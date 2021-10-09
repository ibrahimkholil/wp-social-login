<?php
/*
Plugin Name: Cooalliance Member Toolkit
Description: Simple, flexible, make plugin for client.
Author: Ibrahim Khalil 
Version: 1.0.0
 Text Domain: cooalliance-toolkit
*/



defined( 'ABSPATH' ) or die( 'No Cheating!' );

class Cooallinace_Toolkit
{  
    /**
    * plugin version
    */
   const version = '1.0';

   /**
    * class constructor
    */
    public function __construct()
    {
       $this->define_constants();
   }

   /**
    * Define plugin constants 
    *
    * @return void
    */
   public function define_constants(){
        define( 'COOALLINACE_TOOLKIT_VERSION', self::version );
        define( 'COOALLINACE_TOOLKIT_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
        define( 'COOALLINACE_TOOLKIT_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );
        define( 'COOALLINACE_TOOLKIT_ASSETS', COOALLINACE_TOOLKIT_URL. 'admin/assets' );
        define( 'COOALLINACE_TOOLKIT_DIR_ADMIN', trailingslashit( COOALLINACE_TOOLKIT_PATH. 'admin' ) );
   }
}
if (class_exists('Cooallinace_Toolkit')) 
{
   
    $Cooallinace = new Cooallinace_Toolkit();
}

// Admin file include
require_once( COOALLINACE_TOOLKIT_DIR_ADMIN. 'admin.php' );