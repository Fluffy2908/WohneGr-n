<?php
/**
 * Import Theme Images to WordPress Media Library
 *
 * This script imports all images from theme assets/images folder
 * into WordPress Media Library so they can be used in ACF blocks
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
    <title>Import Theme Images</title>
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
        h2 { color: #2d5016; border-bottom: 2px solid #2d5016; padding-bottom: 10px; }
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
        img { max-width: 100px; height: auto; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📸 Import Theme Images</h1>
            <p>Move images from theme to WordPress Media Library</p>
        </div>
        <div class="content">

            <?php if ($step === 'preview'): ?>

                <h2>Theme Images Found</h2>

                <?php
                $theme_dir = get_template_directory();
                $images_dir = $theme_dir . '/assets/images';

                $files = array();
                if (is_dir($images_dir)) {
                    $scanned = scandir($images_dir);
                    foreach ($scanned as $file) {
                        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        if (in_array($ext, array('jpg', 'jpeg', 'png', 'gif', 'webp'))) {
                            $files[] = $file;
                        }
                    }
                }
                ?>

                <div class="info">
                    <strong>Found <?php echo count($files); ?> image files in theme assets folder</strong>
                </div>

                <?php if (!empty($files)): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Filename</th>
                                <th>Size</th>
                                <th>Preview</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($files as $file): ?>
                                <tr>
                                    <td><code><?php echo esc_html($file); ?></code></td>
                                    <td><?php echo round(filesize($images_dir . '/' . $file) / 1024, 2); ?> KB</td>
                                    <td><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/' . $file); ?>" alt=""></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div class="warning">
                        <strong>⚠️ What This Will Do:</strong><br>
                        - Copy all images from theme assets to WordPress Media Library<br>
                        - Images will be available for use in ACF blocks<br>
                        - Original theme files will remain unchanged<br>
                        - Existing media library images will not be affected
                    </div>

                    <div style="text-align: center; margin: 40px 0;">
                        <a href="?step=import" class="btn btn-danger">📥 Import All Images</a>
                        <a href="full-website-diagnosis.php" class="btn">← Back</a>
                    </div>
                <?php else: ?>
                    <div class="error">
                        <strong>✗ No images found in theme assets folder!</strong>
                    </div>
                <?php endif; ?>

            <?php elseif ($step === 'import'): ?>

                <h2>Importing Images...</h2>

                <?php
                // Require WordPress media upload functions
                require_once(ABSPATH . 'wp-admin/includes/image.php');
                require_once(ABSPATH . 'wp-admin/includes/file.php');
                require_once(ABSPATH . 'wp-admin/includes/media.php');

                $theme_dir = get_template_directory();
                $images_dir = $theme_dir . '/assets/images';
                $uploaded_dir = wp_upload_dir();

                $files = array();
                if (is_dir($images_dir)) {
                    $scanned = scandir($images_dir);
                    foreach ($scanned as $file) {
                        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        if (in_array($ext, array('jpg', 'jpeg', 'png', 'gif', 'webp'))) {
                            $files[] = $file;
                        }
                    }
                }

                $imported = 0;
                $skipped = 0;
                $errors = 0;

                foreach ($files as $file) {
                    $source_path = $images_dir . '/' . $file;

                    // Check if file with same name already exists in media library
                    $existing = get_posts(array(
                        'post_type' => 'attachment',
                        'name' => pathinfo($file, PATHINFO_FILENAME),
                        'posts_per_page' => 1,
                    ));

                    if (!empty($existing)) {
                        echo '<div class="info">Skip: ' . esc_html($file) . ' (already in media library)</div>';
                        $skipped++;
                        continue;
                    }

                    // Copy file to uploads directory
                    $filename = wp_unique_filename($uploaded_dir['path'], $file);
                    $destination_path = $uploaded_dir['path'] . '/' . $filename;

                    if (!copy($source_path, $destination_path)) {
                        echo '<div class="error">✗ Failed to copy: ' . esc_html($file) . '</div>';
                        $errors++;
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
                        // Generate metadata
                        $attach_data = wp_generate_attachment_metadata($attachment_id, $destination_path);
                        wp_update_attachment_metadata($attachment_id, $attach_data);

                        echo '<div class="success">✓ Imported: ' . esc_html($file) . ' (ID: ' . $attachment_id . ')</div>';
                        $imported++;
                    } else {
                        echo '<div class="error">✗ Failed to create attachment: ' . esc_html($file) . '</div>';
                        $errors++;
                    }
                }
                ?>

                <h2>✅ Import Complete!</h2>

                <div class="success">
                    <strong>Summary:</strong><br>
                    - Imported: <?php echo $imported; ?> images<br>
                    - Skipped: <?php echo $skipped; ?> (already exist)<br>
                    - Errors: <?php echo $errors; ?>
                </div>

                <h2>Imported Images</h2>
                <?php
                // Show all images now in media library
                $media_query = new WP_Query(array(
                    'post_type' => 'attachment',
                    'post_status' => 'inherit',
                    'posts_per_page' => -1,
                    'post_mime_type' => 'image',
                    'orderby' => 'date',
                    'order' => 'DESC',
                ));
                ?>
                <div class="info">
                    <strong>Total images in Media Library:</strong> <?php echo $media_query->found_posts; ?>
                </div>

                <?php if ($media_query->have_posts()): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Filename</th>
                                <th>Date</th>
                                <th>Preview</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 0;
                            while ($media_query->have_posts() && $count < 20):
                                $media_query->the_post();
                                $count++;
                            ?>
                                <tr>
                                    <td><?php the_title(); ?></td>
                                    <td><code><?php echo basename(get_attached_file(get_the_ID())); ?></code></td>
                                    <td><?php echo get_the_date(); ?></td>
                                    <td><img src="<?php echo wp_get_attachment_image_url(get_the_ID(), 'thumbnail'); ?>" alt=""></td>
                                </tr>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </tbody>
                    </table>
                    <?php if ($media_query->found_posts > 20): ?>
                        <div class="info">Showing first 20 images. Total: <?php echo $media_query->found_posts; ?></div>
                    <?php endif; ?>
                <?php endif; ?>

                <h2>Next Steps</h2>
                <div class="info">
                    <strong>Images are now available for use!</strong><br>
                    1. Edit pages in WordPress<br>
                    2. Add ACF blocks<br>
                    3. In ACF image fields, select images from Media Library<br>
                    4. All theme images are now available to choose from
                </div>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="<?php echo admin_url('upload.php'); ?>" class="btn">View Media Library</a>
                    <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" class="btn">Edit Pages</a>
                    <a href="create-default-content.php" class="btn">Add Default Content</a>
                </div>

            <?php endif; ?>

        </div>
    </div>
</body>
</html>
