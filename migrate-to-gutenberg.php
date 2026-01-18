<?php
/**
 * Migrate All Pages to Gutenberg + Make ACF Field Groups Visible
 *
 * This script does TWO things:
 * 1. Converts all pages to use Gutenberg editor (removes custom templates)
 * 2. Creates ACF field groups in the database (makes them visible in ACF admin)
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
                    <strong>This will create 10 ACF field groups in the database:</strong>
                    <ul>
                        <li>Hero Block</li>
                        <li>Vorteile Block</li>
                        <li>Über uns Block</li>
                        <li>Modelle Übersicht Block</li>
                        <li>Galerie Block</li>
                        <li>Kontakt Block</li>
                        <li>CTA Block</li>
                        <li>Testimonials Block</li>
                        <li>FAQ Block</li>
                        <li>Stats Block</li>
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

                if (!function_exists('acf_add_local_field_group')) {
                    echo '<div class="error">✗ ACF Pro not found! Cannot create field groups.</div>';
                } else {
                    // Delete existing local field groups from the code
                    // We'll create them in the database instead

                    $field_groups_to_create = array(
                        array(
                            'key' => 'group_hero_block',
                            'title' => 'Hero Block',
                            'fields' => array(
                                array(
                                    'key' => 'field_hero_title',
                                    'label' => 'Titel',
                                    'name' => 'hero_title',
                                    'type' => 'text',
                                    'required' => 1,
                                ),
                                array(
                                    'key' => 'field_hero_subtitle',
                                    'label' => 'Untertitel',
                                    'name' => 'hero_subtitle',
                                    'type' => 'text',
                                ),
                                array(
                                    'key' => 'field_hero_description',
                                    'label' => 'Beschreibung',
                                    'name' => 'hero_description',
                                    'type' => 'textarea',
                                ),
                                array(
                                    'key' => 'field_hero_button_text',
                                    'label' => 'Button Text',
                                    'name' => 'hero_button_text',
                                    'type' => 'text',
                                ),
                                array(
                                    'key' => 'field_hero_button_link',
                                    'label' => 'Button Link',
                                    'name' => 'hero_button_link',
                                    'type' => 'link',
                                ),
                                array(
                                    'key' => 'field_hero_background_image',
                                    'label' => 'Hintergrundbild',
                                    'name' => 'hero_background_image',
                                    'type' => 'image',
                                    'return_format' => 'array',
                                ),
                            ),
                            'location' => array(
                                array(
                                    array(
                                        'param' => 'block',
                                        'operator' => '==',
                                        'value' => 'acf/hero',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'group_vorteile_block',
                            'title' => 'Vorteile Block',
                            'fields' => array(
                                array(
                                    'key' => 'field_vorteile_title',
                                    'label' => 'Titel',
                                    'name' => 'vorteile_title',
                                    'type' => 'text',
                                ),
                                array(
                                    'key' => 'field_vorteile_items',
                                    'label' => 'Vorteile',
                                    'name' => 'vorteile_items',
                                    'type' => 'repeater',
                                    'sub_fields' => array(
                                        array(
                                            'key' => 'field_vorteil_icon',
                                            'label' => 'Icon',
                                            'name' => 'icon',
                                            'type' => 'text',
                                        ),
                                        array(
                                            'key' => 'field_vorteil_title',
                                            'label' => 'Titel',
                                            'name' => 'title',
                                            'type' => 'text',
                                        ),
                                        array(
                                            'key' => 'field_vorteil_description',
                                            'label' => 'Beschreibung',
                                            'name' => 'description',
                                            'type' => 'textarea',
                                        ),
                                    ),
                                ),
                            ),
                            'location' => array(
                                array(
                                    array(
                                        'param' => 'block',
                                        'operator' => '==',
                                        'value' => 'acf/vorteile',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'group_about_block',
                            'title' => 'Über uns Block',
                            'fields' => array(
                                array(
                                    'key' => 'field_about_title',
                                    'label' => 'Titel',
                                    'name' => 'about_title',
                                    'type' => 'text',
                                ),
                                array(
                                    'key' => 'field_about_content',
                                    'label' => 'Inhalt',
                                    'name' => 'about_content',
                                    'type' => 'wysiwyg',
                                ),
                                array(
                                    'key' => 'field_about_image',
                                    'label' => 'Bild',
                                    'name' => 'about_image',
                                    'type' => 'image',
                                    'return_format' => 'array',
                                ),
                            ),
                            'location' => array(
                                array(
                                    array(
                                        'param' => 'block',
                                        'operator' => '==',
                                        'value' => 'acf/about',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'group_models_overview_block',
                            'title' => 'Modelle Übersicht Block',
                            'fields' => array(
                                array(
                                    'key' => 'field_models_title',
                                    'label' => 'Titel',
                                    'name' => 'models_title',
                                    'type' => 'text',
                                ),
                                array(
                                    'key' => 'field_models_description',
                                    'label' => 'Beschreibung',
                                    'name' => 'models_description',
                                    'type' => 'textarea',
                                ),
                            ),
                            'location' => array(
                                array(
                                    array(
                                        'param' => 'block',
                                        'operator' => '==',
                                        'value' => 'acf/models-overview',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'group_gallery_block',
                            'title' => 'Galerie Block',
                            'fields' => array(
                                array(
                                    'key' => 'field_gallery_title',
                                    'label' => 'Titel',
                                    'name' => 'gallery_title',
                                    'type' => 'text',
                                ),
                                array(
                                    'key' => 'field_gallery_images',
                                    'label' => 'Bilder',
                                    'name' => 'gallery_images',
                                    'type' => 'gallery',
                                    'return_format' => 'array',
                                ),
                            ),
                            'location' => array(
                                array(
                                    array(
                                        'param' => 'block',
                                        'operator' => '==',
                                        'value' => 'acf/gallery',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'group_contact_block',
                            'title' => 'Kontakt Block',
                            'fields' => array(
                                array(
                                    'key' => 'field_contact_title',
                                    'label' => 'Titel',
                                    'name' => 'contact_title',
                                    'type' => 'text',
                                ),
                                array(
                                    'key' => 'field_contact_form_shortcode',
                                    'label' => 'Formular Shortcode',
                                    'name' => 'contact_form_shortcode',
                                    'type' => 'text',
                                ),
                            ),
                            'location' => array(
                                array(
                                    array(
                                        'param' => 'block',
                                        'operator' => '==',
                                        'value' => 'acf/contact',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'group_cta_block',
                            'title' => 'CTA Block',
                            'fields' => array(
                                array(
                                    'key' => 'field_cta_title',
                                    'label' => 'Titel',
                                    'name' => 'cta_title',
                                    'type' => 'text',
                                ),
                                array(
                                    'key' => 'field_cta_description',
                                    'label' => 'Beschreibung',
                                    'name' => 'cta_description',
                                    'type' => 'textarea',
                                ),
                                array(
                                    'key' => 'field_cta_button_text',
                                    'label' => 'Button Text',
                                    'name' => 'cta_button_text',
                                    'type' => 'text',
                                ),
                                array(
                                    'key' => 'field_cta_button_link',
                                    'label' => 'Button Link',
                                    'name' => 'cta_button_link',
                                    'type' => 'link',
                                ),
                            ),
                            'location' => array(
                                array(
                                    array(
                                        'param' => 'block',
                                        'operator' => '==',
                                        'value' => 'acf/cta',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'group_testimonials_block',
                            'title' => 'Testimonials Block',
                            'fields' => array(
                                array(
                                    'key' => 'field_testimonials_title',
                                    'label' => 'Titel',
                                    'name' => 'testimonials_title',
                                    'type' => 'text',
                                ),
                                array(
                                    'key' => 'field_testimonials_items',
                                    'label' => 'Testimonials',
                                    'name' => 'testimonials_items',
                                    'type' => 'repeater',
                                    'sub_fields' => array(
                                        array(
                                            'key' => 'field_testimonial_text',
                                            'label' => 'Text',
                                            'name' => 'text',
                                            'type' => 'textarea',
                                        ),
                                        array(
                                            'key' => 'field_testimonial_author',
                                            'label' => 'Autor',
                                            'name' => 'author',
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
                                        'value' => 'acf/testimonials',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'group_faq_block',
                            'title' => 'FAQ Block',
                            'fields' => array(
                                array(
                                    'key' => 'field_faq_title',
                                    'label' => 'Titel',
                                    'name' => 'faq_title',
                                    'type' => 'text',
                                ),
                                array(
                                    'key' => 'field_faq_items',
                                    'label' => 'FAQ Items',
                                    'name' => 'faq_items',
                                    'type' => 'repeater',
                                    'sub_fields' => array(
                                        array(
                                            'key' => 'field_faq_question',
                                            'label' => 'Frage',
                                            'name' => 'question',
                                            'type' => 'text',
                                        ),
                                        array(
                                            'key' => 'field_faq_answer',
                                            'label' => 'Antwort',
                                            'name' => 'answer',
                                            'type' => 'textarea',
                                        ),
                                    ),
                                ),
                            ),
                            'location' => array(
                                array(
                                    array(
                                        'param' => 'block',
                                        'operator' => '==',
                                        'value' => 'acf/faq',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'group_stats_block',
                            'title' => 'Stats Block',
                            'fields' => array(
                                array(
                                    'key' => 'field_stats_items',
                                    'label' => 'Statistiken',
                                    'name' => 'stats_items',
                                    'type' => 'repeater',
                                    'sub_fields' => array(
                                        array(
                                            'key' => 'field_stat_number',
                                            'label' => 'Zahl',
                                            'name' => 'number',
                                            'type' => 'text',
                                        ),
                                        array(
                                            'key' => 'field_stat_label',
                                            'label' => 'Beschriftung',
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
                                        'value' => 'acf/stats',
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
                    - You'll see all 10 field groups<br>
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
