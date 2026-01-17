<?php
/**
 * Fix Permalinks Script
 *
 * Run this if pages show 404 errors after installation
 *
 * USAGE: https://your-site.at/wp-content/themes/WohneGruen/fix-permalinks.php
 */

// Load WordPress
require_once('../../../wp-load.php');

// Security check
if (!current_user_can('manage_options')) {
    wp_die('Access denied. Please log in as administrator first.');
}

// Flush permalinks
flush_rewrite_rules(true);
delete_option('rewrite_rules');
flush_rewrite_rules(true);

// Clear any object cache
if (function_exists('wp_cache_flush')) {
    wp_cache_flush();
}

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permalinks Fixed</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: linear-gradient(135deg, #2d5016 0%, #3d6b1f 100%);
            padding: 40px;
            margin: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        h1 {
            color: #2d5016;
            margin-bottom: 20px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 15px 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #28a745;
        }
        .btn {
            display: inline-block;
            background: #2d5016;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 8px;
            margin: 10px 5px;
        }
        .btn:hover {
            background: #3d6b1f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>✅ Permalinks Fixed!</h1>

        <div class="success">
            <strong>Success!</strong><br>
            Permalink rewrite rules have been flushed.<br>
            Your pages should work now without 404 errors.
        </div>

        <p><strong>What was done:</strong></p>
        <ul>
            <li>Flushed WordPress rewrite rules</li>
            <li>Cleared rewrite rules cache</li>
            <li>Regenerated clean permalink structure</li>
        </ul>

        <p><strong>Next steps:</strong></p>
        <ol>
            <li>Delete this file (fix-permalinks.php) from your server</li>
            <li>Test your pages - they should work now</li>
            <li>Clear your browser cache (Ctrl + Shift + Delete)</li>
        </ol>

        <div style="margin-top: 30px;">
            <a href="<?php echo home_url(); ?>" class="btn">View Homepage</a>
            <a href="<?php echo admin_url(); ?>" class="btn">Go to Dashboard</a>
        </div>
    </div>
</body>
</html>
