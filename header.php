<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package StormGuard
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <?php if(is_front_page()) :
    $header_bg = get_header_image();
  $padding = '';?>
		<title><?php bloginfo('name'); ?></title>
  <?php else :
    $custom_header_bg = get_field('header_bg');
  $padding = 'header--padding';
    if($custom_header_bg) {
      $header_bg = $custom_header_bg;
    } else {
      $header_bg = get_header_image();
    } ?>
		<title><?php bloginfo('name'); ?> | <?php echo wp_get_document_title(); ?></title>
  <?php endif; ?>

	<link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet"> <!-- instead of Nelvetica -->
	<link href="https://fonts.googleapis.com/css?family=Barlow:600" rel="stylesheet"> <!-- instead of EurostileLT -->

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<svg style="display:none; position: absolute;top: 0;height: 0;width: 0;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
	<symbol viewBox="0 0 11 14">
		<path id="arrow-icon" d="M595.63 462l6.37-5-6.37-5-.63.71 5.46 4.29-5.46 4.29.63.71z" transform="translate(-593 -450)"/>
	</symbol>
</svg>
<div id="page" class="site">

	<header class="header <?php echo $padding; ?>" style="background-image:url(<?php echo $header_bg; ?>);">
		<div class="head-top">
			<div class="top-line">
				<span id="top-hover-line" class="hover-line"></span>
				<div class="container top-line__inner">
          <?php
          $location_title = get_field('location_title', 'option');
          $location_link = get_field('location_link', 'option');
          if($location_title) :?>
						<a href="<?php echo $location_link; ?>" class="location-link" title="<?php echo $location_title; ?>">
							<span><?php echo $location_title; ?></span>
							<svg>
								<use xlink:href="#arrow-icon"/>
							</svg>
						</a>
          <?php endif; ?>
					<div class="second-nav">
            <?php
            wp_nav_menu(array(
              'theme_location' => 'top-menu',
              'container'      => 'ul',
              'menu_class'     => 'second-nav__list',
            ));
            ?>
					</div>
					<!-- /.head-nav -->
				</div>
				<!-- /.container -->
			</div>
			<!-- /.top-line -->
			<div class="head-nav">
				<span id="bottom-hover-line" class="hover-line hover-line--bottom"></span>
				<div class="container head-nav__inner">
          <?php
          the_custom_logo(); ?>
					<nav class="main-nav">
            <?php
            wp_nav_menu(array(
              'theme_location' => 'header-menu',
              'container'      => 'ul',
              'menu_class'     => 'main-nav__list',
            ));
            ?>
					</nav>
				</div>
				<!-- /.container -->
			</div>
			<!-- /.head-nav -->
		</div>
		<!-- /.head-top -->
		<?php if(is_front_page()) :?>
			<div class="container">
				<div class="intro">
					<h1 class="intro__title">Does Your Home or Property Have
						<span class="intro__title--color">Storm Damage</span> or
						<span class="intro__title--color">Need an Update?</span></h1>
					<div class="intro__action">
						<div class="btn-wrap">
							<a class="btn" href="#">
								<span>Contact Us Today</span>
								<svg>
									<use xlink:href="#arrow-icon"/>
								</svg>
							</a>
							<span class="btn-wrap__shadow" style="top: -35px; left: 273px;"></span>
						</div>
					</div>
					<!-- /.intro__action -->
				</div>
				<!-- /.intro -->
			</div>
			<!-- /.container -->
		<?php endif; ?>
	</header>
  <?php if(function_exists('bcn_display') && !is_front_page()) {
    ?>
		<div class="breadcrumbs">
			<div class="container">
				<div class="breadcrumbs__inner">
					<?php bcn_display(); ?>
				</div>
				<!-- /.breadcrumbs__inner -->
			</div>
			<!-- /.container -->
		</div>
  <?php }; ?>
	<!-- /.breadcrumbs -->

	<div id="content" class="site-content">
