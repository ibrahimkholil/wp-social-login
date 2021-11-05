
<?php
/**
 * [header include]
 * @var [type]
 */
get_header( );
 ?>
 <main>
   <section class="pay-70">
     <div class="container">
       <div class="row">
         <div class="col-12">
           <div class="page-content">
             <div class="event-items">

               <?php
               global $post;
               $currentId = get_current_user_id();
                $userInfo = get_userdata($currentId);

               $joinUrl = array();
               //if(is_single()):
               $args = array(
                 'numberposts' => -1,
                 'post_type'   => 'events'
               );

               $events = get_posts( $args );
               foreach ($events as $event){
                 $joinUrl[] = $event->guid;
               }

               ?>

               <?php
               $eventData = new WP_Query(
                 [
                   'post_type'        => 'events',
                   'posts_per_page'   => -1,
                   'orderby'          => 'post_date',
                   'order'            => 'DESC',
                   'post_status'      => 'publish'
                 ]
               );
               ?>
               <?php if ($eventData->have_posts()): while ($eventData->have_posts()) : $eventData->the_post(); ?>
                 <div class="even-item mb-5 py-3 px-4">
                   <div class="row align-items-center">
                     <?php if(has_post_thumbnail()):?>
                       <div class="col-12 col-md-3 px-0">
                         <div class="img-wrap text-left">
                           <?php 	the_post_thumbnail('737x449', ['class'=>'img-fluid', 'alt'=>'Cooalliance Events' ]);?>
                         </div>
                       </div>
                       <div class="col-12 col-md-6">
                         <div class="content">
                           <h4><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>
                           <p><?php the_excerpt(); ?></p>
                         </div>
                       </div>
                       <div class="col-12 col-md-3">
                         <div class="text-right">
                           <a href="<?php the_permalink(); ?>" class="btn btn-primary px-5 py-2 read-more-btn">See Event Details</a>
                         </div>
                       </div>
                     <?php else: ?>
                       <div class="col-12">
                         <div class="row">
                           <div class="col-8">
                             <div class="content">
                               <h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
                               <p><?php the_excerpt(); ?></p>
                             </div>
                           </div>
                           <div class="col-4">
                             <div class="btn-join text-right">
                               <a href="<?php the_permalink(); ?>" class="btn btn-primary px-5 py-2 read-more-btn">See Event Details</a>
                             </div>
                           </div>
                         </div>

                       </div>
                     <?php endif; ?>
                   </div>
                 </div>
               <?php endwhile;  wp_reset_query(); endif; ?>
             </div>
           </div>
         </div>
                   <div class="col-8 mx-auto">
                       <div class="pagination">
                           <?php
                             //global $opt;
                            // var_dump($opt->pagination->customPagination());
                           ?>
                       </div>
                   </div>
       </div>
   </section>
 </main>


<?php get_footer(); ?>
