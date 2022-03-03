<?php
/**
 * @Author ibrahim
 *
 * Allow users to update their profiles from Frontend.
 *
 */

include_once ABSPATH . 'wp-admin/includes/media.php';
include_once ABSPATH . 'wp-admin/includes/file.php';
include_once ABSPATH . 'wp-admin/includes/image.php';
require_once (ABSPATH . 'wp-includes/pluggable.php');
?>
<div class="cooalliance_user_profile_edit coo-edit-profile-wrapper">
    <div class="edit-profile-inner">
        <?php
        $current_id = get_current_user_id();
        $user_info = get_userdata($current_id);
        ?>
        <?php if (!is_user_logged_in()) : ?>
            <p class="warning">
                <?php _e('You must be logged in to edit your profile.', 'profile'); ?>
            </p><!-- .warning -->
        <?php else : ?>
            <form accept-charset="utf-8" class="update-member-account-settings" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-12 mb-3">
                        <div class="er-field-wrap">
                            <label for="name"
                                   class="float-left"><?php esc_html_e('Profile Picture', 'cooalliance') ?></label>
                            <img class="cooalliance_image_preview" src="<?php echo  $user_info->image; ?>" style=" display: block;height:96px;margin-bottom:10px">
                            <input type="hidden" name="image" id="image" value="<?php  $user_info->image; ?>" class="regular-text" />
                            <input type='button' class="button-primary" value="Change Image" id="cooalliance_uploadimage"/><br />

                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="er-field-wrap">
                            <label for="name"
                                   class="float-left"><?php esc_html_e('NAME(BLOCK LETTER)', 'cooalliance') ?></label>
                            <input type="text" name="name" class="form-control input-lg er_name" required
                                   value="<?php echo $user_info->nickname; ?>"/>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="er-field-wrap">
                            <label for="title" class="float-left"><?php esc_html_e('Title', 'cooalliance') ?></label>
                            <input type="text" name="title" class="form-control input-lg title"
                                   value="<?php echo $user_info->title; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-xs-12 col-md-4">
                        <div class="er-field-wrap">
                            <label for="dateOfBirth"
                                   class="float-left"><?php esc_html_e('Date Of Birth', 'cooalliance') ?></label>
                            <input type="date" name="dateOfBirth" class="form-control input-lg dateOfBirth"
                                   value="<?php echo $user_info->birthdate ?>"/>
                        </div>
                    </div>


                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <div class="er-field-wrap">
                            <label for="mobile" class="float-left"><?php esc_html_e('Mobile', 'cooalliance') ?></label>
                            <input type="tel" name="mobile" class="form-control input-lg mobile"
                                   value="<?php echo $user_info->cell_number; ?>"/>
                        </div>
                    </div>

                </div>

                

                <div class="row mb-3">
                    <div class="col-12">
                        <div class="er-field-wrap">
                            <label for="email" class="float-left"><?php esc_html_e('Email', 'cooalliance') ?></label>
                            <input type="email" name="email" class="form-control input-lg email"
                                   value="<?php echo $user_info->user_email; ?>"/>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <div class="er-field-wrap">
                            <label for="industry" class="float-left"><?php esc_html_e('Industry', 'cooalliance') ?></label>
                            <input type="text" name="industry" class="form-control input-lg industry"
                                   value="<?php echo $user_info->industry; ?>"/>
                        </div>
                    </div>

                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <div class="er-field-wrap">
                            <label for="city" class="float-left"><?php esc_html_e('City', 'cooalliance') ?></label>
                            <input type="text" name="city" class="form-control input-lg city"
                                   value="<?php echo $user_info->city; ?>"/>
                        </div>
                    </div>

                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <div class="er-field-wrap">
                            <label for="country" class="float-left"><?php esc_html_e('Country', 'cooalliance') ?></label>
                            <input type="text" name="country" class="form-control input-lg country"
                                   value="<?php echo $user_info->country; ?>"/>
                        </div>
                    </div>

                </div>
                
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="er-field-wrap">
                            <label for="facebook" class="float-left"><?php _e( "Facebook","cooalliance" )?></label>
                            <input type="facebook" name="facebook" class="form-control input-lg facebook"
                                   value="<?php echo $user_info->facebook; ?>"/>

                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="er-field-wrap">
                            <label for="linkedin" class="float-left"><?php _e( "Linkedin","cooalliance" )?></label>
                            <input type="linkedin" name="linkedin" class="form-control input-lg linkedin"
                                   value="<?php echo $user_info->linkedin; ?>"/>

                        </div>
                    </div>
                </div>
                <div class="row mt-5 mb-3">
                    <div class="col-xs-6 col-md-12">
                        <div class="register-btn-wrapper text-left">
                            <button class="btn btn-lg btn-primary signup-btn rounded-0"
                                    type="submit"><?php esc_html_e('Update Account Settings', 'cooalliance') ?></button>
                        </div>
                    </div>
                </div>

                <div class="status">
                    <div class="status-success"></div>
                    <div class="status-error"></div>
                </div>
            </form>
        <?php endif; ?>
    </div><!-- .entry-content -->
</div><!-- .hentry .post -->
