<?php
	global $microsite;
	$microsite = true;
	get_header(); 
	$cat_slug = 'wheels-afield';
	$zip_finder_bipad = '34837';
	
	include(get_template_directory() . '/single/microsite-single/microsite-single.php');

	get_footer(); 
?>