<?php
/**
 * Block Template: Gallery
 */

$title = get_field('gallery_title') ?: 'Galerie';
$subtitle = get_field('gallery_subtitle') ?: 'Entdecken Sie unsere Mobilhäuser.';
$show_filters = get_field('gallery_show_filters');
$images = get_field('gallery_images');

$block_id = isset($block['anchor']) ? $block['anchor'] : 'galerie';

// Get unique categories
$categories = array();
if ($images) {
    foreach ($images as $img) {
        if (!empty($img['category']) && !in_array($img['category'], $categories)) {
            $categories[] = $img['category'];
        }
    }
}

$category_labels = array(
    'außenbereich' => 'Außenbereich',
    'innenbereich' => 'Innenbereich',
    'terrasse' => 'Terrasse',
    'details' => 'Details',
);
?>

<section class="gallery-section section-padding" id="<?php echo esc_attr($block_id); ?>">
    <div class="container">
        <div class="section-header">
            <h2><?php echo esc_html($title); ?></h2>
            <p><?php echo esc_html($subtitle); ?></p>
        </div>

        <?php if ($show_filters && !empty($categories)) : ?>
            <div class="gallery-filters">
                <button class="gallery-filter-btn active" data-filter="Alle">Alle</button>
                <?php foreach ($categories as $cat) : ?>
                    <button class="gallery-filter-btn" data-filter="<?php echo esc_attr($cat); ?>">
                        <?php echo esc_html($category_labels[$cat] ?? $cat); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="gallery-grid">
            <?php if ($images) : ?>
                <?php foreach ($images as $img) : ?>
                    <div class="gallery-item" data-category="<?php echo esc_attr($img['category'] ?? ''); ?>">
                        <img src="<?php echo esc_url($img['image']['sizes']['large'] ?? $img['image']['url']); ?>" alt="<?php echo esc_attr($img['title'] ?? ''); ?>">
                        <?php if (!empty($img['title'])) : ?>
                            <div class="gallery-item-overlay">
                                <span class="gallery-item-title"><?php echo esc_html($img['title']); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <!-- Placeholder images -->
                <?php for ($i = 1; $i <= 6; $i++) : ?>
                    <div class="gallery-item" data-category="außenbereich">
                        <div class="gallery-placeholder">
                            <?php echo alpenhomes_get_icon('home'); ?>
                            <span>Bild <?php echo $i; ?></span>
                        </div>
                    </div>
                <?php endfor; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Lightbox -->
    <div class="gallery-lightbox" id="gallery-lightbox">
        <button class="lightbox-close">&times;</button>
        <button class="lightbox-prev"><?php echo alpenhomes_get_icon('arrow-right'); ?></button>
        <button class="lightbox-next"><?php echo alpenhomes_get_icon('arrow-right'); ?></button>
        <div class="lightbox-content">
            <img id="lightbox-image" src="" alt="">
            <div class="lightbox-info">
                <span id="lightbox-title"></span>
                <span id="lightbox-counter"></span>
            </div>
        </div>
    </div>
</section>
