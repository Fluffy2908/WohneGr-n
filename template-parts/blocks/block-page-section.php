<?php
/**
 * Block: Flexible Page Section
 * Universal block that adapts to different content types with LIVE PREVIEW
 * Can be: Text+Image, Features Grid, CTA, Values Grid, or Custom HTML
 */

// Check if we're in the editor for live preview
$is_preview = isset($block['data']['is_preview']) ? $block['data']['is_preview'] : false;

// Get section type
$section_type = get_field('section_type') ?: 'text_image';
$section_id = get_field('section_id') ?: '';
$section_class = get_field('section_class') ?: '';
$background_color = get_field('background_color') ?: 'white';
$padding_size = get_field('padding_size') ?: 'normal';
$reverse_layout = get_field('reverse_layout') ?: false;

// Common fields
$title = get_field('section_title');
$subtitle = get_field('section_subtitle');
$content = get_field('section_content');

// Type-specific fields
$image = get_field('section_image');
$features = get_field('features_items');
$values = get_field('values_items');
$cta_button_text = get_field('cta_button_text');
$cta_button_link = get_field('cta_button_link');
$custom_html = get_field('custom_html');

$block_id = isset($block['anchor']) ? $block['anchor'] : 'page-section-' . $block['id'];

// Background color classes
$bg_classes = [
    'white' => 'bg-white',
    'light' => 'bg-light',
    'primary' => 'bg-primary',
    'dark' => 'bg-dark'
];

// Padding size classes
$padding_classes = [
    'none' => 'py-0',
    'small' => 'py-small',
    'normal' => 'py-normal',
    'large' => 'py-large'
];

$section_classes = 'page-section section-' . $section_type;
$section_classes .= ' ' . ($bg_classes[$background_color] ?? 'bg-white');
$section_classes .= ' ' . ($padding_classes[$padding_size] ?? 'py-normal');
if ($section_class) $section_classes .= ' ' . $section_class;
if ($reverse_layout) $section_classes .= ' reverse-layout';
?>

<section class="<?php echo esc_attr($section_classes); ?>" id="<?php echo esc_attr($block_id); ?>" <?php if($section_id): ?>id="<?php echo esc_attr($section_id); ?>"<?php endif; ?>>
    <div class="container">

        <?php if ($section_type === 'text_image'): ?>
            <!-- Text + Image Layout -->
            <div class="text-image-grid">
                <div class="text-content">
                    <?php if ($title): ?>
                        <h2 class="section-title"><?php echo esc_html($title); ?></h2>
                    <?php endif; ?>

                    <?php if ($subtitle): ?>
                        <p class="section-subtitle"><?php echo esc_html($subtitle); ?></p>
                    <?php endif; ?>

                    <?php if ($content): ?>
                        <div class="section-text">
                            <?php echo wp_kses_post($content); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($cta_button_text && $cta_button_link): ?>
                        <div class="section-cta">
                            <a href="<?php echo esc_url($cta_button_link); ?>" class="btn btn-primary btn-lg">
                                <?php echo esc_html($cta_button_text); ?>
                                <?php echo wohnegruen_get_icon('arrow-right'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if ($image && isset($image['url'])): ?>
                    <div class="image-content">
                        <img src="<?php echo esc_url($image['url']); ?>"
                             alt="<?php echo esc_attr($image['alt'] ?: $title); ?>"
                             loading="lazy">
                    </div>
                <?php endif; ?>
            </div>

        <?php elseif ($section_type === 'features_grid'): ?>
            <!-- Features Grid Layout -->
            <div class="section-header text-center">
                <?php if ($title): ?>
                    <h2><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                <?php if ($subtitle): ?>
                    <p><?php echo esc_html($subtitle); ?></p>
                <?php endif; ?>
            </div>

            <?php if ($features && is_array($features)): ?>
                <div class="features-grid">
                    <?php foreach ($features as $feature): ?>
                        <?php if (isset($feature['title'])): ?>
                            <div class="feature-card">
                                <?php if (isset($feature['icon'])): ?>
                                    <div class="feature-icon">
                                        <?php echo wohnegruen_get_icon($feature['icon']); ?>
                                    </div>
                                <?php endif; ?>
                                <h3><?php echo esc_html($feature['title']); ?></h3>
                                <?php if (isset($feature['description'])): ?>
                                    <p><?php echo esc_html($feature['description']); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        <?php elseif ($section_type === 'values_grid'): ?>
            <!-- Values Grid Layout -->
            <div class="section-header text-center">
                <?php if ($title): ?>
                    <h2><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                <?php if ($subtitle): ?>
                    <p><?php echo esc_html($subtitle); ?></p>
                <?php endif; ?>
            </div>

            <?php if ($values && is_array($values)): ?>
                <div class="values-grid">
                    <?php foreach ($values as $value): ?>
                        <?php if (isset($value['title'])): ?>
                            <div class="value-card">
                                <?php if (isset($value['icon'])): ?>
                                    <div class="value-icon">
                                        <?php echo wohnegruen_get_icon($value['icon']); ?>
                                    </div>
                                <?php endif; ?>
                                <h3><?php echo esc_html($value['title']); ?></h3>
                                <?php if (isset($value['description'])): ?>
                                    <p><?php echo esc_html($value['description']); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        <?php elseif ($section_type === 'cta_banner'): ?>
            <!-- CTA Banner Layout -->
            <div class="cta-banner">
                <?php if ($title): ?>
                    <h2><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                <?php if ($subtitle): ?>
                    <p><?php echo esc_html($subtitle); ?></p>
                <?php endif; ?>
                <?php if ($cta_button_text && $cta_button_link): ?>
                    <a href="<?php echo esc_url($cta_button_link); ?>" class="btn btn-primary btn-lg">
                        <?php echo esc_html($cta_button_text); ?>
                        <?php echo wohnegruen_get_icon('arrow-right'); ?>
                    </a>
                <?php endif; ?>
            </div>

        <?php elseif ($section_type === 'custom_html'): ?>
            <!-- Custom HTML -->
            <?php if ($title): ?>
                <h2 class="section-title text-center"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
            <div class="custom-html-content">
                <?php echo $custom_html; // Already sanitized by ACF ?>
            </div>

        <?php endif; ?>

    </div>
</section>

<style>
/* Page Section Universal Styles */
.page-section {
    position: relative;
}

/* Container Utility */
.page-section .container {
    max-width: 1400px;
    margin-left: auto;
    margin-right: auto;
    padding-left: var(--spacing-lg);
    padding-right: var(--spacing-lg);
}

/* Button styles inherited from global style.css */

/* Background Colors */
.bg-white {
    background: var(--color-white);
}

.bg-light {
    background: var(--color-background);
}

.bg-primary {
    background: var(--color-primary);
    color: var(--color-white);
}

.bg-primary h2,
.bg-primary h3,
.bg-primary .section-title {
    color: var(--color-white);
}

.bg-dark {
    background: var(--color-primary-dark);
    color: var(--color-white);
}

/* Padding Sizes */
.py-0 {
    padding: 0;
}

.py-small {
    padding: var(--spacing-2xl) var(--spacing-lg);
}

.py-normal {
    padding: var(--spacing-3xl) var(--spacing-lg);
}

.py-large {
    padding: calc(var(--spacing-3xl) * 1.5) var(--spacing-lg);
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

/* Text + Image Layout */
.text-image-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--spacing-3xl);
    align-items: center;
}

.text-image-grid .text-content {
    order: 1;
}

.text-image-grid .image-content {
    order: 2;
}

.reverse-layout .text-image-grid .text-content {
    order: 2;
}

.reverse-layout .text-image-grid .image-content {
    order: 1;
}

.section-title {
    font-size: var(--font-size-3xl);
    color: var(--color-primary);
    margin-bottom: var(--spacing-lg);
}

.section-subtitle {
    font-size: var(--font-size-xl);
    color: var(--color-text-secondary);
    margin-bottom: var(--spacing-lg);
}

.section-text {
    font-size: var(--font-size-md);
    line-height: 1.8;
    color: var(--color-text-primary);
    margin-bottom: var(--spacing-xl);
}

.section-text p {
    margin-bottom: var(--spacing-md);
}

.image-content img {
    width: 100%;
    height: auto;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-card);
}

/* Features Grid */
.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--spacing-2xl);
    margin-top: var(--spacing-2xl);
}

.feature-card {
    background: var(--color-white);
    padding: var(--spacing-2xl);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-card);
    transition: var(--transition);
    text-align: center;
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
    font-size: var(--font-size-xl);
    color: var(--color-primary);
    margin-bottom: var(--spacing-md);
}

.feature-card p {
    color: var(--color-text-secondary);
    line-height: 1.6;
}

/* Values Grid (same as features but different styling) */
.values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: var(--spacing-2xl);
    margin-top: var(--spacing-2xl);
}

.value-card {
    background: var(--color-white);
    padding: var(--spacing-2xl);
    border-radius: var(--radius-lg);
    border: 2px solid var(--color-border);
    transition: var(--transition);
}

.value-card:hover {
    border-color: var(--color-primary);
    box-shadow: var(--shadow-card);
}

.value-icon {
    width: 56px;
    height: 56px;
    margin-bottom: var(--spacing-lg);
    color: var(--color-primary);
}

.value-icon svg {
    width: 100%;
    height: 100%;
}

.value-card h3 {
    font-size: var(--font-size-lg);
    color: var(--color-primary);
    margin-bottom: var(--spacing-sm);
}

.value-card p {
    color: var(--color-text-secondary);
    font-size: var(--font-size-sm);
    line-height: 1.6;
}

/* CTA Banner */
.cta-banner {
    text-align: center;
    padding: var(--spacing-3xl) var(--spacing-xl);
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
    border-radius: var(--radius-xl);
    color: var(--color-white);
}

.cta-banner h2 {
    font-size: var(--font-size-3xl);
    color: var(--color-white);
    margin-bottom: var(--spacing-md);
}

.cta-banner p {
    font-size: var(--font-size-xl);
    margin-bottom: var(--spacing-2xl);
    opacity: 0.95;
}

.cta-banner .btn {
    background: var(--color-white);
    color: var(--color-primary);
}

.cta-banner .btn:hover {
    background: var(--color-background);
}

/* Custom HTML */
.custom-html-content {
    max-width: 1000px;
    margin: 0 auto;
}

/* Responsive */
@media (max-width: 767px) {
    .page-section .container {
        padding-left: var(--spacing-md);
        padding-right: var(--spacing-md);
    }

    .text-image-grid {
        grid-template-columns: 1fr;
    }

    .text-image-grid .text-content,
    .reverse-layout .text-image-grid .text-content {
        order: 1;
    }

    .text-image-grid .image-content,
    .reverse-layout .text-image-grid .image-content {
        order: 2;
    }

    .features-grid,
    .values-grid {
        grid-template-columns: 1fr;
    }

    .py-normal {
        padding: var(--spacing-2xl) var(--spacing-md);
    }
}
</style>

<?php
// Add preview helper text in editor
if ($is_preview && !$section_type):
?>
<div style="padding: 40px; text-align: center; background: #f0f0f0; border: 2px dashed #ccc; border-radius: 8px;">
    <p style="margin: 0; color: #666; font-size: 14px;">
        👈 Select a section type in the sidebar to start building
    </p>
</div>
<?php endif; ?>
