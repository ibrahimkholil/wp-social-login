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
  <div class="row">
    <div class="col col-lg-12 resources_archive_list_table">
      <table class="table  table-bordered ">
          <thead>
            <tr>
              <th scope="col">Title</th>
              <th scope="col">Resources type</th>
              <th scope="col">Date</th>
              <th scope="col">Author</th>
            </tr>
          </thead>
          <tbody>
      <?php
        if ( have_posts() ) :
            ?>
            <?php
            /* Start the Loop */
            while ( have_posts() ) :
                the_post();
                  $resource_type = get_post_meta(get_the_id(), 'resources_type', true);
                ?>
                <tr>
                  <td>
                    <a class="text-primary" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                  </td>
                    <td><?php echo esc_attr(   $resource_type );?></td>
                    <td><?php echo get_the_date( 'Y-m-d' ); ?></td>
                    <td><?php  echo get_the_author(); ?></td>
                </tr>
                <?php
            endwhile;

        else :

        echo   esc_attr_e( 'there is not content ', 'cooalliance');

        endif;
        ?>
      </tbody>
    </table>
    </div>
  </div>
</div>

 <?php get_footer(); ?>
