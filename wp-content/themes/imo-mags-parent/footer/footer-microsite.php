<?php
	$microsite = true;
	
	$dartDomain = get_option("dart_domain", $default = false);
	
	// When creating the video page for microsite, the page slug shoud be $category_slug-video. Example bigger-bucks-video
	$page_slug=$post->post_name;
	$page_slug = str_replace('-video', '', $page_slug);
	
/*
	$cat = get_query_var('cat');
	$thiscat = get_category ($cat);
	$catslug = $thiscat->slug;
*/
	
	
/* ------------------------------------------------------------------------
	Petersens Hunting 
---------------------------------------------------------------------------*/
	if ($dartDomain == "imo.hunting") { 
		if ( is_category("wheels-afield") || in_category("wheels-afield")) {
			get_template_part("footer/microsite-footers/petersenshunting/footer", "wheels-afield");		}
	} 


/* ------------------------------------------------------------------------
	Wildfowl 
---------------------------------------------------------------------------*/
	elseif ($dartDomain == "imo.wildfowl") { 
		
		if ( is_category('gear-guide') || in_category('gear-guide')) {
			get_template_part('footer/microsite-footers/wildfowl/footer', "gear-guide");
		} 
		else {
			get_template_part('footer/microsite-footers/wildfowl/footer', $catslug);
		}
	}	
	
	
/* ------------------------------------------------------------------------
	Game and Fish 
---------------------------------------------------------------------------*/
	elseif ($dartDomain == "imo.gameandfish") { 
		$deer_zone_cat = array("deer-zone", "ne", "se", "mw", "sw", "nw", "dz-sweeps");
				
		if ( is_category('crossbows') || in_category('crossbows') || in_category('crossbow-revolution')) {
			get_template_part('footer/microsite-footers/gameandfish/footer', "crossbows");
		} elseif ( is_category($deer_zone_cat) || in_category($deer_zone_cat)) {
			get_template_part('footer/microsite-footers/gameandfish/footer', "deer-zone");
		} 
		
	}

		
/* ------------------------------------------------------------------------
	In-Fisherman 
---------------------------------------------------------------------------*/
	elseif ($dartDomain == "imo.in-fisherman") { 
		$rigged_cat = array("rigged-ready", "ne", "se", "mw", "sw", "nw", "sweeps");
		
		if ( is_category($rigged_cat) || in_category($rigged_cat)) {
			get_template_part('footer/microsite-footers/in-fisherman/footer', "rigged-ready");
		} 
		else {
			get_template_part('footer/microsite-footers/in-fisherman/footer', $catslug);
		}
	}


/* ------------------------------------------------------------------------
	Guns & Ammo 
---------------------------------------------------------------------------*/
	elseif ($dartDomain == "imo.gunsandammo") { 
		
		if ( is_category('shoot101') || in_category('shoot101')) {
			get_template_part('footer/microsite-footers/gunsandammo/footer', "shoot101");
		} 
		else {
			get_template_part('footer/microsite-footers/gunsandammo/footer', $catslug);
		}
	}
	
/* ------------------------------------------------------------------------
	North American Whitetail 
---------------------------------------------------------------------------*/
	elseif ($dartDomain == "imo.northamericanwhitetail") { 		
		if ( is_category('bigger-bucks') || in_category('bigger-bucks') || $page_slug == 'bigger-bucks') {
			get_template_part('footer/microsite-footers/naw/footer', "bigger-bucks");
		} 
		else {
			get_template_part('footer/microsite-footers/naw/footer', $catslug);
		}
	}
	
	
/* ------------------------------------------------------------------------
	Else 
---------------------------------------------------------------------------*/	
	 else { 
		get_template_part('footer/microsite-footers/footer', "microsite");
	}  

?>