<?php

defined('ABSPATH') or die("Cheating........Uh!!");


class Cooallinace_Toolkit_Admin
{
    function __construct()
    {
        $this->include_fiels();
        add_action('login_form', array($this, 'social_links'));
        add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
        add_action('admin_menu', array($this, 'init'));


    }

    public function admin_scripts($hook)
    {
        // wp_enqueue_media();
        if ($hook === 'profile.php' || $hook === 'user-edit.php') {
            wp_enqueue_script('cooalliance_admin_script', plugin_dir_url(__FILE__) . '/assets/js/admin.js', 'jQuery');

            add_thickbox();
            wp_enqueue_script('media-upload');
            wp_enqueue_media();
        }
    }

    public function include_fiels()
    {

        require_once COOALLINACE_TOOLKIT_DIR_ADMIN . 'inc/admin-page.php';
        require_once COOALLINACE_TOOLKIT_DIR_ADMIN . 'settings-fields/fields.php';
        require_once COOALLINACE_TOOLKIT_DIR_ADMIN . 'cpt/cpt.php';
        require_once COOALLINACE_TOOLKIT_DIR_ADMIN . 'inc/extra-user-fields.php';
        // event list table
        require_once(COOALLINACE_TOOLKIT_DIR_ADMIN . '/event-table/list-events.php');
        //event details
        require_once(COOALLINACE_TOOLKIT_DIR_ADMIN . '/event-table/event-details.php');
        //resources
        require_once(COOALLINACE_TOOLKIT_DIR_ADMIN . '/inc/resources/resources-functions.php');

    }

    /**
     * social login file
     *
     * @return void
     */
    public function social_links()
    {
        $msg = __('Login with Social Media', 'cooalliance-tooltik');
        echo "<h4><b>$msg</b></h4> <div>";


        $options = get_option('cooalliance_options');
        $cooalliance_google_app_id = $options['cooalliance_gc_id'];
        $cooalliance_linkedin_app_id = $options['cooalliance_lc_id'];

        if ($cooalliance_google_app_id) {
            include 'google.php';
        }
        if ($cooalliance_linkedin_app_id) {
            include 'linkedin.php';
        }
        echo '</div>';
    }

    public function init()
    {
        $this->joined_member_page();

    }

    /*
         * joined_member_page Option page
         * add join member menu
         * @return mixed
         */

		public function joined_member_page()
		{
			add_submenu_page(
				'edit.php?post_type=events',
				'Attendance',
				'Attendance',
				'manage_options',
				'joined_members',
				[$this,'joined_member_page_content']
			);
		}

		/*
         * joined_member_page_content Option page
         * Joined Member page content
         * @return mixed
         */

		public function joined_member_page_content()
		{?>
            <h1><?php _e("Attendance by events","cooalliance");?> </h1>
            <?php
			if (isset($_GET['event_id'])) {
				$this->event_details_table($_GET['event_id']);
				return;
			}
			$this->all_events_table();


    }

    /*
     * all Events Table list
     * Event list and joined member count
     * @return mixed
     */

    public function all_events_table()
    {
        $listEvents = new ListEvents();
        $listEvents->prepare_items();
        // var_dump($listEvents );
        ?>
        <div class="wrap">
            <div class="page-outer">
                <h2>Joined Members in Event</h2>
                <div class="event-list-content">
                    <?php $listEvents->display(); ?>
                </div>
            </div>
        </div>
        <?php
    }

    /*
     * event_details_table list
     * join member details
     * @return mixed
     */

    public function event_details_table($id)
    {
        $event = get_post($id);
        $listEventDetails = new EventDetails($event);
        $listEventDetails->prepare_items();
        ?>
        <div class="wrap">
            <div class="page-outer">
                <h2>Joined Members in <?php echo $event->post_title; ?></h2>
                <div class="cf7-dbt-content">
                    <?php $listEventDetails->display(); ?>
                </div>
            </div>
        </div>
        <?php

    }

}

new Cooallinace_Toolkit_Admin();
