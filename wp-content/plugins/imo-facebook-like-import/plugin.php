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

/////////////////////////////////////////
//Setup Schedule for Facebook Like import

register_activation_hook( __FILE__, 'prefix_activation' );

add_action( 'imo_facebook_import_event_hook', 'imo_facebook_import_likes' );

function prefix_activation() {
    wp_schedule_event( time(), 'hourly', 'imo_facebook_import_event_hook' );
}

register_deactivation_hook( __FILE__, 'prefix_deactivation' );

function prefix_deactivation() {
    wp_clear_scheduled_hook( 'imo_facebook_import_event_hook' );
}
/////////////////////////////////////////


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

    $query = "SELECT * FROM $wpdb->posts WHERE post_type = '$post_type' AND (post_date BETWEEN '$startDate' AND '$endDate') ORDER BY id DESC";

    //echo $query;
    $posts = $wpdb->get_results( $query );

    //print_r($posts);








    $totalPostCount = count($posts);
    $postCount = 0;

    //echo "tpc: $totalPostCount";

    $getAtOnce = 48;

    $FBrequestCount = ceil($totalPostCount / $getAtOnce);

    //echo "fbrq: $FBrequestCount ";

    for ($i=0; $i < $FBrequestCount; $i++) {

        //echo "heiy: $i";

        $startIndex = $i * $getAtOnce;
        $endIndex = ($i + 1) * $getAtOnce;

        if ($endIndex > $totalPostCount) {
            $endIndex = $totalPostCount;
        }

        $fbGraphURL = "http://graph.facebook.com/?ids=";


        echo "---------------------------------------------------------<br>";

        for ($j=$startIndex; $j < $endIndex; $j++) {

            //echo "hejy: $j";

            $post = $posts[$j];



            $postID = $post->ID;
            $permalink = get_permalink($postID);

            $permalink = str_replace(".deva", ".com", $permalink);
            $permalink = str_replace(".fox", ".com", $permalink);
            $permalink = str_replace(".devj", ".com", $permalink);




            $fbGraphURL .= $permalink . ",";

        }

        $fbGraphURL = rtrim($fbGraphURL, ',');

        //echo $fbGraphURL;

        $fbResults = json_decode( file_get_contents($fbGraphURL) );

        //print_r($fbResults);

        foreach ($fbResults as $FBID => $result) {

            $shares = 0;


            if (!empty($result->shares)) {

                $shares = $result->shares;
            }






            echo "$shares: {$FBID}<br>";
            update_post_meta($post->ID, "facebook_like_count", $shares);

            flush();
        }

    }


    $countQuery = "SELECT SUM(CONVERT(likes.meta_value, UNSIGNED INTEGER)) as like_count FROM wp_14_posts as posts
                                        JOIN wp_14_postmeta AS likes ON (posts.ID = likes.post_id AND likes.meta_key = 'facebook_like_count')
                                        WHERE post_type = '$post_type'
                                        AND posts.ID NOT IN (49658,49182,49252,48942,49681,50087)
                                        AND post_status = 'publish'
                                        AND (post_date BETWEEN '$startDate' AND '$endDate')
                                        ORDER BY like_count";

    $totalLikes = $wpdb->get_var( $countQuery );

    echo "<br>TOTAL LIKES: $totalLikes";


    // foreach ($posts as $post) {

    //     $postCount++;


    //     if (($postCount % 45) == 0) {





    //     }

    //     $postID = $post->ID;
    //     $permalink = get_permalink($postID);

    //     $permalink = str_replace(".deva", ".com", $permalink);
    //     $permalink = str_replace(".fox", ".com", $permalink);
    //     $permalink = str_replace(".devj", ".com", $permalink);

    //     $getURL = $fbGraphURL . $permalink;

    //     $fbResult = json_decode( file_get_contents($getURL) );

    //     $shares = 0;

    //     if (!empty($fbResult->shares)) {

    //         $shares = $fbResult->shares;
    //     }




    //     echo "$shares: {$permalink}<br>";
    //     update_post_meta($post->ID, "facebook_like_count", $shares);

    //     flush();



    // }

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




