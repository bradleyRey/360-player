<?php
/**
 * Setup the theme menus
 *
 * @package bolton-flagship
 */

register_nav_menus( array(
	'header-nav' => 'Header Links',
	'footer-nav' => 'Footer Navigation',
	'404' => '404 Menu',
	)
);

	// Now see if the main navigation menu is there - if not, create it.
if ( ! wp_get_nav_menu_object( 'Main Navigation' ) ) {
	$menu_id = wp_create_nav_menu( 'Main Navigation' ); // Create the menu.
	$locations = get_theme_mod( 'nav_menu_locations' ); // Get the menu locations.
	$locations['primary'] = $menu_id; // Set our new menu to be the main nav.
	set_theme_mod( 'nav_menu_locations', $locations ); // Update.
}

if ( ! wp_get_nav_menu_object( 'Footer Navigation' ) ) {
	$menu_id = wp_create_nav_menu( 'Footer Navigation' ); // Create the menu.
	$locations = get_theme_mod( 'nav_menu_locations' ); // Get the menu locations.
	$locations['footer-nav'] = $menu_id; // Set our new menu to be the main nav.
	set_theme_mod( 'nav_menu_locations', $locations ); // Update.

}

if ( ! wp_get_nav_menu_object( '404 Menu' ) ) {
	$menu_id = wp_create_nav_menu( '404 Menu' ); // Create the menu.
	$locations = get_theme_mod( 'nav_menu_locations' ); // Get the menu locations.
	$locations['404'] = $menu_id; // Set our new menu to be the main nav.
	set_theme_mod( 'nav_menu_locations', $locations ); // Update.
}
