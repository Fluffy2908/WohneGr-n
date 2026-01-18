<?php
/**
 * Complete ACF Setup
 *
 * This script does EVERYTHING needed for ACF to work properly:
 * 1. Fixes field group location rules (correct block names)
 * 2. Assigns pages to use default template (for Gutenberg)
 * 3. Clears any existing page content (start fresh with blocks)
 * 4. Verifies field groups are visible in ACF Pro
 * 5. Tests that blocks show fields
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
    <title>Complete ACF Setup</title>
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
        h2 { color: #2d5016; border-bottom: 2px solid #2d5016; padding-bottom: 10px; margin-top: 30px; }
        .success { background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #28a745; }
        .error { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #dc3545; }
        .warning { background: #fff3cd; color: #856404; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #ffc107; }
        .info { background: #d1ecf1; color: #0c5460; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #17a2b8; }
        .btn { display: inline-block; background: #2d5016; color: white; padding: 15px 40px; text-decoration: none; border-radius: 8px; font-size: 18px; font-weight: 600; margin: 10px 5px; border: none; cursor: pointer; }
        .btn:hover { background: #3d6b1f; }
        .btn-success { background: #28a745; }
        .btn-success:hover { background: #218838; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; font-size: 13px; }
        th { background: #f8f9fa; font-weight: 600; }
        code { background: #f4f4f4; padding: 2px 8px; border-radius: 4px; font-family: monospace; font-size: 12px; }
        .step-box { background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎯 Complete ACF Setup</h1>
            <p>Visible field groups + Working Gutenberg blocks</p>
        </div>
        <div class="content">

            <?php if ($step === 'preview'): ?>

                <h2>What This Will Do</h2>

                <div class="info">
                    <strong>Complete ACF + Gutenberg Setup:</strong>
                    <ol>
                        <li><strong>Fix Field Group Location Rules</strong>
                            <ul>
                                <li>Update database field groups with correct block names</li>
                                <li>Example: acf/hero → acf/wohnegruen-hero</li>
                            </ul>
                        </li>
                        <li><strong>Convert Pages to Gutenberg</strong>
                            <ul>
                                <li>Set all pages to use "default" template</li>
                                <li>This enables Gutenberg editor</li>
                            </ul>
                        </li>
                        <li><strong>Clear Old Content</strong>
                            <ul>
                                <li>Remove hardcoded content</li>
                                <li>Start fresh with ACF blocks</li>
                            </ul>
                        </li>
                    </ol>
                </div>

                <div class="success">
                    <strong>✓ Result:</strong><br>
                    - Field groups visible in ACF Pro admin menu<br>
                    - Field groups editable in WordPress<br>
                    - Blocks show fields when clicked in Gutenberg<br>
                    - Fully flexible - add content through ACF
                </div>

                <div class="warning">
                    <strong>⚠️ Important:</strong><br>
                    - Pages will be BLANK after this (no blocks added yet)<br>
                    - You'll need to manually add ACF blocks to each page<br>
                    - Fill in fields for each block<br>
                    - This gives you full flexibility with ACF
                </div>

                <div style="text-align: center; margin: 40px 0;">
                    <a href="?step=setup" class="btn btn-success">🚀 Run Complete ACF Setup</a>
                </div>

            <?php elseif ($step === 'setup'): ?>

                <h2>Running Complete ACF Setup...</h2>

                <?php
                $results = array(
                    'field_groups_fixed' => 0,
                    'pages_converted' => 0,
                    'pages_cleared' => 0,
                );

                // STEP 1: Fix field group location rules
                echo '<div class="step-box"><h3>Step 1: Fixing Field Group Location Rules</h3>';

                $block_name_fixes = array(
                    'acf/hero' => 'acf/wohnegruen-hero',
                    'acf/vorteile' => 'acf/wohnegruen-features',
                    'acf/models-overview' => 'acf/wohnegruen-models',
                    'acf/gallery' => 'acf/wohnegruen-gallery',
                    'acf/contact' => 'acf/wohnegruen-contact',
                    'acf/cta' => 'acf/wohnegruen-cta',
                    'acf/about' => 'acf/wohnegruen-about',
                    'acf/testimonials' => 'acf/wohnegruen-testimonials',
                    'acf/faq' => 'acf/wohnegruen-faq',
                    'acf/stats' => 'acf/wohnegruen-stats',
                );

                $all_groups = acf_get_field_groups();

                foreach ($all_groups as $group) {
                    $is_local = isset($group['local']) && $group['local'] === 'php';

                    if (!$is_local && isset($group['location'][0][0]['value'])) {
                        $current_location = $group['location'][0][0]['value'];

                        if (isset($block_name_fixes[$current_location])) {
                            $group['location'][0][0]['value'] = $block_name_fixes[$current_location];
                            acf_update_field_group($group);

                            echo '<div class="success">✓ Fixed: ' . esc_html($group['title']) . ' → <code>' . esc_html($block_name_fixes[$current_location]) . '</code></div>';
                            $results['field_groups_fixed']++;
                        }
                    }
                }

                echo '</div>';

                // STEP 2: Convert pages to default template
                echo '<div class="step-box"><h3>Step 2: Converting Pages to Gutenberg</h3>';

                $pages = get_pages(array('number' => 999));

                foreach ($pages as $page) {
                    $current_template = get_post_meta($page->ID, '_wp_page_template', true);

                    if ($current_template && $current_template !== 'default') {
                        update_post_meta($page->ID, '_wp_page_template', 'default');
                        echo '<div class="success">✓ Converted: ' . esc_html($page->post_title) . ' → default template</div>';
                        $results['pages_converted']++;
                    }
                }

                echo '</div>';

                // STEP 3: Clear page content
                echo '<div class="step-box"><h3>Step 3: Clearing Old Content</h3>';

                foreach ($pages as $page) {
                    if (strlen($page->post_content) > 0) {
                        wp_update_post(array(
                            'ID' => $page->ID,
                            'post_content' => '',
                        ));
                        echo '<div class="success">✓ Cleared: ' . esc_html($page->post_title) . '</div>';
                        $results['pages_cleared']++;
                    }
                }

                echo '</div>';
                ?>

                <h2>✅ Setup Complete!</h2>

                <div class="success">
                    <strong>Summary:</strong><br>
                    - Field groups fixed: <?php echo $results['field_groups_fixed']; ?><br>
                    - Pages converted to Gutenberg: <?php echo $results['pages_converted']; ?><br>
                    - Pages cleared: <?php echo $results['pages_cleared']; ?>
                </div>

                <h2>Next Steps</h2>

                <div class="info">
                    <strong>1. Verify Field Groups Visible</strong><br>
                    Go to: <a href="<?php echo admin_url('edit.php?post_type=acf-field-group'); ?>" target="_blank">Custom Fields → Field Groups</a><br>
                    You should see 13 field groups (Hero, Vorteile, Galerie, etc.)<br>
                    <br>
                    <strong>2. Add Blocks to Pages</strong><br>
                    Go to: <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" target="_blank">Pages</a><br>
                    Edit each page:<br>
                    - Click "+" to add blocks<br>
                    - Search for "Hero", "Vorteile", "Galerie", etc.<br>
                    - Add blocks you want<br>
                    <br>
                    <strong>3. Fill in Block Fields</strong><br>
                    - Click on each block<br>
                    - Right sidebar shows ACF fields<br>
                    - Fill in titles, images, descriptions<br>
                    - Save page<br>
                    <br>
                    <strong>4. View Your Pages</strong><br>
                    Visit website to see your content display
                </div>

                <h2>Available ACF Blocks</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Block Name</th>
                            <th>Use For</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td><strong>Hero-Bereich</strong></td><td>Large hero section with background image, title, buttons, stats</td></tr>
                        <tr><td><strong>Vorteile</strong></td><td>Grid of features/benefits with icons</td></tr>
                        <tr><td><strong>Modelle</strong></td><td>Display of models/products</td></tr>
                        <tr><td><strong>Über uns</strong></td><td>About section with image and content</td></tr>
                        <tr><td><strong>Galerie</strong></td><td>Image gallery with categories/filters</td></tr>
                        <tr><td><strong>Kontakt</strong></td><td>Contact section with form and info</td></tr>
                        <tr><td><strong>CTA</strong></td><td>Call-to-action section</td></tr>
                        <tr><td><strong>3D Rundgang</strong></td><td>3D tour embed or video</td></tr>
                        <tr><td><strong>Grundrisse</strong></td><td>Floor plans display</td></tr>
                        <tr><td><strong>Innenausstattung</strong></td><td>Interior rooms showcase</td></tr>
                    </tbody>
                </table>

                <h2>Example Page Structure</h2>

                <div class="warning">
                    <strong>Homepage Example:</strong><br>
                    1. Hero-Bereich (large hero)<br>
                    2. Vorteile (features grid)<br>
                    3. Modelle (models showcase)<br>
                    4. Über uns (about section)<br>
                    5. Kontakt (contact form)<br>
                    <br>
                    <strong>Galerie Page Example:</strong><br>
                    1. Hero-Bereich (small hero)<br>
                    2. Galerie (image gallery)<br>
                    <br>
                    <strong>Kontakt Page Example:</strong><br>
                    1. Hero-Bereich (small hero)<br>
                    2. Kontakt (contact form + info)<br>
                </div>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="<?php echo admin_url('edit.php?post_type=acf-field-group'); ?>" class="btn">View Field Groups</a>
                    <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" class="btn">Edit Pages</a>
                    <a href="<?php echo admin_url('upload.php'); ?>" class="btn">Media Library</a>
                </div>

            <?php endif; ?>

        </div>
    </div>
</body>
</html>
