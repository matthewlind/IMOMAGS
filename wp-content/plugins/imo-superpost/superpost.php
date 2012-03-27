<?php
/*  Copyright 2012 Aaron Baker*/
/*
Plugin Name: IMO SuperPost
Plugin URI: http://imomags.com
Description: Creates a service based UGC post type that is useful for 
Author: aaron
Author URI:
Version: 0.1
Stable tag: 0.1
License: IMO
*/

/********************************
*******LOAD SCRIPTS & STYLE******
*********************************/



add_action('init', 'imo_superpost_scripts');
function imo_superpost_scripts() {
	wp_enqueue_script('jquery-form',null,null,null,false);
	wp_enqueue_script('superpost-js',plugins_url('js/superpost.js', __FILE__));
	wp_enqueue_script('jquery-masonry',plugins_url('js/jquery.masonry.js', __FILE__));
	wp_enqueue_style('superpost-css',plugins_url('css/style.css', __FILE__));
	
}




/********************************
**********SETUP ROUTING**********
*********************************/

register_activation_hook(__FILE__, 'imo_superpost_flush_rules');
function imo_superpost_flush_rules()
{
    add_rewrite_rule('recon-photos/([^/]*)', 'index.php?pagename=recon-photos&templatename=recon_photos&username=$matches[1]', 'top');
    add_rewrite_rule('recon-photos/?$', 'index.php?pagename=recon-photos&templatename=recon_photos', 'top');
    add_rewrite_rule('recon-photo/([^/]+)', 'index.php?pagename=recon-photo&templatename=recon_photo&spid=$matches[1]', 'top');
    flush_rewrite_rules(false);
}

add_filter('query_vars', 'imo_superpost_query_vars');
function imo_superpost_query_vars($query_vars)
{
    $query_vars[] = 'username';
    $query_vars[] = 'spid';
    $query_vars[] = 'templatename';
    return $query_vars;
}



