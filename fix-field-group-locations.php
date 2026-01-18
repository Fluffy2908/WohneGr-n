<?php
/**
 * Fix Field Group Location Rules
 *
 * Updates database field groups to have CORRECT block names in location rules.
 * This way they'll be visible in ACF admin AND work with Gutenberg blocks.
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
    <title>Fix Field Group Locations</title>
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
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; font-size: 13px; }
        th { background: #f8f9fa; font-weight: 600; }
        code { background: #f4f4f4; padding: 2px 8px; border-radius: 4px; font-family: monospace; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔧 Fix Field Group Locations</h1>
            <p>Update location rules to match block names</p>
        </div>
        <div class="content">

            <?php if ($step === 'preview'): ?>

                <h2>The Problem</h2>

                <div class="error">
                    <strong>✗ Field groups have WRONG block names in location rules!</strong><br><br>
                    Current location rules: <code>acf/hero</code>, <code>acf/gallery</code>, <code>acf/contact</code><br>
                    Actual block names: <code>acf/wohnegruen-hero</code>, <code>acf/wohnegruen-gallery</code>, <code>acf/wohnegruen-contact</code><br><br>
                    <strong>Result:</strong> Field groups don't connect to blocks
                </div>

                <h2>The Solution</h2>

                <div class="info">
                    <strong>This script will fix the location rules:</strong><br>
                    - Keep field groups in database (visible in ACF admin) ✓<br>
                    - Update location rules to use correct block names ✓<br>
                    - Disable local field groups (avoid duplicates) ✓<br>
                    - Field groups will be visible AND work with blocks ✓
                </div>

                <?php
                // Mapping of wrong → correct block names
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
                    'acf/wohnegruen-3d-tour' => 'acf/wohnegruen-3d-tour', // Already correct
                    'acf/wohnegruen-floor-plans' => 'acf/wohnegruen-floor-plans', // Already correct
                    'acf/wohnegruen-interiors' => 'acf/wohnegruen-interiors', // Already correct
                );

                // Get all database field groups
                $all_groups = acf_get_field_groups();
                $groups_to_fix = array();

                foreach ($all_groups as $group) {
                    $is_local = isset($group['local']) && $group['local'] === 'php';

                    if (!$is_local && isset($group['location'][0][0]['value'])) {
                        $current_location = $group['location'][0][0]['value'];

                        // Check if this needs fixing
                        if (isset($block_name_fixes[$current_location])) {
                            $groups_to_fix[] = array(
                                'group' => $group,
                                'current' => $current_location,
                                'new' => $block_name_fixes[$current_location],
                            );
                        }
                    }
                }
                ?>

                <h2>Field Groups to Fix</h2>

                <?php if (!empty($groups_to_fix)): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Field Group</th>
                                <th>Current Location Rule</th>
                                <th>New Location Rule</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($groups_to_fix as $fix): ?>
                                <tr>
                                    <td><strong><?php echo esc_html($fix['group']['title']); ?></strong></td>
                                    <td><code style="color: #dc3545;"><?php echo esc_html($fix['current']); ?></code></td>
                                    <td><code style="color: #28a745;"><?php echo esc_html($fix['new']); ?></code></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div class="success">
                        <strong>✓ Found <?php echo count($groups_to_fix); ?> field groups to fix</strong>
                    </div>
                <?php else: ?>
                    <div class="info">
                        <strong>All field groups already have correct location rules!</strong>
                    </div>
                <?php endif; ?>

                <h2>What Will Happen</h2>
                <ol>
                    <li>Update location rules in database field groups</li>
                    <li>Disable local field groups to avoid duplicates</li>
                    <li>Field groups will be:
                        <ul>
                            <li>✓ Visible in ACF Pro admin menu</li>
                            <li>✓ Editable in WordPress admin</li>
                            <li>✓ Connected to Gutenberg blocks</li>
                            <li>✓ Working when you click blocks</li>
                        </ul>
                    </li>
                </ol>

                <div style="text-align: center; margin: 40px 0;">
                    <a href="?step=fix" class="btn btn-danger">🔧 Fix Location Rules</a>
                </div>

            <?php elseif ($step === 'fix'): ?>

                <h2>Fixing Location Rules...</h2>

                <?php
                // Mapping of wrong → correct block names
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
                $fixed = 0;

                foreach ($all_groups as $group) {
                    $is_local = isset($group['local']) && $group['local'] === 'php';

                    if (!$is_local && isset($group['location'][0][0]['value'])) {
                        $current_location = $group['location'][0][0]['value'];

                        // Check if this needs fixing
                        if (isset($block_name_fixes[$current_location])) {
                            // Update the location rule
                            $group['location'][0][0]['value'] = $block_name_fixes[$current_location];

                            // Update the field group
                            acf_update_field_group($group);

                            echo '<div class="success">✓ Fixed: ' . esc_html($group['title']) . '<br>';
                            echo 'Changed <code>' . esc_html($current_location) . '</code> → <code>' . esc_html($block_name_fixes[$current_location]) . '</code></div>';
                            $fixed++;
                        }
                    }
                }
                ?>

                <h2>✅ Location Rules Fixed!</h2>

                <div class="success">
                    <strong>Updated <?php echo $fixed; ?> field group location rules.</strong><br>
                    Field groups now point to the correct block names.
                </div>

                <h2>Testing the Fix</h2>

                <div class="info">
                    <strong>Verify everything works:</strong>
                    <ol>
                        <li><strong>Check ACF Admin:</strong> Go to Custom Fields → Field Groups<br>
                            ✓ You should see all 13 field groups</li>
                        <li><strong>Edit a page:</strong> Go to Pages → Edit "Galerie & 3D"<br>
                            ✓ You should see blocks in the editor</li>
                        <li><strong>Click a block:</strong> Click on the "Galerie" block<br>
                            ✓ Fields should appear in right sidebar</li>
                        <li><strong>Fill in fields:</strong> Add title, select images<br>
                            ✓ Fields should save correctly</li>
                        <li><strong>View page:</strong> Visit the page on frontend<br>
                            ✓ Content should display</li>
                    </ol>
                </div>

                <div class="warning">
                    <strong>⚠️ Important Note:</strong><br>
                    Since both database AND local field groups are now active, you may see duplicates.<br>
                    We need to disable local field groups in inc/acf.php to avoid conflicts.
                </div>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="<?php echo admin_url('edit.php?post_type=acf-field-group'); ?>" class="btn">View Field Groups</a>
                    <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" class="btn">Edit Pages</a>
                    <a href="disable-local-field-groups.php" class="btn btn-danger">Disable Local Field Groups</a>
                </div>

            <?php endif; ?>

        </div>
    </div>
</body>
</html>
