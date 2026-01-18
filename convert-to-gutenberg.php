<?php
/**
 * Convert Pages to Use Gutenberg Editor
 *
 * This script removes custom page templates and sets pages to use
 * the default template with Gutenberg editor instead.
 *
 * USAGE: https://your-site.at/wp-content/themes/WohneGruen/convert-to-gutenberg.php
 */

// Load WordPress
require_once('../../../wp-load.php');

if (!current_user_can('manage_options')) {
    wp_die('Access denied. Please log in as administrator first.');
}

$convert = isset($_GET['convert']) && $_GET['convert'] === 'yes';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Convert Pages to Gutenberg</title>
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
        h2 { color: #2d5016; border-bottom: 2px solid #2d5016; padding-bottom: 10px; }
        .success { background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #28a745; }
        .error { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #dc3545; }
        .warning { background: #fff3cd; color: #856404; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #ffc107; }
        .info { background: #d1ecf1; color: #0c5460; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #17a2b8; }
        .btn { display: inline-block; background: #2d5016; color: white; padding: 15px 40px; text-decoration: none; border-radius: 8px; font-size: 18px; font-weight: 600; margin: 10px 5px; border: none; cursor: pointer; }
        .btn:hover { background: #3d6b1f; }
        .btn-danger { background: #dc3545; }
        .btn-danger:hover { background: #c82333; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; font-weight: 600; }
        code { background: #f4f4f4; padding: 2px 8px; border-radius: 4px; font-family: monospace; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📝 Convert Pages to Gutenberg Editor</h1>
            <p>Enable ACF blocks on all pages by removing custom templates</p>
        </div>
        <div class="content">

            <?php if (!$convert): ?>
                <h2>Current Page Templates</h2>

                <?php
                $pages = get_pages(array('number' => 999));
                $pages_with_templates = array();
                ?>

                <table>
                    <thead>
                        <tr>
                            <th>Page Title</th>
                            <th>Current Template</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pages as $page):
                            $template = get_post_meta($page->ID, '_wp_page_template', true);
                            if ($template && $template !== 'default') {
                                $pages_with_templates[] = $page;
                            }
                        ?>
                            <tr>
                                <td><?php echo esc_html($page->post_title); ?></td>
                                <td>
                                    <?php if ($template && $template !== 'default'): ?>
                                        <code><?php echo esc_html($template); ?></code>
                                    <?php else: ?>
                                        Default (Gutenberg)
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($template && $template !== 'default'): ?>
                                        <span style="color: #dc3545;">✗ Custom template</span>
                                    <?php else: ?>
                                        <span style="color: #28a745;">✓ Gutenberg enabled</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <h2>What This Will Do</h2>

                <div class="info">
                    <strong>This script will convert <?php echo count($pages_with_templates); ?> pages to use Gutenberg editor:</strong><br><br>

                    <?php if (!empty($pages_with_templates)): ?>
                        <ul>
                            <?php foreach ($pages_with_templates as $page): ?>
                                <li><?php echo esc_html($page->post_title); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>✓ All pages already use Gutenberg editor!</p>
                    <?php endif; ?>
                </div>

                <div class="warning">
                    <strong>⚠️ Important:</strong><br>
                    - Pages will lose their current hardcoded content<br>
                    - They will become blank pages ready for Gutenberg blocks<br>
                    - You'll need to add content using ACF blocks<br>
                    - This change can be reversed by reassigning templates
                </div>

                <h2>Why Do This?</h2>
                <div class="success">
                    <strong>Benefits:</strong><br>
                    ✓ All pages will show ACF blocks in the editor<br>
                    ✓ You can use drag-and-drop blocks on all pages<br>
                    ✓ Easier content management<br>
                    ✓ Consistent editing experience across all pages
                </div>

                <?php if (!empty($pages_with_templates)): ?>
                    <div style="text-align: center; margin: 40px 0;">
                        <a href="?convert=yes" class="btn btn-danger">Convert <?php echo count($pages_with_templates); ?> Pages to Gutenberg</a>
                    </div>
                <?php else: ?>
                    <div class="success">
                        <strong>✓ All pages are already using Gutenberg!</strong><br>
                        No conversion needed.
                    </div>
                <?php endif; ?>

            <?php else: ?>
                <h2>Converting Pages...</h2>

                <?php
                $pages = get_pages(array('number' => 999));
                $converted = 0;

                foreach ($pages as $page) {
                    $template = get_post_meta($page->ID, '_wp_page_template', true);

                    if ($template && $template !== 'default') {
                        // Remove custom template
                        update_post_meta($page->ID, '_wp_page_template', 'default');

                        echo '<div class="success">✓ Converted: ' . esc_html($page->post_title) . '</div>';
                        $converted++;
                    }
                }
                ?>

                <h2>✅ Conversion Complete!</h2>

                <div class="success">
                    <strong>Successfully converted <?php echo $converted; ?> pages to Gutenberg editor.</strong><br><br>

                    <strong>What's Changed:</strong><br>
                    - All pages now use the default template<br>
                    - Gutenberg editor is enabled on all pages<br>
                    - ACF blocks are now available when editing any page
                </div>

                <h2>Next Steps:</h2>
                <ol>
                    <li><strong>Edit each page</strong> and add content using ACF blocks</li>
                    <li><strong>Delete this file</strong> (convert-to-gutenberg.php) from your server</li>
                    <li><strong>Test your pages</strong> - they will be blank until you add blocks</li>
                </ol>

                <div class="warning">
                    <strong>⚠️ IMPORTANT:</strong><br>
                    The converted pages are now BLANK. You need to edit each page and add content using the ACF blocks:
                    <ul>
                        <li>Hero Block</li>
                        <li>Features Block</li>
                        <li>About Block</li>
                        <li>Contact Block</li>
                        <li>etc.</li>
                    </ul>
                </div>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" class="btn">View All Pages</a>
                    <a href="<?php echo admin_url(); ?>" class="btn">WordPress Dashboard</a>
                </div>
            <?php endif; ?>

        </div>
    </div>
</body>
</html>
