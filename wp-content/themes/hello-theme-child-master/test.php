<?php
/**
 * Template Name: Elementor Editable Page
 * Template Post Type: page
 *
 * @package YourTheme
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php
        while ( have_posts() ) :
            the_post();

            // Elementor Compatibility
            if ( \Elementor\Plugin::instance()->db->is_built_with_elementor( get_the_ID() ) ) {
                the_content();
            } else {
                // Standard WordPress Content
                the_content();
            }

        endwhile; // End of the loop.
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
