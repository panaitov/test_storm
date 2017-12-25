<?php
/**
 * Template part for displaying franchise searching form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package StormGuard
 */
$franchise_title = get_field('franchise_title', 'option');
$franchise_desc = get_field('franchise_desc', 'option');
$franchise_form = get_field('franchise_form', 'option');
?>

<div class="franchise-form">
	<div class="container">
		<div class="franchise-form__inner">
			<div class="franchise-form__item">
        <?php if($franchise_title) : ?>
					<p class="franchise-form__title"><?php echo $franchise_title; ?></p>
        <?php endif; ?>
        <?php if($franchise_desc) : ?>
					<div class="franchise-form__desc"><?php echo $franchise_desc; ?></div>
        <?php endif; ?>
			</div>
			<!-- /.franchise-form__item -->
			<div class="franchise-form__item">
        <?php if($franchise_form) {
          echo $franchise_form;
        } ?>
			</div>
			<!-- /.franchise-form__item -->
		</div>
		<!-- /.franchise-form__inner -->
	</div>
	<!-- /.container -->
</div>
<!-- /.franchise-form -->