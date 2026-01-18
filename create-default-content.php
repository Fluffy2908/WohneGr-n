<?php
/**
 * Create Default Content - Auto-Patch
 *
 * This script automatically adds default ACF blocks to blank pages
 * so they display proper content instead of showing homepage
 */

// Load WordPress
require_once('../../../wp-load.php');

if (!current_user_can('manage_options')) {
    wp_die('Access denied.');
}

$step = isset($_GET['step']) ? $_GET['step'] : 'preview';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Create Default Content</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: linear-gradient(135deg, #2d5016 0%, #3d6b1f 100%);
            padding: 20px;
        }
        .container {
            max-width: 1000px;
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
        h2 { color: #2d5016; border-bottom: 2px solid #2d5016; padding-bottom: 10px; }
        .success { background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #28a745; }
        .error { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #dc3545; }
        .warning { background: #fff3cd; color: #856404; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #ffc107; }
        .info { background: #d1ecf1; color: #0c5460; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #17a2b8; }
        .btn { display: inline-block; background: #2d5016; color: white; padding: 15px 40px; text-decoration: none; border-radius: 8px; font-size: 18px; font-weight: 600; margin: 10px 5px; border: none; cursor: pointer; }
        .btn:hover { background: #3d6b1f; }
        .btn-danger { background: #dc3545; }
        .btn-danger:hover { background: #c82333; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; font-weight: 600; }
        code { background: #f4f4f4; padding: 2px 8px; border-radius: 4px; font-family: monospace; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔧 Auto-Patch: Create Default Content</h1>
            <p>Add ACF blocks to blank pages automatically</p>
        </div>
        <div class="content">

            <?php if ($step === 'preview'): ?>

                <h2>What This Will Do</h2>

                <div class="info">
                    <strong>This script will add default ACF blocks to blank pages:</strong>
                    <ul>
                        <li><strong>Home</strong> - Hero, Features, Models, About, Contact blocks</li>
                        <li><strong>Modelle</strong> - Hero + Models Overview block</li>
                        <li><strong>Galerie & 3D</strong> - Hero + Gallery block</li>
                        <li><strong>Über uns</strong> - Hero + About block</li>
                        <li><strong>Kontakt</strong> - Hero + Contact block</li>
                    </ul>
                </div>

                <?php
                $pages = get_pages(array('number' => 999));
                ?>

                <h2>Pages Status</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Page</th>
                            <th>Current Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pages as $page):
                            $has_content = strlen($page->post_content) > 0;
                        ?>
                            <tr>
                                <td><strong><?php echo esc_html($page->post_title); ?></strong></td>
                                <td>
                                    <?php if ($has_content): ?>
                                        <span style="color: #28a745;">✓ Has content (<?php echo strlen($page->post_content); ?> chars)</span>
                                    <?php else: ?>
                                        <span style="color: #dc3545;">✗ Blank</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!$has_content): ?>
                                        <span style="color: #0c5460;">→ Will add default blocks</span>
                                    <?php else: ?>
                                        <span style="color: #999;">Skip (has content)</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="warning">
                    <strong>⚠️ Note:</strong><br>
                    - Only blank pages will be modified<br>
                    - Pages with existing content will be skipped<br>
                    - Default blocks use placeholder text that you can edit later<br>
                    - Images will use placeholders (you need to upload real images to Media Library)
                </div>

                <div style="text-align: center; margin: 40px 0;">
                    <a href="?step=create" class="btn btn-danger">🚀 Create Default Content</a>
                    <a href="full-website-diagnosis.php" class="btn">← Back to Diagnosis</a>
                </div>

            <?php elseif ($step === 'create'): ?>

                <h2>Creating Default Content...</h2>

                <?php
                $pages = get_pages(array('number' => 999));
                $pages_updated = 0;

                foreach ($pages as $page) {
                    $has_content = strlen($page->post_content) > 0;

                    // Skip if page already has content
                    if ($has_content) {
                        echo '<div class="info">Skip: ' . esc_html($page->post_title) . ' (already has content)</div>';
                        continue;
                    }

                    $page_slug = $page->post_name;
                    $blocks_content = '';

                    // Determine which blocks to add based on page slug/title
                    switch (strtolower($page_slug)) {
                        case 'home':
                        case 'startseite':
                            $blocks_content = '<!-- wp:acf/wohnegruen-hero /-->

<!-- wp:acf/wohnegruen-features /-->

<!-- wp:acf/wohnegruen-models /-->

<!-- wp:acf/wohnegruen-about /-->

<!-- wp:acf/wohnegruen-contact /-->';
                            break;

                        case 'modelle':
                        case 'models':
                            $blocks_content = '<!-- wp:acf/wohnegruen-hero /-->

<!-- wp:acf/wohnegruen-models /-->';
                            break;

                        case 'galerie-3d':
                        case 'galerie':
                        case 'gallery':
                            $blocks_content = '<!-- wp:acf/wohnegruen-hero /-->

<!-- wp:acf/wohnegruen-gallery /-->';
                            break;

                        case 'uber-uns':
                        case 'about':
                            $blocks_content = '<!-- wp:acf/wohnegruen-hero /-->

<!-- wp:acf/wohnegruen-about /-->';
                            break;

                        case 'kontakt':
                        case 'contact':
                            $blocks_content = '<!-- wp:acf/wohnegruen-hero /-->

<!-- wp:acf/wohnegruen-contact /-->';
                            break;

                        case 'impressum':
                        case 'datenschutz':
                        case 'datenschutzerklarung':
                        case 'agb':
                            // Legal pages get simple content
                            $blocks_content = '<!-- wp:heading -->
<h2>' . esc_html($page->post_title) . '</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Bitte fügen Sie hier den Inhalt für ' . esc_html($page->post_title) . ' hinzu.</p>
<!-- /wp:paragraph -->';
                            break;

                        default:
                            // Default: just add a hero block
                            $blocks_content = '<!-- wp:acf/wohnegruen-hero /-->';
                            break;
                    }

                    // Update the page with blocks
                    if (!empty($blocks_content)) {
                        $updated = wp_update_post(array(
                            'ID' => $page->ID,
                            'post_content' => $blocks_content,
                        ));

                        if ($updated && !is_wp_error($updated)) {
                            echo '<div class="success">✓ Added blocks to: ' . esc_html($page->post_title) . '</div>';
                            $pages_updated++;
                        } else {
                            echo '<div class="error">✗ Failed to update: ' . esc_html($page->post_title) . '</div>';
                        }
                    }
                }
                ?>

                <h2>✅ Content Creation Complete!</h2>

                <div class="success">
                    <strong>Updated <?php echo $pages_updated; ?> pages with default ACF blocks.</strong>
                </div>

                <h2>Next Steps</h2>
                <div class="info">
                    <strong>1. Fill in ACF Block Fields</strong><br>
                    Edit each page and fill in the ACF block fields:<br>
                    - Hero titles and descriptions<br>
                    - Feature items<br>
                    - Gallery images<br>
                    - Contact information<br>
                    <br>
                    <strong>2. Upload Images</strong><br>
                    Go to Media Library and upload:<br>
                    - Hero background images<br>
                    - Model photos<br>
                    - Gallery images<br>
                    - About section images<br>
                    <br>
                    <strong>3. Configure ACF Options</strong><br>
                    Go to Appearance → Navigation, Kontaktdaten, Footer<br>
                    Fill in:<br>
                    - Logo<br>
                    - Phone number<br>
                    - Email address<br>
                    - Footer links
                </div>

                <h2>Test Your Pages</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Page</th>
                            <th>URL</th>
                            <th>Test</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pages as $page): ?>
                            <tr>
                                <td><?php echo esc_html($page->post_title); ?></td>
                                <td><code><?php echo esc_html(get_permalink($page->ID)); ?></code></td>
                                <td><a href="<?php echo esc_url(get_permalink($page->ID)); ?>" target="_blank">Visit →</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" class="btn">Edit Pages</a>
                    <a href="<?php echo admin_url('upload.php'); ?>" class="btn">Upload Images</a>
                    <a href="<?php echo admin_url('themes.php?page=acf-options-navigacija'); ?>" class="btn">Configure Options</a>
                    <a href="<?php echo home_url('/'); ?>" class="btn">View Website</a>
                </div>

            <?php endif; ?>

        </div>
    </div>
</body>
</html>
