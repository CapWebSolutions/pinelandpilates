<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 */
namespace CapWeb\Pineland\PinelandTeachers;
/**
 * Get the bootstrap!
 */

if ( file_exists( dirname( __FILE__ ) . '/metabox/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/metabox/init.php';
}


add_action( 'cmb2_init', __NAMESPACE__ . '\cws_register_teacher_metabox' );
function cws_register_teacher_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_pineland_teacher_';

	/**
	 * Metabox to be displayed on a single page ID
	 */
	$cmb_teacher = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Teacher Details:', 'pineland-teachers' ),
		'object_types' => array( 'teacher', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, 
		'taxonomies'	=> array('type'),
	) );
	
	// $cmb_teacher->add_field( array(
	// 	'name' => __( 'Background', 'pineland-teachers' ),
	// 	'id'   => $prefix . 'background',
	// 	'type' => 'text',
	// 	'sanitization_cb' => 'cws_cmb2_sanitize_text_callback',
	// ) );
	$cmb_teacher->add_field( array(
		'name' => __( 'Phone', 'pineland-teachers' ),
		'id'   => $prefix . 'phone',
		'type' => 'text_medium',
	) );
	$cmb_teacher->add_field( array(
		'name' => __( 'Email', 'pineland-teachers' ),
		'id'   => $prefix . 'email',
		'type' => 'text_email',
	) );

	// $cmb_teacher->add_field( array(
	// 	'name' => __( 'Display Excerpt', 'pineland-teachers' ),
	// 	'id'   => $prefix . 'display_excerpt',
	// 	'type' => 'checkbox',
	// ) );
}

// function cws_cmb2_sanitize_text_callback( $value, $field_args, $field ) {
// 	$value = strip_tags( $value, '<p><a><br><br/>' );
//     return $value;
// }
// add_filter( 'cmb2_sanitize_text', 'cmb2_sanitize_text_callback', 10, 2 );