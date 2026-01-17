<?php
/**
 * Quick test to check if blocks are registered
 *
 * Visit: https://xn--wohnegrn-d6a.at/wp-content/themes/WohneGruen/test-blocks.php
 */

require_once('../../../wp-load.php');

header('Content-Type: text/plain; charset=utf-8');

echo "=== ACF BLOCKS TEST ===\n\n";

// Test 1: Is ACF active?
echo "1. ACF Plugin Active: ";
if (class_exists('ACF') || class_exists('acf_pro')) {
    echo "YES\n";
    if (defined('ACF_VERSION')) {
        echo "   Version: " . ACF_VERSION . "\n";
    }
} else {
    echo "NO - THIS IS THE PROBLEM!\n";
}

echo "\n";

// Test 2: Can we register block types?
echo "2. acf_register_block_type() available: ";
echo function_exists('acf_register_block_type') ? "YES\n" : "NO\n";

echo "\n";

// Test 3: Are blocks registered?
echo "3. Registered ACF Blocks:\n";
if (function_exists('acf_get_block_types')) {
    $blocks = acf_get_block_types();
    if (empty($blocks)) {
        echo "   NO BLOCKS FOUND!\n";
        echo "   This means wohnegruen_register_acf_blocks() didn't run or failed.\n";
    } else {
        echo "   Found " . count($blocks) . " blocks:\n";
        foreach ($blocks as $block) {
            echo "   - " . $block['name'] . " (" . $block['title'] . ")\n";
        }
    }
} else {
    echo "   Cannot check - acf_get_block_types() not available\n";
}

echo "\n";

// Test 4: Is our registration function defined?
echo "4. wohnegruen_register_acf_blocks() exists: ";
echo function_exists('wohnegruen_register_acf_blocks') ? "YES\n" : "NO - inc/acf.php not loaded!\n";

echo "\n";

// Test 5: Block categories
echo "5. Block Categories:\n";
$post = get_post(get_option('page_on_front'));
if ($post) {
    $categories = get_block_categories($post);
    $found_wohnegruen = false;
    foreach ($categories as $cat) {
        if ($cat['slug'] === 'wohnegruen') {
            echo "   ✓ WohneGrün category found!\n";
            $found_wohnegruen = true;
        }
    }
    if (!$found_wohnegruen) {
        echo "   ✗ WohneGrün category NOT found\n";
        echo "   Available categories:\n";
        foreach ($categories as $cat) {
            echo "      - " . $cat['slug'] . " (" . $cat['title'] . ")\n";
        }
    }
} else {
    echo "   Cannot test - no front page set\n";
}

echo "\n";

// Test 6: Check hooks
echo "6. Hook Tests:\n";
global $wp_filter;
echo "   acf/init hook registered: " . (isset($wp_filter['acf/init']) ? "YES" : "NO") . "\n";
echo "   block_categories_all hook registered: " . (isset($wp_filter['block_categories_all']) ? "YES" : "NO") . "\n";

echo "\n=== END TEST ===\n";
