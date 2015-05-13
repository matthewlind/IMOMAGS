<?php
/*
* Plugin Name: OSGIM Pub/Issue Drop-In
* Description: Insert newstand, subscription, and store information about a magazine 
* Version: 1.0
* Author: Jeff Burrows
*/


function osgim_issuesales_shortcode($args){
	$bipad = $args["bipad"];

print '<script type="text/javascript">'
	. 'var pubfindercfg = {'
	. '  bipad: "'.$bipad.'",'
	. '  orient: "left",'
	. '  promptlabel: "Find This Issue In Your Area:",'
	. '  gobutton: "GO!",'
	. '  title: "You should be able to find this publication at the following local retailers:",'
	. '  nodata: "<div style=\"padding:5px;\">No locations found in this zipcode.<br>Try another one!</div>",'
	. '  okbutton: "OK"'
	. '}'
	. '</script>';

print '<div id="pubfinderzipcont"></div>';

print '<script src="http://api.imoutdoors.com/newstand/pubfinder.js" type="text/javascript"></script>';

}

add_action( 'wp_enqueue_scripts', 'osgim_issuesales_css' );

/**
 * Enqueue plugin style-file
 */
function osgim_issuesales_css() {
    wp_register_style( 'osgim-pubissue-style', plugins_url('osgim-pubissue.css', __FILE__) );
    wp_enqueue_style( 'osgim-pubissue-style' );
}

add_shortcode('osgimfirst', 'osgim_issuesales_shortcode');

?>