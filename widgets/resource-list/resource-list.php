<?php
namespace Elementor;

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Schemes\Typography as Scheme_Typography;
use WP_Query;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Cooalliance_Resource_list_Elementor_Widget extends Widget_Base
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

        return 'resource-list-id';
    }

    /**
     * Get widget title
     * @return string
     */
    public function get_title()
    {
        return esc_html('Resource List ', 'cooalliance');
    }

    /**
     * Get widget icon
     * @return string|void
     */
    public function get_icon()
    {
        return 'eicon-post-list';
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
        // blog_post_grid_section
        $this->start_controls_section(
            'resource_section',
            [
                'label' => __('Resource Setting', 'cooalliance'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // number of post select
        $this->add_control(
            'resource_number',
            [
                'label' => __( 'No Of Resource To Show', 'cooalliance' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '3'  => __( '3', 'cooalliance' ),
                    '6' => __( '6', 'cooalliance' ),
                    '9' => __( '9', 'cooalliance' ),
                    '12' => __( '12', 'cooalliance' ),
                    '15' => __( '15', 'cooalliance' ),
                    '18' => __( '18', 'cooalliance' ),
                    '21' => __( '21', 'cooalliance' ),
                    '24' => __( '24', 'cooalliance' ),
                    '27' => __( '27', 'cooalliance' ),
                    '30' => __( '30', 'cooalliance' )
                ],
            ]
        );

        // number of post select
        $this->add_control(
            'paginate',
            [
                'label' => __( 'Show Pagination', 'cooalliance' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'cooalliance' ),
				'label_off' => esc_html__( 'Hide', 'cooalliance' ),
				'return_value' => 'yes',
				'default' => 'yes'
            ]
        );

        // number of post select
        $this->add_control(
            'column_number',
            [
                'label' => __( 'No Of Column To Show', 'cooalliance' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '1'  => __( 'One Column', 'cooalliance' ),
                    '3'  => __( 'Three Column', 'cooalliance' ),
                    '4' => __( 'Four Column ', 'cooalliance' )
                ],
            ]
        );

        //view all text
        $this->add_control(
            'resource_button_text',
            [
                'label' => __('Link Text', 'cooalliance'),
                'type' => Controls_Manager::TEXT,
                'default' => 'See More'
            ]
        );


        $this->end_controls_section();

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
                    '{{WRAPPER}} .card-body h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __( 'Typography', 'cooalliance' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .card-body h3',
            ]
        );
        $this->end_controls_section();
        $this->resource_list_box_style();
        $this->resource_image_style();
        $this->resource_button_style();
//        style section ends here
    }
    private function resource_list_box_style(){
        $this->start_controls_section(
            'section_resource_box',
            [
                'label' => esc_html__( 'Resource List Style', 'cooalliance' ),
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
                    '{{WRAPPER}} .card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
                    '{{WRAPPER}} .card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
                    '{{WRAPPER}} .card' => 'background-color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'     => 'resource_box_border',
                'label'    => __('Border', 'cooalliance'),
                'selector' => '{{WRAPPER}} .card',
            )
        );

        $this->add_control(
            'all_border_radius',
            array(
                'label'      => __('Border Radius', 'cooalliance'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} .card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'all_button_box_shadow',
                'selector' => '{{WRAPPER}} .card',
            )
        );


        $this->end_controls_section();
    }
    /**
     * resource image style
     */
    private function resource_image_style(){
        $this->start_controls_section(
            'section_resource_image',
            [
                'label' => esc_html__( 'Image Style', 'cooalliance' ),
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
                    '{{WRAPPER}} .card img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'     => 'resource_image_border',
                'label'    => __('Border', 'cooalliance'),
                'selector' => '{{WRAPPER}} .card img',
            )
        );

        $this->add_control(
            'image_border_radius',
            array(
                'label'      => __('Border Radius', 'cooalliance'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} .card img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'all_button_image_shadow',
                'selector' => '{{WRAPPER}} .card img',
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
                    '{{WRAPPER}} .card a ' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .card a ' => 'background-color: {{VALUE}};',
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
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'search_button_typography',
                'global'    => array(
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ),
                'selector'  => '{{WRAPPER}} .card .btn',

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



    <div class="container coo-resources-wrapper">
        <?php
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $resourceData = new WP_Query(
            [
                'post_type'        => 'resources',
                'posts_per_page' => esc_attr($settings['resource_number']),
                'paged' => $paged,
                'orderby'          => 'post_date',
                'post_status'      => 'publish'
            ]
        );
        ?>
        <div class="row coo-resources-card-wrapper">
            <?php if ($resourceData->have_posts()): while ($resourceData->have_posts()) : $resourceData->the_post(); ?>
                <?php if (esc_attr($settings['column_number']) == 3) {?>
                    <div class="col-md-4 coo-resource-wrapper">
                        <div class="card">
                            <?php if(has_post_thumbnail()): ?>
                                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>" class="card-img-top">
                            <?php endif; ?>
                            <div class="card-body">
                                <h3 class="resource_title title">
                                    <?php the_title(); ?>
                                </h3>
                                <div class="author">
                                    <h5>-<b><?php  echo get_the_author(); ?></b></h5>
                                </div>
                                <div><h5><?php esc_html_e('Posted On:','cooalliance')?> <span class="posted-on"><i class="fa fa-calendar" aria-hidden="true"></i> <?php the_time( get_option( 'date_format' ) ); ?></span></h5></div>
                                <br>
                                <br>
                                <br>
                                <p><?php the_excerpt(); ?></p>
                                <br>
                                <?php if( esc_attr( $settings['resource_button_text'] ) == true ) : ?>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php echo esc_attr( $settings['resource_button_text'] ); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if (esc_attr($settings['column_number']) == 4) {?>
                    <div class="col-md-3 coo-resource-wrapper">
                        <div class="card">
                            <?php if(has_post_thumbnail()): ?>
                                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>" class="card-img-top">
                            <?php endif; ?>
                            <div class="card-body">
                                <h3 class="resource_title title" style="color: <?php echo esc_attr( $settings['title_color'] ); ?>">
                                    <?php the_title(); ?>
                                </h3>
                                <div><h5><?php __('Posted on:', 'cooalliance'); ?> <span class="posted-on"><i class="fa fa-calendar" aria-hidden="true"></i> <?php the_time( get_option( 'date_format' ) ); ?></span></h5></div>
                                <br>
                                <p><?php the_excerpt(); ?></p>
                                <br>
                                <?php if( esc_attr( $settings['resource_button_text'] ) == true ) : ?>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php echo esc_attr( $settings['resource_button_text'] ); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if (esc_attr($settings['column_number']) == 1) {?>
                    <div class="col-md-12 coo-resource-wrapper">
                        <div class="card">
                            <?php if(has_post_thumbnail()): ?>
                                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>" class="card-img-top">
                            <?php endif; ?>
                            <div class="card-body">
                                <h3 class="resource_title title" style="color: <?php echo esc_attr( $settings['title_color'] ); ?>">
                                    <?php the_title(); ?>
                                </h3>
                                <div><h5><?php esc_html_e('Posted On','cooalliance')?> <span class="posted-on"><i class="fa fa-calendar" aria-hidden="true"></i> <?php the_time( get_option( 'date_format' ) ); ?></span></h5></div>
                                <br>
                                <p><?php the_excerpt(); ?></p>
                                <br>
                                <?php if( esc_attr( $settings['resource_button_text'] ) == true ) : ?>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php echo esc_attr( $settings['resource_button_text'] ); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            <?php endwhile;?>
            <?php if($settings['paginate']): ?>
            <!-- pagination -->
            <div class="pagination coo-pagination-wrapper resources-pagination">
                <?php 
                    echo paginate_links( array(
                        'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                        'total'        => $resourceData->max_num_pages,
                        'current'      => max( 1, get_query_var( 'paged' ) ),
                        'format'       => '?paged=%#%',
                        'show_all'     => false,
                        'type'         => 'plain',
                        'end_size'     => 2,
                        'mid_size'     => 1,
                        'prev_next'    => true,
                        'prev_text'    => sprintf( '<i></i> %1$s', __( '<< Prev', 'cooalliance' ) ),
                        'next_text'    => sprintf( '%1$s <i></i>', __( 'Next >>', 'cooalliance' ) ),
                        'add_args'     => false,
                        'add_fragment' => '',
                    ) );
                ?>
            </div>
            <?php endif; ?>
            <?php endif; ?>

        </div>

        
    </div>

        <?php
    }

}
Plugin::instance()->widgets_manager->register_widget_type(new Cooalliance_Resource_list_Elementor_Widget());
