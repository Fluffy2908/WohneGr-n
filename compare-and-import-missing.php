<?php
/**
 * Compare Theme Images vs Media Library - Import Missing Ones
 */

// Load WordPress
require_once('../../../wp-load.php');

if (!current_user_can('manage_options')) {
    wp_die('Access denied.');
}

$step = isset($_GET['step']) ? $_GET['step'] : 'compare';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Import Missing Images</title>
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
        code { background: #f4f4f4; padding: 2px 6px; border-radius: 3px; font-family: monospace; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; font-size: 13px; }
        th { background: #f8f9fa; font-weight: 600; }
        .status-missing { color: #dc3545; font-weight: bold; }
        .status-exists { color: #28a745; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔄 Import Missing Images</h1>
            <p>Compare theme folder vs Media Library</p>
        </div>
        <div class="content">

            <?php if ($step === 'compare'): ?>

                <h2>📊 Comparison Report</h2>

                <?php
                $theme_dir = get_template_directory();
                $images_dir = $theme_dir . '/assets/images';

                // Get all images in theme folder
                $theme_images = array();
                if (is_dir($images_dir)) {
                    foreach (scandir($images_dir) as $file) {
                        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        if (in_array($ext, array('jpg', 'jpeg', 'png', 'gif', 'webp'))) {
                            $theme_images[] = $file;
                        }
                    }
                }

                // Get all images in Media Library
                $media_images = array();
                $attachments = get_posts(array(
                    'post_type' => 'attachment',
                    'post_mime_type' => 'image',
                    'posts_per_page' => -1,
                ));

                foreach ($attachments as $attachment) {
                    $file = basename(get_attached_file($attachment->ID));
                    $media_images[$file] = $attachment->ID;
                }

                // Compare
                $in_both = array();
                $missing_from_media = array();

                foreach ($theme_images as $image) {
                    if (isset($media_images[$image])) {
                        $in_both[] = $image;
                    } else {
                        $missing_from_media[] = $image;
                    }
                }
                ?>

                <div class="info">
                    <strong>Summary:</strong><br>
                    - Images in theme folder: <strong><?php echo count($theme_images); ?></strong><br>
                    - Images in Media Library: <strong><?php echo count($media_images); ?></strong><br>
                    - Already imported: <strong><?php echo count($in_both); ?></strong><br>
                    - Missing from Media Library: <strong style="color: #dc3545;"><?php echo count($missing_from_media); ?></strong>
                </div>

                <?php if (count($in_both) > 0): ?>
                    <h2>✅ Already in Media Library (<?php echo count($in_both); ?>)</h2>
                    <details>
                        <summary style="cursor: pointer; font-weight: bold; padding: 10px;">Click to show/hide</summary>
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Filename</th>
                                    <th>Media Library ID</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $index = 1; foreach ($in_both as $image): ?>
                                    <tr>
                                        <td><?php echo $index++; ?></td>
                                        <td><code><?php echo esc_html($image); ?></code></td>
                                        <td><?php echo $media_images[$image]; ?></td>
                                        <td class="status-exists">✓ Exists</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </details>
                <?php endif; ?>

                <?php if (count($missing_from_media) > 0): ?>
                    <h2>❌ Missing from Media Library (<?php echo count($missing_from_media); ?>)</h2>
                    <div class="error">
                        <strong>These <?php echo count($missing_from_media); ?> images exist in theme folder but are NOT in Media Library:</strong>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Filename</th>
                                <th>Size</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1; foreach ($missing_from_media as $image): ?>
                                <tr>
                                    <td><?php echo $index++; ?></td>
                                    <td><code><?php echo esc_html($image); ?></code></td>
                                    <td><?php echo round(filesize($images_dir . '/' . $image) / 1024, 1); ?> KB</td>
                                    <td class="status-missing">✗ Missing</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div style="text-align: center; margin: 30px 0;">
                        <a href="?step=import-missing" class="btn btn-success btn-lg">📥 Import Missing <?php echo count($missing_from_media); ?> Images</a>
                    </div>

                <?php else: ?>
                    <h2>✅ All Images Imported!</h2>
                    <div class="success">
                        <strong>All <?php echo count($theme_images); ?> images from theme folder are in Media Library.</strong><br>
                        No missing images to import!
                    </div>
                <?php endif; ?>

            <?php elseif ($step === 'import-missing'): ?>

                <h2>Importing Missing Images...</h2>

                <?php
                $theme_dir = get_template_directory();
                $images_dir = $theme_dir . '/assets/images';

                // Get all images in theme folder
                $theme_images = array();
                if (is_dir($images_dir)) {
                    foreach (scandir($images_dir) as $file) {
                        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        if (in_array($ext, array('jpg', 'jpeg', 'png', 'gif', 'webp'))) {
                            $theme_images[] = $file;
                        }
                    }
                }

                // Get all images in Media Library
                $media_images = array();
                $attachments = get_posts(array(
                    'post_type' => 'attachment',
                    'post_mime_type' => 'image',
                    'posts_per_page' => -1,
                ));

                foreach ($attachments as $attachment) {
                    $file = basename(get_attached_file($attachment->ID));
                    $media_images[$file] = $attachment->ID;
                }

                // Find missing images
                $missing_from_media = array();
                foreach ($theme_images as $image) {
                    if (!isset($media_images[$image])) {
                        $missing_from_media[] = $image;
                    }
                }

                $imported = 0;
                $failed = 0;

                require_once(ABSPATH . 'wp-admin/includes/file.php');
                require_once(ABSPATH . 'wp-admin/includes/media.php');
                require_once(ABSPATH . 'wp-admin/includes/image.php');

                foreach ($missing_from_media as $file) {
                    $source_path = $images_dir . '/' . $file;

                    $file_array = array(
                        'name' => $file,
                        'tmp_name' => $source_path,
                    );

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
                    - Successfully imported: <strong><?php echo $imported; ?></strong> images<br>
                    - Failed: <?php echo $failed; ?><br>
                    - Total now in Media Library: <strong><?php echo (count($media_images) + $imported); ?></strong>
                </div>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="?step=compare" class="btn">🔍 Check Again</a>
                    <a href="<?php echo admin_url('upload.php'); ?>" class="btn btn-success">📷 View Media Library</a>
                </div>

            <?php endif; ?>

        </div>
    </div>
</body>
</html>
