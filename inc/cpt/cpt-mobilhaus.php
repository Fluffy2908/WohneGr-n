<?php
/**
 * Custom Post Type: Mobilhaus
 */

if (!defined('ABSPATH')) exit;

/**
 * Register Custom Post Type: Mobilhaus
 */
function wohnegruen_register_mobilhaus_cpt() {
    $labels = array(
        'name'                  => 'Mobilhäuser',
        'singular_name'         => 'Mobilhaus',
        'menu_name'             => 'Mobilhäuser',
        'add_new'               => 'Neu hinzufügen',
        'add_new_item'          => 'Neues Mobilhaus hinzufügen',
        'edit_item'             => 'Mobilhaus bearbeiten',
        'new_item'              => 'Neues Mobilhaus',
        'view_item'             => 'Mobilhaus ansehen',
        'search_items'          => 'Mobilhäuser durchsuchen',
        'not_found'             => 'Keine Mobilhäuser gefunden',
        'not_found_in_trash'    => 'Keine Mobilhäuser im Papierkorb',
        'all_items'             => 'Alle Mobilhäuser',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'modelle'),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-admin-home',
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'        => true,
    );

    register_post_type('mobilhaus', $args);
}
add_action('init', 'wohnegruen_register_mobilhaus_cpt');

/**
 * Flush rewrite rules on theme activation
 */
function wohnegruen_rewrite_flush() {
    wohnegruen_register_mobilhaus_cpt();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'wohnegruen_rewrite_flush');
