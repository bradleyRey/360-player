<?php
    $startDate = get_field('start_date');
    $newDate = date("d/m/y", strtotime($startDate));
?>

<main role="main" class="chat_wrapper_early">
    <div class='top_bar' id='early_back_button'>
        <a href='<?php echo esc_url( home_url( '/' ) );  ?>' class='back_button'></a>
    </div>
    <div class='not_ready_wrapper'>
       <div class='content_wrapper'>
            <p class='message_content'>We're busy preparing your next online experience.</p><br>
            <p class='when_ready'>It'll be ready on <?php echo $newDate; ?></p>
            <?php
                $posts = get_field('related_events');
                if( $posts ): ?>
                    <ul class='archive'>
                    <?php foreach( $posts as $post): ?>
                        <?php setup_postdata($post); ?>
                        <li>
                            <?php the_post_thumbnail('small_square'); ?>
                            <span class='description_wrapper'>
                                <a class ='title_pre_event'href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                <?php the_content(); ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                <?php wp_reset_postdata();?>
            <?php endif; ?>
        </div>
    </div>
</main>
