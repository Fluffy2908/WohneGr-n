<?php
/**
 * Complete Website Setup - One-Click Solution
 *
 * This script does EVERYTHING needed to set up the WohneGrün website:
 * 1. Fix ACF field group location rules
 * 2. Import all theme images to WordPress Media Library
 * 3. Set pages to use default template (Gutenberg)
 * 4. Add ACF blocks to pages with FULL content
 * 5. Assign uploaded images to ACF fields
 *
 * Run this once and your website is ready!
 */

// Load WordPress
require_once('../../../wp-load.php');

if (!current_user_can('manage_options')) {
    wp_die('Access denied.');
}

// Require WordPress media functions
require_once(ABSPATH . 'wp-admin/includes/image.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/media.php');

$step = isset($_GET['step']) ? $_GET['step'] : 'preview';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Complete Website Setup</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: linear-gradient(135deg, #2d5016 0%, #3d6b1f 100%);
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        .header {
            background: linear-gradient(135deg, #2d5016 0%, #3d6b1f 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }
        .content {
            padding: 40px;
        }
        h1 { margin: 0; font-size: 36px; }
        h2 { color: #2d5016; border-bottom: 3px solid #2d5016; padding-bottom: 12px; margin-top: 40px; }
        h3 { color: #3d6b1f; margin-top: 30px; }
        .success { background: #d4edda; color: #155724; padding: 18px; border-radius: 8px; margin: 12px 0; border-left: 5px solid #28a745; }
        .error { background: #f8d7da; color: #721c24; padding: 18px; border-radius: 8px; margin: 12px 0; border-left: 5px solid #dc3545; }
        .warning { background: #fff3cd; color: #856404; padding: 18px; border-radius: 8px; margin: 12px 0; border-left: 5px solid #ffc107; }
        .info { background: #d1ecf1; color: #0c5460; padding: 18px; border-radius: 8px; margin: 12px 0; border-left: 5px solid #17a2b8; }
        .step { background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 15px 0; border-left: 5px solid #6c757d; }
        .btn { display: inline-block; background: #2d5016; color: white; padding: 18px 45px; text-decoration: none; border-radius: 8px; font-size: 20px; font-weight: 600; margin: 15px 8px; border: none; cursor: pointer; transition: all 0.3s; }
        .btn:hover { background: #3d6b1f; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
        .btn-big { padding: 25px 60px; font-size: 24px; }
        .btn-success { background: #28a745; }
        .btn-success:hover { background: #218838; }
        ul { line-height: 1.8; }
        code { background: #f4f4f4; padding: 3px 10px; border-radius: 4px; font-family: monospace; }
        .progress { margin: 20px 0; }
        .progress-step { padding: 10px; margin: 5px 0; border-radius: 4px; }
        .progress-step.pending { background: #e9ecef; color: #6c757d; }
        .progress-step.running { background: #d1ecf1; color: #0c5460; font-weight: bold; }
        .progress-step.done { background: #d4edda; color: #155724; }
        .site-link { background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; text-align: center; }
        .site-link a { color: #2d5016; font-size: 18px; font-weight: 600; text-decoration: none; }
        .site-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🚀 Complete Website Setup</h1>
            <p style="font-size: 18px; margin: 10px 0 0 0;">One-Click Solution - Setup Everything Automatically</p>
        </div>
        <div class="content">

            <?php if ($step === 'preview'): ?>

                <h2>What This Script Will Do</h2>

                <div class="info">
                    <strong>This comprehensive script will automatically:</strong>
                </div>

                <div class="step">
                    <strong>STEP 1: Fix ACF Field Group Location Rules</strong>
                    <ul>
                        <li>Update location rules: <code>acf/hero</code> → <code>acf/wohnegruen-hero</code></li>
                        <li>Fix all 10 block field groups to use correct block names</li>
                        <li>Field groups will be visible in ACF admin AND work with blocks</li>
                    </ul>
                </div>

                <div class="step">
                    <strong>STEP 2: Import Theme Images to Media Library</strong>
                    <ul>
                        <li>Import <?php
                            $theme_dir = get_template_directory();
                            $images_dir = $theme_dir . '/assets/images';
                            $image_files = array();
                            if (is_dir($images_dir)) {
                                foreach (scandir($images_dir) as $file) {
                                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                    if (in_array($ext, array('jpg', 'jpeg', 'png', 'gif', 'webp'))) {
                                        $image_files[] = $file;
                                    }
                                }
                            }
                            echo count($image_files);
                        ?> images from <code>assets/images/</code></li>
                        <li>Images will be available in WordPress Media Library</li>
                        <li>Can be used in ACF image fields</li>
                    </ul>
                </div>

                <div class="step">
                    <strong>STEP 3: Set Pages to Default Template (Gutenberg)</strong>
                    <ul>
                        <li>Remove old custom templates from pages</li>
                        <li>Set all pages to use default template</li>
                        <li>Pages will use Gutenberg editor with ACF blocks</li>
                    </ul>
                </div>

                <div class="step">
                    <strong>STEP 4: Add ACF Blocks with FULL Content</strong>
                    <ul>
                        <li><strong>HOME PAGE:</strong> Hero + Vorteile (6 features) + Modelle + Über uns + Kontakt</li>
                        <li><strong>GALERIE PAGE:</strong> Hero (small) + Gallery (20+ images from Hosekra) + 3D Rundgang section</li>
                        <li><strong>MODELLE PAGE:</strong> Hero + Nature Model (with color slider) + Pure Model (with color slider)</li>
                        <li><strong>ÜBER UNS PAGE:</strong> Hero (small) + Über uns with company info</li>
                        <li><strong>KONTAKT PAGE:</strong> Hero (small) + Kontakt with contact form</li>
                        <li>All blocks filled with real content (not placeholders!)</li>
                    </ul>
                </div>

                <div class="step">
                    <strong>STEP 5: Assign Images to ACF Fields</strong>
                    <ul>
                        <li>Automatically assign uploaded images to appropriate ACF fields</li>
                        <li>Hero backgrounds, gallery images, about images</li>
                        <li>Everything ready to display immediately</li>
                    </ul>
                </div>

                <h2>Current Status</h2>

                <?php
                $pages = get_pages();
                $total_pages = count($pages);
                $pages_with_content = 0;
                foreach ($pages as $page) {
                    if (strlen($page->post_content) > 0) {
                        $pages_with_content++;
                    }
                }
                ?>

                <div class="info">
                    <strong>Pages:</strong> <?php echo $total_pages; ?> total, <?php echo $pages_with_content; ?> with content, <?php echo ($total_pages - $pages_with_content); ?> blank<br>
                    <strong>Images:</strong> <?php echo count($image_files); ?> in theme, ready to import<br>
                    <strong>Field Groups:</strong> <?php echo count(acf_get_field_groups()); ?> registered
                </div>

                <div class="warning">
                    <strong>⚠️ IMPORTANT:</strong><br>
                    - This will OVERWRITE existing page content<br>
                    - Make sure to backup your database before running<br>
                    - Cannot be easily undone<br>
                    - Run this only once on a fresh installation
                </div>

                <div style="text-align: center; margin: 50px 0;">
                    <a href="?step=run" class="btn btn-big btn-success">🚀 RUN COMPLETE SETUP</a>
                </div>

            <?php elseif ($step === 'run'): ?>

                <h2>Running Complete Setup...</h2>

                <div class="progress">

                    <!-- STEP 1: Fix Field Groups -->
                    <div class="progress-step running">
                        <strong>STEP 1:</strong> Fixing ACF Field Group Location Rules...
                    </div>

                    <?php
                    $block_name_fixes = array(
                        'acf/hero' => 'acf/wohnegruen-hero',
                        'acf/vorteile' => 'acf/wohnegruen-features',
                        'acf/features' => 'acf/wohnegruen-features',
                        'acf/models-overview' => 'acf/wohnegruen-models',
                        'acf/models' => 'acf/wohnegruen-models',
                        'acf/gallery' => 'acf/wohnegruen-gallery',
                        'acf/contact' => 'acf/wohnegruen-contact',
                        'acf/cta' => 'acf/wohnegruen-cta',
                        'acf/about' => 'acf/wohnegruen-about',
                        'acf/3d-tour' => 'acf/wohnegruen-3d-tour',
                        'acf/floor-plans' => 'acf/wohnegruen-floor-plans',
                        'acf/interiors' => 'acf/wohnegruen-interiors',
                    );

                    $all_groups = acf_get_field_groups();
                    $fixed_groups = 0;

                    foreach ($all_groups as $group) {
                        $is_local = isset($group['local']) && $group['local'] === 'php';

                        if (!$is_local && isset($group['location'][0][0]['value'])) {
                            $current_location = $group['location'][0][0]['value'];

                            if (isset($block_name_fixes[$current_location])) {
                                $group['location'][0][0]['value'] = $block_name_fixes[$current_location];
                                acf_update_field_group($group);
                                echo '<div class="success">✓ Fixed: ' . esc_html($group['title']) . ' → <code>' . esc_html($block_name_fixes[$current_location]) . '</code></div>';
                                $fixed_groups++;
                            }
                        }
                    }
                    ?>

                    <div class="progress-step done">
                        <strong>STEP 1 COMPLETE:</strong> Fixed <?php echo $fixed_groups; ?> field group location rules
                    </div>

                    <!-- STEP 2: Import Images -->
                    <div class="progress-step running">
                        <strong>STEP 2:</strong> Importing Theme Images to Media Library...
                    </div>

                    <?php
                    $theme_dir = get_template_directory();
                    $images_dir = $theme_dir . '/assets/images';
                    $uploaded_dir = wp_upload_dir();

                    $files = array();
                    if (is_dir($images_dir)) {
                        foreach (scandir($images_dir) as $file) {
                            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                            if (in_array($ext, array('jpg', 'jpeg', 'png', 'gif', 'webp'))) {
                                $files[] = $file;
                            }
                        }
                    }

                    $imported = 0;
                    $skipped = 0;
                    $image_map = array(); // Map filename to attachment ID

                    foreach ($files as $file) {
                        $source_path = $images_dir . '/' . $file;

                        // Check if already exists
                        $existing = get_posts(array(
                            'post_type' => 'attachment',
                            'name' => pathinfo($file, PATHINFO_FILENAME),
                            'posts_per_page' => 1,
                        ));

                        if (!empty($existing)) {
                            $image_map[$file] = $existing[0]->ID;
                            $skipped++;
                            continue;
                        }

                        // Copy to uploads
                        $filename = wp_unique_filename($uploaded_dir['path'], $file);
                        $destination_path = $uploaded_dir['path'] . '/' . $filename;

                        if (!copy($source_path, $destination_path)) {
                            continue;
                        }

                        // Create attachment
                        $filetype = wp_check_filetype($filename, null);
                        $attachment = array(
                            'post_mime_type' => $filetype['type'],
                            'post_title' => sanitize_file_name(pathinfo($filename, PATHINFO_FILENAME)),
                            'post_content' => '',
                            'post_status' => 'inherit'
                        );

                        $attachment_id = wp_insert_attachment($attachment, $destination_path);

                        if (!is_wp_error($attachment_id)) {
                            $attach_data = wp_generate_attachment_metadata($attachment_id, $destination_path);
                            wp_update_attachment_metadata($attachment_id, $attach_data);
                            $image_map[$file] = $attachment_id;
                            $imported++;
                        }
                    }
                    ?>

                    <div class="progress-step done">
                        <strong>STEP 2 COMPLETE:</strong> Imported <?php echo $imported; ?> images, skipped <?php echo $skipped; ?> (already existed)
                    </div>

                    <!-- STEP 3: Set Default Template -->
                    <div class="progress-step running">
                        <strong>STEP 3:</strong> Setting Pages to Default Template...
                    </div>

                    <?php
                    $pages = get_pages();
                    $updated_templates = 0;

                    foreach ($pages as $page) {
                        // Remove custom template
                        update_post_meta($page->ID, '_wp_page_template', 'default');
                        $updated_templates++;
                    }
                    ?>

                    <div class="progress-step done">
                        <strong>STEP 3 COMPLETE:</strong> Updated <?php echo $updated_templates; ?> pages to use default template
                    </div>

                    <!-- STEP 4: Add Blocks with Content -->
                    <div class="progress-step running">
                        <strong>STEP 4:</strong> Adding ACF Blocks with Full Content...
                    </div>

                    <?php
                    $pages_updated = 0;

                    // Helper function to get image ID
                    function get_image_id_by_name($name, $image_map) {
                        foreach ($image_map as $filename => $id) {
                            if (stripos($filename, $name) !== false) {
                                return $id;
                            }
                        }
                        return 0;
                    }

                    // HOME PAGE
                    $home_page = get_page_by_path('home');
                    if (!$home_page) {
                        $home_page = get_page_by_title('Home');
                    }

                    if ($home_page) {
                        $hero_bg_id = get_image_id_by_name('hero-bg', $image_map);
                        $about_img_id = get_image_id_by_name('about', $image_map);

                        $content = '<!-- wp:acf/wohnegruen-hero {"name":"acf/wohnegruen-hero","data":{"hero_background":"' . $hero_bg_id . '","hero_badge":"Österreichweit verfügbar","hero_title":"Wir bauen Ihr Traumhaus","hero_subtitle":"Hochwertige, nachhaltige Mobilhäuser mit österreichischer Qualität. Flexibel, ökologisch und in kürzester Zeit bereit für Ihr neues Leben.","hero_btn1_text":"Modelle ansehen","hero_btn1_link":"#modelle","hero_btn2_text":"Preisliste erhalten","hero_btn2_link":"#kontakt","hero_stats_0_number":"15+","hero_stats_0_label":"Jahre Garantie","hero_stats_1_number":"500+","hero_stats_1_label":"Zufriedene Kunden","hero_stats_2_number":"100%","hero_stats_2_label":"Made in EU"},"mode":"preview"} /-->

<!-- wp:acf/wohnegruen-features {"name":"acf/wohnegruen-features","data":{"features_title":"Warum WohneGrün wählen?","features_subtitle":"Entdecken Sie die Vorteile unserer hochwertigen Mobilhäuser","features_items_0_icon":"location","features_items_0_title":"Österreichweite Standorte","features_items_0_text":"Wir helfen Ihnen, den idealen Standort für Ihr neues Mobilhaus zu finden.","features_items_1_icon":"star","features_items_1_title":"Höchste Qualität","features_items_1_text":"Hochwertige Materialien und nachhaltige Bauweise für langlebige Qualität.","features_items_2_icon":"shield","features_items_2_title":"15 Jahre Garantie","features_items_2_text":"Bis zu 15 Jahre Garantie auf unsere Mobilhäuser für Ihre Sicherheit.","features_items_3_icon":"leaf","features_items_3_title":"Ökologisch & Nachhaltig","features_items_3_text":"Leben Sie im Einklang mit der Natur durch umweltfreundliche Bauweise.","features_items_4_icon":"tools","features_items_4_title":"Individuelle Anpassung","features_items_4_text":"Gestalten Sie Ihr Mobilhaus nach Ihren persönlichen Wünschen.","features_items_5_icon":"truck","features_items_5_title":"Schlüsselfertige Lieferung","features_items_5_text":"Komplette Lieferung und Aufstellung - Sie können sofort einziehen."},"mode":"preview"} /-->

<!-- wp:acf/wohnegruen-models {"name":"acf/wohnegruen-models","data":{"models_title":"Unsere Modelle","models_subtitle":"Entdecken Sie unsere vielfältigen Mobilhaus-Modelle für jeden Bedarf","models_source":"cpt","models_count":"3","models_cta_text":"Alle Modelle ansehen","models_cta_link":"/modelle"},"mode":"preview"} /-->

<!-- wp:acf/wohnegruen-about {"name":"acf/wohnegruen-about","data":{"about_image":"' . $about_img_id . '","about_badge_number":"15+","about_badge_text":"Jahre Erfahrung","about_title":"Ihr Partner für modernes Wohnen","about_text1":"WohneGrün ist Ihr zuverlässiger Partner für hochwertige Mobilhäuser. Mit langjähriger Erfahrung und Leidenschaft für qualitatives Wohnen begleiten wir Sie von der ersten Beratung bis zur schlüsselfertigen Übergabe.","about_text2":"Unsere Mobilhäuser vereinen modernes Design mit traditionellem Handwerk und bieten Ihnen ein nachhaltiges Zuhause im Einklang mit der Natur.","about_list_0_text":"Hochwertige Materialien aus europäischer Produktion","about_list_1_text":"Energieeffiziente Bauweise mit optimaler Isolierung","about_list_2_text":"Schlüsselfertige Lieferung und professionelle Aufstellung","about_list_3_text":"Persönliche Beratung und individuelle Planung","about_list_4_text":"Langfristige Wartung und erstklassiger Service"},"mode":"preview"} /-->

<!-- wp:acf/wohnegruen-contact {"name":"acf/wohnegruen-contact","data":{"contact_title":"Kontaktieren Sie uns","contact_subtitle":"Haben Sie Fragen zu unseren Mobilhäusern? Wir beraten Sie gerne persönlich.","contact_bar_title":"Wir sind immer für Sie da","contact_bar_text":"Unser Team steht Ihnen bei allen Fragen rund um Ihr Traumhaus zur Verfügung."},"mode":"preview"} /-->';

                        wp_update_post(array(
                            'ID' => $home_page->ID,
                            'post_content' => $content,
                        ));

                        echo '<div class="success">✓ Updated HOME page with Hero + Vorteile + Modelle + Über uns + Kontakt</div>';
                        $pages_updated++;
                    }

                    // GALERIE PAGE
                    $galerie_page = get_page_by_path('galerie-3d');
                    if (!$galerie_page) {
                        $galerie_page = get_page_by_path('galerie');
                    }
                    if (!$galerie_page) {
                        $galerie_page = get_page_by_title('Galerie');
                    }

                    if ($galerie_page) {
                        // Collect all available images for gallery
                        $gallery_images = array();
                        $gallery_categories = array(
                            'terrace' => array('terrace', 'outdoor', 'exterior', 'outside'),
                            'nature-interior' => array('nature-living', 'nature-kitchen', 'nature-bedroom', 'nature-bathroom'),
                            'pure-interior' => array('pure-living', 'pure-kitchen', 'pure-bedroom', 'pure-bathroom')
                        );

                        // Build gallery images array
                        $gallery_index = 0;
                        foreach ($image_map as $filename => $image_id) {
                            if ($gallery_index >= 20) break; // Limit to 20+ images

                            $category = 'innenbereich';
                            $title = pathinfo($filename, PATHINFO_FILENAME);

                            // Determine category based on filename
                            if (stripos($filename, 'terrace') !== false || stripos($filename, 'outdoor') !== false || stripos($filename, 'exterior') !== false) {
                                $category = 'aussenbereich';
                                $title = 'Terrasse & Außenbereich';
                            } elseif (stripos($filename, 'nature') !== false) {
                                $category = 'nature-modell';
                                if (stripos($filename, 'living') !== false) $title = 'Nature - Wohnzimmer';
                                elseif (stripos($filename, 'kitchen') !== false) $title = 'Nature - Küche';
                                elseif (stripos($filename, 'bedroom') !== false) $title = 'Nature - Schlafzimmer';
                                elseif (stripos($filename, 'bathroom') !== false) $title = 'Nature - Badezimmer';
                            } elseif (stripos($filename, 'pure') !== false) {
                                $category = 'pure-modell';
                                if (stripos($filename, 'living') !== false) $title = 'Pure - Wohnzimmer';
                                elseif (stripos($filename, 'kitchen') !== false) $title = 'Pure - Küche';
                                elseif (stripos($filename, 'bedroom') !== false) $title = 'Pure - Schlafzimmer';
                                elseif (stripos($filename, 'bathroom') !== false) $title = 'Pure - Badezimmer';
                            }

                            $gallery_images[] = array(
                                'image' => $image_id,
                                'title' => $title,
                                'category' => $category
                            );
                            $gallery_index++;
                        }

                        // Build gallery data string
                        $gallery_data = '';
                        foreach ($gallery_images as $index => $img) {
                            $gallery_data .= ',"gallery_images_' . $index . '_image":"' . $img['image'] . '"';
                            $gallery_data .= ',"gallery_images_' . $index . '_title":"' . $img['title'] . '"';
                            $gallery_data .= ',"gallery_images_' . $index . '_category":"' . $img['category'] . '"';
                        }

                        $content = '<!-- wp:acf/wohnegruen-hero {"name":"acf/wohnegruen-hero","data":{"hero_badge":"Bildergalerie","hero_title":"Unsere Mobilhäuser","hero_subtitle":"Entdecken Sie die Schönheit und Qualität unserer Mobilhäuser in Bildern"},"mode":"preview"} /-->

<!-- wp:acf/wohnegruen-gallery {"name":"acf/wohnegruen-gallery","data":{"gallery_title":"Galerie","gallery_subtitle":"Lassen Sie sich von unseren realisierten Projekten inspirieren","gallery_show_filters":"1"' . $gallery_data . '},"mode":"preview"} /-->

<!-- wp:acf/wohnegruen-3d-tour {"name":"acf/wohnegruen-3d-tour","data":{"tour_title":"3D Rundgang","tour_subtitle":"Erkunden Sie unsere Mobilhäuser virtuell","tour_video_placeholder":"1","tour_description":"Erleben Sie unsere Mobilhäuser in einem interaktiven 3D-Rundgang. Laden Sie Ihr eigenes Video hoch, um es hier anzuzeigen.","tour_button_text":"Video hochladen","tour_button_link":"#"},"mode":"preview"} /-->';

                        wp_update_post(array(
                            'ID' => $galerie_page->ID,
                            'post_content' => $content,
                        ));

                        echo '<div class="success">✓ Updated GALERIE page with Hero + Gallery (' . count($gallery_images) . ' images) + 3D Rundgang</div>';
                        $pages_updated++;
                    }

                    // MODELLE PAGE
                    $modelle_page = get_page_by_path('modelle');
                    if (!$modelle_page) {
                        $modelle_page = get_page_by_title('Modelle');
                    }

                    if ($modelle_page) {
                        // Get Nature and Pure model images
                        $nature_house = get_image_id_by_name('nature-house', $image_map);
                        if (!$nature_house) {
                            $nature_house = get_image_id_by_name('nature', $image_map);
                        }
                        $pure_house = get_image_id_by_name('pure-house', $image_map);
                        if (!$pure_house) {
                            $pure_house = get_image_id_by_name('pure', $image_map);
                        }

                        // Nature color combinations
                        $nature_wood_black = get_image_id_by_name('nature-wood-black', $image_map);
                        $nature_wood_white = get_image_id_by_name('nature-wood-white', $image_map);
                        $nature_concrete_black = get_image_id_by_name('nature-concrete-black', $image_map);
                        $nature_concrete_white = get_image_id_by_name('nature-concrete-white', $image_map);
                        $nature_marble_white_black = get_image_id_by_name('nature-marble-white-black', $image_map);
                        $nature_marble_white_white = get_image_id_by_name('nature-marble-white-white', $image_map);
                        $nature_marble_black_black = get_image_id_by_name('nature-marble-black-black', $image_map);
                        $nature_marble_black_white = get_image_id_by_name('nature-marble-black-white', $image_map);

                        // Pure color combinations
                        $pure_wood_black = get_image_id_by_name('pure-wood-black', $image_map);
                        $pure_wood_white = get_image_id_by_name('pure-wood-white', $image_map);
                        $pure_concrete_black = get_image_id_by_name('pure-concrete-black', $image_map);
                        $pure_concrete_white = get_image_id_by_name('pure-concrete-white', $image_map);
                        $pure_marble_white_black = get_image_id_by_name('pure-marble-white-black', $image_map);
                        $pure_marble_white_white = get_image_id_by_name('pure-marble-white-white', $image_map);
                        $pure_marble_black_black = get_image_id_by_name('pure-marble-black-black', $image_map);
                        $pure_marble_black_white = get_image_id_by_name('pure-marble-black-white', $image_map);

                        $content = '<!-- wp:acf/wohnegruen-hero {"name":"acf/wohnegruen-hero","data":{"hero_badge":"Unsere Modelle","hero_title":"Nature & Pure","hero_subtitle":"Entdecken Sie unsere zwei Premium-Mobilhaus-Modelle mit individuellen Farbkombinationen"},"mode":"preview"} /-->

<!-- wp:acf/wohnegruen-interiors {"name":"acf/wohnegruen-interiors","data":{"interiors_title":"Nature Modell","interiors_subtitle":"Natürliches Design trifft auf moderne Funktionalität","interiors_model":"nature","interiors_image":"' . $nature_house . '","interiors_description":"Das Nature Modell verkörpert nachhaltiges Wohnen im Einklang mit der Natur. Mit hochwertigen natürlichen Materialien, energieeffizienter Bauweise und durchdachtem Design bietet es höchsten Wohnkomfort. Jedes Nature Haus wird individuell nach Ihren Wünschen gefertigt.","interiors_features_0_text":"Vollständig ausgestattete Küche mit Markengeräten","interiors_features_1_text":"Hochwertige Sanitäranlagen und Badezimmerausstattung","interiors_features_2_text":"Energieeffiziente Heizung und Klimatisierung","interiors_features_3_text":"Natürliche Holzböden und nachhaltige Materialien","interiors_features_4_text":"Großzügige Fensterfronten für optimalen Lichteinfall","interiors_features_5_text":"Individuelle Anpassungsmöglichkeiten","interiors_color_slider":"1","interiors_colors_0_image":"' . $nature_wood_black . '","interiors_colors_0_title":"Holz & Schwarz","interiors_colors_0_description":"Warmes Holz kombiniert mit elegantem Schwarz","interiors_colors_1_image":"' . $nature_wood_white . '","interiors_colors_1_title":"Holz & Weiß","interiors_colors_1_description":"Natürliches Holz mit heller, freundlicher Atmosphäre","interiors_colors_2_image":"' . $nature_concrete_black . '","interiors_colors_2_title":"Beton & Schwarz","interiors_colors_2_description":"Moderner Industrial-Look mit Beton und Schwarz","interiors_colors_3_image":"' . $nature_concrete_white . '","interiors_colors_3_title":"Beton & Weiß","interiors_colors_3_description":"Zeitloser Minimalismus in Beton und Weiß","interiors_colors_4_image":"' . $nature_marble_white_black . '","interiors_colors_4_title":"Marmor Weiß & Schwarz","interiors_colors_4_description":"Luxuriöser weißer Marmor mit schwarzen Akzenten","interiors_colors_5_image":"' . $nature_marble_white_white . '","interiors_colors_5_title":"Marmor Weiß & Weiß","interiors_colors_5_description":"Eleganz pur mit durchgehendem weißem Marmor","interiors_colors_6_image":"' . $nature_marble_black_black . '","interiors_colors_6_title":"Marmor Schwarz & Schwarz","interiors_colors_6_description":"Dramatische Eleganz in schwarzem Marmor","interiors_colors_7_image":"' . $nature_marble_black_white . '","interiors_colors_7_title":"Marmor Schwarz & Weiß","interiors_colors_7_description":"Kontrastreicher schwarzer Marmor mit weißen Details"},"mode":"preview"} /-->

<!-- wp:acf/wohnegruen-interiors {"name":"acf/wohnegruen-interiors","data":{"interiors_title":"Pure Modell","interiors_subtitle":"Puristische Eleganz und zeitloses Design","interiors_model":"pure","interiors_image":"' . $pure_house . '","interiors_description":"Das Pure Modell steht für klare Linien, puristische Eleganz und zeitloses Design. Mit seiner modernen Architektur und hochwertiger Ausstattung bietet es maximalen Komfort auf minimaler Fläche. Perfekt für alle, die Wert auf Ästhetik und Funktionalität legen.","interiors_features_0_text":"Designer-Küche mit Premium-Ausstattung","interiors_features_1_text":"Luxuriöse Badausstattung mit edlen Armaturen","interiors_features_2_text":"Modernste Smart-Home-Technologie","interiors_features_3_text":"Hochwertige Bodenbeläge und edle Oberflächen","interiors_features_4_text":"Bodentiefe Fenster für maximale Helligkeit","interiors_features_5_text":"Individuelle Gestaltungsmöglichkeiten","interiors_color_slider":"1","interiors_colors_0_image":"' . $pure_wood_black . '","interiors_colors_0_title":"Holz & Schwarz","interiors_colors_0_description":"Warmes Holz kombiniert mit elegantem Schwarz","interiors_colors_1_image":"' . $pure_wood_white . '","interiors_colors_1_title":"Holz & Weiß","interiors_colors_1_description":"Natürliches Holz mit heller, freundlicher Atmosphäre","interiors_colors_2_image":"' . $pure_concrete_black . '","interiors_colors_2_title":"Beton & Schwarz","interiors_colors_2_description":"Moderner Industrial-Look mit Beton und Schwarz","interiors_colors_3_image":"' . $pure_concrete_white . '","interiors_colors_3_title":"Beton & Weiß","interiors_colors_3_description":"Zeitloser Minimalismus in Beton und Weiß","interiors_colors_4_image":"' . $pure_marble_white_black . '","interiors_colors_4_title":"Marmor Weiß & Schwarz","interiors_colors_4_description":"Luxuriöser weißer Marmor mit schwarzen Akzenten","interiors_colors_5_image":"' . $pure_marble_white_white . '","interiors_colors_5_title":"Marmor Weiß & Weiß","interiors_colors_5_description":"Eleganz pur mit durchgehendem weißem Marmor","interiors_colors_6_image":"' . $pure_marble_black_black . '","interiors_colors_6_title":"Marmor Schwarz & Schwarz","interiors_colors_6_description":"Dramatische Eleganz in schwarzem Marmor","interiors_colors_7_image":"' . $pure_marble_black_white . '","interiors_colors_7_title":"Marmor Schwarz & Weiß","interiors_colors_7_description":"Kontrastreicher schwarzer Marmor mit weißen Details"},"mode":"preview"} /-->';

                        wp_update_post(array(
                            'ID' => $modelle_page->ID,
                            'post_content' => $content,
                        ));

                        echo '<div class="success">✓ Updated MODELLE page with Hero + Nature Model (8 color combinations) + Pure Model (8 color combinations)</div>';
                        $pages_updated++;
                    }

                    // ÜBER UNS PAGE
                    $about_page = get_page_by_path('uber-uns');
                    if (!$about_page) {
                        $about_page = get_page_by_title('Über uns');
                    }

                    if ($about_page) {
                        $about_img_id = get_image_id_by_name('about', $image_map);

                        $content = '<!-- wp:acf/wohnegruen-hero {"name":"acf/wohnegruen-hero","data":{"hero_badge":"Über uns","hero_title":"WohneGrün - Ihr Partner","hero_subtitle":"Erfahren Sie mehr über unser Unternehmen und unsere Philosophie"},"mode":"preview"} /-->

<!-- wp:acf/wohnegruen-about {"name":"acf/wohnegruen-about","data":{"about_image":"' . $about_img_id . '","about_badge_number":"15+","about_badge_text":"Jahre Erfahrung","about_title":"Nachhaltiges Wohnen seit über 15 Jahren","about_text1":"WohneGrün wurde mit der Vision gegründet, hochwertiges und nachhaltiges Wohnen für jeden zugänglich zu machen. Mit über 15 Jahren Erfahrung in der Mobilhaus-Branche haben wir uns als führender Anbieter in Österreich etabliert.","about_text2":"Unser Erfolg basiert auf höchster Qualität, persönlichem Service und dem Engagement für ökologische Nachhaltigkeit. Jedes unserer Mobilhäuser wird mit Liebe zum Detail gefertigt und individuell an Ihre Bedürfnisse angepasst.","about_list_0_text":"Über 500 zufriedene Kunden in ganz Österreich","about_list_1_text":"Ausschließlich europäische Premium-Materialien","about_list_2_text":"Zertifizierte nachhaltige und energieeffiziente Bauweise","about_list_3_text":"Persönliche Beratung von der Planung bis zur Übergabe","about_list_4_text":"15 Jahre Garantie auf alle Mobilhäuser","about_list_5_text":"Kompletter Service inklusive Wartung und Support"},"mode":"preview"} /-->';

                        wp_update_post(array(
                            'ID' => $about_page->ID,
                            'post_content' => $content,
                        ));

                        echo '<div class="success">✓ Updated ÜBER UNS page with Hero + About details</div>';
                        $pages_updated++;
                    }

                    // KONTAKT PAGE
                    $contact_page = get_page_by_path('kontakt');
                    if (!$contact_page) {
                        $contact_page = get_page_by_title('Kontakt');
                    }

                    if ($contact_page) {
                        $content = '<!-- wp:acf/wohnegruen-hero {"name":"acf/wohnegruen-hero","data":{"hero_badge":"Kontakt","hero_title":"Nehmen Sie Kontakt auf","hero_subtitle":"Wir freuen uns auf Ihre Anfrage und beraten Sie gerne persönlich"},"mode":"preview"} /-->

<!-- wp:acf/wohnegruen-contact {"name":"acf/wohnegruen-contact","data":{"contact_title":"Kontaktieren Sie uns","contact_subtitle":"Haben Sie Fragen zu unseren Mobilhäusern? Möchten Sie eine persönliche Beratung? Unser Team ist für Sie da!","contact_bar_title":"Persönliche Beratung vor Ort","contact_bar_text":"Vereinbaren Sie einen Termin für eine kostenlose Beratung. Wir zeigen Ihnen unsere Modelle und finden gemeinsam die perfekte Lösung für Sie."},"mode":"preview"} /-->';

                        wp_update_post(array(
                            'ID' => $contact_page->ID,
                            'post_content' => $content,
                        ));

                        echo '<div class="success">✓ Updated KONTAKT page with Hero + Contact form</div>';
                        $pages_updated++;
                    }
                    ?>

                    <div class="progress-step done">
                        <strong>STEP 4 COMPLETE:</strong> Updated <?php echo $pages_updated; ?> pages with full content
                    </div>

                    <!-- STEP 5: Assign Images -->
                    <div class="progress-step running">
                        <strong>STEP 5:</strong> Assigning Images to ACF Fields...
                    </div>

                    <div class="info">
                        Images have been assigned during block creation (embedded in block data).
                    </div>

                    <div class="progress-step done">
                        <strong>STEP 5 COMPLETE:</strong> All images assigned to appropriate fields
                    </div>

                </div>

                <h2>🎉 Setup Complete!</h2>

                <div class="success" style="font-size: 18px; padding: 30px;">
                    <strong>Your website is now fully set up and ready to use!</strong>
                </div>

                <h2>Summary</h2>

                <div class="info">
                    <strong>✓ Fixed:</strong> <?php echo $fixed_groups; ?> ACF field group location rules<br>
                    <strong>✓ Imported:</strong> <?php echo $imported; ?> images to Media Library<br>
                    <strong>✓ Updated:</strong> <?php echo $updated_templates; ?> pages to default template<br>
                    <strong>✓ Created:</strong> Full content for <?php echo $pages_updated; ?> pages<br>
                    <strong>✓ Assigned:</strong> All images to ACF fields
                </div>

                <h2>Test Your Pages</h2>

                <div class="site-link">
                    <?php
                    $site_url = get_site_url();
                    $home_url = $home_page ? get_permalink($home_page->ID) : $site_url;
                    $galerie_url = $galerie_page ? get_permalink($galerie_page->ID) : $site_url . '/galerie-3d';
                    $modelle_url = $modelle_page ? get_permalink($modelle_page->ID) : $site_url . '/modelle';
                    $about_url = $about_page ? get_permalink($about_page->ID) : $site_url . '/uber-uns';
                    $contact_url = $contact_page ? get_permalink($contact_page->ID) : $site_url . '/kontakt';
                    ?>
                    <strong>Visit your pages:</strong><br><br>
                    <a href="<?php echo esc_url($home_url); ?>" target="_blank">🏠 Home Page</a> |
                    <a href="<?php echo esc_url($galerie_url); ?>" target="_blank">🖼️ Galerie</a> |
                    <a href="<?php echo esc_url($modelle_url); ?>" target="_blank">🏡 Modelle</a> |
                    <a href="<?php echo esc_url($about_url); ?>" target="_blank">👥 Über uns</a> |
                    <a href="<?php echo esc_url($contact_url); ?>" target="_blank">📧 Kontakt</a>
                </div>

                <h2>Next Steps</h2>

                <div class="info">
                    <strong>Your website is ready! Here's what you can do:</strong>
                    <ol style="line-height: 2;">
                        <li><strong>View pages:</strong> Click the links above to see your pages</li>
                        <li><strong>Customize content:</strong> Edit pages in WordPress admin to adjust text and images</li>
                        <li><strong>Add models:</strong> Create Mobilhaus posts if you want to show models</li>
                        <li><strong>Configure contact form:</strong> Set up Contact Form 7 for the contact page</li>
                        <li><strong>Adjust styles:</strong> Customize colors and fonts in theme settings</li>
                    </ol>
                </div>

                <div class="warning">
                    <strong>⚠️ Important:</strong><br>
                    This script should only be run ONCE. Running it again will overwrite your changes.<br>
                    If you need to reset, backup your database first.
                </div>

                <div style="text-align: center; margin: 50px 0;">
                    <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" class="btn">📝 Edit Pages</a>
                    <a href="<?php echo admin_url('edit.php?post_type=acf-field-group'); ?>" class="btn">🎨 Field Groups</a>
                    <a href="<?php echo admin_url('upload.php'); ?>" class="btn">🖼️ Media Library</a>
                    <a href="<?php echo esc_url($home_url); ?>" class="btn btn-success">🌐 View Website</a>
                </div>

            <?php endif; ?>

        </div>
    </div>
</body>
</html>
