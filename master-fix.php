<?php
/**
 * MASTER FIX - Make All Pages Work Like Homepage
 *
 * Access: https://wohnegruen.at/wp-content/themes/WohneGruen/master-fix.php
 *
 * This script:
 * 1. Shows current status of all pages
 * 2. Removes custom templates from all pages (except homepage)
 * 3. Verifies all pages can now use ACF blocks
 * 4. Shows next steps
 */

require_once('../../../wp-load.php');

if (!current_user_can('manage_options')) {
    wp_die('Access denied. You must be an administrator.');
}

$action = isset($_GET['action']) ? $_GET['action'] : 'status';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Master Fix - WohneGrün</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: linear-gradient(135deg, #2d5016 0%, #3d6b1f 100%);
            padding: 20px;
            line-height: 1.6;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }
        h1 {
            color: #2d5016;
            margin-bottom: 10px;
            font-size: 2.2rem;
        }
        h2 {
            color: #2d5016;
            border-bottom: 3px solid #2d5016;
            padding-bottom: 10px;
            margin: 30px 0 20px 0;
            font-size: 1.6rem;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 20px;
            border-radius: 8px;
            margin: 15px 0;
            border-left: 5px solid #28a745;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 20px;
            border-radius: 8px;
            margin: 15px 0;
            border-left: 5px solid #dc3545;
        }
        .warning {
            background: #fff3cd;
            color: #856404;
            padding: 20px;
            border-radius: 8px;
            margin: 15px 0;
            border-left: 5px solid #ffc107;
        }
        .info {
            background: #d1ecf1;
            color: #0c5460;
            padding: 20px;
            border-radius: 8px;
            margin: 15px 0;
            border-left: 5px solid #17a2b8;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        thead {
            background: #2d5016;
            color: white;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        tbody tr:hover {
            background: #f8f9fa;
        }
        .status-good {
            color: #28a745;
            font-weight: 600;
            font-size: 16px;
        }
        .status-bad {
            color: #dc3545;
            font-weight: 600;
            font-size: 16px;
        }
        .btn {
            display: inline-block;
            background: #2d5016;
            color: white;
            padding: 18px 45px;
            text-decoration: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            margin: 10px 5px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn:hover {
            background: #3d6b1f;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(45, 80, 22, 0.3);
        }
        .btn-large {
            font-size: 22px;
            padding: 25px 60px;
        }
        .btn-success {
            background: #28a745;
        }
        .btn-success:hover {
            background: #218838;
        }
        .btn-primary {
            background: #007bff;
        }
        .btn-primary:hover {
            background: #0056b3;
        }
        .text-center {
            text-align: center;
        }
        code {
            background: #f4f4f4;
            padding: 4px 8px;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            font-size: 13px;
            color: #c7254e;
        }
        ul {
            margin: 15px 0 15px 30px;
        }
        li {
            margin: 8px 0;
        }
        .progress-bar {
            background: #e9ecef;
            border-radius: 8px;
            height: 30px;
            margin: 20px 0;
            overflow: hidden;
        }
        .progress-fill {
            background: #28a745;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            transition: width 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔧 Master Fix - WohneGrün</h1>
        <p style="color: #666; font-size: 16px; margin-bottom: 30px;">Make all pages work like the homepage with ACF blocks</p>

        <?php if ($action === 'status'): ?>

            <?php
            // Get all pages
            $all_pages = get_pages(array(
                'post_type' => 'page',
                'post_status' => 'publish',
                'sort_column' => 'post_title',
            ));

            $homepage_id = get_option('page_on_front');
            $pages_with_custom_templates = 0;
            $pages_ready = 0;

            $page_data = array();
            foreach ($all_pages as $page) {
                $template = get_post_meta($page->ID, '_wp_page_template', true);
                $is_default = empty($template) || $template === 'default';
                $is_homepage = ($page->ID == $homepage_id);

                if (!$is_default && !$is_homepage) {
                    $pages_with_custom_templates++;
                } else {
                    $pages_ready++;
                }

                $page_data[] = array(
                    'id' => $page->ID,
                    'title' => $page->post_title,
                    'template' => $is_default ? 'default' : $template,
                    'is_default' => $is_default,
                    'is_homepage' => $is_homepage,
                    'status' => ($is_default || $is_homepage) ? 'ready' : 'needs_fix',
                );
            }

            $total_pages = count($all_pages);
            $percentage = round(($pages_ready / $total_pages) * 100);
            ?>

            <h2>📊 Current Status</h2>

            <div class="progress-bar">
                <div class="progress-fill" style="width: <?php echo $percentage; ?>%;">
                    <?php echo $percentage; ?>% Ready
                </div>
            </div>

            <div class="info">
                <strong>Summary:</strong><br><br>
                ✅ <strong><?php echo $pages_ready; ?></strong> pages ready (can use ACF blocks)<br>
                ⚠️ <strong><?php echo $pages_with_custom_templates; ?></strong> pages need fixing (have custom templates)<br>
                📄 <strong><?php echo $total_pages; ?></strong> total pages
            </div>

            <?php if ($pages_with_custom_templates > 0): ?>
                <div class="warning">
                    <strong>⚠️ Action Required!</strong><br><br>
                    <?php echo $pages_with_custom_templates; ?> page(s) have custom templates that prevent ACF blocks from displaying.<br>
                    Click the button below to fix all pages automatically.
                </div>
            <?php else: ?>
                <div class="success">
                    <strong>✅ All Pages Ready!</strong><br><br>
                    All pages are using the default template and can display ACF blocks.<br>
                    You can now add ACF blocks to any page in the Gutenberg editor.
                </div>
            <?php endif; ?>

            <h2>📋 Page Details</h2>

            <table>
                <thead>
                    <tr>
                        <th>Page Title</th>
                        <th>Current Template</th>
                        <th>ACF Blocks Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($page_data as $page): ?>
                        <tr>
                            <td>
                                <strong><?php echo esc_html($page['title']); ?></strong>
                                <?php if ($page['is_homepage']): ?>
                                    <br><small style="color: #28a745;">✓ Homepage (working correctly)</small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <code><?php echo esc_html($page['template']); ?></code>
                            </td>
                            <td>
                                <?php if ($page['status'] === 'ready'): ?>
                                    <span class="status-good">✅ Ready</span>
                                <?php else: ?>
                                    <span class="status-bad">⚠️ Needs Fix</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h2>🎯 What Will Happen</h2>

            <div class="info">
                <strong>When you click "Fix All Pages":</strong><br><br>
                1️⃣ Remove custom templates from all pages (except homepage)<br>
                2️⃣ Set all pages to use default template<br>
                3️⃣ Clear old hardcoded content (if any)<br>
                4️⃣ All pages can then use ACF blocks like the homepage<br><br>
                <strong>Result:</strong> All styling remains intact, all ACF blocks become available!
            </div>

            <?php if ($pages_with_custom_templates > 0): ?>
                <div class="text-center" style="margin: 40px 0;">
                    <a href="?action=fix" class="btn btn-success btn-large">
                        🚀 Fix All Pages Now
                    </a>
                </div>
            <?php else: ?>
                <div class="text-center" style="margin: 40px 0;">
                    <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" class="btn btn-primary btn-large">
                        📝 Go to Pages
                    </a>
                </div>
            <?php endif; ?>

        <?php elseif ($action === 'fix'): ?>

            <h2>🔧 Fixing Pages...</h2>

            <?php
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
                    echo '<div class="info">⏭️ <strong>Skipped:</strong> ' . esc_html($page->post_title) . ' (homepage - already working)</div>';
                    $skipped_count++;
                    continue;
                }

                $template = get_post_meta($page->ID, '_wp_page_template', true);
                $is_default = empty($template) || $template === 'default';

                // Skip if already using default template
                if ($is_default) {
                    echo '<div class="info">⏭️ <strong>Skipped:</strong> ' . esc_html($page->post_title) . ' (already using default template)</div>';
                    $skipped_count++;
                    continue;
                }

                // Remove custom template
                delete_post_meta($page->ID, '_wp_page_template');

                // Clear old hardcoded content if no blocks
                $content = $page->post_content;
                $has_blocks = has_blocks($content);

                if (!$has_blocks || strlen(trim($content)) < 50) {
                    wp_update_post(array(
                        'ID' => $page->ID,
                        'post_content' => '',
                    ));
                }

                echo '<div class="success">✅ <strong>Fixed:</strong> ' . esc_html($page->post_title) . ' - Removed template: <code>' . esc_html($template) . '</code></div>';
                $fixed_count++;
            }
            ?>

            <h2>🎉 All Pages Fixed!</h2>

            <div class="success">
                <strong>✅ Conversion Complete!</strong><br><br>
                <strong>Results:</strong><br>
                • Fixed: <strong><?php echo $fixed_count; ?></strong> page(s)<br>
                • Skipped: <?php echo $skipped_count; ?> page(s) (already working)<br>
                • Total: <?php echo count($all_pages); ?> page(s)<br><br>
                <strong>All pages now work like the homepage!</strong>
            </div>

            <h2>📝 Next Steps</h2>

            <div class="warning">
                <strong>Now you need to add ACF blocks to each page:</strong><br><br>

                <strong>1. Go to WordPress Pages:</strong><br>
                • Dashboard → Pages → All Pages<br><br>

                <strong>2. Edit each page and add ACF blocks:</strong><br><br>

                <strong>Über uns page:</strong><br>
                • Hero-Bereich (with hero image)<br>
                • Über uns (about section with image + text)<br>
                • Vorteile (company values)<br>
                • CTA-Bereich (call to action)<br><br>

                <strong>Galerie & 3D page:</strong><br>
                • Hero-Bereich (gallery hero)<br>
                • Galerie (image gallery)<br>
                • 3D Rundgang (3D tour section)<br>
                • Grundrisse (floor plans)<br>
                • CTA-Bereich<br><br>

                <strong>Kontakt page:</strong><br>
                • Hero-Bereich (contact hero)<br>
                • Kontakt (contact form + info)<br>
                • CTA-Bereich<br><br>

                <strong>Modelle page:</strong><br>
                • Hero-Bereich (models hero)<br>
                • Modelle (model cards for Nature & Pure)<br>
                • Vorteile (model features)<br>
                • CTA-Bereich<br><br>

                <strong>3. For each block:</strong><br>
                • Fill in text fields<br>
                • Select images from Media Library<br>
                • Configure settings<br><br>

                <strong>4. Update page and view result!</strong>
            </div>

            <div class="text-center" style="margin: 40px 0;">
                <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" class="btn btn-success btn-large">
                    📝 Go to Pages - Add Blocks
                </a>
                <a href="<?php echo home_url('/'); ?>" class="btn btn-primary" target="_blank">
                    🌐 View Homepage (Example)
                </a>
                <a href="?action=status" class="btn">
                    🔍 Check Status Again
                </a>
            </div>

        <?php endif; ?>

    </div>
</body>
</html>
