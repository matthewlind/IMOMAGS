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
require('bc_mapi/bc-mapi.php');
require('bc-config.php');


/**
 * create a post programatically.
 * @param $title - string
 * @param $description - string
 * @param $id - integer
 * @param $tags - array of strings
 *
 * @return boolean - succes on true, failure on false
 */
function _bc_import_create_post($title, $description, $id, $tags=array()){
    global $user_ID;
    $post_content = "http://brightcove=" . $id . " \n " . $description;

    $post = array(
        "post_type" => "post",
        "post_content" => $post_content,
        "post_parent" => 0,
        "post_author" => $user_ID,
        "post_status" => 'draft',
        "post_title" => $title,
        "tags_input" => $tags,
    );

    return wp_insert_post($post);
}


/**
 * handle the submissino.
 * @param $method - string, 'tag', 'search', 'all'
 * @param $query - string, the specific term used to filter.
 *
 * @return - array of video assets
 */
function _bc_import_gather_videos($method = 'all', $query){
    if(empty($query)) {
        return "";
    }
    $bc = new BCMAPI(BC_READ_TOKEN, BC_WRITE_TOKEN);

    switch($method) {
    case "tag":
        $tags = is_array($query) ? implode(",", $query) : $query; 
        $videos = $bc->search("video", array(), array('all'=>"tag:" . $tags));
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
 * create an admin page.
 */

function bc_import_menu(){
    add_options_page('Brightcove Importer', 'Brightcove Import', "manage_options", "bc_import", "bc_import_options");
}

function bc_import_options() {
    if (!current_user_can('manage_options'))  {
        wp_die( __('You do not have sufficient permissions to access this page.') );
    }
    $videos = _bc_import_gather_videos($_POST['meth'], $_POST['bc_query']);
    if ( isset($_POST['bc_query']) && $_POST['bc_action'] == "import") {
        $resp="<h3>Videos Imported</h3><ul>";
        foreach ($videos as $video) {
            if( $bid = _bc_import_create_post($video->name, $video->shortDescription, $video->id, implode( ',', $video->tags )) )
            {
                //success
                $resp .= "<li class='green'>Added: $video->name with bid $bid</li>";
            }
            else {
                //failure
                $resp .="<li class='red'>Failure: $video->name</li>";
            }
        }
    }
    else { // show default action.
        $resp = "<h3>Videos Found</h3><ul>";
        foreach ($videos as $video) {
            $resp .= "<li class='green'> $video->name</li>";
        }        
        $resp .="</ul>";
    }
    include("bc-import-options.tpl.php");
}

add_action("admin_menu", "bc_import_menu");
