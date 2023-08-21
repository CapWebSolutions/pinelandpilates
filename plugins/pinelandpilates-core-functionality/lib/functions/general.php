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

// Use shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

// Remove theme and plugin editor links
add_action('admin_init', 'cws_hide_editor_and_tools');
function cws_hide_editor_and_tools()
{
    remove_submenu_page('themes.php', 'theme-editor.php');
    remove_submenu_page('plugins.php', 'plugin-editor.php');
}

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
add_filter('custom_menu_order', 'mr_custom_menu_order');
add_filter('menu_order', 'mr_custom_menu_order');

//
// Enqueue / register needed scripts
// Load Font Awesome
add_action('wp_enqueue_scripts', 'cws_enqueue_needed_scripts');
function cws_enqueue_needed_scripts()
{
    // font-awesome
    // Ref: application of these fonts: https://sridharkatakam.com/using-font-awesome-wordpress/
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css');
}

add_filter('widget_title', 'remove_widget_title');
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
 * Gravity Forms Domain
 *
 * Adds a notice at the end of admin email notifications
 * specifying the domain from which the email was sent.
 *
 * @param array $notification
 * @param object $form
 * @param object $entry
 * @return array $notification
 */
function ea_gravityforms_domain($notification, $form, $entry)
{
    if ($notification['name'] == 'Admin Notification') {
        $notification['message'] .= 'Sent from ' . home_url();
    }
    return $notification;
}
add_filter('gform_notification', 'ea_gravityforms_domain', 10, 3);

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
add_action('pre_get_posts', 'ea_exclude_noindex_from_search');
