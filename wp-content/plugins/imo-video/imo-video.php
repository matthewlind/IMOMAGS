<?php
/*  Copyright 2011 Aaron Baker

*/

/*
Plugin Name: IMO Video
Plugin URI: https://imomags.com
Description: Creates a video content type for IMO
Author: aaron
Author URI:
Version: 0.1
Stable tag: 0.1
License: IMO
*/

// Requires the PHP MAPI Wrapper
require_once(WP_CONTENT_DIR . '/plugins/bc_import/bc_mapi/bc-mapi.php');
require_once(WP_CONTENT_DIR . '/plugins/bc_import/bc-config.php');
require_once(WP_CONTENT_DIR . '/plugins/bc_import/plugin.php');


add_action('init', 'imo_video_init');
add_action("init", "imo_video_channel_init");


function imo_video_channel_init() {
    $labels = array();

    $labels['video_channel'] = array(
        'name' => _x( 'Video Channels', 'taxonomy general name' ),
        'singular_name' => _x( 'Video Channel', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Video Channels' ),
        'all_items' => __( 'All Video Channels' ),
        'parent_item' => __( 'Parent Video Channel' ),
        'parent_item_colon' => __( 'Parent Video Channel:' ),
        'edit_item' => __( 'Edit Video Channel' ), 
        'update_item' => __( 'Update Video Channel' ),
        'add_new_item' => __( 'Add New Video Channel' ),
        'new_item_name' => __( 'New Video Channel Name' ),
        'menu_name' => __( 'Video Channels' ),
    ); 

    $taxonomies = array(
        "video_channel" => array(
            "labels" => $labels['video_channel'],
            "hierarchical" => True,
            "show_ui" => True,
            "query_var" => True,
            "rewrite" => array("slug"=>"channel"),
        )
    );

    $types = array("imo_video");

    foreach ($taxonomies as $target_taxonomy => $taxonomy) {
        register_taxonomy(
            $target_taxonomy,
            $types,
            $taxonomy);
    }
}

function imo_video_init() {
	$labels = array(
		'name' => _x('Videos', 'post type general name'),
		'singular_name' => _x('Video', 'post type singular name'),
		'add_new' => _x('Add New', 'video'),
		'add_new_item' => __("Add New Video"),
		'edit_item' => __("Edit Video"),
		'new_item' => __("New Video"),
		'view_item' => __("View Video"),
		'search_items' => __("Search Video"),
		'not_found' =>  __('No videos found'),
		'not_found_in_trash' => __('No videos found in Trash'), 
		'parent_item_colon' => ''
	  );
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
    'has_archive' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','thumbnail','excerpt','editor','author'),
		'rewrite' => array('slug' => 'video', 'with_front' => FALSE),
		'taxonomies' => array('video_channel','post_tag','activity','location','gear','species'),
	  ); 
	  register_post_type('imo_video',$args);

}

function imo_video_flush() {
  //imo_video_init();
  flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'imo_video_flush');
register_deactivation_hook( __FILE__, 'imo_video_flush' );





/* Define the Video ID metabox */

add_action( 'add_meta_boxes', 'imo_video_add_custom_box' );
add_action( 'save_post', 'imo_video_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function imo_video_add_custom_box() {
    add_meta_box( 
        'imo_video_sectionid',
        __( 'Choose Brightcove Video', 'imo_video_textdomain' ),
        'imo_video_inner_custom_box',
        'imo_video',
        'side',
        'high' 
    );
    add_meta_box( 
        'imo_video_legacy',
        __( 'Legacy URL', 'imo_video_legacy_domain' ),
        'imo_video_inner_custom_box_legacy',
        'imo_video' 
    );

}
/* Prints the box content */
function imo_video_inner_custom_box_legacy( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'imo_video_noncename' );
  
  
  $valueTag = "value='" .  get_post_meta($post->ID, '_video_legacy_url', TRUE) . "'";
  
  
  // The actual fields for data entry
  echo '<input type="text" id="imo_video_legacy_url" name="imo_video_legacy_url" size="50" ' . $valueTag . ' />';
}
/* Prints the box content */
function imo_video_inner_custom_box( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'imo_video_noncename' );
  
  
  $valueTag = "value='" .  get_post_meta($post->ID, '_video_id', TRUE) . "'";
  
  
  // The actual fields for data entry
  echo '<label for="imo_video_video_id">';
       _e("Video ID", 'imo_video_textdomain' );
  echo '</label> ';
  echo '<input type="text" id="imo_video_video_id" name="imo_video_video_id" placeholder="36124564556" size="25" ' . $valueTag . ' />';
  echo '<p>A <b>Featured Image</b> will automatically be downloaded from Brightcove when this post is published.  There is no need to add a Featured Image.</p>';


 //_log(imo_video_bc_import_gather_videos());

}

/* When the post is saved, saves our custom data */
function imo_video_save_postdata( $post_id ) {
  // verify if this is an auto save routine. 
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;
  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times

  if ( !wp_verify_nonce( $_POST['imo_video_noncename'], plugin_basename( __FILE__ ) ) )
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

  $mydata = $_POST['imo_video_video_id'];
  $legacyURL = $_POST['imo_video_legacy_url'];

  // Do something with $mydata 
  // probably using add_post_meta(), update_post_meta(), or 
  // a custom table (see Further Reading section below)
  update_post_meta($post_id, '_video_legacy_url', esc_attr($legacyURL) );
  update_post_meta($post_id, '_video_id', esc_attr($mydata) );

  //Get The thumbnail
  $videoID = $mydata;
  $videos = _bc_import_gather_videos('id',$videoID);
  $video = $videos[0];

  imo_video_bc_import_media_sideload_image($video->videoStillURL,$post_id);

  
  
}


/**
 * handle the submissino.
 * @param $method - string, 'tag', 'search', 'all'
 * @param $query - string, the specific term used to filter.
 *
 * @return - array of video assets
 */
function imo_video_bc_import_gather_videos(){

    $bc = new BCMAPI(get_option("bc_write_key", BC_READ_TOKEN), get_option("bc_write_key", BC_WRITE_TOKEN));

    $videos = array();

    // Define our parameters
    $params = array(
      'video_fields' => 'id,name'
    );

    // Set our search terms
    $terms = array(
      'all' => 'display_name:"shotgun"'
    );

    // Make our API call
    $videos = $bc->search('video',$terms, $params);


    return $videos;
}



/**
 * Modified version of media_sideload_image; instead of returning HTML, attaches
 * the image as a featured image. 
 *
 * Download an image from the specified URL and attach it as a featured image.
 *
 * @see media_sideload_image
 * @since 2.6.0
 *
 * @param string $file The URL of the image to download
 * @param int $post_id The post ID the media is to be associated with
 * @param string $desc Optional. Description of the image
 * @return boolean|WP_Error True on success
 *
 */
function imo_video_bc_import_media_sideload_image($file, $post_id, $desc = null) {
    if ( ! empty($file) ) {
        // Download file to temp location
        $tmp = download_url( $file );

        // Set variables for storage
        // fix file filename for query strings
        preg_match('/[^\?]+\.(jpg|JPG|jpe|JPE|jpeg|JPEG|gif|GIF|png|PNG)/', $file, $matches);
        $file_array['name'] = basename($matches[0]);
        $file_array['tmp_name'] = $tmp;

        // If error storing temporarily, unlink
        if ( is_wp_error( $tmp ) ) {
            @unlink($file_array['tmp_name']);
            $file_array['tmp_name'] = '';
        }

        // do the validation and storage stuff
        $id = media_handle_sideload( $file_array, $post_id, $desc );
        // If error storing permanently, unlink
        if ( is_wp_error($id) ) {
            @unlink($file_array['tmp_name']);
            return $id;
        }

        $src = wp_get_attachment_url( $id );
    }

    // Finally check to make sure the file has been saved, then return the html
    if ( ! empty($src) ) {
        return add_post_meta($post_id, '_thumbnail_id', $id);
    }
}

