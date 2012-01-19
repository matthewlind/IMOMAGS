<?php
/*
Plugin Name: IMO Slider
Plugin URI: http://dev.imomags.com
Description: A loop based gallery slider
Author: Aaron Baker
Author URI: http://imomags.com
*/

include('widget.php');


add_action('init', 'register_imo_slider_script');
add_action('admin_init', 'register_imo_slider_admin_script');
add_action('admin_footer', 'print_imo_slider_admin_script');
add_action('wp_footer', 'print_imo_slider_script');
 
function register_imo_slider_script() {
	wp_register_script('jquery-easing', plugins_url('jquery.easing.1.3.js', __FILE__), array('jquery'), '1.0');
	wp_register_script('jquery-buffet', plugins_url('jquery.buffet.min.js', __FILE__), array('jquery','jquery-easing'), '1.0');
	wp_register_script('jquery-imo-slider', plugins_url('imo-slider.js', __FILE__), array('jquery'), '1.0');
	wp_enqueue_style('buffet',plugins_url('buffet.css', __FILE__));

}


function register_imo_slider_admin_script() {
    wp_register_script('jquery-chosen', plugins_url('chosen/chosen.jquery.min.js', __FILE__), array('jquery'), '1.0');
	wp_register_script('jquery-imo-slider-admin', plugins_url('imo-slider-admin.js', __FILE__), array('jquery','jquery-chosen'), '1.0');

	wp_enqueue_style('chosen-css',plugins_url('chosen/chosen.css', __FILE__));
	
}

function print_imo_slider_script() {
	global $add_slider_script;
    

	if ( ! $add_slider_script )
		return;
 
	wp_print_scripts('jquery-easing');
	wp_print_scripts('jquery-buffet');
	wp_print_scripts('jquery-imo-slider');
}


function print_imo_slider_admin_script() {
	

	wp_print_scripts('jquery-chosen');
	wp_print_scripts('jquery-imo-slider-admin');
}

