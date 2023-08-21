<?php
/*
 * Description: Defines all the helper functions used in plugin.
 * Author: Cap Web Solutions
 * Version: 1.0.0
 * Author URI: https://capwebsolutions.com/
 * 
 *
 */
namespace CapWeb\Pineland\PinelandTeachers;

/**
 * Load the stylesheet
 *
 * @since 1.0.0
 *
 * @return void
 */

function enqueue_pineland_teachers_style() {
	$css_file = apply_filters( 'pineland_teacher_css_file', dirname( __FILE__ ) . '/pineland-teachers.css' );
	wp_enqueue_style( 'pineland-teacher-style', dirname( __FILE__ ) . '/pineland-teachers.css', array(), '1.0.0' );
}
/**
 * Adds new image sizes.
 *
 * @since 1.0.0
 *
 * @return void
 */


function adds_new_teachers_image_sizes() {
	$config = array(
		'pineland-teacher-image' => array(
			'width'  => 200,
			'height' => 200,
			'crop'   => true,
		),
	);

	foreach ( $config as $name => $args ) {
		$crop = array_key_exists( 'crop', $args ) ? $args['crop'] : false;

		add_image_size( $name, $args['width'], $args['height'], $crop );
	}
}


 /**
 * load Testimonial archive template
 * @param  template $archive_template requires Genesis
 *
 * @since  1.2.0
 */
function load_archive_template( $archive_template ) {
	if ( is_post_type_archive( 'teacher' ) || is_tax( 'source' ) ) {
		$archive_template = dirname( __FILE__ ) . '/views/archive-teacher.php';
	}

	return $archive_template;

}

/**
 * load single Testimonial template
 * 
 * @param  template $single_template requires Genesis
 * @since 1.2.0
 */
function load_single_template( $single_template ) {
	if ( is_singular( 'teacher' ) ) {
		$single_template = dirname( __FILE__ ) . '/views/single-teacher.php';
	}
	return $single_template;

}
