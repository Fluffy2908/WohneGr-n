<?php
/**
 * SIMPLE DIAGNOSTIC - No WordPress dependencies
 *
 * ACCESS: https://xn--wohnegrn-d6a.at/wp-content/themes/WohneGruen/simple-diagnostic.php?key=check
 */

// Security check
if (!isset($_GET['key']) || $_GET['key'] !== 'check') {
    die('Access denied');
}

// Suppress errors for display
error_reporting(E_ALL);
ini_set('display_errors', 0);
$errors = array();
$warnings = array();
$success = array();

// Check 1: Can we access WordPress files?
$wp_load_path = '../../../wp-load.php';
$wp_load_exists = file_exists($wp_load_path);

if ($wp_load_exists) {
    $success[] = "WordPress wp-load.php found";

    // Try to load WordPress
    try {
        require_once($wp_load_path);
        $success[] = "WordPress loaded successfully";
    } catch (Exception $e) {
        $errors[] = "Failed to load WordPress: " . $e->getMessage();
    }
} else {
    $errors[] = "WordPress wp-load.php not found at " . realpath($wp_load_path);
}

// Check 2: ACF Plugin
$acf_status = "NOT FOUND";
$acf_version = "N/A";

if (function_exists('class_exists')) {
    if (class_exists('ACF')) {
        $acf_status = "ACTIVE (Free)";
        $success[] = "ACF Free version is active";
    } elseif (class_exists('acf_pro')) {
        $acf_status = "ACTIVE (PRO)";
        $success[] = "ACF PRO version is active";
    } else {
        $errors[] = "ACF Plugin is NOT active or not installed";
        $acf_status = "INACTIVE or NOT INSTALLED";
    }

    if (defined('ACF_VERSION')) {
        $acf_version = ACF_VERSION;
    }
}

// Check 3: Theme files
$theme_dir = __DIR__;
$critical_files = array(
    'functions.php',
    'inc/acf.php',
    'inc/theme.php',
    'inc/enqueue.php',
    'page-models.php',
);

$file_status = array();
foreach ($critical_files as $file) {
    $path = $theme_dir . '/' . $file;
    $exists = file_exists($path);
    $file_status[$file] = array(
        'exists' => $exists,
        'size' => $exists ? filesize($path) : 0,
        'modified' => $exists ? date('Y-m-d H:i:s', filemtime($path)) : 'N/A'
    );

    if ($exists) {
        $success[] = "$file exists";
    } else {
        $errors[] = "$file is MISSING";
    }
}

// Check 4: Active plugins
$active_plugins = array();
if (function_exists('get_option')) {
    $active_plugins = get_option('active_plugins', array());
}

// Check 5: WordPress version
$wp_version = function_exists('get_bloginfo') ? get_bloginfo('version') : 'Unknown';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Simple Diagnostic</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .box {
            background: white;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        h1 { color: #2d7c42; }
        h2 { color: #1e5a38; margin-top: 30px; }
        .error {
            background: #fee;
            border-left: 4px solid #f00;
            padding: 15px;
            margin: 10px 0;
        }
        .success {
            background: #efe;
            border-left: 4px solid #0f0;
            padding: 15px;
            margin: 10px 0;
        }
        .warning {
            background: #ffe;
            border-left: 4px solid #ff0;
            padding: 15px;
            margin: 10px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background: #2d7c42;
            color: white;
        }
        code {
            background: #f4f4f4;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: monospace;
        }
        .status-ok { color: green; font-weight: bold; }
        .status-error { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <div class="box">
        <h1>🔍 WohneGrün Simple Diagnostic</h1>
        <p>Generated: <?php echo date('Y-m-d H:i:s'); ?></p>
    </div>

    <?php if (!empty($errors)): ?>
    <div class="error">
        <h2>❌ Errors Found (<?php echo count($errors); ?>)</h2>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
    <div class="success">
        <h2>✅ Success (<?php echo count($success); ?>)</h2>
        <ul>
            <?php foreach ($success as $msg): ?>
                <li><?php echo htmlspecialchars($msg); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <div class="box">
        <h2>1. WordPress Status</h2>
        <table>
            <tr>
                <th>Property</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>WordPress Version</td>
                <td><code><?php echo htmlspecialchars($wp_version); ?></code></td>
            </tr>
            <tr>
                <td>WordPress Loaded</td>
                <td class="<?php echo $wp_load_exists ? 'status-ok' : 'status-error'; ?>">
                    <?php echo $wp_load_exists ? '✓ Yes' : '✗ No'; ?>
                </td>
            </tr>
        </table>
    </div>

    <div class="box">
        <h2>2. ACF Plugin Status</h2>
        <table>
            <tr>
                <th>Property</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>ACF Status</td>
                <td class="<?php echo (strpos($acf_status, 'ACTIVE') !== false) ? 'status-ok' : 'status-error'; ?>">
                    <strong><?php echo htmlspecialchars($acf_status); ?></strong>
                </td>
            </tr>
            <tr>
                <td>ACF Version</td>
                <td><code><?php echo htmlspecialchars($acf_version); ?></code></td>
            </tr>
        </table>

        <?php if (strpos($acf_status, 'INACTIVE') !== false || strpos($acf_status, 'NOT') !== false): ?>
        <div class="error">
            <h3>🚨 THIS IS THE PROBLEM!</h3>
            <p><strong>ACF Plugin is not active.</strong> This is why your blocks are missing.</p>
            <p><strong>SOLUTION:</strong></p>
            <ol>
                <li>Go to: <a href="https://xn--wohnegrn-d6a.at/wp-admin/plugins.php" target="_blank">WordPress Plugins Page</a></li>
                <li>Find "Advanced Custom Fields"</li>
                <li>Click <strong>"Activate"</strong></li>
                <li>Refresh your website</li>
            </ol>
            <p><strong>If ACF is not in the list:</strong></p>
            <ol>
                <li>Go to: <a href="https://xn--wohnegrn-d6a.at/wp-admin/plugin-install.php" target="_blank">Add New Plugin</a></li>
                <li>Search for "Advanced Custom Fields"</li>
                <li>Install and activate it</li>
            </ol>
        </div>
        <?php endif; ?>
    </div>

    <div class="box">
        <h2>3. Theme Files</h2>
        <table>
            <tr>
                <th>File</th>
                <th>Exists</th>
                <th>Size</th>
                <th>Last Modified</th>
            </tr>
            <?php foreach ($file_status as $file => $status): ?>
            <tr>
                <td><code><?php echo htmlspecialchars($file); ?></code></td>
                <td class="<?php echo $status['exists'] ? 'status-ok' : 'status-error'; ?>">
                    <?php echo $status['exists'] ? '✓ Yes' : '✗ No'; ?>
                </td>
                <td><?php echo number_format($status['size']); ?> bytes</td>
                <td><?php echo htmlspecialchars($status['modified']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="box">
        <h2>4. Active Plugins</h2>
        <?php if (!empty($active_plugins)): ?>
            <p>Total active plugins: <strong><?php echo count($active_plugins); ?></strong></p>
            <ul>
                <?php foreach ($active_plugins as $plugin): ?>
                    <li>
                        <code><?php echo htmlspecialchars($plugin); ?></code>
                        <?php if (strpos($plugin, 'advanced-custom-fields') !== false): ?>
                            <span class="status-ok">← ACF PLUGIN FOUND!</span>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="status-error">No active plugins found (or cannot read plugin list)</p>
        <?php endif; ?>
    </div>

    <div class="box">
        <h2>5. Quick Links</h2>
        <ul>
            <li><a href="https://xn--wohnegrn-d6a.at/wp-admin/" target="_blank">WordPress Admin</a></li>
            <li><a href="https://xn--wohnegrn-d6a.at/wp-admin/plugins.php" target="_blank">Plugins Page</a></li>
            <li><a href="https://xn--wohnegrn-d6a.at/" target="_blank">Homepage</a></li>
            <li><a href="https://xn--wohnegrn-d6a.at/modelle/" target="_blank">Modelle Page</a></li>
        </ul>
    </div>

    <div class="box">
        <h2>⚠️ Security Notice</h2>
        <p><strong>DELETE THIS FILE after use!</strong> Remove <code>simple-diagnostic.php</code> from your server.</p>
    </div>
</body>
</html>
