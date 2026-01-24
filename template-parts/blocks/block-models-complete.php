<?php
/**
 * Block: Models Complete (All-in-One for Modelle listing page)
 * Complete models listing/archive page with filters with LIVE PREVIEW
 */

// Get all fields
$hero_title = get_field('models_hero_title');
$hero_subtitle = get_field('models_hero_subtitle');
$hero_image = get_field('models_hero_image');

$intro_title = get_field('models_intro_title');
$intro_content = get_field('models_intro_content');

$show_filters = get_field('models_show_filters');
$filter_by = get_field('models_filter_by'); // 'category', 'size', 'none'

// Get all mobilhaus posts
$args = array(
    'post_type' => 'mobilhaus',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC'
);
$mobilhaus_posts = get_posts($args);

$block_id = 'models-complete-' . $block['id'];
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

    <!-- Models Listing Section -->
    <?php if ($mobilhaus_posts): ?>
    <section class="models-listing section-padding bg-light">
        <div class="container">

            <!-- Filters -->
            <?php if ($show_filters && $filter_by !== 'none'): ?>
            <div class="models-filters">
                <button class="filter-btn active" data-filter="all">Alle Modelle</button>
                <?php if ($filter_by === 'size'): ?>
                    <button class="filter-btn" data-filter="small">Klein (bis 30m²)</button>
                    <button class="filter-btn" data-filter="medium">Mittel (30-50m²)</button>
                    <button class="filter-btn" data-filter="large">Groß (über 50m²)</button>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <!-- Models Grid -->
            <div class="models-grid">
                <?php foreach ($mobilhaus_posts as $model): ?>
                    <?php
                    $size = get_field('size', $model->ID) ?: 0;
                    $size_category = 'medium';
                    if ($size < 30) $size_category = 'small';
                    if ($size > 50) $size_category = 'large';
                    ?>
                    <div class="model-card" data-size="<?php echo esc_attr($size_category); ?>">
                        <?php if (has_post_thumbnail($model->ID)): ?>
                            <div class="model-image">
                                <a href="<?php echo get_permalink($model->ID); ?>">
                                    <?php echo get_the_post_thumbnail($model->ID, 'large'); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="model-content">
                            <h3>
                                <a href="<?php echo get_permalink($model->ID); ?>">
                                    <?php echo esc_html($model->post_title); ?>
                                </a>
                            </h3>

                            <?php if ($model->post_excerpt): ?>
                                <p class="model-excerpt"><?php echo esc_html($model->post_excerpt); ?></p>
                            <?php endif; ?>

                            <?php
                            // Get specifications from ACF
                            $specs = get_field('technical_specs', $model->ID);
                            if ($specs && is_array($specs)):
                            ?>
                                <ul class="model-specs">
                                    <?php foreach (array_slice($specs, 0, 3) as $spec): ?>
                                        <li>
                                            <strong><?php echo esc_html($spec['label']); ?>:</strong>
                                            <?php echo esc_html($spec['value']); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>

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

</div>

<style>
/* Models Complete Styles */
.models-complete-page {
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
    font-size: var(--font-size-4xl);
    margin-bottom: var(--spacing-lg);
}

.hero-subtitle {
    font-size: var(--font-size-xl);
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
    font-size: var(--font-size-3xl);
    color: var(--color-primary);
    margin-bottom: var(--spacing-lg);
}

.intro-text {
    font-size: var(--font-size-lg);
    color: var(--color-text-secondary);
    line-height: 1.8;
}

/* Filters */
.models-filters {
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

/* Models Grid */
.models-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: var(--spacing-2xl);
}

.model-card {
    background: var(--color-white);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-card);
    transition: var(--transition);
}

.model-card.hidden {
    display: none;
}

.model-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-card-hover);
}

.model-image {
    position: relative;
    overflow: hidden;
}

.model-image img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    transition: var(--transition);
}

.model-card:hover .model-image img {
    transform: scale(1.05);
}

.model-content {
    padding: var(--spacing-xl);
}

.model-content h3 {
    margin-bottom: var(--spacing-md);
}

.model-content h3 a {
    color: var(--color-primary);
    text-decoration: none;
    font-size: var(--font-size-xl);
    transition: var(--transition);
}

.model-content h3 a:hover {
    color: var(--color-primary-dark);
}

.model-excerpt {
    color: var(--color-text-secondary);
    line-height: 1.6;
    margin-bottom: var(--spacing-lg);
}

.model-specs {
    list-style: none;
    padding: 0;
    margin: 0 0 var(--spacing-lg) 0;
    border-top: 1px solid var(--color-border);
    padding-top: var(--spacing-md);
}

.model-specs li {
    padding: var(--spacing-sm) 0;
    color: var(--color-text-secondary);
    font-size: var(--font-size-sm);
}

.model-specs strong {
    color: var(--color-text-primary);
}

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

.bg-light {
    background: var(--color-background);
}

/* Responsive */
@media (max-width: 767px) {
    .container {
        padding: 0 var(--spacing-md);
    }

    .models-hero {
        min-height: 300px;
    }

    .hero-content h1 {
        font-size: var(--font-size-2xl);
    }

    .models-grid {
        grid-template-columns: 1fr;
    }

    .section-padding {
        padding: var(--spacing-2xl) 0;
    }
}
</style>

<script>
(function() {
    document.addEventListener('DOMContentLoaded', function() {
        const modelsBlock = document.getElementById('<?php echo esc_js($block_id); ?>');
        if (!modelsBlock) return;

        const filterBtns = modelsBlock.querySelectorAll('.filter-btn');
        const modelCards = modelsBlock.querySelectorAll('.model-card');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const filter = this.dataset.filter;

                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                modelCards.forEach(card => {
                    if (filter === 'all' || card.dataset.size === filter) {
                        card.classList.remove('hidden');
                    } else {
                        card.classList.add('hidden');
                    }
                });
            });
        });
    });
})();
</script>
