<?php
$video_group_fileds = get_field('video_group_fileds');
?>

<style>
    .card .video {
        font-size: 14px;
        color: #424242;
        padding: 20px;
        font-weight: 400;
    }
    .card .card-header {
        color: #424242;
        padding: 20px;
        position: relative;
        box-shadow: none;
    }
    .card .header h2 {
        font-size: 15px;
        color: #757575;
        position: relative;
    }
    .card .header h2:before {
        background: #a27ce6;
    }
    .card .header h2::before {
        position: absolute;
        width: 20px;
        height: 1px;
        left: 0;
        top: -20px;
        content: '';
    }
    .video-page .single_post .meta {
        list-style: none;
        padding: 0;
        margin: 0
    }
    .video-page .single_post .meta li {
        display: inline-block;
        margin-right: 15px
    }
    .video-page .single_post .meta li a {
        font-style: italic;
        color: #959595;
        text-decoration: none;
        font-size: 12px
    }

    .video-page .single_post .meta li a i {
        margin-right: 6px;
        font-size: 12px
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">

<div class="resources-item">
    <div class="container video-page">
        <div class="col-md-12">
            <div class="card single_post">
                <div class="card-header">
                    <h2 class="m-t-0 m-b-5"><b><?php the_title();?></b></h2>
                    <ul class="meta">
                        <li>
                            <a href="javascript:void(0);"><i class="zmdi zmdi-account col-blue"></i>
                                <?php esc_html_e('Posted By:');?> <?php  echo get_the_author(); ?>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"><i class="zmdi zmdi-time col-blue"></i>
                                <?php esc_html_e('Posted On:');?> <?php the_time( get_option( 'date_format' ) ); ?>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="video" style="text-align: center">
                        <?php if ($video_group_fileds['video_url']) {?>
                                <a href="<?php echo _e($video_group_fileds['video_url'],'cooalliance') ?>" type="video/mp4">
                                    <?php echo _e($video_group_fileds['video_url'],'cooalliance') ?>
                                </a>
                        <?php } else{ ?>
                            <video width="1080" height="600"  controls>
                                <source src="<?php echo _e($video_group_fileds['video_upload']['url'],'cooalliance') ?>" type="video/mp4">
                            </video>
                        <?php }  ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
