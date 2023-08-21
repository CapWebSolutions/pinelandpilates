<?php
namespace CapWeb\Pineland\PinelandTeachers;

function cptui_register_my_cpts_teacher() {
	
		/**
		 * Post Type: Teachers.
		 */
	
		$labels = array(
			"name" => __( "Teachers", "CapWebWP/Developers" ),
			"singular_name" => __( "Teacher", "CapWebWP/Developers" ),
			"menu_name" => __( "Our Teachers", "CapWebWP/Developers" ),
			"all_items" => __( "All Teachers", "CapWebWP/Developers" ),
			"add_new" => __( "Add New Teacher", "CapWebWP/Developers" ),
			"add_new_item" => __( "Add New Teacher", "CapWebWP/Developers" ),
			"edit_item" => __( "Edit Teacher", "CapWebWP/Developers" ),
			"new_item" => __( "New Teacher", "CapWebWP/Developers" ),
			"view_item" => __( "View Teacher", "CapWebWP/Developers" ),
			"view_items" => __( "View Teachers", "CapWebWP/Developers" ),
			"search_items" => __( "Search Teachers", "CapWebWP/Developers" ),
			"not_found" => __( "No Teachers Found", "CapWebWP/Developers" ),
			"not_found_in_trash" => __( "No Teachers found in trash", "CapWebWP/Developers" ),
			"featured_image" => __( "Teacher Photo", "CapWebWP/Developers" ),
			"set_featured_image" => __( "Set Teacher Photo for this teacher", "CapWebWP/Developers" ),
			"remove_featured_image" => __( "Remove Teacher Photo", "CapWebWP/Developers" ),
			"use_featured_image" => __( "Use as Teacher Photo for this teacher", "CapWebWP/Developers" ),
			"archives" => __( "Teacher Archives", "CapWebWP/Developers" ),
			"insert_into_item" => __( "Insert into Teacher", "CapWebWP/Developers" ),
			"uploaded_to_this_item" => __( "Uploaded to this Teacher", "CapWebWP/Developers" ),
			"filter_items_list" => __( "Filter Teacher List", "CapWebWP/Developers" ),
			"items_list" => __( "Teacher List", "CapWebWP/Developers" ),
			"attributes" => __( "Teacher Attributes", "CapWebWP/Developers" ),
		);
	
		$args = array(
			"label" => __( "Teachers", "CapWebWP/Developers" ),
			"labels" => $labels,
			"description" => "Manages teachers for website",
			"public" => true,
			"publicly_queryable" => true,
			"show_ui" => true,
			"show_in_rest" => false,
			"rest_base" => "",
			"has_archive" => "teachers",
			"show_in_menu" => true,
			"exclude_from_search" => false,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"hierarchical" => false,
			"rewrite" => array( "slug" => "teacher", "with_front" => true ),
			"query_var" => true,
			"menu_icon" => "dashicons-groups",
			"supports" => array( "title", "editor", "thumbnail", "revisions", "genesis-cpt-archives-settings" ),
		);
	
		register_post_type( "teacher", $args );
	}
	
	add_action( 'init', __NAMESPACE__ . '\cptui_register_my_cpts_teacher' );
	
	
	function pineland_teacher_title( $input ) {
	
		global $post_type;
	
		if( is_admin() && 'Enter title here' == $input && 'teacher' == $post_type )
			return 'Teacher\'s Name';
		return $input;
	}
	add_filter('gettext',__NAMESPACE__ . '\pineland_teacher_title');