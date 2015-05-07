<?php 
	
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
		include("wp-content/themes/imo-mags-parent/header-content/microsites/petersenshunting/header-content-wheels-afield.php");
		//get_template_part('wp-content/themes/imo-mags-parent/header-content/microsites/petersenshunting/header-content', 'wheels-afield');
	}
} // end if ($site_url)	


/* ------------------------------------------------------------------------
	In-Fisherman 
--------------------------------------------------------------------------- */n
elseif ($site_url == "http://www.in-fisherman") { 
	$rigged_cat = array("rigged-ready", "ne", "se", "mw", "sw", "nw");
	
	if ( is_category($rigged_cat) || in_category($rigged_cat)) {
		include("wp-content/themes/imo-mags-parent/header-content/microsites/in-fisherman/header-content-riggedready.php");
	} 
	else {
		include("wp-content/themes/imo-mags-parent/header-content/microsites/in-fisherman/header-content-". $catslug . ".php");
	}
} // end elseif ($site_url)


/* ------------------------------------------------------------------------
	Else 
--------------------------------------------------------------------------- */
 else { 
	include("wp-content/themes/imo-mags-parent/header-content/microsites/header-content-microsite");
} 

?>