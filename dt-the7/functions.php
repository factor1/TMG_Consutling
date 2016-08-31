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
		wp_enqueue_script('factor1-js', get_template_directory_uri() . '/factor1-styles/assets/js/factor1.min.js', array( 'wp-api' ), true);
	}
}
add_action( 'wp_enqueue_scripts', 'f1_styles' );


/**
  * Add REST API support to an already registered post type.
  */
  add_action( 'init', 'tmg_resources_rest_support', 25 );
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

	/**
	  * Add REST API support to an already registered taxonomy.
	  */
	  add_action( 'init', 'resource_category_rest_support', 25 );
	  function resource_category_rest_support() {
	  	global $wp_taxonomies;

	  	//be sure to set this to the name of your taxonomy!
	  	$taxonomy_name = 'resource_category';

	  	if ( isset( $wp_taxonomies[ $taxonomy_name ] ) ) {
	  		$wp_taxonomies[ $taxonomy_name ]->show_in_rest = true;
	  		$wp_taxonomies[ $taxonomy_name ]->rest_base = $taxonomy_name;
	  		$wp_taxonomies[ $taxonomy_name ]->rest_controller_class = 'WP_REST_Terms_Controller';
	  	}


	  }

		/**
		  * Add REST API support to an already registered taxonomy.
		  */
		  add_action( 'init', 'resource_tag_rest_support', 25 );
		  function resource_tag_rest_support() {
		  	global $wp_taxonomies;

		  	//be sure to set this to the name of your taxonomy!
		  	$taxonomy_name = 'resource_tag';

		  	if ( isset( $wp_taxonomies[ $taxonomy_name ] ) ) {
		  		$wp_taxonomies[ $taxonomy_name ]->show_in_rest = true;
		  		$wp_taxonomies[ $taxonomy_name ]->rest_base = $taxonomy_name;
		  		$wp_taxonomies[ $taxonomy_name ]->rest_controller_class = 'WP_REST_Terms_Controller';
		  	}


		  }

// Add new Image Size for Resources
add_image_size('resources', 212, 212, array('center', 'center'));

// Gravity form Hook
add_action( 'gform_after_submission_22', 'download_resource', 10, 2 );
	function download_resource( $entry, $form ) {
		$resourceURL = get_field('resource_upload');
		header("Location: $resourceURL");

	}
