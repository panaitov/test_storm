<?php
/**
 * Template part for displaying testimonials content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package stormguard
 */
global $post;
$title = get_field('testimonials_title', $post->ID);
$args = array(
  'post-type' => 'our-services',
  'orderby'   => 'comment_date_gmt',
  'number'    => 5
);
$comments = get_comments($args);?>

	<!-- Begin testimonials -->
<?php if($comments) : ?>
	<section class="testimonials">
		<div class="container">
      <?php if($title) : ?>
				<h3 class="section-title testimonials__title"><?php echo $title; ?></h3>
      <?php endif; ?>
			<div class="testimonials-slider">
        <?php foreach ($comments as $comment):
          $user_meta = get_userdata($comment->user_id);
          $role = $user_meta->roles; ?>
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