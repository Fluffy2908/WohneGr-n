<?php
/**
 * Block: Gallery Complete (All-in-One for Galerie page)
 * Modern Lovable-style gallery with Hosekra position/room filters
 */

// Get all fields
$hero_title = get_field('gallery_hero_title');
$hero_subtitle = get_field('gallery_hero_subtitle');
$gallery_categories = get_field('gallery_categories');
$show_filters = get_field('gallery_show_filters');

$block_id = 'gallery-complete-' . $block['id'];
?>

<div class="gallery-complete-page" id="<?php echo esc_attr($block_id); ?>">

    <!-- Hero Section - Lovable Style -->
    <section class="gallery-hero">
        <div class="container">
            <div class="hero-content">
                <?php if ($hero_title): ?>
                    <h1><?php echo esc_html($hero_title); ?></h1>
                <?php endif; ?>
                <?php if ($hero_subtitle): ?>
                    <p class="hero-subtitle"><?php echo esc_html($hero_subtitle); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Gallery Section with Hosekra-style Position Filters -->
    <?php if ($gallery_categories && is_array($gallery_categories)): ?>
    <section class="gallery-main section-padding">
        <div class="container">

            <!-- Position/Room Filters (Hosekra-style) -->
            <?php if ($show_filters && count($gallery_categories) > 1): ?>
            <div class="gallery-filters">
                <button class="filter-btn active" data-filter="all">
                    <span class="filter-icon">🏠</span>
                    <span>Alle Ansichten</span>
                </button>
                <?php foreach ($gallery_categories as $index => $category): ?>
                    <?php
                    // Map category names to icons
                    $icons = [
                        'Außenansicht' => '🏡',
                        'Innenansicht' => '🏠',
                        'Küche' => '🍳',
                        'Schlafzimmer' => '🛏️',
                        'Badezimmer' => '🚿',
                        'Wohnzimmer' => '🛋️',
                        'Grundriss' => '📐',
                    ];
                    $icon = $icons[$category['category_name']] ?? '📷';
                    ?>
                    <button class="filter-btn" data-filter="cat-<?php echo $index; ?>">
                        <span class="filter-icon"><?php echo $icon; ?></span>
                        <span><?php echo esc_html($category['category_name']); ?></span>
                    </button>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- Gallery Grid - Modern Lovable Design -->
            <div class="gallery-grid">
                <?php foreach ($gallery_categories as $cat_index => $category): ?>
                    <?php if (isset($category['images']) && is_array($category['images'])): ?>
                        <?php foreach ($category['images'] as $img_index => $image): ?>
                            <div class="gallery-item" data-category="cat-<?php echo $cat_index; ?>" data-all="all">
                                <div class="gallery-image-wrapper">
                                    <img src="<?php echo esc_url($image['sizes']['large'] ?? $image['url']); ?>"
                                         alt="<?php echo esc_attr($image['alt'] ?: $category['category_name']); ?>"
                                         data-full="<?php echo esc_url($image['url']); ?>"
                                         loading="lazy">

                                    <!-- Hosekra-style Position Badge -->
                                    <div class="position-badge">
                                        <?php echo esc_html($category['category_name']); ?>
                                    </div>

                                    <!-- Lovable-style Overlay -->
                                    <div class="gallery-overlay">
                                        <button class="gallery-expand"
                                                onclick="openGalleryLightbox('<?php echo esc_js($block['id']); ?>', <?php echo $cat_index; ?>, <?php echo $img_index; ?>)">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"></path>
                                            </svg>
                                            <span>Vergrößern</span>
                                        </button>
                                    </div>
                                </div>

                                <?php if ($image['caption']): ?>
                                    <p class="gallery-caption"><?php echo esc_html($image['caption']); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

        </div>
    </section>
    <?php endif; ?>

    <!-- Lightbox - Modern Design -->
    <div class="gallery-lightbox" id="gallery-lightbox-<?php echo esc_attr($block['id']); ?>" onclick="closeLightbox('<?php echo esc_attr($block['id']); ?>')">
        <button class="lightbox-close" onclick="closeLightbox('<?php echo esc_attr($block['id']); ?>')">&times;</button>
        <button class="lightbox-prev" onclick="event.stopPropagation(); navigateLightbox('<?php echo esc_attr($block['id']); ?>', -1)">‹</button>
        <img class="lightbox-content" id="lightbox-img-<?php echo esc_attr($block['id']); ?>" src="" alt="" onclick="event.stopPropagation();">
        <button class="lightbox-next" onclick="event.stopPropagation(); navigateLightbox('<?php echo esc_attr($block['id']); ?>', 1)">›</button>
        <p class="lightbox-caption" id="lightbox-caption-<?php echo esc_attr($block['id']); ?>"></p>
        <div class="lightbox-counter" id="lightbox-counter-<?php echo esc_attr($block['id']); ?>"></div>
    </div>

</div>

<style>
/* Modern Lovable-style Gallery */
.gallery-complete-page {
    width: 100%;
}

.section-padding {
    padding: 80px 0;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Hero - Lovable Style (Minimal & Clean) */
.gallery-hero {
    padding: 120px 0 80px;
    background: linear-gradient(135deg, var(--color-background) 0%, #ffffff 100%);
}

.hero-content {
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
}

.hero-content h1 {
    font-size: 3.5rem;
    font-weight: 800;
    color: var(--color-foreground);
    margin: 0 0 20px 0;
    letter-spacing: -0.02em;
}

.hero-subtitle {
    font-size: 1.25rem;
    color: var(--color-text-secondary);
    line-height: 1.7;
}

/* Position/Room Filters - Hosekra Style */
.gallery-filters {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 12px;
    margin-bottom: 60px;
    padding: 20px;
    background: var(--color-white);
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
}

.filter-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    border: 2px solid var(--color-border);
    background: var(--color-white);
    color: var(--color-text-primary);
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: inherit;
}

.filter-btn:hover {
    border-color: var(--color-primary);
    background: var(--color-background);
    transform: translateY(-2px);
}

.filter-btn.active {
    background: var(--color-primary);
    color: white;
    border-color: var(--color-primary);
    box-shadow: 0 4px 12px rgba(var(--color-primary-rgb), 0.3);
}

.filter-icon {
    font-size: 1.25rem;
}

/* Gallery Grid - Modern Masonry-style */
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 24px;
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.gallery-item {
    opacity: 1;
    transition: all 0.3s ease;
}

.gallery-item[style*="display: none"] {
    opacity: 0;
    pointer-events: none;
}

.gallery-image-wrapper {
    position: relative;
    aspect-ratio: 4 / 3;
    border-radius: 16px;
    overflow: hidden;
    background: var(--color-background);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}

.gallery-image-wrapper:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
}

.gallery-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.gallery-image-wrapper:hover img {
    transform: scale(1.05);
}

/* Hosekra-style Position Badge */
.position-badge {
    position: absolute;
    top: 16px;
    left: 16px;
    padding: 8px 16px;
    background: rgba(var(--color-primary-rgb), 0.95);
    color: white;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    z-index: 2;
}

/* Lovable-style Overlay */
.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.7) 100%);
    display: flex;
    align-items: flex-end;
    justify-content: center;
    padding: 24px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.gallery-image-wrapper:hover .gallery-overlay {
    opacity: 1;
}

.gallery-expand {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background: white;
    color: var(--color-foreground);
    border: none;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    font-family: inherit;
}

.gallery-expand:hover {
    background: var(--color-primary);
    color: white;
    transform: scale(1.05);
}

.gallery-expand svg {
    width: 18px;
    height: 18px;
}

.gallery-caption {
    margin-top: 12px;
    font-size: 0.875rem;
    color: var(--color-text-secondary);
    text-align: center;
}

/* Modern Lightbox */
.gallery-lightbox {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.95);
    z-index: 10000;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

.lightbox-close {
    position: absolute;
    top: 24px;
    right: 24px;
    width: 48px;
    height: 48px;
    font-size: 32px;
    color: white;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    cursor: pointer;
    z-index: 10001;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: inherit;
}

.lightbox-close:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: rotate(90deg);
}

.lightbox-content {
    max-width: 90%;
    max-height: 85vh;
    object-fit: contain;
    border-radius: 8px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
}

.lightbox-prev,
.lightbox-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 56px;
    height: 56px;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    cursor: pointer;
    font-size: 32px;
    color: white;
    z-index: 10001;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: inherit;
}

.lightbox-prev {
    left: 40px;
}

.lightbox-next {
    right: 40px;
}

.lightbox-prev:hover,
.lightbox-next:hover {
    background: var(--color-primary);
    border-color: var(--color-primary);
    transform: translateY(-50%) scale(1.1);
}

.lightbox-caption {
    position: absolute;
    bottom: 40px;
    left: 50%;
    transform: translateX(-50%);
    color: white;
    font-size: 1rem;
    background: rgba(0, 0, 0, 0.7);
    padding: 12px 24px;
    border-radius: 8px;
    max-width: 80%;
    text-align: center;
}

.lightbox-counter {
    position: absolute;
    top: 24px;
    left: 50%;
    transform: translateX(-50%);
    color: white;
    font-size: 0.875rem;
    background: rgba(0, 0, 0, 0.5);
    padding: 8px 20px;
    border-radius: 50px;
    font-weight: 600;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-content h1 {
        font-size: 2.5rem;
    }

    .gallery-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 16px;
    }

    .gallery-filters {
        gap: 8px;
        padding: 16px;
    }

    .filter-btn {
        padding: 10px 16px;
        font-size: 0.8rem;
    }

    .lightbox-prev,
    .lightbox-next {
        width: 44px;
        height: 44px;
        font-size: 24px;
    }

    .lightbox-prev {
        left: 16px;
    }

    .lightbox-next {
        right: 16px;
    }
}

@media (max-width: 480px) {
    .gallery-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
// Store gallery data
window.galleryData = window.galleryData || {};

document.addEventListener('DOMContentLoaded', function() {
    const blockId = '<?php echo esc_js($block['id']); ?>';
    const galleryBlock = document.getElementById('gallery-complete-<?php echo esc_js($block['id']); ?>');

    if (!galleryBlock) return;

    // Store gallery images
    const allImages = [];
    <?php foreach ($gallery_categories as $cat_index => $category): ?>
        <?php if (isset($category['images']) && is_array($category['images'])): ?>
            <?php foreach ($category['images'] as $img_index => $image): ?>
                allImages.push({
                    url: '<?php echo esc_js($image['url']); ?>',
                    caption: '<?php echo esc_js($image['caption'] ?? ''); ?>',
                    catIndex: <?php echo $cat_index; ?>,
                    imgIndex: <?php echo $img_index; ?>
                });
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endforeach; ?>

    window.galleryData[blockId] = {
        images: allImages,
        currentIndex: 0
    };

    // Filter functionality
    const filterBtns = galleryBlock.querySelectorAll('.filter-btn');
    const galleryItems = galleryBlock.querySelectorAll('.gallery-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.dataset.filter;

            // Update active button
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            // Filter items
            galleryItems.forEach(item => {
                if (filter === 'all' || item.dataset.category === filter) {
                    item.style.display = '';
                    setTimeout(() => item.style.opacity = '1', 10);
                } else {
                    item.style.opacity = '0';
                    setTimeout(() => item.style.display = 'none', 300);
                }
            });
        });
    });
});

// Lightbox functions
function openGalleryLightbox(blockId, catIndex, imgIndex) {
    const gallery = window.galleryData[blockId];
    if (!gallery) return;

    // Find the correct index in allImages array
    const imageIndex = gallery.images.findIndex(img =>
        img.catIndex === catIndex && img.imgIndex === imgIndex
    );

    if (imageIndex === -1) return;

    gallery.currentIndex = imageIndex;
    const image = gallery.images[imageIndex];

    const lightbox = document.getElementById(`gallery-lightbox-${blockId}`);
    const img = document.getElementById(`lightbox-img-${blockId}`);
    const caption = document.getElementById(`lightbox-caption-${blockId}`);
    const counter = document.getElementById(`lightbox-counter-${blockId}`);

    img.src = image.url;
    caption.textContent = image.caption;
    counter.textContent = `${imageIndex + 1} / ${gallery.images.length}`;

    lightbox.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeLightbox(blockId) {
    document.getElementById(`gallery-lightbox-${blockId}`).style.display = 'none';
    document.body.style.overflow = 'auto';
}

function navigateLightbox(blockId, direction) {
    const gallery = window.galleryData[blockId];
    if (!gallery) return;

    gallery.currentIndex += direction;

    if (gallery.currentIndex < 0) {
        gallery.currentIndex = gallery.images.length - 1;
    } else if (gallery.currentIndex >= gallery.images.length) {
        gallery.currentIndex = 0;
    }

    const image = gallery.images[gallery.currentIndex];
    const img = document.getElementById(`lightbox-img-${blockId}`);
    const caption = document.getElementById(`lightbox-caption-${blockId}`);
    const counter = document.getElementById(`lightbox-counter-${blockId}`);

    img.style.opacity = '0';
    setTimeout(() => {
        img.src = image.url;
        caption.textContent = image.caption;
        counter.textContent = `${gallery.currentIndex + 1} / ${gallery.images.length}`;
        img.style.opacity = '1';
    }, 150);
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const openLightbox = document.querySelector('.gallery-lightbox[style*="display: flex"]');
    if (!openLightbox) return;

    const blockId = openLightbox.id.replace('gallery-lightbox-', '');

    if (e.key === 'Escape') {
        closeLightbox(blockId);
    } else if (e.key === 'ArrowLeft') {
        navigateLightbox(blockId, -1);
    } else if (e.key === 'ArrowRight') {
        navigateLightbox(blockId, 1);
    }
});
</script>
