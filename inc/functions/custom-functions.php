<?php
/**
 * Theme specific functions
 * All function names need to be prefixed with `[theme-name]_glass_`
 *
 * @package glass
 */

/**
 * Rename "Posts" to "News"
 *
 * @link http://new2wp.com/snippet/change-wordpress-posts-post-type-news/
 */
function glass_change_post_menu_label() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'News';
	$submenu['edit.php'][5][0] = 'News';
	$submenu['edit.php'][10][0] = 'Add News';
	$submenu['edit.php'][16][0] = 'News Tags';
	echo '';
}
add_action( 'admin_menu', 'glass_change_post_menu_label' );

/**
 * Rename "Posts" to "News"
 *
 * @link http://new2wp.com/snippet/change-wordpress-posts-post-type-news/
 */
function glass_change_post_object_label() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'News';
	$labels->singular_name = 'News';
	$labels->add_new = 'Add News';
	$labels->add_new_item = 'Add News';
	$labels->edit_item = 'Edit News';
	$labels->new_item = 'News';
	$labels->view_item = 'View News';
	$labels->search_items = 'Search News';
	$labels->not_found = 'No News found';
	$labels->not_found_in_trash = 'No News found in Trash';
}
add_action( 'init', 'glass_change_post_object_label' );

/**
 * Update "Posts" icon
 *
 * @link https://bungeshea.com/change-wordpress-admin-menu-icons/
 */
function replace_admin_menu_icons_css() {
	?>
	<style>
		#adminmenu .dashicons-admin-post:before { content: "\f119"; }
	</style>
	<?php
}

add_action( 'admin_head', 'replace_admin_menu_icons_css' );


/**
 * Disable WordPress REST API
 *
 * @author Warren Reeves
 */
add_filter( 'rest_endpoints', function( $endpoints ) {
	if ( ! is_user_logged_in() ) {
		if ( isset( $endpoints['/wp/v2/posts'] ) ) {
			unset( $endpoints['/wp/v2/posts'] );
		}
		if ( isset( $endpoints['/wp/v2/revisions'] ) ) {
			unset( $endpoints['/wp/v2/revisions'] );
		}
		if ( isset( $endpoints['/wp/v2/categories'] ) ) {
			unset( $endpoints['/wp/v2/categories'] );
		}
		if ( isset( $endpoints['/wp/v2/tags'] ) ) {
			unset( $endpoints['/wp/v2/tags'] );
		}
		if ( isset( $endpoints['/wp/v2/pages'] ) ) {
			unset( $endpoints['/wp/v2/pages'] );
		}
		if ( isset( $endpoints['/wp/v2/comments'] ) ) {
			unset( $endpoints['/wp/v2/comments'] );
		}
		if ( isset( $endpoints['/wp/v2/taxonomies'] ) ) {
			unset( $endpoints['/wp/v2/taxonomies'] );
		}
		if ( isset( $endpoints['/wp/v2/media'] ) ) {
			unset( $endpoints['/wp/v2/media'] );
		}
		if ( isset( $endpoints['/wp/v2/users'] ) ) {
			unset( $endpoints['/wp/v2/users'] );
		}
		if ( isset( $endpoints['/wp/v2/types'] ) ) {
			unset( $endpoints['/wp/v2/types'] );
		}
		if ( isset( $endpoints['/wp/v2/statuses'] ) ) {
			unset( $endpoints['/wp/v2/statuses'] );
		}
		if ( isset( $endpoints['/wp/v2/settings'] ) ) {
			unset( $endpoints['/wp/v2/settings'] );
		}
	}

	return $endpoints;
});

// Removes from admin menu
add_action( 'admin_menu', 'my_remove_admin_menus' );
function my_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}
// Removes from post and pages
add_action('init', 'remove_comment_support', 100);

function remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}

// Removes from admin bar
function mytheme_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );


//add_action( 'wp_enqueue_scripts', 'glass_add_popcorn_js' );


//========================================
// Echo Ajax Url
//========================================
add_action('wp_head','plugin_ajaxurl');
function plugin_ajaxurl() {
?>
<script id="ajax-url" type="text/javascript">
    var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>
<?php
}

add_theme_support( 'post-formats', array( 'link','quote' ) );

add_action('pre_get_posts','aoe_events_homepage');

function aoe_events_homepage($wp_query) {

    if ( is_admin() ){
        return;
    }

    if ( $wp_query->get('page_id') == get_option('page_on_front') ) :

        $wp_query->set('post_type', 'events');
        $wp_query->set('page_id', ''); //Empty

        //Set properties that describe the page to reflect that
        //we aren't really displaying a static page
        $wp_query->is_page = 0;
        $wp_query->is_singular = 0;
        $wp_query->is_post_type_archive = 1;
        $wp_query->is_archive = 1;

    endif;
}

function enable_extended_upload ($mime_types=array()){
   $mime_types['csv']    =    'application/octet-stream';
   return $mime_types;
}
add_filter('upload_mimes','enable_extended_upload');
