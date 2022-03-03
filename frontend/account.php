<?php


/**
 * @ibrahim
 * user profile shortcode
 */

add_shortcode('cooalliance_account', 'cooallinace_user_shortcode');

function cooallinace_user_shortcode()
{
    /* Get user info. */
    global $current_user;

    if (is_user_logged_in()):
        $currentId = get_current_user_id();
        $userInfo = get_userdata($currentId);
//  echo "<pre>";
//  var_dump($userInfo);
        ?>

        <div class="container coo-user-acconut-wrapper" id="cooalliance_account">
            <div class="row">
                <div class="rounded col-12 col-md-3 bg-primary alert alert-primary">
                    <div class="pb-0 profile-sidebar">
                        <div class="mx-auto text-center profile-userpic">
                            <?php if (!empty($userInfo->image)): ?>
                                <img src="<?php echo $userInfo->image; ?>" class="img-fluid" alt="">
                            <?php else: ?>
                                <?php echo get_avatar($userInfo->ID, 'medium', '', 'member-profile', array('class' => array('img-fluid', 'rounded-circle'))); ?>
                            <?php endif; ?>
                        </div>
                        <div class="text-white profile-usertitle">
                            <div class="profile-usertitle-name">
                                <?php echo $userInfo->name . ' ' . $userInfo->display_name; ?>
                            </div>
                            <div class="profile-usertitle-job text-warning">
                                <?php echo $userInfo->company_name; ?>
                            </div>
                        </div>
                    </div>
                    <ul id="account_sidebar_nav" class="profile-usermenu nav flex-column ">
                        <li class="nav-item "><a class="text-white"
                                                 href="#account_overview"><?php esc_html_e('Overview', 'cooalliance') ?></a>
                        </li>
                        <li class="nav-item"><a class="text-white"
                                                href="#account_settings"><?php esc_html_e('Account Settings', 'cooalliance') ?></a>
                        </li>
                        <?php if (current_user_can('administrator')) { ?>
                            <li class="nav-item"><a class="text-white"
                                                    href="#account_resources_list"><?php _e("Resources", "cooalliance"); ?></a>
                            </li>
                        <?php } ?>
                        <li class="nav-item"><a class="text-white"
                                                href="#joined_events"><?php esc_html_e('Joined Events', 'cooalliance') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="py-3 d-block text-white"
                               href="<?php echo wp_logout_url(home_url() . '/login'); ?>">
                                <i class="glyphicon glyphicon-user"></i>
                                <?php esc_html_e('Logout', 'cooalliance') ?></a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-md-9 ">
                    <ul id="account_tab_content ">
                        <li id="account_overview">
                            <div class="profile-info">
                                <div class="profile-content px-5 py-3 rounded">
                                    <h3>
                                        <?php esc_html('Profile Overview', 'cooalliance'); ?>
                                    </h3>
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5><b><?php esc_html_e('Full Name:', 'cooalliance') ?></b></h5>
                                            <h5><?php echo $userInfo->name . ' ' . $userInfo->user_nicename; ?></h5>
                                        </div>
                                        <div class="col-md-6">
                                            <h5><b><?php esc_html_e('Email:', 'cooalliance') ?></b></h5>
                                            <h5><?php echo $userInfo->user_email; ?></h5>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5><b><?php esc_html_e('Title:', 'cooalliance') ?></b></h5>
                                            <h5><?php echo $userInfo->title; ?></h5>
                                        </div>
                                        <div class="col-md-6">
                                            <h5><b><?php esc_html_e('Company Name', 'cooalliance') ?></b></h5>
                                            <h5><?php echo $userInfo->company_name; ?></h5>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5><b><?php esc_html_e('Industry:', 'cooalliance') ?></b></h5>
                                            <h5><?php echo $userInfo->industry; ?></h5>
                                        </div>
                                        <div class="col-md-6">
                                            <h5><b><?php esc_html_e('Date Joined:', 'cooalliance') ?></b></h5>
                                            <h5><?php echo $userInfo->join_date; ?></h5>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5><b><?php esc_html_e('Cell Number:', 'cooalliance') ?></b></h5>
                                            <h5><?php echo $userInfo->cell_number; ?></h5>
                                        </div>
                                        <div class="col-md-6">
                                            <h5><b><?php esc_html_e('Address:', 'cooalliance') ?></b></h5>
                                            <h5><?php echo $userInfo->address; ?></h5>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5><b><?php esc_html_e('City:', 'cooalliance') ?></b></h5>
                                            <h5><?php echo $userInfo->city; ?></h5>
                                        </div>
                                        <div class="col-md-6">
                                            <h5><b><?php esc_html_e('State', 'cooalliance') ?></b></h5>
                                            <h5><?php echo $userInfo->state; ?></h5>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <h5><b><?php esc_html_e('Country:', 'cooalliance') ?></b></h5>
                                            <h5><?php echo $userInfo->country; ?></h5>
                                        </div>
                                        <div class="col-md-6">
                                            <h5><b><?php esc_html_e('Birth Date:', 'cooalliance') ?></b></h5>
                                            <h5><?php echo $userInfo->birthdate; ?></h5>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5><b><?php esc_html_e('About me:', 'cooalliance') ?></b></h5>
                                            <h5><?php echo $userInfo->about_me; ?></h5>
                                        </div>
                                        <div class="col-md-6">
                                            <h5><b><?php esc_html_e('Interests/Hobbies', 'cooalliance') ?></b></h5>
                                            <h5><?php echo $userInfo->interest_or_hobbies; ?></h5>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </li>
                        <li id="account_settings" style="display:none">
                            <ul>
                                <h3><?php esc_html_e('Account Settings', 'cooalliance') ?></h3>
                                <hr>
                                <br>
                                <?php
                                require_once(COOALLINACE_TOOLKIT_PATH . '/frontend/edit-profile.php');
                                ?>
                            </ul>
                        </li>
                        <?php if (current_user_can('administrator')) : ?>
                            <li id="account_resources_list" style="display:none">
                                <h3><a class="btn btn-primary"
                                       href="add-new-resources"><?php esc_html_e('Add New Resources', 'cooalliance') ?></a>
                                </h3>
                                <div class="user_resourse_table mt-3">
                                    <h4 class="py-3"><?php esc_html_e('Your Resources Lists', 'cooalliance') ?></h4>
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h5 class="text-center"><b><?php esc_html_e('Title', 'cooalliance') ?></b>
                                            </h5>
                                        </div>
                                        <div class="col-md-3">
                                            <h5 class="text-center">
                                                <b><?php esc_html_e('Resources Type', 'cooalliance') ?></b></h5>
                                        </div>
                                        <div class="col-md-3">
                                            <h5 class="text-center"><b><?php esc_html_e('Date', 'cooalliance') ?></b>
                                            </h5>
                                        </div>
                                        <div class="col-md-3">
                                            <h5 class="text-center"><b><?php esc_html_e('Action', 'cooalliance') ?></b>
                                            </h5>
                                        </div>
                                    </div>
                                    <br>

                                    <?php

                                    global $current_user;
                                    wp_get_current_user();

                                    $author_query = array('post_type' => 'resources', 'posts_per_page' => '-1', 'author' => $current_user->ID);
                                    $author_posts = new WP_Query($author_query);
                                    while ($author_posts->have_posts()) : $author_posts->the_post();
                                        $resource_type = get_post_meta(get_the_id(), 'resources_type', true);
                                        $text_group_fileds = get_field('text_group_fileds');
                                        ?>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <a class="text-primary" href="<?php the_permalink(); ?>"
                                                   title="<?php the_title_attribute(); ?>"><h5 class="text-center">
                                                        <b><?php the_title(); ?></b></h5></a>
                                            </div>
                                            <div class="col-md-3">
                                                <h5 class="text-center"><b><?php echo esc_attr($resource_type); ?></b>
                                                </h5>
                                            </div>
                                            <div class="col-md-3">
                                                <h5 class="text-center"><b><?php echo get_the_date('Y-m-d'); ?></b></h5>
                                            </div>
                                            <?php
                                            global $post;
                                            $postID = $post->ID;
                                            ?>
                                            <div class="col-md-3">
                                                <a target="_blank" href="./resource-update?post=<?php echo $postID; ?>">
                                                    <h5 class="text-center">
                                                        <b><?php esc_html_e('Edit', 'cooalliance') ?></b></h5></a>
                                            </div>
                                        </div>

                                    <?php
                                    endwhile;
                                    ?>
                                    <br>
                                </div>
                            </li>
                        <?php endif; ?>
                        <li id="joined_events" style="display:none">
                            <?php
                            $events = get_posts(array('post_type' => 'events', 'posts_per_page' => -1));
                            ?>
                            <div class="col-12  rounded">
                                <div class="card">
                                    <br>
                                    <h3>
                                        <?php esc_html('Your Joined Events', 'cooalliance'); ?>
                                    </h3>
                                    <hr>
                                    <br>
                                    <div class="row ">
                                        <div class="col-md-6">
                                            <h4 class="text-center"><b><?php esc_html_e('Title', 'cooalliance') ?></b>
                                            </h4>
                                        </div>
                                        <div class="col-md-6">
                                            <h4 class="text-center"><b><?php esc_html_e('Date', 'cooalliance') ?></b>
                                            </h4>
                                        </div>
                                    </div>
                                    <br>

                                    <?php
                                    foreach ($events as $event) {
                                        $joined_user = get_post_meta($event->ID, 'joinedUsers', true);
                                        $eventDeadLine = get_post_meta($event->ID, 'event_end_date_time', true);
                                        $current_user_id = get_current_user_id();
                                        ?>
                                        <?php
                                        if (!empty($joined_user) && in_array($current_user_id, $joined_user)) {
                                            ?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <a class="text-primary"
                                                       href="<?php echo get_permalink($event->ID); ?>"><h5
                                                                class="text-center">
                                                            <b><?php echo $event->post_title; ?></b></h5></a>
                                                </div>

                                                <div class="col-md-6">
                                                    <h5 class="text-center"><?php echo $eventDeadLine; ?></h5>
                                                </div>
                                            </div>

                                        <?php } ?>

                                    <?php } ?>
                                    <br>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    <?php
    else:
        echo "You cannot access this page ";
        wp_redirect('login.php');

    endif;


}
