<?php
/**
 * [get header]
 * @var [header type]
 */
get_header( );
 ?>

<div class="container">
  <div class="row">
    <div class="col col-lg-12">
      <h3>Resources Lists</h3>
    </div>
  </div>
  <div class="row resources_archive_list_table">
      <?php
       $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
       $resources_arg = new WP_Query(
        [
          'post_type'        => 'resources',
          'posts_per_page'   => 10,
          'paged'=>$paged,
          'orderby'          => 'post_date',
          'order'            => 'DESC',
          'post_status'      => 'publish'
        ]
      );
        if ( have_posts() ) :
            ?>
            <?php
            /* Start the Loop */
            while (  $resources_arg->have_posts() ) :
              $resources_arg->the_post();
                  $resource_type = get_post_meta(get_the_id(), 'resources_type', true);
                ?>
                <div class="col col-md-4 mt-4">
                <div class="card ">

                  <h5 class="card-header">
                    <a class="text-primary" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                  </h5>
                    <div class="card-body">

                      <h6 class="card-subtitle mb-2 text-muted"><?php echo esc_attr(   $resource_type );?></h6>
                      <p class="card-text">
                      <small>Date: <?php echo get_the_date( 'Y-m-d' ); ?></small>
                      <small>By: <?php  echo get_the_author(); ?></small>
                       </p>

                    </div>
                    </div>
                  </div>
                <?php
            endwhile;

        else :

        echo   esc_attr_e( 'there is not content ', 'cooalliance');

        endif;
        ?>
          <div class="col-8 mx-auto">
                       <div class="pagination">
                           <?php
                         // echo cooalliance_pagination_nav();

                         $total_pages = $resources_arg->max_num_pages;

                        if ($total_pages > 1){

                            $current_page = max(1, get_query_var('paged'));

                            echo paginate_links(array(
                                'base' => get_pagenum_link(1) . '%_%',
                                'format' => '/page/%#%',
                                'current' => $current_page,
                                'total' => $total_pages,
                                'prev_text'    => __('« Previous'),
                                'next_text'    => __('Next »'),
                            ));
                        }  
                           ?>
                       </div>
                   </div>
  </div>
</div>

 <?php get_footer(); ?>
