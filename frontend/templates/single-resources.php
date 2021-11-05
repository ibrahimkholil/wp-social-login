<?php
/**
 * [get header]
 * @var single resources template
 */
get_header( );
 ?>

<div class="container">
  <div class="row">
    <div class="col col-lg-12">

<?php
  if ( have_posts() ) :
      ?>
      <?php
      /* Start the Loop */
      while ( have_posts() ) :
          the_post();
            $resource_type = get_post_meta(get_the_id(), 'resources_type', true);

            switch ($resource_type) {
              case 'Text':
                include plugin_dir_path( __FILE__ ) . 'template-parts/text.php';
                break;
              case 'Video':
                include plugin_dir_path( __FILE__ ) . 'template-parts/video.php';
                break;
              case 'URL':
                include plugin_dir_path( __FILE__ ) . 'template-parts/url.php';
                break;
              case 'Upload file':
                include plugin_dir_path( __FILE__ ) . 'template-parts/upload-file.php';
                break;
              default:
                  include plugin_dir_path( __FILE__ ) . 'template-parts/text.php';
                break;
            }
          ?>
          <?php
      endwhile;



  else :

  echo   esc_attr_e( 'there is not content ', 'cooalliance');

  endif;
?>

     </div>
   </div>
  </div>
 <?php get_footer(); ?>
