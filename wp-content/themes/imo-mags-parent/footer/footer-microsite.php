<?php
	$microsite = true;
	
	$dartDomain = get_option("dart_domain", $default = false);
	
	$cat = get_query_var('cat');
	$thiscat = get_category ($cat);
	$catslug = $thiscat->slug;
	
/* ------------------------------------------------------------------------
	Petersens Hunting 
---------------------------------------------------------------------------*/
	if ($dartDomain == "imo.hunting") { 
		if ( is_category("wheels-afield") || in_category("wheels-afield")) {
			get_template_part("footer/microsite-footers/petersenshunting/footer", "wheels-afield");		}
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
	Else 
---------------------------------------------------------------------------*/	
	 else { 
		get_template_part('footer/microsite-footers/footer', "microsite");
	}  

?>