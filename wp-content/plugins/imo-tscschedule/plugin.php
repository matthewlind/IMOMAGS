<?php
/*  Copyright 2014 Jeff Burrows

*/

/*
Plugin Name: TSC Program Schedule
Plugin URI: https://imomags.com
Description: 2014 
Author: Jeff
Author URI:
Version: 0.1
Stable tag: 0.1
License: GPL2
*/
	
function tscschedule_func( $atts ) {
	//global $ismobile;
	$ismobile = false;

	return jsTSCSRender($ismobile, $atts);
}
add_shortcode( 'tscschedule', 'tscschedule_func' );

wp_enqueue_script( 'tscschedulejs', plugin_dir_url( __FILE__ ) . 'tscschedule.js' );
wp_enqueue_style( 'tscschedulecss', plugin_dir_url( __FILE__ ) . 'tscschedule.css' );

function jsTSCSRender($mobile) {
	
	$args = array(
		'numberposts' => -1,
		'post_type' => 'show',
		'meta_key' => 'series_id',
		'meta_value' => '1001'
	);
	
	$the_query = new WP_Query( $args );
	
	print_r($the_query);
}


function jsTSCSRenderEx($mobile) {
	$outp = "";
	$ismobile = ($mobile)? "true":"false"; 
	
  if($mobile) {
	$outp.= '<div class="ga-madness-votestats"></div>';
	
	if (function_exists('imo_add_this'))
		 	$outp.='<div class="addthis-below">'.imo_add_this(false). '</div>';
		 	
	$outp.= '<div id="madtabs">'
		 .  '  <ul class="rounds">'
		 .  '    <li><a href="#madtabs-1">1st</a></li>'
		 .  '    <li class="ui-tabs-selected ui-state-active"><a href="#madtabs-2" >2nd</a></li>'
		 .  '    <li><a href="#madtabs-3">Sweet 16</a></li>'
		 .  '    <li><a href="#madtabs-4">Elite 8</a></li>'
		 .  '    <li><a href="#madtabs-5">Final 4</a></li>'
		 .  '    <li class="final-round"><a href="#madtabs-6">Final</a></li>'
		 .  '  </ul>'
					
		 .  '  <div id="madtabs-1">'
		 .  '    <div class="gun-types">'
		 .  '      <select>'
		 .  '        <option value="">SELECT A GUN REGION</option>'
		 .  '        <option value="#handguns">Handguns</option>'
		 .  '        <option value="#shotguns">Shotguns</option>'
		 .  '        <option value="#rifles">Rifles</option>'
		 .  '        <option value="#ar15s">AR-15s</option>'
		 .  '      </select>'
		 .  '    </div>'
		 .  '    <h2 id="handguns">Handguns</h2>'
		 .  '    <div>'. get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"handgunsmadness")) .'</div>'
		 .  '    <div class="mreg1"></div>'
		 .  '    <h2 id="rifles">Rifles</h2>'
		 .  '    <div>'. get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"riflesmadness")) .'</div>'
		 .  '    <div class="mreg3"></div>'
		 .  '    <h2 id="ar15s">Modern Sporting Rifles</h2>'
		 .  '    <div>'. get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"arsmadness")) .'</div>'
		 .  '    <div class="mreg4"></div>'
		 .  '    <h2 id="shotguns">Shotguns</h2>'
		 .  '    <div>'. get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"shotgunsmadness")) .'</div>'
		 .  '    <div class="mreg2"></div>'
		 .  '  </div>'
		 
		 .  '  <div id="madtabs-2">'

		 .  '    <h2 id="handguns">Handguns</h2>'
		 .  '    <div>'. get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"handgunsmadness")) .'</div>'
		 .  '    <div class="mreg1"></div>'
		 .  '    <h2 id="rifles">Rifles</h2>'
		 .  '    <div>'. get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"riflesmadness")) .'</div>'
		 .  '    <div class="mreg3"></div>'
		 .  '    <h2 id="ar15s">Modern Sporting Rifles</h2>'
		 .  '    <div>'. get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"arsmadness")) .'</div>'
		 .  '    <div class="mreg4"></div>'
		 .  '    <h2 id="shotguns">Shotguns</h2>'
		 .  '    <div>'. get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"shotgunsmadness")) .'</div>'
		 .  '    <div class="mreg2"></div>'
		 .  '  </div>'
		 .  '  <div id="madtabs-3">'
		 		 .  '    <p>Come back on March 28 to see who advances!</p>'
		 .  '  </div>'
		 .  '  <div id="madtabs-4">'
		 .  '  </div>'
		 .  '  <div id="madtabs-5">'
		 .  '  </div>'
		 .  '  <div id="madtabs-6">'
		 .  '  </div>'
		 .  '</div>';

  }
  else {
	
	$outp.= '<div class="tsc-schedule">'
		 .  '<div class="region-titles">'
		 .	'  <div class="region-left">'
		 .	'    <h2>Handguns</h2>'. get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"handgunsmadness"))
		 .	'  </div>'
		 .	'  <div class="region-right">'
		 .	'    <h2>Rifles</h2>'. get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"riflesmadness"))
		 .	'  </div>'
		 .	'</div>'
  }	

	$outp.= '<script type="text/javascript">';
	$outp.= 'var ismobile = '.$ismobile.';';
	
	$outp.= 'jQuery(document).ready(function() {'
		 .  '	getGAMData(1,2);getGAMData(1,3);getGAMData(1,4);getGAMData(1,5);'
		 .  '	getGAMData(2,2);getGAMData(2,3);getGAMData(2,4);getGAMData(2,5);'
		 .  '	getGAMData(3,2);getGAMData(3,3);getGAMData(3,4);getGAMData(3,5);'
		 .  '	getGAMData(4,2);getGAMData(4,3);getGAMData(4,4);getGAMData(4,5);'
	
		 .  '	getGAMData(0,"61,62,63");'
		 .  '   getStats();'
		 .  '   setTimeout(function(){makeGAMPopup()}, 1000);'
		 .	'});';

	$outp.= '</script>';
	$outp.= renderGAMpopup();
	
	return $outp;
}

?>
