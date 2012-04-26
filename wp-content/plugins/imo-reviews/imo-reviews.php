<?php
/*  Copyright 2011 Aaron Baker

*/

/*
Plugin Name: IMO Reviews
Plugin URI: https://imomags.com
Description: Starts the IMO Reviews Content Type (Finished with Content Field Matrix)
Author: aaron
Author URI:
Version: 0.1
Stable tag: 0.1
License: GPL2
*/




add_action('init', 'imo_reviews_init');




function imo_reviews_init() {
	$labels = array(
		'name' => _x('Reviews Lists', 'post type general name'),
		'singular_name' => _x('Reviews List', 'post type singular name'),
		'add_new' => _x('Add New', 'Reviews list'),
		'add_new_item' => __("Add New Reviews List"),
		'edit_item' => __("Edit Reviews List"),
		'new_item' => __("New Reviews List"),
		'view_item' => __("View Reviews List"),
		'search_items' => __("Search Reviews List"),
		'not_found' =>  __('No Reviews lists found'),
		'not_found_in_trash' => __('No Reviews lists found in Trash'), 
		'parent_item_colon' => ''
	  );
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => array("slug" => "imo-reviews-test"),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','thumbnail','excerpt','editor'),
		'taxonomies' => array('manufacturer','category'),
	  ); 
	  register_post_type('imo_reviews',$args);
	  flush_rewrite_rules();
}

function imo_reviews_flush() {
	
	flush_rewrite_rules();
	
}

register_activation_hook( __FILE__, 'imo_reviews_flush' );
register_deactivation_hook( __FILE__, 'imo_reviews_flush' );


