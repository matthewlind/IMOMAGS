<?php
$microsite = true;

$cat = get_query_var('cat');
$thiscat = get_category ($cat);
$catslug = $thiscat->slug;

$url_string = site_url();
$url_suffixes = array(".com", ".com/", ".artem", ".artem/", ".fox", ".fox/");
$site_url = str_replace($url_suffixes, "", $url_string);
	
	
/* ------------------------------------------------------------------------
	Petersens Hunting 
--------------------------------------------------------------------------- */
if ($site_url == "http://www.petersenshunting") { 
			
	if ( is_category("wheels-afield") || in_category("wheels-afield")) {
		get_template_part('footer/microsite-footers/petersenshunting/footer', 'wheels-afield');
	}
	
} // end if ($site_url)

	
/* ------------------------------------------------------------------------
	In-Fisherman 
--------------------------------------------------------------------------- */		
elseif ($site_url == "http://www.in-fisherman") { 
	$rigged_cat = array("rigged-ready", "ne", "se", "mw", "sw", "nw");
	
	if ( is_category($rigged_cat) || in_category($rigged_cat)) {
		get_template_part('footer/microsite-footers/in-fisherman/footer', 'rigged-ready');
	} 
	else {
		get_template_part('footer/microsite-footers/in-fisherman/footer', $catslug);
	}
}
	
	
/* ------------------------------------------------------------------------
	Else 
--------------------------------------------------------------------------- */	
 else { 
	get_template_part('footer/microsite-footers/footer', "microsite");
}  

?>