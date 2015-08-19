<?php
	$microsite = true;
	get_header();
	
	$region_name = 'Northwest';
	
	$cat = get_query_var('cat');
	$yourcat = get_category ($cat);
	$cat_slug =  $yourcat->slug;
	
	
	include(get_stylesheet_directory() . '/content/deer-zone/region-category-template.php');
?>



