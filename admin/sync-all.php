<?php
/**
 * 案例数据手动同步工具
 * 强制同步所有已发布的案例到前端目录
 */

// 开启错误报告
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 设置响应头
header('Content-Type: text/html; charset=utf-8');

// 数据目录
$adminDataDir = __DIR__ . '/data/cases/';
$frontendDataDir = dirname(__DIR__) . '/data/cases/';
$frontendIndexFile = dirname(__DIR__) . '/data/cases-index.json';

$action = $_GET['action'] ?? 'check';

echo '<!DOCTYPE html>';
echo '<html lang="zh-CN">';
echo '<head>';
echo '<meta charset="UTF-8">';
echo '<title>案例数据同步工具</title>';
echo '<style>';
echo 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "PingFang SC", sans-serif; padding: 20px; background: #f5f5f5; }';
echo '.container { max-width: 1000px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }';
echo 'h1 { color: #333; border-bottom: 2px solid #3b82f6; padding-bottom: 10px; }';
echo '.btn { display: inline-block; padding: 12px 24px; background: #3b82f6; color: white; text-decoration: none; border-radius: 6px; margin: 10px 5px; border: none; cursor: pointer; font-size: 14px; }';
echo '.btn:hover { background: #2563eb; }';
echo '.btn-success { background: #10b981; }';
echo '.btn-success:hover { background: #059669; }';
echo '.btn-warning { background: #f59e0b; }';
echo '.btn-warning:hover { background: #d97706; }';
echo '.log { background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 6px; padding: 15px; margin-top: 20px; max-height: 500px; overflow-y: auto; font-family: monospace; font-size: 13px; line-height: 1.6; }';
echo '.log-entry { padding: 4px 0; border-bottom: 1px solid #e5e7eb; }';
echo '.log-success { color: #10b981; }';
echo '.log-error { color: #ef4444; }';
echo '.log-info { color: #3b82f6; }';
echo '.stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin: 20px 0; }';
echo '.stat-card { background: #f9fafb; padding: 20px; border-radius: 8px; text-align: center; }';
echo '.stat-value { font-size: 32px; font-weight: 700; color: #3b82f6; }';
echo '.stat-label { font-size: 14px; color: #6b7280; margin-top: 5px; }';
echo '</style>';
echo '</head>';
echo '<body>';
echo '<div class="container">';
echo '<h1>🔄 案例数据同步工具</h1>';

// 读取后台所有案例
$adminCases = [];
if (file_exists($adminDataDir)) {
    $files = glob($adminDataDir . '*.json');
    foreach ($files as $file) {
        $json = file_get_contents($file);
        $caseData = json_decode($json, true);
        if ($caseData && isset($caseData['id'])) {
            $adminCases[$caseData['id']] = $caseData;
        }
    }
}

// 统计
$totalCases = count($adminCases);
$publishedCases = count(array_filter($adminCases, fn($c) => ($c['status'] ?? 'draft') === 'published'));
$draftCases = count(array_filter($adminCases, fn($c) => ($c['status'] ?? 'draft') === 'draft'));

echo '<div class="stats">';
echo '<div class="stat-card">';
echo '<div class="stat-value">' . $totalCases . '</div>';
echo '<div class="stat-label">案例总数</div>';
echo '</div>';
echo '<div class="stat-card">';
echo '<div class="stat-value">' . $publishedCases . '</div>';
echo '<div class="stat-label">已发布</div>';
echo '</div>';
echo '<div class="stat-card">';
echo '<div class="stat-value">' . $draftCases . '</div>';
echo '<div class="stat-label">草稿</div>';
echo '</div>';
echo '</div>';

// 操作按钮
echo '<div style="margin: 20px 0;">';
echo '<a href="?action=sync" class="btn btn-success">🔄 同步所有已发布案例</a>';
echo '<a href="?action=clean" class="btn btn-warning">🧹 清理前端孤儿数据</a>';
echo '<a href="sync-check.php" class="btn">🔍 返回检查工具</a>';
echo '</div>';

// 执行同步
if ($action === 'sync') {
    echo '<h2>同步日志</h2>';
    echo '<div class="log">';
    
    // 确保前端目录存在
    if (!file_exists($frontendDataDir)) {
        mkdir($frontendDataDir, 0755, true);
        echo '<div class="log-entry log-info">创建前端目录: ' . $frontendDataDir . '</div>';
    }
    
    // 构建前端索引
    $frontendIndex = [];
    $syncCount = 0;
    $errorCount = 0;
    
    foreach ($adminCases as $caseId => $caseData) {
        $status = $caseData['status'] ?? 'draft';
        $title = $caseData['title'] ?? '无标题';
        
        if ($status === 'published') {
            // 同步到前端
            $frontendCaseFile = $frontendDataDir . $caseId . '.json';
            $result = file_put_contents($frontendCaseFile, json_encode($caseData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            
            if ($result !== false) {
                echo '<div class="log-entry log-success">✓ 同步成功: ' . $caseId . ' - ' . htmlspecialchars($title) . '</div>';
                $syncCount++;
                
                // 添加到索引
                $frontendIndex[] = [
                    'id' => $caseData['id'],
                    'title' => $caseData['title'],
                    'type' => $caseData['type'],
                    'city' => $caseData['city'],
                    'amount' => $caseData['amount'],
                    'summary' => $caseData['summary'] ?? '',
                    'image' => $caseData['image'],
                    'coverImage' => $caseData['coverImage'] ?? $caseData['image'],
                    'images' => $caseData['images'] ?? [],
                    'status' => $caseData['status'],
                    'lastModified' => $caseData['lastModified']
                ];
            } else {
                echo '<div class="log-entry log-error">✗ 同步失败: ' . $caseId . ' - ' . htmlspecialchars($title) . '</div>';
                $errorCount++;
            }
        } else {
            echo '<div class="log-entry log-info">○ 跳过草稿: ' . $caseId . ' - ' . htmlspecialchars($title) . '</div>';
        }
    }
    
    // 保存前端索引
    $frontendIndexDir = dirname($frontendIndexFile);
    if (!file_exists($frontendIndexDir)) {
        mkdir($frontendIndexDir, 0755, true);
    }
    
    $indexResult = file_put_contents($frontendIndexFile, json_encode($frontendIndex, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    if ($indexResult !== false) {
        echo '<div class="log-entry log-success">✓ 索引文件更新成功: ' . $frontendIndexFile . '</div>';
    } else {
        echo '<div class="log-entry log-error">✗ 索引文件更新失败: ' . $frontendIndexFile . '</div>';
    }
    
    echo '</div>';
    
    echo '<div style="margin-top: 20px; padding: 15px; background: #f0fdf4; border-radius: 6px;">';
    echo '<strong>同步完成！</strong><br>';
    echo '成功: ' . $syncCount . ' 个案例<br>';
    echo '失败: ' . $errorCount . ' 个案例';
    echo '</div>';
}

// 清理孤儿数据
if ($action === 'clean') {
    echo '<h2>清理日志</h2>';
    echo '<div class="log">';
    
    // 读取前端案例
    $frontendCases = [];
    if (file_exists($frontendDataDir)) {
        $files = glob($frontendDataDir . '*.json');
        foreach ($files as $file) {
            $json = file_get_contents($file);
            $caseData = json_decode($json, true);
            if ($caseData && isset($caseData['id'])) {
                $frontendCases[$caseData['id']] = $file;
            }
        }
    }
    
    $cleanCount = 0;
    foreach ($frontendCases as $caseId => $filePath) {
        if (!isset($adminCases[$caseId])) {
            // 前端存在但后台不存在，删除
            if (unlink($filePath)) {
                echo '<div class="log-entry log-success">✓ 删除孤儿数据: ' . $caseId . '</div>';
                $cleanCount++;
            } else {
                echo '<div class="log-entry log-error">✗ 删除失败: ' . $caseId . '</div>';
            }
        }
    }
    
    if ($cleanCount === 0) {
        echo '<div class="log-entry log-info">没有发现孤儿数据</div>';
    }
    
    echo '</div>';
    
    echo '<div style="margin-top: 20px; padding: 15px; background: #f0fdf4; border-radius: 6px;">';
    echo '<strong>清理完成！</strong><br>';
    echo '删除: ' . $cleanCount . ' 个孤儿文件';
    echo '</div>';
}

echo '</div>';
echo '</body>';
echo '</html>';
