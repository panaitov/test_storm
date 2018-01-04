<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package stormguard
 */
?>

<article id="post-<?php the_ID(); ?>" class="page-content">
		<?php if(get_the_post_thumbnail()) :?>
			<div class="page-content__img">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			    <?php the_post_thumbnail(); ?>
				</a>
			</div>
			<!-- /.page-content__img -->
    <?php endif; ?>
			<div class="page-content__text">
				<header class=" section-title entry-header">
		      <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				</header><!-- .entry-header -->
				<div class="entry-content">
		        <?php the_content(); ?>
				</div><!-- .entry-content -->
			</div>
			<!-- /.page-content__text -->

</article><!-- #post-<?php the_ID(); ?> -->
<?php
wp_link_pages(array(
  'before' => '<div class="page-links">' . esc_html__('Pages:', 'stormguard'),
  'after'  => '</div>',
)); ?>
