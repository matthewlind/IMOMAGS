<?php
	$microsite = true;
	get_header();
	
	$cat_slug = 'gear-guide';

	include(get_template_directory() . '/content/microsite-category/microsite-category-default.php');
		
	get_footer(); 
?>