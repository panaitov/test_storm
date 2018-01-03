<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package StormGuard
 */

?>

</div><!-- #content -->

<footer class="footer">
	<div class="foot-top">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 foot-top__item">
          <?php
          $query = new WP_Query('p=45'); ?>
          <?php if($query->have_posts()): ?>
						<div class="contact-form">
              <?php while ($query->have_posts()): $query->the_post() ?>
								<h3 class="contact-form__title"><?php the_title(); ?></h3>
								<div class="contact-form__desc"><?php the_content(); ?></div>
                <?php $contact_form = get_field('contact_form');
                if($contact_form && is_front_page()) :
                  echo $contact_form;
                else:
                  if(have_rows('contact_buttons')):?>
										<div class="contact-form__btn-wrap">
                      <?php while (have_rows('contact_buttons')): the_row();
                        $title = get_sub_field('contact_button_title');
                        $modal = get_sub_field('contact_button_modal'); ?>
												<div class="btn-wrap btn-wrap--bg-white">
													<a class="js-modal-show btn" href="<?php echo $modal; ?>">
														<span><?php echo $title; ?></span>
													</a>
													<span class="btn-wrap__shadow" style="top: -35px; left: 273px;"></span>
												</div>
                      <?php endwhile; ?>
										</div>
										<!-- /.contact-form__action -->
                  <?php endif;
                endif;
              endwhile; ?>
						</div>
						<!-- /.contact-form -->
          <?php endif;
          wp_reset_query(); ?>
				</div>
				<!-- /.col -->
				<div class="col-sm-6 foot-top__item">
          <?php
          $project_page_id = 64;
          $queryArgs = array(
            'post_type'      => 'projects',
            'posts_per_page' => 8,
            'orderby'        => 'date',
            'order'          => 'DESC'
          );
          $query = new WP_Query($queryArgs); ?>
          <?php if($query->have_posts()):
            $title = get_field('projects_title', $project_page_id);
            $desc = get_field('projects_desc', $project_page_id);
            $btn_title = get_field('projects_button_title', $project_page_id);
            $link_title = get_field('projects_link_title', $project_page_id); ?>
						<div class="projects">
              <?php if($title) : ?>
								<h3 class="projects__title"><?php echo $title ?></h3>
              <?php endif; ?>
              <?php if($desc) : ?>
								<div class="projects__desc">
									<p>
										<?php echo $desc; ?>
	                  <?php if(!is_front_page()) : ?>
											<a class="projects__desc-link" href="<?php echo get_the_permalink($project_page_id); ?>"><?php echo $link_title; ?></a>
	                  <?php endif; ?>
									</p>
								</div>
              <?php endif; ?>
              <?php while ($query->have_posts()): $query->the_post() ?>
								<div class="project">
									<div class="project__img">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
										</a>
									</div>
									<!-- /.project__img -->
								</div>
								<!-- /.project -->
              <?php endwhile; ?>
              <?php if($btn_title && is_front_page()) : ?>
								<div class="projects__action">
									<div class="btn-wrap btn-wrap--bg-white">
										<a class="btn" href="<?php echo get_the_permalink($project_page_id); ?>">
											<span><?php echo $btn_title; ?></span>
										</a>
										<span class="btn-wrap__shadow" style="top: -35px; left: 273px;"></span>
									</div>
									<!-- /.btn-wrap -->
								</div>
								<!-- /.projects__action -->

              <?php endif; ?>
						</div>
						<!-- /.projects -->
          <?php endif;
          wp_reset_query(); ?>
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container -->
	</div>
	<!-- /.foot-top -->
	<div class="foot-bottom">
		<div class="container">
			<div class="foot-bottom__inner">
				<div class="foot-nav">
          <?php
          wp_nav_menu(array(
            'theme_location' => 'footer-menu',
            'container'      => 'ul',
            'menu_class'     => 'foot-nav__list',
          ));
          ?>
				</div>
				<!-- /.foot-nav -->
				<div class="copyright">
          <?php
          $copyright = get_field('copyright_text', 'option');
          $company = get_field('company_information', 'option');
          if($copyright) :?>
						<span><?php echo $copyright; ?></span>
          <?php endif;
          if($company) :?>
						<a href="<?php the_field('company_link', 'option'); ?>"><?php echo $company; ?></a>
          <?php endif; ?>
				</div>
				<!-- /.copyright -->
			</div>
			<!-- /.foot-bottom__inner -->
		</div>
		<!-- /.container -->
	</div>
	<!-- /.foot-bottom -->
</footer>
<!-- Modal window -->
<div class="modal_contact_us modal-wrap">
	<div class="modal">
		<?php the_field('contact_form', 45); ?>
		<button class="modal__btn">
			<svg>
				<use xlink:href="#modal-close-icon"/>
			</svg>
		</button>
	</div>
	<!-- /. modal -->
</div>
<div class="modal_become_franchise modal-wrap">
	<div class="modal">
    <?php the_field('franchise_form', 'option'); ?>
		<button class="modal__btn">
			<svg>
				<use xlink:href="#modal-close-icon"/>
			</svg>
		</button>
	</div>
	<!-- /. modal -->
</div>
<div class="modal_local_franchise modal-wrap">
	<div class="modal">
    <?php echo do_shortcode('[contact-form-7 id="203" title="Local franchise"]') ?>
		<button class="modal__btn">
			<svg>
				<use xlink:href="#modal-close-icon"/>
			</svg>
		</button>
	</div>
	<!-- /. modal -->
</div>
<div class="modal_office_franchise modal-wrap">
	<div class="modal">
    <?php echo do_shortcode('[contact-form-7 id="229" title="Office franchise"]') ?>
		<button class="modal__btn">
			<svg>
				<use xlink:href="#modal-close-icon"/>
			</svg>
		</button>
	</div>
	<!-- /. modal -->
</div>
<!-- /. modal-wrap -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
