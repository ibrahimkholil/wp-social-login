<?php

/**
 * @package     Cooalliance
 * @author      Ibrahim
 * Elementor widgets register class [Cooalliance_Elementor_Widgets]
 */


 class Cooalliance_Elementor_Widgets
{

	private static $_instance = null;

	public static function instance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct()
	{
		add_action('plugins_loaded', [$this, 'init']);
	}

	public function init()
	{
		// add_action('elementor/controls/controls_registered', [$this, 'init_controls']);
		add_action('elementor/widgets/widgets_registered', [$this, 'init_widget']);
        add_action( 'elementor/elements/categories_registered', [$this,'init_category'] );
		require_once(__DIR__ . '/member-directory/member-search.php');

	}
	/**
	 * Init widget
	 */
	public function init_widget()
	{
    	require_once(__DIR__ . '/member-directory/member-directory.php');
		require_once(__DIR__ . '/event-list/event-list.php');
    	require_once(__DIR__ . '/resource-list/resource-list.php');
    	require_once(__DIR__ . '/account/account.php');
    	require_once(__DIR__ . '/add-resource/add-resource.php');

	}
	/**
	 * Init category section
	 */
	public function init_category()
	{
		Elementor\Plugin::instance()->elements_manager->add_category(
			'cooalliance',
			[
				'title' => __('Cooalliance', 'hip')
			],
			1
		);
	}
}




Cooalliance_Elementor_Widgets::instance();
