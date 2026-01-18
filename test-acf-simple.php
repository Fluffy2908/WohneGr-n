<?php
/**
 * Simple ACF Test - Register ONE block to test
 */

// Load WordPress
require_once('../../../wp-load.php');

if (!current_user_can('manage_options')) {
    wp_die('Access denied.');
}

echo '<h1>ACF Simple Test</h1>';

// Test 1: Is ACF loaded?
echo '<h2>Test 1: ACF Loaded?</h2>';
if (class_exists('ACF')) {
    echo '✓ ACF class exists<br>';
} else {
    echo '✗ ACF class NOT found<br>';
}

// Test 2: Is ACF Pro loaded?
echo '<h2>Test 2: ACF Pro?</h2>';
if (function_exists('acf_register_block_type')) {
    echo '✓ acf_register_block_type() exists<br>';
} else {
    echo '✗ acf_register_block_type() NOT found - need ACF PRO!<br>';
}

// Test 3: Try to register a simple block
echo '<h2>Test 3: Register Test Block</h2>';
if (function_exists('acf_register_block_type')) {
    try {
        acf_register_block_type(array(
            'name'              => 'test-block',
            'title'             => 'Test Block',
            'description'       => 'A simple test block',
            'render_template'   => 'template-parts/blocks/block-hero.php',
            'category'          => 'common',
            'icon'              => 'admin-comments',
            'keywords'          => array('test'),
        ));
        echo '✓ Test block registered successfully<br>';
    } catch (Exception $e) {
        echo '✗ Error: ' . $e->getMessage() . '<br>';
    }
} else {
    echo '✗ Cannot register - ACF Pro not loaded<br>';
}

// Test 4: Check if our function exists
echo '<h2>Test 4: Theme Functions</h2>';
if (function_exists('wohnegruen_register_acf_blocks')) {
    echo '✓ wohnegruen_register_acf_blocks() exists<br>';

    // Try calling it
    try {
        wohnegruen_register_acf_blocks();
        echo '✓ Function executed without errors<br>';
    } catch (Exception $e) {
        echo '✗ Error when calling: ' . $e->getMessage() . '<br>';
    }
} else {
    echo '✗ wohnegruen_register_acf_blocks() NOT found<br>';
}

// Test 5: Get registered blocks
echo '<h2>Test 5: Registered Blocks</h2>';
if (function_exists('acf_get_block_types')) {
    $blocks = acf_get_block_types();
    if (!empty($blocks)) {
        echo '✓ Found ' . count($blocks) . ' registered blocks:<br>';
        foreach ($blocks as $block) {
            echo '- ' . $block['name'] . ' (' . $block['title'] . ')<br>';
        }
    } else {
        echo '✗ NO blocks registered!<br>';
    }
} else {
    echo '✗ acf_get_block_types() not available<br>';
}

// Test 6: Check hooks
echo '<h2>Test 6: Hooked Functions</h2>';
global $wp_filter;
if (isset($wp_filter['acf/init'])) {
    echo '✓ acf/init hook exists<br>';
    echo 'Functions hooked to acf/init:<br>';
    foreach ($wp_filter['acf/init']->callbacks as $priority => $callbacks) {
        foreach ($callbacks as $callback) {
            if (is_array($callback['function'])) {
                echo '- Priority ' . $priority . ': ' . get_class($callback['function'][0]) . '::' . $callback['function'][1] . '<br>';
            } else {
                echo '- Priority ' . $priority . ': ' . $callback['function'] . '<br>';
            }
        }
    }
} else {
    echo '✗ acf/init hook NOT found<br>';
}

echo '<hr>';
echo '<h2>Recommendation:</h2>';
if (!function_exists('acf_register_block_type')) {
    echo '<p style="color: red; font-weight: bold;">INSTALL ACF PRO PLUGIN! Blocks require ACF Pro, not the free version.</p>';
} elseif (empty($blocks)) {
    echo '<p style="color: orange;">Blocks function exists but no blocks are registered. Check if wohnegruen_register_acf_blocks() is being called.</p>';
} else {
    echo '<p style="color: green;">ACF is working and blocks are registered!</p>';
}

echo '<hr>';
echo '<a href="' . admin_url() . '">Go to WordPress Admin</a>';
