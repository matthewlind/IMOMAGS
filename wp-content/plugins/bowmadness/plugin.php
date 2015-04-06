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
		    				<a href="http://www.bowhuntingmag.com/battle-of-the-bows/enter/" target="_blank"></a>
		    			</div>
						<div class="related-content">
			    			<h4>Related Stories</h4>
							<ul>
			    				<li><a href="" target="_blank" class="mfp-player1link">Review: <span class="mfp-player1name"></span></a></li>
								<li><a href="" target="_blank" class="mfp-player2link">Review: <span class="mfp-player2name"></span></a></li>
							</ul>
						</div>
		    		</div>
		    		<div id="popupAdRight" class="modal-footer-content-right"></div>
	    		</div>
	    	</div>
	    </div>
    </div>
</script>
EOF;


	return $outp;
}
function jsGAMRender($mobile) {
	
	
	$pageID = get_the_ID();
	$image = get_field("promo_image",$pageID);

	if( !empty($image) ){
		$promo = '<div class="bob-promo-image"><a href="'.get_field("image_url").'" target="_blank"><img src="'.$image["url"].'" alt="'.$image["alt"].'" /></a></div>';
	}else{
		$promo = "";
	}
	$outp = "";
	//$mobile = true;
	$ismobile = ($mobile)? "true":"false";
	 
	$results = file_get_contents("http://apps.imoutdoors.com/bracket/getActiveRound?bracketid=2");
	
	$results = json_decode($results,true);
	
	$madnessround = $results[0]['activeround'];
	
	
  if($mobile) {
	$outp.= '<div class="ga-madness-votestats"></div>';
	
	//if (function_exists('wpsocialite_markup'))
		 	//$outp.= wpsocialite_markup();
		 	
	$ad1 = '<div id="div-bob_region_sponsor_1"><script type="text/javascript">googletag.cmd.push(function() { googletag.display("div-bob_region_sponsor_1"); });</script></div>';
	$ad2 = '<div id="div-bob_region_sponsor_2"><script type="text/javascript">googletag.cmd.push(function() { googletag.display("div-bob_region_sponsor_2"); });</script></div>';
	$ad3 = '<div id="div-bob_region_sponsor_3"><script type="text/javascript">googletag.cmd.push(function() { googletag.display("div-bob_region_sponsor_3"); });</script></div>';
	$ad4 = '<div id="div-bob_region_sponsor_4"><script type="text/javascript">googletag.cmd.push(function() { googletag.display("div-bob_region_sponsor_4"); });</script></div>';
		 	
	$outp.= '<div id="madtabs">'
		 .  '  <ul class="rounds">'
		 //.  '    <li><a href="#madtabs-1">1st</a></li>'
		 .  '    <li><a href="#madtabs-2">1st</a></li>'
		 .  '    <li><a href="#madtabs-3">Sweet 16</a></li>'
		 .  '    <li><a href="#madtabs-4">Elite 8</a></li>'
		 .  '    <li><a href="#madtabs-5">Final 4</a></li>'
		 .  '    <li class="final-round"><a href="#madtabs-6">Final</a></li>'
		 .  '  </ul>'
					
		 .  '  <div style="clear:both;" id="madtabs-2">'
		// .  '    <div class="gun-types">'
		// .  '      <select>'
		// .  '        <option value="">SELECT A BOW REGION</option>'
		// .  '        <option value="#compound1">Compound 1</option>'
		// .  '        <option value="#compound2">Compound 2</option>'
		// .  '        <option value="#crossbows1">Crossbows 1</option>'
		// .  '        <option value="#crossbows2">Crossbows 2</option>'
		// .  '      </select>'
		// .  '    </div>'
		 
		 .  '    <h2 id="compound1">Compound A</h2>'
		 . 			$ad1
		 .  '    <div class="mreg1"></div>'
		 .  '    <h2 id="compound2">Compound B</h2>'
		 .  		$ad2
		 .  '    <div class="mreg3"></div>'
		 .  '    <h2 id="crossbows1">Crossbows A</h2>'
		 .  		$ad3
		 .  '    <div class="mreg4"></div>'
		 .  '    <h2 id="crossbows2">Crossbows B</h2>'
		 .  		$ad4
		 .  '    <div class="mreg2"></div>'

		 .  '  </div>'

		 .  '  <div style="clear:both;" id="madtabs-3">'
		 .  '    <h2 id="compound1">Compound A</h2>'
		 . 			$ad1
		 .  '    <div class="mreg1"></div>'
		 .  '    <h2 id="compound2">Compound B</h2>'
		 .  		$ad2
		 .  '    <div class="mreg3"></div>'
		 .  '    <h2 id="crossbows1">Crossbows A</h2>'
		 .  		$ad3
		 .  '    <div class="mreg4"></div>'
		 .  '    <h2 id="crossbows2">Crossbows B</h2>'
		 .  		$ad4
		 .  '    <div class="mreg2"></div>'
		 
		 .  '  </div>'
		 .  '  <div style="clear:both;" id="madtabs-4">'

		 .  '    <h2 id="compound2">Compound A</h2>'
		 . 			$ad1
		 .  '    <div class="mreg1"></div>'
		 .  '    <h2 id="compound2">Compound B</h2>'
		 .  		$ad2
		 .  '    <div class="mreg3"></div>'
		 .  '    <h2 id="crossbows1">Crossbows B</h2>'
		 .  		$ad3
		 .  '    <div class="mreg4"></div>'
		 .  '    <h2 id="crossbows2">Crossbows A</h2>'
		 .  		$ad4
		 .  '    <div class="mreg2"></div>'
		 		 
		 .  '  </div>'
		 .  '  <div style="clear:both;" id="madtabs-5">'
		 .  '    <br>'. $ad1
		 .  		$ad2
		 .  '    <div class="mreg5 match92"></div>'
		 .  '    <div class="mreg6 match93"></div>'
		 .  		$ad3
		 .  		$ad4
		 
		 .  '  </div>'
		 
		 .  '  <div style="clear:both;" id="madtabs-6">'
		 .  '    <br><div style="margin:10px 0px 0px 6px;clear:both;font-size:18px;font-weight:bold;">Championship</div>'
		 .  '    <div class="mreg7 match94"></div>'
		 .  '    <br>'. $ad1
		 .  		$ad2
		 .  		$ad3
		 .  		$ad4
		 
		 .  '  </div>'		 
		 .  '</div>'
		 .  $promo;

  }
  else {
	
	$outp.= '<ul class="schedule">'
		 //.  '  <li class="'.(($madnessround==2)? "active-round":"").'">First Round<div>March 18-23</div></li>'
		 .  '  <li class="'.(($madnessround==3)? "active-round":"").'">First Round<div>August 18-24</div></li>'
		 .  '  <li class="'.(($madnessround==4)? "active-round":"").'">Sweet 16<div>August 25-31</div></li>'
		 .  '  <li class="'.(($madnessround==5)? "active-round":"").'">Elite 8<div>September 1-7</div></li>'
		 .  '  <li class="'.(($madnessround==6)? "active-round":"").'">Final Four<div>September 8-14</div></li>'
		 .  '  <li class="'.(($madnessround==7)? "active-round":"").'">Final Round<div>September 15-19</div></li>'
		 .  '</ul>'
		 //.  wpsocialite_markup()
		;
	// After all the voting is done, after round 7, you'll have to 
	// go into the db and manually change the last match to "8".
	
	
	if($madnessround == 6) {		 
	$outp.= '<div class="ga-madness-votestats" style="margin-bottom:20px;clear:both;"></div>'
		 .  '<div class="regions region-final" style="display:block;">'
		 .  '  <div class="finalsadvert" style="margin-top:0px;">'
		 
		// .  ' <div id="bob_presenting_sponsor"></div>'
		
		 .  ' <div id="div-bob_presenting_sponsor"><script type="text/javascript">googletag.cmd.push(function() { googletag.display("div-bob_presenting_sponsor"); });</script></div>'
		 
		 .  '  </div>'
		 .  '  <div class="final-wrapper">'
		 .  '    <h2>Final Round</h2>'
		 .  '    <div class="column column5 match92"></div>'
		 .  '    <div class="column column6 match94" style="padding-top:20px;"></div>'
		 .  '    <div class="column column7 match93"></div>'
		 .  '  </div>'		 
		 .  '</div>';
	}
	else {
		$outp.= '<div class="ga-madness-votestats"></div>';
	}

	$outp.= '<div class="ga-madness">'
		 .  '<div class="region-titles">'
		 .	'  <div class="region-left">'
		 .	'    <h2>Compound A</h2><div id="div-bob_region_sponsor_1"><script type="text/javascript">googletag.cmd.push(function() { googletag.display("div-bob_region_sponsor_1"); });</script></div>'
		 .	'  </div>'
		 .	'  <div class="region-right">'
		 .	'    <h2>Compound B</h2><div id="div-bob_region_sponsor_2"><script type="text/javascript">googletag.cmd.push(function() { googletag.display("div-bob_region_sponsor_2"); });</script></div>'
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

	if($madnessround < 6) {		 
	$outp.= '<div class="regions region-final"	>'
		 .  '  <div class="finalsadvert">'
		 .  ' <div id="div-bob_presenting_sponsor"><script type="text/javascript">googletag.cmd.push(function() { googletag.display("div-bob_presenting_sponsor"); });</script></div>'		
		 .  '  </div>'
		 .  '  <div class="final-wrapper">'
		 .  '    <h2>Final Round</h2>'
		 .  '    <div class="column column5 final-modal match92"></div>'
		 .  '    <div class="column column6 final-modal match94"></div>'
		 .  '    <div class="column column7 final-modal match93"></div>'
		 .  '  </div>'		 
		 .  '</div>';
	}
		 
	$outp.= '<div class="region-titles">'
		 .	'  <div class="region-left">'
		 .	'    <h2>Crossbows A</h2><div id="div-bob_region_sponsor_3"><script type="text/javascript">googletag.cmd.push(function() { googletag.display("div-bob_region_sponsor_3"); });</script></div>'
		 .	'  </div>'
		 .	'  <div class="region-right">'
		 .	'    <h2>Crossbows B</h2><div id="div-bob_region_sponsor_4"><script type="text/javascript">googletag.cmd.push(function() { googletag.display("div-bob_region_sponsor_4"); });</script></div>'
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
	 
		 .  '</div>'
		 .  $promo;
  }	

	$outp.= '<script type="text/javascript">';
	$outp.= 'var ismobile = '.$ismobile.';';
	
	$outp.= 'jQuery(document).ready(function() {'
		 .  '	getGAMData(1,3);getGAMData(1,4);getGAMData(1,5);'
		 .  '	getGAMData(2,3);getGAMData(2,4);getGAMData(2,5);'
		 .  '	getGAMData(3,3);getGAMData(3,4);getGAMData(3,5);'
		 .  '	getGAMData(4,3);getGAMData(4,4);getGAMData(4,5);'
	
		 .  '	getGAMData(0,"92,93,94");'
		 .  '   getStats();'
		 .  '   setTimeout(function(){makeGAMPopup()}, 1000);'
		 .  '   setTimeout(function(){autoPopup()}, 2000);'
		 .  '   setTimeout(function(){
		 			//alert(madnessround);
		 			//jQuery("#madtabs").tabs({selected: (madnessround - 2)})
		 		}, 3000);'
		 .	'});';

	$outp.= '</script>';
	$outp.= renderGAMpopup();
	
	return $outp;
}

//Promo image custom field
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_battle-of-the-bows',
		'title' => 'Battle of the Bows',
		'fields' => array (
			array (
				'key' => 'field_54130668ddfc4',
				'label' => 'Promo Image',
				'name' => 'promo_image',
				'type' => 'image',
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_5413068dddfc5',
				'label' => 'Image URL',
				'name' => 'image_url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'battle-of-the-bows.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}


?>
