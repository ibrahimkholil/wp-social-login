<?php


 /**
  * user profile shortcode
  */

 add_shortcode('cooalliance_account','cooallinace_user_shortcode');

 function cooallinace_user_shortcode(){
     /* Get user info. */
global $current_user;

if(is_user_logged_in()): ?>
<div  class="member-profile py-4" style="display: none;"> 
	<div class="container">
		<div class="row ">
			<div class="col-12">
				<div class="profile-info">
					<div class="row">
						<div class="col-12">
							<div class="profile-info">

								<?php
								$currentId = get_current_user_id();
								$userInfo = get_userdata($currentId);
                                // echo "<pre>";
                                // var_dump($userInfo);
								?>
								<div class="row">
									<div class="col-12 col-md-3">
										<div class="profile-sidebar pb-0">
											<div class="profile-userpic text-center">
												<img src="<?php echo $userInfo->image; ?>" class="img-fluid" alt="">
											</div>
											<div class="profile-usertitle">
												<div class="profile-usertitle-name">
													<?php echo $userInfo->name .' '. $userInfo->display_name; ?>
												</div>
												<div class="profile-usertitle-job">
													<?php echo $userInfo->company_name; ?>
												</div>
											</div>

											<div class="profile-usermenu">
												<ul class="nav">
													<li class="active d-block w-100">
														<a class="d-block py-3" href="<?php echo home_url().'/member-profile/' ?>">
															<i class="glyphicon glyphicon-home"></i>
															Overview </a>
													</li>
													<li class="d-block w-100">
														<a class="py-3 d-block" href="<?php echo home_url().'/profile-update' ?>">
															<i class="glyphicon glyphicon-user"></i>
															Account Settings </a>
													</li>
													<li class="d-block w-100">
														<a class="py-3 d-block" href="<?php echo wp_logout_url( home_url().'/login' ); ?>">
															<i class="glyphicon glyphicon-user"></i>
															Logout</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-12 col-md-9">
										<div class="profile-content px-5 py-3">
											<table>
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
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="cooalliance_account">
			<ul id="account_sidebar_nav" class="profile-usermenu">
				<li><a href="#account_overview">Overview</a></li>
				<li><a href="#account_settings">Account Settings</a></li>
				<li><a href="#account_post_list">Post List</a></li>
				<li>
				<a class="py-3 d-block" href="<?php echo wp_logout_url( home_url().'/login' ); ?>">
					<i class="glyphicon glyphicon-user"></i>
				Logout</a>
			</li>

			</ul>
			<ul id="account_tab_content">
				<li id="account_overview">
				<div class="profile-info">

						<?php
						$currentId = get_current_user_id();
						$userInfo = get_userdata($currentId);
						//  echo "<pre>";
						//  var_dump($userInfo);
						?>
						<div class="row">
							<div class="col-12 col-md-3">
								<div class="profile-sidebar pb-0">
									<div class="profile-userpic text-center">
										<img src="<?php echo $userInfo->image; ?>" class="img-fluid" alt="">
									</div>
									<div class="profile-usertitle">
										<div class="profile-usertitle-name">
											<?php echo $userInfo->name .' '. $userInfo->display_name; ?>
										</div>
										<div class="profile-usertitle-job">
											<?php echo $userInfo->company_name; ?>
										</div>
									</div>

									<!-- <div class="profile-usermenu">
										<ul class="nav">
											<li class="active d-block w-100">
												<a class="d-block py-3" href="<?php echo home_url().'/member-profile/' ?>">
													<i class="glyphicon glyphicon-home"></i>
													Overview </a>
											</li>
											<li class="d-block w-100">
												<a class="py-3 d-block" href="<?php echo home_url().'/profile-update' ?>">
													<i class="glyphicon glyphicon-user"></i>
													Account Settings </a>
											</li>
											<li class="d-block w-100">
												<a class="py-3 d-block" href="<?php echo wp_logout_url( home_url().'/login' ); ?>">
													<i class="glyphicon glyphicon-user"></i>
													Logout</a>
											</li>
										</ul>
									</div> -->
								</div>
							</div>
							<div class="col-12 col-md-9">
								<div class="profile-content px-5 py-3">
									<table>
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
						</div>
						</div>
				</li>
						
				<li id="account_settings">
					<ul>
						
						<h1>Account settings</h1>
                         <?php 
						 
						 require_once( COOALLINACE_TOOLKIT_PATH . 'frontend/edit-profile.php' );
						 ?>						
					</ul>
				</li>
						
				<li id="account_post_list">
					
				<h1>Post lists</h1>
					
				</li>
			</ul>
		</div> <!-- div#tabsAndContent -->
<?php
else:
   echo "You cannot access this page ";
   wp_redirect('login.php');

endif;


 }