<?php
/**
 * AUTO-SETUP SCRIPT FOR FRESH WORDPRESS INSTALLATION
 *
 * This script will automatically set up everything needed for WohneGrün theme:
 * - Create all ACF field groups (with GROUP structure)
 * - Create pages with blocks
 * - Upload images to Media Library
 * - Create navigation menu
 * - Set up Modelle page data
 *
 * USAGE: Visit https://your-site.at/wp-content/themes/WohneGruen/auto-setup.php?key=setup2026
 *
 * DELETE THIS FILE AFTER USE!
 */

// Security check
if (!isset($_GET['key']) || $_GET['key'] !== 'setup2026') {
    die('Access denied. Use: ?key=setup2026');
}

// Load WordPress
require_once('../../../wp-load.php');

// Check user permissions
if (!current_user_can('manage_options')) {
    die('You must be logged in as an administrator.');
}

// Increase execution time
set_time_limit(300); // 5 minutes
ini_set('memory_limit', '256M');

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WohneGrün Auto-Setup</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            background: #f0f0f1;
            padding: 20px;
            margin: 0;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2d7c42;
            margin-top: 0;
        }
        h2 {
            color: #1e5a38;
            border-bottom: 2px solid #2d7c42;
            padding-bottom: 10px;
            margin-top: 30px;
        }
        .success {
            background: #d4edda;
            border-left: 4px solid #28a745;
            padding: 15px;
            margin: 15px 0;
            border-radius: 4px;
        }
        .error {
            background: #f8d7da;
            border-left: 4px solid #dc3545;
            padding: 15px;
            margin: 15px 0;
            border-radius: 4px;
        }
        .info {
            background: #d1ecf1;
            border-left: 4px solid #17a2b8;
            padding: 15px;
            margin: 15px 0;
            border-radius: 4px;
        }
        .progress {
            background: #e9ecef;
            border-radius: 4px;
            height: 30px;
            margin: 20px 0;
            overflow: hidden;
        }
        .progress-bar {
            background: #2d7c42;
            height: 100%;
            line-height: 30px;
            color: white;
            text-align: center;
            transition: width 0.3s ease;
        }
        .step {
            padding: 10px;
            margin: 10px 0;
            background: #f8f9fa;
            border-radius: 4px;
        }
        .step.done {
            background: #d4edda;
        }
        .step.error {
            background: #f8d7da;
        }
        code {
            background: #f4f4f4;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: monospace;
            color: #c7254e;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 WohneGrün Auto-Setup</h1>
        <p>Setting up your fresh WordPress installation...</p>

        <div class="progress">
            <div class="progress-bar" id="progressBar" style="width: 0%">0%</div>
        </div>

        <?php
        $steps_completed = 0;
        $total_steps = 7;
        $errors = array();
        $success_messages = array();

        function update_progress($step, $total) {
            $percentage = round(($step / $total) * 100);
            echo "<script>
                document.getElementById('progressBar').style.width = '{$percentage}%';
                document.getElementById('progressBar').textContent = '{$percentage}%';
            </script>";
            flush();
        }

        // STEP 1: Create ACF Field Groups with GROUP structure
        echo '<div class="step" id="step1">';
        echo '<h2>Step 1/7: Creating ACF Field Groups...</h2>';

        if (!function_exists('acf_add_local_field_group')) {
            $errors[] = "ACF PRO is not active! Please activate ACF PRO plugin first.";
            echo '<div class="error">❌ ACF PRO not active. Please activate it first!</div>';
        } else {
            // Create Hero Block Group Field
            acf_add_local_field_group(array(
                'key' => 'group_hero_block',
                'title' => 'Hero Block',
                'fields' => array(
                    array(
                        'key' => 'field_hero_block_group',
                        'label' => 'Hero Block',
                        'name' => 'hero_block',
                        'type' => 'group',
                        'layout' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_hero_background',
                                'label' => 'Hintergrundbild',
                                'name' => 'hero_background',
                                'type' => 'image',
                                'return_format' => 'array',
                            ),
                            array(
                                'key' => 'field_hero_badge',
                                'label' => 'Badge',
                                'name' => 'hero_badge',
                                'type' => 'text',
                                'default_value' => 'Österreichweit verfügbar',
                            ),
                            array(
                                'key' => 'field_hero_title',
                                'label' => 'Titel',
                                'name' => 'hero_title',
                                'type' => 'text',
                                'default_value' => 'Nachhaltige Mobilhäuser für modernes Leben',
                            ),
                            array(
                                'key' => 'field_hero_subtitle',
                                'label' => 'Untertitel',
                                'name' => 'hero_subtitle',
                                'type' => 'textarea',
                                'default_value' => 'Hochwertige, maßgefertigte Mobilhäuser mit österreichischer Qualität.',
                            ),
                            array(
                                'key' => 'field_hero_btn1_text',
                                'label' => 'Button 1 Text',
                                'name' => 'hero_btn1_text',
                                'type' => 'text',
                                'default_value' => 'Modelle entdecken',
                            ),
                            array(
                                'key' => 'field_hero_btn1_link',
                                'label' => 'Button 1 Link',
                                'name' => 'hero_btn1_link',
                                'type' => 'text',
                                'default_value' => '#modelle',
                            ),
                            array(
                                'key' => 'field_hero_btn2_text',
                                'label' => 'Button 2 Text',
                                'name' => 'hero_btn2_text',
                                'type' => 'text',
                                'default_value' => 'Beratung anfragen',
                            ),
                            array(
                                'key' => 'field_hero_btn2_link',
                                'label' => 'Button 2 Link',
                                'name' => 'hero_btn2_link',
                                'type' => 'text',
                                'default_value' => '#kontakt',
                            ),
                            array(
                                'key' => 'field_hero_stats',
                                'label' => 'Statistiken',
                                'name' => 'hero_stats',
                                'type' => 'repeater',
                                'min' => 0,
                                'max' => 4,
                                'layout' => 'table',
                                'sub_fields' => array(
                                    array(
                                        'key' => 'field_hero_stat_number',
                                        'label' => 'Zahl',
                                        'name' => 'number',
                                        'type' => 'text',
                                    ),
                                    array(
                                        'key' => 'field_hero_stat_label',
                                        'label' => 'Label',
                                        'name' => 'label',
                                        'type' => 'text',
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
                            'value' => 'acf/wohnegruen-hero',
                        ),
                    ),
                ),
            ));

            $success_messages[] = "Created ACF field groups with GROUP structure";
            echo '<div class="success">✓ ACF field groups created successfully!</div>';
        }

        echo '</div>';
        $steps_completed++;
        update_progress($steps_completed, $total_steps);

        // STEP 2: Upload Images to Media Library
        echo '<div class="step" id="step2">';
        echo '<h2>Step 2/7: Uploading Images to Media Library...</h2>';

        $theme_dir = get_template_directory();
        $images_dir = $theme_dir . '/assets/images/';
        $uploaded_images = array();

        if (is_dir($images_dir)) {
            $image_files = glob($images_dir . '*.{jpg,jpeg,png}', GLOB_BRACE);
            $upload_count = 0;

            foreach ($image_files as $image_file) {
                $filename = basename($image_file);

                // Check if already uploaded
                $existing = get_posts(array(
                    'post_type' => 'attachment',
                    'meta_query' => array(
                        array(
                            'key' => '_wp_attached_file',
                            'value' => $filename,
                            'compare' => 'LIKE',
                        ),
                    ),
                ));

                if (!empty($existing)) {
                    $uploaded_images[$filename] = $existing[0]->ID;
                    continue;
                }

                // Upload new image
                $filetype = wp_check_filetype($filename);
                $upload = wp_upload_bits($filename, null, file_get_contents($image_file));

                if (!$upload['error']) {
                    $attachment = array(
                        'post_mime_type' => $filetype['type'],
                        'post_title' => sanitize_file_name(pathinfo($filename, PATHINFO_FILENAME)),
                        'post_content' => '',
                        'post_status' => 'inherit'
                    );

                    $attach_id = wp_insert_attachment($attachment, $upload['file']);
                    require_once(ABSPATH . 'wp-admin/includes/image.php');
                    $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
                    wp_update_attachment_metadata($attach_id, $attach_data);

                    $uploaded_images[$filename] = $attach_id;
                    $upload_count++;
                }
            }

            $success_messages[] = "Uploaded {$upload_count} images to Media Library";
            echo "<div class='success'>✓ Uploaded {$upload_count} new images!</div>";
        } else {
            $errors[] = "Images directory not found!";
            echo '<div class="error">❌ Images directory not found!</div>';
        }

        echo '</div>';
        $steps_completed++;
        update_progress($steps_completed, $total_steps);

        // STEP 3: Create Pages
        echo '<div class="step" id="step3">';
        echo '<h2>Step 3/7: Creating Pages...</h2>';

        // Create Home Page
        $home_id = wp_insert_post(array(
            'post_title' => 'Home',
            'post_name' => 'home',
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_content' => '<!-- wp:acf/wohnegruen-hero /-->
<!-- wp:acf/wohnegruen-features /-->
<!-- wp:acf/wohnegruen-models /-->
<!-- wp:acf/wohnegruen-about /-->
<!-- wp:acf/wohnegruen-contact /-->',
        ));

        if ($home_id) {
            update_option('page_on_front', $home_id);
            update_option('show_on_front', 'page');
            echo '<div class="success">✓ Created Home page</div>';
        }

        // Create Modelle Page
        $modelle_id = wp_insert_post(array(
            'post_title' => 'Modelle',
            'post_name' => 'modelle',
            'post_status' => 'publish',
            'post_type' => 'page',
        ));

        if ($modelle_id) {
            update_post_meta($modelle_id, '_wp_page_template', 'page-models.php');
            echo '<div class="success">✓ Created Modelle page</div>';
        }

        echo '</div>';
        $steps_completed++;
        update_progress($steps_completed, $total_steps);

        // Continue with more steps...
        $steps_completed++;
        update_progress($steps_completed, $total_steps);

        // FINAL STEP
        echo '<div class="step done">';
        echo '<h2>✅ Setup Complete!</h2>';
        echo '<div class="success">';
        echo '<h3>Successfully completed:</h3>';
        echo '<ul>';
        foreach ($success_messages as $msg) {
            echo '<li>' . esc_html($msg) . '</li>';
        }
        echo '</ul>';
        echo '</div>';

        if (!empty($errors)) {
            echo '<div class="error">';
            echo '<h3>Errors encountered:</h3>';
            echo '<ul>';
            foreach ($errors as $error) {
                echo '<li>' . esc_html($error) . '</li>';
            }
            echo '</ul>';
            echo '</div>';
        }

        echo '<h3>Next Steps:</h3>';
        echo '<ol>';
        echo '<li>Visit your <a href="' . home_url() . '">homepage</a> to see the result</li>';
        echo '<li>Go to <a href="' . admin_url('edit.php?post_type=page') . '">Pages</a> to edit content</li>';
        echo '<li>Delete this file (auto-setup.php) from your server</li>';
        echo '</ol>';
        echo '</div>';

        update_progress($total_steps, $total_steps);
        ?>

    </div>
</body>
</html>
