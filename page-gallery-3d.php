<?php
/**
 * Template Name: Galerie & 3D Rundgang
 * Combined gallery and 3D tour page template
 */

get_header();
?>

<!-- Gallery Hero Section -->
<section class="hero-section hero-small" id="gallery-hero">
    <div class="hero-background">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg.jpg" alt="Galerie WohneGrün">
        <div class="hero-overlay"></div>
    </div>
    <div class="container">
        <div class="hero-content">
            <h1 class="animate-slide-up">Galerie & 3D Rundgang</h1>
            <p class="hero-text animate-slide-up">Entdecken Sie unsere Mobilhäuser in beeindruckenden Bildern und virtuellen Rundgängen</p>
        </div>
    </div>
</section>

<!-- Tab Navigation -->
<section class="gallery-tabs-section">
    <div class="container">
        <div class="gallery-tabs">
            <button class="gallery-tab active" data-tab="gallery">
                <?php echo wohnegruen_get_icon('grid'); ?>
                <span>Bildergalerie</span>
            </button>
            <button class="gallery-tab" data-tab="3d-tour">
                <?php echo wohnegruen_get_icon('cube'); ?>
                <span>3D Rundgang & Grundrisse</span>
            </button>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="gallery-section section-padding" id="gallery-content">
    <div class="container">
        <!-- Category Filter -->
        <div class="gallery-filters">
            <button class="gallery-filter-btn active" data-filter="all">Alle</button>
            <button class="gallery-filter-btn" data-filter="exterior">Außenansicht</button>
            <button class="gallery-filter-btn" data-filter="interior">Innenausstattung</button>
            <button class="gallery-filter-btn" data-filter="terrace">Terrasse</button>
        </div>

        <!-- Image Grid -->
        <div class="gallery-grid">
            <?php
            // Default gallery items (you can replace with ACF fields)
            $default_images = array(
                array('category' => 'exterior', 'title' => 'Mobilheim in alpiner Landschaft', 'url' => get_template_directory_uri() . '/assets/images/model-1.jpg'),
                array('category' => 'interior', 'title' => 'Modernes Wohnzimmer', 'url' => get_template_directory_uri() . '/assets/images/about.jpg'),
                array('category' => 'exterior', 'title' => 'Kompaktes Mobilheim', 'url' => get_template_directory_uri() . '/assets/images/model-2.jpg'),
                array('category' => 'exterior', 'title' => 'Luxus Mobilheim mit Terrasse', 'url' => get_template_directory_uri() . '/assets/images/model-3.jpg'),
                array('category' => 'interior', 'title' => 'Küche mit moderner Ausstattung', 'url' => get_template_directory_uri() . '/assets/images/about.jpg'),
                array('category' => 'exterior', 'title' => 'Mobilheim im Sonnenuntergang', 'url' => get_template_directory_uri() . '/assets/images/hero-bg.jpg'),
                array('category' => 'terrace', 'title' => 'Terrasse mit Bergblick', 'url' => get_template_directory_uri() . '/assets/images/model-1.jpg'),
                array('category' => 'exterior', 'title' => 'Mobilheim im Grünen', 'url' => get_template_directory_uri() . '/assets/images/model-2.jpg'),
            );

            foreach ($default_images as $index => $image) : ?>
                <div class="gallery-item" data-category="<?php echo esc_attr($image['category']); ?>" data-index="<?php echo $index; ?>">
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['title']); ?>">
                    <div class="gallery-item-overlay">
                        <p class="gallery-item-title"><?php echo esc_html($image['title']); ?></p>
                        <span class="gallery-item-category"><?php
                            $categories = array(
                                'exterior' => 'Außenansicht',
                                'interior' => 'Innenausstattung',
                                'terrace' => 'Terrasse'
                            );
                            echo esc_html($categories[$image['category']] ?? $image['category']);
                        ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- 3D Tour Section -->
<section class="tour-section section-padding" id="3d-content" style="display: none;">
    <div class="container">
        <div class="section-header">
            <h2>Virtueller Rundgang</h2>
            <p>Entdecken Sie unsere Mobilhäuser in 360 Grad und sehen Sie die detaillierten 3D-Grundrisse.</p>
        </div>

        <!-- 3D Tour Video/iFrame -->
        <div class="tour-wrapper">
            <div class="tour-content">
                <div class="tour-placeholder">
                    <?php echo wohnegruen_get_icon('cube'); ?>
                    <p>3D-Rundgang in Kürze verfügbar</p>
                    <span>Hier können Sie bald einen vollständigen virtuellen Rundgang durch unsere Mobilhäuser unternehmen.</span>
                </div>
            </div>
        </div>

        <!-- Floor Plans -->
        <div class="floor-plans-wrapper">
            <h3>3D Grundrisse</h3>
            <div class="floor-plans-grid">
                <?php
                $floor_plans = array(
                    array(
                        'name' => 'Nature - Layout 1',
                        'size' => '45 m²',
                        'rooms' => '2 Zimmer',
                        'description' => 'Offener Wohnbereich mit separatem Schlafzimmer und Badezimmer.',
                    ),
                    array(
                        'name' => 'Nature - Layout 2',
                        'size' => '45 m²',
                        'rooms' => '2 Zimmer',
                        'description' => 'Alternative Aufteilung mit größerer Terrasse und kompaktem Wohnbereich.',
                    ),
                    array(
                        'name' => 'Pure - Layout 1',
                        'size' => '35 m²',
                        'rooms' => '1 Zimmer',
                        'description' => 'Minimalistischer offener Grundriss, ideal für Singles oder Paare.',
                    ),
                );

                foreach ($floor_plans as $index => $plan) : ?>
                    <div class="floor-plan-card">
                        <div class="floor-plan-image">
                            <div class="floor-plan-placeholder">
                                <?php echo wohnegruen_get_icon('grid'); ?>
                                <span>Grundriss</span>
                            </div>
                            <button class="floor-plan-zoom" title="Vergrößern" data-plan="<?php echo $index; ?>">
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
                            </div>
                            <p><?php echo esc_html($plan['description']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Tour Features -->
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
</section>

<!-- Lightbox -->
<div class="gallery-lightbox" id="gallery-lightbox">
    <button class="lightbox-close" aria-label="Schließen">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
    <button class="lightbox-nav lightbox-prev" aria-label="Vorheriges Bild">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>
    <button class="lightbox-nav lightbox-next" aria-label="Nächstes Bild">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </button>
    <div class="lightbox-content">
        <img src="" alt="" id="lightbox-image">
    </div>
    <div class="lightbox-caption">
        <p id="lightbox-title"></p>
        <span id="lightbox-counter"></span>
    </div>
</div>

<script>
// Tab switching functionality
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.gallery-tab');
    const galleryContent = document.getElementById('gallery-content');
    const tourContent = document.getElementById('3d-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs
            tabs.forEach(t => t.classList.remove('active'));
            // Add active class to clicked tab
            this.classList.add('active');

            // Show/hide content
            if (this.dataset.tab === 'gallery') {
                galleryContent.style.display = 'block';
                tourContent.style.display = 'none';
            } else {
                galleryContent.style.display = 'none';
                tourContent.style.display = 'block';
            }
        });
    });
});
</script>

<?php get_footer(); ?>
