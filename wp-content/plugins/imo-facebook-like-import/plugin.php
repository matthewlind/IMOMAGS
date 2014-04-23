<?php
/*
 * Plugin Name: IMO Facebook Like Import
 * Plugin URI: http://github.com/imoutdoors
 * Description: Imports facebook likes to postmeta for a set of posts
 * Version: 0.1
 * Author: Aaron Baker
 * Author URI: http://imomags.com
 */


include("widget.php");


function imo_facebook_like_css() {


}

/* create options page. */
function imo_facebook_like_import_generate_options_page() {
    ?>
    <div class="wrap">
        <h2>Import Facebook Likes</h2>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"></th>
                <td>

                    <?php

                        if ($_GET['import'] == "start") {

                            echo "<h3>STARTING</h3>";


                            global $wpdb;

                            $posts = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_type = 'reader_photos' ORDER BY id DESC LIMIT 200" );

                            $fbGraphURL = "http://graph.facebook.com/?id=";

                            foreach ($posts as $post) {


                                $getURL = $fbGraphURL . $post->guid;

                                $fbResult = json_decode( file_get_contents($getURL) );

                                $shares = 0;

                                if (!empty($fbResult->shares)) {

                                    $shares = $fbResult->shares;
                                }




                                echo "$shares: {$post->guid}<br>";
                                update_post_meta($post->ID, "facebook_like_count", $shares);

                                flush();



                            }




                        } else {

                            echo '<h2>This plugin imports likes from facebook. </h2><a href="?page=imo-com-fb-import-menu&import=start">START IMPORT</a>';
                        }


                    ?>

                </td>
            </tr>
        </table>
    </div>
    <?php
}





/* admin_menu callback. */
function imo_facebook_like_import_settings_init() {

    add_submenu_page("options-general.php", "IMO Facebook Like Import", "Facebook Import", "manage_options", "imo-com-fb-import-menu", "imo_facebook_like_import_generate_options_page");

}

add_action("admin_menu", "imo_facebook_like_import_settings_init");




