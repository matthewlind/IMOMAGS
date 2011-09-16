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

    foreach ($taxonomies as $target_taxonomy => $taxonomy) {
        register_taxonomy(
            $target_taxonomy,
            $types,
            $taxonomy);
    }
}

add_action("init", "imo_tax_init");

/**
 * imo_tax_import_taxonomy() 
 * Recursivly imports terms from a nested array.
 *
 * $terms - array
 * $taxonomy - string - the name of the taxonomy, not the id
 * $parent_id - integer
 *        
 * returns - boolean, false means that you put in bad parameters.  
 */
function imo_tax_import_taxonomy($terms, $taxonomy, $parent_id=Null) {

    if ( !is_array($terms) || !is_string($taxonomy)) {
        // bad inputs. do not try to import.
        return False;
    }
    else {
        foreach ($terms as $term) {
            // slugs may only contain lower-case alphanumeric, -, and _ characters
            $slug = preg_replace( '/[^a-z0-9_-]+/', '-', strtolower( $taxonomy . "-" . $term['name'] ) );
            $new_term = wp_insert_term( $term['name'], $taxonomy, array(Null, $slug, (int) $parent_id) );
            if ( isset($term['children']) ) {
                imo_tax_import_taxonomy($term['children'], $taxonomy, $new_term['term_id']);
            }
        }

        return True;
    }

}

/**
 * Admin menu add_action callback.
 */
function imo_tax_menu() {
    add_options_page('IMO Term Importer', 'IMO Term Import', "administrator", "imo_tax", "imo_tax_options");
}


/**
 * Options Page Callback
 */
function imo_tax_options() {
    $taxonomy_list = array(
        "activity"=> array(),
        "gear" => array(),
        "species" => array(),
        "location" => array(),
    );
    /**
     * ONLY ADMINS SHOULD BE ABLE TO SEE THIS.
     */
    if (!current_user_can('administrator'))  
    {
        wp_die( __('You do not have sufficient permissions to access this page.') );
    }

    elseif ( empty($_POST['taxonomy']) || empty($_POST["tax_action"]) ) {
        $resp=""; // first time visiting...
    }

    elseif ( $_POST['tax_action'] == 'preview' ) {
        $resp = "<p>Preview goes here.</p>";
    }

    elseif ( $_POST['tax_action'] == 'import' ) {

        $taxonomies = array("activity", "gear", "species", "location");
        $target_taxonomy = strtolower($_POST['taxonomy']);

        if ($target_taxonomy == "all") {

            foreach ($taxonomies as $taxon) {
                imo_tax_import_terms($taxonomy_list[$taxon], $taxon, NULL);
            }

        }

        elseif ( in_array($target_taxonomy, $taxonomies) ) {
            imo_tax_import_terms($taxonomy_list[$target_taxonomy], $target_taxonomy, NULL);
        }

        else {
            $restp = "<p>Sorry, we do not recognize that taxonomy term.</p>";
        }
    }

    else {
        $resp = "<p style='color:#C00;'>Sorry, you did not choose a valid entry.</p>";
    }

    include("imo_tax_options_page.tpl.php");
}

add_action("admin_menu", "imo_tax_menu");
