<div class="text-wrapper">
  
  <header>
     <h3><a href="<?php the_permalink(  )?>"><?php   the_title();?></a></h3>
  </header>
  <?php    if (!empty($text_group_fileds['upload_image'])) :?>
  <div class="image">
      <img src="<?php echo $text_group_fileds['upload_image']['url'];?>" alt="<?php  echo $text_group_fileds['upload_image']['alt'] ?>">
  </div>
<?php endif;?>
<?php    if (!empty($text_group_fileds['type_in_content'])) :?>
  <div class="content">
    <?php
      // echo  $text_group_fileds['type_in_content'];
       echo _e( $text_group_fileds['type_in_content'],'cooalliance' );
    ?>
  </div>
<?php endif;?>
  </div>
 <div>
