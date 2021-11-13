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
        if ( have_posts() ) :
            ?>
            <?php
            /* Start the Loop */
            while ( have_posts() ) :
                the_post();
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
  </div>
</div>

 <?php get_footer(); ?>
