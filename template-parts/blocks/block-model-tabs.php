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

<style>
/* Model Tabs Navigation */
.model-tabs-section {
    background: #f8f9fa;
    padding: 40px 0;
}

.model-tabs-nav {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.model-tab-btn {
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    padding: 20px 40px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    min-width: 200px;
}

.model-tab-btn:hover {
    border-color: #2d5016;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(45, 80, 22, 0.2);
}

.model-tab-btn.active {
    background: #2d5016;
    border-color: #2d5016;
    color: white;
}

.tab-icon {
    font-size: 2rem;
}

.tab-title {
    font-size: 1.5rem;
    font-weight: 700;
}

.tab-subtitle {
    font-size: 0.9rem;
    opacity: 0.8;
}

/* Model Content */
.model-content {
    display: none;
}

.model-content.active {
    display: block;
}

/* Model Hero */
.model-hero {
    position: relative;
    min-height: 500px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    display: flex;
    align-items: center;
    padding: 100px 20px;
}

.model-hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(45, 80, 22, 0.85) 0%, rgba(61, 107, 31, 0.75) 100%);
    z-index: 1;
}

.model-hero-content {
    position: relative;
    z-index: 2;
    color: white;
    max-width: 800px;
}

.model-badge {
    display: inline-block;
    background: rgba(255, 255, 255, 0.2);
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 0.9rem;
    margin-bottom: 20px;
}

.model-hero h2 {
    font-size: 3rem;
    margin: 0 0 15px 0;
    font-weight: 700;
}

.model-hero-tagline {
    font-size: 1.3rem;
    margin: 0 0 30px 0;
    opacity: 0.95;
}

.model-hero-specs {
    display: flex;
    gap: 40px;
    flex-wrap: wrap;
}

.hero-spec {
    display: flex;
    flex-direction: column;
}

.spec-value {
    font-size: 2rem;
    font-weight: 700;
}

.spec-label {
    font-size: 0.9rem;
    opacity: 0.9;
}

/* Model Description */
.model-description-section {
    padding: 80px 0;
}

.model-description-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
}

.model-description-text h3 {
    font-size: 2rem;
    margin: 0 0 20px 0;
    color: #2d5016;
}

.model-features-list {
    list-style: none;
    padding: 0;
    margin: 20px 0 0 0;
}

.model-features-list li {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
    font-size: 1.1rem;
}

.model-features-list svg {
    width: 20px;
    height: 20px;
    fill: #2d5016;
    flex-shrink: 0;
}

.model-description-image img {
    width: 100%;
    height: auto;
    border-radius: 12px;
}

/* Color Slider */
.color-slider-section {
    padding: 80px 0;
}

.section-header {
    text-align: center;
    margin-bottom: 50px;
}

.section-header h3 {
    font-size: 2.5rem;
    margin: 0 0 15px 0;
    color: #2d5016;
}

.section-header p {
    font-size: 1.1rem;
    color: #666;
}

.color-slider-wrapper {
    position: relative;
    padding: 0 60px;
}

.color-slider {
    display: flex;
    gap: 30px;
    overflow-x: auto;
    scroll-behavior: smooth;
    scrollbar-width: none;
    -ms-overflow-style: none;
}

.color-slider::-webkit-scrollbar {
    display: none;
}

.color-slide {
    min-width: 350px;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.color-slide-image {
    width: 100%;
    height: 250px;
    overflow: hidden;
}

.color-slide-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.color-slide-content {
    padding: 20px;
}

.color-slide-content h4 {
    margin: 0 0 15px 0;
    font-size: 1.3rem;
    color: #2d5016;
}

.color-scheme-colors {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.color-item {
    display: flex;
    gap: 10px;
    font-size: 0.95rem;
}

.color-label {
    font-weight: 600;
    color: #666;
}

.slider-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: #2d5016;
    color: white;
    border: none;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    font-size: 2rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    z-index: 10;
}

.slider-nav:hover {
    background: #3d6b1f;
    transform: translateY(-50%) scale(1.1);
}

.slider-prev {
    left: 0;
}

.slider-next {
    right: 0;
}

/* Size Options */
.size-options-section {
    padding: 80px 0;
}

.size-options-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
}

.size-option-card {
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    padding: 40px 30px;
    text-align: center;
    transition: all 0.3s ease;
    position: relative;
}

.size-option-card:hover {
    border-color: #2d5016;
    box-shadow: 0 8px 24px rgba(45, 80, 22, 0.15);
}

.size-option-featured {
    border-color: #2d5016;
    background: linear-gradient(135deg, #f8f9fa 0%, #e8f5e9 100%);
}

.size-option-badge {
    position: absolute;
    top: -12px;
    right: 20px;
    background: #2d5016;
    color: white;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
}

.size-option-card h4 {
    font-size: 1.8rem;
    margin: 0 0 15px 0;
    color: #2d5016;
}

.size-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 8px;
}

.size-area {
    font-size: 1.1rem;
    color: #666;
    margin-bottom: 25px;
}

.size-features {
    list-style: none;
    padding: 0;
    margin: 0;
    text-align: left;
}

.size-features li {
    padding: 10px 0;
    border-bottom: 1px solid #e0e0e0;
    font-size: 1rem;
}

.size-features li:last-child {
    border-bottom: none;
}

.bg-light {
    background: #f8f9fa;
}

.section-padding {
    padding: 80px 0;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .model-tabs-nav {
        gap: 15px;
    }

    .model-tab-btn {
        min-width: 150px;
        padding: 15px 25px;
    }

    .tab-title {
        font-size: 1.2rem;
    }

    .tab-subtitle {
        font-size: 0.8rem;
    }

    .model-hero {
        min-height: 400px;
        padding: 60px 20px;
    }

    .model-hero h2 {
        font-size: 2rem;
    }

    .model-hero-tagline {
        font-size: 1.1rem;
    }

    .model-hero-specs {
        gap: 20px;
    }

    .spec-value {
        font-size: 1.5rem;
    }

    .model-description-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }

    .model-description-text h3 {
        font-size: 1.5rem;
    }

    .section-header h3 {
        font-size: 2rem;
    }

    .color-slider-wrapper {
        padding: 0 50px;
    }

    .color-slide {
        min-width: 280px;
    }

    .slider-nav {
        width: 40px;
        height: 40px;
        font-size: 1.5rem;
    }

    .size-options-grid {
        grid-template-columns: 1fr;
    }

    .section-padding {
        padding: 50px 0;
    }
}

@media (max-width: 480px) {
    .model-tab-btn {
        min-width: 130px;
        padding: 12px 20px;
    }

    .tab-icon {
        font-size: 1.5rem;
    }

    .tab-title {
        font-size: 1rem;
    }

    .model-hero {
        min-height: 300px;
        padding: 40px 15px;
    }

    .model-hero h2 {
        font-size: 1.5rem;
    }

    .model-hero-tagline {
        font-size: 1rem;
    }

    .color-slider-wrapper {
        padding: 0 40px;
    }

    .color-slide {
        min-width: 250px;
    }

    .slider-nav {
        width: 35px;
        height: 35px;
        font-size: 1.2rem;
    }
}
</style>

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

            // Scroll to content smoothly
            const content = document.getElementById(modelSlug + '-content');
            if (content) {
                window.scrollTo({
                    top: content.offsetTop - 100,
                    behavior: 'smooth'
                });
            }
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
                const scrollAmount = window.innerWidth < 768 ? 280 : 350;
                slider.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
            });

            nextBtn.addEventListener('click', () => {
                const scrollAmount = window.innerWidth < 768 ? 280 : 350;
                slider.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            });
        }
    });

    // Handle URL hash for direct model access
    const hash = window.location.hash;
    if (hash) {
        const modelSlug = hash.replace('#', '');
        const targetBtn = document.querySelector(`.model-tab-btn[data-model="${modelSlug}"]`);
        if (targetBtn) {
            setTimeout(() => {
                targetBtn.click();
            }, 500);
        }
    }
});
</script>
