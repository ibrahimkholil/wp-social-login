<?php
/**
 *
 * @package     Cooalliance 
 * @author      Ibrahim
 *
 *
 */

defined('ABSPATH') or die("Cheating........Uh!!"); 

//
// cooalliance_switcher_field(
//     array(

//         'label' => esc_html__( 'Popup Switcher', 'cooalliance-toolkit' ),
//         'inline' => false,
//         'name'  => 'popupswitcher',
//     )
// );

// Google Client id field
cooalliance_text_field(
    array(

        'label' => esc_html__( 'Google Client ID', 'cooalliance-toolkit' ),
        'inline' => false,
        'name'  => 'cooalliance_gc_id',
        'description' =>sprintf(__('Required for Google Social Login to work. 
        Please follow the documentation at 
        <a href="%s" target="_blank">this link</a> to get Google Client ID
        %s', 'cooalliance-toolkit'), 'https://developers.google.com/identity/sign-in/web/sign-in',
        '<span style="color: #14ACDF">Paste following url in AUTHORIZED REDIRECT URI option mentioned at the link
        '.esc_url(home_url()).' /wp-login.php</span>')
    )
);
// Google Google Client Secret
cooalliance_text_field(
    array(
        'label' => esc_html__('Google Client Secret', 'cooalliance-toolkit' ),
        'inline' => false,
        'name'  => 'cooalliance_gc_secret',
    )
    );
    // Google  Client Secret
cooalliance_text_field(
    array(
        'label' => esc_html__('Google callback URL', 'cooalliance-toolkit' ),
        'inline' => false,
        'name'  => 'cooalliance_gc_callback_url',
    )
    );
    // LinkedIn Client ID
    cooalliance_text_field(
        array(
            'label' => esc_html__('LinkedIn Client ID', 'cooalliance-toolkit' ),
            'inline' => false,
            'name'  => 'cooalliance_lc_id',
            'description' =>sprintf(__('Required for LinkedIn  Social Login to work. 
            Please follow the documentation at 
            <a href="%s" target="_blank">this link</a> to get LinkedIn  Client ID
            %s', 'cooalliance-toolkit'), 'https://www.linkedin.com/pulse/how-get-signin-linkedin-work-taric-andrade',
            '<span style="color: #14ACDF">Paste following url in AUTHORIZED REDIRECT URI option mentioned at the link
            '.esc_url(home_url()).'/wp-login.php</span>')
        )
        );
 // LinkedIn Client Secret
 cooalliance_text_field(
    array(
        'label' => esc_html__('LinkedIn Client Secret', 'cooalliance-toolkit' ),
        'inline' => false,
        'name'  => 'cooalliance_lc_secret',
    )
    );
    /**
     * Linkedin AUTH redirect url
     */
    cooalliance_text_field(
        array(
            'label' => esc_html__('Linkedin callback URL', 'cooalliance-toolkit' ),
            'inline' => false,
            'name'  => 'cooalliance_lnk_callback_url',
        )
        );