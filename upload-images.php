<?php
/**
 * Batch Upload Images to WordPress Media Library
 *
 * IMPORTANT: Delete this file after use for security reasons!
 */

// Load WordPress
define('WP_USE_THEMES', false);
$wp_load = '../../../wp-load.php';

if (!file_exists($wp_load)) {
    die('ERROR: Cannot find WordPress. Make sure this file is in wp-content/themes/wohnegruen/');
}

require_once($wp_load);

// Check permissions
if (!is_user_logged_in() || !current_user_can('upload_files')) {
    wp_die('You must be logged in as an administrator to use this tool. <a href="' . wp_login_url($_SERVER['REQUEST_URI']) . '">Login here</a>');
}

// Start output
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bulk Image Upload</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; padding: 20px; background: #f0f0f1; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        h1 { color: #1d2327; margin-top: 0; }
        .success { color: #00a32a; }
        .error { color: #d63638; }
        .info { color: #2271b1; }
        .warning { background: #fff3cd; border-left: 4px solid #ffc107; padding: 12px; margin: 20px 0; }
        .progress { margin: 20px 0; }
        .stats { display: flex; gap: 20px; margin: 20px 0; padding: 20px; background: #f6f7f7; border-radius: 4px; }
        .stat { flex: 1; text-align: center; }
        .stat-number { font-size: 32px; font-weight: bold; }
        hr { border: none; border-top: 1px solid #dcdcde; margin: 30px 0; }
    </style>
</head>
<body>
<div class="container">
    <h1>🖼️ Bulk Image Upload</h1>
    <p class="info">✅ Logged in as: <strong><?php echo wp_get_current_user()->user_login; ?></strong></p>

<?php

// Source directory
$source_dir = get_template_directory() . '/assets/images';

if (!is_dir($source_dir)) {
    echo '<p class="error">❌ ERROR: Images directory not found: ' . esc_html($source_dir) . '</p>';
    echo '</div></body></html>';
    exit;
}

// Get all image files
$allowed_types = array('jpg', 'jpeg', 'png', 'gif', 'webp');
$files = array();

foreach (scandir($source_dir) as $file) {
    if ($file === '.' || $file === '..') continue;

    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if (in_array($ext, $allowed_types)) {
        $files[] = $file;
    }
}

echo '<p class="success">📁 Found ' . count($files) . ' images in: ' . esc_html(basename($source_dir)) . '/</p>';
echo '<hr>';
echo '<h2>Upload Progress:</h2>';
echo '<div class="progress">';

// Flush output to show progress
if (function_exists('wp_ob_end_flush_all')) {
    wp_ob_end_flush_all();
}
flush();

// Upload statistics
$uploaded = 0;
$skipped = 0;
$failed = 0;

// Include required files
require_once(ABSPATH . 'wp-admin/includes/image.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/media.php');

// Upload each file
foreach ($files as $filename) {
    $filepath = $source_dir . '/' . $filename;

    // Check if already exists
    $existing = get_posts(array(
        'post_type' => 'attachment',
        'post_status' => 'any',
        'posts_per_page' => 1,
        'meta_query' => array(
            array(
                'key' => '_wp_attached_file',
                'value' => $filename,
                'compare' => 'LIKE'
            )
        )
    ));

    if (!empty($existing)) {
        echo '<p class="info">⏭️ ' . esc_html($filename) . ' (already exists)</p>';
        $skipped++;

        if (($uploaded + $skipped + $failed) % 20 === 0) {
            flush();
        }
        continue;
    }

    // Upload file
    $upload = wp_upload_bits($filename, null, file_get_contents($filepath));

    if ($upload['error']) {
        echo '<p class="error">❌ ' . esc_html($filename) . ' - ' . esc_html($upload['error']) . '</p>';
        $failed++;
        continue;
    }

    // Create attachment
    $attachment = array(
        'guid' => $upload['url'],
        'post_mime_type' => wp_check_filetype($filename)['type'],
        'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );

    $attach_id = wp_insert_attachment($attachment, $upload['file']);

    if (is_wp_error($attach_id)) {
        echo '<p class="error">❌ ' . esc_html($filename) . ' - Failed to create attachment</p>';
        $failed++;
        continue;
    }

    // Generate thumbnails
    $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
    wp_update_attachment_metadata($attach_id, $attach_data);

    echo '<p class="success">✅ ' . esc_html($filename) . ' (ID: ' . $attach_id . ')</p>';
    $uploaded++;

    // Flush every 20 files
    if (($uploaded + $skipped + $failed) % 20 === 0) {
        flush();
    }
}

echo '</div>';
echo '<hr>';
echo '<h2>✅ Upload Complete!</h2>';

echo '<div class="stats">';
echo '<div class="stat"><div class="stat-number success">' . $uploaded . '</div><div>Uploaded</div></div>';
echo '<div class="stat"><div class="stat-number info">' . $skipped . '</div><div>Skipped</div></div>';
echo '<div class="stat"><div class="stat-number error">' . $failed . '</div><div>Failed</div></div>';
echo '<div class="stat"><div class="stat-number">' . count($files) . '</div><div>Total</div></div>';
echo '</div>';

echo '<hr>';
echo '<div class="warning">';
echo '<strong>🔒 SECURITY WARNING:</strong> Delete this file immediately!<br>';
echo 'File location: <code>wp-content/themes/wohnegruen/upload-images.php</code>';
echo '</div>';

echo '<p><a href="' . admin_url('upload.php') . '" class="button">→ Go to Media Library</a></p>';

?>
</div>
</body>
</html>
