<?php
/**
 * Front Page Template (Gutenberg Block-based)
 *
 * This template renders Gutenberg blocks from the page content.
 * Blocks are managed via the WordPress Block Editor (Gutenberg).
 *
 * Available ACF Blocks:
 * - Hero-Bereich (wohnegruen-hero)
 * - Vorteile (wohnegruen-features)
 * - Modelle (wohnegruen-models)
 * - Über uns (wohnegruen-about)
 * - Kontakt (wohnegruen-contact)
 * - Galerie (wohnegruen-gallery)
 * - 3D Rundgang (wohnegruen-3d-tour)
 * - Grundrisse (wohnegruen-floor-plans)
 * - Innenausstattung (wohnegruen-interiors)
 * - CTA-Bereich (wohnegruen-cta)
 */

get_header();
?>

<main class="front-page">
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
