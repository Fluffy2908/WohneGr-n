<?php
/**
 * FIX MODELLE PAGE TEMPLATE
 *
 * This script ensures the Modelle page has the correct template assigned.
 *
 * INSTRUCTIONS:
 * 1. Upload to: wp-content/themes/WohneGruen/
 * 2. Access: https://xn--wohnegrn-d6a.at/wp-content/themes/WohneGruen/fix-modelle-page.php
 * 3. Click "Fix Template" button
 * 4. DELETE this file after use!
 */

// Load WordPress
require_once('../../../wp-load.php');

// Security check
if (!is_user_logged_in() || !current_user_can('edit_pages')) {
    die('You must be logged in as an administrator.');
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fix Modelle Page Template</title>
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
        h1 { color: #2d7c42; }
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
        .btn:hover { background: #1e5a38; }
        code {
            background: #f4f4f4;
            padding: 2px 6px;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔧 Fix Modelle Page Template</h1>

        <?php
        if (isset($_GET['fix']) && $_GET['fix'] === 'run') {
            echo '<h2>Fixing Templates...</h2>';

            // Find Modelle page
            $modelle_page = get_page_by_path('modelle');

            if (!$modelle_page) {
                echo '<div class="warning-box">';
                echo '<strong>Page "Modelle" not found!</strong><br>';
                echo 'Please run setup-models.php first to create the pages.';
                echo '</div>';
            } else {
                // Check current template
                $current_template = get_post_meta($modelle_page->ID, '_wp_page_template', true);

                echo '<div class="info-box">';
                echo '<strong>Found Modelle Page:</strong><br>';
                echo 'ID: ' . $modelle_page->ID . '<br>';
                echo 'URL: ' . get_permalink($modelle_page) . '<br>';
                echo 'Current Template: ' . ($current_template ?: 'default') . '<br>';
                echo '</div>';

                // Set correct template
                if ($current_template !== 'page-models.php') {
                    update_post_meta($modelle_page->ID, '_wp_page_template', 'page-models.php');
                    echo '<div class="success-box">';
                    echo '✓ Template updated to <code>page-models.php</code>';
                    echo '</div>';
                } else {
                    echo '<div class="success-box">';
                    echo '✓ Template already correct: <code>page-models.php</code>';
                    echo '</div>';
                }

                // Check Nature and Pure pages
                $nature_page = get_page_by_path('modelle/nature');
                if (!$nature_page) {
                    $nature_page = get_page_by_path('nature');
                }

                $pure_page = get_page_by_path('modelle/pure');
                if (!$pure_page) {
                    $pure_page = get_page_by_path('pure');
                }

                if ($nature_page) {
                    $nature_template = get_post_meta($nature_page->ID, '_wp_page_template', true);
                    echo '<div class="info-box">';
                    echo '<strong>Nature Page:</strong><br>';
                    echo 'URL: ' . get_permalink($nature_page) . '<br>';
                    echo 'Template: ' . ($nature_template ?: 'default');
                    echo '</div>';

                    if ($nature_template !== 'page-model-nature.php') {
                        update_post_meta($nature_page->ID, '_wp_page_template', 'page-model-nature.php');
                        echo '<div class="success-box">✓ Nature template fixed</div>';
                    }
                }

                if ($pure_page) {
                    $pure_template = get_post_meta($pure_page->ID, '_wp_page_template', true);
                    echo '<div class="info-box">';
                    echo '<strong>Pure Page:</strong><br>';
                    echo 'URL: ' . get_permalink($pure_page) . '<br>';
                    echo 'Template: ' . ($pure_template ?: 'default');
                    echo '</div>';

                    if ($pure_template !== 'page-model-pure.php') {
                        update_post_meta($pure_page->ID, '_wp_page_template', 'page-model-pure.php');
                        echo '<div class="success-box">✓ Pure template fixed</div>';
                    }
                }

                // Flush permalinks
                flush_rewrite_rules();

                echo '<div class="success-box">';
                echo '<h3>✅ All Done!</h3>';
                echo '<p><strong>Test your pages now:</strong></p>';
                echo '<ul>';
                echo '<li><a href="' . get_permalink($modelle_page) . '" target="_blank">View Modelle Page</a></li>';
                if ($nature_page) {
                    echo '<li><a href="' . get_permalink($nature_page) . '" target="_blank">View Nature Page</a></li>';
                }
                if ($pure_page) {
                    echo '<li><a href="' . get_permalink($pure_page) . '" target="_blank">View Pure Page</a></li>';
                }
                echo '</ul>';
                echo '</div>';

                echo '<div class="warning-box">';
                echo '<h3>⚠️ DELETE THIS FILE NOW!</h3>';
                echo '<p>Delete <code>fix-modelle-page.php</code> from your server for security.</p>';
                echo '</div>';
            }

        } else {
            ?>
            <div class="info-box">
                <h3>What This Script Does:</h3>
                <ul>
                    <li>✓ Finds your Modelle, Nature, and Pure pages</li>
                    <li>✓ Assigns the correct template to each page</li>
                    <li>✓ Refreshes permalinks</li>
                </ul>
            </div>

            <h3>Current Page Status:</h3>
            <?php
            $modelle = get_page_by_path('modelle');
            $nature = get_page_by_path('modelle/nature') ?: get_page_by_path('nature');
            $pure = get_page_by_path('modelle/pure') ?: get_page_by_path('pure');

            echo '<ul>';
            if ($modelle) {
                $template = get_post_meta($modelle->ID, '_wp_page_template', true);
                echo '<li><strong>Modelle:</strong> Found (Template: ' . ($template ?: 'default') . ')</li>';
            } else {
                echo '<li><strong>Modelle:</strong> NOT FOUND - Run setup-models.php first!</li>';
            }

            if ($nature) {
                $template = get_post_meta($nature->ID, '_wp_page_template', true);
                echo '<li><strong>Nature:</strong> Found (Template: ' . ($template ?: 'default') . ')</li>';
            } else {
                echo '<li><strong>Nature:</strong> NOT FOUND</li>';
            }

            if ($pure) {
                $template = get_post_meta($pure->ID, '_wp_page_template', true);
                echo '<li><strong>Pure:</strong> Found (Template: ' . ($template ?: 'default') . ')</li>';
            } else {
                echo '<li><strong>Pure:</strong> NOT FOUND</li>';
            }
            echo '</ul>';
            ?>

            <p style="margin-top: 30px;">
                <a href="?fix=run" class="btn">🔧 Fix Templates Now</a>
            </p>

            <?php
        }
        ?>
    </div>
</body>
</html>
