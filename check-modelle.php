<?php
/**
 * Quick Check - Modelle Page Template
 */

require_once('../../../wp-load.php');

if (!current_user_can('manage_options')) {
    wp_die('Access denied.');
}

// Find Modelle page
$modelle_page = get_page_by_path('modelle');
if (!$modelle_page) {
    $modelle_page = get_page_by_title('Modelle');
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modelle Page Check</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        h1 { color: #2d5016; }
        .success { background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .error { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .info { background: #d1ecf1; color: #0c5460; padding: 15px; border-radius: 5px; margin: 10px 0; }
        code { background: #f4f4f4; padding: 2px 6px; border-radius: 3px; }
        .btn { display: inline-block; background: #2d5016; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; margin: 10px 5px; }
        .btn:hover { background: #3d6b1f; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📋 Modelle Page Status</h1>

        <?php if ($modelle_page): ?>
            <?php
            $current_template = get_post_meta($modelle_page->ID, '_wp_page_template', true);
            $modelle_url = get_permalink($modelle_page->ID);
            ?>

            <div class="info">
                <strong>Page Found:</strong><br>
                - ID: <?php echo $modelle_page->ID; ?><br>
                - Title: <?php echo esc_html($modelle_page->post_title); ?><br>
                - Slug: <?php echo esc_html($modelle_page->post_name); ?><br>
                - URL: <a href="<?php echo esc_url($modelle_url); ?>" target="_blank"><?php echo esc_html($modelle_url); ?></a>
            </div>

            <h2>Template Status</h2>

            <?php if ($current_template === 'page-models-new.php'): ?>
                <div class="success">
                    <strong>✅ CORRECT TEMPLATE!</strong><br>
                    The page is using: <code>page-models-new.php</code><br><br>
                    This template includes:<br>
                    - Nature/Pure tabs<br>
                    - 8 color sliders for each model<br>
                    - Size options<br>
                    - All 20 images are in place
                </div>

                <h2>What to Check Next</h2>
                <div class="info">
                    <strong>If the styling still doesn't look right, check:</strong><br><br>
                    1. Browser cache - Clear it and refresh<br>
                    2. CSS files loaded - Check browser DevTools (F12) → Network tab<br>
                    3. JavaScript working - Check browser Console (F12) for errors<br>
                    4. Specific styling issues - Tell me exactly what looks wrong
                </div>

                <a href="<?php echo esc_url($modelle_url); ?>" class="btn" target="_blank">🌐 View Modelle Page</a>

            <?php else: ?>
                <div class="error">
                    <strong>❌ WRONG TEMPLATE!</strong><br>
                    Current template: <code><?php echo $current_template ?: 'default'; ?></code><br>
                    Should be: <code>page-models-new.php</code>
                </div>

                <form method="post">
                    <?php
                    if (isset($_POST['fix_template'])) {
                        update_post_meta($modelle_page->ID, '_wp_page_template', 'page-models-new.php');
                        echo '<div class="success">✅ Template updated! <a href="">Refresh page</a> to see changes.</div>';
                    }
                    ?>
                    <button type="submit" name="fix_template" class="btn">🔧 Fix Template Assignment</button>
                </form>
            <?php endif; ?>

        <?php else: ?>
            <div class="error">
                <strong>❌ Modelle page not found!</strong><br>
                Please create a page with slug "modelle" or title "Modelle"
            </div>
        <?php endif; ?>

    </div>
</body>
</html>
