<?php
/**
 * Block: Models Complete (All-in-One for Modelle page with Nature/Pure toggle)
 * Modelle page with big toggle buttons for Nature and Pure models
 * Shows complete mobilhaus data for selected model - NO HARDCODED CONTENT
 */

// Get all fields
$hero_title = get_field('models_hero_title');
$hero_subtitle = get_field('models_hero_subtitle');
$hero_image = get_field('models_hero_image');

$intro_title = get_field('models_intro_title');
$intro_content = get_field('models_intro_content');

// Nature and Pure model selection
$nature_model = get_field('models_nature_model'); // Post object for Nature
$pure_model = get_field('models_pure_model'); // Post object for Pure

$block_id = 'models-complete-' . $block['id'];

// Function to get mobilhaus data
function get_mobilhaus_data($post_id) {
    if (!$post_id) return null;

    return array(
        'id' => $post_id,
        'title' => get_the_title($post_id),
        'hero_subtitle' => get_field('mobilhaus_hero_subtitle', $post_id),
        'color_variants' => get_field('mobilhaus_color_variants', $post_id),
        'description_title' => get_field('mobilhaus_description_title', $post_id),
        'description_text' => get_field('mobilhaus_description_text', $post_id),
        'description_image' => get_field('mobilhaus_description_image', $post_id),
        'specifications' => get_field('mobilhaus_specifications', $post_id),
        'floor_plan_normal' => get_field('mobilhaus_floor_plan_normal', $post_id),
        'floor_plan_reversed' => get_field('mobilhaus_floor_plan_reversed', $post_id),
        'interior_schemes' => get_field('mobilhaus_interior_schemes', $post_id),
    );
}

$nature_data = $nature_model ? get_mobilhaus_data($nature_model->ID) : null;
$pure_data = $pure_model ? get_mobilhaus_data($pure_model->ID) : null;

// Function to render mobilhaus content
function render_mobilhaus_content($data, $content_id) {
    if (!$data) return;

    $hero_title = $data['title'];
    $hero_subtitle = $data['hero_subtitle'];
    $color_variants = $data['color_variants'];
    $description_title = $data['description_title'];
    $description_text = $data['description_text'];
    $description_image = $data['description_image'];
    $specifications = $data['specifications'];
    $floor_plan_normal = $data['floor_plan_normal'];
    $floor_plan_reversed = $data['floor_plan_reversed'];
    $interior_schemes = $data['interior_schemes'];
    ?>

    <!-- Color Variants Hero -->
    <?php if ($color_variants && is_array($color_variants)): ?>
    <section class="mobilhaus-hero-colors">
        <div class="container">
            <div class="mobilhaus-hero-content">
                <div class="mobilhaus-hero-text">
                    <h2 class="mobilhaus-title"><?php echo esc_html($hero_title); ?></h2>
                    <?php if ($hero_subtitle): ?>
                        <p class="mobilhaus-subtitle"><?php echo esc_html($hero_subtitle); ?></p>
                    <?php endif; ?>

                    <!-- Color Selector Buttons -->
                    <div class="mobilhaus-color-selector">
                        <p class="color-selector-label">Wählen Sie Ihre Farbe:</p>
                        <div class="color-buttons">
                            <?php foreach ($color_variants as $index => $variant): ?>
                                <button
                                    class="color-btn <?php echo $index === 0 ? 'active' : ''; ?>"
                                    data-color-index="<?php echo $index; ?>"
                                    data-content-id="<?php echo esc_attr($content_id); ?>"
                                    style="background-color: <?php echo esc_attr($variant['color_code']); ?>;"
                                    aria-label="<?php echo esc_attr($variant['color_name']); ?>">
                                    <span class="color-name"><?php echo esc_html($variant['color_name']); ?></span>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Hero Image (changes with color selection) -->
                <div class="mobilhaus-hero-image">
                    <?php foreach ($color_variants as $index => $variant): ?>
                        <img
                            class="mobilhaus-exterior-img <?php echo $index === 0 ? 'active' : ''; ?>"
                            data-color-index="<?php echo $index; ?>"
                            data-content-id="<?php echo esc_attr($content_id); ?>"
                            src="<?php echo esc_url($variant['exterior_image']['url']); ?>"
                            alt="<?php echo esc_attr($hero_title . ' - ' . $variant['color_name']); ?>"
                            loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>">
                    <?php endforeach; ?>
                </div>
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
                        id="grundriss-img-<?php echo esc_attr($content_id); ?>"
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
                        data-target="grundriss-img-<?php echo esc_attr($content_id); ?>">
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
                                 onclick="openInteriorLightbox('<?php echo esc_js($content_id); ?>', <?php echo $scheme_index; ?>, <?php echo $img_index; ?>)">
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
    <div id="interior-lightbox-<?php echo esc_attr($content_id); ?>" class="interior-lightbox" onclick="closeInteriorLightbox('<?php echo esc_attr($content_id); ?>')">
        <button class="lightbox-close" onclick="closeInteriorLightbox('<?php echo esc_attr($content_id); ?>')">&times;</button>
        <button class="lightbox-prev" onclick="event.stopPropagation(); navigateInteriorLightbox('<?php echo esc_attr($content_id); ?>', -1)">‹</button>
        <img class="lightbox-content" id="interior-lightbox-img-<?php echo esc_attr($content_id); ?>" src="" alt="">
        <button class="lightbox-next" onclick="event.stopPropagation(); navigateInteriorLightbox('<?php echo esc_attr($content_id); ?>', 1)">›</button>
        <div class="lightbox-counter" id="interior-lightbox-counter-<?php echo esc_attr($content_id); ?>"></div>
    </div>

    <?php
}
?>

<div class="models-complete-page" id="<?php echo esc_attr($block_id); ?>">

    <!-- Hero Section -->
    <section class="models-hero" <?php if ($hero_image): ?>style="background-image: url('<?php echo esc_url($hero_image['url']); ?>');"<?php endif; ?>>
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

    <!-- Intro Section -->
    <?php if ($intro_title || $intro_content): ?>
    <section class="models-intro section-padding">
        <div class="container">
            <div class="intro-content text-center">
                <?php if ($intro_title): ?>
                    <h2><?php echo esc_html($intro_title); ?></h2>
                <?php endif; ?>
                <?php if ($intro_content): ?>
                    <div class="intro-text">
                        <?php echo wp_kses_post($intro_content); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Model Toggle Section -->
    <?php if ($nature_data || $pure_data): ?>
    <section class="model-toggle-section section-padding">
        <div class="container">
            <!-- BIG Toggle Buttons -->
            <div class="model-toggle-buttons">
                <?php if ($nature_data): ?>
                <button class="model-toggle-btn active" data-model="nature">
                    <span class="toggle-icon">🌲</span>
                    <span class="toggle-label">Nature</span>
                    <span class="toggle-subtitle"><?php echo esc_html($nature_data['title']); ?></span>
                </button>
                <?php endif; ?>

                <?php if ($pure_data): ?>
                <button class="model-toggle-btn <?php echo !$nature_data ? 'active' : ''; ?>" data-model="pure">
                    <span class="toggle-icon">✨</span>
                    <span class="toggle-label">Pure</span>
                    <span class="toggle-subtitle"><?php echo esc_html($pure_data['title']); ?></span>
                </button>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Nature Model Content (Mobilhaus Complete Style) -->
    <?php if ($nature_data): ?>
    <div class="model-content-wrapper" data-model-content="nature" style="display:block;">
        <?php render_mobilhaus_content($nature_data, $block_id . '-nature'); ?>
    </div>
    <?php endif; ?>

    <!-- Pure Model Content (Mobilhaus Complete Style) -->
    <?php if ($pure_data): ?>
    <div class="model-content-wrapper" data-model-content="pure" style="display:<?php echo $nature_data ? 'none' : 'block'; ?>;">
        <?php render_mobilhaus_content($pure_data, $block_id . '-pure'); ?>
    </div>
    <?php endif; ?>

    <?php endif; ?>

</div>

<style>
/* Models Complete Styles - PROFESSIONAL DESIGN */
.models-complete-page {
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

/* Hero */
.models-hero {
    min-height: 400px;
    display: flex;
    align-items: center;
    background-size: cover;
    background-position: center;
    position: relative;
    background-color: var(--color-primary);
}

.models-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.4);
}

.hero-content {
    position: relative;
    z-index: 1;
    color: var(--color-white);
}

.hero-content.text-center {
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.hero-content h1 {
    font-size: 3.5rem;
    margin-bottom: 20px;
}

.hero-subtitle {
    font-size: 1.25rem;
}

/* Intro */
.intro-content {
    max-width: 900px;
    margin: 0 auto;
}

.intro-content.text-center {
    text-align: center;
}

.intro-content h2 {
    font-size: 2.5rem;
    color: var(--color-primary);
    margin-bottom: 20px;
}

.intro-text {
    font-size: 1.125rem;
    color: var(--color-text-secondary);
    line-height: 1.8;
}

/* BIG Model Toggle Buttons */
.model-toggle-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
}

.model-toggle-buttons {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 40px;
    max-width: 900px;
    margin: 0 auto;
}

.model-toggle-btn {
    padding: 60px 40px;
    background: #ffffff;
    border: 4px solid #e5e7eb;
    border-radius: 24px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 16px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.model-toggle-btn:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
    border-color: var(--color-primary);
}

.model-toggle-btn.active {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
    border-color: var(--color-primary);
    color: white;
    box-shadow: 0 12px 40px rgba(var(--color-primary-rgb), 0.3);
}

.toggle-icon {
    font-size: 4rem;
    opacity: 0.9;
}

.toggle-label {
    font-size: 2.5rem;
    font-weight: 800;
    letter-spacing: -0.02em;
}

.toggle-subtitle {
    font-size: 1.125rem;
    opacity: 0.9;
    font-weight: 500;
}

.model-content-wrapper {
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

/* Mobilhaus Content Styles */
.mobilhaus-hero-colors {
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

.btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    border-radius: 12px;
    font-weight: 600;
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

    .model-toggle-buttons {
        grid-template-columns: 1fr;
        gap: 24px;
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

    .hero-content h1 {
        font-size: 2.5rem;
    }

    .model-toggle-btn {
        padding: 40px 24px;
    }

    .toggle-label {
        font-size: 2rem;
    }

    .toggle-icon {
        font-size: 3rem;
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
</style>

<script>
// Store gallery data for each model
window.mobilhausGalleries = window.mobilhausGalleries || {};

document.addEventListener('DOMContentLoaded', function() {
    const pageBlock = document.getElementById('<?php echo esc_js($block_id); ?>');
    if (!pageBlock) return;

    // Store gallery data for each model content
    <?php if ($nature_data && isset($nature_data['interior_schemes'])): ?>
    window.mobilhausGalleries['<?php echo esc_js($block_id . '-nature'); ?>'] = {
        interiorSchemes: <?php echo json_encode(array_map(function($scheme) {
            return array_map(function($img) {
                return isset($img['url']) ? $img['url'] : '';
            }, $scheme['gallery'] ?? []);
        }, $nature_data['interior_schemes'])); ?>,
        currentScheme: 0,
        currentImage: 0
    };
    <?php endif; ?>

    <?php if ($pure_data && isset($pure_data['interior_schemes'])): ?>
    window.mobilhausGalleries['<?php echo esc_js($block_id . '-pure'); ?>'] = {
        interiorSchemes: <?php echo json_encode(array_map(function($scheme) {
            return array_map(function($img) {
                return isset($img['url']) ? $img['url'] : '';
            }, $scheme['gallery'] ?? []);
        }, $pure_data['interior_schemes'])); ?>,
        currentScheme: 0,
        currentImage: 0
    };
    <?php endif; ?>

    // Model toggle functionality
    const toggleBtns = pageBlock.querySelectorAll('.model-toggle-btn');
    const contentWrappers = pageBlock.querySelectorAll('.model-content-wrapper');

    toggleBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const model = this.dataset.model;

            // Update button states
            toggleBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            // Show/hide content
            contentWrappers.forEach(wrapper => {
                if (wrapper.dataset.modelContent === model) {
                    wrapper.style.display = 'block';
                    wrapper.style.animation = 'fadeIn 0.5s ease';
                } else {
                    wrapper.style.display = 'none';
                }
            });
        });
    });

    // Color selector functionality (works for both models)
    const colorButtons = pageBlock.querySelectorAll('.color-btn');
    colorButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const colorIndex = this.dataset.colorIndex;
            const contentId = this.dataset.contentId;

            // Get all buttons and images for this specific model
            const scopedButtons = pageBlock.querySelectorAll(`.color-btn[data-content-id="${contentId}"]`);
            const scopedImages = pageBlock.querySelectorAll(`.mobilhaus-exterior-img[data-content-id="${contentId}"]`);

            scopedButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            scopedImages.forEach(img => {
                img.classList.toggle('active', img.dataset.colorIndex === colorIndex);
            });
        });
    });

    // Grundriss toggle (works for both models)
    const grundrissToggles = pageBlock.querySelectorAll('.grundriss-toggle');
    grundrissToggles.forEach(toggle => {
        const targetImg = document.getElementById(toggle.dataset.target);
        if (!targetImg) return;

        const normalSrc = toggle.dataset.normal;
        const reversedSrc = toggle.dataset.reversed;
        let isReversed = false;

        toggle.addEventListener('click', function() {
            isReversed = !isReversed;
            targetImg.style.opacity = '0';

            setTimeout(() => {
                targetImg.src = isReversed ? reversedSrc : normalSrc;
                targetImg.style.opacity = '1';
                this.querySelector('.toggle-text').textContent = isReversed ? 'Normal Version anzeigen' : 'Reversed Version anzeigen';
            }, 200);
        });
    });
});

// Lightbox functions
function openInteriorLightbox(blockId, schemeIndex, imageIndex) {
    const gallery = window.mobilhausGalleries[blockId];
    if (!gallery) return;

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
    if (!gallery) return;

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
