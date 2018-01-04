<?php
/**
 * Enqueue all styles and scripts
 *
 * Learn more about enqueue_script: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_script}
 * Learn more about enqueue_style: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_style }
 *
 */

add_action('wp_head', 'show_template');
function show_template()
{
  global $template;
  echo basename($template);
}

if(!function_exists('stormguard_scripts')) :
  /**
   *
   */
  function stormguard_scripts()
  {

    wp_enqueue_style('stormguard_grids', get_stylesheet_directory_uri() . '/app/css/bootstrap.grid.css');
    wp_enqueue_style('stormguard_normalize', get_stylesheet_directory_uri() . '/app/css/normalize.css');
    wp_enqueue_style('stormguard_style', get_stylesheet_directory_uri() . '/app/css/style.css');


    // Deregister the jquery version bundled with WordPress.
    wp_deregister_script('jquery');

    // CDN hosted jQuery placed in the header.
    wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), '3.1.1');

    // Slick slider
    wp_enqueue_script('slick_script', get_template_directory_uri() . '/app/plugins/slick.min.js', array('jquery'),'1.6.0', true);

    // SmoothScroll
    wp_enqueue_script('SmoothScroll_script', get_template_directory_uri() . '/app/plugins/SmoothScroll.min.js', array('jquery'), '1.0.0', true);

    // Custom scripts
    wp_enqueue_script('stormguard_script', get_template_directory_uri() . '/app/js/main.js', array('jquery'), '0.0.1',true);

    // Custom minify scripts
    //wp_enqueue_script('stormguard_min_script', get_template_directory_uri() . '/app/js/min/main.min.js', array('jquery'), '0.0.1', true);

    if(is_singular() && comments_open() && get_option('thread_comments')) {
      wp_enqueue_script('comment-reply');
    }
  }

  add_action('wp_enqueue_scripts', 'stormguard_scripts');
endif;
