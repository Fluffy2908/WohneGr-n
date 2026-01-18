<?php
/**
 * Block: Model Color Options
 *
 * For use in individual Mobilhaus posts
 */

$title = get_field('model_colors_title') ?: 'Farboptionen';
$subtitle = get_field('model_colors_subtitle');
$colors = get_field('model_colors_items');

if (empty($colors)) {
    echo '<div class="acf-block-placeholder">Fügen Sie Farboptionen hinzu</div>';
    return;
}
?>

<section class="model-colors-section section-padding bg-light">
    <div class="container">
        <div class="section-header">
            <h2><?php echo esc_html($title); ?></h2>
            <?php if (!empty($subtitle)): ?>
                <p><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>
        </div>

        <div class="model-colors-grid">
            <?php foreach ($colors as $color): ?>
                <div class="model-color-card">
                    <?php if (!empty($color['image'])): ?>
                        <div class="model-color-image">
                            <img src="<?php echo esc_url($color['image']['url']); ?>" alt="<?php echo esc_attr($color['name']); ?>" loading="lazy">
                        </div>
                    <?php endif; ?>
                    <div class="model-color-content">
                        <h3><?php echo esc_html($color['name']); ?></h3>
                        <?php if (!empty($color['exterior_color']) || !empty($color['interior_color'])): ?>
                            <div class="color-details">
                                <?php if (!empty($color['exterior_color'])): ?>
                                    <div class="color-detail">
                                        <span class="color-label">Außen:</span>
                                        <span class="color-value"><?php echo esc_html($color['exterior_color']); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($color['interior_color'])): ?>
                                    <div class="color-detail">
                                        <span class="color-label">Innen:</span>
                                        <span class="color-value"><?php echo esc_html($color['interior_color']); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($color['description'])): ?>
                            <p><?php echo esc_html($color['description']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
.model-colors-section {
    padding: 80px 0;
}

.model-colors-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

.model-color-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.model-color-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
}

.model-color-image {
    width: 100%;
    height: 250px;
    overflow: hidden;
}

.model-color-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.model-color-content {
    padding: 25px;
}

.model-color-content h3 {
    margin: 0 0 15px 0;
    font-size: 1.5rem;
    color: #2d5016;
}

.color-details {
    margin: 15px 0;
}

.color-detail {
    display: flex;
    gap: 10px;
    margin-bottom: 8px;
}

.color-label {
    font-weight: 600;
    color: #666;
}

.color-value {
    color: #333;
}

.model-color-content p {
    margin: 15px 0 0 0;
    color: #666;
    line-height: 1.6;
}

@media (max-width: 768px) {
    .model-colors-grid {
        grid-template-columns: 1fr;
    }
}
</style>
