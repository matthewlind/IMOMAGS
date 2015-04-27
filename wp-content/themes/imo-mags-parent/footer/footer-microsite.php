<?php
	$cat = get_query_var('cat');
	$thiscat = get_category ($cat);
	$catslug = $thiscat->slug;
	
	
// Petersens Hunting
	if (site_url() == "http://www.petersenshunting.com/") { 
		get_template_part('footer/microsite-footers/in-fisherman/footer', $catslug);
	} 
	
// Gans & Ammo
	elseif (site_url() == "http://www.gunsandammo.com/") { 
		get_template_part('footer/microsite-footers/in-fisherman/footer', $catslug);
	} 
	
// Game & Fish
	elseif (site_url() == "http://www.gameandfishmag.com/") { 
		get_template_part('footer/microsite-footers/in-fisherman/footer', $catslug);
	} 
	
// In-Fisherman
	elseif (site_url() == "http://www.in-fisherman.artem") { 
		$rigged_cat = array("riggedready", "northeast", "southeast", "midwest", "southwest", "northwest");
		
		if ( is_category($rigged_cat) || in_category($rigged_cat)) {
			get_template_part('footer/microsite-footers/in-fisherman/footer', "riggedready");
		} 
		else {
			get_template_part('footer/microsite-footers/in-fisherman/footer', $catslug);
		}
	}
	
	
	 else { 
		get_template_part('footer/footer', "microsite");
	}  

?>