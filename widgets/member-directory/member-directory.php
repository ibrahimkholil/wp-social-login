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


	}

	/**
	 * Render widget output on the frontend
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		
		?>

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				
				<div class="page-content">
				<?php 
				//echo $this->member_search_form();
				
				?>
				<form id="MemberSearchForm" method="POST">
                            <label>Search members by name or email:</label>
							<div class="input-group">
								<div class="form-outline">
									<input type="search" id="search-term" class="form-control" />
									
								</div>
								<input type="submit" class="btn btn-primary" value="Search">
								
				
								</div>
                            <!-- <input type="text" placeholder="Enter search term..." id="search-term" />
                            <input type="submit" value="Search" /> -->
			               </form>
					<!--/#user-search-form-->
					<div class="du-loader">
            				<div class="du-loader-inner">
            					<span class="du-loading-icon"></span>
            					<p class="du-loading-text">Member Searching....</p>
            				</div>
            			</div>
					<?php
						// user search query arguments
						
						// user query
						//$user_search_query = new \WP_User_Query( $user_search_args );
		
						// Get the results
						//$users = get_users($user_search_query);
		
						// Array of WP_User objects
						
					?>
					<div class="container">
                      
								<?php
								$member_info = array(
									'role'    => 'subscriber',
									'order'   => 'ASC',
									'number' => -1,
								);
								$users_info = get_users( $member_info );
								if(!empty($users_info)):
								?>
								<div class="row" id="search-filter-data">
								<?php 
								foreach ($users_info as $member_info):
								$nick_name = get_user_meta( $member_info->ID, 'nickname', true);
								$company = get_user_meta( $member_info->ID, 'company_name', true);
								$user_image = get_user_meta( $member_info->ID, 'image', true);
								?>
					<div class="col-12 col-md-4 col-lg-4 mb-3">
						<div class="member-item text-center rounded">
							<?php if(!empty($user_image)): ?>
							<img src="<?php echo $user_image; ?>" class="img-fluid rounded-circle" alt="user Photo" width="96" height="96" style="height: 96px;object-fit: cover;">
							<?php else: ?>
							<?php echo get_avatar( $member_info->ID, 'medium', '', 'member-profile', array('class' => array('img-fluid', 'rounded-circle') )); ?>
							<?php endif; ?>
							<?php if(!empty($nick_name)): ?>
								<h4><?php echo $nick_name; ?></h4>
							<?php endif; ?>
							<?php if(!empty($company)): ?>
								<h6>Company: <?php echo $company; ?></h6>
							<?php endif; ?>
						</div>
					</div>
			     	<?php endforeach; else:?>
					<h4>Member Not Register Yet!</h4>
				     <?php endif; ?>
					   </div>
				
						
					
				
				</div>
				<!--/.page-content-->
		

		
			</main>
			<!--/.site-main-->
		</div>
<!--/.content-area-->
   <?php
	}

	public function member_search_form()
	{
		ob_start();

        ?>
        <div class="member-search-filter-wrapper">
            <div class="search-filter-container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <form method="POST" id="MemberSearchForm" class="form-inline row">
                                <div class="form-gorup col">
								    <div class="form-check">
									<label class="form-check-label" for="name">
										Name
										</label>
										<input class="form-check-input" type="checkbox" value="" id="name">
									</div>
                                </div>
								<div class="form-gorup col">
								    <div class="form-check">
									<label class="form-check-label" for="title">
										Title
										</label>
										<input class="form-check-input" type="checkbox" value="" id="title">
									</div>
                                </div>
                                <div class="form-gorup col">
								    <div class="form-check">
									<label class="form-check-label" for="company_name">
									Company name
										</label>
										<input class="form-check-input" type="checkbox" value="" id="company_name">
									</div>
                                </div>
								<div class="form-gorup col">
								    <div class="form-check">
									<label class="form-check-label" for="industry">
									     Industry
										</label>
										<input class="form-check-input" type="checkbox" value="" id="industry">
									</div>
                                </div>
								<div class="form-gorup col">
								    <div class="form-check">
									<label class="form-check-label" for="join_date">
									     Join Date
										</label>
										<input class="form-check-input" type="checkbox" value="" id="join_date">
									</div>
                                </div><div class="form-gorup col">
								    <div class="form-check">
									<label class="form-check-label" for="birthdate">
									   Birth date
										</label>
										<input class="form-check-input" type="checkbox" value="" id="birthdate">
									</div>
                                </div>
                            </form>
                        </div>
                        <div class="du-loader">
            				<div class="du-loader-inner">
            					<span class="du-loading-icon"></span>
            					<p class="du-loading-text">Member Searching....</p>
            				</div>
            			</div>
                    </div>
                </div>
            </div>
        </div>
            <?php
     return ob_get_clean();
	}

}
Plugin::instance()->widgets_manager->register_widget_type(new Cooalliance_Member_Directory_Elementor_Widget());
