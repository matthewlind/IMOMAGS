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
	In-Fisherman 
---------------------------------------------------------------------------*/	 
	elseif ($dartDomain == "imo.in-fisherman") { 
		$rigged_cat = array("rigged-ready", "ne", "se", "mw", "sw", "nw");
		
		if ( is_category($rigged_cat) || in_category($rigged_cat)) {
			include("wp-content/themes/imo-mags-parent/header-content/microsites/in-fisherman/header-content-riggedready.php");
		} 
		else {
			include("wp-content/themes/imo-mags-parent/header-content/microsites/in-fisherman/header-content-". $catslug . ".php");
		}
	}
	

/* ------------------------------------------------------------------------
	Else 
---------------------------------------------------------------------------*/	
	 else { 
		include("wp-content/themes/imo-mags-parent/header-content/microsites/header-content-microsite");
	} 

?>