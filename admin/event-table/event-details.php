<?php

if (!class_exists('WP_List_Table')) {
	require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class EventDetails extends \WP_List_Table
{
	/**
	 * table name for get data
	 * @var string
	 */
	private $event;

	/**
	 * method __construct()
	 */
	public function __construct($event)
	{
		parent::__construct(array(
			'ajax' => false
		));
		$this->event = $event;
	}

	/**
	 * prepare items for table
	 * @return void
	 */

	public function prepare_items()
	{
		// get ordering clause from query string
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
		$columns['id'] = 'ID';
		$columns['user_name'] = 'Member Name';
		$columns['user_email'] = 'Member Email';
		$columns['user_phone'] = 'Member Mobile Number';
		return $columns;
	}

	/**
	 * set default column values
	 * @param array
	 * @param string
	 * @return string
	 */
	public function column_default($item, $column_name)
	{
		switch ($column_name) {
			case 'id':
			case 'user_name':
			case 'user_email':
			case 'user_phone':
				return $item[$column_name];
			default:
				return 'Not Found';
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
			'user_name' => array('user_name', false),
			'user_email' => array('user_email', false),
			'user_phone' => array('user_phone', false)
		);
	}

	private function _get_data()
	{
		$data = array();
		$userIds = get_post_meta($this->event->ID,'joinedUsers',true);
     
		foreach ($userIds as $userId){
			$user = get_user_by('id',$userId);
			
			if(!empty($user->ID)):  
			$data[] = array(
				'id' => $user->ID,
				'user_name' => get_user_meta($user->ID, 'name', true),
				'user_email' => get_user_meta($user->ID, 'email', true), 
				'user_phone' => get_user_meta($user->ID, 'mobile', true),
			);
			endif;
		}
		return $data;
	}
}