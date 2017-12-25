<?php
/**
 * The template for displaying front page
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package StormGuard
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
      <?php locate_template('template-parts/franchise-form.php', true);

      locate_template('template-parts/content-services.php', true);

      locate_template('template-parts/content-services_cat.php', true); ?>

			<!-- Begin testimonials -->
      <?php $title = get_field('testimonials_title');
      $comments = get_comments($args);
      $args = array(
        'post-type' => 'our-services'
      ); ?>
      <?php if($comments) : ?>
				<section class="testimonials">
					<div class="container">
            <?php if($title) : ?>
							<h3 class="section-title testimonials__title"><?php echo $title; ?></h3>
            <?php endif; ?>
						<div class="testimonials-slider">
              <?php foreach ($comments as $comment):
                $user_meta = get_userdata($comment->user_id);
                $role = $user_meta->roles;?>
								<div class="testimonials-slide">
									<blockquote><?php echo $comment->comment_content; ?></blockquote>
									<div class="testimonials-slide__info">
										<p><?php echo $comment->comment_author; ?></p>
										<p><?php echo $role[0]; ?></p>
									</div>
									<!-- /.testimonials-slide__info -->
								</div>
								<!-- /.testimonials-slide -->

              <?php endforeach; ?>
						</div>
						<!-- /.testimonials-slider -->
					</div>
					<!-- /.container -->
				</section>
				<!-- End testimonials -->
      <?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
