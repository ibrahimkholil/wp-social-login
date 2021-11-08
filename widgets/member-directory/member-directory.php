<?php
namespace Elementor;

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

class Cooalliance_Member_Directory_Elementor_Widget extends Widget_Base
{
	/**
	 * construct
	 */
	public function __construct($data = [], $args = null)
	{
		parent::__construct($data, $args);
		//add_action('elementor/frontend/after_register_styles', [$this,'hip_team_style']);
		wp_register_style('cooalliance-member-widget-css', 'https://cdn.jsdelivr.net/npm/datatables@1.10.18/media/css/jquery.dataTables.min.css');
		wp_register_script('cooalliance-member-table-js', 'https://cdn.jsdelivr.net/npm/datatables@1.10.18/media/js/jquery.dataTables.min.js',array( 'jquery' ));
		wp_register_script('cooalliance-member-custom-js', plugins_url( 'assets/js/member-script.js', __FILE__ ),array( 'jquery' ));

	}

	public function get_style_depends() {
		return ['cooalliance-member-widget-css'];
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

		<div class="cooalliance-wrapper ">
			<div class="cooalliance-container elementor-grid ">
        <section class="register-member-section container">
          	<div class="register-members row">
          		<?php
          		$memberInfo = array(
          			'role'    => 'subscriber',
          			'order'   => 'ASC'
          		);
          		$usersInfo = get_users( $memberInfo );
          		if(!empty($usersInfo)):
          		foreach ($usersInfo as $memberInfo):
          			$fullName = get_user_meta( $memberInfo->ID, 'nickname', true);
          			$company_name = get_user_meta( $memberInfo->ID, 'company_name', true);
          			$userPhoto = get_user_meta( $memberInfo->ID, 'image', true);

          			?>
          			<div class="member-item text-center rounded ">
          			    <?php if(!empty($userPhoto)): ?>
          			    <img src="<?php echo $userPhoto; ?>" class="img-fluid rounded-circle" alt="user Photo" width="96" height="96" style="height: 96px;object-fit: cover;">
          			    <?php else: ?>
          			    <?php echo get_avatar( $memberInfo->ID, 'medium', '', 'member-profile', array('class' => array('img-fluid', 'rounded-circle') )); ?>
          			    <?php endif; ?>
          				<?php if(!empty($fullName)): ?>
          					<h4><?php echo $fullName; ?></h4>
          				<?php endif; ?>
          				<?php if(!empty($company_name)): ?>
          				<h6>Company: <?php echo $company_name; ?></h6>
          				<?php endif; ?>
          			</div>
          		<?php endforeach; else:?>
          			<h4>Member Not Register Yet!</h4>
          		<?php endif; ?>
          	</div>
          </section>
          <?php


          $memberInfo = array(
            'role'    => 'subscriber',
            'order'   => 'ASC'
          );


          ?>
          <table id="listUsers">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Company</th>
                        <th>Address</th>
                        <th>Country</th>
                        <th>Joined Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $usersInfo = get_users( $memberInfo );
                    if(!empty($usersInfo)):
                    foreach ($usersInfo as $memberInfo):
                      $fullName = get_user_meta( $memberInfo->ID, 'nickname', true);
                      $company_name = get_user_meta( $memberInfo->ID, 'company_name', true);
                      $userPhoto = get_user_meta( $memberInfo->ID, 'image', true);
                      ?>
                        <tr>
                            <td><?php echo $memberInfo->display_name; ?></td>
                            <td>
                              <?php if(!empty($userPhoto)): ?>
                    			    <img src="<?php echo $userPhoto; ?>" class="img-fluid rounded-circle" alt="user Photo" width="96" height="96" style="height: 96px;object-fit: cover;">
                    			    <?php else: ?>
                    			    <?php echo get_avatar( $memberInfo->ID, 'medium', '', 'member-profile', array('class' => array('img-fluid', 'rounded-circle') )); ?>
                    			    <?php endif; ?>
                            </td>
                            <td><?php ?></td>
                            <td><?php  ?></td>
                            <td><?php  ?></td>
                            <td>$<?php  ?></td>
                        </tr>
                      <?php endforeach; else:?>
                  			<h4>Member Not Register Yet!</h4>
                  		<?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Image</th>
                      <th>Title</th>
                      <th>Company</th>
                      <th>Address</th>
                      <th>Country</th>
                      <th>Joined Date</th>
                    </tr>
                </tfoot>
            </table>
			</div>


		</div>


		<?php
	}

}
Plugin::instance()->widgets_manager->register_widget_type(new Cooalliance_Member_Directory_Elementor_Widget());
