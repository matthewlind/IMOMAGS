<?php
	$microsite = true;
	$microsite_default = true;
	get_header();
	
	//include('../imo-mags-parent/content/microsite-category/microsite-category-default.php');
	
	get_template_part( '../imo-mags-parent/content/microsite-category/microsite-category', 'default' ); 
	get_template_part( '../imo-mags-parent/footer/footer', 'microsite' ); 
?>