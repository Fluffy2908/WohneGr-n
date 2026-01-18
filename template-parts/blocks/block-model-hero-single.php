<?php
/**
 * Block: Model Hero (Single Model Page)
 *
 * For use in individual Mobilhaus posts
 */

$hero_image = get_field('single_model_hero_image');
$tagline = get_field('single_model_tagline');
$badge = get_field('single_model_badge');
$specs = get_field('single_model_specs');

$title = get_the_title();
?>

<section class="single-model-hero" <?php if (!empty($hero_image)): ?>style="background-image: url('<?php echo esc_url($hero_image['url']); ?>');"<?php endif; ?>>
    <div class="model-hero-overlay"></div>
    <div class="container">
        <div class="model-hero-content">
            <?php if (!empty($badge)): ?>
                <div class="model-badge"><?php echo esc_html($badge); ?></div>
            <?php endif; ?>
            <h1><?php echo esc_html($title); ?></h1>
            <?php if (!empty($tagline)): ?>
                <p class="model-hero-tagline"><?php echo esc_html($tagline); ?></p>
            <?php endif; ?>

            <?php if (!empty($specs)): ?>
                <div class="model-hero-specs">
                    <?php foreach ($specs as $spec): ?>
                        <div class="hero-spec">
                            <span class="spec-value"><?php echo esc_html($spec['value']); ?></span>
                            <span class="spec-label"><?php echo esc_html($spec['label']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<style>
.single-model-hero {
    position: relative;
    min-height: 500px;
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    padding: 100px 20px;
    margin-bottom: 0;
}

.single-model-hero .model-hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(45, 80, 22, 0.85) 0%, rgba(61, 107, 31, 0.75) 100%);
    z-index: 1;
}

.single-model-hero .model-hero-content {
    position: relative;
    z-index: 2;
    color: white;
    max-width: 800px;
}

.single-model-hero h1 {
    font-size: 3.5rem;
    margin: 0 0 15px 0;
    font-weight: 700;
    color: white;
}

.single-model-hero .model-hero-tagline {
    font-size: 1.5rem;
    margin: 0 0 30px 0;
    opacity: 0.95;
}

@media (max-width: 768px) {
    .single-model-hero {
        min-height: 400px;
        padding: 60px 20px;
    }

    .single-model-hero h1 {
        font-size: 2.5rem;
    }
}
</style>
