<?php
/*  Copyright 2014 Jeff Burrows

*/

/*
Plugin Name: G&A Madness Bracket/Voting
Plugin URI: https://imomags.com
Description: 2014 
Author: Jeff
Author URI:
Version: 0.1
Stable tag: 0.1
License: GPL2
*/
	

function madness_func( $atts ) {

	return jsGAMRender();
}
add_shortcode( 'madness', 'madness_func' );

wp_enqueue_script( 'madnessjs', plugin_dir_url( __FILE__ ) . 'madness.js', array( 'jquery' ) );
wp_enqueue_style( 'madnesscss', plugin_dir_url( __FILE__ ) . 'madness.css' );

function jsGAMRender() {
	$outp = "";
	
	//$outp.= 'Let&apos;s try a <a href="#" id="jstestclick" data-pk="22">click</a> event<br><br>';
	$outp.= '<div class="ga-madness">'
		 .  '<div class="region-titles">'
		 .	'  <div class="region-left">'
		 .	'    <h2>Handguns</h2>'. get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"handgunsmadness"))
		 .	'  </div>'
		 .	'  <div class="region-right">'
		 .	'    <h2>Shotguns</h2>'. get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"shotgunsmadness"))
		 .	'  </div>'
		 .	'</div>'
		 
		 .	'<div class="regions region1">'
		 .	'  <div class="column column1"></div>'
		 .	'  <div class="column column2"></div>'
		 .	'  <div class="column column3"></div>'
		 .	'  <div class="column column4"></div>'
		 .  '</div>'
		 .	'<div class="regions region2">'
		 .	'  <div class="column column1"></div>'
		 .	'  <div class="column column2"></div>'
		 .	'  <div class="column column3"></div>'
		 .	'  <div class="column column4"></div>'
		 .  '</div>'
		 
		 .  '<div class="regions region-final">'
		 .  '  <div class="final-wrapper">'
		 .  '    <h2>Final Round</h2>'
		 .  '    <div class="column column5 match61"></div>'
		 .  '    <div class="column column6 match63"></div>'
		 .  '    <div class="column column7 match62"></div>'
		 .  '  </div>'		 
		 .  '</div>'

		 .  '<div class="region-titles">'
		 .	'  <div class="region-left">'
		 .	'    <h2>Rifles</h2>'. get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"riflesmadness"))
		 .	'  </div>'
		 .	'  <div class="region-right">'
		 .	'    <h2>AR-15s</h2>'. get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"arsmadness"))
		 .	'  </div>'
		 .	'</div>'

		 .	'<div class="regions region3">'
		 .	'  <div class="column column1"></div>'
		 .	'  <div class="column column2"></div>'
		 .	'  <div class="column column3"></div>'
		 .	'  <div class="column column4"></div>'
		 .  '</div>'
		 .	'<div class="regions region4">'
		 .	'  <div class="column column1"></div>'
		 .	'  <div class="column column2"></div>'
		 .	'  <div class="column column3"></div>'
		 .	'  <div class="column column4"></div>'
		 .  '</div>'
	 
		 .  '</div>';
	
	$outp.= '<script type="text/javascript">';

	$outp.= 'jQuery(document).ready(function() {';
	$outp.= '		getGAMData(1,2);getGAMData(1,3);getGAMData(1,4);getGAMData(1,5);';
	$outp.= '		getGAMData(2,2);getGAMData(2,3);getGAMData(2,4);getGAMData(2,5);';
	$outp.= '		getGAMData(3,2);getGAMData(3,3);getGAMData(3,4);getGAMData(3,5);';
	$outp.= '		getGAMData(4,2);getGAMData(4,3);getGAMData(4,4);getGAMData(4,5);';
	
	$outp.= '		getGAMData(0,"61,62,63");';
	$outp.= '});';	

	$outp.= '</script>';
	
	return $outp;
}

