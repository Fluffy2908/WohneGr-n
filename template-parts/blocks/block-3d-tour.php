<?php
/**
 * Block Template: 3D Tour
 */

$title = get_field('tour_title') ?: 'Virtueller Rundgang';
$subtitle = get_field('tour_subtitle') ?: 'Entdecken Sie unsere Mobilhäuser in 360 Grad.';
$description = get_field('tour_description');
$button_text = get_field('tour_button_text');
$button_link = get_field('tour_button_link');
$video_placeholder = get_field('tour_video_placeholder');
$type = get_field('tour_type') ?: 'video';
$video_url = get_field('tour_video_url');
$iframe_code = get_field('tour_iframe');
$preview_image = get_field('tour_preview_image');
$features = get_field('tour_features');

$block_id = isset($block['anchor']) ? $block['anchor'] : '3d-rundgang';

// Parse video URL for embed
$video_embed = '';
if ($video_url) {
    if (strpos($video_url, 'youtube.com') !== false || strpos($video_url, 'youtu.be') !== false) {
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $video_url, $matches);
        if (!empty($matches[1])) {
            $video_embed = 'https://www.youtube.com/embed/' . $matches[1];
        }
    } elseif (strpos($video_url, 'vimeo.com') !== false) {
        preg_match('/vimeo\.com\/(\d+)/', $video_url, $matches);
        if (!empty($matches[1])) {
            $video_embed = 'https://player.vimeo.com/video/' . $matches[1];
        }
    }
}

// Default features
if (!$features) {
    $features = array(
        array('icon' => 'cube', 'text' => '360-Grad-Ansicht'),
        array('icon' => 'expand', 'text' => 'Vollbildmodus'),
        array('icon' => 'play', 'text' => 'Interaktive Navigation'),
        array('icon' => 'grid', 'text' => 'Alle Räume ansehen'),
    );
}
?>

<section class="tour-section section-padding" id="<?php echo esc_attr($block_id); ?>">
    <div class="container">
        <div class="section-header">
            <h2><?php echo esc_html($title); ?></h2>
            <p><?php echo esc_html($subtitle); ?></p>
        </div>

        <div class="tour-wrapper">
            <div class="tour-content">
                <?php if ($type === 'video' && $video_embed) : ?>
                    <div class="tour-video">
                        <div class="video-container">
                            <iframe
                                src="<?php echo esc_url($video_embed); ?>"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                <?php elseif ($type === 'iframe' && $iframe_code) : ?>
                    <div class="tour-iframe">
                        <?php echo $iframe_code; ?>
                    </div>
                <?php elseif ($preview_image) : ?>
                    <div class="tour-preview">
                        <img src="<?php echo esc_url($preview_image['url']); ?>" alt="<?php echo esc_attr($preview_image['alt'] ?: $title); ?>">
                        <div class="tour-preview-overlay">
                            <button class="tour-play-btn" data-video="<?php echo esc_attr($video_url); ?>">
                                <?php echo wohnegruen_get_icon('play'); ?>
                                <span>Rundgang abspielen</span>
                            </button>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="tour-placeholder">
                        <div class="tour-placeholder-content">
                            <?php echo wohnegruen_get_icon('cube'); ?>
                            <?php if ($description) : ?>
                                <p><?php echo esc_html($description); ?></p>
                            <?php else : ?>
                                <p>3D-Rundgang in Kürze verfügbar</p>
                            <?php endif; ?>
                            <?php if ($button_text && $button_link) : ?>
                                <a href="<?php echo esc_url($button_link); ?>" class="btn btn-primary">
                                    <?php echo esc_html($button_text); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($features) : ?>
                <div class="tour-features">
                    <?php foreach ($features as $feature) : ?>
                        <div class="tour-feature">
                            <div class="tour-feature-icon">
                                <?php echo wohnegruen_get_icon($feature['icon']); ?>
                            </div>
                            <span><?php echo esc_html($feature['text']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
