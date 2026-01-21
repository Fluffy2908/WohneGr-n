<?php
/**
 * Delete Old ACF Field Groups
 *
 * IMPORTANT: Run this ONCE, then delete this file!
 *
 * This script deletes the 6 old ACF field groups that were removed from the theme:
 * - 3D Rundgang-Block (group_block_3d_tour)
 * - Galerie mit Tabs Block (group_block_gallery_tabs)
 * - Galerie-Block (group_block_gallery)
 * - Grundrisse-Block (group_block_floor_plans)
 * - Innenausstattung-Block (group_block_interiors)
 * - Modell-Tabs Block (group_block_model_tabs)
 *
 * HOW TO RUN:
 * 1. Upload this file to your WordPress root directory (same folder as wp-config.php)
 * 2. Access it in your browser: https://yoursite.com/delete-old-acf-groups.php
 * 3. Check the output to confirm deletion
 * 4. DELETE THIS FILE immediately after running!
 */

// Load WordPress
require_once('wp-load.php');

// Security check - only run if logged in as admin
if (!is_user_logged_in() || !current_user_can('manage_options')) {
    die('ERROR: You must be logged in as an administrator to run this script.');
}

// List of old field group keys to delete
$old_field_groups = array(
    'group_block_3d_tour',
    'group_block_gallery_tabs',
    'group_block_gallery',
    'group_block_floor_plans',
    'group_block_interiors',
    'group_block_model_tabs',
    'group_block_model_colors',      // Orphaned: Farboptionen Block (replaced by Modell-Showcase)
    'group_block_model_hero_single', // Orphaned: Modell-Hero Block (replaced by Modell-Showcase)
);

echo '<html><head><title>Delete Old ACF Field Groups</title></head><body>';
echo '<h1>Deleting Old ACF Field Groups</h1>';
echo '<p>This will permanently delete the following field groups:</p>';
echo '<ul>';
foreach ($old_field_groups as $key) {
    echo '<li>' . esc_html($key) . '</li>';
}
echo '</ul>';
echo '<hr>';

$deleted_count = 0;
$errors = array();

foreach ($old_field_groups as $field_group_key) {
    // Find the post ID for this field group
    $posts = get_posts(array(
        'post_type' => 'acf-field-group',
        'posts_per_page' => 1,
        'post_status' => 'any',
        'meta_query' => array(
            array(
                'key' => 'key',
                'value' => $field_group_key,
                'compare' => '='
            )
        )
    ));

    if (!empty($posts)) {
        $post_id = $posts[0]->ID;
        $post_title = $posts[0]->post_title;

        // Find all fields belonging to this group
        $fields = get_posts(array(
            'post_type' => 'acf-field',
            'posts_per_page' => -1,
            'post_status' => 'any',
            'post_parent' => $post_id
        ));

        // Delete all fields
        $fields_deleted = 0;
        foreach ($fields as $field) {
            if (wp_delete_post($field->ID, true)) {
                $fields_deleted++;
            }
        }

        // Delete the field group
        if (wp_delete_post($post_id, true)) {
            echo '<p style="color: green;">✅ <strong>DELETED:</strong> ' . esc_html($post_title) . ' (Key: ' . esc_html($field_group_key) . ')</p>';
            echo '<p style="margin-left: 30px; color: #666;">→ Deleted ' . $fields_deleted . ' field(s)</p>';
            $deleted_count++;
        } else {
            $errors[] = "Failed to delete field group: $field_group_key";
            echo '<p style="color: red;">❌ <strong>ERROR:</strong> Could not delete ' . esc_html($field_group_key) . '</p>';
        }
    } else {
        echo '<p style="color: orange;">⚠️ <strong>NOT FOUND:</strong> ' . esc_html($field_group_key) . ' (already deleted or never existed)</p>';
    }
}

echo '<hr>';
echo '<h2>Summary</h2>';
echo '<p><strong>Field Groups Deleted:</strong> ' . $deleted_count . ' / ' . count($old_field_groups) . '</p>';

if (!empty($errors)) {
    echo '<h3 style="color: red;">Errors:</h3>';
    echo '<ul>';
    foreach ($errors as $error) {
        echo '<li>' . esc_html($error) . '</li>';
    }
    echo '</ul>';
} else {
    echo '<p style="color: green; font-weight: bold;">✅ All old field groups have been successfully deleted!</p>';
}

echo '<hr>';
echo '<h2>⚠️ IMPORTANT - Next Steps:</h2>';
echo '<ol>';
echo '<li><strong style="color: red;">DELETE THIS FILE (delete-old-acf-groups.php) IMMEDIATELY</strong> for security reasons</li>';
echo '<li>Go to <strong>ACF > Field Groups</strong> in WordPress admin to verify the groups are gone</li>';
echo '<li>Clear your WordPress cache if you\'re using a caching plugin</li>';
echo '<li>The old blocks will no longer appear in the Gutenberg block inserter</li>';
echo '</ol>';

echo '<p><a href="' . admin_url('edit.php?post_type=acf-field-group') . '" style="display: inline-block; padding: 10px 20px; background: #0073aa; color: white; text-decoration: none; border-radius: 4px; margin-top: 20px;">View ACF Field Groups</a></p>';

echo '</body></html>';
?>
