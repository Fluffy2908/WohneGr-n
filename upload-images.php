<?php
/**
 * Batch Upload Images to WordPress Media Library
 *
 * This script uploads all images from theme assets folder to WordPress.
 * Run this file by visiting: https://wohnegruen.at/wp-content/themes/wohnegruen/upload-images.php
 *
 * IMPORTANT: Delete this file after use for security reasons!
 */

// Enable error display for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start output
echo '<html><head><title>Bulk Image Upload</title>';
echo '<style>body{font-family:sans-serif;padding:20px;background:#f5f5f5;} .success{color:green;} .error{color:red;} .info{color:blue;} .warning{color:orange;}</style>';
echo '</head><body>';
echo '<h1>🖼️ Bulk Image Upload to WordPress</h1>';

// Try to load WordPress
$wp_load_path = dirname(dirname(dirname(__DIR__))) . '/wp-load.php';

if (!file_exists($wp_load_path)) {
    echo '<p class="error">❌ ERROR: Cannot find wp-load.php at: ' . htmlspecialchars($wp_load_path) . '</p>';
    echo '<p class="warning">Make sure this file is in: wp-content/themes/wohnegruen/</p>';
    echo '</body></html>';
    exit;
}

echo '<p class="info">Loading WordPress from: ' . htmlspecialchars($wp_load_path) . '</p>';

require_once($wp_load_path);

echo '<p class="success">✅ WordPress loaded successfully</p>';

// Check if user is logged in and is admin
if (!is_user_logged_in()) {
    echo '<p class="error">❌ ERROR: You are not logged in</p>';
    echo '<p class="info">Please <a href="' . wp_login_url($_SERVER['REQUEST_URI']) . '">login as admin</a> first</p>';
    echo '</body></html>';
    exit;
}

if (!current_user_can('upload_files')) {
    echo '<p class="error">❌ ERROR: You do not have permission to upload files</p>';
    echo '<p class="info">Current user: ' . wp_get_current_user()->user_login . '</p>';
    echo '</body></html>';
    exit;
}

echo '<p class="success">✅ User authenticated: ' . wp_get_current_user()->user_login . '</p>';
echo '<hr>';

// Source directory - only theme assets (properly renamed images)
$source_dir = get_template_directory() . '/assets/images';

echo '<p class="info">Source directory: ' . esc_html($source_dir) . '</p>';

if (!is_dir($source_dir)) {
    echo '<p class="error">❌ ERROR: Source directory does not exist</p>';
    echo '</body></html>';
    exit;
}

// Get all image files
$image_extensions = array('jpg', 'jpeg', 'png', 'gif', 'webp');
$files = array();

foreach (scandir($source_dir) as $file) {
    if ($file === '.' || $file === '..') {
        continue;
    }
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if (in_array($ext, $image_extensions)) {
        $files[] = $file;
    }
}

echo '<p class="success">✅ Found ' . count($files) . ' images to upload</p>';
echo '<hr>';
echo '<h2>Upload Progress:</h2>';

// Flush output
if (ob_get_level() > 0) {
    ob_flush();
}
flush();

// Upload each image
$uploaded = 0;
$failed = 0;
$skipped = 0;

foreach ($files as $filename) {
    $filepath = $source_dir . DIRECTORY_SEPARATOR . $filename;

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
        echo '<p class="info">⏭️ Skipped (already exists): ' . esc_html($filename) . '</p>';
        $skipped++;

        // Flush every 10 files
        if (($uploaded + $skipped + $failed) % 10 === 0) {
            if (ob_get_level() > 0) {
                ob_flush();
            }
            flush();
        }
        continue;
    }

    // Get file mime type
    $filetype = wp_check_filetype($filename);

    // Prepare upload
    $upload = wp_upload_bits($filename, null, file_get_contents($filepath));

    if ($upload['error']) {
        echo '<p class="error">❌ Failed: ' . esc_html($filename) . ' - ' . esc_html($upload['error']) . '</p>';
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
        echo '<p class="error">❌ Failed to insert: ' . esc_html($filename) . '</p>';
        $failed++;
        continue;
    }

    // Generate metadata
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
    wp_update_attachment_metadata($attach_id, $attach_data);

    echo '<p class="success">✅ Uploaded: ' . esc_html($filename) . ' (ID: ' . $attach_id . ')</p>';
    $uploaded++;

    // Flush every 10 files for progress display
    if (($uploaded + $skipped + $failed) % 10 === 0) {
        if (ob_get_level() > 0) {
            ob_flush();
        }
        flush();
    }
}

echo '<hr>';
echo '<h2>✅ Upload Complete!</h2>';
echo '<p class="success"><strong>✅ Successfully uploaded: ' . $uploaded . ' images</strong></p>';
if ($skipped > 0) {
    echo '<p class="info"><strong>⏭️ Skipped (already existed): ' . $skipped . ' images</strong></p>';
}
if ($failed > 0) {
    echo '<p class="error"><strong>❌ Failed: ' . $failed . ' images</strong></p>';
}
echo '<p><strong>📊 Total processed: ' . count($files) . ' images</strong></p>';
echo '<hr>';
echo '<p class="error" style="font-size:18px;padding:15px;background:#fff3cd;border:2px solid #ff0000;border-radius:8px;"><strong>🔒 IMPORTANT SECURITY WARNING:</strong><br>Delete this file (upload-images.php) immediately for security reasons!<br>You can delete it via FTP or file manager.</p>';
echo '<p class="info">Go to <a href="' . admin_url('upload.php') . '">Media Library</a> to view uploaded images</p>';
echo '</body></html>';
