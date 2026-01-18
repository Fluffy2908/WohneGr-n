<?php
/**
 * Quick Website Setup (Without Image Import)
 *
 * This script sets up the website WITHOUT importing images.
 * Upload images manually through WordPress Media Library after setup.
 */

// Load WordPress
require_once('../../../wp-load.php');

if (!current_user_can('manage_options')) {
    wp_die('Access denied.');
}

$step = isset($_GET['step']) ? $_GET['step'] : 'preview';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Quick Setup (No Images)</title>
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
        .progress-step { padding: 15px; margin: 10px 0; border-radius: 8px; }
        .progress-step.running { background: #d1ecf1; border-left: 4px solid #17a2b8; }
        .progress-step.done { background: #d4edda; border-left: 4px solid #28a745; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>⚡ Quick Website Setup</h1>
            <p>Setup pages without image import (faster)</p>
        </div>
        <div class="content">

            <?php if ($step === 'preview'): ?>

                <h2>What This Will Do</h2>

                <div class="info">
                    <strong>Quick Setup Steps:</strong>
                    <ol>
                        <li><strong>Fix Field Group Location Rules</strong> (if needed)</li>
                        <li><strong>Convert Pages to Gutenberg</strong></li>
                        <li><strong>Add ACF Blocks to All Pages</strong> with complete content structure</li>
                    </ol>
                </div>

                <div class="warning">
                    <strong>⚠️ Images NOT Included:</strong><br>
                    This version skips image import to avoid timeout issues.<br>
                    <br>
                    <strong>After setup, you'll need to:</strong><br>
                    1. Go to WordPress Media Library<br>
                    2. Upload images manually<br>
                    3. Edit each page in Gutenberg<br>
                    4. Assign images to ACF blocks
                </div>

                <div class="success">
                    <strong>✓ Result:</strong><br>
                    - All pages ready with ACF blocks<br>
                    - Field groups working correctly<br>
                    - Content structure in place<br>
                    - Ready for you to add images
                </div>

                <div style="text-align: center; margin: 40px 0;">
                    <a href="?step=run" class="btn btn-success">🚀 Run Quick Setup (No Images)</a>
                </div>

            <?php elseif ($step === 'run'): ?>

                <h2>Running Quick Setup...</h2>

                <?php
                // STEP 1: Fix field group location rules
                echo '<div class="progress-step running"><strong>STEP 1:</strong> Fixing Field Group Location Rules...</div>';

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

                <!-- STEP 2: Convert pages to default template -->
                <div class="progress-step running">
                    <strong>STEP 2:</strong> Converting Pages to Gutenberg...
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
                    <strong>STEP 2 COMPLETE:</strong> Converted <?php echo $converted; ?> pages to Gutenberg
                </div>

                <!-- STEP 3: Add content to pages -->
                <div class="progress-step running">
                    <strong>STEP 3:</strong> Adding ACF Blocks to Pages...
                </div>

                <?php
                $pages_updated = 0;

                // HOMEPAGE
                $home_page = get_page_by_path('home');
                if (!$home_page) {
                    $home_page = get_page_by_title('Home');
                }

                if ($home_page) {
                    $content = '<!-- wp:acf/wohnegruen-hero {"name":"acf/wohnegruen-hero","data":{"hero_badge":"Österreichweit verfügbar","hero_title":"Nachhaltige Mobilhäuser für modernes Leben","hero_subtitle":"Hochwertige, maßgefertigte Mobilhäuser mit österreichischer Qualität"},"mode":"preview"} /-->

<!-- wp:acf/wohnegruen-features {"name":"acf/wohnegruen-features","data":{"features_title":"Warum WohneGrün?","features_subtitle":"Entdecken Sie die Vorteile"},"mode":"preview"} /-->

<!-- wp:acf/wohnegruen-models {"name":"acf/wohnegruen-models","data":{"models_title":"Unsere Modelle","models_subtitle":"Entdecken Sie unsere Mobilhaus-Modelle"},"mode":"preview"} /-->

<!-- wp:acf/wohnegruen-about {"name":"acf/wohnegruen-about","data":{"about_title":"Ihr Partner für modernes Wohnen","about_text1":"WohneGrün ist Ihr zuverlässiger Partner für hochwertige Mobilhäuser."},"mode":"preview"} /-->

<!-- wp:acf/wohnegruen-contact {"name":"acf/wohnegruen-contact","data":{"contact_title":"Kontaktieren Sie uns","contact_subtitle":"Haben Sie Fragen zu unseren Mobilhäusern?"},"mode":"preview"} /-->';

                    wp_update_post(array(
                        'ID' => $home_page->ID,
                        'post_content' => $content,
                    ));

                    echo '<div class="success">✓ Updated HOMEPAGE</div>';
                    $pages_updated++;
                }

                // GALERIE PAGE
                $galerie_page = get_page_by_path('galerie-3d');
                if (!$galerie_page) {
                    $galerie_page = get_page_by_title('Galerie & 3D');
                }

                if ($galerie_page) {
                    $content = '<!-- wp:acf/wohnegruen-hero {"name":"acf/wohnegruen-hero","data":{"hero_badge":"Bildergalerie","hero_title":"Unsere Mobilhäuser","hero_subtitle":"Entdecken Sie die Schönheit unserer Mobilhäuser"},"mode":"preview"} /-->

<!-- wp:acf/wohnegruen-gallery {"name":"acf/wohnegruen-gallery","data":{"gallery_title":"Galerie","gallery_subtitle":"Lassen Sie sich inspirieren","gallery_show_filters":"1"},"mode":"preview"} /-->

<!-- wp:acf/wohnegruen-3d-tour {"name":"acf/wohnegruen-3d-tour","data":{"tour_title":"3D Rundgang","tour_subtitle":"Erkunden Sie unsere Mobilhäuser virtuell","tour_description":"Erleben Sie unsere Mobilhäuser in einem interaktiven 3D-Rundgang."},"mode":"preview"} /-->';

                    wp_update_post(array(
                        'ID' => $galerie_page->ID,
                        'post_content' => $content,
                    ));

                    echo '<div class="success">✓ Updated GALERIE page</div>';
                    $pages_updated++;
                }

                // MODELLE PAGE
                $modelle_page = get_page_by_path('modelle');
                if (!$modelle_page) {
                    $modelle_page = get_page_by_title('Modelle');
                }

                if ($modelle_page) {
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

<!-- wp:acf/wohnegruen-about {"name":"acf/wohnegruen-about","data":{"about_title":"Nachhaltiges Wohnen seit über 15 Jahren","about_text1":"WohneGrün wurde mit der Vision gegründet, hochwertiges und nachhaltiges Wohnen zugänglich zu machen."},"mode":"preview"} /-->';

                    wp_update_post(array(
                        'ID' => $about_page->ID,
                        'post_content' => $content,
                    ));

                    echo '<div class="success">✓ Updated ABOUT page</div>';
                    $pages_updated++;
                }

                // KONTAKT PAGE
                $contact_page = get_page_by_path('kontakt');
                if (!$contact_page) {
                    $contact_page = get_page_by_title('Kontakt');
                }

                if ($contact_page) {
                    $content = '<!-- wp:acf/wohnegruen-hero {"name":"acf/wohnegruen-hero","data":{"hero_badge":"Kontakt","hero_title":"Nehmen Sie Kontakt auf","hero_subtitle":"Wir freuen uns auf Ihre Anfrage"},"mode":"preview"} /-->

<!-- wp:acf/wohnegruen-contact {"name":"acf/wohnegruen-contact","data":{"contact_title":"Kontaktieren Sie uns","contact_subtitle":"Haben Sie Fragen? Wir beraten Sie gerne!"},"mode":"preview"} /-->';

                    wp_update_post(array(
                        'ID' => $contact_page->ID,
                        'post_content' => $content,
                    ));

                    echo '<div class="success">✓ Updated KONTAKT page</div>';
                    $pages_updated++;
                }
                ?>

                <div class="progress-step done">
                    <strong>STEP 3 COMPLETE:</strong> Updated <?php echo $pages_updated; ?> pages with ACF blocks
                </div>

                <h2>✅ Quick Setup Complete!</h2>

                <div class="success">
                    <strong>Summary:</strong><br>
                    - Field groups fixed: <?php echo $fixed_groups; ?><br>
                    - Pages converted: <?php echo $converted; ?><br>
                    - Pages updated: <?php echo $pages_updated; ?>
                </div>

                <h2>Next Steps: Add Images</h2>

                <div class="warning">
                    <strong>How to add images manually:</strong><br>
                    <br>
                    <strong>1. Upload Images to Media Library</strong><br>
                    - Go to: <a href="<?php echo admin_url('upload.php'); ?>" target="_blank">Media → Add New</a><br>
                    - Upload all your images<br>
                    <br>
                    <strong>2. Edit Pages and Assign Images</strong><br>
                    - Go to: <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" target="_blank">Pages</a><br>
                    - Edit each page<br>
                    - Click on ACF blocks<br>
                    - Use the sidebar to select images from Media Library<br>
                    <br>
                    <strong>3. Save and View</strong><br>
                    - Click "Update" on each page<br>
                    - View your website to see the results
                </div>

                <?php
                $site_url = get_site_url();
                $home_url = $home_page ? get_permalink($home_page->ID) : $site_url;
                ?>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="<?php echo esc_url($home_url); ?>" class="btn btn-success">🌐 View Website</a>
                    <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" class="btn">📝 Edit Pages</a>
                    <a href="<?php echo admin_url('upload.php'); ?>" class="btn">📷 Media Library</a>
                </div>

            <?php endif; ?>

        </div>
    </div>
</body>
</html>
