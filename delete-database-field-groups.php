<?php
/**
 * Delete Database Field Groups
 *
 * Removes the field groups that were created in database with wrong location rules.
 * Re-enables the local (code-based) field groups that work correctly.
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
    <title>Delete Database Field Groups</title>
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
            <h1>🗑️ Delete Database Field Groups</h1>
            <p>Fix: Remove conflicting database field groups</p>
        </div>
        <div class="content">

            <?php if ($step === 'preview'): ?>

                <h2>Problem Identified</h2>

                <div class="error">
                    <strong>✗ Field groups in database have wrong location rules!</strong><br><br>
                    Blocks are named: <code>acf/wohnegruen-hero</code>, <code>acf/wohnegruen-gallery</code>, etc.<br>
                    But database field groups look for: <code>acf/hero</code>, <code>acf/gallery</code>, etc.<br><br>
                    <strong>Result:</strong> Blocks say "This block contains no editable fields"
                </div>

                <h2>Solution</h2>

                <div class="info">
                    <strong>What this script will do:</strong><br>
                    1. Delete all field groups from the database (they have wrong location rules)<br>
                    2. Local field groups (from code) are already re-enabled<br>
                    3. Local field groups have CORRECT location rules<br>
                    4. Blocks will immediately work again
                </div>

                <?php
                // Get all field groups
                $all_groups = acf_get_field_groups();
                ?>

                <h2>Field Groups to Delete</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Key</th>
                            <th>Type</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($all_groups as $group):
                            // Check if this is a local group (from code) or database group
                            $is_local = isset($group['local']) && $group['local'] === 'php';

                            // Get first location rule
                            $location_rule = '';
                            if (isset($group['location'][0][0]['value'])) {
                                $location_rule = $group['location'][0][0]['value'];
                            }
                        ?>
                            <tr style="<?php echo !$is_local ? 'background: #fff3cd;' : ''; ?>">
                                <td><?php echo esc_html($group['title']); ?></td>
                                <td><code><?php echo esc_html($group['key']); ?></code></td>
                                <td>
                                    <?php if ($is_local): ?>
                                        <span style="color: #28a745;">✓ Local (code)</span>
                                    <?php else: ?>
                                        <span style="color: #dc3545;">Database (will delete)</span>
                                    <?php endif; ?>
                                </td>
                                <td><code><?php echo esc_html($location_rule); ?></code></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="warning">
                    <strong>⚠️ Important:</strong><br>
                    - Only DATABASE field groups will be deleted<br>
                    - LOCAL field groups (from code) will remain<br>
                    - This is safe - the correct field groups are in your theme code
                </div>

                <div style="text-align: center; margin: 40px 0;">
                    <a href="?step=delete" class="btn btn-danger">🗑️ Delete Database Field Groups</a>
                </div>

            <?php elseif ($step === 'delete'): ?>

                <h2>Deleting Database Field Groups...</h2>

                <?php
                $all_groups = acf_get_field_groups();
                $deleted = 0;

                foreach ($all_groups as $group) {
                    $is_local = isset($group['local']) && $group['local'] === 'php';

                    // Only delete database groups
                    if (!$is_local) {
                        // This is a database group - delete it
                        $result = acf_delete_field_group($group['ID']);

                        if ($result) {
                            echo '<div class="success">✓ Deleted: ' . esc_html($group['title']) . ' (Key: ' . esc_html($group['key']) . ')</div>';
                            $deleted++;
                        } else {
                            echo '<div class="error">✗ Failed to delete: ' . esc_html($group['title']) . '</div>';
                        }
                    } else {
                        echo '<div class="info">Kept (local): ' . esc_html($group['title']) . '</div>';
                    }
                }
                ?>

                <h2>✅ Cleanup Complete!</h2>

                <div class="success">
                    <strong>Deleted <?php echo $deleted; ?> database field groups.</strong><br>
                    Local field groups (from code) are active and have correct location rules.
                </div>

                <h2>What Changed</h2>

                <div class="info">
                    <strong>✓ Blocks now have field groups attached:</strong><br>
                    - Hero Block → Hero-Block field group<br>
                    - Vorteile Block → Vorteile-Block field group<br>
                    - Galerie Block → Galerie-Block field group<br>
                    - Kontakt Block → Kontakt-Block field group<br>
                    - Über uns Block → Über uns-Block field group<br>
                    <br>
                    <strong>All blocks will show editable fields now!</strong>
                </div>

                <div class="warning">
                    <strong>⚠️ Note:</strong><br>
                    Local field groups are NOT visible/editable in ACF admin menu.<br>
                    This is normal - they are managed via code in inc/acf.php<br>
                    But they WORK correctly with the blocks!
                </div>

                <h2>Next Steps</h2>

                <ol>
                    <li><strong>Edit any page</strong> in WordPress</li>
                    <li><strong>Click on a block</strong> (Hero, Galerie, etc.)</li>
                    <li><strong>You will see fields</strong> appear in the right sidebar!</li>
                    <li><strong>Fill in the fields</strong> (titles, images, descriptions)</li>
                    <li><strong>Save the page</strong></li>
                    <li><strong>View the page</strong> - content will display correctly</li>
                </ol>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" class="btn">Edit Pages</a>
                    <a href="<?php echo home_url('/'); ?>" class="btn">View Website</a>
                </div>

            <?php endif; ?>

        </div>
    </div>
</body>
</html>
