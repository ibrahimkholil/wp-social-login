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

	
			$options = get_option('cooalliance_options');
			$cooalliance_google_app_id       = $options['cooalliance_gc_id'];
			$cooalliance_linkedin_app_id  = $options['cooalliance_lc_id'];
			
			if ( $cooalliance_google_app_id ) {
				include 'google.php';
			}
			if ( $cooalliance_linkedin_app_id ) {
				include 'linkedin.php';
			}
			echo '</div>';
    }
}

new Cooallinace_Toolkit_Admin();