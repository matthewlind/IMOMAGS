<?php
/*
 * Plugin Name: IMO State Taxonomy
 * Plugin URI: http://github.com/imoutdoors
 * Description: Provides a static, hard-coded taxonomy for US States
  * Version: 0.1
 * Author: aaron baker
 * Author URI: http://imomags.com
 */



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

	
	//48 states = 51 - 98 (not including Alaska and Hawaii)
	wp_insert_term("Alabama","state",array("slug"=>"alabama"));
	wp_insert_term("Arizona","state",array("slug"=>"arizona"));
	wp_insert_term("Arkansas","state",array("slug"=>"arkansas"));
	wp_insert_term("California","state",array("slug"=>"california"));
	wp_insert_term("Colorado","state",array("slug"=>"colorado"));
	wp_insert_term("Connecticut","state",array("slug"=>"connecticut"));
	wp_insert_term("Delaware","state",array("slug"=>"delaware"));
	wp_insert_term("Florida","state",array("slug"=>"florida"));
	wp_insert_term("Georgia","state",array("slug"=>"georgia"));
	wp_insert_term("Idaho","state",array("slug"=>"idaho"));
	wp_insert_term("Illinois","state",array("slug"=>"illinois"));
	wp_insert_term("Indiana","state",array("slug"=>"indiana"));
	wp_insert_term("Iowa","state",array("slug"=>"iowa"));
	wp_insert_term("Kansas","state",array("slug"=>"kansas"));
	wp_insert_term("Kentucky","state",array("slug"=>"kentucky"));
	wp_insert_term("Louisiana","state",array("slug"=>"louisiana"));
	wp_insert_term("Maine","state",array("slug"=>"maine"));
	wp_insert_term("Maryland","state",array("slug"=>"maryland"));
	wp_insert_term("Massachusetts","state",array("slug"=>"massachusetts"));
	wp_insert_term("Michigan","state",array("slug"=>"michigan"));
	wp_insert_term("Minnesota","state",array("slug"=>"minnesota"));
	wp_insert_term("Mississippi","state",array("slug"=>"mississippi"));
	wp_insert_term("Missouri","state",array("slug"=>"missouri"));
	wp_insert_term("Montana","state",array("slug"=>"montana"));
	wp_insert_term("Nebraska","state",array("slug"=>"nebraska"));
	wp_insert_term("Nevada","state",array("slug"=>"nevada"));
	wp_insert_term("New Hampshire","state",array("slug"=>"new-hampshire"));
	wp_insert_term("New Jersey","state",array("slug"=>"new-jersey"));
	wp_insert_term("New Mexico","state",array("slug"=>"new-mexico"));
	wp_insert_term("New York","state",array("slug"=>"new-york"));
	wp_insert_term("North Carolina","state",array("slug"=>"north-carolina"));
	wp_insert_term("North Dakota","state",array("slug"=>"north-dakota"));
	wp_insert_term("Ohio","state",array("slug"=>"ohio"));
	wp_insert_term("Oklahoma","state",array("slug"=>"oklahoma"));
	wp_insert_term("Oregon","state",array("slug"=>"oregon"));
	wp_insert_term("Pennsylvania","state",array("slug"=>"pennsylvania"));
	wp_insert_term("Rhode Island","state",array("slug"=>"rhode-island"));
	wp_insert_term("South Carolina","state",array("slug"=>"south-carolina"));
	wp_insert_term("South Dakota","state",array("slug"=>"south-dakota"));
	wp_insert_term("Tennessee","state",array("slug"=>"tennessee"));
	wp_insert_term("Texas","state",array("slug"=>"texas"));
	wp_insert_term("Utah","state",array("slug"=>"utah"));
	wp_insert_term("Vermont","state",array("slug"=>"vermont"));
	wp_insert_term("Virginia","state",array("slug"=>"virginia"));
	wp_insert_term("Washington","state",array("slug"=>"washington"));
	wp_insert_term("West Virginia","state",array("slug"=>"west-virginia"));
	wp_insert_term("Wisconsin","state",array("slug"=>"wisconsin"));
	wp_insert_term("Wyoming","state",array("slug"=>"wyoming"));
		
}