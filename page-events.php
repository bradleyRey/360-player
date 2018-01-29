<?php get_header(); ?>

<main role="main">
    <!-- section -->
    <section>

        <h1>
            <?php the_title(); ?>
        </h1>
        <?php if (have_posts()): while (have_posts()) : the_post(); ?>

        <!-- article -->
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <?php the_content(); ?>
            <p>
                <?php $start_date = get_field('start_date'); ?>
                <?php echo $start_date; ?>
            </p>


            <br class="clear">



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

    </section>
    <!-- /section -->
</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
