<?php
/*  Copyright 2013 Aaron Baker*/
/*
Plugin Name: iPad Magazine Subscription Interstitial
Plugin URI: http://imomags.com
Description: When a site is viewed on the ipad, a full-screen popup appears that directs users to the digital magazine.
Author: aaron
Author URI:
Version: 0.1
License: IMO
*/


add_action('init', 'ipad_mag_scripts');
function ipad_mag_scripts() {

    wp_enqueue_script('ipad-mag-interstitial-js',plugins_url('ipad-mag-interstitial.js', __FILE__));
    wp_enqueue_script('jquery-cookie',plugins_url('jquery.cookie.js', __FILE__));
	wp_enqueue_style('ipad-mag-interstitial-css',plugins_url('ipad-mag-interstitial.css', __FILE__));
	wp_enqueue_style('pt-sans-400-700',"http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic");
	
}
