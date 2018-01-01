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
	<?php if(get_the_post_thumbnail()) :?>
		<div class="col-sm-6">
	    <?php the_post_thumbnail(); ?>
		</div>
		<!-- /.col -->
		<div class="col-sm-6">
			<header class=" section-title entry-header">
	      <?php the_title('<h2 class="entry-title">', '</h2>'); ?>
			</header><!-- .entry-header -->
			<div class="entry-content">
	      <?php the_content(); ?>
			</div><!-- .entry-content -->
		</div>
		<!-- /.col -->
	<?php else: ?>
		<div class="col-xs-12">
			<header class=" section-title entry-header">
        <?php the_title('<h2 class="entry-title">', '</h2>'); ?>
			</header><!-- .entry-header -->
			<div class="entry-content">
        <?php the_content(); ?>
			</div><!-- .entry-content -->
		</div>
		<!-- /.col -->
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
<?php
wp_link_pages(array(
  'before' => '<div class="page-links">' . esc_html__('Pages:', 'stormguard'),
  'after'  => '</div>',
)); ?>
