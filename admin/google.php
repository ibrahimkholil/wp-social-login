<?php
/**
 *
 * @package     Cooalliance 
 * @author      Ibrahim
 *
 *
 */

defined('ABSPATH') or die("Cheating........Uh!!"); 

global $wpdb;

@header( 'X-Accel-Buffering: no' );

require COOALLINACE_TOOLKIT_PATH . 'vendor/autoload.php';

$options = get_option('cooalliance_options');
$cooalliance_login_google_app_id       = $options['cooalliance_gc_id'];
$cooalliance_login_google_app_secret   = $options['cooalliance_gc_secret'];
$cooalliance_login_google_callback_url    = $options['cooalliance_gc_callback_url'];


// Step 1: Enter you google account credentials
$g_client = new Google_Client();
$g_client->setClientId( $cooalliance_login_google_app_id );
$g_client->setClientSecret( $cooalliance_login_google_app_secret  );
$g_client->setRedirectUri( $cooalliance_login_google_callback_url );
$g_client->setScopes( 'profile email' );

$service = new Google_Service_Oauth2( $g_client );



if ( $cooalliance_login_google_callback_url && $cooalliance_login_google_app_secret  && $cooalliance_login_google_app_id  ) {
	// Step 2 : Create the url
	$auth_url = $g_client->createAuthUrl();
} else {
	$auth_url = '?error=google';
}
echo "<a class='wt-sl-iconlink wt-sl-button' href='$auth_url'> <img style='display: inline' src='" . plugin_dir_url( __FILE__ ) . 'images/google.png' . "'/> </a>";



// Step 3 : Get the authorization  code
$code = isset( $_GET['code'] ) ? $_GET['code'] : null;

$uri      = $_SERVER['REQUEST_URI'];
$uri      = urldecode( $uri );
$exploded = array();
parse_str( $uri, $exploded );

if ( isset( $exploded['code'] ) ) {
	$code = $exploded['code'];
}


// Step 4: Get access token
if ( $code ) {
	try {
		$token = $g_client->fetchAccessTokenWithAuthCode( $code );
		$g_client->setAccessToken( $token );

	} catch ( Exception $e ) {
		// echo $e->getMessage();
	}

	try {
		$pay_load = $g_client->verifyIdToken();


	} catch ( Exception $e ) {
		// echo $e->getMessage();
	}
} else {
	$pay_load = null;
}

if ( isset( $pay_load ) ) {
	if ( $g_client->getAccessToken() ) {
		$user                     = $service->userinfo->get( $_POST );
		$_SESSION['access_token'] = $g_client->getAccessToken();
		$user_email               = $user->email;

		$cooalliance_user_data['first_name'] = isset($user->givenName) ? $user->givenName : '';
		$cooalliance_user_data['last_name'] = isset($user->familyName) ? $user->familyName : '';
		$cooalliance_user_data['display_name'] = isset($user->name) ?$user->name : '';
		$cooalliance_user_data['profile_pic'] = isset($user->picture) ? $user->picture : '';
		$platform                 = 'google';
		include 'login-data.php';
		die;
	}
}
