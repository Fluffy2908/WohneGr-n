<?php
/**
 * Enqueue Scripts and Styles
 */

if (!defined('ABSPATH')) exit;

/**
 * Enqueue frontend styles and scripts
 */
function wohnegruen_scripts() {
    // Google Fonts - Outfit + DM Sans
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=DM+Sans:wght@400;500;600&display=swap', array(), null);

    // Main stylesheet - ONLY ONE, CLEAN, NO OVERRIDES
    wp_enqueue_style('wohnegruen-style', get_stylesheet_uri(), array(), '2.0.0');

    // Main JavaScript - CLEAN, NO DEPENDENCIES
    wp_enqueue_script('wohnegruen-main', get_template_directory_uri() . '/assets/js/main.js', array(), '2.0.0', true);
}
add_action('wp_enqueue_scripts', 'wohnegruen_scripts');

// Editor uses main stylesheet via enqueue_block_editor_assets

/**
 * Enqueue block editor assets
 */
function wohnegruen_block_editor_assets() {
    wp_enqueue_style('wohnegruen-editor', get_stylesheet_uri(), array(), '2.0.0');
}
add_action('enqueue_block_editor_assets', 'wohnegruen_block_editor_assets');
