<?php
/**
 * Create Missing Gallery Images by Copying Existing Model Images
 *
 * Maps existing model images to the filenames needed by gallery/about/contact pages
 */

require_once('../../../wp-load.php');

if (!current_user_can('manage_options')) {
    wp_die('Access denied.');
}

$step = isset($_GET['step']) ? $_GET['step'] : 'preview';

$theme_dir = get_template_directory();
$images_dir = $theme_dir . '/assets/images';

// Mapping: destination => source
$image_mappings = array(
    // Exterior images - use model exteriors
    'wohnegruen-mobilhaus-exterior-1.jpg' => 'model-nature-exterior.jpg',
    'wohnegruen-mobilhaus-exterior-2.jpg' => 'model-nature-hero.jpg',
    'wohnegruen-mobilhaus-exterior-3.jpg' => 'model-pure-exterior.jpg',
    'wohnegruen-mobilhaus-exterior-4.jpg' => 'model-pure-hero.jpg',
    'wohnegruen-mobilhaus-exterior-5.jpg' => 'model-nature-exterior.jpg', // Reuse
    'wohnegruen-mobilhaus-exterior-6.jpg' => 'model-pure-exterior.jpg', // Reuse

    // Terrace images - use exterior/living images
    'wohnegruen-mobilhaus-terrace-1.jpg' => 'nature-living.jpg',
    'wohnegruen-mobilhaus-terrace-2.jpg' => 'pure-living.jpg',
    'wohnegruen-mobilhaus-terrace-3.jpg' => 'model-nature-exterior.jpg',

    // Kitchen images
    'wohnegruen-mobilhaus-interior-kitchen-1.jpg' => 'nature-kitchen.jpg',
    'wohnegruen-mobilhaus-interior-kitchen-2.jpg' => 'pure-kitchen.jpg',
    'wohnegruen-mobilhaus-interior-kitchen-3.jpg' => 'nature-wood-white.jpg', // Kitchen color scheme

    // Living room images
    'wohnegruen-mobilhaus-interior-living-1.jpg' => 'model-nature-interior-living.jpg',
    'wohnegruen-mobilhaus-interior-living-2.jpg' => 'model-pure-interior-living.jpg',

    // Bedroom
    'wohnegruen-mobilhaus-interior-bedroom-1.jpg' => 'nature-bedroom.jpg',

    // Bathroom
    'wohnegruen-mobilhaus-interior-bathroom-1.jpg' => 'nature-bathroom.jpg',
);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Create Gallery Images</title>
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
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        h1 { color: #2d5016; margin-top: 0; }
        h2 { color: #2d5016; border-bottom: 2px solid #2d5016; padding-bottom: 10px; margin-top: 30px; }
        .success { background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #28a745; }
        .error { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #dc3545; }
        .warning { background: #fff3cd; color: #856404; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #ffc107; }
        .info { background: #d1ecf1; color: #0c5460; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #17a2b8; }
        code { background: #f4f4f4; padding: 2px 6px; border-radius: 3px; font-family: monospace; font-size: 12px; }
        .btn { display: inline-block; background: #2d5016; color: white; padding: 15px 40px; text-decoration: none; border-radius: 8px; font-size: 18px; font-weight: 600; margin: 10px 5px; border: none; cursor: pointer; }
        .btn:hover { background: #3d6b1f; }
        .btn-success { background: #28a745; }
        .btn-success:hover { background: #218838; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; font-size: 13px; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; font-weight: 600; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📷 Create Gallery Images</h1>

        <?php if ($step === 'preview'): ?>

            <div class="info">
                <strong>This will create <?php echo count($image_mappings); ?> missing images</strong><br>
                by copying/duplicating existing model images with new filenames.
            </div>

            <h2>Image Mapping Plan</h2>
            <table>
                <thead>
                    <tr>
                        <th>New Filename (needed by gallery)</th>
                        <th>Source File (will be copied)</th>
                        <th>Source Exists?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($image_mappings as $dest => $source):
                        $source_exists = file_exists($images_dir . '/' . $source);
                        $dest_exists = file_exists($images_dir . '/' . $dest);
                    ?>
                        <tr>
                            <td><code><?php echo esc_html($dest); ?></code><?php if ($dest_exists) echo ' <span style="color: #28a745;">✓ Already exists</span>'; ?></td>
                            <td><code><?php echo esc_html($source); ?></code></td>
                            <td><?php echo $source_exists ? '<span style="color: #28a745;">✓ Yes</span>' : '<span style="color: #dc3545;">✗ No</span>'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="warning">
                <strong>⚠️ What this does:</strong><br>
                - Copies existing model images to new filenames<br>
                - Does NOT overwrite existing files<br>
                - Safe to run multiple times<br>
                - After this, Galerie, Über uns, and Kontakt pages will show images
            </div>

            <div style="text-align: center; margin: 30px 0;">
                <form method="get" action="" style="display: inline;">
                    <input type="hidden" name="step" value="create">
                    <button type="submit" class="btn btn-success">📷 Create Missing <?php echo count($image_mappings); ?> Images</button>
                </form>
            </div>

        <?php elseif ($step === 'create'): ?>

            <h2>Creating Images...</h2>

            <?php
            $created = 0;
            $skipped = 0;
            $failed = 0;

            foreach ($image_mappings as $dest => $source) {
                $source_path = $images_dir . '/' . $source;
                $dest_path = $images_dir . '/' . $dest;

                // Skip if destination already exists
                if (file_exists($dest_path)) {
                    echo '<div class="info">⏭️ Skipped: ' . esc_html($dest) . ' (already exists)</div>';
                    $skipped++;
                    continue;
                }

                // Check if source exists
                if (!file_exists($source_path)) {
                    echo '<div class="error">✗ Failed: ' . esc_html($dest) . ' - source not found: ' . esc_html($source) . '</div>';
                    $failed++;
                    continue;
                }

                // Copy the file
                if (copy($source_path, $dest_path)) {
                    echo '<div class="success">✓ Created: ' . esc_html($dest) . ' from ' . esc_html($source) . '</div>';
                    $created++;
                } else {
                    echo '<div class="error">✗ Failed: ' . esc_html($dest) . ' - copy failed</div>';
                    $failed++;
                }
            }
            ?>

            <h2>✅ Complete!</h2>

            <div class="success">
                <strong>Image Creation Summary:</strong><br>
                - Created: <strong><?php echo $created; ?></strong> new images<br>
                - Skipped: <?php echo $skipped; ?> (already existed)<br>
                - Failed: <?php echo $failed; ?><br>
                - Total gallery images now: <strong><?php echo ($created + $skipped); ?></strong>
            </div>

            <div class="info">
                <strong>✅ Pages that now have images:</strong><br>
                - Galerie & 3D: Gallery grid + floor plans<br>
                - Über uns: Hero background + about image<br>
                - Kontakt: Hero background
            </div>

            <div style="text-align: center; margin: 30px 0;">
                <a href="<?php echo home_url('/galerie-3d'); ?>" class="btn btn-success" target="_blank">🖼️ View Gallery Page</a>
                <a href="<?php echo home_url('/uber-uns'); ?>" class="btn" target="_blank">ℹ️ View About Page</a>
                <a href="<?php echo home_url('/kontakt'); ?>" class="btn" target="_blank">📞 View Contact Page</a>
            </div>

        <?php endif; ?>

    </div>
</body>
</html>
