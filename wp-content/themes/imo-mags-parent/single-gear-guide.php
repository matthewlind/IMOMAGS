<?php
	global $microsite;
	$microsite = true;
	get_header(); 
	$cat_slug = 'gear-guide';
	$zip_finder_bipad = '000000';
	
	include(get_template_directory() . '/single/microsite-single/microsite-single-default.php');

	get_footer(); 
?>