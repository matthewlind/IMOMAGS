<?php
	$microsite = true;
	get_header();
	
	$cat_slug = 'shoot101';
	
	include(get_template_directory() . '/content/microsite-category/microsite-category-default.php');
	
	get_template_part( '../imo-mags-parent/footer/footer', 'microsite' ); 
?>