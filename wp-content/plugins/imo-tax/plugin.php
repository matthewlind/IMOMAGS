<?php
/*
 * Plugin Name: IMO Taxonomy
 * Plugin URI: http://github.com/imoutdoors
 * Description: Provides a static, hard-coded taxonomy for classification of articles
 * Version: 0.1
 * Author: jacob angel 
 * Author URI: http://imomags.com
 */


/**
 * Define Region Custom Taxonomy
 */
function imo_tax_init() {
    $labels = array();

    $labels['activity'] = array(
        'name' => _x( 'Activities', 'taxonomy general name' ),
        'singular_name' => _x( 'Activity', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Activities' ),
        'all_items' => __( 'All Activities' ),
        'parent_item' => __( 'Parent Activity' ),
        'parent_item_colon' => __( 'Parent Activity:' ),
        'edit_item' => __( 'Edit Activity' ), 
        'update_item' => __( 'Update Activity' ),
        'add_new_item' => __( 'Add New Activity' ),
        'new_item_name' => __( 'New Activity Name' ),
        'menu_name' => __( 'Activity' ),
    ); 

    $labels['gear'] = array(
        'name' => _x( 'Gear', 'taxonomy general name' ),
        'singular_name' => _x( 'Gear', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Gear' ),
        'all_items' => __( 'All Gear' ),
        'parent_item' => __( 'Parent Gear' ),
        'parent_item_colon' => __( 'Parent Gear:' ),
        'edit_item' => __( 'Edit Gear' ), 
        'update_item' => __( 'Update Gear' ),
        'add_new_item' => __( 'Add New Gear' ),
        'new_item_name' => __( 'New Gear Name' ),
        'menu_name' => __( 'Gear' ),
    ); 

    $labels['location'] = array(
        'name' => _x( 'Locations', 'taxonomy general name' ),
        'singular_name' => _x( 'Location', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Locations' ),
        'all_items' => __( 'All Locations' ),
        'parent_item' => __( 'Parent Location' ),
        'parent_item_colon' => __( 'Parent Location:' ),
        'edit_item' => __( 'Edit Location' ), 
        'update_item' => __( 'Update Location' ),
        'add_new_item' => __( 'Add New Location' ),
        'new_item_name' => __( 'New Location Name' ),
        'menu_name' => __( 'Location' ),
    ); 

    $labels['species'] = array(
        'name' => _x( 'Species', 'taxonomy general name' ),
        'singular_name' => _x( 'Species', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Species' ),
        'all_items' => __( 'All Species' ),
        'parent_item' => __( 'Parent Species' ),
        'parent_item_colon' => __( 'Parent Species:' ),
        'edit_item' => __( 'Edit Species' ), 
        'update_item' => __( 'Update Species' ),
        'add_new_item' => __( 'Add New Species' ),
        'new_item_name' => __( 'New Species Name' ),
        'menu_name' => __( 'Species' ),
    );    

    $taxonomies = array(
        "activity" => array(
            "labels" => $labels['activity'],
            "hierarchical" => True,
            "show_ui" => True,
            "query_var" => True,
            "rewrite" => array("slug"=>"activity"),
        ),
        "gear" => array(
            "labels" => $labels['gear'],
            "hierarchical" => True,
            "show_ui" => True,
            "query_var" => True,
            "rewrite" => array("slug"=>"gear"),
        ),
        "location" => array(            
            "labels" => $labels['location'],
            "hierarchical" => True,
            "show_ui" => True,
            "query_var" => True,
            "rewrite" => array("slug"=>"location"),
        ),
        "species" => array(            
            "labels" => $labels['species'],
            "hierarchical" => True,
            "show_ui" => True,
            "query_var" => True,
            "rewrite" => array("slug"=>"species"),
        ),
    );

    $types = array("post");

    foreach ($taxonomies as $taxonomy_name => $taxonomy) {
        register_taxonomy(
            $taxonomy_name,
            $types,
            $taxonomy);
    }
}

add_action("init", "imo_tax_init");

