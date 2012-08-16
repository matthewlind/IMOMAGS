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
	
}




/********************************
**********SETUP ROUTING**********
*********************************/

register_activation_hook(__FILE__, 'imo_superpost_flush_rules');
function imo_superpost_flush_rules()
{

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

    //add_rewrite_rule('plus/trophy-buck/([^/]+)', 'index.php?pagename=superpost&templatename=superpost_single&spid=$matches[1]', 'top');
    flush_rewrite_rules(false);
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

    $template = get_query_var("templatename");
    $username = get_query_var("username");
    if ($template == "user_profile") {
        wp_enqueue_script('superpost-profile-js',plugins_url('js/profile.js', __FILE__));
        wp_localize_script( 'superpost-profile-js', 'username', $username);
    }
         

}



