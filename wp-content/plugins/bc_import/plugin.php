<?php 
/**
 * Plugin Name: Brightcove Import
 * Plugin URI: http://www.imomags.com/
 * Description: A basic importer  that creates brightcove posts
 * Version: 0.1
 * Author: Jacob Angel
 * Author URI: http://github.com/jacobangel
 */

// Requires the PHP MAPI Wrapper
require_once('bc_mapi/bc-mapi.php');
require_once('bc-config.php');


/**
 * create a post programatically.
 * @param $title - string
 * @param $description - string
 * @param $id - integer
 * @param $tags - array of strings
 *
 * @return boolean - succes on true, failure on false
 */
function _bc_import_create_post($video, $title, $description, $id, $tags=array()){
    global $user_ID;
    $post_content = _bc_embed_format_tag($id) . " \n " . $description;

    $post = array(
        "post_type" => "post",
        "post_content" => $post_content,
        "post_parent" => 0,
        "post_author" => $user_ID,
        "post_status" => 'draft',
        "post_title" => $title,
        "tags_input" => $tags,
    );

    $result = wp_insert_post($post);

    if ( is_int($result) && $result !== 0 )
    {
        // attaching image.
        if ( !empty($video->videoStillURL) ) 
        {
            _bc_import_media_sideload_image($video->videoStillURL, $result, "Thumbnail for the video '" . $title . "'"); 
        }
        return true; 
    }
    else 
    {
        return false;
    }
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
function _bc_import_media_sideload_image($file, $post_id, $desc = null) {
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
/**
 * handle the submissino.
 * @param $method - string, 'tag', 'search', 'all'
 * @param $query - string, the specific term used to filter.
 *
 * @return - array of video assets
 */
function _bc_import_gather_videos($method = 'all', $query){
    if(empty($query) || !is_string($query)) 
    {
        return array(); 
    }
    $bc = new BCMAPI(get_option("bc_write_key", BC_READ_TOKEN), get_option("bc_write_key", BC_WRITE_TOKEN));

    $videos = array();
    switch($method) 
    {
    case "tag":
        $videos = $bc->search("video", array(), array('all'=>"tag:" . $query));
        break;
    case "search":
        $videos = $bc->search("video", array(), array('all'=>"display_name:" . $query));
        break;
    case "id":
        // returns a single object, wrapping.
        $videos = array($bc->find("find_video_by_id", $query));
        break;
    case "all":
        // only grabs the first 100 videos.
        $videos = $bc->find("find_all_videos");
        break;
    default:
        // pass
    } 

    return $videos;
}


/**
 * Admin menu add_action callback.
 */
function bc_import_menu() {
    if (!is_plugin_active("bc_embed/plugin.php")) 
    {
        print "<div class='error'>Brightcove Embed is not enabled. Video import is disabled.</div>";
    }
    add_options_page('Brightcove Importer', 'Brightcove Import', "manage_options", "bc_import", "bc_import_options");
}


/**
 * Options Page Callback
 */
function bc_import_options() {
    if (!current_user_can('manage_options'))  
    {
        wp_die( __('You do not have sufficient permissions to access this page.') );
    }

    if ( empty($_POST['bc_query']) || empty($_POST["bc_meth"]) || !is_plugin_active("bc_embed/plugin.php") ) 
    {
        $resp="";
    }
    else 
    {
        $videos = _bc_import_gather_videos($_POST["bc_meth"], $_POST['bc_query']);
        if ( $_POST['bc_action'] == "import") 
        {
            $resp="<h3>Videos Imported</h3><ul>";
            foreach ($videos as $video) {
                if( $bid = _bc_import_create_post($video, $video->name, $video->shortDescription, $video->id, implode( ',', $video->tags )) ) 
                { //success
                    $resp .= "<li class='green'>Added: $video->name with bid $bid</li>";
                }
                else 
                { //failure
                    $resp .="<li class='red'>Failure: $video->name</li>";
                }
            }
        }
        else 
        { // show default action.
            $resp = "<h3>Videos Found</h3><ul>";

            foreach ($videos as $video) 
            {
                $resp .= "<li class='green'> $video->name</li>";
            }        

            $resp .="</ul>";
        }
    }
    include("bc-import-options.tpl.php");
}

add_action("admin_menu", "bc_import_menu");

/******************************************************************************************
 * Administration Menus
 * Adds a bc_player_id setting to the General Options page in the admin_menu, allowing for 
 * overriding the inferred domain tag.
 ******************************************************************************************/

/* add_settings_field callback */
function bc_import_read_key_settings_option() {
    echo "<input type='text' name='bc_read_key' id='bc-player_bc-read-key' value='" . get_option("bc_read_key", BC_READ_TOKEN)."' size='52' />";
}

function bc_import_write_key_settings_option() {
    echo "<input type='text' name='bc_write_key' id='bc-player_bc-write' value='".get_option("bc_write_key", BC_WRITE_TOKEN )."' size='52' />";
}

function imo_bc_import_settings_section() {
    echo "<p>Brightcove API tokens often terminate with one or more periods. They are required.</p>";
}

/* admin_menu callback. */
function imo_bc_import_settings_init() {
    add_settings_section("bc_import_settings", __("Brightcove API Settings"), "imo_bc_import_settings_section", "general");
    add_settings_field("bc_write_key", __("Brightcove Write Token"), "bc_import_read_key_settings_option", "general", "bc_import_settings");
    add_settings_field("bc_read_key", __("Brightcove Read Token"), "bc_import_write_key_settings_option", "general", "bc_import_settings");
    register_setting("general", "bc_write_key");
    register_setting("general", "bc_read_key");
}
add_action("admin_menu", "imo_bc_import_settings_init");
