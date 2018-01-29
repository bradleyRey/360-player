<main role="main" class="chat_wrapper">
   <div class='top_bar'>
        <a href='<?php echo esc_url( home_url( '/' ) ); ?>' class='back_button'></a>
        <?php get_template_part('partials/notifications'); ?>
   </div>
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
               <?php get_template_part('partials/fb_live_message'); ?>

        <?php if( get_field('is_it_live') ):
            $fblink = get_field('live_embed_url');
        ?>
            <div class='video360'>
                <div class="height">
                    <div class="vertical-center">
                       <div class='livefb sixteennine'>
                            <iframe src="https://www.facebook.com/plugins/video.php?href=<?php echo $fblink; ?>" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        <?php else :
            $videoFile = get_field('360_video_file');
            $captionRoom = get_field('event_room_caption');
            echo $captionRoom;
         ?>
        <?php if ( wp_is_mobile() ) : ?>
            <script>
                <?php
                    $videoFile = get_field('360_video_file');
                ?>
                  var panorama, viewer;

                  panorama = new PANOLENS.VideoPanorama( '<?php echo $videoFile; ?>', { autoplay: true } );

                  viewer = new PANOLENS.Viewer();
                  viewer.add( panorama );
            </script>
        <?php else : ?>
            <div id="video" class="valiant" data-video-src="<?php echo $videoFile ?>"></div>
        <?php endif; ?>
        <?php endif; ?>
        <div class='chat_room'>
            <?php get_template_part( 'partials/header_partial' ); ?>
            <div class='message_wrapper'>
                <ul id="messages">
                    <li>Welcome to the Aston Online Experience! If you would like to ask a question please do not hesitate.</li>
                    <?php $args = array(
                        'meta_query' => array(
                                            array('key'     => 'event_room',
                                                  'value'   =>  get_the_ID(),
                                            ),
                                            array('key'     => 'event_room',
                                                  'value'   => get_the_ID(),
                                                 ),
                                            ),
                                                'post_type' => array('answers',
                                                                     'captions'
                                                                     ),
                                                'post_status' => 'publish',
                                            );
                            $the_query = new WP_Query( $args );
                    ?>
                    <?php if($the_query->have_posts() ) : ?>
                        <?php while($the_query->have_posts()) : $the_query->the_post(); ?>
                        <?php
                            $answerRoom = get_field('event_room');
                            $captionRoom = get_field('event_room_caption');
                            $content = get_the_content();
                            $link = get_the_title();
                            if( 'answers' === get_post_type()  ):
                        ?>
                        <!--IF IS LIVE CHAT-->
                            <li class = 'question_post 1 '><p class='q_and_a_title'>Question: </p> <?php the_title() ?><br/><p class='q_and_a_title'>Answer: </p><?php the_content() ?></li>
                        <?php elseif ( !empty($content) ):  ?>
                        <!--ELSE IF IS CAPTION-->
                            <li class='question_post 2'><?php the_content(); ?></li>
                        <?php elseif('captions' === get_post_type()): ?>
                            <li class="question_post 3"><a href='<?php echo $link; ?>'><img src="<?php  echo wp_get_attachment_url( get_post_thumbnail_id($post) ) ?>"></a></li>
                    <?php endif; ?>
                       <!--END IF-->
                    <?php endwhile; ?>
                </ul>
                <?php wp_reset_postdata(); ?>
                <?php else : ?>

                <?php endif; ?>
                </div>
                <?php
                    $startDate = get_field('start_date');
                    $endDate = get_field('end_date');
                    $nowDate = date('Y-m-d H:i:s');
                    if (strtotime( $nowDate ) < strtotime( $endDate ) ):
                ?>
                    <div class='question_wrapper'>
                        <form action="" class='submit_question' >
                            <input type="text" id="m" placeholder="ASK A QUESTION">
                            <input type="submit" class='hidden'>
                        </form>
                    </div>
                <?php else: ?>
                    <div class='question_wrapper'>
                        <p class='event_over'>The event has now ended</p>
                    </div>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
        <?php else: ?>
		<!-- article -->
            <article>
                <h1><?php _e( 'Sorry, nothing to display.', 'glass' ); ?></h1>
            </article>
		<!-- /article -->
    <?php endif; ?>
</main>
