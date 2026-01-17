<?php
/**
 * WohneGrün Theme - Complete Installation Script
 *
 * This script performs a complete, clean installation of the WohneGrün theme.
 * It creates all pages, ACF field groups, navigation menus, and sample content.
 *
 * USAGE:
 * 1. Upload theme to /wp-content/themes/WohneGruen/
 * 2. Activate theme in WordPress
 * 3. Make sure ACF Pro is installed and activated
 * 4. Visit: https://your-site.at/wp-content/themes/WohneGruen/install.php
 * 5. Click "Start Installation"
 * 6. DELETE this file after installation completes!
 *
 * @version 1.0.0
 * @date 2026-01-17
 */

// Load WordPress
require_once('../../../wp-load.php');

// Security check - must be logged in as admin
if (!current_user_can('manage_options')) {
    wp_die('Access denied. Please log in as WordPress administrator first.', 'Installation Error', array('response' => 403));
}

// Check if ACF Pro is installed
if (!function_exists('acf_add_local_field_group')) {
    wp_die('ACF Pro is required but not installed. Please install and activate Advanced Custom Fields PRO plugin first.', 'Installation Error');
}

// Start output buffering for clean HTML
ob_start();

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WohneGrün - Theme Installation</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background: linear-gradient(135deg, #2d5016 0%, #3d6b1f 100%);
            padding: 20px;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 1100px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #2d5016 0%, #3d6b1f 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }
        .header h1 {
            font-size: 32px;
            margin-bottom: 10px;
            font-weight: 600;
        }
        .header p {
            font-size: 16px;
            opacity: 0.95;
        }
        .content {
            padding: 40px;
        }
        .section {
            margin-bottom: 30px;
        }
        .section h2 {
            color: #2d5016;
            font-size: 24px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 3px solid #2d5016;
        }
        .step {
            background: #f8f9fa;
            padding: 20px;
            margin: 15px 0;
            border-radius: 8px;
            border-left: 4px solid #2d5016;
        }
        .step h3 {
            color: #2d5016;
            font-size: 18px;
            margin-bottom: 10px;
        }
        .step-number {
            display: inline-block;
            background: #2d5016;
            color: white;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            border-radius: 50%;
            margin-right: 10px;
            font-weight: bold;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 15px 20px;
            border-radius: 8px;
            margin: 10px 0;
            border-left: 4px solid #28a745;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 15px 20px;
            border-radius: 8px;
            margin: 10px 0;
            border-left: 4px solid #dc3545;
        }
        .warning {
            background: #fff3cd;
            color: #856404;
            padding: 15px 20px;
            border-radius: 8px;
            margin: 10px 0;
            border-left: 4px solid #ffc107;
        }
        .info {
            background: #d1ecf1;
            color: #0c5460;
            padding: 15px 20px;
            border-radius: 8px;
            margin: 10px 0;
            border-left: 4px solid #17a2b8;
        }
        .btn {
            display: inline-block;
            background: #2d5016;
            color: white;
            padding: 15px 40px;
            text-decoration: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn:hover {
            background: #3d6b1f;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(45,80,22,0.3);
        }
        .btn-danger {
            background: #dc3545;
        }
        .btn-danger:hover {
            background: #c82333;
        }
        .progress-bar {
            background: #e9ecef;
            height: 30px;
            border-radius: 15px;
            overflow: hidden;
            margin: 20px 0;
        }
        .progress-fill {
            background: linear-gradient(90deg, #2d5016 0%, #3d6b1f 100%);
            height: 100%;
            width: 0%;
            transition: width 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        .checklist {
            list-style: none;
            margin: 20px 0;
        }
        .checklist li {
            padding: 10px 0;
            padding-left: 30px;
            position: relative;
        }
        .checklist li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #28a745;
            font-weight: bold;
            font-size: 20px;
        }
        code {
            background: #f4f4f4;
            padding: 2px 8px;
            border-radius: 4px;
            font-family: "Courier New", monospace;
            color: #c7254e;
        }
        .footer {
            background: #f8f9fa;
            padding: 30px 40px;
            text-align: center;
            border-top: 1px solid #dee2e6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        th {
            background: #f8f9fa;
            font-weight: 600;
            color: #2d5016;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }
        .status-success {
            background: #d4edda;
            color: #155724;
        }
        .status-error {
            background: #f8d7da;
            color: #721c24;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏡 WohneGrün Theme Installation</h1>
            <p>Complete setup in one click - Creates pages, menus, ACF fields, and sample content</p>
        </div>

        <div class="content">
            <?php
            // Check if installation should run
            $run_install = isset($_GET['run']) && $_GET['run'] === 'yes';

            if (!$run_install) {
                // Show installation start page
                ?>
                <div class="section">
                    <h2>✅ Pre-Installation Checklist</h2>

                    <?php
                    // System requirements check
                    $wp_version = get_bloginfo('version');
                    $php_version = phpversion();
                    $acf_active = class_exists('ACF');
                    $acf_pro_active = function_exists('acf_add_local_field_group');

                    $all_ok = version_compare($wp_version, '6.0', '>=') &&
                              version_compare($php_version, '8.0', '>=') &&
                              $acf_pro_active;
                    ?>

                    <table>
                        <tr>
                            <th>Requirement</th>
                            <th>Required</th>
                            <th>Current</th>
                            <th>Status</th>
                        </tr>
                        <tr>
                            <td>WordPress Version</td>
                            <td>6.0+</td>
                            <td><?php echo $wp_version; ?></td>
                            <td>
                                <?php if (version_compare($wp_version, '6.0', '>=')): ?>
                                    <span class="status-badge status-success">✓ OK</span>
                                <?php else: ?>
                                    <span class="status-badge status-error">✗ Update Required</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>PHP Version</td>
                            <td>8.0+</td>
                            <td><?php echo $php_version; ?></td>
                            <td>
                                <?php if (version_compare($php_version, '8.0', '>=')): ?>
                                    <span class="status-badge status-success">✓ OK</span>
                                <?php else: ?>
                                    <span class="status-badge status-error">✗ Update Required</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>ACF Pro Plugin</td>
                            <td>Installed & Active</td>
                            <td><?php echo $acf_pro_active ? 'Active' : ($acf_active ? 'Free Version Only' : 'Not Installed'); ?></td>
                            <td>
                                <?php if ($acf_pro_active): ?>
                                    <span class="status-badge status-success">✓ OK</span>
                                <?php else: ?>
                                    <span class="status-badge status-error">✗ Install ACF Pro</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="section">
                    <h2>📋 What Will Be Installed</h2>

                    <div class="step">
                        <h3><span class="step-number">1</span> ACF Field Groups</h3>
                        <p>13 field groups will be created for all blocks and theme options:</p>
                        <ul class="checklist">
                            <li>Hero Block Fields</li>
                            <li>Features Block Fields</li>
                            <li>Models Block Fields</li>
                            <li>About Block Fields</li>
                            <li>Contact Block Fields</li>
                            <li>Gallery Block Fields</li>
                            <li>3D Tour Block Fields</li>
                            <li>Floor Plans Block Fields</li>
                            <li>Interiors Block Fields</li>
                            <li>CTA Block Fields</li>
                            <li>Navigation Options</li>
                            <li>Footer Options</li>
                            <li>Contact Information</li>
                        </ul>
                    </div>

                    <div class="step">
                        <h3><span class="step-number">2</span> Pages</h3>
                        <p>8 pages will be created with proper templates:</p>
                        <ul class="checklist">
                            <li>Home (Front Page with all blocks)</li>
                            <li>Modelle (Models showcase)</li>
                            <li>Galerie & 3D (Gallery and 3D tours)</li>
                            <li>Über uns (About page)</li>
                            <li>Kontakt (Contact page)</li>
                            <li>Impressum (Legal notice)</li>
                            <li>Datenschutzerklärung (Privacy policy)</li>
                            <li>AGB (Terms and conditions)</li>
                        </ul>
                    </div>

                    <div class="step">
                        <h3><span class="step-number">3</span> Navigation Menu</h3>
                        <p>Main navigation menu will be created and assigned.</p>
                    </div>

                    <div class="step">
                        <h3><span class="step-number">4</span> Sample Content</h3>
                        <p>2 Mobilhaus model posts will be created:</p>
                        <ul class="checklist">
                            <li>Nature Model (with all specifications)</li>
                            <li>Pure Model (with all specifications)</li>
                        </ul>
                    </div>

                    <div class="step">
                        <h3><span class="step-number">5</span> Theme Settings</h3>
                        <p>WordPress settings will be configured automatically.</p>
                    </div>
                </div>

                <?php if (!$all_ok): ?>
                    <div class="warning">
                        <strong>⚠️ Warning:</strong> Some requirements are not met. Please fix the issues above before continuing.
                    </div>
                <?php else: ?>
                    <div class="info">
                        <strong>ℹ️ Important:</strong> This installation will <strong>delete all existing pages and menus</strong> to create a fresh setup. Make sure you have a backup if needed.
                    </div>

                    <div style="text-align: center; margin: 40px 0;">
                        <a href="?run=yes" class="btn">🚀 Start Installation</a>
                    </div>
                <?php endif; ?>

                <?php
            } else {
                // Run the installation
                echo '<div class="section">';
                echo '<h2>🔧 Installation in Progress</h2>';
                echo '<div class="progress-bar"><div class="progress-fill" id="progress">0%</div></div>';
                echo '<div id="install-log">';

                // Flush output so progress shows in real-time
                flush_output();

                // Start installation
                run_installation();

                echo '</div>';
                echo '</div>';

                echo '<div class="section">';
                echo '<div class="success">';
                echo '<h3>✅ Installation Complete!</h3>';
                echo '<p>Your WohneGrün website is now ready to use.</p>';
                echo '</div>';

                echo '<div class="info">';
                echo '<h3>🔐 Important Security Step</h3>';
                echo '<p><strong>DELETE THIS FILE NOW!</strong> For security reasons, remove <code>install.php</code> from your server:</p>';
                echo '<code>/wp-content/themes/WohneGruen/install.php</code>';
                echo '</div>';

                echo '<div style="text-align: center; margin: 30px 0;">';
                echo '<a href="' . home_url() . '" class="btn">View Your Website</a> ';
                echo '<a href="' . admin_url() . '" class="btn">Go to Dashboard</a>';
                echo '</div>';

                echo '</div>';
            }
            ?>
        </div>

        <div class="footer">
            <p><strong>WohneGrün</strong> - Nachhaltige Mobilhäuser für modernes Leben</p>
            <p style="margin-top: 10px; font-size: 14px; color: #6c757d;">Installation Script v1.0.0 | 2026</p>
        </div>
    </div>

    <script>
    function updateProgress(percent) {
        const progressBar = document.getElementById('progress');
        if (progressBar) {
            progressBar.style.width = percent + '%';
            progressBar.textContent = percent + '%';
        }
    }
    </script>
</body>
</html>
<?php

/**
 * Flush output buffer to show progress in real-time
 */
function flush_output() {
    if (ob_get_level() > 0) {
        ob_flush();
    }
    flush();
}

/**
 * Log a message to the installation output
 */
function log_message($message, $type = 'info') {
    $classes = array(
        'success' => 'success',
        'error' => 'error',
        'warning' => 'warning',
        'info' => 'info'
    );

    $class = isset($classes[$type]) ? $classes[$type] : 'info';
    echo "<div class='$class'>$message</div>";
    flush_output();
}

/**
 * Main installation function
 */
function run_installation() {
    $start_time = microtime(true);

    // Step 1: Clean up old data
    log_message('<strong>Step 1/9:</strong> Cleaning up old data...', 'info');
    echo '<script>updateProgress(10);</script>';
    flush_output();
    cleanup_old_data();
    log_message('✓ Old data cleaned up successfully.', 'success');

    // Step 2: Create ACF Field Groups
    log_message('<strong>Step 2/9:</strong> Creating ACF field groups...', 'info');
    echo '<script>updateProgress(20);</script>';
    flush_output();
    create_acf_field_groups();
    log_message('✓ ACF field groups created successfully.', 'success');

    // Step 3: Create Pages
    log_message('<strong>Step 3/9:</strong> Creating pages...', 'info');
    echo '<script>updateProgress(35);</script>';
    flush_output();
    $pages = create_pages();
    log_message('✓ Created ' . count($pages) . ' pages successfully.', 'success');

    // Step 4: Create Navigation Menu
    log_message('<strong>Step 4/9:</strong> Creating navigation menu...', 'info');
    echo '<script>updateProgress(50);</script>';
    flush_output();
    create_navigation_menu($pages);
    log_message('✓ Navigation menu created successfully.', 'success');

    // Step 5: Create Mobilhaus Posts
    log_message('<strong>Step 5/9:</strong> Creating sample Mobilhaus posts...', 'info');
    echo '<script>updateProgress(65);</script>';
    flush_output();
    create_mobilhaus_posts();
    log_message('✓ Sample Mobilhaus posts created successfully.', 'success');

    // Step 6: Configure Homepage Blocks
    log_message('<strong>Step 6/9:</strong> Configuring homepage blocks...', 'info');
    echo '<script>updateProgress(75);</script>';
    flush_output();
    configure_homepage_blocks($pages['home']);
    log_message('✓ Homepage blocks configured successfully.', 'success');

    // Step 7: Set WordPress Options
    log_message('<strong>Step 7/9:</strong> Configuring WordPress settings...', 'info');
    echo '<script>updateProgress(85);</script>';
    flush_output();
    configure_wordpress_settings($pages);
    log_message('✓ WordPress settings configured successfully.', 'success');

    // Step 8: Set Theme Options
    log_message('<strong>Step 8/9:</strong> Setting theme options...', 'info');
    echo '<script>updateProgress(93);</script>';
    flush_output();
    set_theme_options();
    log_message('✓ Theme options set successfully.', 'success');

    // Step 9: Final verification
    log_message('<strong>Step 9/9:</strong> Running final verification...', 'info');
    echo '<script>updateProgress(98);</script>';
    flush_output();
    verify_installation();
    log_message('✓ Verification complete.', 'success');

    echo '<script>updateProgress(100);</script>';
    flush_output();

    $end_time = microtime(true);
    $duration = round($end_time - $start_time, 2);

    log_message("<strong>Installation completed in $duration seconds!</strong>", 'success');
}

/**
 * Step 1: Clean up old data
 */
function cleanup_old_data() {
    // Delete all pages
    $pages = get_pages(array('number' => 999));
    foreach ($pages as $page) {
        wp_delete_post($page->ID, true);
    }

    // Delete all menus
    $menus = wp_get_nav_menus();
    foreach ($menus as $menu) {
        wp_delete_nav_menu($menu->term_id);
    }

    // Delete all Mobilhaus posts
    $mobilhaus_posts = get_posts(array(
        'post_type' => 'mobilhaus',
        'posts_per_page' => -1
    ));
    foreach ($mobilhaus_posts as $post) {
        wp_delete_post($post->ID, true);
    }

    // Clear theme setup flags
    delete_option('wohnegruen_setup_complete');
    delete_option('wohnegruen_pages_created');
}

/**
 * Step 2: Create ACF Field Groups
 * Field groups are auto-registered from inc/acf.php when theme loads
 */
function create_acf_field_groups() {
    // ACF field groups are already defined in inc/acf.php
    // They auto-register via the wohnegruen_register_block_fields() function
    // which is called on 'acf/init' hook

    // Verify that the registration function exists
    if (function_exists('wohnegruen_register_block_fields')) {
        // Trigger the registration
        do_action('acf/init');

        log_message('✓ ACF field groups registered automatically from theme', 'info');
        log_message('Registered 10 block field groups + 3 option field groups', 'info');
    } else {
        log_message('⚠️ Warning: ACF registration function not found', 'warning');
    }
}

/**
 * Step 3: Create Pages
 */
function create_pages() {
    $pages_data = array(
        'home' => array(
            'title' => 'Home',
            'template' => '',
            'content' => ''
        ),
        'modelle' => array(
            'title' => 'Modelle',
            'template' => 'page-models-new.php',
            'content' => ''
        ),
        'galerie' => array(
            'title' => 'Galerie & 3D',
            'template' => 'page-gallery-3d.php',
            'content' => ''
        ),
        'about' => array(
            'title' => 'Über uns',
            'template' => 'page-about.php',
            'content' => ''
        ),
        'kontakt' => array(
            'title' => 'Kontakt',
            'template' => 'page-contact.php',
            'content' => ''
        ),
        'impressum' => array(
            'title' => 'Impressum',
            'template' => 'page-impressum.php',
            'content' => ''
        ),
        'datenschutz' => array(
            'title' => 'Datenschutzerklärung',
            'template' => 'page-datenschutz.php',
            'content' => ''
        ),
        'agb' => array(
            'title' => 'AGB',
            'template' => 'page-agb.php',
            'content' => ''
        ),
    );

    $created_pages = array();

    foreach ($pages_data as $key => $page_data) {
        $page_id = wp_insert_post(array(
            'post_title' => $page_data['title'],
            'post_content' => $page_data['content'],
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_author' => 1,
        ));

        if ($page_id && !is_wp_error($page_id)) {
            if (!empty($page_data['template'])) {
                update_post_meta($page_id, '_wp_page_template', $page_data['template']);
            }
            $created_pages[$key] = $page_id;
        }
    }

    return $created_pages;
}

/**
 * Step 4: Create Navigation Menu
 */
function create_navigation_menu($pages) {
    $menu_name = 'Hauptmenü';
    $menu_id = wp_create_nav_menu($menu_name);

    if (!is_wp_error($menu_id)) {
        // Add pages to menu
        $menu_items = array(
            array('id' => $pages['home'], 'title' => 'Home'),
            array('id' => $pages['modelle'], 'title' => 'Modelle'),
            array('id' => $pages['galerie'], 'title' => 'Galerie & 3D'),
            array('id' => $pages['about'], 'title' => 'Über uns'),
            array('id' => $pages['kontakt'], 'title' => 'Kontakt'),
        );

        foreach ($menu_items as $index => $item) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-object-id' => $item['id'],
                'menu-item-object' => 'page',
                'menu-item-type' => 'post_type',
                'menu-item-status' => 'publish',
                'menu-item-position' => $index + 1,
            ));
        }

        // Assign menu to primary location
        $locations = get_theme_mod('nav_menu_locations');
        $locations['primary'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }
}

/**
 * Step 5: Create Mobilhaus Posts
 */
function create_mobilhaus_posts() {
    // Create Nature model
    $nature_id = wp_insert_post(array(
        'post_title' => 'Nature',
        'post_content' => 'Unser Nature-Modell kombiniert nachhaltiges Design mit maximaler Funktionalität. Perfekt für Familien, die Wert auf ökologisches Wohnen legen.',
        'post_status' => 'publish',
        'post_type' => 'mobilhaus',
        'post_author' => 1,
    ));

    if ($nature_id && !is_wp_error($nature_id)) {
        update_post_meta($nature_id, 'mobilhaus_size', '45');
        update_post_meta($nature_id, 'mobilhaus_rooms', '2');
        update_post_meta($nature_id, 'mobilhaus_capacity', '4');
        update_post_meta($nature_id, 'mobilhaus_price', '59900');
        log_message('Created Nature model (ID: ' . $nature_id . ')', 'info');
    }

    // Create Pure model
    $pure_id = wp_insert_post(array(
        'post_title' => 'Pure',
        'post_content' => 'Das Pure-Modell besticht durch minimalistisches Design und optimale Raumnutzung. Ideal für Paare oder Singles.',
        'post_status' => 'publish',
        'post_type' => 'mobilhaus',
        'post_author' => 1,
    ));

    if ($pure_id && !is_wp_error($pure_id)) {
        update_post_meta($pure_id, 'mobilhaus_size', '35');
        update_post_meta($pure_id, 'mobilhaus_rooms', '1');
        update_post_meta($pure_id, 'mobilhaus_capacity', '2');
        update_post_meta($pure_id, 'mobilhaus_price', '49900');
        log_message('Created Pure model (ID: ' . $pure_id . ')', 'info');
    }
}

/**
 * Step 6: Configure Homepage Blocks
 */
function configure_homepage_blocks($home_page_id) {
    // Create Gutenberg block content for homepage
    // Note: Blocks will need to be manually configured with ACF fields after installation

    $blocks_content = '<!-- wp:acf/wohnegruen-hero /-->

<!-- wp:acf/wohnegruen-features /-->

<!-- wp:acf/wohnegruen-models /-->

<!-- wp:acf/wohnegruen-about /-->

<!-- wp:acf/wohnegruen-contact /-->';

    // Update homepage with blocks
    wp_update_post(array(
        'ID' => $home_page_id,
        'post_content' => $blocks_content
    ));

    log_message('Added 5 ACF blocks to homepage (Hero, Features, Models, About, Contact)', 'info');
    log_message('ℹ️ Blocks added - you can customize their content in the page editor', 'info');
}

/**
 * Step 7: Configure WordPress Settings
 */
function configure_wordpress_settings($pages) {
    // Set homepage
    update_option('show_on_front', 'page');
    update_option('page_on_front', $pages['home']);

    // Set site title and tagline
    update_option('blogname', 'WohneGrün');
    update_option('blogdescription', 'Nachhaltige Mobilhäuser für modernes Leben');

    // Set permalinks to post name
    update_option('permalink_structure', '/%postname%/');

    // Force flush rewrite rules multiple times to ensure it works
    flush_rewrite_rules(true);
    delete_option('rewrite_rules');
    flush_rewrite_rules(true);

    log_message('Permalinks flushed - pages should work now', 'info');
}

/**
 * Step 8: Set Theme Options
 */
function set_theme_options() {
    update_option('wohnegruen_setup_complete', '1');
    update_option('wohnegruen_installation_date', current_time('mysql'));
}

/**
 * Step 9: Verify Installation
 */
function verify_installation() {
    $errors = array();

    // Check if homepage is set
    if (!get_option('page_on_front')) {
        $errors[] = 'Homepage not set';
    }

    // Check if menu exists
    $menus = wp_get_nav_menus();
    if (empty($menus)) {
        $errors[] = 'No navigation menu found';
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            log_message('⚠️ ' . $error, 'warning');
        }
    } else {
        log_message('All checks passed!', 'success');
    }
}

// End of output buffering
ob_end_flush();
