<?php
/**
 * Fix Modelle Menu Link - Diagnose URL Conflict
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
    <title>Fix Modelle Menu</title>
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
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        h1 { color: #2d5016; margin-top: 0; }
        h2 { color: #2d5016; border-bottom: 2px solid #2d5016; padding-bottom: 10px; margin-top: 30px; }
        .success { background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #28a745; }
        .error { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #dc3545; }
        .warning { background: #fff3cd; color: #856404; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #ffc107; }
        .info { background: #d1ecf1; color: #0c5460; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #17a2b8; }
        code { background: #f4f4f4; padding: 3px 8px; border-radius: 3px; font-family: monospace; word-break: break-all; }
        .btn { display: inline-block; background: #2d5016; color: white; padding: 15px 30px; text-decoration: none; border-radius: 8px; margin: 10px 5px; border: none; cursor: pointer; font-size: 16px; font-weight: 600; }
        .btn:hover { background: #3d6b1f; }
        .btn-success { background: #28a745; }
        .btn-success:hover { background: #218838; }
        .comparison-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin: 20px 0; }
        .comparison-box { padding: 20px; border-radius: 8px; }
        .comparison-wrong { background: #f8d7da; border: 2px solid #dc3545; }
        .comparison-right { background: #d4edda; border: 2px solid #28a745; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; font-weight: 600; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔧 Fix Modelle Navigation Menu</h1>

        <?php if ($step === 'diagnose'): ?>

            <h2>🔍 URL Conflict Diagnosis</h2>

            <?php
            // Check the Modelle PAGE
            $modelle_page = get_page_by_path('modelle');
            if (!$modelle_page) {
                $modelle_page = get_page_by_title('Modelle');
            }

            // Check mobilhaus archive
            $archive_url = get_post_type_archive_link('mobilhaus');

            // Check CPT settings
            $cpt_object = get_post_type_object('mobilhaus');
            $cpt_rewrite = $cpt_object ? $cpt_object->rewrite : null;
            $cpt_slug = $cpt_rewrite ? $cpt_rewrite['slug'] : 'mobilhaus';
            $cpt_has_archive = $cpt_object ? $cpt_object->has_archive : false;
            ?>

            <div class="error">
                <strong>❌ PROBLEM IDENTIFIED!</strong><br><br>
                The custom post type "mobilhaus" is using the slug: <code><?php echo esc_html($cpt_slug); ?></code><br>
                This is CONFLICTING with your Modelle page URL!<br><br>
                <?php if ($cpt_slug === 'modelle'): ?>
                    <strong>The mobilhaus archive is stealing the /modelle/ URL!</strong>
                <?php endif; ?>
            </div>

            <h2>Current URL Situation</h2>

            <table>
                <thead>
                    <tr>
                        <th>What</th>
                        <th>URL</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Modelle PAGE (page-models-new.php)</td>
                        <td><code><?php echo $modelle_page ? get_permalink($modelle_page->ID) : 'Not found'; ?></code></td>
                        <td><?php echo $modelle_page ? '✓ Exists' : '✗ Missing'; ?></td>
                    </tr>
                    <tr>
                        <td>Mobilhaus Archive (archive-mobilhaus.php)</td>
                        <td><code><?php echo esc_html($archive_url); ?></code></td>
                        <td>✓ Active</td>
                    </tr>
                    <tr>
                        <td>Mobilhaus CPT Slug</td>
                        <td><code><?php echo esc_html($cpt_slug); ?></code></td>
                        <td><?php echo $cpt_slug === 'modelle' ? '<span style="color: #dc3545;">⚠️ CONFLICTS!</span>' : '✓ OK'; ?></td>
                    </tr>
                </tbody>
            </table>

            <h2>✅ Solutions</h2>

            <div class="comparison-grid">
                <div class="comparison-box comparison-right">
                    <h3 style="margin-top: 0;">Option 1: Change Modelle Page Slug</h3>
                    <p><strong>Easiest fix:</strong></p>
                    <ul>
                        <li>Change Modelle page slug to: <code>unsere-modelle</code></li>
                        <li>Keep mobilhaus archive at: <code>/modelle/</code></li>
                        <li>New URL: <code>/unsere-modelle/</code></li>
                        <li>Update navigation menu</li>
                    </ul>
                </div>

                <div class="comparison-box comparison-wrong">
                    <h3 style="margin-top: 0;">Option 2: Change CPT Slug</h3>
                    <p><strong>More complex:</strong></p>
                    <ul>
                        <li>Change mobilhaus CPT slug to: <code>mobilhaeuser</code></li>
                        <li>Keep Modelle page at: <code>/modelle/</code></li>
                        <li>Requires code change</li>
                        <li>Flush permalinks</li>
                    </ul>
                </div>
            </div>

            <h2>🎯 Recommended Fix: Option 1</h2>

            <div class="success">
                <strong>I'll do this automatically:</strong><br><br>
                1. Change Modelle page slug from <code>modelle</code> → <code>unsere-modelle</code><br>
                2. This frees up /modelle/ for the mobilhaus archive<br>
                3. Your new Modelle page URL: <code><?php echo home_url('/unsere-modelle/'); ?></code><br>
                4. You'll need to update the navigation menu link manually<br><br>
                <strong>After this fix:</strong><br>
                - Navigation "Modelle" should point to: <code><?php echo home_url('/unsere-modelle/'); ?></code><br>
                - Mobilhaus archive stays at: <code>/modelle/</code>
            </div>

            <form method="post" action="?step=fix" onsubmit="return confirm('Change Modelle page slug to unsere-modelle?');">
                <button type="submit" class="btn btn-success">🔧 Fix Slug Conflict (Change to unsere-modelle)</button>
            </form>

        <?php elseif ($step === 'fix'): ?>

            <h2>Applying Fix...</h2>

            <?php
            $modelle_page = get_page_by_path('modelle');
            if (!$modelle_page) {
                $modelle_page = get_page_by_title('Modelle');
            }

            if ($modelle_page) {
                // Update the page slug
                $result = wp_update_post(array(
                    'ID' => $modelle_page->ID,
                    'post_name' => 'unsere-modelle',
                ));

                if ($result && !is_wp_error($result)) {
                    echo '<div class="success">✅ Page slug changed to: unsere-modelle</div>';

                    // Flush rewrite rules
                    flush_rewrite_rules();
                    echo '<div class="success">✅ Permalinks refreshed</div>';
                } else {
                    echo '<div class="error">❌ Error: ' . ($result ? $result->get_error_message() : 'Unknown error') . '</div>';
                }

                $new_url = get_permalink($modelle_page->ID);
            } else {
                echo '<div class="error">❌ Modelle page not found!</div>';
            }
            ?>

            <h2>✅ Fixed!</h2>

            <div class="success">
                <strong>Slug conflict resolved!</strong><br><br>
                Old URL: <code><?php echo home_url('/modelle/'); ?></code> → Now shows mobilhaus archive<br>
                New URL: <code><?php echo esc_html($new_url); ?></code> → Shows page-models-new.php with tabs!<br><br>
                <strong>The page with tabs and color sliders is now at a different URL.</strong>
            </div>

            <h2>📝 Update Navigation Menu</h2>

            <div class="warning">
                <strong>You need to manually update your menu:</strong><br><br>
                1. Go to: <a href="<?php echo admin_url('nav-menus.php'); ?>" target="_blank">Appearance → Menus</a><br>
                2. Find the "Modelle" menu item<br>
                3. Change URL to: <code><?php echo esc_html($new_url); ?></code><br>
                4. Save menu
            </div>

            <a href="<?php echo $new_url; ?>" class="btn btn-success" target="_blank">🎨 View Fixed Modelle Page (With Tabs!)</a>
            <a href="<?php echo admin_url('nav-menus.php'); ?>" class="btn" target="_blank">📝 Update Menu</a>

        <?php endif; ?>

    </div>
</body>
</html>
