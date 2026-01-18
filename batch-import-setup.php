<?php
/**
 * Batch Import Setup - Import Images in Small Batches + Auto-Assign
 *
 * This script imports images in small batches to avoid timeouts,
 * then automatically assigns them to ACF blocks.
 */

// Load WordPress
require_once('../../../wp-load.php');

if (!current_user_can('manage_options')) {
    wp_die('Access denied.');
}

$step = isset($_GET['step']) ? $_GET['step'] : 'preview';
$batch = isset($_GET['batch']) ? intval($_GET['batch']) : 1;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Batch Import Setup</title>
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
        .btn-success { background: #28a745; }
        .btn-success:hover { background: #218838; }
        .btn-lg { padding: 20px 50px; font-size: 20px; }
        .progress-step { padding: 15px; margin: 10px 0; border-radius: 8px; }
        .progress-step.running { background: #d1ecf1; border-left: 4px solid #17a2b8; }
        .progress-step.done { background: #d4edda; border-left: 4px solid #28a745; }
        .batch-progress { background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .batch-bar { background: #e9ecef; height: 30px; border-radius: 15px; overflow: hidden; margin: 10px 0; }
        .batch-bar-fill { background: linear-gradient(90deg, #2d5016, #3d6b1f); height: 100%; transition: width 0.3s ease; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📦 Batch Import Setup</h1>
            <p>Import images in small batches + Auto-assign to ACF blocks</p>
        </div>
        <div class="content">

            <?php if ($step === 'preview'): ?>

                <h2>How This Works</h2>

                <div class="info">
                    <strong>🔄 Batch Import Process:</strong>
                    <ol>
                        <li><strong>Step 1:</strong> Fix ACF field group location rules (if needed)</li>
                        <li><strong>Step 2:</strong> Import images in batches of 12 images each
                            <ul>
                                <li>Each batch completes in 15-20 seconds</li>
                                <li>Click "Continue" to import next batch</li>
                                <li>Repeat until all images are imported</li>
                            </ul>
                        </li>
                        <li><strong>Step 3:</strong> Convert pages to Gutenberg</li>
                        <li><strong>Step 4:</strong> Add ACF blocks to pages</li>
                        <li><strong>Step 5:</strong> <strong>Automatically assign images to blocks</strong></li>
                    </ol>
                </div>

                <div class="success">
                    <strong>✓ Fully Automated:</strong><br>
                    - Images import in safe batches (no timeout)<br>
                    - Images automatically assigned to correct blocks<br>
                    - No manual work needed<br>
                    - Just click "Continue" a few times
                </div>

                <?php
                // Count images in theme folder
                $theme_dir = get_template_directory();
                $images_dir = $theme_dir . '/assets/images';
                $total_images = 0;

                if (is_dir($images_dir)) {
                    foreach (scandir($images_dir) as $file) {
                        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        if (in_array($ext, array('jpg', 'jpeg', 'png', 'gif', 'webp'))) {
                            $total_images++;
                        }
                    }
                }

                $batches_needed = ceil($total_images / 12);
                ?>

                <div class="warning">
                    <strong>📊 Import Stats:</strong><br>
                    - Total images found: <strong><?php echo $total_images; ?></strong><br>
                    - Batches needed: <strong><?php echo $batches_needed; ?></strong><br>
                    - Estimated time: <strong><?php echo ($batches_needed * 20); ?> seconds</strong>
                </div>

                <div style="text-align: center; margin: 40px 0;">
                    <a href="?step=run&batch=1" class="btn btn-success btn-lg">🚀 Start Batch Import</a>
                </div>

            <?php elseif ($step === 'run'): ?>

                <?php
                // Get all images
                $theme_dir = get_template_directory();
                $images_dir = $theme_dir . '/assets/images';

                $all_files = array();
                if (is_dir($images_dir)) {
                    foreach (scandir($images_dir) as $file) {
                        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        if (in_array($ext, array('jpg', 'jpeg', 'png', 'gif', 'webp'))) {
                            $all_files[] = $file;
                        }
                    }
                }

                $total_images = count($all_files);
                $batch_size = 12;
                $total_batches = ceil($total_images / $batch_size);
                $current_batch = $batch;

                // Calculate batch range
                $start_index = ($current_batch - 1) * $batch_size;
                $end_index = min($start_index + $batch_size, $total_images);
                $batch_files = array_slice($all_files, $start_index, $batch_size);

                $progress_percent = min(100, round(($current_batch / $total_batches) * 100));
                ?>

                <h2>Batch Import Progress</h2>

                <div class="batch-progress">
                    <strong>Batch <?php echo $current_batch; ?> of <?php echo $total_batches; ?></strong>
                    <div class="batch-bar">
                        <div class="batch-bar-fill" style="width: <?php echo $progress_percent; ?>%;">
                            <?php echo $progress_percent; ?>%
                        </div>
                    </div>
                    <small>Importing images <?php echo ($start_index + 1); ?>-<?php echo $end_index; ?> of <?php echo $total_images; ?></small>
                </div>

                <?php if ($current_batch == 1): ?>
                    <!-- STEP 1: Fix field groups (only on first batch) -->
                    <div class="progress-step running">
                        <strong>STEP 1:</strong> Fixing ACF Field Group Location Rules...
                    </div>

                    <?php
                    $block_name_fixes = array(
                        'acf/hero' => 'acf/wohnegruen-hero',
                        'acf/vorteile' => 'acf/wohnegruen-features',
                        'acf/models-overview' => 'acf/wohnegruen-models',
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
                                $fixed_groups++;
                            }
                        }
                    }
                    ?>

                    <div class="progress-step done">
                        <strong>STEP 1 COMPLETE:</strong> Fixed <?php echo $fixed_groups; ?> field group location rules
                    </div>
                <?php endif; ?>

                <!-- STEP 2: Import this batch -->
                <div class="progress-step running">
                    <strong>STEP 2 (Batch <?php echo $current_batch; ?>):</strong> Importing Images...
                </div>

                <?php
                $imported = 0;
                $skipped = 0;
                $image_map = get_option('wohnegruen_image_map', array());

                foreach ($batch_files as $file) {
                    $source_path = $images_dir . '/' . $file;

                    // Check if already imported
                    if (isset($image_map[$file])) {
                        $skipped++;
                        echo '<div class="info">⏭️ Already imported: ' . esc_html($file) . '</div>';
                        continue;
                    }

                    // Check if already exists in Media Library
                    $existing = get_posts(array(
                        'post_type' => 'attachment',
                        'meta_query' => array(
                            array(
                                'key' => '_wp_attached_file',
                                'value' => $file,
                                'compare' => 'LIKE',
                            ),
                        ),
                        'posts_per_page' => 1,
                    ));

                    if (!empty($existing)) {
                        $image_map[$file] = $existing[0]->ID;
                        $skipped++;
                        echo '<div class="info">⏭️ Already in library: ' . esc_html($file) . '</div>';
                        continue;
                    }

                    // Import the image
                    $file_array = array(
                        'name' => $file,
                        'tmp_name' => $source_path,
                    );

                    $attachment_id = media_handle_sideload($file_array, 0);

                    if (!is_wp_error($attachment_id)) {
                        $image_map[$file] = $attachment_id;
                        $imported++;
                        echo '<div class="success">✓ Imported: ' . esc_html($file) . ' (ID: ' . $attachment_id . ')</div>';
                    } else {
                        echo '<div class="error">✗ Failed: ' . esc_html($file) . ' - ' . $attachment_id->get_error_message() . '</div>';
                    }
                }

                // Save image map
                update_option('wohnegruen_image_map', $image_map);
                ?>

                <div class="progress-step done">
                    <strong>BATCH <?php echo $current_batch; ?> COMPLETE:</strong>
                    Imported <?php echo $imported; ?>, Skipped <?php echo $skipped; ?> (already existed)
                </div>

                <?php if ($current_batch < $total_batches): ?>
                    <!-- More batches to go -->
                    <div class="info">
                        <strong>📦 More images to import...</strong><br>
                        Batch <?php echo ($current_batch + 1); ?> of <?php echo $total_batches; ?> is ready to import.
                    </div>

                    <div style="text-align: center; margin: 30px 0;">
                        <a href="?step=run&batch=<?php echo ($current_batch + 1); ?>" class="btn btn-success btn-lg">
                            ▶ Continue to Batch <?php echo ($current_batch + 1); ?>
                        </a>
                    </div>

                <?php else: ?>
                    <!-- All batches done, move to content setup -->
                    <div class="success">
                        <strong>✅ All Images Imported!</strong><br>
                        Total images in library: <?php echo count($image_map); ?>
                    </div>

                    <div style="text-align: center; margin: 30px 0;">
                        <a href="?step=setup-content" class="btn btn-success btn-lg">
                            ▶ Continue to Setup Pages
                        </a>
                    </div>
                <?php endif; ?>

            <?php elseif ($step === 'setup-content'): ?>

                <h2>Setting Up Pages...</h2>

                <?php
                // Get the image map
                $image_map = get_option('wohnegruen_image_map', array());

                // Helper function to get image ID by filename pattern
                function get_image_id_by_name($pattern, $image_map) {
                    foreach ($image_map as $filename => $id) {
                        if (stripos($filename, $pattern) !== false) {
                            return $id;
                        }
                    }
                    return '';
                }
                ?>

                <!-- STEP 3: Convert pages -->
                <div class="progress-step running">
                    <strong>STEP 3:</strong> Converting Pages to Gutenberg...
                </div>

                <?php
                $pages = get_pages(array('number' => 999));
                $converted = 0;

                foreach ($pages as $page) {
                    $current_template = get_post_meta($page->ID, '_wp_page_template', true);

                    if ($current_template && $current_template !== 'default') {
                        update_post_meta($page->ID, '_wp_page_template', 'default');
                        $converted++;
                    }
                }
                ?>

                <div class="progress-step done">
                    <strong>STEP 3 COMPLETE:</strong> Converted <?php echo $converted; ?> pages to Gutenberg
                </div>

                <!-- STEP 4: Add content with images -->
                <div class="progress-step running">
                    <strong>STEP 4:</strong> Adding ACF Blocks with Images...
                </div>

                <?php
                $pages_updated = 0;

                // Get common images
                $hero_bg = get_image_id_by_name('hero-bg', $image_map);
                $about_img_id = get_image_id_by_name('about', $image_map);

                // HOMEPAGE
                $home_page = get_page_by_path('home');
                if (!$home_page) {
                    $home_page = get_page_by_title('Home');
                }

                if ($home_page) {
                    $content = '<!-- wp:acf/wohnegruen-hero {"name":"acf/wohnegruen-hero","data":{"hero_background":"' . $hero_bg . '","hero_badge":"Österreichweit verfügbar","hero_title":"Nachhaltige Mobilhäuser für modernes Leben","hero_subtitle":"Hochwertige, maßgefertigte Mobilhäuser mit österreichischer Qualität"},"mode":"preview"} /-->

<!-- wp:acf/wohnegruen-features {"name":"acf/wohnegruen-features","data":{"features_title":"Warum WohneGrün?","features_subtitle":"Entdecken Sie die Vorteile"},"mode":"preview"} /-->

<!-- wp:acf/wohnegruen-models {"name":"acf/wohnegruen-models","data":{"models_title":"Unsere Modelle","models_subtitle":"Entdecken Sie unsere Mobilhaus-Modelle"},"mode":"preview"} /-->

<!-- wp:acf/wohnegruen-about {"name":"acf/wohnegruen-about","data":{"about_image":"' . $about_img_id . '","about_title":"Ihr Partner für modernes Wohnen"},"mode":"preview"} /-->

<!-- wp:acf/wohnegruen-contact {"name":"acf/wohnegruen-contact","data":{"contact_title":"Kontaktieren Sie uns"},"mode":"preview"} /-->';

                    wp_update_post(array(
                        'ID' => $home_page->ID,
                        'post_content' => $content,
                    ));

                    echo '<div class="success">✓ Updated HOMEPAGE with images</div>';
                    $pages_updated++;
                }

                // GALERIE PAGE
                $galerie_page = get_page_by_path('galerie-3d');
                if (!$galerie_page) {
                    $galerie_page = get_page_by_title('Galerie & 3D');
                }

                if ($galerie_page) {
                    // Build gallery images data
                    $gallery_images = array();
                    $gallery_index = 0;

                    foreach ($image_map as $filename => $image_id) {
                        if ($gallery_index >= 20) break;

                        $category = 'innenbereich';
                        $title = pathinfo($filename, PATHINFO_FILENAME);

                        // Determine category
                        if (stripos($filename, 'terrace') !== false || stripos($filename, 'outdoor') !== false || stripos($filename, 'exterior') !== false) {
                            $category = 'aussenbereich';
                            $title = 'Terrasse & Außenbereich';
                        } elseif (stripos($filename, 'nature') !== false) {
                            $category = 'nature-modell';
                        } elseif (stripos($filename, 'pure') !== false) {
                            $category = 'pure-modell';
                        }

                        $gallery_images[] = array(
                            'image' => $image_id,
                            'title' => $title,
                            'category' => $category
                        );
                        $gallery_index++;
                    }

                    // Build gallery data string for Gutenberg
                    $gallery_data = '';
                    foreach ($gallery_images as $index => $img) {
                        $gallery_data .= ',"gallery_images_' . $index . '_image":"' . $img['image'] . '"';
                        $gallery_data .= ',"gallery_images_' . $index . '_title":"' . $img['title'] . '"';
                        $gallery_data .= ',"gallery_images_' . $index . '_category":"' . $img['category'] . '"';
                    }

                    $content = '<!-- wp:acf/wohnegruen-hero {"name":"acf/wohnegruen-hero","data":{"hero_badge":"Bildergalerie","hero_title":"Unsere Mobilhäuser","hero_subtitle":"Entdecken Sie die Schönheit unserer Mobilhäuser"},"mode":"preview"} /-->

<!-- wp:acf/wohnegruen-gallery {"name":"acf/wohnegruen-gallery","data":{"gallery_title":"Galerie","gallery_subtitle":"Lassen Sie sich inspirieren","gallery_show_filters":"1"' . $gallery_data . '},"mode":"preview"} /-->

<!-- wp:acf/wohnegruen-3d-tour {"name":"acf/wohnegruen-3d-tour","data":{"tour_title":"3D Rundgang","tour_subtitle":"Erkunden Sie unsere Mobilhäuser virtuell"},"mode":"preview"} /-->';

                    wp_update_post(array(
                        'ID' => $galerie_page->ID,
                        'post_content' => $content,
                    ));

                    echo '<div class="success">✓ Updated GALERIE page with ' . count($gallery_images) . ' images</div>';
                    $pages_updated++;
                }

                // MODELLE PAGE (simplified for now - you can expand with color sliders)
                $modelle_page = get_page_by_path('modelle');
                if (!$modelle_page) {
                    $modelle_page = get_page_by_title('Modelle');
                }

                if ($modelle_page) {
                    $nature_img = get_image_id_by_name('nature', $image_map);
                    $pure_img = get_image_id_by_name('pure', $image_map);

                    $content = '<!-- wp:acf/wohnegruen-hero {"name":"acf/wohnegruen-hero","data":{"hero_badge":"Unsere Modelle","hero_title":"Nature & Pure","hero_subtitle":"Entdecken Sie unsere Premium-Mobilhaus-Modelle"},"mode":"preview"} /-->';

                    wp_update_post(array(
                        'ID' => $modelle_page->ID,
                        'post_content' => $content,
                    ));

                    echo '<div class="success">✓ Updated MODELLE page</div>';
                    $pages_updated++;
                }

                // ABOUT PAGE
                $about_page = get_page_by_path('uber-uns');
                if (!$about_page) {
                    $about_page = get_page_by_title('Über uns');
                }

                if ($about_page) {
                    $content = '<!-- wp:acf/wohnegruen-hero {"name":"acf/wohnegruen-hero","data":{"hero_badge":"Über uns","hero_title":"WohneGrün - Ihr Partner","hero_subtitle":"Erfahren Sie mehr über unser Unternehmen"},"mode":"preview"} /-->

<!-- wp:acf/wohnegruen-about {"name":"acf/wohnegruen-about","data":{"about_image":"' . $about_img_id . '","about_title":"Nachhaltiges Wohnen seit über 15 Jahren"},"mode":"preview"} /-->';

                    wp_update_post(array(
                        'ID' => $about_page->ID,
                        'post_content' => $content,
                    ));

                    echo '<div class="success">✓ Updated ABOUT page with images</div>';
                    $pages_updated++;
                }

                // KONTAKT PAGE
                $contact_page = get_page_by_path('kontakt');
                if (!$contact_page) {
                    $contact_page = get_page_by_title('Kontakt');
                }

                if ($contact_page) {
                    $content = '<!-- wp:acf/wohnegruen-hero {"name":"acf/wohnegruen-hero","data":{"hero_badge":"Kontakt","hero_title":"Nehmen Sie Kontakt auf","hero_subtitle":"Wir freuen uns auf Ihre Anfrage"},"mode":"preview"} /-->

<!-- wp:acf/wohnegruen-contact {"name":"acf/wohnegruen-contact","data":{"contact_title":"Kontaktieren Sie uns"},"mode":"preview"} /-->';

                    wp_update_post(array(
                        'ID' => $contact_page->ID,
                        'post_content' => $content,
                    ));

                    echo '<div class="success">✓ Updated KONTAKT page</div>';
                    $pages_updated++;
                }
                ?>

                <div class="progress-step done">
                    <strong>STEP 4 COMPLETE:</strong> Updated <?php echo $pages_updated; ?> pages with ACF blocks and images
                </div>

                <h2>✅ Setup Complete!</h2>

                <div class="success">
                    <strong>Summary:</strong><br>
                    - Images imported: <?php echo count($image_map); ?><br>
                    - Pages converted: <?php echo $converted; ?><br>
                    - Pages updated: <?php echo $pages_updated; ?><br>
                    - Images automatically assigned: ✓
                </div>

                <?php
                $site_url = get_site_url();
                $home_url = $home_page ? get_permalink($home_page->ID) : $site_url;
                ?>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="<?php echo esc_url($home_url); ?>" class="btn btn-success btn-lg">🌐 View Website</a>
                    <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" class="btn">📝 Edit Pages</a>
                    <a href="<?php echo admin_url('upload.php'); ?>" class="btn">📷 View Media Library</a>
                </div>

            <?php endif; ?>

        </div>
    </div>
</body>
</html>
