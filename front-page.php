<?php get_header(); ?>

<main role="main">
    <!-- section -->
    <section>
        <div class='events_wrapper'>
            <div class="featured_event">
             <?php if (have_posts()): while (have_posts()) : the_post(); ?>

        <!-- article -->
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <div class='archive_wrapper '>

                <?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
                    </a>
                    <div class='description_wrapper'>
                        <h4 class='room_title'><?php echo get_the_title(); ?></h4><br>
                        <p class='room_decription'><?php echo get_the_content(); ?></p>
                    </div>

                <?php endif; ?>
            </div>

            <!-- /post details -->
            <?php //html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>


        </article>
        <!-- /article -->
        <?php break; ?>
        <?php endwhile; ?>

        <?php endif; ?>
            </div>
        </div>
        <?php if (have_posts()): while (have_posts()) : the_post(); ?>

        <!-- article -->
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <div class='archive_wrapper '>

                <?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
                    </a>
                    <div class='description_wrapper'>
                        <h4 class='room_title'><?php echo get_the_title(); ?></h4><br>
                        <p class='room_decription'><?php echo get_the_content(); ?></p>
                    </div>

                <?php endif; ?>
            </div>

            <!-- /post details -->
            <?php //html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>


        </article>
        <!-- /article -->

        <?php endwhile; ?>

        <?php else: ?>

        <!-- article -->
        <article>
            <h2>
                <?php _e( 'Sorry, nothing to display.', 'glass' ); ?>
            </h2>
        </article>
        <!-- /article -->

        <?php endif; ?>


        <?php get_template_part('pagination'); ?>

    </section>
    <!-- /section -->
</main>

 <?php// get_template_part( 'partials/ask_questions' ); ?>

<?php get_footer(); ?>
