<?php
/**
 * Block: Complete Mobilhaus Presentation
 * All-in-one block for individual mobilhaus pages (Nature, Pure, etc.)
 * Inspired by Hosekra design - NO HARDCODED CONTENT
 */

// Get all field data
$hero_title = get_field('mobilhaus_hero_title') ?: get_the_title();
$hero_subtitle = get_field('mobilhaus_hero_subtitle');

// Color variants (exterior images)
$color_variants = get_field('mobilhaus_color_variants');

// Description section with image
$description_title = get_field('mobilhaus_description_title');
$description_text = get_field('mobilhaus_description_text');
$description_image = get_field('mobilhaus_description_image');

// Floor plan - normal and reversed (not mirrored CSS, but two different images)
$floor_plan_normal = get_field('mobilhaus_floor_plan_normal');
$floor_plan_reversed = get_field('mobilhaus_floor_plan_reversed');

// Technical specifications
$specifications = get_field('mobilhaus_specifications');

// Interior color schemes (like Hosekra)
$interior_schemes = get_field('mobilhaus_interior_schemes');

$block_id = isset($block['anchor']) ? $block['anchor'] : 'mobilhaus-' . $block['id'];
?>

<article class="mobilhaus-complete-page" id="<?php echo esc_attr($block_id); ?>">

    <!-- Hero Section with Color Selector -->
    <?php if ($hero_title || $color_variants): ?>
    <section class="mobilhaus-hero">
        <div class="container">
            <div class="mobilhaus-hero-content">
                <div class="mobilhaus-hero-text">
                    <?php if ($hero_title): ?>
                        <h1 class="mobilhaus-title"><?php echo esc_html($hero_title); ?></h1>
                    <?php endif; ?>

                    <?php if ($hero_subtitle): ?>
                        <p class="mobilhaus-subtitle"><?php echo esc_html($hero_subtitle); ?></p>
                    <?php endif; ?>

                    <!-- Color Selector Buttons -->
                    <?php if ($color_variants && is_array($color_variants)): ?>
                        <div class="mobilhaus-color-selector">
                            <p class="color-selector-label">Wählen Sie Ihre Farbe:</p>
                            <div class="color-buttons">
                                <?php foreach ($color_variants as $index => $variant): ?>
                                    <button
                                        class="color-btn <?php echo $index === 0 ? 'active' : ''; ?>"
                                        data-color-index="<?php echo $index; ?>"
                                        style="background-color: <?php echo esc_attr($variant['color_code']); ?>;"
                                        aria-label="<?php echo esc_attr($variant['color_name']); ?>">
                                        <span class="color-name"><?php echo esc_html($variant['color_name']); ?></span>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Hero Image (changes with color selection) -->
                <?php if ($color_variants && is_array($color_variants)): ?>
                <div class="mobilhaus-hero-image">
                    <?php foreach ($color_variants as $index => $variant): ?>
                        <img
                            class="mobilhaus-exterior-img <?php echo $index === 0 ? 'active' : ''; ?>"
                            data-color-index="<?php echo $index; ?>"
                            src="<?php echo esc_url($variant['exterior_image']['url']); ?>"
                            alt="<?php echo esc_attr($hero_title . ' - ' . $variant['color_name']); ?>"
                            loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>">
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Description Section: Text LEFT, Image RIGHT -->
    <?php if ($description_title || $description_text || $description_image): ?>
    <section class="mobilhaus-description-section section-padding">
        <div class="container">
            <div class="description-grid">
                <!-- Left: Text -->
                <div class="description-text">
                    <?php if ($description_title): ?>
                        <h2><?php echo esc_html($description_title); ?></h2>
                    <?php endif; ?>

                    <?php if ($description_text): ?>
                        <div class="description-content">
                            <?php echo wp_kses_post($description_text); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Technical Specifications -->
                    <?php if ($specifications && is_array($specifications)): ?>
                        <div class="mobilhaus-specs">
                            <h3>Technische Daten</h3>
                            <dl class="specs-list">
                                <?php foreach ($specifications as $spec): ?>
                                    <div class="spec-item">
                                        <dt><?php echo esc_html($spec['label']); ?></dt>
                                        <dd><?php echo esc_html($spec['value']); ?></dd>
                                    </div>
                                <?php endforeach; ?>
                            </dl>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Right: Image -->
                <?php if ($description_image): ?>
                <div class="description-image">
                    <img src="<?php echo esc_url($description_image['url']); ?>"
                         alt="<?php echo esc_attr($description_image['alt'] ?: $hero_title); ?>"
                         loading="lazy">
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Grundriss Section - Full Width with Toggle -->
    <?php if ($floor_plan_normal): ?>
    <section class="mobilhaus-grundriss-section section-padding">
        <div class="container">
            <h2>Grundriss</h2>

            <div class="grundriss-viewer">
                <div class="grundriss-image-wrapper">
                    <img
                        id="grundriss-img-<?php echo esc_attr($block_id); ?>"
                        class="grundriss-img"
                        src="<?php echo esc_url($floor_plan_normal['url']); ?>"
                        alt="Grundriss"
                        loading="lazy">
                </div>

                <?php if ($floor_plan_reversed): ?>
                <div class="grundriss-controls">
                    <button
                        class="btn btn-outline grundriss-toggle"
                        data-normal="<?php echo esc_url($floor_plan_normal['url']); ?>"
                        data-reversed="<?php echo esc_url($floor_plan_reversed['url']); ?>"
                        data-target="grundriss-img-<?php echo esc_attr($block_id); ?>">
                        <span class="toggle-text">Reversed Version anzeigen</span>
                    </button>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Interior Color Schemes Section -->
    <?php if ($interior_schemes && is_array($interior_schemes)): ?>
    <section class="mobilhaus-interior-section section-padding">
        <div class="container">
            <div class="section-header">
                <h2>Innenausstattung & Farbvarianten</h2>
                <p>Wählen Sie aus verschiedenen hochwertigen Material- und Farbkombinationen</p>
            </div>

            <?php foreach ($interior_schemes as $scheme_index => $scheme): ?>
                <div class="interior-scheme-block">
                    <div class="scheme-header">
                        <h3 class="scheme-title"><?php echo esc_html($scheme['scheme_name']); ?></h3>

                        <?php if (isset($scheme['color_palette_image']['url'])): ?>
                            <div class="scheme-palette-preview">
                                <img src="<?php echo esc_url($scheme['color_palette_image']['url']); ?>"
                                     alt="Farbpalette <?php echo esc_attr($scheme['scheme_name']); ?>"
                                     loading="lazy">
                            </div>
                        <?php endif; ?>

                        <?php if (isset($scheme['scheme_description'])): ?>
                            <p class="scheme-description"><?php echo esc_html($scheme['scheme_description']); ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Gallery Grid with proper gaps and rounded edges -->
                    <div class="interior-gallery-grid">
                        <?php foreach ($scheme['gallery'] as $img_index => $image): ?>
                            <div class="gallery-item"
                                 onclick="openInteriorLightbox('<?php echo esc_js($block_id); ?>', <?php echo $scheme_index; ?>, <?php echo $img_index; ?>)">
                                <img src="<?php echo esc_url($image['sizes']['medium'] ?? $image['url']); ?>"
                                     alt="<?php echo esc_attr($scheme['scheme_name'] . ' - Ansicht ' . ($img_index + 1)); ?>"
                                     loading="lazy">
                                <div class="gallery-overlay">
                                    <span class="gallery-icon">🔍</span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Lightbox for Interior Images -->
    <div id="interior-lightbox-<?php echo esc_attr($block_id); ?>" class="interior-lightbox" onclick="closeInteriorLightbox('<?php echo esc_attr($block_id); ?>')">
        <button class="lightbox-close" onclick="closeInteriorLightbox('<?php echo esc_attr($block_id); ?>')">&times;</button>
        <button class="lightbox-prev" onclick="event.stopPropagation(); navigateInteriorLightbox('<?php echo esc_attr($block_id); ?>', -1)">‹</button>
        <img class="lightbox-content" id="interior-lightbox-img-<?php echo esc_attr($block_id); ?>" src="" alt="">
        <button class="lightbox-next" onclick="event.stopPropagation(); navigateInteriorLightbox('<?php echo esc_attr($block_id); ?>', 1)">›</button>
        <div class="lightbox-counter" id="interior-lightbox-counter-<?php echo esc_attr($block_id); ?>"></div>
    </div>

</article>

<script>
// Store gallery data
window.mobilhausGalleries = window.mobilhausGalleries || {};
window.mobilhausGalleries['<?php echo esc_js($block_id); ?>'] = {
    interiorSchemes: <?php echo json_encode(array_map(function($scheme) {
        return array_map(function($img) {
            return isset($img['url']) ? $img['url'] : '';
        }, $scheme['gallery'] ?? []);
    }, $interior_schemes ?? [])); ?>,
    currentScheme: 0,
    currentImage: 0
};

document.addEventListener('DOMContentLoaded', function() {
    // Color selector functionality
    const colorButtons = document.querySelectorAll('#<?php echo esc_js($block_id); ?> .color-btn');
    const exteriorImages = document.querySelectorAll('#<?php echo esc_js($block_id); ?> .mobilhaus-exterior-img');

    colorButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const colorIndex = this.dataset.colorIndex;

            colorButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            exteriorImages.forEach(img => {
                img.classList.toggle('active', img.dataset.colorIndex === colorIndex);
            });
        });
    });

    // Grundriss toggle (switches between two different images)
    const grundrissToggle = document.querySelector('#<?php echo esc_js($block_id); ?> .grundriss-toggle');
    if (grundrissToggle) {
        const targetImg = document.getElementById(grundrissToggle.dataset.target);
        const normalSrc = grundrissToggle.dataset.normal;
        const reversedSrc = grundrissToggle.dataset.reversed;
        let isReversed = false;

        grundrissToggle.addEventListener('click', function() {
            isReversed = !isReversed;
            targetImg.style.opacity = '0';

            setTimeout(() => {
                targetImg.src = isReversed ? reversedSrc : normalSrc;
                targetImg.style.opacity = '1';
                this.querySelector('.toggle-text').textContent = isReversed ? 'Normal Version anzeigen' : 'Reversed Version anzeigen';
            }, 200);
        });
    }
});

// Lightbox functions
function openInteriorLightbox(blockId, schemeIndex, imageIndex) {
    const gallery = window.mobilhausGalleries[blockId];
    gallery.currentScheme = schemeIndex;
    gallery.currentImage = imageIndex;

    const lightbox = document.getElementById(`interior-lightbox-${blockId}`);
    const img = document.getElementById(`interior-lightbox-img-${blockId}`);
    const counter = document.getElementById(`interior-lightbox-counter-${blockId}`);

    const schemeImages = gallery.interiorSchemes[schemeIndex];
    img.src = schemeImages[imageIndex];
    counter.textContent = `${imageIndex + 1} / ${schemeImages.length}`;

    lightbox.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeInteriorLightbox(blockId) {
    document.getElementById(`interior-lightbox-${blockId}`).style.display = 'none';
    document.body.style.overflow = 'auto';
}

function navigateInteriorLightbox(blockId, direction) {
    const gallery = window.mobilhausGalleries[blockId];
    const schemeImages = gallery.interiorSchemes[gallery.currentScheme];

    gallery.currentImage += direction;

    if (gallery.currentImage < 0) {
        gallery.currentImage = schemeImages.length - 1;
    } else if (gallery.currentImage >= schemeImages.length) {
        gallery.currentImage = 0;
    }

    const img = document.getElementById(`interior-lightbox-img-${blockId}`);
    const counter = document.getElementById(`interior-lightbox-counter-${blockId}`);

    img.src = schemeImages[gallery.currentImage];
    counter.textContent = `${gallery.currentImage + 1} / ${schemeImages.length}`;
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const openLightbox = document.querySelector('.interior-lightbox[style*="display: flex"]');
    if (!openLightbox) return;

    const blockId = openLightbox.id.replace('interior-lightbox-', '');

    if (e.key === 'Escape') {
        closeInteriorLightbox(blockId);
    } else if (e.key === 'ArrowLeft') {
        navigateInteriorLightbox(blockId, -1);
    } else if (e.key === 'ArrowRight') {
        navigateInteriorLightbox(blockId, 1);
    }
});
</script>

<style>
/* Mobilhaus Complete Page Styles - PROFESSIONAL DESIGN */

/* Hero Section */
.mobilhaus-hero {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    padding: 80px 20px;
}

.mobilhaus-hero-content {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    gap: 60px;
    align-items: center;
    max-width: 1400px;
    margin: 0 auto;
}

.mobilhaus-title {
    font-size: 3.5rem;
    color: var(--color-primary);
    margin: 0 0 20px 0;
    font-weight: 800;
}

.mobilhaus-subtitle {
    font-size: 1.25rem;
    color: var(--color-text-secondary);
    margin: 0 0 40px 0;
    line-height: 1.7;
}

/* Color Selector */
.mobilhaus-color-selector {
    margin-top: 40px;
}

.color-selector-label {
    font-size: 1.125rem;
    font-weight: 600;
    margin-bottom: 16px;
}

.color-buttons {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
}

.color-btn {
    padding: 12px 24px;
    border-radius: 12px;
    border: 3px solid transparent;
    cursor: pointer;
    transition: all 0.3s ease;
    min-width: 120px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.color-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
}

.color-btn.active {
    border-color: var(--color-primary);
    box-shadow: 0 4px 20px rgba(var(--color-primary-rgb), 0.3);
}

.color-name {
    font-size: 0.875rem;
    font-weight: 600;
    color: #333;
    text-shadow: 0 1px 2px rgba(255, 255, 255, 0.8);
}

/* Hero Image */
.mobilhaus-hero-image {
    position: relative;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    aspect-ratio: 16 / 10;
}

.mobilhaus-exterior-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0;
    transition: opacity 0.5s ease;
}

.mobilhaus-exterior-img.active {
    opacity: 1;
    z-index: 1;
}

/* Description Section - Text LEFT, Image RIGHT */
.mobilhaus-description-section {
    background: #ffffff;
}

.description-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: start;
}

.description-text h2 {
    color: var(--color-primary);
    font-size: 2.5rem;
    margin-bottom: 24px;
    font-weight: 700;
}

.description-content {
    font-size: 1.125rem;
    line-height: 1.8;
    color: var(--color-text-primary);
    margin-bottom: 40px;
}

.description-content p {
    margin-bottom: 20px;
}

.description-image {
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
}

.description-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Specifications */
.mobilhaus-specs {
    background: var(--color-background);
    border-radius: 16px;
    padding: 32px;
    margin-top: 32px;
}

.mobilhaus-specs h3 {
    color: var(--color-primary);
    font-size: 1.5rem;
    margin-bottom: 24px;
}

.specs-list {
    display: grid;
    gap: 16px;
}

.spec-item {
    display: grid;
    grid-template-columns: 1fr 1fr;
    padding: 16px;
    background: #ffffff;
    border-radius: 12px;
    border-left: 4px solid var(--color-primary);
}

.spec-item dt {
    font-weight: 600;
    color: var(--color-text-secondary);
}

.spec-item dd {
    color: var(--color-text-primary);
    font-weight: 600;
    text-align: right;
}

/* Grundriss Section - Full Width */
.mobilhaus-grundriss-section {
    background: var(--color-background);
}

.mobilhaus-grundriss-section h2 {
    color: var(--color-primary);
    font-size: 2.5rem;
    margin-bottom: 40px;
    text-align: center;
}

.grundriss-viewer {
    max-width: 1000px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 24px;
    padding: 40px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
}

.grundriss-image-wrapper {
    border-radius: 16px;
    overflow: hidden;
    background: #f8f9fa;
}

.grundriss-img {
    width: 100%;
    height: auto;
    display: block;
    transition: opacity 0.3s ease;
}

.grundriss-controls {
    margin-top: 32px;
    display: flex;
    justify-content: center;
}

.grundriss-toggle {
    padding: 14px 32px;
    font-size: 1rem;
}

/* Interior Schemes - PROFESSIONAL STYLING */
.mobilhaus-interior-section {
    background: #ffffff;
}

.mobilhaus-interior-section .section-header {
    margin-bottom: 60px;
    text-align: center;
}

.mobilhaus-interior-section .section-header h2 {
    font-size: 2.5rem;
    color: var(--color-primary);
    margin-bottom: 16px;
}

.mobilhaus-interior-section .section-header p {
    font-size: 1.125rem;
    color: var(--color-text-secondary);
}

.interior-scheme-block {
    margin-bottom: 60px;
    padding: 40px;
    background: var(--color-background);
    border-radius: 24px;
}

.scheme-header {
    margin-bottom: 40px;
    text-align: center;
}

.scheme-title {
    font-size: 2rem;
    color: var(--color-primary);
    margin-bottom: 24px;
}

.scheme-palette-preview {
    max-width: 600px;
    margin: 0 auto 24px;
    border-radius: 16px;
    overflow: hidden;
}

.scheme-palette-preview img {
    width: 100%;
    height: auto;
    display: block;
}

.scheme-description {
    font-size: 1.125rem;
    color: var(--color-text-secondary);
}

/* Interior Gallery Grid - PROPER GAPS & ROUNDED EDGES */
.interior-gallery-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px; /* Proper gap between images */
}

.gallery-item {
    position: relative;
    aspect-ratio: 4 / 3;
    border-radius: 16px; /* Rounded edges */
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
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
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

.gallery-icon {
    font-size: 3rem;
    color: white;
}

/* Lightbox */
.interior-lightbox {
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
    background: none;
    border: none;
    cursor: pointer;
    z-index: 10001;
}

.lightbox-content {
    max-width: 90%;
    max-height: 90%;
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
@media (max-width: 1023px) {
    .mobilhaus-hero-content,
    .description-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }

    .interior-gallery-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }
}

@media (max-width: 767px) {
    .mobilhaus-title {
        font-size: 2.5rem;
    }

    .interior-gallery-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .gallery-item {
        border-radius: 12px;
    }
}

@media (max-width: 479px) {
    .mobilhaus-title {
        font-size: 2rem;
    }

    .interior-gallery-grid {
        grid-template-columns: 1fr;
    }
}

.section-padding {
    padding: 80px 0;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px;
}
</style>
