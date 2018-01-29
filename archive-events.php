<?php get_header(); ?>
<!--
<div class='keyframe_animation_overlay_white'></div>
<div class='keyframe_animation_slide_orange'></div>
<div class='keyframe_logo_wrapper'>
    <div class='keyframe_logo_fadein'><img src="<?php echo get_template_directory_uri(); ?>/img/aston_white_new.png" alt="Logo" class="logo-img"></div>
</div>
-->

<div class="logo_archive">
    <a href="<?php echo home_url(); ?>">
        <img src="<?php echo get_template_directory_uri(); ?>/img/aston-logo.png" alt="Logo" class="logo-img">
    </a>
</div>
<main role="main">
    <!-- section -->
    <section>
        <div class='events_wrapper'>
            <div class="featured_event">
                <?php if (have_posts()): while (have_posts()) : the_post(); ?>
        <!-- article -->
                    <article id="post-<?php the_ID(); ?>" <?php post_class();  ?>>
                            <?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                   <div class='media_wrapper'>
                                        <div class='video_wrapper' >
                                            <video id='video_snippet_featured' muted loop>
                                                <source src="<?php echo get_field('video_snippet') ?>">
                                            </video>
                                        </div>
                                    </div>
                                    <style>
                                        article#post-<?php the_ID(); ?>{
                                            background-image: url('<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID() , 'full' ) ); ?>');

                                        }

                                    </style>

                                </a>
                            <?php endif; ?>
                        <!-- /post details -->
                        <?php //html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>
                        <div id='featured-description_wrapper'>
                            <h4 class='room_title'><?php echo get_the_title(); ?></h4><br>
                            <p class='room_decription'><?php echo get_the_content(); ?></p>
                        </div>
                    </article>

                <!-- /article -->
                <?php break; ?>
                <?php endwhile; ?>

                <?php endif; ?>
            </div>
        </div>
        <?php get_template_part('partials/archive_slider'); ?>

    </section>
    <!-- /section -->
</main>

 <?php// get_template_part( 'partials/ask_questions' ); ?>

<?php get_footer(); ?>
