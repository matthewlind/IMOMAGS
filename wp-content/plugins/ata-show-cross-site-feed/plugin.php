<?php
/*
Plugin Name: ATA Show Cross Site Feed Widget
Plugin URI: http://dev.imomags.com
Description: ATA Show Cross Site Feed Widget
Author: Fox Bowden
Author URI: http://imomags.com
*/
include('widget.php');
 


/********************************
*******LOAD SCRIPTS & STYLE******
*********************************/



add_action('init', 'register_ata_script');
add_action('wp_footer', 'print_ata_script');

function register_ata_script() {
	wp_register_script('atacsf-js',plugins_url('ata-cross-site-feed-widget.js', __FILE__), null, false, true);
	wp_enqueue_style('atacsf-css',plugins_url('/css/style.css', __FILE__));	
}

function print_ata_script() {
    global $should_print_ata_script; // Set this to true in your widget's 'widget' method
    if (!$should_print_ata_script) return;
    wp_print_scripts('atacsf-js');
}