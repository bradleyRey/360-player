<?php
/**
 * Enqueue files for the frontend
 *
 * @package smile-glass
 */

$config = array(
	'font-awesome'	=> true,
	'jquery'		=> true,
	'simplebar'		=> true,
    'swiper'        => true,
	'mapbox'		=> true,
	'slick'			=> true,
	'dropzone'		=> true,
	'font-loader'	=> array(
		'google'	=> [ 'Montserrat,400,700' ], // Array List of fonts to load.
		'typekit'	=> 'miu7lkf', // String Your Typekit ID.
	),
    'moment'        => true,
);

/**
 * Enqueue all styles
 *
 * @package smile-glass
 */
function glass_enqueue_styles() {
	global $config;
	wp_enqueue_style( 'normalize', get_template_directory_uri() . '/bower_components/normalize-css/normalize.css' );
	wp_enqueue_style( 'glass-min', get_template_directory_uri() . '/css/style.min.css' );
	wp_enqueue_style( 'glass', get_stylesheet_uri() );

	// Font Awesome.
	if ( ! empty( $config['font-awesome'] ) ) {
		wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/bower_components/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );
	}

	// Mapbox GL.
	if ( ! empty( $config['mapbox'] ) ) {
		wp_enqueue_style( 'mapbox-gl', 'https://api.mapbox.com/mapbox-gl-js/v0.32.1/mapbox-gl.css', '1.0', null, true );
	}

	// Simplebar.
	if ( ! empty( $config['simplebar'] ) ) {
		wp_enqueue_style( 'simplebar', get_stylesheet_directory_uri() . '/node_modules/simplebar/dist/simplebar.css', '1.0.0', false, true );
	}

    // Swiper.
	if ( ! empty( $config['swiper'] ) ) {
		wp_enqueue_style( 'swiper', get_stylesheet_directory_uri() . '/bower_components/swiper/dist/css/swiper.min.css' );
	}

	// Slick Slider.
	if ( ! empty( $config['slick'] ) ) {
		wp_enqueue_style( 'slick-slider', get_stylesheet_directory_uri() . '/bower_components/slick-carousel/slick/slick.css', '1.0', null, true );
	}

	// Dropzone.
	if ( ! empty( $config['dropzone'] ) ) {
		wp_enqueue_style( 'dropzone', get_stylesheet_directory_uri() . '/bower_components/dropzone/dist/min/dropzone.min.css', '1.0', null, true );
	}
}

/**
 * Enqueue all scripts
 *
 * @package smile-glass
 */
function glass_enqueue_scripts() {
	global $config;
	// JQuery.
	if ( ! empty( $config['jquery'] ) ) {
		wp_deregister_script( 'jquery' );
		wp_enqueue_script( 'jquery', get_stylesheet_directory_uri() . '/bower_components/jquery/dist/jquery.min.js', '2.2.4', null, false );
	}

	// Simplebar.
	if ( ! empty( $config['simplebar'] ) ) {
		wp_enqueue_script( 'simplebar', get_stylesheet_directory_uri() . '/node_modules/simplebar/dist/simplebar.js', '1.0.0', false, true );
	}

    // Moment.
    if ( ! empty( $config['moment'] ) ) {
        wp_enqueue_script( 'moment', get_stylesheet_directory_uri() . '/bower_components/moment/min/moment.min.js', '2.19.3', false );
	}
    // Moment TZ
    if ( ! empty( $config['moment'] ) ) {
        wp_enqueue_script( 'momentTz', get_stylesheet_directory_uri() . '/bower_components/moment-timezone/builds/moment-timezone-with-data.min.js', '2.19.3', false );
	}

	// Font Loader.
	if ( ! empty( $config['font-loader'] ) && ( ! empty( $config['font-loader']['google'] ) || ! empty( $config['font-loader']['typekit'] ) ) ) {
		wp_enqueue_script( 'google-fonts', 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js', '1.0', false, true );
	}

	// Mapbox GL.
	if ( ! empty( $config['mapbox'] ) ) {
		wp_enqueue_script( 'mapbox-js', 'https://api.mapbox.com/mapbox-gl-js/v0.32.1/mapbox-gl.js', '1.0', null, true );
	}

    // Swiper.
    if ( ! empty( $config['swiper'] ) ) {
		wp_enqueue_script( 'swiper', get_stylesheet_directory_uri() . '/bower_components/swiper/dist/js/swiper.min.js', array(), '4.0.0', true );
	}

	// Slick Slider.
	if ( ! empty( $config['slick'] ) ) {
		wp_enqueue_script( 'slick-slider', get_stylesheet_directory_uri() . '/bower_components/slick-carousel/slick/slick.min.js', '1.0', null, false );
	}

	// Dropzone.
	if ( ! empty( $config['dropzone'] ) ) {
		wp_enqueue_script( 'dropzone', get_stylesheet_directory_uri() . '/bower_components/dropzone/dist/min/dropzone.min.js', '1.0', null, true );
	}

    //wp_enqueue_script( 'twitter-widget', '//platform.twitter.com/widgets.js', '1.0', false, false );

	// IE only.
	wp_enqueue_script( 'selectivizr', get_template_directory_uri() . '/bower_components/selectivizr/selectivizr.js', array(), '1.0.2', false );
	wp_script_add_data( 'selectivizr', 'conditional', 'lte IE 9' );
	wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/bower_components/html5shiv/dist/html5shiv.min.js', array(), '3.7.3', false );
	wp_script_add_data( 'html5shiv', 'conditional', 'lte IE 9' );
	wp_enqueue_script( 'respond', get_template_directory_uri() . '/bower_components/respond/dest/respond.min.js', array(), '1.4.2', false );
	wp_script_add_data( 'respond', 'conditional', 'lte IE 9' );
	wp_enqueue_script( 'rem', get_template_directory_uri() . '/bower_components/REM-unit-polyfill/js/rem.min.js', array(), '1.0', true );
	wp_script_add_data( 'rem', 'conditional', 'lte IE 9' );
    wp_enqueue_script( 'socket-io', '//cdn.socket.io/socket.io-1.3.5.js', '1.3.5', false, true );

	// Polyfills.
	wp_enqueue_script( 'requestAnimationFrame', get_template_directory_uri() . '/bower_components/requestAnimationFrame/app/requestAnimationFrame.js', array(), '1.0', true );
	wp_enqueue_script( 'smoothscroll', get_template_directory_uri() . '/bower_components/smoothscroll/dist/smoothscroll.js', array(), '1.0', true );
    wp_enqueue_script( 'three', get_stylesheet_directory_uri() . '/node_modules/three/build/three.min.js', '1.0', null, false );
	if(! wp_is_mobile() ) {
        wp_enqueue_script( 'valiant360', get_stylesheet_directory_uri() . '/js/valiant360/jquery.valiant360.min.js', '1.0', null, false );
        wp_enqueue_script( 'valiant', get_stylesheet_directory_uri() . '/js/valiant.js', '1.0', null, false );
    }else {
    wp_enqueue_script( 'jpano', get_stylesheet_directory_uri() . '/js/panolensjs.js/build/panolens.min.js', '1.0', null, false );
    wp_enqueue_script( 'tween', get_stylesheet_directory_uri() . '/node_modules/tween.js/src/Tween.js', '1.0', null, false );
    wp_enqueue_script( 'iphone-inline', get_stylesheet_directory_uri() . '/node_modules/iphone-inline-video/dist/iphone-inline-video.min.js', '1.0', null, false );

    }

	wp_enqueue_script( 'ice', get_stylesheet_directory_uri() . '/js/ice.js', '1.0', null, true );
	wp_enqueue_script( 'main', get_stylesheet_directory_uri() . '/js/main.js', '1.0', null, false );
    wp_localize_script( 'main', 'localize',
		array(
			'startDate' =>  get_field('start_date'),
            'endDate'   =>  get_field('end_date'),
        )
    );
}

add_action( 'wp_enqueue_scripts', 'glass_enqueue_styles' );
add_action( 'wp_enqueue_scripts', 'glass_enqueue_scripts' );

if ( ! empty( $config['font-loader'] ) && ( ! empty( $config['font-loader']['google'] ) || ! empty( $config['font-loader']['typekit'] ) ) ) :
	/**
	 * Font Loader for Google Fonts and Typekit
	 *
	 * @author Nathan Monk / Warren Reeves
	 */
	function font_loader() {
		global $config;
	?>
	<script>
		WebFont.load({
			<?php if ( ! empty( $config['font-loader']['google'] ) ) : ?>
			google: {
				families: <?php echo wp_json_encode( $config['font-loader']['google'] ); ?>
			},
			<?php endif; ?>
			<?php if ( ! empty( $config['font-loader']['typekit'] ) ) : ?>
			typekit: {
				id: '<?php echo esc_js( $config['font-loader']['typekit'] ); ?>'
			},
			<?php endif; ?>
		});
	</script>
	<?php
	}
	add_action( 'wp_footer','font_loader', 99 );
endif;
