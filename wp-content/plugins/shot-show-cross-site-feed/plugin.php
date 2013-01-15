<?php
/*
Plugin Name: Shot Show Cross Site Feed Widget
Plugin URI: http://dev.imomags.com
Description: Shot Show Cross Site Feed Widget
Author: Fox Bowden
Author URI: http://imomags.com
*/
include('widget.php');
 


/********************************
*******LOAD SCRIPTS & STYLE******
*********************************/



add_action('init', 'register_my_script');
add_action('wp_footer', 'print_my_script');

function register_my_script() {
	if( $_SERVER['SERVER_NAME'] == "www.petersenshunting.com" || $_SERVER['SERVER_NAME'] == "www.northamericanwhitetail.com" || $_SERVER['SERVER_NAME'] == "www.bowhuntingmag.com/" || $_SERVER['SERVER_NAME'] == "www.gundogmag.com/" || $_SERVER['SERVER_NAME'] == "www.wildfowlmag.com/" || $_SERVER['SERVER_NAME'] =="www.bowhunter.com/" || $_SERVER['SERVER_NAME'] == "www.gameandfishmag.com/" ){ 
		wp_register_script('sscsf-js',plugins_url('ss-hunt-cross-site-feed-widget.js', __FILE__), null, false, true);
	}else{
		wp_register_script('sscsf-js',plugins_url('ss-shoot-cross-site-feed-widget.js', __FILE__), null, false, true);
	}
	wp_enqueue_style('sscsf-css',plugins_url('/css/style.css', __FILE__));	
}

function print_my_script() {
    global $should_print_my_script; // Set this to true in your widget's 'widget' method
    if (!$should_print_my_script) return;
    wp_print_scripts('sscsf-js');
}