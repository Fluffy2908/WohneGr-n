<?php
/**
 * Single Mobilhaus Template
 * CLEAN - Uses Gutenberg blocks only
 */

get_header();
?>

<main id="main-content" class="single-mobilhaus-page">
    <?php
    while (have_posts()) :
        the_post();
        the_content(); // Shows Gutenberg blocks including mobilhaus-complete
    endwhile;
    ?>
</main>

<?php get_footer(); ?>
