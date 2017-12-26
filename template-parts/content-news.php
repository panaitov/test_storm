<?php
/**
 * Template part for displaying news content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package stormguard
 */
global $post;
$title = get_field('news_title', $post->ID);
$queryArgs = array(
  'post_type'      => 'news',
  'posts_per_page' => 3,
  'orderby'        => 'date',
  'order'          => 'DESC'
);
$query = new WP_Query($queryArgs); ?>
<?php if($query->have_posts()): ?>
	<!-- Begin news -->
	<section class="block-news">
		<div class="container">
			<h3 class="section-title block-news__title"><?php echo $title; ?></h3>
			<div class="row">
        <?php while ($query->have_posts()): $query->the_post()?>
					<div class="col-sm-6 col-md-4 block-news__item">
						<div class="news">
							<div class="news__img">
								<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
								<div class="news__date">
									<p><?php echo get_the_date('M', $query->ID); ?></p>
									<p class="news__date--number"><?php echo get_the_date('j', $query->ID); ?></p>
								</div>
								<!-- /.news__date -->
							</div>
							<!-- /.news__img -->
							<div class="news__body">
								<p class="news__title"><?php the_title(); ?></p>
								<p><?php the_excerpt(); ?></p>
							</div>
							<!-- /.news__body -->
							<div class="news__footer">
								<p><?php echo get_the_author_meta('display_name',$query->post_author); ?></p>
							</div>
							<!-- /.news__footer -->
						</div>
						<!-- /.news -->
					</div>
					<!-- /.col -->
        <?php endwhile; ?>
			</div>
			<!-- /.row -->
			<div class="block-news__action">
				<div class="btn-wrap">
					<a class="btn" href="<?php echo get_the_permalink(165); ?>">
						<span><?php the_field('news_button', 2);?></span>
						<svg>
							<use xlink:href="#arrow-icon"/>
						</svg>
					</a>
					<span class="btn-wrap__shadow" style="top: -35px; left: 273px;"></span>
				</div>
			</div>
			<!-- /.block-news__action -->
		</div>
		<!-- /.container -->
	</section>
	<!-- End block-news -->
<?php endif;
wp_reset_query(); ?>

