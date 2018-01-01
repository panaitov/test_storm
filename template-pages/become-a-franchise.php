<?php
/**
 * The template for displaying Become a franchise pages
 *
 * Template name: Become a franchise
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package stormguard
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container franchise-info">
        <?php
        while (have_posts()) : the_post();
          if(get_the_post_thumbnail()) :?>
						<div class="franchise-info__img">
              <?php the_post_thumbnail(); ?>
						</div>
            <?php the_content(); ?>

          <?php endif; ?>


        <?php endwhile; // End of the loop.; ?>
			</div>
			<!-- /.container -->
      <?php get_template_part('template-parts/fill-out', 'form'); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
