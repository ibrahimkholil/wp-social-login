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

?>
<?php
 // var_dump($current_author);
?>
<div class="container">
  <div class="">
    <h1 class="pb-3">
      <?php echo apply_filters('author_page_heading', 'Author Info'); ?>
    </h1>
  </div>
<div class="row">
  <div class="profile-nav col-md-3">
    <div class="card">
          <div class="card-header">
            <?php if (!empty($user_image)): ?>
              <img  class="card-img-top rounded-circle" src="<?php echo $user_image;?>" alt="">
              <?php else:?>
                <img  class="card-img-top rounded-circle" src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="">

            <?php endif; ?>
          </div>

        <div class="card-body">
          <div class="profile-left-info text-center">
            <h3 class="card-title"> <?php echo $current_author->nickname; ?></h3>
            <p class="card-text">
            <?php echo $user_job_company;?>
            </p>
          </div>


          <ul class="list-group list-group-flush">
           <li class="list-group-item">Profile</li>
           <li class="list-group-item">Recent Activity</li>

         </ul>
        </div>
    </div>

  </div>
  <div class="profile-info col-md-9">


      <div class="card">
          <div class="card-header">
              <h3>User Info</h3>
          </div>
          <div class="card-body bio-graph-info ">

              <div class="row">
                  <div class="col col-md-6 col-sm-12">
                      <p class="text-secondary">
                        <span>First Name </span>: <?php echo $current_author->first_name; ?>
                      </p>
                  </div>
                  <div class="col col-md-6 col-sm-12">
                      <p class="text-secondary">
                        <span>Last Name </span>: <?php echo $current_author->last_name;?>
                      </p>
                  </div>
                  <div class="col col-md-6 col-sm-12">
                      <p class="text-secondary">
                        <span>Country </span>: <?php echo $user_country; ?>
                      </p>
                  </div>
                  <div class="col col-md-6 col-sm-12">
                      <p class="text-secondary">
                        <span>Birthday</span>: <?php echo $user_birthday;?>
                      </p>
                  </div>
                  <div class="col col-md-6 col-sm-12">
                        <p class="text-secondary">
                        <span>Occupation </span>: <?php echo $user_job_title;?>
                      </p>
                  </div>
                  <div class="col col-md-6 col-sm-12">
                        <p class="text-secondary">
                        <span>Industry </span>: <?php echo $user_industry;?>
                      </p>
                  </div>
                  <div class="col col-md-6 col-sm-12">
                      <p class="text-secondary">
                        <span>Mobile </span>: <?php echo $user_phone;?>
                      </p>
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
