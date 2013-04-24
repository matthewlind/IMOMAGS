<?php
/*  Copyright 2013 IMO FOX */
/*
Plugin Name: IMO Holiday Gift Guide 
Plugin URI: http://imomags.com
Description: Holiday Gift Guide Widgets.
Author: IMO FOX
Author URI:
Version: 0.1
Stable tag: 0.1
License: IMO
*/
include('widget.php');

/********************************
*******LOAD SCRIPTS & STYLE******
*********************************/

add_action('init', 'imo_gift_guide_scripts');
function imo_gift_guide_scripts() {
    wp_enqueue_script('gift-guide-js',plugins_url('js/gift-guide.js', __FILE__));
    wp_enqueue_script('jquery-ui-tabs',plugins_url('jquery-ui-tabs', __FILE__));
    wp_enqueue_style('gift-guide-css',plugins_url('css/gift-guide.css', __FILE__));	
}


/**********************************************
******* ******
***********************************************/

