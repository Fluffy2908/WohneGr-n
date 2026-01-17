<?php
/**
 * MODELS SETUP SCRIPT
 *
 * This script automatically:
 * 1. Creates "Modelle" overview page
 * 2. Creates "Nature" model page
 * 3. Creates "Pure" model page
 * 4. Assigns correct templates to each page
 * 5. Adds "Modelle" to navigation menu
 *
 * INSTRUCTIONS:
 * 1. Upload this file to your WordPress theme directory (wp-content/themes/wohnegruen/)
 * 2. Access: https://xn--wohnegrn-d6a.at/wp-content/themes/wohnegruen/setup-models.php
 * 3. Click "Setup Models Now"
 * 4. DELETE THIS FILE after use for security!
 */

// Load WordPress
require_once('../../../wp-load.php');

// Security check
if (!is_user_logged_in() || !current_user_can('edit_pages')) {
    die('You must be logged in as an administrator to run this setup.');
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>WohneGrün Models Setup</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            max-width: 900px;
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
            margin-top: 20px;
        }
        .btn:hover {
            background: #1e5a38;
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
        .page-link {
            display: inline-block;
            margin: 5px 10px 5px 0;
            padding: 8px 15px;
            background: #2d7c42;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }
        .page-link:hover {
            background: #1e5a38;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🏠 WohneGrün Models Setup</h1>
        <p class="subtitle">Automatic setup for Nature and Pure models</p>

        <?php
        if (isset($_GET['setup']) && $_GET['setup'] === 'run') {
            // RUN THE SETUP
            echo '<h2>Running Setup...</h2>';

            $created_pages = array();
            $errors = array();

            // =================================================================
            // STEP 1: Create Modelle Overview Page
            // =================================================================

            echo '<div class="info-box"><strong>Step 1:</strong> Creating "Modelle" overview page...</div>';

            // Check if page already exists
            $modelle_page = get_page_by_path('modelle');

            if ($modelle_page) {
                echo '<div class="warning-box">Page "Modelle" already exists (ID: ' . $modelle_page->ID . '). Skipping creation.</div>';
                $modelle_page_id = $modelle_page->ID;
            } else {
                $modelle_page_id = wp_insert_post(array(
                    'post_title'    => 'Modelle',
                    'post_name'     => 'modelle',
                    'post_status'   => 'publish',
                    'post_type'     => 'page',
                    'post_content'  => '',
                ));

                if (is_wp_error($modelle_page_id)) {
                    $errors[] = 'Failed to create Modelle page: ' . $modelle_page_id->get_error_message();
                } else {
                    update_post_meta($modelle_page_id, '_wp_page_template', 'page-models.php');
                    $created_pages['modelle'] = $modelle_page_id;
                    echo '<div class="success-box">✓ Created "Modelle" page (ID: ' . $modelle_page_id . ')</div>';
                }
            }

            // =================================================================
            // STEP 2: Create Nature Model Page
            // =================================================================

            echo '<div class="info-box"><strong>Step 2:</strong> Creating "Nature" model page...</div>';

            $nature_page = get_page_by_path('nature');

            if ($nature_page) {
                echo '<div class="warning-box">Page "Nature" already exists (ID: ' . $nature_page->ID . '). Skipping creation.</div>';
                $nature_page_id = $nature_page->ID;
            } else {
                $nature_page_id = wp_insert_post(array(
                    'post_title'    => 'Nature',
                    'post_name'     => 'nature',
                    'post_parent'   => $modelle_page_id,
                    'post_status'   => 'publish',
                    'post_type'     => 'page',
                    'post_content'  => '',
                ));

                if (is_wp_error($nature_page_id)) {
                    $errors[] = 'Failed to create Nature page: ' . $nature_page_id->get_error_message();
                } else {
                    update_post_meta($nature_page_id, '_wp_page_template', 'page-model-nature.php');
                    $created_pages['nature'] = $nature_page_id;
                    echo '<div class="success-box">✓ Created "Nature" page (ID: ' . $nature_page_id . ')</div>';
                }
            }

            // =================================================================
            // STEP 3: Create Pure Model Page
            // =================================================================

            echo '<div class="info-box"><strong>Step 3:</strong> Creating "Pure" model page...</div>';

            $pure_page = get_page_by_path('pure');

            if ($pure_page) {
                echo '<div class="warning-box">Page "Pure" already exists (ID: ' . $pure_page->ID . '). Skipping creation.</div>';
                $pure_page_id = $pure_page->ID;
            } else {
                $pure_page_id = wp_insert_post(array(
                    'post_title'    => 'Pure',
                    'post_name'     => 'pure',
                    'post_parent'   => $modelle_page_id,
                    'post_status'   => 'publish',
                    'post_type'     => 'page',
                    'post_content'  => '',
                ));

                if (is_wp_error($pure_page_id)) {
                    $errors[] = 'Failed to create Pure page: ' . $pure_page_id->get_error_message();
                } else {
                    update_post_meta($pure_page_id, '_wp_page_template', 'page-model-pure.php');
                    $created_pages['pure'] = $pure_page_id;
                    echo '<div class="success-box">✓ Created "Pure" page (ID: ' . $pure_page_id . ')</div>';
                }
            }

            // =================================================================
            // STEP 4: Add to Navigation Menu
            // =================================================================

            echo '<div class="info-box"><strong>Step 4:</strong> Adding to navigation menu...</div>';

            // Get primary menu
            $locations = get_nav_menu_locations();
            $menu_id = isset($locations['primary']) ? $locations['primary'] : 0;

            if (!$menu_id) {
                // Try to find any menu
                $menus = wp_get_nav_menus();
                if (!empty($menus)) {
                    $menu_id = $menus[0]->term_id;
                }
            }

            if ($menu_id) {
                // Check if Modelle already in menu
                $menu_items = wp_get_nav_menu_items($menu_id);
                $modelle_exists = false;

                if ($menu_items) {
                    foreach ($menu_items as $item) {
                        if ($item->object_id == $modelle_page_id) {
                            $modelle_exists = true;
                            break;
                        }
                    }
                }

                if (!$modelle_exists && $modelle_page_id) {
                    wp_update_nav_menu_item($menu_id, 0, array(
                        'menu-item-title' => 'Modelle',
                        'menu-item-object-id' => $modelle_page_id,
                        'menu-item-object' => 'page',
                        'menu-item-type' => 'post_type',
                        'menu-item-status' => 'publish',
                    ));
                    echo '<div class="success-box">✓ Added "Modelle" to navigation menu</div>';
                } else {
                    echo '<div class="warning-box">⚠ "Modelle" already in menu or menu not found</div>';
                }
            } else {
                echo '<div class="warning-box">⚠ No navigation menu found. Please add "Modelle" to your menu manually.</div>';
            }

            // =================================================================
            // STEP 5: Flush Rewrite Rules
            // =================================================================

            flush_rewrite_rules();
            echo '<div class="success-box">✓ Refreshed permalinks</div>';

            // =================================================================
            // SUMMARY
            // =================================================================

            if (empty($errors)) {
                echo '<div class="success-box">';
                echo '<h3>🎉 Setup Complete!</h3>';
                echo '<p><strong>Created pages:</strong></p>';
                echo '<ul>';
                if (isset($created_pages['modelle'])) {
                    echo '<li>Modelle (ID: ' . $created_pages['modelle'] . ') - Template: page-models.php</li>';
                }
                if (isset($created_pages['nature'])) {
                    echo '<li>Nature (ID: ' . $created_pages['nature'] . ') - Template: page-model-nature.php</li>';
                }
                if (isset($created_pages['pure'])) {
                    echo '<li>Pure (ID: ' . $created_pages['pure'] . ') - Template: page-model-pure.php</li>';
                }
                echo '</ul>';
                echo '</div>';

                echo '<div class="info-box">';
                echo '<h3>📸 Next Step: Upload Images</h3>';
                echo '<p>You need to upload <strong>32 images</strong> to:</p>';
                echo '<code>wp-content/themes/wohnegruen/assets/images/</code>';
                echo '<p style="margin-top: 15px;">See <strong>IMAGE-DOWNLOAD-GUIDE.txt</strong> for the complete list of images needed.</p>';
                echo '</div>';

                echo '<div class="warning-box">';
                echo '<h3>⚠️ IMPORTANT - DELETE THIS FILE NOW!</h3>';
                echo '<p>For security reasons, delete <code>setup-models.php</code> from your server immediately.</p>';
                echo '<p><strong>Delete via:</strong></p>';
                echo '<ul>';
                echo '<li>cPanel File Manager: Navigate to wp-content/themes/wohnegruen/ and delete setup-models.php</li>';
                echo '<li>Or FTP: Delete the file from the theme directory</li>';
                echo '</ul>';
                echo '</div>';

                echo '<h3 style="margin-top: 30px;">View Your New Pages:</h3>';
                if ($modelle_page_id) {
                    echo '<a href="' . get_permalink($modelle_page_id) . '" class="page-link" target="_blank">View Modelle Page</a>';
                }
                if (isset($nature_page_id)) {
                    echo '<a href="' . get_permalink($nature_page_id) . '" class="page-link" target="_blank">View Nature Page</a>';
                }
                if (isset($pure_page_id)) {
                    echo '<a href="' . get_permalink($pure_page_id) . '" class="page-link" target="_blank">View Pure Page</a>';
                }

                echo '<br><br>';
                echo '<a href="' . admin_url('nav-menus.php') . '" class="page-link">Edit Navigation Menu</a>';
                echo '<a href="' . admin_url('edit.php?post_type=page') . '" class="page-link">View All Pages</a>';

            } else {
                echo '<div class="error-box">';
                echo '<h3>❌ Errors Occurred:</h3>';
                echo '<ul>';
                foreach ($errors as $error) {
                    echo '<li>' . esc_html($error) . '</li>';
                }
                echo '</ul>';
                echo '</div>';
            }

        } else {
            // SHOW SETUP OPTIONS
            ?>

            <div class="info-box">
                <h3>What This Script Will Do:</h3>
                <ul>
                    <li>✓ Create "Modelle" overview page with page-models.php template</li>
                    <li>✓ Create "Nature" model detail page with page-model-nature.php template</li>
                    <li>✓ Create "Pure" model detail page with page-model-pure.php template</li>
                    <li>✓ Set Nature and Pure as child pages of Modelle</li>
                    <li>✓ Add "Modelle" to your navigation menu</li>
                    <li>✓ Refresh permalinks</li>
                </ul>
            </div>

            <div class="warning-box">
                <h3>⚠️ Before You Continue:</h3>
                <ul>
                    <li>Make sure you're logged into WordPress as an administrator</li>
                    <li>This will create new pages (won't overwrite existing ones)</li>
                    <li>After setup, you'll need to upload 32 images manually</li>
                </ul>
            </div>

            <h3>Current Setup Status:</h3>
            <?php
            $existing_modelle = get_page_by_path('modelle');
            $existing_nature = get_page_by_path('nature');
            $existing_pure = get_page_by_path('pure');

            echo '<ul>';
            if ($existing_modelle) {
                echo '<li>✓ "Modelle" page exists (ID: ' . $existing_modelle->ID . ')</li>';
            } else {
                echo '<li>✗ "Modelle" page does not exist</li>';
            }

            if ($existing_nature) {
                echo '<li>✓ "Nature" page exists (ID: ' . $existing_nature->ID . ')</li>';
            } else {
                echo '<li>✗ "Nature" page does not exist</li>';
            }

            if ($existing_pure) {
                echo '<li>✓ "Pure" page exists (ID: ' . $existing_pure->ID . ')</li>';
            } else {
                echo '<li>✗ "Pure" page does not exist</li>';
            }
            echo '</ul>';

            // Check templates exist
            echo '<h3>Template Files Check:</h3>';
            echo '<ul>';
            echo '<li>' . (file_exists(get_template_directory() . '/page-models.php') ? '✓' : '✗') . ' page-models.php</li>';
            echo '<li>' . (file_exists(get_template_directory() . '/page-model-nature.php') ? '✓' : '✗') . ' page-model-nature.php</li>';
            echo '<li>' . (file_exists(get_template_directory() . '/page-model-pure.php') ? '✓' : '✗') . ' page-model-pure.php</li>';
            echo '</ul>';
            ?>

            <p style="margin-top: 30px;">
                <a href="?setup=run" class="btn">✨ Setup Models Now</a>
            </p>

            <?php
        }
        ?>
    </div>
</body>
</html>
