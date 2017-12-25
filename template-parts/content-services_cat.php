<?php
/*
 * Template part for displaying services category
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package StormGuard
 */
global $post;
$post_id = 135;
$queryArgs = array(
  'post_type'   => 'page',
  'post_parent' => $post_id,
  'orderby'     => 'date',
  'order'       => 'DESC'
);
$query = new WP_Query($queryArgs); ?>
<?php if($query->have_posts()):
  $post_object = get_post($post_id); ?>
	<!-- Begin services-cat -->
	<section class="services-cat">
		<div class="container">
			<h3 class="section-title services-cat__title"><?php echo get_the_title($post_id); ?></h3>
			<div class="services-cat__desc"><?php echo $post_object->post_content; ?></div>
			<div class="row">
        <?php while ($query->have_posts()): $query->the_post() ?>
					<div class="col-sm-6 col-md-4">
						<div class="services-cat-item">
							<div class="services-cat-item__img">
								<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
							</div>
							<!-- /.services-cat-item__img -->
							<div class="btn-wrap">
								<a class="btn" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<span><?php the_title(); ?></span>
									<svg>
										<use xlink:href="#arrow-icon"/>
									</svg>
								</a>
								<span class="btn-wrap__shadow" style="top: -35px; left: 273px;"></span>
							</div>
						</div>
						<!-- /.services-cat-item -->
					</div>
					<!-- /.col -->
        <?php endwhile; ?>
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container -->
	</section>
	<!-- End services-cat -->
<?php endif;
wp_reset_query(); ?>