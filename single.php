<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package stormguard
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">
        <?php
        while (have_posts()) : the_post();

          get_template_part('template-parts/content', 'page');

        endwhile; // End of the loop.
        get_template_part('template-parts/content', 'services');

        get_template_part('template-parts/content', 'services_cat'); ?>
			</div>
			<!-- /.container -->
      <?php get_template_part('template-parts/franchise', 'form'); ?>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
