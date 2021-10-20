<?php
/**
 * @package     Cooalliance
 * @author      Ibrahim
*/


/*
  personal Information users
*/
//add_filter( 'user_contactmethods', 'add_extra_fields' );
function add_extra_fields( $contactmethods ) {
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
 // $contactmethods['interest_or_hobbies'] = 'Interests/Hobbies';
 // // $contactmethods['motherName'] = 'Mother\'s Name';
 // // $contactmethods['spouseName'] = 'Spouse\'s Name';
 // // $contactmethods['childrenNumber'] = 'Children Number';
 // // $contactmethods['son'] = 'Son';
 // $contactmethods['daughter'] = 'Daughter';
 // $contactmethods['phoneOfficeHome'] = 'Phone Office / Home';
 // $contactmethods['presentAddress'] = 'Present Address';
 // $contactmethods['permanentAddress'] = 'Permanent Address';
 // $contactmethods['mobile'] = 'Mobile Number';
 // $contactmethods['email'] = 'Email Address';
 //return $contactmethods;

}
?>
<?php
//remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

 //add_filter( 'option_show_avatars', '__return_false' );

add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
<h3><?php _e("Extra profile information", "blank"); ?></h3>

<table class="form-table">
  <tr>
            <th><label for="image">Profile Image</label></th>

            <td>
                <img class="cooalliance_image_preview" src="<?php echo esc_attr( get_the_author_meta( 'image', $user->ID ) ); ?>" style=" display: block;height:96px;margin-bottom:10px">
                <input type="text" name="image" id="image" value="<?php echo esc_attr( get_the_author_meta( 'image', $user->ID ) ); ?>" class="regular-text" />
                <input type='button' class="button-primary" value="Upload Image" id="cooalliance_uploadimage"/><br />
                <span class="description">Please upload your image for your profile.</span>
            </td>
        </tr>
  <tr>
     <th>
       <label for="title"><?php _e("Title"); ?></label>
     </th>
  <td>
      <input type="text" name="title" id="title" value="<?php echo esc_attr( get_the_author_meta( 'title', $user->ID ) ); ?>" class="regular-text" /><br />
  </td>
  </tr>
<tr>
  <th>
    <label for="company_name"><?php _e("Company Name"); ?></label>
  </th>
  <td>
      <input type="text" name="company_name" id="company_name" value="<?php echo esc_attr( get_the_author_meta( 'company_name', $user->ID ) ); ?>" class="regular-text" /><br />
  </td>
</tr>
<tr>
  <th>
    <label for="industry"><?php _e("Industry"); ?></label>
  </th>
  <td>
    <input type="text" name="industry" id="province" value="<?php echo esc_attr( get_the_author_meta( 'industry', $user->ID ) ); ?>" class="regular-text" /><br />

  </td>
</tr>
<tr>
  <th>
    <label for="join_date"><?php _e("Date joined"); ?></label>
  </th>
  <td>
    <input type="date" name="join_date" id="join_date" value="<?php echo esc_attr( get_the_author_meta( 'join_date', $user->ID ) ); ?>" class="regular-text" /><br />
  </td>
</tr>
<tr>
  <th>
    <label for="cell_number"><?php _e("Cell Number"); ?></label>
  </th>
  <td>
    <input type="text" name="cell_number" id="cell_number" value="<?php echo esc_attr( get_the_author_meta( 'cell_number', $user->ID ) ); ?>" class="regular-text" /><br />
  </td>
</tr>
<tr>
  <th>
    <label for="address"><?php _e("Address"); ?></label>
  </th>
  <td>
    <input type="text" name="address" id="address" value="<?php echo esc_attr( get_the_author_meta( 'address', $user->ID ) ); ?>" class="regular-text" /><br />
  </td>
</tr>
<tr>
  <th>
    <label for="city"><?php _e("City"); ?></label>
  </th>
  <td>
    <input type="text" name="city" id="city" value="<?php echo esc_attr( get_the_author_meta( 'city', $user->ID ) ); ?>" class="regular-text" /><br />
  </td>
</tr>
<tr>
  <th>
    <label for="state"><?php _e("State"); ?></label>
  </th>
  <td>
    <input type="text" name="state" id="state" value="<?php echo esc_attr( get_the_author_meta( 'state', $user->ID ) ); ?>" class="regular-text" /><br />
  </td>
</tr>
<tr>
  <th>
    <label for="country"><?php _e("Country"); ?></label>
  </th>
  <td>
    <input type="text" name="country" id="country" value="<?php echo esc_attr( get_the_author_meta( 'country', $user->ID ) ); ?>" class="regular-text" /><br />
  </td>
</tr>
<tr>
  <th>
    <label for="birthdate"><?php _e("Birthdate"); ?></label>
  </th>
  <td>
    <input type="date" name="birthdate" id="birthdate" value="<?php echo esc_attr( get_the_author_meta( 'birthdate', $user->ID ) ); ?>" class="regular-text" /><br />
  </td>
</tr>
<tr>
  <th>
    <label for="about_me"><?php _e("About Me"); ?></label>
  </th>
  <td>
    <textarea name="about_me" id="about_me" rows="8" cols="80">
    <?php echo esc_attr( get_the_author_meta( 'about_me', $user->ID ) ); ?>
  </textarea>
  </td>
</tr>
<tr>
  <th>
    <label for="interest_or_hobbies"><?php _e("Interests/Hobbies"); ?></label>
  </th>
  <td>
    <input type="text" name="interest_or_hobbies" id="interest_or_hobbies" value="<?php echo esc_attr( get_the_author_meta( 'interest_or_hobbies', $user->ID ) ); ?>" class="regular-text" /><br />
  </td>
</tr>
</table>
<?php }

add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {

if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }
update_user_meta( $user_id, 'image', $_POST['image'] );
update_user_meta( $user_id, 'title', $_POST['title'] );
update_user_meta( $user_id, 'company_name', $_POST['company_name'] );
update_user_meta( $user_id, 'industry', $_POST['industry'] );
update_user_meta( $user_id, 'cell_number', $_POST['cell_number'] );
update_user_meta( $user_id, 'join_date', $_POST['join_date'] );
update_user_meta( $user_id, 'address', $_POST['address'] );
update_user_meta( $user_id, 'city', $_POST['city'] );
update_user_meta( $user_id, 'state', $_POST['state'] );
update_user_meta( $user_id, 'country', $_POST['country'] );
update_user_meta( $user_id, 'birthdate', $_POST['birthdate'] );
update_user_meta( $user_id, 'about_me', $_POST['about_me'] );
update_user_meta( $user_id, 'interest_or_hobbies', $_POST['interest_or_hobbies'] );

}
// 5. Set the uploaded image as default gravatar.
add_filter( 'get_avatar_url', 'ayecode_get_avatar_url', 10, 3 );
function ayecode_get_avatar_url( $url, $id_or_email, $args ) {
	$id = '';
	if ( is_numeric( $id_or_email ) ) {
		$id = (int) $id_or_email;
	} elseif ( is_object( $id_or_email ) ) {
		if ( ! empty( $id_or_email->user_id ) ) {
			$id = (int) $id_or_email->user_id;
		}
	} else {
		$user = get_user_by( 'email', $id_or_email );
		$id = !empty( $user ) ?  $user->data->ID : '';
	}
	//Preparing for the launch.
	$custom_url = $id ?  get_user_meta( $id, 'image', true ) : '';

	// If there is no custom avatar set, return the normal one.
	if( $custom_url == '' || !empty($args['force_default'])) {
		return esc_url_raw( 'https://wpgd-jzgngzymm1v50s3e3fqotwtenpjxuqsmvkua.netdna-ssl.com/wp-content/uploads/sites/12/2020/07/blm-avatar.png' );
	}else{
		return esc_url_raw($custom_url);
	}
}


add_action( 'admin_head', function(){
echo "
<style>
.user-description-wrap,.user-profile-picture{
  display:none;
}
</style>";

} );
