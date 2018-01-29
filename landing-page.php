<?php /* Template Name: landing-page */ ?>
<?php
    get_template_part('partials/csvReader');
    get_header();
?>
    <header class="featured_image">
        <?php if ( has_post_thumbnail( get_the_ID() ) ) : ?>
            <style>
                .featured_image {
                    background-image: url('<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID() , 'full_hd' ) ); ?>');
                }
            </style>
        <?php endif; ?>
        <div class='overlay'>
        </div>
        <div class='title internal_wrap oneoverone'>
            <p class='nameID'><?php echo esc_html( $id['F_Name'] ); ?>, This is</p>
            <p class='main_title'>#YoursForTheTaking</p>
        </div>
        <button class='view_more'>View More</button>
    </header>
    <section>
        <div class='student__wrapper'>
            <div class='student--profiles'>
              <span><p>Student Profiles</p></span>
            </div>
            <div class='student--placeholder'>
                <?php get_template_part( 'partials/student-slider' ); ?>
            </div>
        </div><!-- 
    --></section><!--
    --><section><!--
        --><div class='sign_up'>
            <h2>Sign Up</h2>
            <div class='sign_up_wrapper'>
                <form action="">
                    <div class='dropdown' id='gForm'><?php gravity_form( 1, false, false, false, '', false ); ?>  </div>
                </form>
            </div>
        </div>
    </section>
    <section id='live_experience'>
        <div class='live_experience_wrapper'>
            <?php  get_template_part( 'partials/events-slider' ); ?>
        </div>
    </section>


<section id='promo1' class='promotion_height'>
  <div class='promotion_1'>
        <?php $prom_img = get_field('promotion_image_1');
             $prom_img_embed = 'background: url( ' . esc_url( $prom_img ) . ') no-repeat center center / cover;';
        ?>
        <div class='promotion_swish_1_container promotion_height'>
            <div class='swish_position_1'>
                <div class='promotion_swish_1'>
                    <span><?php the_field('caption_1'); ?></span>
                </div>
            </div>
        </div>
        <?php if( $prom_img ): ?>
            <div class='promotion_image_1 promotion_height' style='<?php echo $prom_img_embed ?>'></div>
        <?php endif; ?>
    </div>
</section>

<section id='promo2'  class='promotion_height'>
    <div class='promotion_2 '>
        <?php
            $prom_img_2 = get_field('promotion_image_2');
            $prom_img_2_embed = 'background: url( ' . esc_url( $prom_img_2 ) . ') no-repeat center center / cover;';
        ?>
        <div class='promotion_swish_2_container promotion_height'>
<!--           <div class='vertical-center'>-->
                 <div class='swish_position_2'>
                <div class='promotion_swish_2'>
                    <span><?php the_field('caption_2'); ?></span>
                </div>
               </div>
<!--           </div>-->

        </div>
        <?php if( $prom_img_2 ): ?>
            <div class='promotion_image_2 promotion_height' style='<?php echo $prom_img_2_embed ?>'></div>
        <?php endif; ?>
    </div>
</section>

<section id='questions'>
    <div class='question_banner'>
        <h2>Have a question?</h2>
    </div>
    <div class='openday_wrapper'>
        <div class='book_open_day'>
            <h4> What are you waiting for?</h4>
            <p>Why not come and Test Drive the university at one of our open days</p>
            <button>Book an open day</button>
        </div>
    </div>
</section>
<?php get_footer(); ?>
