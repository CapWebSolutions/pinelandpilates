<?php
/**
 * Archive template customization
 *
 * @package     CapWeb\Pineland
 * @since       1.0.0
 * @author      CapWebSolutions
 * @link        https://capwebsolutions.com
 * @license     GNU General Public License 2.0+
 */
namespace CapWeb\Pineland;

// Get rid of the archive title description output.
/* remove_action( 'genesis_before_loop', 'genesis_do_cpt_archive_title_description' ); */

// Get rid of the taxonomy title description output.
remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );