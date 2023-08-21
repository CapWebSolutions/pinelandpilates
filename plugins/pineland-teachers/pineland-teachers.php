<?php

/*
 * Plugin Name: Pineland Teachers
 * Plugin URI: https://capwebsolutions.com/
 * Description: Adds the teacher post type for the theme.
 * Author: Cap Web Solutions
 * Version: 1.0.0
 * Author URI: https://capwebsolutions.com/
 * 
 *
 */
namespace CapWeb\Pineland\PinelandTeachers;

// Get all the things
require_once( dirname( __FILE__ ) . '/post-types.php' );
require_once( dirname( __FILE__ ) . '/metaboxes.php' );
// require_once( dirname( __FILE__ ) . '/taxonomies.php' );
require_once( dirname( __FILE__ ) . '/helper-functions.php' );


// Load Translations
add_action( 'plugins_loaded', __NAMESPACE__ . '\pineland_teachers_init' );
function pineland_teachers_init() {
	load_plugin_textdomain( 'pineland-teachers', false, 'pineland-teachers/languages' );
}

// Enqueue Teacher styles
// add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_pineland_teachers_style');

// Setup new teach image sizes. 
__NAMESPACE__ . '\adds_new_teachers_image_sizes()';

// Set up templates for new post type
add_filter( 'archive_template', __NAMESPACE__ . '\load_archive_template' );
add_filter( 'single_template', __NAMESPACE__ . '\load_single_template' );