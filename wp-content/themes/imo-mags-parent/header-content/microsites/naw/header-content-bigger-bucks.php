<?php 
	//fixed_connect_footer();
	if ( mobile() ) { ?><div class="mobile-adhesion"><?php imo_ad_placement("mobile_adhesion_320x50"); ?></div><?php } 
		
	$cat_slug = 'bigger-bucks';	
	$theme_location = 'microsite';
	$blog_title = get_bloginfo('name');
	$zip_finder_bipad = '0';
	
	include(get_template_directory() . '/header-content/microsites/header-microsite-default.php');		
?>