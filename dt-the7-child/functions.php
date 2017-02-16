<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'optionsframework-global','dt-main','dt-awsome-fonts','dt-fontello' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

/**
 * A function to grab fields from Advanced Custom Fields.
 *
 * Use case: Using ACF you need to link to either an internal page in the site or an external URL
 *
 * @param string         $field1  The name of the first field to check for
 * @param string         $field2  The name of the second field to check for
 * @param string         $field3  The name of the third field to check for. Most common if needing to link to a modal ID
 * @param string|integer $page_id Alternate page ID, if the fields being checked are from a different page
 */
function get_acf_link( $field1, $field2, $field3 = null, $page_id = null ) {
  $field1 = get_field( $field1, $page_id ) ? get_field( $field1, $page_id ) : get_sub_field( $field1, $page_id );
  $field2 = get_field( $field2, $page_id ) ? get_field( $field2, $page_id ) : get_sub_field( $field2, $page_id );
  $field3 = get_field( $field3, $page_id ) ? get_field( $field3, $page_id ) : get_sub_field( $field3, $page_id );

  if ( $field1 ) {
    return esc_url( $field1 );
  }
  if ( $field2 ) {
    return esc_url( $field2 );
  }
  if ( $field3 ) {
    return '#' . $field3;
  }

  return '#';
}

/**
 * Debug some piece of code.
 * Remove the die; if you want the rest of the code on the page to execute
 *
 * @param $code The code that you want to check.
 */
function debug( $code ) {
  printf( '<pre>%s</pre>', print_r( $code, true ) );
  // die;
}
// END ENQUEUE PARENT ACTION
