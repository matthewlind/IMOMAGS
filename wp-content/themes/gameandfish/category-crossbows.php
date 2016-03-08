<?php
	$microsite = true;
	$microsite_default = true;
	get_header();

	$dartDomain = get_option("dart_domain", $default = false);

	include(get_template_directory() . '/content/microsite-category/microsite-category-default.php');
		
	get_footer(); 
?>