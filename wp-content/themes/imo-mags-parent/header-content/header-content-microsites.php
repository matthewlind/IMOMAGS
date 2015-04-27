<?php 
	$cat = get_query_var('cat');
	$thiscat = get_category ($cat);
	$catslug = $thiscat->slug;
	
	
	// Petersens Hunting
	if (site_url() == "http://www.petersenshunting.com/") { 
		include("wp-content/themes/imo-mags-parent/header-content/microsites/petersenshunting/header-content-". $catslug . ".php");
	} 	
	
	// In-Fisherman
	elseif (site_url() == "http://www.in-fisherman.artem") { 
		$rigged_cat = array("riggedready", "northeast", "southeast", "midwest", "southwest", "northwest");
		
		if ( is_category($rigged_cat) || in_category($rigged_cat)) {
			include("wp-content/themes/imo-mags-parent/header-content/microsites/in-fisherman/header-content-riggedready.php");
		} 
		else {
			include("wp-content/themes/imo-mags-parent/header-content/microsites/in-fisherman/header-content-". $catslug . ".php");
		}
	}
	
	
	 else { 
		include("wp-content/themes/imo-mags-parent/header-content/microsites/header-content-microsite");
	} 

?>