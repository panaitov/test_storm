<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package stormguard
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('page-content row'); ?>>
	<div class="col-sm-5">
    <?php stormguard_post_thumbnail(); ?>
	</div>
	<!-- /.col -->
	<div class="col-sm-7">
		<header class=" section-title entry-header">
      <?php the_title('<h3 class="entry-title">', '</h3>'); ?>
		</header><!-- .entry-header -->
		<div class="entry-content">
      <?php the_content(); ?>
		</div><!-- .entry-content -->
	</div>
	<!-- /.col -->

</article><!-- #post-<?php the_ID(); ?> -->
<?php
wp_link_pages(array(
  'before' => '<div class="page-links">' . esc_html__('Pages:', 'stormguard'),
  'after'  => '</div>',
)); ?>
