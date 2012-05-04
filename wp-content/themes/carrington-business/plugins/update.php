<?php

/**
 * @package carrington-business
 *
 * This file is part of the Carrington Business Theme for WordPress
 * http://crowdfavorite.com/wordpress/themes/carrington-business/
 *
 * Copyright (c) 2008-2011 Crowd Favorite, Ltd. All rights reserved.
 * http://crowdfavorite.com
 *
 * **********************************************************************
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
 * **********************************************************************
 */

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }

// delete_site_transient('update_themes'); // for testing only

function cfctbiz_pre_set_site_transient_update_themes($value) {
	$theme = current_theme_info();
	$response = wp_remote_get(
		'http://api.crowdfavorite.com/wordpress/themes/carrington-business/?cf_action=version-api&request=latest&current_version='.CFCT_THEME_VERSION,
		array(
			'timeout' => 20,
			'httpversion' => '1.1'
		)
	);
	if (is_array($response) && isset($response['response']) && isset($response['response']['code']) && $response['response']['code'] == 200 && !empty($response['body'])) {
		if (strpos($response['body'], '\\\\') !== false) {
			$response['body'] = stripslashes($response['body']);
		}
		$version = json_decode($response['body']);
		if (isset($version->current_version) && version_compare(CFCT_THEME_VERSION, $version->current_version) < 0) {
			$value->response[$theme->template] = array(
				'new_version' => $version->current_version,
				'url' => $version->more_info,
			);
		}
	}
	return $value;
}
add_filter('pre_set_site_transient_update_themes', 'cfctbiz_pre_set_site_transient_update_themes');

?>
