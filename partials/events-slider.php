
<?php /* initialise your acf gallery field, ALSO make OPTIONS its source  */ ?>

<?php
$query = new WP_Query( array(
        'post_type' => 'events',
    ));
    if ( $query->have_posts() ) :
    ?>
   <ul class='scroll'>
    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <li class=swiper-slide>
          <?php $bgimg = 'background: url( ' . esc_url( get_the_post_thumbnail_url() ) . ' ) no-repeat center center / cover;';
            ?>
           <div class="internal_wrap oneoverone border-radius--circle" style="<?php echo $bgimg ?>">
                <div class="ratiocontent overlay dark">
                   <div class="height">
                       <div class="vertical-center">
                            <h3>
                                <?php echo the_title() ?>
                            </h3>
                            <p>
                                <?php the_content(); ?>
                            </p>
                            <a href="<?php //echo( $link_events ) ?>"><i id='play' class="fa fa-play-circle-o" aria-hidden="true"></i></a>
                       </div>
                   </div>
                    <div class='overlay'>
                    </div>
               </div>
            </div>
        </li>
    <?php endwhile; wp_reset_postdata(); ?>
    </ul>
    <?php else: ?>
        <p>No event posts have been created</p>
<?php endif; ?>


