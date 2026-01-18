<?php
/**
 * Create ACF Field Groups for New Blocks
 *
 * Run this script ONCE to create field groups for:
 * - Modell-Tabs
 * - Galerie mit Tabs
 * - Werte-Raster
 * - Kontaktformular
 *
 * Access: https://wohnegruen.at/wp-content/themes/WohneGruen/create-new-acf-field-groups.php
 */

require_once('../../../wp-load.php');

if (!current_user_can('manage_options')) {
    wp_die('Access denied. You must be an administrator.');
}

if (!function_exists('acf_add_local_field_group')) {
    wp_die('ACF Pro is not active!');
}

$created = array();
$errors = array();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Create ACF Field Groups - WohneGrün</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: linear-gradient(135deg, #2d5016 0%, #3d6b1f 100%);
            padding: 20px;
            line-height: 1.6;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }
        h1 { color: #2d5016; margin-bottom: 20px; font-size: 2.2rem; }
        h2 { color: #2d5016; border-bottom: 3px solid #2d5016; padding-bottom: 10px; margin: 30px 0 20px 0; }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin: 10px 0;
            border-left: 5px solid #28a745;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 8px;
            margin: 10px 0;
            border-left: 5px solid #dc3545;
        }
        .info {
            background: #d1ecf1;
            color: #0c5460;
            padding: 15px;
            border-radius: 8px;
            margin: 10px 0;
            border-left: 5px solid #17a2b8;
        }
        .btn {
            display: inline-block;
            background: #2d5016;
            color: white;
            padding: 15px 40px;
            text-decoration: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            margin: 10px 5px;
        }
        .btn:hover { background: #3d6b1f; }
        code { background: #f4f4f4; padding: 3px 8px; border-radius: 3px; font-family: monospace; color: #c7254e; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎨 Create ACF Field Groups</h1>
        <p style="color: #666; margin-bottom: 30px;">Creating field groups for 4 new ACF blocks...</p>

        <?php

        // =====================================================
        // 1. MODEL TABS BLOCK
        // =====================================================

        try {
            acf_add_local_field_group(array(
                'key' => 'group_model_tabs',
                'title' => 'Modell-Tabs Block',
                'fields' => array(
                    array(
                        'key' => 'field_models',
                        'label' => 'Modelle',
                        'name' => 'models',
                        'type' => 'repeater',
                        'instructions' => 'Fügen Sie Modelle hinzu (z.B. Nature, Pure)',
                        'min' => 1,
                        'max' => 5,
                        'layout' => 'block',
                        'button_label' => 'Modell hinzufügen',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_model_slug',
                                'label' => 'Modell Slug',
                                'name' => 'model_slug',
                                'type' => 'text',
                                'instructions' => 'Eindeutiger Bezeichner (z.B. "nature", "pure")',
                                'required' => 1,
                                'wrapper' => array('width' => '33'),
                            ),
                            array(
                                'key' => 'field_model_icon',
                                'label' => 'Icon',
                                'name' => 'model_icon',
                                'type' => 'text',
                                'instructions' => 'Emoji (z.B. 🌿, ✨)',
                                'default_value' => '🏠',
                                'wrapper' => array('width' => '33'),
                            ),
                            array(
                                'key' => 'field_model_name',
                                'label' => 'Modell Name',
                                'name' => 'model_name',
                                'type' => 'text',
                                'required' => 1,
                                'wrapper' => array('width' => '34'),
                            ),
                            array(
                                'key' => 'field_model_tagline',
                                'label' => 'Tagline',
                                'name' => 'model_tagline',
                                'type' => 'text',
                                'instructions' => 'Kurze Beschreibung unter dem Tab',
                            ),
                            array(
                                'key' => 'field_model_badge',
                                'label' => 'Badge',
                                'name' => 'model_badge',
                                'type' => 'text',
                                'instructions' => 'Optional (z.B. "Beliebt", "Neu")',
                            ),
                            array(
                                'key' => 'field_model_description',
                                'label' => 'Beschreibung',
                                'name' => 'model_description',
                                'type' => 'textarea',
                                'rows' => 3,
                            ),
                            array(
                                'key' => 'field_hero_image',
                                'label' => 'Hero Hintergrundbild',
                                'name' => 'hero_image',
                                'type' => 'image',
                                'return_format' => 'array',
                                'preview_size' => 'large',
                            ),
                            array(
                                'key' => 'field_specs',
                                'label' => 'Spezifikationen',
                                'name' => 'specs',
                                'type' => 'repeater',
                                'min' => 0,
                                'max' => 4,
                                'layout' => 'table',
                                'button_label' => 'Spezifikation hinzufügen',
                                'sub_fields' => array(
                                    array(
                                        'key' => 'field_spec_value',
                                        'label' => 'Wert',
                                        'name' => 'value',
                                        'type' => 'text',
                                    ),
                                    array(
                                        'key' => 'field_spec_label',
                                        'label' => 'Bezeichnung',
                                        'name' => 'label',
                                        'type' => 'text',
                                    ),
                                ),
                            ),
                            array(
                                'key' => 'field_description_title',
                                'label' => 'Beschreibungs-Titel',
                                'name' => 'description_title',
                                'type' => 'text',
                            ),
                            array(
                                'key' => 'field_description_text',
                                'label' => 'Beschreibungs-Text',
                                'name' => 'description_text',
                                'type' => 'textarea',
                                'rows' => 5,
                            ),
                            array(
                                'key' => 'field_description_image',
                                'label' => 'Beschreibungs-Bild',
                                'name' => 'description_image',
                                'type' => 'image',
                                'return_format' => 'array',
                                'preview_size' => 'medium',
                            ),
                            array(
                                'key' => 'field_description_features',
                                'label' => 'Merkmale',
                                'name' => 'description_features',
                                'type' => 'repeater',
                                'min' => 0,
                                'max' => 10,
                                'layout' => 'table',
                                'button_label' => 'Merkmal hinzufügen',
                                'sub_fields' => array(
                                    array(
                                        'key' => 'field_feature_text',
                                        'label' => 'Merkmal',
                                        'name' => 'feature_text',
                                        'type' => 'text',
                                    ),
                                ),
                            ),
                            array(
                                'key' => 'field_color_schemes',
                                'label' => 'Farbvarianten',
                                'name' => 'color_schemes',
                                'type' => 'repeater',
                                'min' => 0,
                                'max' => 20,
                                'layout' => 'block',
                                'button_label' => 'Farbvariante hinzufügen',
                                'sub_fields' => array(
                                    array(
                                        'key' => 'field_scheme_name',
                                        'label' => 'Name',
                                        'name' => 'name',
                                        'type' => 'text',
                                        'instructions' => 'z.B. "Holz & Schwarz"',
                                    ),
                                    array(
                                        'key' => 'field_scheme_image',
                                        'label' => 'Bild',
                                        'name' => 'image',
                                        'type' => 'image',
                                        'return_format' => 'array',
                                        'preview_size' => 'medium',
                                    ),
                                    array(
                                        'key' => 'field_exterior_color',
                                        'label' => 'Außenfarbe',
                                        'name' => 'exterior_color',
                                        'type' => 'text',
                                        'wrapper' => array('width' => '50'),
                                    ),
                                    array(
                                        'key' => 'field_trim_color',
                                        'label' => 'Zierleisten-Farbe',
                                        'name' => 'trim_color',
                                        'type' => 'text',
                                        'wrapper' => array('width' => '50'),
                                    ),
                                ),
                            ),
                            array(
                                'key' => 'field_size_options',
                                'label' => 'Größenoptionen',
                                'name' => 'size_options',
                                'type' => 'repeater',
                                'min' => 0,
                                'max' => 5,
                                'layout' => 'block',
                                'button_label' => 'Größenoption hinzufügen',
                                'sub_fields' => array(
                                    array(
                                        'key' => 'field_size_badge',
                                        'label' => 'Badge',
                                        'name' => 'badge',
                                        'type' => 'text',
                                        'instructions' => 'z.B. "Standard", "Empfohlen"',
                                    ),
                                    array(
                                        'key' => 'field_size_name',
                                        'label' => 'Name',
                                        'name' => 'name',
                                        'type' => 'text',
                                    ),
                                    array(
                                        'key' => 'field_size_dimensions',
                                        'label' => 'Abmessungen',
                                        'name' => 'dimensions',
                                        'type' => 'text',
                                        'instructions' => 'z.B. "3 × 8 m"',
                                        'wrapper' => array('width' => '50'),
                                    ),
                                    array(
                                        'key' => 'field_size_area',
                                        'label' => 'Fläche',
                                        'name' => 'area',
                                        'type' => 'text',
                                        'instructions' => 'z.B. "24 m²"',
                                        'wrapper' => array('width' => '50'),
                                    ),
                                    array(
                                        'key' => 'field_size_featured',
                                        'label' => 'Hervorgehoben',
                                        'name' => 'featured',
                                        'type' => 'true_false',
                                        'ui' => 1,
                                    ),
                                    array(
                                        'key' => 'field_size_features',
                                        'label' => 'Merkmale',
                                        'name' => 'features',
                                        'type' => 'repeater',
                                        'min' => 0,
                                        'max' => 5,
                                        'layout' => 'table',
                                        'button_label' => 'Merkmal hinzufügen',
                                        'sub_fields' => array(
                                            array(
                                                'key' => 'field_size_feature',
                                                'label' => 'Merkmal',
                                                'name' => 'feature',
                                                'type' => 'text',
                                            ),
                                        ),
                                    ),
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
                            'value' => 'acf/wohnegruen-model-tabs',
                        ),
                    ),
                ),
            ));

            // Save to database
            acf_update_field_group(acf_get_field_group('group_model_tabs'));
            $created[] = 'Modell-Tabs Block';
            echo '<div class="success">✅ Created: <strong>Modell-Tabs Block</strong> field group</div>';
        } catch (Exception $e) {
            $errors[] = 'Modell-Tabs: ' . $e->getMessage();
            echo '<div class="error">❌ Error creating Modell-Tabs: ' . esc_html($e->getMessage()) . '</div>';
        }

        // =====================================================
        // 2. GALLERY TABS BLOCK
        // =====================================================

        try {
            acf_add_local_field_group(array(
                'key' => 'group_gallery_tabs',
                'title' => 'Galerie mit Tabs Block',
                'fields' => array(
                    array(
                        'key' => 'field_gallery_title',
                        'label' => 'Galerie Titel',
                        'name' => 'gallery_title',
                        'type' => 'text',
                        'default_value' => 'Galerie & 3D Rundgang',
                    ),
                    array(
                        'key' => 'field_gallery_subtitle',
                        'label' => 'Galerie Untertitel',
                        'name' => 'gallery_subtitle',
                        'type' => 'textarea',
                        'rows' => 2,
                    ),
                    array(
                        'key' => 'field_gallery_images',
                        'label' => 'Galerie Bilder',
                        'name' => 'gallery_images',
                        'type' => 'repeater',
                        'min' => 1,
                        'max' => 50,
                        'layout' => 'block',
                        'button_label' => 'Bild hinzufügen',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_gallery_image',
                                'label' => 'Bild',
                                'name' => 'image',
                                'type' => 'image',
                                'return_format' => 'array',
                                'preview_size' => 'medium',
                                'required' => 1,
                            ),
                            array(
                                'key' => 'field_gallery_image_title',
                                'label' => 'Titel',
                                'name' => 'title',
                                'type' => 'text',
                            ),
                            array(
                                'key' => 'field_gallery_image_category',
                                'label' => 'Kategorie',
                                'name' => 'category',
                                'type' => 'select',
                                'choices' => array(
                                    'exterior' => 'Außenansicht',
                                    'interior' => 'Innenausstattung',
                                    'terrace' => 'Terrasse',
                                    'other' => 'Sonstiges',
                                ),
                                'default_value' => 'exterior',
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_show_3d_tab',
                        'label' => '3D-Tour Tab anzeigen',
                        'name' => 'show_3d_tab',
                        'type' => 'true_false',
                        'ui' => 1,
                        'default_value' => 1,
                    ),
                    array(
                        'key' => 'field_floor_plans',
                        'label' => 'Grundrisse',
                        'name' => 'floor_plans',
                        'type' => 'repeater',
                        'min' => 0,
                        'max' => 20,
                        'layout' => 'block',
                        'button_label' => 'Grundriss hinzufügen',
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_show_3d_tab',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'sub_fields' => array(
                            array(
                                'key' => 'field_floor_plan_name',
                                'label' => 'Name',
                                'name' => 'name',
                                'type' => 'text',
                                'required' => 1,
                            ),
                            array(
                                'key' => 'field_floor_plan_image',
                                'label' => 'Bild',
                                'name' => 'image',
                                'type' => 'image',
                                'return_format' => 'array',
                                'preview_size' => 'medium',
                            ),
                            array(
                                'key' => 'field_floor_plan_size',
                                'label' => 'Größe',
                                'name' => 'size',
                                'type' => 'text',
                                'instructions' => 'z.B. "24 m²"',
                                'wrapper' => array('width' => '50'),
                            ),
                            array(
                                'key' => 'field_floor_plan_rooms',
                                'label' => 'Räume',
                                'name' => 'rooms',
                                'type' => 'text',
                                'instructions' => 'z.B. "3 x 8 m"',
                                'wrapper' => array('width' => '50'),
                            ),
                            array(
                                'key' => 'field_floor_plan_type',
                                'label' => 'Typ',
                                'name' => 'type',
                                'type' => 'select',
                                'choices' => array(
                                    'floorplan' => 'Grundriss',
                                    '360' => '360-Grad-Ansicht',
                                    'interior' => 'Innenausstattung',
                                ),
                                'default_value' => 'floorplan',
                            ),
                            array(
                                'key' => 'field_floor_plan_description',
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
                            'value' => 'acf/wohnegruen-gallery-tabs',
                        ),
                    ),
                ),
            ));

            acf_update_field_group(acf_get_field_group('group_gallery_tabs'));
            $created[] = 'Galerie mit Tabs Block';
            echo '<div class="success">✅ Created: <strong>Galerie mit Tabs Block</strong> field group</div>';
        } catch (Exception $e) {
            $errors[] = 'Galerie mit Tabs: ' . $e->getMessage();
            echo '<div class="error">❌ Error creating Galerie mit Tabs: ' . esc_html($e->getMessage()) . '</div>';
        }

        // =====================================================
        // 3. VALUES GRID BLOCK
        // =====================================================

        try {
            acf_add_local_field_group(array(
                'key' => 'group_values_grid',
                'title' => 'Werte-Raster Block',
                'fields' => array(
                    array(
                        'key' => 'field_values_title',
                        'label' => 'Titel',
                        'name' => 'values_title',
                        'type' => 'text',
                        'default_value' => 'Unsere Werte',
                    ),
                    array(
                        'key' => 'field_values_subtitle',
                        'label' => 'Untertitel',
                        'name' => 'values_subtitle',
                        'type' => 'textarea',
                        'rows' => 2,
                    ),
                    array(
                        'key' => 'field_values_background',
                        'label' => 'Hintergrund',
                        'name' => 'values_background',
                        'type' => 'select',
                        'choices' => array(
                            'light' => 'Hell (Grau)',
                            'white' => 'Weiß',
                        ),
                        'default_value' => 'light',
                    ),
                    array(
                        'key' => 'field_values_items',
                        'label' => 'Werte',
                        'name' => 'values_items',
                        'type' => 'repeater',
                        'min' => 1,
                        'max' => 8,
                        'layout' => 'block',
                        'button_label' => 'Wert hinzufügen',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_value_icon',
                                'label' => 'Icon',
                                'name' => 'icon',
                                'type' => 'select',
                                'choices' => array(
                                    'shield' => 'Schild (Qualität)',
                                    'leaf' => 'Blatt (Nachhaltigkeit)',
                                    'users' => 'Personen (Kundenzufriedenheit)',
                                    'star' => 'Stern (Innovation)',
                                    'check' => 'Haken (Zuverlässigkeit)',
                                    'heart' => 'Herz (Leidenschaft)',
                                    'clock' => 'Uhr (Pünktlichkeit)',
                                    'home' => 'Haus (Heimat)',
                                ),
                                'default_value' => 'star',
                            ),
                            array(
                                'key' => 'field_value_title',
                                'label' => 'Titel',
                                'name' => 'title',
                                'type' => 'text',
                                'required' => 1,
                            ),
                            array(
                                'key' => 'field_value_description',
                                'label' => 'Beschreibung',
                                'name' => 'description',
                                'type' => 'textarea',
                                'rows' => 3,
                            ),
                        ),
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'block',
                            'operator' => '==',
                            'value' => 'acf/wohnegruen-values-grid',
                        ),
                    ),
                ),
            ));

            acf_update_field_group(acf_get_field_group('group_values_grid'));
            $created[] = 'Werte-Raster Block';
            echo '<div class="success">✅ Created: <strong>Werte-Raster Block</strong> field group</div>';
        } catch (Exception $e) {
            $errors[] = 'Werte-Raster: ' . $e->getMessage();
            echo '<div class="error">❌ Error creating Werte-Raster: ' . esc_html($e->getMessage()) . '</div>';
        }

        // =====================================================
        // 4. CONTACT FORM BLOCK
        // =====================================================

        try {
            acf_add_local_field_group(array(
                'key' => 'group_contact_form',
                'title' => 'Kontaktformular Block',
                'fields' => array(
                    array(
                        'key' => 'field_show_info_bar',
                        'label' => 'Info-Leiste anzeigen',
                        'name' => 'show_info_bar',
                        'type' => 'true_false',
                        'ui' => 1,
                        'default_value' => 1,
                    ),
                    array(
                        'key' => 'field_info_title',
                        'label' => 'Info Titel',
                        'name' => 'info_title',
                        'type' => 'text',
                        'default_value' => 'Wir sind für Sie da',
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_show_info_bar',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_info_subtitle',
                        'label' => 'Info Untertitel',
                        'name' => 'info_subtitle',
                        'type' => 'textarea',
                        'rows' => 2,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_show_info_bar',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_contact_info',
                        'label' => 'Kontaktinformationen',
                        'name' => 'contact_info',
                        'type' => 'repeater',
                        'min' => 1,
                        'max' => 6,
                        'layout' => 'table',
                        'button_label' => 'Info hinzufügen',
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_show_info_bar',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'sub_fields' => array(
                            array(
                                'key' => 'field_contact_icon',
                                'label' => 'Icon',
                                'name' => 'icon',
                                'type' => 'select',
                                'choices' => array(
                                    'phone' => 'Telefon',
                                    'email' => 'E-Mail',
                                    'location' => 'Standort',
                                    'clock' => 'Öffnungszeiten',
                                ),
                                'default_value' => 'phone',
                            ),
                            array(
                                'key' => 'field_contact_label',
                                'label' => 'Bezeichnung',
                                'name' => 'label',
                                'type' => 'text',
                            ),
                            array(
                                'key' => 'field_contact_value',
                                'label' => 'Wert',
                                'name' => 'value',
                                'type' => 'text',
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_show_form',
                        'label' => 'Formular anzeigen',
                        'name' => 'show_form',
                        'type' => 'true_false',
                        'ui' => 1,
                        'default_value' => 1,
                    ),
                    array(
                        'key' => 'field_show_map',
                        'label' => 'Karte anzeigen',
                        'name' => 'show_map',
                        'type' => 'true_false',
                        'ui' => 1,
                        'default_value' => 1,
                    ),
                    array(
                        'key' => 'field_map_title',
                        'label' => 'Karten Titel',
                        'name' => 'map_title',
                        'type' => 'text',
                        'default_value' => 'Besuchen Sie uns',
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_show_map',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_map_embed_code',
                        'label' => 'Google Maps Einbettungscode',
                        'name' => 'map_embed_code',
                        'type' => 'textarea',
                        'rows' => 5,
                        'instructions' => 'Fügen Sie den kompletten iframe-Code von Google Maps ein',
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_show_map',
                                    'operator' => '==',
                                    'value' => '1',
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
                            'value' => 'acf/wohnegruen-contact-form',
                        ),
                    ),
                ),
            ));

            acf_update_field_group(acf_get_field_group('group_contact_form'));
            $created[] = 'Kontaktformular Block';
            echo '<div class="success">✅ Created: <strong>Kontaktformular Block</strong> field group</div>';
        } catch (Exception $e) {
            $errors[] = 'Kontaktformular: ' . $e->getMessage();
            echo '<div class="error">❌ Error creating Kontaktformular: ' . esc_html($e->getMessage()) . '</div>';
        }

        ?>

        <h2>✅ Summary</h2>

        <?php if (count($created) > 0): ?>
            <div class="success">
                <strong>Successfully created <?php echo count($created); ?> field groups:</strong><br>
                <ul style="margin: 10px 0 0 20px;">
                    <?php foreach ($created as $name): ?>
                        <li><?php echo esc_html($name); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (count($errors) > 0): ?>
            <div class="error">
                <strong>Errors (<?php echo count($errors); ?>):</strong><br>
                <ul style="margin: 10px 0 0 20px;">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo esc_html($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <h2>📝 Next Steps</h2>

        <div class="info">
            <strong>1. Verify field groups in ACF:</strong><br>
            → Go to <a href="<?php echo admin_url('edit.php?post_type=acf-field-group'); ?>" target="_blank">ACF → Field Groups</a><br>
            → You should see all 4 new field groups<br><br>

            <strong>2. Run the conversion script:</strong><br>
            → <a href="<?php echo get_template_directory_uri(); ?>/switch-to-acf-blocks.php" target="_blank">Switch to ACF Blocks</a><br>
            → This removes custom templates and enables ACF blocks<br><br>

            <strong>3. Build your pages:</strong><br>
            → Go to <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" target="_blank">Pages</a><br>
            → Edit each page and add the new blocks<br>
            → All 15 blocks are now available!
        </div>

        <div style="text-align: center; margin: 40px 0;">
            <a href="<?php echo admin_url('edit.php?post_type=acf-field-group'); ?>" class="btn" target="_blank">
                📝 View ACF Field Groups
            </a>
            <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" class="btn" target="_blank">
                📄 Edit Pages
            </a>
        </div>

    </div>
</body>
</html>
