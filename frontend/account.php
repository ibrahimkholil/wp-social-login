<?php


 /**
  * @ibrahim
  * user profile shortcode
  */

 add_shortcode('cooalliance_account','cooallinace_user_shortcode');

 function cooallinace_user_shortcode(){
     /* Get user info. */
global $current_user;

if(is_user_logged_in()):
$currentId = get_current_user_id();
$userInfo = get_userdata($currentId);
//  echo "<pre>";
//  var_dump($userInfo);
?>

<div class="container" id="cooalliance_account">
  <div class="row">
     <div class="col-12 col-md-3 bg-primary rounded">
       <div class="profile-sidebar pb-0">
         <div class="profile-userpic text-center mx-auto">
           <img src="<?php echo $userInfo->image; ?>" class="img-fluid" alt="">
         </div>
         <div class="profile-usertitle text-white">
           <div class="profile-usertitle-name">
             <?php echo $userInfo->name .' '. $userInfo->display_name; ?>
           </div>
           <div class="profile-usertitle-job">
             <?php echo $userInfo->company_name; ?>
           </div>
         </div>


       </div>
       <ul id="account_sidebar_nav" class="profile-usermenu nav flex-column ">
  				<li class="nav-item "><a class="text-white" href="#account_overview">Overview</a></li>
  				<li class="nav-item"><a class="text-white" href="#account_settings">Account Settings</a></li>
  				<li class="nav-item" ><a class="text-white" href="#account_resources_list">Resources</a></li>
  				<li class="nav-item">
  				<a class="py-3 d-block text-white" href="<?php echo wp_logout_url( home_url().'/login' ); ?>">
  					<i class="glyphicon glyphicon-user"></i>
  				Logout</a>
  			</li>

  			</ul>
    </div>
    <div class="col-12 col-md-9 ">
      <ul id="account_tab_content ">
        <li id="account_overview">
          <div class="profile-info">
             <div class="profile-content px-5 py-3 rounded">
              <table class="table table-striped table-bordered">
                <tbody>
                <tr>
                  <td>Full Name:</td>
                  <td><?php echo $userInfo->name.' '.$userInfo->user_nicename; ?></td>
                </tr>
                <tr>
                  <td>Email Address:</td>
                  <td><?php echo $userInfo->user_email; ?></td>
                </tr>
                <tr>
                  <td>Title:</td>
                  <td><?php echo $userInfo->title; ?></td>
                </tr>
                <tr>
                  <td>Company Name:</td>
                  <td><?php echo $userInfo->company_name; ?></td>
                </tr>
                <tr>
                  <td>Industry:</td>
                  <td><?php echo $userInfo->industry; ?></td>
                </tr>
                <tr>
                  <td>Date joined:</td>
                  <td><?php echo $userInfo->join_date; ?></td>
                </tr>
                <tr>
                  <td>Cell Number:</td>
                  <td><?php echo $userInfo->cell_number; ?></td>
                </tr>
                <tr>
                  <td>Address:</td>
                  <td><?php echo $userInfo->address; ?></td>
                </tr>
                <tr>
                  <td>City:</td>
                  <td><?php echo $userInfo->city; ?></td>
                </tr>
                <tr>
                  <td>State:</td>
                  <td><?php echo $userInfo->state; ?></td>
                </tr>
                <tr>
                  <td>Country:</td>
                  <td><?php echo $userInfo->country; ?></td>
                </tr>
                <tr>
                  <td>Birthdate:</td>
                  <td><?php echo $userInfo->birthdate; ?></td>
                </tr>
                <tr>
                  <td>About Me:</td>
                  <td><?php echo $userInfo->about_me; ?></td>
                </tr>
                <tr>
                  <td>Interests/Hobbies:</td>
                  <td><?php echo $userInfo->interest_or_hobbies; ?></td>
                </tr>

              </tbody>
              </table>
            </div>
          </div>

        </li>

        <li id="account_settings" style="display:none">
          <ul>
            <h3>Account settings</h1>
            <?php
             require_once( COOALLINACE_TOOLKIT_PATH . 'frontend/edit-profile.php' );
             ?>
          </ul>
        </li>

        <li id="account_resources_list" style="display:none">

          <h3>Add New Resources</h3>
          <?php acf_form_head();?>
          <?php acf_form(array(
         'post_id'       => 'new_post',
         'post_title'	=> true,
         'new_post'      => array(
             'post_type'     => 'resources',
             'post_status'   => 'publish'
         ),
         'submit_value'  => 'Create new Resources'
     )); ?>
        </li>
      </ul>

    </div>
  </div>

</div> <!-- div#tabsAndContent -->
<?php
else:
   echo "You cannot access this page ";
   wp_redirect('login.php');

endif;


 }
