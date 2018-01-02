<?php
/**
 * Template name 404
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package stormguard
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">
				<section class="error-404 not-found row">
					<header class="page-header">
						<h3 class="page-title"><?php esc_html_e('Page Not Found', 'stormguard'); ?></h3>
						<p>You may have mistyped the address or the page may have moved.</p>
					</header><!-- .page-header -->
					<div class="btn-wrap">
						<a class="btn" href="/" title="Go Back">
							<span>Go back</span>
						</a>
						<span class="btn-wrap__shadow" style="top: -35px; left: 273px;"></span>
					</div>
				</section><!-- .error-404 -->
			</div>
			<!-- /.container -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
