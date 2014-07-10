<?php
/*
Plugin Name:X-Scroll To Top - Responsive
Plugin URI: 
Description: This plugin will add a scroll to top button on footer center.
Author: Md. Jahidul Islam
Author URI: https://www.elance.com/s/edit/jahid07/ 
Version: 1.0
*/

/*Adding Latest jQuery from Wordpress*/
function x_scroll_to_top_latest_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'x_scroll_to_top_latest_jquery');


/*Some Set-up*/
define('X_PLUGIN_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );

wp_enqueue_script('x-jquery-easing', X_PLUGIN_URL.'js/jquery.easing.min.js', array('jquery'));

wp_enqueue_script('x-jquery-main-scroll-up', X_PLUGIN_URL.'js/jquery.scrollUp.min.js', array('jquery'));
wp_enqueue_script('x-jquery-active', X_PLUGIN_URL.'js/active.js', array('jquery'));



wp_enqueue_style('x-scroll-plugin-css', X_PLUGIN_URL.'css/custom.css');


wp_enqueue_style('x-scroll-plugin-css', X_PLUGIN_URL.'http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" ');


?>