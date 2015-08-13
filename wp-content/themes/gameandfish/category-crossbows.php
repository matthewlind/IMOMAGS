<?php
	$microsite = true;
	get_header();
	
	$cat_slug = 'crossbow-revolution';
	$dartDomain = get_option("dart_domain", $default = false);

	include(get_template_directory() . '/content/microsite-category/microsite-category-default.php');
		
	get_footer(); 
?>