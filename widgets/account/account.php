<?php
namespace Elementor;

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Schemes\Typography as Scheme_Typography;
use WP_Query;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/**
 * [Cooalliance_account_settings_Elementor_Widget]
 */
class Cooalliance_account_Elementor_Widget extends Widget_Base
{
    /**
     * construct
     */
    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);

    }


    /**
     * Get widget name
     * @return string
     */
    public function get_name()
    {

        return 'account-id';
    }

    /**
     * Get widget title
     * @return string
     */
    public function get_title()
    {
        return esc_html('Account ', 'cooalliance');
    }

    /**
     * Get widget icon
     * @return string|void
     */
    public function get_icon()
    {
        return 'eicon-my-account';
    }

    /**
     * Get widget category
     * @return array
     */

    public function get_categories()
    {
        return ['cooalliance'];
    }

    /**
     * Register widget controls
     */
    protected function _register_controls()
    {
        $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Avatar', 'cooalliance' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Avatar', 'cooalliance' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();

//        start style section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style Section',  'cooalliance' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .background',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __( 'Typography', 'cooalliance' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .typography a',
            ]
        );
        $this->end_controls_section();
        $this->account_image_style();
        $this->account_button_style();
//        style section ends here
    }
        /**
     * account image style
     */
    private function account_image_style(){
        $this->start_controls_section(
            'section_account_image',
            [
                'label' => esc_html__( 'Avatar Style', 'cooalliance' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_padding',
            [
                'label' => esc_html__( ' Padding', 'cooalliance' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .profile-userpic' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );



        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'     => 'account_image_border',
                'label'    => __('Border', 'cooalliance'),
                'selector' => '{{WRAPPER}} .profile-userpic',
            )
        );

        $this->add_control(
            'image_border_radius',
            array(
                'label'      => __('Border Radius', 'cooalliance'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} .profile-userpic' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'all_button_image_shadow',
                'selector' => '{{WRAPPER}} .profile-userpic',
            )
        );


        $this->end_controls_section();
    }

    private function account_button_style()
    {
        $this->start_controls_section(
            'section_button',
            [
                'label' => esc_html__('Button Style', 'cooalliance'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'button_text_color',
            array(
                'label'     => __('Button Text  Color', 'cooalliance'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .cooalliance_account' => 'background-color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'     => 'account_box_border',
                'label'    => __('Border', 'cooalliance'),
                'selector' => '{{WRAPPER}} .cooalliance_account',
            )
        );

        $this->add_control(
            'all_border_radius',
            array(
                'label'      => __('Border Radius', 'cooalliance'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} .cooalliance_account' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'all_button_box_shadow',
                'selector' => '{{WRAPPER}} .cooalliance_account',
            )
        );


        $this->end_controls_section();
    }


    /**
     * Render widget output on the frontend
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
//        global $current_user;

        if(is_user_logged_in()):
            $currentId = get_current_user_id();
            $userInfo = get_userdata($currentId);
            ?>

            <div class="container cooalliance_account" id="cooalliance_account">
                <div class="row">
                    <div class="rounded col-12 col-md-3 bg-primary alert alert-primary background typography">
                        <div class="pb-0 profile-sidebar">
                            <div class="mx-auto text-center profile-userpic">
                                <?php if(!empty($settings['image'])): ?>
                                    <?php echo wp_get_attachment_image( $settings['image']['id'], 'thumbnail', 'medium', '', 'member-profile', array('class' => array('img-fluid', 'rounded-circle')) );?>
                                <?php else: ?>
                                    <?php echo get_avatar( $userInfo->ID, 'medium', '', 'member-profile', array('class' => array('img-fluid', 'rounded-circle') )); ?>
                                <?php endif; ?>
                            </div>
                            <div class="text-white profile-usertitle">
                                <div class="profile-usertitle-name">
                                    <?php echo $userInfo->name .' '. $userInfo->display_name; ?>
                                </div>
                                <div class="profile-usertitle-job text-warning">
                                    <?php echo $userInfo->company_name; ?>
                                </div>
                            </div>
                        </div>
                        <ul id="account_sidebar_nav" class="profile-usermenu nav flex-column ">
                            <li class="nav-item"><a class="text-white" href="#account_overview"><?php esc_html_e('Overview','cooalliance')?></a></li>
                            <li class="nav-item"><a class="text-white" href="#account_settings"><?php esc_html_e('Account Settings','cooalliance')?></a></li>
                            <li class="nav-item" ><a class="text-white" href="#joined_events"><?php esc_html_e('Joined Events','cooalliance')?></a></li>
                            <li class="nav-item">
                                <a class="py-3 d-block text-white" href="<?php echo wp_logout_url( home_url().'/login' ); ?>">
                                    <i class="glyphicon glyphicon-user"></i>
                                    <?php esc_html_e('Logout','cooalliance')?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-9">
                        <ul id="account_tab_content ">
                            <li id="account_overview">
                                <div class="profile-info">
                                    <div class="profile-content px-5 py-3 rounded">
                                        <h3>
                                            <?php esc_html_e('Profile Overview','cooalliance');?>
                                        </h3>
                                        <hr>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5><b><?php esc_html_e('Full Name:','cooalliance')?></b></h5>
                                                <h5><?php echo $userInfo->name.' '.$userInfo->user_nicename; ?></h5>
                                            </div>
                                            <div class="col-md-6">
                                                <h5><b><?php esc_html_e('Email:','cooalliance')?></b></h5>
                                                <h5><?php echo $userInfo->user_email; ?></h5>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5><b><?php esc_html_e('Title:','cooalliance')?></b></h5>
                                                <h5><?php echo $userInfo->title; ?></h5>
                                            </div>
                                            <div class="col-md-6">
                                                <h5><b><?php esc_html_e('Company Name','cooalliance')?></b></h5>
                                                <h5><?php echo $userInfo->company_name; ?></h5>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5><b><?php esc_html_e('Industry','cooalliance')?></b></h5>
                                                <h5><?php echo $userInfo->industry; ?></h5>
                                            </div>
                                            <div class="col-md-6">
                                                <h5><b><?php esc_html_e('Date Joined:','cooalliance')?></b></h5>
                                                <h5><?php echo $userInfo->join_date; ?></h5>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5><b><?php esc_html_e('Cell Number:','cooalliance')?></b></h5>
                                                <h5><?php echo $userInfo->cell_number; ?></h5>
                                            </div>
                                            <div class="col-md-6">
                                                <h5><b><?php esc_html_e('City:','cooalliance')?></b></h5>
                                                <h5><?php echo $userInfo->city; ?></h5>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5><b><?php esc_html_e('State:','cooalliance')?></b></h5>
                                                <h5><?php echo $userInfo->state; ?></h5>
                                            </div>
                                            <div class="col-md-6">
                                                <h5><b><?php esc_html_e('Country:','cooalliance')?></b></h5>
                                                <h5><?php echo $userInfo->country; ?></h5>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5><b><?php esc_html_e('Birth Date:','cooalliance')?></b></h5>
                                                <h5><?php echo $userInfo->birthdate; ?></h5>
                                            </div>
                                            <div class="col-md-6">
                                                <h5><b><?php esc_html_e('Interests/Hobbies:','cooalliance')?></b></h5>
                                                <h5><?php echo $userInfo->interest_or_hobbies; ?></h5>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?php 
                                                    $about_me_content = $userInfo->about_me;
                                                    $trimmed_content=  wp_trim_words($about_me_content, 10, '... <a href="' . get_permalink() . '">more</a>');
                                                    ?>
                                                <h5><b><?php esc_html_e('About Me:','cooalliance')?></b></h5>
                                                <h5><?php echo $trimmed_content; ?></h5>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </li>
                            <li id="account_settings" style="display:none">
                                <ul>
                                    <h3><?php esc_html_e('Account Settings','cooalliance')?></h3>
                                    <hr>
                                    <br>
                                    <?php
                                    require_once(COOALLINACE_TOOLKIT_PATH . '/frontend/edit-profile.php' );
                                    ?>
                                </ul>
                            </li>
                            <li id="joined_events"  style="display:none">
                                <?php
                                    $events = get_posts( array( 'post_type' => 'events', 'posts_per_page' => -1 ) );
                                ?>
                                <div class="col-12  rounded">
                                    <div class="card">
                                        <br>
                                        <h3><?php esc_html_e('Your Joined Events','cooalliance')?></h3>
                                        <hr>
                                        <br>
                                        <div class="row ">
                                            <div class="col-md-6">
                                                <h4 class="text-center"><b><?php esc_html_e('Title','cooalliance')?></b></h4>
                                            </div>
                                            <div class="col-md-6">
                                                <h4 class="text-center"><b><?php esc_html_e('Date','cooalliance')?></b></h4>
                                            </div>
                                        </div>
                                        <br>

                                        <?php
                                        foreach ($events as $event){
                                            $joined_user = get_post_meta($event->ID, 'joinedUsers', true);
                                            $eventDeadLine = get_post_meta($event->ID,'event_end_date_time',true);
                                            $current_user_id = get_current_user_id();
                                            ?>
                                            <?php
                                            if (!empty($joined_user) && in_array(  $current_user_id, $joined_user)) {
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <a class="text-primary" href="<?php echo get_permalink($event->ID); ?>"><h5 class="text-center"><b><?php  echo $event->post_title;?></b></h5></a>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <h5 class="text-center"><?php  echo $eventDeadLine;?></h5>
                                                    </div>
                                                </div>

                                            <?php } ?>

                                        <?php	} ?>
                                        <br>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div> <!-- div#tabsAndContent -->
        <?php
        else:
            echo "<?php esc_html_e('You cannot access to this page!','cooalliance')?>";
            wp_redirect('login.php');

        endif;


    }
}
Plugin::instance()->widgets_manager->register_widget_type(new Cooalliance_account_Elementor_Widget());
