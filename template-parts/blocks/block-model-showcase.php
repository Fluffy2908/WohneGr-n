<?php
/**
 * Block: Model Showcase (Combined Hero + Color Options)
 *
 * For use in individual Mobilhaus posts
 */

// Hero fields
$hero_image = get_field('showcase_hero_image');
$tagline = get_field('showcase_tagline');
$badge = get_field('showcase_badge');
$specs = get_field('showcase_specs');

// Color options fields
$colors_title = get_field('showcase_colors_title') ?: 'Farboptionen';
$colors_subtitle = get_field('showcase_colors_subtitle');
$colors = get_field('showcase_colors_items');

$hero_bg_url = '';
if (!empty($hero_image)) {
    $hero_bg_url = is_array($hero_image) ? $hero_image['url'] : $hero_image;
}
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

<!-- Color Options Section -->
<?php if (!empty($colors) && is_array($colors)): ?>
<section class="model-showcase-colors section-padding">
    <div class="container">
        <div class="section-header text-center">
            <h2><?php echo esc_html($colors_title); ?></h2>
            <?php if (!empty($colors_subtitle)): ?>
                <p><?php echo esc_html($colors_subtitle); ?></p>
            <?php endif; ?>
        </div>

        <div class="showcase-colors-grid">
            <?php foreach ($colors as $color): ?>
                <div class="showcase-color-card">
                    <?php if (!empty($color['image'])): ?>
                        <div class="showcase-color-image">
                            <img src="<?php echo esc_url($color['image']['url']); ?>"
                                 alt="<?php echo esc_attr($color['name']); ?>"
                                 loading="lazy">
                        </div>
                    <?php endif; ?>

                    <div class="showcase-color-content">
                        <h3><?php echo esc_html($color['name']); ?></h3>

                        <?php if (!empty($color['exterior_color']) || !empty($color['interior_color'])): ?>
                            <div class="color-specs">
                                <?php if (!empty($color['exterior_color'])): ?>
                                    <div class="color-spec">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        </svg>
                                        <span class="color-spec-label">Außen:</span>
                                        <span class="color-spec-value"><?php echo esc_html($color['exterior_color']); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($color['interior_color'])): ?>
                                    <div class="color-spec">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                        </svg>
                                        <span class="color-spec-label">Innen:</span>
                                        <span class="color-spec-value"><?php echo esc_html($color['interior_color']); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($color['description'])): ?>
                            <p class="color-description"><?php echo esc_html($color['description']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

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

/* Color Options Section */
.model-showcase-colors {
    padding: 80px 0;
    background: #f8f9fa;
}

.section-header.text-center {
    text-align: center;
    margin-bottom: 50px;
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

.showcase-colors-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 30px;
}

.showcase-color-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.showcase-color-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
}

.showcase-color-image {
    width: 100%;
    height: 280px;
    overflow: hidden;
    background: #f0f0f0;
}

.showcase-color-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.showcase-color-card:hover .showcase-color-image img {
    transform: scale(1.05);
}

.showcase-color-content {
    padding: 30px;
}

.showcase-color-content h3 {
    margin: 0 0 20px 0;
    font-size: 1.6rem;
    color: #2d5016;
    font-weight: 600;
}

.color-specs {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin: 20px 0;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
}

.color-spec {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #555;
}

.color-spec svg {
    color: #2d5016;
    flex-shrink: 0;
}

.color-spec-label {
    font-weight: 600;
    font-size: 0.9rem;
}

.color-spec-value {
    color: #333;
}

.color-description {
    margin: 15px 0 0 0;
    color: #666;
    line-height: 1.6;
    font-size: 0.95rem;
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

    .showcase-colors-grid {
        grid-template-columns: 1fr;
    }

    .model-showcase-colors {
        padding: 60px 0;
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

    .showcase-color-image {
        height: 220px;
    }

    .showcase-color-content {
        padding: 20px;
    }
}
</style>
