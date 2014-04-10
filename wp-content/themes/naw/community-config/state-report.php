<?php
///////////////////////////////////////////
//Report Community Page Configuration
///////////////////////////////////////////
$IMO_COMMUNITY_CONFIG = NULL;
$IMO_COMMUNITY_CONFIG['community_home_slug'] = "community/report";//This slug will override ANY setting in wordpress.
$IMO_COMMUNITY_CONFIG['page_type'] = 'state';
$IMO_COMMUNITY_CONFIG['page_title'] = 'State Rut Reports';
$IMO_COMMUNITY_CONFIG['template'] = '/naw/state-report.php';
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
		"script-name" => "bootstrap-dropdown-js",
		"script-path" => "naw/js/bootstrap-dropdown.js",
		"script-dependencies" => array('jquery')
	),
	array(
		"script-name" => "community-state-report-js",
		"script-path" => "naw/js/community-state-report.js",
		"script-dependencies" => array('jquery',"bootstrap-dropdown-js")
	)
);

$IMO_COMMUNITY_CONFIG['additional_styles'] = array(
	array(
		"style-name" => "community-common-css",
		"style-path" => "naw/css/community-common.css",
		"style-dependencies" => null
	),
	array(
		"style-name" => "bootstrap-dropdown-css",
		"style-path" => "naw/css/bootstrap-dropdown.css",
		"style-dependencies" => null
	),
	array(
		"style-name" => "community-report-css",
		"style-path" => "naw/css/community-report.css",
		"style-dependencies" => array('community-common-css',"bootstrap-dropdown-css")
	)
);

global $IMO_COMMUNITY;
$IMO_COMMUNITY['community-state'] = $IMO_COMMUNITY_CONFIG;
