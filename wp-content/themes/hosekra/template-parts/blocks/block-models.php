<?php
/**
 * Block Template: Models
 */

$title = get_field('models_title') ?: 'Unsere Modelle';
$subtitle = get_field('models_subtitle') ?: 'Wählen Sie zwischen verschiedenen Größen und Ausstattungen.';
$source = get_field('models_source') ?: 'cpt';
$count = get_field('models_count') ?: 3;
$manual_models = get_field('models_items');
$cta_text = get_field('models_cta_text') ?: 'Alle Modelle ansehen';
$cta_link = get_field('models_cta_link') ?: '/modelle/';

$block_id = isset($block['anchor']) ? $block['anchor'] : 'modelle';

// Get models from CPT or manual
$models = array();

if ($source === 'cpt') {
    $args = array(
        'post_type' => 'mobilhaus',
        'posts_per_page' => $count,
        'post_status' => 'publish',
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $models[] = array(
                'title' => get_the_title(),
                'link' => get_permalink(),
                'image' => get_post_thumbnail_id() ? wp_get_attachment_image_src(get_post_thumbnail_id(), 'large') : null,
                'description' => get_the_excerpt(),
                'size' => get_field('model_size') ?: '45 m2',
                'rooms' => get_field('model_rooms') ?: '2',
                'persons' => get_field('model_persons') ?: '4',
                'price' => get_field('model_price') ?: '',
            );
        }
        wp_reset_postdata();
    }
} elseif ($manual_models) {
    $models = $manual_models;
}

// Fallback models
if (empty($models)) {
    $models = array(
        array(
            'title' => 'Alpin Kompakt',
            'description' => 'Perfekt für Paare oder als Ferienhaus.',
            'size' => '25 m²',
            'rooms' => '1',
            'persons' => '2',
            'price' => 'ab 39.900 EUR',
            'link' => '#',
        ),
        array(
            'title' => 'Alpin Comfort',
            'description' => 'Unser beliebtestes Modell mit optimaler Raumaufteilung.',
            'size' => '45 m²',
            'rooms' => '2',
            'persons' => '4',
            'price' => 'ab 59.900 EUR',
            'link' => '#',
        ),
        array(
            'title' => 'Alpin Premium',
            'description' => 'Luxuriöses Wohnen mit großer Terrasse und Premium-Ausstattung.',
            'size' => '65 m²',
            'rooms' => '3',
            'persons' => '6',
            'price' => 'ab 89.900 EUR',
            'link' => '#',
        ),
    );
}
?>

<section class="models-section section-padding" id="<?php echo esc_attr($block_id); ?>">
    <div class="container">
        <div class="section-header">
            <h2><?php echo esc_html($title); ?></h2>
            <p><?php echo esc_html($subtitle); ?></p>
        </div>
        <div class="models-grid">
            <?php foreach ($models as $model) : ?>
                <div class="model-card">
                    <div class="model-image">
                        <?php if (!empty($model['image'])) : ?>
                            <?php if (is_array($model['image']) && isset($model['image']['url'])) : ?>
                                <img src="<?php echo esc_url($model['image']['url']); ?>" alt="<?php echo esc_attr($model['title']); ?>">
                            <?php elseif (is_array($model['image'])) : ?>
                                <img src="<?php echo esc_url($model['image'][0]); ?>" alt="<?php echo esc_attr($model['title']); ?>">
                            <?php endif; ?>
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/model-placeholder.jpg" alt="<?php echo esc_attr($model['title']); ?>">
                        <?php endif; ?>
                        <?php if (!empty($model['price'])) : ?>
                            <div class="model-price"><?php echo esc_html($model['price']); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="model-content">
                        <h3><?php echo esc_html($model['title']); ?></h3>
                        <p><?php echo esc_html($model['description']); ?></p>
                        <div class="model-specs">
                            <div class="model-spec">
                                <?php echo wohnegruen_get_icon('size'); ?>
                                <span><?php echo esc_html($model['size']); ?></span>
                            </div>
                            <div class="model-spec">
                                <?php echo wohnegruen_get_icon('rooms'); ?>
                                <span><?php echo esc_html($model['rooms']); ?> Zimmer</span>
                            </div>
                            <div class="model-spec">
                                <?php echo wohnegruen_get_icon('users'); ?>
                                <span><?php echo esc_html($model['persons']); ?> Personen</span>
                            </div>
                        </div>
                        <a href="<?php echo esc_url($model['link'] ?: '#'); ?>" class="btn btn-primary">
                            Podrobnosti
                            <?php echo wohnegruen_get_icon('arrow-right'); ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if ($cta_text && $cta_link) : ?>
            <div class="models-cta">
                <a href="<?php echo esc_url($cta_link); ?>" class="btn btn-outline btn-lg">
                    <?php echo esc_html($cta_text); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>
