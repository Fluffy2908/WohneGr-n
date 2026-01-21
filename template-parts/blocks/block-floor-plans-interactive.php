<?php
/**
 * Block Template: Interactive Floor Plans
 * Shows floor plans with size selection and mirror function
 */

$title = get_field('floor_plans_title') ?: 'Grundrisse';
$subtitle = get_field('floor_plans_subtitle') ?: 'Wählen Sie zwischen verschiedenen Größen und Konfigurationen';
$floor_plans = get_field('floor_plan_variants'); // Repeater

$block_id = isset($block['anchor']) ? $block['anchor'] : 'floor-plans-' . uniqid();
?>

<section class="floor-plans-interactive-section section-padding" id="<?php echo esc_attr($block_id); ?>">
    <div class="container">
        <div class="section-header">
            <h2><?php echo esc_html($title); ?></h2>
            <?php if ($subtitle) : ?>
                <p><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>
        </div>

        <?php if ($floor_plans) : ?>
            <!-- Size Tabs -->
            <div class="floor-plan-tabs">
                <?php foreach ($floor_plans as $index => $plan) : ?>
                    <button class="floor-plan-tab <?php echo $index === 0 ? 'active' : ''; ?>" data-plan="plan-<?php echo $index; ?>">
                        <span class="tab-size"><?php echo esc_html($plan['size_label']); ?></span>
                        <span class="tab-sqm"><?php echo esc_html($plan['square_meters']); ?></span>
                    </button>
                <?php endforeach; ?>
            </div>

            <!-- Floor Plan Content -->
            <?php foreach ($floor_plans as $index => $plan) : ?>
                <div class="floor-plan-content <?php echo $index === 0 ? 'active' : ''; ?>" data-plan-content="plan-<?php echo $index; ?>">
                    <div class="floor-plan-viewer">
                        <div class="floor-plan-image-wrapper">
                            <img class="floor-plan-image"
                                 src="<?php echo esc_url($plan['floor_plan_image']['url']); ?>"
                                 data-normal="<?php echo esc_url($plan['floor_plan_image']['url']); ?>"
                                 data-mirrored="<?php echo esc_url($plan['mirrored_floor_plan_image']['url']); ?>"
                                 alt="<?php echo esc_attr($plan['size_label']); ?> Grundriss"
                                 loading="lazy">
                        </div>

                        <div class="floor-plan-controls">
                            <button class="btn btn-outline mirror-toggle">
                                <?php echo wohnegruen_get_icon('refresh'); ?>
                                Grundriss spiegeln
                            </button>

                            <?php if ($plan['download_pdf']) : ?>
                                <a href="<?php echo esc_url($plan['download_pdf']['url']); ?>" class="btn btn-secondary" download>
                                    <?php echo wohnegruen_get_icon('download'); ?>
                                    PDF herunterladen
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if ($plan['specifications']) : ?>
                        <div class="floor-plan-specs">
                            <h3>Spezifikationen</h3>
                            <div class="specs-grid">
                                <?php foreach ($plan['specifications'] as $spec) : ?>
                                    <div class="spec-item">
                                        <span class="spec-label"><?php echo esc_html($spec['label']); ?></span>
                                        <span class="spec-value"><?php echo esc_html($spec['value']); ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<script>
// Floor plan interactive functionality
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching
    const tabs = document.querySelectorAll('.floor-plan-tab');
    const contents = document.querySelectorAll('.floor-plan-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const planId = this.dataset.plan;

            // Update active tab
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            // Show corresponding content
            contents.forEach(content => {
                if (content.dataset.planContent === planId) {
                    content.classList.add('active');
                } else {
                    content.classList.remove('active');
                }
            });
        });
    });

    // Mirror toggle
    document.querySelectorAll('.mirror-toggle').forEach(btn => {
        btn.addEventListener('click', function() {
            const wrapper = this.closest('.floor-plan-viewer');
            const img = wrapper.querySelector('.floor-plan-image');
            const normalSrc = img.dataset.normal;
            const mirroredSrc = img.dataset.mirrored;

            // Toggle between normal and mirrored
            if (img.src.includes(normalSrc)) {
                img.src = mirroredSrc;
                this.classList.add('active');
            } else {
                img.src = normalSrc;
                this.classList.remove('active');
            }
        });
    });
});
</script>
