<?php
/**
 * DEPLOYMENT VERIFICATION TOOL
 *
 * This file helps diagnose why deployments aren't showing up on the live site.
 *
 * ACCESS: https://xn--wohnegrn-d6a.at/wp-content/themes/WohneGruen/deployment-check.php
 */

// Prevent direct access without proper authentication
$secret_key = isset($_GET['key']) ? $_GET['key'] : '';
$expected_key = 'wohnegruen2026check'; // Simple security

if ($secret_key !== $expected_key) {
    die('Access Denied. Use: ?key=wohnegruen2026check');
}

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WohneGrün - Deployment Diagnostic</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
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
            box-shadow: 0 4px 20px rgba(0,0,0,0.5);
        }
        h1 {
            color: #4ec9b0;
            border-bottom: 2px solid #4ec9b0;
            padding-bottom: 10px;
        }
        h2 {
            color: #569cd6;
            margin-top: 30px;
        }
        .success {
            color: #4ec9b0;
        }
        .error {
            color: #f48771;
        }
        .warning {
            color: #dcdcaa;
        }
        .info {
            color: #9cdcfe;
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
        .status-box.warning {
            background: #3a3a1e;
            border-color: #dcdcaa;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 WohneGrün Deployment Diagnostic</h1>
        <p class="info">Generated: <?php echo date('Y-m-d H:i:s'); ?></p>

        <h2>1. Theme Directory Information</h2>
        <?php
        $theme_dir = __DIR__;
        $wp_content_dir = dirname(dirname($theme_dir));
        ?>
        <table>
            <tr>
                <th>Property</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Current File Location</td>
                <td><code><?php echo __FILE__; ?></code></td>
            </tr>
            <tr>
                <td>Theme Directory</td>
                <td><code><?php echo $theme_dir; ?></code></td>
            </tr>
            <tr>
                <td>WP Content Directory</td>
                <td><code><?php echo $wp_content_dir; ?></code></td>
            </tr>
            <tr>
                <td>Server Document Root</td>
                <td><code><?php echo $_SERVER['DOCUMENT_ROOT']; ?></code></td>
            </tr>
        </table>

        <h2>2. Critical Files Check</h2>
        <?php
        $critical_files = array(
            'page-models.php' => 'Models Page Template',
            'assets/css/models-tabs.css' => 'Models Tabs CSS (NEW)',
            'assets/js/main.js' => 'Main JavaScript',
            'inc/enqueue.php' => 'Asset Enqueue File',
            'clear-cache.php' => 'Cache Clear Utility (NEW)',
            'deployment-check.php' => 'This File',
        );

        echo '<table>';
        echo '<tr><th>File</th><th>Status</th><th>Size</th><th>Last Modified</th></tr>';

        foreach ($critical_files as $file => $description) {
            $filepath = $theme_dir . '/' . $file;
            $exists = file_exists($filepath);
            $status = $exists ? '<span class="success">✓ EXISTS</span>' : '<span class="error">✗ MISSING</span>';
            $size = $exists ? number_format(filesize($filepath)) . ' bytes' : 'N/A';
            $modified = $exists ? date('Y-m-d H:i:s', filemtime($filepath)) : 'N/A';

            echo "<tr>";
            echo "<td><strong>{$description}</strong><br><code>{$file}</code></td>";
            echo "<td>{$status}</td>";
            echo "<td>{$size}</td>";
            echo "<td>{$modified}</td>";
            echo "</tr>";
        }
        echo '</table>';
        ?>

        <h2>3. File Content Verification</h2>

        <h3>3.1 Check enqueue.php for Version Numbers</h3>
        <?php
        $enqueue_file = $theme_dir . '/inc/enqueue.php';
        if (file_exists($enqueue_file)) {
            $enqueue_content = file_get_contents($enqueue_file);

            // Check for version 1.0.3
            if (strpos($enqueue_content, '1.0.3') !== false) {
                echo '<div class="status-box success">';
                echo '<strong class="success">✓ Version 1.0.3 FOUND in enqueue.php</strong><br>';
                echo 'The file has been updated with new version numbers.';
                echo '</div>';
            } else {
                echo '<div class="status-box error">';
                echo '<strong class="error">✗ Version 1.0.3 NOT FOUND in enqueue.php</strong><br>';
                echo 'The file still has old version numbers. Deployment may not have worked.';
                echo '</div>';
            }

            // Show version occurrences
            preg_match_all("/array\(\), '([0-9.]+)'/", $enqueue_content, $matches);
            if (!empty($matches[1])) {
                echo '<p>Versions found in file:</p>';
                echo '<pre>' . implode(', ', array_unique($matches[1])) . '</pre>';
            }
        } else {
            echo '<div class="status-box error">✗ enqueue.php NOT FOUND</div>';
        }
        ?>

        <h3>3.2 Check page-models.php Content</h3>
        <?php
        $models_file = $theme_dir . '/page-models.php';
        if (file_exists($models_file)) {
            $models_content = file_get_contents($models_file);

            // Check for new tabbed interface
            $has_tabs = strpos($models_content, 'model-tabs-nav') !== false;
            $has_slider = strpos($models_content, 'color-slider') !== false;
            $has_pure_tab = strpos($models_content, 'data-model="pure"') !== false;

            if ($has_tabs && $has_slider && $has_pure_tab) {
                echo '<div class="status-box success">';
                echo '<strong class="success">✓ NEW TABBED INTERFACE FOUND</strong><br>';
                echo 'page-models.php contains the redesigned tabbed interface code.';
                echo '</div>';
            } else {
                echo '<div class="status-box error">';
                echo '<strong class="error">✗ OLD DESIGN DETECTED</strong><br>';
                echo 'page-models.php does not contain the new tabbed interface.<br>';
                echo 'Has tabs: ' . ($has_tabs ? 'YES' : 'NO') . '<br>';
                echo 'Has slider: ' . ($has_slider ? 'YES' : 'NO') . '<br>';
                echo 'Has Pure tab: ' . ($has_pure_tab ? 'YES' : 'NO');
                echo '</div>';
            }

            // Show file size
            echo '<p>File size: ' . number_format(filesize($models_file)) . ' bytes</p>';
            echo '<p>Last modified: ' . date('Y-m-d H:i:s', filemtime($models_file)) . '</p>';
        } else {
            echo '<div class="status-box error">✗ page-models.php NOT FOUND</div>';
        }
        ?>

        <h2>4. WordPress Active Theme</h2>
        <?php
        // Try to load WordPress
        $wp_load = dirname(dirname(dirname($theme_dir))) . '/wp-load.php';
        if (file_exists($wp_load)) {
            require_once($wp_load);

            $current_theme = wp_get_theme();
            echo '<table>';
            echo '<tr><th>Property</th><th>Value</th></tr>';
            echo '<tr><td>Active Theme</td><td><strong>' . $current_theme->get('Name') . '</strong></td></tr>';
            echo '<tr><td>Theme Version</td><td>' . $current_theme->get('Version') . '</td></tr>';
            echo '<tr><td>Theme Directory</td><td><code>' . $current_theme->get_stylesheet_directory() . '</code></td></tr>';
            echo '<tr><td>Template Directory</td><td><code>' . $current_theme->get_template_directory() . '</code></td></tr>';
            echo '</table>';

            // Check if this is the active theme
            if ($current_theme->get_stylesheet_directory() === $theme_dir) {
                echo '<div class="status-box success">';
                echo '<strong class="success">✓ This IS the active theme</strong>';
                echo '</div>';
            } else {
                echo '<div class="status-box error">';
                echo '<strong class="error">✗ This is NOT the active theme!</strong><br>';
                echo 'Active theme directory: <code>' . $current_theme->get_stylesheet_directory() . '</code><br>';
                echo 'This file directory: <code>' . $theme_dir . '</code>';
                echo '</div>';
            }
        } else {
            echo '<div class="status-box warning">';
            echo '<strong class="warning">⚠ Cannot load WordPress</strong><br>';
            echo 'wp-load.php not found at expected location.';
            echo '</div>';
        }
        ?>

        <h2>5. Deployment Target Verification</h2>
        <div class="status-box warning">
            <strong>Expected Deployment Path (from GitHub Actions):</strong><br>
            <code>/home/wohneg79/public_html/wp-content/themes/WohneGruen</code>
            <br><br>
            <strong>Actual File Location:</strong><br>
            <code><?php echo $theme_dir; ?></code>
            <br><br>
            <?php if ($theme_dir === '/home/wohneg79/public_html/wp-content/themes/WohneGruen'): ?>
                <span class="success">✓ PATHS MATCH - Deployment target is correct</span>
            <?php else: ?>
                <span class="error">✗ PATHS DO NOT MATCH - Deployment may be going to wrong location!</span>
            <?php endif; ?>
        </div>

        <h2>6. Recommendations</h2>
        <?php
        $models_exists = file_exists($theme_dir . '/page-models.php');
        $tabs_css_exists = file_exists($theme_dir . '/assets/css/models-tabs.css');
        $enqueue_updated = file_exists($theme_dir . '/inc/enqueue.php') &&
                          strpos(file_get_contents($theme_dir . '/inc/enqueue.php'), '1.0.3') !== false;

        echo '<ul style="line-height: 2;">';

        if (!$tabs_css_exists) {
            echo '<li class="error">✗ models-tabs.css is MISSING - Deployment did not work</li>';
        } else {
            echo '<li class="success">✓ models-tabs.css exists</li>';
        }

        if (!$enqueue_updated) {
            echo '<li class="error">✗ enqueue.php has OLD version numbers - Deployment did not update files</li>';
        } else {
            echo '<li class="success">✓ enqueue.php has version 1.0.3</li>';
        }

        if ($models_exists) {
            $content = file_get_contents($theme_dir . '/page-models.php');
            if (strpos($content, 'model-tabs-nav') === false) {
                echo '<li class="error">✗ page-models.php has OLD content - Deployment did not update template</li>';
            } else {
                echo '<li class="success">✓ page-models.php has NEW tabbed interface code</li>';
            }
        }

        echo '</ul>';

        if (!$tabs_css_exists || !$enqueue_updated) {
            echo '<div class="status-box error">';
            echo '<h3>🚨 DEPLOYMENT IS NOT WORKING</h3>';
            echo '<p><strong>Possible causes:</strong></p>';
            echo '<ol>';
            echo '<li>GitHub Actions secrets (SFTP credentials) are incorrect or expired</li>';
            echo '<li>SSH/SFTP connection is failing silently</li>';
            echo '<li>File permissions prevent writing to server</li>';
            echo '<li>Deployment is going to a different directory</li>';
            echo '<li>Server-side caching is preventing file updates</li>';
            echo '</ol>';
            echo '<p><strong>Next steps:</strong></p>';
            echo '<ol>';
            echo '<li>Check GitHub Actions workflow logs for errors</li>';
            echo '<li>Verify SFTP credentials in repository secrets</li>';
            echo '<li>Manually upload files via cPanel File Manager to test</li>';
            echo '<li>Check file permissions on server</li>';
            echo '</ol>';
            echo '</div>';
        } else {
            echo '<div class="status-box success">';
            echo '<h3>✅ All files appear to be deployed correctly!</h3>';
            echo '<p>If you still don\'t see changes on the site:</p>';
            echo '<ol>';
            echo '<li>Clear WordPress cache (visit clear-cache.php)</li>';
            echo '<li>Hard refresh browser (Ctrl+F5)</li>';
            echo '<li>Check if Modelle page is using the correct template in WordPress admin</li>';
            echo '<li>Disable any caching plugins temporarily</li>';
            echo '</ol>';
            echo '</div>';
        }
        ?>

        <h2>7. Security Notice</h2>
        <div class="status-box error">
            <strong>⚠️ DELETE THIS FILE AFTER DIAGNOSIS!</strong><br>
            This diagnostic file exposes server information. Delete <code>deployment-check.php</code> after use.
        </div>
    </div>
</body>
</html>
