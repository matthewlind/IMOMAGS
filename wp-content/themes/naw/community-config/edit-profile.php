<?php
	///////////////////////////////////////////
	//Edit Profile Community Page Configuration
	///////////////////////////////////////////
	$IMO_COMMUNITY_CONFIG = NULL;
	$IMO_COMMUNITY_CONFIG['community_home_slug'] = "profile";//This slug will override ANY setting in wordpress.
	$IMO_COMMUNITY_CONFIG['page_type'] = 'profile-edit';
	$IMO_COMMUNITY_CONFIG['page_title'] = 'Edit Profile';
	$IMO_COMMUNITY_CONFIG['template'] = '/naw/profile-edit.php';
	$IMO_COMMUNITY_CONFIG['dart_page'] = 'naw_community';
	$IMO_COMMUNITY_CONFIG['dart_sect'] = 'nawcommunity';
	$IMO_COMMUNITY_CONFIG['post_types'] = $nawPostTypes;


	$IMO_COMMUNITY_CONFIG['additional_scripts'] = array(
		//Third Part Scripts
		array(
			"script-name" => "underscore-js",
			"script-path" => "js/underscore-min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "community-common-js",
			"script-path" => "naw/js/community-common.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "community-profile-edit-js",
			"script-path" => "naw/js/community-profile.js",
			"script-dependencies" => array('jquery')
		)
	);

	$IMO_COMMUNITY_CONFIG['additional_styles'] = array(
		array(
			"style-name" => "community-common-css",
			"style-path" => "naw/css/community-common.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "community-profile-edit-css",
			"style-path" => "naw/css/community-profile.css",
			"style-dependencies" => array('community-common-css')
		)
	);

	global $IMO_COMMUNITY;
	$IMO_COMMUNITY['community-profile-edit'] = $IMO_COMMUNITY_CONFIG;
?>