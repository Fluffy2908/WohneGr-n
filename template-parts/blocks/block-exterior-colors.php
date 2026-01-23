<?php
/**
 * Block Template: Exterior Colors Selector
 * Allows users to toggle between Anthrazit and Weiß exterior colors
 */

$title = get_field('exterior_title');
$subtitle = get_field('exterior_subtitle');

// Anthrazit option
$anthrazit_images = get_field('anthrazit_images'); // Gallery field
// Weiß option
$weiss_images = get_field('weiss_images'); // Gallery field

$block_id = isset($block['anchor']) ? $block['anchor'] : 'exterior-colors-' . $block['id'];
?>

<section class="exterior-colors-section section-padding" id="<?php echo esc_attr($block_id); ?>">
    <div class="container">
        <div class="section-header">
            <h2><?php echo esc_html($title); ?></h2>
            <?php if ($subtitle) : ?>
                <p><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>
        </div>

        <!-- Color Toggle Buttons -->
        <div class="exterior-color-toggle" role="tablist" aria-label="Farbauswahl Außenansicht">
            <button class="color-toggle-btn active" data-color="anthrazit" role="tab" aria-selected="true" aria-controls="anthrazit-gallery" aria-label="Zeige Mobilhaus in Anthrazit">
                <span class="color-swatch" style="background: #3A3A3A;" aria-hidden="true"></span>
                Anthrazit
            </button>
            <button class="color-toggle-btn" data-color="weiss" role="tab" aria-selected="false" aria-controls="weiss-gallery" aria-label="Zeige Mobilhaus in Weiß">
                <span class="color-swatch" style="background: #FFFFFF; border: 1px solid #ddd;" aria-hidden="true"></span>
                Weiß
            </button>
        </div>

        <!-- Exterior Images Display -->
        <div class="exterior-images-container">
            <?php if ($anthrazit_images) : ?>
                <div class="exterior-gallery active" data-color-gallery="anthrazit" id="anthrazit-gallery" role="tabpanel" aria-labelledby="anthrazit-tab">
                    <div class="exterior-main-image">
                        <img src="<?php echo esc_url($anthrazit_images[0]['url']); ?>" alt="WohneGrün Mobilhaus Außenansicht in Anthrazit - Moderne Fassade" loading="lazy">
                    </div>
                    <?php if (count($anthrazit_images) > 1) : ?>
                        <div class="exterior-thumbnails" role="group" aria-label="Miniaturansichten Anthrazit">
                            <?php foreach ($anthrazit_images as $index => $image) : ?>
                                <button class="exterior-thumb <?php echo $index === 0 ? 'active' : ''; ?>" data-image="<?php echo esc_url($image['url']); ?>" aria-label="Zeige Anthrazit Ansicht <?php echo $index + 1; ?>">
                                    <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="Anthrazit Miniatur <?php echo $index + 1; ?>" aria-hidden="true">
                                </button>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($weiss_images) : ?>
                <div class="exterior-gallery" data-color-gallery="weiss" id="weiss-gallery" role="tabpanel" aria-labelledby="weiss-tab" aria-hidden="true">
                    <div class="exterior-main-image">
                        <img src="<?php echo esc_url($weiss_images[0]['url']); ?>" alt="WohneGrün Mobilhaus Außenansicht in Weiß - Elegante Fassade" loading="lazy">
                    </div>
                    <?php if (count($weiss_images) > 1) : ?>
                        <div class="exterior-thumbnails" role="group" aria-label="Miniaturansichten Weiß">
                            <?php foreach ($weiss_images as $index => $image) : ?>
                                <button class="exterior-thumb <?php echo $index === 0 ? 'active' : ''; ?>" data-image="<?php echo esc_url($image['url']); ?>" aria-label="Zeige Weiß Ansicht <?php echo $index + 1; ?>">
                                    <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="Weiß Miniatur <?php echo $index + 1; ?>" aria-hidden="true">
                                </button>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
// Exterior color toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtns = document.querySelectorAll('.color-toggle-btn');
    const galleries = document.querySelectorAll('.exterior-gallery');

    toggleBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const color = this.dataset.color;

            // Update active button and ARIA attributes
            toggleBtns.forEach(b => {
                b.classList.remove('active');
                b.setAttribute('aria-selected', 'false');
            });
            this.classList.add('active');
            this.setAttribute('aria-selected', 'true');

            // Show corresponding gallery with ARIA
            galleries.forEach(gallery => {
                if (gallery.dataset.colorGallery === color) {
                    gallery.classList.add('active');
                    gallery.setAttribute('aria-hidden', 'false');
                } else {
                    gallery.classList.remove('active');
                    gallery.setAttribute('aria-hidden', 'true');
                }
            });
        });
    });

    // Thumbnail click handlers
    document.querySelectorAll('.exterior-thumb').forEach(thumb => {
        thumb.addEventListener('click', function() {
            const gallery = this.closest('.exterior-gallery');
            const mainImage = gallery.querySelector('.exterior-main-image img');
            const newSrc = this.dataset.image;

            // Update active thumbnail
            gallery.querySelectorAll('.exterior-thumb').forEach(t => t.classList.remove('active'));
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
