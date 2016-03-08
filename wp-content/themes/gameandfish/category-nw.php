<?php
	$microsite = true;
	$microsite_rigged = true;
	get_header();
	
	$region_name = 'Northwest';
	
	$cat = get_query_var('cat');
	$yourcat = get_category ($cat);
	$cat_slug =  $yourcat->slug;
	
	
	include(get_template_directory() . '/content/microsite-template-parts/deer-zone/region-category-template.php');
?>



