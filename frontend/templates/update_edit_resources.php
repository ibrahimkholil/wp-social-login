<?php
 acf_form_head();
 get_header( );
?>

<div class="container">
  <div class="row">
      <div class="col">
        <a class="btn btn-warning"href="/my-account">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
          </svg>
           My Account
         </a>
      </div>
  </div>
  <div class="row">
    <div class="col">
      <?php
      if( isset($_GET['action']) && $_GET['action'] == 'edit' ){
          // Show the form
        //  acf_form();
      }
       while ( have_posts() ) : the_post();
         acf_form(array(
            'post_id'       => $post_id = $_GET["post"],
            'post_title'    => true,
            'post_content'  => false,
            'submit_value'  => __('Update Resources')
        ));
        endwhile;
        ?>
    </div>

  </div>
</div>




<?php get_footer(); ?>
