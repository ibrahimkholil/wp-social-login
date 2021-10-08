<?php
/**
 * @package     Cooalliance 
 * @author      Ibrahim
 */

defined('ABSPATH') or die("Cheating........Uh!!"); 

class Fields{

    private static $instance = null;

    private static $pluginUrl;

    private static $pluginPath;

    private static $optionName = 'cooalliance_options';

    private static $optionData;

    function __construct() {
        $this->init();
    }

    public function getInstance() {

        if( self::$instance == null ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function init() {
        
        //
        self::pluginsUrl();
        //
        self::pluginPath();
        //
        self::getOptionData();
        //
        $this->include_fiels();
        //
        add_filter( 'cooalliance_get_settings_opt', [$this, 'option_flug'] );

        add_action( 'admin_enqueue_scripts', [ $this, 'enqueueScripts' ] );
        
    }

    public function enqueueScripts() {

        wp_enqueue_media();
        wp_enqueue_style( 'cooalliance-settings-field', self::$pluginUrl.'assets/css/fields.css', array(), '1.0', false );
       
    }

    public function option_flug() {

        return [
            'option_name' => self::setOptionName(),
            'option_data' => self::$optionData
        ];

    } 

    private function setOptionName() {
        return self::$optionName;
    }

    private function getOptionData() {
        self::$optionData = get_option( self::$optionName );
    }

    private static function pluginsUrl() {
        self::$pluginUrl = plugin_dir_url( __FILE__ );
    }

    private static function pluginPath() {
        self::$pluginPath = plugin_dir_path( __FILE__ );
    }

    private function include_fiels() {

        //
        require_once( self::$pluginPath.'fields/text.php' );
        require_once( self::$pluginPath.'fields/textarea.php' );
        require_once( self::$pluginPath.'fields/hidden.php' );
        require_once( self::$pluginPath.'fields/checkbox.php' );
        require_once( self::$pluginPath.'fields/radio.php' );
        require_once( self::$pluginPath.'fields/image-upload.php' );
        require_once( self::$pluginPath.'fields/text-repeater.php' );
        require_once( self::$pluginPath.'fields/select.php' );
        require_once( self::$pluginPath.'fields/switcher.php' );
        require_once( self::$pluginPath.'fields/mulitext-repeater.php' );

        //
        require_once( self::$pluginPath.'inc/functions.php' );
    }

}

$obj = new Fields();
$obj->getInstance();