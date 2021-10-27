<?php
/**
 *
 * @package     Cooalliance
 * @author      Ibrahim
 *Registration custom post types
 *
 */


 function cooalliance_cpts_register() {

 	/**
 	 * Post Type: Events.
 	 */

 	$labels = [
 		"name" => __( "Events", "cooalliance" ),
 		"singular_name" => __( "Events", "cooalliance" ),
 	];

 	$args = [
 		"label" => __( "Events", "cooalliance" ),
 		"labels" => $labels,
 		"description" => "",
 		"public" => true,
 		"publicly_queryable" => true,
 		"show_ui" => true,
 		"show_in_rest" => true,
 		"rest_base" => "",
 		"rest_controller_class" => "WP_REST_Posts_Controller",
 		"has_archive" => true,
 		"show_in_menu" => true,
 		"show_in_nav_menus" => true,
 		"delete_with_user" => false,
 		"exclude_from_search" => false,
 		"capability_type" => "post",
    'menu_icon' => 'dashicons-calendar-alt',
 		"map_meta_cap" => true,
 		"hierarchical" => false,
 		"rewrite" => [ "slug" => "events", "with_front" => true ],
 		"query_var" => true,
 		"supports" => [ "title", "editor", "thumbnail", "excerpt" ],
 		"taxonomies" => [ "category", "post_tag" ],
 		"show_in_graphql" => false,
 	];

 	register_post_type( "Events", $args );

 	/**
 	 * Post Type: Resources.
 	 */

 	$labels = [
 		"name" => __( "Resources", "cooalliance" ),
 		"singular_name" => __( "Patient Resource", "cooalliance" ),
 	];

 	$args = [
 		"label" => __( "Resources", "cooalliance" ),
 		"labels" => $labels,
 		"description" => "",
 		"public" => true,
 		"publicly_queryable" => true,
 		"show_ui" => true,
 		"show_in_rest" => true,
 		"rest_base" => "",
 		"rest_controller_class" => "WP_REST_Posts_Controller",
 		"has_archive" => true,
 		"show_in_menu" => true,
 		"show_in_nav_menus" => true,
 		"delete_with_user" => false,
 		"exclude_from_search" => false,
 		"capability_type" => "post",
 		"map_meta_cap" => true,
    'menu_icon'=>'dashicons-media-text',
 		"hierarchical" => false,
 		"rewrite" => [ "slug" => "patient-resources", "with_front" => true ],
 		"query_var" => true,
 		"supports" => [ "title", "editor", "thumbnail", "excerpt" ],
 		"taxonomies" => [ "category", "post_tag" ],
 		"show_in_graphql" => false,
 	];

 	register_post_type( "resources", $args );
}
 add_action( 'init', 'cooalliance_cpts_register' );
