<?php
namespace Elementor;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Schemes\Typography as Scheme_Typography;

acf_form_head();

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/**
 * [Cooalliance_account_settings_Elementor_Widget]
 */
class Cooalliance_add_resource_Elementor_Widget extends Widget_Base
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

        return 'add-resource-id';
    }

    /**
     * Get widget title
     * @return string
     */
    public function get_title()
    {
        return esc_html('Add Resource ', 'cooalliance');
    }

    /**
     * Get widget icon
     * @return string|void
     */
    public function get_icon()
    {
        return 'eicon-plus';
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
//        start style section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Title Style Section',  'cooalliance' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        //title color
        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'cooalliance' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .account_resource h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __( 'Typography', 'cooalliance' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .account_resource h2',
            ]
        );
        $this->end_controls_section();
        $this->resource_box_style();
        $this->resource_button_style();
//        style section ends here
    }

    private function resource_box_style(){
        $this->start_controls_section(
            'section_event_box',
            [
                'label' => esc_html__( 'Add Resource Form', 'cooalliance' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'card_padding',
            [
                'label' => esc_html__( 'Box Padding', 'cooalliance' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .account_resource' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'card_body_padding',
            [
                'label' => esc_html__( 'Box content Padding', 'cooalliance' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .account_resource' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'all_background_color',
            array(
                'label'     => __('Background Color', 'cooalliance'),
                'type'      => Controls_Manager::COLOR,
                'global'    => array(
                    'default' => Global_Colors::COLOR_ACCENT,
                ),
                'selectors' => array(
                    '{{WRAPPER}} .account_resource' => 'background-color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'     => 'event_box_border',
                'label'    => __('Border', 'cooalliance'),
                'selector' => '{{WRAPPER}} .account_resource',
            )
        );

        $this->add_control(
            'all_border_radius',
            array(
                'label'      => __('Border Radius', 'cooalliance'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} .account_resource' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'all_button_box_shadow',
                'selector' => '{{WRAPPER}} .account_resource',
            )
        );


        $this->end_controls_section();
    }

    private function resource_button_style()
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
                    '{{WRAPPER}} .card .btn ' => 'color: {{VALUE}};',
                ),
            )
        );
        $this->add_control(
            'button_background_color',
            array(
                'label'     => __('Button Background Color', 'cooalliance'),
                'type'      => Controls_Manager::COLOR,
                'global'    => array(
                    'default' => Global_Colors::COLOR_ACCENT,
                ),
                'selectors' => array(
                    '{{WRAPPER}} .acf-form .acf-button ' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .acf-form-submit .acf-button' => 'background-color: {{VALUE}};',
                ),
            )
        );
        $this->add_control(
            'button_hover_background_color',
            array(
                'label'     => __('Button Hover Background Color', 'cooalliance'),
                'type'      => Controls_Manager::COLOR,
                'global'    => array(
                    'default' => Global_Colors::COLOR_ACCENT,
                ),
                'selectors' => array(
                    '{{WRAPPER}} .card .btn:hover ' => 'background-color: {{VALUE}};',
                ),
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
    ?>
    <div class="container account_resource">
            <h2><?php esc_html_e('Add New Resource','cooalliance')?></h2>
            <div class="row">
                <div class="col">
                    <?php acf_form(array(
                        'post_id'       => 'new_post',
                        'post_title'	=> true,
                        'new_post'      => array(
                            'post_type'     => 'resources',
                            'post_status'   => 'publish'
                        ),
                        'submit_value'  => __('Create new Resources', 'cooalliance')
                    )); ?>
                </div>
            </div>
    </div>


        <?php
    }

}
Plugin::instance()->widgets_manager->register_widget_type(new Cooalliance_add_resource_Elementor_Widget());
