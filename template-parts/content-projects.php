<?php
/**
 * Template part for displaying projects content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package stormguard
 */

$title = get_the_title(get_the_ID());
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$queryArgs = array(
  'post_type'      => 'projects',
  'posts_per_page' => 8,
  'paged'          => $paged,
  'orderby'        => 'date',
  'order'          => 'DESC'
);
$query = new WP_Query($queryArgs); ?>
<?php if($query->have_posts()): ?>
	<!-- Begin news -->
	<section class="all-projects">
		<div class="container">
			<h3 class="section-title block-news__title"><?php echo $title; ?></h3>
			<div class="row">
        <?php while ($query->have_posts()): $query->the_post() ?>
					<div class="col-xs-6 col-sm-4 col-md-3 block-news__item">
						<div class="news-item">
							<div class="news-item__img">
								<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
							</div>
							<!-- /.news-item__img -->
							<div class="news-item__body">
								<p class="news-item__title"><?php the_title(); ?></p>
								<p><?php the_excerpt(); ?></p>
							</div>
							<!-- /.news-item__body -->
						</div>
						<!-- /.news-item -->
					</div>
					<!-- /.col -->
        <?php endwhile; ?>
			</div>
			<!-- /.row -->
      <?php if(function_exists('wp_pagenavi')) : ?>
				<div class="pagination">
          <?php wp_pagenavi(array('query' => $query)); ?>
				</div>
				<!-- /.pagination -->
      <?php endif; ?>
		</div>
		<!-- /.container -->
	</section>
	<!-- End block-news -->
<?php endif;
wp_reset_query(); ?>

