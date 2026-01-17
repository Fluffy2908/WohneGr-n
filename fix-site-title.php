<?php
/**
 * Fix Site Title - One-Time Script
 *
 * This script fixes the WordPress site title and tagline.
 * Visit: https://wohnegrün.at/wp-content/themes/WohneGruen/fix-site-title.php
 */

// Load WordPress
require_once('../../../wp-load.php');

// Update site title and tagline
update_option('blogname', 'WohneGrün');
update_option('blogdescription', 'Hochwertige Mobilhäuser in Österreich');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Site Title Fixed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 50px;
            background: #f5f5f5;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 { color: #2d7c42; }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        a {
            display: inline-block;
            background: #2d7c42;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        a:hover { background: #1e5a38; }
    </style>
</head>
<body>
<div class="container">
    <h1>✅ Site Title Fixed!</h1>

    <div class="success">
        <strong>Site Title:</strong> WohneGrün<br>
        <strong>Tagline:</strong> Hochwertige Mobilhäuser in Österreich
    </div>

    <p>The WordPress admin bar should now show the correct site title.</p>

    <p><strong>Important:</strong> Delete this file from the server after use!</p>

    <a href="<?php echo admin_url(); ?>">Go to WordPress Admin</a>
    <a href="<?php echo home_url(); ?>">View Site</a>
</div>
</body>
</html>
