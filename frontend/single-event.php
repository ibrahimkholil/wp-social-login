
<?php
/**
 * [get_header part]
 * @var [type]
 */
get_header( );
 ?>
<?php

global $post;

$userId = get_current_user_id();
$loggedUserId = get_userdata($userId);
$joinedUsers = get_post_meta($post->ID, 'joinedUsers', true);
$isJoined = false;
if(is_array($joinedUsers)){
    if(in_array($userId,$joinedUsers)){
        $isJoined = true;
    }
}
?>
<main>
    <section>
        <div class="page-content">
            <div class="container">
                <div class="row my-5">
                    <div class="col-12">
                        <div class="event-single">
                            <?php if (have_posts()): while (have_posts()) : the_post(); ?>
                                <div class="event-details">
                                    <div class="row">
                                        <div class="col-12 col-md-8">
                                            <div class="event-content p-3">
                                                <?php if(has_post_thumbnail()): ?>
                                                    <?php the_post_thumbnail('full', ['class'=>'img-fluid w-100 mb-3', 'alt'=> 'event-thumb']); ?>
                                                <?php endif; ?>
                                                <div class="p-1">
                                                    <h4><?php the_title(); ?></h4>
                                                    <p><small><strong class="text-muted"><i class="fa fa-calendar mr-2"></i> Published at <?php the_time('l, F jS, Y'); ?></strong></small></p>
                                                    <p><?php the_content(); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="event-sidebar">
                                                <div class="siderbar-content bg-light">
                                                    <div class="info-block border-bottom p-3">
                                                        <h5>Last date of registration</h5>
                                                        <?php $eventDeadLine = get_field('event_end_date_time');?>
                                                        <p class="m-0"><?php echo $eventDeadLine;?></p>
                                                    </div>
                                                    <div class="info-block p-3">
                                                        <div class="d-flex">
                                                            <h5 class="m-0">Payment: </h5>
                                                            <div class="pl-2">
                                                                <?php
                                                                $paymentStatus = get_field('event_payment');
                                                                if($paymentStatus == 'yes'):
                                                                    ?>
                                                                    <span class="badge badge-warning px-2 py-1">Required Payment</span>
                                                                <?php else: ?>
                                                                    <span class="badge bg-success px-2 py-1">Free</span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <?php if(get_field('payable_amount')):?>
                                                            <p class="m-0 pt-2"> <strong>Payable amount: </strong><?php echo get_field('payable_amount')?> TK</p>
                                                        <?php endif; ?>
                                                    </div>


                                                </div>
                                                <div class="btn-join">
                                                    <?php
                                                  //  date format F j, Y g:i a
                                                    $datetime1 = new DateTime(current_time('F j, Y g:i a'));
                                                    $datetime2 = new DateTime($eventDeadLine);
                      
                                                    $interval = $datetime1->diff($datetime2);
                                                    if($interval->invert):
                                                        ?>
                                                        <div class="alert alert-danger event-joined-message text-center" role="alert" >
                                                            Event already expired
                                                        </div>
                                                    <?php else: ?>
                                                        <?php if($isJoined):?>
                                                            <div class="alert alert-warning event-joined-message text-center" role="alert" >
                                                                You have already joined in the event
                                                            </div>
                                                        <?php else: ?>
                                                            <?php if($loggedUserId): ?>

                                                                <?php

                                                                if($paymentStatus == 'yes'){ ?>
                                                                    <a href="<?php echo site_url()."/checkout?usermail=".get_current_user_id().'&eid='.get_the_ID() ?>" class="btn btn-primary px-5 py-2 payment-event-item d-block text-white" ">Join Now!</a>
                                                                <?php    }else{ ?>
                                                                    <a class="btn btn-primary px-5 py-2 join-event-btn d-block text-white"  data-id="<?php echo get_the_ID(); ?>" data-action="<?php the_permalink(); ?>">Join Now!</a>
                                                                <?php  }

                                                                ?>

                                                            <?php else: ?>
                                                                <a href="<?php echo home_url().'/login'; ?>" class="btn btn-primary px-5 py-2 d-block text-white" >Join Now!</a>
                                                            <?php endif; ?>
                                                        <?php endif;?>
                                                    <?php endif; ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            <?php endwhile;  endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
