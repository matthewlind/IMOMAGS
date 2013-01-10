<?php
/*
Plugin Name: IMO Cross Site Feed Widget
Plugin URI: http://dev.imomags.com
Description: Cross Site Feed Widget
Author: Fox Bowden
Author URI: http://imomags.com
*/
include('widget.php');
 


/********************************
*******LOAD SCRIPTS & STYLE******
*********************************/



add_action('init', 'register_imo_script');
add_action('wp_footer', 'print_imo_script');

function register_imo_script() {
	wp_register_script('csf-js',plugins_url('cross-site-feed-widget.js', __FILE__), null, false, true);
	wp_enqueue_style('csf-css',plugins_url('/css/style.css', __FILE__));	
}

function print_imo_script() {
    global $should_print_my_script; // Set this to true in your widget's 'widget' method
    if (!$should_print_my_script) return;
    wp_print_scripts('csf-js');
}

