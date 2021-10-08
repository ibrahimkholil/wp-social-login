<?php 

defined('ABSPATH') or die("Cheating........Uh!!"); 



class Cooallinace_Toolkit_Admin
{
    function __construct() {
        $this->include_fiels();
        add_action( 'login_form', array( $this, 'social_links' ) );
    }

    public function include_fiels() {

    	require_once COOALLINACE_TOOLKIT_DIR_ADMIN. 'inc/admin-page.php' ;
        require_once COOALLINACE_TOOLKIT_DIR_ADMIN. 'settings-fields/fields.php' ;

    }
    public function social_links()
    {
            $msg = __( 'Login with Social Media', 'cooalliance-tooltik' );
			echo "<h4><b>$msg</b></h4> <div>";

			$wt_social_login_enable_google   = get_option( 'wt_social_login_enable_google' );
			$wt_social_login_enable_facebook = get_option( 'wt_social_login_enable_facebook' );
			$wt_social_login_enable_linkedin = get_option( 'wt_social_login_enable_linkedin' );

			
			if ( $wt_social_login_enable_google ) {
				include 'google.php';
			}
			if ( $wt_social_login_enable_linkedin ) {
				include 'linkedin.php';
			}
			echo '</div>';
    }
}

new Cooallinace_Toolkit_Admin();