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

$pageData = json_decode($page["content"] ?? "{}", true) ?: [];
$pageName = $page["page_name"] ?? $pageId;
$title = $pageData["title"] ?? $page["title"] ?? $pageName;

$customUrl = trim($page["custom_url"] ?? "");
$outputSlug = !empty($customUrl) ? $customUrl : $pageId;
$outputSlug = basename($outputSlug);
if (!preg_match('/\.html$/', $outputSlug)) $outputSlug .= ".html";

$targetFile = __DIR__ . "/../../../" . $outputSlug;

$indexTemplate = @file_get_contents(__DIR__ . "/../../../index.html");
$headerHtml = "";
$footerHtml = "";

if ($indexTemplate) {
    $mainPos = strpos($indexTemplate, "<main");
    if ($mainPos !== false) {
        $headerHtml = substr($indexTemplate, 0, $mainPos);
    } else {
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

    $mainClose = strrpos($indexTemplate, "</main>");
    if ($mainClose !== false) {
        $footerHtml = substr($indexTemplate, $mainClose + 7);
    } else {
        $footerStart = strrpos($indexTemplate, "<footer");
        if ($footerStart !== false) {
            $footerHtml = substr($indexTemplate, $footerStart);
        } else {
            $footerHtml = '<footer class="footer"><div class="footer-container"><p>&copy; 2026 Yao资金网</p></div></footer></body></html>';
        }
    }
} else {
    $headerHtml = "<!DOCTYPE html>\n<html lang=\"zh-CN\">\n<head>\n<meta charset=\"UTF-8\">\n<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n<title>" . htmlspecialchars($title) . "</title>\n<link rel=\"stylesheet\" href=\"/css/style.min.css?v=20260519\">\n</head>\n<body>";
    $footerHtml = "<footer class=\"footer\"><p>&copy; 2026 Yao资金网</p></footer>\n</body>\n</html>";
}

$headerHtml = str_replace('href="css/', 'href="/css/', $headerHtml);
$headerHtml = str_replace('src="js/', 'src="/js/', $headerHtml);
$headerHtml = str_replace('href="uploads/', 'href="/uploads/', $headerHtml);
$headerHtml = str_replace('src="uploads/', 'src="/uploads/', $headerHtml);
$headerHtml = str_replace('href="images/', 'href="/images/', $headerHtml);
$headerHtml = preg_replace('/<title>[^<]*<\/title>/', '<title>' . htmlspecialchars($title) . ' - Yao资金网</title>', $headerHtml);

$pbStyles = '<style id="pb-modules">
.page-section{padding:60px 0}.section-container{max-width:1200px;margin:0 auto;padding:0 24px}.section-container h2{font-size:28px;font-weight:700;margin-bottom:16px;color:#1e293b}
.hero{position:relative;overflow:hidden}.hero-slide{position:absolute;inset:0}.hero-slide img{width:100%;height:100%;object-fit:cover}.hero-container{max-width:1200px;margin:0 auto;padding:60px 24px}.hero-title{font-size:42px;font-weight:800;margin-bottom:12px}.hero-subtitle{font-size:20px;margin-bottom:24px;opacity:0.9}
.btn{display:inline-block;padding:10px 28px;border-radius:8px;font-size:15px;font-weight:600;text-decoration:none;transition:all 0.2s;cursor:pointer;border:none}.btn-primary{background:#2563eb;color:#fff}.btn-primary:hover{background:#1d4ed8}.btn-secondary{background:#64748b;color:#fff}.btn-outline{background:transparent;color:#2563eb;border:2px solid #2563eb}.btn-small{padding:6px 18px;font-size:13px}.btn-medium{padding:10px 28px;font-size:15px}.btn-large{padding:14px 36px;font-size:17px}
.card-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:24px}.card{background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,0.06);transition:box-shadow 0.25s,transform 0.25s}.card:hover{box-shadow:0 8px 30px rgba(0,0,0,0.10);transform:translateY(-2px)}.card-img img{width:100%;height:200px;object-fit:cover}.card-body{padding:20px}.card-body h3{font-size:18px;font-weight:600;margin-bottom:8px;color:#1e293b}.card-body p{font-size:14px;color:#64748b;line-height:1.6;margin-bottom:12px}.card-link{color:#2563eb;font-weight:600;font-size:14px;text-decoration:none}.card-link:hover{text-decoration:underline}
.carousel{position:relative;overflow:hidden}.carousel-slide{position:absolute;inset:0}.carousel-slide img{width:100%;height:100%;object-fit:cover}
.module-image-text{display:flex;gap:24px;align-items:center}.module-image-text img{width:100%;border-radius:8px}
.module-container{margin:0 auto}
.module-video video{width:100%;border-radius:8px}
.module-button{padding:20px 0}.module-custom{padding:20px 0}.module-custom img{max-width:100%;height:auto}
@media(max-width:768px){.page-section{padding:40px 0}.section-container{padding:0 16px}.hero-title{font-size:28px}.hero-subtitle{font-size:16px}.card-grid{grid-template-columns:repeat(auto-fill,minmax(260px,1fr))}.module-image-text{flex-direction:column}}
</style>';
$headerHtml = str_replace('</head>', $pbStyles . '</head>', $headerHtml);

$contentHtml = "";

$escapedPageId = $conn->real_escape_string($pageId);
$modResult = $conn->query("SELECT module_type, module_data FROM page_builder_modules WHERE (page_id = '$escapedPageId' OR page_id = 'pages/$escapedPageId') AND is_active = 1 ORDER BY sort_order ASC");
if ($modResult && $modResult->num_rows > 0) {
    while ($mod = $modResult->fetch_assoc()) {
        $modData = json_decode($mod["module_data"] ?? "{}", true) ?: [];
        $type = $mod["module_type"] ?? "text";

        $html = "";
        switch ($type) {
            case "banner":
                $items = $modData["items"] ?? [];
                $height = $modData["height"] ?? 500;
                $html = '<section class="hero" style="position:relative;overflow:hidden;height:' . ((int)$height) . 'px">';
                if (!empty($items)) {
                    foreach ($items as $i => $item) {
                        $display = $i === 0 ? 'block' : 'none';
                        $html .= '<div class="hero-slide" style="display:' . $display . ';position:absolute;inset:0">';
                        if (!empty($item["image"])) {
                            $html .= '<img src="' . htmlspecialchars($item["image"]) . '" alt="' . htmlspecialchars($item["title"] ?? "") . '" style="width:100%;height:100%;object-fit:cover">';
                        }
                        if (!empty($item["title"]) || !empty($item["subtitle"])) {
                            $html .= '<div class="hero-container" style="position:absolute;bottom:60px;left:50%;transform:translateX(-50%);text-align:center;color:#fff;text-shadow:0 2px 8px rgba(0,0,0,.5)">';
                            if (!empty($item["title"])) $html .= '<h1 class="hero-title">' . htmlspecialchars($item["title"]) . '</h1>';
                            if (!empty($item["subtitle"])) $html .= '<p class="hero-subtitle">' . htmlspecialchars($item["subtitle"]) . '</p>';
                            if (!empty($item["link"])) $html .= '<a href="' . htmlspecialchars($item["link"]) . '" class="btn btn-primary">了解更多</a>';
                            $html .= '</div>';
                        }
                        $html .= '</div>';
                    }
                }
                $html .= '</section>';
                break;
            case "text":
                $textContent = $modData["content"] ?? $modData["html"] ?? "";
                $html = '<section class="page-section"><div class="section-container">' . $textContent . '</div></section>';
                break;
            case "image":
                $src = $modData["src"] ?? $modData["url"] ?? "";
                $alt = $modData["alt"] ?? "";
                $imgWidth = $modData["width"] ?? "100%";
                $html = '<section class="page-section"><div class="section-container"><img src="' . htmlspecialchars($src) . '" alt="' . htmlspecialchars($alt) . '" style="max-width:100%;width:' . htmlspecialchars($imgWidth) . '" loading="lazy"></div></section>';
                break;
            case "button":
                $btnText = $modData["text"] ?? $modData["title"] ?? "按钮";
                $btnLink = $modData["link"] ?? $modData["url"] ?? "#";
                $btnType = $modData["type"] ?? "primary";
                $btnSize = $modData["size"] ?? "medium";
                $btnAlign = $modData["align"] ?? "center";
                $newWindow = !empty($modData["newWindow"]) ? ' target="_blank" rel="noopener"' : '';
                $html = '<div class="module module-button" style="text-align:' . htmlspecialchars($btnAlign) . ';padding:20px 0"><a href="' . htmlspecialchars($btnLink) . '" class="btn btn-' . htmlspecialchars($btnType) . ' btn-' . htmlspecialchars($btnSize) . '"' . $newWindow . '>' . htmlspecialchars($btnText) . '</a></div>';
                break;
            case "card":
                $cards = $modData["items"] ?? $modData["cards"] ?? [];
                $html = '<section class="page-section"><div class="section-container"><div class="card-grid">';
                foreach ($cards as $card) {
                    $html .= '<div class="card">';
                    if (!empty($card["image"])) {
                        $html .= '<div class="card-img"><img src="' . htmlspecialchars($card["image"]) . '" alt="' . htmlspecialchars($card["title"] ?? "") . '" loading="lazy"></div>';
                    }
                    $html .= '<div class="card-body">';
                    if (!empty($card["title"])) $html .= '<h3>' . htmlspecialchars($card["title"]) . '</h3>';
                    $desc = $card["description"] ?? $card["content"] ?? "";
                    if (!empty($desc)) $html .= '<p>' . htmlspecialchars($desc) . '</p>';
                    if (!empty($card["link"])) $html .= '<a href="' . htmlspecialchars($card["link"]) . '" class="card-link">查看详情</a>';
                    $html .= '</div></div>';
                }
                $html .= '</div></div></section>';
                break;
            case "carousel":
                $cItems = $modData["items"] ?? [];
                $cHeight = $modData["height"] ?? 400;
                $html = '<section class="page-section"><div class="section-container"><div class="carousel" style="position:relative;overflow:hidden;height:' . ((int)$cHeight) . 'px">';
                if (!empty($cItems)) {
                    foreach ($cItems as $i => $item) {
                        $display = $i === 0 ? 'block' : 'none';
                        $html .= '<div class="carousel-slide" style="display:' . $display . ';position:absolute;inset:0">';
                        if (!empty($item["image"])) {
                            $html .= '<img src="' . htmlspecialchars($item["image"]) . '" alt="' . htmlspecialchars($item["title"] ?? "") . '" style="width:100%;height:100%;object-fit:cover">';
                        }
                        if (!empty($item["title"])) {
                            $html .= '<div style="position:absolute;bottom:40px;left:50%;transform:translateX(-50%);color:#fff;text-shadow:0 2px 4px rgba(0,0,0,.5)"><h2>' . htmlspecialchars($item["title"]) . '</h2></div>';
                        }
                        $html .= '</div>';
                    }
                }
                $html .= '</div></div></section>';
                break;
            case "imageText":
                $layout = $modData["layout"] ?? "image-left";
                $flexDir = ($layout === "image-right") ? "row-reverse" : (($layout === "image-top") ? "column" : "row");
                $imgW = $modData["imageWidth"] ?? "40%";
                $html = '<section class="page-section"><div class="section-container"><div style="display:flex;flex-direction:' . $flexDir . ';gap:24px;align-items:center">';
                if (!empty($modData["image"])) {
                    $html .= '<div style="flex:0 0 ' . htmlspecialchars($imgW) . ';max-width:100%"><img src="' . htmlspecialchars($modData["image"]) . '" alt="' . htmlspecialchars($modData["title"] ?? "") . '" style="width:100%;border-radius:8px" loading="lazy"></div>';
                }
                $html .= '<div style="flex:1">';
                if (!empty($modData["title"])) $html .= '<h2>' . htmlspecialchars($modData["title"]) . '</h2>';
                if (!empty($modData["content"])) $html .= '<div>' . $modData["content"] . '</div>';
                $html .= '</div></div></div></section>';
                break;
            case "container":
                $cWidth = $modData["width"] ?? "100%";
                $cPadding = $modData["padding"] ?? "24px";
                $cBgColor = $modData["bgColor"] ?? "#ffffff";
                $cBorderRadius = $modData["borderRadius"] ?? "0";
                $bgStyle = !empty($modData["bgImage"]) ? 'background-image:url(' . htmlspecialchars($modData["bgImage"]) . ');background-size:cover;background-position:center' : 'background-color:' . htmlspecialchars($cBgColor);
                $html = '<div class="module module-container" style="width:' . htmlspecialchars($cWidth) . ';padding:' . htmlspecialchars($cPadding) . ';' . $bgStyle . ';border-radius:' . htmlspecialchars($cBorderRadius) . ';min-height:60px;margin:0 auto">';
                $cContent = $modData["content"] ?? $modData["html"] ?? "";
                if (!empty($cContent)) $html .= $cContent;
                $html .= '</div>';
                break;
            case "video":
                $vSrc = $modData["src"] ?? "";
                $vPoster = $modData["poster"] ?? "";
                $vAutoplay = !empty($modData["autoplay"]) ? " autoplay" : "";
                $html = '<section class="page-section"><div class="section-container"><div class="module-video" style="max-width:100%"><video controls' . $vAutoplay . ($vPoster ? ' poster="' . htmlspecialchars($vPoster) . '"' : '') . ' style="width:100%"><source src="' . htmlspecialchars($vSrc) . '" type="video/mp4"></video></div></div></section>';
                break;
            case "columns":
                $cols = (int)($modData["columns"] ?? 2);
                $gap = $modData["gap"] ?? "24px";
                $colItems = $modData["items"] ?? [];
                $html = '<section class="page-section"><div class="section-container"><div style="display:grid;grid-template-columns:repeat(' . $cols . ',1fr);gap:' . htmlspecialchars($gap) . '">';
                if (!empty($colItems)) {
                    foreach ($colItems as $col) {
                        $html .= '<div style="padding:20px;background:#f9fafb;border-radius:8px">';
                        if (!empty($col["title"])) $html .= '<h3>' . htmlspecialchars($col["title"]) . '</h3>';
                        if (!empty($col["content"])) $html .= '<p>' . htmlspecialchars($col["content"]) . '</p>';
                        $html .= '</div>';
                    }
                } else {
                    for ($i = 0; $i < $cols; $i++) {
                        $html .= '<div style="padding:20px;background:#f9fafb;border-radius:8px;min-height:80px"></div>';
                    }
                }
                $html .= '</div></div></section>';
                break;
            default:
                $defContent = $modData["content"] ?? $modData["html"] ?? "";
                $html = '<div class="module module-' . htmlspecialchars($type) . '">' . $defContent . '</div>';
        }
        $contentHtml .= $html . "\n";
    }
}

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

if (empty($contentHtml)) {
    $contentHtml = '<div class="page-content" style="max-width:800px;margin:40px auto;padding:40px;background:#fff;border-radius:10px"><h1>' . htmlspecialchars($title) . '</h1><p style="color:#94a3b8">页面内容正在编辑中，请在页面设计器中添加模块后保存再发布。</p></div>';
}

$fullHtml = $headerHtml . "\n<main id=\"main-content\">\n" . $contentHtml . "\n</main>\n" . $footerHtml;

@unlink($targetFile);
$written = @file_put_contents($targetFile, $fullHtml, LOCK_EX);
if ($written === false) {
    echo json_encode(["code"=>1,"msg"=>"Failed to write file: " . $targetFile]);
    exit;
}

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
