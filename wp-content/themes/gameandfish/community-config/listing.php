<?php
	///////////////////////////////////////////
	//Main Community Page Configuration
	///////////////////////////////////////////
	$IMO_COMMUNITY_CONFIG = NULL;
	$IMO_COMMUNITY_CONFIG['community_home_slug'] = "community";//This slug will override ANY setting in wordpress.
	$IMO_COMMUNITY_CONFIG['page_type'] = 'listing';
	$IMO_COMMUNITY_CONFIG['page_title'] = 'Game & Fish Community';
	$IMO_COMMUNITY_CONFIG['template'] = '/gameandfish/listing.php';
	$IMO_COMMUNITY_CONFIG['dart_page'] = 'gf_community';
	$IMO_COMMUNITY_CONFIG['dart_sect'] = 'gfcommunity';
	$IMO_COMMUNITY_CONFIG['post_types'] = $gfPostTypes;

	$IMO_COMMUNITY_CONFIG['additional_scripts'] = array(
		//Third Part Scripts
		array(
			"script-name" => "underscore-js",
			"script-path" => "js/underscore-min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "community-common-js",
			"script-path" => "gameandfish/js/community-common.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "bootstrap-dropdown-js",
			"script-path" => "gameandfish/js/bootstrap-dropdown.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "community-listing-js",
			"script-path" => "gameandfish/js/community-listing.js",
			"script-dependencies" => array('jquery',"bootstrap-dropdown-js")
		)
	);

	$IMO_COMMUNITY_CONFIG['additional_styles'] = array(
		array(
			"style-name" => "community-common-css",
			"style-path" => "gameandfish/css/community-common.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "bootstrap-dropdown-css",
			"style-path" => "gameandfish/css/bootstrap-dropdown.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "community-listing-css",
			"style-path" => "gameandfish/css/community-listing.css",
			"style-dependencies" => array('community-common-css',"bootstrap-dropdown-css")
		)
	);

	global $IMO_COMMUNITY;
	$IMO_COMMUNITY['community-main'] = $IMO_COMMUNITY_CONFIG;
?>