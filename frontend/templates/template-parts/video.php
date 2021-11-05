<?php
$video_group_fileds = get_field('video_group_fileds');
?>
<div class="resources-item">

  <header>
     <h3><?php   the_title();?></h3>
  </header>
    <?php if ($video_group_fileds['video_url']) {?>
      <div class="video">
        <a target="_blank" href="<?php echo $video_group_fileds['video_url']; ?>"><?php echo $video_group_fileds['video_url']; ?></a>

      </div>
    <?php } else{ ?>
      <video src="<?php echo $video_group_fileds['video_upload']['url']; ?>"  controls>

      </video>
        <?php }  ?>
</div>
