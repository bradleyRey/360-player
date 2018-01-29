<?php

    $importedFile = get_field('csv_file');
    $file = get_attached_file( $importedFile['id'] );
	$array = $fields = array();
	$i = 0;
	if ( ( $handle = fopen( $file, "r" ) ) !== FALSE ) {
		while ( ( $row = fgetcsv( $handle, 4096)) !== FALSE) {
			if ( empty( $fields ) ) {
				$fields = $row;
				continue;
			}
			foreach ($row as $k=>$value) {
				$array[$i][$fields[$k]] = $value;
			}
			$i++;
        }
		if ( ! feof( $handle ) ) {
			echo "Error: unexpected fgets() fail\n";
		}
		fclose( $handle );
        //var_dump( $array );
	}
    foreach ( $array as $key => $single ) :
        $value = $single['Std_ID'];
        if ( $value === $_GET['id'] ):
            $id = $single;
   endif;
    endforeach;
    $query = new WP_Query( array(
        'post_type' => 'student',
        'tax_query' => array(
            array(
                'taxonomy' => 'courses',
                'terms'    => $id['Course'],
                'field'    => 'slug'
            )
        )
    ));
    if ( $query->have_posts() ) :
    ?>
   <ul class='scroll'>
    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <li class=swiper-slide>
          <?php $bgimg = 'background: url( ' . esc_url( get_the_post_thumbnail_url() ) . ' ) no-repeat center center / cover;';
            ?>
           <div class="internal_wrap oneoverone " style="<?php echo $bgimg ?>">
                <div class="ratiocontent overlay ">
                   <div class="height">
                       <div class="vertical-center">
                            <h3>
                                <?php echo the_title() ?>
                            </h3>
                            <p>
                                <?php the_content(); ?>
                            </p>
                            <a href="<?php //echo( $link_events ) ?>"><i id='play' class="fa fa-play-circle-o" aria-hidden="true"></i></a>
                       </div>
                   </div>
                    <div class='overlay'>
                    </div>
               </div>
            </div>
        </li>
    <?php endwhile; wp_reset_postdata(); ?>
    </ul>
    <?php else: ?>
        <p>No student posts have been created</p>
<?php endif; ?>
