<?php
/*
 * Plugin Name: IMO Permissions
 * Plugin URI: http://github.com/imoutdoors
 * Description: Makes customizations to the permissions on IMO sites.
 * Version: 0.1
 * Author: jacob angel 
 * Author URI: http://imomags.com
 */


if (function_exists("add_role")) {
    add_role("trial_user", "Trial User", array(
        "read" => true,
        "edit_posts" => true,
        "delete_posts" => true,
        "upload_files" => true,
        ));
}
