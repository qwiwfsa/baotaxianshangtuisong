<?php
/**
 * 同步localStorage文章到数据库
 * 
 * 用法：
 * 1. 在浏览器打开此页面
 * 2. 它会显示一个表单，让你把localStorage数据粘贴进来
 * 3. 点击同步即可
 */

require_once __DIR__ . '/../api/config.php';

header('Content-Type: text/html; charset=utf-8');

$message = '';
$synced = 0;
$skipped = 0;

// 处理POST请求
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['articles_json'])) {
    $articles = json_decode($_POST['articles_json'], true);
    
    if (!$articles || !is_array($articles)) {
        $message = '<div class="error">JSON解析失败，请检查数据格式</div>';
    } else {
        try {
            $conn = getDbConnection();
            initDatabase($conn);
            
            // 获取数据库中已有ID
            $existingIds = [];
            $r = $conn->query("SELECT id FROM cms_articles");
            while ($row = $r->fetch_assoc()) {
                $existingIds[] = $row['id'];
            }
            
            foreach ($articles as $article) {
                $id = isset($article['id']) ? intval($article['id']) : 0;
                $title = $conn->real_escape_string($article['title'] ?? '无标题');
                $summary = $conn->real_escape_string($article['summary'] ?? '');
                $content = $conn->real_escape_string($article['content'] ?? '');
                $categoryId = intval($article['category_id'] ?? $article['categoryId'] ?? 0);
                $coverImage = $conn->real_escape_string($article['cover_image'] ?? $article['coverImage'] ?? '');
                $status = in_array($article['status'] ?? '', ['published', 'draft']) ? $article['status'] : 'published';
                $isTop = intval($article['is_top'] ?? 0);
                $sortOrder = intval($article['sort_order'] ?? $article['sortOrder'] ?? 0);
                
                // 检查是否已存在
                if (in_array($id, $existingIds)) {
                    // 更新
                    $sql = "UPDATE cms_articles SET 
                        title='$title', summary='$summary', content='$content', 
                        category_id=$categoryId, cover_image='$coverImage', status='$status',
                        is_top=$isTop, sort_order=$sortOrder, updated_at=NOW()
                        WHERE id=$id";
                    $conn->query($sql);
                    $synced++;
                } else {
                    // 插入
                    $sql = "INSERT INTO cms_articles 
                        (id, title, summary, content, category_id, cover_image, status, is_top, sort_order, created_at, updated_at)
                        VALUES ($id, '$title', '$summary', '$content', $categoryId, '$coverImage', '$status', $isTop, $sortOrder, NOW(), NOW())";
                    if ($conn->query($sql)) {
                        $synced++;
                    } else {
                        // ID冲突，不加ID插入
                        $sql2 = "INSERT INTO cms_articles 
                            (title, summary, content, category_id, cover_image, status, is_top, sort_order, created_at, updated_at)
                            VALUES ('$title', '$summary', '$content', $categoryId, '$coverImage', '$status', $isTop, $sortOrder, NOW(), NOW())";
                        if ($conn->query($sql2)) {
                            $synced++;
                        } else {
                            $message .= '<div class="error">插入失败: ' . $conn->error . '</div>';
                        }
                    }
                }
            }
            
            $conn->close();
            
            if ($synced > 0) {
                $message = '<div class="success">同步成功！共导入/更新 ' . $synced . ' 篇文章</div>';
            } else {
                $message = '<div class="info">没有需要同步的文章</div>';
            }
            
        } catch (Exception $e) {
            $message = '<div class="error">数据库错误: ' . $e->getMessage() . '</div>';
        }
    }
}

// 显示数据库当前文章数
$dbCount = 0;
try {
    $conn = getDbConnection();
    $r = $conn->query("SELECT COUNT(*) as c FROM cms_articles");
    if ($r) {
        $dbCount = $r->fetch_assoc()['c'];
    }
    // 列出所有文章
    $articlesList = $conn->query("SELECT id, title, category_id, status, cover_image, LEFT(created_at,19) as created_at FROM cms_articles ORDER BY id");
    $conn->close();
} catch (Exception $e) {}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>同步localStorage文章到数据库</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: #f5f7fa; padding: 40px; }
        .container { max-width: 900px; margin: 0 auto; }
        h1 { font-size: 24px; color: #1f2937; margin-bottom: 8px; }
        p { color: #6b7280; margin-bottom: 24px; line-height: 1.6; }
        .steps { background: white; border-radius: 12px; padding: 24px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }
        .steps ol { padding-left: 20px; }
        .steps li { margin-bottom: 8px; color: #374151; line-height: 1.6; }
        .steps code { background: #f3f4f6; padding: 2px 6px; border-radius: 4px; font-size: 13px; }
        form { background: white; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }
        textarea { width: 100%; min-height: 200px; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 13px; font-family: monospace; margin-bottom: 16px; }
        button { padding: 12px 32px; background: #3b82f6; color: white; border: none; border-radius: 8px; font-size: 16px; cursor: pointer; }
        button:hover { background: #2563eb; }
        .success { background: #d1fae5; color: #059669; padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; }
        .error { background: #fef2f2; color: #dc2626; padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; }
        .info { background: #eff6ff; color: #3b82f6; padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; }
        .db-status { background: white; border-radius: 12px; padding: 20px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }
        .db-status h3 { margin-bottom: 12px; color: #1f2937; }
        table { width: 100%; border-collapse: collapse; font-size: 13px; }
        th, td { padding: 8px 12px; text-align: left; border-bottom: 1px solid #e5e7eb; }
        th { background: #f9fafb; font-weight: 600; color: #374151; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 4px; font-size: 12px; }
        .badge-published { background: #d1fae5; color: #059669; }
        .badge-draft { background: #fef3c7; color: #d97706; }
        .no-cover { color: #9ca3af; font-style: italic; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔄 同步localStorage文章到数据库</h1>
        <p>若管理员后台无法保存文章到数据库（仅保存在本地浏览器），使用此工具将localStorage数据导入数据库</p>
        
        <?= $message ?>
        
        <div class="steps">
            <h3>📋 操作步骤</h3>
            <ol>
                <li>打开浏览器控制台 (F12 → Console)</li>
                <li>输入命令：<code>console.log(JSON.stringify(JSON.parse(localStorage.getItem('cms_articles') || '[]'), null, 2))</code> 并按回车</li>
                <li>复制输出的全部JSON内容</li>
                <li>粘贴到下方文本框</li>
                <li>点击"同步到数据库"按钮</li>
            </ol>
        </div>

        <div class="db-status">
            <h3>📊 当前数据库状态</h3>
            <p>数据库中共有 <strong><?= $dbCount ?></strong> 篇文章</p>
            <?php if (isset($articlesList) && $articlesList && $articlesList->num_rows > 0): ?>
            <table>
                <tr><th>ID</th><th>标题</th><th>分类</th><th>状态</th><th>封面图</th><th>创建时间</th></tr>
                <?php while ($row = $articlesList->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars(mb_substr($row['title'], 0, 30)) ?></td>
                    <td><?= htmlspecialchars($row['category_id']) ?></td>
                    <td><span class="badge badge-<?= $row['status'] ?>"><?= $row['status'] ?></span></td>
                    <td><?= $row['cover_image'] ? '<span style="color:#059669">✓ 有</span>' : '<span class="no-cover">无</span>' ?></td>
                    <td><?= $row['created_at'] ?? '' ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
            <?php endif; ?>
        </div>

        <form method="POST">
            <h3 style="margin-bottom:12px">📝 粘贴localStorage文章数据</h3>
            <textarea name="articles_json" placeholder='[{"id":1,"title":"示例文章","content":"..."},...]'><?= htmlspecialchars($_POST['articles_json'] ?? '') ?></textarea>
            <br>
            <button type="submit">🔄 同步到数据库</button>
        </form>
    </div>
</body>
</html>
