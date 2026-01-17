<?php
/**
 * ACF DIAGNOSTIC TOOL
 *
 * Check if ACF plugin is active and blocks are registered
 *
 * ACCESS: https://xn--wohnegrn-d6a.at/wp-content/themes/WohneGruen/acf-diagnostic.php?key=wohnegruen2026check
 */

$secret_key = isset($_GET['key']) ? $_GET['key'] : '';
if ($secret_key !== 'wohnegruen2026check') {
    die('Access Denied. Use: ?key=wohnegruen2026check');
}

// Load WordPress
require_once('../../../wp-load.php');

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACF Diagnostic</title>
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
        .success { color: #4ec9b0; }
        .error { color: #f48771; }
        .warning { color: #dcdcaa; }
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
        .status-box {
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
            border-left: 4px solid;
        }
        .status-box.success {
            background: #1e3a1e;
            border-color: #4ec9b0;
        }
        .status-box.error {
            background: #3a1e1e;
            border-color: #f48771;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 ACF Plugin Diagnostic</h1>
        <p>Generated: <?php echo date('Y-m-d H:i:s'); ?></p>

        <h2>1. ACF Plugin Status</h2>
        <?php
        $acf_active = class_exists('ACF');
        $acf_pro_active = class_exists('acf_pro');

        if ($acf_active || $acf_pro_active):
            echo '<div class="status-box success">';
            echo '<strong class="success">✓ ACF Plugin is ACTIVE</strong><br>';
            if ($acf_pro_active) {
                echo 'ACF PRO version detected';
            } else {
                echo 'ACF Free version detected';
            }
            echo '</div>';

            // Get ACF version
            if (defined('ACF_VERSION')) {
                echo '<p>ACF Version: <code>' . ACF_VERSION . '</code></p>';
            }
        else:
            echo '<div class="status-box error">';
            echo '<strong class="error">✗ ACF Plugin is NOT ACTIVE</strong><br>';
            echo 'The Advanced Custom Fields plugin is not installed or not activated.';
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
                'acf_add_options_page' => 'Add Options Pages',
                'acf_add_local_field_group' => 'Register Field Groups',
                'get_field' => 'Get Field Values',
                'the_field' => 'Display Field Values',
            );

            foreach ($functions as $func => $desc):
                $exists = function_exists($func);
                $status = $exists ? '<span class="success">✓ Available</span>' : '<span class="error">✗ Not Available</span>';
            ?>
                <tr>
                    <td><code><?php echo $func; ?></code><br><small><?php echo $desc; ?></small></td>
                    <td><?php echo $status; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h2>3. Registered ACF Blocks</h2>
        <?php
        if (function_exists('acf_get_block_types')):
            $block_types = acf_get_block_types();

            if (!empty($block_types)):
                echo '<div class="status-box success">';
                echo '<strong class="success">✓ Found ' . count($block_types) . ' ACF Blocks</strong>';
                echo '</div>';

                echo '<table>';
                echo '<tr><th>Block Name</th><th>Title</th><th>Category</th></tr>';

                foreach ($block_types as $block):
                    echo '<tr>';
                    echo '<td><code>' . esc_html($block['name']) . '</code></td>';
                    echo '<td>' . esc_html($block['title']) . '</td>';
                    echo '<td>' . esc_html($block['category']) . '</td>';
                    echo '</tr>';
                endforeach;

                echo '</table>';
            else:
                echo '<div class="status-box error">';
                echo '<strong class="error">✗ NO ACF Blocks Registered</strong><br>';
                echo 'ACF plugin is active but no blocks are registered.<br>';
                echo 'Check if <code>inc/acf.php</code> is being loaded properly.';
                echo '</div>';
            endif;
        else:
            echo '<div class="status-box error">';
            echo '<strong class="error">✗ Cannot check blocks - ACF not active</strong>';
            echo '</div>';
        endif;
        ?>

        <h2>4. Theme Functions File</h2>
        <?php
        $functions_file = get_template_directory() . '/functions.php';
        $acf_file = get_template_directory() . '/inc/acf.php';

        echo '<table>';
        echo '<tr><th>File</th><th>Status</th></tr>';

        $files = array(
            'functions.php' => $functions_file,
            'inc/acf.php' => $acf_file,
        );

        foreach ($files as $name => $path):
            $exists = file_exists($path);
            $status = $exists ? '<span class="success">✓ Exists</span>' : '<span class="error">✗ Missing</span>';
            $size = $exists ? number_format(filesize($path)) . ' bytes' : 'N/A';
        ?>
            <tr>
                <td><code><?php echo $name; ?></code></td>
                <td><?php echo $status; ?> (<?php echo $size; ?>)</td>
            </tr>
        <?php endforeach; ?>
        </table>

        <h2>5. Active Plugins</h2>
        <?php
        $active_plugins = get_option('active_plugins');

        echo '<table>';
        echo '<tr><th>Plugin</th><th>Status</th></tr>';

        if (!empty($active_plugins)):
            $acf_found = false;
            foreach ($active_plugins as $plugin):
                if (strpos($plugin, 'advanced-custom-fields') !== false):
                    $acf_found = true;
                    echo '<tr>';
                    echo '<td><code>' . esc_html($plugin) . '</code></td>';
                    echo '<td><span class="success">✓ ACF Plugin Active</span></td>';
                    echo '</tr>';
                endif;
            endforeach;

            if (!$acf_found):
                echo '<tr><td colspan="2"><span class="error">⚠️ ACF Plugin NOT in active plugins list</span></td></tr>';
            endif;

            echo '<tr><td colspan="2"><em>Showing ' . count($active_plugins) . ' total active plugins</em></td></tr>';
        else:
            echo '<tr><td colspan="2"><span class="warning">No plugins active</span></td></tr>';
        endif;

        echo '</table>';
        ?>

        <h2>6. PHP Errors Check</h2>
        <?php
        // Check if there are PHP errors
        $errors = error_get_last();

        if ($errors && in_array($errors['type'], array(E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR))):
            echo '<div class="status-box error">';
            echo '<strong class="error">⚠️ PHP Error Detected</strong><br>';
            echo '<pre>' . print_r($errors, true) . '</pre>';
            echo '</div>';
        else:
            echo '<div class="status-box success">';
            echo '<strong class="success">✓ No fatal PHP errors detected</strong>';
            echo '</div>';
        endif;
        ?>

        <h2>7. Recommended Actions</h2>
        <?php
        if (!$acf_active && !$acf_pro_active):
        ?>
            <div class="status-box error">
                <h3>🚨 CRITICAL: ACF Plugin Not Active</h3>
                <p><strong>This is the problem!</strong> The Advanced Custom Fields plugin is not active.</p>
                <p><strong>Solution:</strong></p>
                <ol>
                    <li>Log into WordPress Admin: <code>https://xn--wohnegrn-d6a.at/wp-admin/</code></li>
                    <li>Go to <strong>Plugins → Installed Plugins</strong></li>
                    <li>Find "Advanced Custom Fields" or "Advanced Custom Fields PRO"</li>
                    <li>Click <strong>"Activate"</strong></li>
                    <li>Refresh your website</li>
                </ol>
                <p><strong>If ACF is not in the list:</strong></p>
                <ol>
                    <li>Go to <strong>Plugins → Add New</strong></li>
                    <li>Search for "Advanced Custom Fields"</li>
                    <li>Install and activate the plugin</li>
                </ol>
            </div>
        <?php
        elseif (empty($block_types)):
        ?>
            <div class="status-box error">
                <h3>⚠️ ACF Active but No Blocks Registered</h3>
                <p>ACF plugin is active but blocks are not being registered.</p>
                <p><strong>Possible causes:</strong></p>
                <ul>
                    <li>PHP syntax error in <code>inc/acf.php</code></li>
                    <li>File permissions preventing file from loading</li>
                    <li>Theme caching issues</li>
                </ul>
                <p><strong>Next steps:</strong></p>
                <ol>
                    <li>Check PHP error logs in cPanel</li>
                    <li>Deactivate and reactivate the theme</li>
                    <li>Clear all WordPress caches</li>
                </ol>
            </div>
        <?php
        else:
        ?>
            <div class="status-box success">
                <h3>✅ Everything Looks Good!</h3>
                <p>ACF plugin is active and blocks are registered correctly.</p>
                <p>If blocks still aren't showing on pages, try:</p>
                <ol>
                    <li>Clear WordPress cache</li>
                    <li>Hard refresh browser (Ctrl+F5)</li>
                    <li>Check if pages are using the correct templates</li>
                </ol>
            </div>
        <?php
        endif;
        ?>

        <h2>8. Security Notice</h2>
        <div class="status-box error">
            <strong>⚠️ DELETE THIS FILE AFTER USE!</strong><br>
            Remove <code>acf-diagnostic.php</code> from your server for security.
        </div>
    </div>
</body>
</html>
