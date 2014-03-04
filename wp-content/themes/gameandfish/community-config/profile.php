<?php
	///////////////////////////////////////////
	//Profile Community Page Configuration
	///////////////////////////////////////////
	$IMO_COMMUNITY_CONFIG = NULL;
	$IMO_COMMUNITY_CONFIG['community_home_slug'] = "profile";//This slug will override ANY setting in wordpress.
	$IMO_COMMUNITY_CONFIG['page_type'] = 'profile';
	$IMO_COMMUNITY_CONFIG['page_title'] = 'User Profile';
	$IMO_COMMUNITY_CONFIG['template'] = '/gameandfish/profile.php';
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
			"script-name" => "timeago-js",
			"script-path" => "js/jquery.timeago.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "community-common-js",
			"script-path" => "gameandfish/js/community-common.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "community-profile-js",
			"script-path" => "gameandfish/js/community-profile.js",
			"script-dependencies" => array('jquery')
		)
	);

	$IMO_COMMUNITY_CONFIG['additional_styles'] = array(
		array(
			"style-name" => "community-common-css",
			"style-path" => "gameandfish/css/community-common.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "community-profile-css",
			"style-path" => "gameandfish/css/community-profile.css",
			"style-dependencies" => array('community-common-css')
		)
	);

	global $IMO_COMMUNITY;
	$IMO_COMMUNITY['community-profile'] = $IMO_COMMUNITY_CONFIG;
?>