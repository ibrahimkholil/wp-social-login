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
 		"singular_name" => __( " Resource", "cooalliance" ),
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
 		"rewrite" => [ "slug" => "resources", "with_front" => true ],
 		"query_var" => true,
 		"supports" => [ "title","custom-fields" ],
 		"taxonomies" => [ "category", "post_tag" ],
 		"show_in_graphql" => false,
 	];

 	register_post_type( "resources", $args );
}
 add_action( 'init', 'cooalliance_cpts_register' );


// Add the custom columns to the book post type:
add_filter( 'manage_events_posts_columns', 'set_custom_edit_event_columns' );
function set_custom_edit_event_columns($columns) {
    // unset( $columns['author'] );
    $columns['attendance'] = __( 'Attendance', 'cooalliance' );
    // $columns['publisher'] = __( 'Publisher', 'your_text_domain' );

    return $columns;
}

// Add the data to the custom columns for the book post type:
add_action( 'manage_events_posts_custom_column' , 'custom_event_column', 10, 2 );
function custom_event_column( $column, $post_id ) {
    global $post;
    switch ( $column ) {

        case 'attendance' :

            $users = get_post_meta($post->ID,'joinedUsers',true);
            $member_count =  is_array($users) ? count($users) : '';
            echo  $member_count ;
            break;


    }
}
