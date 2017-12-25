<?php
/**
 * Clean up WordPress defaults
 *
 * @package WordPress
 */

if ( ! function_exists( 'start_cleanup' ) ) :
function start_cleanup() {

	// Launching operation cleanup.
	add_action( 'init', 'cleanup_head' );

	// Remove WP version from RSS.
	add_filter( 'the_generator', 'remove_rss_version' );

	// Remove pesky injected css for recent comments widget.
	add_filter( 'wp_head', 'remove_wp_widget_recent_comments_style', 1 );

	// Clean up comment styles in the head.
	add_action( 'wp_head', 'remove_recent_comments_style', 1 );

	// Clean up gallery output in wp.
	add_filter( 'gallery_style', 'gallery_style' );

}
add_action( 'after_setup_theme','start_cleanup' );
endif;
/**
 * Clean up head.+
 * ----------------------------------------------------------------------------
 */

if ( ! function_exists( 'cleanup_head' ) ) :
function cleanup_head() {

	// EditURI link.
	remove_action( 'wp_head', 'rsd_link' );

	// Category feed links.
	remove_action( 'wp_head', 'feed_links_extra', 3 );

	// Post and comment feed links.
	remove_action( 'wp_head', 'feed_links', 2 );

	// Windows Live Writer.
	remove_action( 'wp_head', 'wlwmanifest_link' );

	// Index link.
	remove_action( 'wp_head', 'index_rel_link' );

	// Previous link.
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );

	// Start link.
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );

	// Canonical.
	remove_action( 'wp_head', 'rel_canonical', 10, 0 );

	// Shortlink.
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

	// Links for adjacent posts.
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

	// WP version.
	remove_action( 'wp_head', 'wp_generator' );

	// Emoji detection script.
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );

	// Emoji styles.
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
}
endif;

// Remove WP version from RSS.
if ( ! function_exists( 'remove_rss_version' ) ) :
function remove_rss_version() { return ''; }
endif;

// Remove injected CSS for recent comments widget.
if ( ! function_exists( 'remove_wp_widget_recent_comments_style' ) ) :
function remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
	  remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}
endif;

// Remove injected CSS from recent comments widget.
if ( ! function_exists( 'remove_recent_comments_style' ) ) :
function remove_recent_comments_style() {
	global $wp_widget_factory;
	if ( isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments']) ) {
	remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}
endif;

// Remove injected CSS from gallery.
if ( ! function_exists( 'gallery_style' ) ) :
function gallery_style( $css ) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}
endif;


/*
* Rebuild the image tag with only the stuff we want
*/

if ( ! class_exists( 'img_rebuilder' ) ) :
	class img_rebuilder {

	  public $caption_class   = 'wp-caption';
	  public $caption_p_class = 'wp-caption-text';
	  public $caption_id_attr = false;
	  public $caption_padding = 8; // Double of the padding on $caption_class

	  public function __construct() {
	    add_filter( 'img_caption_shortcode', array( $this, 'img_caption_shortcode' ), 1, 3 );
	    add_filter( 'get_avatar', array( $this, 'recreate_img_tag' ) );
	    add_filter( 'the_content', array( $this, 'the_content') );
	  }

	  public function recreate_img_tag( $tag ) {
        // Supress SimpleXML errors
        libxml_use_internal_errors( true );

        try {
            $x = new SimpleXMLElement( $tag );

            // We only want to rebuild img tags
            if ( $x->getName() == 'img' ) {

                // Get the attributes I'll use in the new tag
                $alt        = (string) $x->attributes()->alt;
                $src        = (string) $x->attributes()->src;
                $classes    = (string) $x->attributes()->class;
                $class_segs = explode(' ', $classes);

                // All images have a source
                $img = '<img src="' . $src . '"';

                // If alt not empty, add it
                if ( ! empty( $alt ) ) {
                  $img .= ' alt="' . $alt . '"';
                }

                // Filter Through Class Segments & Find Alignment Classes and Size Classes
                $filtered_classes = array();

                foreach ( $class_segs as $class_seg ) {
                    if ( substr( $class_seg, 0, 5 ) === 'align' || substr( $class_seg, 0, 4 ) === 'size' ) {
                        $filtered_classes[] = $class_seg;
                    }
                }

                // Add Rebuilt Classes and Close The Tag
                if ( count( $filtered_classes ) ) {
                    $img .= ' class="' . implode( $filtered_classes, ' ' ) . '" />';
                } else {
                    $img .= ' />';
                }

                return $img;
            }
        }

        catch ( Exception $e ) {
                if ( defined('WP_DEBUG') && WP_DEBUG ) {
                        if ( defined('WP_DEBUG_DISPLAY') && WP_DEBUG_DISPLAY ) {
                            echo 'Caught exception: ',  $e->getMessage(), "\n";
                        }
                }
            }

        // Tag not an img, so just return it untouched
        return $tag;
	  }

	  /**
	   * Search post content for images to rebuild
	   */
	  public function the_content( $html ) {
	    return preg_replace_callback(
	      '|(<img[^>]*>)|',
	      array( $this, 'the_content_callback' ),
	      $html
	    );
	  }

	  /**
	   * Rebuild an image in post content
	   */
	  private function the_content_callback( $match ) {
	    return $this->recreate_img_tag( $match[0] );
	  }

	  /**
	   * Customize caption shortcode
	   */
	  public function img_caption_shortcode( $output, $attr, $content ) {
	    // Not for feed
	    if ( is_feed() ) {
	      return $output;
      }

	    // Set up shortcode atts
	    $attr = shortcode_atts( array(
	      'align'   => 'alignnone',
	      'caption' => '',
	      'width'   => '',
	    ), $attr );

	    // Add id and classes to caption
	    $attributes = '';
			$caption_id_attr = '';

	    if ( $caption_id_attr && ! empty( $attr['id'] ) ) {
	      $attributes .= ' id="' . esc_attr( $attr['id'] ) . '"';
	    }

	    $attributes .= ' class="' . $this->caption_class . ' ' . esc_attr( $attr['align'] ) . '"';

	    // Set the max-width of the caption
	    $attributes .= ' style="max-width:' . ( $attr['width'] + $this->caption_padding ) . 'px;"';

	    // Create caption HTML
	    $output = '
	      <div' . $attributes .'>' .
	        do_shortcode( $content ) .
	        '<p class="' . $this->caption_p_class . '">' . $attr['caption'] . '</p>' .
	      '</div>
	    ';

	    return $output;
	  }
	}

	$img_rebuilder = new img_rebuilder;

endif;

// Add WooCommerce support for wrappers per http://docs.woothemes.com/document/third-party-custom-theme-compatibility/
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
add_action('woocommerce_before_main_content', 'before_content', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_after_main_content', 'after_content', 10);

