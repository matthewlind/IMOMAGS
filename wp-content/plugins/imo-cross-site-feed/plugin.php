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



add_action('init', 'imo_csf_scripts');
function imo_csf_scripts() {
	wp_enqueue_script('csf-js',plugins_url('cross-site-feed-widget.js', __FILE__));
	wp_enqueue_style('csf-css',plugins_url('/css/style.css', __FILE__));	

	
}

