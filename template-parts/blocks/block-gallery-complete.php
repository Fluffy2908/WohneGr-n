<?php
/**
 * Block: Gallery Complete (All-in-One for Galerie page)
 * Complete gallery page with categories and lightbox with LIVE PREVIEW
 */

// Get all fields
$hero_title = get_field('gallery_hero_title');
$hero_subtitle = get_field('gallery_hero_subtitle');

$gallery_categories = get_field('gallery_categories');
$show_filters = get_field('gallery_show_filters');

$block_id = 'gallery-complete-' . $block['id'];
?>

<div class="gallery-complete-page" id="<?php echo esc_attr($block_id); ?>">

    <!-- Hero Section -->
    <section class="gallery-hero">
        <div class="container">
            <div class="hero-content text-center">
                <?php if ($hero_title): ?>
                    <h1><?php echo esc_html($hero_title); ?></h1>
                <?php endif; ?>
                <?php if ($hero_subtitle): ?>
                    <p class="hero-subtitle"><?php echo esc_html($hero_subtitle); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <?php if ($gallery_categories && is_array($gallery_categories)): ?>
    <section class="gallery-main section-padding">
        <div class="container">

            <!-- Category Filters -->
            <?php if ($show_filters && count($gallery_categories) > 1): ?>
            <div class="gallery-filters">
                <button class="filter-btn active" data-filter="all">Alle</button>
                <?php foreach ($gallery_categories as $index => $category): ?>
                    <button class="filter-btn" data-filter="cat-<?php echo $index; ?>">
                        <?php echo esc_html($category['category_name']); ?>
                    </button>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- Gallery Grid -->
            <div class="gallery-grid">
                <?php foreach ($gallery_categories as $cat_index => $category): ?>
                    <?php if (isset($category['images']) && is_array($category['images'])): ?>
                        <?php foreach ($category['images'] as $img_index => $image): ?>
                            <div class="gallery-item" data-category="cat-<?php echo $cat_index; ?>">
                                <div class="gallery-image-wrapper">
                                    <img src="<?php echo esc_url($image['sizes']['large'] ?? $image['url']); ?>"
                                         alt="<?php echo esc_attr($image['alt'] ?: $category['category_name']); ?>"
                                         data-full="<?php echo esc_url($image['url']); ?>"
                                         loading="lazy">
                                    <div class="gallery-overlay">
                                        <button class="gallery-expand" data-index="<?php echo $cat_index . '-' . $img_index; ?>">
                                            <?php echo wohnegruen_get_icon('expand'); ?>
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

    <!-- Lightbox -->
    <div class="gallery-lightbox" id="gallery-lightbox-<?php echo esc_attr($block['id']); ?>">
        <button class="lightbox-close">&times;</button>
        <button class="lightbox-prev">&lsaquo;</button>
        <button class="lightbox-next">&rsaquo;</button>
        <div class="lightbox-content">
            <img src="" alt="">
            <p class="lightbox-caption"></p>
        </div>
    </div>

</div>

<style>
/* Gallery Complete Styles */
.gallery-complete-page {
    width: 100%;
}

.section-padding {
    padding: var(--spacing-3xl) 0;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 var(--spacing-lg);
}

/* Hero */
.gallery-hero {
    padding: var(--spacing-3xl) 0;
    background: var(--color-background);
}

.hero-content.text-center {
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.hero-content h1 {
    font-size: var(--font-size-4xl);
    color: var(--color-primary);
    margin-bottom: var(--spacing-lg);
}

.hero-subtitle {
    font-size: var(--font-size-xl);
    color: var(--color-text-secondary);
}

/* Filters */
.gallery-filters {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: var(--spacing-md);
    margin-bottom: var(--spacing-3xl);
}

.filter-btn {
    padding: var(--spacing-sm) var(--spacing-lg);
    border: 2px solid var(--color-border);
    background: var(--color-white);
    color: var(--color-text-primary);
    border-radius: var(--radius-md);
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    font-family: inherit;
    font-size: var(--font-size-md);
}

.filter-btn:hover,
.filter-btn.active {
    border-color: var(--color-primary);
    background: var(--color-primary);
    color: var(--color-white);
}

/* Gallery Grid */
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: var(--spacing-xl);
}

.gallery-item {
    transition: var(--transition);
}

.gallery-item.hidden {
    display: none;
}

.gallery-image-wrapper {
    position: relative;
    overflow: hidden;
    border-radius: var(--radius-lg);
    aspect-ratio: 4/3;
}

.gallery-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}

.gallery-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: var(--transition);
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.gallery-item:hover img {
    transform: scale(1.05);
}

.gallery-expand {
    width: 60px;
    height: 60px;
    border: none;
    background: var(--color-white);
    color: var(--color-primary);
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
}

.gallery-expand:hover {
    transform: scale(1.1);
}

.gallery-expand svg {
    width: 30px;
    height: 30px;
}

.gallery-caption {
    margin-top: var(--spacing-sm);
    text-align: center;
    color: var(--color-text-secondary);
    font-size: var(--font-size-sm);
}

/* Lightbox */
.gallery-lightbox {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.95);
    z-index: 9999;
    align-items: center;
    justify-content: center;
}

.gallery-lightbox.active {
    display: flex;
}

.lightbox-content {
    max-width: 90%;
    max-height: 90%;
    text-align: center;
}

.lightbox-content img {
    max-width: 100%;
    max-height: 85vh;
    object-fit: contain;
}

.lightbox-caption {
    color: var(--color-white);
    margin-top: var(--spacing-lg);
    font-size: var(--font-size-md);
}

.lightbox-close,
.lightbox-prev,
.lightbox-next {
    position: absolute;
    background: var(--color-white);
    color: var(--color-primary);
    border: none;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    font-size: 30px;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
}

.lightbox-close {
    top: 20px;
    right: 20px;
}

.lightbox-prev {
    left: 20px;
    top: 50%;
    transform: translateY(-50%);
}

.lightbox-next {
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
}

.lightbox-close:hover,
.lightbox-prev:hover,
.lightbox-next:hover {
    background: var(--color-primary);
    color: var(--color-white);
}

/* Responsive */
@media (max-width: 767px) {
    .container {
        padding: 0 var(--spacing-md);
    }

    .gallery-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: var(--spacing-md);
    }

    .section-padding {
        padding: var(--spacing-2xl) 0;
    }

    .hero-content h1 {
        font-size: var(--font-size-2xl);
    }

    .lightbox-prev,
    .lightbox-next {
        width: 40px;
        height: 40px;
        font-size: 24px;
    }
}
</style>

<script>
(function() {
    document.addEventListener('DOMContentLoaded', function() {
        const galleryBlock = document.getElementById('<?php echo esc_js($block_id); ?>');
        if (!galleryBlock) return;

        // Filter functionality
        const filterBtns = galleryBlock.querySelectorAll('.filter-btn');
        const galleryItems = galleryBlock.querySelectorAll('.gallery-item');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const filter = this.dataset.filter;

                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                galleryItems.forEach(item => {
                    if (filter === 'all' || item.dataset.category === filter) {
                        item.classList.remove('hidden');
                    } else {
                        item.classList.add('hidden');
                    }
                });
            });
        });

        // Lightbox functionality
        const lightbox = galleryBlock.querySelector('.gallery-lightbox');
        const expandBtns = galleryBlock.querySelectorAll('.gallery-expand');
        const closeLightbox = lightbox.querySelector('.lightbox-close');
        const prevBtn = lightbox.querySelector('.lightbox-prev');
        const nextBtn = lightbox.querySelector('.lightbox-next');
        const lightboxImg = lightbox.querySelector('.lightbox-content img');
        const lightboxCaption = lightbox.querySelector('.lightbox-caption');

        let currentIndex = 0;
        const allImages = Array.from(galleryBlock.querySelectorAll('.gallery-item:not(.hidden) img'));

        function showImage(index) {
            const visibleImages = Array.from(galleryBlock.querySelectorAll('.gallery-item:not(.hidden) img'));
            if (visibleImages.length === 0) return;

            currentIndex = (index + visibleImages.length) % visibleImages.length;
            const img = visibleImages[currentIndex];

            lightboxImg.src = img.dataset.full;
            lightboxImg.alt = img.alt;

            const caption = img.closest('.gallery-item').querySelector('.gallery-caption');
            lightboxCaption.textContent = caption ? caption.textContent : '';
        }

        expandBtns.forEach((btn, index) => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                lightbox.classList.add('active');
                showImage(index);
            });
        });

        closeLightbox.addEventListener('click', () => {
            lightbox.classList.remove('active');
        });

        prevBtn.addEventListener('click', () => showImage(currentIndex - 1));
        nextBtn.addEventListener('click', () => showImage(currentIndex + 1));

        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) {
                lightbox.classList.remove('active');
            }
        });

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (!lightbox.classList.contains('active')) return;

            if (e.key === 'Escape') lightbox.classList.remove('active');
            if (e.key === 'ArrowLeft') showImage(currentIndex - 1);
            if (e.key === 'ArrowRight') showImage(currentIndex + 1);
        });
    });
})();
</script>
