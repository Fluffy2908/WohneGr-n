<?php
/**
 * BLOCK REGISTRATION DIAGNOSTIC
 *
 * Checks if ACF blocks are being registered correctly
 *
 * ACCESS: https://xn--wohnegrn-d6a.at/wp-content/themes/WohneGruen/block-diagnostic.php?key=checkblocks
 */

// Security check
if (!isset($_GET['key']) || $_GET['key'] !== 'checkblocks') {
    die('Access denied. Use: ?key=checkblocks');
}

// Load WordPress
require_once('../../../wp-load.php');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Block Registration Diagnostic</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            background: #1e1e1e;
            color: #d4d4d4;
            padding: 20px;
            margin: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: #252526;
            padding: 30px;
            border-radius: 8px;
        }
        h1 { color: #4ec9b0; }
        h2 { color: #569cd6; margin-top: 30px; }
        .success {
            color: #4ec9b0;
            background: #1e3a1e;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #4ec9b0;
            margin: 10px 0;
        }
        .error {
            color: #f48771;
            background: #3a1e1e;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #f48771;
            margin: 10px 0;
        }
        .warning {
            color: #dcdcaa;
            background: #3a3a1e;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #dcdcaa;
            margin: 10px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: #1e1e1e;
        }
        table th, table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #3c3c3c;
        }
        table th {
            background: #2d2d30;
            color: #569cd6;
        }
        code {
            background: #1e1e1e;
            padding: 2px 6px;
            border-radius: 3px;
            color: #ce9178;
        }
        pre {
            background: #1e1e1e;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
            border-left: 3px solid #4ec9b0;
        }
        .check-item {
            padding: 10px;
            margin: 5px 0;
            background: #1e1e1e;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Block Registration Diagnostic</h1>
        <p>Generated: <?php echo date('Y-m-d H:i:s'); ?></p>

        <h2>1. ACF Plugin Status</h2>
        <?php
        $acf_active = class_exists('ACF') || class_exists('acf_pro');

        if ($acf_active):
            echo '<div class="success">';
            echo '<strong>✓ ACF Plugin is ACTIVE</strong><br>';
            if (defined('ACF_VERSION')) {
                echo 'Version: <code>' . ACF_VERSION . '</code>';
            }
            echo '</div>';
        else:
            echo '<div class="error">';
            echo '<strong>✗ ACF Plugin is NOT ACTIVE</strong>';
            echo '</div>';
        endif;
        ?>

        <h2>2. ACF Functions Available</h2>
        <table>
            <tr>
                <th>Function</th>
                <th>Status</th>
            </tr>
            <?php
            $functions = array(
                'acf_register_block_type' => 'Register ACF Blocks',
                'acf_get_block_types' => 'Get Registered Blocks',
                'acf_add_local_field_group' => 'Register Field Groups',
                'get_field' => 'Get Field Values',
            );

            foreach ($functions as $func => $desc):
                $exists = function_exists($func);
            ?>
                <tr>
                    <td><code><?php echo $func; ?></code><br><small><?php echo $desc; ?></small></td>
                    <td><?php echo $exists ? '<span style="color: #4ec9b0;">✓ Available</span>' : '<span style="color: #f48771;">✗ Not Available</span>'; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h2>3. Theme Functions File Check</h2>
        <?php
        $functions_file = get_template_directory() . '/functions.php';
        $acf_file = get_template_directory() . '/inc/acf.php';

        echo '<table>';
        echo '<tr><th>File</th><th>Status</th><th>Size</th></tr>';

        $files = array(
            'functions.php' => $functions_file,
            'inc/acf.php' => $acf_file,
        );

        foreach ($files as $name => $path):
            $exists = file_exists($path);
            $size = $exists ? number_format(filesize($path)) . ' bytes' : 'N/A';
        ?>
            <tr>
                <td><code><?php echo $name; ?></code></td>
                <td><?php echo $exists ? '<span style="color: #4ec9b0;">✓ Exists</span>' : '<span style="color: #f48771;">✗ Missing</span>'; ?></td>
                <td><?php echo $size; ?></td>
            </tr>
        <?php endforeach; ?>
        </table>

        <h2>4. Custom Function Check</h2>
        <?php
        $custom_function_exists = function_exists('wohnegruen_register_acf_blocks');

        if ($custom_function_exists):
            echo '<div class="success">';
            echo '<strong>✓ wohnegruen_register_acf_blocks() function EXISTS</strong><br>';
            echo 'This means inc/acf.php is loaded correctly.';
            echo '</div>';
        else:
            echo '<div class="error">';
            echo '<strong>✗ wohnegruen_register_acf_blocks() function MISSING</strong><br>';
            echo 'This means inc/acf.php is NOT being loaded or has a PHP error.';
            echo '</div>';
        endif;
        ?>

        <h2>5. Registered ACF Blocks</h2>
        <?php
        if (function_exists('acf_get_block_types')):
            $block_types = acf_get_block_types();

            if (!empty($block_types)):
                echo '<div class="success">';
                echo '<strong>✓ Found ' . count($block_types) . ' ACF Blocks</strong>';
                echo '</div>';

                echo '<table>';
                echo '<tr><th>Block Name</th><th>Title</th><th>Template File</th><th>Template Exists</th></tr>';

                foreach ($block_types as $block):
                    $template_path = get_template_directory() . '/' . $block['render_template'];
                    $template_exists = file_exists($template_path);

                    echo '<tr>';
                    echo '<td><code>' . esc_html($block['name']) . '</code></td>';
                    echo '<td>' . esc_html($block['title']) . '</td>';
                    echo '<td><code>' . esc_html($block['render_template']) . '</code></td>';
                    echo '<td>' . ($template_exists ? '<span style="color: #4ec9b0;">✓ Yes</span>' : '<span style="color: #f48771;">✗ No</span>') . '</td>';
                    echo '</tr>';
                endforeach;

                echo '</table>';
            else:
                echo '<div class="error">';
                echo '<strong>✗ NO ACF Blocks Registered</strong><br>';
                echo 'ACF plugin is active but no blocks are registered.';
                echo '</div>';
            endif;
        else:
            echo '<div class="error">';
            echo '<strong>✗ Cannot check blocks - acf_get_block_types() not available</strong>';
            echo '</div>';
        endif;
        ?>

        <h2>6. WordPress Block Categories</h2>
        <?php
        $block_categories = get_block_categories(get_post(get_option('page_on_front')));

        echo '<table>';
        echo '<tr><th>Category Slug</th><th>Category Title</th></tr>';

        $wohnegruen_category_found = false;
        foreach ($block_categories as $category):
            if ($category['slug'] === 'wohnegruen') {
                $wohnegruen_category_found = true;
            }
            echo '<tr>';
            echo '<td><code>' . esc_html($category['slug']) . '</code></td>';
            echo '<td>' . esc_html($category['title']) . '</td>';
            echo '</tr>';
        endforeach;

        echo '</table>';

        if (!$wohnegruen_category_found):
            echo '<div class="warning">';
            echo '<strong>⚠️ "wohnegruen" block category not found</strong><br>';
            echo 'This might be why blocks aren\'t showing in the editor.';
            echo '</div>';
        endif;
        ?>

        <h2>7. PHP Error Check</h2>
        <?php
        // Check for errors in error log
        $errors = error_get_last();

        if ($errors && in_array($errors['type'], array(E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR))):
            echo '<div class="error">';
            echo '<strong>⚠️ PHP Error Detected</strong><br>';
            echo '<pre>' . print_r($errors, true) . '</pre>';
            echo '</div>';
        else:
            echo '<div class="success">';
            echo '<strong>✓ No fatal PHP errors detected in this request</strong>';
            echo '</div>';
        endif;
        ?>

        <h2>8. Block Template Files</h2>
        <?php
        $expected_blocks = array(
            'block-hero.php',
            'block-features.php',
            'block-models.php',
            'block-about.php',
            'block-contact.php',
            'block-gallery.php',
            'block-3d-tour.php',
            'block-cta.php',
            'block-floor-plans.php',
            'block-interiors.php',
        );

        echo '<table>';
        echo '<tr><th>Template File</th><th>Status</th><th>Size</th></tr>';

        foreach ($expected_blocks as $block_file):
            $block_path = get_template_directory() . '/template-parts/blocks/' . $block_file;
            $exists = file_exists($block_path);
            $size = $exists ? number_format(filesize($block_path)) . ' bytes' : 'N/A';
        ?>
            <tr>
                <td><code><?php echo $block_file; ?></code></td>
                <td><?php echo $exists ? '<span style="color: #4ec9b0;">✓ Exists</span>' : '<span style="color: #f48771;">✗ Missing</span>'; ?></td>
                <td><?php echo $size; ?></td>
            </tr>
        <?php endforeach; ?>
        </table>

        <h2>9. Diagnosis Summary</h2>
        <?php
        $issues = array();
        $fixes = array();

        if (!$acf_active) {
            $issues[] = "ACF Plugin is not active";
            $fixes[] = "Activate ACF plugin in WordPress Admin → Plugins";
        }

        if (!function_exists('acf_register_block_type')) {
            $issues[] = "acf_register_block_type() function not available";
            $fixes[] = "Ensure ACF PRO is installed (free version doesn't support blocks)";
        }

        if (!$custom_function_exists) {
            $issues[] = "wohnegruen_register_acf_blocks() function missing";
            $fixes[] = "Check inc/acf.php for PHP syntax errors";
            $fixes[] = "Verify inc/acf.php is loaded in functions.php";
        }

        if (function_exists('acf_get_block_types') && empty($block_types)) {
            $issues[] = "No blocks registered despite ACF being active";
            $fixes[] = "Check if acf/init hook is firing";
            $fixes[] = "Look for PHP errors in wp-content/debug.log";
            $fixes[] = "Try deactivating and reactivating the theme";
        }

        if (!$wohnegruen_category_found && function_exists('acf_register_block_type')) {
            $issues[] = "WohneGrün block category not registered";
            $fixes[] = "Add block category registration to inc/theme.php";
        }

        if (empty($issues)):
            echo '<div class="success">';
            echo '<h3>✅ All Checks Passed!</h3>';
            echo '<p>ACF is active and blocks are registered correctly.</p>';
            echo '<p><strong>If blocks still aren\'t showing:</strong></p>';
            echo '<ol>';
            echo '<li>Clear WordPress cache (plugins, server, browser)</li>';
            echo '<li>Hard refresh browser (Ctrl+F5)</li>';
            echo '<li>Edit a page and check the "+" button for WohneGrün blocks</li>';
            echo '<li>Check if page template allows blocks</li>';
            echo '</ol>';
            echo '</div>';
        else:
            echo '<div class="error">';
            echo '<h3>🚨 Issues Found (' . count($issues) . ')</h3>';
            echo '<ul>';
            foreach ($issues as $issue) {
                echo '<li>' . $issue . '</li>';
            }
            echo '</ul>';
            echo '</div>';

            if (!empty($fixes)) {
                echo '<div class="warning">';
                echo '<h3>🔧 Recommended Fixes</h3>';
                echo '<ol>';
                foreach ($fixes as $fix) {
                    echo '<li>' . $fix . '</li>';
                }
                echo '</ol>';
                echo '</div>';
            }
        endif;
        ?>

        <h2>10. Quick Actions</h2>
        <div class="check-item">
            <strong>WordPress Admin Links:</strong><br>
            <ul>
                <li><a href="<?php echo admin_url('plugins.php'); ?>" target="_blank">Plugins Page</a></li>
                <li><a href="<?php echo admin_url('themes.php'); ?>" target="_blank">Themes Page</a></li>
                <li><a href="<?php echo admin_url('edit.php?post_type=page'); ?>" target="_blank">All Pages</a></li>
                <li><a href="<?php echo home_url(); ?>" target="_blank">View Site</a></li>
            </ul>
        </div>

        <h2>⚠️ Security Notice</h2>
        <div class="error">
            <strong>DELETE THIS FILE AFTER USE!</strong><br>
            Remove <code>block-diagnostic.php</code> from your server for security.
        </div>
    </div>
</body>
</html>
