<?php
/**
 *
 * @package     Cooalliance 
 * @author      Ibrahim
 * login data
 *
 */

defined('ABSPATH') or die("Cheating........Uh!!");

global $wpdb;
if ( is_user_logged_in() ) {
	$current_user = wp_get_current_user();
	if ( $current_user->user_email != $user_email ) {
		wp_redirect( htmlspecialchars( $_SERVER['HTTP_REFERER'] ) );
	}
	exit;
}
$table_name     = $wpdb->prefix . 'users';
$query_check_already_exists = "SELECT COUNT(*),'user_login'  from  $table_name where `user_email` = '$user_email'";

$found_customer = false;

if ( is_email( $user_email ) ) {

	$maybe_username = explode( '@', $user_email );
	$maybe_username = sanitize_user( $maybe_username[0] );
	$counter        = 1;
	$username       = $maybe_username;

	while ( username_exists( $username ) ) {
		$username = $maybe_username . $counter;
		$counter ++;
	}
	$password = substr( str_shuffle( str_repeat( $x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil( 11 / strlen( $x ) ) ) ), 1, 11 );
	//var_dump($wpdb );
	if ( ! $wpdb->get_var( $query_check_already_exists ) ) {
		$new_user_data['user_login'] = $username;
		$new_user_data['user_pass'] = $password;
		$new_user_data['user_email'] = $user_email;
		$new_user_data['role'] = 'subscriber';
		if(isset($wt_sl_user_data['first_name']))
			$new_user_data['first_name'] = $wt_sl_user_data['first_name'];
		if(isset($wt_sl_user_data['last_name']))
			$new_user_data['last_name'] = $wt_sl_user_data['last_name'];
		if(isset($wt_sl_user_data['display_name']))
			$new_user_data['display_name'] = $wt_sl_user_data['display_name'];
		$found_customer = wp_insert_user( $new_user_data );

		if ( ! is_wp_error( $found_customer ) ) {
			if(!empty($wt_sl_user_data['profile_pic']))
				add_user_meta($found_customer, 'wt_sl_profile_pic', $wt_sl_user_data['profile_pic']);
		}

	} else {
		$user_data      = $wpdb->get_row( "SELECT *  from  $table_name where `user_email` = '$user_email'", ARRAY_A );
		$username       = $user_data['user_login'];
		$found_customer = $user_data['ID'];
	}
}



$user = get_user_by( 'login', $username );

// Redirect URL //
if ( ! is_wp_error( $user ) ) {
	wp_clear_auth_cookie();
	wp_set_current_user( $user->ID );
	wp_set_auth_cookie( $user->ID );

	update_user_meta( $found_customer, $platform . '_last_login', date( 'Y-m-d H:i:s' ) );
	update_user_meta( $found_customer, $platform . '_email', $user_email );
	update_user_meta( $found_customer, $platform . '_link_status', 1 );

	$redirect_to = user_admin_url();
	wp_safe_redirect( $redirect_to );
}
