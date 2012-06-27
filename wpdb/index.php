<?php
/**
 * Step 1: Require the Slim PHP 5 Framework
 *
 * If using the default file layout, the `Slim/` directory
 * will already be on your include path. If you move the `Slim/`
 * directory elsewhere, ensure that it is added to your include path
 * or update this file path as needed.
 */
require 'Slim/Slim.php';

/**
 * Step 2: Instantiate the Slim application
 *
 * Here we instantiate the Slim application with its default settings.
 * However, we could also pass a key-value array of settings.
 * Refer to the online documentation for available settings.
 */
$app = new Slim();
include 'mysql.php';
/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, and `Slim::delete`
 * is an anonymous function. If you are using PHP < 5.3, the
 * second argument should be any variable that returns `true` for
 * `is_callable()`. An example GET route for PHP < 5.3 is:
 *
 * $app = new Slim();
 * $app->get('/hello/:name', 'myFunction');
 * function myFunction($name) { echo "Hello, $name"; }
 *
 * The routes below work with PHP >= 5.3.
 */

//GET route
$app->get('/imomags/term/naw-plus', function () {

    header('Access-Control-Allow-Origin: *');  


    try {

        $db = dbConnect();


        $sql = <<<EOT
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Guns & Ammo" as brand,
(SELECT count(comment_ID) from wp_2_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.gunsandammo.com" as domain  
FROM wp_2_posts as posts
JOIN wp_2_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_2_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_2_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_2_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_2_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Bowhunter" as brand,
(SELECT count(comment_ID) from wp_3_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.bowhunter.com" as domain
FROM wp_3_posts as posts
JOIN wp_3_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_3_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_3_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_3_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_3_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Petersen's Bowhunting" as brand,
(SELECT count(comment_ID) from wp_4_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.petersenshunting.com" as domain  
FROM wp_4_posts as posts
JOIN wp_4_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_4_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_4_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_4_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_4_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Gundog" as brand,
(SELECT count(comment_ID) from wp_5_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.gundogmag.com" as domain
FROM wp_5_posts as posts
JOIN wp_5_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_5_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_5_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_5_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_5_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "North American Whitetail" as brand,
(SELECT count(comment_ID) from wp_6_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.northamericanwhitetail.com" as domain
FROM wp_6_posts as posts
JOIN wp_6_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_6_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_6_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_6_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_6_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Petersen's Hunting" as brand,
(SELECT count(comment_ID) from wp_7_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.petersenshunting.com" as domain  
FROM wp_7_posts as posts
JOIN wp_7_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_7_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_7_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_7_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_7_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Wildfowl" as brand,
(SELECT count(comment_ID) from wp_8_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.wildfowlmag.com" as domain
FROM wp_8_posts as posts
JOIN wp_8_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_8_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_8_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_8_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_8_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Handguns" as brand,
(SELECT count(comment_ID) from wp_9_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.handgunsmag.com" as domain  
FROM wp_9_posts as posts
JOIN wp_9_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_9_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_9_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_9_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_9_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Rifleshooter" as brand,
(SELECT count(comment_ID) from wp_10_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.rifleshootermag.com" as domain  
FROM wp_10_posts as posts
JOIN wp_10_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_10_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_10_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_10_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_10_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Shooting Times" as brand,
(SELECT count(comment_ID) from wp_11_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.shootingtimes.com" as domain
FROM wp_11_posts as posts
JOIN wp_11_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_11_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_11_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_11_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_11_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Shotgun News" as brand,
(SELECT count(comment_ID) from wp_12_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_coun, "www.shotgunnews.com" as domain
FROM wp_12_posts as posts
JOIN wp_12_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_12_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_12_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_12_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_12_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Florida Sportsman" as brand,
(SELECT count(comment_ID) from wp_13_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.floridasportsman.com" as domain
FROM wp_13_posts as posts
JOIN wp_13_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_13_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_13_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_13_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_13_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Game & Fish" as brand,
(SELECT count(comment_ID) from wp_14_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.gameandfishmag.com" as domain
FROM wp_14_posts as posts
JOIN wp_14_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_14_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_14_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_14_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_14_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "In-Fisherman" as brand,
(SELECT count(comment_ID) from wp_15_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.in-fisherman.com" as domain
FROM wp_15_posts as posts
JOIN wp_15_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_15_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_15_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_15_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_15_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Flyfisherman" as brand,
(SELECT count(comment_ID) from wp_16_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.flyfisherman.com" as domain
FROM wp_16_posts as posts
JOIN wp_16_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_16_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_16_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_16_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_16_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND meta.meta_key = "_thumbnail_id")
ORDER BY post_date DESC LIMIT 200
EOT;

        $stmt = $db->prepare($sql);
        $stmt->execute();

        $posts = $stmt->fetchAll(PDO::FETCH_OBJ);

        foreach ($posts as $key => $post) {
            $postContent = trim(strip_tags($post->post_content));
            $postContent = preg_replace('/\[[^\)]+\]/', "", $postContent);
            $postContent = str_replace("\n", "", $postContent);
            $postContent = str_replace("\r", "", $postContent);
            $postContent = substr($postContent,0,120) . "...";
            $posts[$key]->post_content = $postContent;

            $timestamp =  strtotime($post->post_date);
            $datePath = date("Y/m/d",$timestamp);
            $url = "http://" . $post->domain . "/" . $datePath . "/" . $post->post_name;

            $posts[$key]->post_url = $url;

            $niceDate = date("F j, Y",$timestamp);
            $posts[$key]->post_nicedate = $niceDate;

            $thumbnail = str_replace(".jpg", "-190x120.jpg", $post->img_url);
            $posts[$key]->img_url = $thumbnail;

            if ($post->domain == "www.northamericanwhitetail.com") {
                $posts[$key]->terms = getWhitetailPostTerms($post->ID);
            }
            

        }


        $json = json_encode($posts);

        $f = fopen("cache/naw-plus.json", "w");
        fwrite($f, $json);
        fclose($f); 

        echo $json;

        $db = "";

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
  
});



//************************************************
//*** Get all posts in NAW+ AND SOMETHING ELSE ***
//************************************************
$app->get('/imomags/term/naw-plus/:term',function($term){

    header('Access-Control-Allow-Origin: *');  

    try {

        $db = dbConnect();


        $sql = <<<EOT
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug as slug, terms2.slug as slug2, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Guns & Ammo" as brand,
(SELECT count(comment_ID) from wp_2_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.gunsandammo.com" as domain
FROM wp_2_term_relationships as relationships
JOIN wp_2_term_relationships as relationships2 ON (relationships.`object_id` = relationships2.`object_id`)
JOIN wp_2_term_taxonomy as term_taxonomy2 ON (relationships2.term_taxonomy_id = term_taxonomy2.term_taxonomy_id)
JOIN wp_2_terms as terms2 ON (term_taxonomy2.term_id = terms2.term_id)
JOIN wp_2_posts as posts ON (posts.ID = relationships.object_id)
JOIN wp_2_term_taxonomy as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.term_taxonomy_id)
JOIN wp_2_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_2_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_2_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND terms2.slug = ?
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug as slug, terms2.slug as slug2, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Bowhunter" as brand,
(SELECT count(comment_ID) from wp_3_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.bowhunter.com" as domain
FROM wp_3_term_relationships as relationships
JOIN wp_3_term_relationships as relationships2 ON (relationships.`object_id` = relationships2.`object_id`)
JOIN wp_3_term_taxonomy as term_taxonomy2 ON (relationships2.term_taxonomy_id = term_taxonomy2.term_taxonomy_id)
JOIN wp_3_terms as terms2 ON (term_taxonomy2.term_id = terms2.term_id)
JOIN wp_3_posts as posts ON (posts.ID = relationships.object_id)
JOIN wp_3_term_taxonomy as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.term_taxonomy_id)
JOIN wp_3_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_3_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_3_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND terms2.slug = ?
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug as slug, terms2.slug as slug2, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Petersen's Bowhunting" as brand,
(SELECT count(comment_ID) from wp_4_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.petersensbowhunting.com" as domain
FROM wp_4_term_relationships as relationships
JOIN wp_4_term_relationships as relationships2 ON (relationships.`object_id` = relationships2.`object_id`)
JOIN wp_4_term_taxonomy as term_taxonomy2 ON (relationships2.term_taxonomy_id = term_taxonomy2.term_taxonomy_id)
JOIN wp_4_terms as terms2 ON (term_taxonomy2.term_id = terms2.term_id)
JOIN wp_4_posts as posts ON (posts.ID = relationships.object_id)
JOIN wp_4_term_taxonomy as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.term_taxonomy_id)
JOIN wp_4_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_4_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_4_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND terms2.slug = ?
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug as slug, terms2.slug as slug2, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Gundog" as brand,
(SELECT count(comment_ID) from wp_5_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.gundogmag.com" as domain
FROM wp_5_term_relationships as relationships
JOIN wp_5_term_relationships as relationships2 ON (relationships.`object_id` = relationships2.`object_id`)
JOIN wp_5_term_taxonomy as term_taxonomy2 ON (relationships2.term_taxonomy_id = term_taxonomy2.term_taxonomy_id)
JOIN wp_5_terms as terms2 ON (term_taxonomy2.term_id = terms2.term_id)
JOIN wp_5_posts as posts ON (posts.ID = relationships.object_id)
JOIN wp_5_term_taxonomy as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.term_taxonomy_id)
JOIN wp_5_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_5_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_5_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND terms2.slug = ?
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug as slug, terms2.slug as slug2, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "North American Whitetail" as brand,
(SELECT count(comment_ID) from wp_6_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.northamericanwhitetail.com" as domain
FROM wp_6_term_relationships as relationships
JOIN wp_6_term_relationships as relationships2 ON (relationships.`object_id` = relationships2.`object_id`)
JOIN wp_6_term_taxonomy as term_taxonomy2 ON (relationships2.term_taxonomy_id = term_taxonomy2.term_taxonomy_id)
JOIN wp_6_terms as terms2 ON (term_taxonomy2.term_id = terms2.term_id)
JOIN wp_6_posts as posts ON (posts.ID = relationships.object_id)
JOIN wp_6_term_taxonomy as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.term_taxonomy_id)
JOIN wp_6_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_6_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_6_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND terms2.slug = ?
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug as slug, terms2.slug as slug2, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Petersen's Hunting" as brand,
(SELECT count(comment_ID) from wp_7_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.petersenshunting.com" as domain
FROM wp_7_term_relationships as relationships
JOIN wp_7_term_relationships as relationships2 ON (relationships.`object_id` = relationships2.`object_id`)
JOIN wp_7_term_taxonomy as term_taxonomy2 ON (relationships2.term_taxonomy_id = term_taxonomy2.term_taxonomy_id)
JOIN wp_7_terms as terms2 ON (term_taxonomy2.term_id = terms2.term_id)
JOIN wp_7_posts as posts ON (posts.ID = relationships.object_id)
JOIN wp_7_term_taxonomy as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.term_taxonomy_id)
JOIN wp_7_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_7_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_7_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND terms2.slug = ?
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug as slug, terms2.slug as slug2, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Wildfowl" as brand,
(SELECT count(comment_ID) from wp_8_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.wildfowlmag.com" as domain
FROM wp_8_term_relationships as relationships
JOIN wp_8_term_relationships as relationships2 ON (relationships.`object_id` = relationships2.`object_id`)
JOIN wp_8_term_taxonomy as term_taxonomy2 ON (relationships2.term_taxonomy_id = term_taxonomy2.term_taxonomy_id)
JOIN wp_8_terms as terms2 ON (term_taxonomy2.term_id = terms2.term_id)
JOIN wp_8_posts as posts ON (posts.ID = relationships.object_id)
JOIN wp_8_term_taxonomy as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.term_taxonomy_id)
JOIN wp_8_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_8_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_8_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND terms2.slug = ?
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug as slug, terms2.slug as slug2, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Handguns" as brand,
(SELECT count(comment_ID) from wp_9_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.handgunsmag.com" as domain
FROM wp_9_term_relationships as relationships
JOIN wp_9_term_relationships as relationships2 ON (relationships.`object_id` = relationships2.`object_id`)
JOIN wp_9_term_taxonomy as term_taxonomy2 ON (relationships2.term_taxonomy_id = term_taxonomy2.term_taxonomy_id)
JOIN wp_9_terms as terms2 ON (term_taxonomy2.term_id = terms2.term_id)
JOIN wp_9_posts as posts ON (posts.ID = relationships.object_id)
JOIN wp_9_term_taxonomy as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.term_taxonomy_id)
JOIN wp_9_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_9_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_9_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND terms2.slug = ?
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug as slug, terms2.slug as slug2, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Rifleshooter" as brand,
(SELECT count(comment_ID) from wp_10_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.rifleshootermag.com" as domain
FROM wp_10_term_relationships as relationships
JOIN wp_10_term_relationships as relationships2 ON (relationships.`object_id` = relationships2.`object_id`)
JOIN wp_10_term_taxonomy as term_taxonomy2 ON (relationships2.term_taxonomy_id = term_taxonomy2.term_taxonomy_id)
JOIN wp_10_terms as terms2 ON (term_taxonomy2.term_id = terms2.term_id)
JOIN wp_10_posts as posts ON (posts.ID = relationships.object_id)
JOIN wp_10_term_taxonomy as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.term_taxonomy_id)
JOIN wp_10_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_10_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_10_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND terms2.slug = ?
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug as slug, terms2.slug as slug2, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Shooting Times" as brand,
(SELECT count(comment_ID) from wp_11_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.shootingtimes.com" as domain
FROM wp_11_term_relationships as relationships
JOIN wp_11_term_relationships as relationships2 ON (relationships.`object_id` = relationships2.`object_id`)
JOIN wp_11_term_taxonomy as term_taxonomy2 ON (relationships2.term_taxonomy_id = term_taxonomy2.term_taxonomy_id)
JOIN wp_11_terms as terms2 ON (term_taxonomy2.term_id = terms2.term_id)
JOIN wp_11_posts as posts ON (posts.ID = relationships.object_id)
JOIN wp_11_term_taxonomy as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.term_taxonomy_id)
JOIN wp_11_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_11_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_11_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND terms2.slug = ?
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug as slug, terms2.slug as slug2, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Shotgun News" as brand,
(SELECT count(comment_ID) from wp_12_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.shotgunnews.com" as domain
FROM wp_12_term_relationships as relationships
JOIN wp_12_term_relationships as relationships2 ON (relationships.`object_id` = relationships2.`object_id`)
JOIN wp_12_term_taxonomy as term_taxonomy2 ON (relationships2.term_taxonomy_id = term_taxonomy2.term_taxonomy_id)
JOIN wp_12_terms as terms2 ON (term_taxonomy2.term_id = terms2.term_id)
JOIN wp_12_posts as posts ON (posts.ID = relationships.object_id)
JOIN wp_12_term_taxonomy as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.term_taxonomy_id)
JOIN wp_12_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_12_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_12_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND terms2.slug = ?
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug as slug, terms2.slug as slug2, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Florida Sportsman" as brand,
(SELECT count(comment_ID) from wp_13_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.floridasportsman.com" as domain
FROM wp_13_term_relationships as relationships
JOIN wp_13_term_relationships as relationships2 ON (relationships.`object_id` = relationships2.`object_id`)
JOIN wp_13_term_taxonomy as term_taxonomy2 ON (relationships2.term_taxonomy_id = term_taxonomy2.term_taxonomy_id)
JOIN wp_13_terms as terms2 ON (term_taxonomy2.term_id = terms2.term_id)
JOIN wp_13_posts as posts ON (posts.ID = relationships.object_id)
JOIN wp_13_term_taxonomy as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.term_taxonomy_id)
JOIN wp_13_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_13_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_13_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND terms2.slug = ?
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug as slug, terms2.slug as slug2, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Game & Fish" as brand,
(SELECT count(comment_ID) from wp_14_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.gameandfishmag.com" as domain
FROM wp_14_term_relationships as relationships
JOIN wp_14_term_relationships as relationships2 ON (relationships.`object_id` = relationships2.`object_id`)
JOIN wp_14_term_taxonomy as term_taxonomy2 ON (relationships2.term_taxonomy_id = term_taxonomy2.term_taxonomy_id)
JOIN wp_14_terms as terms2 ON (term_taxonomy2.term_id = terms2.term_id)
JOIN wp_14_posts as posts ON (posts.ID = relationships.object_id)
JOIN wp_14_term_taxonomy as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.term_taxonomy_id)
JOIN wp_14_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_14_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_14_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND terms2.slug = ?
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug as slug, terms2.slug as slug2, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "In-Fisherman" as brand,
(SELECT count(comment_ID) from wp_15_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.in-fisherman.com" as domain
FROM wp_15_term_relationships as relationships
JOIN wp_15_term_relationships as relationships2 ON (relationships.`object_id` = relationships2.`object_id`)
JOIN wp_15_term_taxonomy as term_taxonomy2 ON (relationships2.term_taxonomy_id = term_taxonomy2.term_taxonomy_id)
JOIN wp_15_terms as terms2 ON (term_taxonomy2.term_id = terms2.term_id)
JOIN wp_15_posts as posts ON (posts.ID = relationships.object_id)
JOIN wp_15_term_taxonomy as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.term_taxonomy_id)
JOIN wp_15_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_15_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_15_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND terms2.slug = ?
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug as slug, terms2.slug as slug2, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Flyfisherman" as brand,
(SELECT count(comment_ID) from wp_16_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "www.flyfisherman.com" as domain
FROM wp_16_term_relationships as relationships
JOIN wp_16_term_relationships as relationships2 ON (relationships.`object_id` = relationships2.`object_id`)
JOIN wp_16_term_taxonomy as term_taxonomy2 ON (relationships2.term_taxonomy_id = term_taxonomy2.term_taxonomy_id)
JOIN wp_16_terms as terms2 ON (term_taxonomy2.term_id = terms2.term_id)
JOIN wp_16_posts as posts ON (posts.ID = relationships.object_id)
JOIN wp_16_term_taxonomy as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.term_taxonomy_id)
JOIN wp_16_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_16_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_16_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "naw-plus"
AND terms2.slug = ?
AND meta.meta_key = "_thumbnail_id")
ORDER BY post_date DESC LIMIT 200


EOT;

        $stmt = $db->prepare($sql);
        $stmt->execute(array($term,$term,$term,$term,$term,$term,$term,$term,$term,$term,$term,$term,$term,$term,$term));
    
        $posts = $stmt->fetchAll(PDO::FETCH_OBJ);

        foreach ($posts as $key => $post) {
            $postContent = trim(strip_tags($post->post_content));
            $postContent = preg_replace('/\[[^\)]+\]/', "", $postContent);
            $postContent = str_replace("\n", "", $postContent);
            $postContent = str_replace("\r", "", $postContent);
            $postContent = substr($postContent,0,120) . "...";
            $posts[$key]->post_content = $postContent;


            $timestamp =  strtotime($post->post_date);
            $datePath = date("Y/m/d",$timestamp);
            $url = "http://" . $post->domain . "/" . $datePath . "/" . $post->post_name;

            $posts[$key]->post_url = $url;

            $niceDate = date("F j, Y",$timestamp);
            $posts[$key]->post_nicedate = $niceDate;

            $thumbnail = str_replace(".jpg", "-190x120.jpg", $post->img_url);
            $posts[$key]->img_url = $thumbnail;

            if ($post->domain == "www.northamericanwhitetail.com") {
                $posts[$key]->terms = getWhitetailPostTerms($post->ID);
            }

        }

        $json = json_encode($posts);
        echo $json;

        $db = "";

        $f = fopen("cache/naw-plus-$term.json", "w");
        fwrite($f, $json);
        fclose($f); 

    } catch(PDOException $e) {
        echo $e->getMessage();
    }

});

/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This is responsible for executing
 * the Slim application using the settings and routes defined above.
 */


function getWhitetailPostTerms($post_id) {

    try {

        $db = dbConnect();

        $sql = "SELECT DISTINCT name,slug,t.term_id,taxonomy From wp_6_terms as t
            JOIN wp_6_term_taxonomy as tt on (t.`term_id` = tt.`term_id`)
            JOIN `wp_6_term_relationships`as tr on (tr.`term_taxonomy_id` = tt.`term_taxonomy_id`)
            WHERE tr.`object_id` = ?
            AND taxonomy = 'category'";

        

        $stmt = $db->prepare($sql);
        $stmt->execute(array($post_id));
    
        $terms = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = "";

        return($terms);

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}


$app->run();
