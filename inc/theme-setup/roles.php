<?php
/**
 * Setup the theme roles.
 *
 * @package glass
 */

// Remove Roles.
if ( get_role( 'subscriber' ) ) {
	remove_role( 'subscriber' );
}
if ( get_role( 'author' ) ) {
	remove_role( 'author' );
}
if ( get_role( 'contributor' ) ) {
	remove_role( 'contributor' );
}

/**
 * Add User Roles.
 * Use to build custom roles with oermission sets.
 * Group them sensibly so you can scale easily.
 *
 * @author Nathan Monk
 */
$reset = array(
	'gform_full_access'				=> false,
	'export'						=> false,
	'manage_categories'				=> false,
);

$users = array(
	'create_users'					=> true,
	'delete_users'					=> true,
	'list_users'					=> true,
	'edit_users'					=> true,
);

$edit_forms = array(
	'gravityforms_edit_entry_notes' => true,
	'gravityforms_edit_forms'       => true,
	'gravityforms_edit_settings'    => true,
	'gravityforms_view_entries'     => true,
	'gravityforms_view_entry_notes' => true,
	'gravityforms_view_settings'    => true,
);
$publish_forms = array(
	'gravityforms_create_form'      => true,
	'gravityforms_delete_entries'   => true,
	'gravityforms_delete_forms'     => true,
	'gravityforms_edit_entries'     => true,
	'gravityforms_feed'             => true,
	'gravityforms_export_entries'   => true,
);

$edit_posts = array(
	'edit_posts'             		=> true,
	'edit_published_posts'   		=> true,
	'read'                   		=> true,
	'read_private_posts'     		=> true,
	'upload_files'           		=> true,
);

$publish_posts = array(
	'publish_posts'					=> true,
	'edit_others_posts'				=> true,
	'delete_posts'           		=> true,
	'delete_private_posts'   		=> true,
	'delete_published_posts' 		=> true,
	'delete_others_posts'           => true,
	'edit_private_pages' 			=> true,
	'edit_private_posts' 			=> true,
);

$roles = array(
//	array(
//		'label' 		=> 'Role Name',
//		'name'			=> 'role_name',
//		'permissions' 	=> $reset + $users,
//	),
);

foreach ( $roles as $role ) {
	remove_role( $role['name'] );
	add_role( $role['name'], $role['label'], $role['permissions'] );
	// WordPress Bug fix to add Custom user roles to the author list.
	$role_cap = get_role( $role['name'] );
	$role_cap -> add_cap( 'level_1' );
}
