<?php
/**
 * Theme Setup and Configuration
 */

if (!defined('ABSPATH')) exit;

/**
 * Theme Setup
 */
function alpenhomes_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('editor-styles');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'alpenhomes'),
        'footer'  => __('Footer Menu', 'alpenhomes'),
    ));
}
add_action('after_setup_theme', 'alpenhomes_setup');

/**
 * Custom Menu Walker for Navigation
 */
class Alpenhomes_Nav_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= '<a href="' . esc_url($item->url) . '"' . $class_names . '>' . esc_html($item->title) . '</a>';
    }
}

/**
 * Get SVG Icon
 */
function alpenhomes_get_icon($icon_name) {
    $icons = array(
        'phone' => '<svg xmlns="http://www.w3.org/2000/svg" ...></svg>',
        'email' => '<svg xmlns="http://www.w3.org/2000/svg" ...></svg>',
        'location' => '<svg xmlns="http://www.w3.org/2000/svg" ...></svg>',
        'clock' => '<svg xmlns="http://www.w3.org/2000/svg" ...></svg>',
        'check' => '<svg xmlns="http://www.w3.org/2000/svg" ...></svg>',
        'arrow-right' => '<svg xmlns="http://www.w3.org/2000/svg" ...></svg>',
        'home' => '<svg xmlns="http://www.w3.org/2000/svg" ...></svg>',
        'size' => '<svg xmlns="http://www.w3.org/2000/svg" ...></svg>',
        'rooms' => '<svg xmlns="http://www.w3.org/2000/svg" ...></svg>',
        'users' => '<svg xmlns="http://www.w3.org/2000/svg" ...></svg>',
        'shield' => '<svg xmlns="http://www.w3.org/2000/svg" ...></svg>',
        'star' => '<svg xmlns="http://www.w3.org/2000/svg" ...></svg>',
        'truck' => '<svg xmlns="http://www.w3.org/2000/svg" ...></svg>',
        'tools' => '<svg xmlns="http://www.w3.org/2000/svg" ...></svg>',
        'leaf' => '<svg xmlns="http://www.w3.org/2000/svg" ...></svg>',
        'play' => '<svg xmlns="http://www.w3.org/2000/svg" ...></svg>',
        'cube' => '<svg xmlns="http://www.w3.org/2000/svg" ...></svg>',
        'expand' => '<svg xmlns="http://www.w3.org/2000/svg" ...></svg>',
        'grid' => '<svg xmlns="http://www.w3.org/2000/svg" ...></svg>',
    );

    return isset($icons[$icon_name]) ? $icons[$icon_name] : '';
}

/**
 * Shortcode for icons
 */
function alpenhomes_icon_shortcode($atts) {
    $atts = shortcode_atts(array(
        'name' => 'check',
    ), $atts);

    return alpenhomes_get_icon($atts['name']);
}
add_shortcode('icon', 'alpenhomes_icon_shortcode');

/**
 * Helper function to get ACF field with fallback
 */
function alpenhomes_get_field($field_name, $post_id = false, $default = '') {
    if (function_exists('get_field')) {
        $value = get_field($field_name, $post_id);
        return ($value !== null && $value !== false && $value !== '') ? $value : $default;
    }
    return $default;
}

function alpenhomes_get_option($field_name, $default = '') {
    return alpenhomes_get_field($field_name, 'option', $default);
}
