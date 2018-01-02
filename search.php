<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package stormguard
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">
        <?php
        if(have_posts()) : ?>

					<div class="row">
            <?php
            /* Start the Loop */
            while (have_posts()) : the_post();

              /**
               * Run the loop for the search to output the results.
               * If you want to overload this in a child theme then include a file
               * called content-search.php and that will be used instead.
               */
              get_template_part('template-parts/content', 'search');

            endwhile; ?>
					</div>
					<!-- /.row -->

          <?php
          if(function_exists('wp_pagenavi')) : ?>
						<div class="pagination">
              <?php wp_pagenavi(); ?>
						</div>
						<!-- /.pagination -->
          <?php endif;

        else :

          get_template_part('template-parts/content', 'none');

        endif; ?>

			</div>
			<!-- /.container -->


		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
