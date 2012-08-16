<?php
/*
 * Plugin Name: IMO State Taxonomy
 * Plugin URI: http://github.com/imoutdoors
 * Description: Provides a static, hard-coded taxonomy for US States
  * Version: 0.1
 * Author: aaron baker
 * Author URI: http://imomags.com
 */


/**
 * Define Region Custom Taxonomy
 */
 


//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'imo_state_tax_init', 0 );
register_activation_hook(__FILE__, 'imo_insert_state_tax');
 
function imo_state_tax_init() {

    $labels = array(
        'name' => _x( 'States', 'taxonomy general name' ),
        'singular_name' => _x( 'State', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search States' ),
        'all_items' => __( 'All States' ),
        'parent_item' => __( 'Parent State' ),
        'parent_item_colon' => __( 'Parent State:' ),
        'edit_item' => __( 'Edit State' ), 
        'update_item' => __( 'Update State' ),
        'add_new_item' => __( 'Add New State' ),
        'new_item_name' => __( 'New State Name' ),
        'menu_name' => __( 'State' ),
    ); 
    
    $stateTaxonomy = array(
            "labels" => $labels,
            "hierarchical" => false,
            "show_ui" => true,
            "query_var" => true,
            "rewrite" => array("slug"=>"state"),
     );
     
     $types = array("post","page");
     
     register_taxonomy("state",$types,$stateTaxonomy);
}

function imo_insert_state_tax() {

	imo_state_tax_init();


	wp_insert_term("New York","state",array("slug"=>"NY"));
	wp_insert_term("Virginia","state",array("slug"=>"VA"));

	
}