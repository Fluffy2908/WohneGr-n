<?php
/**
 * ACF Pro Blocks Registration for Gutenberg
 *
 * This file registers all ACF blocks that appear in the Gutenberg editor.
 * Each block has its own template file in template-parts/blocks/
 */

if (!defined('ABSPATH')) exit;

/**
 * Register ACF Blocks
 */
function wohnegruen_register_acf_blocks() {
    // Check if ACF function exists
    if (!function_exists('acf_register_block_type')) {
        error_log('WohneGrün: acf_register_block_type function not found!');
        return;
    }

    error_log('WohneGrün: Registering ACF blocks...');

    // Block Category
    $category = 'wohnegruen';

    // Hero Block
    acf_register_block_type(array(
        'name'              => 'wohnegruen-hero',
        'title'             => __('Hero-Bereich', 'wohnegruen'),
        'description'       => __('Hauptbereich mit Hintergrund, Titel und CTA-Buttons.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-hero.php',
        'category'          => $category,
        'icon'              => 'cover-image',
        'keywords'          => array('hero', 'header', 'banner', 'titel'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
            'jsx' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('page'),
        'enqueue_assets'    => function() {},
    ));

    // Features Block
    acf_register_block_type(array(
        'name'              => 'wohnegruen-features',
        'title'             => __('Vorteile', 'wohnegruen'),
        'description'       => __('Raster von Vorteilen/Dienstleistungen mit Icons.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-features.php',
        'category'          => $category,
        'icon'              => 'grid-view',
        'keywords'          => array('features', 'vorteile', 'dienste', 'icons'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('page'),
    ));

    // Models Block
    acf_register_block_type(array(
        'name'              => 'wohnegruen-models',
        'title'             => __('Modelle', 'wohnegruen'),
        'description'       => __('Darstellung von Mobilhäusern/Modellen.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-models.php',
        'category'          => $category,
        'icon'              => 'admin-home',
        'keywords'          => array('models', 'modelle', 'häuser', 'produkte'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('page'),
    ));

    // About Block
    acf_register_block_type(array(
        'name'              => 'wohnegruen-about',
        'title'             => __('Über uns', 'wohnegruen'),
        'description'       => __('Bereich über das Unternehmen mit Bild und Text.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-about.php',
        'category'          => $category,
        'icon'              => 'admin-users',
        'keywords'          => array('about', 'über uns', 'unternehmen'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('page'),
    ));

    // Contact Block
    acf_register_block_type(array(
        'name'              => 'wohnegruen-contact',
        'title'             => __('Kontakt', 'wohnegruen'),
        'description'       => __('Kontaktbereich mit Formular und Daten.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-contact.php',
        'category'          => $category,
        'icon'              => 'email',
        'keywords'          => array('contact', 'kontakt', 'formular'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('page'),
    ));

    // CTA Block
    acf_register_block_type(array(
        'name'              => 'wohnegruen-cta',
        'title'             => __('CTA-Bereich', 'wohnegruen'),
        'description'       => __('Call-to-Action-Bereich mit Button.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-cta.php',
        'category'          => $category,
        'icon'              => 'megaphone',
        'keywords'          => array('cta', 'action'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('page'),
    ));

    // Values Grid Block
    acf_register_block_type(array(
        'name'              => 'wohnegruen-values-grid',
        'title'             => __('Werte-Raster', 'wohnegruen'),
        'description'       => __('Raster von Unternehmenswerten mit Icons.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-values-grid.php',
        'category'          => $category,
        'icon'              => 'star-filled',
        'keywords'          => array('values', 'werte', 'icons'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('page'),
    ));

    // Contact Form Block
    acf_register_block_type(array(
        'name'              => 'wohnegruen-contact-form',
        'title'             => __('Kontaktformular', 'wohnegruen'),
        'description'       => __('Kontaktformular mit Info und Karte.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-contact-form.php',
        'category'          => $category,
        'icon'              => 'email-alt',
        'keywords'          => array('contact', 'kontakt', 'form', 'map'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('page'),
    ));

    // Page Hero Block (Simple hero for inner pages)
    acf_register_block_type(array(
        'name'              => 'wohnegruen-page-hero',
        'title'             => __('Seiten-Hero', 'wohnegruen'),
        'description'       => __('Einfacher Hero-Bereich für Unterseiten mit Hintergrund und Titel.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-page-hero.php',
        'category'          => $category,
        'icon'              => 'cover-image',
        'keywords'          => array('hero', 'header', 'page', 'title', 'simple'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('page'),
    ));

    // Model Details Block (For single model posts - stores homepage card data)
    acf_register_block_type(array(
        'name'              => 'wohnegruen-model-details',
        'title'             => __('Modell-Details', 'wohnegruen'),
        'description'       => __('Details für Homepage-Karte (Tagline, Badge, Specs, Highlights).', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-model-details.php',
        'category'          => $category,
        'icon'              => 'info',
        'keywords'          => array('details', 'info', 'specs', 'tagline', 'badge'),
        'supports'          => array(
            'align' => false,
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('mobilhaus'),
    ));

    // Model Showcase Block (Combined Hero + Color Options)
    acf_register_block_type(array(
        'name'              => 'wohnegruen-model-showcase',
        'title'             => __('Modell-Showcase', 'wohnegruen'),
        'description'       => __('Kombinierter Hero + Farboptionen Block für Modell-Seiten.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-model-showcase.php',
        'category'          => $category,
        'icon'              => 'images-alt2',
        'keywords'          => array('showcase', 'hero', 'colors', 'farben', 'modell'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('mobilhaus'),
    ));

    // 3D Floor Plans Block
    acf_register_block_type(array(
        'name'              => 'wohnegruen-3d-floorplans',
        'title'             => __('3D Grundrisse', 'wohnegruen'),
        'description'       => __('3D Grundrisse mit verschiedenen Konfigurationen.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-3d-floorplans.php',
        'category'          => $category,
        'icon'              => 'layout',
        'keywords'          => array('3d', 'grundriss', 'floor plan', 'tloris'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('page', 'mobilhaus'),
    ));

    error_log('WohneGrün: Successfully registered ' . (19) . ' ACF blocks');
}
add_action('acf/init', 'wohnegruen_register_acf_blocks', 5);
add_action('init', 'wohnegruen_register_acf_blocks', 20);

/**
 * Register custom block category
 */
// Block category registration moved to inc/theme.php to avoid duplicates

// ACF Options Pages removed - all settings now managed through ACF Field Groups

// NOTE: ACF field groups are managed through WordPress admin (database field groups)
// instead of being registered in code. This approach allows easier editing via
// the ACF admin interface and prevents duplicates.
//
// To edit field groups: Go to ACF > Field Groups in WordPress admin.

/**
 * Register ACF Options Pages
 */
function wohnegruen_register_acf_options_pages() {
    if (!function_exists('acf_add_options_page')) {
        return;
    }

    // Navigation Options Page
    acf_add_options_page(array(
        'page_title' => 'Navigation',
        'menu_title' => 'Navigation',
        'menu_slug' => 'acf-options-navigacija',
        'capability' => 'edit_posts',
        'parent_slug' => 'themes.php',
        'position' => false,
        'icon_url' => false,
    ));

    // Contact Info Options Page
    acf_add_options_page(array(
        'page_title' => 'Kontaktdaten',
        'menu_title' => 'Kontaktdaten',
        'menu_slug' => 'acf-options-kontakt',
        'capability' => 'edit_posts',
        'parent_slug' => 'themes.php',
        'position' => false,
        'icon_url' => false,
    ));

    // Footer Options Page
    acf_add_options_page(array(
        'page_title' => 'Footer',
        'menu_title' => 'Footer',
        'menu_slug' => 'acf-options-footer',
        'capability' => 'edit_posts',
        'parent_slug' => 'themes.php',
        'position' => false,
        'icon_url' => false,
    ));
}
add_action('acf/init', 'wohnegruen_register_acf_options_pages');

