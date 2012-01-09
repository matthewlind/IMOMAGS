<?php
/*  Copyright 2011 Aaron Baker

*/

/*
Plugin Name: IMO Caption Contest
Plugin URI: https://imomags.com
Description: Choose the best comment to win the contest!
Author: aaron
Author URI:
Version: 0.1
Stable tag: 0.1
License: GPL2
*/




add_action('init', 'imo_caption_contest_init');
register_activation_hook( __FILE__, 'imo_caption_contest_activate' );
add_action('admin_init', 'imo_caption_contest_admin_script');

function imo_caption_contest_admin_script() {
  wp_register_script('jquery-chosen', plugins_url('chosen/chosen.jquery.min.js', __FILE__), array('jquery'), '1.0');
	wp_register_script('jquery-imo-slider-admin', plugins_url('imo-caption-contest-admin.js', __FILE__), array('jquery','jquery-chosen'), '1.0');

	wp_enqueue_style('chosen-css',plugins_url('chosen/chosen.css', __FILE__));
	
}


function imo_caption_contest_init() {
	$labels = array(
		'name' => _x('Caption Contests', 'post type general name'),
		'singular_name' => _x('Caption Contest', 'post type singular name'),
		'add_new' => _x('Add New', 'Caption Contest'),
		'add_new_item' => __("Add New Caption Contest"),
		'edit_item' => __("Edit Caption Contest"),
		'new_item' => __("New Caption Contest"),
		'view_item' => __("View Caption Contest"),
		'search_items' => __("Search Caption Contest"),
		'not_found' =>  __('No Caption Contests found'),
		'not_found_in_trash' => __('No Caption Contests found in Trash'), 
		'parent_item_colon' => ''
	  );
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => array('slug' => 'caption-contest', 'with_front' => FALSE),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','thumbnail','excerpt','editor','comments'),
		'taxonomies' => array('video_channel','post_tag','activity','location','gear','species','blogs'),
	  ); 
	  register_post_type('imo_caption_contest',$args);
	  flush_rewrite_rules();
}

function imo_caption_contest_flush() {
	
	flush_rewrite_rules();
	
}

register_activation_hook( __FILE__, 'imo_caption_contest_flush' );
register_deactivation_hook( __FILE__, 'imo_caption_contest_flush' );





/* Define the caption ID metabox */

add_action( 'add_meta_boxes', 'imo_caption_contest_add_custom_box' );
add_action( 'save_post', 'imo_caption_contest_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function imo_caption_contest_add_custom_box() {
    add_meta_box( 
        'imo_caption_contest_sectionid',
        __( 'Choose caption', 'imo_caption_contest_textdomain' ),
        'imo_caption_contest_inner_custom_box',
        'imo_caption_contest',
        'normal',
        'high' 
    );


}


/* Prints the box content */
function imo_caption_contest_inner_custom_box( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'imo_caption_contest_noncename' );
  
  
  $valueTag = get_post_meta($post->ID, '_caption_id', TRUE);



  
  $postID = $post->ID;


  
  $args = array('post_id' => 6009);
 
  //UNCOMMENT THIS LINE BEFORE LAUNCH!!!! (Also delete above line.)
  //$args = array('post_id' => $postID);

  $comments = get_comments($args);


  $active = "";
  $count = 0;
  // The actual fields for data entry
  //echo '<input type="text" id="imo_caption_contest_caption_id" name="imo_caption_contest_caption_id" placeholder="Select a caption" size="25" ' . $valueTag . ' />';
  echo '<select id="imo_caption_contest_caption_id" class="chzn-select" name="imo_caption_contest_caption_id" placeholder="Select a Caption" style="width:500px;" />';

  foreach ($comments as $comment) {
  	$count++;
  	
  	$text = substr($comment->comment_content,0,60) . "...";
    $author = $comment->comment_author;
    $commentID = $comment->comment_ID;



  	if ($commentID == $valueTag)
  		$active = "selected";

    

  	echo "<option value='$commentID' $active><b>$author</b> - $text</option>";
    $active = "";  
  }
  if ($count < 1)
    echo "<option value='0'>No Comments Yet! Come back later.</option>";



  echo "</select>";
}

/* When the post is saved, saves our custom data */
function imo_caption_contest_save_postdata( $post_id ) {
  // verify if this is an auto save routine. 
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;
  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times

  if ( !wp_verify_nonce( $_POST['imo_caption_contest_noncename'], plugin_basename( __FILE__ ) ) )
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

  $mydata = $_POST['imo_caption_contest_caption_id'];


  // Do something with $mydata 
  // probably using add_post_meta(), update_post_meta(), or 
  // a custom table (see Further Reading section below)
  update_post_meta($post_id, '_caption_id', esc_attr($mydata) );
  
  
}


