<?php
 	global $microsite;
	$microsite = true; 
	get_header();
	$cat_slug = 'shoot101';
	$zip_finder_bipad = '30314';

	include(get_template_directory() . '/single/microsite-single/microsite-single-default.php');

	get_template_part( '../imo-mags-parent/footer/footer', 'microsite' ); 
?>