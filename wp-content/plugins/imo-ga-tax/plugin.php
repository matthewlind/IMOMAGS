<?php
/*
 * Plugin Name: IMO G&A Taxonomy
 * Plugin URI: http://github.com/imoutdoors
 * Description: Provides extra taxonomies for G&A
 * Version: 0.1
 * Author: aaron baker
 * Author URI: http://imomags.com
 */


/**
 * Define Region Custom Taxonomy
 */
function imo_ga_tax_init() {
    $labels = array();

    $labels['manufacturer'] = array(
        'name' => _x( 'Manufacturers', 'taxonomy general name' ),
        'singular_name' => _x( 'Manufacturer', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Manufacturers' ),
        'all_items' => __( 'All Manufacturers' ),
        'parent_item' => __( 'Parent Manufacturer' ),
        'parent_item_colon' => __( 'Parent Manufacturer:' ),
        'edit_item' => __( 'Edit Manufacturer' ), 
        'update_item' => __( 'Update Manufacturer' ),
        'add_new_item' => __( 'Add New Manufacturer' ),
        'new_item_name' => __( 'New Manufacturer Name' ),
        'menu_name' => __( 'Manufacturer' ),
    ); 

    $labels['caliber'] = array(
        'name' => _x( 'Caliber', 'taxonomy general name' ),
        'singular_name' => _x( 'Caliber', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Caliber' ),
        'all_items' => __( 'All Caliber' ),
        'parent_item' => __( 'Parent Caliber' ),
        'parent_item_colon' => __( 'Parent Caliber:' ),
        'edit_item' => __( 'Edit Caliber' ), 
        'update_item' => __( 'Update Caliber' ),
        'add_new_item' => __( 'Add New Caliber' ),
        'new_item_name' => __( 'New Caliber Name' ),
        'menu_name' => __( 'Caliber' ),
    ); 


    $taxonomies = array(
        "manufacturer" => array(
            "labels" => $labels['manufacturer'],
            "hierarchical" => True,
            "show_ui" => True,
            "query_var" => True,
            "rewrite" => array("slug"=>"manufacturer"),
        ),
        "caliber" => array(
            "labels" => $labels['caliber'],
            "hierarchical" => True,
            "show_ui" => True,
            "query_var" => True,
            "rewrite" => array("slug"=>"caliber"),
        ),
    );

    $types = array("post","imo_video","imo_gallery","reviews");

    foreach ($taxonomies as $target_taxonomy => $taxonomy) {
        register_taxonomy(
            $target_taxonomy,
            $types,
            $taxonomy);
    }
}

add_action("after_setup_theme", "imo_ga_tax_init");
