<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package stormguard
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="col-sm-4">
      <?php stormguard_post_thumbnail(); ?>
		</div>
		<!-- /.col -->
		<div class="col-sm-8">
			<header class=" section-title entry-header">
        <?php the_title('<h3 class="entry-title">', '</h3>'); ?>
			</header><!-- .entry-header -->
			<div class="entry-content">
        <?php the_content(); ?>
			</div><!-- .entry-content -->

		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->

</article><!-- #post-<?php the_ID(); ?> -->
