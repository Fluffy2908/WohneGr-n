<?php
/**
 * Diagnose 404 Errors
 *
 * This script checks why pages are showing 404 errors
 */

// Load WordPress
require_once('../../../wp-load.php');

if (!current_user_can('manage_options')) {
    wp_die('Access denied.');
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>404 Error Diagnosis</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            padding: 20px;
            background: #f0f0f1;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
        }
        h1 { color: #2d5016; }
        h2 { color: #3d6b1f; border-bottom: 2px solid #2d5016; padding-bottom: 10px; margin-top: 30px; }
        .success { background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin: 10px 0; border-left: 4px solid #28a745; }
        .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin: 10px 0; border-left: 4px solid #dc3545; }
        .warning { background: #fff3cd; color: #856404; padding: 10px; border-radius: 5px; margin: 10px 0; border-left: 4px solid #ffc107; }
        .info { background: #d1ecf1; color: #0c5460; padding: 10px; border-radius: 5px; margin: 10px 0; border-left: 4px solid #17a2b8; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; font-weight: 600; }
        code { background: #f4f4f4; padding: 2px 6px; border-radius: 3px; font-family: monospace; }
        .btn { display: inline-block; background: #2d5016; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; font-size: 16px; font-weight: 600; margin: 10px 5px; }
        .btn:hover { background: #3d6b1f; }
        .btn-danger { background: #dc3545; }
        .btn-danger:hover { background: #c82333; }
        pre { background: #f4f4f4; padding: 15px; border-radius: 5px; overflow-x: auto; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 404 Error Diagnosis</h1>

        <h2>1. Permalink Settings</h2>
        <?php
        $permalink_structure = get_option('permalink_structure');
        $rewrite_rules = get_option('rewrite_rules');
        ?>
        <table>
            <tr>
                <th>Setting</th>
                <th>Value</th>
                <th>Status</th>
            </tr>
            <tr>
                <td>Permalink Structure</td>
                <td><code><?php echo $permalink_structure ? esc_html($permalink_structure) : 'Plain (default)'; ?></code></td>
                <td>
                    <?php if ($permalink_structure === '/%postname%/'): ?>
                        <span style="color: #28a745;">✓ Correct</span>
                    <?php else: ?>
                        <span style="color: #dc3545;">✗ Incorrect</span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>Rewrite Rules</td>
                <td><?php echo is_array($rewrite_rules) ? count($rewrite_rules) . ' rules' : 'Not set'; ?></td>
                <td>
                    <?php if (is_array($rewrite_rules) && count($rewrite_rules) > 0): ?>
                        <span style="color: #28a745;">✓ Rules exist</span>
                    <?php else: ?>
                        <span style="color: #dc3545;">✗ No rules - PROBLEM!</span>
                    <?php endif; ?>
                </td>
            </tr>
        </table>

        <h2>2. All Pages</h2>
        <?php
        $pages = get_pages(array('number' => 999, 'sort_column' => 'post_title'));
        ?>
        <div class="info">
            <strong>Total pages found: <?php echo count($pages); ?></strong>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Page Title</th>
                    <th>Status</th>
                    <th>Template</th>
                    <th>Slug</th>
                    <th>Permalink</th>
                    <th>Test Link</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pages as $page):
                    $template = get_post_meta($page->ID, '_wp_page_template', true);
                    $permalink = get_permalink($page->ID);
                ?>
                    <tr>
                        <td><strong><?php echo esc_html($page->post_title); ?></strong></td>
                        <td>
                            <?php if ($page->post_status === 'publish'): ?>
                                <span style="color: #28a745;">✓ Published</span>
                            <?php else: ?>
                                <span style="color: #dc3545;">✗ <?php echo esc_html($page->post_status); ?></span>
                            <?php endif; ?>
                        </td>
                        <td><code><?php echo $template ? esc_html($template) : 'default'; ?></code></td>
                        <td><code><?php echo esc_html($page->post_name); ?></code></td>
                        <td><code><?php echo esc_html($permalink); ?></code></td>
                        <td><a href="<?php echo esc_url($permalink); ?>" target="_blank">Test →</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>3. Navigation Menu</h2>
        <?php
        $menus = get_terms('nav_menu', array('hide_empty' => false));
        ?>
        <?php if ($menus && !is_wp_error($menus)): ?>
            <?php foreach ($menus as $menu): ?>
                <h3><?php echo esc_html($menu->name); ?> (<?php echo $menu->count; ?> items)</h3>
                <?php
                $menu_items = wp_get_nav_menu_items($menu->term_id);
                if ($menu_items):
                ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Menu Item</th>
                                <th>Type</th>
                                <th>URL</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($menu_items as $item): ?>
                                <tr>
                                    <td><?php echo esc_html($item->title); ?></td>
                                    <td><code><?php echo esc_html($item->type); ?></code></td>
                                    <td><code><?php echo esc_html($item->url); ?></code></td>
                                    <td>
                                        <?php if ($item->type === 'post_type' && $item->object === 'page'): ?>
                                            <?php
                                            $linked_page = get_post($item->object_id);
                                            if ($linked_page && $linked_page->post_status === 'publish'):
                                            ?>
                                                <span style="color: #28a745;">✓ Page exists</span>
                                            <?php else: ?>
                                                <span style="color: #dc3545;">✗ Page missing!</span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span style="color: #0c5460;">Custom URL</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="error">
                <strong>✗ No menus found!</strong>
            </div>
        <?php endif; ?>

        <h2>4. Homepage Settings</h2>
        <?php
        $show_on_front = get_option('show_on_front');
        $page_on_front = get_option('page_on_front');
        $page_for_posts = get_option('page_for_posts');
        ?>
        <table>
            <tr>
                <th>Setting</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Show on Front</td>
                <td><code><?php echo esc_html($show_on_front); ?></code></td>
            </tr>
            <tr>
                <td>Homepage</td>
                <td>
                    <?php if ($page_on_front): ?>
                        <?php $home = get_post($page_on_front); ?>
                        <?php echo $home ? esc_html($home->post_title) : 'Page ID: ' . $page_on_front; ?>
                    <?php else: ?>
                        Not set
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>Posts Page</td>
                <td>
                    <?php if ($page_for_posts): ?>
                        <?php $blog = get_post($page_for_posts); ?>
                        <?php echo $blog ? esc_html($blog->post_title) : 'Page ID: ' . $page_for_posts; ?>
                    <?php else: ?>
                        Not set
                    <?php endif; ?>
                </td>
            </tr>
        </table>

        <h2>5. Theme Template Files</h2>
        <?php
        $theme_root = get_template_directory();
        $page_templates = array(
            'page-about.php',
            'page-contact.php',
            'page-gallery-3d.php',
            'page-models-new.php',
            'page-floor-plans.php',
            'page-layouts.php',
            'page-impressum.php',
            'page-datenschutz.php',
            'page-agb.php',
            'page-model-nature.php',
            'page-model-pure.php',
        );
        ?>
        <table>
            <thead>
                <tr>
                    <th>Template File</th>
                    <th>Exists</th>
                    <th>Used By Pages</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($page_templates as $template_file): ?>
                    <tr>
                        <td><code><?php echo esc_html($template_file); ?></code></td>
                        <td>
                            <?php if (file_exists($theme_root . '/' . $template_file)): ?>
                                <span style="color: #28a745;">✓ Exists</span>
                            <?php else: ?>
                                <span style="color: #dc3545;">✗ Missing</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php
                            $using_pages = array();
                            foreach ($pages as $p) {
                                $t = get_post_meta($p->ID, '_wp_page_template', true);
                                if ($t === $template_file) {
                                    $using_pages[] = $p->post_title;
                                }
                            }
                            if ($using_pages) {
                                echo esc_html(implode(', ', $using_pages));
                            } else {
                                echo '<span style="color: #999;">None</span>';
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>6. .htaccess File</h2>
        <?php
        $htaccess_file = ABSPATH . '.htaccess';
        ?>
        <div class="info">
            <strong>File location:</strong> <code><?php echo esc_html($htaccess_file); ?></code>
        </div>
        <?php if (file_exists($htaccess_file) && is_readable($htaccess_file)): ?>
            <div class="success">✓ .htaccess file exists and is readable</div>
            <pre><?php echo esc_html(file_get_contents($htaccess_file)); ?></pre>
        <?php else: ?>
            <div class="error">✗ .htaccess file not found or not readable - this could cause 404 errors!</div>
        <?php endif; ?>

        <h2>7. Diagnostic Summary</h2>
        <?php
        $issues = array();

        if ($permalink_structure !== '/%postname%/') {
            $issues[] = 'Permalink structure is not set to Post name';
        }

        if (!is_array($rewrite_rules) || count($rewrite_rules) === 0) {
            $issues[] = 'Rewrite rules are missing or empty';
        }

        if (!file_exists($htaccess_file)) {
            $issues[] = '.htaccess file is missing';
        }

        $pages_with_custom_templates = 0;
        foreach ($pages as $p) {
            $t = get_post_meta($p->ID, '_wp_page_template', true);
            if ($t && $t !== 'default') {
                $pages_with_custom_templates++;
            }
        }

        if ($pages_with_custom_templates > 0) {
            $issues[] = $pages_with_custom_templates . ' pages still have custom templates assigned';
        }
        ?>

        <?php if (empty($issues)): ?>
            <div class="success">
                <strong>✓ No obvious issues detected</strong><br>
                The 404 errors might be caused by caching or other factors.
            </div>
        <?php else: ?>
            <div class="error">
                <strong>✗ Issues detected:</strong>
                <ul>
                    <?php foreach ($issues as $issue): ?>
                        <li><?php echo esc_html($issue); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <h2>8. Quick Fix Actions</h2>
        <div style="text-align: center; margin: 30px 0;">
            <a href="?action=flush_permalinks" class="btn">Flush Permalinks</a>
            <a href="?action=fix_templates" class="btn">Convert All Pages to Default Template</a>
            <a href="<?php echo admin_url('options-permalink.php'); ?>" class="btn">Permalink Settings</a>
            <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" class="btn">View All Pages</a>
        </div>

        <?php
        // Handle actions
        if (isset($_GET['action'])) {
            if ($_GET['action'] === 'flush_permalinks') {
                flush_rewrite_rules(true);
                delete_option('rewrite_rules');
                flush_rewrite_rules(true);
                echo '<div class="success"><strong>✓ Permalinks flushed!</strong> Rewrite rules have been regenerated. Try visiting your pages now.</div>';
            } elseif ($_GET['action'] === 'fix_templates') {
                $fixed = 0;
                foreach ($pages as $p) {
                    $t = get_post_meta($p->ID, '_wp_page_template', true);
                    if ($t && $t !== 'default') {
                        update_post_meta($p->ID, '_wp_page_template', 'default');
                        $fixed++;
                    }
                }
                echo '<div class="success"><strong>✓ Fixed ' . $fixed . ' pages!</strong> All pages now use the default template.</div>';
            }
        }
        ?>

    </div>
</body>
</html>
