<?php
/**
 * CACHE CLEARING UTILITY
 *
 * This script clears WordPress caches to force reload of new CSS/JS files.
 *
 * INSTRUCTIONS:
 * 1. This file is already in your theme, it will deploy automatically
 * 2. After deployment, visit: https://xn--wohnegrn-d6a.at/wp-content/themes/WohneGruen/clear-cache.php
 * 3. Click "Clear All Caches" button
 * 4. Hard refresh your browser (Ctrl+F5 or Cmd+Shift+R)
 * 5. DELETE this file after use for security!
 */

// Load WordPress
require_once('../../../wp-load.php');

// Security check - only logged-in admins
if (!is_user_logged_in() || !current_user_can('manage_options')) {
    die('⛔ Access Denied: You must be logged in as an administrator.');
}

// Process cache clearing
$cleared = array();
$errors = array();

if (isset($_GET['action']) && $_GET['action'] === 'clear') {

    // 1. Clear WordPress object cache
    if (function_exists('wp_cache_flush')) {
        wp_cache_flush();
        $cleared[] = '✓ WordPress object cache cleared';
    }

    // 2. Clear all transients
    global $wpdb;
    $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_%'");
    $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_site_transient_%'");
    $cleared[] = '✓ All transients cleared';

    // 3. Clear rewrite rules
    flush_rewrite_rules();
    $cleared[] = '✓ Rewrite rules flushed';

    // 4. Check for common caching plugins

    // W3 Total Cache
    if (function_exists('w3tc_flush_all')) {
        w3tc_flush_all();
        $cleared[] = '✓ W3 Total Cache cleared';
    }

    // WP Super Cache
    if (function_exists('wp_cache_clear_cache')) {
        wp_cache_clear_cache();
        $cleared[] = '✓ WP Super Cache cleared';
    }

    // WP Rocket
    if (function_exists('rocket_clean_domain')) {
        rocket_clean_domain();
        $cleared[] = '✓ WP Rocket cache cleared';
    }

    // LiteSpeed Cache
    if (class_exists('LiteSpeed\Purge')) {
        LiteSpeed\Purge::purge_all();
        $cleared[] = '✓ LiteSpeed Cache cleared';
    }

    // Autoptimize
    if (class_exists('autoptimizeCache')) {
        autoptimizeCache::clearall();
        $cleared[] = '✓ Autoptimize cache cleared';
    }

    // 5. Clear theme/template cache
    if (function_exists('wp_clean_themes_cache')) {
        wp_clean_themes_cache();
        $cleared[] = '✓ Theme cache cleared';
    }

    $cleared[] = '✓ Version numbers updated to 1.0.3 (forces browser reload)';
}

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WohneGrün - Cache Clearing Tool</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            background: linear-gradient(135deg, #2d7c42 0%, #1e5a38 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            background: white;
            max-width: 800px;
            width: 100%;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #2d7c42 0%, #1e5a38 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }
        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        .content {
            padding: 40px;
        }
        .status-box {
            background: #f8f9fa;
            border-left: 4px solid #2d7c42;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .status-box.success {
            background: #d4edda;
            border-color: #28a745;
        }
        .status-box.warning {
            background: #fff3cd;
            border-left-color: #ffc107;
        }
        .status-box.error {
            background: #f8d7da;
            border-left-color: #dc3545;
        }
        .status-box h3 {
            color: #2d7c42;
            margin-bottom: 15px;
            font-size: 1.3rem;
        }
        .status-box ul {
            list-style: none;
            padding: 0;
        }
        .status-box li {
            padding: 8px 0;
            font-size: 1.05rem;
        }
        .btn {
            display: inline-block;
            background: #2d7c42;
            color: white;
            padding: 16px 40px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.1rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(45, 124, 66, 0.3);
        }
        .btn:hover {
            background: #1e5a38;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(45, 124, 66, 0.4);
        }
        .btn-secondary {
            background: #6c757d;
        }
        .btn-secondary:hover {
            background: #545b62;
        }
        .instructions {
            background: #e7f3ff;
            border-left: 4px solid #2196f3;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .instructions h3 {
            color: #2196f3;
            margin-bottom: 15px;
        }
        .instructions ol {
            margin-left: 20px;
        }
        .instructions li {
            padding: 5px 0;
            line-height: 1.6;
        }
        .danger-box {
            background: #f8d7da;
            border-left: 4px solid #dc3545;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .danger-box h3 {
            color: #dc3545;
            margin-bottom: 10px;
        }
        .actions {
            margin-top: 30px;
            text-align: center;
        }
        .actions a {
            margin: 0 10px;
        }
        code {
            background: #f4f4f4;
            padding: 3px 8px;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            color: #dc3545;
        }
        .version-badge {
            display: inline-block;
            background: #28a745;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🧹 Cache Clearing Tool</h1>
            <p>WohneGrün Theme - Force Reload New Assets</p>
            <span class="version-badge">v1.0.3</span>
        </div>

        <div class="content">

            <?php if (!empty($cleared)): ?>
                <div class="status-box success">
                    <h3>✅ Caches Successfully Cleared!</h3>
                    <ul>
                        <?php foreach ($cleared as $item): ?>
                            <li><?php echo esc_html($item); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="instructions">
                    <h3>📋 Next Steps:</h3>
                    <ol>
                        <li><strong>Hard Refresh Your Browser:</strong>
                            <ul style="margin-left: 20px; margin-top: 10px;">
                                <li><strong>Windows:</strong> Press <code>Ctrl + F5</code> or <code>Ctrl + Shift + R</code></li>
                                <li><strong>Mac:</strong> Press <code>Cmd + Shift + R</code></li>
                            </ul>
                        </li>
                        <li>Visit your <a href="<?php echo home_url('/modelle'); ?>" target="_blank">Modelle page</a> to see the new tabbed interface</li>
                        <li>If still not working, clear your browser cache in settings</li>
                        <li><strong>Important:</strong> Delete this <code>clear-cache.php</code> file from your server for security!</li>
                    </ol>
                </div>

                <div class="actions">
                    <a href="<?php echo home_url('/modelle'); ?>" class="btn" target="_blank">
                        View Modelle Page
                    </a>
                    <a href="<?php echo home_url(); ?>" class="btn btn-secondary" target="_blank">
                        Go to Homepage
                    </a>
                </div>

            <?php else: ?>

                <div class="instructions">
                    <h3>📋 What This Tool Does:</h3>
                    <ul style="list-style: none; padding-left: 0;">
                        <li>✓ Clears WordPress object cache</li>
                        <li>✓ Removes all transients</li>
                        <li>✓ Flushes rewrite rules</li>
                        <li>✓ Clears caching plugin caches (if installed)</li>
                        <li>✓ Forces browsers to reload CSS/JS (version 1.0.3)</li>
                    </ul>
                </div>

                <div class="status-box warning">
                    <h3>⚠️ Why You Need This</h3>
                    <p>Your browser is caching the old CSS and JavaScript files. The new tabbed Modelle page won't appear until you:</p>
                    <ol style="margin-top: 15px; margin-left: 20px;">
                        <li>Click the button below to clear server-side caches</li>
                        <li>Hard refresh your browser (Ctrl+F5)</li>
                    </ol>
                </div>

                <div class="actions">
                    <a href="?action=clear" class="btn">
                        🧹 Clear All Caches Now
                    </a>
                </div>

            <?php endif; ?>

            <div class="danger-box">
                <h3>⚠️ IMPORTANT SECURITY NOTICE</h3>
                <p><strong>DELETE THIS FILE AFTER USE!</strong></p>
                <p>This file provides administrative functionality and should be removed from your server after clearing caches.</p>
                <p style="margin-top: 10px;">To delete: Remove <code>/wp-content/themes/WohneGruen/clear-cache.php</code> from your server via FTP or cPanel File Manager.</p>
            </div>

        </div>
    </div>
</body>
</html>
