<?php
/**
 * Block: Home Complete (All-in-One for Homepage)
 * Complete homepage with all sections in one block with LIVE PREVIEW
 */

// Get all fields
$hero_title = get_field('home_hero_title');
$hero_subtitle = get_field('home_hero_subtitle');
$hero_button_text = get_field('home_hero_button_text');
$hero_button_link = get_field('home_hero_button_link');
$hero_background = get_field('home_hero_background');

$features_title = get_field('home_features_title');
$features_subtitle = get_field('home_features_subtitle');
$features = get_field('home_features');

$models_title = get_field('home_models_title');
$models_subtitle = get_field('home_models_subtitle');
$selected_models = get_field('home_selected_models');

$cta_title = get_field('home_cta_title');
$cta_subtitle = get_field('home_cta_subtitle');
$cta_button_text = get_field('home_cta_button_text');
$cta_button_link = get_field('home_cta_button_link');

$block_id = 'home-complete-' . $block['id'];
?>

<div class="home-complete-page" id="<?php echo esc_attr($block_id); ?>">

    <!-- Hero Section -->
    <?php if ($hero_title || $hero_subtitle || $hero_button_text): ?>
    <section class="home-hero" style="background-image: url('<?php echo esc_url($hero_background['url'] ?? ''); ?>');">
        <div class="container">
            <div class="hero-content">
                <?php if ($hero_title): ?>
                    <h1><?php echo esc_html($hero_title); ?></h1>
                <?php endif; ?>

                <?php if ($hero_subtitle): ?>
                    <p class="hero-subtitle"><?php echo esc_html($hero_subtitle); ?></p>
                <?php endif; ?>

                <?php if ($hero_button_text && $hero_button_link): ?>
                    <a href="<?php echo esc_url($hero_button_link); ?>" class="btn btn-primary btn-lg">
                        <?php echo esc_html($hero_button_text); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Features Section -->
    <?php if ($features && is_array($features)): ?>
    <section class="home-features section-padding">
        <div class="container">
            <?php if ($features_title || $features_subtitle): ?>
            <div class="section-header text-center">
                <?php if ($features_title): ?>
                    <h2><?php echo esc_html($features_title); ?></h2>
                <?php endif; ?>
                <?php if ($features_subtitle): ?>
                    <p><?php echo esc_html($features_subtitle); ?></p>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <div class="features-grid">
                <?php foreach ($features as $feature): ?>
                    <div class="feature-card">
                        <?php if (isset($feature['icon'])): ?>
                            <div class="feature-icon">
                                <?php echo wohnegruen_get_icon($feature['icon']); ?>
                            </div>
                        <?php endif; ?>
                        <h3><?php echo esc_html($feature['title']); ?></h3>
                        <p><?php echo esc_html($feature['description']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Models Section -->
    <?php if ($selected_models && is_array($selected_models)): ?>
    <section class="home-models section-padding bg-light">
        <div class="container">
            <?php if ($models_title || $models_subtitle): ?>
            <div class="section-header text-center">
                <?php if ($models_title): ?>
                    <h2><?php echo esc_html($models_title); ?></h2>
                <?php endif; ?>
                <?php if ($models_subtitle): ?>
                    <p><?php echo esc_html($models_subtitle); ?></p>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <div class="models-grid">
                <?php foreach ($selected_models as $model): ?>
                    <div class="model-card">
                        <?php if (has_post_thumbnail($model->ID)): ?>
                            <div class="model-image">
                                <?php echo get_the_post_thumbnail($model->ID, 'large'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="model-content">
                            <h3><?php echo esc_html($model->post_title); ?></h3>
                            <a href="<?php echo get_permalink($model->ID); ?>" class="btn btn-primary">
                                Mehr erfahren
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- CTA Section -->
    <section class="home-cta section-padding">
        <div class="container">
            <div class="cta-banner">
                <?php if ($cta_title): ?>
                    <h2><?php echo esc_html($cta_title); ?></h2>
                <?php endif; ?>
                <?php if ($cta_subtitle): ?>
                    <p><?php echo esc_html($cta_subtitle); ?></p>
                <?php endif; ?>
                <?php if ($cta_button_text && $cta_button_link): ?>
                    <a href="<?php echo esc_url($cta_button_link); ?>" class="btn btn-primary btn-lg">
                        <?php echo esc_html($cta_button_text); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

</div>

<style>
/* Home Complete Styles */
.home-complete-page {
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
.home-hero {
    min-height: 600px;
    display: flex;
    align-items: center;
    background-size: cover;
    background-position: center;
    position: relative;
}

.home-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.4);
}

.hero-content {
    position: relative;
    z-index: 1;
    color: var(--color-white);
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.hero-content h1 {
    font-size: var(--font-size-4xl);
    margin-bottom: var(--spacing-lg);
}

.hero-subtitle {
    font-size: var(--font-size-xl);
    margin-bottom: var(--spacing-2xl);
}

/* Features */
.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--spacing-2xl);
}

.feature-card {
    background: var(--color-white);
    padding: var(--spacing-2xl);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-card);
    text-align: center;
    transition: var(--transition);
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-card-hover);
}

.feature-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto var(--spacing-lg);
    color: var(--color-primary);
}

.feature-icon svg {
    width: 100%;
    height: 100%;
}

.feature-card h3 {
    color: var(--color-primary);
    margin-bottom: var(--spacing-md);
}

/* Models */
.models-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: var(--spacing-2xl);
}

.model-card {
    background: var(--color-white);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-card);
    transition: var(--transition);
}

.model-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-card-hover);
}

.model-image img {
    width: 100%;
    height: 250px;
    object-fit: cover;
}

.model-content {
    padding: var(--spacing-xl);
    text-align: center;
}

.model-content h3 {
    color: var(--color-primary);
    margin-bottom: var(--spacing-lg);
}

/* CTA */
.cta-banner {
    text-align: center;
    padding: var(--spacing-3xl);
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
    border-radius: var(--radius-xl);
    color: var(--color-white);
}

.cta-banner h2 {
    color: var(--color-white);
    font-size: var(--font-size-3xl);
    margin-bottom: var(--spacing-md);
}

.cta-banner p {
    font-size: var(--font-size-xl);
    margin-bottom: var(--spacing-2xl);
}

.cta-banner .btn {
    background: var(--color-white);
    color: var(--color-primary);
}

.cta-banner .btn:hover {
    background: var(--color-background);
}

/* Button */
.btn {
    display: inline-flex;
    align-items: center;
    gap: var(--spacing-sm);
    padding: var(--spacing-md) var(--spacing-xl);
    border-radius: var(--radius-lg);
    font-weight: 600;
    text-decoration: none;
    transition: var(--transition);
    cursor: pointer;
}

.btn-primary {
    background: var(--color-primary);
    color: var(--color-white);
}

.btn-primary:hover {
    background: var(--color-primary-dark);
    transform: translateY(-2px);
    box-shadow: var(--shadow-card);
}

.btn-lg {
    padding: var(--spacing-lg) var(--spacing-2xl);
    font-size: var(--font-size-lg);
}

/* Section Header */
.section-header {
    margin-bottom: var(--spacing-3xl);
}

.section-header.text-center {
    text-align: center;
}

.section-header h2 {
    font-size: var(--font-size-3xl);
    color: var(--color-primary);
    margin-bottom: var(--spacing-md);
}

.section-header p {
    font-size: var(--font-size-lg);
    color: var(--color-text-secondary);
}

.bg-light {
    background: var(--color-background);
}

/* Responsive */
@media (max-width: 767px) {
    .container {
        padding: 0 var(--spacing-md);
    }

    .home-hero {
        min-height: 500px;
    }

    .hero-content h1 {
        font-size: var(--font-size-2xl);
    }

    .features-grid,
    .models-grid {
        grid-template-columns: 1fr;
    }

    .section-padding {
        padding: var(--spacing-2xl) 0;
    }
}
</style>
