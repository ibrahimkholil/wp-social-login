<?php

/**
 * @ibrahim
 * user profile shortcode
 */
 require_once( COOALLINACE_TOOLKIT_PATH . 'frontend/account.php' );
 require_once( COOALLINACE_TOOLKIT_PATH . 'frontend/profile_update_process.php' );

add_action('wp_enqueue_scripts', 'cooalliance_frontend_styles' );

function cooalliance_frontend_styles(){
    wp_enqueue_style('cooalliance-user-account', COOALLINACE_TOOLKIT_URL . 'frontend/assets/css/user-account.css', array());
    wp_enqueue_style('cooalliance-user-account', COOALLINACE_TOOLKIT_URL . 'frontend/assets/css/single-event.css', array());
    wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' );
    wp_enqueue_script('cooalliance-user-tab', COOALLINACE_TOOLKIT_URL . 'frontend/assets/js/frontend.js', array('jquery'));
    wp_enqueue_script('profile-update-scripts',   COOALLINACE_TOOLKIT_URL .'frontend/assets/js/profile-update.js', ['jquery'],'', true);
    wp_enqueue_script('bootstrap-js',  'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js', ['jquery'],'', true);

    wp_localize_script( 'profile-update-scripts', 'profile_update_obj', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce('profile-update-form-nonce')
    ));
    wp_enqueue_script('eventJoinMetaBox', COOALLINACE_TOOLKIT_URL . 'frontend/assets/js/event-join-metabox.js', ['jquery'],'', true);

			wp_localize_script('eventJoinMetaBox', 'eventJoinMetaBoxObj', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'nonce'    => wp_create_nonce('event-join-meta-nonce')
			));
}
/**
 * [page template create]
 * @param  page template
 * @return mixed
 */
function cooalliance_register_template_page($templates){
  $templates[plugin_dir_path( __FILE__ ).'templates/add_new_resources.php'] = 'Add New Resources';
  return $templates;
}
add_filter('theme_page_templates', 'cooalliance_register_template_page');

/**
 * [register_redirect_page_templates description]
 * Redirect Templates
 * @mixed
 */
  function register_redirect_page_templates ($template) {
      $templates = plugin_dir_path( __FILE__ ) .'templates/';
  		if (is_page_template('add_new_resources.php'))
  			$template =   $templates . 'add_new_resources.php';
  		return $template;
  	}
  add_filter('page_template', 'register_redirect_page_templates');
/**
 * [added single even template by hook]
 * @var [event]
 */
add_filter( 'single_template', 'events_single_template', 99, 1 );

function events_single_template($single_template) {
     global $post;
     if ($post->post_type == 'events' ) {
       $single_template = trailingslashit( plugin_dir_path( __FILE__ ) ).'/templates/single-event.php';
      }
     if ($post->post_type == 'resources' ) {
       $single_template = trailingslashit( plugin_dir_path( __FILE__ ) ).'/templates/single-resources.php';
      }
     return $single_template;
  }

  /**
   * [archive_template ]
   *
   */
add_filter( 'archive_template','custom_archive_template',99,1 );
function custom_archive_template($archive_template){
  global $post;

       if ( is_post_type_archive ( 'resources' ) ) {
            $archive_template = dirname( __FILE__ ) . '/templates/resources-archive.php';
       }elseif (is_post_type_archive ( 'events' )) {
          $archive_template = dirname( __FILE__ ) . '/templates/events-archive.php';
      }
       return $archive_template;
}
/**
 * Added UserId into metaBox
 */
 function user_join_meta_box(){

	if(!check_ajax_referer( 'event-join-meta-nonce', 'security', false)){
		echo 'Nonce not varified';
		wp_die();
	}else{
	$userId = get_current_user_id();

	if(!empty($_POST['eventPostId']) ){
		$joinedUsers = get_post_meta($_POST['eventPostId'],'joinedUsers',true);

		if(is_array($joinedUsers)){

			if(in_array($userId,$joinedUsers)){
				echo json_encode(array('Status' => true, 'message' => 'You have already joined in the event'));
				wp_die();
			}else{
				array_push($joinedUsers,$userId);
				update_post_meta( $_POST['eventPostId'],  'joinedUsers', $joinedUsers);
				echo json_encode(array('Status' => true, 'message' => 'Thank you for Join This Event.'));
				wp_die();
			}
		}else{
			$joinedUsers = array($userId);
			update_post_meta( $_POST['eventPostId'],  'joinedUsers', $joinedUsers);
			echo json_encode(array('Status' => true, 'message' => 'Thank you for Join This Event.'));
			wp_die();
		}



	}else{
		echo json_encode(array('Status' => true, 'message' => 'Event Join Fail!'));
		wp_die();
		}
	}
}

add_action( 'wp_ajax_user_join_meta_box', 'user_join_meta_box');
add_action( 'wp_ajax_nopriv_user_join_meta_box', 'user_join_meta_box' );
