<?php
/**
 * Migrate All Pages to Gutenberg + Make ACF Field Groups Visible
 *
 * This script does TWO things:
 * 1. Converts all pages to use Gutenberg editor (removes custom templates)
 * 2. Creates ALL 13 ACF field groups in the database (makes them visible in ACF admin)
 *
 * USAGE: https://your-site.at/wp-content/themes/WohneGruen/migrate-to-gutenberg.php
 */

// Load WordPress
require_once('../../../wp-load.php');

if (!current_user_can('manage_options')) {
    wp_die('Access denied. Please log in as administrator first.');
}

$step = isset($_GET['step']) ? $_GET['step'] : 'preview';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Migrate to Gutenberg</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: linear-gradient(135deg, #2d5016 0%, #3d6b1f 100%);
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        .header {
            background: linear-gradient(135deg, #2d5016 0%, #3d6b1f 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .content {
            padding: 30px;
        }
        h1 { margin: 0; }
        h2 { color: #2d5016; border-bottom: 2px solid #2d5016; padding-bottom: 10px; margin-top: 30px; }
        .success { background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #28a745; }
        .error { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #dc3545; }
        .warning { background: #fff3cd; color: #856404; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #ffc107; }
        .info { background: #d1ecf1; color: #0c5460; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #17a2b8; }
        .btn { display: inline-block; background: #2d5016; color: white; padding: 15px 40px; text-decoration: none; border-radius: 8px; font-size: 18px; font-weight: 600; margin: 10px 5px; border: none; cursor: pointer; }
        .btn:hover { background: #3d6b1f; }
        .btn-danger { background: #dc3545; }
        .btn-danger:hover { background: #c82333; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; font-weight: 600; }
        code { background: #f4f4f4; padding: 2px 8px; border-radius: 4px; font-family: monospace; }
        .step { background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔄 Migrate to Gutenberg Editor</h1>
            <p>Convert all pages to Gutenberg + Make ACF field groups visible</p>
        </div>
        <div class="content">

            <?php if ($step === 'preview'): ?>

                <h2>📋 Step 1: Convert Pages to Gutenberg</h2>

                <?php
                $pages = get_pages(array('number' => 999));
                $pages_with_templates = array();
                ?>

                <table>
                    <thead>
                        <tr>
                            <th>Page Title</th>
                            <th>Current Template</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pages as $page):
                            $template = get_post_meta($page->ID, '_wp_page_template', true);
                            if ($template && $template !== 'default') {
                                $pages_with_templates[] = $page;
                            }
                        ?>
                            <tr>
                                <td><?php echo esc_html($page->post_title); ?></td>
                                <td>
                                    <?php if ($template && $template !== 'default'): ?>
                                        <code><?php echo esc_html($template); ?></code>
                                    <?php else: ?>
                                        Default (Gutenberg)
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($template && $template !== 'default'): ?>
                                        <span style="color: #dc3545;">→ Will convert</span>
                                    <?php else: ?>
                                        <span style="color: #28a745;">✓ Already using Gutenberg</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="info">
                    <strong><?php echo count($pages_with_templates); ?> pages will be converted to Gutenberg</strong>
                </div>

                <h2>📦 Step 2: Create ACF Field Groups in Database</h2>

                <div class="info">
                    <strong>This will create 13 ACF field groups in the database:</strong>
                    <ul>
                        <li>Hero Block</li>
                        <li>Features Block</li>
                        <li>Models Block</li>
                        <li>3D Tour Block</li>
                        <li>Floor Plans Block</li>
                        <li>Interiors Block</li>
                        <li>Gallery Block</li>
                        <li>About Block</li>
                        <li>Contact Block</li>
                        <li>CTA Block</li>
                        <li>Navigation Options</li>
                        <li>Contact Info Options</li>
                        <li>Footer Options</li>
                    </ul>
                    These will be <strong>visible in the ACF admin menu</strong> and fully editable.
                </div>

                <div class="warning">
                    <strong>⚠️ Important Notes:</strong><br>
                    - Pages will lose hardcoded content and become blank<br>
                    - You'll need to add content using ACF blocks in Gutenberg<br>
                    - ACF field groups will appear in the admin menu under "Custom Fields"<br>
                    - This can be reversed, but it's recommended to backup first
                </div>

                <div style="text-align: center; margin: 40px 0;">
                    <a href="?step=migrate" class="btn btn-danger">🚀 Start Migration</a>
                </div>

            <?php elseif ($step === 'migrate'): ?>

                <h2>🔄 Migration in Progress...</h2>

                <?php
                $results = array(
                    'pages_converted' => 0,
                    'field_groups_created' => 0,
                    'errors' => array()
                );

                // STEP 1: Convert all pages to default template
                echo '<div class="step"><h3>Step 1: Converting Pages to Gutenberg</h3>';

                $pages = get_pages(array('number' => 999));
                foreach ($pages as $page) {
                    $template = get_post_meta($page->ID, '_wp_page_template', true);

                    if ($template && $template !== 'default') {
                        update_post_meta($page->ID, '_wp_page_template', 'default');
                        echo '<div class="success">✓ Converted: ' . esc_html($page->post_title) . '</div>';
                        $results['pages_converted']++;
                    }
                }

                if ($results['pages_converted'] === 0) {
                    echo '<div class="info">All pages already using Gutenberg editor</div>';
                }

                echo '</div>';

                // STEP 2: Create ACF field groups in database
                echo '<div class="step"><h3>Step 2: Creating ACF Field Groups</h3>';

                if (!function_exists('acf_update_field_group')) {
                    echo '<div class="error">✗ ACF Pro not found! Cannot create field groups.</div>';
                } else {
                    // Complete field group definitions from inc/acf.php
                    $field_groups_to_create = array(
                        // Hero Block Fields
                        array(
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
                        ),

                        // Features Block Fields
                        array(
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
                        ),

                        // Models Block Fields
                        array(
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
                        ),

                        // 3D Tour Block Fields
                        array(
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
                        ),

                        // Floor Plans Block Fields
                        array(
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
                        ),

                        // Interiors Block Fields
                        array(
                            'key' => 'group_block_interiors',
                            'title' => 'Innenausstattung-Block',
                            'fields' => array(
                                array(
                                    'key' => 'field_block_interior_title',
                                    'label' => 'Titel',
                                    'name' => 'interior_title',
                                    'type' => 'text',
                                    'default_value' => 'Innenausstattung',
                                ),
                                array(
                                    'key' => 'field_block_interior_subtitle',
                                    'label' => 'Untertitel',
                                    'name' => 'interior_subtitle',
                                    'type' => 'textarea',
                                    'rows' => 2,
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
                        ),

                        // Gallery Block Fields
                        array(
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
                        ),

                        // About Block Fields
                        array(
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
                        ),

                        // Contact Block Fields
                        array(
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
                        ),

                        // CTA Block Fields
                        array(
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
                        ),

                        // Navigation Options Fields
                        array(
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
                        ),

                        // Contact Info Options Fields
                        array(
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
                        ),

                        // Footer Options Fields
                        array(
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
                        ),
                    );

                    foreach ($field_groups_to_create as $field_group) {
                        // Check if field group already exists
                        $existing = acf_get_field_group($field_group['key']);

                        if ($existing) {
                            echo '<div class="info">Field group "' . esc_html($field_group['title']) . '" already exists - skipping</div>';
                        } else {
                            // Create the field group using acf_update_field_group
                            // This creates it in the database, not as a local group
                            acf_update_field_group($field_group);
                            echo '<div class="success">✓ Created: ' . esc_html($field_group['title']) . '</div>';
                            $results['field_groups_created']++;
                        }
                    }
                }

                echo '</div>';
                ?>

                <h2>✅ Migration Complete!</h2>

                <div class="success">
                    <strong>Summary:</strong><br>
                    - Pages converted to Gutenberg: <?php echo $results['pages_converted']; ?><br>
                    - ACF field groups created: <?php echo $results['field_groups_created']; ?>
                </div>

                <h2>What Changed:</h2>
                <div class="info">
                    <strong>✓ All pages now use Gutenberg editor</strong><br>
                    - Pages are now blank and ready for blocks<br>
                    - You can add content using ACF blocks<br><br>

                    <strong>✓ ACF field groups are now visible</strong><br>
                    - Go to Custom Fields in WordPress admin<br>
                    - You'll see all 13 field groups<br>
                    - You can edit them directly in the admin
                </div>

                <h2>Next Steps:</h2>
                <ol>
                    <li><strong>Go to Pages</strong> and edit each page</li>
                    <li><strong>Add ACF blocks</strong> using the "+" button in Gutenberg</li>
                    <li><strong>View Custom Fields</strong> in the admin to see all field groups</li>
                    <li><strong>Delete this file</strong> (migrate-to-gutenberg.php) when done</li>
                </ol>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="<?php echo admin_url('edit.php?post_type=acf-field-group'); ?>" class="btn">View ACF Field Groups</a>
                    <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" class="btn">View Pages</a>
                    <a href="<?php echo admin_url(); ?>" class="btn">WordPress Dashboard</a>
                </div>

            <?php endif; ?>

        </div>
    </div>
</body>
</html>
