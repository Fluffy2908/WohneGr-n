<?php
/**
 * Theme Setup and Configuration
 */

if (!defined('ABSPATH')) exit;

/**
 * Theme Setup
 */
function wohnegruen_setup() {
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
        'primary' => __('Primary Menu', 'wohnegruen'),
        'footer'  => __('Footer Menu', 'wohnegruen'),
    ));
}
add_action('after_setup_theme', 'wohnegruen_setup');

/**
 * Custom Menu Walker for Navigation
 */
class wohnegruen_Nav_Walker extends Walker_Nav_Menu {
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
function wohnegruen_get_icon($icon_name) {
    $icons = array(
        'phone' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>',
        'email' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>',
        'location' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>',
        'clock' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>',
        'check' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>',
        'arrow-right' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
        'home' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>',
        'size' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>',
        'rooms' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>',
        'users' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>',
        'shield' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>',
        'star' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>',
        'truck' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>',
        'tools' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>',
        'leaf' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"></path><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"></path></svg>',
        'play' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>',
        'cube' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>',
        'expand' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 3 21 3 21 9"></polyline><polyline points="9 21 3 21 3 15"></polyline><line x1="21" y1="3" x2="14" y2="10"></line><line x1="3" y1="21" x2="10" y2="14"></line></svg>',
        'grid' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>',
    );

    return isset($icons[$icon_name]) ? $icons[$icon_name] : '';
}

/**
 * Shortcode for icons
 */
function wohnegruen_icon_shortcode($atts) {
    $atts = shortcode_atts(array(
        'name' => 'check',
    ), $atts);

    return wohnegruen_get_icon($atts['name']);
}
add_shortcode('icon', 'wohnegruen_icon_shortcode');

/**
 * Helper function to get ACF field with fallback
 */
function wohnegruen_get_field($field_name, $post_id = false, $default = '') {
    if (function_exists('get_field')) {
        $value = get_field($field_name, $post_id);
        return ($value !== null && $value !== false && $value !== '') ? $value : $default;
    }
    return $default;
}

function wohnegruen_get_option($field_name, $default = '') {
    return wohnegruen_get_field($field_name, 'option', $default);
}

/**
 * Create required pages on theme activation
 */
function wohnegruen_create_required_pages() {
    // Check if already created
    if (get_option('wohnegruen_pages_created')) {
        return;
    }

    // 1. Create Home Page with Gutenberg blocks
    $home_id = wp_insert_post(array(
        'post_title'    => 'Home',
        'post_name'     => 'home',
        'post_content'  => '', // Will add blocks separately
        'post_status'   => 'publish',
        'post_type'     => 'page',
    ));

    if ($home_id && !is_wp_error($home_id)) {
        // Set as front page
        update_option('page_on_front', $home_id);
        update_option('show_on_front', 'page');

        // Add default blocks to homepage
        $home_blocks = array(
            '<!-- wp:acf/wohnegruen-hero {"name":"acf/wohnegruen-hero","mode":"preview"} /-->',
            '<!-- wp:acf/wohnegruen-features {"name":"acf/wohnegruen-features","mode":"preview"} /-->',
            '<!-- wp:acf/wohnegruen-models {"name":"acf/wohnegruen-models","mode":"preview"} /-->',
            '<!-- wp:acf/wohnegruen-about {"name":"acf/wohnegruen-about","mode":"preview"} /-->',
            '<!-- wp:acf/wohnegruen-contact {"name":"acf/wohnegruen-contact","mode":"preview"} /-->',
        );

        wp_update_post(array(
            'ID' => $home_id,
            'post_content' => implode("\n\n", $home_blocks),
        ));
    }

    // 2. Create combined Gallery & 3D Page
    $gallery_id = wp_insert_post(array(
        'post_title'    => 'Galerie & 3D',
        'post_name'     => 'galerie-3d',
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_type'     => 'page',
    ));

    if ($gallery_id && !is_wp_error($gallery_id)) {
        // Set custom template for combined gallery & 3D page
        update_post_meta($gallery_id, '_wp_page_template', 'page-gallery-3d.php');
    }

    // 3. Create Über uns Page
    $about_id = wp_insert_post(array(
        'post_title'    => 'Über uns',
        'post_name'     => 'uber-uns',
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_type'     => 'page',
    ));

    if ($about_id && !is_wp_error($about_id)) {
        // Set custom template for about page
        update_post_meta($about_id, '_wp_page_template', 'page-about.php');
    }

    // 4. Create Kontakt Page
    $contact_id = wp_insert_post(array(
        'post_title'    => 'Kontakt',
        'post_name'     => 'kontakt',
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_type'     => 'page',
    ));

    if ($contact_id && !is_wp_error($contact_id)) {
        // Set custom template for contact page
        update_post_meta($contact_id, '_wp_page_template', 'page-contact.php');
    }

    // Store page IDs for reference
    update_option('wohnegruen_page_ids', array(
        'home' => $home_id,
        'gallery' => $gallery_id,
        'about' => $about_id,
        'contact' => $contact_id,
    ));

    update_option('wohnegruen_pages_created', true);
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'wohnegruen_create_required_pages');

/**
 * Create primary navigation menu
 */
function wohnegruen_create_navigation_menu() {
    // Check if already created
    if (get_option('wohnegruen_menu_created')) {
        return;
    }

    $menu_name = 'Hauptmenü';
    $menu_exists = wp_get_nav_menu_object($menu_name);

    if (!$menu_exists) {
        $menu_id = wp_create_nav_menu($menu_name);
        $page_ids = get_option('wohnegruen_page_ids', array());

        // Menu items configuration
        $items = array(
            array(
                'title' => 'Home',
                'object_id' => isset($page_ids['home']) ? $page_ids['home'] : 0,
                'type' => 'post_type',
                'object' => 'page',
            ),
            array(
                'title' => 'Galerie & 3D',
                'object_id' => isset($page_ids['gallery']) ? $page_ids['gallery'] : 0,
                'type' => 'post_type',
                'object' => 'page',
            ),
            array(
                'title' => 'Über uns',
                'object_id' => isset($page_ids['about']) ? $page_ids['about'] : 0,
                'type' => 'post_type',
                'object' => 'page',
            ),
            array(
                'title' => 'Kontakt',
                'object_id' => isset($page_ids['contact']) ? $page_ids['contact'] : 0,
                'type' => 'post_type',
                'object' => 'page',
            ),
        );

        // Add menu items
        foreach ($items as $item) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => $item['title'],
                'menu-item-object-id' => isset($item['object_id']) ? $item['object_id'] : 0,
                'menu-item-object' => isset($item['object']) ? $item['object'] : '',
                'menu-item-type' => $item['type'],
                'menu-item-url' => isset($item['url']) ? $item['url'] : '',
                'menu-item-status' => 'publish',
            ));
        }

        // Assign to primary location
        $locations = get_theme_mod('nav_menu_locations');
        if (!is_array($locations)) {
            $locations = array();
        }
        $locations['primary'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);

        update_option('wohnegruen_menu_created', true);
    }
}
add_action('after_switch_theme', 'wohnegruen_create_navigation_menu');
