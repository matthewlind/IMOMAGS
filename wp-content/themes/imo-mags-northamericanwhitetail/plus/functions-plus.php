<?php
//This file contain functions that fix the titles and opengraph data for superposts

wp_enqueue_script("jquery-ui-tabs");
wp_enqueue_script("naw-plus-js",get_stylesheet_directory_uri() . "/plus/plus.js");
wp_enqueue_script("community-mod-js",get_stylesheet_directory_uri() . "/plus/community-mod.js");
wp_enqueue_script("jquery-cookie",get_stylesheet_directory_uri() . "/plus/jquery.cookie.js");
wp_enqueue_script("imo-profile-js",get_stylesheet_directory_uri() . "/plus/profile.js");
wp_enqueue_style("naw-plus-css",get_stylesheet_directory_uri() . "/plus/plus.css");

//Thickbox allows the user avatar editing box to appear as a modal
	wp_enqueue_script("thickbox");
	wp_enqueue_style("thickbox");

add_action ("wp_head","superpost_set_meta",0);
add_filter("page_link","add_superpost_link",0,2);
add_filter( 'wp_title', 'superpost_set_title', 0, 3 );


function superpost_set_title($title,$sep,$seplocation) {
	global $post;

	if ($post->post_name == "superpost-single"){

		global $wpdb;
		$spid =  get_query_var("spid");
		$title = $wpdb->get_var( $wpdb->prepare( "SELECT slim.superposts.title from slim.superposts WHERE id = %d;" , $spid ) );
	}

	if ($post->post_name == "superpost-state"){
		$state =  get_query_var("state");
		$title = ucfirst($state) . " Rut Reports";
	}

	return $title;
}





function add_superpost_link($permalink,$pageID) {


	global $post;

	if ($post->post_name == "superpost-single"){


		$permalink = "http://" . $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}

	return $permalink;

}


add_filter('wpseo_opengraph_image',"set_imageurl_meta");

function set_imageurl_meta() {
	global $wpdb;
	$spid =  get_query_var("spid");

	$imgURL = $wpdb->get_var( $wpdb->prepare( "SELECT slim.superposts.img_url from slim.superposts WHERE id = %d;" , $spid ) );
	return "http://www.imomags.com$imgURL";

}



function superpost_set_meta() {

//This code block can be userd to remove the WP SEO OpenGraph Data
/*
	global $wp_filter;

	foreach ($wp_filter['wp_head'][1] as $key => $value) {
		if (preg_match("/\w+head/", $key)) {
			//$wp_filter['wp_head'][1][$key] = null;
		}
	}
*/
	global $post;

	if ($post->post_name == "superpost-single"){
		global $wpdb;
		$spid =  get_query_var("spid");
		$title = $wpdb->get_var( $wpdb->prepare( "SELECT slim.superposts.title from slim.superposts WHERE id = %d;" , $spid ) );

		$post->post_title = $title;
	}
}
