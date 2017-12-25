<?php
/**
 * StormGuard functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package stormguard
 */

/** Various clean up functions */
require_once('library/cleanup.php');

/** Enqueue scripts */
require_once('library/enqueue-scripts.php');
/** Customization Admin */

require_once('library/custom-admin.php');


if (!function_exists('stormguard_setup')) :
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
  function stormguard_setup()
  {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on stormguard, use a find and replace
     * to change 'stormguard' to the name of your theme in all the template files.
     */
    load_theme_textdomain('stormguard', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

     /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(array(
      'top-menu' => esc_html__('Top menu', 'stormguard'),
      'header-menu' => esc_html__('Header menu', 'stormguard'),
      'footer-menu' => esc_html__('Footer menu', 'stormguard')
    ));

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support('html5', array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    ));


    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support('custom-logo', array(
      'height' => 73,
      'width' => 198,
      'flex-width' => true,
      'flex-height' => true,
    ));
  }
endif;
add_action('after_setup_theme', 'stormguard_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function stormguard_content_width()
{
  $GLOBALS['content_width'] = apply_filters('stormguard_content_width', 640);
}
add_action('after_setup_theme', 'stormguard_content_width', 0);


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Customize title separator
 */
add_filter('document_title_separator', function () {
  return ' | ';
});

/**
 * Delete site title
 */
add_filter('document_title_parts', function ($parts) {
  if (isset($parts['site'])) unset($parts['site']);
  return $parts;
});

/**
 * Delete tagline
 */
add_filter('document_title_parts', function ($title) {
  if (isset($title['tagline'])) unset($title['tagline']);
  return $title;
});


/**
 * Customizes read more link in excerpts
 */
function new_more_text($more_link, $more_link_text)
{
  $new = "Read More";
  return str_replace($more_link_text, $new, $more_link);
}
add_filter('the_content_more_link', 'new_more_text', 10, 2);

/**
 * ACF Options Page
 */
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page(array(
    'page_title'    => 'General Settings',
    'menu_title'    => 'General Settings',
    'menu_slug'     => 'general-settings',
    'capability'    => 'edit_posts',
    'redirect'      => false
  ));
}
