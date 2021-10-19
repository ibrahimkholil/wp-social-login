<?php 

defined('ABSPATH') or die("Cheating........Uh!!"); 

class Admin_Page
{
    public function __construct()
    {
    
      add_action('admin_menu',array($this,'add_admin_page'));
      add_action('admin_init',[$this,'register_setting']);
    }
     public function add_admin_page()
    {
        add_menu_page(
            esc_html__( 'Cooalliance Setting', ' cooalliance' ),
            esc_html__( 'Cooalliance Setting', ' cooalliance' ),
            'manage_options',
            'cooalliance_setting',
            [$this, 'admin_cooalliance_view_callback'],
            'dashicons-rest-api',
            6
        );
        add_submenu_page( 
            'cooalliance_setting',
            'Cooalliance Setting', 
            'Cooalliance Setting',
            'manage_options',
             'cooalliance_setting'
            );
        add_submenu_page( 
            'cooalliance_setting',
            'Integration',
            'Integration',
            'manage_options', 
            'cooalliance_setting_integration',
            [$this,'cooalliance_integration']
        );
            }
    public function admin_cooalliance_view_callback()
    {
        echo "<h1>Cooalliance  setting</h1>";


    }
    public function register_setting()
    {
        register_setting('cooalliance-options-group','cooalliance_options','cooalliance');
    }
    public function cooalliance_integration()
    {
        ?>
        
         <div class="cooalliance-integration-setting-wrapper wrap">
            <h1> <?php _e('Social Login  Integration','cooalliance')?></h1>
            <form method="post" action="options.php">
               <?php 
                settings_fields('cooalliance-options-group');
                do_settings_sections('cooalliance-options-group');
                require_once COOALLINACE_TOOLKIT_DIR_ADMIN .'inc/integration-template.php';
                submit_button(); 
               
               ?>
            </form>
         </div>
        <?php
    }
}
new Admin_Page();