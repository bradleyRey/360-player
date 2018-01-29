<div class='list_of_elements'>
        <?php if (have_posts()): while (have_posts()) : the_post(); ?>

        <!-- article -->
        <div class='table_padding'>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
                    <div class='media_wrapper'>
                        <div class='oneoverone'>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <div class='video_wrapper' >
                                    <video id='video_snippet' autoplay muted loop>
                                        <source src="<?php echo get_field('video_snippet') ?>">
                                    </video>
                                </div>
                                <?php the_post_thumbnail('medium_square'); // Declare pixel size you need inside the array ?>
                            </a>
                        </div>
                    </div>

                    <div id='description_wrapper'>
                        <h4 class='room_title'><?php echo get_the_title(); ?></h4><br>
                        <p class='room_decription'><?php echo get_the_content(); ?></p>
                    </div>
                <?php endif; ?>
            <!-- /post details -->
            <?php //html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>
        </article>
        </div>

        <!-- /article -->

        <?php endwhile; ?>
        <div class="pagination">
            <?php echo paginate_links(); ?>
        </div>
        <?php else: ?>

        <!-- article -->
        <article>
            <h2>
                <?php _e( 'Sorry, nothing to display.', 'glass' ); ?>
            </h2>
        </article>
        <!-- /article -->

        <?php endif; ?>
        </div>
