<?php
/**
 * Template Name: 3D Floor Plans
 *
 * Display floor plans/3D perspectives like Hosekra
 * Shows different models with their layout variations
 */

get_header();
?>

<main class="page-floor-plans">
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            ?>

            <!-- Hero Section -->
            <section class="floor-plans-hero">
                <div class="container">
                    <h1><?php the_title(); ?></h1>
                    <?php if (get_the_excerpt()) : ?>
                        <p class="floor-plans-intro"><?php the_excerpt(); ?></p>
                    <?php endif; ?>
                </div>
            </section>

            <!-- Floor Plans Content -->
            <section class="floor-plans-content-section section-padding">
                <div class="container">
                    <?php
                    // Get custom floor plans or use defaults
                    $floor_plan_models = get_field('floor_plan_models');

                    if (!$floor_plan_models || empty($floor_plan_models)) :
                        // Default models - EKO and PANORAMA only
                        $floor_plan_models = array(
                            array(
                                'model_name' => 'EKO',
                                'model_size' => '3 x 8 m',
                                'model_description' => 'Compact and efficient mobile home design with terrace.',
                                'plans' => array(
                                    array(
                                        'name' => 'EKO Layout 1',
                                        'image' => 'https://www.hosekra.com/homes/wp-content/uploads/sites/16/Tloris-3D-Eko-1-1-1024x615.jpg',
                                        'description' => 'Open living space with integrated kitchen',
                                        'rooms' => '1 Bedroom',
                                        'size' => '24 m²',
                                    ),
                                    array(
                                        'name' => 'EKO Layout 2',
                                        'image' => 'https://www.hosekra.com/homes/wp-content/uploads/sites/16/Tloris-3D-Eko-2-1-1024x615.jpg',
                                        'description' => 'Separate bedroom with spacious living area',
                                        'rooms' => '1 Bedroom',
                                        'size' => '24 m²',
                                    ),
                                ),
                            ),
                            array(
                                'model_name' => 'PANORAMA',
                                'model_size' => '3 x 8 m',
                                'model_description' => 'Modern design with large windows and terrace.',
                                'plans' => array(
                                    array(
                                        'name' => 'PANORAMA Layout 1',
                                        'image' => 'https://www.hosekra.com/homes/wp-content/uploads/sites/16/Tloris-3D-Panorama-1-1-1024x615.jpg',
                                        'description' => 'Contemporary open-plan living',
                                        'rooms' => '1 Bedroom',
                                        'size' => '24 m²',
                                    ),
                                    array(
                                        'name' => 'PANORAMA Layout 2',
                                        'image' => 'https://www.hosekra.com/homes/wp-content/uploads/sites/16/Tloris-3D-Panorama-2-1-1024x615.jpg',
                                        'description' => 'Maximized natural light throughout',
                                        'rooms' => '1 Bedroom',
                                        'size' => '24 m²',
                                    ),
                                ),
                            ),
                        );
                    endif;

                    // Display models
                    foreach ($floor_plan_models as $model) :
                        $model_name = $model['model_name'] ?? '';
                        $model_size = $model['model_size'] ?? '';
                        $model_description = $model['model_description'] ?? '';
                        $plans = $model['plans'] ?? array();
                        ?>

                        <div class="floor-plan-model">
                            <div class="floor-plan-model-header">
                                <h2><?php echo esc_html($model_name); ?>
                                    <?php if ($model_size) : ?>
                                        <span class="model-size">(<?php echo esc_html($model_size); ?>)</span>
                                    <?php endif; ?>
                                </h2>
                                <?php if ($model_description) : ?>
                                    <p class="model-description"><?php echo esc_html($model_description); ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="floor-plan-variations">
                                <?php foreach ($plans as $plan) :
                                    $plan_name = $plan['name'] ?? '';
                                    $plan_image = $plan['image'] ?? '';
                                    $plan_description = $plan['description'] ?? '';
                                    $plan_rooms = $plan['rooms'] ?? '';
                                    $plan_size = $plan['size'] ?? '';
                                    ?>
                                    <div class="floor-plan-item">
                                        <div class="floor-plan-image">
                                            <?php if ($plan_image) : ?>
                                                <img src="<?php echo esc_url($plan_image); ?>"
                                                     alt="<?php echo esc_attr($plan_name); ?>"
                                                     loading="lazy">
                                                <button class="floor-plan-zoom" data-image="<?php echo esc_url($plan_image); ?>">
                                                    <?php echo wohnegruen_get_icon('expand'); ?>
                                                    <span>View Full Size</span>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                        <div class="floor-plan-details">
                                            <h3><?php echo esc_html($plan_name); ?></h3>
                                            <?php if ($plan_description) : ?>
                                                <p><?php echo esc_html($plan_description); ?></p>
                                            <?php endif; ?>
                                            <div class="floor-plan-specs">
                                                <?php if ($plan_rooms) : ?>
                                                    <span class="spec">
                                                        <?php echo wohnegruen_get_icon('rooms'); ?>
                                                        <?php echo esc_html($plan_rooms); ?>
                                                    </span>
                                                <?php endif; ?>
                                                <?php if ($plan_size) : ?>
                                                    <span class="spec">
                                                        <?php echo wohnegruen_get_icon('size'); ?>
                                                        <?php echo esc_html($plan_size); ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="cta-section cta-bg-primary">
                <div class="container">
                    <div class="cta-content">
                        <h2>Interested in These Floor Plans?</h2>
                        <p>Contact us for more details or to customize a layout for your needs.</p>
                        <a href="<?php echo esc_url(home_url('/#kontakt')); ?>" class="btn btn-white btn-lg">
                            Get in Touch
                            <?php echo wohnegruen_get_icon('arrow-right'); ?>
                        </a>
                    </div>
                </div>
            </section>

            <?php
        endwhile;
    endif;
    ?>

    <!-- Floor Plan Lightbox -->
    <div class="floor-plan-lightbox" id="floor-plan-lightbox">
        <button class="lightbox-close" aria-label="Close">&times;</button>
        <div class="lightbox-content">
            <img id="floor-plan-lightbox-image" src="" alt="">
        </div>
    </div>
</main>

<?php
get_footer();
