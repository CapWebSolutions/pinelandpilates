<?php

/**
 * General
 *
 * This file contains any general functions
 *
 * @package      Core_Functionality
 * @since        1.0.0
 * @link         https://github.com/capwebsolutions/starter-core-functionality
 * @author       Matt Ryan <matt@capwebsolutions.com>
 * @copyright    Copyright (c) 2017, Matt Ryan
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

namespace capweb;

/**
 * Don't Update Plugin
 *
 * @since 1.0.0
 *
 * This prevents you being prompted to update if there's a public plugin
 * with the same name.
 *
 * @author Mark Jaquith
 * @link http://markjaquith.wordpress.com/2009/12/14/excluding-your-plugin-or-theme-from-update-checks/
 *
 * @param array  $r, request arguments
 * @param string $url, request url
 * @return array request arguments
 */
function core_functionality_hidden( $r, $url ) {
	if ( 0 !== strpos( $url, 'http://api.wordpress.org/plugins/update-check' ) ) {
		return $r; // Not a plugin update request. Bail immediately.
	}
	$plugins = unserialize( $r['body']['plugins'] );
	unset( $plugins->plugins[ plugin_basename( __FILE__ ) ] );
	unset( $plugins->active[ array_search( plugin_basename( __FILE__ ), $plugins->active ) ] );
	$r['body']['plugins'] = serialize( $plugins );
	return $r;
}
add_filter( 'http_request_args', __NAMESPACE__ . '\core_functionality_hidden', 5, 2 );

// Use shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

// Add Genesis theme support for WooCommerce
add_theme_support('genesis-connect-woocommerce');

// Remove theme and plugin editor links
add_action('admin_init', __NAMESPACE__ . '\hide_editor_and_tools');
function hide_editor_and_tools()
{
    remove_submenu_page('themes.php', 'theme-editor.php');
    remove_submenu_page('plugins.php', 'plugin-editor.php');
}

/**
 * Remove Menu Items
 *
 * @since 1.0.0
 *
 * Remove unused menu items by adding them to the array.
 * See the commented list of menu items for reference.
 */
function be_remove_menus()
{
    global $menu;
    $restricted = array(__('Links'));
    // Example:
    // $restricted = array(__('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins'));
    end($menu);
    while (prev($menu)) {
        $value = explode(' ', $menu[key($menu)][0]);
        if (in_array($value[0] != null ? $value[0] : '', $restricted)) {
            unset($menu[key($menu)]);
        }
    }
}
add_action('admin_menu', __NAMESPACE__ . '\be_remove_menus');

/**
 * Customize Admin Bar Items
 *
 * @since 1.0.0
 * @link http://wp-snippets.com/addremove-wp-admin-bar-links/
 */
function be_admin_bar_items()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('new-link', 'new-content');
}
add_action('wp_before_admin_bar_render', __NAMESPACE__ . '\be_admin_bar_items');


/**
 * Customize Menu Order
 *
 * @since 1.0.0
 *
 * @param array $menu_ord. Current order.
 * @return array $menu_ord. New order.
 */
function mr_custom_menu_order($menu_ord)
{
    if (!$menu_ord) {
        return true;
    }
    return array(
        'index.php', // dashboard link
        'edit.php?post_type=page', // the page tab
        'edit.php', // the posts tab
        'plugins.php', // plugins tab
        'options-general.php',  //settings
        'tools.php',  //tools
        'upload.php', // the media manager
    );
}
add_filter('custom_menu_order', __NAMESPACE__ . '\mr_custom_menu_order');
add_filter('menu_order', __NAMESPACE__ . '\mr_custom_menu_order');

// Disable WPSEO columns on edit screen
add_filter('wpseo_use_page_analysis', '__return_false');

//
// * Customize search form input box text
// * Ref: https://my.studiopress.com/snippets/search-form/
add_filter('genesis_search_text', __NAMESPACE__ . '\sp_search_text');
function sp_search_text($text)
{
    return esc_attr('Search ' . get_bloginfo($show = '', 'display'));
    get_permalink();
}

// We will make use of widget_title filter to 
//dynamically replace custom tags with html tags

add_filter('widget_title', __NAMESPACE__ . '\accept_html_widget_title');
function accept_html_widget_title($mytitle)
{

    // The sequence of String Replacement is important!!

    $mytitle = str_replace('[link', '<a', $mytitle);
    $mytitle = str_replace('[/link]', '</a>', $mytitle);
    $mytitle = str_replace(']', '>', $mytitle);

    return $mytitle;
}

// Custom 404 Pages ===================================================
// Call the sitemap generator
// Source: http://www.carriedils.com/custom-404-wordpress-html-sitemap/
// remove_action( 'genesis_loop', 'genesis_404' ); // Remove the default Genesis 404 content
add_action('genesis_loop', __NAMESPACE__ . '\cd_custom_404'); // Add function for custom 404 content
function cd_custom_404()
{
    if (is_404()) {
        get_template_part('/partials/sitemap'); // Plop in our customized sitemap code
    }
}


add_filter('widget_title', __NAMESPACE__ . '\remove_widget_title');
// Add the filter and function, returning the widget title only if the first character is not "!"
// Author: Stephen Cronin
// Author URI: http://www.scratch99.com/
function remove_widget_title($widget_title)
{
    if (substr($widget_title, 0, 1) === '!')
        return;
    else
        return ($widget_title);
}


/**
 * Exclude No-index content from search
 *
 */
function ea_exclude_noindex_from_search($query)
{
    if ($query->is_main_query() && $query->is_search() && !is_admin()) {
        $meta_query = empty($query->query_vars['meta_query']) ? array() : $query->query_vars['meta_query'];
        $meta_query[] = array(
            'key' => '_yoast_wpseo_meta-robots-noindex',
            'compare' => 'NOT EXISTS',
        );
        $query->set('meta_query', $meta_query);
    }
}
add_action('pre_get_posts', __NAMESPACE__ . '\ea_exclude_noindex_from_search');
