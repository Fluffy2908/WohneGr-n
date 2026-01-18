<?php
/**
 * Block: Gallery with Tabs
 *
 * Displays gallery with category filters and tabs (Gallery/3D Tour)
 */

// Get block fields
$gallery_title = get_field('gallery_title');
$gallery_subtitle = get_field('gallery_subtitle');
$gallery_images = get_field('gallery_images');
$show_3d_tab = get_field('show_3d_tab');
$floor_plans = get_field('floor_plans');

?>

<!-- Gallery Hero -->
<?php if (!empty($gallery_title)): ?>
    <section class="gallery-section-header section-padding-small">
        <div class="container">
            <div class="section-header">
                <h2><?php echo esc_html($gallery_title); ?></h2>
                <?php if (!empty($gallery_subtitle)): ?>
                    <p><?php echo esc_html($gallery_subtitle); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- Tab Navigation -->
<?php if ($show_3d_tab): ?>
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
<?php endif; ?>

<!-- Gallery Section -->
<section class="gallery-section section-padding" id="gallery-content">
    <div class="container">
        <!-- Category Filter -->
        <?php if (!empty($gallery_images)): ?>
            <?php
            // Get unique categories
            $categories = array();
            foreach ($gallery_images as $image) {
                if (!empty($image['category']) && !in_array($image['category'], $categories)) {
                    $categories[] = $image['category'];
                }
            }
            ?>
            <?php if (count($categories) > 1): ?>
                <div class="gallery-filters">
                    <button class="gallery-filter-btn active" data-filter="all">Alle</button>
                    <?php
                    $category_labels = array(
                        'exterior' => 'Außenansicht',
                        'interior' => 'Innenausstattung',
                        'terrace' => 'Terrasse',
                        'other' => 'Sonstiges',
                    );
                    foreach ($categories as $cat):
                        $label = isset($category_labels[$cat]) ? $category_labels[$cat] : ucfirst($cat);
                    ?>
                        <button class="gallery-filter-btn" data-filter="<?php echo esc_attr($cat); ?>">
                            <?php echo esc_html($label); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Image Grid -->
            <div class="gallery-grid">
                <?php foreach ($gallery_images as $index => $image_data):
                    $image = $image_data['image'];
                    $category = !empty($image_data['category']) ? $image_data['category'] : 'other';
                    $title = !empty($image_data['title']) ? $image_data['title'] : $image['title'];
                ?>
                    <div class="gallery-item" data-category="<?php echo esc_attr($category); ?>" data-index="<?php echo $index; ?>">
                        <img src="<?php echo esc_url($image['sizes']['large'] ?? $image['url']); ?>" alt="<?php echo esc_attr($title); ?>" loading="lazy">
                        <div class="gallery-item-overlay">
                            <p class="gallery-item-title"><?php echo esc_html($title); ?></p>
                            <?php if (!empty($category)): ?>
                                <span class="gallery-item-category">
                                    <?php echo esc_html($category_labels[$category] ?? $category); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Keine Bilder vorhanden. Bitte fügen Sie Bilder im Block-Editor hinzu.</p>
        <?php endif; ?>
    </div>
</section>

<!-- 3D Tour Section -->
<?php if ($show_3d_tab): ?>
    <section class="tour-section section-padding" id="3d-content" style="display: none;">
        <div class="container">
            <div class="section-header">
                <h2>Virtueller Rundgang</h2>
                <p>Entdecken Sie unsere Mobilhäuser in 360 Grad und sehen Sie die detaillierten 3D-Grundrisse.</p>
            </div>

            <!-- Tour Features -->
            <?php if (!empty($floor_plans)): ?>
                <?php
                // Get unique types
                $types = array();
                foreach ($floor_plans as $plan) {
                    if (!empty($plan['type']) && !in_array($plan['type'], $types)) {
                        $types[] = $plan['type'];
                    }
                }
                ?>
                <?php if (count($types) > 1): ?>
                    <div class="tour-features-top">
                        <button class="tour-feature-btn active" data-view="all">
                            <div class="tour-feature-icon"><?php echo wohnegruen_get_icon('grid'); ?></div>
                            <span>Alle Räume ansehen</span>
                        </button>
                        <?php
                        $type_config = array(
                            '360' => array('icon' => 'cube', 'label' => '360-Grad-Ansicht'),
                            'floorplan' => array('icon' => 'home', 'label' => 'Grundrisse'),
                            'interior' => array('icon' => 'star', 'label' => 'Innenausstattung'),
                        );
                        foreach ($types as $type):
                            if (isset($type_config[$type])):
                        ?>
                            <button class="tour-feature-btn" data-view="<?php echo esc_attr($type); ?>">
                                <div class="tour-feature-icon"><?php echo wohnegruen_get_icon($type_config[$type]['icon']); ?></div>
                                <span><?php echo esc_html($type_config[$type]['label']); ?></span>
                            </button>
                        <?php
                            endif;
                        endforeach;
                        ?>
                    </div>
                <?php endif; ?>

                <!-- Floor Plans -->
                <div class="floor-plans-wrapper">
                    <h3>3D Grundrisse</h3>
                    <div class="floor-plans-grid">
                        <?php foreach ($floor_plans as $index => $plan): ?>
                            <div class="floor-plan-card" data-type="<?php echo esc_attr($plan['type'] ?? 'floorplan'); ?>">
                                <div class="floor-plan-image">
                                    <?php if (!empty($plan['image'])): ?>
                                        <img src="<?php echo esc_url($plan['image']['url']); ?>" alt="<?php echo esc_attr($plan['name']); ?>" loading="lazy">
                                    <?php else: ?>
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
                                        <?php if (!empty($plan['size'])): ?>
                                            <div class="floor-plan-spec">
                                                <?php echo wohnegruen_get_icon('size'); ?>
                                                <span><?php echo esc_html($plan['size']); ?></span>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($plan['rooms'])): ?>
                                            <div class="floor-plan-spec">
                                                <?php echo wohnegruen_get_icon('rooms'); ?>
                                                <span><?php echo esc_html($plan['rooms']); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($plan['description'])): ?>
                                        <p><?php echo esc_html($plan['description']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>

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

<!-- Floor Plan Lightbox -->
<div class="gallery-lightbox" id="floor-plan-lightbox">
    <button class="lightbox-close" aria-label="Schließen">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
    <div class="lightbox-content">
        <img src="" alt="" id="floor-plan-lightbox-image">
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching
    const tabs = document.querySelectorAll('.gallery-tab');
    const galleryContent = document.getElementById('gallery-content');
    const tourContent = document.getElementById('3d-content');

    if (tabs.length > 0) {
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                tabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                if (this.dataset.tab === 'gallery') {
                    galleryContent.style.display = 'block';
                    if (tourContent) tourContent.style.display = 'none';
                } else {
                    galleryContent.style.display = 'none';
                    if (tourContent) tourContent.style.display = 'block';
                }
            });
        });
    }

    // Gallery filtering
    const filterBtns = document.querySelectorAll('.gallery-filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.dataset.filter;

            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            galleryItems.forEach(item => {
                if (filter === 'all' || item.dataset.category === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Floor plan filtering
    const tourBtns = document.querySelectorAll('.tour-feature-btn');
    const floorPlanCards = document.querySelectorAll('.floor-plan-card');

    if (tourBtns.length > 0) {
        tourBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const view = this.dataset.view;

                tourBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                floorPlanCards.forEach(card => {
                    if (view === 'all' || card.dataset.type === view) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    }

    // Gallery lightbox (use existing lightbox functionality from main.js)
});
</script>
