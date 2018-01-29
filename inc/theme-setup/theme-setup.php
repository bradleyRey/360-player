<?php
/**
 * Setup the theme post types and default pages
 *
 * @package bolton-flagship
 */

/**
 * Programatically sets the theme on every page load
 *
 * @author Nathan Monk
 */
function glass_child_theme_setup() {

	glass_set_homepage( 'Home', 'home' );
	glass_set_news_archive( 'News', 'news' );

	add_theme_support( 'post-thumbnails' );
	include 'roles.php';
	include 'menus.php';
	include 'insert-posts.php';
	include 'custom-post-types.php';
	include 'taxonomies.php';
}
add_action( 'after_setup_theme', 'glass_child_theme_setup', 99 );

/** New image sizes.
 *
 * @package smile-glass
 */
add_image_size( 'small_square', 250, 250, true );
add_image_size( 'medium', 300, 200, true );
add_image_size( 'hd', 1280, 720, true );
add_image_size( 'medium_square', 500, 500, true );
add_image_size( 'full_hd', 1920, 1080, true );

/**
 * Disable comments and pings by default
 *
 * @author Warren Reeves
 */
function glass_disable_all_comments_and_pings() {

	// Turn off comments.
	if ( '' !== get_option( 'default_ping_status' ) ) {
		update_option( 'default_ping_status', '' );
	} // end if

	// Turn off pings.
	if ( '' !== get_option( 'default_comment_status' ) ) {
		update_option( 'default_comment_status', '' );
	} // end if

} // End disable_all_comments_and_pings.
add_action( 'after_setup_theme', 'glass_disable_all_comments_and_pings' );
