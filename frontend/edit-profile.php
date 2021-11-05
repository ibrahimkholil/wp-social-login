<?php
/**
 * @Author ibrahim
 *
 * Allow users to update their profiles from Frontend.
 *
 */
?>
    <div class="cooalliance_user_profile_edit">
        <div class="edit-profile-inner">
        <?php
            $current_id = get_current_user_id();
            $user_info = get_userdata($current_id);
            ?>
            <?php if ( !is_user_logged_in() ) : ?>
                    <p class="warning">
                        <?php _e('You must be logged in to edit your profile.', 'profile'); ?>
                    </p><!-- .warning -->
            <?php else : ?>
                <form  accept-charset="utf-8" class="update-member-account-settings" >
												<div class="row mb-3">
													<div class="col-12 mb-3">
														<div class="er-field-wrap">
															<label for="name" class="float-left">NAME(<span>BLOCK LETTER</span>)</label>
															<input type="text" name="name" class="form-control input-lg er_name" required value="<?php echo $user_info->nickname; ?>"/>
														</div>
													</div>
													<div class="col-12">
														<div class="er-field-wrap">
															<label for="title" class="float-left">Title</label>
															<input type="text" name="title" class="form-control input-lg title"  value="<?php echo $user_info->title; ?>" />
														</div>
													</div>
												</div>
												<div class="row mb-3">
													<div class="col-xs-12 col-md-4">
														<div class="er-field-wrap">
															<label for="dateOfBirth" class="float-left">Date Of birth</label>
															<input type="date" name="dateOfBirth" class="form-control input-lg dateOfBirth"  value="<?php echo $user_info->birthdate?>" />
														</div>
													</div>


												</div>

												<div class="row mb-3">
													<div class="col-12">
														<div class="er-field-wrap">
															<label for="mobile" class="float-left">Mobile</label>
															<input type="tel" name="mobile" class="form-control input-lg mobile" value="<?php echo $user_info->cell_number; ?>"/>
														</div>
													</div>

												</div>

												<div class="row mb-3">
													<div class="col-12">
														<div class="er-field-wrap">
															<label for="email" class="float-left">Email</label>
															<input type="email" name="email" class="form-control input-lg email"  value="<?php echo $user_info->user_email; ?>"/>
														</div>
													</div>
												</div>
												<div class="row mt-5 mb-3">
													<div class="col-xs-6 col-md-12">
														<div class="register-btn-wrapper text-left">
															<button class="btn btn-lg btn-primary signup-btn rounded-0" type="submit">Update Account Settings</button>
														</div>
													</div>
												</div>

                                                <div class="status">
                                                <div class="status-success"></div>
											   <div class="status-error"></div>
                                                </div>
							</form>
            <?php endif;?>
        </div><!-- .entry-content -->
    </div><!-- .hentry .post -->
