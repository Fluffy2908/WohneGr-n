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

    // Hero Block (with LIVE PREVIEW)
    acf_register_block_type(array(
        'name'              => 'wohnegruen-hero',
        'title'             => __('Hero-Bereich', 'wohnegruen'),
        'description'       => __('Hauptbereich mit Hintergrund, Titel und CTA-Buttons - mit Live-Vorschau.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-hero.php',
        'category'          => $category,
        'icon'              => 'cover-image',
        'keywords'          => array('hero', 'header', 'banner', 'titel'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
            'jsx' => true,
            'mode' => false,
        ),
        'mode'              => 'auto',
        'post_types'        => array('page'),
        'enqueue_assets'    => function() {},
    ));

    // Features Block - DEPRECATED: Use "Flexible Sektion" (wohnegruen-page-section) instead
    // Set section_type to "features_grid" for same functionality with live preview
    /*
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
    */

    // Models Block (with LIVE PREVIEW)
    acf_register_block_type(array(
        'name'              => 'wohnegruen-models',
        'title'             => __('Modelle', 'wohnegruen'),
        'description'       => __('Darstellung von Mobilhäusern/Modellen - mit Live-Vorschau.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-models.php',
        'category'          => $category,
        'icon'              => 'admin-home',
        'keywords'          => array('models', 'modelle', 'häuser', 'produkte'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
            'jsx' => true,
            'mode' => false,
        ),
        'mode'              => 'auto',
        'post_types'        => array('page'),
    ));

    // About Block (with LIVE PREVIEW)
    acf_register_block_type(array(
        'name'              => 'wohnegruen-about',
        'title'             => __('Über uns', 'wohnegruen'),
        'description'       => __('Bereich über das Unternehmen mit Bild und Text - mit Live-Vorschau.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-about.php',
        'category'          => $category,
        'icon'              => 'admin-users',
        'keywords'          => array('about', 'über uns', 'unternehmen'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
            'jsx' => true,
            'mode' => false,
        ),
        'mode'              => 'auto',
        'post_types'        => array('page'),
    ));

    // Contact Block - DEPRECATED: Use "Kontaktformular" (wohnegruen-contact-form) instead
    // It has more features (map support, better form structure)
    /*
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
    */

    // CTA Block (with LIVE PREVIEW)
    acf_register_block_type(array(
        'name'              => 'wohnegruen-cta',
        'title'             => __('CTA-Bereich', 'wohnegruen'),
        'description'       => __('Call-to-Action-Bereich mit Button - mit Live-Vorschau.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-cta.php',
        'category'          => $category,
        'icon'              => 'megaphone',
        'keywords'          => array('cta', 'action'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
            'jsx' => true,
            'mode' => false,
        ),
        'mode'              => 'auto',
        'post_types'        => array('page'),
    ));

    // Values Grid Block - DEPRECATED: Use "Flexible Sektion" (wohnegruen-page-section) instead
    // Set section_type to "values_grid" for same functionality with live preview
    /*
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
    */

    // Contact Form Block (with LIVE PREVIEW)
    acf_register_block_type(array(
        'name'              => 'wohnegruen-contact-form',
        'title'             => __('Kontaktformular', 'wohnegruen'),
        'description'       => __('Kontaktformular mit Info und Karte - mit Live-Vorschau.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-contact-form.php',
        'category'          => $category,
        'icon'              => 'email-alt',
        'keywords'          => array('contact', 'kontakt', 'form', 'map'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
            'jsx' => true,
            'mode' => false,
        ),
        'mode'              => 'auto',
        'post_types'        => array('page'),
    ));

    // Page Hero Block (Simple hero for inner pages with LIVE PREVIEW)
    acf_register_block_type(array(
        'name'              => 'wohnegruen-page-hero',
        'title'             => __('Seiten-Hero', 'wohnegruen'),
        'description'       => __('Einfacher Hero-Bereich für Unterseiten - mit Live-Vorschau.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-page-hero.php',
        'category'          => $category,
        'icon'              => 'cover-image',
        'keywords'          => array('hero', 'header', 'page', 'title', 'simple'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
            'jsx' => true,
            'mode' => false,
        ),
        'mode'              => 'auto',
        'post_types'        => array('page'),
    ));

    // Model Details Block - DEPRECATED: Data should be stored in post meta or custom fields
    // Not as a block. Use ACF field groups attached to mobilhaus post type instead.
    /*
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
    */

    // Model Showcase Block - CONSIDER USING: "Mobilhaus Komplett" instead (more comprehensive)
    // This block is kept for backwards compatibility, but the new block is recommended
    /*
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
    */

    // 3D Floor Plans Block - Replaced by "Mobilhaus Komplett" block for mobilhaus posts
    // Can be re-enabled if standalone floor plan display is needed
    /*
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
    */

    // Exterior Color Selector Block - Replaced by "Mobilhaus Komplett" block
    // Can be re-enabled if standalone exterior color display is needed
    /*
    acf_register_block_type(array(
        'name'              => 'wohnegruen-exterior-colors',
        'title'             => __('Außenfarben', 'wohnegruen'),
        'description'       => __('Außenfarben-Auswahl mit Anthrazit und Weiß.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-exterior-colors.php',
        'category'          => $category,
        'icon'              => 'admin-appearance',
        'keywords'          => array('color', 'exterior', 'außenfarbe', 'farbe'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('page', 'mobilhaus'),
    ));
    */

    // Interactive Floor Plans Block - Replaced by "Mobilhaus Komplett" block
    // Can be re-enabled if standalone floor plan display is needed
    /*
    acf_register_block_type(array(
        'name'              => 'wohnegruen-floor-plans-interactive',
        'title'             => __('Grundrisse Interaktiv', 'wohnegruen'),
        'description'       => __('Interaktive Grundrisse mit Größenauswahl und Spiegelfunktion.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-floor-plans-interactive.php',
        'category'          => $category,
        'icon'              => 'desktop',
        'keywords'          => array('floor plan', 'grundriss', 'interactive', 'spiegeln'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('page', 'mobilhaus'),
    ));
    */

    // Interior Color Showcase Block - Replaced by "Mobilhaus Komplett" block
    // Can be re-enabled if standalone interior color display is needed
    /*
    acf_register_block_type(array(
        'name'              => 'wohnegruen-interior-colors',
        'title'             => __('Innenfarben Showcase', 'wohnegruen'),
        'description'       => __('Interaktiver Slider für Innenfarbschemata mit Bildergalerien.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-interior-colors.php',
        'category'          => $category,
        'icon'              => 'images-alt2',
        'keywords'          => array('interior', 'colors', 'innenfarben', 'slider'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('page', 'mobilhaus'),
    ));
    */

    // Mobilhaus Complete Block (NEW - All-in-One for Mobilhaus Posts)
    acf_register_block_type(array(
        'name'              => 'wohnegruen-mobilhaus-complete',
        'title'             => __('Mobilhaus Komplett', 'wohnegruen'),
        'description'       => __('Alles-in-einem Block für Mobilhaus-Seiten: Hero, Farbauswahl, Beschreibung, Grundriss, Innenausstattung (Hosekra-Stil).', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-mobilhaus-complete.php',
        'category'          => $category,
        'icon'              => 'admin-home',
        'keywords'          => array('mobilhaus', 'komplett', 'hosekra', 'modell', 'complete'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
            'mode' => false,
            'jsx' => true,
        ),
        'mode'              => 'auto',
        'post_types'        => array('mobilhaus'),
        'enqueue_style'     => false,
        'enqueue_assets'    => function() {},
    ));

    // Flexible Page Section Block (NEW - Universal block with LIVE PREVIEW)
    acf_register_block_type(array(
        'name'              => 'wohnegruen-page-section',
        'title'             => __('Flexible Sektion', 'wohnegruen'),
        'description'       => __('Universeller Block mit Live-Vorschau: Text+Bild, Features, Werte, CTA, oder Custom HTML.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-page-section.php',
        'category'          => $category,
        'icon'              => 'layout',
        'keywords'          => array('section', 'sektion', 'flexible', 'universal', 'live'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
            'mode' => false,
            'jsx' => true,
        ),
        'mode'              => 'auto',
        'post_types'        => array('page', 'post'),
        'enqueue_style'     => false,
        'enqueue_assets'    => function() {},
        'example'           => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'section_type' => 'text_image',
                    'section_title' => 'Beispiel Sektion',
                    'section_subtitle' => 'Dies ist eine Vorschau',
                    '_is_preview' => true
                )
            )
        ),
    ));

    error_log('WohneGrün: Successfully registered ' . (10) . ' ACF blocks (8 deprecated blocks commented out)');
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

