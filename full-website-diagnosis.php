<?php
/**
 * Full Website Diagnosis
 *
 * Comprehensive check of:
 * - Page content and templates
 * - Image paths and broken images
 * - ACF blocks on each page
 * - Theme assets
 */

// Load WordPress
require_once('../../../wp-load.php');

if (!current_user_can('manage_options')) {
    wp_die('Access denied.');
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Full Website Diagnosis</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            padding: 20px;
            background: #f0f0f1;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
        }
        h1 { color: #2d5016; }
        h2 { color: #3d6b1f; border-bottom: 2px solid #2d5016; padding-bottom: 10px; margin-top: 30px; }
        h3 { color: #2d5016; }
        .success { background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin: 10px 0; border-left: 4px solid #28a745; }
        .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin: 10px 0; border-left: 4px solid #dc3545; }
        .warning { background: #fff3cd; color: #856404; padding: 10px; border-radius: 5px; margin: 10px 0; border-left: 4px solid #ffc107; }
        .info { background: #d1ecf1; color: #0c5460; padding: 10px; border-radius: 5px; margin: 10px 0; border-left: 4px solid #17a2b8; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; font-weight: 600; }
        code { background: #f4f4f4; padding: 2px 6px; border-radius: 3px; font-family: monospace; font-size: 12px; }
        pre { background: #f4f4f4; padding: 10px; border-radius: 5px; overflow-x: auto; font-size: 12px; }
        .btn { display: inline-block; background: #2d5016; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; font-size: 16px; font-weight: 600; margin: 10px 5px; }
        .btn:hover { background: #3d6b1f; }
        .section { background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; }
        img { max-width: 100px; height: auto; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Full Website Diagnosis</h1>

        <h2>1. Pages Content Analysis</h2>
        <?php
        $pages = get_pages(array('number' => 999, 'sort_column' => 'post_title'));
        ?>
        <table>
            <thead>
                <tr>
                    <th>Page</th>
                    <th>Template</th>
                    <th>Content Length</th>
                    <th>Has Blocks?</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pages as $page):
                    $template = get_post_meta($page->ID, '_wp_page_template', true);
                    $content = $page->post_content;
                    $content_length = strlen($content);
                    $has_blocks = has_blocks($content);
                ?>
                    <tr>
                        <td><strong><?php echo esc_html($page->post_title); ?></strong></td>
                        <td><code><?php echo $template ? esc_html($template) : 'default'; ?></code></td>
                        <td><?php echo $content_length; ?> chars</td>
                        <td>
                            <?php if ($has_blocks): ?>
                                <span style="color: #28a745;">✓ Yes</span>
                            <?php else: ?>
                                <span style="color: #dc3545;">✗ No - Empty!</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($content_length === 0): ?>
                                <span style="color: #dc3545;">✗ Blank page</span>
                            <?php elseif (!$has_blocks && $template === 'default'): ?>
                                <span style="color: #856404;">⚠️ No blocks, may show default</span>
                            <?php else: ?>
                                <span style="color: #28a745;">✓ Has content</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="warning">
            <strong>⚠️ Issue Identified:</strong><br>
            Pages showing the same content are likely BLANK pages with no blocks added.<br>
            When a page is blank, WordPress may fall back to showing homepage content or the theme's default display.
        </div>

        <h2>2. Page Content Details</h2>
        <?php foreach ($pages as $page): ?>
            <div class="section">
                <h3><?php echo esc_html($page->post_title); ?></h3>
                <p><strong>Permalink:</strong> <a href="<?php echo esc_url(get_permalink($page->ID)); ?>" target="_blank"><?php echo esc_url(get_permalink($page->ID)); ?></a></p>
                <p><strong>Template:</strong> <code><?php echo get_post_meta($page->ID, '_wp_page_template', true) ?: 'default'; ?></code></p>
                <p><strong>Content:</strong></p>
                <?php if (strlen($page->post_content) > 0): ?>
                    <pre><?php echo esc_html(substr($page->post_content, 0, 500)); ?><?php echo strlen($page->post_content) > 500 ? '...' : ''; ?></pre>
                <?php else: ?>
                    <div class="error">✗ Page is completely empty! This is why it shows default/homepage content.</div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <h2>3. Theme Images Check</h2>
        <?php
        $theme_dir = get_template_directory();
        $theme_uri = get_template_directory_uri();
        $assets_dir = $theme_dir . '/assets/images';

        $expected_images = array(
            'wohnegruen-mobilhaus-hero-bg.jpg',
            'wohnegruen-mobilhaus-nature.jpg',
            'wohnegruen-mobilhaus-pure.jpg',
            'wohnegruen-mobilhaus-gallery-1.jpg',
            'wohnegruen-mobilhaus-gallery-2.jpg',
            'wohnegruen-mobilhaus-gallery-3.jpg',
            'wohnegruen-about-image.jpg',
        );
        ?>
        <table>
            <thead>
                <tr>
                    <th>Image File</th>
                    <th>Expected Path</th>
                    <th>Exists?</th>
                    <th>Preview</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($expected_images as $img): ?>
                    <tr>
                        <td><code><?php echo esc_html($img); ?></code></td>
                        <td><code><?php echo esc_html($assets_dir . '/' . $img); ?></code></td>
                        <td>
                            <?php if (file_exists($assets_dir . '/' . $img)): ?>
                                <span style="color: #28a745;">✓ Exists</span>
                            <?php else: ?>
                                <span style="color: #dc3545;">✗ Missing</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (file_exists($assets_dir . '/' . $img)): ?>
                                <img src="<?php echo esc_url($theme_uri . '/assets/images/' . $img); ?>" alt="<?php echo esc_attr($img); ?>">
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>4. Available Images in Theme</h2>
        <?php
        if (is_dir($assets_dir)) {
            $files = scandir($assets_dir);
            $image_files = array_filter($files, function($file) use ($assets_dir) {
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                return in_array($ext, array('jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'));
            });
        } else {
            $image_files = array();
        }
        ?>
        <?php if (!empty($image_files)): ?>
            <div class="info">
                <strong>Found <?php echo count($image_files); ?> image files in theme:</strong>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Filename</th>
                        <th>Size</th>
                        <th>Preview</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($image_files as $file): ?>
                        <tr>
                            <td><code><?php echo esc_html($file); ?></code></td>
                            <td><?php echo round(filesize($assets_dir . '/' . $file) / 1024, 2); ?> KB</td>
                            <td><img src="<?php echo esc_url($theme_uri . '/assets/images/' . $file); ?>" alt="<?php echo esc_attr($file); ?>"></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="error">
                <strong>✗ No images found in theme assets directory!</strong><br>
                Directory: <code><?php echo esc_html($assets_dir); ?></code>
            </div>
        <?php endif; ?>

        <h2>5. WordPress Media Library</h2>
        <?php
        $media_query = new WP_Query(array(
            'post_type' => 'attachment',
            'post_status' => 'inherit',
            'posts_per_page' => -1,
            'post_mime_type' => 'image',
        ));
        ?>
        <div class="info">
            <strong>Total images in Media Library:</strong> <?php echo $media_query->found_posts; ?>
        </div>
        <?php if ($media_query->have_posts()): ?>
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Filename</th>
                        <th>Upload Date</th>
                        <th>Preview</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($media_query->have_posts()): $media_query->the_post(); ?>
                        <tr>
                            <td><?php the_title(); ?></td>
                            <td><code><?php echo basename(get_attached_file(get_the_ID())); ?></code></td>
                            <td><?php echo get_the_date(); ?></td>
                            <td><img src="<?php echo wp_get_attachment_image_url(get_the_ID(), 'thumbnail'); ?>" alt=""></td>
                        </tr>
                    <?php endwhile; wp_reset_postdata(); ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="warning">
                <strong>⚠️ WordPress Media Library is empty!</strong><br>
                No images have been uploaded to WordPress yet.
            </div>
        <?php endif; ?>

        <h2>6. Diagnosis Summary</h2>
        <?php
        $issues = array();
        $blank_pages = 0;

        foreach ($pages as $page) {
            if (strlen($page->post_content) === 0) {
                $blank_pages++;
            }
        }

        if ($blank_pages > 0) {
            $issues[] = $blank_pages . ' pages are completely blank (no content/blocks)';
        }

        $missing_images = 0;
        foreach ($expected_images as $img) {
            if (!file_exists($assets_dir . '/' . $img)) {
                $missing_images++;
            }
        }

        if ($missing_images > 0) {
            $issues[] = $missing_images . ' expected theme images are missing';
        }

        if ($media_query->found_posts === 0) {
            $issues[] = 'WordPress Media Library is empty';
        }
        ?>

        <?php if (empty($issues)): ?>
            <div class="success">
                <strong>✓ No critical issues detected!</strong>
            </div>
        <?php else: ?>
            <div class="error">
                <strong>✗ Issues Found:</strong>
                <ul>
                    <?php foreach ($issues as $issue): ?>
                        <li><?php echo esc_html($issue); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <h2>7. Root Cause Analysis</h2>
        <div class="warning">
            <strong>Why pages show the same content:</strong><br>
            <?php if ($blank_pages > 0): ?>
                • <?php echo $blank_pages; ?> pages have NO content or blocks<br>
                • When WordPress renders a blank page, it may fall back to showing the homepage/template default<br>
                • Pages were converted from custom templates to Gutenberg but no blocks were added<br>
            <?php endif; ?>
            <br>
            <strong>Why images aren't loading:</strong><br>
            <?php if ($missing_images > 0): ?>
                • <?php echo $missing_images; ?> image files are missing from theme assets<br>
            <?php endif; ?>
            <?php if ($media_query->found_posts === 0): ?>
                • No images uploaded to WordPress Media Library<br>
            <?php endif; ?>
            • Images were hardcoded in templates with specific paths that don't exist<br>
        </div>

        <h2>8. Recommended Fix</h2>
        <div class="info">
            <strong>To fix these issues:</strong><br>
            1. <strong>Add content to blank pages</strong> - Edit each page and add ACF blocks<br>
            2. <strong>Upload images to WordPress</strong> - Use Media Library to upload all images<br>
            3. <strong>OR run the automatic patch script</strong> - Let the system add default content automatically
        </div>

        <div style="text-align: center; margin: 30px 0;">
            <a href="create-default-content.php" class="btn">🔧 Create Default Content (Auto-Patch)</a>
            <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" class="btn">Edit Pages Manually</a>
            <a href="<?php echo admin_url('upload.php'); ?>" class="btn">Media Library</a>
        </div>

    </div>
</body>
</html>
