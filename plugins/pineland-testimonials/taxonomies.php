<?php
function cptui_register_my_taxes_source() {
	
		/**
		 * Taxonomy: Sources.
		 */
	
		$labels = array(
			"name" => __( "Sources", "CapWebWP/Developers" ),
			"singular_name" => __( "Source", "CapWebWP/Developers" ),
		);
	
		$args = array(
			"label" => __( "Sources", "CapWebWP/Developers" ),
			"labels" => $labels,
			"public" => true,
			"hierarchical" => false,
			"label" => "Sources",
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => array( 'slug' => 'testimonials-by', 'with_front' => true, ),
			"show_admin_column" => false,
			"show_in_rest" => false,
			"rest_base" => "",
			"show_in_quick_edit" => true,
		);
		register_taxonomy( "source", array( "testimonial" ), $args );
	}
	
	add_action( 'init', 'cptui_register_my_taxes_source' );
	
