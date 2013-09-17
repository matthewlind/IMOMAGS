<?php
/*
 * Plugin Name: IMO Community
 * Plugin URI: http://github.com/imoutdoors
 * Description: Provides a framework for deploying and maintaining communities
 * Version: 0.1
 * Author: aaron baker
 * Author URI: http://imomags.com
 */


add_action('template_redirect', 'imo_community_template',5);
add_filter( 'wp_title', 'imo_community_set_title', 0, 3 );


register_activation_hook(__FILE__, 'imo_community_flush_rules');
function imo_community_flush_rules()
{
    //add_rewrite_rule('plus/trophy-buck/([^/]+)', 'index.php?pagename=superpost&templatename=superpost_single&spid=$matches[1]', 'top');
    flush_rewrite_rules(false);
}

add_action('init', 'imo_community_setup_routes');
function imo_community_setup_routes() {


    global $IMO_COMMUNITY;

    foreach ($IMO_COMMUNITY as $CONFIG_NAME => $IMO_COMMUNITY_CONFIG) {


    	$regex = "?";

    	$matchName = "&spid=";

    	if ($IMO_COMMUNITY_CONFIG['page_type'] == "single")
    		$regex = "/([^/]*)/?";

    	if ($IMO_COMMUNITY_CONFIG['page_type'] == "profile") {
    		$regex = "/([^/]*)/?";
    		$matchName = "&username=";
    	}

    	$rewriteCondition = "^" . $IMO_COMMUNITY_CONFIG['community_home_slug'] . $regex;
    	$rewriteString = "index.php?pagename="
    					. $CONFIG_NAME
    					. "&config_name=" . $CONFIG_NAME
    					. $matchName . '$matches[1]';

        // print($rewriteCondition . "  -  ");
        // print($rewriteString . "\n");

    	add_rewrite_rule( $rewriteCondition, $rewriteString,'top');
    }




}


add_filter('query_vars', 'imo_community_query_vars');
function imo_community_query_vars($query_vars)
{

    $query_vars[] = 'username';
    $query_vars[] = 'spid';
    $query_vars[] = 'config_name';
    $query_vars[] = 'state';
    $query_vars[] = 'post_type';

    return $query_vars;
}


function imo_community_template() {

	global $IMO_COMMUNITY;

	//echo $_SERVER['REQUEST_URI'];

	global $wp_query;
	// print_r($wp_query->query_vars);

	$queryVars = $wp_query->query_vars;
	$configName = $queryVars[config_name];

	if ($configName) {

		imo_community_404_check();

		$IMO_COMMUNITY_CONFIG = $IMO_COMMUNITY[$configName];

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


		//Make Certain variables available to dart.
		define("COMMUNITY_DART_SECT",$IMO_COMMUNITY_CONFIG['dart_sect']);
		define("COMMUNITY_DART_PAGE",$IMO_COMMUNITY_CONFIG['dart_page']);

		//Use wp_localize_script to make these settings available to Javascript
		//Erase some of the settings so that there isn't too much stuff
		unset($IMO_COMMUNITY_CONFIG['additional_scripts']);
		unset($IMO_COMMUNITY_CONFIG['additional_styles']);
		wp_enqueue_script( 'imo-community-config', plugin_dir_url( __FILE__ ) . 'wp-localize-fake-script.js', array( 'jquery' ) );
		wp_localize_script( 'imo-community-config', 'IMO_COMMUNITY_CONFIG', $IMO_COMMUNITY_CONFIG);


		imo_include_wordpress_template(dirname( __FILE__ ) . $IMO_COMMUNITY_CONFIG['template'] );

		exit();


	}




}

function imo_community_set_title($title,$sep,$seplocation) {

	global $IMO_COMMUNITY;

	foreach ($IMO_COMMUNITY as $IMO_COMMUNITY_CONFIG) {



		$matchString = "/" . $IMO_COMMUNITY_CONFIG['community_home_slug'] . "/";

		if (strstr($_SERVER['REQUEST_URI'],$matchString)) {

	     	$title = $IMO_COMMUNITY_CONFIG['page_title'];
	     	return $title;
	     }
	}
	return $title;
}
function imo_community_404_check() {

	$currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	$lastChar = substr($currentURL, -1);

    global $wp_query;
    if ($wp_query->is_404 && $lastChar != "/") {
    	header("Location: " . $currentURL . "/");
    }

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


//Set the FB Opengraph Meta title
add_filter( 'wpseo_head',"imo_community_seo_thing");
function imo_community_seo_thing($thing) {

	echo "THINGTHING: ";
	print_r($thing);
	echo "THING22THING: ";
}






