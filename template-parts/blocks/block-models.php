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
            'title' => 'Nature',
            'tagline' => 'Natürliches Wohnen im Einklang mit der Natur',
            'description' => 'Das Nature Modell verbindet zeitloses Design mit natürlichen Materialien. Warme Holztöne und organische Texturen schaffen eine gemütliche Atmosphäre, die perfekt für Familien und Naturliebhaber ist.',
            'badge' => 'Beliebt',
            'badge_class' => '',
            'size' => '24-32 m²',
            'type' => 'Kompakt & Funktional',
            'persons' => '2-4',
            'link' => home_url('/models/nature'),
            'image' => get_template_directory_uri() . '/assets/images/model-nature-exterior.jpg',
            'highlights' => array(
                '8 Farbschemata verfügbar',
                '3×8m oder 4×8m Konfiguration',
                'Natürliche Materialien',
                'Funktionales Design',
            ),
        ),
        array(
            'title' => 'Pure',
            'tagline' => 'Minimalistisches Design mit maximalem Komfort',
            'description' => 'Das Pure Modell steht für zeitgenössisches Design und klare Linien. Mit elegantem Marmor, Beton und modernen Oberflächen bietet es ein luxuriöses Wohngefühl für anspruchsvolle Kunden.',
            'badge' => 'Premium',
            'badge_class' => 'model-badge-premium',
            'size' => '24-32 m²',
            'type' => 'Premium & Modern',
            'persons' => '2-4',
            'link' => home_url('/models/pure'),
            'image' => get_template_directory_uri() . '/assets/images/model-pure-exterior.jpg',
            'highlights' => array(
                '8 exklusive Farbschemata',
                '3×8m oder 4×8m Premium',
                'Marmor & Beton Optionen',
                'Panorama-Fenster',
            ),
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
        <div class="featured-models-grid">
            <?php foreach ($models as $model) : ?>
                <div class="featured-model-card">
                    <div class="featured-model-image">
                        <?php if (!empty($model['image'])) : ?>
                            <?php if (is_array($model['image']) && isset($model['image']['url'])) : ?>
                                <img src="<?php echo esc_url($model['image']['url']); ?>" alt="WohneGrün <?php echo esc_attr($model['title']); ?> Model" loading="lazy">
                            <?php elseif (is_array($model['image']) && isset($model['image'][0])) : ?>
                                <img src="<?php echo esc_url($model['image'][0]); ?>" alt="WohneGrün <?php echo esc_attr($model['title']); ?> Model" loading="lazy">
                            <?php elseif (is_string($model['image'])) : ?>
                                <img src="<?php echo esc_url($model['image']); ?>" alt="WohneGrün <?php echo esc_attr($model['title']); ?> Model" loading="lazy">
                            <?php endif; ?>
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/model-placeholder.jpg" alt="<?php echo esc_attr($model['title']); ?>" loading="lazy">
                        <?php endif; ?>
                        <?php if (!empty($model['badge'])) : ?>
                            <div class="model-badge <?php echo !empty($model['badge_class']) ? esc_attr($model['badge_class']) : ''; ?>"><?php echo esc_html($model['badge']); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="featured-model-content">
                        <h3><?php echo esc_html($model['title']); ?></h3>
                        <?php if (!empty($model['tagline'])) : ?>
                            <p class="model-tagline"><?php echo esc_html($model['tagline']); ?></p>
                        <?php endif; ?>
                        <p class="model-description">
                            <?php echo esc_html($model['description']); ?>
                        </p>

                        <?php if (!empty($model['highlights'])) : ?>
                            <div class="model-highlights">
                                <?php foreach ($model['highlights'] as $highlight) : ?>
                                    <div class="model-highlight">
                                        <?php echo wohnegruen_get_icon('check'); ?>
                                        <span><?php echo esc_html($highlight); ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <div class="model-specs-grid">
                            <div class="model-spec-item">
                                <?php echo wohnegruen_get_icon('size'); ?>
                                <div>
                                    <span class="spec-label">Größe</span>
                                    <span class="spec-value"><?php echo esc_html($model['size']); ?></span>
                                </div>
                            </div>
                            <div class="model-spec-item">
                                <?php echo wohnegruen_get_icon('home'); ?>
                                <div>
                                    <span class="spec-label">Typ</span>
                                    <span class="spec-value"><?php echo esc_html(!empty($model['type']) ? $model['type'] : 'Mobilhaus'); ?></span>
                                </div>
                            </div>
                            <div class="model-spec-item">
                                <?php echo wohnegruen_get_icon('users'); ?>
                                <div>
                                    <span class="spec-label">Ideal für</span>
                                    <span class="spec-value"><?php echo esc_html($model['persons']); ?> Personen</span>
                                </div>
                            </div>
                        </div>

                        <a href="<?php echo esc_url($model['link'] ?: '#'); ?>" class="btn btn-primary btn-block">
                            <?php echo esc_html($model['title']); ?> entdecken
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
