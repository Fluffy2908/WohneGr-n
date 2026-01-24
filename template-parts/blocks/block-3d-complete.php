<?php
/**
 * Block: 3D Complete (All-in-One for 3D Grundrisse page)
 * Complete 3D floor plans page with interactive viewer with LIVE PREVIEW
 */

// Get all fields
$hero_title = get_field('3d_hero_title');
$hero_subtitle = get_field('3d_hero_subtitle');

$intro_title = get_field('3d_intro_title');
$intro_content = get_field('3d_intro_content');

$floorplans = get_field('3d_floorplans');

$block_id = '3d-complete-' . $block['id'];
?>

<div class="3d-complete-page" id="<?php echo esc_attr($block_id); ?>">

    <!-- Hero Section -->
    <section class="3d-hero">
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
    <section class="3d-intro section-padding">
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

    <!-- 3D Floor Plans Section -->
    <?php if ($floorplans && is_array($floorplans)): ?>
    <section class="3d-floorplans section-padding bg-light">
        <div class="container">

            <?php foreach ($floorplans as $index => $plan): ?>
                <div class="floorplan-item">

                    <div class="floorplan-header">
                        <?php if (isset($plan['title'])): ?>
                            <h3><?php echo esc_html($plan['title']); ?></h3>
                        <?php endif; ?>
                        <?php if (isset($plan['description'])): ?>
                            <p><?php echo esc_html($plan['description']); ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="floorplan-viewer">

                        <!-- Plan Selector -->
                        <?php if (isset($plan['normal_plan']) && isset($plan['mirrored_plan'])): ?>
                        <div class="plan-controls">
                            <button class="plan-btn active" data-plan="normal" data-index="<?php echo $index; ?>">
                                Normal
                            </button>
                            <button class="plan-btn" data-plan="mirrored" data-index="<?php echo $index; ?>">
                                Gespiegelt
                            </button>
                        </div>
                        <?php endif; ?>

                        <!-- Plan Images -->
                        <div class="plan-images">
                            <?php if (isset($plan['normal_plan'])): ?>
                                <div class="plan-image active" data-plan="normal">
                                    <img src="<?php echo esc_url($plan['normal_plan']['url']); ?>"
                                         alt="<?php echo esc_attr($plan['title'] . ' - Normal'); ?>">
                                </div>
                            <?php endif; ?>

                            <?php if (isset($plan['mirrored_plan'])): ?>
                                <div class="plan-image" data-plan="mirrored">
                                    <img src="<?php echo esc_url($plan['mirrored_plan']['url']); ?>"
                                         alt="<?php echo esc_attr($plan['title'] . ' - Gespiegelt'); ?>">
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Specifications -->
                        <?php if (isset($plan['specifications']) && is_array($plan['specifications'])): ?>
                        <div class="plan-specifications">
                            <h4>Technische Daten</h4>
                            <ul class="specs-list">
                                <?php foreach ($plan['specifications'] as $spec): ?>
                                    <li>
                                        <strong><?php echo esc_html($spec['label']); ?>:</strong>
                                        <?php echo esc_html($spec['value']); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endif; ?>

                    </div>

                </div>
            <?php endforeach; ?>

        </div>
    </section>
    <?php endif; ?>

</div>

<style>
/* 3D Complete Styles */
.3d-complete-page {
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
.3d-hero {
    padding: var(--spacing-3xl) 0;
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
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

/* Floor Plans */
.floorplan-item {
    background: var(--color-white);
    border-radius: var(--radius-lg);
    padding: var(--spacing-3xl);
    margin-bottom: var(--spacing-3xl);
    box-shadow: var(--shadow-card);
}

.floorplan-item:last-child {
    margin-bottom: 0;
}

.floorplan-header {
    text-align: center;
    margin-bottom: var(--spacing-2xl);
}

.floorplan-header h3 {
    font-size: var(--font-size-2xl);
    color: var(--color-primary);
    margin-bottom: var(--spacing-md);
}

.floorplan-header p {
    font-size: var(--font-size-lg);
    color: var(--color-text-secondary);
}

/* Plan Controls */
.plan-controls {
    display: flex;
    justify-content: center;
    gap: var(--spacing-md);
    margin-bottom: var(--spacing-2xl);
}

.plan-btn {
    padding: var(--spacing-sm) var(--spacing-xl);
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

.plan-btn:hover,
.plan-btn.active {
    border-color: var(--color-primary);
    background: var(--color-primary);
    color: var(--color-white);
}

/* Plan Images */
.plan-images {
    position: relative;
    margin-bottom: var(--spacing-2xl);
}

.plan-image {
    display: none;
    text-align: center;
}

.plan-image.active {
    display: block;
}

.plan-image img {
    max-width: 100%;
    height: auto;
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-card);
}

/* Specifications */
.plan-specifications {
    background: var(--color-background);
    padding: var(--spacing-xl);
    border-radius: var(--radius-md);
}

.plan-specifications h4 {
    font-size: var(--font-size-lg);
    color: var(--color-primary);
    margin-bottom: var(--spacing-lg);
    text-align: center;
}

.specs-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: var(--spacing-md);
}

.specs-list li {
    padding: var(--spacing-sm);
    color: var(--color-text-secondary);
}

.specs-list strong {
    color: var(--color-text-primary);
}

.bg-light {
    background: var(--color-background);
}

/* Responsive */
@media (max-width: 767px) {
    .container {
        padding: 0 var(--spacing-md);
    }

    .hero-content h1 {
        font-size: var(--font-size-2xl);
    }

    .floorplan-item {
        padding: var(--spacing-xl);
    }

    .specs-list {
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
        const block3d = document.getElementById('<?php echo esc_js($block_id); ?>');
        if (!block3d) return;

        const planBtns = block3d.querySelectorAll('.plan-btn');

        planBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const planType = this.dataset.plan;
                const index = this.dataset.index;
                const container = this.closest('.floorplan-item');

                // Update active button
                container.querySelectorAll('.plan-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                // Show corresponding plan image
                container.querySelectorAll('.plan-image').forEach(img => {
                    if (img.dataset.plan === planType) {
                        img.classList.add('active');
                    } else {
                        img.classList.remove('active');
                    }
                });
            });
        });
    });
})();
</script>
