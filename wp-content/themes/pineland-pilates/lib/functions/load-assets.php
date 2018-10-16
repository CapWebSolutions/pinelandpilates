<?php
/**
 * Asset loader handler.
 *
 * @package     CapWeb\Pineland
 * @since       1.0.0
 * @author      CapWebSolutions
 * @link        https://capwebsolutions.com
 * @license     GNU General Public License 2.0+
 */
namespace CapWeb\Pineland;

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_assets' );
/**
 * Enqueue Scripts and Styles.
 *
 * @since 1.0.2
 *
 * @return void
 */
function enqueue_assets() {

	wp_enqueue_style( CHILD_TEXT_DOMAIN . '-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	// wp_enqueue_script( CHILD_TEXT_DOMAIN . '-responsive-menu', CHILD_URL . '/assets/js/responsive-menu.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
	//wp_enqueue_style( CHILD_TEXT_DOMAIN . '-horizontal', CHILD_URL . '/style-menu-horizontal.css', array(), '1.0.0' );
	// wp_enqueue_style( CHILD_TEXT_DOMAIN . '-megamenu', CHILD_URL . '/style-sk-megamenu.css', array(), '1.0.0' );

	// $localized_script_args = array(
	// 	'mainMenu' => __( 'Menu', CHILD_TEXT_DOMAIN ),
	// 	'subMenu'  => __( 'Menu', CHILD_TEXT_DOMAIN ),
	// );
	// wp_localize_script( __NAMESPACE__ . '\responsive_menu_settings', 'developersL10n', $localized_script_args );

	/* New style mobile menu
	Ref: https://sridharkatakam.com/genesis-responsivemenus-in-minimum-pro/ */
	wp_enqueue_script(
		'minimum-responsive-menu',
		get_stylesheet_directory_uri() . '/assets/js/responsive-menu.js',
		array( 'jquery' ),
		CHILD_THEME_VERSION,
		true
	);
	wp_localize_script(
		'minimum-responsive-menu',
		'genesis_responsive_menu',
		responsive_menu_settings()
	);

}