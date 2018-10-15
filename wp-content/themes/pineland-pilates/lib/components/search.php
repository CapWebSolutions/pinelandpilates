<?php
/**
 * Description: Gravity forms mods and tweaks
 *
 * @package     CapWeb\Pineland
 * @since       1.0.0
 * @author      CapWebSolutions
 * @link        https://capwebsolutions.com
 * @license     GNU General Public License 2.0+
 */
namespace CapWeb\Pineland;


//* Customize search form input box text of Genesis child themes
add_filter( 'genesis_search_text', __NAMESPACE__ . '\genesis_search_text' );
function genesis_search_text( $text ) {

    return esc_attr( 'Search ' . get_bloginfo( 'name' ) . ' . . .' );
    
}