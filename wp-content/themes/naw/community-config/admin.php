<?php
	///////////////////////////////////////////
	//Admin Page Testing
	///////////////////////////////////////////
	$IMO_COMMUNITY_CONFIG = NULL;
	$IMO_COMMUNITY_CONFIG['community_home_slug'] = "beta-community";//This slug will override ANY setting in wordpress.
	$IMO_COMMUNITY_CONFIG['page_title'] = 'In-Fisherman Community';
	$IMO_COMMUNITY_CONFIG['template'] = '/templates/blank-template.php';
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
			"script-name" => "backbone-js",
			"script-path" => "js/backbone-min.js",
			"script-dependencies" => array('jquery','underscore-js')
		),
		array(
			"script-name" => "form-params-js",
			"script-path" => "js/formParams.min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "filepicker-io-js",
			"script-path" => "js/filepicker.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "imo-community-grid-js",
			"script-path" => "js/backgrid.min.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js')
		),
		//Application specific scripts
		array(
			"script-name" => "imo-community-common",
			"script-path" => "js/common.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js')
		),
		array(
			"script-name" => "imo-community-models",
			"script-path" => "js/models.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js','imo-community-common')
		),
		array(
			"script-name" => "imo-community-mod",
			"script-path" => "js/mod2.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js','imo-community-models','imo-community-common')
		),
		array(
			"script-name" => "imo-community-community",
			"script-path" => "js/community.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js','imo-community-models','imo-community-common','imo-community-mod')
		),
		array(
			"script-name" => "imo-community-routes",
			"script-path" => "js/routes.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js','imo-community-community','imo-community-mod')
		),
		array(
			"script-name" => "backgrid-select-all",
			"script-path" => "js/backgrid-select-all.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js','imo-community-grid-js','custom.js','jquery.timeago.js')
		)

	);

	$IMO_COMMUNITY_CONFIG['additional_styles'] = array(
		array(
			"style-name" => "imo-community-stylesheet-main",
			"style-path" => "css/bootstrap.min.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "stylesheet_responsive",
			"style-path" => "css/bootstrap-responsive.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "imo-community-grid-css",
			"style-path" => "css/backgrid.min.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "styles-select-all",
			"style-path" => "css/styles-select-all.css",
			"style-dependencies" => array('custom.css')
		),
		array(
			"style-name" => "stylesheet_custom",
			"style-path" => "css/custom.css",
			"style-dependencies" => null
		)
	);

	global $IMO_COMMUNITY;
	$IMO_COMMUNITY['beta-community'] = $IMO_COMMUNITY_CONFIG;
?>