<?php
/**
 * Block: Model Showcase (Hero + Interactive Color Gallery)
 *
 * Combines hero section with tabbed color gallery similar to Hosekra
 */

// Hero fields
$hero_image = get_field('showcase_hero_image');
$tagline = get_field('showcase_tagline');
$badge = get_field('showcase_badge');
$specs = get_field('showcase_specs');

// Gallery fields
$gallery_title = get_field('showcase_gallery_title') ?: 'Farboptionen & Innenausstattung';
$gallery_subtitle = get_field('showcase_gallery_subtitle');
$color_variants = get_field('showcase_color_variants');

$hero_bg_url = '';
if (!empty($hero_image)) {
    $hero_bg_url = is_array($hero_image) ? $hero_image['url'] : $hero_image;
}

$block_id = 'showcase-' . uniqid();
?>

<!-- Hero Section -->
<section class="model-showcase-hero" <?php if ($hero_bg_url): ?>style="background-image: url('<?php echo esc_url($hero_bg_url); ?>');"<?php endif; ?>>
    <div class="model-showcase-overlay"></div>
    <div class="container">
        <div class="model-showcase-content">
            <?php if (!empty($badge)): ?>
                <span class="model-showcase-badge"><?php echo esc_html($badge); ?></span>
            <?php endif; ?>

            <h1 class="model-showcase-title"><?php echo esc_html(get_the_title()); ?></h1>

            <?php if (!empty($tagline)): ?>
                <p class="model-showcase-tagline"><?php echo esc_html($tagline); ?></p>
            <?php endif; ?>

            <?php if (!empty($specs) && is_array($specs)): ?>
                <div class="model-showcase-specs">
                    <?php foreach ($specs as $spec): ?>
                        <div class="spec-item">
                            <span class="spec-value"><?php echo esc_html($spec['value']); ?></span>
                            <span class="spec-label"><?php echo esc_html($spec['label']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Interactive Color Gallery Section -->
<?php if (!empty($color_variants) && is_array($color_variants)): ?>
<section class="model-color-gallery section-padding" id="<?php echo esc_attr($block_id); ?>">
    <div class="container">
        <div class="section-header text-center">
            <h2><?php echo esc_html($gallery_title); ?></h2>
            <?php if (!empty($gallery_subtitle)): ?>
                <p><?php echo esc_html($gallery_subtitle); ?></p>
            <?php endif; ?>
        </div>

        <!-- Color Tabs/Filters -->
        <div class="color-tabs">
            <?php foreach ($color_variants as $index => $variant): ?>
                <button class="color-tab <?php echo $index === 0 ? 'active' : ''; ?>"
                        data-tab="variant-<?php echo $index; ?>"
                        onclick="switchColorTab(event, 'variant-<?php echo $index; ?>', '<?php echo esc_attr($block_id); ?>')">
                    <span class="tab-name"><?php echo esc_html($variant['variant_name']); ?></span>
                    <?php if (!empty($variant['exterior_color']) || !empty($variant['interior_color'])): ?>
                        <span class="tab-colors">
                            <?php if (!empty($variant['exterior_color'])): ?>
                                <span class="color-dot" style="background-color: <?php echo esc_attr($variant['exterior_color']); ?>"></span>
                            <?php endif; ?>
                            <?php if (!empty($variant['interior_color'])): ?>
                                <span class="color-dot" style="background-color: <?php echo esc_attr($variant['interior_color']); ?>"></span>
                            <?php endif; ?>
                        </span>
                    <?php endif; ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Color Variant Content -->
        <?php foreach ($color_variants as $index => $variant): ?>
            <div class="color-variant-content" id="variant-<?php echo $index; ?>" style="<?php echo $index !== 0 ? 'display: none;' : ''; ?>">

                <!-- Variant Info -->
                <div class="variant-info">
                    <div class="variant-details">
                        <h3><?php echo esc_html($variant['variant_name']); ?></h3>
                        <?php if (!empty($variant['description'])): ?>
                            <p><?php echo esc_html($variant['description']); ?></p>
                        <?php endif; ?>

                        <div class="variant-color-specs">
                            <?php if (!empty($variant['exterior_name'])): ?>
                                <div class="color-spec-item">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    </svg>
                                    <div>
                                        <span class="spec-label">Außen</span>
                                        <span class="spec-value"><?php echo esc_html($variant['exterior_name']); ?></span>
                                        <?php if (!empty($variant['exterior_color'])): ?>
                                            <span class="color-swatch" style="background-color: <?php echo esc_attr($variant['exterior_color']); ?>"></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($variant['interior_name'])): ?>
                                <div class="color-spec-item">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                    </svg>
                                    <div>
                                        <span class="spec-label">Innen</span>
                                        <span class="spec-value"><?php echo esc_html($variant['interior_name']); ?></span>
                                        <?php if (!empty($variant['interior_color'])): ?>
                                            <span class="color-swatch" style="background-color: <?php echo esc_attr($variant['interior_color']); ?>"></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Image Gallery Grid -->
                <?php if (!empty($variant['gallery']) && is_array($variant['gallery'])): ?>
                    <div class="variant-gallery-grid">
                        <?php foreach ($variant['gallery'] as $img_index => $image): ?>
                            <div class="gallery-item" onclick="openLightbox('<?php echo esc_attr($block_id); ?>', <?php echo $index; ?>, <?php echo $img_index; ?>)">
                                <img src="<?php echo esc_url($image['sizes']['medium'] ?? $image['url']); ?>"
                                     alt="<?php echo esc_attr($variant['variant_name']); ?> - <?php echo esc_attr($image['alt'] ?? 'Gallery image'); ?>"
                                     loading="lazy">
                                <div class="gallery-overlay">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <path d="m21 21-4.35-4.35"></path>
                                        <path d="M11 8v6M8 11h6"></path>
                                    </svg>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Lightbox -->
<div id="lightbox-<?php echo esc_attr($block_id); ?>" class="gallery-lightbox" onclick="closeLightbox('<?php echo esc_attr($block_id); ?>')" role="dialog" aria-modal="true" aria-label="Bildergalerie Vollansicht">
    <button class="lightbox-close" onclick="closeLightbox('<?php echo esc_attr($block_id); ?>')" aria-label="Galerie schließen">&times;</button>
    <button class="lightbox-nav lightbox-prev" onclick="event.stopPropagation(); navigateLightbox('<?php echo esc_attr($block_id); ?>', -1)" aria-label="Vorheriges Bild">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" aria-hidden="true">
            <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
    </button>
    <img class="lightbox-content" id="lightbox-img-<?php echo esc_attr($block_id); ?>" src="" alt="">
    <button class="lightbox-nav lightbox-next" onclick="event.stopPropagation(); navigateLightbox('<?php echo esc_attr($block_id); ?>', 1)" aria-label="Nächstes Bild">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" aria-hidden="true">
            <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
    </button>
    <div class="lightbox-counter" id="lightbox-counter-<?php echo esc_attr($block_id); ?>" aria-live="polite" aria-atomic="true"></div>
</div>

<script>
// Store gallery data
window.showcaseGalleries = window.showcaseGalleries || {};
window.showcaseGalleries['<?php echo esc_js($block_id); ?>'] = {
    variants: <?php echo json_encode(array_map(function($variant) {
        return array_map(function($img) {
            return $img['url'];
        }, $variant['gallery'] ?? []);
    }, $color_variants)); ?>,
    currentVariant: 0,
    currentIndex: 0
};

// Switch color tab
function switchColorTab(event, tabId, blockId) {
    event.preventDefault();

    // Update tabs
    const tabs = document.querySelectorAll(`#${blockId} .color-tab`);
    tabs.forEach(tab => tab.classList.remove('active'));
    event.currentTarget.classList.add('active');

    // Update content
    const contents = document.querySelectorAll(`#${blockId} .color-variant-content`);
    contents.forEach(content => content.style.display = 'none');
    document.getElementById(tabId).style.display = 'block';

    // Update current variant index
    const variantIndex = parseInt(tabId.replace('variant-', ''));
    window.showcaseGalleries[blockId].currentVariant = variantIndex;
}

// Open lightbox
function openLightbox(blockId, variantIndex, imageIndex) {
    const gallery = window.showcaseGalleries[blockId];
    gallery.currentVariant = variantIndex;
    gallery.currentIndex = imageIndex;

    const lightbox = document.getElementById(`lightbox-${blockId}`);
    const img = document.getElementById(`lightbox-img-${blockId}`);
    const counter = document.getElementById(`lightbox-counter-${blockId}`);

    img.src = gallery.variants[variantIndex][imageIndex];
    counter.textContent = `${imageIndex + 1} / ${gallery.variants[variantIndex].length}`;

    lightbox.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

// Close lightbox
function closeLightbox(blockId) {
    document.getElementById(`lightbox-${blockId}`).style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Navigate lightbox
function navigateLightbox(blockId, direction) {
    const gallery = window.showcaseGalleries[blockId];
    const variantGallery = gallery.variants[gallery.currentVariant];

    gallery.currentIndex += direction;

    if (gallery.currentIndex < 0) {
        gallery.currentIndex = variantGallery.length - 1;
    } else if (gallery.currentIndex >= variantGallery.length) {
        gallery.currentIndex = 0;
    }

    const img = document.getElementById(`lightbox-img-${blockId}`);
    const counter = document.getElementById(`lightbox-counter-${blockId}`);

    img.src = variantGallery[gallery.currentIndex];
    counter.textContent = `${gallery.currentIndex + 1} / ${variantGallery.length}`;
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const openLightbox = document.querySelector('.gallery-lightbox[style*="display: flex"]');
    if (!openLightbox) return;

    const blockId = openLightbox.id.replace('lightbox-', '');

    if (e.key === 'Escape') {
        closeLightbox(blockId);
    } else if (e.key === 'ArrowLeft') {
        navigateLightbox(blockId, -1);
    } else if (e.key === 'ArrowRight') {
        navigateLightbox(blockId, 1);
    }
});
</script>

<style>
/* Hero Section */
.model-showcase-hero {
    position: relative;
    min-height: 600px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    display: flex;
    align-items: center;
    padding: 100px 20px;
}

.model-showcase-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(45, 80, 22, 0.85) 0%, rgba(45, 80, 22, 0.6) 100%);
    z-index: 1;
}

.model-showcase-content {
    position: relative;
    z-index: 2;
    color: white;
    max-width: 800px;
}

.model-showcase-badge {
    display: inline-block;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 8px 20px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 20px;
}

.model-showcase-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin: 0 0 20px 0;
    color: white;
    line-height: 1.2;
}

.model-showcase-tagline {
    font-size: 1.3rem;
    margin: 0 0 40px 0;
    color: rgba(255, 255, 255, 0.95);
    line-height: 1.6;
}

.model-showcase-specs {
    display: flex;
    gap: 40px;
    flex-wrap: wrap;
}

.spec-item {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.spec-value {
    font-size: 2rem;
    font-weight: 700;
    color: white;
}

.spec-label {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.8);
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Color Gallery Section */
.model-color-gallery {
    padding: 80px 0;
    background: #f8f9fa;
}

.section-header.text-center {
    text-align: center;
    margin-bottom: 40px;
}

.section-header h2 {
    font-size: 2.5rem;
    color: #2d5016;
    margin: 0 0 15px 0;
}

.section-header p {
    font-size: 1.1rem;
    color: #666;
    margin: 0;
}

/* Color Tabs */
.color-tabs {
    display: flex;
    gap: 15px;
    margin-bottom: 40px;
    flex-wrap: wrap;
    justify-content: center;
}

.color-tab {
    padding: 15px 30px;
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    min-width: 160px;
}

.color-tab:hover {
    border-color: #2d5016;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.color-tab.active {
    background: #2d5016;
    border-color: #2d5016;
    color: white;
}

.tab-name {
    font-weight: 600;
    font-size: 1rem;
}

.tab-colors {
    display: flex;
    gap: 6px;
}

.color-dot {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 2px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.color-tab.active .color-dot {
    border-color: rgba(255, 255, 255, 0.6);
}

/* Variant Info */
.variant-info {
    background: white;
    border-radius: 16px;
    padding: 30px;
    margin-bottom: 30px;
}

.variant-details h3 {
    margin: 0 0 15px 0;
    font-size: 1.8rem;
    color: #2d5016;
}

.variant-details p {
    margin: 0 0 20px 0;
    color: #666;
    line-height: 1.6;
}

.variant-color-specs {
    display: flex;
    gap: 30px;
    flex-wrap: wrap;
}

.color-spec-item {
    display: flex;
    gap: 12px;
    align-items: flex-start;
}

.color-spec-item svg {
    color: #2d5016;
    flex-shrink: 0;
    margin-top: 2px;
}

.color-spec-item > div {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.spec-label {
    font-size: 0.85rem;
    color: #999;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.spec-value {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
}

.color-swatch {
    width: 30px;
    height: 30px;
    border-radius: 6px;
    display: inline-block;
    border: 2px solid #e0e0e0;
    margin-top: 5px;
}

/* Gallery Grid */
.variant-gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
}

.gallery-item {
    position: relative;
    aspect-ratio: 1;
    overflow: hidden;
    border-radius: 12px;
    cursor: pointer;
    background: #f0f0f0;
}

.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(45, 80, 22, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.gallery-item:hover img {
    transform: scale(1.1);
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

/* Lightbox */
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
}

.lightbox-close {
    position: absolute;
    top: 30px;
    right: 40px;
    font-size: 50px;
    color: white;
    cursor: pointer;
    z-index: 10001;
    line-height: 1;
}

.lightbox-content {
    max-width: 90%;
    max-height: 90%;
    object-fit: contain;
}

.lightbox-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.2);
    border: none;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.3s ease;
    z-index: 10001;
}

.lightbox-nav:hover {
    background: rgba(255, 255, 255, 0.3);
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
    font-size: 1.1rem;
    background: rgba(0, 0, 0, 0.5);
    padding: 10px 20px;
    border-radius: 50px;
}

/* Responsive */
@media (max-width: 768px) {
    .model-showcase-hero {
        min-height: 500px;
        padding: 60px 20px;
    }

    .model-showcase-title {
        font-size: 2.5rem;
    }

    .model-showcase-tagline {
        font-size: 1.1rem;
    }

    .model-showcase-specs {
        gap: 25px;
    }

    .spec-value {
        font-size: 1.5rem;
    }

    .color-tabs {
        gap: 10px;
    }

    .color-tab {
        min-width: 140px;
        padding: 12px 20px;
    }

    .variant-gallery-grid {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 15px;
    }

    .lightbox-nav {
        width: 50px;
        height: 50px;
    }

    .lightbox-prev {
        left: 20px;
    }

    .lightbox-next {
        right: 20px;
    }

    .lightbox-close {
        top: 20px;
        right: 20px;
        font-size: 40px;
    }
}

@media (max-width: 480px) {
    .model-showcase-hero {
        min-height: 400px;
        padding: 40px 15px;
    }

    .model-showcase-title {
        font-size: 2rem;
    }

    .variant-gallery-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .color-tab {
        min-width: 120px;
        padding: 10px 15px;
    }

    .tab-name {
        font-size: 0.9rem;
    }
}
</style>
<?php endif; ?>
