<?php
// Auto-detect page_id from URL
$path = $_SERVER['REQUEST_URI'] ?? '';
$path = strtok($path, '?');
$pageId = trim($path, '/');
if (empty($pageId) || $pageId === 'index.php' || $pageId === '/') $pageId = 'index';
// Remove .html or .php extension
$pageId = str_replace(['.html', '.php'], '', $pageId);

$cmsHasModules = false;
try {
    require_once __DIR__ . '/config/db.php';
    $db = getDB();
    $stmt = $db->prepare("SELECT module_type, module_data FROM page_builder_modules WHERE page_id=? AND is_active=1 ORDER BY sort_order ASC");
    $stmt->bind_param("s", $pageId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $cmsHasModules = true;
        echo '<style>.hero,.services,.services-grid,.service-details,.page-content,.service-list{display:none!important}</style>';
        echo '<!-- CMS_RENDER:' . $pageId . ' -->';
        while ($row = $result->fetch_assoc()) {
            $data = json_decode($row['module_data'], true) ?: [];
            echo '<section style="padding:60px 0"><div class="section-container">';
            $type = $row['module_type'];
            if ($type == 'heading') {
                echo '<h2 style="font-size:40px;font-weight:800;text-align:center">' . htmlspecialchars($data['title'] ?? '') . '</h2>';
                if (!empty($data['subtitle'])) echo '<p style="text-align:center;color:#64748b;font-size:17px">' . htmlspecialchars($data['subtitle']) . '</p>';
            } elseif ($type == 'text' || $type == 'richtext') {
                echo '<div style="max-width:800px;margin:0 auto;line-height:1.8">' . ($data['content'] ?? '') . '</div>';
            } elseif ($type == 'image') {
                $src = htmlspecialchars($data['src'] ?? '');
                if ($src) echo '<img src="' . $src . '" style="max-width:100%">';
            } elseif ($type == 'button') {
                $text = htmlspecialchars($data['text'] ?? '');
                $link = htmlspecialchars($data['link'] ?? '#');
                if ($text) echo '<div style="text-align:center"><a href="' . $link . '" class="btn btn-primary">' . $text . '</a></div>';
            } elseif ($type == 'banner') {
                echo '<div style="background:linear-gradient(135deg,#1e3a8a,#3b82f6);color:white;padding:80px 24px;text-align:center;border-radius:16px"><h1 style="font-size:48px;font-weight:800">' . htmlspecialchars($data['title'] ?? '') . '</h1>';
                if (!empty($data['subtitle'])) echo '<p style="font-size:18px;opacity:0.9">' . htmlspecialchars($data['subtitle']) . '</p>';
                echo '</div>';
            } elseif ($type == 'card') {
                $cols = (int)($data['columns'] ?? 3);
                echo '<div style="display:grid;grid-template-columns:repeat(' . $cols . ',1fr);gap:24px">';
                foreach (($data['items'] ?? []) as $item) {
                    echo '<div style="background:white;padding:28px;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,0.08)"><h3>' . htmlspecialchars($item['title'] ?? '') . '</h3><p style="color:#64748b">' . htmlspecialchars($item['description'] ?? '') . '</p></div>';
                }
                echo '</div>';
            }
            echo '</div></section>';
        }
    }
    $stmt->close();
    $db->close();
} catch (Exception $e) {}
?>
