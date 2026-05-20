<?php
require_once __DIR__ . "/../config.php";

header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") { http_response_code(200); exit; }
if ($_SERVER["REQUEST_METHOD"] !== "POST") { http_response_code(405); echo json_encode(["code"=>1,"msg"=>"POST only"]); exit; }

$json = file_get_contents("php://input");
$data = json_decode($json, true);
if (!$data) { http_response_code(400); echo json_encode(["code"=>1,"msg"=>"Invalid JSON"]); exit; }

$pageId = $data["page"] ?? $data["page_id"] ?? "";
if (empty($pageId)) { http_response_code(400); echo json_encode(["code"=>1,"msg"=>"Missing page_id"]); exit; }
$pageId = preg_replace("/[^a-zA-Z0-9_-]/", "", $pageId);

$conn = getDbConnection();

// Get page data from database (saved by editor)
$stmt = $conn->prepare("SELECT * FROM cms_pages WHERE page_id = ?");
$stmt->bind_param("s", $pageId);
$stmt->execute();
$result = $stmt->get_result();
if (!$result->num_rows) {
    echo json_encode(["code"=>1,"msg"=>"Page not found. Save the page first before publishing."]);
    exit;
}
$page = $result->fetch_assoc();
$stmt->close();

// Parse content JSON
$pageData = json_decode($page["content"] ?? "{}", true) ?: [];
$pageName = $page["page_name"] ?? $pageId;
$title = $pageData["title"] ?? $page["title"] ?? $pageName;

// Use custom_url for filename if set, otherwise use page_id
$customUrl = trim($page["custom_url"] ?? "");
$outputSlug = !empty($customUrl) ? $customUrl : $pageId;
// Remove any path components, keep just the filename part
$outputSlug = basename($outputSlug);
// Ensure it ends with .html
if (!preg_match('/\.html$/', $outputSlug)) $outputSlug .= ".html";

// Build HTML file path in root directory
$targetFile = __DIR__ . "/../../" . $outputSlug;

// Read templates for header/footer
$indexTemplate = @file_get_contents(__DIR__ . "/../../index.html");
$headerHtml = "";
$footerHtml = "";

if ($indexTemplate) {
    // Extract header (everything before <main>)
    $mainPos = strpos($indexTemplate, "<main");
    if ($mainPos !== false) {
        $headerHtml = substr($indexTemplate, 0, $mainPos);
    } else {
        // Fallback: everything before closing </head> plus opening body
        $headEnd = strpos($indexTemplate, "</head>");
        $bodyStart = strpos($indexTemplate, "<body");
        if ($headEnd !== false) {
            $headerHtml = substr($indexTemplate, 0, $headEnd + 7) . "\n";
            if ($bodyStart !== false) {
                $bodyOpenEnd = strpos($indexTemplate, ">", $bodyStart) + 1;
                $headerHtml .= substr($indexTemplate, $bodyStart, $bodyOpenEnd - $bodyStart);
            } else {
                $headerHtml .= "<body>";
            }
        }
    }

    // Extract footer (everything after </main>)
    $mainClose = strrpos($indexTemplate, "</main>");
    if ($mainClose !== false) {
        $footerHtml = substr($indexTemplate, $mainClose + 7);
    } else {
        // Fallback: everything from <footer to end
        $footerStart = strrpos($indexTemplate, "<footer");
        if ($footerStart !== false) {
            $footerHtml = substr($indexTemplate, $footerStart);
        } else {
            // Default footer
            $footerHtml = '<footer class="footer"><div class="footer-container"><p>&copy; 2026 Yao资金网</p></div></footer></body></html>';
        }
    }
} else {
    // No template - use basic structure
    $headerHtml = "<!DOCTYPE html>\n<html lang=\"zh-CN\">\n<head>\n<meta charset=\"UTF-8\">\n<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n<title>" . htmlspecialchars($title) . "</title>\n<link rel=\"stylesheet\" href=\"/css/style.min.css?v=20260519\">\n</head>\n<body>";
    $footerHtml = "<footer class=\"footer\"><p>&copy; 2026 Yao资金网</p></footer>\n</body>\n</html>";
}

// Fix relative paths in header to be absolute
$headerHtml = str_replace('href="css/', 'href="/css/', $headerHtml);
$headerHtml = str_replace('src="js/', 'src="/js/', $headerHtml);
$headerHtml = str_replace('href="uploads/', 'href="/uploads/', $headerHtml);
$headerHtml = str_replace('src="uploads/', 'src="/uploads/', $headerHtml);
$headerHtml = str_replace('href="images/', 'href="/images/', $headerHtml);
// Update title
$headerHtml = preg_replace('/<title>[^<]*<\/title>/', '<title>' . htmlspecialchars($title) . ' - Yao资金网</title>', $headerHtml);

// Build page content - read modules from page_builder_modules table
$contentHtml = "";

// Query modules from the page builder modules table
$modResult = $conn->query("SELECT module_type, module_data FROM page_builder_modules WHERE page_id = '" . $conn->real_escape_string($pageId) . "' AND is_active = 1 ORDER BY sort_order ASC");
if ($modResult && $modResult->num_rows > 0) {
    while ($mod = $modResult->fetch_assoc()) {
        $modData = json_decode($mod["module_data"] ?? "{}", true) ?: [];
        $type = $mod["module_type"] ?? "text";

        // Render module based on type
        $html = "";
        switch ($type) {
            case "banner":
                $title = $modData["title"] ?? "";
                $subtitle = $modData["subtitle"] ?? "";
                $bg = $modData["background"] ?? "";
                $html = '<section class="hero"' . ($bg ? ' style="background-image:url(' . htmlspecialchars($bg) . ')"' : '') . '><div class="hero-container"><h1 class="hero-title">' . htmlspecialchars($title) . '</h1><p class="hero-subtitle">' . htmlspecialchars($subtitle) . '</p></div></section>';
                break;
            case "text":
                $content = $modData["content"] ?? $modData["html"] ?? "";
                $html = '<section class="page-section"><div class="section-container">' . $content . '</div></section>';
                break;
            case "image":
                $src = $modData["src"] ?? $modData["url"] ?? "";
                $alt = $modData["alt"] ?? "";
                $html = '<section class="page-section"><div class="section-container"><img src="' . htmlspecialchars($src) . '" alt="' . htmlspecialchars($alt) . '" style="max-width:100%"></div></section>';
                break;
            case "card":
                $cards = $modData["cards"] ?? [];
                $html = '<section class="page-section"><div class="section-container"><div class="card-grid">';
                foreach ($cards as $card) {
                    $html .= '<div class="card"><h3>' . htmlspecialchars($card["title"] ?? "") . '</h3><p>' . htmlspecialchars($card["content"] ?? "") . '</p></div>';
                }
                $html .= '</div></div></section>';
                break;
            default:
                $content = $modData["content"] ?? $modData["html"] ?? "";
                $html = '<div class="module module-' . htmlspecialchars($type) . '">' . $content . '</div>';
        }
        $contentHtml .= $html . "\n";
    }
}

// Also check cms_pages.content for sections/modules
if (empty($contentHtml)) {
    $sections = $pageData["sections"] ?? [];
    $modules = $pageData["modules"] ?? [];
    if (!empty($modules)) {
        foreach ($modules as $mod) {
            $type = $mod["type"] ?? "text";
            $content = $mod["content"] ?? $mod["html"] ?? "";
            $contentHtml .= '<div class="module module-' . htmlspecialchars($type) . '">' . $content . '</div>' . "\n";
        }
    }
    if (!empty($sections)) {
        foreach ($sections as $sec) {
            if (is_string($sec)) $contentHtml .= $sec . "\n";
        }
    }
    if (empty($contentHtml) && !empty($pageData["content"])) {
        $contentHtml = $pageData["content"];
    }
}

// If still empty, show placeholder
if (empty($contentHtml)) {
    $contentHtml = '<div class="page-content" style="max-width:800px;margin:40px auto;padding:40px;background:#fff;border-radius:10px"><h1>' . htmlspecialchars($title) . '</h1><p style="color:#94a3b8">页面内容正在编辑中，请在页面设计器中添加模块后保存再发布。</p></div>';
}

// Assemble full page
$fullHtml = $headerHtml . "\n<main id=\"main-content\">\n" . $contentHtml . "\n</main>\n" . $footerHtml;

// Write file
$written = @file_put_contents($targetFile, $fullHtml, LOCK_EX);
if ($written === false) {
    echo json_encode(["code"=>1,"msg"=>"Failed to write file: " . $targetFile]);
    exit;
}

// Update database record
$stmt = $conn->prepare("UPDATE cms_pages SET last_modified = NOW() WHERE page_id = ?");
$stmt->bind_param("s", $pageId);
$stmt->execute();
$stmt->close();
$conn->close();

echo json_encode([
    "code" => 0,
    "msg" => "success",
    "data" => [
        "html_path" => "/" . $outputSlug,
        "page_id" => $pageId,
        "file" => $targetFile,
        "size" => $written
    ]
], JSON_UNESCAPED_UNICODE);
