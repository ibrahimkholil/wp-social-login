<?php
$text_group_fileds = get_field('text_group_fileds');
?>

<div class="resources-item">

  <header>

     <h3><?php   the_title();?></h3>
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
