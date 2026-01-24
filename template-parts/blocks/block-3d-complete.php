<?php
/**
 * Block: 3D Complete (All-in-One for 3D Grundrisse page)
 * Smaller calling cards (2-3 per row) + Tech data side-by-side with image
 */

$hero_title = get_field('3d_hero_title');
$hero_subtitle = get_field('3d_hero_subtitle');
$intro_title = get_field('3d_intro_title');
$intro_content = get_field('3d_intro_content');
$floorplans = get_field('3d_floorplans');

$block_id = '3d-complete-' . $block['id'];
?>

<div class="threed-complete-page" id="<?php echo esc_attr($block_id); ?>">

    <!-- Hero Section -->
    <section class="threed-hero">
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
    <section class="threed-intro section-padding">
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

    <!-- Floor Plans Grid - Small Calling Cards -->
    <?php if ($floorplans && is_array($floorplans)): ?>
    <section class="floorplans-grid-section section-padding">
        <div class="container">
            <div class="floorplans-grid">

                <?php foreach ($floorplans as $index => $plan): ?>
                <div class="floorplan-card">
                    <!-- Card Header -->
                    <div class="card-header">
                        <?php if (isset($plan['title'])): ?>
                            <h3><?php echo esc_html($plan['title']); ?></h3>
                        <?php endif; ?>
                        <?php if (isset($plan['description'])): ?>
                            <p class="card-description"><?php echo esc_html($plan['description']); ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Card Content: Tech Data LEFT, Image RIGHT -->
                    <div class="card-content-grid">
                        <!-- LEFT: Technical Data -->
                        <?php if (isset($plan['specifications']) && is_array($plan['specifications']) && !empty($plan['specifications'])): ?>
                        <div class="tech-data">
                            <h4>Technische Daten</h4>
                            <dl class="specs-list">
                                <?php foreach ($plan['specifications'] as $spec): ?>
                                    <div class="spec-row">
                                        <dt><?php echo esc_html($spec['label']); ?></dt>
                                        <dd><?php echo esc_html($spec['value']); ?></dd>
                                    </div>
                                <?php endforeach; ?>
                            </dl>
                        </div>
                        <?php endif; ?>

                        <!-- RIGHT: Plan Image -->
                        <div class="plan-preview">
                            <?php if (isset($plan['normal_plan'])): ?>
                                <img src="<?php echo esc_url($plan['normal_plan']['url']); ?>"
                                     alt="<?php echo esc_attr($plan['title']); ?>"
                                     loading="lazy">
                            <?php endif; ?>

                            <!-- Toggle Button for Mirrored Version -->
                            <?php if (isset($plan['mirrored_plan'])): ?>
                            <button class="toggle-mirror-btn"
                                    data-normal="<?php echo esc_url($plan['normal_plan']['url']); ?>"
                                    data-mirrored="<?php echo esc_url($plan['mirrored_plan']['url']); ?>"
                                    onclick="togglePlanView(this)">
                                <span class="toggle-text">Gespiegelt anzeigen</span>
                            </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
    </section>
    <?php endif; ?>

</div>

<style>
/* 3D GRUNDRISSE - SMALL CALLING CARDS DESIGN */
.threed-complete-page {
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
.threed-hero {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
    color: white;
    padding: 80px 20px;
}

.hero-content {
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.hero-content h1 {
    font-size: 3.5rem;
    margin: 0 0 20px 0;
    font-weight: 800;
}

.hero-subtitle {
    font-size: 1.25rem;
    margin: 0;
    opacity: 0.95;
}

/* Intro */
.threed-intro {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
}

.intro-content {
    max-width: 900px;
    margin: 0 auto;
    text-align: center;
}

.intro-content h2 {
    font-size: 2.5rem;
    color: var(--color-primary);
    margin-bottom: 24px;
    font-weight: 700;
}

.intro-text {
    font-size: 1.125rem;
    color: var(--color-text-secondary);
    line-height: 1.8;
}

/* Floor Plans Grid - 2-3 Cards Per Row */
.floorplans-grid-section {
    background: #ffffff;
}

.floorplans-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
}

.floorplan-card {
    background: #ffffff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 6px 24px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}

.floorplan-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
}

/* Card Header */
.card-header {
    padding: 24px;
    background: var(--color-background);
    border-bottom: 3px solid var(--color-primary);
}

.card-header h3 {
    font-size: 1.5rem;
    color: var(--color-primary);
    margin: 0 0 8px 0;
    font-weight: 700;
}

.card-description {
    font-size: 0.95rem;
    color: var(--color-text-secondary);
    margin: 0;
    line-height: 1.5;
}

/* Card Content Grid: Tech Data LEFT, Image RIGHT */
.card-content-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    padding: 24px;
}

/* Technical Data (LEFT) */
.tech-data h4 {
    font-size: 1.125rem;
    color: var(--color-primary);
    margin: 0 0 16px 0;
    font-weight: 600;
}

.specs-list {
    display: grid;
    gap: 12px;
}

.spec-row {
    display: flex;
    justify-content: space-between;
    padding: 10px;
    background: var(--color-background);
    border-radius: 8px;
    border-left: 3px solid var(--color-primary);
}

.spec-row dt {
    font-weight: 600;
    color: var(--color-text-secondary);
    font-size: 0.9rem;
}

.spec-row dd {
    font-weight: 700;
    color: var(--color-text-primary);
    font-size: 0.9rem;
}

/* Plan Preview (RIGHT) */
.plan-preview {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.plan-preview img {
    width: 100%;
    height: auto;
    border-radius: 12px;
    background: var(--color-background);
    transition: opacity 0.3s ease;
}

.toggle-mirror-btn {
    padding: 10px 16px;
    background: transparent;
    border: 2px solid var(--color-primary);
    border-radius: 8px;
    color: var(--color-primary);
    font-weight: 600;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.toggle-mirror-btn:hover {
    background: var(--color-primary);
    color: white;
    transform: translateY(-2px);
}

/* Responsive Design */
@media (max-width: 1200px) {
    .floorplans-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 32px;
    }
}

@media (max-width: 768px) {
    .hero-content h1 {
        font-size: 2.5rem;
    }

    .intro-content h2 {
        font-size: 2rem;
    }

    .floorplans-grid {
        grid-template-columns: 1fr;
        gap: 24px;
    }

    .card-content-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .card-header h3 {
        font-size: 1.25rem;
    }
}
</style>

<script>
// Toggle between normal and mirrored plan
let isReversedStates = {};

function togglePlanView(button) {
    const normalUrl = button.dataset.normal;
    const mirroredUrl = button.dataset.mirrored;
    const img = button.previousElementSibling;
    const buttonId = button.dataset.normal + button.dataset.mirrored;

    if (!isReversedStates[buttonId]) {
        isReversedStates[buttonId] = false;
    }

    isReversedStates[buttonId] = !isReversedStates[buttonId];

    img.style.opacity = '0';

    setTimeout(() => {
        img.src = isReversedStates[buttonId] ? mirroredUrl : normalUrl;
        img.style.opacity = '1';
        button.querySelector('.toggle-text').textContent = isReversedStates[buttonId] ? 'Normal anzeigen' : 'Gespiegelt anzeigen';
    }, 200);
}
</script>
