<?php
/*  Copyright 2011 Aaron Baker

*/

/*
Plugin Name: IMO Blogs
Plugin URI: https://imomags.com
Description: Creates a blog post content type for IMO
Author: aaron
Author URI:
Version: 0.1
Stable tag: 0.1
License: IMO
*/



add_action('init', 'imo_blog_init');
add_action("init", "imo_blog_tax_init");


function imo_blog_tax_init() {
    $labels = array();

    $labels['blog_tax'] = array(
        'name' => _x( 'Blogs', 'taxonomy general name' ),
        'singular_name' => _x( 'Blog', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Blogs' ),
        'all_items' => __( 'All Blogs' ),
        'parent_item' => __( 'Parent Blog' ),
        'parent_item_colon' => __( 'Parent Blog:' ),
        'edit_item' => __( 'Edit Blog' ), 
        'update_item' => __( 'Update Blog' ),
        'add_new_item' => __( 'Add New Blog' ),
        'new_item_name' => __( 'New Blog Name' ),
        'menu_name' => __( 'Blogs' ),
    ); 

    $taxonomies = array(
        "blog_tax" => array(
            "labels" => $labels['blog_tax'],
            "hierarchical" => True,
            "show_ui" => True,
            "query_var" => True,
            "rewrite" => array("slug"=>"blogs"),
        )
    );

    $types = array("imo_blog");

    foreach ($taxonomies as $target_taxonomy => $taxonomy) {
        register_taxonomy(
            $target_taxonomy,
            $types,
            $taxonomy);
    }
}

function imo_blog_init() {
	$labels = array(
		'name' => _x('Blog Posts', 'post type general name'),
		'singular_name' => _x('Blog Post', 'post type singular name'),
		'add_new' => _x('Add New', 'blog post'),
		'add_new_item' => __("Add New Blog Post"),
		'edit_item' => __("Edit Blog Post"),
		'new_item' => __("New Blog Post"),
		'view_item' => __("View Blog Post"),
		'search_items' => __("Search Blog Posts"),
		'not_found' =>  __('No blog posts found'),
		'not_found_in_trash' => __('No blog posts found in Trash'), 
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
		'rewrite' => array('slug' => 'blogs', 'with_front' => FALSE),
		'taxonomies' => array('blog_tax','post_tag','activity','location','gear','species'),
	  ); 
	  register_post_type('imo_blog',$args);
    flush_rewrite_rules();
}

function imo_blog_flush() {
  //imo_blog_init();
  flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'imo_blog_flush');
register_deactivation_hook( __FILE__, 'imo_blog_flush' );






