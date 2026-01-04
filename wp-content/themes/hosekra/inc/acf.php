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
function alpenhomes_register_acf_blocks() {
    if (!function_exists('acf_register_block_type')) {
        return;
    }

    // Block Category
    $category = 'alpenhomes';

    // Hero Block
    acf_register_block_type(array(
        'name'              => 'alpenhomes-hero',
        'title'             => __('Hero Sekcija', 'alpenhomes'),
        'description'       => __('Glavna hero sekcija z ozadjem, naslovom in CTA gumbi.', 'alpenhomes'),
        'render_template'   => 'template-parts/blocks/block-hero.php',
        'category'          => $category,
        'icon'              => 'cover-image',
        'keywords'          => array('hero', 'header', 'banner', 'naslov'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
            'jsx' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('page'),
    ));

    // Features Block
    acf_register_block_type(array(
        'name'              => 'alpenhomes-features',
        'title'             => __('Prednosti', 'alpenhomes'),
        'description'       => __('Mreža prednosti/storitev z ikonami.', 'alpenhomes'),
        'render_template'   => 'template-parts/blocks/block-features.php',
        'category'          => $category,
        'icon'              => 'grid-view',
        'keywords'          => array('features', 'prednosti', 'storitve', 'ikone'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('page'),
    ));

    // Models Block
    acf_register_block_type(array(
        'name'              => 'alpenhomes-models',
        'title'             => __('Modeli', 'alpenhomes'),
        'description'       => __('Prikaz mobilnih hišk/modelov.', 'alpenhomes'),
        'render_template'   => 'template-parts/blocks/block-models.php',
        'category'          => $category,
        'icon'              => 'admin-home',
        'keywords'          => array('models', 'modeli', 'hiške', 'izdelki'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('page'),
    ));

    // About Block
    acf_register_block_type(array(
        'name'              => 'alpenhomes-about',
        'title'             => __('O nas', 'alpenhomes'),
        'description'       => __('Sekcija o podjetju s sliko in besedilom.', 'alpenhomes'),
        'render_template'   => 'template-parts/blocks/block-about.php',
        'category'          => $category,
        'icon'              => 'admin-users',
        'keywords'          => array('about', 'o nas', 'podjetje'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('page'),
    ));

    // Contact Block
    acf_register_block_type(array(
        'name'              => 'alpenhomes-contact',
        'title'             => __('Kontakt', 'alpenhomes'),
        'description'       => __('Kontaktna sekcija z obrazcem in podatki.', 'alpenhomes'),
        'render_template'   => 'template-parts/blocks/block-contact.php',
        'category'          => $category,
        'icon'              => 'email',
        'keywords'          => array('contact', 'kontakt', 'obrazec'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('page'),
    ));

    // Gallery Block
    acf_register_block_type(array(
        'name'              => 'alpenhomes-gallery',
        'title'             => __('Galerija', 'alpenhomes'),
        'description'       => __('Galerija slik s filtri in lightboxom.', 'alpenhomes'),
        'render_template'   => 'template-parts/blocks/block-gallery.php',
        'category'          => $category,
        'icon'              => 'format-gallery',
        'keywords'          => array('gallery', 'galerija', 'slike'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('page'),
    ));

    // 3D Tour Block
    acf_register_block_type(array(
        'name'              => 'alpenhomes-3d-tour',
        'title'             => __('3D Ogled', 'alpenhomes'),
        'description'       => __('Interaktivni 3D ogled ali video predstavitev.', 'alpenhomes'),
        'render_template'   => 'template-parts/blocks/block-3d-tour.php',
        'category'          => $category,
        'icon'              => 'visibility',
        'keywords'          => array('3d', 'tour', 'ogled'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('page'),
    ));

    // Floor Plans Block
    acf_register_block_type(array(
        'name'              => 'alpenhomes-floor-plans',
        'title'             => __('Tlorisi', 'alpenhomes'),
        'description'       => __('Prikaz tlorisov in postavitev prostorov.', 'alpenhomes'),
        'render_template'   => 'template-parts/blocks/block-floor-plans.php',
        'category'          => $category,
        'icon'              => 'layout',
        'keywords'          => array('tloris', 'layout'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('page'),
    ));

    // Interiors Block
    acf_register_block_type(array(
        'name'              => 'alpenhomes-interiors',
        'title'             => __('Notranjost', 'alpenhomes'),
        'description'       => __('Predstavitev notranjosti in opreme.', 'alpenhomes'),
        'render_template'   => 'template-parts/blocks/block-interiors.php',
        'category'          => $category,
        'icon'              => 'admin-appearance',
        'keywords'          => array('interior', 'notranjost'),
        'supports'          => array(
            'align' => array('full', 'wide'),
            'anchor' => true,
        ),
        'mode'              => 'preview',
        'post_types'        => array('page'),
    ));

    // CTA Block
    acf_register_block_type(array(
        'name'              => 'alpenhomes-cta',
        'title'             => __('CTA Sekcija', 'alpenhomes'),
        'description'       => __('Call-to-action sekcija z gumbom.', 'alpenhomes'),
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
}
add_action('acf/init', 'alpenhomes_register_acf_blocks');

/**
 * Register custom block category
 */
function alpenhomes_block_categories($categories) {
    return array_merge(
        array(
            array(
                'slug'  => 'alpenhomes',
                'title' => __('AlpenHomes', 'alpenhomes'),
                'icon'  => 'admin-home',
            ),
        ),
        $categories
    );
}
add_filter('block_categories_all', 'alpenhomes_block_categories', 10, 1);

/**
 * Register ACF Options Pages
 */
function alpenhomes_register_options_pages() {
    if (!function_exists('acf_add_options_page')) {
        return;
    }

    acf_add_options_page(array(
        'page_title'    => 'AlpenHomes Nastavitve',
        'menu_title'    => 'AlpenHomes',
        'menu_slug'     => 'alpenhomes-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false,
        'icon_url'      => 'dashicons-admin-home',
        'position'      => 2,
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Navigacija',
        'menu_title'    => 'Navigacija',
        'parent_slug'   => 'alpenhomes-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Footer',
        'menu_title'    => 'Footer',
        'parent_slug'   => 'alpenhomes-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Kontaktni podatki',
        'menu_title'    => 'Kontakt',
        'parent_slug'   => 'alpenhomes-settings',
    ));
}
add_action('acf/init', 'alpenhomes_register_options_pages');

/**
 * Register ACF Field Groups for Blocks
 */
function alpenhomes_register_block_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    // Hero Block Fields
    acf_add_local_field_group(array(
        'key' => 'group_block_hero',
        'title' => 'Hero Blok',
        'fields' => array(
            array(
                'key' => 'field_block_hero_background',
                'label' => 'Ozadje slika',
                'name' => 'hero_background',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'large',
                'instructions' => 'Priporocena velikost: 1920x1080px',
            ),
            array(
                'key' => 'field_block_hero_badge',
                'label' => 'Badge tekst',
                'name' => 'hero_badge',
                'type' => 'text',
                'default_value' => 'Dobavljivo po celi Sloveniji',
            ),
            array(
                'key' => 'field_block_hero_title',
                'label' => 'Naslov',
                'name' => 'hero_title',
                'type' => 'text',
                'default_value' => 'Gradimo vas sanjski dom',
            ),
            array(
                'key' => 'field_block_hero_subtitle',
                'label' => 'Podnaslov',
                'name' => 'hero_subtitle',
                'type' => 'textarea',
                'rows' => 2,
            ),
            array(
                'key' => 'field_block_hero_btn1_text',
                'label' => 'Gumb 1 - Tekst',
                'name' => 'hero_btn1_text',
                'type' => 'text',
                'default_value' => 'Oglejte si modele',
                'wrapper' => array('width' => '50'),
            ),
            array(
                'key' => 'field_block_hero_btn1_link',
                'label' => 'Gumb 1 - Povezava',
                'name' => 'hero_btn1_link',
                'type' => 'url',
                'wrapper' => array('width' => '50'),
            ),
            array(
                'key' => 'field_block_hero_btn2_text',
                'label' => 'Gumb 2 - Tekst',
                'name' => 'hero_btn2_text',
                'type' => 'text',
                'default_value' => 'Pridobite cenik',
                'wrapper' => array('width' => '50'),
            ),
            array(
                'key' => 'field_block_hero_btn2_link',
                'label' => 'Gumb 2 - Povezava',
                'name' => 'hero_btn2_link',
                'type' => 'url',
                'wrapper' => array('width' => '50'),
            ),
            array(
                'key' => 'field_block_hero_stats',
                'label' => 'Statistika',
                'name' => 'hero_stats',
                'type' => 'repeater',
                'min' => 0,
                'max' => 4,
                'layout' => 'table',
                'button_label' => 'Dodaj statistiko',
                'sub_fields' => array(
                    array(
                        'key' => 'field_block_hero_stat_number',
                        'label' => 'Stevilka',
                        'name' => 'number',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_block_hero_stat_label',
                        'label' => 'Oznaka',
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
                    'value' => 'acf/alpenhomes-hero',
                ),
            ),
        ),
    ));

    // Features Block Fields
    acf_add_local_field_group(array(
        'key' => 'group_block_features',
        'title' => 'Prednosti Blok',
        'fields' => array(
            array(
                'key' => 'field_block_features_title',
                'label' => 'Naslov',
                'name' => 'features_title',
                'type' => 'text',
                'default_value' => 'Zakaj izbrati nas?',
            ),
            array(
                'key' => 'field_block_features_subtitle',
                'label' => 'Podnaslov',
                'name' => 'features_subtitle',
                'type' => 'textarea',
                'rows' => 2,
            ),
            array(
                'key' => 'field_block_features_items',
                'label' => 'Prednosti',
                'name' => 'features_items',
                'type' => 'repeater',
                'min' => 1,
                'max' => 6,
                'layout' => 'block',
                'button_label' => 'Dodaj prednost',
                'sub_fields' => array(
                    array(
                        'key' => 'field_block_feature_icon',
                        'label' => 'Ikona',
                        'name' => 'icon',
                        'type' => 'select',
                        'choices' => array(
                            'shield' => 'Scit (garancija)',
                            'star' => 'Zvezda (kakovost)',
                            'truck' => 'Dostava',
                            'tools' => 'Orodja (storitev)',
                            'leaf' => 'List (ekologija)',
                            'home' => 'Hisa',
                            'check' => 'Kljukica',
                            'users' => 'Uporabniki',
                            'location' => 'Lokacija',
                        ),
                        'wrapper' => array('width' => '30'),
                    ),
                    array(
                        'key' => 'field_block_feature_title',
                        'label' => 'Naslov',
                        'name' => 'title',
                        'type' => 'text',
                        'wrapper' => array('width' => '70'),
                    ),
                    array(
                        'key' => 'field_block_feature_text',
                        'label' => 'Besedilo',
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
                    'value' => 'acf/alpenhomes-features',
                ),
            ),
        ),
    ));

    // Models Block Fields
    acf_add_local_field_group(array(
        'key' => 'group_block_models',
        'title' => 'Modeli Blok',
        'fields' => array(
            array(
                'key' => 'field_block_models_title',
                'label' => 'Naslov',
                'name' => 'models_title',
                'type' => 'text',
                'default_value' => 'Nasi modeli',
            ),
            array(
                'key' => 'field_block_models_subtitle',
                'label' => 'Podnaslov',
                'name' => 'models_subtitle',
                'type' => 'textarea',
                'rows' => 2,
            ),
            array(
                'key' => 'field_block_models_source',
                'label' => 'Vir podatkov',
                'name' => 'models_source',
                'type' => 'select',
                'choices' => array(
                    'cpt' => 'Iz custom post type (Mobilne Hiske)',
                    'manual' => 'Rocni vnos',
                ),
                'default_value' => 'cpt',
            ),
            array(
                'key' => 'field_block_models_count',
                'label' => 'Stevilo modelov',
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
                'label' => 'Modeli',
                'name' => 'models_items',
                'type' => 'repeater',
                'min' => 1,
                'max' => 8,
                'layout' => 'block',
                'button_label' => 'Dodaj model',
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
                        'label' => 'Slika',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                    ),
                    array(
                        'key' => 'field_block_model_title',
                        'label' => 'Naziv modela',
                        'name' => 'title',
                        'type' => 'text',
                        'wrapper' => array('width' => '50'),
                    ),
                    array(
                        'key' => 'field_block_model_link',
                        'label' => 'Povezava',
                        'name' => 'link',
                        'type' => 'url',
                        'wrapper' => array('width' => '50'),
                    ),
                    array(
                        'key' => 'field_block_model_description',
                        'label' => 'Opis',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 2,
                    ),
                    array(
                        'key' => 'field_block_model_size',
                        'label' => 'Velikost (m2)',
                        'name' => 'size',
                        'type' => 'text',
                        'wrapper' => array('width' => '33'),
                    ),
                    array(
                        'key' => 'field_block_model_rooms',
                        'label' => 'Stevilo sob',
                        'name' => 'rooms',
                        'type' => 'text',
                        'wrapper' => array('width' => '33'),
                    ),
                    array(
                        'key' => 'field_block_model_persons',
                        'label' => 'Stevilo oseb',
                        'name' => 'persons',
                        'type' => 'text',
                        'wrapper' => array('width' => '34'),
                    ),
                    array(
                        'key' => 'field_block_model_price',
                        'label' => 'Cena',
                        'name' => 'price',
                        'type' => 'text',
                    ),
                ),
            ),
            array(
                'key' => 'field_block_models_cta_text',
                'label' => 'CTA gumb tekst',
                'name' => 'models_cta_text',
                'type' => 'text',
                'default_value' => 'Oglejte si vse modele',
                'wrapper' => array('width' => '50'),
            ),
            array(
                'key' => 'field_block_models_cta_link',
                'label' => 'CTA gumb povezava',
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
                    'value' => 'acf/alpenhomes-models',
                ),
            ),
        ),
    ));

    // 3D Tour Block Fields
    acf_add_local_field_group(array(
        'key' => 'group_block_3d_tour',
        'title' => '3D Ogled Blok',
        'fields' => array(
            array(
                'key' => 'field_block_3d_title',
                'label' => 'Naslov',
                'name' => 'tour_title',
                'type' => 'text',
                'default_value' => 'Virtualni ogled',
            ),
            array(
                'key' => 'field_block_3d_subtitle',
                'label' => 'Podnaslov',
                'name' => 'tour_subtitle',
                'type' => 'textarea',
                'rows' => 2,
            ),
            array(
                'key' => 'field_block_3d_type',
                'label' => 'Tip vsebine',
                'name' => 'tour_type',
                'type' => 'select',
                'choices' => array(
                    'video' => 'Video (YouTube/Vimeo)',
                    'iframe' => 'Iframe (3D ogled)',
                    'image' => 'Slika s predogledom',
                ),
                'default_value' => 'video',
            ),
            array(
                'key' => 'field_block_3d_video_url',
                'label' => 'Video URL',
                'name' => 'tour_video_url',
                'type' => 'url',
                'instructions' => 'YouTube ali Vimeo povezava',
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
                'label' => 'Iframe koda',
                'name' => 'tour_iframe',
                'type' => 'textarea',
                'instructions' => 'Vnesite embed kodo za 3D ogled (Matterport, etc.)',
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
                'label' => 'Predogledna slika',
                'name' => 'tour_preview_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'large',
            ),
            array(
                'key' => 'field_block_3d_features',
                'label' => 'Znacilnosti',
                'name' => 'tour_features',
                'type' => 'repeater',
                'min' => 0,
                'max' => 4,
                'layout' => 'table',
                'button_label' => 'Dodaj znacilnost',
                'sub_fields' => array(
                    array(
                        'key' => 'field_block_3d_feature_icon',
                        'label' => 'Ikona',
                        'name' => 'icon',
                        'type' => 'select',
                        'choices' => array(
                            'cube' => '3D Kocka',
                            'expand' => 'Razsiri',
                            'play' => 'Predvajaj',
                            'grid' => 'Mrezha',
                        ),
                    ),
                    array(
                        'key' => 'field_block_3d_feature_text',
                        'label' => 'Besedilo',
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
                    'value' => 'acf/alpenhomes-3d-tour',
                ),
            ),
        ),
    ));

    // Floor Plans Block Fields
    acf_add_local_field_group(array(
        'key' => 'group_block_floor_plans',
        'title' => 'Tlorisi Blok',
        'fields' => array(
            array(
                'key' => 'field_block_floor_title',
                'label' => 'Naslov',
                'name' => 'floor_title',
                'type' => 'text',
                'default_value' => 'Tlorisi in postavitve',
            ),
            array(
                'key' => 'field_block_floor_subtitle',
                'label' => 'Podnaslov',
                'name' => 'floor_subtitle',
                'type' => 'textarea',
                'rows' => 2,
            ),
            array(
                'key' => 'field_block_floor_plans',
                'label' => 'Tlorisi',
                'name' => 'floor_plans',
                'type' => 'repeater',
                'min' => 1,
                'max' => 10,
                'layout' => 'block',
                'button_label' => 'Dodaj tloris',
                'sub_fields' => array(
                    array(
                        'key' => 'field_block_floor_plan_name',
                        'label' => 'Naziv',
                        'name' => 'name',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_block_floor_plan_image',
                        'label' => 'Slika tlorisa',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                    ),
                    array(
                        'key' => 'field_block_floor_plan_size',
                        'label' => 'Velikost',
                        'name' => 'size',
                        'type' => 'text',
                        'wrapper' => array('width' => '33'),
                    ),
                    array(
                        'key' => 'field_block_floor_plan_rooms',
                        'label' => 'Sobe',
                        'name' => 'rooms',
                        'type' => 'text',
                        'wrapper' => array('width' => '33'),
                    ),
                    array(
                        'key' => 'field_block_floor_plan_bath',
                        'label' => 'Kopalnice',
                        'name' => 'bathrooms',
                        'type' => 'text',
                        'wrapper' => array('width' => '34'),
                    ),
                    array(
                        'key' => 'field_block_floor_plan_desc',
                        'label' => 'Opis',
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
                    'value' => 'acf/alpenhomes-floor-plans',
                ),
            ),
        ),
    ));

    // Interiors Block Fields
    acf_add_local_field_group(array(
        'key' => 'group_block_interiors',
        'title' => 'Notranjost Blok',
        'fields' => array(
            array(
                'key' => 'field_block_interior_title',
                'label' => 'Naslov',
                'name' => 'interior_title',
                'type' => 'text',
                'default_value' => 'Notranjost',
            ),
            array(
                'key' => 'field_block_interior_subtitle',
                'label' => 'Podnaslov',
                'name' => 'interior_subtitle',
                'type' => 'textarea',
                'rows' => 2,
            ),
            array(
                'key' => 'field_block_interior_rooms',
                'label' => 'Prostori',
                'name' => 'interior_rooms',
                'type' => 'repeater',
                'min' => 1,
                'max' => 8,
                'layout' => 'block',
                'button_label' => 'Dodaj prostor',
                'sub_fields' => array(
                    array(
                        'key' => 'field_block_interior_room_name',
                        'label' => 'Naziv prostora',
                        'name' => 'name',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_block_interior_room_image',
                        'label' => 'Slika',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                    ),
                    array(
                        'key' => 'field_block_interior_room_desc',
                        'label' => 'Opis',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 2,
                    ),
                    array(
                        'key' => 'field_block_interior_room_features',
                        'label' => 'Znacilnosti',
                        'name' => 'features',
                        'type' => 'textarea',
                        'rows' => 3,
                        'instructions' => 'Vsaka znacilnost v novi vrstici',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/alpenhomes-interiors',
                ),
            ),
        ),
    ));

    // Gallery Block Fields
    acf_add_local_field_group(array(
        'key' => 'group_block_gallery',
        'title' => 'Galerija Blok',
        'fields' => array(
            array(
                'key' => 'field_block_gallery_title',
                'label' => 'Naslov',
                'name' => 'gallery_title',
                'type' => 'text',
                'default_value' => 'Galerija',
            ),
            array(
                'key' => 'field_block_gallery_subtitle',
                'label' => 'Podnaslov',
                'name' => 'gallery_subtitle',
                'type' => 'textarea',
                'rows' => 2,
            ),
            array(
                'key' => 'field_block_gallery_show_filters',
                'label' => 'Prikazi filtre',
                'name' => 'gallery_show_filters',
                'type' => 'true_false',
                'default_value' => 1,
                'ui' => 1,
            ),
            array(
                'key' => 'field_block_gallery_images',
                'label' => 'Slike',
                'name' => 'gallery_images',
                'type' => 'repeater',
                'min' => 1,
                'layout' => 'block',
                'button_label' => 'Dodaj sliko',
                'sub_fields' => array(
                    array(
                        'key' => 'field_block_gallery_image',
                        'label' => 'Slika',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                    ),
                    array(
                        'key' => 'field_block_gallery_image_title',
                        'label' => 'Naslov',
                        'name' => 'title',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_block_gallery_image_category',
                        'label' => 'Kategorija',
                        'name' => 'category',
                        'type' => 'select',
                        'choices' => array(
                            'zunanjost' => 'Zunanjost',
                            'notranjost' => 'Notranjost',
                            'terasa' => 'Terasa',
                            'detajli' => 'Detajli',
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
                    'value' => 'acf/alpenhomes-gallery',
                ),
            ),
        ),
    ));

    // About Block Fields
    acf_add_local_field_group(array(
        'key' => 'group_block_about',
        'title' => 'O nas Blok',
        'fields' => array(
            array(
                'key' => 'field_block_about_image',
                'label' => 'Slika',
                'name' => 'about_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'large',
            ),
            array(
                'key' => 'field_block_about_badge_number',
                'label' => 'Badge - Stevilka',
                'name' => 'about_badge_number',
                'type' => 'text',
                'default_value' => '15+',
                'wrapper' => array('width' => '50'),
            ),
            array(
                'key' => 'field_block_about_badge_text',
                'label' => 'Badge - Tekst',
                'name' => 'about_badge_text',
                'type' => 'text',
                'default_value' => 'Let izkusenj',
                'wrapper' => array('width' => '50'),
            ),
            array(
                'key' => 'field_block_about_title',
                'label' => 'Naslov',
                'name' => 'about_title',
                'type' => 'text',
            ),
            array(
                'key' => 'field_block_about_text1',
                'label' => 'Besedilo 1',
                'name' => 'about_text1',
                'type' => 'textarea',
                'rows' => 3,
            ),
            array(
                'key' => 'field_block_about_text2',
                'label' => 'Besedilo 2',
                'name' => 'about_text2',
                'type' => 'textarea',
                'rows' => 3,
            ),
            array(
                'key' => 'field_block_about_list',
                'label' => 'Seznam prednosti',
                'name' => 'about_list',
                'type' => 'repeater',
                'min' => 1,
                'max' => 10,
                'layout' => 'table',
                'button_label' => 'Dodaj tocko',
                'sub_fields' => array(
                    array(
                        'key' => 'field_block_about_list_item',
                        'label' => 'Besedilo',
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
                    'value' => 'acf/alpenhomes-about',
                ),
            ),
        ),
    ));

    // Contact Block Fields
    acf_add_local_field_group(array(
        'key' => 'group_block_contact',
        'title' => 'Kontakt Blok',
        'fields' => array(
            array(
                'key' => 'field_block_contact_title',
                'label' => 'Naslov',
                'name' => 'contact_title',
                'type' => 'text',
                'default_value' => 'Kontaktirajte nas',
            ),
            array(
                'key' => 'field_block_contact_subtitle',
                'label' => 'Podnaslov',
                'name' => 'contact_subtitle',
                'type' => 'textarea',
                'rows' => 2,
            ),
            array(
                'key' => 'field_block_contact_bar_title',
                'label' => 'Info bar - Naslov',
                'name' => 'contact_bar_title',
                'type' => 'text',
                'default_value' => 'Vedno smo vam na voljo',
            ),
            array(
                'key' => 'field_block_contact_bar_text',
                'label' => 'Info bar - Besedilo',
                'name' => 'contact_bar_text',
                'type' => 'textarea',
                'rows' => 2,
            ),
            array(
                'key' => 'field_block_contact_form_shortcode',
                'label' => 'Kontaktni obrazec (shortcode)',
                'name' => 'contact_form_shortcode',
                'type' => 'text',
                'instructions' => 'Vnesite shortcode za kontaktni obrazec (npr. Contact Form 7)',
                'placeholder' => '[contact-form-7 id="123"]',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/alpenhomes-contact',
                ),
            ),
        ),
    ));

    // CTA Block Fields
    acf_add_local_field_group(array(
        'key' => 'group_block_cta',
        'title' => 'CTA Blok',
        'fields' => array(
            array(
                'key' => 'field_block_cta_title',
                'label' => 'Naslov',
                'name' => 'cta_title',
                'type' => 'text',
            ),
            array(
                'key' => 'field_block_cta_text',
                'label' => 'Besedilo',
                'name' => 'cta_text',
                'type' => 'textarea',
                'rows' => 2,
            ),
            array(
                'key' => 'field_block_cta_btn_text',
                'label' => 'Gumb tekst',
                'name' => 'cta_btn_text',
                'type' => 'text',
                'default_value' => 'Kontaktirajte nas',
                'wrapper' => array('width' => '50'),
            ),
            array(
                'key' => 'field_block_cta_btn_link',
                'label' => 'Gumb povezava',
                'name' => 'cta_btn_link',
                'type' => 'url',
                'wrapper' => array('width' => '50'),
            ),
            array(
                'key' => 'field_block_cta_background',
                'label' => 'Ozadje',
                'name' => 'cta_background',
                'type' => 'select',
                'choices' => array(
                    'primary' => 'Zelena',
                    'dark' => 'Temna',
                    'light' => 'Svetla',
                ),
                'default_value' => 'primary',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/alpenhomes-cta',
                ),
            ),
        ),
    ));

    // Navigation Options Fields
    acf_add_local_field_group(array(
        'key' => 'group_navigation',
        'title' => 'Navigacija',
        'fields' => array(
            array(
                'key' => 'field_nav_logo',
                'label' => 'Logo',
                'name' => 'nav_logo',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'instructions' => 'Nalozite SVG ali PNG logo',
            ),
            array(
                'key' => 'field_nav_logo_alt',
                'label' => 'Logo Alt (za footer/temno ozadje)',
                'name' => 'nav_logo_alt',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ),
            array(
                'key' => 'field_nav_cta_text',
                'label' => 'CTA gumb tekst',
                'name' => 'nav_cta_text',
                'type' => 'text',
                'default_value' => 'Kontaktirajte nas',
            ),
            array(
                'key' => 'field_nav_cta_link',
                'label' => 'CTA gumb povezava',
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
        'title' => 'Kontaktni podatki',
        'fields' => array(
            array(
                'key' => 'field_contact_phone',
                'label' => 'Telefon',
                'name' => 'contact_phone',
                'type' => 'text',
                'default_value' => '+386 1 234 5678',
            ),
            array(
                'key' => 'field_contact_email',
                'label' => 'E-posta',
                'name' => 'contact_email',
                'type' => 'email',
                'default_value' => 'info@alpenhomes.si',
            ),
            array(
                'key' => 'field_contact_address',
                'label' => 'Naslov',
                'name' => 'contact_address',
                'type' => 'textarea',
                'rows' => 2,
                'default_value' => 'Ulica 123, 1000 Ljubljana',
            ),
            array(
                'key' => 'field_contact_hours',
                'label' => 'Delovni cas',
                'name' => 'contact_hours',
                'type' => 'text',
                'default_value' => 'Pon - Pet: 8:00 - 17:00',
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
                'label' => 'Opis podjetja',
                'name' => 'footer_description',
                'type' => 'textarea',
                'rows' => 3,
            ),
            array(
                'key' => 'field_footer_col2_title',
                'label' => 'Stolpec 2 - Naslov',
                'name' => 'footer_col2_title',
                'type' => 'text',
                'default_value' => 'Nasi modeli',
            ),
            array(
                'key' => 'field_footer_col2_links',
                'label' => 'Stolpec 2 - Povezave',
                'name' => 'footer_col2_links',
                'type' => 'repeater',
                'min' => 1,
                'max' => 10,
                'layout' => 'table',
                'button_label' => 'Dodaj povezavo',
                'sub_fields' => array(
                    array(
                        'key' => 'field_footer_link_text',
                        'label' => 'Tekst',
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
                'label' => 'Copyright tekst',
                'name' => 'footer_copyright',
                'type' => 'text',
                'default_value' => 'AlpenHomes. Vse pravice pridržane.',
            ),
            array(
                'key' => 'field_footer_legal_links',
                'label' => 'Pravne povezave',
                'name' => 'footer_legal_links',
                'type' => 'repeater',
                'min' => 1,
                'max' => 5,
                'layout' => 'table',
                'button_label' => 'Dodaj povezavo',
                'sub_fields' => array(
                    array(
                        'key' => 'field_legal_link_text',
                        'label' => 'Tekst',
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
add_action('acf/init', 'alpenhomes_register_block_fields');

/**
 * Globalna Options Page (ACF)
 * Vse ACF registracije naj tečejo na acf/init.
 */
add_action('acf/init', function () {
    if (!function_exists('acf_add_options_page')) {
        return;
    }

    acf_add_options_page([
        'page_title'  => 'Nastavitve strani',
        'menu_title'  => 'Nastavitve',
        'menu_slug'   => 'site-settings',
        'capability'  => 'edit_posts',
        'redirect'    => false,
    ]);
});

