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

    // Main stylesheet
    wp_enqueue_style('wohnegruen-style', get_stylesheet_uri(), array(), '1.0.1');
    wp_enqueue_style('wohnegruen-main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.1');
    wp_enqueue_style('wohnegruen-blocks', get_template_directory_uri() . '/assets/css/blocks.css', array(), '1.0.1');

    // Main JavaScript
    wp_enqueue_script('wohnegruen-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.1', true);

    // Localize script with theme data
    wp_localize_script('wohnegruen-main', 'wohnegruenData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'themeUrl' => get_template_directory_uri(),
        'homeUrl'  => home_url('/'),
    ));
}
add_action('wp_enqueue_scripts', 'wohnegruen_scripts');

/**
 * Enqueue editor styles for Gutenberg
 */
function wohnegruen_editor_styles() {
    add_editor_style('assets/css/editor-style.css');
}
add_action('after_setup_theme', 'wohnegruen_editor_styles');

/**
 * Enqueue block editor assets
 */
function wohnegruen_block_editor_assets() {
    wp_enqueue_style('wohnegruen-editor', get_template_directory_uri() . '/assets/css/editor-style.css', array(), '1.0.1');
    wp_enqueue_style('wohnegruen-blocks-editor', get_template_directory_uri() . '/assets/css/blocks.css', array(), '1.0.1');
    wp_enqueue_style('wohnegruen-main-editor', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.1');
}
add_action('enqueue_block_editor_assets', 'wohnegruen_block_editor_assets');
