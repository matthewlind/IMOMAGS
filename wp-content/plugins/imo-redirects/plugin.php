<?php
/*
Plugin Name: IMO 503 Redirector
Plugin URI: http://dev.imomags.com
Description: Redirect missing pages appropriately.  
Version: 1.1
Author: Jacob Angel
Author URI: http://imomags.com
 */

function _imo_global_redirect() {
    if ( is_404() ) 
    {
        if (defined("DRUPAL_SITE") && DRUPAL_SITE == true) 
        {
            $location = "http://" . str_replace("www", "archive", $_SERVER["HTTP_HOST"]) . $_SERVER['REQUEST_URI'];
            header("Location: $location", TRUE, 307);
        }
        else
        {
            $location = get_bloginfo("home");
            header('HTTP/1.1 503 Service Temporarily Unavailable');
            header('Retry-After: Sat, 11 Jul 2011 18:27:00 GMT');

            print '<html><head><meta http-equiv="refresh" content="0;url='.$location.'"></head><body>If you are not automatically redirected, click <a href="'.$location.'">here</a>.</body></html>';
        }
        exit();
    }
}

add_action("template_redirect", "_imo_global_redirect");
