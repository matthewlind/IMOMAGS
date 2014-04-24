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

add_action('init', 'imo_facebook_like_css');
function imo_facebook_like_css() {
    wp_enqueue_style('styles-css',plugins_url('css/styles.css', __FILE__));
}

if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => 'acf_facebook-like-import-options',
        'title' => 'Facebook Like Import Options',
        'fields' => array (
            array (
                'key' => 'field_535811fabd7ba',
                'label' => 'Post Type',
                'name' => 'like_import_post_type',
                'type' => 'text',
                'instructions' => 'Enter a wordpress post type to be used when importing likes from facebook. Only the posts of this type will have their likes imported. Try e.g. "reader_photos" or "post" or "magazines"',
                'default_value' => 'reader_photos',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53581279bd7bb',
                'label' => 'Import Start Date',
                'name' => 'like_import_start_date',
                'type' => 'text',
                'instructions' => 'Choose the start and end dates for the import. Only posts created between these dates will have their likes imported. Use format YYYY-MM-DD',
                'default_value' => '2014-04-12',
                'placeholder' => '2014-04-12',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none'
            ),
            array (
                'key' => 'field_5358134dfc4ab',
                'label' => 'Import End Date',
                'name' => 'like_import_end_date',
                'type' => 'text',
                'instructions' => 'Use format YYYY-MM-DD.',
                'default_value' => '2014-07-15',
                'placeholder' => '2014-07-15',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none'
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options',
                    'order_no' => '0',
                    'group_no' => '0',
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
}


function imo_facebook_import_likes() {


    global $wpdb;

    $post_type = get_option("options_like_import_post_type","reader_photos");
    $startDate = get_option("options_like_import_start_date","2014-04-12");
    $endDate = get_option("options_like_import_end_date","2014-06-12");

    $query = "SELECT * FROM $wpdb->posts WHERE post_type = '$post_type' AND (post_date BETWEEN '$startDate' AND '$endDate') ORDER BY id DESC LIMIT 200";

    //echo $query;
    $posts = $wpdb->get_results( $query );


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

                            imo_facebook_import_likes();




                        } else {

                            echo '<h2>This plugin imports likes from facebook. </h2><a href="?page=imo-com-fb-import-menu&import=start">START IMPORT</a>';


                            $post_type = get_option("options_like_import_post_type","reader_photos");
                            $startDate = get_option("options_like_import_start_date","2014-04-12");
                            $endDate = get_option("options_like_import_end_date","2014-06-12");

                            echo "<p><b>Current Settings:</b><br>";
                            echo "Clicking start import will find all posts with the post type <b>$post_type</b> that were created between <b>$startDate</b> and <b>$endDate</b> and it contact Facebook and import the number of LIKEs for each post. This LIKE count is stored in a postmeta called <b>facebook_like_count</b>. Imports will also occur automatically every 24 hours as long as this plugin is active.";
                            echo "</p><p>The settings for this import can be <a href='/wp-admin/admin.php?page=acf-options'>administered here.</a></p>";
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




