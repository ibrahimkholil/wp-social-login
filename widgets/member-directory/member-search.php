<?php

/**
 * Member_Search class
 *
 */
class Member_Search
{
    public function __construct()
    {
        add_action('wp_ajax_member_search_filter', [$this, 'member_search_filter']);
        add_action('wp_ajax_nopriv_member_search_filter', [$this, 'member_search_filter']);
        add_action('wp_enqueue_scripts', [$this, 'member_scripts']);
    }

    public function member_scripts()
    {
        wp_enqueue_script('cooalliance-member-search', plugins_url('assets/js/member-script.js', __FILE__), array('jquery'));
        wp_localize_script('cooalliance-member-search', 'member_search_obj',
            array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('member-search-filter-nonce')
            ));
    }

    //add custom meta fields to search query
    function add_my_custom_queries( $query ) {
        global $wpdb;
    
        //let's add the billing_coutry to our meta fields in our query
        $query->query_fields .= ', industry.meta_value';
    
        //now we add a left join to actually gather the billing country for our users
        $query->query_from .= " LEFT JOIN $wpdb->usermeta industry ON $wpdb->users.ID = ".
            "industry.user_id and industry.meta_key = 'industry'";
        
        //and the last step is ordering users based on the billing_country values, when present
        $query->query_orderby = ' ORDER BY billing_country.meta_value DESC';
    }

    public function member_search_filter()
    {
        if (!check_ajax_referer('member-search-filter-nonce', 'security', false)) {
            echo 'Nonce not varified';
            wp_die();
        } else {

            if (isset($_POST["search_term"])) {
                $search_term = $_POST["search_term"];
            }

            //add our function on top of the user_query
            // add_action( 'pre_user_query', 'add_my_custom_queries' );
            

            $meta_query = new WP_Meta_Query(
                array(
                    'relation' => 'OR',
                    array(
                        'key' => 'first_name',
                        'value' => $search_term,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => 'last_name',
                        'value' => $search_term,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => 'company_name',
                        'value' => $search_term,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => 'address',
                        'value' => $search_term,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => 'city',
                        'value' => $search_term,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => 'states',
                        'value' => $search_term,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => 'country',
                        'value' => $search_term,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => 'industry',
                        'value' => $search_term,
                        'compare' => 'LIKE'
                    )

                )
            );
            
            $meta = array(
                    'relation' => 'OR',
                    array(
                        'key' => 'first_name',
                        'value' => $search_term,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => 'last_name',
                        'value' => $search_term,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => 'company_name',
                        'value' => $search_term,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => 'address',
                        'value' => $search_term,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => 'city',
                        'value' => $search_term,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => 'states',
                        'value' => $search_term,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => 'country',
                        'value' => $search_term,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => 'industry',
                        'value' => $search_term,
                        'compare' => 'LIKE'
                    )
            );
            $user_search_args = array(
                'role' => 'member',
                'fields' => 'all_with_meta',
                'order' => 'ASC',
                'orderby' => 'last_name',
                // 'search' =>  $search_term,
                'meta_query' => $meta
            );

            $users = get_users( $user_search_args );
    //  $users = new WP_User_Query(  array(
    //     'role' => 'member',
    //     'orderby' => 'last_name',
    //     'order' => 'ASC',
    //     'search' => $search_term,
    //     'meta_query' => $meta_query
    // ) );
    //   var_dump($users); die();
            if (!empty($users)) {
                foreach ($users as $user) {
//               var_dump($user);
                    $user_meta_data = get_user_meta($user->ID);
                    $nick_name = get_user_meta($user->ID, 'nickname', true);
                    $company = ['company_name'];
                    $title = ['title'];
                    $first_name = get_user_meta( $user->ID, 'first_name', true);
                    $last_name = get_user_meta( $user->ID, 'last_name', true);
                    $company = get_user_meta($user->ID, 'company_name', true);
                    $user_image = get_user_meta($user->ID, 'image', true);
                    ?>
                    <div class="card cooalliance_member_list_card coo-member-wrapper">
                        <?php if (!empty($user_image)): ?>
                            <a href="<?php echo get_author_posts_url($user->ID, $nick_name); ?>">
                                <img class="card-img-top" src="<?php echo $user_image; ?>" alt="Card image cap">
                            </a>

                        <?php else: ?>
                            <a href="<?php echo get_author_posts_url($user->ID, $nick_name); ?>">
                                <?php echo get_avatar($user->ID, 'medium', '', 'member-profile', array('class' => array('img-fluid', 'rounded-circle'))); ?>
                            </a>
                        <?php endif; ?>
                        <div class="card-body">
                            <?php if(!empty($first_name)): ?>
                                <a href="<?php echo get_author_posts_url( $user->ID, $nick_name ); ?>"	>
                                    <h5 class="card-title"><?php echo $first_name .'<span style="padding: 2px"></span>'. $last_name; ?>
                                    </h5>
                                </a>
                            <?php endif; ?>
                            <?php if(!empty($company)): ?>
                                <p class="card-text">Company: <?php echo $company; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                <?php };
                wp_die();
            } else {
                echo _e('No member data Found ', 'cooalliance');
            }


        }
    }
}

new Member_Search();
