
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
        <div class="page-content coo-event-wrapper">
            <div class="container">
                <div class="row my-5">
                    <div class="col-12">
                        <div class="event-single coo-event-single-wrapper">
                            <?php if (have_posts()): while (have_posts()) : the_post(); ?>
                                <?php 
                                    $event_end_date = get_field('event_end_date_time', get_the_ID());
                                    $event_start_date = get_field( 'event_start_date_time', get_the_ID() ); 
                                    if(!empty($event_start_date)){
                                        $event_start_date = date(get_option( 'date_format' ), strtotime($event_start_date)); 
                                    }

                                    if(!empty($event_end_date)){
                                        $event_end_date = date(get_option( 'date_format' ), strtotime($event_end_date)); 
                                    }
                                
                                ?>
                                <div class="event-details">
                                    <div class="row">
                                        <div class="col-12 col-md-8">
                                            <div class="event-content p-3">
                                                <?php if(has_post_thumbnail()): ?>
                                                    <?php the_post_thumbnail('full', ['class'=>'img-fluid w-100 mb-3', 'alt'=> 'event-thumb']); ?>
                                                <?php endif; ?>
                                                <div class="p-1">
                                                    <h4><?php the_title(); ?></h4>
                                                    <p><?php the_content(); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="event-sidebar">
                                                <div class="siderbar-content bg-light">
                                                    <?php if(!empty($event_start_date) || !empty($event_end_date)): ?>
                                                    <div class="info-block border-bottom p-3">
                                                        <h5><?php _e("Event Dates","cooalliance")?></h5>

                                                        <p class="m-0 coo-event-dates-wrapper">
                                                            <?php if(!empty($event_start_date)) { echo __('Starts from: ', 'cooalliance') . $event_start_date .'<br>'; } ?>
                                                            <?php if(!empty($event_end_date)) { echo __('Ends At: ', 'cooalliance') . $event_end_date; } ?></p>
                                                    </div>
                                                    <?php endif; ?>
                                                    <div class="info-block p-3">
                                                        <div class="d-flex">
                                                            <h5 class="m-0"><?php _e("Payment","cooalliance")?>: </h5>
                                                            <div class="pl-2">
                                                                <?php
                                                                $paymentStatus = get_field('event_payment');
                                                                if($paymentStatus == 'yes'):
                                                                    ?>
                                                                    <span class="badge badge-warning px-2 py-1"><?php _e("Required Payment","cooalliance")?></span>
                                                                <?php else: ?>
                                                                    <span class="badge bg-success px-2 py-1"><?php _e("Free","cooalliance")?></span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <?php if(get_field('payable_amount')):?>
                                                            <p class="m-0 pt-2"> <strong><?php _e("Payable amount","cooalliance")?>: </strong><?php echo get_field('payable_amount')?> <?php _e("TK","cooalliance")?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="btn-join coo-event-join-wrapper">
                                                    <?php
                                                  //  date format F j, Y g:i a
                                                    $datetime1 = new DateTime(current_time('F j, Y g:i a'));
                                                    $datetime2 = new DateTime($event_start_date);

                                                    $interval = $datetime1->diff($datetime2);
                                                  //  var_dump($event_start_date  );

                                                    if($interval->invert):
                                                        ?>
                                                        <div class="alert alert-danger event-joined-message text-center" role="alert" >
                                                            <?php _e('Joining on this event is closed','cooalliance');?>
                                                        </div>
                                                    <?php else: ?>
                                                        <?php if($isJoined):?>
                                                            <div class="alert alert-warning event-joined-message text-center" role="alert" >
                                                                <?php _e('You have already joined in the event','cooalliance');?>
                                                            </div>
                                                        <?php else: ?>
                                                            <?php if($loggedUserId && !empty( $event_start_date )): ?>

                                                                <?php

                                                                if($paymentStatus == 'yes'){ ?>
                                                                    <a href="<?php echo site_url()."/checkout?usermail=".get_current_user_id().'&eid='.get_the_ID() ?>" class="btn btn-primary px-5 py-2 payment-event-item d-block text-white" ><?php _e('Join Now!','cooalliance')?></a>
                                                                <?php    }else{ ?>
                                                                    <a class="btn btn-primary px-5 py-2 join-event-btn d-block text-white"  data-id="<?php echo get_the_ID(); ?>" data-action="<?php the_permalink(); ?>"><?php _e('Join Now!','cooalliance')?></a>
                                                                <?php  }

                                                                ?>

                                                            <?php else: ?>
                                                                <a href="<?php echo home_url().'/login'; ?>" class="btn btn-primary px-5 py-2 d-block text-white" ><?php _e('Join Now!','cooalliance')?></a>
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
