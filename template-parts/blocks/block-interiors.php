<?php
/**
 * Block Template: Interiors (with Color Slider Support)
 *
 * This block supports two modes:
 * 1. Simple interior rooms grid (legacy)
 * 2. Model showcase with color slider (for Modelle page)
 */

// Get fields
$title = get_field('interiors_title') ?: get_field('interior_title') ?: 'Innenausstattung';
$subtitle = get_field('interiors_subtitle') ?: get_field('interior_subtitle') ?: 'Entdecken Sie die Innenausstattung unserer Mobilhäuser.';
$model = get_field('interiors_model'); // nature or pure
$image = get_field('interiors_image');
$description = get_field('interiors_description');
$features = get_field('interiors_features');
$color_slider = get_field('interiors_color_slider');
$colors = get_field('interiors_colors');

// Legacy fields (for backward compatibility)
$rooms = get_field('interior_rooms');

$block_id = isset($block['anchor']) ? $block['anchor'] : 'innenausstattung-' . ($model ?: 'standard');

// Determine which mode to use
$use_color_slider = $color_slider && $colors && $model;
?>

<?php if ($use_color_slider) : ?>
    <!-- MODEL SHOWCASE MODE with Color Slider -->

    <!-- Model Hero Section -->
    <section class="model-hero-section" id="<?php echo esc_attr($block_id); ?>">
        <div class="model-hero-background">
            <?php if ($image) :
                $image_url = is_array($image) ? $image['url'] : wp_get_attachment_image_url($image, 'full');
            ?>
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>" loading="lazy">
            <?php endif; ?>
        </div>
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="model-hero-content">
                <?php if ($model === 'nature') : ?>
                    <div class="model-hero-badge">Natur</div>
                <?php elseif ($model === 'pure') : ?>
                    <div class="model-hero-badge model-badge-premium">Premium</div>
                <?php endif; ?>
                <h1><?php echo esc_html($title); ?></h1>
                <?php if ($subtitle) : ?>
                    <p class="model-hero-tagline"><?php echo esc_html($subtitle); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Model Description Section -->
    <section class="model-description-section section-padding">
        <div class="container">
            <div class="model-description-grid">
                <div class="model-description-content">
                    <?php if ($description) : ?>
                        <p><?php echo esc_html($description); ?></p>
                    <?php endif; ?>

                    <?php if ($features) : ?>
                        <ul class="model-features-list">
                            <?php foreach ($features as $feature) : ?>
                                <li>
                                    <?php echo wohnegruen_get_icon('check'); ?>
                                    <span><?php echo esc_html($feature['text']); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>

                <?php if ($image) :
                    $image_url = is_array($image) ? $image['url'] : wp_get_attachment_image_url($image, 'large');
                ?>
                    <div class="model-description-image">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>" loading="lazy">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Color Schemes Slider Section -->
    <section class="color-schemes-section section-padding">
        <div class="container">
            <h3>Farbkombinationen</h3>
            <p class="section-subtitle">Wählen Sie Ihre individuelle Farbkombination</p>

            <div class="color-slider-wrapper">
                <button class="slider-nav prev" data-slider="<?php echo esc_attr($model); ?>">‹</button>

                <div class="color-slider" id="<?php echo esc_attr($model); ?>-slider">
                    <?php $first = true; foreach ($colors as $color) :
                        $color_image = $color['image'];
                        $color_image_url = is_array($color_image) ? $color_image['url'] : wp_get_attachment_image_url($color_image, 'large');
                    ?>
                        <div class="color-slide <?php echo $first ? 'active' : ''; ?>">
                            <div class="color-slide-image">
                                <img src="<?php echo esc_url($color_image_url); ?>" alt="<?php echo esc_attr($color['title']); ?>" loading="lazy">
                            </div>
                            <div class="color-slide-content">
                                <h4><?php echo esc_html($color['title']); ?></h4>
                                <?php if (!empty($color['description'])) : ?>
                                    <p><?php echo esc_html($color['description']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php $first = false; endforeach; ?>
                </div>

                <button class="slider-nav next" data-slider="<?php echo esc_attr($model); ?>">›</button>
            </div>

            <div class="slider-dots" id="<?php echo esc_attr($model); ?>-dots"></div>
        </div>
    </section>

<?php else : ?>
    <!-- LEGACY MODE: Interior Rooms Grid -->

    <?php
    // Default rooms if none provided
    if (!$rooms) {
        $rooms = array(
            array(
                'name' => 'Wohnzimmer',
                'description' => 'Heller und offener Raum zum Zusammensein und Entspannen.',
                'features' => "Große Fenster für natürliches Licht\nModerne Polstermöbel\nAnschluss für TV und Multimedia",
            ),
            array(
                'name' => 'Küche',
                'description' => 'Voll ausgestattete Küche mit modernen Geräten.',
                'features' => "Einbaugeräte\nKücheninsel\nHochwertige Materialien",
            ),
            array(
                'name' => 'Schlafzimmer',
                'description' => 'Komfortables Schlafzimmer für ruhigen Schlaf.',
                'features' => "Großes Bett\nEinbauschränke\nVerdunklungsvorhänge",
            ),
            array(
                'name' => 'Badezimmer',
                'description' => 'Modernes Badezimmer mit allem Notwendigen.',
                'features' => "Duschkabine\nDoppelwaschbecken\nFußbodenheizung",
            ),
        );
    }
    ?>

    <section class="interiors-section section-padding" id="<?php echo esc_attr($block_id); ?>">
        <div class="container">
            <div class="section-header">
                <h2><?php echo esc_html($title); ?></h2>
                <p><?php echo esc_html($subtitle); ?></p>
            </div>

            <div class="interiors-grid">
                <?php foreach ($rooms as $room) : ?>
                    <div class="interior-card">
                        <div class="interior-image">
                            <?php if (!empty($room['image'])) : ?>
                                <img src="<?php echo esc_url($room['image']['url']); ?>" alt="<?php echo esc_attr($room['name']); ?>">
                            <?php else : ?>
                                <div class="interior-placeholder">
                                    <?php echo wohnegruen_get_icon('home'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="interior-content">
                            <h3><?php echo esc_html($room['name']); ?></h3>
                            <p><?php echo esc_html($room['description']); ?></p>
                            <?php if (!empty($room['features'])) : ?>
                                <ul class="interior-features">
                                    <?php
                                    $features_list = explode("\n", $room['features']);
                                    foreach ($features_list as $feature) :
                                        $feature = trim($feature);
                                        if (!empty($feature)) :
                                    ?>
                                        <li>
                                            <?php echo wohnegruen_get_icon('check'); ?>
                                            <span><?php echo esc_html($feature); ?></span>
                                        </li>
                                    <?php endif; endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

<?php endif; ?>
