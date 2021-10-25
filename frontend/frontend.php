<?php

/**
 * @ibrahim
 * user profile shortcode
 */

add_action('wp_enqueue_scripts', 'cooalliance_frontend_styles' );

function cooalliance_frontend_styles(){
    wp_enqueue_style('cooalliance-user-account', COOALLINACE_TOOLKIT_URL . 'frontend/assets/css/user-account.css', array());
    wp_enqueue_script('cooalliance-user-tab', COOALLINACE_TOOLKIT_URL . 'frontend/assets/js/frontend.js', array('jquery'));
    wp_enqueue_script('profile-update-scripts',   COOALLINACE_TOOLKIT_URL .'frontend/assets/js/profile-update.js', ['jquery'],'', true);

    wp_localize_script( 'profile-update-scripts', 'profile_update_obj', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce('profile-update-form-nonce')
    ));
}

require_once( COOALLINACE_TOOLKIT_PATH . 'frontend/account.php' );
require_once( COOALLINACE_TOOLKIT_PATH . 'frontend/profile_update_process.php' );