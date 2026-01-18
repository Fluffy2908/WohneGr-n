<?php
/**
 * Switch All Pages to ACF Blocks
 *
 * This removes custom templates and enables ACF blocks on all pages
 * Access: https://wohnegruen.at/wp-content/themes/WohneGruen/switch-to-acf-blocks.php
 */

require_once('../../../wp-load.php');

if (!current_user_can('manage_options')) {
    wp_die('Access denied. You must be an administrator.');
}

$step = isset($_GET['step']) ? $_GET['step'] : 'info';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Switch to ACF Blocks - WohneGrün</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: linear-gradient(135deg, #2d5016 0%, #3d6b1f 100%);
            padding: 20px;
            line-height: 1.6;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }
        h1 {
            color: #2d5016;
            margin-bottom: 15px;
            font-size: 2.5rem;
        }
        h2 {
            color: #2d5016;
            border-bottom: 3px solid #2d5016;
            padding-bottom: 10px;
            margin: 40px 0 20px 0;
            font-size: 1.8rem;
        }
        h3 {
            color: #2d5016;
            margin: 25px 0 15px 0;
            font-size: 1.4rem;
        }
        .subtitle {
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 30px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 20px;
            border-radius: 8px;
            margin: 15px 0;
            border-left: 5px solid #28a745;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 20px;
            border-radius: 8px;
            margin: 15px 0;
            border-left: 5px solid #dc3545;
        }
        .warning {
            background: #fff3cd;
            color: #856404;
            padding: 20px;
            border-radius: 8px;
            margin: 15px 0;
            border-left: 5px solid #ffc107;
        }
        .info {
            background: #d1ecf1;
            color: #0c5460;
            padding: 20px;
            border-radius: 8px;
            margin: 15px 0;
            border-left: 5px solid #17a2b8;
        }
        .btn {
            display: inline-block;
            background: #2d5016;
            color: white;
            padding: 18px 45px;
            text-decoration: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            margin: 10px 5px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn:hover {
            background: #3d6b1f;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(45, 80, 22, 0.3);
        }
        .btn-large {
            font-size: 22px;
            padding: 25px 60px;
        }
        .btn-success {
            background: #28a745;
        }
        .btn-success:hover {
            background: #218838;
        }
        .btn-danger {
            background: #dc3545;
        }
        .btn-danger:hover {
            background: #c82333;
        }
        .text-center {
            text-align: center;
        }
        ul, ol {
            margin: 15px 0 15px 30px;
        }
        li {
            margin: 10px 0;
        }
        strong {
            color: #2d5016;
        }
        .blocks-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin: 25px 0;
        }
        .block-card {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 20px;
            transition: all 0.3s ease;
        }
        .block-card:hover {
            border-color: #2d5016;
            box-shadow: 0 4px 12px rgba(45, 80, 22, 0.1);
        }
        .block-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }
        .block-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2d5016;
            margin-bottom: 8px;
        }
        .block-desc {
            font-size: 0.9rem;
            color: #666;
        }
        .page-guide {
            background: #f8f9fa;
            border-left: 4px solid #2d5016;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .page-guide-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2d5016;
            margin-bottom: 15px;
        }
        code {
            background: #f4f4f4;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
            color: #c7254e;
        }
    </style>
</head>
<body>
    <div class="container">

        <?php if ($step === 'info'): ?>

            <h1>🎯 Switch to ACF Blocks</h1>
            <p class="subtitle">The professional way to build WordPress pages</p>

            <div class="success">
                <strong>✅ Great Decision!</strong><br><br>
                You're switching from hardcoded templates to ACF blocks.<br>
                This is professional WordPress development best practice!
            </div>

            <h2>📊 What You Have Now (Hardcoded)</h2>

            <div class="warning">
                <strong>Current Setup - Hardcoded Templates:</strong><br><br>
                ❌ <strong>Über uns</strong> - Content hardcoded in page-about.php<br>
                ❌ <strong>Galerie & 3D</strong> - Content hardcoded in page-gallery-3d.php<br>
                ❌ <strong>Kontakt</strong> - Content hardcoded in page-contact.php<br>
                ❌ <strong>Modelle</strong> - Content hardcoded in page-models-new.php<br><br>
                <strong>Problem:</strong> You can't edit content without a developer!
            </div>

            <h2>🎨 What You'll Have (ACF Blocks)</h2>

            <div class="success">
                <strong>New Setup - Flexible ACF Blocks:</strong><br><br>
                ✅ All pages use <strong>default template</strong> (like homepage)<br>
                ✅ You build pages with <strong>ACF blocks</strong> in Gutenberg<br>
                ✅ Add, remove, reorder blocks anytime<br>
                ✅ Edit all content yourself - no developer needed<br>
                ✅ Want to add a new model? Just add another block!
            </div>

            <h2>🧱 Your 10 Available ACF Blocks</h2>

            <div class="blocks-grid">
                <div class="block-card">
                    <div class="block-icon">🖼️</div>
                    <div class="block-name">Hero-Bereich</div>
                    <div class="block-desc">Hero section with image, title, buttons</div>
                </div>
                <div class="block-card">
                    <div class="block-icon">⭐</div>
                    <div class="block-name">Vorteile</div>
                    <div class="block-desc">Benefits/features grid with icons</div>
                </div>
                <div class="block-card">
                    <div class="block-icon">🏠</div>
                    <div class="block-name">Modelle</div>
                    <div class="block-desc">Model cards with images and specs</div>
                </div>
                <div class="block-card">
                    <div class="block-icon">👥</div>
                    <div class="block-name">Über uns</div>
                    <div class="block-desc">About section with image and text</div>
                </div>
                <div class="block-card">
                    <div class="block-icon">📧</div>
                    <div class="block-name">Kontakt</div>
                    <div class="block-desc">Contact form and info</div>
                </div>
                <div class="block-card">
                    <div class="block-icon">🖼️</div>
                    <div class="block-name">Galerie</div>
                    <div class="block-desc">Image gallery with lightbox</div>
                </div>
                <div class="block-card">
                    <div class="block-icon">🔄</div>
                    <div class="block-name">3D Rundgang</div>
                    <div class="block-desc">3D tour or video embed</div>
                </div>
                <div class="block-card">
                    <div class="block-icon">📐</div>
                    <div class="block-name">Grundrisse</div>
                    <div class="block-desc">Floor plans display</div>
                </div>
                <div class="block-card">
                    <div class="block-icon">🎨</div>
                    <div class="block-name">Innenausstattung</div>
                    <div class="block-desc">Interior features showcase</div>
                </div>
                <div class="block-card">
                    <div class="block-icon">📣</div>
                    <div class="block-name">CTA-Bereich</div>
                    <div class="block-desc">Call-to-action with button</div>
                </div>
            </div>

            <h2>⚡ What This Script Will Do</h2>

            <div class="info">
                <strong>Automated Process:</strong><br><br>
                1️⃣ <strong>Remove custom templates</strong> from all pages<br>
                2️⃣ <strong>Set all pages to default template</strong> (like homepage)<br>
                3️⃣ <strong>Clear hardcoded content</strong><br>
                4️⃣ <strong>Enable ACF blocks</strong> in Gutenberg editor<br><br>
                <strong>Result:</strong> You can build pages yourself with ACF blocks!
            </div>

            <div class="text-center" style="margin: 50px 0;">
                <a href="?step=switch" class="btn btn-success btn-large">
                    🚀 Switch to ACF Blocks Now
                </a>
            </div>

        <?php elseif ($step === 'switch'): ?>

            <h1>🔄 Switching to ACF Blocks...</h1>

            <?php
            // Get all pages
            $all_pages = get_pages(array(
                'post_type' => 'page',
                'post_status' => 'publish',
            ));

            $homepage_id = get_option('page_on_front');
            $fixed_count = 0;
            $skipped_count = 0;

            foreach ($all_pages as $page) {
                // Skip homepage (already using ACF blocks)
                if ($page->ID == $homepage_id) {
                    echo '<div class="info">⏭️ <strong>Skipped:</strong> ' . esc_html($page->post_title) . ' (homepage - already using ACF blocks)</div>';
                    $skipped_count++;
                    continue;
                }

                $template = get_post_meta($page->ID, '_wp_page_template', true);
                $is_default = empty($template) || $template === 'default';

                // Skip if already using default template
                if ($is_default) {
                    echo '<div class="info">⏭️ <strong>Skipped:</strong> ' . esc_html($page->post_title) . ' (already using ACF blocks)</div>';
                    $skipped_count++;
                    continue;
                }

                // Remove custom template
                delete_post_meta($page->ID, '_wp_page_template');

                // Clear ALL content (will be rebuilt with ACF blocks)
                wp_update_post(array(
                    'ID' => $page->ID,
                    'post_content' => '',
                ));

                echo '<div class="success">✅ <strong>Converted:</strong> ' . esc_html($page->post_title) . ' - Removed template: <code>' . esc_html($template) . '</code></div>';
                $fixed_count++;
            }
            ?>

            <h2>🎉 Conversion Complete!</h2>

            <div class="success">
                <strong>✅ Successfully Switched to ACF Blocks!</strong><br><br>
                <strong>Results:</strong><br>
                • Converted: <strong><?php echo $fixed_count; ?></strong> page(s)<br>
                • Skipped: <?php echo $skipped_count; ?> page(s) (already using ACF blocks)<br>
                • Total: <?php echo count($all_pages); ?> page(s)
            </div>

            <h2>📝 How to Rebuild Your Pages</h2>

            <div class="info">
                <strong>Step-by-Step Instructions:</strong><br><br>
                1. Go to <strong>WordPress Dashboard → Pages</strong><br>
                2. Click <strong>Edit</strong> on any page<br>
                3. Click the <strong>+ (Plus)</strong> button to add blocks<br>
                4. Search for "wohnegruen" or scroll to <strong>WohneGruen category</strong><br>
                5. Add blocks and fill in content<br>
                6. Click <strong>Update</strong> to save
            </div>

            <?php
            // Page-specific guides
            $page_guides = array(
                'Über uns' => array(
                    'blocks' => array(
                        'Hero-Bereich' => 'Hero with company image',
                        'Über uns' => 'Company info with image and text',
                        'Vorteile' => 'Company values (Quality, Sustainability, etc.)',
                        'CTA-Bereich' => 'Call to action for contact',
                    ),
                ),
                'Galerie & 3D' => array(
                    'blocks' => array(
                        'Hero-Bereich' => 'Gallery hero image',
                        'Galerie' => 'Image gallery with filters',
                        '3D Rundgang' => '3D tour section',
                        'Grundrisse' => 'Floor plans display',
                        'CTA-Bereich' => 'Call to action',
                    ),
                ),
                'Kontakt' => array(
                    'blocks' => array(
                        'Hero-Bereich' => 'Contact hero',
                        'Kontakt' => 'Contact form and info',
                        'CTA-Bereich' => 'Additional CTA',
                    ),
                ),
                'Modelle / Unsere Modelle' => array(
                    'blocks' => array(
                        'Hero-Bereich' => 'Models hero',
                        'Modelle' => 'Nature model card',
                        'Modelle' => 'Pure model card',
                        'Vorteile' => 'Model features/benefits',
                        'Galerie' => 'Model gallery',
                        'CTA-Bereich' => 'Call to action',
                    ),
                ),
            );

            foreach ($page_guides as $page_name => $guide):
            ?>
                <div class="page-guide">
                    <div class="page-guide-title">📄 <?php echo $page_name; ?> Page</div>
                    <strong>Suggested blocks (in order):</strong>
                    <ol>
                        <?php foreach ($guide['blocks'] as $block => $desc): ?>
                            <li><strong><?php echo $block; ?></strong> - <?php echo $desc; ?></li>
                        <?php endforeach; ?>
                    </ol>
                </div>
            <?php endforeach; ?>

            <h2>💡 Pro Tips</h2>

            <div class="warning">
                <strong>Important Tips:</strong><br><br>
                ✅ <strong>Images:</strong> Select images from Media Library (already imported)<br>
                ✅ <strong>Multiple models?</strong> Add multiple "Modelle" blocks<br>
                ✅ <strong>Reorder:</strong> Drag blocks to reorder them<br>
                ✅ <strong>Preview:</strong> Use "Preview" button to see changes before publishing<br>
                ✅ <strong>Flexibility:</strong> You can add/remove/edit blocks anytime!
            </div>

            <div class="text-center" style="margin: 50px 0;">
                <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" class="btn btn-success btn-large">
                    📝 Go to Pages - Start Building
                </a>
                <a href="<?php echo home_url('/'); ?>" class="btn" target="_blank">
                    🌐 View Homepage (Example)
                </a>
            </div>

        <?php endif; ?>

    </div>
</body>
</html>
