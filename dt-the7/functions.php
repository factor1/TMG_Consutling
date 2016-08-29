<?php
/**
 * Vogue theme.
 *
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since 1.0.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1200; /* pixels */
}

/**
 * Initialize theme.
 *
 * @since 1.0.0
 */
require( trailingslashit( get_template_directory() ) . 'inc/init.php' );


function f1_styles() {
	if( is_post_type_archive('tmg_resources') || is_singular('tmg_resources') ){
		wp_enqueue_style('factor1-styles', get_template_directory_uri() . '/factor1-styles/assets/css/factor1.min.css');
	}
}
add_action( 'wp_enqueue_scripts', 'f1_styles' );


/**
  * Add REST API support to an already registered post type.
  */
  add_action( 'init', 'my_custom_post_type_rest_support', 25 );
  function tmg_resources_rest_support() {
  	global $wp_post_types;

  	//be sure to set this to the name of your post type!
  	$post_type_name = 'tmg_resources';
  	if( isset( $wp_post_types[ $post_type_name ] ) ) {
  		$wp_post_types[$post_type_name]->show_in_rest = true;
  		$wp_post_types[$post_type_name]->rest_base = $post_type_name;
  		$wp_post_types[$post_type_name]->rest_controller_class = 'WP_REST_Posts_Controller';
  	}

  }
