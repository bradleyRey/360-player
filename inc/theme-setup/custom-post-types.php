<?php
/**
 * Setup the theme post types
 *
 * @package glass
 */

$types = array(



    array(
        'the_type'     => 'events',
        'single'     => 'Experience',
        'plural'     => 'Experiences',
        'args'        => array(
            'menu_icon'    => 'dashicons-admin-site',

        ),
        'labels'    => array(
            'add_new'    => 'New Event',
        ),
    ),
     array(
        'the_type'     => 'answers',
        'single'     => 'Answer Question',
        'plural'     => 'Answer Questions',
        'args'        => array(
            'menu_icon'    => 'dashicons-megaphone',
            'supports'	=> array( 'title', 'thumbnail','editor'),
        ),
        'labels'    => array(
            'add_new'    => 'Answer',
        ),
    ),
    array(
        'the_type'     => 'captions',
        'single'       => 'Captions',
        'plural'       => 'Captions',
        'args'         => array(
            'menu_icon' => 'dashicons-images-alt',

        ),



    )


);
foreach ( $types as $type ) {
    $the_type     = $type['the_type'];
    $single     = $type['single'];
    $plural     = $type['plural'];

    $labels = array(
        'name'                    => _x( $plural, 'post type general name' ),
        'singular_name'            => _x( $single, 'post type singular name' ),
        'add_new'                => _x( 'Add New', $single ),
        'add_new_item'            => __( 'Add New ' . $single ),
        'edit_item'                => __( 'Edit ' . $single ),
        'new_item'                => __( 'New ' . $single ),
        'view_item'                => __( 'View ' . $single ),
        'search_items'            => __( 'Search ' . $plural ),
        'not_found'                => __( 'No ' . $plural . ' found' ),
        'not_found_in_trash'    => __( 'No ' . $plural . ' found in Trash' ),
        'parent_item_colon'        => '',
    );
    if ( ! empty( $type['labels'] ) ) :
        foreach ( $type['labels'] as $arg => $value ) :
            $labels[ $arg ] = $value;
        endforeach;
    endif;

    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'                => true,
        'query_var'                => true,
        'rewrite'                => true,
        'has_archive'            => true,
        'capability_type'        => array( $single, $plural ),
        'hierarchical'            => false,
        'menu_position'            => 5,
        'supports'                => array( 'title','editor','thumbnail' ),
    );
    if ( ! empty( $type['args'] ) ) :
        foreach ( $type['args'] as $arg => $value ) :
            $args[ $arg ] = $value;
        endforeach;
    endif;

    register_post_type( $the_type, $args );

}
