<?php



class Profile_Update_Process{


	public function __construct() {
		add_action( 'wp_ajax_update_member_profile', [$this, 'update_member_profile']);
		add_action( 'wp_ajax_update_member_profile', array($this, 'update_member_profile' ));
	}

	/*
	 * update_member_profile ajax
	 * @mixed
	 */
	public function update_member_profile(){

		if(!check_ajax_referer( 'profile-update-form-nonce', 'security', false)){
			echo 'Nonce not varified';
			wp_die();
		}
		else{
			if( isset( $_POST[ 'formData' ] ) ) {

				$data = array();
				$meta_user_value = array();

				foreach ($_POST['formData'] as $key => $value) {
					$data[] = $value['name'];
					$meta_user_value[] = $value['value'];
				}
				$register_data = array_combine($data, $meta_user_value);

				if (!empty($register_data)) {
                            // $contactmethods['title'] = 'Title';
                            // $contactmethods['company_name'] = 'Company Name';
                            // $contactmethods['industry'] = 'Industry';
                            // $contactmethods['join_date'] = 'Date joined';
                            // $contactmethods['cell_number'] = 'Cell Number';
                            // $contactmethods['address'] = 'Address';
                            // $contactmethods['city'] = 'City';
                            // $contactmethods['state'] = 'State';
                            // $contactmethods['country'] = 'Country';
                            // $contactmethods['birthdate'] = 'Birthdate';
                            // $contactmethods['about_me'] = 'About Me';

					$metas = array(
                        'image'=>$register_data['image'],
                        'title'=>$register_data['title'],
						'nickname' => $register_data['name'],
						// 'nickName' => $register_data['nickName'],

						'birthdate' => $register_data['dateOfBirth'],
						'address' => $register_data['address'],
						'cell_number' => $register_data['mobile'],
						'industry' => $register_data['industry'],
						'city' => $register_data['city'],
						'country' => $register_data['country'],
						'email' => $register_data['email'],
                        'facebook' => $register_data['facebook'],
                        'linkedin' => $register_data['linkedin'],
						// 'status' => 0
					);

					$userId = get_current_user_id();


					if ($userId != NULL) {
						foreach ($metas as $key => $value) {
							update_user_meta($userId, $key, $value);
						}
					}

					echo json_encode(array('Status' => true, 'message' => 'Update Profile Success'));
					wp_die();
				} else {
					echo json_encode(array('Status' => false, 'message' => 'Update Profile Fails'));
					wp_die();
				}
			}
		}
	}


}

new Profile_Update_Process();
