<?php
/**
 * Footer HTML markup structure
 *
 * @package     CapWeb\Pineland
 * @since       1.0.0
 * @author      CapWebSolutions
 * @link        https://capwebsolutions.com
 * @license     GNU General Public License 2.0+
 */
namespace CapWeb\Pineland;

/**
 * Unregister footer callbacks.
 *
 * @since 1.0.0
 *
 * @return void
 */
function unregister_footer_callbacks() {

}

//* Remove the default site footer
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

//* Customize the site footer

add_shortcode( 'footer_custombacktotop', __NAMESPACE__ . '\footer_back_to_top' );
function footer_back_to_top( $atts ) {
	return '<a href="#" class="top">Top of page</a>';
}

// Set up split custom footer
// Ref: https://sridharkatakam.com/split-footer-genesis/
add_shortcode( 'sitename', __NAMESPACE__ . '\site_name' );
function site_name() {
	return '<a href="' . get_bloginfo( 'url' ) . '" title="' . get_bloginfo( 'sitename' ) . '">' . get_bloginfo( 'name' ) . '</a>';
}

// * Change the footer text
add_filter( 'genesis_footer_creds_text',  __NAMESPACE__ . '\footer_creds_filter' );
function footer_creds_filter( $creds ) {
	$creds = '
	<div class="alignleft">
    <a href="/privacy-policy/">Privacy Policy</a> &middot; <a href="/terms-conditions/">Terms & Conditions</a><br/>
	Published by UpBeat Enterprises LLC<br />
	Copyright [footer_copyright] <a href="http://pinelandpilates.com">[sitename]</a> &middot; All Rights Reserved.
	</div>
	
	<div class="alignright">
	<br />[footer_custombacktotop]<br/>
	Website by <a href="https://capwebsolutions.com" target="_blank" >Cap Web Solutions</a>
	</div>
	
	';
	return $creds;
}
