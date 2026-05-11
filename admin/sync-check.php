<?php
/**
 * 案例数据同步检查工具
 * 检查后台和前端的案例数据是否一致
 */

// 开启错误报告
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 设置响应头
header('Content-Type: text/html; charset=utf-8');

// 数据目录
$adminDataDir = __DIR__ . '/data/cases/';
$frontendDataDir = dirname(__DIR__) . '/data/cases/';
$adminIndexFile = __DIR__ . '/data/cases-index.json';
$frontendIndexFile = dirname(__DIR__) . '/data/cases-index.json';

echo '<!DOCTYPE html>';
echo '<html lang="zh-CN">';
echo '<head>';
echo '<meta charset="UTF-8">';
echo '<title>案例数据同步检查</title>';
echo '<style>';
echo 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "PingFang SC", sans-serif; padding: 20px; background: #f5f5f5; }';
echo '.container { max-width: 1200px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }';
echo 'h1 { color: #333; border-bottom: 2px solid #3b82f6; padding-bottom: 10px; }';
echo 'h2 { color: #555; margin-top: 30px; }';
echo 'table { width: 100%; border-collapse: collapse; margin-top: 20px; }';
echo 'th, td { padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb; }';
echo 'th { background: #f9fafb; font-weight: 600; color: #374151; }';
echo 'tr:hover { background: #f9fafb; }';
echo '.status-ok { color: #10b981; font-weight: 600; }';
echo '.status-error { color: #ef4444; font-weight: 600; }';
echo '.status-warning { color: #f59e0b; font-weight: 600; }';
echo '.info-box { background: #eff6ff; border-left: 4px solid #3b82f6; padding: 15px; margin: 20px 0; }';
echo '.error-box { background: #fef2f2; border-left: 4px solid #ef4444; padding: 15px; margin: 20px 0; }';
echo '.success-box { background: #d1fae5; border-left: 4px solid #10b981; padding: 15px; margin: 20px 0; }';
echo '</style>';
echo '</head>';
echo '<body>';
echo '<div class="container">';
echo '<h1>🔍 案例数据同步检查工具</h1>';

// 检查目录是否存在
echo '<h2>📁 目录状态</h2>';
echo '<table>';
echo '<tr><th>目录</th><th>路径</th><th>状态</th></tr>';

$dirs = [
    '后台数据目录' => $adminDataDir,
    '前端数据目录' => $frontendDataDir,
];

foreach ($dirs as $name => $dir) {
    $exists = file_exists($dir);
    $status = $exists ? '<span class="status-ok">✓ 存在</span>' : '<span class="status-error">✗ 不存在</span>';
    echo '<tr>';
    echo '<td>' . $name . '</td>';
    echo '<td>' . $dir . '</td>';
    echo '<td>' . $status . '</td>';
    echo '</tr>';
}
echo '</table>';

// 读取后台案例
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

// 读取前端案例
$frontendCases = [];
if (file_exists($frontendDataDir)) {
    $files = glob($frontendDataDir . '*.json');
    foreach ($files as $file) {
        $json = file_get_contents($file);
        $caseData = json_decode($json, true);
        if ($caseData && isset($caseData['id'])) {
            $frontendCases[$caseData['id']] = $caseData;
        }
    }
}

// 显示统计信息
echo '<h2>📊 数据统计</h2>';
echo '<table>';
echo '<tr><th>位置</th><th>案例总数</th><th>已发布</th><th>草稿</th></tr>';

$adminPublished = count(array_filter($adminCases, fn($c) => ($c['status'] ?? 'draft') === 'published'));
$adminDraft = count(array_filter($adminCases, fn($c) => ($c['status'] ?? 'draft') === 'draft'));
$frontendPublished = count(array_filter($frontendCases, fn($c) => ($c['status'] ?? 'draft') === 'published'));
$frontendDraft = count(array_filter($frontendCases, fn($c) => ($c['status'] ?? 'draft') === 'draft'));

echo '<tr>';
echo '<td>后台</td>';
echo '<td>' . count($adminCases) . '</td>';
echo '<td>' . $adminPublished . '</td>';
echo '<td>' . $adminDraft . '</td>';
echo '</tr>';

echo '<tr>';
echo '<td>前端</td>';
echo '<td>' . count($frontendCases) . '</td>';
echo '<td>' . $frontendPublished . '</td>';
echo '<td>' . $frontendDraft . '</td>';
echo '</tr>';
echo '</table>';

// 检查同步状态
echo '<h2>🔄 同步状态检查</h2>';
echo '<table>';
echo '<tr><th>案例ID</th><th>标题</th><th>后台状态</th><th>前端状态</th><th>同步状态</th><th>最后修改时间</th></tr>';

$allCaseIds = array_unique(array_merge(array_keys($adminCases), array_keys($frontendCases)));

foreach ($allCaseIds as $caseId) {
    $inAdmin = isset($adminCases[$caseId]);
    $inFrontend = isset($frontendCases[$caseId]);
    
    if ($inAdmin) {
        $adminCase = $adminCases[$caseId];
        $title = $adminCase['title'] ?? '无标题';
        $adminStatus = $adminCase['status'] ?? 'draft';
        $lastModified = $adminCase['lastModified'] ?? '未知';
        
        if ($inFrontend) {
            $frontendCase = $frontendCases[$caseId];
            $frontendStatus = $frontendCase['status'] ?? 'draft';
            
            // 检查内容是否一致
            $adminJson = json_encode($adminCase);
            $frontendJson = json_encode($frontendCase);
            $isIdentical = ($adminJson === $frontendJson);
            
            if ($adminStatus === 'published' && $frontendStatus === 'published' && $isIdentical) {
                $syncStatus = '<span class="status-ok">✓ 已同步</span>';
            } elseif ($adminStatus === 'published' && $frontendStatus === 'published' && !$isIdentical) {
                $syncStatus = '<span class="status-warning">⚠ 内容不一致</span>';
            } elseif ($adminStatus === 'draft' && !$inFrontend) {
                $syncStatus = '<span class="status-ok">✓ 正常（草稿不同步）</span>';
            } else {
                $syncStatus = '<span class="status-error">✗ 同步异常</span>';
            }
            
            echo '<tr>';
            echo '<td>' . $caseId . '</td>';
            echo '<td>' . htmlspecialchars($title) . '</td>';
            echo '<td>' . $adminStatus . '</td>';
            echo '<td>' . $frontendStatus . '</td>';
            echo '<td>' . $syncStatus . '</td>';
            echo '<td>' . $lastModified . '</td>';
            echo '</tr>';
        } else {
            // 只在后台存在
            if ($adminStatus === 'published') {
                $syncStatus = '<span class="status-error">✗ 未同步到前端</span>';
            } else {
                $syncStatus = '<span class="status-ok">✓ 正常（草稿）</span>';
            }
            
            echo '<tr>';
            echo '<td>' . $caseId . '</td>';
            echo '<td>' . htmlspecialchars($title) . '</td>';
            echo '<td>' . $adminStatus . '</td>';
            echo '<td>不存在</td>';
            echo '<td>' . $syncStatus . '</td>';
            echo '<td>' . $lastModified . '</td>';
            echo '</tr>';
        }
    } else {
        // 只在前端存在（异常情况）
        $frontendCase = $frontendCases[$caseId];
        $title = $frontendCase['title'] ?? '无标题';
        $frontendStatus = $frontendCase['status'] ?? 'draft';
        $lastModified = $frontendCase['lastModified'] ?? '未知';
        
        echo '<tr style="background: #fef2f2;">';
        echo '<td>' . $caseId . '</td>';
        echo '<td>' . htmlspecialchars($title) . '</td>';
        echo '<td>不存在</td>';
        echo '<td>' . $frontendStatus . '</td>';
        echo '<td><span class="status-error">✗ 前端孤儿数据</span></td>';
        echo '<td>' . $lastModified . '</td>';
        echo '</tr>';
    }
}

echo '</table>';

// 提供修复建议
echo '<h2>🔧 修复建议</h2>';

$issues = [];

// 检查未同步的已发布案例
foreach ($adminCases as $caseId => $caseData) {
    if (($caseData['status'] ?? 'draft') === 'published' && !isset($frontendCases[$caseId])) {
        $issues[] = '案例 ' . $caseId . ' (' . ($caseData['title'] ?? '无标题') . ') 已发布但未同步到前端';
    }
}

// 检查内容不一致的案例
foreach ($adminCases as $caseId => $adminCase) {
    if (isset($frontendCases[$caseId])) {
        $frontendCase = $frontendCases[$caseId];
        $adminJson = json_encode($adminCase);
        $frontendJson = json_encode($frontendCase);
        if ($adminJson !== $frontendJson) {
            $issues[] = '案例 ' . $caseId . ' (' . ($adminCase['title'] ?? '无标题') . ') 前后端内容不一致';
        }
    }
}

if (empty($issues)) {
    echo '<div class="success-box">✓ 没有发现同步问题，所有数据正常！</div>';
} else {
    echo '<div class="error-box">';
    echo '<strong>发现以下问题：</strong><ul>';
    foreach ($issues as $issue) {
        echo '<li>' . $issue . '</li>';
    }
    echo '</ul>';
    echo '<p><strong>解决方法：</strong></p>';
    echo '<ol>';
    echo '<li>进入后台案例管理，编辑有问题的案例</li>';
    echo '<li>点击保存按钮重新触发同步</li>';
    echo '<li>刷新此页面检查同步状态</li>';
    echo '</ol>';
    echo '</div>';
}

echo '<div class="info-box">';
echo '<strong>提示：</strong>此工具用于诊断后台和前端案例数据同步问题。如果发现同步异常，请重新保存案例以触发同步。';
echo '</div>';

echo '</div>';
echo '</body>';
echo '</html>';
