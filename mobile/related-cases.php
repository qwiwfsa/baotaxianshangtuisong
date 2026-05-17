<?php
$related_html = '';
try {
    $rel_conn = function_exists('getDbConnection') ? getDbConnection() : getDB();
    $cat = $case_data['category'] ?? '';
    $stmt = $rel_conn->prepare('SELECT id, title, category, amount, image, content FROM cases WHERE status = 1 AND category = ? AND id != ? ORDER BY sort_order DESC LIMIT 5');
    $stmt->bind_param('si', $cat, $case_id_seo);
    $stmt->execute();
    $result = $stmt->get_result();
    $related_cases = array();
    while ($r = $result->fetch_assoc()) {
        $rc = json_decode($r['content'], true) ?: array();
        $r['coverImage'] = $rc['coverImage'] ?? $r['image'] ?? '';
        $related_cases[] = $r;
    }
    $stmt->close();
    if (count($related_cases) < 5) {
        $fill_limit = 5 - count($related_cases);
        $fstmt = $rel_conn->prepare('SELECT id, title, category, amount, image, content FROM cases WHERE status = 1 AND category != ? AND id != ? ORDER BY sort_order DESC LIMIT ?');
        $fstmt->bind_param('sii', $cat, $case_id_seo, $fill_limit);
        $fstmt->execute();
        $fresult = $fstmt->get_result();
        while ($fr = $fresult->fetch_assoc()) {
            $frc = json_decode($fr['content'], true) ?: array();
            $fr['coverImage'] = $frc['coverImage'] ?? $fr['image'] ?? '';
            $related_cases[] = $fr;
        }
        $fstmt->close();
    }
    $rel_conn->close();
} catch (Exception $e) {
    $related_cases = array();
}
foreach ($related_cases as $rc):
    $rimg = $rc['coverImage'] ?: '/images/cases/default.jpg';
    if (strpos($rimg, 'http') !== 0 && $rimg[0] !== '/') $rimg = '../' . $rimg;
    $rtitle = htmlspecialchars($rc['title']);
    $rtype = htmlspecialchars($rc['category'] ?? '');
    $ramount = htmlspecialchars($rc['amount'] ?? '');
?>
                                <a href="case-detail.html?id=<?php echo $rc['id']; ?>" class="case-related-item">
                                    <div class="case-related-thumb ratio-portrait">
                                        <img src="<?php echo htmlspecialchars($rimg); ?>" alt="<?php echo $rtitle; ?>">
                                    </div>
                                    <div class="case-related-info">
                                        <h4 class="case-related-item-title"><?php echo $rtitle; ?></h4>
                                        <span class="case-related-item-type"><?php echo $rtype . ($ramount ? ' | ' . $ramount : ''); ?></span>
                                    </div>
                                </a>
<?php endforeach; ?>