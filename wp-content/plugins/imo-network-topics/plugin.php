<?php
/*  Copyright 2013 IMO FOX */
/*
Plugin Name: IMO Network Topics
Plugin URI: http://imomags.com
Description: Displays Network Topics for shooting sites.
Author: IMO FOX
Author URI:
Version: 0.1
Stable tag: 0.1
License: IMO
*/
include('widget.php');
//include('page-widget.php');

/********************************
*******LOAD SCRIPTS & STYLE******
*********************************/

add_action('init', 'imo_nt_scripts');
function imo_nt_scripts() {
	wp_enqueue_script('jquery-flexslider',plugins_url('js/jquery.flexslider.js', __FILE__));
    wp_enqueue_script('network-topics-js',plugins_url('js/network-topics.js', __FILE__),array("jquery-flexslider"));


	wp_enqueue_style('network-topics-css',plugins_url('css/network-topics.css', __FILE__));

}


/**********************************************
******* ******
***********************************************/

