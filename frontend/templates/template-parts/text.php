<?php
$text_group_fileds = get_field('text_group_fileds');
?>
<style>
    body{
        margin-top:20px;
        background:#eee;
    }
    .blog-page .single_post {
        -webkit-transition: all .4s ease;
        transition: all .4s ease
    }

    .blog-page .single_post .img-post {
        position: relative;
        overflow: hidden;
        max-height: 500px;
        text-align: center;
    }

    .blog-page .single_post .img-post>img {
        -webkit-transform: scale(1);
        -ms-transform: scale(1);
        transform: scale(1);
        opacity: 1;
        -webkit-transition: -webkit-transform .4s ease, opacity .4s ease;
        transition: transform .4s ease, opacity .4s ease;
        max-width: 100%;
        filter: none;
        -webkit-filter: grayscale(0);
        -webkit-transform: scale(1.01)
    }

    .blog-page .single_post .img-post:hover img {
        -webkit-transform: scale(1.02);
        -ms-transform: scale(1.02);
        transform: scale(1.02);
        opacity: .7;
        filter: gray;
        -webkit-filter: grayscale(1);
        -webkit-transition: all .8s ease-in-out
    }


    .blog-page .single_post .meta {
        list-style: none;
        padding: 0;
        margin: 0
    }

    .blog-page .single_post .meta li {
        display: inline-block;
        margin-right: 15px
    }

    .blog-page .single_post .meta li a {
        font-style: italic;
        color: #959595;
        text-decoration: none;
        font-size: 12px
    }

    .blog-page .single_post .meta li a i {
        margin-right: 6px;
        font-size: 12px
    }

    .blog-page .single_post h3 {
        font-size: 20px;
        line-height: 26px;
        -webkit-transition: color .4s ease;
        transition: color .4s ease
    }

    .blog-page .single_post h3 a {
        color: #242424;
        text-decoration: none
    }

    .blog-page .single_post p {
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
<div class="container blog-page">
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
                    <?php if (!empty($text_group_fileds['upload_image'])) :?>
                        <div class="img-post m-b-15">
                            <img src="<?php echo $text_group_fileds['upload_image']['url'];?>" alt="<?php  echo $text_group_fileds['upload_image']['alt'] ?>">
                        </div>
                    <?php endif;?>
                    <?php if (!empty($text_group_fileds['type_in_content'])) :?>
                        <p> <?php echo _e( $text_group_fileds['type_in_content'],'cooalliance' ); ?></p>
                    <?php endif;?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>