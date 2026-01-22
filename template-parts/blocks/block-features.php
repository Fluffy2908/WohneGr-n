<?php
/**
 * Block Template: Features
 */

$title = get_field('features_title') ?: '';
$subtitle = get_field('features_subtitle') ?: '';
$features = get_field('features_items');

$block_id = isset($block['anchor']) ? $block['anchor'] : 'vorteile';
?>

<section class="features-section section-padding" id="<?php echo esc_attr($block_id); ?>">
    <div class="container">
        <div class="section-header">
            <h2><?php echo esc_html($title); ?></h2>
            <p><?php echo esc_html($subtitle); ?></p>
        </div>
        <div class="features-grid">
            <?php if ($features) : ?>
                <?php foreach ($features as $feature) : ?>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <?php echo wohnegruen_get_icon($feature['icon']); ?>
                        </div>
                        <h3><?php echo esc_html($feature['title']); ?></h3>
                        <p><?php echo esc_html($feature['text']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
