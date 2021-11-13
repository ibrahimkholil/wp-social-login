<?php
namespace Elementor;

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
				$this->add_control(

						 'grid_style',
						 [
							 'label' => __( ' Style', 'cooalliance' ),
							 'type' => Controls_Manager::SELECT,
							 'default' => '1',
							 'options' => [
								 '1' => esc_html__( 'List style', 'cooalliance' ),
								 '2' => esc_html__( 'Grid style', 'cooalliance' ),
							 ],
						 ]
					 );
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

	}
private function member_layout_style_controls()
{
	$this->start_controls_section(
			'section_design_layout',
			[
				'label' => esc_html__( 'Layout', 'cooalliance' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
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

		$this->add_control(
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

		$this->add_control(
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
		$this->add_responsive_control(
			'card_padding',
			[
				'label' => esc_html__( 'Padding', 'cooalliance' ),
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
				'label' => esc_html__( 'Card body Padding', 'cooalliance' ),
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
		$this->end_controls_section();
}
	/**
	 * Render widget output on the frontend
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$user_per_page = $settings['user_per_page'];
		$grid_style = $settings['grid_style'];

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
								<a href="<?php echo get_author_posts_url( $member_info->ID, $nick_name ); ?>"	>
									<?php echo $nick_name; ?>
								</a>
									<?php if(!empty($user_image)): ?>


								  <img class="card-img-top" src="<?php echo $user_image; ?>" alt="Card image cap">
							  	<?php else: ?>
							    <?php echo get_avatar( $member_info->ID, 'medium', '', 'member-profile', array('class' => array('img-fluid', 'rounded-circle') )); ?>
							  	<?php endif; ?>
								  <div class="card-body">
										<?php if(!empty($nick_name)): ?>
											 <h5 class="card-title"><?php echo $nick_name; ?></h5>
										<?php endif; ?>
										<?php if(!empty($company)): ?>
											 <p class="card-text">Company: <?php echo $company; ?></hp>
										<?php endif; ?>
								  </div>
							</div>

			      	<?php endforeach; ?>
			      	<?php  else:?>
				         	<h4>Member Not Register Yet!</h4>
				     <?php endif; ?>
						 <?php
							if ($total_users > $total_query) {
							echo '<div id="pagination" class="clearfix">';
							echo '<span class="pages">Pages:</span>';
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
								<input type="submit" class="btn btn-primary" value="Search">
								</div>
				 </form>
            <?php
     return ob_get_clean();
	}

}
Plugin::instance()->widgets_manager->register_widget_type(new Cooalliance_Member_Directory_Elementor_Widget());
