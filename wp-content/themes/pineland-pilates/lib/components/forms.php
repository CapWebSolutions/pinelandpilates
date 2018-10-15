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

//* Enable Gravity Forms Field Label Visibility 
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );