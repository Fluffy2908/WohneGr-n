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
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/wohnegruen-mobilhaus-exterior-3.jpg" alt="Galerie WohneGrün">
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
            // Gallery images from Hosekra
            $default_images = array(
                array('category' => 'exterior', 'title' => 'WohneGrün Mobilhaus Außenansicht', 'url' => get_template_directory_uri() . '/assets/images/wohnegruen-mobilhaus-exterior-1.jpg'),
                array('category' => 'exterior', 'title' => 'Modernes Mobilheim im Grünen', 'url' => get_template_directory_uri() . '/assets/images/wohnegruen-mobilhaus-exterior-2.jpg'),
                array('category' => 'exterior', 'title' => 'Mobilhaus mit Panoramafenster', 'url' => get_template_directory_uri() . '/assets/images/wohnegruen-mobilhaus-exterior-3.jpg'),
                array('category' => 'terrace', 'title' => 'Terrasse mit Gartenmöbeln', 'url' => get_template_directory_uri() . '/assets/images/wohnegruen-mobilhaus-terrace-1.jpg'),
                array('category' => 'terrace', 'title' => 'Outdoor Wohnbereich', 'url' => get_template_directory_uri() . '/assets/images/wohnegruen-mobilhaus-terrace-2.jpg'),
                array('category' => 'terrace', 'title' => 'Terrasse mit Bergblick', 'url' => get_template_directory_uri() . '/assets/images/wohnegruen-mobilhaus-terrace-3.jpg'),
                array('category' => 'interior', 'title' => 'Moderne Küche in heller Holzoptik', 'url' => get_template_directory_uri() . '/assets/images/wohnegruen-mobilhaus-interior-kitchen-1.jpg'),
                array('category' => 'interior', 'title' => 'Küche in dunklem Design', 'url' => get_template_directory_uri() . '/assets/images/wohnegruen-mobilhaus-interior-kitchen-2.jpg'),
                array('category' => 'interior', 'title' => 'Elegante Küchenausstattung', 'url' => get_template_directory_uri() . '/assets/images/wohnegruen-mobilhaus-interior-kitchen-3.jpg'),
                array('category' => 'interior', 'title' => 'Helles Wohnzimmer', 'url' => get_template_directory_uri() . '/assets/images/wohnegruen-mobilhaus-interior-living-1.jpg'),
                array('category' => 'interior', 'title' => 'Moderner Wohnbereich', 'url' => get_template_directory_uri() . '/assets/images/wohnegruen-mobilhaus-interior-living-2.jpg'),
                array('category' => 'interior', 'title' => 'Gemütliches Schlafzimmer', 'url' => get_template_directory_uri() . '/assets/images/wohnegruen-mobilhaus-interior-bedroom-1.jpg'),
                array('category' => 'interior', 'title' => 'Modernes Badezimmer', 'url' => get_template_directory_uri() . '/assets/images/wohnegruen-mobilhaus-interior-bathroom-1.jpg'),
                array('category' => 'exterior', 'title' => 'Mobilheim im Sonnenuntergang', 'url' => get_template_directory_uri() . '/assets/images/wohnegruen-mobilhaus-exterior-4.jpg'),
                array('category' => 'exterior', 'title' => 'Seitenansicht Mobilhaus', 'url' => get_template_directory_uri() . '/assets/images/wohnegruen-mobilhaus-exterior-5.jpg'),
                array('category' => 'exterior', 'title' => 'Eingangsbereich', 'url' => get_template_directory_uri() . '/assets/images/wohnegruen-mobilhaus-exterior-6.jpg'),
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

        <!-- Tour Features -->
        <div class="tour-features-top">
            <button class="tour-feature-btn active" data-view="all">
                <div class="tour-feature-icon">
                    <?php echo wohnegruen_get_icon('grid'); ?>
                </div>
                <span>Alle Räume ansehen</span>
            </button>
            <button class="tour-feature-btn" data-view="360">
                <div class="tour-feature-icon">
                    <?php echo wohnegruen_get_icon('cube'); ?>
                </div>
                <span>360-Grad-Ansicht</span>
            </button>
            <button class="tour-feature-btn" data-view="floorplan">
                <div class="tour-feature-icon">
                    <?php echo wohnegruen_get_icon('home'); ?>
                </div>
                <span>Grundrisse</span>
            </button>
            <button class="tour-feature-btn" data-view="interior">
                <div class="tour-feature-icon">
                    <?php echo wohnegruen_get_icon('star'); ?>
                </div>
                <span>Innenausstattung</span>
            </button>
        </div>

        <!-- Floor Plans -->
        <div class="floor-plans-wrapper">
            <h3>3D Grundrisse</h3>
            <div class="floor-plans-grid">
                <?php
                $floor_plans = array(
                    array(
                        'name' => 'Nature - Layout 1',
                        'size' => '24 m²',
                        'rooms' => '3 x 8 m',
                        'type' => 'floorplan',
                        'description' => 'Offener Wohnbereich mit separatem Schlafzimmer und Badezimmer.',
                        'image' => get_template_directory_uri() . '/assets/images/floor-plan-eko-03.jpg',
                    ),
                    array(
                        'name' => 'Nature - Layout 2 (Gespiegelt)',
                        'size' => '24 m²',
                        'rooms' => '3 x 8 m',
                        'type' => 'floorplan',
                        'description' => 'Alternative Aufteilung mit größerer Terrasse und kompaktem Wohnbereich.',
                        'image' => get_template_directory_uri() . '/assets/images/floor-plan-eko-03-mirrored.jpg',
                    ),
                    array(
                        'name' => 'Pure - 3D Ansicht 1',
                        'size' => '24 m²',
                        'rooms' => '1 Zimmer',
                        'type' => '360',
                        'description' => 'Minimalistischer offener Grundriss, ideal für Singles oder Paare.',
                        'image' => get_template_directory_uri() . '/assets/images/floor-plan-eko-03-3d-1.jpg',
                    ),
                    array(
                        'name' => 'Pure - 3D Ansicht 2',
                        'size' => '24 m²',
                        'rooms' => '1 Zimmer',
                        'type' => '360',
                        'description' => 'Minimalistischer offener Grundriss mit moderner Einrichtung.',
                        'image' => get_template_directory_uri() . '/assets/images/floor-plan-eko-03-3d-2.jpg',
                    ),
                    array(
                        'name' => 'Nature - DeLux Innenausstattung',
                        'size' => '24 m²',
                        'rooms' => 'Komplett ausgestattet',
                        'type' => 'interior',
                        'description' => 'Hochwertige Innenausstattung mit modernem Design und Premium-Materialien.',
                        'image' => get_template_directory_uri() . '/assets/images/interior-eko-delux.jpg',
                    ),
                    array(
                        'name' => 'Pure - Premium Innenausstattung',
                        'size' => '24 m²',
                        'rooms' => 'Voll ausgestattet',
                        'type' => 'interior',
                        'description' => 'Elegante Innenausstattung mit hochwertigen Oberflächen und moderner Küche.',
                        'image' => get_template_directory_uri() . '/assets/images/interior-panorama-delux.jpg',
                    ),
                );

                foreach ($floor_plans as $index => $plan) : ?>
                    <div class="floor-plan-card" data-type="<?php echo esc_attr($plan['type']); ?>">
                        <div class="floor-plan-image">
                            <?php if (isset($plan['image'])) : ?>
                                <img src="<?php echo esc_url($plan['image']); ?>" alt="<?php echo esc_attr($plan['name']); ?>">
                            <?php else : ?>
                                <div class="floor-plan-placeholder">
                                    <?php echo wohnegruen_get_icon('grid'); ?>
                                    <span>Grundriss</span>
                                </div>
                            <?php endif; ?>
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

    // Floor plan filtering functionality
    const tourBtns = document.querySelectorAll('.tour-feature-btn');
    const floorPlanCards = document.querySelectorAll('.floor-plan-card');

    if (tourBtns.length && floorPlanCards.length) {
        tourBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const view = this.dataset.view;

                // Update active button
                tourBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                // Filter floor plans
                floorPlanCards.forEach(card => {
                    const cardType = card.dataset.type;
                    if (view === 'all' || cardType === view) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    }
});
</script>

<?php get_footer(); ?>
