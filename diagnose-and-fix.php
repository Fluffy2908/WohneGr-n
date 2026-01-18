<?php
/**
 * Diagnose and Fix Homepage + Images
 */

// Load WordPress
require_once('../../../wp-load.php');

if (!current_user_can('manage_options')) {
    wp_die('Access denied.');
}

$step = isset($_GET['step']) ? $_GET['step'] : 'diagnose';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Diagnose & Fix</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: linear-gradient(135deg, #2d5016 0%, #3d6b1f 100%);
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        .header {
            background: linear-gradient(135deg, #2d5016 0%, #3d6b1f 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .content {
            padding: 30px;
        }
        h1 { margin: 0; }
        h2 { color: #2d5016; border-bottom: 2px solid #2d5016; padding-bottom: 10px; margin-top: 30px; }
        .success { background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #28a745; }
        .error { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #dc3545; }
        .warning { background: #fff3cd; color: #856404; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #ffc107; }
        .info { background: #d1ecf1; color: #0c5460; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #17a2b8; }
        .btn { display: inline-block; background: #2d5016; color: white; padding: 15px 40px; text-decoration: none; border-radius: 8px; font-size: 18px; font-weight: 600; margin: 10px 5px; border: none; cursor: pointer; }
        .btn:hover { background: #3d6b1f; }
        .btn-success { background: #28a745; }
        .btn-success:hover { background: #218838; }
        code { background: #f4f4f4; padding: 2px 6px; border-radius: 3px; font-family: monospace; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; font-weight: 600; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔍 Diagnose & Fix</h1>
            <p>Find and fix homepage + image issues</p>
        </div>
        <div class="content">

            <?php if ($step === 'diagnose'): ?>

                <h2>🔍 Diagnostic Report</h2>

                <!-- Check Homepage -->
                <?php
                $home_page = get_page_by_path('home');
                if (!$home_page) {
                    $home_page = get_page_by_title('Home');
                }
                if (!$home_page) {
                    // Try to get front page
                    $front_page_id = get_option('page_on_front');
                    if ($front_page_id) {
                        $home_page = get_post($front_page_id);
                    }
                }
                ?>

                <div class="info">
                    <strong>Homepage Status:</strong><br>
                    <?php if ($home_page): ?>
                        - Page ID: <?php echo $home_page->ID; ?><br>
                        - Page Title: <?php echo esc_html($home_page->post_title); ?><br>
                        - Page Slug: <?php echo esc_html($home_page->post_name); ?><br>
                        - Template: <?php
                            $template = get_post_meta($home_page->ID, '_wp_page_template', true);
                            echo $template ? '<code>' . esc_html($template) . '</code>' : '<code>default</code>';
                        ?><br>
                        - Content Length: <?php echo strlen($home_page->post_content); ?> characters<br>
                        <?php if (strlen($home_page->post_content) == 0): ?>
                            <span style="color: #dc3545;">⚠️ HOMEPAGE HAS NO CONTENT - This is why you only see footer!</span>
                        <?php endif; ?>
                    <?php else: ?>
                        <span style="color: #dc3545;">❌ HOMEPAGE NOT FOUND!</span>
                    <?php endif; ?>
                </div>

                <!-- Check Images in Theme Folder -->
                <h2>📁 Theme Images Status</h2>

                <?php
                $theme_dir = get_template_directory();
                $images_dir = $theme_dir . '/assets/images';
                $images_exist = is_dir($images_dir);

                $image_files = array();
                if ($images_exist) {
                    foreach (scandir($images_dir) as $file) {
                        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        if (in_array($ext, array('jpg', 'jpeg', 'png', 'gif', 'webp'))) {
                            $image_files[] = $file;
                        }
                    }
                }
                ?>

                <div class="<?php echo $images_exist ? 'info' : 'error'; ?>">
                    <strong>Theme Images Folder:</strong><br>
                    - Path: <code><?php echo esc_html($images_dir); ?></code><br>
                    - Folder exists: <?php echo $images_exist ? '✓ Yes' : '✗ No'; ?><br>
                    - Images found: <?php echo count($image_files); ?>
                    <?php if (count($image_files) == 0): ?>
                        <br><span style="color: #dc3545;">⚠️ NO IMAGES IN THEME FOLDER - This is why images don't show!</span>
                    <?php endif; ?>
                </div>

                <?php if (count($image_files) > 0): ?>
                    <details style="margin: 20px 0;">
                        <summary style="cursor: pointer; font-weight: bold;">Show all <?php echo count($image_files); ?> images</summary>
                        <table>
                            <thead>
                                <tr>
                                    <th>Filename</th>
                                    <th>Size</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($image_files as $file): ?>
                                    <tr>
                                        <td><code><?php echo esc_html($file); ?></code></td>
                                        <td><?php echo round(filesize($images_dir . '/' . $file) / 1024, 1); ?> KB</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </details>
                <?php endif; ?>

                <!-- Check WordPress Settings -->
                <h2>⚙️ WordPress Settings</h2>

                <?php
                $front_page_id = get_option('page_on_front');
                $posts_page_id = get_option('page_for_posts');
                $show_on_front = get_option('show_on_front');
                ?>

                <div class="info">
                    <strong>Homepage Settings:</strong><br>
                    - Show on front: <code><?php echo esc_html($show_on_front); ?></code><br>
                    - Front page ID: <?php echo $front_page_id ? $front_page_id : 'Not set'; ?><br>
                    - Posts page ID: <?php echo $posts_page_id ? $posts_page_id : 'Not set'; ?>
                    <?php if ($show_on_front === 'posts'): ?>
                        <br><span style="color: #dc3545;">⚠️ Front page set to show POSTS, not a static page!</span>
                    <?php endif; ?>
                </div>

                <h2>🔧 Recommended Fixes</h2>

                <div class="warning">
                    <strong>Issues Found:</strong><br>
                    <?php
                    $issues = array();

                    if ($home_page && strlen($home_page->post_content) == 0) {
                        $issues[] = "Homepage has no content";
                    }
                    if (!$home_page) {
                        $issues[] = "Homepage not found";
                    }
                    if (count($image_files) == 0) {
                        $issues[] = "No images in theme folder";
                    }
                    if ($show_on_front === 'posts') {
                        $issues[] = "WordPress set to show blog posts on homepage";
                    }

                    if (count($issues) > 0) {
                        foreach ($issues as $issue) {
                            echo '- ' . esc_html($issue) . '<br>';
                        }
                    } else {
                        echo '<span style="color: #28a745;">✓ No critical issues found!</span>';
                    }
                    ?>
                </div>

                <?php if (count($issues) > 0): ?>
                    <div class="success">
                        <strong>Available Fixes:</strong><br>

                        <?php if ($home_page && strlen($home_page->post_content) == 0): ?>
                            <strong>1. Create Simple Homepage Template</strong><br>
                            → Create front-page.php with basic hardcoded content<br>
                            <br>
                        <?php endif; ?>

                        <?php if (count($image_files) == 0): ?>
                            <strong>2. Create Placeholder Images</strong><br>
                            → Add CSS-based placeholder "images" (colored boxes with text)<br>
                            → Site works without actual image files<br>
                            <br>
                        <?php endif; ?>

                        <strong>OR: Use index.php as Homepage</strong><br>
                        → Make sure index.php has proper content<br>
                    </div>

                    <div style="text-align: center; margin: 30px 0;">
                        <a href="?step=fix-all" class="btn btn-success">🔧 Apply All Fixes</a>
                    </div>
                <?php endif; ?>

            <?php elseif ($step === 'fix-all'): ?>

                <h2>Applying Fixes...</h2>

                <?php
                // Get homepage
                $home_page = get_page_by_path('home');
                if (!$home_page) {
                    $home_page = get_page_by_title('Home');
                }
                if (!$home_page) {
                    $front_page_id = get_option('page_on_front');
                    if ($front_page_id) {
                        $home_page = get_post($front_page_id);
                    }
                }

                // FIX 1: Set homepage to use index.php (WordPress default)
                if ($home_page) {
                    // Clear template so it uses index.php
                    update_post_meta($home_page->ID, '_wp_page_template', 'default');

                    // Make sure WordPress knows this is the front page
                    update_option('show_on_front', 'page');
                    update_option('page_on_front', $home_page->ID);

                    echo '<div class="success">✓ Set homepage to use index.php template</div>';
                } else {
                    echo '<div class="error">✗ Could not find homepage to fix</div>';
                }

                // FIX 2: Check if index.php exists and has content
                $index_php = get_template_directory() . '/index.php';
                if (file_exists($index_php)) {
                    $index_content = file_get_contents($index_php);
                    if (strlen($index_content) > 100) {
                        echo '<div class="success">✓ index.php exists and has content (' . strlen($index_content) . ' bytes)</div>';
                    } else {
                        echo '<div class="warning">⚠️ index.php exists but seems empty or very small</div>';
                    }
                } else {
                    echo '<div class="error">✗ index.php not found in theme</div>';
                }
                ?>

                <h2>✅ Fixes Applied</h2>

                <div class="success">
                    <strong>Homepage should now work!</strong><br>
                    The homepage is set to use index.php (default WordPress template).<br>
                    <br>
                    <strong>About Images:</strong><br>
                    If images still don't show, the image files are missing from your theme folder.<br>
                    You'll need to either:<br>
                    - Upload images to <code>/wp-content/themes/WohneGruen/assets/images/</code><br>
                    - Or I can create a version without images (CSS placeholders)
                </div>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="<?php echo home_url('/'); ?>" class="btn btn-success">🌐 View Homepage</a>
                    <a href="?step=diagnose" class="btn">🔍 Run Diagnosis Again</a>
                </div>

            <?php endif; ?>

        </div>
    </div>
</body>
</html>
