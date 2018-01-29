<?php
/**
 * Setup the theme taxonomies
 *
 * @package glass
 */

$taxonomies = array(
	array(
		'the_tax' 	=> 'courses',
		'single' 	=> 'courses',
		'plural' 	=> 'courses',
		'icon' 		=> '',
		'post_type' => array( 'student' ),
    ),
);
foreach ( $taxonomies as $taxonomy ) {
	$the_tax = $taxonomy['the_tax'];
	$single = $taxonomy['single'];
	$plural = $taxonomy['plural'];
	$post_type = $taxonomy['post_type'];
	$labels = array(
		'name' => _x( $plural, 'Taxonomy general name' ),
		'singular_name' => _x( $single, 'Taxonomy singular name' ),
		'search_items' => __( 'Search ' . $plural ),
		'popular_items' => __( 'Popular ' . $plural ),
		'all_items' => __( 'All ' . $plural ),
		'parent_item' => __( 'Parent ' . $single ),
		'parent_item_colon' => __( 'Parent ' . $single ),
		'edit_item' => __( 'Edit ' . $single ),
		'update_item' => __( 'Update ' . $single ),
		'add_new_item' => __( 'Add New ' . $single ),
		'new_item_name' => __( 'New ' . $single ),
		'add_or_remove_items' => __( 'Add or remove ' . $plural ),
		'choose_from_most_used' => __( 'Choose from most used ' . $plural ),
		'menu_name' => __( $plural ),
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_in_nav_menus' => true,
		'hierarchical' => true,
		'show_tagcloud' => true,
		'show_ui' => true,
		'rewrite' => true,
		'query_var' => true,
		'show_admin_column' => false,
	);
	register_taxonomy( $the_tax, $post_type, $args );
}
