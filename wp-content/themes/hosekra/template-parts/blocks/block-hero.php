<?php
/**
 * Block Template: Hero (with Group Field)
 */

// Get entire group field
$hero = get_field('hero_block') ?: array();

// Set defaults - will show even if no data is entered
$hero_bg         = $hero['hero_background'] ?? null;
$hero_badge      = $hero['hero_badge'] ?? 'Österreichweit verfügbar';
$hero_title      = $hero['hero_title'] ?? 'Nachhaltige Mobilhäuser für modernes Leben';
$hero_subtitle   = $hero['hero_subtitle'] ?? 'Hochwertige, maßgefertigte Mobilhäuser mit österreichischer Qualität. Flexibel, ökologisch und in kürzester Zeit bereit.';
$hero_btn1_text  = $hero['hero_btn1_text'] ?? 'Modelle entdecken';
$hero_btn1_link  = $hero['hero_btn1_link'] ?? '#modelle';
$hero_btn2_text  = $hero['hero_btn2_text'] ?? 'Beratung anfragen';
$hero_btn2_link  = $hero['hero_btn2_link'] ?? '#kontakt';
$hero_stats      = $hero['hero_stats'] ?? [];

$block_id = isset($block['anchor']) ? $block['anchor'] : 'home';
?>

<section class="hero-section" id="<?php echo esc_attr($block_id); ?>">
    <div class="hero-background">
        <?php if (!empty($hero_bg)) : ?>
            <img src="<?php echo esc_url($hero_bg['url']); ?>" alt="<?php echo esc_attr($hero_bg['alt'] ?? 'Hero-Hintergrund'); ?>">
        <?php else : ?>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg.jpg" alt="Hero-Hintergrund">
        <?php endif; ?>
    </div>
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
                            <span class="hero-stat-number"><?php echo esc_html($stat['number']); ?></span>
                            <span class="hero-stat-label"><?php echo esc_html($stat['label']); ?></span>
                        </div>
                        <?php $first = false; ?>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="hero-stats animate-fade-in">
                    <div class="hero-stat">
                        <span class="hero-stat-number">15+</span>
                        <span class="hero-stat-label">Jahre Garantie</span>
                    </div>
                    <div class="hero-stat-divider"></div>
                    <div class="hero-stat">
                        <span class="hero-stat-number">500+</span>
                        <span class="hero-stat-label">Zufriedene Kunden</span>
                    </div>
                    <div class="hero-stat-divider"></div>
                    <div class="hero-stat">
                        <span class="hero-stat-number">100%</span>
                        <span class="hero-stat-label">Made in EU</span>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
