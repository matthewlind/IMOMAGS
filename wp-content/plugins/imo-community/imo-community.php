<?php
/*
 * Plugin Name: IMO Community
 * Plugin URI: http://github.com/imoutdoors
 * Description: Provides a framework for deploying and maintaining communities
 * Version: 0.1
 * Author: aaron baker
 * Author URI: http://imomags.com
 */

add_action('template_redirect', 'imo_community_template');
add_filter( 'wp_title', 'imo_community_set_title', 0, 3 );

function imo_community_template() {

	global $IMO_COMMUNITY;

	foreach ($IMO_COMMUNITY as $IMO_COMMUNITY_CONFIG) {

		$matchString = "/^\/" . $IMO_COMMUNITY_CONFIG['community_home_slug'] . "(\?(.+)?)?$/";

		if (preg_match($matchString, $_SERVER['REQUEST_URI'])) {


		    wp_deregister_script( 'jquery' );
		    wp_register_script( 'jquery', '/wp-content/plugins/imo-community/js/jquery-1.7.1.min.js');
		    wp_enqueue_script( 'jquery' );

			foreach($IMO_COMMUNITY_CONFIG['additional_scripts'] as $script) {

				$in_footer = true;

				if ($script["show-in-header"])
					$in_footer = false;

				wp_enqueue_script($script['script-name'], plugins_url( $script['script-path'] , __FILE__), $script['script-dependencies'], '1.0',$in_footer);

			}

			foreach($IMO_COMMUNITY_CONFIG['additional_styles'] as $style) {
				wp_enqueue_style($style['style-name'], plugins_url( $style['style-path'], __FILE__), $style['style-dependencies'] );

			}

			//Use wp_localize_script to make these settings available to Javascript
			//Erase some of the settings so that there isn't too much stuff
			unset($IMO_COMMUNITY_CONFIG['additional_scripts']);
			unset($IMO_COMMUNITY_CONFIG['additional_styles']);
			wp_localize_script( 'imo-community-common', 'IMO_COMMUNITY_CONFIG', $IMO_COMMUNITY_CONFIG);


			imo_include_wordpress_template(dirname( __FILE__ ) . $IMO_COMMUNITY_CONFIG['template'] );
			exit;
		}
	}
}

function imo_community_set_title($title,$sep,$seplocation) {

	global $IMO_COMMUNITY;

	foreach ($IMO_COMMUNITY as $IMO_COMMUNITY_CONFIG) {



		$matchString = "/^\/" . $IMO_COMMUNITY_CONFIG['community_home_slug'] . "(\?(.+)?)?$/";

		if (preg_match($matchString, $_SERVER['REQUEST_URI'])) {

	     	$title = $IMO_COMMUNITY_CONFIG['page_title'];
	     	return $title;
	     }
	}
	return $title;
}


function imo_include_wordpress_template($t) {
    global $wp_query;
    if ($wp_query->is_404) {
        $wp_query->is_404 = false;
        $wp_query->is_archive = true;
    }
    header("HTTP/1.1 200 OK");
    include($t);
}