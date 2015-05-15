<?php
/*
* Plugin Name: OSGIM Pub/Issue Drop-In
* Description: Insert newstand, subscription, and store information about a magazine 
* Version: 1.0
* Author: Jeff Burrows
*/


function osgim_issuesales_shortcode($args){
	$bipad = $args["bipad"];
	$alias = (isset($args["alias"]))? $args["alias"]:"";
	
	$attr = array("horizontal","vertical","prompt","gotxt","title","nodata","oktxt");
	$data = "";
	
	if(isset($args["bipad"])){
		$data.= 'data-bipad="'.$args["bipad"].'" ';
	}
	else { return; }
	
	foreach($attr as $att){
		if(isset($args[$att])){
			$data.= 'data-'.$att.'="'.$args[$att].'" ';
		}
	}
	
	print '<div id="pubfinderzipcont'.$alias.'" class="pubfinderzipcont" '.$data.'></div>';

}

function osgim_issuesales() {
    wp_register_style( 'osgim-pubissue-style', plugins_url('osgim-pubissue.css', __FILE__) );
    wp_enqueue_style( 'osgim-pubissue-style' );
    
    wp_enqueue_script('osgim-pubissue', 'http://api.imoutdoors.com/newstand/pubfinder2.js', array('jquery'), '1.0.0', true);
}

add_action( 'wp_enqueue_scripts', 'osgim_issuesales' );
add_shortcode('osgimpubissue', 'osgim_issuesales_shortcode');

?>