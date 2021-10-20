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
				$metaUserValue = array();

				foreach ($_POST['formData'] as $key => $value) {
					$data[] = $value['name'];
					$metaUserValue[] = $value['value'];
				}
				$registerData = array_combine($data, $metaUserValue);
                
				if (!empty($registerData)) {
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
                        'title'=>$registerData['title'],
						'nickname' => $registerData['name'],
						// 'nickName' => $registerData['nickName'],
						
						'birthdate' => $registerData['dateOfBirth'],
						'address' => $registerData['address'],
						'cell_number' => $registerData['mobile'],
						'email' => $registerData['email'],
						'status' => 0
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
