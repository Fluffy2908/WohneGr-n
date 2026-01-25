<?php
/**
 * Block: Gallery Complete (All-in-One for Galerie page)
 * Hero + Toggle Buttons (Bilder / 3D Grundrisse) + Gallery Grid + Slider + 3D Floor Plans
 */

$hero_title = get_field('gallery_hero_title');
$hero_image = get_field('gallery_hero_image');
$show_filters = get_field('gallery_show_filters');
$categories = get_field('gallery_categories');

$block_id = 'gallery-' . $block['id'];
?>

<div class="gallery-complete-page" id="<?php echo esc_attr($block_id); ?>">

    <!-- Hero Section with Background Image -->
    <section class="gallery-hero" style="<?php if ($hero_image): ?>background-image: url('<?php echo esc_url($hero_image['url']); ?>');<?php endif; ?>">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <?php if ($hero_title): ?>
                    <h1><?php echo esc_html($hero_title); ?></h1>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- GALLERY SECTION -->
    <?php if ($categories && is_array($categories)): ?>
    <section class="gallery-section section-padding">
        <div class="container">

            <!-- Filter Buttons (Simple Text Only) -->
            <?php if ($show_filters && count($categories) > 1): ?>
            <div class="gallery-filters">
                <button class="filter-btn active" data-filter="all">
                    <span class="filter-label">Alle</span>
                </button>
                <?php foreach ($categories as $index => $category): ?>
                    <button class="filter-btn" data-filter="cat-<?php echo $index; ?>">
                        <span class="filter-label"><?php echo esc_html($category['category_name']); ?></span>
                    </button>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- Gallery Grid (First 6 images) -->
            <div class="gallery-grid">
                <?php
                $all_images = [];
                foreach ($categories as $cat_index => $category):
                    if (isset($category['images']) && is_array($category['images'])):
                        foreach ($category['images'] as $image):
                            $all_images[] = [
                                'image' => $image,
                                'category' => 'cat-' . $cat_index,
                                'category_name' => $category['category_name']
                            ];
                        endforeach;
                    endif;
                endforeach;

                // Show first 9 images in grid
                $grid_images = array_slice($all_images, 0, 9);

                foreach ($grid_images as $img_index => $item):
                    $image = $item['image'];
                ?>
                    <div class="gallery-item" data-category="<?php echo esc_attr($item['category']); ?>" onclick="openGalleryLightbox(<?php echo $img_index; ?>)">
                        <img src="<?php echo esc_url($image['sizes']['large'] ?? $image['url']); ?>"
                             alt="<?php echo esc_attr($image['alt'] ?: $item['category_name']); ?>"
                             loading="lazy">
                        <div class="gallery-overlay">
                            <span class="zoom-icon">🔍</span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Show indicator for more images -->
            <?php if (count($all_images) > 9): ?>
            <div class="gallery-more-indicator" onclick="openGalleryLightbox(9)" role="button" tabindex="0" onkeypress="if(event.key==='Enter') openGalleryLightbox(9)">
                <p>+<?php echo count($all_images) - 9; ?> weitere Bilder in der Galerie</p>
                <p class="hint-text">Klicken Sie hier, um alle Bilder in der Galerie anzuzeigen</p>
            </div>
            <?php endif; ?>

        </div>
    </section>
    <?php endif; ?>

    <!-- Lightbox -->
    <div id="gallery-lightbox" class="gallery-lightbox" onclick="closeGalleryLightbox()">
        <button class="lightbox-close" onclick="closeGalleryLightbox()">&times;</button>
        <button class="lightbox-prev" onclick="event.stopPropagation(); navigateGalleryLightbox(-1)">‹</button>
        <img class="lightbox-content" id="gallery-lightbox-img" src="" alt="">
        <button class="lightbox-next" onclick="event.stopPropagation(); navigateGalleryLightbox(1)">›</button>
        <div class="lightbox-counter" id="gallery-lightbox-counter"></div>
    </div>

</div>

<style>
/* GALLERY COMPLETE - PROFESSIONAL TOGGLE DESIGN */
.gallery-complete-page {
    width: 100%;
}

.section-padding {
    padding: 60px 0;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px;
}

.text-center {
    text-align: center;
}

/* Hero with Background Image */
.gallery-hero {
    position: relative;
    min-height: 400px;
    display: flex;
    align-items: center;
    background-size: cover;
    background-position: center;
    background-color: var(--color-primary);
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: var(--color-primary);
    opacity: 0.85;
}

.hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    color: white;
    max-width: 800px;
    margin: 0 auto;
}

.hero-content h1 {
    font-size: 3.5rem;
    margin: 0;
    font-weight: 800;
}

/* BILDER SECTION - Gallery Filters (Simple Text, No Icons) */
.bilder-section {
    background: #ffffff;
    padding: 60px 0;
}

.gallery-filters {
    display: flex;
    gap: 16px;
    justify-content: center;
    margin-bottom: 60px;
    flex-wrap: wrap;
}

.filter-btn {
    display: inline-flex;
    align-items: center;
    padding: 14px 32px;
    background: #ffffff;
    border: 2px solid #e5e7eb;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 1rem;
    font-weight: 600;
    color: var(--color-text-primary);
}

.filter-btn:hover {
    border-color: var(--color-primary);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.filter-btn.active {
    background: var(--color-primary);
    border-color: var(--color-primary);
    color: white;
}

/* Gallery Grid - First 6 Images */
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-bottom: 80px;
}

.gallery-item {
    position: relative;
    aspect-ratio: 4 / 3;
    border-radius: 16px;
    overflow: hidden;
    cursor: pointer;
    background: #f8f9fa;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.gallery-item:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
}

.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-item:hover img {
    transform: scale(1.1);
}

.gallery-overlay {
    position: absolute;
    inset: 0;
    background: rgba(var(--color-primary-rgb), 0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.zoom-icon {
    font-size: 3rem;
    color: white;
}

/* More Images Indicator */
.gallery-more-indicator {
    text-align: center;
    margin-top: 40px;
    padding: 24px;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border-radius: 12px;
    border: 2px dashed var(--color-primary);
    cursor: pointer;
    transition: all 0.3s ease;
}

.gallery-more-indicator:hover {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
    border-color: var(--color-primary-dark);
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(var(--color-primary-rgb), 0.3);
}

.gallery-more-indicator:hover p,
.gallery-more-indicator:hover .hint-text {
    color: white;
}

.gallery-more-indicator p {
    font-size: 1.125rem;
    color: var(--color-primary);
    font-weight: 600;
    margin: 0 0 8px 0;
    transition: color 0.3s ease;
}

.gallery-more-indicator .hint-text {
    font-size: 0.95rem;
    color: var(--color-text-secondary);
    font-weight: 400;
    transition: color 0.3s ease;
}

/* 3D GRUNDRISSE SECTION */
.threed-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
}

.threed-intro {
    max-width: 900px;
    margin: 0 auto 60px auto;
}

.threed-intro h2 {
    font-size: 2.5rem;
    color: var(--color-primary);
    margin-bottom: 24px;
    font-weight: 700;
}

.intro-text {
    font-size: 1.125rem;
    color: var(--color-text-secondary);
    line-height: 1.8;
}

.floorplans-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
}

.floorplan-card {
    background: #ffffff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 6px 24px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}

.floorplan-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
}

.card-header {
    padding: 24px;
    background: var(--color-background);
    border-bottom: 3px solid var(--color-primary);
}

.card-header h3 {
    font-size: 1.5rem;
    color: var(--color-primary);
    margin: 0 0 8px 0;
    font-weight: 700;
}

.card-description {
    font-size: 0.95rem;
    color: var(--color-text-secondary);
    margin: 0;
    line-height: 1.5;
}

.card-content-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    padding: 24px;
}

.tech-data h4 {
    font-size: 1.125rem;
    color: var(--color-primary);
    margin: 0 0 16px 0;
    font-weight: 600;
}

.specs-list {
    display: grid;
    gap: 12px;
}

.spec-row {
    display: flex;
    justify-content: space-between;
    padding: 10px;
    background: var(--color-background);
    border-radius: 8px;
    border-left: 3px solid var(--color-primary);
}

.spec-row dt {
    font-weight: 600;
    color: var(--color-text-secondary);
    font-size: 0.9rem;
}

.spec-row dd {
    font-weight: 700;
    color: var(--color-text-primary);
    font-size: 0.9rem;
}

.plan-preview {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.plan-preview img {
    width: 100%;
    height: auto;
    border-radius: 12px;
    background: var(--color-background);
    transition: opacity 0.3s ease;
}

.toggle-mirror-btn {
    padding: 10px 16px;
    background: transparent;
    border: 2px solid var(--color-primary);
    border-radius: 8px;
    color: var(--color-primary);
    font-weight: 600;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.toggle-mirror-btn:hover {
    background: var(--color-primary);
    color: white;
    transform: translateY(-2px);
}

/* Lightbox */
.gallery-lightbox {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.95);
    z-index: 10000;
    align-items: center;
    justify-content: center;
}

.lightbox-close {
    position: absolute;
    top: 30px;
    right: 40px;
    font-size: 50px;
    color: white;
    background: none;
    border: none;
    cursor: pointer;
    z-index: 10001;
}

.lightbox-content {
    max-width: 95%;
    max-height: 95%;
    width: auto;
    height: auto;
    object-fit: contain;
    border-radius: 8px;
}

.lightbox-prev,
.lightbox-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.2);
    border: none;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 2rem;
    color: white;
    z-index: 10001;
}

.lightbox-prev {
    left: 40px;
}

.lightbox-next {
    right: 40px;
}

.lightbox-counter {
    position: absolute;
    bottom: 40px;
    left: 50%;
    transform: translateX(-50%);
    color: white;
    font-size: 1.125rem;
    background: rgba(0, 0, 0, 0.5);
    padding: 8px 24px;
    border-radius: 50px;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .floorplans-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 32px;
    }
}

@media (max-width: 1023px) {
    .gallery-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
}

@media (max-width: 767px) {
    .hero-content h1 {
        font-size: 2.5rem;
    }

    .big-toggle-buttons {
        flex-direction: column;
        gap: 16px;
    }

    .big-toggle-btn {
        width: 100%;
        padding: 20px;
    }

    .toggle-btn-text {
        font-size: 1.5rem;
    }

    .gallery-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .floorplans-grid {
        grid-template-columns: 1fr;
        gap: 24px;
    }

    .card-content-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .card-header h3 {
        font-size: 1.25rem;
    }

    .threed-intro h2 {
        font-size: 2rem;
    }
}
</style>

<script>
// Store all images for lightbox
window.galleryImages = <?php echo json_encode(array_map(function($item) {
    return $item['image']['url'];
}, $all_images ?? [])); ?>;

window.currentGalleryIndex = 0;

// Filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.dataset.filter;

            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            galleryItems.forEach(item => {
                if (filter === 'all' || item.dataset.category === filter) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});

// Lightbox functions
function openGalleryLightbox(index) {
    window.currentGalleryIndex = index;
    const lightbox = document.getElementById('gallery-lightbox');
    const img = document.getElementById('gallery-lightbox-img');
    const counter = document.getElementById('gallery-lightbox-counter');

    img.src = window.galleryImages[index];
    counter.textContent = `${index + 1} / ${window.galleryImages.length}`;

    lightbox.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeGalleryLightbox() {
    document.getElementById('gallery-lightbox').style.display = 'none';
    document.body.style.overflow = 'auto';
}

function navigateGalleryLightbox(direction) {
    window.currentGalleryIndex += direction;

    if (window.currentGalleryIndex < 0) {
        window.currentGalleryIndex = window.galleryImages.length - 1;
    } else if (window.currentGalleryIndex >= window.galleryImages.length) {
        window.currentGalleryIndex = 0;
    }

    const img = document.getElementById('gallery-lightbox-img');
    const counter = document.getElementById('gallery-lightbox-counter');

    img.src = window.galleryImages[window.currentGalleryIndex];
    counter.textContent = `${window.currentGalleryIndex + 1} / ${window.galleryImages.length}`;
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const lightbox = document.getElementById('gallery-lightbox');
    if (lightbox && lightbox.style.display === 'flex') {
        if (e.key === 'Escape') closeGalleryLightbox();
        else if (e.key === 'ArrowLeft') navigateGalleryLightbox(-1);
        else if (e.key === 'ArrowRight') navigateGalleryLightbox(1);
    }
});
</script>
