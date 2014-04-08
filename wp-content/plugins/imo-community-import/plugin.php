<?php
/*
 * Plugin Name: IMO G&F Community Import
 * Plugin URI: http://github.com/imoutdoors
 * Description: Imports the community posts from a special MySQL view into wordpress posts
 * Version: 0.1
 * Author: Aaron Baker
 * Author URI: http://imomags.com
 */




/* create options page. */
function imo_gf_import_generate_options_page() {
    ?>
    <div class="wrap">
        <h2>Import G&F Community</h2>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"></th>
                <td>

                    <?php

                        if ($_GET['import'] == "start") {

                            echo "<h3>STARTING</h3>";

                            $statesAbbv = array('AL' => 'alabama','AK' => 'alaska','AZ' => 'arizona','AR' => 'arkansas','CA' => 'california','CO' => 'colorado','CT' => 'connecticut','DE' => 'delaware','FL' => 'florida','GA' => 'georgia','HI' => 'hawaii','ID' => 'idaho','IL' => 'illinois','IN' => 'indiana','IA' => 'iowa','KS' => 'kansas','KY' => 'kentucky','LA' => 'louisiana','ME' => 'maine','MD' => 'maryland','MA' => 'massachusetts','MI' => 'michigan','MN' => 'minnesota','MS' => 'mississippi','MO' => 'missouri','MT' => 'montana','NE' => 'nebraska','NV' => 'nevada','NH' => 'new-hampshire','NJ' => 'new-jersey','NM' => 'new-mexico','NY' => 'new-york','NC' => 'north-carolina','ND' => 'north-dakota','OH' => 'ohio','OK' => 'oklahoma','OR' => 'oregon','PA' => 'pennsylvania','RI' => 'rhode-island','SC' => 'south-carolina','SD' => 'south-dakota','TN' => 'tennessee','TX' => 'texas','UT' => 'utah','VT' => 'vermont', 'VA' => 'virginia','WA' => 'washington','WV' => 'west-virginia','WI' => 'wisconsin','WY' => 'wyoming');


                            global $wpdb;

                            $superposts = $wpdb->get_results( "SELECT * FROM slim.gfimport ORDER BY id DESC LIMIT 3" );

                            foreach ($superposts as $superpost) {


                                //first check to see if it's been imported
                                $test = $wpdb->get_var( "SELECT meta_value FROM imomags.wp_14_postmeta WHERE meta_key = 'legacy_spid' AND meta_value = '{$superpost->id}'" );

                                echo "test:";
                                echo $test;

                                if (empty($test)) {

                                    //Get State Category
                                    $stateSlug = $statesAbbv[$superpost->state];
                                    $stateCategory = get_category_by_slug( $stateSlug );

                                    //Get species category
                                    $speciesCategory = get_category_by_slug( $superpost->post_type );


                                    $postData = array(
                                      'post_content'   => $superpost->body, // The full text of the post.
                                      'post_title'     => $superpost->title, // The title of your post.
                                      'post_status'    => 'publish',
                                      'post_type'      => 'reader_photos',
                                      'post_author'    => $superpost->user_id, // The user ID number of the author. Default is the current user ID.

                                      'post_date'      => $superpost->created, // The time post was made.

                                      'comment_status' => 'open', // Default is the option 'default_comment_status', or 'closed'.
                                      'post_category'  => array($stateCategory->term_id,$speciesCategory->term_id) // Default empty.

                                    );

                                    //Insert the Post
                                    $postID = wp_insert_post( $postData, FALSE );

                                    if ($postID == 0) {
                                        echo "<b>SUPERPOST $superpost->id IMPORT FAILED</b><br>";
                                    } else {
                                        echo "SUPERPOST $superpost->id IMPORTED TO $postID<br>";

                                        //Update the post meta
                                        update_post_meta($postID, 'camera_corner_taken', $superpost->location);
                                        update_post_meta($postID, 'camera_corner_when', $superpost->date);
                                        update_post_meta($postID, 'camera_corner_who', $superpost->peoplewith);
                                        update_post_meta($postID, 'legacy_spid', $superpost->id);


                                        //Upload the thumbnail
                                        $imagePathParts = pathinfo($superpost->img_url);
                                        $uploadedFileName = $imagePathParts['basename'];

                                        //print_r($imagePathParts);

                                        //echo "uploadedfilename: $uploadedfilename";

                                        $fileData = file_get_contents($superpost->img_url);

                                        $uploadedFile = wp_upload_bits( $uploadedFileName . ".jpg", null, $fileData);


                                        //print_r($uploadedFile);


                                        //Insert the post thumbnail
                                        $filename = $uploadedFile['file'];

                                        $wp_filetype = wp_check_filetype(basename($filename), null );
                                        $attachment = array(
                                            'post_mime_type' => $wp_filetype['type'],
                                            'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                                            'post_content' => '',
                                            'post_status' => 'inherit'
                                        );

                                        //print_r($filename);
                                        //print_r($attachment);

                                        $attach_id = wp_insert_attachment( $attachment, $filename, $postID );

                                        echo "attach_id: $attach_id";
                                        add_post_meta($postID, '_thumbnail_id', $attach_id, true);

                                        //Get any comments and insert them too

                                        $comments = $wpdb->get_results( "SELECT * FROM slim.superposts WHERE post_type = 'comment' AND parent = $superpost->id" );

                                        foreach ($comments as $comment) {

                                            $data = array(
                                                'comment_post_ID' => $postID,

                                                'comment_content' => $comment->body,
                                                'user_id' => $comment->user_id,


                                                'comment_date' => $comment->created,
                                                'comment_approved' => 1,
                                            );

                                            wp_insert_comment($data);


                                        }


                                    }


                                }



                                flush();




                            }



                        } else {

                            echo '<h2>DON\'T EVER USE THIS PLUGIN. ALSO, THIS PLUGIN REQUIRES A gfimport VIEW WHICH MAY NOT EXIST. </h2><a href="?page=imo-com-import-menu&import=start">START IMPORT</a>';
                        }


                    ?>

                </td>
            </tr>
        </table>
    </div>
    <?php
}





/* admin_menu callback. */
function imo_gf_import_settings_init() {

    add_submenu_page("options-general.php", "IMO Community GF Import", "Community Import", "manage_options", "imo-com-import-menu", "imo_gf_import_generate_options_page");

}

add_action("admin_menu", "imo_gf_import_settings_init");




