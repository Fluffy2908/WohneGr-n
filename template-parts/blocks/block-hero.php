<?php
/**
 * Block Template: Hero (supports both group field and direct fields)
 */

// Try to get direct fields first (for Gutenberg blocks)
// Fall back to group field (for backward compatibility)
$hero_bg         = get_field('hero_background') ?: (get_field('hero_block')['hero_background'] ?? null);
$hero_badge      = get_field('hero_badge') ?: (get_field('hero_block')['hero_badge'] ?? '');
$hero_title      = get_field('hero_title') ?: (get_field('hero_block')['hero_title'] ?? '');
$hero_subtitle   = get_field('hero_subtitle') ?: (get_field('hero_block')['hero_subtitle'] ?? '');
$hero_btn1_text  = get_field('hero_btn1_text') ?: (get_field('hero_block')['hero_btn1_text'] ?? '');
$hero_btn1_link  = get_field('hero_btn1_link') ?: (get_field('hero_block')['hero_btn1_link'] ?? '');
$hero_btn2_text  = get_field('hero_btn2_text') ?: (get_field('hero_block')['hero_btn2_text'] ?? '');
$hero_btn2_link  = get_field('hero_btn2_link') ?: (get_field('hero_block')['hero_btn2_link'] ?? '');
$hero_stats      = get_field('hero_stats') ?: (get_field('hero_block')['hero_stats'] ?? []);

$block_id = isset($block['anchor']) ? $block['anchor'] : 'hero-' . $block['id'];
?>

<section class="hero-section" id="<?php echo esc_attr($block_id); ?>">
    <?php if (!empty($hero_bg) && isset($hero_bg['url'])) : ?>
        <div class="hero-background">
            <img src="<?php echo esc_url($hero_bg['url']); ?>" alt="<?php echo esc_attr($hero_bg['alt'] ?? 'Hero-Hintergrund'); ?>">
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge animate-fade-in">
                <?php echo wohnegruen_get_icon('location'); ?>
                <span><?php echo esc_html($hero_badge); ?></span>
            </div>

            <h1 class="animate-slide-up"><?php echo esc_html($hero_title); ?></h1>

            <p class="hero-text animate-slide-up"><?php echo esc_html($hero_subtitle); ?></p>

            <div class="hero-buttons animate-slide-up">
                <?php if ($hero_btn1_text && $hero_btn1_link) : ?>
                    <a href="<?php echo esc_url($hero_btn1_link); ?>" class="btn btn-primary btn-lg">
                        <?php echo esc_html($hero_btn1_text); ?>
                        <?php echo wohnegruen_get_icon('arrow-right'); ?>
                    </a>
                <?php endif; ?>
                <?php if ($hero_btn2_text && $hero_btn2_link) : ?>
                    <a href="<?php echo esc_url($hero_btn2_link); ?>" class="btn btn-white btn-lg">
                        <?php echo esc_html($hero_btn2_text); ?>
                    </a>
                <?php endif; ?>
            </div>

            <?php if (!empty($hero_stats) && is_array($hero_stats)) : ?>
                <div class="hero-stats animate-fade-in">
                    <?php $first = true; foreach ($hero_stats as $stat) : ?>
                        <?php if (!$first) : ?><div class="hero-stat-divider"></div><?php endif; ?>
                        <div class="hero-stat">
                            <span class="hero-stat-number"><?php echo isset($stat['number']) ? esc_html($stat['number']) : ''; ?></span>
                            <span class="hero-stat-label"><?php echo isset($stat['label']) ? esc_html($stat['label']) : ''; ?></span>
                        </div>
                        <?php $first = false; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
