<?php
/**
 * Import Theme Images to WordPress Media Library
 *
 * Simple version - imports ALL images at once from theme folder
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
        .btn-success { background: #28a745; }
        .btn-success:hover { background: #218838; }
        .btn-lg { padding: 20px 50px; font-size: 20px; }
        code { background: #f4f4f4; padding: 2px 6px; border-radius: 3px; font-family: monospace; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; font-weight: 600; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📥 Import Theme Images</h1>
            <p>Copy images from theme folder to WordPress Media Library</p>
        </div>
        <div class="content">

            <?php if ($step === 'preview'): ?>

                <h2>🔍 Images Found in Theme Folder</h2>

                <?php
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
                ?>

                <div class="info">
                    <strong>Theme Images Folder:</strong><br>
                    - Path: <code><?php echo esc_html($images_dir); ?></code><br>
                    - Images found: <strong><?php echo count($image_files); ?></strong>
                </div>

                <?php if (count($image_files) > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Filename</th>
                                <th>Size</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1; foreach ($image_files as $file): ?>
                                <tr>
                                    <td><?php echo $index++; ?></td>
                                    <td><code><?php echo esc_html($file); ?></code></td>
                                    <td><?php echo round(filesize($images_dir . '/' . $file) / 1024, 1); ?> KB</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <h2>What This Will Do</h2>

                    <div class="success">
                        <strong>✓ Import Process:</strong><br><br>
                        1. Copy all <?php echo count($image_files); ?> images from theme folder<br>
                        2. Import them into WordPress Media Library<br>
                        3. Generate thumbnails (small, medium, large)<br>
                        4. Images will be available for ACF blocks<br>
                        5. You can then assign them to your blocks
                    </div>

                    <div class="warning">
                        <strong>⚠️ Note:</strong><br>
                        - This will only import images, not assign them to blocks<br>
                        - After import, you'll need to edit pages and select images in ACF blocks<br>
                        - Import may take 30-60 seconds for <?php echo count($image_files); ?> images
                    </div>

                    <div style="text-align: center; margin: 40px 0;">
                        <a href="?step=import" class="btn btn-success btn-lg">📥 Import All Images to Media Library</a>
                    </div>

                <?php else: ?>
                    <div class="error">
                        <strong>No images found in theme folder!</strong><br>
                        Make sure images are uploaded to:<br>
                        <code><?php echo esc_html($images_dir); ?></code>
                    </div>
                <?php endif; ?>

            <?php elseif ($step === 'import'): ?>

                <h2>Importing Images...</h2>

                <?php
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

                $imported = 0;
                $skipped = 0;
                $failed = 0;

                foreach ($image_files as $file) {
                    $source_path = $images_dir . '/' . $file;

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
                        echo '<div class="info">⏭️ Already exists: ' . esc_html($file) . ' (ID: ' . $existing[0]->ID . ')</div>';
                        $skipped++;
                        continue;
                    }

                    // Import the image
                    require_once(ABSPATH . 'wp-admin/includes/file.php');
                    require_once(ABSPATH . 'wp-admin/includes/media.php');
                    require_once(ABSPATH . 'wp-admin/includes/image.php');

                    $file_array = array(
                        'name' => $file,
                        'tmp_name' => $source_path,
                    );

                    // Use media_handle_sideload to import
                    $attachment_id = media_handle_sideload($file_array, 0);

                    if (!is_wp_error($attachment_id)) {
                        echo '<div class="success">✓ Imported: ' . esc_html($file) . ' (ID: ' . $attachment_id . ')</div>';
                        $imported++;
                    } else {
                        echo '<div class="error">✗ Failed: ' . esc_html($file) . ' - ' . $attachment_id->get_error_message() . '</div>';
                        $failed++;
                    }
                }
                ?>

                <h2>✅ Import Complete!</h2>

                <div class="success">
                    <strong>Import Summary:</strong><br>
                    - Imported: <strong><?php echo $imported; ?></strong> new images<br>
                    - Skipped: <?php echo $skipped; ?> (already existed)<br>
                    - Failed: <?php echo $failed; ?><br>
                    - Total in Media Library: <strong><?php echo ($imported + $skipped); ?></strong>
                </div>

                <h2>Next Steps</h2>

                <div class="info">
                    <strong>How to assign images to ACF blocks:</strong><br><br>

                    <strong>1. Go to Pages</strong><br>
                    → <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" target="_blank">Pages</a><br>
                    <br>

                    <strong>2. Edit each page (Homepage, Galerie, etc.)</strong><br>
                    <br>

                    <strong>3. Click on each ACF block</strong><br>
                    - Block settings appear in right sidebar<br>
                    <br>

                    <strong>4. Find image fields (hero_background, about_image, etc.)</strong><br>
                    - Click "Select Image"<br>
                    - Choose from Media Library<br>
                    - Click "Select"<br>
                    <br>

                    <strong>5. Update page</strong><br>
                    - Click "Update" button<br>
                    - View page to see images
                </div>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" class="btn btn-success">📝 Edit Pages</a>
                    <a href="<?php echo admin_url('upload.php'); ?>" class="btn">📷 View Media Library</a>
                    <a href="<?php echo home_url('/'); ?>" class="btn">🌐 View Website</a>
                </div>

            <?php endif; ?>

        </div>
    </div>
</body>
</html>
