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
require('./bc_mapi/bc-mapi.php');

// Define Tokens
define("BC_WRITE_TOKEN", "");
define("BC_READ_TOKEN", "");


/**
 * createa  post programatically.
 * @param $title - stri
 * @param $description - string
 * @param $id - integer
 * @param $tags - array of strings
 *
 * @return boolean - succes on true, failure on false
 */
function _bc_import_create_post($title, $description, $id, $tags){
    global $user_ID;
    $page = array(
        "post_type" => "post",
        "post_content" => $content,
        "post_parent" => 0,
        "post_author" => $user_ID,
        "post_status" => 'draft',
        "post_title" => $title,
        "tags_input" => $tags,
    );

    $postid = wp_insert_post($post);

    return (bool) $postid;
}
