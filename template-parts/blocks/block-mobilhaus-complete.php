<?php
/**
 * Block: Complete Mobilhaus Presentation
 * All-in-one block for mobilhaus model pages inspired by Hosekra design
 * Includes: Hero, Color Selector, Description, Floor Plans, Interior Gallery
 */

// Get all field data
$hero_title = get_field('mobilhaus_hero_title') ?: get_the_title();
$hero_subtitle = get_field('mobilhaus_hero_subtitle');

// Color variants (exterior images)
$color_variants = get_field('mobilhaus_color_variants'); // Repeater: color_name, color_code, exterior_image

// Description section
$description_title = get_field('mobilhaus_description_title') ?: 'Über dieses Modell';
$description_text = get_field('mobilhaus_description_text');

// Floor plan
$floor_plan_image = get_field('mobilhaus_floor_plan');
$floor_plan_mirrored = get_field('mobilhaus_floor_plan_mirrored');

// Interior color schemes (like Hosekra)
$interior_schemes = get_field('mobilhaus_interior_schemes'); // Repeater: scheme_name, color_palette_image, gallery

// Specifications
$specifications = get_field('mobilhaus_specifications'); // Repeater: label, value

// Layout options
$reverse_hero = get_field('mobilhaus_reverse_hero'); // True/false
$reverse_details = get_field('mobilhaus_reverse_details'); // True/false

$block_id = isset($block['anchor']) ? $block['anchor'] : 'mobilhaus-' . $block['id'];
?>

<article class="mobilhaus-complete-page" id="<?php echo esc_attr($block_id); ?>">

    <!-- Hero Section with Color Selector -->
    <section class="mobilhaus-hero">
        <div class="container">
            <div class="mobilhaus-hero-content<?php echo $reverse_hero ? ' reverse' : ''; ?>">
                <div class="mobilhaus-hero-text">
                    <h1 class="mobilhaus-title"><?php echo esc_html($hero_title); ?></h1>
                    <?php if ($hero_subtitle): ?>
                        <p class="mobilhaus-subtitle"><?php echo esc_html($hero_subtitle); ?></p>
                    <?php endif; ?>

                    <!-- Color Selector Buttons -->
                    <?php if ($color_variants && is_array($color_variants)): ?>
                        <div class="mobilhaus-color-selector" role="group" aria-label="Farbauswahl">
                            <p class="color-selector-label">Wählen Sie Ihre Farbe:</p>
                            <div class="color-buttons">
                                <?php foreach ($color_variants as $index => $variant): ?>
                                    <?php if (isset($variant['color_name']) && isset($variant['exterior_image']['url'])): ?>
                                        <button
                                            class="color-btn <?php echo $index === 0 ? 'active' : ''; ?>"
                                            data-color-index="<?php echo $index; ?>"
                                            style="background-color: <?php echo esc_attr($variant['color_code'] ?? '#ffffff'); ?>; <?php echo (strtolower($variant['color_name']) === 'weiß' || strtolower($variant['color_name']) === 'white') ? 'border: 2px solid var(--color-border);' : ''; ?>"
                                            aria-label="<?php echo esc_attr($variant['color_name']); ?> auswählen"
                                            aria-pressed="<?php echo $index === 0 ? 'true' : 'false'; ?>">
                                            <span class="color-name"><?php echo esc_html($variant['color_name']); ?></span>
                                        </button>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Hero Image (changes with color selection) -->
                <div class="mobilhaus-hero-image">
                    <?php if ($color_variants && is_array($color_variants)): ?>
                        <?php foreach ($color_variants as $index => $variant): ?>
                            <?php if (isset($variant['exterior_image']['url'])): ?>
                                <img
                                    class="mobilhaus-exterior-img <?php echo $index === 0 ? 'active' : ''; ?>"
                                    data-color-index="<?php echo $index; ?>"
                                    src="<?php echo esc_url($variant['exterior_image']['url']); ?>"
                                    alt="<?php echo esc_attr($hero_title . ' - ' . $variant['color_name']); ?>"
                                    loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>">
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Description + Floor Plan Section -->
    <section class="mobilhaus-details-section section-padding">
        <div class="container">
            <div class="mobilhaus-details-grid<?php echo $reverse_details ? ' reverse' : ''; ?>">
                <!-- Left: Description -->
                <div class="mobilhaus-description">
                    <h2><?php echo esc_html($description_title); ?></h2>
                    <div class="description-content">
                        <?php echo wp_kses_post($description_text); ?>
                    </div>

                    <?php if ($specifications && is_array($specifications)): ?>
                        <div class="mobilhaus-specs">
                            <h3>Technische Daten</h3>
                            <dl class="specs-list">
                                <?php foreach ($specifications as $spec): ?>
                                    <?php if (isset($spec['label']) && isset($spec['value'])): ?>
                                        <div class="spec-item">
                                            <dt><?php echo esc_html($spec['label']); ?></dt>
                                            <dd><?php echo esc_html($spec['value']); ?></dd>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </dl>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Right: Floor Plan with Mirror Option -->
                <div class="mobilhaus-floorplan">
                    <h3>Grundriss</h3>

                    <?php if ($floor_plan_image && isset($floor_plan_image['url'])): ?>
                        <div class="floorplan-viewer">
                            <div class="floorplan-image-wrapper">
                                <img
                                    class="floorplan-img"
                                    id="floorplan-img-<?php echo esc_attr($block_id); ?>"
                                    src="<?php echo esc_url($floor_plan_image['url']); ?>"
                                    alt="<?php echo esc_attr($hero_title); ?> Grundriss"
                                    loading="lazy">
                            </div>

                            <?php if ($floor_plan_mirrored && isset($floor_plan_mirrored['url'])): ?>
                                <div class="floorplan-controls">
                                    <button
                                        class="btn btn-outline mirror-toggle"
                                        data-normal="<?php echo esc_url($floor_plan_image['url']); ?>"
                                        data-mirrored="<?php echo esc_url($floor_plan_mirrored['url']); ?>"
                                        data-target="floorplan-img-<?php echo esc_attr($block_id); ?>"
                                        aria-label="Grundriss spiegeln">
                                        <?php echo wohnegruen_get_icon('refresh'); ?>
                                        <span class="toggle-text">Grundriss spiegeln</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <p class="floorplan-note">Klicken Sie auf das Bild für eine vergrößerte Ansicht</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Interior Color Schemes Section (Hosekra-style) -->
    <?php if ($interior_schemes && is_array($interior_schemes)): ?>
        <section class="mobilhaus-interior-section section-padding">
            <div class="container">
                <div class="section-header">
                    <h2>Innenausstattung & Farbvarianten</h2>
                    <p>Wählen Sie aus verschiedenen hochwertigen Material- und Farbkombinationen</p>
                </div>

                <?php foreach ($interior_schemes as $scheme_index => $scheme): ?>
                    <?php if (isset($scheme['scheme_name']) && isset($scheme['gallery']) && is_array($scheme['gallery'])): ?>
                        <div class="interior-scheme-block" id="scheme-<?php echo $scheme_index; ?>">
                            <div class="scheme-header">
                                <h3 class="scheme-title"><?php echo esc_html($scheme['scheme_name']); ?></h3>

                                <?php if (isset($scheme['color_palette_image']['url'])): ?>
                                    <div class="scheme-palette-preview">
                                        <img
                                            src="<?php echo esc_url($scheme['color_palette_image']['url']); ?>"
                                            alt="Farbpalette <?php echo esc_attr($scheme['scheme_name']); ?>"
                                            loading="lazy">
                                    </div>
                                <?php endif; ?>

                                <?php if (isset($scheme['scheme_description'])): ?>
                                    <p class="scheme-description"><?php echo esc_html($scheme['scheme_description']); ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Gallery Grid (4 columns, Hosekra-style) -->
                            <div class="interior-gallery-grid">
                                <?php foreach ($scheme['gallery'] as $img_index => $image): ?>
                                    <?php if (isset($image['url'])): ?>
                                        <div class="gallery-item"
                                             onclick="openInteriorLightbox('<?php echo esc_js($block_id); ?>', <?php echo $scheme_index; ?>, <?php echo $img_index; ?>)">
                                            <img
                                                src="<?php echo esc_url($image['sizes']['medium'] ?? $image['url']); ?>"
                                                alt="<?php echo esc_attr($scheme['scheme_name'] . ' - Ansicht ' . ($img_index + 1)); ?>"
                                                loading="lazy">
                                            <div class="gallery-overlay">
                                                <?php echo wohnegruen_get_icon('search'); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- Lightbox for Interior Images -->
    <div id="interior-lightbox-<?php echo esc_attr($block_id); ?>" class="interior-lightbox" onclick="closeInteriorLightbox('<?php echo esc_attr($block_id); ?>')">
        <button class="lightbox-close" onclick="closeInteriorLightbox('<?php echo esc_attr($block_id); ?>')" aria-label="Schließen">&times;</button>
        <button class="lightbox-nav lightbox-prev" onclick="event.stopPropagation(); navigateInteriorLightbox('<?php echo esc_attr($block_id); ?>', -1)" aria-label="Vorheriges Bild">
            <?php echo wohnegruen_get_icon('arrow-left'); ?>
        </button>
        <img class="lightbox-content" id="interior-lightbox-img-<?php echo esc_attr($block_id); ?>" src="" alt="">
        <button class="lightbox-nav lightbox-next" onclick="event.stopPropagation(); navigateInteriorLightbox('<?php echo esc_attr($block_id); ?>', 1)" aria-label="Nächstes Bild">
            <?php echo wohnegruen_get_icon('arrow-right'); ?>
        </button>
        <div class="lightbox-counter" id="interior-lightbox-counter-<?php echo esc_attr($block_id); ?>"></div>
    </div>

</article>

<script>
// Store gallery data globally
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

// Color selector functionality
document.addEventListener('DOMContentLoaded', function() {
    const colorButtons = document.querySelectorAll('#<?php echo esc_js($block_id); ?> .color-btn');
    const exteriorImages = document.querySelectorAll('#<?php echo esc_js($block_id); ?> .mobilhaus-exterior-img');

    colorButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const colorIndex = this.dataset.colorIndex;

            // Update button states
            colorButtons.forEach(b => {
                b.classList.remove('active');
                b.setAttribute('aria-pressed', 'false');
            });
            this.classList.add('active');
            this.setAttribute('aria-pressed', 'true');

            // Update image visibility
            exteriorImages.forEach(img => {
                if (img.dataset.colorIndex === colorIndex) {
                    img.classList.add('active');
                } else {
                    img.classList.remove('active');
                }
            });
        });
    });

    // Floor plan mirror toggle
    const mirrorToggle = document.querySelector('#<?php echo esc_js($block_id); ?> .mirror-toggle');
    if (mirrorToggle) {
        const targetImg = document.getElementById(mirrorToggle.dataset.target);
        const normalSrc = mirrorToggle.dataset.normal;
        const mirroredSrc = mirrorToggle.dataset.mirrored;
        let isMirrored = false;

        mirrorToggle.addEventListener('click', function() {
            isMirrored = !isMirrored;
            targetImg.style.opacity = '0';

            setTimeout(() => {
                targetImg.src = isMirrored ? mirroredSrc : normalSrc;
                targetImg.style.opacity = '1';
                this.classList.toggle('active', isMirrored);
                this.querySelector('.toggle-text').textContent = isMirrored ? 'Original anzeigen' : 'Grundriss spiegeln';
            }, 200);
        });
    }
});

// Interior lightbox functions
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
/* Mobilhaus Complete Page Styles */

/* Hero Section */
.mobilhaus-hero {
    background: linear-gradient(135deg, var(--color-background) 0%, var(--color-white) 100%);
    padding: var(--spacing-3xl) var(--spacing-lg);
    margin-bottom: var(--spacing-3xl);
}

/* Section Padding Utility */
.section-padding {
    padding: var(--spacing-3xl) 0;
}

/* Container Utility */
.mobilhaus-complete-page .container {
    max-width: 1400px;
    margin-left: auto;
    margin-right: auto;
    padding-left: var(--spacing-lg);
    padding-right: var(--spacing-lg);
}

.mobilhaus-hero-content {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    gap: var(--spacing-3xl);
    align-items: center;
    max-width: 1400px;
    margin: 0 auto;
}

.mobilhaus-hero-content.reverse {
    grid-template-columns: 1.2fr 1fr;
}

.mobilhaus-hero-content.reverse .mobilhaus-hero-text {
    order: 2;
}

.mobilhaus-hero-content.reverse .mobilhaus-hero-image {
    order: 1;
}

.mobilhaus-title {
    font-size: var(--font-size-4xl);
    color: var(--color-primary);
    margin: 0 0 var(--spacing-md) 0;
    font-weight: 700;
}

.mobilhaus-subtitle {
    font-size: var(--font-size-xl);
    color: var(--color-text-secondary);
    margin: 0 0 var(--spacing-2xl) 0;
    line-height: 1.6;
}

/* Color Selector */
.mobilhaus-color-selector {
    margin-top: var(--spacing-2xl);
}

.color-selector-label {
    font-size: var(--font-size-lg);
    font-weight: 600;
    color: var(--color-text-primary);
    margin-bottom: var(--spacing-md);
}

.color-buttons {
    display: flex;
    gap: var(--spacing-md);
    flex-wrap: wrap;
}

.color-btn {
    padding: var(--spacing-md) var(--spacing-xl);
    border-radius: var(--radius-lg);
    border: 3px solid transparent;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: var(--spacing-xs);
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
    font-size: var(--font-size-sm);
    font-weight: 600;
    color: var(--color-text-primary);
    text-shadow: 0 1px 2px rgba(255, 255, 255, 0.8);
}

/* Hero Image */
.mobilhaus-hero-image {
    position: relative;
    border-radius: var(--radius-xl);
    overflow: hidden;
    box-shadow: var(--shadow-lg);
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

/* Details Section */
.mobilhaus-details-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--spacing-3xl);
    align-items: start;
}

.mobilhaus-details-grid.reverse .mobilhaus-description {
    order: 2;
}

.mobilhaus-details-grid.reverse .mobilhaus-floorplan {
    order: 1;
}

.mobilhaus-description h2 {
    color: var(--color-primary);
    font-size: var(--font-size-3xl);
    margin-bottom: var(--spacing-lg);
}

.description-content {
    font-size: var(--font-size-md);
    line-height: 1.8;
    color: var(--color-text-primary);
    margin-bottom: var(--spacing-2xl);
}

.description-content p {
    margin-bottom: var(--spacing-lg);
}

/* Specifications */
.mobilhaus-specs {
    background: var(--color-background);
    border-radius: var(--radius-lg);
    padding: var(--spacing-xl);
    margin-top: var(--spacing-2xl);
}

.mobilhaus-specs h3 {
    color: var(--color-primary);
    font-size: var(--font-size-xl);
    margin-bottom: var(--spacing-lg);
}

.specs-list {
    display: grid;
    gap: var(--spacing-md);
}

.spec-item {
    display: grid;
    grid-template-columns: 1fr 1fr;
    padding: var(--spacing-md);
    background: var(--color-white);
    border-radius: var(--radius);
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

/* Floor Plan */
.mobilhaus-floorplan h3 {
    color: var(--color-primary);
    font-size: var(--font-size-2xl);
    margin-bottom: var(--spacing-lg);
}

.floorplan-viewer {
    background: var(--color-background);
    border-radius: var(--radius-xl);
    padding: var(--spacing-xl);
}

.floorplan-image-wrapper {
    border-radius: var(--radius-lg);
    overflow: hidden;
    background: var(--color-white);
    box-shadow: var(--shadow-card);
    cursor: pointer;
}

.floorplan-img {
    width: 100%;
    height: auto;
    display: block;
    transition: opacity 0.3s ease;
}

.floorplan-controls {
    margin-top: var(--spacing-lg);
    display: flex;
    justify-content: center;
}

.mirror-toggle {
    display: inline-flex;
    align-items: center;
    gap: var(--spacing-sm);
}

.mirror-toggle.active {
    background: var(--color-primary);
    color: var(--color-white);
    border-color: var(--color-primary);
}

.floorplan-note {
    text-align: center;
    font-size: var(--font-size-sm);
    color: var(--color-text-muted);
    margin-top: var(--spacing-md);
}

/* Interior Schemes Section */
.mobilhaus-interior-section {
    background: var(--color-background);
}

.mobilhaus-interior-section .section-header {
    margin-bottom: var(--spacing-3xl);
    text-align: center;
}

.mobilhaus-interior-section .section-header h2 {
    font-size: var(--font-size-3xl);
    color: var(--color-primary);
    margin-bottom: var(--spacing-md);
}

.mobilhaus-interior-section .section-header p {
    font-size: var(--font-size-lg);
    color: var(--color-text-secondary);
    max-width: 800px;
    margin: 0 auto;
}

.interior-scheme-block {
    margin-bottom: var(--spacing-3xl);
    padding: var(--spacing-2xl);
    background: var(--color-white);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow-card);
}

.scheme-header {
    margin-bottom: var(--spacing-2xl);
    text-align: center;
}

.scheme-title {
    font-size: var(--font-size-2xl);
    color: var(--color-primary);
    margin-bottom: var(--spacing-lg);
}

.scheme-palette-preview {
    max-width: 600px;
    margin: 0 auto var(--spacing-lg);
}

.scheme-palette-preview img {
    width: 100%;
    height: auto;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-card);
}

.scheme-description {
    font-size: var(--font-size-md);
    color: var(--color-text-secondary);
    max-width: 800px;
    margin: 0 auto;
}

/* Interior Gallery Grid (Hosekra-style 4 columns) */
.interior-gallery-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: var(--spacing-lg);
}

.gallery-item {
    position: relative;
    aspect-ratio: 4 / 3;
    border-radius: var(--radius-lg);
    overflow: hidden;
    cursor: pointer;
    background: var(--color-background);
    transition: var(--transition);
}

.gallery-item:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-card-hover);
}

.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}

.gallery-item:hover img {
    transform: scale(1.05);
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
    transition: var(--transition);
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.gallery-overlay svg {
    width: 48px;
    height: 48px;
    color: var(--color-white);
}

/* Interior Lightbox */
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
    color: var(--color-white);
    background: none;
    border: none;
    cursor: pointer;
    z-index: 10001;
    line-height: 1;
    transition: var(--transition);
}

.lightbox-close:hover {
    transform: rotate(90deg);
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
    transition: var(--transition);
    z-index: 10001;
}

.lightbox-nav:hover {
    background: rgba(255, 255, 255, 0.3);
}

.lightbox-nav svg {
    width: 32px;
    height: 32px;
    color: var(--color-white);
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
    color: var(--color-white);
    font-size: var(--font-size-lg);
    background: rgba(0, 0, 0, 0.5);
    padding: var(--spacing-sm) var(--spacing-lg);
    border-radius: 50px;
}

/* Responsive Design */
@media (max-width: 1023px) {
    .mobilhaus-hero-content {
        grid-template-columns: 1fr;
        gap: var(--spacing-2xl);
    }

    .mobilhaus-details-grid {
        grid-template-columns: 1fr;
    }

    .interior-gallery-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 767px) {
    .section-padding {
        padding: var(--spacing-2xl) 0;
    }

    .mobilhaus-complete-page .container {
        padding-left: var(--spacing-md);
        padding-right: var(--spacing-md);
    }

    .mobilhaus-title {
        font-size: var(--font-size-3xl);
    }

    .mobilhaus-subtitle {
        font-size: var(--font-size-lg);
    }

    .color-buttons {
        justify-content: center;
    }

    .color-btn {
        min-width: 100px;
        padding: var(--spacing-sm) var(--spacing-lg);
    }

    .interior-gallery-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: var(--spacing-md);
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
}

@media (max-width: 479px) {
    .mobilhaus-hero {
        padding: var(--spacing-2xl) var(--spacing-md);
    }

    .mobilhaus-title {
        font-size: var(--font-size-2xl);
    }

    .interior-gallery-grid {
        grid-template-columns: 1fr;
    }

    .spec-item {
        grid-template-columns: 1fr;
        text-align: left;
    }

    .spec-item dd {
        text-align: left;
        margin-top: var(--spacing-xs);
    }
}
</style>
