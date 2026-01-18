<?php
/**
 * Test Gutenberg Block Categories
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
    <title>Gutenberg Blocks Test</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            padding: 20px;
            background: #f0f0f1;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
        }
        h1 { color: #2d5016; }
        h2 { color: #3d6b1f; border-bottom: 2px solid #2d5016; padding-bottom: 10px; }
        .success { background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin: 10px 0; border-left: 4px solid #28a745; }
        .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin: 10px 0; border-left: 4px solid #dc3545; }
        .info { background: #d1ecf1; color: #0c5460; padding: 10px; border-radius: 5px; margin: 10px 0; border-left: 4px solid #17a2b8; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; font-weight: 600; }
        code { background: #f4f4f4; padding: 2px 6px; border-radius: 3px; font-family: monospace; }
        .highlight { background: #fff3cd; padding: 15px; border-radius: 5px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🧩 Gutenberg Blocks & Categories Test</h1>

        <h2>Block Categories Available</h2>
        <?php
        // Get all block categories
        $categories = get_block_categories(get_post());

        $wohnegruen_found = false;
        ?>
        <table>
            <thead>
                <tr>
                    <th>Slug</th>
                    <th>Title</th>
                    <th>Icon</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $cat): ?>
                    <tr <?php echo ($cat['slug'] === 'wohnegruen') ? 'style="background: #d4edda;"' : ''; ?>>
                        <td><code><?php echo esc_html($cat['slug']); ?></code></td>
                        <td><?php echo esc_html($cat['title']); ?></td>
                        <td><?php echo isset($cat['icon']) ? esc_html($cat['icon']) : '-'; ?></td>
                    </tr>
                    <?php if ($cat['slug'] === 'wohnegruen') $wohnegruen_found = true; ?>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if ($wohnegruen_found): ?>
            <div class="success">
                <strong>✓ WohneGrün category is registered!</strong><br>
                The category exists and should be visible in the Gutenberg editor.
            </div>
        <?php else: ?>
            <div class="error">
                <strong>✗ WohneGrün category NOT found!</strong><br>
                The category is not registered. Blocks won't appear in the editor.
            </div>
        <?php endif; ?>

        <h2>ACF Blocks in WohneGrün Category</h2>
        <?php
        $blocks = acf_get_block_types();
        $wohnegruen_blocks = array_filter($blocks, function($block) {
            return $block['category'] === 'wohnegruen';
        });
        ?>

        <?php if (!empty($wohnegruen_blocks)): ?>
            <div class="success">
                <strong>✓ Found <?php echo count($wohnegruen_blocks); ?> blocks in 'wohnegruen' category:</strong>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Block Name</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Icon</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($wohnegruen_blocks as $block): ?>
                        <tr>
                            <td><code><?php echo esc_html($block['name']); ?></code></td>
                            <td><?php echo esc_html($block['title']); ?></td>
                            <td><code><?php echo esc_html($block['category']); ?></code></td>
                            <td><?php echo esc_html($block['icon']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="error">
                <strong>✗ No blocks found in 'wohnegruen' category!</strong>
            </div>
        <?php endif; ?>

        <h2>How to See Blocks in Gutenberg Editor</h2>
        <div class="highlight">
            <strong>Follow these exact steps:</strong>
            <ol>
                <li>Go to <strong>Pages → All Pages</strong></li>
                <li>Click <strong>Edit</strong> on the "Home" page</li>
                <li>Click the <strong>"+" (Add Block)</strong> button in the top-left corner</li>
                <li>In the search box, type: <strong>wohne</strong> or <strong>hero</strong></li>
                <li>OR scroll down to find the <strong>"WohneGrün"</strong> category section</li>
                <li>You should see all 10 blocks listed there</li>
            </ol>
        </div>

        <h2>Troubleshooting</h2>

        <?php if ($wohnegruen_found && !empty($wohnegruen_blocks)): ?>
            <div class="success">
                <strong>Everything is configured correctly!</strong><br><br>

                <strong>If you still don't see the blocks in the editor, try these:</strong>
                <ol>
                    <li><strong>Clear browser cache:</strong> Press Ctrl+Shift+Delete and clear cached files</li>
                    <li><strong>Hard refresh:</strong> Press Ctrl+F5 when in the page editor</li>
                    <li><strong>Try a different browser:</strong> Open WordPress in incognito/private mode</li>
                    <li><strong>Search for the blocks:</strong> Type "Hero" or "Vorteile" in the block search</li>
                    <li><strong>Check the full block list:</strong> Click "Browse all" in the block inserter</li>
                </ol>
            </div>

            <div class="info">
                <strong>💡 Pro Tip:</strong> In the Gutenberg editor, blocks are organized by categories.
                Look for the <strong>"WohneGrün"</strong> section when adding blocks. It should appear
                near the top of the list.
            </div>
        <?php else: ?>
            <div class="error">
                <strong>Configuration Issue Detected</strong><br>
                The category or blocks are not properly registered. Check the code in inc/acf.php and inc/theme.php.
            </div>
        <?php endif; ?>

        <h2>Quick Test Links</h2>
        <p>
            <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" style="display: inline-block; background: #2d5016; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin: 5px;">View All Pages</a>

            <?php
            $home_page = get_page_by_title('Home');
            if ($home_page):
            ?>
                <a href="<?php echo admin_url('post.php?post=' . $home_page->ID . '&action=edit'); ?>" style="display: inline-block; background: #3d6b1f; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin: 5px;">Edit Home Page</a>
            <?php endif; ?>

            <a href="<?php echo admin_url(); ?>" style="display: inline-block; background: #0073aa; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin: 5px;">WordPress Dashboard</a>
        </p>

        <h2>Summary</h2>
        <div class="info">
            <strong>Status:</strong><br>
            - Categories: <?php echo count($categories); ?> total, WohneGrün: <?php echo $wohnegruen_found ? '✓ Found' : '✗ Not found'; ?><br>
            - ACF Blocks: <?php echo count($blocks); ?> total registered<br>
            - WohneGrün Blocks: <?php echo count($wohnegruen_blocks); ?> blocks<br>
            - Block Registration: <?php echo (count($wohnegruen_blocks) > 0) ? '✓ Working' : '✗ Not working'; ?>
        </div>
    </div>
</body>
</html>
