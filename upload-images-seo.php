<?php
/**
 * SEO-Friendly Image Upload Script
 * Uploads images in batches with German SEO names and duplicate detection
 */

// Prevent timeout
set_time_limit(300);
ini_set('memory_limit', '512M');

// WordPress root path
$wp_load_path = dirname(__FILE__) . '/../../../wp-load.php';
if (!file_exists($wp_load_path)) {
    $wp_load_path = dirname(__FILE__) . '/wp-load.php';
}

if (!file_exists($wp_load_path)) {
    die('<p style="color: red;">❌ Cannot find wp-load.php</p>');
}

require_once($wp_load_path);

// Check if user is admin
if (!current_user_can('upload_files')) {
    die('<p style="color: red;">❌ You need admin privileges to run this script.</p>');
}

// Configuration
$batch_size = 50;
$images_dir = get_template_directory() . '/assets/images/';

// SEO-friendly name mapping for German/Austrian market
$seo_names = array(
    // Slovenian to German translations
    'hiska' => 'mobilhaus',
    'hiška' => 'mobilhaus',
    'hisica' => 'mobilhaus',
    'hiš' => 'mobilhaus',
    'mobilna' => 'mobil',
    'eko' => 'oeko',
    'terasa' => 'terrasse',
    'leseno' => 'holz',
    'bela' => 'weiss',
    'antracitno' => 'anthrazit',
    'ograjo' => 'gelaender',
    'naravi' => 'natur',
    'borovci' => 'kiefer',
    'pohorju' => 'berglandschaft',
    'pomlad' => 'fruehling',
    'zima' => 'winter',
    'urejna' => 'gepflegt',
    'moderna' => 'modern',
    'pocitniska' => 'ferien',
    'dovrseno' => 'perfekt',
    'zunanjostjo' => 'aussenansicht',
    'kamp' => 'camping',
    'resort' => 'resort',
    'panorama' => 'panorama',
    'spredaj' => 'vorne',

    // Remove ugly patterns
    '-nggid' => '',
    'ngg0dyn' => '',
    '-250x250x100-00f0w010c011r110f110r010t010' => '',
    '.jpg-' => '-',
    '.jpeg-' => '-',
    '.png-' => '-',
);

// German keywords for better SEO
$german_keywords = array(
    'exterior' => 'aussenansicht',
    'interior' => 'innenraum',
    'kitchen' => 'kueche',
    'bathroom' => 'badezimmer',
    'bedroom' => 'schlafzimmer',
    'living' => 'wohnzimmer',
    'terrace' => 'terrasse',
    'garden' => 'garten',
    'modern' => 'modern',
    'delux' => 'deluxe',
    'hero' => 'hauptbild',
    'floor-plan' => 'grundriss',
    'mirrored' => 'gespiegelt',
    '3d' => '3d-ansicht',
);

/**
 * Clean and convert filename to SEO-friendly German name
 */
function clean_filename($filename, $seo_names, $german_keywords) {
    // Remove extension
    $name = pathinfo($filename, PATHINFO_FILENAME);
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    // Convert to lowercase
    $name = strtolower($name);

    // Remove ugly patterns and translate Slovenian
    foreach ($seo_names as $search => $replace) {
        $name = str_replace($search, $replace, $name);
    }

    // Replace English with German keywords
    foreach ($german_keywords as $english => $german) {
        $name = str_replace($english, $german, $name);
    }

    // Remove number-only patterns at start (like 1000021318)
    $name = preg_replace('/^[0-9]+[_-]?/', '', $name);

    // Remove timestamp patterns (like 20250205_143854)
    $name = preg_replace('/^[0-9]{8}_[0-9]+[_-]?/', '', $name);

    // Remove special characters except hyphens
    $name = preg_replace('/[^a-z0-9\-]/', '-', $name);

    // Remove multiple consecutive hyphens
    $name = preg_replace('/-+/', '-', $name);

    // Remove leading/trailing hyphens
    $name = trim($name, '-');

    // If name is empty or too short, use generic name
    if (strlen($name) < 3) {
        $name = 'wohnegruen-mobilhaus-' . uniqid();
    }

    // Add descriptive prefix if needed
    if (!preg_match('/^(mobilhaus|wohnegruen|nature|pure|grundriss|innenraum|aussenansicht)/', $name)) {
        $name = 'wohnegruen-' . $name;
    }

    return $name . '.' . $ext;
}

/**
 * Check if image already exists in media library by filename or hash
 */
function image_exists_in_library($filename, $file_path) {
    global $wpdb;

    // Check by filename
    $existing = $wpdb->get_var($wpdb->prepare(
        "SELECT ID FROM $wpdb->posts WHERE post_type = 'attachment' AND guid LIKE %s",
        '%' . $wpdb->esc_like($filename) . '%'
    ));

    if ($existing) {
        return array('exists' => true, 'id' => $existing, 'reason' => 'filename');
    }

    // Check by file hash (for true duplicates)
    $file_hash = md5_file($file_path);
    $all_attachments = get_posts(array(
        'post_type' => 'attachment',
        'posts_per_page' => -1,
        'fields' => 'ids',
    ));

    foreach ($all_attachments as $attachment_id) {
        $attached_file = get_attached_file($attachment_id);
        if ($attached_file && file_exists($attached_file)) {
            if (md5_file($attached_file) === $file_hash) {
                return array('exists' => true, 'id' => $attachment_id, 'reason' => 'duplicate');
            }
        }
    }

    return array('exists' => false);
}

// Get all images
$all_images = glob($images_dir . '*.{jpg,jpeg,png,JPG,JPEG,PNG}', GLOB_BRACE);
$total_images = count($all_images);

// Get progress from query parameter
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$batch_images = array_slice($all_images, $offset, $batch_size);

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEO Image Upload - WohneGrün</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            min-height: 100vh;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        h1 {
            color: #2d5016;
            margin-bottom: 10px;
            font-size: 2rem;
        }
        .subtitle {
            color: #666;
            margin-bottom: 30px;
            font-size: 1.1rem;
        }
        .progress-bar {
            width: 100%;
            height: 40px;
            background: #f0f0f0;
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 20px;
            position: relative;
        }
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #2d5016 0%, #4a8028 100%);
            transition: width 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.9rem;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 20px;
            border-radius: 12px;
            border-left: 4px solid #2d5016;
        }
        .stat-label {
            color: #666;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .stat-value {
            color: #2d5016;
            font-size: 1.8rem;
            font-weight: bold;
            margin-top: 5px;
        }
        .upload-list {
            max-height: 500px;
            overflow-y: auto;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            background: #fafafa;
        }
        .upload-item {
            display: flex;
            align-items: center;
            padding: 12px;
            margin-bottom: 8px;
            background: white;
            border-radius: 8px;
            border-left: 4px solid transparent;
            transition: all 0.2s;
        }
        .upload-item.success {
            border-left-color: #28a745;
        }
        .upload-item.duplicate {
            border-left-color: #ffc107;
            background: #fff9e6;
        }
        .upload-item.error {
            border-left-color: #dc3545;
        }
        .upload-icon {
            width: 24px;
            height: 24px;
            margin-right: 12px;
            flex-shrink: 0;
        }
        .upload-details {
            flex: 1;
        }
        .original-name {
            font-size: 0.75rem;
            color: #999;
            text-decoration: line-through;
        }
        .new-name {
            font-weight: 600;
            color: #333;
            margin-top: 2px;
        }
        .upload-status {
            font-size: 0.8rem;
            padding: 4px 12px;
            border-radius: 12px;
            font-weight: 500;
        }
        .status-success { background: #d4edda; color: #155724; }
        .status-duplicate { background: #fff3cd; color: #856404; }
        .status-error { background: #f8d7da; color: #721c24; }
        .continue-btn {
            display: inline-block;
            background: #2d5016;
            color: white;
            padding: 15px 40px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.1rem;
            transition: all 0.3s;
            margin-top: 20px;
        }
        .continue-btn:hover {
            background: #1f3810;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(45, 80, 22, 0.3);
        }
        .complete-message {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            border: 2px solid #28a745;
        }
        .complete-message h2 {
            color: #155724;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🖼️ SEO-Friendly Image Upload</h1>
        <p class="subtitle">Automatisches Umbenennen und Hochladen mit Duplikatserkennung</p>

        <?php
        $progress_percent = ($offset / $total_images) * 100;
        ?>

        <div class="progress-bar">
            <div class="progress-fill" style="width: <?php echo $progress_percent; ?>%;">
                <?php echo round($progress_percent); ?>% - <?php echo $offset; ?> / <?php echo $total_images; ?>
            </div>
        </div>

        <?php
        $uploaded = 0;
        $skipped = 0;
        $errors = 0;
        $results = array();

        foreach ($batch_images as $image_path) {
            $original_filename = basename($image_path);
            $new_filename = clean_filename($original_filename, $seo_names, $german_keywords);

            $result = array(
                'original' => $original_filename,
                'new' => $new_filename,
                'status' => '',
                'message' => '',
            );

            // Check if exists
            $exists_check = image_exists_in_library($new_filename, $image_path);

            if ($exists_check['exists']) {
                $result['status'] = 'duplicate';
                $result['message'] = 'Bereits vorhanden (' . $exists_check['reason'] . ')';
                $skipped++;
            } else {
                // Upload to WordPress
                $upload = wp_upload_bits($new_filename, null, file_get_contents($image_path));

                if ($upload['error']) {
                    $result['status'] = 'error';
                    $result['message'] = $upload['error'];
                    $errors++;
                } else {
                    // Create attachment
                    $attachment = array(
                        'post_mime_type' => $upload['type'],
                        'post_title' => preg_replace('/\.[^.]+$/', '', $new_filename),
                        'post_content' => '',
                        'post_status' => 'inherit'
                    );

                    $attach_id = wp_insert_attachment($attachment, $upload['file']);

                    if (!is_wp_error($attach_id)) {
                        require_once(ABSPATH . 'wp-admin/includes/image.php');
                        $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
                        wp_update_attachment_metadata($attach_id, $attach_data);

                        // Set alt text for SEO
                        update_post_meta($attach_id, '_wp_attachment_image_alt', 'WohneGrün Mobilhaus Österreich');

                        $result['status'] = 'success';
                        $result['message'] = 'Erfolgreich hochgeladen (ID: ' . $attach_id . ')';
                        $uploaded++;
                    } else {
                        $result['status'] = 'error';
                        $result['message'] = $attach_id->get_error_message();
                        $errors++;
                    }
                }
            }

            $results[] = $result;
        }

        $remaining = $total_images - ($offset + count($batch_images));
        $is_complete = $remaining <= 0;
        ?>

        <div class="stats">
            <div class="stat-card">
                <div class="stat-label">✅ Hochgeladen</div>
                <div class="stat-value"><?php echo $uploaded; ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">⚠️ Übersprungen</div>
                <div class="stat-value"><?php echo $skipped; ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">❌ Fehler</div>
                <div class="stat-value"><?php echo $errors; ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">📦 Verbleibend</div>
                <div class="stat-value"><?php echo max(0, $remaining); ?></div>
            </div>
        </div>

        <div class="upload-list">
            <?php foreach ($results as $result): ?>
                <div class="upload-item <?php echo $result['status']; ?>">
                    <div class="upload-icon">
                        <?php if ($result['status'] === 'success'): ?>
                            ✅
                        <?php elseif ($result['status'] === 'duplicate'): ?>
                            ⚠️
                        <?php else: ?>
                            ❌
                        <?php endif; ?>
                    </div>
                    <div class="upload-details">
                        <div class="original-name"><?php echo htmlspecialchars($result['original']); ?></div>
                        <div class="new-name"><?php echo htmlspecialchars($result['new']); ?></div>
                    </div>
                    <span class="upload-status status-<?php echo $result['status']; ?>">
                        <?php echo htmlspecialchars($result['message']); ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ($is_complete): ?>
            <div class="complete-message">
                <h2>🎉 Upload abgeschlossen!</h2>
                <p style="font-size: 1.1rem; color: #155724; margin-top: 10px;">
                    <strong><?php echo $uploaded; ?></strong> Bilder hochgeladen,
                    <strong><?php echo $skipped; ?></strong> übersprungen
                </p>
                <a href="<?php echo admin_url('upload.php'); ?>" class="continue-btn">
                    Zur Mediathek →
                </a>
            </div>
        <?php else: ?>
            <div style="text-align: center;">
                <a href="?offset=<?php echo $offset + $batch_size; ?>" class="continue-btn">
                    Weiter (<?php echo $remaining; ?> verbleibend) →
                </a>
                <p style="margin-top: 15px; color: #666; font-size: 0.9rem;">
                    Seite wird automatisch in 2 Sekunden fortgesetzt...
                </p>
            </div>
            <script>
                setTimeout(function() {
                    window.location.href = '?offset=<?php echo $offset + $batch_size; ?>';
                }, 2000);
            </script>
        <?php endif; ?>
    </div>
</body>
</html>
