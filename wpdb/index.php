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
$app->get('/imomags/term', function () {

    header('Access-Control-Allow-Origin: *');  

    try {

        $db = dbConnect();


        $sql = <<<EOT
(SELECT posts.ID, posts.post_title, posts.post_date, terms.slug, LEFT(posts.post_content,420) as post_content, posts.post_excerpt,attachments.guid, users.display_name as author, "Guns & Ammo" as brand,
(SELECT count(comment_ID) from wp_2_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count  
FROM wp_2_posts as posts
JOIN wp_2_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_2_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_2_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_2_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_2_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "video"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_date, terms.slug, LEFT(posts.post_content,420) as post_content, posts.post_excerpt,attachments.guid, users.display_name as author, "Bowhunter" as brand,
(SELECT count(comment_ID) from wp_3_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count  
FROM wp_3_posts as posts
JOIN wp_3_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_3_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_3_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_3_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_3_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "video"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_date, terms.slug, LEFT(posts.post_content,420) as post_content, posts.post_excerpt,attachments.guid, users.display_name as author, "Petersen's Bowhunting" as brand,
(SELECT count(comment_ID) from wp_4_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count  
FROM wp_4_posts as posts
JOIN wp_4_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_4_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_4_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_4_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_4_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "video"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_date, terms.slug, LEFT(posts.post_content,420) as post_content, posts.post_excerpt,attachments.guid, users.display_name as author, "Gundog" as brand,
(SELECT count(comment_ID) from wp_5_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count  
FROM wp_5_posts as posts
JOIN wp_5_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_5_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_5_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_5_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_5_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "video"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_date, terms.slug, LEFT(posts.post_content,420) as post_content, posts.post_excerpt,attachments.guid, users.display_name as author, "North American White Tail" as brand,
(SELECT count(comment_ID) from wp_6_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count  
FROM wp_6_posts as posts
JOIN wp_6_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_6_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_6_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_6_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_6_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "video"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_date, terms.slug, LEFT(posts.post_content,420) as post_content, posts.post_excerpt,attachments.guid, users.display_name as author, "Petersen's Hunting" as brand,
(SELECT count(comment_ID) from wp_7_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count  
FROM wp_7_posts as posts
JOIN wp_7_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_7_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_7_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_7_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_7_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "video"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_date, terms.slug, LEFT(posts.post_content,420) as post_content, posts.post_excerpt,attachments.guid, users.display_name as author, "Wildfowl" as brand,
(SELECT count(comment_ID) from wp_8_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count  
FROM wp_8_posts as posts
JOIN wp_8_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_8_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_8_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_8_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_8_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "video"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_date, terms.slug, LEFT(posts.post_content,420) as post_content, posts.post_excerpt,attachments.guid, users.display_name as author, "Handguns" as brand,
(SELECT count(comment_ID) from wp_9_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count  
FROM wp_9_posts as posts
JOIN wp_9_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_9_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_9_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_9_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_9_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "video"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_date, terms.slug, LEFT(posts.post_content,420) as post_content, posts.post_excerpt,attachments.guid, users.display_name as author, "Rifleshooter" as brand,
(SELECT count(comment_ID) from wp_10_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count  
FROM wp_10_posts as posts
JOIN wp_10_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_10_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_10_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_10_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_10_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "video"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_date, terms.slug, LEFT(posts.post_content,420) as post_content, posts.post_excerpt,attachments.guid, users.display_name as author, "Shooting Times" as brand,
(SELECT count(comment_ID) from wp_11_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count  
FROM wp_11_posts as posts
JOIN wp_11_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_11_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_11_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_11_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_11_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "video"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_date, terms.slug, LEFT(posts.post_content,420) as post_content, posts.post_excerpt,attachments.guid, users.display_name as author, "Shotgun News" as brand,
(SELECT count(comment_ID) from wp_12_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count  
FROM wp_12_posts as posts
JOIN wp_12_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_12_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_12_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_12_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_12_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "video"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_date, terms.slug, LEFT(posts.post_content,420) as post_content, posts.post_excerpt,attachments.guid, users.display_name as author, "Florida Sportsman" as brand,
(SELECT count(comment_ID) from wp_13_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count  
FROM wp_13_posts as posts
JOIN wp_13_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_13_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_13_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_13_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_13_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "video"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_date, terms.slug, LEFT(posts.post_content,420) as post_content, posts.post_excerpt,attachments.guid, users.display_name as author, "Game & Fish" as brand,
(SELECT count(comment_ID) from wp_14_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count  
FROM wp_14_posts as posts
JOIN wp_14_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_14_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_14_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_14_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_14_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "video"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_date, terms.slug, LEFT(posts.post_content,420) as post_content, posts.post_excerpt,attachments.guid, users.display_name as author, "In-Fisherman" as brand,
(SELECT count(comment_ID) from wp_15_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count  
FROM wp_15_posts as posts
JOIN wp_15_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_15_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_15_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_15_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_15_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "video"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT posts.ID, posts.post_title, posts.post_date, terms.slug, LEFT(posts.post_content,420) as post_content, posts.post_excerpt,attachments.guid, users.display_name as author, "Flyfisherman" as brand,
(SELECT count(comment_ID) from wp_16_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count  
FROM wp_16_posts as posts
JOIN wp_16_term_relationships as relationships ON (posts.ID = relationships.object_id)
JOIN `wp_16_term_taxonomy`as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.`term_taxonomy_id`)
JOIN wp_16_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_16_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_16_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
AND posts.post_status = "publish"
AND terms.slug = "video"
AND meta.meta_key = "_thumbnail_id")
ORDER BY post_date DESC LIMIT 100
EOT;

        $stmt = $db->prepare($sql);
        $stmt->execute();

        $posts = $stmt->fetchAll(PDO::FETCH_OBJ);

        foreach ($posts as $key => $post) {
            $postContent = strip_tags($post->post_content);
            $postContent = substr($postContent,0,120);
            $posts[$key]->post_content = $postContent;
        }


        echo json_encode($posts);

        $db = "";

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
$app->run();
