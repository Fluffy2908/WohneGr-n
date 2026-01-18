<?php
/**
 * Restore Working Templates from Friday
 *
 * On Friday, pages used custom templates with hardcoded content.
 * Yesterday we converted them to "default" template - that's why they show homepage content!
 *
 * This script restores the Friday template assignments.
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
    <title>Restore Working Templates</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: linear-gradient(135deg, #2d5016 0%, #3d6b1f 100%);
            padding: 20px;
        }
        .container {
            max-width: 900px;
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
        .btn-success { background: #28a745; }
        .btn-success:hover { background: #218838; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; font-weight: 600; }
        code { background: #f4f4f4; padding: 2px 8px; border-radius: 4px; font-family: monospace; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔄 Restore Working Templates</h1>
            <p>Return to Friday's working state</p>
        </div>
        <div class="content">

            <?php if ($step === 'preview'): ?>

                <h2>🔍 Root Cause Analysis</h2>

                <div class="error">
                    <strong>✗ Why pages show homepage content:</strong><br><br>
                    <strong>On Friday (Working):</strong><br>
                    - Über uns → page-about.php template (custom content)<br>
                    - Kontakt → page-contact.php template (custom content)<br>
                    - Galerie & 3D → page-gallery-3d.php template (custom content)<br>
                    <br>
                    <strong>Yesterday (Broken):</strong><br>
                    - All pages → "default" template<br>
                    - WordPress falls back to index.php<br>
                    - index.php has homepage content!<br>
                    - That's why all pages show homepage!
                </div>

                <h2>✅ The Solution</h2>

                <div class="success">
                    <strong>Restore Friday's custom template assignments!</strong><br><br>
                    Custom templates STILL EXIST with working content:<br>
                    ✓ page-about.php - Full hardcoded About content<br>
                    ✓ page-contact.php - Full hardcoded Contact content<br>
                    ✓ page-gallery-3d.php - Full hardcoded Gallery content<br>
                    <br>
                    We just need to reassign pages to use these templates!
                </div>

                <?php
                // Template mappings
                $template_mappings = array(
                    'uber-uns' => 'page-about.php',
                    'kontakt' => 'page-contact.php',
                    'galerie-3d' => 'page-gallery-3d.php',
                    'modelle' => 'page-models-new.php',
                    'impressum' => 'page-impressum.php',
                    'datenschutz' => 'page-datenschutz.php',
                    'datenschutzerklarung' => 'page-datenschutz.php',
                    'agb' => 'page-agb.php',
                );

                $pages = get_pages(array('number' => 999));
                ?>

                <h2>Pages to Fix</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Page</th>
                            <th>Current Template</th>
                            <th>Will Use Template</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pages as $page):
                            $current_template = get_post_meta($page->ID, '_wp_page_template', true);
                            $page_slug = $page->post_name;

                            // Find correct template
                            $correct_template = isset($template_mappings[$page_slug]) ? $template_mappings[$page_slug] : 'default';
                            $template_file = get_template_directory() . '/' . $correct_template;
                        ?>
                            <tr>
                                <td><strong><?php echo esc_html($page->post_title); ?></strong></td>
                                <td><code><?php echo $current_template ?: 'default'; ?></code></td>
                                <td>
                                    <code><?php echo $correct_template; ?></code>
                                    <?php if ($correct_template !== 'default' && !file_exists($template_file)): ?>
                                        <span style="color: #dc3545;"> (missing!)</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($current_template === $correct_template): ?>
                                        <span style="color: #28a745;">✓ Correct</span>
                                    <?php elseif ($correct_template !== 'default' && file_exists($template_file)): ?>
                                        <span style="color: #dc3545;">→ Will fix</span>
                                    <?php else: ?>
                                        <span style="color: #999;">No change</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <h2>What This Will Do</h2>
                <ol>
                    <li><strong>Reassign pages to Friday's templates</strong>
                        <ul>
                            <li>"Über uns" → page-about.php</li>
                            <li>"Kontakt" → page-contact.php</li>
                            <li>"Galerie & 3D" → page-gallery-3d.php</li>
                            <li>"Modelle" → page-models-new.php</li>
                        </ul>
                    </li>
                    <li><strong>Pages will immediately show their own content</strong></li>
                    <li><strong>No more homepage content on other pages</strong></li>
                    <li><strong>Everything works like Friday</strong></li>
                </ol>

                <div class="warning">
                    <strong>⚠️ Note:</strong><br>
                    - Custom templates have hardcoded content (like Friday)<br>
                    - No need for Gutenberg blocks<br>
                    - This is the simple solution that was already working!
                </div>

                <div style="text-align: center; margin: 40px 0;">
                    <a href="?step=restore" class="btn btn-success">🔧 Restore Friday's Template Assignments</a>
                </div>

            <?php elseif ($step === 'restore'): ?>

                <h2>Restoring Templates...</h2>

                <?php
                $template_mappings = array(
                    'uber-uns' => 'page-about.php',
                    'kontakt' => 'page-contact.php',
                    'galerie-3d' => 'page-gallery-3d.php',
                    'modelle' => 'page-models-new.php',
                    'impressum' => 'page-impressum.php',
                    'datenschutz' => 'page-datenschutz.php',
                    'datenschutzerklarung' => 'page-datenschutz.php',
                    'agb' => 'page-agb.php',
                );

                $pages = get_pages(array('number' => 999));
                $fixed = 0;

                foreach ($pages as $page) {
                    $page_slug = $page->post_name;

                    if (isset($template_mappings[$page_slug])) {
                        $template = $template_mappings[$page_slug];
                        $template_file = get_template_directory() . '/' . $template;

                        if (file_exists($template_file)) {
                            update_post_meta($page->ID, '_wp_page_template', $template);
                            echo '<div class="success">✓ Fixed: ' . esc_html($page->post_title) . ' → <code>' . esc_html($template) . '</code></div>';
                            $fixed++;
                        } else {
                            echo '<div class="error">✗ Template missing: ' . esc_html($page->post_title) . ' (needs <code>' . esc_html($template) . '</code>)</div>';
                        }
                    }
                }
                ?>

                <h2>✅ Templates Restored!</h2>

                <div class="success">
                    <strong>Fixed <?php echo $fixed; ?> pages!</strong><br>
                    Pages now use Friday's custom templates with hardcoded content.
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
                                <td><a href="<?php echo esc_url(get_permalink($page->ID)); ?>" target="_blank" class="btn" style="padding: 5px 15px; font-size: 14px;">Visit Page →</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="info">
                    <strong>✓ Everything should work now!</strong><br>
                    - Über uns: Shows company information<br>
                    - Kontakt: Shows contact form and details<br>
                    - Galerie & 3D: Shows gallery<br>
                    - Modelle: Shows model listings<br>
                    <br>
                    Exactly like it was working on Friday!
                </div>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="<?php echo home_url('/'); ?>" class="btn">View Website</a>
                </div>

            <?php endif; ?>

        </div>
    </div>
</body>
</html>
