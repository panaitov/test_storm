<?php
/**
 * The template for displaying All news page
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package stormguard
 */

get_header();
$title = get_the_title(get_the_ID()) ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">
				<h3 class="section-title block-news__title"><?php echo $title; ?></h3>
			</div>
			<!-- /.container -->
      <?php

      get_template_part('template-parts/content', 'news');

      get_template_part('template-parts/content', 'services_cat');

      get_template_part('template-parts/franchise', 'form'); ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
