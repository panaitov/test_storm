<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package stormguard
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">
        <?php
        if(have_posts()) :

          /* Start the Loop */
          while (have_posts()) : the_post();

            /*
             * Include the Post-Format-specific template for the content.
             * If you want to override this in a child theme, then include a file
             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
             */
            get_template_part('template-parts/content', 'page');

          endwhile;

        else :

          get_template_part('template-parts/content', 'none');

        endif; ?>
			</div>
			<!-- /.container -->
      <?php
      get_template_part('template-parts/content', 'services_cat');

      get_template_part('template-parts/franchise', 'form'); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
