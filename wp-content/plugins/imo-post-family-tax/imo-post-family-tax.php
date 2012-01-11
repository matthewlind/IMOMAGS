<?php
/*  Copyright 2012 Aaron Baker

*/

/*
Plugin Name: IMO Post Family Taxonomy
Plugin URI: https://imomags.com
Description: Allows posts to be categorized as Review or Gallery
Author: aaron
Author URI:
Version: 0.1
Stable tag: 0.1
License: IMO
*/


add_action("init", "imo_post_family_init",5);


function imo_post_family_init() {
    $labels = array();

    $labels['post_family'] = array(
        'name' => _x( 'Post Family', 'taxonomy general name' ),
        'singular_name' => _x( 'Post Family', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Post Families' ),
        'all_items' => __( 'All Post Families' ),
        'parent_item' => __( 'Parent Post Family' ),
        'parent_item_colon' => __( 'Parent Post Family:' ),
        'edit_item' => __( 'Edit Post Family' ), 
        'update_item' => __( 'Update Post Family' ),
        'add_new_item' => __( 'Add New Post Family' ),
        'new_item_name' => __( 'New Post Family Name' ),
        'menu_name' => __( 'Post Family' ),
    ); 

    $taxonomies = array(
        "post_family" => array(
            "labels" => $labels['post_family'],
            "hierarchical" => True,
            "show_ui" => True,
            "query_var" => True,
            "rewrite" => False,
        )
    );

    $types = array("imo_blog","post","imo_gallery");

    foreach ($taxonomies as $target_taxonomy => $taxonomy) {
        register_taxonomy(
            $target_taxonomy,
            $types,
            $taxonomy);
    }


    wp_insert_term(
      'Review', // the term 
      'post_family', // the taxonomy
      array(

        'slug' => 'review'
      )
    );
        wp_insert_term(
      'Gallery', // the term 
      'post_family', // the taxonomy
      array(

        'slug' => 'gallery'
      )
    );

}

function imo_post_family_flush() {
  //imo_post_family_init();
  flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'imo_post_family_flush');
register_deactivation_hook( __FILE__, 'imo_post_family_flush' );






