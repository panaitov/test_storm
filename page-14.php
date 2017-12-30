<?php
/**
 * The template for displaying Residential page
 *
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

      get_template_part('template-parts/content', 'services');

      get_template_part('template-parts/content', 'services_cat'); ?>
		</div>
		<!-- /.container -->
    <?php get_template_part('template-parts/franchise', 'form'); ?>


	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
