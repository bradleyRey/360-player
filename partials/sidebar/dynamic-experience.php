<main class="sidebar dynamic-experience">
    <section>
       <div>
        <?php if( have_rows('dynamic_content_repeater') ): ?>


            <?php while( have_rows('dynamic_content_repeater') ): the_row();

                // vars
                $tweet = get_sub_field('repeater_oembed_tweet');
                $content_title = get_sub_field('repeater_content_title');
                $content_subtitle = get_sub_field('repeater_content_subtitle');
                $gallery = get_sub_field('repeater_gallery');
                $content_type = get_sub_field('repeater_select');

                ?>

                <div>

                    <?php if ( $content_type === 'tweet' ) : ?>
                    <div class="embed-container">
                        <?php the_sub_field('repeater_oembed_tweet'); ?>
                    </div>
                    <?php endif; ?>
                    <?php if ( $content_type === 'content' ) : ?>
                    <div class="content-container">
                        <h3><?php the_sub_field('repeater_content_title'); ?></h3>
                        <p><?php the_sub_field('repeater_content_subtitle'); ?></p>
                    </div>
                    <?php endif; ?>

                    <?php if ( $content_type === 'gallery' ) : ?>

                     <div class="slider-for">
                     <?php foreach( $gallery as $image ): ?>
                     <div class="slick-container">
                     <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                     </div>
                     <?php endforeach; ?>
                     </div>


                    <?php endif; ?>


                </div>

            <?php endwhile; ?>


        <?php endif; ?>
        </div>
    </section>
</main>
