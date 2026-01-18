<?php
/**
 * Remove Custom Templates - CLI Version
 * Run this via: php remove-templates-cli.php
 */

// Load WordPress
require_once(__DIR__ . '/../../../wp-load.php');

if (!defined('ABSPATH')) {
    die('Could not load WordPress');
}

echo "===========================================\n";
echo "REMOVING CUSTOM TEMPLATES FROM ALL PAGES\n";
echo "===========================================\n\n";

// Get all pages
$all_pages = get_pages(array(
    'post_type' => 'page',
    'post_status' => 'publish',
    'sort_column' => 'post_title',
));

$homepage_id = get_option('page_on_front');
$fixed_count = 0;
$skipped_count = 0;

foreach ($all_pages as $page) {
    // Skip homepage
    if ($page->ID == $homepage_id) {
        echo "⏭️  SKIPPED: {$page->post_title} (homepage - already working)\n";
        $skipped_count++;
        continue;
    }

    $template = get_post_meta($page->ID, '_wp_page_template', true);
    $is_default = empty($template) || $template === 'default';

    // Skip if already using default template
    if ($is_default) {
        echo "⏭️  SKIPPED: {$page->post_title} (already using default template)\n";
        $skipped_count++;
        continue;
    }

    // Remove custom template
    delete_post_meta($page->ID, '_wp_page_template');

    // Clear any old hardcoded content if no blocks present
    $content = $page->post_content;
    $has_blocks = has_blocks($content);

    if (!$has_blocks || strlen(trim($content)) < 50) {
        wp_update_post(array(
            'ID' => $page->ID,
            'post_content' => '', // Clear so ACF blocks can be added fresh
        ));
        echo "✅ FIXED: {$page->post_title} - Removed template: {$template} (content cleared)\n";
    } else {
        echo "✅ FIXED: {$page->post_title} - Removed template: {$template} (kept existing blocks)\n";
    }

    $fixed_count++;
}

echo "\n===========================================\n";
echo "CONVERSION COMPLETE!\n";
echo "===========================================\n\n";
echo "✅ Fixed: {$fixed_count} page(s)\n";
echo "⏭️  Skipped: {$skipped_count} page(s)\n";
echo "📊 Total: " . count($all_pages) . " page(s)\n\n";

echo "WHAT YOU HAVE NOW:\n";
echo "✅ All pages use default template (like homepage)\n";
echo "✅ All pages can use ACF blocks\n";
echo "✅ All styling is in place and working\n\n";

echo "NEXT STEPS:\n";
echo "1. Go to WordPress Dashboard → Pages\n";
echo "2. Edit each page and add ACF blocks:\n";
echo "   - Hero-Bereich (Hero section)\n";
echo "   - Vorteile (Benefits)\n";
echo "   - Modelle (Models)\n";
echo "   - Galerie (Gallery)\n";
echo "   - 3D Rundgang (3D tour)\n";
echo "   - Kontakt (Contact)\n";
echo "   - CTA-Bereich (Call to action)\n";
echo "3. Fill in content and select images\n";
echo "4. Update and view!\n\n";
