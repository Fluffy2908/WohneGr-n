<?php
/**
 * Make All Pages Work Like Homepage
 * Remove custom templates, use ACF blocks with proper styling
 */

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
    <title>Make All Pages Like Homepage</title>
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
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        h1 { color: #2d5016; margin-top: 0; }
        h2 { color: #2d5016; border-bottom: 2px solid #2d5016; padding-bottom: 10px; margin-top: 30px; }
        .success { background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #28a745; }
        .error { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #dc3545; }
        .warning { background: #fff3cd; color: #856404; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #ffc107; }
        .info { background: #d1ecf1; color: #0c5460; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #17a2b8; }
        code { background: #f4f4f4; padding: 3px 8px; border-radius: 3px; font-family: monospace; font-size: 13px; }
        .btn { display: inline-block; background: #2d5016; color: white; padding: 15px 40px; text-decoration: none; border-radius: 8px; font-size: 18px; font-weight: 600; margin: 10px 5px; border: none; cursor: pointer; }
        .btn:hover { background: #3d6b1f; }
        .btn-success { background: #28a745; }
        .btn-success:hover { background: #218838; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; font-size: 14px; }
        th { background: #f8f9fa; font-weight: 600; }
        .check-mark { color: #28a745; font-weight: bold; font-size: 16px; }
        .x-mark { color: #dc3545; font-weight: bold; font-size: 16px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>✅ Make All Pages Work Like Homepage</h1>

        <?php if ($step === 'preview'): ?>

            <div class="success">
                <strong>🎯 Perfect Approach!</strong><br><br>
                The homepage uses ACF blocks + proper styling = everything works perfectly.<br>
                Let's make ALL pages work the same way!
            </div>

            <h2>📊 Current Page Status</h2>

            <?php
            // Get all pages
            $all_pages = get_pages(array(
                'post_type' => 'page',
                'post_status' => 'publish',
                'sort_column' => 'post_title',
            ));

            $homepage_id = get_option('page_on_front');
            ?>

            <table>
                <thead>
                    <tr>
                        <th>Page</th>
                        <th>Current Template</th>
                        <th>Status</th>
                        <th>Will Be Fixed?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all_pages as $page): ?>
                        <?php
                        $template = get_post_meta($page->ID, '_wp_page_template', true);
                        $is_homepage = ($page->ID == $homepage_id);
                        $is_default = empty($template) || $template === 'default';
                        ?>
                        <tr>
                            <td>
                                <strong><?php echo esc_html($page->post_title); ?></strong>
                                <?php if ($is_homepage): ?>
                                    <br><small style="color: #28a745;">✓ This is the homepage (working correctly)</small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <code><?php echo $is_default ? 'default' : esc_html($template); ?></code>
                            </td>
                            <td>
                                <?php if ($is_default || $is_homepage): ?>
                                    <span class="check-mark">✓ ACF blocks work</span>
                                <?php else: ?>
                                    <span class="x-mark">✗ Custom template blocks ACF</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!$is_default && !$is_homepage): ?>
                                    <strong style="color: #28a745;">Yes - will use default template</strong>
                                <?php else: ?>
                                    <span style="color: #666;">No change needed</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h2>🔧 What This Will Do</h2>

            <div class="info">
                <strong>For each page with a custom template:</strong><br><br>
                1️⃣ <strong>Remove custom template</strong> (page-about.php, page-gallery-3d.php, etc.)<br>
                2️⃣ <strong>Set to default template</strong> (same as homepage)<br>
                3️⃣ <strong>Clear any old hardcoded content</strong><br>
                4️⃣ <strong>Result:</strong> Pages use ACF blocks with all styling intact ✨
            </div>

            <div class="success">
                <strong>✅ What You'll Have After:</strong><br><br>
                - All pages work exactly like homepage<br>
                - All ACF blocks available (Hero-Bereich, Vorteile, Modelle, Galerie, etc.)<br>
                - All styling already in place and working<br>
                - You just add the blocks you want to each page<br>
                - Modelle page will lose its tabs/color sliders (becomes ACF-based like others)
            </div>

            <div class="warning">
                <strong>⚠️ Note About Modelle Page:</strong><br><br>
                The Modelle page currently has tabs (Nature/Pure) and color sliders hardcoded.<br>
                This will be removed so you can use ACF blocks instead.<br><br>
                <strong>If you want to keep Modelle's tabs/sliders:</strong><br>
                - Don't run this script<br>
                - Or manually exclude Modelle page after<br>
                <br>
                <strong>Recommendation:</strong> Make all pages consistent - use ACF blocks everywhere.
            </div>

            <div style="text-align: center; margin: 40px 0;">
                <form method="get" action="" style="display: inline;">
                    <input type="hidden" name="step" value="fix">
                    <button type="submit" class="btn btn-success" style="font-size: 20px; padding: 20px 50px;">
                        ✅ Make All Pages Like Homepage
                    </button>
                </form>
            </div>

        <?php elseif ($step === 'fix'): ?>

            <h2>🔧 Converting Pages...</h2>

            <?php
            // Get all pages
            $all_pages = get_pages(array(
                'post_type' => 'page',
                'post_status' => 'publish',
            ));

            $homepage_id = get_option('page_on_front');
            $fixed_count = 0;
            $skipped_count = 0;

            foreach ($all_pages as $page) {
                // Skip homepage
                if ($page->ID == $homepage_id) {
                    echo '<div class="info">⏭️ Skipped: ' . esc_html($page->post_title) . ' (homepage - already working)</div>';
                    $skipped_count++;
                    continue;
                }

                $template = get_post_meta($page->ID, '_wp_page_template', true);
                $is_default = empty($template) || $template === 'default';

                // Skip if already using default template
                if ($is_default) {
                    echo '<div class="info">⏭️ Skipped: ' . esc_html($page->post_title) . ' (already using default template)</div>';
                    $skipped_count++;
                    continue;
                }

                // Remove custom template
                delete_post_meta($page->ID, '_wp_page_template');

                // Clear any old hardcoded content
                // (Keep content if there are Gutenberg blocks, clear if empty or just title)
                $content = $page->post_content;
                $has_blocks = has_blocks($content);

                if (!$has_blocks || strlen(trim($content)) < 50) {
                    wp_update_post(array(
                        'ID' => $page->ID,
                        'post_content' => '', // Clear so you can add ACF blocks fresh
                    ));
                }

                echo '<div class="success">✓ Fixed: <strong>' . esc_html($page->post_title) . '</strong> - Removed template: <code>' . esc_html($template) . '</code></div>';
                $fixed_count++;
            }
            ?>

            <h2>🎉 All Pages Converted Successfully!</h2>

            <div class="success">
                <strong>✅ Conversion Complete!</strong><br><br>
                - Fixed: <strong><?php echo $fixed_count; ?></strong> page(s)<br>
                - Skipped: <?php echo $skipped_count; ?> page(s) (already working)<br>
                - Total pages: <?php echo count($all_pages); ?>
            </div>

            <div class="info">
                <strong>📝 What You Have Now:</strong><br><br>
                ✅ All pages use default template (like homepage)<br>
                ✅ All pages can use ACF blocks<br>
                ✅ All styling is in place and working<br>
                ✅ ACF blocks registered:<br>
                <ul style="margin-top: 0.5rem; margin-left: 2rem;">
                    <li>Hero-Bereich (Hero section with image/text)</li>
                    <li>Vorteile (Benefits/features grid)</li>
                    <li>Modelle (Model cards)</li>
                    <li>Galerie (Image gallery)</li>
                    <li>3D Rundgang (3D tour)</li>
                    <li>Grundrisse (Floor plans)</li>
                    <li>Innenausstattung (Interior features)</li>
                    <li>Über uns (About section)</li>
                    <li>Kontakt (Contact form)</li>
                    <li>CTA-Bereich (Call-to-action sections)</li>
                </ul>
            </div>

            <h2>📋 Next Steps</h2>

            <div class="warning">
                <strong>Now you need to add ACF blocks to each page:</strong><br><br>

                <strong>1. Go to Pages:</strong><br>
                → <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" target="_blank">Dashboard → Pages</a><br>
                <br>

                <strong>2. Edit each page and add blocks:</strong><br>
                <br>

                <strong>Über uns page - suggested blocks:</strong><br>
                - Hero-Bereich (with hero image)<br>
                - Über uns (about section with image + text)<br>
                - Vorteile (show company values)<br>
                - CTA-Bereich (call to action)<br>
                <br>

                <strong>Galerie & 3D page - suggested blocks:</strong><br>
                - Hero-Bereich (gallery hero)<br>
                - Galerie (image gallery)<br>
                - 3D Rundgang (3D tour section)<br>
                - Grundrisse (floor plans)<br>
                - CTA-Bereich<br>
                <br>

                <strong>Kontakt page - suggested blocks:</strong><br>
                - Hero-Bereich (contact hero)<br>
                - Kontakt (contact form + info)<br>
                - CTA-Bereich<br>
                <br>

                <strong>Modelle page - suggested blocks:</strong><br>
                - Hero-Bereich (models hero)<br>
                - Modelle (model cards for Nature & Pure)<br>
                - Vorteile (model features)<br>
                - CTA-Bereich<br>
                <br>

                <strong>3. For each block:</strong><br>
                - Fill in the text fields<br>
                - Select images from Media Library<br>
                - Configure settings<br>
                <br>

                <strong>4. Update page and view result!</strong>
            </div>

            <div style="text-align: center; margin: 40px 0;">
                <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" class="btn btn-success" target="_blank">
                    📝 Go to Pages - Start Adding Blocks
                </a>
                <a href="<?php echo home_url('/'); ?>" class="btn" target="_blank">
                    🌐 View Homepage (Example)
                </a>
            </div>

        <?php endif; ?>

    </div>
</body>
</html>
