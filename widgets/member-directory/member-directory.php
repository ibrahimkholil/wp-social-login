<?php
namespace Elementor;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
/**
 * [Cooalliance_Member_Directory_Elementor_Widget]
 * member directory search filter widget
 */
class Cooalliance_Member_Directory_Elementor_Widget extends Widget_Base
{
	/**
	 * construct
	 */
	public function __construct($data = [], $args = null)
	{
		parent::__construct($data, $args);

		// wp_register_style('cooalliance-member-widget-css', 'https://cdn.jsdelivr.net/npm/datatables@1.10.18/media/css/jquery.dataTables.min.css');
		wp_register_script('cooalliance-member-custom-js', plugins_url( 'assets/js/member-script.js', __FILE__ ),array( 'jquery' ));

	}

	public function get_style_depends() {
		return ['cooalliance-member-widget-css'];
	}
  /**
   * [get_script_depends description]
   * @return [type] load js
   */
  public function get_script_depends()
  {
    	return ['cooalliance-member-table-js','cooalliance-member-custom-js'];
  }

	/**
	 * Get widget name
	 * @return string
	 */
	public function get_name()
	{

		return 'member-directory-id';
	}

	/**
	 * Get widget title
	 * @return string
	 */
	public function get_title()
	{
		return esc_html('Member Directory ', 'cooalliance');
	}

	/**
	 * Get widget icon
	 * @return string|void
	 */
	public function get_icon()
	{
		return 'eicon-library-open';
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
			  	'layout-section',
				  [
				  	'label'=>__('Layout','cooalliance'),
					'tab'=> \Elementor\Controls_Manager::TAB_CONTENT
				  ]
			  );
				// grid style
				// $this->add_control(

				// 		 'grid_style',
				// 		 [
				// 			 'label' => __( ' Style', 'cooalliance' ),
				// 			 'type' => Controls_Manager::SELECT,
				// 			 'default' => '1',
				// 			 'options' => [
				// 				 '1' => esc_html__( 'List style', 'cooalliance' ),
				// 				 '2' => esc_html__( 'Grid style', 'cooalliance' ),
				// 			 ],
				// 		 ]
				// 	 );
					 //show column
	 $this->add_responsive_control(
		 'columns',
		 [
			 'label' => __( 'Columns', 'cooalliance' ),
			 'type' => Controls_Manager::SELECT,
			 'default' => '3',
			 'tablet_default' => '2',
			 'mobile_default' => '1',
			 'options' => [
				 '1' => '1',
				 '2' => '2',
				 '3' => '3',
				 '4' => '4',
			 ],
			 'prefix_class' => 'elementor-grid%s-',
			 'frontend_available' => true,
			 'selectors' => [
				 '.elementor-msie {{WRAPPER}} .elementor-portfolio-item' => 'width: calc( 100% / {{SIZE}} )',
			 ],
		 ]
	 );
		 //posts per page
		 $this->add_control(
			 'user_per_page',
			 [
				 'label' => __( 'User Per page', 'cooalliance' ),
									 'type' => Controls_Manager::TEXT,

			 ]
		 );
		$this->end_controls_section();
		$this->member_layout_style_controls();
		$this->member_box_style();
		$this->member_image_style();
		$this->member_title_style();
		$this->member_subtitle_style();
		$this->member_pagination_style();
		$this->member_search_form_style();

	}
	/**
	 * layout controls
	 */
private function member_layout_style_controls()
{
	$this->start_controls_section(
			'section_design_layout',
			[
				'label' => esc_html__( 'Layout', 'cooalliance' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'item_gap',
			[
				'label' => esc_html__( 'Item Gap', 'cooalliance' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}' => '--grid-row-gap: {{SIZE}}{{UNIT}}; --grid-column-gap: {{SIZE}}{{UNIT}};',
				],
				'frontend_available' => true,
				'classes' => 'elementor-hidden',
			]
		);

		$this->add_responsive_control(
			'column_gap',
			[
				'label' => esc_html__( 'Columns Gap', 'cooalliance' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => ' --grid-column-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'row_gap',
			[
				'label' => esc_html__( 'Rows Gap', 'cooalliance' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'frontend_available' => true,
				'selectors' => [
					'{{WRAPPER}}' => '--grid-row-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->end_controls_section();
}
/**
* Member box style
*/
private function member_box_style(){
		$this->start_controls_section(
			'section_member_box',
			[
				'label' => esc_html__( 'Member Box', 'cooalliance' ),
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
					'{{WRAPPER}} .cooalliance_member_list_card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .cooalliance_member_list_card .card-body ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
								'{{WRAPPER}} .cooalliance_member_list_card' => 'background-color: {{VALUE}};',
						),
				)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
						'name'     => 'member_box_border',
						'label'    => __('Border', 'cooalliance'),
						'selector' => '{{WRAPPER}} .cooalliance_member_list_card',
				)
		);

		$this->add_control(
			'all_border_radius',
			array(
						'label'      => __('Border Radius', 'cooalliance'),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', '%' ),
						'selectors'  => array(
								'{{WRAPPER}} .cooalliance_member_list_card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
				)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
						'name'     => 'all_button_box_shadow',
						'selector' => '{{WRAPPER}} .cooalliance_member_list_card',
				)
		);


		$this->end_controls_section();
	}
	/**
* Member image style
*/
private function member_image_style(){
	$this->start_controls_section(
		'section_member_image',
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
				'{{WRAPPER}} .cooalliance_member_list_card a img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
			],
		]
	);



	$this->add_group_control(
		Group_Control_Border::get_type(),
		array(
					'name'     => 'member_image_border',
					'label'    => __('Border', 'cooalliance'),
					'selector' => '{{WRAPPER}} .cooalliance_member_list_card a img',
			)
	);

	$this->add_control(
		'image_border_radius',
		array(
					'label'      => __('Border Radius', 'cooalliance'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
							'{{WRAPPER}} .cooalliance_member_list_card a img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
			)
	);

	$this->add_group_control(
		Group_Control_Box_Shadow::get_type(),
		array(
					'name'     => 'all_button_image_shadow',
					'selector' => '{{WRAPPER}} .cooalliance_member_list_card a img',
			)
	);


	$this->end_controls_section();
}
/** 
 * Member title style
 * */ 

private function member_title_style(){
	$this->start_controls_section(
		'section_member_title',
		[
			'label' => esc_html__( 'Title', 'cooalliance' ),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);


	$this->add_responsive_control(
		'title_padding',
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
				'{{WRAPPER}} .cooalliance_member_list_card .card-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
			],
		]
	);
	$this->add_responsive_control(
		'title_spacing',
		array(
					'label'     => __('Bottom Spacing', 'cooalliance'),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
							'px' => array(
									'max' => 100,
							),
					),
					'default'   => array(
							'size' => 5,
							'unit' => 'px',
					),
					'selectors' => array(
							'{{WRAPPER}} .cooalliance_member_list_card .card-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					),

			)
	);


	$this->add_control(
		'title_color',
		array(
					'label'     => __('Color', 'cooalliance'),
					'type'      => Controls_Manager::COLOR,
					'global'    => array(
							'default' => Global_Colors::COLOR_SECONDARY,
					),
					'selectors' => array(
							'{{WRAPPER}} .card-body .card-title' => 'color: {{VALUE}};',
					),

			)
	);

	$this->add_control(
		'title_hover_color',
		array(
					'label'     => __('Hover Color', 'cooalliance'),
					'type'      => Controls_Manager::COLOR,
					'global'    => array(
							'default' => Global_Colors::COLOR_SECONDARY,
					),
					'selectors' => array(
							'{{WRAPPER}} .card-body a:hover .card-title' => 'color: {{VALUE}};',

					),

			)
	);

	$this->add_group_control(
		Group_Control_Typography::get_type(),
		array(
					'name'      => 'title_typography',
					'global'    => array(
							'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					),
					'selector'  => '{{WRAPPER}} .card-body .card-title',

			)
	);

	$this->end_controls_section();
}
/** 
 * Member Subtitle style
 * */ 

private function member_subtitle_style(){
	$this->start_controls_section(
		'section_member_subtitle',
		[
			'label' => esc_html__( 'Sub Title', 'cooalliance' ),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);


	$this->add_responsive_control(
		'subtitle_padding',
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
				'{{WRAPPER}} .cooalliance_member_list_card .card-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
			],
		]
	);

	$this->add_control(
		'subtitle_color',
		array(
					'label'     => __('Color', 'cooalliance'),
					'type'      => Controls_Manager::COLOR,
					'global'    => array(
							'default' => Global_Colors::COLOR_SECONDARY,
					),
					'selectors' => array(
							'{{WRAPPER}} .card-body .card-text' => 'color: {{VALUE}};',
					),

			)
	);

	
	

	$this->add_group_control(
		Group_Control_Typography::get_type(),
		array(
					'name'      => 'subtitle_typography',
					'global'    => array(
							'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					),
					'selector'  => '{{WRAPPER}} .card-body .card-text',

			)
	);

	$this->end_controls_section();
}
/** 
 * Member pagination style
 * */ 

private function member_pagination_style(){
	$this->start_controls_section(
		'section_member_pagination',
		[
			'label' => esc_html__( 'Pagination', 'cooalliance' ),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);
	$this->add_responsive_control(
		'pagination_padding',
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
				'{{WRAPPER}} #pagination' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
			],
		]
	);
	$this->add_responsive_control(
		'pagination_item_padding',
		[
			'label' => esc_html__( ' Item Padding', 'cooalliance' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px' ],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 50,
				],
			],
			'selectors' => [
				'{{WRAPPER}} #pagination .page-numbers li .page-numbers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
			],
		]
	);
	$this->add_control(
		'pagination_text_color',
		array(
					'label'     => __('Text Color', 'cooalliance'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
							'{{WRAPPER}} #pagination .page-numbers li .page-numbers' => 'color: {{VALUE}};',
					),
			)
	);
	$this->add_control(
		'pagination_text_hover_color',
		array(
					'label'     => __('Text hover Color', 'cooalliance'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
							'{{WRAPPER}} #pagination .page-numbers li .page-numbers:hover' => 'color: {{VALUE}};',
					),
			)
	);
	$this->add_control(
		'pagination_background_color',
		array(
					'label'     => __('Background Color', 'cooalliance'),
					'type'      => Controls_Manager::COLOR,
					'global'    => array(
							'default' => Global_Colors::COLOR_ACCENT,
					),
					'selectors' => array(
							'{{WRAPPER}} #pagination .page-numbers li .page-numbers ' => 'background-color: {{VALUE}};',
					),
			)
	);
	$this->add_control(
		'pagination_active_background_color',
		array(
					'label'     => __('Active Background Color', 'cooalliance'),
					'type'      => Controls_Manager::COLOR,
					'global'    => array(
							'default' => Global_Colors::COLOR_ACCENT,
					),
					'selectors' => array(
							'{{WRAPPER}} #pagination .page-numbers li .page-numbers.current ' => 'background-color: {{VALUE}};border-color: {{VALUE}};',
					),
			)
	);
	$this->add_control(
		'pagination_text_active_color',
		array(
					'label'     => __('Active Text  Color', 'cooalliance'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
							'{{WRAPPER}} #pagination .page-numbers li .page-numbers.current' => 'color: {{VALUE}};',
					),
			)
	);
	$this->add_group_control(
		Group_Control_Typography::get_type(),
		array(
					'name'      => 'pagination_typography',
					'global'    => array(
							'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					),
					'selector'  => '{{WRAPPER}} #pagination .page-numbers li .page-numbers',

			)
	);

	$this->end_controls_section();
}
/** 
 * Member pagination style
 * */ 

private function member_search_form_style(){
	$this->start_controls_section(
		'section_member_form',
		[
			'label' => esc_html__( 'Form', 'cooalliance' ),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);
	$this->add_control(
		'input_text_color',
		array(
					'label'     => __('Input Text  Color', 'cooalliance'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
							'{{WRAPPER}} #MemberSearchForm .input-group .form-outline input' => 'color: {{VALUE}};',
					),
			)
	);
	$this->add_control(
		'input_background_color',
		array(
					'label'     => __('Input Background Color', 'cooalliance'),
					'type'      => Controls_Manager::COLOR,
					'global'    => array(
							'default' => Global_Colors::COLOR_ACCENT,
					),
					'selectors' => array(
							'{{WRAPPER}} #MemberSearchForm .input-group .form-outline input ' => 'background-color: {{VALUE}};',
					),
			)
	);
	
	$this->add_group_control(
		Group_Control_Typography::get_type(),
		array(
					'name'      => 'search_input_typography',
					'global'    => array(
							'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					),
					'selector'  => '{{WRAPPER}} #MemberSearchForm .input-group .form-outline input',

			)
	);
	$this->add_group_control(
		Group_Control_Border::get_type(),
		array(
					'name'     => 'search_input_border',
					'label'    => __('Border', 'hip-posts'),
					'selector' => '{{WRAPPER}} #MemberSearchForm .input-group .form-outline input',
			)
	);


	$this->add_control(
		'button_text_color',
		array(
					'label'     => __('Button Text  Color', 'cooalliance'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
							'{{WRAPPER}} #MemberSearchForm .input-group .search-btn ' => 'color: {{VALUE}};',
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
							'{{WRAPPER}} #MemberSearchForm .input-group .search-btn ' => 'background-color: {{VALUE}};',
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
							'{{WRAPPER}} #MemberSearchForm .input-group .search-btn:hover ' => 'background-color: {{VALUE}};',
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
					'selector'  => '{{WRAPPER}} #MemberSearchForm .input-group .search-btn',

			)
	);
	$this->end_controls_section();
}
	/**
	 * Render widget output on th frontend
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$user_per_page = $settings['user_per_page'];
		// $grid_style = $settings['grid_style'];

	    $columns_desktop = ( ! empty( $settings['columns'] ) ? 'cooalliance-grid-desktop-' . $settings['columns'] : 'cooalliance-grid-desktop-3' );

		$columns_tablet = ( ! empty( $settings['columns_tablet'] ) ? ' cooalliance-grid-tablet-' . $settings['columns_tablet'] : 'cooalliance-grid-tablet-2' );

		$columns_mobile = ( ! empty( $settings['columns_mobile'] ) ? ' cooalliance-grid-mobile-' . $settings['columns_mobile'] : ' cooalliance-grid-mobile-1' );
		?>


				<?php
				echo $this->member_search_form();

				?>
              <div class="cooalliance_member_directory-wrapper">
					<!--/#user-search-form-->
					<div class="cooalliance-loader" style="display:none">
						<div class="cooalliance-loader-inner">
							<span class="cooalliance-loading-icon"></span>
							<p class="cooalliance-loading-text">Member Searching....</p>
						</div>
                    </div>

					<?php

					$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$number = sanitize_text_field(	$user_per_page);
					$offset = ($page - 1) * $number;
					$member_info = array(
						'role'    => 'subscriber',
						'order'   => 'ASC',
						'offset'    => $offset,
						'number' => 	$user_per_page,
					);

					$users = get_users( );
					$query = get_users( $member_info );
					$total_users = count($users);
					$total_query = count($query);
					$total_pages = intval($total_users / $user_per_page) + 1;
				

					if(!empty($query)):
					?>
				   	<div class="elementor-grid  <?php echo $columns_desktop.$columns_tablet.$columns_mobile ?>" id="search-filter-data">
							<?php
							foreach ($query as $member_info):
							$nick_name = get_user_meta( $member_info->ID, 'nickname', true);
							$company = get_user_meta( $member_info->ID, 'company_name', true);
							$user_image = get_user_meta( $member_info->ID, 'image', true);
							?>
							<div class="card cooalliance_member_list_card">
								<a class="d-block text-center w-100" href="<?php echo get_author_posts_url( $member_info->ID, $nick_name ); ?>">
									<?php if(!empty($user_image)): ?>
									<img class="card-img-top text-center" src="<?php echo $user_image; ?>" alt="Card image cap">
									</a>
									<?php else: ?>
								
									
							    <?php echo get_avatar( $member_info->ID, 'medium', '', 'member-profile', array('class' => array('img-fluid', 'm-auto rounded-circle') )); ?>
							  	<?php endif; ?>
								  <div class="card-body">
									<?php if(!empty($nick_name)): ?>
										<a href="<?php echo get_author_posts_url( $member_info->ID, $nick_name ); ?>"	>
												<h5 class="card-title"><?php echo $nick_name; ?>
												</h5>
										</a>
									<?php endif; ?>
									<?php if(!empty($company)): ?>
											<p class="card-text">Company: <?php echo $company; ?></hp>
									<?php endif; ?>
								  </div>
							</div>

			      	<?php endforeach; ?>
			      	<?php  else:?>
				         	<h4 class="mb-3">Member Not Register Yet!</h4>
				     <?php endif; ?>
					
	</div>
	<?php
							if ($total_users > $total_query) {
							echo '<div id="pagination" class="clearfix ">';
							//echo '<span class="pages">Pages:</span>';
							  $current_page = max(1, get_query_var('paged'));
							  echo paginate_links(array(
							    'base' => get_pagenum_link(1) . '%_%',
							    'format' => 'page/%#%/',
							    'current' => $current_page,
							    'total' => $total_pages,
							    'type'         => 'list',
								'prev_next'          => true,
					        'prev_text'          => __( '&laquo; Previous' ),
					        'next_text'          => __( 'Next &raquo;' ),
							    ));
							echo '</div>';
						}
					?>
	</div>
   <?php
	}

	public function member_search_form()
	{
		ob_start();

        ?>
				<form id="MemberSearchForm" method="POST">
							<label>Search members :</label>
							<div class="input-group">
								<div class="form-outline">
									<input type="search" id="search-term" class="form-control" />
								</div>
								<input type="submit" class="btn btn-primary search-btn" value="Search">
								</div>
				 </form>
            <?php
     return ob_get_clean();
	}

}
Plugin::instance()->widgets_manager->register_widget_type(new Cooalliance_Member_Directory_Elementor_Widget());
