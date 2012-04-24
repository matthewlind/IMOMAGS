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
        if ( get_option("imo_redirect_enable", False)  ) 
        {
            $location = _imo_redirect_get_default_location();

            // If the redirect domain is www, aka home, then we need to try to guess the url
            // based on the slug. 
            if ( get_option("redirect_domain", "www") == "www" ) 
            {
                // Need to redirect to potential story.
                $path_string = array_filter(explode("/", strtolower( $_SERVER['REQUEST_URI'])));
                $potential_slug = array_pop($path_string);
                // if it's "index.html" then we need to ignore it. 
                if (substr($potential_slug, 0, 5) == "index") 
                {
                    $potential_slug = array_pop($path_string);
                }
                $potential_slug = join("_", $path_string) . "_" . $potential_slug;

                // slugs should be unique, so we should only grab one.  
                global $wpdb;
                $result = $wpdb->get_results(
                    $wpdb->prepare(
                        "SELECT ID 
                        FROM $wpdb->posts
                        WHERE post_type='post'
                        AND post_name='%s'
                        LIMIT 1
                        ",
                        $potential_slug
                    ),
                    ARRAY_A
                );

                if ($pID = (int) array_shift($result[0]) ) 
                {
                   $location = get_permalink($pID); 
                }
            }

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

/**
 * Helper function, returns the default location.
 */
function _imo_redirect_get_default_location() {
    
    //Aaron Commented out these 3 lines because the thought they broke the redirects to the Drupal sites.
    //if (get_option('redirect_domain', "www")) {
    //    return $_SERVER["HTTP_HOST"];
    //}
    $target_host = str_replace("www", get_option('redirect_domain', "www"), $_SERVER["HTTP_HOST"]);
    $location = "http://" . $target_host;

    // we only append the current URI if the target host does not match the current host. 
    if ($target_host != $_SERVER["HTTP_HOST"]) 
    {
        $location .= $_SERVER['REQUEST_URI'];
    }
    return $location;
}
add_action("template_redirect", "_imo_global_redirect");

/******************************************************************************************
 * Administration Menus
 * Adds a redirect_domain setting to the General Options page in the admin_menu, allowing for 
 * overriding the inferred domain tag.
 ******************************************************************************************/

/* add_settings_field callback */
function imo_redirector_enable_settings_option() {
    $checked = (get_option("imo_redirect_enable", False) == True); 
    echo "<input type='checkbox' name='imo_redirect_enable' id='imo-redirector_imo-redirect-enable' ". (($checked) ? "checked='true'" : "") ." value='True' />";
}
function imo_redirector_domain_settings_option() {

    echo "<input type='text' name='redirect_domain' id='imo-redirector_redirect-domain' value='".get_option("redirect_domain", "www"  )."' />";
    echo "<p>(Leaving this set to 'www' will redirect all missing pages to the homepage.)</p>";
}

function imo_redirector_settings_section() {
    echo "";
}

/* admin_menu callback. */
function imo_redirector_settings_init() {
    add_settings_section("redirector_settings", __("Redirect Settings"), "imo_redirector_settings_section", "general");
    add_settings_field("redirect_domain", __("Redirect Domain"), "imo_redirector_domain_settings_option", "general", "redirector_settings");
    add_settings_field("imo_redirect_enable", __("Enable Redirecting"), "imo_redirector_enable_settings_option", "general", "redirector_settings");
    register_setting("general", "redirect_domain");
    register_setting("general", "imo_redirect_enable");
}
add_action("admin_menu", "imo_redirector_settings_init");
