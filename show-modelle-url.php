<?php
/**
 * Show Correct Modelle Page URL
 */

require_once('../../../wp-load.php');

if (!current_user_can('manage_options')) {
    wp_die('Access denied.');
}

$modelle_page = get_page_by_path('modelle');
if (!$modelle_page) {
    $modelle_page = get_page_by_title('Modelle');
}

$modelle_url = $modelle_page ? get_permalink($modelle_page->ID) : '';
$archive_url = get_post_type_archive_link('mobilhaus');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modelle Page URLs</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: linear-gradient(135deg, #2d5016 0%, #3d6b1f 100%);
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        h1 { color: #2d5016; margin-top: 0; text-align: center; }
        .comparison { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin: 30px 0; }
        .page-box { padding: 25px; border-radius: 8px; }
        .page-wrong { background: #f8d7da; border: 3px solid #dc3545; }
        .page-correct { background: #d4edda; border: 3px solid #28a745; }
        .page-box h2 { margin-top: 0; font-size: 20px; }
        .page-box ul { list-style: none; padding: 0; margin: 15px 0; }
        .page-box li { padding: 8px 0; }
        .page-box li:before { content: "•"; margin-right: 10px; font-weight: bold; }
        .url { background: #f4f4f4; padding: 10px; border-radius: 5px; word-break: break-all; font-family: monospace; margin: 10px 0; font-size: 14px; }
        .btn-big { display: block; background: #28a745; color: white; padding: 20px; text-align: center; text-decoration: none; border-radius: 8px; font-size: 20px; font-weight: 600; margin: 20px 0; }
        .btn-big:hover { background: #218838; }
        .warning { background: #fff3cd; padding: 20px; border-radius: 8px; border-left: 4px solid #ffc107; margin: 20px 0; }
        strong { color: #2d5016; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎯 You're On The Wrong Page!</h1>

        <div class="comparison">
            <div class="page-box page-wrong">
                <h2>❌ Archive Page (Wrong)</h2>
                <p><strong>What you're viewing now:</strong></p>
                <ul>
                    <li>Heading: "Unsere Mobilhäuser"</li>
                    <li>Filter dropdowns (Größe, Preis)</li>
                    <li>Gray model cards</li>
                    <li>Shows mobilhaus POSTS</li>
                </ul>
                <div class="url"><?php echo esc_html($archive_url); ?></div>
                <p style="color: #721c24;"><strong>This is archive-mobilhaus.php template</strong></p>
            </div>

            <div class="page-box page-correct">
                <h2>✅ Modelle Page (Correct)</h2>
                <p><strong>What you should see:</strong></p>
                <ul>
                    <li>Heading: "Unsere Modelle"</li>
                    <li>Nature 🌿 / Pure ✨ tabs</li>
                    <li>Hero images</li>
                    <li>8 color sliders per model</li>
                    <li>Size options</li>
                </ul>
                <div class="url"><?php echo esc_html($modelle_url); ?></div>
                <p style="color: #155724;"><strong>This is page-models-new.php template</strong></p>
            </div>
        </div>

        <div class="warning">
            <strong>⚠️ What Happened:</strong><br><br>
            You're viewing the <strong>Mobilhaus Archive</strong> which lists all mobilhaus custom posts.<br>
            The Modelle page with tabs and color sliders is a completely different page!<br><br>
            The navigation menu should link to the Modelle page, not the archive.
        </div>

        <?php if ($modelle_url): ?>
            <a href="<?php echo esc_url($modelle_url); ?>" class="btn-big" target="_blank">
                🎨 View REAL Modelle Page (With Tabs & Color Sliders)
            </a>
        <?php endif; ?>

        <h2 style="margin-top: 40px;">🔧 Fix Navigation Menu</h2>
        <div class="warning">
            <strong>To fix your navigation menu:</strong><br><br>
            1. Go to <a href="<?php echo admin_url('nav-menus.php'); ?>">Appearance → Menus</a><br>
            2. Find the "Modelle" menu item<br>
            3. Make sure it links to: <code><?php echo esc_html($modelle_url); ?></code><br>
            4. NOT to: <code><?php echo esc_html($archive_url); ?></code>
        </div>
    </div>
</body>
</html>
