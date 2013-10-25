<?php
/*  Copyright 2012 Aaron Baker*/
/*
Plugin Name: IMO SuperPost
Plugin URI: http://imomags.com
Description: Creates a service based UGC post type that is useful for posting Photos, Tips, Comments, Videos, Reports and more.
Author: aaron
Author URI:
Version: 0.1
Stable tag: 0.1
License: IMO


******************
IMPORTANT NOTE:
For this template to work correctly, there must be a page this name and slug: superpost-single

YES. The name of the page and the slug should both be superpost-single.

Check out the imo-superpost plugin for the routing that causes this.  Check out functions.php for how the title is pulled for these pages.
******************

*/

/********************************
*******LOAD SCRIPTS & STYLE******
*********************************/



add_action('init', 'imo_superpost_scripts');
function imo_superpost_scripts() {
	wp_enqueue_script('jquery-form',null,null,null,false);
	wp_enqueue_script('superpost-js',plugins_url('js/superpost.js', __FILE__));
	wp_enqueue_script('jquery-masonry',plugins_url('js/jquery.masonry.js', __FILE__));
    wp_enqueue_script('jquery-input',plugins_url('js/jquery.input.js', __FILE__));
    wp_enqueue_script('jquery-timeago-superpost',plugins_url('js/jquery.timeago.js', __FILE__));
    wp_enqueue_script('jquery-chosen',plugins_url('js/chosen.jquery.min.js', __FILE__));
    wp_enqueue_script('jquery-laconic',plugins_url('js/laconic.js', __FILE__));

	wp_enqueue_style('superpost-css',plugins_url('css/superpost.css', __FILE__));
    wp_enqueue_style('chosen-css',plugins_url('css/chosen.css', __FILE__));

    //wp_localize_script( 'imo-user-auth', 'userIMO', $user);

    global $user_login;
    $username['authUser'] = $user_login;


    $profileUsername = getLastPathSegment($_SERVER["REQUEST_URI"]);
    $username['profileUser'] = $profileUsername;


    wp_enqueue_script('superpost-profile-js',plugins_url('js/profile.js', __FILE__));
    wp_localize_script( 'superpost-profile-js', 'username', $username);


}

function getLastPathSegment($url) {
        $path = parse_url($url, PHP_URL_PATH); // to get the path from a whole URL
        $pathTrimmed = trim($path, '/'); // normalise with no leading or trailing slash
        $pathTokens = explode('/', $pathTrimmed); // get segments delimited by a slash

        if (substr($path, -1) !== '/') {
            array_pop($pathTokens);
        }
        return end($pathTokens); // get the last segment
   }


/********************************
**********SETUP ROUTING**********
*********************************/

register_activation_hook(__FILE__, 'imo_superpost_flush_rules');
function imo_superpost_flush_rules()
{



    //add_rewrite_rule('plus/trophy-buck/([^/]+)', 'index.php?pagename=superpost&templatename=superpost_single&spid=$matches[1]', 'top');
    flush_rewrite_rules(false);
}

add_action('init', 'imo_superpost_setup_routes');
function imo_superpost_setup_routes() {
	add_rewrite_rule('profile/([^/]+)', 'index.php?pagename=user-profile&templatename=user_profile&username=$matches[1]', 'top');

    add_rewrite_rule('recon-photos/([^/]*)', 'index.php?pagename=recon-photos&templatename=recon_photos&username=$matches[1]', 'top');
    add_rewrite_rule('recon-photos/?$', 'index.php?pagename=recon-photos&templatename=recon_photos', 'top');

    add_rewrite_rule('plus/report/([^/]+)', 'index.php?pagename=superpost-single&templatename=superpost_single&spid=$matches[1]', 'top');

    add_rewrite_rule('plus/general/([^/]+)', 'index.php?pagename=superpost-single&templatename=superpost_single&spid=$matches[1]', 'top');
    add_rewrite_rule('plus/tip/([^/]+)', 'index.php?pagename=superpost-single&templatename=superpost_single&spid=$matches[1]', 'top');
    add_rewrite_rule('plus/lifestyle/([^/]+)', 'index.php?pagename=superpost-single&templatename=superpost_single&spid=$matches[1]', 'top');
    add_rewrite_rule('plus/trophy/([^/]+)', 'index.php?pagename=superpost-single&templatename=superpost_single&spid=$matches[1]', 'top');
    add_rewrite_rule('plus/gear/([^/]+)', 'index.php?pagename=superpost-single&templatename=superpost_single&spid=$matches[1]', 'top');
    add_rewrite_rule('plus/question/([^/]+)', 'index.php?pagename=superpost-single&templatename=superpost_single&spid=$matches[1]', 'top');


    add_rewrite_rule('community/trophy/([^/]+)', 'index.php?pagename=superpost-state&templatename=state&post_type=trophy&state=$matches[1]', 'top');
    add_rewrite_rule('community/report/([^/]+)', 'index.php?pagename=superpost-state&templatename=state&post_type=report&state=$matches[1]', 'top');
}


add_filter('query_vars', 'imo_superpost_query_vars');
function imo_superpost_query_vars($query_vars)
{


    $query_vars[] = 'username';
    $query_vars[] = 'spid';
    $query_vars[] = 'templatename';
    $query_vars[] = 'state';
    $query_vars[] = 'post_type';

    return $query_vars;
}


add_action("pre_get_posts","add_sp_conditional_scripts");

//This adds script only to pages that use them.
function add_sp_conditional_scripts() {




}

add_action('template_redirect', 'imo_superpost_modify_query_vars',5);
function imo_superpost_modify_query_vars() {

    global $wp_query;
    //print_r($wp_query->query_vars);

    $queryVars = $wp_query->query_vars;

    if ($queryVars["spid"]) {
        $postData = get_imo_superpost_post_data($queryVars['spid']);


        $wp_query->query_vars['post_title'] = $postData->title;
        $wp_query->query_vars['seo_image'] = $postData->img_url;
        $wp_query->query_vars['seo_body'] = substr($postData->body,0,160) . "...";
    }
}


function get_imo_superpost_post_data($spid) {
    global $wpdb;

    $postData = $wpdb->get_row($wpdb->prepare("SELECT * FROM slim.superposts WHERE id = %d",$spid));

    return $postData;
}




add_filter( 'wp_title', 'imo_superpost_set_title', 50, 3 );
function imo_superpost_set_title($title,$sep,$seplocation) {


    global $wp_query;



    $queryVars = $wp_query->query_vars;



    if ($queryVars["spid"]) {
        $title = $wp_query->query_vars['post_title'];
        //$title = "cheese";
    }


    return $title;

}






//Set the FB Opengraph Meta title
add_filter( 'wpseo_opengraph_title',"imo_superpost_seo_title");
function imo_superpost_seo_title($title) {

    global $wp_query;

    //If this is community single post, change the meta.
    if ($wp_query->query_vars['spid']) {
        $title = $wp_query->query_vars['post_title'];
    }


    return $title;
}

add_filter( 'wpseo_opengraph_desc',"imo_superpost_seo_desc");
function imo_superpost_seo_desc($desc) {

    global $wp_query;

    //If this is community single post, change the meta.
    if ($wp_query->query_vars['spid']) {
        $desc = $wp_query->query_vars['seo_body'];
    }


    return $desc;
}

add_filter( 'wpseo_opengraph_image',"imo_superpost_seo_image");
function imo_superpost_seo_image($image) {

    global $wp_query;

    //If this is community single post, change the meta.
    if ($wp_query->query_vars['spid']) {
        $image = $wp_query->query_vars['seo_image'];
    }

    return $image;
}

add_filter( 'wpseo_opengraph_type',"imo_superpost_seo_type");
function imo_superpost_seo_type($type) {

    global $wp_query;

    //If this is community single post, change the meta.
    if ($wp_query->query_vars['spid']) {
        $type = "article";
    }

    return $type;
}




