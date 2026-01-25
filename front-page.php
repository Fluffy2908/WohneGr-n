<?php
/**
 * Front Page Template (Gutenberg Block-based)
 *
 * This template renders Gutenberg blocks from the page content.
 * Uses all-in-one "Komplett" blocks for each page type.
 *
 * Available ACF Complete Blocks:
 * - Homepage Komplett (wohnegruen-home-complete)
 * - Über uns Komplett (wohnegruen-about-complete)
 * - Kontakt Komplett (wohnegruen-contact-complete)
 * - Galerie Komplett (wohnegruen-gallery-complete)
 * - Modelle Komplett (wohnegruen-models-complete) - Nature/Pure toggle
 * - 3D Grundrisse Komplett (wohnegruen-3d-complete)
 * - Mobilhaus Komplett (wohnegruen-mobilhaus-complete)
 */

get_header();
?>

<main id="main-content" class="front-page">
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();

            // Render Gutenberg blocks
            the_content();

        endwhile;
    endif;
    ?>
</main>

<?php
get_footer();
