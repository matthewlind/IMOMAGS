<?php
	$microsite = true;
	
	$cat = get_query_var('cat');
	$thiscat = get_category ($cat);
	$catslug = $thiscat->slug;
	
	$url_string = site_url();
	$url_suffixes = array(".com", ".com/", ".artem", ".artem/", ".fox", ".fox/");
	$site_url = str_replace($url_suffixes, "", $url_string);
	
	
// Petersens Hunting
	if ($site_url == "http://www.petersenshunting") { 
		get_template_part('footer/microsite-footers/in-fisherman/footer', $catslug);
	} 
	
		
// In-Fisherman
	elseif ($site_url == "http://www.in-fisherman") { 
		$rigged_cat = array("riggedready", "northeast", "southeast", "midwest", "southwest", "northwest");
		
		if ( is_category($rigged_cat) || in_category($rigged_cat)) {
			get_template_part('footer/microsite-footers/in-fisherman/footer', "riggedready");
		} 
		else {
			get_template_part('footer/microsite-footers/in-fisherman/footer', $catslug);
		}
	}
	
	
	 else { 
		get_template_part('footer/microsite-footers/footer', "microsite");
	}  

?>