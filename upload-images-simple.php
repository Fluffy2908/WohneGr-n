<?php
/**
 * Simple Image Upload Script - More Reliable Version
 * Uploads images from theme assets to WordPress Media Library
 */

// Prevent timeout
set_time_limit(300);
ini_set('memory_limit', '512M');

// Load WordPress
$wp_load_path = dirname(__FILE__) . '/../../../wp-load.php';
if (!file_exists($wp_load_path)) {
    die('❌ Cannot find wp-load.php');
}
require_once($wp_load_path);

// Check admin access
if (!current_user_can('upload_files')) {
    die('❌ You need to be logged in as admin');
}

// Configuration
$batch_size = 30; // Smaller batches for reliability
$images_dir = get_template_directory() . '/assets/images/';
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;

// Get all images
$all_images = glob($images_dir . '*.{jpg,jpeg,png,JPG,JPEG,PNG}', GLOB_BRACE);
$total_images = count($all_images);
$batch_images = array_slice($all_images, $offset, $batch_size);

// Check for duplicates by MD5 hash
function image_exists_by_hash($file_path) {
    global $wpdb;
    $hash = md5_file($file_path);
    $existing = $wpdb->get_var($wpdb->prepare(
        "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = '_wp_attached_file_hash' AND meta_value = %s",
        $hash
    ));
    return $existing ? true : false;
}

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload - WohneGrün</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2d5016;
            margin: 0 0 10px 0;
        }
        .progress {
            background: #e0e0e0;
            height: 30px;
            border-radius: 15px;
            overflow: hidden;
            margin: 20px 0;
        }
        .progress-bar {
            background: linear-gradient(90deg, #2d5016, #4a8028);
            height: 100%;
            line-height: 30px;
            color: white;
            text-align: center;
            font-weight: bold;
            transition: width 0.3s;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin: 20px 0;
        }
        .stat {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            border-left: 4px solid #2d5016;
        }
        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: #2d5016;
        }
        .stat-label {
            font-size: 0.85rem;
            color: #666;
            margin-top: 5px;
        }
        .log {
            background: #fafafa;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            max-height: 400px;
            overflow-y: auto;
            font-family: monospace;
            font-size: 0.9rem;
        }
        .log-item {
            padding: 8px;
            margin: 4px 0;
            border-radius: 4px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .log-success {
            background: #d4edda;
            border-left: 4px solid #28a745;
        }
        .log-skip {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
        }
        .log-error {
            background: #f8d7da;
            border-left: 4px solid #dc3545;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: #2d5016;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin-top: 20px;
        }
        .btn:hover {
            background: #1f3810;
        }
        .complete {
            background: #d4edda;
            border: 2px solid #28a745;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>📸 WohneGrün Bilder hochladen</h1>
    <p style="color: #666; margin-bottom: 20px;">Batch-Upload von Theme-Bildern zur WordPress-Mediathek</p>

    <?php
    $processed = $offset + count($batch_images);
    $percentage = $total_images > 0 ? round(($processed / $total_images) * 100) : 0;
    ?>

    <div class="progress">
        <div class="progress-bar" style="width: <?php echo $percentage; ?>%">
            <?php echo $percentage; ?>% - <?php echo $processed; ?> / <?php echo $total_images; ?>
        </div>
    </div>

    <?php
    // Process batch
    $uploaded = 0;
    $skipped = 0;
    $errors = 0;
    $log = array();

    foreach ($batch_images as $image_path) {
        $filename = basename($image_path);

        // Check if already uploaded
        if (image_exists_by_hash($image_path)) {
            $log[] = array('type' => 'skip', 'message' => "⚠️ {$filename} - Bereits vorhanden");
            $skipped++;
            continue;
        }

        // Prepare upload
        $wp_upload_dir = wp_upload_dir();
        $file_array = array(
            'name' => $filename,
            'tmp_name' => $image_path
        );

        // Upload to WordPress
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        // Copy file to temp location (required by media_handle_sideload)
        $temp_file = $wp_upload_dir['path'] . '/' . $filename;
        if (copy($image_path, $temp_file)) {
            $file_array['tmp_name'] = $temp_file;

            // Create attachment
            $attachment_id = media_handle_sideload($file_array, 0);

            // Clean up temp file
            if (file_exists($temp_file)) {
                @unlink($temp_file);
            }

            if (!is_wp_error($attachment_id)) {
                // Store hash to prevent duplicates
                $hash = md5_file($image_path);
                update_post_meta($attachment_id, '_wp_attached_file_hash', $hash);

                // Set alt text
                update_post_meta($attachment_id, '_wp_attachment_image_alt', 'WohneGrün Mobilhaus Österreich');

                $log[] = array('type' => 'success', 'message' => "✅ {$filename} - Erfolgreich hochgeladen");
                $uploaded++;
            } else {
                $log[] = array('type' => 'error', 'message' => "❌ {$filename} - " . $attachment_id->get_error_message());
                $errors++;
            }
        } else {
            $log[] = array('type' => 'error', 'message' => "❌ {$filename} - Kann Datei nicht kopieren");
            $errors++;
        }
    }

    $remaining = $total_images - $processed;
    $is_complete = $remaining <= 0;
    ?>

    <div class="stats">
        <div class="stat">
            <div class="stat-value"><?php echo $uploaded; ?></div>
            <div class="stat-label">✅ Hochgeladen</div>
        </div>
        <div class="stat">
            <div class="stat-value"><?php echo $skipped; ?></div>
            <div class="stat-label">⚠️ Übersprungen</div>
        </div>
        <div class="stat">
            <div class="stat-value"><?php echo $errors; ?></div>
            <div class="stat-label">❌ Fehler</div>
        </div>
        <div class="stat">
            <div class="stat-value"><?php echo max(0, $remaining); ?></div>
            <div class="stat-label">📦 Verbleibend</div>
        </div>
    </div>

    <h3>📋 Upload-Log</h3>
    <div class="log">
        <?php foreach ($log as $entry): ?>
            <div class="log-item log-<?php echo $entry['type']; ?>">
                <?php echo $entry['message']; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if ($is_complete): ?>
        <div class="complete">
            <h2>🎉 Upload abgeschlossen!</h2>
            <p style="font-size: 1.2rem; margin: 15px 0;">
                <strong><?php echo $uploaded; ?></strong> neue Bilder hochgeladen<br>
                <strong><?php echo $skipped; ?></strong> Duplikate übersprungen
            </p>
            <a href="<?php echo admin_url('upload.php'); ?>" class="btn">Zur Mediathek →</a>
        </div>
    <?php else: ?>
        <div style="text-align: center;">
            <p style="color: #666;">Weiter mit nächstem Batch...</p>
            <a href="?offset=<?php echo $offset + $batch_size; ?>" class="btn">
                Weiter (<?php echo $remaining; ?> verbleibend) →
            </a>
        </div>
        <script>
            // Auto-refresh after 3 seconds
            setTimeout(function() {
                window.location.href = '?offset=<?php echo $offset + $batch_size; ?>';
            }, 3000);
        </script>
    <?php endif; ?>

</div>
</body>
</html>
