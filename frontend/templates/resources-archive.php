<?php
/**
 * [get header]
 * @var [header type]
 */
get_header( );
 ?>

<div class="container coo-resources-list-wrapper">
  <div class="row">
    <div class="col col-lg-12">
    <?php esc_html('Resources Lists','cooalliance');?>
    </div>
  </div>
  <div class="row resources_archive_list_table">
  <?php
       $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
       $per_page = 10;
       $offset_start = 0;  // initial offset
       $offset       = $paged ? ( $paged - 1 ) * $per_page + $offset_start : $offset_start;

       $resources_arg = new WP_Query(
        [
          'post_type'        => 'resources',
          'posts_per_page'   => $per_page,
          'paged'=>$paged,
          'offset'           => $offset,
          'orderby'          => 'post_date',
          'order'            => 'DESC',
          'post_status'      => 'publish'
        ]
      );

      $resources_arg->found_posts   = max( 0, $resources_arg->found_posts - $offset_start );
      $resources_arg->max_num_pages = ceil( $resources_arg->found_posts / $per_page );

        if ( $resources_arg->have_posts() ) :
            ?>
            <div class="container-fluid">
                <div class="card">
                  <div class="card-header d-flex">
                    <div class="col-5 "><?php _e("Resource Title", "cooalliance"); ?></div>
                    <div class="col-2"><?php _e("Resource Type", "cooalliance"); ?></div>
                    <div class="col-5"><?php _e("Resource Info", "cooalliance"); ?></div>
                  </div>
                <ul class="list-group list-group-flush">
            <?php
            
          /* Start the Loop */
          while (  $resources_arg->have_posts() ) :
            $resources_arg->the_post();
                $resource_type = get_post_meta(get_the_id(), 'resources_type', true);
              ?>
                  <li class="list-group-item d-flex">
                    <!-- <div class="d-flex justify-content-between  align-content-center text-center"> -->
                      <h5 class="align-self-center col-5">
                        <a class="text-primary" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                      </h5>
                      <h6 class="text-muted col-2"><?php echo esc_attr(   $resource_type );?></h6>
                        <div class="align-self-center"> 
                          <small><?php _e("on", "cooalliance"); ?> <?php echo get_the_date( 'Y-m-d' ); ?></small>
                          <small><?php _e("by", "cooalliance"); ?> <?php  echo get_the_author(); ?></small>
                        </div>
                    <!-- </div> -->
                  </li>
                   
                <?php
            endwhile;
            ?> 
             </ul>
              </div>
              </div>
         </div>
         <?php
        else :

        echo   esc_attr_e( 'there is no content ', 'cooalliance');

        endif;
        ?>

        <div class="col-8 mx-auto coo-pagination-wrapper resources-pagination">
                              <div class="pagination">
                                  <?php
                                // echo cooalliance_pagination_nav();

                                $total_pages = $resources_arg->max_num_pages;

                                if ($total_pages > 1){

                                    echo paginate_links(array(
                                        'base' => get_pagenum_link(1) . '%_%',
                                        'format' => 'page/%#%',
                                        'current' => $paged,
                                        'total' => $total_pages,
                                        // 'type'         => 'list',
								                        'prev_next'          => true,
                                        'prev_text'    => __('« Prev' , 'cooalliance'),
                                        'next_text'    => __('Next »', 'cooalliance'),
                                    ));
                                }  
                                  ?>
                              </div>
                          </div>
  </div>
</div>

 <?php get_footer(); ?>
