<?php
/**
 * Menu HTML markup structure
 *
 * @package     CapWeb\Pineland
 * @since       1.0.0
 * @author      CapWebSolutions
 * @link        https://capwebsolutions.com
 * @license     GNU General Public License 2.0+
 */
namespace CapWeb\Pineland;

/**
 * Unregister menu callbacks.
 *
 * @since 1.0.0
 *
 * @return void
 */
function unregister_menu_callbacks() {
	// remove_action( 'genesis_after_header', 'genesis_do_nav' );
	remove_action( 'genesis_after_header', 'genesis_do_subnav' );
}

// Reposition the secondary navigation menu
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

/**
 * Reduce the secondary navigation menu to one level depth.
 *
 * @since 1.0.0
 *
 * @param array $args
 *
 * @return array
 */
function setup_secondary_menu_args( array $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;
}
add_filter( 'wp_nav_menu_args', __NAMESPACE__ . '\setup_secondary_menu_args' );

/**
 * Setup Tertiary menu.
 *
 * @since 1.0.0
 *
 * @param array $args
 *
 * @return array
 */
// function add_tertiary_nav_menu () {
// 	$args = array(
// 		'theme_location' => 'tertiary',
// 		'container' => 'nav',
// 		'container_class' => 'nav-tertiary',
// 		'menu_class' => 'menu genesis-nav-menu menu-tertiary',
// 		'depth' => 0,
// 		);
// 	wp_nav_menu( $args );
// }
// add_action( 'genesis_before_footer', __NAMESPACE__ . '\add_tertiary_nav_menu', 15 );



// Adds descriptions to menus
function nav_description( $item_output, $item, $depth, $args ) {
 if ( !empty( $item->description ) ) {
 $item_output = str_replace( $args->link_after . '</a>', '<p class="menu-item-description">' . $item->description . '</p>' . $args->link_after . '</a>', $item_output );
 }
  
 return $item_output;
}

// add_filter( 'walker_nav_menu_start_el',  __NAMESPACE__ . '\nav_description', 10, 4 );

// Stop WP removing HTML in Menu Description area
remove_filter('nav_menu_description', 'strip_tags');
 
// add_filter( 'wp_setup_nav_menu_item', __NAMESPACE__ . '\cws_wp_setup_nav_menu_item' );
 
function cws_wp_setup_nav_menu_item($menu_item) {
 
$menu_item->description = apply_filters( 'nav_menu_description', $menu_item->post_content );
 
return $menu_item;
 
}

