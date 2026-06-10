<?php header("Cache-Control: no-cache, no-store, must-revalidate");header("Pragma: no-cache");header("Expires: 0");?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <base href="/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, follow">
    <link rel="canonical" href="https://www.yaozijin.com/">
    <title>404 - 页面未找到 | Yao资金网</title>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></noscript>
    <link rel="stylesheet" href="/css/style.min.css?v=20260519">
    <style>
        .error-page { display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 60vh; text-align: center; padding: 80px 20px; }
        .error-page .error-code { font-size: 120px; font-weight: 800; color: #1e3a8a; line-height: 1; margin-bottom: 10px; }
        .error-page .error-title { font-size: 24px; color: #1f2937; margin-bottom: 12px; }
        .error-page .error-desc { font-size: 15px; color: #6b7280; max-width: 480px; margin-bottom: 30px; line-height: 1.6; }
        .error-page .btn-home { display: inline-flex; align-items: center; gap: 8px; padding: 12px 32px; background: #1e3a8a; color: #fff; border-radius: 8px; font-size: 15px; text-decoration: none; transition: background 0.2s; }
        .error-page .btn-home:hover { background: #2563eb; }
    </style>
</head>
<body>
<?php require_once __DIR__ . '/includes/logo.php'; ?>
<?php include __DIR__ . '/includes/header.php'; ?>

    <main>
        <div class="error-page">
            <div class="error-code">404</div>
            <h1 class="error-title">页面未找到</h1>
            <p class="error-desc">抱歉，您访问的页面不存在或已被移除。<br>请检查网址是否正确，或返回首页浏览。</p>
            <a href="/" class="btn-home"><i class="fas fa-home"></i> 返回首页</a>
        </div>
    </main>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>
</body></html>