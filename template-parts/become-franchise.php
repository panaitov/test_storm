<?php
/**
 * Template part for displaying become a franchise form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package StormGuard
 */
$fill_out_title = get_field('fill_out_title', 'option');
$fill_out_desc = get_field('fill_out_description', 'option');
$fill_out_btn_title = get_field('fill_out_btn_title', 'option');

?>

<div class="franchise-form become-franchise-form">
	<div class="container">
		<div class="franchise-form__inner">
			<div class="franchise-form__item">
        <?php if($fill_out_title) : ?>
					<p class="franchise-form__title"><?php echo $fill_out_title; ?></p>
        <?php endif; ?>
        <?php if($fill_out_desc) : ?>
					<div class="franchise-form__desc"><?php echo $fill_out_desc; ?></div>
        <?php endif; ?>
			</div>
			<!-- /.franchise-form__item -->
			<div class="franchise-form__item">
        <?php if($fill_out_btn_title) :?>
	        <div class="btn-wrap btn-wrap--bg-red">
		        <a class="js-modal-show btn become-franchise-form__btn" href=".modal_become_franchise">
			        <span><?php echo $fill_out_btn_title;?></span>
		        </a>
		        <span class="btn-wrap__shadow" style="top: -35px; left: 273px;"></span>
	        </div>
        <?php endif; ?>
			</div>
			<!-- /.franchise-form__item -->
		</div>
		<!-- /.franchise-form__inner -->
	</div>
	<!-- /.container -->

</div>
<!-- /.franchise-form -->