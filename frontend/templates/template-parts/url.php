<?php
$file_group_fileds = get_field('url_group_fileds');
?>
<div class="resources-item">

  <header>
     <h3><?php   the_title();?></h3>
  </header>
    <?php if (!empty($file_group_fileds['url'])) {?>
      <div class="upload-file">
        <a target="_blank" href="<?php echo $file_group_fileds['url']; ?>"><?php echo $file_group_fileds['url']; ?></a>

      </div>
    <?php } ?>
</div>
