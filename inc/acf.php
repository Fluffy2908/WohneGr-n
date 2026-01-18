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

    // Gallery Block
    acf_register_block_type(array(
        'name'              => 'wohnegruen-gallery',
        'title'             => __('Galerie', 'wohnegruen'),
        'description'       => __('Bildergalerie mit Filtern und Lightbox.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-gallery.php',
        'category'          => $category,
        'icon'              => 'format-gallery',
        'keywords'          => array('gallery', 'galerie', 'bilder'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('page'),
    ));

    // 3D Tour Block
    acf_register_block_type(array(
        'name'              => 'wohnegruen-3d-tour',
        'title'             => __('3D Rundgang', 'wohnegruen'),
        'description'       => __('Interaktive 3D-Tour oder Video-Präsentation.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-3d-tour.php',
        'category'          => $category,
        'icon'              => 'visibility',
        'keywords'          => array('3d', 'tour', 'rundgang'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('page'),
    ));

    // Floor Plans Block
    acf_register_block_type(array(
        'name'              => 'wohnegruen-floor-plans',
        'title'             => __('Grundrisse', 'wohnegruen'),
        'description'       => __('Darstellung von Grundrissen und Raumlayouts.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-floor-plans.php',
        'category'          => $category,
        'icon'              => 'layout',
        'keywords'          => array('grundriss', 'layout'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('page'),
    ));

    // Interiors Block
    acf_register_block_type(array(
        'name'              => 'wohnegruen-interiors',
        'title'             => __('Innenausstattung', 'wohnegruen'),
        'description'       => __('Darstellung von Innenausstattung und Einrichtung.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-interiors.php',
        'category'          => $category,
        'icon'              => 'admin-appearance',
        'keywords'          => array('interior', 'innenausstattung'),
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

    // Model Tabs Block
    acf_register_block_type(array(
        'name'              => 'wohnegruen-model-tabs',
        'title'             => __('Modell-Tabs', 'wohnegruen'),
        'description'       => __('Modell-Tabs mit Farbauswahl und Größenoptionen (Nature/Pure).', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-model-tabs.php',
        'category'          => $category,
        'icon'              => 'admin-home',
        'keywords'          => array('models', 'tabs', 'color', 'modelle'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('page'),
    ));

    // Gallery Tabs Block
    acf_register_block_type(array(
        'name'              => 'wohnegruen-gallery-tabs',
        'title'             => __('Galerie mit Tabs', 'wohnegruen'),
        'description'       => __('Bildergalerie mit Filter und 3D-Tour Tabs.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-gallery-tabs.php',
        'category'          => $category,
        'icon'              => 'format-gallery',
        'keywords'          => array('gallery', 'galerie', '3d', 'tabs'),
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

    // Model Hero Block (For single model posts)
    acf_register_block_type(array(
        'name'              => 'wohnegruen-model-hero-single',
        'title'             => __('Modell-Hero', 'wohnegruen'),
        'description'       => __('Hero-Bereich für einzelne Modell-Seiten.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-model-hero-single.php',
        'category'          => $category,
        'icon'              => 'format-image',
        'keywords'          => array('model', 'hero', 'modell'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('mobilhaus'),
    ));

    // Model Colors Block (For single model posts)
    acf_register_block_type(array(
        'name'              => 'wohnegruen-model-colors',
        'title'             => __('Farboptionen', 'wohnegruen'),
        'description'       => __('Farboptionen und Innenausstattung für Modelle.', 'wohnegruen'),
        'render_template'   => 'template-parts/blocks/block-model-colors.php',
        'category'          => $category,
        'icon'              => 'art',
        'keywords'          => array('color', 'farbe', 'interior', 'innen'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('mobilhaus'),
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

    error_log('WohneGrün: Successfully registered ' . (19) . ' ACF blocks');
}
add_action('acf/init', 'wohnegruen_register_acf_blocks', 5);
add_action('init', 'wohnegruen_register_acf_blocks', 20);

/**
 * Register custom block category
 */
// Block category registration moved to inc/theme.php to avoid duplicates

// ACF Options Pages removed - all settings now managed through ACF Field Groups

/**
 * Register ACF Field Groups for Blocks
 */
function wohnegruen_register_block_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    // Hero Block Fields
    acf_add_local_field_group(array(
        'key' => 'group_block_hero',
        'title' => 'Hero-Block',
        'fields' => array(
            array(
                'key' => 'field_block_hero_background',
                'label' => 'Hintergrundbild',
                'name' => 'hero_background',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'large',
                'instructions' => 'Empfohlene Größe: 1920x1080px',
            ),
            array(
                'key' => 'field_block_hero_badge',
                'label' => 'Badge-Text',
                'name' => 'hero_badge',
                'type' => 'text',
                'default_value' => 'Österreichweit verfügbar',
            ),
            array(
                'key' => 'field_block_hero_title',
                'label' => 'Titel',
                'name' => 'hero_title',
                'type' => 'text',
                'default_value' => 'Wir bauen Ihr Traumhaus',
            ),
            array(
                'key' => 'field_block_hero_subtitle',
                'label' => 'Untertitel',
                'name' => 'hero_subtitle',
                'type' => 'textarea',
                'rows' => 2,
            ),
            array(
                'key' => 'field_block_hero_btn1_text',
                'label' => 'Button 1 - Text',
                'name' => 'hero_btn1_text',
                'type' => 'text',
                'default_value' => 'Modelle ansehen',
                'wrapper' => array('width' => '50'),
            ),
            array(
                'key' => 'field_block_hero_btn1_link',
                'label' => 'Button 1 - Link',
                'name' => 'hero_btn1_link',
                'type' => 'url',
                'wrapper' => array('width' => '50'),
            ),
            array(
                'key' => 'field_block_hero_btn2_text',
                'label' => 'Button 2 - Text',
                'name' => 'hero_btn2_text',
                'type' => 'text',
                'default_value' => 'Preisliste erhalten',
                'wrapper' => array('width' => '50'),
            ),
            array(
                'key' => 'field_block_hero_btn2_link',
                'label' => 'Button 2 - Link',
                'name' => 'hero_btn2_link',
                'type' => 'url',
                'wrapper' => array('width' => '50'),
            ),
            array(
                'key' => 'field_block_hero_stats',
                'label' => 'Statistik',
                'name' => 'hero_stats',
                'type' => 'repeater',
                'min' => 0,
                'max' => 4,
                'layout' => 'table',
                'button_label' => 'Statistik hinzufügen',
                'sub_fields' => array(
                    array(
                        'key' => 'field_block_hero_stat_number',
                        'label' => 'Zahl',
                        'name' => 'number',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_block_hero_stat_label',
                        'label' => 'Bezeichnung',
                        'name' => 'label',
                        'type' => 'text',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/wohnegruen-hero',
                ),
            ),
        ),
    ));

    // Features Block Fields
    acf_add_local_field_group(array(
        'key' => 'group_block_features',
        'title' => 'Vorteile-Block',
        'fields' => array(
            array(
                'key' => 'field_block_features_title',
                'label' => 'Titel',
                'name' => 'features_title',
                'type' => 'text',
                'default_value' => 'Warum WohneGrün wählen?',
            ),
            array(
                'key' => 'field_block_features_subtitle',
                'label' => 'Untertitel',
                'name' => 'features_subtitle',
                'type' => 'textarea',
                'rows' => 2,
            ),
            array(
                'key' => 'field_block_features_items',
                'label' => 'Vorteile',
                'name' => 'features_items',
                'type' => 'repeater',
                'min' => 1,
                'max' => 6,
                'layout' => 'block',
                'button_label' => 'Vorteil hinzufügen',
                'sub_fields' => array(
                    array(
                        'key' => 'field_block_feature_icon',
                        'label' => 'Icon',
                        'name' => 'icon',
                        'type' => 'select',
                        'choices' => array(
                            'shield' => 'Schild (Garantie)',
                            'star' => 'Stern (Qualität)',
                            'truck' => 'Lieferung',
                            'tools' => 'Werkzeuge (Service)',
                            'leaf' => 'Blatt (Ökologie)',
                            'home' => 'Haus',
                            'check' => 'Häkchen',
                            'users' => 'Benutzer',
                            'location' => 'Standort',
                        ),
                        'wrapper' => array('width' => '30'),
                    ),
                    array(
                        'key' => 'field_block_feature_title',
                        'label' => 'Titel',
                        'name' => 'title',
                        'type' => 'text',
                        'wrapper' => array('width' => '70'),
                    ),
                    array(
                        'key' => 'field_block_feature_text',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'textarea',
                        'rows' => 2,
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/wohnegruen-features',
                ),
            ),
        ),
    ));

    // Models Block Fields
    acf_add_local_field_group(array(
        'key' => 'group_block_models',
        'title' => 'Modelle-Block',
        'fields' => array(
            array(
                'key' => 'field_block_models_title',
                'label' => 'Titel',
                'name' => 'models_title',
                'type' => 'text',
                'default_value' => 'Unsere Modelle',
            ),
            array(
                'key' => 'field_block_models_subtitle',
                'label' => 'Untertitel',
                'name' => 'models_subtitle',
                'type' => 'textarea',
                'rows' => 2,
            ),
            array(
                'key' => 'field_block_models_source',
                'label' => 'Datenquelle',
                'name' => 'models_source',
                'type' => 'select',
                'choices' => array(
                    'cpt' => 'Aus Custom Post Type (Mobilhäuser)',
                    'manual' => 'Manuelle Eingabe',
                ),
                'default_value' => 'cpt',
            ),
            array(
                'key' => 'field_block_models_count',
                'label' => 'Anzahl der Modelle',
                'name' => 'models_count',
                'type' => 'number',
                'default_value' => 3,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_block_models_source',
                            'operator' => '==',
                            'value' => 'cpt',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_block_models_items',
                'label' => 'Modelle',
                'name' => 'models_items',
                'type' => 'repeater',
                'min' => 1,
                'max' => 8,
                'layout' => 'block',
                'button_label' => 'Modell hinzufügen',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_block_models_source',
                            'operator' => '==',
                            'value' => 'manual',
                        ),
                    ),
                ),
                'sub_fields' => array(
                    array(
                        'key' => 'field_block_model_image',
                        'label' => 'Bild',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                    ),
                    array(
                        'key' => 'field_block_model_title',
                        'label' => 'Modellname',
                        'name' => 'title',
                        'type' => 'text',
                        'wrapper' => array('width' => '50'),
                    ),
                    array(
                        'key' => 'field_block_model_link',
                        'label' => 'Link',
                        'name' => 'link',
                        'type' => 'url',
                        'wrapper' => array('width' => '50'),
                    ),
                    array(
                        'key' => 'field_block_model_description',
                        'label' => 'Beschreibung',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 2,
                    ),
                    array(
                        'key' => 'field_block_model_size',
                        'label' => 'Größe (m²)',
                        'name' => 'size',
                        'type' => 'text',
                        'wrapper' => array('width' => '33'),
                    ),
                    array(
                        'key' => 'field_block_model_rooms',
                        'label' => 'Anzahl Zimmer',
                        'name' => 'rooms',
                        'type' => 'text',
                        'wrapper' => array('width' => '33'),
                    ),
                    array(
                        'key' => 'field_block_model_persons',
                        'label' => 'Anzahl Personen',
                        'name' => 'persons',
                        'type' => 'text',
                        'wrapper' => array('width' => '34'),
                    ),
                    array(
                        'key' => 'field_block_model_price',
                        'label' => 'Preis',
                        'name' => 'price',
                        'type' => 'text',
                    ),
                ),
            ),
            array(
                'key' => 'field_block_models_cta_text',
                'label' => 'CTA-Button Text',
                'name' => 'models_cta_text',
                'type' => 'text',
                'default_value' => 'Alle Modelle ansehen',
                'wrapper' => array('width' => '50'),
            ),
            array(
                'key' => 'field_block_models_cta_link',
                'label' => 'CTA-Button Link',
                'name' => 'models_cta_link',
                'type' => 'url',
                'wrapper' => array('width' => '50'),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/wohnegruen-models',
                ),
            ),
        ),
    ));

    // 3D Tour Block Fields
    acf_add_local_field_group(array(
        'key' => 'group_block_3d_tour',
        'title' => '3D Rundgang-Block',
        'fields' => array(
            array(
                'key' => 'field_block_3d_title',
                'label' => 'Titel',
                'name' => 'tour_title',
                'type' => 'text',
                'default_value' => 'Virtueller Rundgang',
            ),
            array(
                'key' => 'field_block_3d_subtitle',
                'label' => 'Untertitel',
                'name' => 'tour_subtitle',
                'type' => 'textarea',
                'rows' => 2,
            ),
            array(
                'key' => 'field_block_3d_type',
                'label' => 'Inhaltstyp',
                'name' => 'tour_type',
                'type' => 'select',
                'choices' => array(
                    'video' => 'Video (YouTube/Vimeo)',
                    'iframe' => 'Iframe (3D-Rundgang)',
                    'image' => 'Bild mit Vorschau',
                ),
                'default_value' => 'video',
            ),
            array(
                'key' => 'field_block_3d_video_url',
                'label' => 'Video URL',
                'name' => 'tour_video_url',
                'type' => 'url',
                'instructions' => 'YouTube oder Vimeo Link',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_block_3d_type',
                            'operator' => '==',
                            'value' => 'video',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_block_3d_iframe',
                'label' => 'Iframe-Code',
                'name' => 'tour_iframe',
                'type' => 'textarea',
                'instructions' => 'Embed-Code für 3D-Rundgang eingeben (Matterport, etc.)',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_block_3d_type',
                            'operator' => '==',
                            'value' => 'iframe',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_block_3d_preview_image',
                'label' => 'Vorschaubild',
                'name' => 'tour_preview_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'large',
            ),
            array(
                'key' => 'field_block_3d_features',
                'label' => 'Merkmale',
                'name' => 'tour_features',
                'type' => 'repeater',
                'min' => 0,
                'max' => 4,
                'layout' => 'table',
                'button_label' => 'Merkmal hinzufügen',
                'sub_fields' => array(
                    array(
                        'key' => 'field_block_3d_feature_icon',
                        'label' => 'Icon',
                        'name' => 'icon',
                        'type' => 'select',
                        'choices' => array(
                            'cube' => '3D-Würfel',
                            'expand' => 'Erweitern',
                            'play' => 'Abspielen',
                            'grid' => 'Raster',
                        ),
                    ),
                    array(
                        'key' => 'field_block_3d_feature_text',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'text',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/wohnegruen-3d-tour',
                ),
            ),
        ),
    ));

    // Floor Plans Block Fields
    acf_add_local_field_group(array(
        'key' => 'group_block_floor_plans',
        'title' => 'Grundrisse-Block',
        'fields' => array(
            array(
                'key' => 'field_block_floor_title',
                'label' => 'Titel',
                'name' => 'floor_title',
                'type' => 'text',
                'default_value' => 'Grundrisse und Layouts',
            ),
            array(
                'key' => 'field_block_floor_subtitle',
                'label' => 'Untertitel',
                'name' => 'floor_subtitle',
                'type' => 'textarea',
                'rows' => 2,
            ),
            array(
                'key' => 'field_block_floor_plans',
                'label' => 'Grundrisse',
                'name' => 'floor_plans',
                'type' => 'repeater',
                'min' => 1,
                'max' => 10,
                'layout' => 'block',
                'button_label' => 'Grundriss hinzufügen',
                'sub_fields' => array(
                    array(
                        'key' => 'field_block_floor_plan_name',
                        'label' => 'Bezeichnung',
                        'name' => 'name',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_block_floor_plan_image',
                        'label' => 'Grundriss-Bild',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                    ),
                    array(
                        'key' => 'field_block_floor_plan_size',
                        'label' => 'Größe',
                        'name' => 'size',
                        'type' => 'text',
                        'wrapper' => array('width' => '33'),
                    ),
                    array(
                        'key' => 'field_block_floor_plan_rooms',
                        'label' => 'Zimmer',
                        'name' => 'rooms',
                        'type' => 'text',
                        'wrapper' => array('width' => '33'),
                    ),
                    array(
                        'key' => 'field_block_floor_plan_bath',
                        'label' => 'Badezimmer',
                        'name' => 'bathrooms',
                        'type' => 'text',
                        'wrapper' => array('width' => '34'),
                    ),
                    array(
                        'key' => 'field_block_floor_plan_desc',
                        'label' => 'Beschreibung',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 2,
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/wohnegruen-floor-plans',
                ),
            ),
        ),
    ));

    // Interiors Block Fields (supports both legacy rooms mode and model showcase with color slider)
    acf_add_local_field_group(array(
        'key' => 'group_block_interiors',
        'title' => 'Innenausstattung-Block',
        'fields' => array(
            // Mode selector
            array(
                'key' => 'field_block_interiors_mode_tab',
                'label' => 'Anzeigemodus',
                'name' => '',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_block_interiors_title',
                'label' => 'Titel',
                'name' => 'interiors_title',
                'type' => 'text',
                'default_value' => 'Innenausstattung',
            ),
            array(
                'key' => 'field_block_interiors_subtitle',
                'label' => 'Untertitel',
                'name' => 'interiors_subtitle',
                'type' => 'textarea',
                'rows' => 2,
            ),
            array(
                'key' => 'field_block_interiors_model',
                'label' => 'Modell (für Farbslider)',
                'name' => 'interiors_model',
                'type' => 'select',
                'choices' => array(
                    '' => 'Kein Modell (normale Ansicht)',
                    'nature' => 'Nature Modell',
                    'pure' => 'Pure Modell',
                ),
                'default_value' => '',
                'allow_null' => 1,
                'instructions' => 'Wählen Sie ein Modell, um den Farbslider zu aktivieren',
            ),

            // Model showcase fields
            array(
                'key' => 'field_block_interiors_model_tab',
                'label' => 'Modell Showcase (mit Farbslider)',
                'name' => '',
                'type' => 'tab',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_block_interiors_model',
                            'operator' => '!=',
                            'value' => '',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_block_interiors_image',
                'label' => 'Hauptbild',
                'name' => 'interiors_image',
                'type' => 'image',
                'return_format' => 'id',
                'preview_size' => 'medium',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_block_interiors_model',
                            'operator' => '!=',
                            'value' => '',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_block_interiors_description',
                'label' => 'Beschreibung',
                'name' => 'interiors_description',
                'type' => 'textarea',
                'rows' => 4,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_block_interiors_model',
                            'operator' => '!=',
                            'value' => '',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_block_interiors_features',
                'label' => 'Merkmale',
                'name' => 'interiors_features',
                'type' => 'repeater',
                'min' => 0,
                'max' => 10,
                'layout' => 'table',
                'button_label' => 'Merkmal hinzufügen',
                'sub_fields' => array(
                    array(
                        'key' => 'field_block_interiors_feature_text',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'text',
                    ),
                ),
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_block_interiors_model',
                            'operator' => '!=',
                            'value' => '',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_block_interiors_color_slider',
                'label' => 'Farbslider aktivieren',
                'name' => 'interiors_color_slider',
                'type' => 'true_false',
                'default_value' => 1,
                'ui' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_block_interiors_model',
                            'operator' => '!=',
                            'value' => '',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_block_interiors_colors',
                'label' => 'Farbkombinationen',
                'name' => 'interiors_colors',
                'type' => 'repeater',
                'min' => 1,
                'max' => 12,
                'layout' => 'block',
                'button_label' => 'Farbkombination hinzufügen',
                'sub_fields' => array(
                    array(
                        'key' => 'field_block_interiors_color_image',
                        'label' => 'Bild',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'id',
                        'preview_size' => 'medium',
                    ),
                    array(
                        'key' => 'field_block_interiors_color_title',
                        'label' => 'Titel',
                        'name' => 'title',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_block_interiors_color_description',
                        'label' => 'Beschreibung',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 2,
                    ),
                ),
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_block_interiors_model',
                            'operator' => '!=',
                            'value' => '',
                        ),
                        array(
                            'field' => 'field_block_interiors_color_slider',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
            ),

            // Legacy rooms mode
            array(
                'key' => 'field_block_interiors_rooms_tab',
                'label' => 'Räume Ansicht (Legacy)',
                'name' => '',
                'type' => 'tab',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_block_interiors_model',
                            'operator' => '==',
                            'value' => '',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_block_interior_rooms',
                'label' => 'Räume',
                'name' => 'interior_rooms',
                'type' => 'repeater',
                'min' => 1,
                'max' => 8,
                'layout' => 'block',
                'button_label' => 'Raum hinzufügen',
                'sub_fields' => array(
                    array(
                        'key' => 'field_block_interior_room_name',
                        'label' => 'Raumbezeichnung',
                        'name' => 'name',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_block_interior_room_image',
                        'label' => 'Bild',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                    ),
                    array(
                        'key' => 'field_block_interior_room_desc',
                        'label' => 'Beschreibung',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 2,
                    ),
                    array(
                        'key' => 'field_block_interior_room_features',
                        'label' => 'Merkmale',
                        'name' => 'features',
                        'type' => 'textarea',
                        'rows' => 3,
                        'instructions' => 'Jedes Merkmal in einer neuen Zeile',
                    ),
                ),
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_block_interiors_model',
                            'operator' => '==',
                            'value' => '',
                        ),
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/wohnegruen-interiors',
                ),
            ),
        ),
    ));

    // Gallery Block Fields
    acf_add_local_field_group(array(
        'key' => 'group_block_gallery',
        'title' => 'Galerie-Block',
        'fields' => array(
            array(
                'key' => 'field_block_gallery_title',
                'label' => 'Titel',
                'name' => 'gallery_title',
                'type' => 'text',
                'default_value' => 'Galerie',
            ),
            array(
                'key' => 'field_block_gallery_subtitle',
                'label' => 'Untertitel',
                'name' => 'gallery_subtitle',
                'type' => 'textarea',
                'rows' => 2,
            ),
            array(
                'key' => 'field_block_gallery_show_filters',
                'label' => 'Filter anzeigen',
                'name' => 'gallery_show_filters',
                'type' => 'true_false',
                'default_value' => 1,
                'ui' => 1,
            ),
            array(
                'key' => 'field_block_gallery_images',
                'label' => 'Bilder',
                'name' => 'gallery_images',
                'type' => 'repeater',
                'min' => 1,
                'layout' => 'block',
                'button_label' => 'Bild hinzufügen',
                'sub_fields' => array(
                    array(
                        'key' => 'field_block_gallery_image',
                        'label' => 'Bild',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                    ),
                    array(
                        'key' => 'field_block_gallery_image_title',
                        'label' => 'Titel',
                        'name' => 'title',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_block_gallery_image_category',
                        'label' => 'Kategorie',
                        'name' => 'category',
                        'type' => 'select',
                        'choices' => array(
                            'außenbereich' => 'Außenbereich',
                            'innenbereich' => 'Innenbereich',
                            'terrasse' => 'Terrasse',
                            'details' => 'Details',
                        ),
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/wohnegruen-gallery',
                ),
            ),
        ),
    ));

    // About Block Fields
    acf_add_local_field_group(array(
        'key' => 'group_block_about',
        'title' => 'Über uns-Block',
        'fields' => array(
            array(
                'key' => 'field_block_about_image',
                'label' => 'Bild',
                'name' => 'about_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'large',
            ),
            array(
                'key' => 'field_block_about_badge_number',
                'label' => 'Badge - Zahl',
                'name' => 'about_badge_number',
                'type' => 'text',
                'default_value' => '15+',
                'wrapper' => array('width' => '50'),
            ),
            array(
                'key' => 'field_block_about_badge_text',
                'label' => 'Badge - Text',
                'name' => 'about_badge_text',
                'type' => 'text',
                'default_value' => 'Jahre Erfahrung',
                'wrapper' => array('width' => '50'),
            ),
            array(
                'key' => 'field_block_about_title',
                'label' => 'Titel',
                'name' => 'about_title',
                'type' => 'text',
            ),
            array(
                'key' => 'field_block_about_text1',
                'label' => 'Text 1',
                'name' => 'about_text1',
                'type' => 'textarea',
                'rows' => 3,
            ),
            array(
                'key' => 'field_block_about_text2',
                'label' => 'Text 2',
                'name' => 'about_text2',
                'type' => 'textarea',
                'rows' => 3,
            ),
            array(
                'key' => 'field_block_about_list',
                'label' => 'Liste der Vorteile',
                'name' => 'about_list',
                'type' => 'repeater',
                'min' => 1,
                'max' => 10,
                'layout' => 'table',
                'button_label' => 'Punkt hinzufügen',
                'sub_fields' => array(
                    array(
                        'key' => 'field_block_about_list_item',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'text',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/wohnegruen-about',
                ),
            ),
        ),
    ));

    // Contact Block Fields
    acf_add_local_field_group(array(
        'key' => 'group_block_contact',
        'title' => 'Kontakt-Block',
        'fields' => array(
            array(
                'key' => 'field_block_contact_title',
                'label' => 'Titel',
                'name' => 'contact_title',
                'type' => 'text',
                'default_value' => 'Kontaktieren Sie uns',
            ),
            array(
                'key' => 'field_block_contact_subtitle',
                'label' => 'Untertitel',
                'name' => 'contact_subtitle',
                'type' => 'textarea',
                'rows' => 2,
            ),
            array(
                'key' => 'field_block_contact_bar_title',
                'label' => 'Info-Leiste - Titel',
                'name' => 'contact_bar_title',
                'type' => 'text',
                'default_value' => 'Wir sind immer für Sie da',
            ),
            array(
                'key' => 'field_block_contact_bar_text',
                'label' => 'Info-Leiste - Text',
                'name' => 'contact_bar_text',
                'type' => 'textarea',
                'rows' => 2,
            ),
            array(
                'key' => 'field_block_contact_form_shortcode',
                'label' => 'Kontaktformular (Shortcode)',
                'name' => 'contact_form_shortcode',
                'type' => 'text',
                'instructions' => 'Shortcode für Kontaktformular eingeben (z.B. Contact Form 7)',
                'placeholder' => '[contact-form-7 id="123"]',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/wohnegruen-contact',
                ),
            ),
        ),
    ));

    // CTA Block Fields
    acf_add_local_field_group(array(
        'key' => 'group_block_cta',
        'title' => 'CTA-Block',
        'fields' => array(
            array(
                'key' => 'field_block_cta_title',
                'label' => 'Titel',
                'name' => 'cta_title',
                'type' => 'text',
            ),
            array(
                'key' => 'field_block_cta_text',
                'label' => 'Text',
                'name' => 'cta_text',
                'type' => 'textarea',
                'rows' => 2,
            ),
            array(
                'key' => 'field_block_cta_btn_text',
                'label' => 'Button-Text',
                'name' => 'cta_btn_text',
                'type' => 'text',
                'default_value' => 'Kontaktieren Sie uns',
                'wrapper' => array('width' => '50'),
            ),
            array(
                'key' => 'field_block_cta_btn_link',
                'label' => 'Button-Link',
                'name' => 'cta_btn_link',
                'type' => 'url',
                'wrapper' => array('width' => '50'),
            ),
            array(
                'key' => 'field_block_cta_background',
                'label' => 'Hintergrund',
                'name' => 'cta_background',
                'type' => 'select',
                'choices' => array(
                    'primary' => 'Grün',
                    'dark' => 'Dunkel',
                    'light' => 'Hell',
                ),
                'default_value' => 'primary',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/wohnegruen-cta',
                ),
            ),
        ),
    ));

    // Navigation Options Fields
    acf_add_local_field_group(array(
        'key' => 'group_navigation',
        'title' => 'Navigation',
        'fields' => array(
            array(
                'key' => 'field_nav_logo',
                'label' => 'Logo',
                'name' => 'nav_logo',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'instructions' => 'SVG oder PNG Logo hochladen',
            ),
            array(
                'key' => 'field_nav_logo_alt',
                'label' => 'Logo Alt (für Footer/dunkler Hintergrund)',
                'name' => 'nav_logo_alt',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ),
            array(
                'key' => 'field_nav_cta_text',
                'label' => 'CTA-Button Text',
                'name' => 'nav_cta_text',
                'type' => 'text',
                'default_value' => 'Kontaktieren Sie uns',
            ),
            array(
                'key' => 'field_nav_cta_link',
                'label' => 'CTA-Button Link',
                'name' => 'nav_cta_link',
                'type' => 'text',
                'default_value' => '#kontakt',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-navigacija',
                ),
            ),
        ),
    ));

    // Contact Info Options Fields
    acf_add_local_field_group(array(
        'key' => 'group_contact_info',
        'title' => 'Kontaktdaten',
        'fields' => array(
            array(
                'key' => 'field_contact_phone',
                'label' => 'Telefon',
                'name' => 'contact_phone',
                'type' => 'text',
                'default_value' => '+43 123 456 789',
            ),
            array(
                'key' => 'field_contact_email',
                'label' => 'E-Mail',
                'name' => 'contact_email',
                'type' => 'email',
                'default_value' => 'info@wohnegruen.at',
            ),
            array(
                'key' => 'field_contact_address',
                'label' => 'Adresse',
                'name' => 'contact_address',
                'type' => 'textarea',
                'rows' => 2,
                'default_value' => 'Musterstraße 123, 1010 Wien',
            ),
            array(
                'key' => 'field_contact_hours',
                'label' => 'Öffnungszeiten',
                'name' => 'contact_hours',
                'type' => 'text',
                'default_value' => 'Mo - Fr: 8:00 - 17:00',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-kontakt',
                ),
            ),
        ),
    ));

    // Footer Options Fields
    acf_add_local_field_group(array(
        'key' => 'group_footer',
        'title' => 'Footer',
        'fields' => array(
            array(
                'key' => 'field_footer_description',
                'label' => 'Unternehmensbeschreibung',
                'name' => 'footer_description',
                'type' => 'textarea',
                'rows' => 3,
            ),
            array(
                'key' => 'field_footer_col2_title',
                'label' => 'Spalte 2 - Titel',
                'name' => 'footer_col2_title',
                'type' => 'text',
                'default_value' => 'Unsere Modelle',
            ),
            array(
                'key' => 'field_footer_col2_links',
                'label' => 'Spalte 2 - Links',
                'name' => 'footer_col2_links',
                'type' => 'repeater',
                'min' => 1,
                'max' => 10,
                'layout' => 'table',
                'button_label' => 'Link hinzufügen',
                'sub_fields' => array(
                    array(
                        'key' => 'field_footer_link_text',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_footer_link_url',
                        'label' => 'URL',
                        'name' => 'url',
                        'type' => 'url',
                    ),
                ),
            ),
            array(
                'key' => 'field_footer_copyright',
                'label' => 'Copyright-Text',
                'name' => 'footer_copyright',
                'type' => 'text',
                'default_value' => 'WohneGrün. Alle Rechte vorbehalten.',
            ),
            array(
                'key' => 'field_footer_legal_links',
                'label' => 'Rechtliche Links',
                'name' => 'footer_legal_links',
                'type' => 'repeater',
                'min' => 1,
                'max' => 5,
                'layout' => 'table',
                'button_label' => 'Link hinzufügen',
                'sub_fields' => array(
                    array(
                        'key' => 'field_legal_link_text',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_legal_link_url',
                        'label' => 'URL',
                        'name' => 'url',
                        'type' => 'url',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-footer',
                ),
            ),
        ),
    ));
}
// DISABLED: Using database field groups with corrected location rules instead
// Database field groups are visible in ACF admin AND work with blocks
// Local field groups would create duplicates
// add_action('acf/init', 'wohnegruen_register_block_fields');

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

