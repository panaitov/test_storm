<?php
/**
 * The template for displaying front page
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package StormGuard
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
      <?php locate_template('template-parts/franchise-form.php', true);

      locate_template('template-parts/content-services.php', true);

      locate_template('template-parts/content-services_cat.php', true);

			locate_template('template-parts/content-testimonials.php', true); ?>



		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
