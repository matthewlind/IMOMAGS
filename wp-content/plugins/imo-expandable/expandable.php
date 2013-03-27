<?php
/*  Copyright 2012 IMO FOX */
/*
Plugin Name: IMO Expandable Header Ad
Plugin URI: http://imomags.com
Description: An expandanle ad for promiting content or advertisers.
Author: IMO FOX
Author URI:
Version: 0.1
Stable tag: 0.1
License: IMO
*/

/********************************
*******LOAD SCRIPTS & STYLE******
*********************************/



add_action('init', 'imo_expandable_scripts');
function imo_expandable_scripts() {
	//wp_deregister_script( 'jquery' );
	//wp_enqueue_script( 'jquery' );
    wp_enqueue_script('expandable',plugins_url('js/expandable.js', __FILE__));
    wp_enqueue_script('jquery-cookie',plugins_url('js/jquery.cookie.js', __FILE__));
    wp_enqueue_style('expandable-css',plugins_url('css/expandable.css', __FILE__));	
}
