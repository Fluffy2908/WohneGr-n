<?php
/**
 * RUN THEME SETUP - One-Time Execution Script
 *
 * This script manually runs all the theme setup functions that should have run
 * when the theme was activated.
 *
 * USAGE: https://wohnegrün.at/wp-content/themes/WohneGruen/run-setup.php
 */

// Load WordPress
require_once('../../../wp-load.php');

// Load theme functions
require_once('inc/theme.php');
require_once('inc/sample-data.php');

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Theme Setup Runner</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 { color: #2d7c42; }
        h2 {
            color: #1e5a38;
            border-bottom: 2px solid #2d7c42;
            padding-bottom: 10px;
            margin-top: 30px;
        }
        .step {
            background: #f8f9fa;
            padding: 15px;
            margin: 15px 0;
            border-left: 4px solid #2d7c42;
            border-radius: 4px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
        }
        .info {
            background: #d1ecf1;
            color: #0c5460;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
        }
        code {
            background: #f4f4f4;
            padding: 2px 6px;
            border-radius: 3px;
        }
        ul { line-height: 1.8; }
        .actions {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #ddd;
        }
        a.button {
            display: inline-block;
            background: #2d7c42;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px;
        }
        a.button:hover { background: #1e5a38; }
    </style>
</head>
<body>
<div class="container">
    <h1>🚀 WohneGrün Theme Setup Runner</h1>
    <p><strong>Running all setup functions manually...</strong></p>

    <?php
    // STEP 1: Reset flags to allow re-running
    echo "<h2>Step 1: Reset Setup Flags</h2>";
    echo "<div class='step'>";

    delete_option('wohnegruen_pages_created');
    delete_option('wohnegruen_menu_created');
    delete_option('wohnegruen_sample_posts_created');

    echo "<div class='success'>✓ Setup flags reset - functions can now run</div>";
    echo "</div>";

    // STEP 2: Create Pages
    echo "<h2>Step 2: Create Pages</h2>";
    echo "<div class='step'>";

    if (function_exists('wohnegruen_create_required_pages')) {
        wohnegruen_create_required_pages();

        $page_ids = get_option('wohnegruen_page_ids', array());

        echo "<div class='success'>✓ Pages created successfully!</div>";
        echo "<ul>";

        if (isset($page_ids['home'])) {
            $home = get_post($page_ids['home']);
            echo "<li><strong>Home:</strong> " . ($home ? $home->post_title : 'Not found') . " (ID: {$page_ids['home']})</li>";
        }
        if (isset($page_ids['modelle'])) {
            $modelle = get_post($page_ids['modelle']);
            echo "<li><strong>Modelle:</strong> " . ($modelle ? $modelle->post_title : 'Not found') . " (ID: {$page_ids['modelle']})</li>";
        }
        if (isset($page_ids['gallery'])) {
            $gallery = get_post($page_ids['gallery']);
            echo "<li><strong>Gallery:</strong> " . ($gallery ? $gallery->post_title : 'Not found') . " (ID: {$page_ids['gallery']})</li>";
        }
        if (isset($page_ids['about'])) {
            $about = get_post($page_ids['about']);
            echo "<li><strong>About:</strong> " . ($about ? $about->post_title : 'Not found') . " (ID: {$page_ids['about']})</li>";
        }
        if (isset($page_ids['contact'])) {
            $contact = get_post($page_ids['contact']);
            echo "<li><strong>Contact:</strong> " . ($contact ? $contact->post_title : 'Not found') . " (ID: {$page_ids['contact']})</li>";
        }

        echo "</ul>";
    } else {
        echo "<div class='error'>✗ Function wohnegruen_create_required_pages() not found!</div>";
    }

    echo "</div>";

    // STEP 3: Create Navigation Menu
    echo "<h2>Step 3: Create Navigation Menu</h2>";
    echo "<div class='step'>";

    if (function_exists('wohnegruen_create_navigation_menu')) {
        wohnegruen_create_navigation_menu();

        $menus = wp_get_nav_menus();

        if (!empty($menus)) {
            echo "<div class='success'>✓ Menu created successfully!</div>";

            foreach ($menus as $menu) {
                $items = wp_get_nav_menu_items($menu->term_id);
                echo "<strong>{$menu->name}</strong> (ID: {$menu->term_id})<br>";
                echo "<ul>";
                if ($items) {
                    foreach ($items as $item) {
                        echo "<li>{$item->title}</li>";
                    }
                }
                echo "</ul>";
            }
        } else {
            echo "<div class='error'>✗ No menus found after creation!</div>";
        }
    } else {
        echo "<div class='error'>✗ Function wohnegruen_create_navigation_menu() not found!</div>";
    }

    echo "</div>";

    // STEP 4: Create Legal Pages
    echo "<h2>Step 4: Create Legal Pages</h2>";
    echo "<div class='step'>";

    if (function_exists('wohnegruen_create_legal_pages')) {
        wohnegruen_create_legal_pages();

        $legal_ids = get_option('wohnegruen_legal_page_ids', array());

        echo "<div class='success'>✓ Legal pages created successfully!</div>";
        echo "<ul>";

        foreach ($legal_ids as $key => $id) {
            $page = get_post($id);
            echo "<li><strong>" . ucfirst($key) . ":</strong> " . ($page ? $page->post_title : 'Not found') . " (ID: {$id})</li>";
        }

        echo "</ul>";
    } else {
        echo "<div class='info'>ℹ Legal pages function not found (may not exist)</div>";
    }

    echo "</div>";

    // STEP 5: Create Sample Mobilhaus Posts
    echo "<h2>Step 5: Create Mobilhaus Posts (Nature & Pure)</h2>";
    echo "<div class='step'>";

    if (function_exists('wohnegruen_create_sample_mobilhaus_posts')) {
        wohnegruen_create_sample_mobilhaus_posts();

        $posts = get_posts(array(
            'post_type' => 'mobilhaus',
            'posts_per_page' => -1,
            'post_status' => 'any'
        ));

        echo "<div class='success'>✓ Mobilhaus posts created successfully!</div>";
        echo "<ul>";

        foreach ($posts as $post) {
            echo "<li><strong>{$post->post_title}</strong> (Status: {$post->post_status}, ID: {$post->ID})</li>";
        }

        echo "</ul>";
    } else {
        echo "<div class='error'>✗ Function wohnegruen_create_sample_mobilhaus_posts() not found!</div>";
    }

    echo "</div>";

    // STEP 6: Verify ACF Blocks
    echo "<h2>Step 6: Check ACF Blocks</h2>";
    echo "<div class='step'>";

    if (function_exists('acf_get_block_types')) {
        $blocks = acf_get_block_types();

        if (!empty($blocks)) {
            echo "<div class='success'>✓ Found " . count($blocks) . " ACF blocks registered</div>";
            echo "<ul>";
            foreach ($blocks as $block) {
                echo "<li><code>{$block['name']}</code> - {$block['title']}</li>";
            }
            echo "</ul>";
        } else {
            echo "<div class='error'>✗ No ACF blocks found!</div>";
        }
    } else {
        echo "<div class='error'>✗ ACF Pro is not active!</div>";
    }

    echo "</div>";

    // Summary
    echo "<h2>✅ Setup Complete!</h2>";
    echo "<div class='info'>";
    echo "<strong>What was done:</strong><ul>";
    echo "<li>Created all required pages (Home, Modelle, Gallery, About, Contact)</li>";
    echo "<li>Created navigation menu with Modelle link</li>";
    echo "<li>Created legal pages (Impressum, Datenschutz, AGB)</li>";
    echo "<li>Created Nature and Pure model posts</li>";
    echo "<li>Verified ACF blocks are registered</li>";
    echo "</ul>";
    echo "<p><strong>⚠️ IMPORTANT:</strong> Delete this file (<code>run-setup.php</code>) from the server after use!</p>";
    echo "</div>";
    ?>

    <div class="actions">
        <h3>Next Steps:</h3>
        <a href="<?php echo admin_url(); ?>" class="button">Go to WordPress Admin</a>
        <a href="<?php echo admin_url('nav-menus.php'); ?>" class="button">View Menus</a>
        <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" class="button">View Pages</a>
        <a href="<?php echo home_url(); ?>" class="button">View Site</a>
    </div>
</div>
</body>
</html>
