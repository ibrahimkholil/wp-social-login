<?php
$file_group_fileds = get_field('url_group_fileds');
?>

<style>
    body{
        margin-top:20px;
        background:#eee;
    }
    .upload-file-page .single_post {
        -webkit-transition: all .4s ease;
        transition: all .4s ease
    }

    .upload-file-page .single_post .img-post {
        position: relative;
        overflow: hidden;
        max-height: 500px;
        text-align: center;
    }

    .upload-file-page .single_post .meta {
        list-style: none;
        padding: 0;
        margin: 0
    }

    .upload-file-page .single_post .meta li {
        display: inline-block;
        margin-right: 15px
    }

    .upload-file-page .single_post .meta li a {
        font-style: italic;
        color: #959595;
        text-decoration: none;
        font-size: 12px
    }

    .upload-file-page .single_post .meta li a i {
        margin-right: 6px;
        font-size: 12px
    }

    .upload-file-page .single_post h3 {
        font-size: 20px;
        line-height: 26px;
        -webkit-transition: color .4s ease;
        transition: color .4s ease
    }

    .upload-file-page .single_post h3 a {
        color: #242424;
        text-decoration: none
    }

    .upload-file-page .single_post p {
        font-size: 20px
    }

    .card {
        background: #fff;
        margin-bottom: 30px;
        transition: .5s;
        border: 0;
        border-radius: .55rem;
        position: relative;
        width: 100%;
        box-shadow: 0 1px 2px 0 rgba(0,0,0,0.1);
    }

    .card .body {
        font-size: 14px;
        color: #424242;
        padding: 20px;
        font-weight: 400;
    }

    .m-b-15 {
        margin-bottom: 15px;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
<div class="container upload-file-page">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card single_post">
                <div class="body">
                    <h2 class="m-t-0 m-b-5"><b><?php   the_title();?></b></h2>
                    <ul class="meta">
                        <li>
                            <a href="javascript:void(0);">
                                <i class="zmdi zmdi-account col-blue"></i>
                                <?php esc_html_e('Posted By:');?>
                                <?php  echo get_the_author(); ?>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <i class="zmdi zmdi-time col-blue"></i>
                                <?php esc_html_e('Posted On:');?>
                                <?php the_time( get_option( 'date_format' ) ); ?>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <?php if (!empty($file_group_fileds['url'])) :?>
                        <div class="img-post m-b-15">
                            <a target="_blank" href="<?php echo $file_group_fileds['url']; ?>">
                                <?php echo $file_group_fileds['url']; ?>
                            </a>
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>


