<?php
/**
 * SITE STATUS CHECKER
 *
 * Shows exactly what was created by the setup script
 *
 * USAGE: https://xn--wohnegrn-d6a.at/wp-content/themes/WohneGruen/check-site.php
 */

require_once('../../../wp-load.php');

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Site Status Check</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; }
        h1 { color: #2d7c42; }
        h2 { color: #1e5a38; border-bottom: 2px solid #2d7c42; padding-bottom: 10px; margin-top: 30px; }
        .good { color: green; font-weight: bold; }
        .bad { color: red; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background: #2d7c42; color: white; }
        code { background: #f4f4f4; padding: 2px 6px; border-radius: 3px; }
        .section { margin: 20px 0; padding: 15px; background: #f8f9fa; border-radius: 5px; }
    </style>
</head>
<body>
<div class="container">
    <h1>🔍 WohneGrün Site Status Check</h1>
    <p>Generated: <?php echo date('Y-m-d H:i:s'); ?></p>

    <h2>1. Pages Created</h2>
    <?php
    $pages = get_pages();
    echo "<p>Total pages found: <strong>" . count($pages) . "</strong></p>";

    if (count($pages) > 0) {
        echo "<table><tr><th>Page Title</th><th>Status</th><th>Template</th><th>ID</th></tr>";
        foreach ($pages as $page) {
            $template = get_page_template_slug($page->ID);
            echo "<tr>";
            echo "<td>" . esc_html($page->post_title) . "</td>";
            echo "<td>" . esc_html($page->post_status) . "</td>";
            echo "<td><code>" . ($template ? $template : 'default') . "</code></td>";
            echo "<td>" . $page->ID . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p class='bad'>❌ NO PAGES FOUND!</p>";
    }

    $front_page = get_option('page_on_front');
    echo "<div class='section'>";
    echo "<strong>Front Page Setting:</strong> ";
    if ($front_page) {
        echo "<span class='good'>✓ Page ID $front_page is set as front page</span>";
    } else {
        echo "<span class='bad'>✗ No front page set (showing blog posts)</span>";
    }
    echo "</div>";
    ?>

    <h2>2. Uploaded Images</h2>
    <?php
    $images = get_posts(array(
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'posts_per_page' => -1,
        'post_status' => 'any'
    ));

    echo "<p>Total images in Media Library: <strong>" . count($images) . "</strong></p>";

    if (count($images) > 0) {
        echo "<div class='section'>";
        echo "<strong>Recent images:</strong><ul>";
        foreach (array_slice($images, 0, 10) as $img) {
            echo "<li>" . esc_html($img->post_title) . " <code>(" . basename(get_attached_file($img->ID)) . ")</code></li>";
        }
        echo "</ul>";
        if (count($images) > 10) {
            echo "<p>... and " . (count($images) - 10) . " more</p>";
        }
        echo "</div>";
    } else {
        echo "<p class='bad'>❌ NO IMAGES UPLOADED!</p>";
    }
    ?>

    <h2>3. Navigation Menus</h2>
    <?php
    $menus = wp_get_nav_menus();
    echo "<p>Total menus: <strong>" . count($menus) . "</strong></p>";

    if (count($menus) > 0) {
        foreach ($menus as $menu) {
            $items = wp_get_nav_menu_items($menu->term_id);
            echo "<div class='section'>";
            echo "<strong>" . esc_html($menu->name) . "</strong> (ID: $menu->term_id)<br>";
            echo "Items: " . count($items) . "<br>";

            if ($items) {
                echo "<ul>";
                foreach ($items as $item) {
                    echo "<li>" . esc_html($item->title) . " → <code>" . esc_html($item->url) . "</code></li>";
                }
                echo "</ul>";
            }
            echo "</div>";
        }

        $locations = get_nav_menu_locations();
        echo "<div class='section'>";
        echo "<strong>Menu Locations:</strong><br>";
        if (!empty($locations)) {
            foreach ($locations as $location => $menu_id) {
                $menu = wp_get_nav_menu_object($menu_id);
                echo "- <strong>$location:</strong> " . ($menu ? $menu->name : 'Not assigned') . "<br>";
            }
        } else {
            echo "<span class='bad'>No menus assigned to locations</span>";
        }
        echo "</div>";
    } else {
        echo "<p class='bad'>❌ NO MENUS FOUND!</p>";
    }
    ?>

    <h2>4. Mobilhaus Posts (Nature & Pure)</h2>
    <?php
    $posts = get_posts(array(
        'post_type' => 'mobilhaus',
        'posts_per_page' => -1,
        'post_status' => 'any'
    ));

    echo "<p>Total Mobilhaus posts: <strong>" . count($posts) . "</strong></p>";

    if (count($posts) > 0) {
        echo "<table><tr><th>Title</th><th>Status</th><th>Date</th></tr>";
        foreach ($posts as $post) {
            echo "<tr>";
            echo "<td>" . esc_html($post->post_title) . "</td>";
            echo "<td>" . esc_html($post->post_status) . "</td>";
            echo "<td>" . esc_html($post->post_date) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p class='bad'>❌ NO MOBILHAUS POSTS FOUND!</p>";
    }
    ?>

    <h2>5. Setup Options Check</h2>
    <div class='section'>
    <?php
    $setup_flags = array(
        'wohnegruen_pages_created' => 'Pages creation flag',
        'wohnegruen_menu_created' => 'Menu creation flag',
        'wohnegruen_legal_pages_created' => 'Legal pages flag',
        'wohnegruen_sample_posts_created' => 'Sample posts flag',
        'wohnegruen_page_ids' => 'Page IDs storage',
        'wohnegruen_legal_page_ids' => 'Legal page IDs storage'
    );

    foreach ($setup_flags as $option => $label) {
        $value = get_option($option);
        echo "<strong>$label:</strong> ";
        if ($value) {
            echo "<span class='good'>✓ Set</span>";
            if (is_array($value)) {
                echo " <code>" . json_encode($value) . "</code>";
            } else {
                echo " <code>" . esc_html($value) . "</code>";
            }
        } else {
            echo "<span class='bad'>✗ Not set</span>";
        }
        echo "<br>";
    }
    ?>
    </div>

    <h2>6. ACF Plugin Status</h2>
    <div class='section'>
    <?php
    if (class_exists('ACF') || class_exists('acf_pro')) {
        echo "<span class='good'>✓ ACF Plugin Active</span><br>";
        if (defined('ACF_VERSION')) {
            echo "Version: <code>" . ACF_VERSION . "</code><br>";
        }

        if (function_exists('acf_get_block_types')) {
            $blocks = acf_get_block_types();
            echo "Registered Blocks: <strong>" . count($blocks) . "</strong><br>";
        }
    } else {
        echo "<span class='bad'>✗ ACF Plugin NOT Active</span><br>";
    }
    ?>
    </div>

    <h2>7. What Needs to Be Done?</h2>
    <div class='section'>
    <?php
    $issues = array();

    if (count($pages) == 0) {
        $issues[] = "Create pages (Home, Modelle, etc.)";
    }

    if (count($images) == 0) {
        $issues[] = "Upload images to Media Library";
    }

    if (count($menus) == 0) {
        $issues[] = "Create navigation menu";
    }

    if (count($posts) == 0) {
        $issues[] = "Create Nature & Pure posts";
    }

    if (!$front_page) {
        $issues[] = "Set front page in Settings → Reading";
    }

    if (empty($issues)) {
        echo "<p class='good'>✅ Everything looks good!</p>";
    } else {
        echo "<p><strong>Issues found:</strong></p><ol>";
        foreach ($issues as $issue) {
            echo "<li>" . esc_html($issue) . "</li>";
        }
        echo "</ol>";

        echo "<p><strong>Next step:</strong> Re-run the setup script or create manually.</p>";
    }
    ?>
    </div>

    <h2>Quick Actions</h2>
    <div class='section'>
        <a href="<?php echo admin_url(); ?>">WordPress Admin</a> |
        <a href="<?php echo admin_url('edit.php?post_type=page'); ?>">Pages</a> |
        <a href="<?php echo admin_url('upload.php'); ?>">Media</a> |
        <a href="<?php echo admin_url('nav-menus.php'); ?>">Menus</a> |
        <a href="<?php echo home_url(); ?>">View Site</a>
    </div>

</div>
</body>
</html>
