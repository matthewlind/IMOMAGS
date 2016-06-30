<?php 
	$dartDomain = get_option("dart_domain", $default = false);
	
	$cat = get_query_var('cat');
	$thiscat = get_category ($cat);
	$catslug = $thiscat->slug;
	
	
/* ------------------------------------------------------------------------
	Petersens Hunting 
---------------------------------------------------------------------------*/
	if ($dartDomain == "imo.hunting") { 
		if ( is_category("wheels-afield") || in_category("wheels-afield")) {
			get_template_part("header-content/microsites/petersenshunting/header-content", "wheels-afield");
		}
	} 	


/* ------------------------------------------------------------------------
	Wildfowl 
---------------------------------------------------------------------------*/
	elseif ($dartDomain == "imo.wildfowl") { 		
		if ( is_category('gear-guide') || in_category('gear-guide')) {
			get_template_part('header-content/microsites/wildfowl/header-content', 'gear-guide');
		} 
	}
	
	
/* ------------------------------------------------------------------------
	Game and Fish 
---------------------------------------------------------------------------*/
	elseif ($dartDomain == "imo.gameandfish") { 
		$deer_zone_cat = array("deer-zone", "ne", "se", "mw", "sw", "nw", "dz-sweeps");
				
		if ( is_category('crossbows') || in_category('crossbows') || in_category('crossbow-revolution')) {
			get_template_part('header-content/microsites/gameandfish/header-content', 'crossbows');
		} elseif ( is_category($deer_zone_cat) || in_category($deer_zone_cat)) {
			get_template_part('header-content/microsites/gameandfish/header-content', 'deer-zone');
		} 
	}
	
	
/* ------------------------------------------------------------------------
	In-Fisherman 
---------------------------------------------------------------------------*/	 
	elseif ($dartDomain == "imo.in-fisherman") { 
		$rigged_cat = array("rigged-ready", "ne", "se", "mw", "sw", "nw", "sweeps");
		
		if ( is_category($rigged_cat) || in_category($rigged_cat)) {
			include("wp-content/themes/imo-mags-parent/header-content/microsites/in-fisherman/header-content-riggedready.php");
		} 
	}
	
	
/* ------------------------------------------------------------------------
	Guns & Ammo 
---------------------------------------------------------------------------*/
	elseif ($dartDomain == "imo.gunsandammo") { 		
		if ( is_category('shoot101') || in_category('shoot101')) {
			get_template_part('header-content/microsites/gunsandammo/header-content', 'shoot101');
		} 
	}	


/* ------------------------------------------------------------------------
	Else 
---------------------------------------------------------------------------*/	
	 else { 
		include("wp-content/themes/imo-mags-parent/header-content/microsites/header-content-microsite");
	} 

?>