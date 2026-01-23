<?php
/**
 * Block Template: CTA
 */

$title = get_field('cta_title') ?: '';
$text = get_field('cta_text') ?: '';
$btn_text = get_field('cta_btn_text') ?: '';
$btn_link = get_field('cta_btn_link') ?: '';
$background = get_field('cta_background') ?: 'primary';

$block_id = isset($block['anchor']) ? $block['anchor'] : 'cta-' . $block['id'];
$bg_class = 'cta-bg-' . $background;
?>

<section class="cta-section <?php echo esc_attr($bg_class); ?>" id="<?php echo esc_attr($block_id); ?>">
    <div class="container">
        <div class="cta-content">
            <h2><?php echo esc_html($title); ?></h2>
            <p><?php echo esc_html($text); ?></p>
            <?php if ($btn_text && $btn_link) : ?>
                <a href="<?php echo esc_url($btn_link); ?>" class="btn <?php echo $background === 'primary' ? 'btn-white' : 'btn-primary'; ?> btn-lg">
                    <?php echo esc_html($btn_text); ?>
                    <?php echo wohnegruen_get_icon('arrow-right'); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>
