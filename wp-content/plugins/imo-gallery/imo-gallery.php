<?php
/*  Copyright 2011 Aaron Baker

*/

/*
Plugin Name: IMO Gallery
Plugin URI: https://imomags.com
Description: Starts the IMO Gallery Content Type (Finished with Content Field Matrix)
Author: aaron
Author URI:
Version: 0.1
Stable tag: 0.1
License: GPL2
*/




add_action('init', 'imo_gallery_init');
register_activation_hook( __FILE__, 'imo_gallery_activate' );
add_action('admin_init', 'imo_gallery_admin_script');

function imo_gallery_admin_script() {
    wp_register_script('jquery-chosen', plugins_url('chosen/chosen.jquery.min.js', __FILE__), array('jquery'), '1.0');
	wp_register_script('jquery-imo-slider-admin', plugins_url('imo-gallery-admin.js', __FILE__), array('jquery','jquery-chosen'), '1.0');

	wp_enqueue_style('chosen-css',plugins_url('chosen/chosen.css', __FILE__));
	
}


function imo_gallery_init() {
	$labels = array(
		'name' => _x('Gallery Lists', 'post type general name'),
		'singular_name' => _x('Gallery List', 'post type singular name'),
		'add_new' => _x('Add New', 'gallery list'),
		'add_new_item' => __("Add New Gallery List"),
		'edit_item' => __("Edit Gallery List"),
		'new_item' => __("New Gallery List"),
		'view_item' => __("View Gallery List"),
		'search_items' => __("Search Gallery List"),
		'not_found' =>  __('No gallery lists found'),
		'not_found_in_trash' => __('No gallery lists found in Trash'), 
		'parent_item_colon' => ''
	  );
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => array('slug' => 'gallery', 'with_front' => FALSE),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','thumbnail','excerpt','editor'),
		'taxonomies' => array('video_channel','post_tag','activity','location','gear','species'),
	  ); 
	  register_post_type('imo_gallery',$args);

}

function imo_gallery_flush() {
	
	flush_rewrite_rules();
	
}

register_activation_hook( __FILE__, 'imo_gallery_flush' );
register_deactivation_hook( __FILE__, 'imo_gallery_flush' );





/* Define the Gallery ID metabox */

add_action( 'add_meta_boxes', 'imo_gallery_add_custom_box' );
add_action( 'save_post', 'imo_gallery_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function imo_gallery_add_custom_box() {
    add_meta_box( 
        'imo_gallery_sectionid',
        __( 'Choose Gallery', 'imo_gallery_textdomain' ),
        'imo_gallery_inner_custom_box',
        'imo_gallery',
        'normal',
        'high' 
    );


}


/* Prints the box content */
function imo_gallery_inner_custom_box( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'imo_gallery_noncename' );
  
  
  $valueTag = get_post_meta($post->ID, '_gallery_id', TRUE);
  
  
  global $wpdb;

  $table_name = $wpdb->prefix . "ngg_gallery";
  $myrows = $wpdb->get_results( "SELECT gid, title FROM $table_name" );


  $active = "";
  // The actual fields for data entry
  //echo '<input type="text" id="imo_gallery_gallery_id" name="imo_gallery_gallery_id" placeholder="Select a Gallery" size="25" ' . $valueTag . ' />';
  echo '<select id="imo_gallery_gallery_id" class="chzn-select" name="imo_gallery_gallery_id" placeholder="Select a Gallery" style="width:400px;" />';

  foreach ($myrows as $row) {
  	
  	$id = $row->gid;
  	$name = $row->title;

  	if ($id == $valueTag)
  		$active = "selected";

  	echo "<option value='$id' $active>$name</option>";
  }
  

  echo "</select>";
}

/* When the post is saved, saves our custom data */
function imo_gallery_save_postdata( $post_id ) {
  // verify if this is an auto save routine. 
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;
  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times

  if ( !wp_verify_nonce( $_POST['imo_gallery_noncename'], plugin_basename( __FILE__ ) ) )
      return;

  // Check permissions
  if ( 'page' == $_POST['post_type'] ) 
  {
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;
  }
  else
  {
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  }

  // OK, we're authenticated: we need to find and save the data

  $mydata = $_POST['imo_gallery_gallery_id'];


  // Do something with $mydata 
  // probably using add_post_meta(), update_post_meta(), or 
  // a custom table (see Further Reading section below)
  update_post_meta($post_id, '_gallery_id', esc_attr($mydata) );
  
  
}


