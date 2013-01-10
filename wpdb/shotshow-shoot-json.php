<?php 

include 'mysql.php';
include 'cli-helper-functions.php';
$sort = "post_date";

$arguments = getopt("s:t:");


if (empty($arguments)) {
	
	$arguments['s'] = $_REQUEST['s'];
	$arguments['t'] = $_REQUEST['t'];
	
}

if (!empty($arguments['s']))
	$sort = $arguments['s'];
	
$term = $arguments['t'];


header('Access-Control-Allow-Origin: *');  



date_default_timezone_set('America/New_York'); 

    $termList = getAllChildTerms($term);
    $termList[] = $term;

    $termString = "";
    $inQuery = "";
    $inQmarks = "";

    $count = 0;
    foreach ($termList as $term) {
    	
    	$termString .= "'$term'";
    	$inQuery .= ":term" . $count;
    	$inQmarks .= "?";
    	$count++;
    	if ($count != count($termList)) {
    		$termString .= ",";
    		$inQuery .= ",";
    		$inQmarks .= ",";
    	}
    		
    }
    
    $siteID["www.gunsandammo.com"] = 2;
    $siteID["www.handgunsmag.com"] = 9;
    $siteID["www.shootingtimes.com"] = 11;
    $siteID["www.rifleshootermag.com"] = 10;
    $siteID["www.shotgunnews.com"] = 12;

    if (!empty($term))
    	$termQuery = "AND terms2.slug IN ($inQmarks)";
    else
    	$termQuery = "";

    try {

        $db = dbConnect();


        $sql = <<<EOT
(SELECT DISTINCT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug as slug, null as slug2, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Guns & Ammo" as brand,
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
AND terms.slug = "shot-show-2013"
$termQuery
AND term_taxonomy2.taxonomy = "category"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT DISTINCT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug as slug, null as slug2, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Handguns" as brand,
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
AND terms.slug = "shot-show-2013"
$termQuery
AND term_taxonomy2.taxonomy = "category"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT DISTINCT posts.ID, posts.post_title, posts.post_name, posts.post_date, null as slug, null as slug2, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Shooting Times" as brand,
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
AND terms.slug = "shot-show-2013"
$termQuery
AND term_taxonomy2.taxonomy = "category"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT DISTINCT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug as slug, null as slug2, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "RifleShooter" as brand,
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
AND terms.slug = "shot-show-2013"
$termQuery
AND term_taxonomy2.taxonomy = "category"
AND meta.meta_key = "_thumbnail_id")
UNION
(SELECT DISTINCT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug as slug, null as slug2, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "Shotgun News" as brand,
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
AND terms.slug = "shot-show-2013"
$termQuery
AND term_taxonomy2.taxonomy = "category"
AND meta.meta_key = "_thumbnail_id")
ORDER BY $sort DESC LIMIT 200


EOT;

        $stmt = $db->prepare($sql);

        // print_r($termList);
        // echo $sql;

        $siteCount = 5;

        $executeArray = array();

        for ($i=1; $i <= $siteCount; $i++) { 
        	$executeArray = array_merge($executeArray,$termList);
        }


        foreach ($termList as $key => $term) {
        	//$stmt->bindParam(":term" . $key, $term, PDO::PARAM_STR);
        	// echo ":term" . $key . "--" . $term;
        }

        //print_r($stmt);
        $stmt->execute($executeArray);
    
        $posts = $stmt->fetchAll(PDO::FETCH_OBJ);

        foreach ($posts as $key => $post) {

        	//First Clean up the data
            $postContent = trim(strip_tags($post->post_content));
            $postContent = preg_replace('/\[[^\)]+\]/', "", $postContent);
            $postContent = str_replace("\n", "", $postContent);
            $postContent = str_replace("\r", "", $postContent);
            $postContent = str_replace("\xe2", "", $postContent);
            $postContent = str_replace("\x80", "", $postContent);
            $postContent = str_replace("\x9d", "", $postContent);
            $postContent = str_replace("\x99", "", $postContent);
            $postContent = str_replace("\x9c", "", $postContent);
            $postContent = str_replace("\x94", "", $postContent);
            $postContent = str_replace("\xa6", "", $postContent);
            $postContent = str_replace("\\", "", $postContent);
            $postContent = str_replace("\x93", "", $postContent);
            $postContent = str_replace("\xa8", "", $postContent);
            $postContent = str_replace("\\", "", $postContent);
            $postContent = str_replace("\\", "", $postContent);

            $postContent = substr($postContent,0,120) . "...";
            $posts[$key]->post_content = $postContent;

            $posts[$key]->post_excerpt = "";

            //Generate the URL
            $timestamp =  strtotime($post->post_date);
            $datePath = date("Y/m/d",$timestamp);
            $url = "http://" . $post->domain . "/" . $datePath . "/" . $post->post_name;

            $posts[$key]->post_url = $url;

            $niceDate = date("F j, Y",$timestamp);
            $posts[$key]->post_nicedate = $niceDate;

            $thumbnail = str_replace(".jpg", "-190x120.jpg", $post->img_url);
            $posts[$key]->img_url = $thumbnail;




            //Check to see if we need to add terms
            //if ($post->domain == "www.northamericanwhitetail.com") {
                $posts[$key]->terms = getPostTerms($post->ID,$siteID[$post->domain]);
            //}


            //TESTING
        
            // _log($post);
            // json_encode($post);

            // echo "<pre>";
            // print_r($post);
            // echo $termString;
            // echo "</pre>";
        
            //$json = json_encode($post);

        }

        $json = json_encode($posts);
        //echo $json;

        $db = "";
        
        if (!empty($posts)) {
	    
	    	//$filename = "/data/wordpress/imomags/wp-content/cache/superloop/naw-plus-$term-$sort.json";
	        //$f = fopen($filename, "w");
	        
	        
	        if ($json) {
	        
	        	
	        	echo $json;
	        
/*
		    	fwrite($f, $json);
		    	fclose($f); 
*/
		    	//echo "SUCCESS $filename \n";
	        } else {
		        //echo "FAILURE $filename \n";
	        }
	
	    } else {
	    	echo "FAILURE - NO POSTS FROM QUERY: $term WITH SORT: $sort \n";
	    }




    } catch(PDOException $e) {
        echo $e->getMessage();
    }
