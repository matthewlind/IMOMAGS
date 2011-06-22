<?php
/*
Plugin Name: IMO 503 Redirector
Plugin URI: http://dev.imomags.com
Description: Automatically provides a 503 response for missing resources.
Version: 1.0
Author: Jacob Angel
Author URI: http://imomags.com
*/

function _imo_global_redirect() {
        if ( is_404() ) {
                $location = "http://" . $_SERVER["HTTP_HOST"];
                $location = get_bloginfo("home");
                header('HTTP/1.1 503 Service Temporarily Unavailable');
                header('Retry-After: Sat, 11 Jul 2011 18:27:00 GMT');

                print '<html><head><meta http-equiv="refresh" content="0;url='.$location.'"></head><body>If you are not automatically redirected, click <a href="'.$location.'">here</a>.</body></html>';

                exit();
        }
}

add_action("template_redirect", "_imo_global_redirect");
