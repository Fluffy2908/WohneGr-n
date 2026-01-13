<?php
/**
 * Template Name: Gallery
 * Gallery page template with category filtering and lightbox
 */

get_header();

// Get gallery settings from ACF
$gallery_title = wohnegruen_get_field('gallery_title', false, 'Unsere');
$gallery_title_highlight = wohnegruen_get_field('gallery_title_highlight', false, 'Galerie');
$gallery_subtitle = wohnegruen_get_field('gallery_subtitle', false, 'Entdecken Sie unsere Mobilheime in beeindruckenden Bildern');

// Get gallery images from ACF or use defaults
$gallery_images = get_field('gallery_images');
$gallery_categories = array('Alle', 'Außenansicht', 'Innenausstattung', 'Terrasse');
?>

<!-- Gallery Hero Section -->
<section class="gallery-hero">
    <div class="gallery-hero-background">
        <?php
        $gallery_hero_bg = get_field('gallery_hero_image');
        if ($gallery_hero_bg) : ?>
            <img src="<?php echo esc_url($gallery_hero_bg['url']); ?>" alt="<?php echo esc_attr($gallery_hero_bg['alt']); ?>">
        <?php else : ?>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg.jpg" alt="Galerie Mobilheime">
        <?php endif; ?>
    </div>
    <div class="gallery-hero-content">
        <h1><?php echo esc_html($gallery_title); ?> <span class="text-primary"><?php echo esc_html($gallery_title_highlight); ?></span></h1>
        <p><?php echo esc_html($gallery_subtitle); ?></p>
    </div>
</section>

<!-- Gallery Section -->
<section class="gallery-section section-padding">
    <div class="container">
        <!-- Category Filter -->
        <div class="gallery-filters">
            <?php foreach ($gallery_categories as $category) : ?>
                <button class="gallery-filter-btn <?php echo $category === 'Alle' ? 'active' : ''; ?>" data-filter="<?php echo esc_attr($category); ?>">
                    <?php echo esc_html($category); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Image Grid -->
        <div class="gallery-grid">
            <?php if ($gallery_images) :
                foreach ($gallery_images as $index => $image) : ?>
                    <div class="gallery-item" data-category="<?php echo esc_attr($image['category'] ?? 'Außenansicht'); ?>" data-index="<?php echo $index; ?>">
                        <img src="<?php echo esc_url($image['image']['url']); ?>" alt="<?php echo esc_attr($image['image']['alt'] ?: $image['title']); ?>">
                        <div class="gallery-item-overlay">
                            <p class="gallery-item-title"><?php echo esc_html($image['title']); ?></p>
                            <span class="gallery-item-category"><?php echo esc_html($image['category'] ?? 'Außenansicht'); ?></span>
                        </div>
                    </div>
                <?php endforeach;
            else :
                // Default gallery items
                $default_images = array(
                    array('src' => 'hero-bg.jpg', 'alt' => 'Mobilheim in alpiner Landschaft', 'category' => 'Außenansicht'),
                    array('src' => 'about.jpg', 'alt' => 'Modernes Wohnzimmer im Mobilheim', 'category' => 'Innenausstattung'),
                    array('src' => 'model-1.jpg', 'alt' => 'Kompaktes Mobilheim', 'category' => 'Außenansicht'),
                    array('src' => 'model-2.jpg', 'alt' => 'Luxus Mobilheim mit Terrasse', 'category' => 'Außenansicht'),
                    array('src' => 'about.jpg', 'alt' => 'Küche mit moderner Ausstattung', 'category' => 'Innenausstattung'),
                    array('src' => 'hero-bg.jpg', 'alt' => 'Mobilheim im Sonnenuntergang', 'category' => 'Außenansicht'),
                    array('src' => 'model-2.jpg', 'alt' => 'Terrasse mit Bergblick', 'category' => 'Terrasse'),
                    array('src' => 'model-1.jpg', 'alt' => 'Mobilheim im Grünen', 'category' => 'Außenansicht'),
                );
                foreach ($default_images as $index => $image) : ?>
                    <div class="gallery-item" data-category="<?php echo esc_attr($image['category']); ?>" data-index="<?php echo $index; ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/<?php echo esc_attr($image['src']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                        <div class="gallery-item-overlay">
                            <p class="gallery-item-title"><?php echo esc_html($image['alt']); ?></p>
                            <span class="gallery-item-category"><?php echo esc_html($image['category']); ?></span>
                        </div>
                    </div>
                <?php endforeach;
            endif; ?>
        </div>
    </div>
</section>

<!-- Lightbox -->
<div class="gallery-lightbox" id="gallery-lightbox">
    <button class="lightbox-close" aria-label="Schließen">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
    <button class="lightbox-nav lightbox-prev" aria-label="Vorheriges Bild">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>
    <button class="lightbox-nav lightbox-next" aria-label="Nächstes Bild">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </button>
    <div class="lightbox-content">
        <img src="" alt="" id="lightbox-image">
    </div>
    <div class="lightbox-caption">
        <p id="lightbox-title"></p>
        <span id="lightbox-counter"></span>
    </div>
</div>

<?php get_footer(); ?>
