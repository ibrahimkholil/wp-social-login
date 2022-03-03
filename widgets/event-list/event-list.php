<?php
namespace Elementor;

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Schemes\Typography as Scheme_Typography;
use WP_Query;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Cooalliance_Event_list_Elementor_Widget extends Widget_Base
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

        return 'event-list-id';
    }

    /**
     * Get widget title
     * @return string
     */
    public function get_title()
    {
        return esc_html('Event List ', 'cooalliance');
    }

    /**
     * Get widget icon
     * @return string|void
     */
    public function get_icon()
    {
        return 'eicon-date';
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
            'events_section',
            [
                'label' => __('Event Setting', 'cooalliance'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // number of post select
        $this->add_control(
            'events_number',
            [
                'label' => __( 'No Of Event To Show', 'cooalliance' ),
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

        // number of post select
        $this->add_control(
            'showold',
            [
                'label' => __( 'Hide Old Events', 'cooalliance' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'cooalliance' ),
				'label_off' => esc_html__( 'Hide', 'cooalliance' ),
				'return_value' => 'yes',
				'default' => 'yes'
            ]
        );

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

        //view all text
        $this->add_control(
            'event_button_text',
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
                'label' => __( 'Style Section',  'cooalliance' ),
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
                    '{{WRAPPER}} .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __( 'Title Typography', 'cooalliance' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .event_title',
            ]
        );
        //content color
        $this->add_control(
            'content_color',
            [
                'label' => __( 'Description Color', 'cooalliance' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .card p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => __( 'Description Typography', 'cooalliance' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .card p',
            ]
        );

        $this->end_controls_section();

        $this->event_box_style();
        $this->event_image_style();
        $this->event_button_style();
//        style section ends here
    }

    private function event_box_style(){
        $this->start_controls_section(
            'section_event_box',
            [
                'label' => esc_html__( 'Event Box', 'cooalliance' ),
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
                    '{{WRAPPER}} .cooalliance_events_list_card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
                    '{{WRAPPER}} .cooalliance_events_list_card ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
                    '{{WRAPPER}} .cooalliance_events_list_card' => 'background-color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'     => 'event_box_border',
                'label'    => __('Border', 'cooalliance'),
                'selector' => '{{WRAPPER}} .cooalliance_events_list_card',
            )
        );

        $this->add_control(
            'all_border_radius',
            array(
                'label'      => __('Border Radius', 'cooalliance'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} .cooalliance_events_list_card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'all_button_box_shadow',
                'selector' => '{{WRAPPER}} .cooalliance_events_list_card',
            )
        );


        $this->end_controls_section();
    }

    /**
     * event image style
     */
    private function event_image_style(){
        $this->start_controls_section(
            'section_event_image',
            [
                'label' => esc_html__( 'Image', 'cooalliance' ),
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
                    '{{WRAPPER}} .cooalliance_events_list_card img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );



        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'     => 'event_image_border',
                'label'    => __('Border', 'cooalliance'),
                'selector' => '{{WRAPPER}} .cooalliance_events_list_card img',
            )
        );

        $this->add_control(
            'image_border_radius',
            array(
                'label'      => __('Border Radius', 'cooalliance'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} .cooalliance_events_list_card img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'all_button_image_shadow',
                'selector' => '{{WRAPPER}} .cooalliance_events_list_card img',
            )
        );


        $this->end_controls_section();
    }

    private function event_button_style()
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
                    '{{WRAPPER}} .card .btn ' => 'background-color: {{VALUE}};',
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



    <div class="container cooalliance_events_list_card coo-events-list-wrapper">
        <?php
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        if($settings['showold'] == 'yes'){
            $eventData = new WP_Query(
                [
                    'post_type'        => 'events',
                    'posts_per_page' => esc_attr($settings['events_number']),
                    'paged' => $paged,
                    'orderby'          => 'post_date',
                    'order'            => 'DESC',
                    'post_status'      => 'publish'
                ]
            );
        }else{
            $eventData = new WP_Query(
                [
                    'post_type'        => 'events',
                    'posts_per_page' => esc_attr($settings['events_number']),
                    'paged' => $paged,
                    'orderby'          => 'post_date',
                    'order'            => 'DESC',
                    'post_status'      => 'publish',
                    'meta_query' => array(
                        array(
                            'key'     => 'event_end_date_time', 
                            'value'   => date('Y-m-d'), 
                            'compare' => '>=',
                            'type' => 'date'
                        )
                    )
                ]
            );
        }
        ?>
        <div class="row">
            <?php if ($eventData->have_posts()): while ($eventData->have_posts()) : $eventData->the_post(); ?>
                <?php $event_start_date = get_post_meta( get_the_ID(), 'event_start_date_time', true ); 
                    if(!empty($event_start_date)){
                        $event_start_date = date(get_option( 'date_format' ), strtotime($event_start_date)); 
                    }
                ?>
                <?php if (esc_attr($settings['column_number']) == 3) {?>
                    <div class="col-md-4">
                        <div class="card coo-event-card-wrapper">
                            <?php if(has_post_thumbnail()): ?>
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>" class="card-img-top coo-card-image" style="height:200px">
                                </a>
                            <?php endif; ?>
                            <div class="card-body">
                                <h3 class="event_title title" style="color: <?php echo esc_attr( $settings['title_color'] ); ?>">
                                    <?php the_title(); ?>
                                </h3>
                                <?php if(!empty($event_start_date)): ?>
                                <div><h5><?php __('Event Date: ', 'cooalliance'); ?> <span class="posted-on"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $event_start_date; ?></span></h5></div>
                                <br>
                                <?php endif; ?>
                                <p><?php echo substr( get_the_excerpt(), 0, 150 ); ?></p>
                                <br>
                                <?php if( esc_attr( $settings['event_button_text'] ) == true ) : ?>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php echo esc_attr( $settings['event_button_text'] ); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
            <?php } ?>
                <?php if (esc_attr($settings['column_number']) == 4) {?>
                    <div class="col-md-3">
                        <div class="card">
                            <?php if(has_post_thumbnail()): ?>
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>" class="card-img-top coo-card-image" style="height:200px">
                                </a>
                            <?php endif; ?>
                            <div class="card-body">
                                <h3 class="event_title title" style="color: <?php echo esc_attr( $settings['title_color'] ); ?>">
                                    <?php the_title(); ?>
                                </h3>
                                <?php if(!empty($event_start_date)): ?>
                                <div><h5><?php __('Event Date: ', 'cooalliance'); ?> <span class="posted-on"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $event_start_date; ?></span></h5></div>
                                <br>
                                <?php endif; ?>
                                <p><?php echo substr( get_the_excerpt(), 0, 150 ); ?></p>
                                <br>
                                <?php if( esc_attr( $settings['event_button_text'] ) == true ) : ?>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php echo esc_attr( $settings['event_button_text'] ); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if (esc_attr($settings['column_number']) == 1) {?>
                    <div class="col-md-12">
                        <div class="card coo-event-card-wrapper">
                            <?php if(has_post_thumbnail()): ?>
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>" class="card-img-top coo-card-image" style="height:200px">
                                </a>
                            <?php endif; ?>
                            <div class="card-body">
                                <h3 class="event_title title" style="color: <?php echo esc_attr( $settings['title_color'] ); ?>">
                                    <?php the_title(); ?>
                                </h3>
                                <?php if(!empty($event_start_date)): ?>
                                <div><h5><?php __('Event Date: ', 'cooalliance'); ?> <span class="posted-on"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $event_start_date; ?></span></h5></div>
                                
                                <?php endif; ?>
                                <p><?php echo substr( get_the_excerpt(), 0, 150 ); ?></p>
                                
                                <?php if( esc_attr( $settings['event_button_text'] ) == true ) : ?>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php echo esc_attr( $settings['event_button_text'] ); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php endwhile;  wp_reset_query(); endif; ?>
            <?php if($settings['paginate'] == "yes"): ?>
            <div class="col-8 mx-auto coo-pagination-wrapper events-pagination">
                       <div class="pagination">
                           <?php
                         // echo cooalliance_pagination_nav();

                         $total_pages = $eventData->max_num_pages;

                        if ($total_pages > 1){

                            $current_page = max(1, get_query_var('paged'));

                            echo paginate_links(array(
                                'base' => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                                // 'format' => 'page/%#%',
                                'current' => $current_page,
                                'total' => $total_pages,
                                'format'       => '?paged=%#%',
                                'show_all'     => false,
                                'type'         => 'plain',
                                'end_size'     => 2,
                                'mid_size'     => 1,
                                'prev_text'    => sprintf( '<i></i> %1$s', __( '<< Prev', 'cooalliance' ) ),
                                'next_text'    => sprintf( '%1$s <i></i>', __( 'Next >>', 'cooalliance' ) ),
                                'add_args'     => false,
                                'add_fragment' => '',
                            ));
                        }  
                           ?>
                       </div>
                   </div>
            <?php endif; ?>
        </div>
    </div>

        <?php
    }

}
Plugin::instance()->widgets_manager->register_widget_type(new Cooalliance_Event_list_Elementor_Widget());
