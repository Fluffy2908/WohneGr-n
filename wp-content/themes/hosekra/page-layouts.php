<?php
/**
 * Template Name: Grundrisse & Innenausstattung
 * Template for displaying house layouts and interiors
 */

get_header();
?>

<main class="page-layouts">
    <?php
    // Check if page uses Gutenberg blocks
    if (have_posts()) :
        while (have_posts()) :
            the_post();

            // If page has blocks, render them
            if (has_blocks(get_the_content())) :
                the_content();
            else :
                // Fallback content if no blocks
                ?>
                <!-- Hero Section -->
                <section class="hero-section hero-small" id="top">
                    <div class="hero-background">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('full'); ?>
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg.jpg" alt="<?php the_title(); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="container">
                        <div class="hero-content">
                            <h1 class="animate-slide-up"><?php the_title(); ?></h1>
                            <?php if (get_the_excerpt()) : ?>
                                <p class="hero-text animate-slide-up"><?php the_excerpt(); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>

                <!-- Intro Section -->
                <section class="layouts-intro">
                    <div class="container">
                        <h2>Entdecken Sie unsere Grundrisse</h2>
                        <p>Jedes Mobilhaus ist mit Blick auf Praktikabilität und Komfort konzipiert. Entdecken Sie die verschiedenen Grundrisse und Innenausstattungen, die wir anbieten.</p>
                    </div>
                </section>

                <!-- Floor Plans -->
                <section class="floor-plans-section section-padding" id="grundrisse">
                    <div class="container">
                        <div class="section-header">
                            <h2>Grundrisse</h2>
                            <p>Verschiedene Größen und Layouts für unterschiedliche Bedürfnisse.</p>
                        </div>
                        <div class="floor-plans-grid">
                            <?php
                            $floor_plans = array(
                                array(
                                    'name' => 'Kompakt 25',
                                    'size' => '25 m²',
                                    'rooms' => '1 Zimmer',
                                    'bathrooms' => '1 Badezimmer',
                                    'description' => 'Ideal für Paare oder als Wochenendhaus. Offener Wohnbereich mit Küchenzeile.',
                                ),
                                array(
                                    'name' => 'Comfort 45',
                                    'size' => '45 m²',
                                    'rooms' => '2 Zimmer',
                                    'bathrooms' => '1 Badezimmer',
                                    'description' => 'Perfekte Familienaufteilung mit separatem Schlafzimmer und offenem Wohnbereich.',
                                ),
                                array(
                                    'name' => 'Premium 65',
                                    'size' => '65 m²',
                                    'rooms' => '3 Zimmer',
                                    'bathrooms' => '2 Badezimmer',
                                    'description' => 'Geräumige Gestaltung mit großer Terrasse, zusätzlichem Zimmer und zwei Badezimmern.',
                                ),
                            );

                            foreach ($floor_plans as $plan) :
                            ?>
                                <div class="floor-plan-card">
                                    <div class="floor-plan-image">
                                        <div class="floor-plan-placeholder">
                                            <?php echo wohnegruen_get_icon('grid'); ?>
                                            <span>Grundriss</span>
                                        </div>
                                        <button class="floor-plan-zoom" title="Vergrößern">
                                            <?php echo wohnegruen_get_icon('expand'); ?>
                                        </button>
                                    </div>
                                    <div class="floor-plan-content">
                                        <h3><?php echo esc_html($plan['name']); ?></h3>
                                        <div class="floor-plan-specs">
                                            <div class="floor-plan-spec">
                                                <?php echo wohnegruen_get_icon('size'); ?>
                                                <span><?php echo esc_html($plan['size']); ?></span>
                                            </div>
                                            <div class="floor-plan-spec">
                                                <?php echo wohnegruen_get_icon('rooms'); ?>
                                                <span><?php echo esc_html($plan['rooms']); ?></span>
                                            </div>
                                            <div class="floor-plan-spec">
                                                <?php echo wohnegruen_get_icon('home'); ?>
                                                <span><?php echo esc_html($plan['bathrooms']); ?></span>
                                            </div>
                                        </div>
                                        <p><?php echo esc_html($plan['description']); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>

                <!-- Interiors -->
                <section class="interiors-section section-padding" id="innenausstattung">
                    <div class="container">
                        <div class="section-header">
                            <h2>Innenausstattung</h2>
                            <p>Entdecken Sie die Innenausstattung unserer Mobilhäuser.</p>
                        </div>
                        <div class="interiors-grid">
                            <?php
                            $rooms = array(
                                array(
                                    'name' => 'Wohnzimmer',
                                    'description' => 'Heller und offener Raum zum Zusammensein und Entspannen.',
                                    'features' => array(
                                        'Große Fenster für natürliches Licht',
                                        'Moderne Polstermöbel',
                                        'Anschluss für TV und Multimedia',
                                    ),
                                ),
                                array(
                                    'name' => 'Küche',
                                    'description' => 'Voll ausgestattete Küche mit modernen Geräten.',
                                    'features' => array(
                                        'Einbaugeräte',
                                        'Kücheninsel',
                                        'Hochwertige Materialien',
                                    ),
                                ),
                                array(
                                    'name' => 'Schlafzimmer',
                                    'description' => 'Komfortables Schlafzimmer für ruhigen Schlaf.',
                                    'features' => array(
                                        'Großes Bett',
                                        'Einbauschränke',
                                        'Verdunklungsvorhänge',
                                    ),
                                ),
                                array(
                                    'name' => 'Badezimmer',
                                    'description' => 'Modernes Badezimmer mit allem Notwendigen.',
                                    'features' => array(
                                        'Duschkabine',
                                        'Doppelwaschbecken',
                                        'Fußbodenheizung',
                                    ),
                                ),
                            );

                            foreach ($rooms as $room) :
                            ?>
                                <div class="interior-card">
                                    <div class="interior-image">
                                        <div class="interior-placeholder">
                                            <?php echo wohnegruen_get_icon('home'); ?>
                                        </div>
                                    </div>
                                    <div class="interior-content">
                                        <h3><?php echo esc_html($room['name']); ?></h3>
                                        <p><?php echo esc_html($room['description']); ?></p>
                                        <ul class="interior-features">
                                            <?php foreach ($room['features'] as $feature) : ?>
                                                <li>
                                                    <?php echo wohnegruen_get_icon('check'); ?>
                                                    <span><?php echo esc_html($feature); ?></span>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>

                <!-- 3D Tour Section -->
                <section class="tour-section section-padding" id="3d-rundgang">
                    <div class="container">
                        <div class="section-header">
                            <h2>Virtueller Rundgang</h2>
                            <p>Entdecken Sie unsere Mobilhäuser in 360 Grad.</p>
                        </div>
                        <div class="tour-wrapper">
                            <div class="tour-content">
                                <div class="tour-placeholder">
                                    <?php echo wohnegruen_get_icon('cube'); ?>
                                    <p>3D-Rundgang in Kürze verfügbar</p>
                                </div>
                            </div>
                            <div class="tour-features">
                                <div class="tour-feature">
                                    <div class="tour-feature-icon">
                                        <?php echo wohnegruen_get_icon('cube'); ?>
                                    </div>
                                    <span>360-Grad-Ansicht</span>
                                </div>
                                <div class="tour-feature">
                                    <div class="tour-feature-icon">
                                        <?php echo wohnegruen_get_icon('expand'); ?>
                                    </div>
                                    <span>Vollbildmodus</span>
                                </div>
                                <div class="tour-feature">
                                    <div class="tour-feature-icon">
                                        <?php echo wohnegruen_get_icon('play'); ?>
                                    </div>
                                    <span>Interaktive Navigation</span>
                                </div>
                                <div class="tour-feature">
                                    <div class="tour-feature-icon">
                                        <?php echo wohnegruen_get_icon('grid'); ?>
                                    </div>
                                    <span>Alle Räume ansehen</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- CTA Section -->
                <section class="cta-section cta-bg-primary">
                    <div class="container">
                        <div class="cta-content">
                            <h2>Möchten Sie mehr erfahren?</h2>
                            <p>Kontaktieren Sie uns für eine kostenlose Beratung und Besichtigung unserer Mobilhäuser.</p>
                            <a href="<?php echo esc_url(home_url('/#kontakt')); ?>" class="btn btn-white btn-lg">
                                Kontaktieren Sie uns
                                <?php echo wohnegruen_get_icon('arrow-right'); ?>
                            </a>
                        </div>
                    </div>
                </section>
                <?php
            endif;
        endwhile;
    endif;
    ?>
</main>

<?php get_footer(); ?>
