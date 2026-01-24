<?php
/**
 * Block: Complete Mobilhaus Presentation
 * NEW DESIGN: Hero with background + Color buttons + Banner + Text/Image sections
 */

// Get all field data
$hero_title = get_field('mobilhaus_hero_title') ?: get_the_title();
$hero_subtitle = get_field('mobilhaus_hero_subtitle');
$color_variants = get_field('mobilhaus_color_variants');
$description_title = get_field('mobilhaus_description_title');
$description_text = get_field('mobilhaus_description_text');
$description_image = get_field('mobilhaus_description_image');
$specifications = get_field('mobilhaus_specifications');
$floor_plan_normal = get_field('mobilhaus_floor_plan_normal');
$floor_plan_reversed = get_field('mobilhaus_floor_plan_reversed');
$interior_schemes = get_field('mobilhaus_interior_schemes');

$block_id = isset($block['anchor']) ? $block['anchor'] : 'mobilhaus-' . $block['id'];

// Get hero background image (use first color variant's image or featured image)
$hero_bg_image = '';
if ($color_variants && isset($color_variants[0]['exterior_image']['url'])) {
    $hero_bg_image = $color_variants[0]['exterior_image']['url'];
} elseif (has_post_thumbnail()) {
    $hero_bg_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
}
?>

<article class="mobilhaus-complete-page" id="<?php echo esc_attr($block_id); ?>">

    <!-- HERO SECTION: Background Image + Green Filter + Centered Headline -->
    <section class="mobilhaus-hero-new" style="background-image: url('<?php echo esc_url($hero_bg_image); ?>');">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content-center">
                <?php if ($hero_title): ?>
                    <h1 class="hero-headline"><?php echo esc_html($hero_title); ?></h1>
                <?php endif; ?>
                <?php if ($hero_subtitle): ?>
                    <p class="hero-subtitle-text"><?php echo esc_html($hero_subtitle); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- COLOR SELECTION BUTTONS + EXTERIOR IMAGE -->
    <?php if ($color_variants && is_array($color_variants)): ?>
    <section class="color-selection-section section-padding">
        <div class="container">
            <h2 class="section-title">Wählen Sie Ihre Farbvariante</h2>

            <!-- Big Color Buttons -->
            <div class="big-color-buttons">
                <?php foreach ($color_variants as $index => $variant): ?>
                    <button
                        class="big-color-btn <?php echo $index === 0 ? 'active' : ''; ?>"
                        data-color-index="<?php echo $index; ?>"
                        onclick="switchExteriorColor(<?php echo $index; ?>)">
                        <span class="color-btn-text"><?php echo esc_html($variant['color_name']); ?></span>
                    </button>
                <?php endforeach; ?>
            </div>

            <!-- Exterior Image Display -->
            <div class="exterior-image-display">
                <?php foreach ($color_variants as $index => $variant): ?>
                    <img
                        class="exterior-img <?php echo $index === 0 ? 'active' : ''; ?>"
                        data-color-index="<?php echo $index; ?>"
                        src="<?php echo esc_url($variant['exterior_image']['url']); ?>"
                        alt="<?php echo esc_attr($hero_title . ' - ' . $variant['color_name']); ?>"
                        loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>">
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- DESCRIPTION BANNER: Full Width with Text -->
    <?php if ($description_title || $description_text): ?>
    <section class="description-banner">
        <div class="container">
            <?php if ($description_title): ?>
                <h2 class="banner-title"><?php echo esc_html($description_title); ?></h2>
            <?php endif; ?>
            <?php if ($description_text): ?>
                <div class="banner-text">
                    <?php echo wp_kses_post($description_text); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- DETAILS SECTION: Text LEFT, Image RIGHT -->
    <?php if ($specifications || $description_image): ?>
    <section class="details-section section-padding">
        <div class="container">
            <div class="details-grid">
                <!-- Left: Specifications Text -->
                <div class="details-text">
                    <?php if ($specifications && is_array($specifications)): ?>
                        <h3>Technische Daten</h3>
                        <dl class="specs-list">
                            <?php foreach ($specifications as $spec): ?>
                                <div class="spec-row">
                                    <dt><?php echo esc_html($spec['label']); ?></dt>
                                    <dd><?php echo esc_html($spec['value']); ?></dd>
                                </div>
                            <?php endforeach; ?>
                        </dl>
                    <?php endif; ?>
                </div>

                <!-- Right: Image -->
                <?php if ($description_image): ?>
                <div class="details-image">
                    <img src="<?php echo esc_url($description_image['url']); ?>"
                         alt="<?php echo esc_attr($description_image['alt'] ?: $hero_title); ?>"
                         loading="lazy">
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- GRUNDRISS SECTION -->
    <?php if ($floor_plan_normal): ?>
    <section class="grundriss-section section-padding">
        <div class="container">
            <h2 class="section-title">Grundriss</h2>

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
                        onclick="toggleGrundriss('<?php echo esc_js($block_id); ?>', '<?php echo esc_url($floor_plan_normal['url']); ?>', '<?php echo esc_url($floor_plan_reversed['url']); ?>')">
                        <span class="toggle-text">Reversed Version anzeigen</span>
                    </button>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- INTERIOR COLOR SCHEMES -->
    <?php if ($interior_schemes && is_array($interior_schemes)): ?>
    <section class="interior-schemes-section section-padding">
        <div class="container">
            <h2 class="section-title">Innenausstattung & Farbschemata</h2>
            <p class="section-subtitle">Wählen Sie aus verschiedenen hochwertigen Material- und Farbkombinationen</p>

            <?php foreach ($interior_schemes as $scheme_index => $scheme): ?>
                <div class="scheme-block">
                    <div class="scheme-header">
                        <h3><?php echo esc_html($scheme['scheme_name']); ?></h3>

                        <?php if (isset($scheme['color_palette_image']['url'])): ?>
                            <div class="palette-preview">
                                <img src="<?php echo esc_url($scheme['color_palette_image']['url']); ?>"
                                     alt="Palette <?php echo esc_attr($scheme['scheme_name']); ?>"
                                     loading="lazy">
                            </div>
                        <?php endif; ?>

                        <?php if (isset($scheme['scheme_description'])): ?>
                            <p class="scheme-desc"><?php echo esc_html($scheme['scheme_description']); ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Gallery Grid -->
                    <div class="interior-gallery">
                        <?php foreach ($scheme['gallery'] as $img_index => $image): ?>
                            <div class="gallery-item"
                                 onclick="openLightbox(<?php echo $scheme_index; ?>, <?php echo $img_index; ?>)">
                                <img src="<?php echo esc_url($image['sizes']['medium'] ?? $image['url']); ?>"
                                     alt="<?php echo esc_attr($scheme['scheme_name'] . ' - Ansicht ' . ($img_index + 1)); ?>"
                                     loading="lazy">
                                <div class="gallery-overlay">
                                    <span class="zoom-icon">🔍</span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Lightbox -->
    <div id="lightbox-<?php echo esc_attr($block_id); ?>" class="lightbox" onclick="closeLightbox()">
        <button class="lightbox-close" onclick="closeLightbox()">&times;</button>
        <button class="lightbox-prev" onclick="event.stopPropagation(); navigateLightbox(-1)">‹</button>
        <img class="lightbox-content" id="lightbox-img" src="" alt="">
        <button class="lightbox-next" onclick="event.stopPropagation(); navigateLightbox(1)">›</button>
        <div class="lightbox-counter" id="lightbox-counter"></div>
    </div>
    <?php endif; ?>

</article>

<style>
/* NEW PROFESSIONAL DESIGN */
.mobilhaus-complete-page {
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

.section-title {
    font-size: 2.5rem;
    color: var(--color-primary);
    margin-bottom: 40px;
    text-align: center;
    font-weight: 700;
}

.section-subtitle {
    text-align: center;
    font-size: 1.125rem;
    color: var(--color-text-secondary);
    margin-bottom: 60px;
}

/* HERO SECTION: Background Image + Green Filter + Centered Text */
.mobilhaus-hero-new {
    position: relative;
    min-height: 500px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: var(--color-primary);
    opacity: 0.85;
}

.hero-content-center {
    position: relative;
    z-index: 2;
    text-align: center;
    color: white;
    max-width: 800px;
    padding: 40px 20px;
}

.hero-headline {
    font-size: 4rem;
    font-weight: 800;
    margin: 0 0 20px 0;
    letter-spacing: -0.02em;
}

.hero-subtitle-text {
    font-size: 1.5rem;
    margin: 0;
    opacity: 0.95;
}

/* COLOR SELECTION SECTION */
.color-selection-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
}

.big-color-buttons {
    display: flex;
    gap: 30px;
    justify-content: center;
    margin-bottom: 60px;
    flex-wrap: wrap;
}

.big-color-btn {
    padding: 24px 60px;
    background: #ffffff;
    border: 4px solid #e5e7eb;
    border-radius: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    min-width: 200px;
}

.big-color-btn:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
    border-color: var(--color-primary);
}

.big-color-btn.active {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
    border-color: var(--color-primary);
    box-shadow: 0 12px 40px rgba(var(--color-primary-rgb), 0.3);
}

.big-color-btn.active .color-btn-text {
    color: white;
}

.color-btn-text {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--color-text-primary);
}

/* Exterior Image Display */
.exterior-image-display {
    position: relative;
    max-width: 1000px;
    margin: 0 auto;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 12px 48px rgba(0, 0, 0, 0.15);
    aspect-ratio: 16 / 10;
}

.exterior-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0;
    transition: opacity 0.5s ease;
}

.exterior-img.active {
    opacity: 1;
    z-index: 1;
}

/* DESCRIPTION BANNER: Full Width */
.description-banner {
    background: var(--color-primary);
    color: white;
    padding: 80px 20px;
    text-align: center;
}

.banner-title {
    font-size: 3rem;
    margin: 0 0 30px 0;
    font-weight: 700;
}

.banner-text {
    font-size: 1.25rem;
    line-height: 1.8;
    max-width: 1000px;
    margin: 0 auto;
}

.banner-text p {
    margin-bottom: 20px;
}

/* DETAILS SECTION: Text LEFT, Image RIGHT */
.details-section {
    background: #ffffff;
}

.details-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: start;
}

.details-text h3 {
    font-size: 2rem;
    color: var(--color-primary);
    margin-bottom: 32px;
    font-weight: 700;
}

.specs-list {
    display: grid;
    gap: 20px;
}

.spec-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    padding: 20px;
    background: var(--color-background);
    border-radius: 12px;
    border-left: 4px solid var(--color-primary);
}

.spec-row dt {
    font-weight: 600;
    color: var(--color-text-secondary);
    font-size: 1.125rem;
}

.spec-row dd {
    font-weight: 700;
    color: var(--color-text-primary);
    text-align: right;
    font-size: 1.125rem;
}

.details-image {
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 12px 48px rgba(0, 0, 0, 0.1);
}

.details-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* GRUNDRISS SECTION */
.grundriss-section {
    background: var(--color-background);
}

.grundriss-viewer {
    max-width: 1000px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 24px;
    padding: 40px;
    box-shadow: 0 12px 48px rgba(0, 0, 0, 0.1);
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

.btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 32px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
    font-family: inherit;
}

.btn-outline {
    background: transparent;
    color: var(--color-primary);
    border: 2px solid var(--color-primary);
}

.btn-outline:hover {
    background: var(--color-primary);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(var(--color-primary-rgb), 0.2);
}

/* INTERIOR SCHEMES */
.interior-schemes-section {
    background: #ffffff;
}

.scheme-block {
    margin-bottom: 80px;
    padding: 60px;
    background: var(--color-background);
    border-radius: 24px;
}

.scheme-header {
    text-align: center;
    margin-bottom: 50px;
}

.scheme-header h3 {
    font-size: 2.5rem;
    color: var(--color-primary);
    margin-bottom: 24px;
    font-weight: 700;
}

.palette-preview {
    max-width: 600px;
    margin: 0 auto 24px;
    border-radius: 16px;
    overflow: hidden;
}

.palette-preview img {
    width: 100%;
    height: auto;
    display: block;
}

.scheme-desc {
    font-size: 1.125rem;
    color: var(--color-text-secondary);
}

.interior-gallery {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
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

/* Lightbox */
.lightbox {
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
    .details-grid,
    .interior-gallery {
        grid-template-columns: 1fr;
        gap: 40px;
    }

    .interior-gallery {
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }
}

@media (max-width: 767px) {
    .hero-headline {
        font-size: 2.5rem;
    }

    .banner-title {
        font-size: 2rem;
    }

    .section-title {
        font-size: 2rem;
    }

    .interior-gallery {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .big-color-buttons {
        flex-direction: column;
        gap: 16px;
    }

    .big-color-btn {
        width: 100%;
    }

    .scheme-block {
        padding: 30px;
    }
}

@media (max-width: 479px) {
    .hero-headline {
        font-size: 2rem;
    }

    .interior-gallery {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
// Store gallery data
window.interiorGallery = <?php echo json_encode(array_map(function($scheme) {
    return array_map(function($img) {
        return isset($img['url']) ? $img['url'] : '';
    }, $scheme['gallery'] ?? []);
}, $interior_schemes ?? [])); ?>;

window.currentScheme = 0;
window.currentImage = 0;

// Color selection
function switchExteriorColor(colorIndex) {
    const buttons = document.querySelectorAll('.big-color-btn');
    const images = document.querySelectorAll('.exterior-img');

    buttons.forEach(btn => btn.classList.remove('active'));
    buttons[colorIndex].classList.add('active');

    images.forEach(img => {
        img.classList.toggle('active', img.dataset.colorIndex == colorIndex);
    });
}

// Grundriss toggle
let isReversed = false;
function toggleGrundriss(blockId, normalUrl, reversedUrl) {
    const img = document.getElementById('grundriss-img-' + blockId);
    const btn = event.target.closest('.grundriss-toggle');

    isReversed = !isReversed;
    img.style.opacity = '0';

    setTimeout(() => {
        img.src = isReversed ? reversedUrl : normalUrl;
        img.style.opacity = '1';
        btn.querySelector('.toggle-text').textContent = isReversed ? 'Normal Version anzeigen' : 'Reversed Version anzeigen';
    }, 200);
}

// Lightbox
function openLightbox(schemeIndex, imageIndex) {
    window.currentScheme = schemeIndex;
    window.currentImage = imageIndex;

    const lightbox = document.getElementById('lightbox-<?php echo esc_js($block_id); ?>');
    const img = document.getElementById('lightbox-img');
    const counter = document.getElementById('lightbox-counter');

    const schemeImages = window.interiorGallery[schemeIndex];
    img.src = schemeImages[imageIndex];
    counter.textContent = `${imageIndex + 1} / ${schemeImages.length}`;

    lightbox.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    document.getElementById('lightbox-<?php echo esc_js($block_id); ?>').style.display = 'none';
    document.body.style.overflow = 'auto';
}

function navigateLightbox(direction) {
    const schemeImages = window.interiorGallery[window.currentScheme];

    window.currentImage += direction;

    if (window.currentImage < 0) {
        window.currentImage = schemeImages.length - 1;
    } else if (window.currentImage >= schemeImages.length) {
        window.currentImage = 0;
    }

    const img = document.getElementById('lightbox-img');
    const counter = document.getElementById('lightbox-counter');

    img.src = schemeImages[window.currentImage];
    counter.textContent = `${window.currentImage + 1} / ${schemeImages.length}`;
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const lightbox = document.getElementById('lightbox-<?php echo esc_js($block_id); ?>');
    if (lightbox && lightbox.style.display === 'flex') {
        if (e.key === 'Escape') closeLightbox();
        else if (e.key === 'ArrowLeft') navigateLightbox(-1);
        else if (e.key === 'ArrowRight') navigateLightbox(1);
    }
});
</script>
