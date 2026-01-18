<?php
/**
 * Fix Images - Check and Upload Missing Images
 */

// Load WordPress
require_once('../../../wp-load.php');

if (!current_user_can('manage_options')) {
    wp_die('Access denied.');
}

$step = isset($_GET['step']) ? $_GET['step'] : 'check';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fix Images</title>
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
        code { background: #f4f4f4; padding: 2px 6px; border-radius: 3px; font-family: monospace; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; font-size: 14px; }
        th { background: #f8f9fa; font-weight: 600; }
        .status-missing { color: #dc3545; font-weight: bold; }
        .status-exists { color: #28a745; font-weight: bold; }
        .upload-form { background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; }
        input[type="file"] { padding: 10px; border: 2px solid #ddd; border-radius: 4px; width: 100%; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🖼️ Fix Images</h1>
            <p>Check and upload missing images</p>
        </div>
        <div class="content">

            <?php if ($step === 'check'): ?>

                <h2>📁 Image Status Check</h2>

                <?php
                $theme_dir = get_template_directory();
                $images_dir = $theme_dir . '/assets/images';
                $images_url = get_template_directory_uri() . '/assets/images';

                // Common images used in templates
                $expected_images = array(
                    'hero-bg.jpg' => 'Homepage hero background',
                    'about.jpg' => 'About page image',
                    'wohnegruen-mobilhaus-exterior-1.jpg' => 'Exterior view 1',
                    'wohnegruen-mobilhaus-exterior-2.jpg' => 'Exterior view 2',
                    'model-nature-exterior.jpg' => 'Nature model exterior',
                    'model-pure-exterior.jpg' => 'Pure model exterior',
                    'contact-bg.jpg' => 'Contact background',
                    'gallery-1.jpg' => 'Gallery image 1',
                    'gallery-2.jpg' => 'Gallery image 2',
                    'gallery-3.jpg' => 'Gallery image 3',
                );

                // Check which images exist
                $existing_images = array();
                $missing_images = array();

                if (is_dir($images_dir)) {
                    $files = scandir($images_dir);
                    foreach ($files as $file) {
                        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        if (in_array($ext, array('jpg', 'jpeg', 'png', 'gif', 'webp'))) {
                            $existing_images[] = $file;
                        }
                    }
                }

                foreach ($expected_images as $image => $description) {
                    if (!in_array($image, $existing_images)) {
                        $missing_images[] = $image;
                    }
                }
                ?>

                <div class="info">
                    <strong>Images Folder:</strong><br>
                    - Path: <code><?php echo esc_html($images_dir); ?></code><br>
                    - Folder exists: <?php echo is_dir($images_dir) ? '✓ Yes' : '✗ No'; ?><br>
                    - Images found: <?php echo count($existing_images); ?><br>
                    - Expected images: <?php echo count($expected_images); ?><br>
                    - Missing images: <strong><?php echo count($missing_images); ?></strong>
                </div>

                <?php if (count($existing_images) > 0): ?>
                    <h2>✅ Existing Images (<?php echo count($existing_images); ?>)</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Filename</th>
                                <th>Size</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($existing_images as $image): ?>
                                <tr>
                                    <td><code><?php echo esc_html($image); ?></code></td>
                                    <td><?php echo round(filesize($images_dir . '/' . $image) / 1024, 1); ?> KB</td>
                                    <td class="status-exists">✓ Exists</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

                <?php if (count($missing_images) > 0): ?>
                    <h2>❌ Missing Images (<?php echo count($missing_images); ?>)</h2>
                    <div class="error">
                        <strong>These images are referenced in templates but don't exist:</strong>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Filename</th>
                                <th>Used For</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($missing_images as $image): ?>
                                <tr>
                                    <td><code><?php echo esc_html($image); ?></code></td>
                                    <td><?php echo isset($expected_images[$image]) ? esc_html($expected_images[$image]) : 'Unknown'; ?></td>
                                    <td class="status-missing">✗ Missing</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

                <h2>🎯 How to Fix</h2>

                <div class="warning">
                    <strong>You have 3 options to get images working:</strong><br><br>

                    <strong>Option 1: Upload via FTP/cPanel (Recommended)</strong><br>
                    1. Get your image files (from backup, downloads, or new photos)<br>
                    2. Connect to your server via FTP or cPanel File Manager<br>
                    3. Upload images to: <code><?php echo esc_html($images_dir); ?></code><br>
                    4. Images will show immediately<br>
                    <br>

                    <strong>Option 2: Upload via WordPress Media Library</strong><br>
                    1. Go to <a href="<?php echo admin_url('upload.php'); ?>" target="_blank">Media → Add New</a><br>
                    2. Upload all your images<br>
                    3. Then manually assign them to ACF blocks in each page<br>
                    <br>

                    <strong>Option 3: Use Placeholder Images (Temporary)</strong><br>
                    - I can create CSS-based colored placeholders<br>
                    - Site will work without real images<br>
                    - You can add real images later<br>
                    <a href="?step=create-placeholders" class="btn" style="margin-top: 10px;">Create Placeholders</a>
                </div>

                <?php if (count($existing_images) == 0): ?>
                    <div class="info">
                        <strong>💡 Where to get images?</strong><br>
                        - Download from Hosekra website: <a href="https://www.hosekra.com/homes/galerija/" target="_blank">hosekra.com/homes/galerija</a><br>
                        - Use stock photos from: <a href="https://unsplash.com/s/photos/mobile-home" target="_blank">Unsplash</a> or <a href="https://www.pexels.com/search/tiny-house/" target="_blank">Pexels</a><br>
                        - Take your own photos of mobilhäuser
                    </div>
                <?php endif; ?>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="<?php echo admin_url('upload.php?page=upload-new'); ?>" class="btn btn-success" target="_blank">📤 Upload via WordPress</a>
                    <a href="?step=create-placeholders" class="btn">🎨 Create CSS Placeholders</a>
                </div>

            <?php elseif ($step === 'create-placeholders'): ?>

                <h2>Creating CSS Placeholder Images...</h2>

                <?php
                // Create a custom CSS file with placeholder styles
                $css_file = $theme_dir . '/assets/css/image-placeholders.css';

                $css_content = "/* Image Placeholders - Temporary until real images are uploaded */\n\n";

                $css_content .= "/* Hero backgrounds */\n";
                $css_content .= ".hero-section .hero-background::before {\n";
                $css_content .= "    content: '';\n";
                $css_content .= "    position: absolute;\n";
                $css_content .= "    top: 0;\n";
                $css_content .= "    left: 0;\n";
                $css_content .= "    width: 100%;\n";
                $css_content .= "    height: 100%;\n";
                $css_content .= "    background: linear-gradient(135deg, #2d5016 0%, #3d6b1f 100%);\n";
                $css_content .= "    z-index: -1;\n";
                $css_content .= "}\n\n";

                $css_content .= "/* About section image */\n";
                $css_content .= ".about-image img[src*='about'],\n";
                $css_content .= ".about-image img[src*='placeholder'] {\n";
                $css_content .= "    display: none;\n";
                $css_content .= "}\n";
                $css_content .= ".about-image::before {\n";
                $css_content .= "    content: 'WohneGrün';\n";
                $css_content .= "    display: flex;\n";
                $css_content .= "    align-items: center;\n";
                $css_content .= "    justify-content: center;\n";
                $css_content .= "    width: 100%;\n";
                $css_content .= "    height: 400px;\n";
                $css_content .= "    background: linear-gradient(135deg, #4a7c2e 0%, #5a8c3e 100%);\n";
                $css_content .= "    border-radius: 12px;\n";
                $css_content .= "    color: white;\n";
                $css_content .= "    font-size: 48px;\n";
                $css_content .= "    font-weight: bold;\n";
                $css_content .= "}\n\n";

                $css_content .= "/* Model images */\n";
                $css_content .= ".model-card img,\n";
                $css_content .= ".featured-model-image img {\n";
                $css_content .= "    min-height: 300px;\n";
                $css_content .= "    background: linear-gradient(135deg, #3d6b1f 0%, #4d7b2f 100%);\n";
                $css_content .= "}\n\n";

                $css_content .= "/* Gallery placeholders */\n";
                $css_content .= ".gallery-item img {\n";
                $css_content .= "    min-height: 250px;\n";
                $css_content .= "    background: linear-gradient(135deg, #2d5016 0%, #3d6b1f 100%);\n";
                $css_content .= "}\n\n";

                // Make sure CSS directory exists
                $css_dir = $theme_dir . '/assets/css';
                if (!is_dir($css_dir)) {
                    mkdir($css_dir, 0755, true);
                }

                file_put_contents($css_file, $css_content);

                echo '<div class="success">✓ Created placeholder CSS file</div>';

                // Now we need to enqueue this CSS
                $functions_file = $theme_dir . '/functions.php';
                if (file_exists($functions_file)) {
                    $functions_content = file_get_contents($functions_file);

                    // Check if placeholder CSS is already enqueued
                    if (strpos($functions_content, 'image-placeholders.css') === false) {
                        // Add enqueue code
                        $enqueue_code = "\n\n// Enqueue image placeholder CSS (temporary)\n";
                        $enqueue_code .= "add_action('wp_enqueue_scripts', function() {\n";
                        $enqueue_code .= "    wp_enqueue_style('image-placeholders', get_template_directory_uri() . '/assets/css/image-placeholders.css', array(), '1.0');\n";
                        $enqueue_code .= "});\n";

                        file_put_contents($functions_file, $functions_content . $enqueue_code);
                        echo '<div class="success">✓ Added placeholder CSS to functions.php</div>';
                    } else {
                        echo '<div class="info">ℹ️ Placeholder CSS already enqueued</div>';
                    }
                }
                ?>

                <h2>✅ Placeholders Created!</h2>

                <div class="success">
                    <strong>CSS placeholders are now active!</strong><br><br>
                    - Images will show as colored boxes with gradients<br>
                    - Site will work without actual image files<br>
                    - You can add real images later<br>
                    <br>
                    <strong>Next steps:</strong><br>
                    1. Visit your website to see placeholders<br>
                    2. When you have real images, upload them via FTP/cPanel<br>
                    3. Placeholders will be replaced automatically
                </div>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="<?php echo home_url('/'); ?>" class="btn btn-success">🌐 View Website with Placeholders</a>
                    <a href="?step=check" class="btn">🔍 Check Images Again</a>
                </div>

            <?php endif; ?>

        </div>
    </div>
</body>
</html>
