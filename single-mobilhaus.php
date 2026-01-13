<?php
/**
 * Single Mobilhaus Template
 * Template for displaying single mobilhaus/model posts
 */

get_header();

// Get model fields
$model_name = get_the_title();
$model_description = wohnegruen_get_field('model_short_description', get_the_ID(), get_the_excerpt());
$model_full_description = wohnegruen_get_field('model_full_description', get_the_ID(), get_the_content());
$model_price = wohnegruen_get_field('model_price', get_the_ID(), 'ab €45.000');
$model_size = wohnegruen_get_field('model_size', get_the_ID(), '35 m²');
$model_beds = wohnegruen_get_field('model_beds', get_the_ID(), '2');
$model_persons = wohnegruen_get_field('model_persons', get_the_ID(), '4');
$model_image = get_field('model_image') ?: get_the_post_thumbnail_url(get_the_ID(), 'full');
$model_features = get_field('model_features');
$model_specifications = get_field('model_specifications');

// Contact info
$contact_phone = wohnegruen_get_option('contact_phone', '+43 123 456 789');
$contact_email = wohnegruen_get_option('contact_email', 'info@wohnegruen.at');
?>

<!-- Model Hero Section -->
<section class="model-hero">
    <div class="model-hero-background">
        <?php if ($model_image) : ?>
            <img src="<?php echo esc_url($model_image); ?>" alt="<?php echo esc_attr($model_name); ?>">
        <?php else : ?>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/model-1.jpg" alt="<?php echo esc_attr($model_name); ?>">
        <?php endif; ?>
    </div>
    <div class="model-hero-content">
        <div class="container">
            <a href="<?php echo esc_url(home_url('/#modelle')); ?>" class="back-link">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Zurück zu allen Modellen
            </a>
            <h1><?php echo esc_html($model_name); ?></h1>
            <p class="model-hero-description"><?php echo esc_html($model_description); ?></p>
        </div>
    </div>
</section>

<!-- Model Details Section -->
<section class="model-details section-padding">
    <div class="container">
        <div class="model-details-grid">
            <!-- Main Content -->
            <div class="model-main-content">
                <!-- About this model -->
                <div class="model-section">
                    <h2>Über dieses Modell</h2>
                    <p class="model-description"><?php echo wp_kses_post($model_full_description); ?></p>
                </div>

                <!-- Quick Stats -->
                <div class="model-quick-stats">
                    <div class="quick-stat">
                        <?php echo wohnegruen_get_icon('size'); ?>
                        <div class="quick-stat-value"><?php echo esc_html($model_size); ?></div>
                        <div class="quick-stat-label">Wohnfläche</div>
                    </div>
                    <div class="quick-stat">
                        <?php echo wohnegruen_get_icon('rooms'); ?>
                        <div class="quick-stat-value"><?php echo esc_html($model_beds); ?> Zimmer</div>
                        <div class="quick-stat-label">Schlafzimmer</div>
                    </div>
                    <div class="quick-stat">
                        <?php echo wohnegruen_get_icon('users'); ?>
                        <div class="quick-stat-value"><?php echo esc_html($model_persons); ?> Pers.</div>
                        <div class="quick-stat-label">Kapazität</div>
                    </div>
                </div>

                <!-- Features -->
                <div class="model-section">
                    <h2>Ausstattung & Features</h2>
                    <div class="model-features-grid">
                        <?php if ($model_features) :
                            foreach ($model_features as $feature) : ?>
                                <div class="model-feature-item">
                                    <div class="check-icon"><?php echo wohnegruen_get_icon('check'); ?></div>
                                    <span><?php echo esc_html($feature['feature']); ?></span>
                                </div>
                            <?php endforeach;
                        else :
                            $default_features = array(
                                'Vollständig isoliert für Ganzjahresnutzung',
                                'Moderne Küchenzeile mit Geräten',
                                'Energieeffiziente Heizung',
                                'Große Panoramafenster',
                                'Optionale Terrasse',
                                'Schlüsselfertige Lieferung'
                            );
                            foreach ($default_features as $feature) : ?>
                                <div class="model-feature-item">
                                    <div class="check-icon"><?php echo wohnegruen_get_icon('check'); ?></div>
                                    <span><?php echo esc_html($feature); ?></span>
                                </div>
                            <?php endforeach;
                        endif; ?>
                    </div>
                </div>

                <!-- Specifications -->
                <div class="model-section">
                    <h2>Technische Daten</h2>
                    <div class="model-specs-table">
                        <?php if ($model_specifications) :
                            foreach ($model_specifications as $spec) : ?>
                                <div class="spec-row">
                                    <span class="spec-label"><?php echo esc_html($spec['label']); ?></span>
                                    <span class="spec-value"><?php echo esc_html($spec['value']); ?></span>
                                </div>
                            <?php endforeach;
                        else :
                            $default_specs = array(
                                array('label' => 'Wohnfläche', 'value' => $model_size),
                                array('label' => 'Außenmaße', 'value' => '10,0 x 4,0 m'),
                                array('label' => 'Schlafzimmer', 'value' => $model_beds),
                                array('label' => 'Badezimmer', 'value' => '1'),
                                array('label' => 'Höhe', 'value' => '3,5 m'),
                                array('label' => 'Gewicht', 'value' => 'ca. 6.000 kg'),
                            );
                            foreach ($default_specs as $spec) : ?>
                                <div class="spec-row">
                                    <span class="spec-label"><?php echo esc_html($spec['label']); ?></span>
                                    <span class="spec-value"><?php echo esc_html($spec['value']); ?></span>
                                </div>
                            <?php endforeach;
                        endif; ?>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="model-sidebar">
                <div class="model-sidebar-card">
                    <div class="model-price-large"><?php echo esc_html($model_price); ?></div>
                    <p class="price-note">inkl. Lieferung & Aufbau in Österreich</p>

                    <div class="sidebar-buttons">
                        <a href="<?php echo esc_url(home_url('/#kontakt')); ?>" class="btn btn-primary btn-lg">
                            Angebot anfragen
                        </a>
                        <a href="<?php echo esc_url(home_url('/#kontakt')); ?>" class="btn btn-outline btn-lg">
                            Besichtigung vereinbaren
                        </a>
                    </div>

                    <div class="sidebar-contact">
                        <h3>Haben Sie Fragen?</h3>
                        <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $contact_phone)); ?>" class="contact-link">
                            <?php echo wohnegruen_get_icon('phone'); ?>
                            <?php echo esc_html($contact_phone); ?>
                        </a>
                        <a href="mailto:<?php echo esc_attr($contact_email); ?>" class="contact-link">
                            <?php echo wohnegruen_get_icon('email'); ?>
                            <?php echo esc_html($contact_email); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Other Models Section -->
<?php
$other_models = new WP_Query(array(
    'post_type' => 'mobilhaus',
    'posts_per_page' => 2,
    'post__not_in' => array(get_the_ID()),
));

if ($other_models->have_posts()) : ?>
<section class="other-models-section section-padding">
    <div class="container">
        <h2>Weitere Modelle entdecken</h2>
        <div class="other-models-grid">
            <?php while ($other_models->have_posts()) : $other_models->the_post();
                $other_image = get_field('model_image') ?: get_the_post_thumbnail_url(get_the_ID(), 'medium');
                $other_size = wohnegruen_get_field('model_size', get_the_ID(), '35 m²');
                $other_beds = wohnegruen_get_field('model_beds', get_the_ID(), '2');
                $other_price = wohnegruen_get_field('model_price', get_the_ID(), 'ab €45.000');
            ?>
                <a href="<?php the_permalink(); ?>" class="other-model-card">
                    <div class="other-model-image">
                        <?php if ($other_image) : ?>
                            <img src="<?php echo esc_url($other_image); ?>" alt="<?php the_title_attribute(); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="other-model-content">
                        <h3><?php the_title(); ?></h3>
                        <p class="other-model-specs"><?php echo esc_html($other_size); ?> · <?php echo esc_html($other_beds); ?> Zimmer</p>
                        <span class="other-model-price"><?php echo esc_html($other_price); ?></span>
                    </div>
                </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
