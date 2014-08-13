<?php
/*  Copyright 2014 Intermedia Outdoors

*/

/*
Plugin Name: Bow Madness Bracket/Voting
Plugin URI: https://imomags.com
Description: 2014 
Author: Jeff Burrows / Ben Gray
Author URI:
Version: 0.1
Stable tag: 0.1
License: GPL2
*/

	
function bowmadness_func( $atts ) {
	global $ismobile;

	return jsGAMRender($ismobile);
}
add_shortcode( 'bowmadness', 'bowmadness_func' );

	wp_enqueue_script( 'madnessjs', plugin_dir_url( __FILE__ ) . 'madness.js', array( 'jquery' ) );
	wp_enqueue_style( 'madnesscss', plugin_dir_url( __FILE__ ) . 'madness.css' );
	wp_enqueue_script( 'magnificjs', plugin_dir_url( __FILE__ ) . 'jquery.magnific-popup.js');
	wp_enqueue_style( 'magnificcss', plugin_dir_url( __FILE__ ) . 'magnific-popup.css');
	
	wp_enqueue_script( 'htmlparser', plugin_dir_url( __FILE__ ) . 'htmlParser.js');
	wp_enqueue_script( 'postscribe', plugin_dir_url( __FILE__ ) . 'postscribe.js');
	wp_enqueue_script( 'xdomainrequest', plugin_dir_url( __FILE__ ) . 'xdomainrequest.min.js');
	

function renderGAMpopup($mobile) {
	$outp = "";
	$outp.= <<<EOF
<script id="tmplGAMpopup" type="text/x-magnific-popup-template">
    <div class="white-popup mfp-hidden"><div class="mfp-close"></div>
        <div class='mfp-counter'></div>
	    <div class="popup-inner clearfix gun">
	    	<h3 id="popuptitle">The Matchup</h3>
			<div class="popmatchbrackettop"></div>
			<div class="popmatchbracket"></div>
	    	<div class="vote-section gun gunone">
		    	<h2 class="mfp-player1name"></h2>
		    	<img class="mfp-player1image" src="" alt="" title="">
		    	<div class="popup-vote" id="popvoteon1">
		    		<div class="popup-vote-btn mfp-mid" data-pnum="1">VOTE</div>
		    	</div>
	    	</div>
	    	<div class="vote-section versus">
	    		<div><h2>vs.</h2></div>
	    	</div>	    	
			<div class="vote-section gun guntwo">
		    	<h2 class="mfp-player2name"></h2>
		    	<img class="mfp-player2image" src="" alt="" title="">
		    	<div class="popup-vote" id="popvoteon2">
		    		<div class="popup-vote-btn mfp-mid" data-pnum="2">VOTE</div>
		    	</div>
	    	</div>
	    	<div class="next-matchup">Go to the next matchup <span>&raquo;</span></div>
	    	<div class="vote-again">Vote again <span>&raquo;</span></div>
	    	
	    	<div class="modal-footer">
	    		<div class="modal-footer-content">
		    		<div class="modal-footer-content-left">
		    			<div id="popupsponsor">
		    				<a href="http://www.gunsandammo.com/bracket/enter/"></a>
		    			</div>
						<div class="related-content">
			    			<h4>Related Stories</h4>
							<ul>
			    				<li><a href="" class="mfp-player1link">Review: <span class="mfp-player1name"></span></a></li>
								<li><a href="" class="mfp-player2link">Review: <span class="mfp-player2name"></span></a></li>
							</ul>
						</div>
		    		</div>
		    		<div class="modal-footer-content-right">
		    			<div id="div-gpt-ad-1386782139095-3"></div>
		    		</div>
	    		</div>
	    	</div>
	    </div>
    </div>
</script>
EOF;


	return $outp;
}
function jsGAMRender($mobile) {
	$outp = "";
	//$mobile = true;
	$ismobile = ($mobile)? "true":"false"; 
	$madnessround = 1;

  if($mobile) {
	$outp.= '<div class="ga-madness-votestats"></div>';
	
	//if (function_exists('wpsocialite_markup'))
		 	//$outp.= wpsocialite_markup();
		 	
	$outp.= '<div id="madtabs">'
		 .  '  <ul class="rounds">'
		 .  '    <li><a href="#madtabs-1">1st</a></li>'
		 .  '    <li><a href="#madtabs-2">2nd</a></li>'
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
		 .  '  <div id="madtabs-4">'

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
		 .  '  <div id="madtabs-5">'
		 .  '    <br><div>'. get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"handgunsmadness")) .'</div>'
		 .  '    <div>'. get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"riflesmadness")) .'</div>'
		 .  '    <div class="mreg5 match61"></div>'
		 .  '    <div class="mreg6 match62"></div>'
		 .  '    <div>'. get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"shotgunsmadness")) .'</div>'
		 .  '    <div>'. get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"arsmadness")) .'</div>'
		 
		 .  '  </div>'
		 
		 .  '  <div id="madtabs-6">'
		 .  '    <br><div style="margin:10px 0px 0px 6px;clear:both;font-size:18px;font-weight:bold;">Championship</div>'
		 .  '    <div class="mreg7 match63"></div>'
		 .  '    <br><div>'. get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"handgunsmadness")) .'</div>'
		 .  '    <div>'. get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"riflesmadness")) .'</div>'
		 .  '    <div>'. get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"shotgunsmadness")) .'</div>'
		 .  '    <div>'. get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"arsmadness")) .'</div>'
		 
		 .  '  </div>'		 
		 .  '</div>';

  }
  else {
	
	$outp.= '<ul class="schedule">'
		 //.  '  <li class="'.(($madnessround==2)? "active-round":"").'">First Round<div>March 18-23</div></li>'
		 .  '  <li class="'.(($madnessround==3)? "active-round":"").'">First Round<div>March 24-27</div></li>'
		 .  '  <li class="'.(($madnessround==4)? "active-round":"").'">Sweet 16<div>March 28-31</div></li>'
		 .  '  <li class="'.(($madnessround==5)? "active-round":"").'">Elite 8<div>April 1-3</div></li>'
		 .  '  <li class="'.(($madnessround==6)? "active-round":"").'">Final Four<div>April 4-7</div></li>'
		 .  '  <li class="'.(($madnessround==7)? "active-round":"").'">Final Round<div>April 8-11</div></li>'
		 .  '</ul>'
		 //.  wpsocialite_markup()
		 ;
	
	if($madnessround == 7) {		 
	$outp.= '<div class="ga-madness-votestats" style="margin-bottom:20px;clear:both;"></div>'
		 .  '<div class="regions region-final" style="display:block;">'
		 .  '  <div class="finalsadvert" style="margin-top:0px;">'
		 .       get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"presentingmadness"))
		 .  '  </div>'
		 .  '  <div class="final-wrapper">'
		 .  '    <h2>Final Round</h2>'
		 .  '    <div class="column column5 match61"></div>'
		 .  '    <div class="column column6 match63" style="padding-top:20px;"></div>'
		 .  '    <div class="column column7 match62"></div>'
		 .  '  </div>'		 
		 .  '</div>';
	}
	else {
		$outp.= '<div class="ga-madness-votestats"></div>';
	}

	$outp.= '<div class="ga-madness">'
		 .  '<div class="region-titles">'
		 .	'  <div class="region-left">'
		 .	'    <h2>Compound</h2>'. get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"handgunsmadness"))
		 .	'  </div>'
		 .	'  <div class="region-right">'
		 .	'    <h2>Compound</h2>'. get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"riflesmadness"))
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
		 .  '</div>';

	if($madnessround < 7) {		 
	$outp.= '<div class="regions region-final"	>'
		 .  '  <div class="finalsadvert">'
		 .       get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"presentingmadness"))
		 .  '  </div>'
		// .  '  <div class="final-wrapper">'
		//.  '    <h2>Final Round</h2>'
		// .  '    <div class="column column5 match61"></div>'
		// .  '    <div class="column column6 match63"></div>'
		// .  '    <div class="column column7 match62"></div>'
		 //.  '  </div>'		 
		 .  '</div>';
	}
		 
	$outp.= '<div class="region-titles">'
		 .	'  <div class="region-left">'
		 .	'    <h2>Crossbows</h2>'. get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"arsmadness"))
		 .	'  </div>'
		 .	'  <div class="region-right">'
		 .	'    <h2>Crossbows</h2>'. get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"shotgunsmadness"))
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
  }	

	$outp.= '<script type="text/javascript">';
	$outp.= 'var ismobile = '.$ismobile.';';
	
	$outp.= 'jQuery(document).ready(function() {'
		 .  '	getGAMData(1,3);getGAMData(1,4);getGAMData(1,5);'
		 .  '	getGAMData(2,3);getGAMData(2,4);getGAMData(2,5);'
		 .  '	getGAMData(3,3);getGAMData(3,4);getGAMData(3,5);'
		 .  '	getGAMData(4,3);getGAMData(4,4);getGAMData(4,5);'
	
		 .  '	getGAMData(0,"61,62,63");'
		 .  '   getStats();'
		 .  '   setTimeout(function(){makeGAMPopup()}, 1000);'
		 .	'});';

	$outp.= '</script>';
	$outp.= renderGAMpopup();
	
	return $outp;
}

?>
