<?php
	$microsite = true;
	$microsite_rigged = true;
	get_header();
	
	$region_name = 'Southwest';
	
	$cat = get_query_var('cat');
	$yourcat = get_category ($cat);
	$cat_slug =  $yourcat->slug;
	
	
	include(get_template_directory() . '/content/microsite-template-parts/rigged-ready/region-category-template.php');
?>