<?php
/**
 * Page Template
 *
 * This is the default template for all pages.
 * It displays Gutenberg blocks from the page content.
 */

get_header();
?>

<main id="main-content" class="page-content">
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
