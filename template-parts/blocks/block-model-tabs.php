<?php
/**
 * Block: Model Tabs
 *
 * Displays model tabs (Nature/Pure) with color sliders and size options
 */

// Get block fields
$models = get_field('models');

if (empty($models)) {
    echo '<div class="acf-block-placeholder">Add models in the block settings</div>';
    return;
}

?>

<!-- Model Tabs Navigation -->
<section class="model-tabs-section">
    <div class="container">
        <div class="model-tabs-nav">
            <?php foreach ($models as $index => $model): ?>
                <button class="model-tab-btn <?php echo $index === 0 ? 'active' : ''; ?>" data-model="<?php echo esc_attr($model['model_slug']); ?>">
                    <span class="tab-icon"><?php echo esc_html($model['model_icon']); ?></span>
                    <span class="tab-title"><?php echo esc_html($model['model_name']); ?></span>
                    <span class="tab-subtitle"><?php echo esc_html($model['model_tagline']); ?></span>
                </button>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Model Content -->
<?php foreach ($models as $index => $model): ?>
    <div class="model-content <?php echo $index === 0 ? 'active' : ''; ?>" id="<?php echo esc_attr($model['model_slug']); ?>-content">

        <!-- Model Hero -->
        <?php if (!empty($model['hero_image'])): ?>
            <section class="model-hero" style="background-image: url('<?php echo esc_url($model['hero_image']['url']); ?>');">
                <div class="model-hero-overlay"></div>
                <div class="container">
                    <div class="model-hero-content">
                        <?php if (!empty($model['model_badge'])): ?>
                            <div class="model-badge"><?php echo esc_html($model['model_badge']); ?></div>
                        <?php endif; ?>
                        <h2><?php echo esc_html($model['model_name']); ?></h2>
                        <p class="model-hero-tagline"><?php echo esc_html($model['model_description']); ?></p>

                        <?php if (!empty($model['specs'])): ?>
                            <div class="model-hero-specs">
                                <?php foreach ($model['specs'] as $spec): ?>
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
        <?php endif; ?>

        <!-- Model Description -->
        <?php if (!empty($model['description_text']) || !empty($model['description_image'])): ?>
            <section class="model-description-section section-padding">
                <div class="container">
                    <div class="model-description-grid">
                        <div class="model-description-text">
                            <?php if (!empty($model['description_title'])): ?>
                                <h3><?php echo esc_html($model['description_title']); ?></h3>
                            <?php endif; ?>
                            <?php if (!empty($model['description_text'])): ?>
                                <?php echo wpautop($model['description_text']); ?>
                            <?php endif; ?>
                            <?php if (!empty($model['description_features'])): ?>
                                <ul class="model-features-list">
                                    <?php foreach ($model['description_features'] as $feature): ?>
                                        <li>
                                            <?php echo wohnegruen_get_icon('check'); ?>
                                            <span><?php echo esc_html($feature['feature_text']); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($model['description_image'])): ?>
                            <div class="model-description-image">
                                <img src="<?php echo esc_url($model['description_image']['url']); ?>" alt="<?php echo esc_attr($model['model_name']); ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- Color Slider -->
        <?php if (!empty($model['color_schemes'])): ?>
            <section class="color-slider-section section-padding bg-light">
                <div class="container">
                    <div class="section-header">
                        <h3>Farbvarianten</h3>
                        <p>Wählen Sie aus verschiedenen Farbkombinationen</p>
                    </div>
                    <div class="color-slider-wrapper">
                        <button class="slider-nav slider-prev" aria-label="Vorherige">‹</button>
                        <div class="color-slider">
                            <?php foreach ($model['color_schemes'] as $scheme): ?>
                                <div class="color-slide">
                                    <div class="color-slide-image">
                                        <img src="<?php echo esc_url($scheme['image']['url']); ?>" alt="<?php echo esc_attr($scheme['name']); ?>" loading="lazy">
                                    </div>
                                    <div class="color-slide-content">
                                        <h4><?php echo esc_html($scheme['name']); ?></h4>
                                        <div class="color-scheme-colors">
                                            <?php if (!empty($scheme['exterior_color'])): ?>
                                                <div class="color-item">
                                                    <span class="color-label">Außen:</span>
                                                    <span class="color-name"><?php echo esc_html($scheme['exterior_color']); ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($scheme['trim_color'])): ?>
                                                <div class="color-item">
                                                    <span class="color-label">Zierleisten:</span>
                                                    <span class="color-name"><?php echo esc_html($scheme['trim_color']); ?></span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="slider-nav slider-next" aria-label="Nächste">›</button>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- Size Options -->
        <?php if (!empty($model['size_options'])): ?>
            <section class="size-options-section section-padding">
                <div class="container">
                    <div class="section-header">
                        <h3>Größenoptionen</h3>
                        <p>Wählen Sie die passende Größe für Ihre Bedürfnisse</p>
                    </div>
                    <div class="size-options-grid">
                        <?php foreach ($model['size_options'] as $size): ?>
                            <div class="size-option-card <?php echo !empty($size['featured']) ? 'size-option-featured' : ''; ?>">
                                <?php if (!empty($size['badge'])): ?>
                                    <div class="size-option-badge"><?php echo esc_html($size['badge']); ?></div>
                                <?php endif; ?>
                                <h4><?php echo esc_html($size['name']); ?></h4>
                                <div class="size-value"><?php echo esc_html($size['dimensions']); ?></div>
                                <div class="size-area"><?php echo esc_html($size['area']); ?> Wohnfläche</div>
                                <?php if (!empty($size['features'])): ?>
                                    <ul class="size-features">
                                        <?php foreach ($size['features'] as $feature): ?>
                                            <li><?php echo esc_html($feature['feature']); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

    </div>
<?php endforeach; ?>

<script>
// Model tabs functionality
document.addEventListener('DOMContentLoaded', function() {
    const tabBtns = document.querySelectorAll('.model-tab-btn');
    const modelContents = document.querySelectorAll('.model-content');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const modelSlug = this.dataset.model;

            // Remove active class from all tabs and contents
            tabBtns.forEach(b => b.classList.remove('active'));
            modelContents.forEach(c => c.classList.remove('active'));

            // Add active class to clicked tab and corresponding content
            this.classList.add('active');
            document.getElementById(modelSlug + '-content').classList.add('active');
        });
    });

    // Color slider functionality
    const sliders = document.querySelectorAll('.color-slider-wrapper');
    sliders.forEach(sliderWrapper => {
        const slider = sliderWrapper.querySelector('.color-slider');
        const prevBtn = sliderWrapper.querySelector('.slider-prev');
        const nextBtn = sliderWrapper.querySelector('.slider-next');

        if (prevBtn && nextBtn && slider) {
            prevBtn.addEventListener('click', () => {
                slider.scrollBy({ left: -350, behavior: 'smooth' });
            });

            nextBtn.addEventListener('click', () => {
                slider.scrollBy({ left: 350, behavior: 'smooth' });
            });
        }
    });
});
</script>
