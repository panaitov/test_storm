<?php
/**
 * Template part for displaying news content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package stormguard
 */

$title = get_field('news_title', get_the_ID());
if(is_front_page()) {
  $queryArgs = array(
    'post_type'      => 'news',
    'posts_per_page' => 3,
    'orderby'        => 'date',
    'order'          => 'DESC'
  );
} else {
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $queryArgs = array(
    'post_type'      => 'news',
    'posts_per_page' => 6,
    'paged'          => $paged,
    'orderby'        => 'date',
    'order'          => 'DESC'
  );
}
$queryNews = new WP_Query($queryArgs); ?>
<?php if($queryNews->have_posts()): ?>
	<!-- Begin news -->
	<section class="block-news">
		<div class="container">
			<h3 class="section-title block-news__title"><?php echo $title; ?></h3>
			<div class="row">
        <?php while ($queryNews->have_posts()): $queryNews->the_post() ?>
					<div class="col-sm-6 col-md-4 block-news__item">
						<div class="news-item">
							<div class="news-item__img">
								<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
								<div class="news-item__date">
									<p><?php echo get_the_date('M', $queryNews->ID); ?></p>
									<p class="news-item__date--number"><?php echo get_the_date('j', $queryNews->ID); ?></p>
								</div>
								<!-- /.news-item__date -->
							</div>
							<!-- /.news-item__img -->
							<div class="news-item__body">
								<p class="news-item__title"><?php the_title(); ?></p>
								<p><?php the_excerpt(); ?></p>
							</div>
							<!-- /.news-item__body -->
							<div class="news-item__footer">
								<p><?php echo get_the_author_meta('display_name', $queryNews->post_author); ?></p>
							</div>
							<!-- /.news-item__footer -->
						</div>
						<!-- /.news-item -->
					</div>
					<!-- /.col -->
        <?php endwhile; ?>
			</div>
			<!-- /.row -->
			<div class="block-news__action">
        <?php if(is_front_page()) : ?>
					<div class="btn-wrap">
						<a class="btn" href="<?php echo get_the_permalink(165); ?>">
							<span><?php the_field('news_button', 2); ?></span>
						</a>
						<span class="btn-wrap__shadow" style="top: -35px; left: 273px;"></span>
					</div>
        <?php else: ?>
          <?php if(function_exists('wp_pagenavi')) : ?>
						<div class="pagination">
              <?php wp_pagenavi(array('query' => $queryNews)); ?>
						</div>
						<!-- /.pagination -->
          <?php endif; ?>
        <?php endif; ?>
			</div>
			<!-- /.block-news__action -->
		</div>
		<!-- /.container -->
	</section>
	<!-- End block-news -->
<?php endif;
wp_reset_query();