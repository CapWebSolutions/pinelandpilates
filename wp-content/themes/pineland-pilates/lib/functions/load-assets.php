<?php
/**
 * Asset loader handler.
 */

namespace CapWeb\Pineland;

/**
 * Use This Stylesheet Version
 *
 * Set stylesheet version number so that c ache is busted when in debug.
 *
 * @link https://capwebsolutions.com
 *
 * @package WordPress
 * @since 1.0.0
 * @license GNU General Public License 2.0+
 */
function use_this_style_version() {
	if ( WP_DEBUG ) return time();
	return CHILD_THEME_VERSION;
}

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_assets' );
/**
 * Enqueue Scripts and Styles.
 *
 * @since 1.0.2
 *
 * @return void
 */
function enqueue_assets() {

	wp_enqueue_style(
		CHILD_TEXT_DOMAIN . '-fonts',
		'//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700',
		array(),
		CHILD_THEME_VERSION
	);

	wp_enqueue_style( 'dashicons' );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_script(
		CHILD_TEXT_DOMAIN . '-responsive-menus',
		CHILD_THEME_DIR_URI . "/assets/js/responsive-menus{$suffix}.js",
		array( 'jquery' ),
		CHILD_THEME_VERSION,
		true
	);

	// Localize your settings to the responsive menus script.
	wp_localize_script(
		CHILD_TEXT_DOMAIN . '-responsive-menu',
		'genesis_responsive_menu',
		pineland_responsive_menu_settings()
	);

	wp_enqueue_script(
		CHILD_TEXT_DOMAIN,
		CHILD_THEME_DIR_URI . "/assets/js/pineland-pilates{$suffix}.js",
		array( 'jquery' ),
		CHILD_THEME_VERSION,
		true
	);

}


/**
 * Defines responsive menu settings.
 *
 * @link: https://github.com/studiopress/responsive-menus
 *
 * @since 2.3.0
 */
function pineland_responsive_menu_settings() {
	$settings = array(
		'mainMenu'         => __( 'PinMenu', 'pineland' ),
		'menuIconClass'    => 'dashicons-before dashicons-menu',
		'subMenu'          => __( 'PinSubMenu', 'pineland' ),
		'subMenuIconClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'      => array(
			'combine' => array(
				'.nav-primary',
				'.menu-primary',
				'#menu-primary-menu'
			),
			'others'  => array(
				'.mega-menu',
			),
		),
	);
	return $settings;
}


add_filter( 'stylesheet_uri', __NAMESPACE__ . '\stylesheet_uri', 10, 2 );
/**
 * Loads minified version of style.css depending on value of wp_debug.
 *
 * @param string $stylesheet_uri     Original stylesheet URI.
 * @param string $stylesheet_dir_uri Stylesheet directory.
 * @return string (Maybe modified) stylesheet URI.
 */
function stylesheet_uri( $stylesheet_uri, $stylesheet_dir_uri ) {
	if ( WP_DEBUG ) return trailingslashit( $stylesheet_dir_uri ) . 'style.css';
	return trailingslashit( $stylesheet_dir_uri ) . 'style.min.css';

}
