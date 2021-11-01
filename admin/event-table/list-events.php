<?php

if (!class_exists('WP_List_Table')) {
	require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class ListEvents extends \WP_List_Table
{

	/**
	 * method __construct()
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * prepare items for table
	 */

	public function prepare_items()
	{
		// get ordering clause from query string
		$orderby = isset($_GET['orderby']) ? trim($_GET['orderby']) : 'time';
		$order = isset($_GET['order']) ? trim($_GET['order']) : 'desc';
		// set column headers
		$this->_column_headers = array($this->get_columns(), $this->get_hidden_columns(), $this->get_sortable_columns());
		// get data for table
		$this->items = $this->_get_data();
	}

	/**
	 * set columns for datatable
	 * @return array
	 */
	public function get_columns()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'eventDate' => 'Event Deadline Date',
			'registered' => 'Total Joined Members'
		);
	}

	/**
	 * set default column values
	 * @param array
	 * @param string
	 * @return mixed
	 */
	public function column_default($item, $column_name)
	{
		switch ($column_name) {
			case 'id':
			case 'title':
			case 'eventDate':
			case 'registered':
				return $item[$column_name];
			default:
				return 'No values';
		}
	}

	/**
	 * set hidden columns
	 * @return array
	 */
	public function get_hidden_columns()
	{
		return array('id');
	}

	/**
	 * set sortable columns
	 * @return array
	 */
	public function get_sortable_columns()
	{
		return array(
			'title' => array('title', false),
			'registered' => array('registered', true)
		);
	}

	/**
	 * get data for table
	 * @return array
	 */
	private function _get_data()
	{
		$data = array();
		//var_dump($data);
		$events = get_posts([
			'post_type' => 'events',
			'posts_per_page' => -1
		]);

		foreach ($events as $event){
			$users = get_post_meta($event->ID,'joinedUsers',true);
			$data[] = array(
				'id' => $event->ID,
				'title' => '<a class="row-title" href="admin.php?page=joined_members&event_id='.$event->ID.'">'.$event->post_title.'</a>',
				'eventDate' =>  get_post_meta($event->ID, 'event_end_date_time', true),
				'registered' => is_array($users) ? count($users) : 0
			);
		}
		return $data;
	}
}
