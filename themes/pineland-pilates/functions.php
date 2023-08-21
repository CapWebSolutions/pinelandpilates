<?php

/**
 * Pineland Pilates Child Theme.
 *
 * This file adds functions to the custom Pineland Pilates Child Theme.
 *
 * @package     CapWeb\Pineland
 * @since       1.0.0
 * @author      CapWebSolutions
 * @link        https://capwebsolutions.com
 * @license     GNU General Public License 2.0+
 */

// Start the engine.
require_once 'lib/init.php';

// Load in functional logic.
require_once 'lib/functions/autoload.php';




// Remove post info from posts, aka events.
add_filter('genesis_post_info', 'sp_post_info_filter');
function sp_post_info_filter($post_info)
{
    $post_info = '';
    return $post_info;
}

// Turn off optimization for Beaver Builder in Admin
add_filter('autoptimize_filter_noptimize', 'beaver_noptimize', 10, 0);
function beaver_noptimize()
{
    if (strpos($_SERVER['REQUEST_URI'], 'fl_builder') !== false) {
        return true;
    } else {
        return false;
    }
}



/**
 * Replace <br> tags in labesl with html on Buy Books
 * 
 * ref: https://docs.gravityforms.com/gform_field_content/
 */

add_filter( 'gform_field_content_6', 'capweb_enable_html_label', 10, 2 );
function capweb_enable_html_label( $field_content, $field ) {
	 return str_replace( '&lt;br&gt;', '<br>', $field_content );
}
