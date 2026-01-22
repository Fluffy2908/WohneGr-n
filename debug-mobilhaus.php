<?php
/**
 * Debug script to check Mobilhaus CPT posts
 */

// Load WordPress
$wp_load_path = dirname(__FILE__) . '/../../../../../../wp-load.php';
if (!file_exists($wp_load_path)) {
    $wp_load_path = dirname(__FILE__) . '/../../../wp-load.php';
}

if (!file_exists($wp_load_path)) {
    die('Cannot find wp-load.php');
}

require_once($wp_load_path);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Mobilhaus CPT Debug</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; }
        h1 { color: #2d5016; }
        .post-card { background: #f9f9f9; padding: 15px; margin: 15px 0; border-left: 4px solid #2d5016; }
        .post-title { font-size: 1.5rem; font-weight: bold; color: #333; margin-bottom: 10px; }
        .post-meta { color: #666; font-size: 0.9rem; margin-bottom: 10px; }
        .field-list { margin-top: 10px; }
        .field-item { padding: 5px 0; border-bottom: 1px solid #e0e0e0; }
        .field-label { font-weight: bold; color: #555; display: inline-block; width: 200px; }
        .field-value { color: #333; }
        .status-publish { color: green; font-weight: bold; }
        .status-draft { color: orange; font-weight: bold; }
        .empty { color: #999; font-style: italic; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🏡 Mobilhaus CPT Posts Debug</h1>

        <?php
        $args = array(
            'post_type' => 'mobilhaus',
            'posts_per_page' => -1,
            'post_status' => array('publish', 'draft', 'pending'),
            'orderby' => 'title',
            'order' => 'ASC',
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            echo '<p><strong>Found ' . $query->post_count . ' Mobilhaus posts:</strong></p>';

            while ($query->have_posts()) {
                $query->the_post();
                $post_id = get_the_ID();

                echo '<div class="post-card">';
                echo '<div class="post-title">' . get_the_title() . '</div>';
                echo '<div class="post-meta">';
                echo 'ID: ' . $post_id . ' | ';
                echo 'Status: <span class="status-' . get_post_status() . '">' . strtoupper(get_post_status()) . '</span> | ';
                echo 'Permalink: <a href="' . get_permalink() . '" target="_blank">' . get_permalink() . '</a>';
                echo '</div>';

                // Check for ACF fields
                echo '<div class="field-list">';
                echo '<h3>ACF Fields (block_ prefix):</h3>';

                $fields_to_check = array(
                    'block_model_tagline',
                    'block_model_badge',
                    'block_model_type',
                    'block_model_size',
                    'block_model_rooms',
                    'block_model_persons',
                    'block_model_price',
                    'block_model_card_image',
                    'block_model_highlights',
                );

                foreach ($fields_to_check as $field) {
                    $value = get_field($field, $post_id);
                    $display_value = '';

                    if (empty($value)) {
                        $display_value = '<span class="empty">(empty)</span>';
                    } elseif (is_array($value)) {
                        if (isset($value['url'])) {
                            $display_value = '<img src="' . $value['url'] . '" style="max-width: 100px; height: auto;">';
                        } else {
                            $display_value = 'Array (' . count($value) . ' items)';
                        }
                    } else {
                        $display_value = htmlspecialchars($value);
                    }

                    echo '<div class="field-item">';
                    echo '<span class="field-label">' . $field . ':</span>';
                    echo '<span class="field-value">' . $display_value . '</span>';
                    echo '</div>';
                }

                // Check for featured image
                echo '<div class="field-item">';
                echo '<span class="field-label">Featured Image:</span>';
                if (has_post_thumbnail()) {
                    echo '<span class="field-value">' . get_the_post_thumbnail($post_id, 'thumbnail') . '</span>';
                } else {
                    echo '<span class="field-value empty">(no featured image)</span>';
                }
                echo '</div>';

                // Check excerpt
                echo '<div class="field-item">';
                echo '<span class="field-label">Excerpt:</span>';
                echo '<span class="field-value">' . (get_the_excerpt() ?: '<span class="empty">(no excerpt)</span>') . '</span>';
                echo '</div>';

                echo '</div>'; // .field-list
                echo '</div>'; // .post-card
            }
            wp_reset_postdata();
        } else {
            echo '<p style="color: red; font-weight: bold;">❌ No Mobilhaus posts found!</p>';
            echo '<p>Please create posts in WordPress Admin → Mobilhauser → Add New</p>';
        }
        ?>

        <hr style="margin: 30px 0;">
        <p><a href="<?php echo admin_url('edit.php?post_type=mobilhaus'); ?>" target="_blank">→ Go to Mobilhaus Posts in Admin</a></p>
        <p><a href="<?php echo admin_url('post-new.php?post_type=mobilhaus'); ?>" target="_blank">→ Add New Mobilhaus Post</a></p>
    </div>
</body>
</html>
