<?php
/**
 * Template Name: Gallery with Lightbox
 *
 * Full gallery page with categories, filtering, and lightbox
 * Inspired by Hosekra gallery functionality
 */

get_header();
?>

<main class="page-gallery-full">
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            ?>

            <!-- Gallery Hero -->
            <section class="gallery-hero">
                <div class="container">
                    <h1><?php the_title(); ?></h1>
                    <?php if (get_the_excerpt()) : ?>
                        <p class="gallery-intro"><?php the_excerpt(); ?></p>
                    <?php endif; ?>
                </div>
            </section>

            <!-- Gallery Filters -->
            <section class="gallery-filters-section">
                <div class="container">
                    <div class="gallery-filters">
                        <button class="gallery-filter-btn active" data-filter="all">All</button>
                        <button class="gallery-filter-btn" data-filter="exterior">Exterior</button>
                        <button class="gallery-filter-btn" data-filter="interior">Interior</button>
                        <button class="gallery-filter-btn" data-filter="terrace">Terrace</button>
                        <button class="gallery-filter-btn" data-filter="details">Details</button>
                    </div>
                </div>
            </section>

            <!-- Gallery Grid -->
            <section class="gallery-grid-section">
                <div class="container">
                    <div class="gallery-grid-full">
                        <?php
                        // Get gallery images from ACF
                        $gallery_images = get_field('gallery_images_full');

                        if ($gallery_images && is_array($gallery_images)) :
                            foreach ($gallery_images as $index => $img) :
                                $image_data = isset($img['image']) ? $img['image'] : null;
                                $category = isset($img['category']) ? $img['category'] : 'all';
                                $title = isset($img['title']) ? $img['title'] : '';

                                if ($image_data) :
                                    $image_url = is_array($image_data) ? $image_data['url'] : $image_data;
                                    $image_thumb = is_array($image_data) && isset($image_data['sizes']['medium']) ? $image_data['sizes']['medium'] : $image_url;
                                    ?>
                                    <div class="gallery-item-full" data-category="<?php echo esc_attr($category); ?>">
                                        <div class="gallery-item-inner">
                                            <img src="<?php echo esc_url($image_thumb); ?>"
                                                 data-full="<?php echo esc_url($image_url); ?>"
                                                 alt="<?php echo esc_attr($title); ?>"
                                                 loading="lazy">
                                            <?php if ($title) : ?>
                                                <div class="gallery-item-overlay">
                                                    <span class="gallery-item-title"><?php echo esc_html($title); ?></span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php
                                endif;
                            endforeach;
                        else :
                            // Default images - focus on terrace and layouts
                            $placeholder_images = array(
                                // Main models
                                array('category' => 'exterior', 'title' => 'EKO Mobile Home', 'url' => 'https://www.hosekra.com/homes/wp-content/uploads/sites/16/hiska_eko_1025.jpg'),
                                array('category' => 'exterior', 'title' => 'PANORAMA Model', 'url' => 'https://www.hosekra.com/homes/wp-content/uploads/sites/16/nggallery/eko-zunanjost/eko-mobilna-hiska-5.jpg'),

                                // Terrace focus
                                array('category' => 'terrace', 'title' => 'Terrace with Furniture', 'url' => 'https://www.hosekra.com/homes/wp-content/uploads/sites/16/nggallery/eko-zunanjost/TER1.jpg'),
                                array('category' => 'terrace', 'title' => 'Outdoor Living Space', 'url' => 'https://www.hosekra.com/homes/wp-content/uploads/sites/16/nggallery/eko-zunanjost/H1.jpg'),
                                array('category' => 'terrace', 'title' => 'Garden Terrace', 'url' => 'https://www.hosekra.com/homes/wp-content/uploads/sites/16/nggallery/eko-zunanjost/Predstavnost-14.jpg'),
                                array('category' => 'terrace', 'title' => 'Terrace View', 'url' => 'https://www.hosekra.com/homes/wp-content/uploads/sites/16/nggallery/eko-zunanjost/Predstavnost-29.jpg'),

                                // Different layouts/angles
                                array('category' => 'exterior', 'title' => 'Side View', 'url' => 'https://www.hosekra.com/homes/wp-content/uploads/sites/16/nggallery/eko-zunanjost/eko-mobilna-hiska-2.jpg'),
                                array('category' => 'exterior', 'title' => 'Front Entrance', 'url' => 'https://www.hosekra.com/homes/wp-content/uploads/sites/16/nggallery/eko-zunanjost/Z1.jpg'),
                            );

                            foreach ($placeholder_images as $index => $img) :
                                ?>
                                <div class="gallery-item-full" data-category="<?php echo esc_attr($img['category']); ?>">
                                    <div class="gallery-item-inner">
                                        <img src="<?php echo esc_url($img['url']); ?>"
                                             data-full="<?php echo esc_url($img['url']); ?>"
                                             alt="<?php echo esc_attr($img['title']); ?>"
                                             loading="lazy">
                                        <div class="gallery-item-overlay">
                                            <span class="gallery-item-title"><?php echo esc_html($img['title']); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </div>

                    <!-- Pagination -->
                    <div class="gallery-pagination">
                        <button class="gallery-load-more btn btn-primary">Load More Images</button>
                    </div>
                </div>
            </section>

            <?php
        endwhile;
    endif;
    ?>

    <!-- Lightbox -->
    <div class="lightbox-full" id="gallery-lightbox-full">
        <button class="lightbox-close" aria-label="Close">&times;</button>
        <button class="lightbox-prev" aria-label="Previous">
            <?php echo wohnegruen_get_icon('arrow-right'); ?>
        </button>
        <button class="lightbox-next" aria-label="Next">
            <?php echo wohnegruen_get_icon('arrow-right'); ?>
        </button>
        <div class="lightbox-content-full">
            <img id="lightbox-image-full" src="" alt="">
            <div class="lightbox-info-full">
                <span id="lightbox-title-full"></span>
                <span id="lightbox-counter-full"></span>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
