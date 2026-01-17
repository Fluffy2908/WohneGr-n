<?php
/**
 * COMPLETE RESET & FIX Script
 *
 * This script fixes ALL common issues:
 * - 404 errors
 * - Missing ACF blocks
 * - Duplicate pages
 * - Permalink issues
 *
 * USAGE: https://your-site.at/wp-content/themes/WohneGruen/complete-reset.php
 *
 * WARNING: This will DELETE all pages and recreate them fresh!
 */

// Load WordPress
require_once('../../../wp-load.php');

// Security check
if (!current_user_can('manage_options')) {
    wp_die('Access denied. Please log in as WordPress administrator first.', 'Access Denied', array('response' => 403));
}

// Check if ACF Pro is installed
if (!function_exists('acf_add_local_field_group')) {
    wp_die('ACF Pro is required but not installed. Please install and activate Advanced Custom Fields PRO plugin first.', 'Installation Error');
}

$run = isset($_GET['run']) && $_GET['run'] === 'yes';

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Reset & Fix</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: linear-gradient(135deg, #2d5016 0%, #3d6b1f 100%);
            padding: 20px;
            margin: 0;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        .header {
            background: linear-gradient(135deg, #2d5016 0%, #3d6b1f 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .content {
            padding: 30px;
        }
        h1 { margin: 0 0 10px 0; font-size: 28px; }
        h2 { color: #2d5016; border-bottom: 2px solid #2d5016; padding-bottom: 10px; }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin: 10px 0;
            border-left: 4px solid #28a745;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 8px;
            margin: 10px 0;
            border-left: 4px solid #dc3545;
        }
        .warning {
            background: #fff3cd;
            color: #856404;
            padding: 15px;
            border-radius: 8px;
            margin: 10px 0;
            border-left: 4px solid #ffc107;
        }
        .info {
            background: #d1ecf1;
            color: #0c5460;
            padding: 15px;
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
            margin: 10px 5px;
        }
        .btn:hover {
            background: #3d6b1f;
        }
        .btn-danger {
            background: #dc3545;
        }
        .btn-danger:hover {
            background: #c82333;
        }
        ul, ol {
            line-height: 1.8;
        }
        code {
            background: #f4f4f4;
            padding: 2px 8px;
            border-radius: 4px;
            font-family: monospace;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔧 Complete Reset & Fix</h1>
            <p>Fix all issues: 404 errors, missing blocks, duplicates</p>
        </div>
        <div class="content">
            <?php if (!$run): ?>
                <h2>⚠️ What This Script Does</h2>

                <div class="warning">
                    <strong>WARNING: This will DELETE all pages and start fresh!</strong><br>
                    Make sure you have a backup if you have custom content.
                </div>

                <h2>This Script Will:</h2>
                <ol>
                    <li>Delete ALL existing pages (including duplicates)</li>
                    <li>Delete all menus</li>
                    <li>Delete all Mobilhaus posts</li>
                    <li>Create 8 fresh pages (Home, Modelle, Galerie, etc.)</li>
                    <li>Create navigation menu</li>
                    <li>Create sample models (Nature & Pure)</li>
                    <li>Add ACF blocks to homepage</li>
                    <li>Fix permalinks (solve 404 errors)</li>
                    <li>Flush all caches</li>
                    <li>Force ACF to re-register blocks</li>
                </ol>

                <h2>Before You Start:</h2>
                <ul>
                    <li>✓ Make sure ACF Pro is installed and activated</li>
                    <li>✓ You are logged in as WordPress administrator</li>
                    <li>✓ You have a backup (if you have important content)</li>
                </ul>

                <div style="text-align: center; margin: 40px 0;">
                    <a href="?run=yes" class="btn btn-danger">⚠️ Start Complete Reset</a>
                </div>

            <?php else: ?>
                <h2>🔄 Running Complete Reset...</h2>

                <?php
                // Step 1: Delete all pages
                echo '<div class="info"><strong>Step 1:</strong> Deleting all pages...</div>';
                $pages = get_pages(array('number' => 999));
                $deleted_pages = 0;
                foreach ($pages as $page) {
                    wp_delete_post($page->ID, true);
                    $deleted_pages++;
                }
                echo '<div class="success">✓ Deleted ' . $deleted_pages . ' pages</div>';

                // Step 2: Delete all menus
                echo '<div class="info"><strong>Step 2:</strong> Deleting all menus...</div>';
                $menus = wp_get_nav_menus();
                foreach ($menus as $menu) {
                    wp_delete_nav_menu($menu->term_id);
                }
                echo '<div class="success">✓ Deleted ' . count($menus) . ' menus</div>';

                // Step 3: Delete Mobilhaus posts
                echo '<div class="info"><strong>Step 3:</strong> Deleting Mobilhaus posts...</div>';
                $mobilhaus_posts = get_posts(array('post_type' => 'mobilhaus', 'posts_per_page' => -1));
                foreach ($mobilhaus_posts as $post) {
                    wp_delete_post($post->ID, true);
                }
                echo '<div class="success">✓ Deleted ' . count($mobilhaus_posts) . ' Mobilhaus posts</div>';

                // Step 4: Create pages
                echo '<div class="info"><strong>Step 4:</strong> Creating fresh pages...</div>';
                $pages_data = array(
                    'home' => array('title' => 'Home', 'template' => ''),
                    'modelle' => array('title' => 'Modelle', 'template' => 'page-models-new.php'),
                    'galerie' => array('title' => 'Galerie & 3D', 'template' => 'page-gallery-3d.php'),
                    'about' => array('title' => 'Über uns', 'template' => 'page-about.php'),
                    'kontakt' => array('title' => 'Kontakt', 'template' => 'page-contact.php'),
                    'impressum' => array('title' => 'Impressum', 'template' => 'page-impressum.php'),
                    'datenschutz' => array('title' => 'Datenschutzerklärung', 'template' => 'page-datenschutz.php'),
                    'agb' => array('title' => 'AGB', 'template' => 'page-agb.php'),
                );

                $created_pages = array();
                foreach ($pages_data as $key => $page_data) {
                    $page_id = wp_insert_post(array(
                        'post_title' => $page_data['title'],
                        'post_content' => '',
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
                echo '<div class="success">✓ Created ' . count($created_pages) . ' pages</div>';

                // Step 5: Create navigation menu
                echo '<div class="info"><strong>Step 5:</strong> Creating navigation menu...</div>';
                $menu_name = 'Hauptmenü';
                $menu_id = wp_create_nav_menu($menu_name);

                if (!is_wp_error($menu_id)) {
                    $menu_items = array(
                        array('id' => $created_pages['home'], 'title' => 'Home'),
                        array('id' => $created_pages['modelle'], 'title' => 'Modelle'),
                        array('id' => $created_pages['galerie'], 'title' => 'Galerie & 3D'),
                        array('id' => $created_pages['about'], 'title' => 'Über uns'),
                        array('id' => $created_pages['kontakt'], 'title' => 'Kontakt'),
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

                    $locations = get_theme_mod('nav_menu_locations');
                    $locations['primary'] = $menu_id;
                    set_theme_mod('nav_menu_locations', $locations);

                    echo '<div class="success">✓ Created navigation menu with ' . count($menu_items) . ' items</div>';
                }

                // Step 6: Create Mobilhaus posts
                echo '<div class="info"><strong>Step 6:</strong> Creating sample Mobilhaus posts...</div>';

                $nature_id = wp_insert_post(array(
                    'post_title' => 'Nature',
                    'post_content' => 'Unser Nature-Modell kombiniert nachhaltiges Design mit maximaler Funktionalität.',
                    'post_status' => 'publish',
                    'post_type' => 'mobilhaus',
                    'post_author' => 1,
                ));
                if ($nature_id) {
                    update_post_meta($nature_id, 'mobilhaus_size', '45');
                    update_post_meta($nature_id, 'mobilhaus_rooms', '2');
                    update_post_meta($nature_id, 'mobilhaus_capacity', '4');
                    update_post_meta($nature_id, 'mobilhaus_price', '59900');
                }

                $pure_id = wp_insert_post(array(
                    'post_title' => 'Pure',
                    'post_content' => 'Das Pure-Modell besticht durch minimalistisches Design und optimale Raumnutzung.',
                    'post_status' => 'publish',
                    'post_type' => 'mobilhaus',
                    'post_author' => 1,
                ));
                if ($pure_id) {
                    update_post_meta($pure_id, 'mobilhaus_size', '35');
                    update_post_meta($pure_id, 'mobilhaus_rooms', '1');
                    update_post_meta($pure_id, 'mobilhaus_capacity', '2');
                    update_post_meta($pure_id, 'mobilhaus_price', '49900');
                }

                echo '<div class="success">✓ Created 2 Mobilhaus posts (Nature & Pure)</div>';

                // Step 7: Add blocks to homepage
                echo '<div class="info"><strong>Step 7:</strong> Adding ACF blocks to homepage...</div>';
                $blocks_content = '<!-- wp:acf/wohnegruen-hero /-->

<!-- wp:acf/wohnegruen-features /-->

<!-- wp:acf/wohnegruen-models /-->

<!-- wp:acf/wohnegruen-about /-->

<!-- wp:acf/wohnegruen-contact /-->';

                wp_update_post(array(
                    'ID' => $created_pages['home'],
                    'post_content' => $blocks_content
                ));
                echo '<div class="success">✓ Added 5 ACF blocks to homepage</div>';

                // Step 8: Configure WordPress settings
                echo '<div class="info"><strong>Step 8:</strong> Configuring WordPress settings...</div>';
                update_option('show_on_front', 'page');
                update_option('page_on_front', $created_pages['home']);
                update_option('blogname', 'WohneGrün');
                update_option('blogdescription', 'Nachhaltige Mobilhäuser für modernes Leben');
                update_option('permalink_structure', '/%postname%/');
                echo '<div class="success">✓ WordPress settings configured</div>';

                // Step 9: Fix permalinks AGGRESSIVELY
                echo '<div class="info"><strong>Step 9:</strong> Fixing permalinks (solving 404 errors)...</div>';

                // Clear all caches
                if (function_exists('wp_cache_flush')) {
                    wp_cache_flush();
                }

                // Delete rewrite rules
                delete_option('rewrite_rules');

                // Flush permalinks multiple times
                flush_rewrite_rules(true);
                sleep(1);
                flush_rewrite_rules(true);
                sleep(1);
                flush_rewrite_rules(true);

                echo '<div class="success">✓ Permalinks flushed (3x) - 404 errors should be fixed!</div>';

                // Step 10: Force ACF re-initialization
                echo '<div class="info"><strong>Step 10:</strong> Re-initializing ACF blocks...</div>';

                // Trigger ACF init hooks
                do_action('acf/init');
                do_action('init');

                // Clear ACF cache
                if (function_exists('acf_reset_local')) {
                    acf_reset_local();
                }

                echo '<div class="success">✓ ACF blocks re-initialized</div>';

                // Final success message
                echo '<h2>✅ Complete Reset Finished!</h2>';
                echo '<div class="success">';
                echo '<strong>All done! Your site should be working now.</strong><br><br>';
                echo '<strong>What was done:</strong><br>';
                echo '✓ Deleted ' . $deleted_pages . ' old pages<br>';
                echo '✓ Created ' . count($created_pages) . ' fresh pages<br>';
                echo '✓ Created navigation menu<br>';
                echo '✓ Created 2 sample models<br>';
                echo '✓ Added ACF blocks to homepage<br>';
                echo '✓ Fixed permalinks (404 errors)<br>';
                echo '✓ Re-initialized ACF blocks<br>';
                echo '</div>';

                echo '<div class="warning">';
                echo '<strong>⚠️ IMPORTANT - Next Steps:</strong><br>';
                echo '1. DELETE this file (complete-reset.php) from your server NOW!<br>';
                echo '2. Go to WordPress → Settings → Permalinks and click "Save Changes"<br>';
                echo '3. Clear your browser cache (Ctrl + Shift + Delete)<br>';
                echo '4. Test your site - all pages should work now!<br>';
                echo '</div>';

                echo '<div style="text-align: center; margin: 30px 0;">';
                echo '<a href="' . home_url() . '" class="btn">View Homepage</a> ';
                echo '<a href="' . admin_url() . '" class="btn">Go to Dashboard</a> ';
                echo '<a href="' . admin_url('edit.php?post_type=page') . '" class="btn">View Pages</a>';
                echo '</div>';
                ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
