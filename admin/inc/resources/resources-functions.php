<?php

/**
 * @ibrahim
 * resources
 */

 function my_resources_columns($columns)
{

    $columns = array(
        'cb'        => '<input type="checkbox" />',
        // 'thumbnail' =>  'Thumbnail',
        'title'     => 'Title',
        'resources_type'  => 'Resources type',
        'categories' => 'Categories',
        'author'    =>  'Author',
        'date'      =>  'Date',
    );
    return $columns;
}
add_filter("manage_edit-resources_columns", "my_resources_columns");

function resource_type_display_column_value( $column_name, $post_id ) {
    $custom_fields = get_post_custom( $post_id );

    switch ($column_name) {
        case 'resources_type' :
        $resource_type = get_post_meta($post_id, 'resources_type', true);

        echo (isset($resource_type)) ? "<a href='edit.php?post_type=resources&amp;resources_type=$resource_type'> $resource_type </a>" : ' ';

        break;

        default:
    }
}
add_action( 'manage_resources_posts_custom_column', 'resource_type_display_column_value', 10, 2 );

add_filter( 'parse_query', 'prefix_parse_filter' );
function  prefix_parse_filter($query) {
   global $pagenow;
   $current_page = isset( $_GET['post_type'] ) ? $_GET['post_type'] : '';

   if ( is_admin() &&
     'resources' == $current_page &&
     'edit.php' == $pagenow &&
      isset( $_GET['resources_type'] ) &&
      $_GET['resources_type'] != '' ) {

    $competition_name                  = $_GET['resources_type'];
    $query->query_vars['meta_key']     = 'resources_type';
    $query->query_vars['meta_value']   = $competition_name;
    $query->query_vars['meta_compare'] = '=';
  }
}
