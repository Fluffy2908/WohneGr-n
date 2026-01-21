<?php
/**
 * Batch Upload Images to WordPress Media Library
 *
 * This script uploads all images from the Hosekra slike folder to WordPress.
 * Run this file by visiting: https://wohnegruen.at/wp-content/themes/wohnegruen/upload-images.php
 *
 * IMPORTANT: Delete this file after use for security reasons!
 */

// Load WordPress
require_once('../../../wp-load.php');

// Check if user is logged in and is admin
if (!is_user_logged_in() || !current_user_can('upload_files')) {
    wp_die('You do not have permission to upload files.');
}

// Source directories
$source_dirs = array(
    'Hosekra Images' => 'C:\Users\Uporabnik\Documents\Hosekra slike',
    'Theme Assets' => get_template_directory() . '/assets/images'
);

// Get all image files from both directories
$image_extensions = array('jpg', 'jpeg', 'png', 'gif', 'webp');
$files = array();

foreach ($source_dirs as $dir_name => $source_dir) {
    if (!is_dir($source_dir)) {
        continue;
    }

    foreach (scandir($source_dir) as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (in_array($ext, $image_extensions)) {
            $files[] = array(
                'source' => $dir_name,
                'dir' => $source_dir,
                'filename' => $file,
                'filepath' => $source_dir . DIRECTORY_SEPARATOR . $file
            );
        }
    }
}

echo '<html><head><title>Bulk Image Upload</title>';
echo '<style>body{font-family:sans-serif;padding:20px;} .success{color:green;} .error{color:red;} .info{color:blue;}</style>';
echo '</head><body>';
echo '<h1>Bulk Image Upload to WordPress</h1>';
echo '<p class="info">Found ' . count($files) . ' images to upload</p>';
echo '<hr>';

// Upload each image
$uploaded = 0;
$failed = 0;
$skipped = 0;

foreach ($files as $file_data) {
    $filename = $file_data['filename'];
    $filepath = $file_data['filepath'];
    $source = $file_data['source'];

    // Check if file already exists in media library by filename
    $existing = get_posts(array(
        'post_type' => 'attachment',
        'post_status' => 'any',
        'meta_query' => array(
            array(
                'key' => '_wp_attached_file',
                'value' => $filename,
                'compare' => 'LIKE'
            )
        ),
        'posts_per_page' => 1
    ));

    if (!empty($existing)) {
        echo '<p class="info">⏭️ Skipped (already exists): <strong>[' . esc_html($source) . ']</strong> ' . esc_html($filename) . '</p>';
        $skipped++;
        continue;
    }

    // Get file mime type
    $filetype = wp_check_filetype($filename);

    // Prepare upload
    $upload = wp_upload_bits($filename, null, file_get_contents($filepath));

    if ($upload['error']) {
        echo '<p class="error">❌ Failed: <strong>[' . esc_html($source) . ']</strong> ' . esc_html($filename) . ' - ' . esc_html($upload['error']) . '</p>';
        $failed++;
        continue;
    }

    // Prepare attachment data
    $attachment = array(
        'guid' => $upload['url'],
        'post_mime_type' => $filetype['type'],
        'post_title' => sanitize_file_name(pathinfo($filename, PATHINFO_FILENAME)),
        'post_content' => '',
        'post_status' => 'inherit'
    );

    // Insert attachment
    $attach_id = wp_insert_attachment($attachment, $upload['file']);

    if (is_wp_error($attach_id)) {
        echo '<p class="error">❌ Failed to insert: <strong>[' . esc_html($source) . ']</strong> ' . esc_html($filename) . '</p>';
        $failed++;
        continue;
    }

    // Generate metadata
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
    wp_update_attachment_metadata($attach_id, $attach_data);

    echo '<p class="success">✅ Uploaded: <strong>[' . esc_html($source) . ']</strong> ' . esc_html($filename) . ' (ID: ' . $attach_id . ')</p>';
    $uploaded++;

    // Flush output buffer to show progress in real-time
    if (ob_get_level() > 0) {
        ob_flush();
    }
    flush();
}

echo '<hr>';
echo '<h2>Upload Complete!</h2>';
echo '<p class="success">✅ Successfully uploaded: ' . $uploaded . ' images</p>';
if ($skipped > 0) {
    echo '<p class="info">⏭️ Skipped (already existed): ' . $skipped . ' images</p>';
}
if ($failed > 0) {
    echo '<p class="error">❌ Failed: ' . $failed . ' images</p>';
}
echo '<p><strong>Total processed: ' . count($files) . ' images</strong></p>';
echo '<hr>';
echo '<p class="error" style="font-size:18px;"><strong>🔒 IMPORTANT:</strong> Delete this file (upload-images.php) immediately for security reasons!</p>';
echo '</body></html>';
