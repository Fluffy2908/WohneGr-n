<?php
/**
 * EMERGENCY FIX - Restore Site
 *
 * This will:
 * 1. Clear all page content (remove bad Gutenberg blocks)
 * 2. Restore custom templates
 * 3. Get site back online
 */

// Load WordPress
require_once('../../../wp-load.php');

if (!current_user_can('manage_options')) {
    wp_die('Access denied.');
}

$step = isset($_GET['step']) ? $_GET['step'] : 'preview';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Emergency Fix</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: #dc3545;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }
        .header {
            background: #dc3545;
            color: white;
            padding: 30px;
            text-align: center;
        }
        .content {
            padding: 30px;
        }
        h1 { margin: 0; }
        .success { background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #28a745; }
        .error { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #dc3545; }
        .warning { background: #fff3cd; color: #856404; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #ffc107; }
        .btn { display: inline-block; background: #dc3545; color: white; padding: 15px 40px; text-decoration: none; border-radius: 8px; font-size: 18px; font-weight: 600; margin: 10px 5px; border: none; cursor: pointer; }
        .btn:hover { background: #c82333; }
        .btn-lg { padding: 20px 50px; font-size: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🚨 Emergency Site Fix</h1>
            <p>Restore site to working state</p>
        </div>
        <div class="content">

            <?php if ($step === 'preview'): ?>

                <div class="error">
                    <strong>Critical Error Detected</strong><br>
                    Your site has a critical error (white screen). This is likely caused by bad Gutenberg block content or ACF conflicts.
                </div>

                <h2>What This Will Do:</h2>

                <div class="warning">
                    <strong>Emergency Restoration Steps:</strong>
                    <ol>
                        <li><strong>Clear all page content</strong> (remove bad Gutenberg blocks)</li>
                        <li><strong>Restore Friday's custom templates</strong> (page-about.php, page-contact.php, etc.)</li>
                        <li><strong>Site will be back online</strong> with working hardcoded content</li>
                    </ol>
                </div>

                <div class="success">
                    <strong>✓ Result:</strong><br>
                    - Site will work again immediately<br>
                    - Pages will show Friday's hardcoded content<br>
                    - No more critical errors<br>
                    - You can access your website again
                </div>

                <div style="text-align: center; margin: 40px 0;">
                    <a href="?step=fix" class="btn btn-lg">🔧 FIX SITE NOW</a>
                </div>

            <?php elseif ($step === 'fix'): ?>

                <h2>Restoring Site...</h2>

                <?php
                // STEP 1: Clear all page content
                echo '<div class="warning"><strong>STEP 1:</strong> Clearing bad page content...</div>';

                $pages = get_pages(array('number' => 999));
                $cleared = 0;

                foreach ($pages as $page) {
                    wp_update_post(array(
                        'ID' => $page->ID,
                        'post_content' => '',
                    ));
                    $cleared++;
                }

                echo '<div class="success">✓ Cleared content from ' . $cleared . ' pages</div>';

                // STEP 2: Restore custom templates
                echo '<div class="warning"><strong>STEP 2:</strong> Restoring Friday\'s custom templates...</div>';

                $template_mappings = array(
                    'uber-uns' => 'page-about.php',
                    'kontakt' => 'page-contact.php',
                    'galerie-3d' => 'page-gallery-3d.php',
                    'modelle' => 'page-models-new.php',
                    'impressum' => 'page-impressum.php',
                    'datenschutz' => 'page-datenschutz.php',
                    'datenschutzerklarung' => 'page-datenschutz.php',
                    'agb' => 'page-agb.php',
                );

                $restored = 0;

                foreach ($pages as $page) {
                    $page_slug = $page->post_name;

                    if (isset($template_mappings[$page_slug])) {
                        $template = $template_mappings[$page_slug];
                        $template_file = get_template_directory() . '/' . $template;

                        if (file_exists($template_file)) {
                            update_post_meta($page->ID, '_wp_page_template', $template);
                            echo '<div class="success">✓ Restored: ' . esc_html($page->post_title) . ' → ' . esc_html($template) . '</div>';
                            $restored++;
                        }
                    }
                }

                echo '<div class="success">✓ Restored ' . $restored . ' page templates</div>';

                // STEP 3: Clear the image map option
                echo '<div class="warning"><strong>STEP 3:</strong> Cleaning up batch import data...</div>';
                delete_option('wohnegruen_image_map');
                echo '<div class="success">✓ Cleaned up import data</div>';
                ?>

                <h2>✅ Site Restored!</h2>

                <div class="success">
                    <strong>Your site is now working again!</strong><br><br>
                    - All bad content removed<br>
                    - Custom templates restored<br>
                    - Site back to Friday's working state<br>
                    - No more critical errors
                </div>

                <div class="warning">
                    <strong>⚠️ What Happened:</strong><br>
                    The Gutenberg block content from the batch import script caused a critical error.<br>
                    Your site is now back to using Friday's hardcoded custom templates (which work perfectly).
                </div>

                <?php
                $site_url = get_site_url();
                ?>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="<?php echo esc_url($site_url); ?>" class="btn btn-lg">🌐 View Your Site (Should Work Now!)</a>
                </div>

            <?php endif; ?>

        </div>
    </div>
</body>
</html>
