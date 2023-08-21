<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 */

/**
 * Get the bootstrap!
 */

if ( file_exists( dirname( __FILE__ ) . '/metabox/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/metabox/init.php';
}


add_action( 'cmb2_init', 'cws_register_testimonial_metabox' );
function cws_register_testimonial_metabox() {

	$prefix = '_pineland_testimonial_';

	/**
	 * Metabox to be displayed on a single page ID
	 */
	$cmb_testimonial = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Testimonial Details:', 'pineland-testimonials' ),
		'object_types' => array( 'testimonial', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, 
		'taxonomies'	=> array('type'),
	) );
	
	$cmb_testimonial->add_field( array(
		'name' => __( 'Descriptor', 'pineland-testimonials' ),
		'id'   => $prefix . 'descriptor',
		'type' => 'text',
		'sanitization_cb' => 'cws_cmb2_sanitize_text_callback',
	) );
	// $cmb_testimonial->add_field( array(
	// 	'name' => __( 'Company', 'pineland-testimonials' ),
	// 	'id'   => $prefix . 'company',
	// 	'type' => 'text',
	// ) );
	// $cmb_testimonial->add_field( array(
	// 	'name' => __( 'Location', 'pineland-testimonials' ),
	// 	'id'   => $prefix . 'location',
	// 	'type' => 'text',
	// ) );
	$cmb_testimonial->add_field( array(
		'name' => __( 'Display Excerpt', 'pineland-testimonials' ),
		'id'   => $prefix . 'display_excerpt',
		'type' => 'checkbox',
	) );
}

function cws_cmb2_sanitize_text_callback( $value, $field_args, $field ) {
	$value = strip_tags( $value, '<p><a><br><br/>' );
    return $value;
}
add_filter( 'cmb2_sanitize_text', 'cmb2_sanitize_text_callback', 10, 2 );
