<?php
/**
 * Block Template: Interior Colors Showcase
 * Interactive slider for interior color schemes with image galleries
 */

$title = get_field('interior_title') ?: 'Innenausstattung';
$subtitle = get_field('interior_subtitle') ?: 'Wählen Sie aus 8 exklusiven Farbschemata';
$intro_text = get_field('interior_intro_text');
$color_schemes = get_field('interior_color_schemes'); // Repeater

$block_id = isset($block['anchor']) ? $block['anchor'] : 'interior-colors-' . uniqid();
?>

<section class="interior-colors-section section-padding" id="<?php echo esc_attr($block_id); ?>">
    <div class="container">
        <div class="section-header">
            <h2><?php echo esc_html($title); ?></h2>
            <?php if ($subtitle) : ?>
                <p><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>
        </div>

        <?php if ($intro_text) : ?>
            <div class="interior-intro">
                <?php echo wp_kses_post($intro_text); ?>
            </div>
        <?php endif; ?>

        <?php if ($color_schemes) : ?>
            <!-- Color Scheme Selector Pills -->
            <div class="color-scheme-selector">
                <?php foreach ($color_schemes as $index => $scheme) : ?>
                    <button class="color-scheme-pill <?php echo $index === 0 ? 'active' : ''; ?>" data-scheme="scheme-<?php echo $index; ?>">
                        <span class="scheme-name"><?php echo esc_html($scheme['scheme_name']); ?></span>
                        <?php if ($scheme['color_palette']) : ?>
                            <span class="scheme-colors">
                                <?php foreach (array_slice($scheme['color_palette'], 0, 3) as $color) : ?>
                                    <span class="color-dot" style="background: <?php echo esc_attr($color['color_code']); ?>"></span>
                                <?php endforeach; ?>
                            </span>
                        <?php endif; ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <!-- Color Scheme Content -->
            <div class="color-scheme-showcase">
                <?php foreach ($color_schemes as $index => $scheme) : ?>
                    <div class="scheme-content <?php echo $index === 0 ? 'active' : ''; ?>" data-scheme-content="scheme-<?php echo $index; ?>">
                        <div class="scheme-details">
                            <h3><?php echo esc_html($scheme['scheme_name']); ?></h3>
                            <?php if ($scheme['scheme_description']) : ?>
                                <p class="scheme-description"><?php echo esc_html($scheme['scheme_description']); ?></p>
                            <?php endif; ?>

                            <?php if ($scheme['color_palette']) : ?>
                                <div class="color-palette-display">
                                    <h4>Farbpalette</h4>
                                    <div class="palette-swatches">
                                        <?php foreach ($scheme['color_palette'] as $color) : ?>
                                            <div class="palette-swatch">
                                                <span class="swatch-color" style="background: <?php echo esc_attr($color['color_code']); ?>"></span>
                                                <span class="swatch-code"><?php echo esc_html($color['color_code']); ?></span>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($scheme['features_list']) : ?>
                                <div class="scheme-features">
                                    <h4>Merkmale</h4>
                                    <ul>
                                        <?php foreach ($scheme['features_list'] as $feature) : ?>
                                            <li><?php echo wohnegruen_get_icon('check'); ?> <?php echo esc_html($feature['feature']); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if ($scheme['interior_gallery']) : ?>
                            <div class="scheme-gallery">
                                <!-- Main Image Display -->
                                <div class="scheme-main-image">
                                    <img src="<?php echo esc_url($scheme['interior_gallery'][0]['sizes']['large']); ?>"
                                         alt="<?php echo esc_attr($scheme['scheme_name']); ?> Innenansicht"
                                         loading="lazy">
                                </div>

                                <!-- Thumbnail Navigation -->
                                <?php if (count($scheme['interior_gallery']) > 1) : ?>
                                    <div class="scheme-thumbnails">
                                        <?php foreach ($scheme['interior_gallery'] as $img_index => $image) : ?>
                                            <button class="scheme-thumb <?php echo $img_index === 0 ? 'active' : ''; ?>"
                                                    data-image="<?php echo esc_url($image['sizes']['large']); ?>">
                                                <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>"
                                                     alt="Ansicht <?php echo $img_index + 1; ?>">
                                            </button>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Optional: Link to full gallery -->
        <div class="interior-cta">
            <a href="<?php echo esc_url(home_url('/galerie/')); ?>" class="btn btn-outline btn-lg">
                Alle Innenansichten in der Galerie
                <?php echo wohnegruen_get_icon('arrow-right'); ?>
            </a>
        </div>
    </div>
</section>

<script>
// Interior colors interactive functionality
document.addEventListener('DOMContentLoaded', function() {
    // Scheme selection
    const schemePills = document.querySelectorAll('.color-scheme-pill');
    const schemeContents = document.querySelectorAll('.scheme-content');

    schemePills.forEach(pill => {
        pill.addEventListener('click', function() {
            const schemeId = this.dataset.scheme;

            // Update active pill
            schemePills.forEach(p => p.classList.remove('active'));
            this.classList.add('active');

            // Show corresponding content
            schemeContents.forEach(content => {
                if (content.dataset.schemeContent === schemeId) {
                    content.classList.add('active');
                } else {
                    content.classList.remove('active');
                }
            });
        });
    });

    // Thumbnail navigation
    document.querySelectorAll('.scheme-thumb').forEach(thumb => {
        thumb.addEventListener('click', function() {
            const gallery = this.closest('.scheme-gallery');
            const mainImage = gallery.querySelector('.scheme-main-image img');
            const newSrc = this.dataset.image;

            // Update active thumbnail
            gallery.querySelectorAll('.scheme-thumb').forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            // Update main image with fade
            mainImage.style.opacity = '0';
            setTimeout(() => {
                mainImage.src = newSrc;
                mainImage.style.opacity = '1';
            }, 200);
        });
    });
});
</script>
