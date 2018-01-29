 <?php get_header(); ?>
    <input type="checkbox" id='toggle_eye' class='hidden'>
    <?php

        $startDate = get_field('start_date');
        $endDate = get_field('end_date');
        if(strtotime( $startDate ) > strtotime( 'now' ) && strtotime( $endDate ) > strtotime( 'now' ) ){
            get_template_part('partials/pre_template');
        } else {
            get_template_part('partials/now_playing_template');
        }
    ?>
<?php get_footer(); ?>
