<?php
/**
 * Template part for displaying services content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package StormGuard
 */
global $post;
$services_title = get_field('services_title', $post->ID);
$services_description = get_field('services_description', $post->ID);
$queryArgs = array(
  'post_type' => 'our_services',
  'orderby'   => 'date',
  'order'     => 'DESC'
);
$query = new WP_Query($queryArgs);

if($query->have_posts()): ?>
	<!-- Begin services -->
	<section class="services">
		<div class="container">
      <?php if($services_title) : ?>
				<h3 class="section-title services__title"><?php echo $services_title; ?></h3>
      <?php endif; ?>
      <?php if($services_description) : ?>
				<div class="services__desc"><?php echo $services_description; ?></div>
      <?php endif; ?>
			<div class="row">
        <?php while ($query->have_posts()): $query->the_post();
          ?>
					<div class="col-sm-6 col-md-4 service">
						<div class="service__icon">
							<img src="<?php the_field('services_icon', $post->ID); ?>" alt="<?php the_title(); ?>">
						</div>
						<!-- /.service__icon -->
						<p class="service__title"><?php the_title(); ?></p>
						<p><?php the_content(); ?></p>
					</div>
					<!-- /.service -->
        <?php endwhile; ?>
			</div>
			<!-- /.row -->
      <?php if(is_front_page()) : ?>
				<div class="services__action">
					<div class="btn-wrap">
						<a class="btn" href="<?php echo get_the_permalink(8); ?>"><span><?php the_field('services_btn',
                  2); ?></span></a>
						<span class="btn-wrap__shadow" style="top: -35px; left: 273px;"></span>
					</div>
				</div>
				<!-- /.services__action -->
      <?php endif; ?>
		</div>
		<!-- /.container -->
	</section>
	<!-- End services -->
<?php endif;
wp_reset_query(); ?>