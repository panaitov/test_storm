<?php
/**
 * Template part for displaying services content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package StormGuard
 */

$post_id = get_the_ID();
$cat = get_the_category($post_id);
$cat_slug = $cat[0]->slug;
$cat_id = $cat[0]->term_id;
$page = get_page_by_path($cat_slug);
$page_id = $page->ID;
$services_title = get_field('services_title', $page_id);
$services_description = get_field('services_description', $page_id);

if($services_title != NULL) {
  $services_title = get_field('services_title', $page_id);
} else {
  $services_title = get_field('services_title', 2);
}
if($services_description != NULL) {
  $services_description = get_field('services_description', $page_id);
} else {
  $services_description = get_field('services_description', 2);
}

if(is_single()) {
  $queryArgs = array(
    'post_type'      => 'our_services',
    'posts_per_page' => 6,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'post__not_in'   => array($post_id),
    'tax_query'      => array(
      array(
        'taxonomy' => 'category',
        'field'    => 'id',
        'terms'    => $cat_id
      )
    )
  );
} else {
  $queryArgs = array(
    'post_type' => 'our_services',
    'orderby'   => 'date',
    'order'     => 'DESC'
  );
}
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
						<a href="<?php the_permalink(); ?>">
							<div class="service__icon">
								<img src="<?php the_field('services_icon', $post->ID); ?>" alt="<?php the_title(); ?>">
							</div>
							<!-- /.service__icon -->
							<p class="service__title"><?php the_title(); ?></p>
							<p><?php
                $trimmed_content = wp_trim_words(get_the_content(), 20, '');
                echo $trimmed_content;
                ?></p>
						</a>
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