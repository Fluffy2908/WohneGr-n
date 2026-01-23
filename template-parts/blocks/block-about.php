<?php
/**
 * Block Template: About
 */

$image = get_field('about_image');
$badge_number = get_field('about_badge_number') ?: '';
$badge_text = get_field('about_badge_text') ?: '';
$title = get_field('about_title') ?: '';
$text1 = get_field('about_text1') ?: '';
$text2 = get_field('about_text2') ?: '';
$list = get_field('about_list');

$block_id = isset($block['anchor']) ? $block['anchor'] : 'about-' . $block['id'];
?>

<section class="about-section section-padding" id="<?php echo esc_attr($block_id); ?>">
    <div class="container">
        <div class="about-wrapper">
            <div class="about-image-wrapper">
                <?php if ($image) : ?>
                    <div class="about-image">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?: 'Über uns'); ?>">
                    </div>
                <?php endif; ?>
                <div class="about-badge">
                    <span><?php echo esc_html($badge_number); ?></span>
                    <span><?php echo esc_html($badge_text); ?></span>
                </div>
            </div>
            <div class="about-content">
                <h2><?php echo esc_html($title); ?></h2>
                <p><?php echo esc_html($text1); ?></p>
                <p><?php echo esc_html($text2); ?></p>

                <?php if ($list) : ?>
                    <ul class="about-list">
                        <?php foreach ($list as $item) : ?>
                            <li>
                                <div class="check-icon"><?php echo wohnegruen_get_icon('check'); ?></div>
                                <span><?php echo esc_html($item['text']); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
