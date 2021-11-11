<?php
 /**
  * Member_Search class
  * 
  */
class Member_Search{
    public function __construct()
    {
        add_action('wp_ajax_member_search_filter' , [$this,'member_search_filter']);
        add_action('wp_ajax_nopriv_member_search_filter',[$this,'member_search_filter']);
        add_action('wp_enqueue_scripts',[$this,'member_scripts']);
    }
    public function member_scripts(){
        wp_enqueue_script('cooalliance-member-search', plugins_url( 'assets/js/member-script.js', __FILE__ ),array( 'jquery' ));
        wp_localize_script( 'cooalliance-member-search', 'member_search_obj',
            array(
                'ajax_url' => admin_url( 'admin-ajax.php' ),
                'nonce'    => wp_create_nonce('member-search-filter-nonce')
            ));
    }
    public function member_search_filter()
    {
        if(!check_ajax_referer( 'member-search-filter-nonce', 'security', false)){
            echo 'Nonce not varified';
            wp_die();
        }else{
            // $department = '';
            // $session = '';
            // if(isset($_POST['department'])){
            //     $department = sanitize_text_field($_POST['department']);
            // }
            // if(isset($_POST['session'])){
            //     $session = sanitize_text_field($_POST['session']);
            // }
            if ( isset($_POST["search_term"]) ) {
                $search_term = $_POST["search_term"];
            } 
            $user_search_args = array (
                'order'      => 'ASC',
                'orderby'    => 'display_name',
                'search'     => '*' . esc_attr( $search_term ) . '*',
                'meta_query' => array(
                    'relation' => 'OR',
                    array(
                        'key'     => 'first_name',
                        'value'   => $search_term,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key'     => 'last_name',
                        'value'   => $search_term,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key'     => 'title',
                        'value'   => $search_term ,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key'     => 'company_name',
                        'value'   => $search_term ,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key'     => 'industry',
                        'value'   => $search_term ,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key'     => 'join_date',
                        'value'   => $search_term ,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key'     => 'birthdate',
                        'value'   => $search_term ,
                        'compare' => 'LIKE'
                    )
                )
            );
            //$users = get_users( $user_search_args );
            $users = new WP_User_Query( $user_search_args );

            var_dump($users);
            if(!empty($users)){
                foreach ( $users as $user ) {
                    //var_dump($user->user_email);
                    // $session = $user->session;

                    $nick_name = get_user_meta( $user->ID, 'nickname', true);
					$company = get_user_meta( $user->ID, 'company_name', true);
					$user_image = get_user_meta( $user->ID, 'image', true);
                   ?>
                        <div class="col-12 col-md-4 col-lg-4 mb-3">
						<div class="member-item text-center rounded">
							<?php if(!empty($user_image)): ?>
							<img src="<?php echo $user_image; ?>" class="img-fluid rounded-circle" alt="user Photo" width="96" height="96" style="height: 96px;object-fit: cover;">
							<?php else: ?>
							<?php echo get_avatar( $user->ID, 'medium', '', 'member-profile', array('class' => array('img-fluid', 'rounded-circle') )); ?>
							<?php endif; ?>
							<?php if(!empty($nick_name)): ?>
								<h4><?php echo $nick_name; ?></h4>
							<?php endif; ?>
							<?php if(!empty($company)): ?>
								<h6>Company: <?php echo $company; ?></h6>
							<?php endif; ?>
						</div>
					</div>

               <?php };
                wp_die();
            }
            else{
                echo _e('No member data Found ','dumhall');
            }


        }
    }
}

new Member_Search();