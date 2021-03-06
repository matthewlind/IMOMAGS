<?php
/*  Copyright 2014 Intermedia Outdoors

*/

/*
Plugin Name: G&A Madness Bracket/Voting
Plugin URI: https://imomags.com
Description: 2014 
Author: Jeff Burrows
Author URI:
Version: 0.1
Stable tag: 0.1
License: GPL2
*/

	
	
function madness_func( $atts ) {
	global $ismobile;

	return jsGAMRender($ismobile);
}
add_shortcode( 'madness', 'madness_func' );

add_action('init', function() {

	setcookie('imo_nocache', 'true');
	
});

wp_enqueue_script( 'madnessjs', plugin_dir_url( __FILE__ ) . 'madness6.js', array( 'jquery' ) );
wp_enqueue_style( 'madnesscss', plugin_dir_url( __FILE__ ) . 'madness.css' );
wp_enqueue_script( 'magnificjs', plugin_dir_url( __FILE__ ) . 'jquery.magnific-popup.js');
wp_enqueue_style( 'magnificcss', plugin_dir_url( __FILE__ ) . 'magnific-popup.css');
wp_enqueue_style( 'popupAD', plugin_dir_url( __FILE__ ) . 'popupAD.css');
wp_enqueue_script( 'waituntilexists', plugin_dir_url( __FILE__ ) . 'waituntilexists.js');
wp_enqueue_script( 'htmlparser', plugin_dir_url( __FILE__ ) . 'htmlParser.js');
wp_enqueue_script( 'postscribe', plugin_dir_url( __FILE__ ) . 'postscribe.js');
wp_enqueue_script( 'xdomainrequest', plugin_dir_url( __FILE__ ) . 'xdomainrequest.min.js');
wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js');
wp_enqueue_script( 'jquery-cookie', plugin_dir_url( __FILE__ ) . 'jquery-cookie.js');
	
function renderGAMpopup($mobile) {
	
	$outp = "";
	$outp.= <<<EOF
<script id="tmplGAMpopup" type="text/x-magnific-popup-template">
    <div class="white-popup mfp-hidden"><div class="mfp-close"></div>
        <div class='mfp-counter'></div>
	    <div class="popup-inner clearfix gun">
	    	
	    	<div id="popupAD">
	    		<div class='close-ad' onclick='closeInterstitial();'>Go to the next matchup <span>&raquo;</span></div>
	    	</div>
	    
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
	    	<div class="filler">&nbsp;</div>
	    	<div class="vote-again">Vote again <span>&raquo;</span></div>
	    	
	    	<div class="modal-footer">
	    		<div class="modal-footer-content">
	    			<div id="popupsponsor">
	    				<a target="_blank" href="http://www.gunsandammo.com/bracket/enter/"></a>
	    			</div>
					<div class="related-content">
		    			<h4>Related Stories</h4>
						<ul>
		    				<li><a href="" target="_blank" class="mfp-player1link"><span class="mfp-player1name"></span></a></li>
							<li><a href="" target="_blank" class="mfp-player2link"><span class="mfp-player2name"></span></a></li>
						</ul>
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
	
	$sessID = substr( "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" , mt_rand( 0 ,50 ) , 1 ) . substr( md5( time() ), 1); //$_COOKIE['imo_sparta'];
	
	file_get_contents("http://apps.imoutdoors.com/bracket/initSession?sessid=$sessID");

	$outp = "";
	//$mobile = true;
	$ismobile = ($mobile)? "true":"false"; 
	$results = file_get_contents("http://apps.imoutdoors.com/bracket/getActiveRound?bracketid=6");
	
	$results = json_decode($results,true);
	
	$madnessround = $results[0]['activeround'];

  if($mobile) { // If it's a mobile device //
	$outp.= '<div class="ga-madness-votestats"></div>';
	
	//if (function_exists('wpsocialite_markup'))
		 	//$outp.= wpsocialite_markup();
	$outp.= '<div id="faded" style="display: none;"></div>';
	$outp.= '
	<div id="captchaWrapper"><br />
		<div class="g-recaptcha" data-sitekey="6LdWGAMTAAAAANfZM5fbK5aNYozpopkz-v_LhhR0"></div>
		<button id="proceed">Proceed</button>
	</div>';	 	
	$outp.= '<div id="madtabs">'
		 .  '  <ul class="rounds" style="min-width:300px;">'
		 .  '    <li class="active-round"><a href="#madtabs-2">1st</a></li>'
		 .  '    <li><a href="#madtabs-3">2nd</a></li>'
		 .  '    <li><a href="#madtabs-4">Sweet 16</a></li>'
		 .  '    <li><a href="#madtabs-5">Elite 8</a></li>'
		 .  '    <li><a href="#madtabs-6">Final 4</a></li>'
		 .  '    <li class="final-round"><a href="#madtabs-7">Final</a></li>'
		 .  '  </ul>'
		/*			
		 .  '  <div id="madtabs-1">'
		 //.  '    <div class="gun-types">'
		 //.  '      <select>'
		 //.  '        <option value="">SELECT A GUN REGION</option>'
		 //.  '        <option value="handguns1">Personal Defense</option>'
		 //.  '        <option value="rifles1">Tactical</option>'
		 //.  '        <option value="handguns2">Hunting</option>'
		 //.  '        <option value="rifles2">Exclusive/Custom</option>'
		 //.  '      </select>'
		 //.  '    </div>'
		 .  '    <h2 id="handguns1">Personal Defense</h2>'
		 .  '    <div>'. imo_ad_placement("region1") .'</div>'
		 .  '    <div class="mreg1"></div>'
		 .  '    <h2 id="rifles1">Tactical</h2>'
		 .  '    <div>'. imo_ad_placement("region2") .'</div>'
		 .  '    <div class="mreg3"></div>'
		 .  '    <h2 id="handguns2">Hunting</h2>'
		 .  '    <div>'. imo_ad_placement("region3") .'</div>'
		 .  '    <div class="mreg4"></div>'
		 .  '    <h2 id="rifles2">Exclusive/Custom</h2>'
		 .  '    <div>'. imo_ad_placement("region4") .'</div>'
		 .  '    <div class="mreg2"></div>'

		 .  '  </div>'
		*/ 

		 .  '   <div class="madtabs-5 tabcontent">'
		 .  '    <div class="mreg5 match217"></div>'
		 .  '    <div class="mreg6 match218"></div>'
		 .  '   </div>'

		 .  '   <div class="madtabs-6 tabcontent">'
		 .  '    <br><div style="margin:10px 0px 0px 6px;clear:both;font-size:18px;font-weight:bold;">Championship</div>'
		 .  '    <div class="mreg7 match219"></div>'
		 .  '   </div>'


		 .  '  <h2 id="handguns2">Personal Defense</h2>'
		 .  '  <div id="region1">'
		 .  '    <script type="text/javascript">'
		 .	'      googletag.cmd.push(function() { googletag.display("region1"); });'
		 .	'    </script>'
		 .	'  </div>'
		 
		 .  '  <div class="madtabs-2 tabcontent">'
		 .  '    <div class="mreg1"></div>'
		 .	'  </div>'
		 
		 .  '  <div class="madtabs-3 tabcontent">'
		 .  '    <div class="mreg1"></div>'
		 .	'  </div>'

		 .  '  <div class="madtabs-4 tabcontent">'
		 .  '    <div class="mreg1"></div>'
		 .	'  </div>'
		 
		 .  '  <h2 id="rifles">Tactical</h2>'
		 .  '  <div id="region2">'
		 .  '    <script type="text/javascript">'
		 .	'      googletag.cmd.push(function() { googletag.display("region2"); });'
		 .	'    </script>'
		 .	'  </div>'		 
		 
		 .  '  <div class="madtabs-2 tabcontent">'
		 .  '    <div class="mreg2"></div>'
		 .	'  </div>'
		 
		 .  '  <div class="madtabs-3 tabcontent">'
		 .  '    <div class="mreg2"></div>'
		 .	'  </div>'
		 
		 .  '  <div class="madtabs-4 tabcontent">'
		 .  '    <div class="mreg2"></div>'
		 .	'  </div>'
		 
		 .  '  <h2 id="ar15s">Hunting</h2>'
		 .  '  <div id="region3">'
		 .  '    <script type="text/javascript">'
		 .	'      googletag.cmd.push(function() { googletag.display("region3"); });'
		 .	'    </script>'
		 .	'  </div>'		 
		 
		 .  '  <div class="madtabs-2 tabcontent">'
		 .  '    <div class="mreg3"></div>'
		 .	'  </div>'
		 
		 .  '  <div class="madtabs-3 tabcontent">'
		 .  '    <div class="mreg3"></div>'
		 .	'  </div>'
		 
		 .  '  <div class="madtabs-4 tabcontent">'
		 .  '    <div class="mreg3"></div>'
		 .	'  </div>'
		 
		 .  '  <h2 id="shotguns">Exclusive/Custom</h2>'
		 .  '  <div id="region4">'
		 .  '    <script type="text/javascript">'
		 .	'      googletag.cmd.push(function() { googletag.display("region4"); });'
		 .	'    </script>'
		 .	'  </div>'		 
		 
		 .  '  <div class="madtabs-2 tabcontent">'
		 .  '    <div class="mreg4"></div>'
		 .	'  </div>'
		 
		 .  '  <div class="madtabs-3 tabcontent">'
		 .  '    <div class="mreg4"></div>'
		 .	'  </div>'
		 
		 .  '  <div class="madtabs-4 tabcontent">'
		 .  '    <div class="mreg4"></div>'
		 .	'  </div>'		 	 
		 
		/* 
		 .  '  <div id="OLDmadtabs-2">'
		 .  '   <div class="madtabs-2 tabcontent">'
		 .  '    <h2 id="handguns2">Personal Defense</h2>'
		 .  '    <div>'. imo_ad_placement("region1") .'</div>'
		 .  '    <div class="mreg1"></div>'
		 .  '    <h2 id="rifles">Tactical</h2>'
		 .  '    <div>'. imo_ad_placement("region2") .'</div>'
		 .  '    <div class="mreg3"></div>'
		 .  '    <h2 id="ar15s">Hunting</h2>'
		 .  '    <div>'. imo_ad_placement("region3") .'</div>'
		 .  '    <div class="mreg4"></div>'
		 .  '    <h2 id="shotguns">Exclusive/Custom</h2>'
		 .  '    <div>'. imo_ad_placement("region4") .'</div>'
		 .  '    <div class="mreg2"></div>'		 
		 .  '   </div>'
		 .  '  </div>'
		 
		 .  '  <div id="OLDmadtabs-3">'
		 .  '   <div class="madtabs-3 tabcontent">'
		 .  '    <h2 id="handguns">Personal Defense</h2>'
		 //.  '    <div>'. imo_ad_placement("region1") .'</div>'
		 .  '    <div class="mreg1"></div>'
		 .  '    <h2 id="rifles">Tactical</h2>'
		 //.  '    <div>'. imo_ad_placement("region2") .'</div>'
		 .  '    <div class="mreg3"></div>'
		 .  '    <h2 id="ar15s">Hunting</h2>'
		 //.  '    <div>'. imo_ad_placement("region3") .'</div>'
		 .  '    <div class="mreg4"></div>'
		 .  '    <h2 id="shotguns">Exclusive/Custom</h2>'
		 //.  '    <div>'. imo_ad_placement("region4") .'</div>'
		 .  '    <div class="mreg2"></div>' 
		 .  '   </div>'
		 .  '  </div>'
		 
		 .  '  <div id="OLDmadtabs-4">'
		 .  '   <div class="madtabs-4 tabcontent">'
		 .  '    <h2 id="handguns">Personal Defense</h2>'
		 //.  '    <div>'. imo_ad_placement("region1") .'</div>'
		 .  '    <div class="mreg1"></div>'
		 .  '    <h2 id="rifles">Tactical</h2>'
		 //.  '    <div>'. imo_ad_placement("region2") .'</div>'
		 .  '    <div class="mreg3"></div>'
		 .  '    <h2 id="ar15s">Hunting</h2>'
		 //.  '    <div>'. imo_ad_placement("region3") .'</div>'
		 .  '    <div class="mreg4"></div>'
		 .  '    <h2 id="shotguns">Exclusive/Custom</h2>'
		 //.  '    <div>'. imo_ad_placement("region4") .'</div>'
		 .  '    <div class="mreg2"></div>'
		 .  '   </div>'
		 .  '  </div>'
		 
		 .  '  <div id="OLDmadtabs-5">'
		 .  '   <div class="madtabs-5 tabcontent">'
		 //.  '    <br><div>'. imo_ad_placement("region1") .'</div>'
		 //.  '    <div>'. imo_ad_placement("region2") .'</div>'
		 .  '    <div class="mreg5 match217"></div>'
		 .  '    <div class="mreg6 match218"></div>'
		 //.  '    <div>'. imo_ad_placement("region4") .'</div>'
		 //.  '    <div>'. imo_ad_placement("region3") .'</div>'
		 .  '   </div>'
		 .  '  </div>'
		 
		 .  '  <div id="OLDmadtabs-6">'
		 .  '   <div class="madtabs-6 tabcontent">'
		 .  '    <br><div style="margin:10px 0px 0px 6px;clear:both;font-size:18px;font-weight:bold;">Championship</div>'
		 .  '    <div class="mreg7 match219"></div>'
		 //.  '    <br><div>'. imo_ad_placement("region1") .'</div>'
		 //.  '    <div>'. imo_ad_placement("region2") .'</div>'
		 //.  '    <div>'. imo_ad_placement("region4") .'</div>'
		 //.  '    <div>'. imo_ad_placement("region3") .'</div>'
		 .  '   </div>'
		 .  '  </div>'	
		 
		 */	 
		 .  '</div>';

  }
  else { // If it's not a mobile device //
	

	$outp.= '<ul class="schedule">'
		 .  '  <li class="'.(($madnessround==2)? "active-round":"").'">1st Round<div>March 14-19</div></li>'
		 .  '  <li class="'.(($madnessround==3)? "active-round":"").'">2nd Round<div>March 20-25</div></li>'
		 .  '  <li class="'.(($madnessround==4)? "active-round":"").'">Sweet 16<div>March 26-31</div></li>'
		 .  '  <li class="'.(($madnessround==5)? "active-round":"").'">Elite 8<div>April 1-5</div></li>'
		 .  '  <li class="'.(($madnessround==6)? "active-round":"").'">Final Four<div>April 6-11</div></li>'
		 .  '  <li class="'.(($madnessround==7)? "active-round":"").'">Final Round<div>April 12-14</div></li>'
		 .  '</ul>'
		 //.  wpsocialite_markup()
		 ;
	
	if($madnessround == 8) {		 
	$outp.= '<div class="ga-madness-votestats" style="margin-bottom:20px;clear:both;"></div>'
		 .  '<div class="regions region-final" style="display:block;">'
		 .  '<div class="finalsadvert" style="margin-top:0px;">'
		 .	'	<div id="region1" >'
		 .	'		<script type="text/javascript">'
		 .	'			googletag.cmd.push(function() { googletag.display("region1"); });'
		 .	'		</script>'
		 .	'	</div>'	 
		 .  '</div>'
		 .  '  <div class="final-wrapper">'
		 .  '    <h2>Final Round</h2>'
		 .  '    <div class="column column5 match217"></div>'
		 .  '    <div class="column column6 match219" style="padding-top:20px;"></div>'
		 .  '    <div class="column column7 match218"></div>'
		 .  '  </div>'		 
		 .  '</div>';
	}
	else {
		$outp.= '<div class="ga-madness-votestats" style="clear:both;"></div>';
	}

	$outp.= '<div class="ga-madness">'
		 .  '<div class="region-titles">'
		 .	'  <div class="region-left">'
		 .	'    <h2 style="width:300px;">Personal Defense</h2>'
		 .	'		<div id="region1">'
		 .	'			<script type="text/javascript">'
		 .	'				googletag.cmd.push(function() { googletag.display("region1"); });'
		 .	'			</script>'
		 .	'		</div>'
		 .	'  </div>'
		 .	'  <div class="region-right">'
		 .	'    <h2>Tactical</h2>'
		 .	'		<div id="region2">'
	 	 .	'			<script type="text/javascript">'
	 	 .	'				googletag.cmd.push(function() { googletag.display("region2"); });'
	 	 .	'			</script>'
	 	 .	'		</div>'
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

	if($madnessround < 8) {		 
	$outp.= '<div class="regions region-final">'
		 .  '<div class="finalsadvert" style="margin-top:0px;">'
		 .	'	<div id="presenting" >'
		 .	'		<script type="text/javascript">'
		 .	'			googletag.cmd.push(function() { googletag.display("presenting"); });'
		 .	'		</script>'
		 .	'	</div>'		 
		 .  '</div>'
		 .  '  <div class="final-wrapper">'
		 .  '    <h2>Final Round</h2>'
		 .  '    <div class="column column5 match217"></div>'
		 .  '    <div class="column column6 match219"></div>'
		 .  '    <div class="column column7 match218"></div>'
		 .  '  </div>'		 
		 .  '</div>';
	}
		 
	$outp.= '<div class="region-titles">'
		 .	'  <div class="region-left">'
		 .	'    <h2>Hunting</h2>'
		 .	'		<div id="region3">'		 
		 .	'	 		<script type="text/javascript">'
		 .	'	 			googletag.cmd.push(function() { googletag.display("region3"); });'
		 .	'	 		</script>'
		 .	'	 	</div>'
		 .	'  </div>'
		 .	'  <div class="region-right">'
		 .	'		<h2>Exclusive/Custom</h2>'
		 .	'    <div id="region4">'
		 .	'	 		<script type="text/javascript">'
		 .	'	 			googletag.cmd.push(function() { googletag.display("region4"); });'
		 .	'	 		</script>'
		 .	'	 	</div>'
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
		 .  '<button style="display: none;" onclick="removeCookie();">Remove CAPTCHA Cookie</button>'
		 .  '</div>';
  }	

  // Below gets executed regardless of mobile

	$outp.= '<script type="text/javascript">';
	$outp.= 'var ismobile = '.$ismobile.';';
	$outp.= 'var madness = "'.$sessID.'";';
	$outp.= 'jQuery(document).ready(function() {'
		 .  '	getGAMData(1,2);getGAMData(1,3);getGAMData(1,4);getGAMData(1,5);'
		 .  '	getGAMData(2,2);getGAMData(2,3);getGAMData(2,4);getGAMData(2,5);'
		 .  '	getGAMData(3,2);getGAMData(3,3);getGAMData(3,4);getGAMData(3,5);'
		 .  '	getGAMData(4,2);getGAMData(4,3);getGAMData(4,4);getGAMData(4,5);'
	
		 .  '	getGAMData(0,"217,218,219");'
		 .  '   getStats();'
		 .  '   setTimeout(function(){makeGAMPopup()}, 1000);'
		 .  '   setTimeout(function(){autoPopup()}, 2000);'
		 .	'});';

	$outp.= '</script>';

	$outp.= renderGAMpopup(mobile());
	$outp.= '
	<div id="captchaWrapper">
	<br />
	   <div class="g-recaptcha" data-sitekey="6LeMvRoTAAAAAANfpLHAClGgcs7rgA4bFBVhzcu3"></div>
	   <button id="proceed">Proceed</button>
	</div>';
	
	$outp.= '<div id="faded"></div>';
	return $outp;
}

?>