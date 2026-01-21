<?php
/**
 * Block Template: Exterior Colors Selector
 * Allows users to toggle between Anthrazit and Weiß exterior colors
 */

$title = get_field('exterior_title') ?: 'Außenfarbe wählen';
$subtitle = get_field('exterior_subtitle') ?: 'Wählen Sie zwischen zwei eleganten Außenfarben';

// Anthrazit option
$anthrazit_images = get_field('anthrazit_images'); // Gallery field
// Weiß option
$weiss_images = get_field('weiss_images'); // Gallery field

$block_id = isset($block['anchor']) ? $block['anchor'] : 'exterior-colors-' . uniqid();
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
        <div class="exterior-color-toggle">
            <button class="color-toggle-btn active" data-color="anthrazit">
                <span class="color-swatch" style="background: #3A3A3A;"></span>
                Anthrazit
            </button>
            <button class="color-toggle-btn" data-color="weiss">
                <span class="color-swatch" style="background: #FFFFFF; border: 1px solid #ddd;"></span>
                Weiß
            </button>
        </div>

        <!-- Exterior Images Display -->
        <div class="exterior-images-container">
            <?php if ($anthrazit_images) : ?>
                <div class="exterior-gallery active" data-color-gallery="anthrazit">
                    <div class="exterior-main-image">
                        <img src="<?php echo esc_url($anthrazit_images[0]['url']); ?>" alt="Anthrazit Außenansicht" loading="lazy">
                    </div>
                    <?php if (count($anthrazit_images) > 1) : ?>
                        <div class="exterior-thumbnails">
                            <?php foreach ($anthrazit_images as $index => $image) : ?>
                                <button class="exterior-thumb <?php echo $index === 0 ? 'active' : ''; ?>" data-image="<?php echo esc_url($image['url']); ?>">
                                    <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="Ansicht <?php echo $index + 1; ?>">
                                </button>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($weiss_images) : ?>
                <div class="exterior-gallery" data-color-gallery="weiss">
                    <div class="exterior-main-image">
                        <img src="<?php echo esc_url($weiss_images[0]['url']); ?>" alt="Weiß Außenansicht" loading="lazy">
                    </div>
                    <?php if (count($weiss_images) > 1) : ?>
                        <div class="exterior-thumbnails">
                            <?php foreach ($weiss_images as $index => $image) : ?>
                                <button class="exterior-thumb <?php echo $index === 0 ? 'active' : ''; ?>" data-image="<?php echo esc_url($image['url']); ?>">
                                    <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="Ansicht <?php echo $index + 1; ?>">
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

            // Update active button
            toggleBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            // Show corresponding gallery
            galleries.forEach(gallery => {
                if (gallery.dataset.colorGallery === color) {
                    gallery.classList.add('active');
                } else {
                    gallery.classList.remove('active');
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
