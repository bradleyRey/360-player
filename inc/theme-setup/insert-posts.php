<?php
/**
 * Programatically creates posts within post types
 *
 * @package bolton-flagship
 */


sb_insert_post(
	array(
		'post_name'		=> 'home',
		'post_title'	=> 'Home',
		'post_type'		=> 'post',
		'post_status'	=> 'publish',
	),
	false //Hidden page?
);
