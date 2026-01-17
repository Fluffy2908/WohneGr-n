<?php
/**
 * Check ACF Registration
 *
 * Use this to debug ACF blocks and field groups
 *
 * USAGE: https://your-site.at/wp-content/themes/WohneGruen/check-acf.php
 */

// Load WordPress
require_once('../../../wp-load.php');

// Security check
if (!current_user_can('manage_options')) {
    wp_die('Access denied. Please log in as administrator first.');
}

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACF Check</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: #f5f5f5;
            padding: 20px;
            margin: 0;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
        }
        h1 {
            color: #2d5016;
        }
        h2 {
            color: #3d6b1f;
            border-bottom: 2px solid #2d5016;
            padding-bottom: 10px;
            margin-top: 30px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 10px 15px;
            border-radius: 5px;
            margin: 10px 0;
            border-left: 4px solid #28a745;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px 15px;
            border-radius: 5px;
            margin: 10px 0;
            border-left: 4px solid #dc3545;
        }
        .warning {
            background: #fff3cd;
            color: #856404;
            padding: 10px 15px;
            border-radius: 5px;
            margin: 10px 0;
            border-left: 4px solid #ffc107;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #f8f9fa;
            font-weight: 600;
        }
        code {
            background: #f4f4f4;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: monospace;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 ACF Registration Check</h1>

        <h2>1. ACF Pro Status</h2>
        <?php if (class_exists('ACF')): ?>
            <div class="success">✓ ACF Plugin is active</div>
        <?php else: ?>
            <div class="error">✗ ACF Plugin is NOT active</div>
        <?php endif; ?>

        <?php if (function_exists('acf_add_local_field_group')): ?>
            <div class="success">✓ ACF Pro is active (acf_add_local_field_group exists)</div>
        <?php else: ?>
            <div class="error">✗ ACF Pro is NOT active - field groups won't work!</div>
        <?php endif; ?>

        <?php if (function_exists('acf_register_block_type')): ?>
            <div class="success">✓ ACF Blocks feature is available</div>
        <?php else: ?>
            <div class="error">✗ ACF Blocks feature is NOT available</div>
        <?php endif; ?>

        <h2>2. Registered ACF Blocks</h2>
        <?php
        $registered_blocks = acf_get_block_types();
        if (!empty($registered_blocks)):
        ?>
            <div class="success">✓ Found <?php echo count($registered_blocks); ?> registered ACF blocks</div>
            <table>
                <thead>
                    <tr>
                        <th>Block Name</th>
                        <th>Title</th>
                        <th>Category</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registered_blocks as $block): ?>
                        <tr>
                            <td><code><?php echo esc_html($block['name']); ?></code></td>
                            <td><?php echo esc_html($block['title']); ?></td>
                            <td><?php echo esc_html($block['category']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="error">✗ NO ACF blocks registered!</div>
            <div class="warning">
                <strong>Possible causes:</strong><br>
                - ACF Pro is not active<br>
                - Registration function not running<br>
                - Theme not properly activated
            </div>
        <?php endif; ?>

        <h2>3. ACF Field Groups</h2>
        <?php
        $field_groups = acf_get_field_groups();
        if (!empty($field_groups)):
        ?>
            <div class="success">✓ Found <?php echo count($field_groups); ?> field groups</div>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Key</th>
                        <th>Active</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($field_groups as $group): ?>
                        <tr>
                            <td><?php echo esc_html($group['title']); ?></td>
                            <td><code><?php echo esc_html($group['key']); ?></code></td>
                            <td><?php echo $group['active'] ? '✓ Active' : '✗ Inactive'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="error">✗ NO field groups found!</div>
        <?php endif; ?>

        <h2>4. Registration Functions</h2>
        <?php if (function_exists('wohnegruen_register_acf_blocks')): ?>
            <div class="success">✓ wohnegruen_register_acf_blocks() function exists</div>
        <?php else: ?>
            <div class="error">✗ wohnegruen_register_acf_blocks() function NOT found</div>
        <?php endif; ?>

        <?php if (function_exists('wohnegruen_register_block_fields')): ?>
            <div class="success">✓ wohnegruen_register_block_fields() function exists</div>
        <?php else: ?>
            <div class="error">✗ wohnegruen_register_block_fields() function NOT found</div>
        <?php endif; ?>

        <?php if (function_exists('wohnegruen_register_acf_options_pages')): ?>
            <div class="success">✓ wohnegruen_register_acf_options_pages() function exists</div>
        <?php else: ?>
            <div class="error">✗ wohnegruen_register_acf_options_pages() function NOT found</div>
        <?php endif; ?>

        <h2>5. Block Categories</h2>
        <?php
        $categories = get_block_categories(get_post());
        $wohnegruen_category = null;
        foreach ($categories as $cat) {
            if ($cat['slug'] === 'wohnegruen') {
                $wohnegruen_category = $cat;
                break;
            }
        }
        ?>
        <?php if ($wohnegruen_category): ?>
            <div class="success">✓ WohneGrün block category is registered</div>
            <p>Category title: <code><?php echo esc_html($wohnegruen_category['title']); ?></code></p>
        <?php else: ?>
            <div class="error">✗ WohneGrün block category NOT found</div>
        <?php endif; ?>

        <h2>6. Action Hooks Check</h2>
        <?php
        global $wp_filter;
        $acf_init_hooks = isset($wp_filter['acf/init']) ? count($wp_filter['acf/init']->callbacks) : 0;
        ?>
        <p>Number of functions hooked to <code>acf/init</code>: <strong><?php echo $acf_init_hooks; ?></strong></p>

        <?php if ($acf_init_hooks > 0): ?>
            <div class="success">✓ ACF init hooks are registered</div>
        <?php else: ?>
            <div class="warning">⚠ No functions hooked to acf/init</div>
        <?php endif; ?>

        <h2>7. Recommendations</h2>
        <?php
        $issues = array();
        if (!class_exists('ACF')) {
            $issues[] = 'Install and activate ACF Pro plugin';
        }
        if (empty($registered_blocks)) {
            $issues[] = 'Blocks are not registering - check inc/acf.php file';
        }
        if (empty($field_groups)) {
            $issues[] = 'Field groups are not registering - check inc/acf.php file';
        }
        if (!$wohnegruen_category) {
            $issues[] = 'Block category missing - check inc/theme.php';
        }
        ?>

        <?php if (empty($issues)): ?>
            <div class="success">
                <strong>✓ Everything looks good!</strong><br>
                All ACF blocks and field groups are properly registered.
            </div>
        <?php else: ?>
            <div class="error">
                <strong>Issues found:</strong><br>
                <ul>
                    <?php foreach ($issues as $issue): ?>
                        <li><?php echo esc_html($issue); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #ddd;">
            <p><strong>Next steps:</strong></p>
            <ol>
                <li>Fix any issues listed above</li>
                <li>Delete this file (check-acf.php) after debugging</li>
                <li>Go to Pages → Edit any page to see blocks in Gutenberg editor</li>
            </ol>
        </div>
    </div>
</body>
</html>
