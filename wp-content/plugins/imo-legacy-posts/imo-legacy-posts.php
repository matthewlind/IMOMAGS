<?php
/*  Copyright 2012 Aaron Baker

*/

/*
Plugin Name: IMO Legacy Posts
Plugin URI: https://imomags.com
Description: Creates a content type for posts imported from Drupal
Author: aaron
Author URI:
Version: 0.1
Stable tag: 0.1
License: IMO
*/



add_action('init', 'imo_legacy_post_init');
add_action('init', 'imo_more_legacy_init');


function imo_more_legacy_init() {
	$labels = array(
		'name' => _x('Legacy Articles 2', 'post type general name'),
		'singular_name' => _x('More Legacy', 'post type singular name'),
		'add_new' => _x('Add New', 'More Legacy'),
		'add_new_item' => __("Add New More Legacy"),
		'edit_item' => __("Edit More Legacy"),
		'new_item' => __("New More Legacy"),
		'view_item' => __("View More Legacy"),
		'search_items' => __("Search More Legacys"),
		'not_found' =>  __('No More Legacys found'),
		'not_found_in_trash' => __('No More Legacys found in Trash'), 
		'parent_item_colon' => ''
	  );
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','thumbnail','excerpt','editor','author'),
		'rewrite' => array('slug' => 'article',FALSE),
		'taxonomies' => array('blog_tax','post_tag','activity','location','gear','species'),
	  ); 
	register_post_type('imo_more_legacy',$args);


    flush_rewrite_rules();
}


function imo_legacy_post_init() {

	wp_register_script('imo-legacy-posts', plugins_url('imo-legacy-posts.js', __FILE__), array('jquery'), '1.0');
	wp_enqueue_script('imo-legacy-posts');





	$labels = array(
		'name' => _x('Legacy Posts', 'post type general name'),
		'singular_name' => _x('Legacy Post', 'post type singular name'),
		'add_new' => _x('Add New', 'Legacy Post'),
		'add_new_item' => __("Add New Legacy Post"),
		'edit_item' => __("Edit Legacy Post"),
		'new_item' => __("New Legacy Post"),
		'view_item' => __("View Legacy Post"),
		'search_items' => __("Search Legacy Posts"),
		'not_found' =>  __('No Legacy Posts found'),
		'not_found_in_trash' => __('No Legacy Posts found in Trash'), 
		'parent_item_colon' => ''
	  );
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','thumbnail','excerpt','editor','author'),
		'rewrite' => array('slug' => 'content', 'with_front' => FALSE),
		'taxonomies' => array('blog_tax','post_tag','activity','location','gear','species','category','post_family'),
	  ); 
	  register_post_type('imo_legacy_post',$args);


	





    flush_rewrite_rules();
}

function imo_legacy_post_flush() {
  flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'imo_legacy_post_flush');
register_deactivation_hook( __FILE__, 'imo_legacy_post_flush' );






