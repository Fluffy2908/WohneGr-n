<?php
/**
 * Find All Missing Images from Gallery, About, and Contact Pages
 */

require_once('../../../wp-load.php');

if (!current_user_can('manage_options')) {
    wp_die('Access denied.');
}

$theme_dir = get_template_directory();
$images_dir = $theme_dir . '/assets/images';

// Get all existing images
$existing_images = array();
if (is_dir($images_dir)) {
    foreach (scandir($images_dir) as $file) {
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (in_array($ext, array('jpg', 'jpeg', 'png', 'gif', 'webp'))) {
            $existing_images[] = $file;
        }
    }
}

// Images needed by templates
$required_images = array(
    // Galerie & 3D page
    'wohnegruen-mobilhaus-exterior-1.jpg' => 'Gallery - Exterior 1',
    'wohnegruen-mobilhaus-exterior-2.jpg' => 'Gallery - Exterior 2',
    'wohnegruen-mobilhaus-exterior-3.jpg' => 'Gallery - Exterior 3',
    'wohnegruen-mobilhaus-exterior-4.jpg' => 'Gallery - Exterior 4 (Also: About hero)',
    'wohnegruen-mobilhaus-exterior-5.jpg' => 'Gallery - Exterior 5 (Also: Contact hero)',
    'wohnegruen-mobilhaus-exterior-6.jpg' => 'Gallery - Exterior 6',
    'wohnegruen-mobilhaus-terrace-1.jpg' => 'Gallery - Terrace 1',
    'wohnegruen-mobilhaus-terrace-2.jpg' => 'Gallery - Terrace 2',
    'wohnegruen-mobilhaus-terrace-3.jpg' => 'Gallery - Terrace 3',
    'wohnegruen-mobilhaus-interior-kitchen-1.jpg' => 'Gallery - Kitchen 1',
    'wohnegruen-mobilhaus-interior-kitchen-2.jpg' => 'Gallery - Kitchen 2',
    'wohnegruen-mobilhaus-interior-kitchen-3.jpg' => 'Gallery - Kitchen 3',
    'wohnegruen-mobilhaus-interior-living-1.jpg' => 'Gallery - Living 1',
    'wohnegruen-mobilhaus-interior-living-2.jpg' => 'Gallery - Living 2',
    'wohnegruen-mobilhaus-interior-bedroom-1.jpg' => 'Gallery - Bedroom 1',
    'wohnegruen-mobilhaus-interior-bathroom-1.jpg' => 'Gallery - Bathroom 1',

    // Floor plans already exist
    'floor-plan-eko-03.jpg' => '3D - Floor plan (✓ Exists)',
    'floor-plan-eko-03-mirrored.jpg' => '3D - Floor plan mirrored (✓ Exists)',
    'floor-plan-eko-03-3d-1.jpg' => '3D - 3D view 1 (✓ Exists)',
    'floor-plan-eko-03-3d-2.jpg' => '3D - 3D view 2 (✓ Exists)',
    'interior-eko-delux.jpg' => '3D - Interior delux (✓ Exists)',
    'interior-panorama-delux.jpg' => '3D - Interior panorama (✓ Exists)',
);

$missing = array();
$found = array();

foreach ($required_images as $img => $desc) {
    if (in_array($img, $existing_images)) {
        $found[] = array('file' => $img, 'desc' => $desc);
    } else {
        $missing[] = array('file' => $img, 'desc' => $desc);
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Missing Images Report</title>
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
        code { background: #f4f4f4; padding: 2px 6px; border-radius: 3px; font-family: monospace; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; font-size: 13px; }
        th { background: #f8f9fa; font-weight: 600; }
        .status-missing { color: #dc3545; font-weight: bold; }
        .status-found { color: #28a745; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🖼️ Missing Images Report</h1>

        <div class="info">
            <strong>Summary:</strong><br>
            - Total images in assets folder: <strong><?php echo count($existing_images); ?></strong><br>
            - Images required by templates: <strong><?php echo count($required_images); ?></strong><br>
            - Images found: <strong style="color: #28a745;"><?php echo count($found); ?></strong><br>
            - Images missing: <strong style="color: #dc3545;"><?php echo count($missing); ?></strong>
        </div>

        <?php if (count($missing) > 0): ?>
            <h2>❌ Missing Images (<?php echo count($missing); ?>)</h2>
            <div class="error">
                <strong>These images are referenced in page templates but don't exist:</strong>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Filename</th>
                        <th>Used For</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $index = 1; foreach ($missing as $img): ?>
                        <tr>
                            <td><?php echo $index++; ?></td>
                            <td><code><?php echo esc_html($img['file']); ?></code></td>
                            <td><?php echo esc_html($img['desc']); ?></td>
                            <td class="status-missing">✗ Missing</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <?php if (count($found) > 0): ?>
            <h2>✅ Found Images (<?php echo count($found); ?>)</h2>
            <details>
                <summary style="cursor: pointer; font-weight: bold; padding: 10px;">Click to show/hide</summary>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Filename</th>
                            <th>Used For</th>
                            <th>Size</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $index = 1; foreach ($found as $img): ?>
                            <tr>
                                <td><?php echo $index++; ?></td>
                                <td><code><?php echo esc_html($img['file']); ?></code></td>
                                <td><?php echo esc_html($img['desc']); ?></td>
                                <td><?php echo round(filesize($images_dir . '/' . $img['file']) / 1024, 1); ?> KB</td>
                                <td class="status-found">✓ Exists</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </details>
        <?php endif; ?>

        <h2>💡 Solutions</h2>

        <div class="warning">
            <strong>How to get the missing images:</strong><br><br>
            <strong>Option 1: Use Hosekra Images (Recommended)</strong><br>
            1. Download images from: <a href="https://www.hosekra.com/homes/galerija/" target="_blank">Hosekra Gallery</a><br>
            2. Rename them to match the required filenames above<br>
            3. Upload to: <code><?php echo esc_html($images_dir); ?></code><br>
            <br>
            <strong>Option 2: Use Stock Photos</strong><br>
            1. Download from <a href="https://unsplash.com/s/photos/mobile-home" target="_blank">Unsplash</a> or <a href="https://www.pexels.com/search/tiny-house/" target="_blank">Pexels</a><br>
            2. Rename to match required filenames<br>
            3. Upload via FTP/cPanel<br>
            <br>
            <strong>Option 3: Check GitHub Repo from Friday/Saturday</strong><br>
            - Images may have been committed earlier<br>
            - Check git history for these files
        </div>

    </div>
</body>
</html>
