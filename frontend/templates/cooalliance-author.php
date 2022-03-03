<?php
get_header();
// Set the Current Author Variable $current_author
$current_author = ( isset( $_GET['author_name'] ) ) ? get_user_by( 'slug', $author_name ) : get_userdata( intval( $author ) );
$user_image = get_user_meta( $current_author->ID, 'image', true);
$user_job_title = get_user_meta( $current_author->ID, 'title', true);
$user_job_company = get_user_meta( $current_author->ID, 'company_name', true);
$user_country = get_user_meta( $current_author->ID, 'country', true);
$user_birthday = get_user_meta( $current_author->ID, 'birthdate', true);
$user_industry = get_user_meta( $current_author->ID, 'industry', true);
$user_phone = get_user_meta( $current_author->ID, 'cell_number', true);
$linkedin = get_user_meta( $current_author->ID, 'linkedin', true);
$facebook = get_user_meta( $current_author->ID, 'facebook', true);

?>
<?php
 // var_dump($current_author);
?>
<div class="container coo-author-wrapper">
  <div class="">
    <h1 class="pb-3">
      <?php echo apply_filters('author_page_heading', _e('Author Info', 'cooalliance')); ?>
    </h1>
  </div>
<div class="row">
  <div class="col-md-3">
    <div class="card">
          <div class="card-header">
            <?php if (!empty($user_image)): ?>
              <img  class="card-img-top rounded-circle" src="<?php echo $user_image;?>" alt="">
              <?php else:?>
                <img  class="card-img-top rounded-circle" src="<?php echo get_avatar_url( $current_author->ID, 'medium', '', 'member-profile', array('class' => array('img-fluid', 'm-auto rounded-circle') )); ?>" alt="">

            <?php endif; ?>
          </div>

        <div class="card-body">
          <div class="profile-left-info text-center">
            <h3 class="card-title"> <?php echo $current_author->first_name .'<span style="padding: 5px"></span>'. $current_author->last_name; ?></h3>
            <p class="card-text">
            <?php echo $user_job_company;?>
            </p>
          </div>


          <ul class="list-group list-group-flush">
          
         </ul>
        </div>
    </div>

  </div>
  <div class=" col-md-9">


      <div class="card">
          <div class="card-header">
              <h3>
                  <?php esc_html('User Info','cooalliance');?>
              </h3>
          </div>
          <div class="card-body bio-graph-info ">
              <div class="row">
                  <div class="col col-md-6 col-sm-12">
                      <p class="text-secondary">
                        <span><?php esc_html_e('First Name','cooalliance')?> </span>: <?php echo $current_author->first_name; ?>
                      </p>
                  </div>
                  <div class="col col-md-6 col-sm-12">
                      <p class="text-secondary">
                        <span><?php esc_html_e('Last Name','cooalliance')?> </span>: <?php echo $current_author->last_name;?>
                      </p>
                  </div>
                  <div class="col col-md-6 col-sm-12">
                      <p class="text-secondary">
                        <span><?php esc_html_e('Country','cooalliance')?> </span>: <?php echo $user_country; ?>
                      </p>
                  </div>
                  <div class="col col-md-6 col-sm-12">
                      <p class="text-secondary">
                        <span><?php esc_html_e('Birthday','cooalliance')?></span>: <?php echo $user_birthday;?>
                      </p>
                  </div>
                  <div class="col col-md-6 col-sm-12">
                        <p class="text-secondary">
                        <span><?php esc_html_e('Occupation','cooalliance')?> </span>: <?php echo $user_job_title;?>
                      </p>
                  </div>
                  <div class="col col-md-6 col-sm-12">
                        <p class="text-secondary">
                        <span><?php esc_html_e('Industry','cooalliance')?> </span>: <?php echo $user_industry;?>
                      </p>
                  </div>
                  <div class="col col-md-6 col-sm-12">
                      <p class="text-secondary">
                        <span><?php esc_html_e('Mobile','cooalliance')?> </span>: <?php echo $user_phone;?>
                      </p>
                  </div>
              </div>
              <br>
              <div class="row">
                  <div class="col col-md-6 col-sm-12">
                      <?php if(!empty($facebook)): ?>
                          <a target="_blank" href="<?php echo $facebook ?>" class="btn btn-primary"><?php esc_html_e('Facebook','cooalliance')?></a>
                      <?php endif; ?>
                      <?php if(!empty($linkedin)): ?>
                          <a target="_blank" href="<?php echo $linkedin ?>" class="btn btn-primary"><?php esc_html_e('LinkedIn','cooalliance')?></a>
                      <?php endif; ?>
                  </div>
              </div>
          </div>
      </div>
      <div>

      </div>
  </div>
</div>
</div>
<?php
get_footer();
