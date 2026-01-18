<?php
/**
 * Fix 404 Errors - Comprehensive Fix
 *
 * This script fixes 404 errors by:
 * 1. Flushing permalink rewrite rules
 * 2. Ensuring .htaccess file is correct
 * 3. Converting pages to default template if needed
 * 4. Recreating missing pages
 */

// Load WordPress
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
    <title>Fix 404 Errors</title>
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
        .step-box { background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔧 Fix 404 Errors</h1>
            <p>Comprehensive troubleshooting and repair tool</p>
        </div>
        <div class="content">

            <?php if ($step === 'diagnose'): ?>

                <h2>Current Status</h2>

                <?php
                $issues = array();
                $pages = get_pages(array('number' => 999));
                $permalink_structure = get_option('permalink_structure');
                $rewrite_rules = get_option('rewrite_rules');
                $htaccess_file = ABSPATH . '.htaccess';
                ?>

                <div class="step-box">
                    <h3>1. Permalink Structure</h3>
                    <p><strong>Current:</strong> <code><?php echo $permalink_structure ? esc_html($permalink_structure) : 'Plain (default)'; ?></code></p>
                    <?php if ($permalink_structure !== '/%postname%/'): ?>
                        <div class="error">✗ Incorrect! Should be <code>/%postname%/</code></div>
                        <?php $issues[] = 'permalink_structure'; ?>
                    <?php else: ?>
                        <div class="success">✓ Correct</div>
                    <?php endif; ?>
                </div>

                <div class="step-box">
                    <h3>2. Rewrite Rules</h3>
                    <p><strong>Count:</strong> <?php echo is_array($rewrite_rules) ? count($rewrite_rules) : '0'; ?> rules</p>
                    <?php if (!is_array($rewrite_rules) || count($rewrite_rules) === 0): ?>
                        <div class="error">✗ Missing or empty! This WILL cause 404 errors.</div>
                        <?php $issues[] = 'rewrite_rules'; ?>
                    <?php else: ?>
                        <div class="success">✓ Rules exist</div>
                    <?php endif; ?>
                </div>

                <div class="step-box">
                    <h3>3. .htaccess File</h3>
                    <p><strong>Location:</strong> <code><?php echo esc_html($htaccess_file); ?></code></p>
                    <?php if (!file_exists($htaccess_file)): ?>
                        <div class="error">✗ File missing! WordPress needs this for pretty permalinks.</div>
                        <?php $issues[] = 'htaccess'; ?>
                    <?php elseif (!is_writable($htaccess_file)): ?>
                        <div class="warning">⚠️ File exists but is not writable</div>
                    <?php else: ?>
                        <div class="success">✓ Exists and writable</div>
                    <?php endif; ?>
                </div>

                <div class="step-box">
                    <h3>4. Pages Status</h3>
                    <p><strong>Total pages:</strong> <?php echo count($pages); ?></p>
                    <table>
                        <thead>
                            <tr>
                                <th>Page</th>
                                <th>Status</th>
                                <th>Template</th>
                                <th>Slug</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pages as $page):
                                $template = get_post_meta($page->ID, '_wp_page_template', true);
                                if ($template && $template !== 'default' && !file_exists(get_template_directory() . '/' . $template)) {
                                    $issues[] = 'missing_template_' . $page->ID;
                                }
                            ?>
                                <tr>
                                    <td><?php echo esc_html($page->post_title); ?></td>
                                    <td>
                                        <?php if ($page->post_status === 'publish'): ?>
                                            <span style="color: #28a745;">✓ Published</span>
                                        <?php else: ?>
                                            <span style="color: #dc3545;">✗ <?php echo esc_html($page->post_status); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($template && $template !== 'default'): ?>
                                            <?php if (file_exists(get_template_directory() . '/' . $template)): ?>
                                                <code><?php echo esc_html($template); ?></code>
                                            <?php else: ?>
                                                <span style="color: #dc3545;"><code><?php echo esc_html($template); ?></code> (missing!)</span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            Default
                                        <?php endif; ?>
                                    </td>
                                    <td><code><?php echo esc_html($page->post_name); ?></code></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <h2>Recommended Actions</h2>

                <?php if (empty($issues)): ?>
                    <div class="success">
                        <strong>✓ No critical issues detected!</strong><br>
                        If you're still seeing 404 errors, try flushing permalinks manually.
                    </div>
                <?php else: ?>
                    <div class="error">
                        <strong>✗ <?php echo count($issues); ?> issue(s) detected</strong><br>
                        Click "Apply Automatic Fixes" to resolve all issues automatically.
                    </div>
                <?php endif; ?>

                <div style="text-align: center; margin: 40px 0;">
                    <a href="?step=fix" class="btn btn-danger">🔧 Apply Automatic Fixes</a>
                    <a href="diagnose-404.php" class="btn">📊 Full Diagnostic Report</a>
                </div>

            <?php elseif ($step === 'fix'): ?>

                <h2>🔧 Applying Fixes...</h2>

                <?php
                $fixes_applied = array();

                // FIX 1: Set correct permalink structure
                echo '<div class="step-box"><h3>Fix 1: Permalink Structure</h3>';
                $current_structure = get_option('permalink_structure');
                if ($current_structure !== '/%postname%/') {
                    update_option('permalink_structure', '/%postname%/');
                    echo '<div class="success">✓ Updated permalink structure to /%postname%/</div>';
                    $fixes_applied[] = 'Permalink structure updated';
                } else {
                    echo '<div class="info">Already correct</div>';
                }
                echo '</div>';

                // FIX 2: Flush rewrite rules (do this multiple times for reliability)
                echo '<div class="step-box"><h3>Fix 2: Rewrite Rules</h3>';
                delete_option('rewrite_rules');
                flush_rewrite_rules(false);
                flush_rewrite_rules(true);
                sleep(1); // Give WordPress time to process
                flush_rewrite_rules(true);
                echo '<div class="success">✓ Flushed rewrite rules (3x for reliability)</div>';
                $fixes_applied[] = 'Rewrite rules regenerated';
                echo '</div>';

                // FIX 3: Ensure .htaccess is correct
                echo '<div class="step-box"><h3>Fix 3: .htaccess File</h3>';
                $htaccess_file = ABSPATH . '.htaccess';
                if (!file_exists($htaccess_file)) {
                    $htaccess_content = "# BEGIN WordPress\n";
                    $htaccess_content .= "<IfModule mod_rewrite.c>\n";
                    $htaccess_content .= "RewriteEngine On\n";
                    $htaccess_content .= "RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]\n";
                    $htaccess_content .= "RewriteBase /\n";
                    $htaccess_content .= "RewriteRule ^index\.php$ - [L]\n";
                    $htaccess_content .= "RewriteCond %{REQUEST_FILENAME} !-f\n";
                    $htaccess_content .= "RewriteCond %{REQUEST_FILENAME} !-d\n";
                    $htaccess_content .= "RewriteRule . /index.php [L]\n";
                    $htaccess_content .= "</IfModule>\n";
                    $htaccess_content .= "# END WordPress\n";

                    if (file_put_contents($htaccess_file, $htaccess_content)) {
                        echo '<div class="success">✓ Created .htaccess file with correct WordPress rules</div>';
                        $fixes_applied[] = '.htaccess file created';
                    } else {
                        echo '<div class="error">✗ Could not create .htaccess file (permission denied)</div>';
                    }
                } else {
                    echo '<div class="info">.htaccess file already exists</div>';
                }
                echo '</div>';

                // FIX 4: Convert pages with missing templates to default template
                echo '<div class="step-box"><h3>Fix 4: Page Templates</h3>';
                $pages = get_pages(array('number' => 999));
                $converted = 0;
                foreach ($pages as $page) {
                    $template = get_post_meta($page->ID, '_wp_page_template', true);
                    if ($template && $template !== 'default') {
                        // Check if template file exists
                        if (!file_exists(get_template_directory() . '/' . $template)) {
                            update_post_meta($page->ID, '_wp_page_template', 'default');
                            echo '<div class="success">✓ Converted "' . esc_html($page->post_title) . '" to default template (template file missing)</div>';
                            $converted++;
                        }
                    }
                }
                if ($converted > 0) {
                    $fixes_applied[] = $converted . ' pages converted to default template';
                } else {
                    echo '<div class="info">All pages have valid templates</div>';
                }
                echo '</div>';

                // FIX 5: Final permalink flush
                echo '<div class="step-box"><h3>Fix 5: Final Flush</h3>';
                flush_rewrite_rules(true);
                echo '<div class="success">✓ Final rewrite rules flush completed</div>';
                echo '</div>';
                ?>

                <h2>✅ Fixes Applied</h2>

                <div class="success">
                    <strong>All automatic fixes have been applied:</strong>
                    <ul>
                        <?php foreach ($fixes_applied as $fix): ?>
                            <li><?php echo esc_html($fix); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <h2>Test Your Pages</h2>

                <div class="info">
                    <strong>Try visiting these pages now:</strong>
                </div>

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
                                <td><a href="<?php echo esc_url(get_permalink($page->ID)); ?>" target="_blank">Test →</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <h2>If Pages Are Still Blank</h2>

                <div class="warning">
                    <strong>⚠️ Pages may appear blank because:</strong><br>
                    - They were converted from custom templates to Gutenberg<br>
                    - They don't have any blocks added yet<br><br>
                    <strong>Solution:</strong> Edit each page in WordPress admin and add ACF blocks using the Gutenberg editor.
                </div>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" class="btn">View All Pages</a>
                    <a href="<?php echo admin_url(); ?>" class="btn">WordPress Dashboard</a>
                    <a href="?step=diagnose" class="btn">Run Diagnosis Again</a>
                </div>

            <?php endif; ?>

        </div>
    </div>
</body>
</html>
