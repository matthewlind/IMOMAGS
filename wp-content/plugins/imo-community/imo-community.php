<?php
/*
 * Plugin Name: IMO Community
 * Plugin URI: http://github.com/imoutdoors
 * Description: Provides a framework for deploying and maintaining communities
 * Version: 0.1
 * Author: aaron baker
 * Author URI: http://imomags.com
 */


include("widgets/trending-community-sidebar-widget.php");

add_action('template_redirect', 'imo_community_template',5);
add_filter( 'wp_title', 'imo_community_set_title', 50, 3 );


register_activation_hook(__FILE__, 'imo_community_flush_rules');
function imo_community_flush_rules()
{
    //add_rewrite_rule('plus/trophy-buck/([^/]+)', 'index.php?pagename=superpost&templatename=superpost_single&spid=$matches[1]', 'top');
    flush_rewrite_rules(false);
}



add_action('generate_rewrite_rules', 'imo_community_setup_routes');
function imo_community_setup_routes($wp_rewrite) {



	$newRewriteRules = array();



	// print_r($wp_rewrite->rules);

    global $IMO_COMMUNITY;

    foreach ($IMO_COMMUNITY as $CONFIG_NAME => $IMO_COMMUNITY_CONFIG) {

    	$post_types = $IMO_COMMUNITY_CONFIG['post_types'];

    	//Check if page type is nested list, if it is, cycle through taxonomy
    	if ($IMO_COMMUNITY_CONFIG['page_type'] == "nested-listing") {



	    	//$regex = "/([^/]*)/([^/]*)/([^/]*)/?";
    		$regex = ")/?$";

    		$pathBeginning = $IMO_COMMUNITY_CONFIG['community_home_slug'];

	    	$post_types = $IMO_COMMUNITY_CONFIG['post_types'];


	    	foreach ($post_types as $post_type_name => $post_type_data) {

	    		$rewriteCondition = "(" . $IMO_COMMUNITY_CONFIG['community_home_slug']. "/" . $post_type_name . $regex;
	    		$rewriteString = "index.php?pagename="
	    					. $CONFIG_NAME
	    					. "&config_name=" . $CONFIG_NAME
	    					. "&post_type_tertiary=" . $post_type_name;



	    		foreach ($post_type_data['children'] as $post_type_name2 => $post_type_data2) {

	    			if (empty($post_type_data2['children'])) {
			    		$rewriteCondition2 = "(" . $IMO_COMMUNITY_CONFIG['community_home_slug']. "/" . $post_type_name . "/" . $post_type_name2 . $regex;
			    		$rewriteString2 = "index.php?pagename="
			    					. $CONFIG_NAME
			    					. "&config_name=" . $CONFIG_NAME
			    					. "&post_type_tertiary=" . $post_type_name
			    					. "&post_type_primary=" . $post_type_name2;
	    			} else {
			    		$rewriteCondition2 = "(" . $IMO_COMMUNITY_CONFIG['community_home_slug']. "/" . $post_type_name . "/" . $post_type_name2 . $regex;
			    		$rewriteString2 = "index.php?pagename="
			    					. $CONFIG_NAME
			    					. "&config_name=" . $CONFIG_NAME
			    					. "&post_type_tertiary=" . $post_type_name
			    					. "&post_type_secondary=" . $post_type_name2;
	    			}



		    		foreach ($post_type_data2['children'] as $post_type_name3 => $post_type_data3) {

			    		$rewriteCondition3 = "(" . $IMO_COMMUNITY_CONFIG['community_home_slug']. "/" . $post_type_name . "/" . $post_type_name2 . "/" . $post_type_name3 . $regex;
			    		$rewriteString3 = "index.php?pagename="
			    					. $CONFIG_NAME
			    					. "&config_name=" . $CONFIG_NAME
			    					. "&post_type_tertiary=" . $post_type_name
			    					. "&post_type_secondary=" . $post_type_name2
			    					. "&post_type_primary=" . $post_type_name3;

			    		// print($rewriteCondition3 . "  -  ");
			      //   	print($rewriteString3 . "\n");
			    		$newRewriteRules[$rewriteCondition3] = $rewriteString3;

			    	}

		    		// print($rewriteCondition2 . "  -  ");
		      //   	print($rewriteString2 . "\n");
		    		$newRewriteRules[$rewriteCondition2] = $rewriteString2;

		    	}

		    	// print($rewriteCondition . "  -  ");
	      //   	print($rewriteString . "\n");
		    	$newRewriteRules[$rewriteCondition] = $rewriteString;

	    	}

	    	$rewriteCondition = "(" . $IMO_COMMUNITY_CONFIG['community_home_slug'] . $regex;
	    	$rewriteString = "index.php?pagename="
				. $CONFIG_NAME
				. "&config_name=" . $CONFIG_NAME;

			$newRewriteRules[$rewriteCondition] = $rewriteString;


	        // print($rewriteCondition . "  -  ");
	        // print($rewriteString . "\n");

	    	//Perhaps uncomment this if things go sour
	    	//add_rewrite_rule( $rewriteCondition, $rewriteString,'top');



    	//If it's not, just use the community_home_slug to determine the path
    	} else if ($IMO_COMMUNITY_CONFIG['page_type'] == "nested-single") {

	    	//$regex = "/([^/]*)/([^/]*)/([^/]*)/?";
    		$regex = ")/([0-9]{1,})/?$";

    		$pathBeginning = $IMO_COMMUNITY_CONFIG['community_home_slug'];

	    	$post_types = $IMO_COMMUNITY_CONFIG['post_types'];


	    	foreach ($post_types as $post_type_name => $post_type_data) {

	    		foreach ($post_type_data['children'] as $post_type_name2 => $post_type_data2) {


	    				if (empty($post_type_data2['children'])) {
				    		$rewriteCondition2 = "(" . $IMO_COMMUNITY_CONFIG['community_home_slug']. "/" . $post_type_name . "/" . $post_type_name2 . $regex;
				    		$rewriteString2 = "index.php?pagename="
				    					. $CONFIG_NAME
				    					. "&config_name=" . $CONFIG_NAME
				    					. "&post_type_tertiary=" . $post_type_name
				    					. "&post_type_primary=" . $post_type_name2
				    					. '&spid=$matches[2]';

				    		$newRewriteRules[$rewriteCondition2] = $rewriteString2;
	    				}




		    		foreach ($post_type_data2['children'] as $post_type_name3 => $post_type_data3) {

			    		$rewriteCondition3 = "(" . $IMO_COMMUNITY_CONFIG['community_home_slug']. "/" . $post_type_name . "/" . $post_type_name2 . "/" . $post_type_name3 . $regex;
			    		$rewriteString3 = "index.php?pagename="
			    					. $CONFIG_NAME
			    					. "&config_name=" . $CONFIG_NAME
			    					. "&post_type_tertiary=" . $post_type_name
			    					. "&post_type_secondary=" . $post_type_name2
			    					. "&post_type_primary=" . $post_type_name3
			    					. '&spid=$matches[2]';

			    		// print($rewriteCondition3 . "  -  ");
			      //   	print($rewriteString3 . "\n");
			    		$newRewriteRules[$rewriteCondition3] = $rewriteString3;

			    	}


		    	}


	    	}


    	} else {




	    	$regex = "?";

	    	$matchName = "&spid=";



	    	if ($IMO_COMMUNITY_CONFIG['page_type'] == "single") {
	    		$regex = "/([^/]*)/?";
	    	}


	    	if ($IMO_COMMUNITY_CONFIG['page_type'] == "profile") {
	    		$regex = "/([^/]*)/?";
	    		$matchName = "&username=";
	    	}


	    	if ($IMO_COMMUNITY_CONFIG['page_type'] == "state") {
	    		$regex = "/([^/]*)/?";
	    		$matchName = "&state=";
	    	}

	    	$rewriteCondition = "^" . $IMO_COMMUNITY_CONFIG['community_home_slug'] . $regex;
	    	$rewriteString = "index.php?pagename="
	    					. $CONFIG_NAME
	    					. "&config_name=" . $CONFIG_NAME
	    					. $matchName . '$matches[1]';

	         // print($rewriteCondition . "  -  ");
	         // print($rewriteString . "\n");

	    	//add_rewrite_rule( $rewriteCondition, $rewriteString,'top');

	    	$newRewriteRules[$rewriteCondition] = $rewriteString;

    	}






    }

    // print_r($wp_rewrite->rewrite_rules());
    //flush_rewrite_rules(false);


    // print('DID WORK?\n\n');
    // print_r($wp_rewrite->rules);

    $wp_rewrite->rules = $newRewriteRules + $wp_rewrite->rules;
	return $wp_rewrite->rules;

}

//Community Sidebar
register_sidebar( array(
    'name' => __( 'Community Sidebar', 'imo-mags-parent' ),
    'id' => 'sidebar-4',
    'description' => __( 'The sidebar for community pages', 'twentyeleven' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
) );

add_filter('query_vars', 'imo_community_query_vars');
function imo_community_query_vars($query_vars)
{

    $query_vars[] = 'username';
    $query_vars[] = 'spid';
    $query_vars[] = 'config_name';
    $query_vars[] = 'state';
    $query_vars[] = 'post_type';
    $query_vars[] = 'post_type_primary';
    $query_vars[] = 'post_type_secondary';
    $query_vars[] = 'post_type_tertiary';

    return $query_vars;
}


function imo_community_template() {

	global $IMO_COMMUNITY;

	//echo $_SERVER['REQUEST_URI'];

	global $wp_query;
	//print_r($wp_query->query_vars);

	$queryVars = $wp_query->query_vars;





	$configName = $queryVars[config_name];

	if ($configName) {

		imo_community_404_check();

		global $IMO_COMMUNITY_CONFIG;

		$IMO_COMMUNITY_CONFIG = $IMO_COMMUNITY[$configName];


		$postData = get_imo_community_post_data($queryVars['spid']);


		$wp_query->query_vars['post_title'] = $postData->title;
		$wp_query->query_vars['seo_image'] = $postData->img_url . "/convert?w=200&h=200&fit=crop&rotate=exif";

	    wp_deregister_script( 'jquery' );
	    wp_register_script( 'jquery', '/wp-content/plugins/imo-community/js/jquery-1.7.1.min.js');
	    wp_enqueue_script( 'jquery' );







		foreach($IMO_COMMUNITY_CONFIG['additional_scripts'] as $script) {

			$in_footer = true;

			if ($script["show-in-header"])
				$in_footer = false;

			wp_enqueue_script($script['script-name'], plugins_url( $script['script-path'] , __FILE__), $script['script-dependencies'], '1.1',$in_footer);

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



function get_imo_community_post_data($spid) {
	global $wpdb;

	$postData = $wpdb->get_row($wpdb->prepare("SELECT * FROM slim.superposts WHERE id = %d",$spid));

	return $postData;
}

function imo_community_set_title($title,$sep,$seplocation) {


	global $wp_query;
	global $IMO_COMMUNITY;

	$queryVars = $wp_query->query_vars;
	$configName = $queryVars[config_name];

	if ($configName) {

		$IMO_COMMUNITY_CONFIG = $IMO_COMMUNITY[$configName];

		$title = $IMO_COMMUNITY_CONFIG['page_title'];
		//$title = "cola";

		if ($queryVars["spid"]) {
			$title = $wp_query->query_vars['post_title'];
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



// function yoast_change_opengraph_type( $type ) {

//     return 'video';
// }
// add_filter( 'wpseo_opengraph_type', 'yoast_change_opengraph_type', 10, 1 );

//Set the FB Opengraph Meta title
add_filter( 'wpseo_opengraph_title',"imo_community_seo_title");
function imo_community_seo_title($title) {

	global $wp_query;

	//If this is community single post, change the meta.
	if ($wp_query->query_vars['spid']) {
		$title = $wp_query->query_vars['post_title'];
	}


	return $title;
}

add_filter( 'wpseo_opengraph_image',"imo_community_seo_image");
function imo_community_seo_image($image) {

	global $wp_query;

	//If this is community single post, change the meta.
	if ($wp_query->query_vars['spid']) {
		$image = $wp_query->query_vars['seo_image'];
	}

	return $image;
}

add_filter( 'wpseo_opengraph_type',"imo_community_seo_type");
function imo_community_seo_type($type) {

	global $wp_query;

	//If this is community single post, change the meta.
	if ($wp_query->query_vars['spid']) {
		$type = "article";
	}

	return $type;
}







