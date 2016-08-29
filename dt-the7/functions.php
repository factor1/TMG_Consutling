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

if( is_post_type_archive('tmg_resources') || is_singular('tmg_resources') ){
	function f1_styles() {
		wp_enqueue_style('factor1-styles', get_template_directory_uri() . '/factor1-styles/assets/css/factor1.min.css');
	}
	add_action( 'wp_enqueue_scripts', 'f1_styles' );
}
