<?php
/**
 * Index Template
 *
 * Fallback template for all content types.
 * This displays Gutenberg blocks from the content.
 */

get_header();
?>

<main id="main-content" class="site-content">
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();

            // Render Gutenberg blocks
            the_content();

        endwhile;
    else :
        ?>
        <div class="container">
            <p><?php _e('No content found.', 'wohnegruen'); ?></p>
        </div>
        <?php
    endif;
    ?>
</main>

<?php
get_footer();
