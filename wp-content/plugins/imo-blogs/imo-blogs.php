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
            "rewrite" => array("slug"=>"blog"),
        )
    );

    $types = array("imo_blog","post");

    foreach ($taxonomies as $target_taxonomy => $taxonomy) {
        register_taxonomy(
            $target_taxonomy,
            $types,
            $taxonomy);
    }
}


