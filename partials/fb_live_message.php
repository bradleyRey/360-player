<?php if ( wp_is_mobile() ) : ?>
    <?php if ( get_field('is_it_live') ): ?>
    <div class='fb-notification'>
        <p class='fb-message-content'>
            <?php echo esc_html("This video may not work on mobile, please use a desktop to view this video ") ?>
        </p>
    </div>
    <?php endif; ?>
<?php endif; ?>
