<?php
/**
 * Author: Warren Reeevs
 * URL: wearesmile.com
 *
 * @package smile-glass
 */

/**
 * Force activation
 *
 * @param string $plugin The plugin file.
 */
function plugin_activation( $plugin ) {
	if ( ! function_exists( 'activate_plugin' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}

	if ( ! is_plugin_active( $plugin ) ) {
		activate_plugin( $plugin );
	}
}
if ( ! function_exists( 'smile_bartender' ) ) :
	plugin_activation( 'bartender/bartender.php' );
endif;
add_filter('show_admin_bar', '__return_false');
/**
 Load any external files you have here.
 */

require_once 'inc/theme-setup/theme-setup.php';
require_once 'inc/functions/enqueue.php';
require_once 'inc/class-tgm-plugin-activation.php';
require_once 'inc/functions/load-plugins.php';
require_once 'inc/functions/custom-functions.php';
require_once 'inc/websocket.php';

