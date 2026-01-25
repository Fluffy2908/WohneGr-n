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

                // Show first 6 images in grid
                $grid_images = array_slice($all_images, 0, 6);
                $slider_images = array_slice($all_images, 6);

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

            <!-- Slider for Remaining Images -->
            <?php if (!empty($slider_images)): ?>
            <div class="gallery-slider-section">
                <h2 class="slider-title">Weitere Bilder</h2>
                <div class="gallery-slider">
                    <button class="slider-prev" onclick="moveGallerySlider(-1)">‹</button>
                    <div class="slider-track">
                        <?php foreach ($slider_images as $slider_index => $item):
                            $image = $item['image'];
                            $global_index = 6 + $slider_index;
                        ?>
                            <div class="slider-item" data-category="<?php echo esc_attr($item['category']); ?>" onclick="openGalleryLightbox(<?php echo $global_index; ?>)">
                                <img src="<?php echo esc_url($image['sizes']['medium'] ?? $image['url']); ?>"
                                     alt="<?php echo esc_attr($image['alt'] ?: $item['category_name']); ?>"
                                     loading="lazy">
                                <div class="gallery-overlay">
                                    <span class="zoom-icon">🔍</span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="slider-next" onclick="moveGallerySlider(1)">›</button>
                </div>
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
    padding: 80px 0;
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

/* Toggle Buttons Section (Like Models Page) */
.gallery-toggle-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    padding: 60px 0;
}

.big-toggle-buttons {
    display: flex;
    gap: 40px;
    justify-content: center;
    flex-wrap: wrap;
}

.big-toggle-btn {
    padding: 24px 80px;
    background: #ffffff;
    border: 4px solid #e5e7eb;
    border-radius: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    min-width: 280px;
}

.big-toggle-btn:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
    border-color: var(--color-primary);
}

.big-toggle-btn.active {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
    border-color: var(--color-primary);
    box-shadow: 0 12px 40px rgba(var(--color-primary-rgb), 0.3);
}

.big-toggle-btn.active .toggle-btn-text {
    color: white;
}

.toggle-btn-text {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--color-text-primary);
}

/* Section Content Toggle */
.section-content {
    display: none;
}

.section-content.active {
    display: block;
}

/* BILDER SECTION - Gallery Filters (Simple Text, No Icons) */
.bilder-section {
    background: #ffffff;
    padding: 80px 0;
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

.gallery-item:hover .gallery-overlay,
.slider-item:hover .gallery-overlay {
    opacity: 1;
}

.zoom-icon {
    font-size: 3rem;
    color: white;
}

/* Slider Section */
.gallery-slider-section {
    margin-top: 60px;
}

.slider-title {
    font-size: 2rem;
    color: var(--color-primary);
    margin-bottom: 40px;
    text-align: center;
    font-weight: 700;
}

.gallery-slider {
    position: relative;
    overflow: hidden;
    padding: 0 60px;
}

.slider-track {
    display: flex;
    gap: 24px;
    transition: transform 0.4s ease;
    overflow-x: auto;
    scroll-behavior: smooth;
    scrollbar-width: none;
    -ms-overflow-style: none;
}

.slider-track::-webkit-scrollbar {
    display: none;
}

.slider-item {
    flex: 0 0 calc(33.333% - 16px);
    aspect-ratio: 4 / 3;
    border-radius: 16px;
    overflow: hidden;
    cursor: pointer;
    background: #f8f9fa;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    position: relative;
}

.slider-item:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
}

.slider-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.slider-prev,
.slider-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: var(--color-primary);
    color: white;
    border: none;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2;
    transition: all 0.3s ease;
}

.slider-prev {
    left: 0;
}

.slider-next {
    right: 0;
}

.slider-prev:hover,
.slider-next:hover {
    background: var(--color-primary-dark);
    transform: translateY(-50%) scale(1.1);
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

    .slider-item {
        flex: 0 0 calc(50% - 12px);
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

    .slider-item {
        flex: 0 0 100%;
    }

    .gallery-slider {
        padding: 0 50px;
    }

    .slider-prev,
    .slider-next {
        width: 40px;
        height: 40px;
        font-size: 1.5rem;
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
window.sliderPosition = 0;

// Toggle between Bilder and 3D & Grundrisse
function switchGallerySection(section) {
    // Toggle buttons
    const buttons = document.querySelectorAll('.big-toggle-btn');
    buttons.forEach(btn => {
        btn.classList.toggle('active', btn.dataset.section === section);
    });

    // Toggle sections
    const sections = document.querySelectorAll('.section-content');
    sections.forEach(sec => {
        sec.classList.toggle('active', sec.dataset.contentSection === section);
    });
}

// Filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item, .slider-item');

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

// Slider navigation
function moveGallerySlider(direction) {
    const track = document.querySelector('.slider-track');
    if (!track) return;

    const itemWidth = track.querySelector('.slider-item')?.offsetWidth + 24 || 0;
    const maxScroll = track.scrollWidth - track.offsetWidth;

    window.sliderPosition += direction * itemWidth * 3;
    window.sliderPosition = Math.max(0, Math.min(window.sliderPosition, maxScroll));

    track.scrollTo({
        left: window.sliderPosition,
        behavior: 'smooth'
    });
}

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

// Toggle between normal and mirrored plan
let isReversedStates = {};

function togglePlanView(button) {
    const normalUrl = button.dataset.normal;
    const mirroredUrl = button.dataset.mirrored;
    const img = button.previousElementSibling;
    const buttonId = button.dataset.normal + button.dataset.mirrored;

    if (!isReversedStates[buttonId]) {
        isReversedStates[buttonId] = false;
    }

    isReversedStates[buttonId] = !isReversedStates[buttonId];

    img.style.opacity = '0';

    setTimeout(() => {
        img.src = isReversedStates[buttonId] ? mirroredUrl : normalUrl;
        img.style.opacity = '1';
        button.querySelector('.toggle-text').textContent = isReversedStates[buttonId] ? 'Normal anzeigen' : 'Gespiegelt anzeigen';
    }, 200);
}
</script>
