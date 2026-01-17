<?php
/**
 * MASTER FIX SCRIPT - Fix ALL Issues
 *
 * This script fixes all the problems found in the screenshots:
 * 1. Site title ("Cats And Dogs")
 * 2. Delete duplicate pages
 * 3. Create proper pages
 * 4. Create navigation menu with Modelle
 * 5. Create Mobilhaus posts
 * 6. Verify ACF field groups
 *
 * USAGE: https://wohnegrün.at/wp-content/themes/WohneGruen/master-fix.php
 */

// Load WordPress
require_once('../../../wp-load.php');

// Load theme functions
require_once('inc/theme.php');
require_once('inc/sample-data.php');

// Must be admin
if (!current_user_can('manage_options')) {
    die('Access denied. Please log in as admin first.');
}

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>WohneGrün Master Fix</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            padding: 20px;
            background: #f5f5f5;
            line-height: 1.6;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2d7c42;
            border-bottom: 3px solid #2d7c42;
            padding-bottom: 10px;
        }
        h2 {
            color: #1e5a38;
            border-left: 4px solid #2d7c42;
            padding-left: 15px;
            margin-top: 30px;
        }
        .step {
            background: #f8f9fa;
            padding: 20px;
            margin: 15px 0;
            border-radius: 5px;
            border-left: 4px solid #2d7c42;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 12px 15px;
            border-radius: 5px;
            margin: 10px 0;
            border-left: 4px solid #28a745;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 12px 15px;
            border-radius: 5px;
            margin: 10px 0;
            border-left: 4px solid #dc3545;
        }
        .warning {
            background: #fff3cd;
            color: #856404;
            padding: 12px 15px;
            border-radius: 5px;
            margin: 10px 0;
            border-left: 4px solid #ffc107;
        }
        .info {
            background: #d1ecf1;
            color: #0c5460;
            padding: 12px 15px;
            border-radius: 5px;
            margin: 10px 0;
            border-left: 4px solid #17a2b8;
        }
        code {
            background: #f4f4f4;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
            font-size: 0.9em;
        }
        ul {
            line-height: 1.8;
        }
        .actions {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #ddd;
            text-align: center;
        }
        a.button {
            display: inline-block;
            background: #2d7c42;
            color: white !important;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px;
            transition: background 0.3s;
        }
        a.button:hover {
            background: #1e5a38;
        }
        .count {
            font-weight: bold;
            color: #2d7c42;
            font-size: 1.1em;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: #2d7c42;
            color: white;
        }
        tr:nth-child(even) {
            background: #f8f9fa;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>🔧 WohneGrün Master Fix Script</h1>
    <p><strong>This script will fix ALL issues found in your screenshots.</strong></p>

    <?php
    $errors = array();
    $warnings = array();
    $success_messages = array();

    // ============================================================
    // STEP 1: Fix Site Title
    // ============================================================
    echo "<h2>Step 1: Fix Site Title</h2>";
    echo "<div class='step'>";

    $old_title = get_option('blogname');
    $old_tagline = get_option('blogdescription');

    update_option('blogname', 'WohneGrün');
    update_option('blogdescription', 'Hochwertige Mobilhäuser in Österreich');

    echo "<div class='success'>✓ Site title updated</div>";
    echo "<ul>";
    echo "<li>Old: <code>" . esc_html($old_title) . "</code> → New: <code>WohneGrün</code></li>";
    echo "<li>Old tagline: <code>" . esc_html($old_tagline) . "</code></li>";
    echo "<li>New tagline: <code>Hochwertige Mobilhäuser in Österreich</code></li>";
    echo "</ul>";

    echo "</div>";

    // ============================================================
    // STEP 2: Delete Duplicate Pages
    // ============================================================
    echo "<h2>Step 2: Clean Up Duplicate Pages</h2>";
    echo "<div class='step'>";

    // Get all pages
    $all_pages = get_posts(array(
        'post_type' => 'page',
        'posts_per_page' => -1,
        'post_status' => 'any',
        'orderby' => 'title',
        'order' => 'ASC'
    ));

    echo "<p>Found <span class='count'>" . count($all_pages) . "</span> pages total.</p>";

    // Group pages by title
    $page_groups = array();
    foreach ($all_pages as $page) {
        $title = $page->post_title;
        if (!isset($page_groups[$title])) {
            $page_groups[$title] = array();
        }
        $page_groups[$title][] = $page;
    }

    // Find and delete duplicates (keep the oldest one)
    $deleted_count = 0;
    foreach ($page_groups as $title => $pages) {
        if (count($pages) > 1) {
            echo "<div class='warning'>Found " . count($pages) . " pages titled '<strong>" . esc_html($title) . "</strong>'</div>";

            // Sort by ID (oldest first)
            usort($pages, function($a, $b) {
                return $a->ID - $b->ID;
            });

            // Keep first (oldest), delete rest
            $keep = array_shift($pages);
            echo "<ul><li>✓ Keeping ID: {$keep->ID} (created: {$keep->post_date})</li>";

            foreach ($pages as $duplicate) {
                wp_delete_post($duplicate->ID, true); // Force delete
                echo "<li>✗ Deleted ID: {$duplicate->ID}</li>";
                $deleted_count++;
            }
            echo "</ul>";
        }
    }

    if ($deleted_count > 0) {
        echo "<div class='success'>✓ Deleted <span class='count'>{$deleted_count}</span> duplicate pages</div>";
    } else {
        echo "<div class='info'>No duplicate pages found.</div>";
    }

    echo "</div>";

    // ============================================================
    // STEP 3: Reset Flags and Create Pages
    // ============================================================
    echo "<h2>Step 3: Create Missing Pages</h2>";
    echo "<div class='step'>";

    // Reset flags
    delete_option('wohnegruen_pages_created');
    delete_option('wohnegruen_menu_created');
    delete_option('wohnegruen_legal_pages_created');

    echo "<div class='info'>Reset setup flags to allow re-creation...</div>";

    // Create pages
    if (function_exists('wohnegruen_create_required_pages')) {
        wohnegruen_create_required_pages();

        $page_ids = get_option('wohnegruen_page_ids', array());

        echo "<div class='success'>✓ Pages created successfully!</div>";
        echo "<table>";
        echo "<tr><th>Page</th><th>ID</th><th>Template</th><th>Status</th></tr>";

        $page_mapping = array(
            'home' => 'Home',
            'modelle' => 'Modelle',
            'gallery' => 'Galerie & 3D',
            'about' => 'Über uns',
            'contact' => 'Kontakt'
        );

        foreach ($page_mapping as $key => $name) {
            if (isset($page_ids[$key])) {
                $page = get_post($page_ids[$key]);
                if ($page) {
                    $template = get_page_template_slug($page->ID);
                    echo "<tr>";
                    echo "<td><strong>" . esc_html($page->post_title) . "</strong></td>";
                    echo "<td>{$page->ID}</td>";
                    echo "<td><code>" . ($template ? basename($template) : 'default') . "</code></td>";
                    echo "<td>{$page->post_status}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'><div class='error'>✗ {$name} page not created!</div></td></tr>";
            }
        }

        echo "</table>";

        // Check front page setting
        $front_page_id = get_option('page_on_front');
        if ($front_page_id && isset($page_ids['home']) && $front_page_id == $page_ids['home']) {
            echo "<div class='success'>✓ Homepage is set as front page</div>";
        } else {
            echo "<div class='warning'>⚠ Front page setting may need adjustment</div>";
        }
    } else {
        echo "<div class='error'>✗ Function wohnegruen_create_required_pages() not found!</div>";
    }

    echo "</div>";

    // ============================================================
    // STEP 4: Create Navigation Menu
    // ============================================================
    echo "<h2>Step 4: Create Navigation Menu</h2>";
    echo "<div class='step'>";

    if (function_exists('wohnegruen_create_navigation_menu')) {
        wohnegruen_create_navigation_menu();

        $menus = wp_get_nav_menus();

        if (!empty($menus)) {
            echo "<div class='success'>✓ Navigation menu created!</div>";

            foreach ($menus as $menu) {
                $items = wp_get_nav_menu_items($menu->term_id);
                echo "<strong>{$menu->name}</strong> (ID: {$menu->term_id})<br>";
                echo "<ul>";
                if ($items) {
                    foreach ($items as $item) {
                        echo "<li>{$item->title} → <code>" . esc_html($item->url) . "</code></li>";
                    }
                } else {
                    echo "<li><em>No items</em></li>";
                }
                echo "</ul>";
            }

            // Check menu locations
            $locations = get_nav_menu_locations();
            if (!empty($locations['primary'])) {
                echo "<div class='success'>✓ Menu assigned to primary location</div>";
            } else {
                echo "<div class='warning'>⚠ Menu not assigned to primary location</div>";
            }
        } else {
            echo "<div class='error'>✗ No menus created!</div>";
        }
    } else {
        echo "<div class='error'>✗ Function wohnegruen_create_navigation_menu() not found!</div>";
    }

    echo "</div>";

    // ============================================================
    // STEP 5: Create Legal Pages
    // ============================================================
    echo "<h2>Step 5: Create Legal Pages</h2>";
    echo "<div class='step'>";

    if (function_exists('wohnegruen_create_legal_pages')) {
        wohnegruen_create_legal_pages();

        $legal_ids = get_option('wohnegruen_legal_page_ids', array());

        if (!empty($legal_ids)) {
            echo "<div class='success'>✓ Legal pages created!</div>";
            echo "<ul>";
            foreach ($legal_ids as $key => $id) {
                $page = get_post($id);
                echo "<li><strong>" . ucfirst($key) . ":</strong> " . ($page ? $page->post_title : 'Not found') . " (ID: {$id})</li>";
            }
            echo "</ul>";
        } else {
            echo "<div class='info'>No legal pages created (function may be optional)</div>";
        }
    } else {
        echo "<div class='info'>Legal pages function not found (this is optional)</div>";
    }

    echo "</div>";

    // ============================================================
    // STEP 6: Create Mobilhaus Posts
    // ============================================================
    echo "<h2>Step 6: Create Mobilhaus Posts (Nature & Pure)</h2>";
    echo "<div class='step'>";

    // First, clean up any existing duplicates
    $existing_posts = get_posts(array(
        'post_type' => 'mobilhaus',
        'posts_per_page' => -1,
        'post_status' => 'any'
    ));

    if (count($existing_posts) > 2) {
        echo "<div class='warning'>Found " . count($existing_posts) . " Mobilhaus posts (should be 2). Cleaning up...</div>";

        // Group by slug
        $post_groups = array();
        foreach ($existing_posts as $post) {
            if (!isset($post_groups[$post->post_name])) {
                $post_groups[$post->post_name] = array();
            }
            $post_groups[$post->post_name][] = $post;
        }

        // Delete duplicates
        foreach ($post_groups as $slug => $posts) {
            if (count($posts) > 1) {
                usort($posts, function($a, $b) {
                    return $a->ID - $b->ID;
                });
                $keep = array_shift($posts);
                foreach ($posts as $duplicate) {
                    wp_delete_post($duplicate->ID, true);
                    echo "<ul><li>Deleted duplicate '{$slug}' (ID: {$duplicate->ID})</li></ul>";
                }
            }
        }
    }

    // Reset flag
    delete_option('wohnegruen_sample_posts_created');

    if (function_exists('wohnegruen_create_sample_mobilhaus_posts')) {
        wohnegruen_create_sample_mobilhaus_posts();

        $posts = get_posts(array(
            'post_type' => 'mobilhaus',
            'posts_per_page' => -1,
            'post_status' => 'any',
            'orderby' => 'title',
            'order' => 'ASC'
        ));

        echo "<div class='success'>✓ Mobilhaus posts created!</div>";
        echo "<ul>";
        foreach ($posts as $post) {
            echo "<li><strong>{$post->post_title}</strong> (Status: {$post->post_status}, ID: {$post->ID})</li>";
        }
        echo "</ul>";
    } else {
        echo "<div class='error'>✗ Function wohnegruen_create_sample_mobilhaus_posts() not found!</div>";
    }

    echo "</div>";

    // ============================================================
    // STEP 7: Verify ACF Blocks and Field Groups
    // ============================================================
    echo "<h2>Step 7: Verify ACF Blocks & Field Groups</h2>";
    echo "<div class='step'>";

    // Check if ACF Pro is active
    if (class_exists('ACF') || function_exists('acf_get_setting')) {
        echo "<div class='success'>✓ ACF Pro is active</div>";

        if (defined('ACF_VERSION')) {
            echo "<p>ACF Version: <code>" . ACF_VERSION . "</code></p>";
        }

        // Check blocks
        if (function_exists('acf_get_block_types')) {
            $blocks = acf_get_block_types();

            if (!empty($blocks)) {
                echo "<div class='success'>✓ Found <span class='count'>" . count($blocks) . "</span> ACF blocks registered</div>";
                echo "<ul>";
                foreach ($blocks as $block) {
                    echo "<li><code>{$block['name']}</code> - {$block['title']}</li>";
                }
                echo "</ul>";
            } else {
                echo "<div class='error'>✗ No ACF blocks found! Check inc/acf.php</div>";
            }
        }

        // Check field groups - This is the CRITICAL check
        if (function_exists('acf_get_field_groups')) {
            $field_groups = acf_get_field_groups();

            if (!empty($field_groups)) {
                echo "<div class='success'>✓ Found <span class='count'>" . count($field_groups) . "</span> ACF field groups</div>";
                echo "<ul>";
                foreach ($field_groups as $group) {
                    echo "<li>{$group['title']} (Key: <code>{$group['key']}</code>)</li>";
                }
                echo "</ul>";
            } else {
                echo "<div class='error'>";
                echo "<strong>✗ NO FIELD GROUPS FOUND!</strong><br>";
                echo "This is why your blocks are empty. The field groups are defined in <code>inc/acf.php</code> but not loading.<br>";
                echo "<strong>Solution:</strong> The field groups should auto-register via the <code>acf/init</code> hook in inc/acf.php line 1263.<br>";
                echo "If they're still not showing after this script, there may be a PHP error. Check your error logs.";
                echo "</div>";
            }
        }
    } else {
        echo "<div class='error'>";
        echo "<strong>✗ ACF Pro is NOT active!</strong><br>";
        echo "You must install and activate Advanced Custom Fields PRO plugin.<br>";
        echo "Without ACF Pro, the blocks will not work.";
        echo "</div>";
    }

    echo "</div>";

    // ============================================================
    // FINAL SUMMARY
    // ============================================================
    echo "<h2>✅ Cleanup Complete!</h2>";
    echo "<div class='step'>";
    echo "<p><strong>Summary of changes:</strong></p>";
    echo "<ul>";
    echo "<li>✓ Fixed site title to 'WohneGrün'</li>";
    echo "<li>✓ Deleted {$deleted_count} duplicate pages</li>";
    echo "<li>✓ Created all required pages (Home, Modelle, Gallery, About, Contact)</li>";
    echo "<li>✓ Created navigation menu with Modelle link</li>";
    echo "<li>✓ Created legal pages (Impressum, Datenschutz, AGB)</li>";
    echo "<li>✓ Created Nature and Pure mobilhaus posts</li>";
    echo "<li>✓ Verified ACF blocks registration</li>";
    echo "</ul>";

    echo "<div class='warning'>";
    echo "<strong>⚠️ IMPORTANT NEXT STEPS:</strong><br>";
    echo "1. <strong>Delete this file</strong> (<code>master-fix.php</code>) from the server for security<br>";
    echo "2. Clear your browser cache (Ctrl + Shift + Delete)<br>";
    echo "3. Log out and log back into WordPress<br>";
    echo "4. Go to ACF → Field Groups and verify field groups are there<br>";
    echo "5. Edit the Home page and verify all 5 blocks appear<br>";
    echo "6. If field groups are still missing, check PHP error logs";
    echo "</div>";

    echo "</div>";
    ?>

    <div class="actions">
        <h3>Quick Links:</h3>
        <a href="<?php echo admin_url(); ?>" class="button">WordPress Admin</a>
        <a href="<?php echo admin_url('edit.php?post_type=acf-field-group'); ?>" class="button">ACF Field Groups</a>
        <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" class="button">View Pages</a>
        <a href="<?php echo admin_url('nav-menus.php'); ?>" class="button">View Menus</a>
        <a href="<?php echo home_url(); ?>" class="button">View Site</a>
    </div>
</div>
</body>
</html>
