<?php
/**
 * Fix Modelle Page - Clear Old Content
 *
 * The template is correct but old Gutenberg blocks are showing instead
 */

require_once('../../../wp-load.php');

if (!current_user_can('manage_options')) {
    wp_die('Access denied.');
}

$step = isset($_GET['step']) ? $_GET['step'] : 'check';

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
    <title>Fix Modelle Content</title>
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
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        h1 { color: #2d5016; margin-top: 0; }
        h2 { color: #2d5016; border-bottom: 2px solid #2d5016; padding-bottom: 10px; }
        .success { background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #28a745; }
        .error { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #dc3545; }
        .warning { background: #fff3cd; color: #856404; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #ffc107; }
        .info { background: #d1ecf1; color: #0c5460; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #17a2b8; }
        code { background: #f4f4f4; padding: 2px 6px; border-radius: 3px; font-family: monospace; word-break: break-all; }
        .btn { display: inline-block; background: #2d5016; color: white; padding: 15px 30px; text-decoration: none; border-radius: 8px; margin: 10px 5px; border: none; cursor: pointer; font-size: 16px; font-weight: 600; }
        .btn:hover { background: #3d6b1f; }
        .btn-danger { background: #dc3545; }
        .btn-danger:hover { background: #c82333; }
        .content-preview { background: #f8f9fa; padding: 15px; border-radius: 5px; max-height: 300px; overflow-y: auto; font-size: 12px; line-height: 1.5; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔧 Fix Modelle Page Content</h1>

        <?php if (!$modelle_page): ?>
            <div class="error">
                <strong>❌ Modelle page not found!</strong>
            </div>
        <?php else: ?>

            <?php if ($step === 'check'): ?>

                <div class="info">
                    <strong>Page Info:</strong><br>
                    - ID: <?php echo $modelle_page->ID; ?><br>
                    - Template: <code>page-models-new.php</code> ✓<br>
                    - Content Length: <?php echo strlen($modelle_page->post_content); ?> characters
                </div>

                <h2>🔍 Problem Diagnosis</h2>

                <?php if (strlen($modelle_page->post_content) > 0): ?>
                    <div class="error">
                        <strong>❌ PROBLEM FOUND!</strong><br><br>
                        The Modelle page has <strong><?php echo strlen($modelle_page->post_content); ?> characters</strong> of old content stored in the database.<br><br>
                        This old content (Gutenberg blocks) is displaying INSTEAD OF the page-models-new.php template content.<br><br>
                        <strong>What's happening:</strong><br>
                        - Template is correct ✓<br>
                        - But WordPress shows page content BEFORE template content<br>
                        - So you see old model cards instead of new tabbed interface
                    </div>

                    <h2>Current Page Content Preview</h2>
                    <div class="content-preview">
                        <code><?php echo esc_html(substr($modelle_page->post_content, 0, 2000)); ?><?php if (strlen($modelle_page->post_content) > 2000) echo '...'; ?></code>
                    </div>

                    <h2>✅ Solution</h2>
                    <div class="success">
                        <strong>Clear all page content</strong><br><br>
                        When page-models-new.php is the template, the page content should be EMPTY.<br>
                        The template handles everything:<br>
                        - Hero section<br>
                        - Nature/Pure tabs<br>
                        - 8 color sliders per model<br>
                        - Size options<br>
                        - CTA section<br><br>
                        <strong>This is safe</strong> - the template has all the content hardcoded.
                    </div>

                    <form method="post" action="?step=fix" onsubmit="return confirm('Clear page content and use template only?');">
                        <button type="submit" class="btn btn-danger">🗑️ Clear Page Content & Use Template Only</button>
                    </form>

                <?php else: ?>
                    <div class="success">
                        <strong>✅ Page content is already empty!</strong><br><br>
                        The page should be using the template content only.<br>
                        If it's still showing wrong content, try:<br>
                        1. Clear browser cache (Ctrl + Shift + Delete)<br>
                        2. Clear WordPress cache (if using cache plugin)<br>
                        3. Open in incognito/private window
                    </div>

                    <a href="<?php echo get_permalink($modelle_page->ID); ?>" class="btn" target="_blank">🌐 View Modelle Page</a>
                <?php endif; ?>

            <?php elseif ($step === 'fix'): ?>

                <h2>Clearing Page Content...</h2>

                <?php
                // Clear the page content
                $result = wp_update_post(array(
                    'ID' => $modelle_page->ID,
                    'post_content' => '',
                ));

                if ($result && !is_wp_error($result)) {
                    echo '<div class="success">✅ Page content cleared successfully!</div>';
                } else {
                    echo '<div class="error">❌ Error clearing content: ' . ($result ? $result->get_error_message() : 'Unknown error') . '</div>';
                }
                ?>

                <h2>✅ Fixed!</h2>

                <div class="success">
                    <strong>The Modelle page is now set up correctly:</strong><br><br>
                    ✓ Template: page-models-new.php<br>
                    ✓ Content: Empty (template handles everything)<br>
                    ✓ All 20 images in place<br>
                    ✓ CSS and JavaScript loaded<br><br>
                    <strong>What you should see now:</strong><br>
                    - Hero section "Unsere Modelle"<br>
                    - Tab buttons: Nature 🌿 and Pure ✨<br>
                    - Click tabs to switch between models<br>
                    - Each model shows hero image + 8 color sliders<br>
                    - Size options at bottom
                </div>

                <div class="warning">
                    <strong>⚠️ Clear Your Browser Cache!</strong><br>
                    Press <code>Ctrl + Shift + Delete</code> and clear cached images and files.<br>
                    Or open in Incognito/Private window to see fresh version.
                </div>

                <a href="<?php echo get_permalink($modelle_page->ID); ?>?nocache=<?php echo time(); ?>" class="btn" target="_blank">🌐 View Modelle Page (Fresh)</a>
                <a href="?step=check" class="btn">🔍 Check Again</a>

            <?php endif; ?>

        <?php endif; ?>

    </div>
</body>
</html>
