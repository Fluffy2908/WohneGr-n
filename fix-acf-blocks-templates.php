<?php
/**
 * Fix ACF Blocks - Remove Custom Templates
 *
 * Problem: Pages have custom templates with hardcoded content
 * Solution: Remove custom templates so ACF blocks can be used
 */

require_once('../../../wp-load.php');

if (!current_user_can('manage_options')) {
    wp_die('Access denied.');
}

$step = isset($_GET['step']) ? $_GET['step'] : 'diagnose';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fix ACF Blocks Templates</title>
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
        code { background: #f4f4f4; padding: 2px 6px; border-radius: 3px; font-family: monospace; font-size: 13px; }
        .btn { display: inline-block; background: #2d5016; color: white; padding: 15px 40px; text-decoration: none; border-radius: 8px; font-size: 18px; font-weight: 600; margin: 10px 5px; border: none; cursor: pointer; }
        .btn:hover { background: #3d6b1f; }
        .btn-danger { background: #dc3545; }
        .btn-danger:hover { background: #c82333; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; font-weight: 600; }
        .status-problem { color: #dc3545; font-weight: bold; }
        .status-ok { color: #28a745; font-weight: bold; }
        label { display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem; cursor: pointer; }
        label:hover { background: #f8f9fa; }
        input[type="checkbox"] { width: 20px; height: 20px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔧 Fix ACF Blocks - Remove Custom Templates</h1>

        <?php if ($step === 'diagnose'): ?>

            <div class="error">
                <strong>❌ PROBLEM IDENTIFIED!</strong><br><br>
                Your pages have <strong>custom templates with hardcoded content</strong>.<br>
                This prevents ACF blocks from being added and displayed.<br><br>
                <strong>Why this happens:</strong><br>
                - Custom templates (page-about.php, page-gallery-3d.php, etc.) have HTML hardcoded<br>
                - They don't call <code>the_content()</code> so Gutenberg blocks never show<br>
                - Homepage works because it uses default template which displays ACF blocks
            </div>

            <h2>📋 Page Template Status</h2>

            <?php
            // Check all pages
            $pages_to_check = array(
                'uber-uns' => 'Über uns',
                'galerie-3d' => 'Galerie & 3D',
                'kontakt' => 'Kontakt',
                'unsere-modelle' => 'Modelle',
            );

            $pages_data = array();

            foreach ($pages_to_check as $slug => $title) {
                $page = get_page_by_path($slug);
                if (!$page) {
                    // Try alternative slugs
                    $page = get_page_by_title($title);
                }

                if ($page) {
                    $template = get_post_meta($page->ID, '_wp_page_template', true);
                    $has_content = strlen($page->post_content) > 0;

                    $pages_data[] = array(
                        'id' => $page->ID,
                        'title' => $page->post_title,
                        'slug' => $page->post_name,
                        'template' => $template ?: 'default',
                        'has_content' => $has_content,
                        'url' => get_permalink($page->ID),
                    );
                }
            }
            ?>

            <table>
                <thead>
                    <tr>
                        <th>Page</th>
                        <th>Current Template</th>
                        <th>Has Gutenberg Content?</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pages_data as $page): ?>
                        <tr>
                            <td><strong><?php echo esc_html($page['title']); ?></strong><br><small><?php echo esc_html($page['slug']); ?></small></td>
                            <td><code><?php echo esc_html($page['template']); ?></code></td>
                            <td><?php echo $page['has_content'] ? '✓ Yes' : '✗ Empty'; ?></td>
                            <td>
                                <?php if ($page['template'] !== 'default' && $page['template'] !== ''): ?>
                                    <span class="status-problem">⚠️ Custom template blocks ACF</span>
                                <?php else: ?>
                                    <span class="status-ok">✓ Can use ACF blocks</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h2>✅ Solution</h2>

            <div class="warning">
                <strong>What needs to be done:</strong><br><br>
                <strong>Option 1: Remove ALL custom templates (Recommended)</strong><br>
                - Remove custom templates from all pages<br>
                - Let all pages use ACF blocks like the homepage<br>
                - You can then build pages with ACF blocks in Gutenberg editor<br>
                - More flexible - you control the content<br>
                <br>
                <strong>Option 2: Keep Modelle template, remove others</strong><br>
                - Keep Modelle page with tabs and color sliders (hardcoded)<br>
                - Remove templates from Über uns, Galerie & 3D, Kontakt<br>
                - Those 3 pages can then use ACF blocks<br>
            </div>

            <form method="post" action="?step=fix">
                <h3>Select pages to fix:</h3>

                <?php foreach ($pages_data as $page): ?>
                    <?php if ($page['template'] !== 'default' && $page['template'] !== ''): ?>
                        <label>
                            <input type="checkbox" name="pages[]" value="<?php echo $page['id']; ?>" <?php echo ($page['slug'] !== 'unsere-modelle') ? 'checked' : ''; ?>>
                            <strong><?php echo esc_html($page['title']); ?></strong>
                            - Remove template: <code><?php echo esc_html($page['template']); ?></code>
                        </label>
                    <?php endif; ?>
                <?php endforeach; ?>

                <div class="info" style="margin-top: 2rem;">
                    <strong>💡 Recommendation:</strong><br>
                    - <strong>Über uns, Galerie & 3D, Kontakt:</strong> Remove templates (checked by default)<br>
                    - <strong>Modelle:</strong> Keep if you like the tabs/color sliders, or remove if you want to use ACF blocks
                </div>

                <div style="text-align: center; margin: 30px 0;">
                    <button type="submit" class="btn btn-danger">🗑️ Remove Selected Templates</button>
                </div>
            </form>

        <?php elseif ($step === 'fix'): ?>

            <h2>Removing Custom Templates...</h2>

            <?php
            $pages_to_fix = isset($_POST['pages']) ? $_POST['pages'] : array();

            if (empty($pages_to_fix)) {
                echo '<div class="warning">⚠️ No pages selected for fixing.</div>';
            } else {
                $fixed_count = 0;

                foreach ($pages_to_fix as $page_id) {
                    $page = get_post($page_id);

                    if ($page) {
                        $old_template = get_post_meta($page_id, '_wp_page_template', true);

                        // Remove custom template
                        delete_post_meta($page_id, '_wp_page_template');

                        echo '<div class="success">✓ ' . esc_html($page->post_title) . ' - Removed template: <code>' . esc_html($old_template) . '</code></div>';
                        $fixed_count++;
                    }
                }

                echo '<h2>✅ Fixed!</h2>';

                echo '<div class="success">';
                echo '<strong>Successfully removed ' . $fixed_count . ' custom template(s)!</strong><br><br>';
                echo '<strong>What happens now:</strong><br>';
                echo '1. Pages now use the DEFAULT template<br>';
                echo '2. Default template calls <code>the_content()</code> which displays Gutenberg blocks<br>';
                echo '3. You can now add ACF blocks to these pages in the Gutenberg editor<br>';
                echo '4. Go to Pages → Edit each page → Add your ACF blocks<br>';
                echo '</div>';

                echo '<div class="info">';
                echo '<strong>📝 Next Steps:</strong><br><br>';
                echo '1. Go to <a href="' . admin_url('edit.php?post_type=page') . '" target="_blank">Pages</a><br>';
                echo '2. Edit each page you just fixed<br>';
                echo '3. Add ACF blocks (Hero-Bereich, Vorteile, Modelle, etc.)<br>';
                echo '4. Assign images from Media Library<br>';
                echo '5. Update & view page<br>';
                echo '</div>';

                echo '<div style="text-align: center; margin: 30px 0;">';
                echo '<a href="' . admin_url('edit.php?post_type=page') . '" class="btn">📝 Edit Pages</a>';
                echo '<a href="?step=diagnose" class="btn">🔍 Check Again</a>';
                echo '</div>';
            }
            ?>

        <?php endif; ?>

    </div>
</body>
</html>
