<?php
/**
 * HOMEPAGE SETUP SCRIPT
 *
 * This script automatically:
 * 1. Removes the "Kontakt" block from the home page
 * 2. Adds the "Über uns" block after Hero section
 * 3. Sets up the correct block order
 *
 * INSTRUCTIONS:
 * 1. Upload this file to your WordPress root directory
 * 2. Access: https://xn--wohnegrn-d6a.at/setup-homepage.php
 * 3. Click "Setup Homepage Now"
 * 4. DELETE THIS FILE after use for security!
 */

// Load WordPress
require_once('wp-load.php');

// Security check
if (!is_user_logged_in() || !current_user_can('edit_pages')) {
    die('You must be logged in as an administrator to run this setup.');
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>WohneGrün Homepage Setup</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2d7c42;
            margin-bottom: 10px;
        }
        .subtitle {
            color: #666;
            margin-bottom: 30px;
        }
        .info-box {
            background: #e7f3ff;
            border-left: 4px solid #2196f3;
            padding: 15px;
            margin: 20px 0;
        }
        .success-box {
            background: #d4edda;
            border-left: 4px solid #28a745;
            padding: 15px;
            margin: 20px 0;
        }
        .warning-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
        }
        .error-box {
            background: #f8d7da;
            border-left: 4px solid #dc3545;
            padding: 15px;
            margin: 20px 0;
        }
        .btn {
            display: inline-block;
            background: #2d7c42;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background: #1e5a38;
        }
        .btn-danger {
            background: #dc3545;
        }
        .btn-danger:hover {
            background: #c82333;
        }
        ul {
            line-height: 1.8;
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
        <h1>🏠 WohneGrün Homepage Setup</h1>
        <p class="subtitle">Automatic homepage configuration tool</p>

        <?php
        if (isset($_GET['setup']) && $_GET['setup'] === 'run') {
            // RUN THE SETUP
            echo '<h2>Running Setup...</h2>';

            // Find the home page
            $home_page_id = get_option('page_on_front');

            if (!$home_page_id) {
                // Try to find by slug
                $home_page = get_page_by_path('startseite');
                if (!$home_page) {
                    $home_page = get_page_by_path('home');
                }
                if ($home_page) {
                    $home_page_id = $home_page->ID;
                }
            }

            if (!$home_page_id) {
                echo '<div class="error-box">';
                echo '<strong>Error:</strong> Could not find the home page. Please set a static front page in Settings → Reading first.';
                echo '</div>';
            } else {
                $page = get_post($home_page_id);

                echo '<div class="info-box">';
                echo '<strong>Found Home Page:</strong> ' . $page->post_title . ' (ID: ' . $home_page_id . ')';
                echo '</div>';

                // Define the correct block structure
                $new_content = '<!-- wp:acf/wohnegruen-hero {"name":"acf/wohnegruen-hero","mode":"preview"} /-->

<!-- wp:acf/wohnegruen-about {"name":"acf/wohnegruen-about","data":{"about_title":"Ihr Partner für modernes Wohnen","about_badge_number":"20+","about_badge_text":"Jahre Erfahrung"},"mode":"preview"} /-->

<!-- wp:acf/wohnegruen-features {"name":"acf/wohnegruen-features","mode":"preview"} /-->

<!-- wp:acf/wohnegruen-models {"name":"acf/wohnegruen-models","mode":"preview"} /-->';

                // Update the page
                $updated = wp_update_post(array(
                    'ID' => $home_page_id,
                    'post_content' => $new_content,
                ));

                if (is_wp_error($updated)) {
                    echo '<div class="error-box">';
                    echo '<strong>Error:</strong> ' . $updated->get_error_message();
                    echo '</div>';
                } else {
                    echo '<div class="success-box">';
                    echo '<h3>✅ Setup Complete!</h3>';
                    echo '<p>Your homepage has been updated with the following blocks:</p>';
                    echo '<ol>';
                    echo '<li><strong>Hero-Bereich</strong> - "Wir bauen Ihr Traumhaus"</li>';
                    echo '<li><strong>Über uns</strong> - "Ihr Partner für modernes Wohnen" (NEW!)</li>';
                    echo '<li><strong>Vorteile</strong> - "Warum WohneGrün wählen?"</li>';
                    echo '<li><strong>Modelle</strong> - "Unsere Modelle"</li>';
                    echo '</ol>';
                    echo '<p><strong>Changes made:</strong></p>';
                    echo '<ul>';
                    echo '<li>✓ Removed "Kontaktieren Sie uns" block</li>';
                    echo '<li>✓ Added "Über uns" block after Hero section</li>';
                    echo '<li>✓ Blocks reordered correctly</li>';
                    echo '</ul>';
                    echo '</div>';

                    echo '<div class="warning-box">';
                    echo '<h3>⚠️ IMPORTANT - DELETE THIS FILE NOW!</h3>';
                    echo '<p>For security reasons, you must delete <code>setup-homepage.php</code> from your server immediately.</p>';
                    echo '<p><strong>Delete via:</strong></p>';
                    echo '<ul>';
                    echo '<li>FTP/File Manager: Navigate to WordPress root and delete setup-homepage.php</li>';
                    echo '<li>Or SSH: <code>rm setup-homepage.php</code></li>';
                    echo '</ul>';
                    echo '</div>';

                    echo '<p style="margin-top: 30px;">';
                    echo '<a href="' . admin_url('post.php?post=' . $home_page_id . '&action=edit') . '" class="btn">View Page in Editor</a> ';
                    echo '<a href="' . get_permalink($home_page_id) . '" class="btn">View Live Page</a>';
                    echo '</p>';
                }
            }

        } else {
            // SHOW SETUP OPTIONS
            ?>

            <div class="info-box">
                <h3>What This Script Will Do:</h3>
                <ul>
                    <li>✓ Find your home page automatically</li>
                    <li>✓ Remove the "Kontaktieren Sie uns" (Contact) block</li>
                    <li>✓ Add the "Über uns" (About) block with "Ihr Partner für modernes Wohnen"</li>
                    <li>✓ Place it right after the Hero section</li>
                    <li>✓ Keep all other blocks (Features, Models)</li>
                </ul>
            </div>

            <div class="warning-box">
                <h3>⚠️ Before You Continue:</h3>
                <ul>
                    <li>Make sure you're logged into WordPress as an administrator</li>
                    <li>This will replace your home page content with the new block structure</li>
                    <li>You can always undo this in WordPress admin (Pages → Revisions)</li>
                </ul>
            </div>

            <h3>Current Home Page Status:</h3>
            <?php
            $home_page_id = get_option('page_on_front');
            if ($home_page_id) {
                $page = get_post($home_page_id);
                echo '<p><strong>Home Page:</strong> ' . $page->post_title . '</p>';
                echo '<p><strong>Current Content Preview:</strong></p>';
                echo '<code style="display: block; padding: 10px; background: #f4f4f4; white-space: pre-wrap; max-height: 200px; overflow-y: auto;">';
                echo esc_html(substr($page->post_content, 0, 500)) . '...';
                echo '</code>';
            } else {
                echo '<div class="warning-box">';
                echo '<strong>Warning:</strong> No static front page is set. Go to Settings → Reading and set a static front page first.';
                echo '</div>';
            }
            ?>

            <p style="margin-top: 30px;">
                <a href="?setup=run" class="btn">✨ Setup Homepage Now</a>
            </p>

            <hr style="margin: 40px 0;">

            <h3>Manual Alternative:</h3>
            <p>If you prefer to make changes manually in WordPress admin:</p>
            <ol>
                <li>Go to <a href="<?php echo admin_url('edit.php?post_type=page'); ?>">Pages</a></li>
                <li>Edit the home page (Startseite)</li>
                <li>Remove the Contact block</li>
                <li>Add the About block after Hero</li>
                <li>Click Update</li>
            </ol>

            <?php
        }
        ?>
    </div>
</body>
</html>
