<?php


function getPosts($network,$term,$taxonomy,$sort,$count,$skip,$thumbnail_size,$state,$post_set_merge,$get_count,$post_type) {

    $posts = runBigAssQuery($network,$term,$taxonomy,$sort,$count,$skip,$thumbnail_size,$state,$get_count,$post_type);

    $json = "";

    if (!empty($post_set_merge)) {


        include_once "ps-queries.php";

        $mergeVars = explode("-", $post_set_merge);
        $ps_site_id = $mergeVars[0];
        $post_set_id = $mergeVars[1];

        $ps_post_data = get_set_data($ps_site_id,$post_set_id);
        $ps_posts = $ps_post_data['posts'];


        if (!$get_count) {

            $posts = array_merge($posts,$ps_posts);

            shuffle($posts);

        } else {

            $posts[0]->count += count($ps_posts);
        }


    }

    $json = json_encode($posts);

    return $json;
}


function runBigAssQuery($network,$term,$taxonomy,$sort,$count,$skip,$thumbnail_size,$state,$get_count,$post_type) {

    $brand["www.gunsandammo.com"] = "Guns & Ammo";
    $brand["www.handgunsmag.com"] = "Handguns";
    $brand["www.shootingtimes.com"] = "Shooting Times";
    $brand["www.rifleshootermag.com"] = "RifleShooter";
    $brand["www.shotgunnews.com"] = "Shotgun News";
    $brand["www.bowhunter.com"] = "Bowhunter";
    $brand["www.bowhuntingmag.com"] = "Petersen's Bowhunting";
    $brand["www.gundogmag.com"] = "Gundog";
    $brand["www.northamericanwhitetail.com"] = "North American Whitetail";
    $brand["www.petersenshunting.com"] = "Petersens Hunting";
    $brand["www.wildfowlmag.com"] = "Wildfowl";
    $brand["www.gameandfishmag.com"] = "Game & Fish";
    $brand["www.floridasportsman.com"] = "Florida Sportsman";
    $brand["www.in-fisherman.com"] = "In-Fisherman";
    $brand["www.flyfisherman.com"] = "Fly Fisherman";

    if ($network == "shooting") {
        $siteIDs["www.gunsandammo.com"] = 2;
        $siteIDs["www.handgunsmag.com"] = 9;
        $siteIDs["www.shootingtimes.com"] = 11;
        $siteIDs["www.rifleshootermag.com"] = 10;
        $siteIDs["www.shotgunnews.com"] = 12;
    }

    if ($network == "hunting") {

        $siteIDs["www.bowhunter.com"] = 3;
        $siteIDs["www.bowhuntingmag.com"] = 4;
        $siteIDs["www.gundogmag.com"] = 5;
        $siteIDs["www.northamericanwhitetail.com"] = 6;
        $siteIDs["www.petersenshunting.com"] = 7;
        $siteIDs["www.wildfowlmag.com"] = 8;
        $siteIDs["www.gameandfishmag.com"] = 14;
    }

    if ($network == "fishing") {

        $siteIDs["www.floridasportsman.com"] = 13;
        $siteIDs["www.gameandfishmag.com"] = 14;
        $siteIDs["www.in-fisherman.com"] = 15;
        $siteIDs["www.flyfisherman.com"] = 16;


    }

    if ($network == "everything") {
        $siteIDs["www.gunsandammo.com"] = 2;
        $siteIDs["www.handgunsmag.com"] = 9;
        $siteIDs["www.shootingtimes.com"] = 11;
        $siteIDs["www.rifleshootermag.com"] = 10;
        $siteIDs["www.shotgunnews.com"] = 12;
        $siteIDs["www.bowhunter.com"] = 3;
        $siteIDs["www.bowhuntingmag.com"] = 4;
        $siteIDs["www.gundogmag.com"] = 5;
        $siteIDs["www.northamericanwhitetail.com"] = 6;
        $siteIDs["www.petersenshunting.com"] = 7;
        $siteIDs["www.wildfowlmag.com"] = 8;
        $siteIDs["www.gameandfishmag.com"] = 14;
        $siteIDs["www.floridasportsman.com"] = 13;
        $siteIDs["www.in-fisherman.com"] = 15;
        $siteIDs["www.flyfisherman.com"] = 16;

    }

    //If network contains .com, only search a single site.
    if (strstr($network, ".com")) {

        $siteIDlist["www.gunsandammo.com"] = 2;
        $siteIDlist["www.handgunsmag.com"] = 9;
        $siteIDlist["www.shootingtimes.com"] = 11;
        $siteIDlist["www.rifleshootermag.com"] = 10;
        $siteIDlist["www.shotgunnews.com"] = 12;
        $siteIDlist["www.bowhunter.com"] = 3;
        $siteIDlist["www.bowhuntingmag.com"] = 4;
        $siteIDlist["www.gundogmag.com"] = 5;
        $siteIDlist["www.northamericanwhitetail.com"] = 6;
        $siteIDlist["www.petersenshunting.com"] = 7;
        $siteIDlist["www.wildfowlmag.com"] = 8;
        $siteIDlist["www.gameandfishmag.com"] = 14;
        $siteIDlist["www.floridasportsman.com"] = 13;
        $siteIDlist["www.in-fisherman.com"] = 15;
        $siteIDlist["www.flyfisherman.com"] = 16;

        $siteIDs[$network] = $siteIDlist[$network];

    }








    try {

        $db = dbConnect();

        $sql = "";
        $siteCount = 0;
        $executeArray = array();


        foreach ($siteIDs as $domain => $siteID) {

            if ($term == "all")
                $term = "";



            $termList = getAllChildTerms2($term,$siteID);
            $termList[] = $term;

            $termString = "";
            $inQuery = "";
            $inQmarks = "";

            $termCount = 0;
            foreach ($termList as $term) {

                $termString .= "'$term'";
                $inQuery .= ":term" . $termCount;
                $inQmarks .= "?";
                $termCount++;
                if ($termCount != count($termList)) {
                    $termString .= ",";
                    $inQuery .= ",";
                    $inQmarks .= ",";
                }

            }


            $termSelect = "terms.slug as slug,";

            //If there is a term, search for it.
            if (!empty($term)) {
                $termQuery = "AND terms.slug IN ($inQmarks)";
            }
            else {
                $termQuery = "";
                $termSelect = "";

            }


            //If there is a state, search for it and show it.
            if (!empty($state)) {
                $stateQuery = "AND terms2.slug IN ('$state')";
                $stateSelect = "terms2.slug as state,";

            }
            else {
                $stateQuery = "";
                $stateSelect = "";
            }

            $siteCount++;

            $siteBrand = $brand[$domain];

            $sql .= <<<EOT
(SELECT DISTINCT posts.ID, camera_corner_taken.meta_value as camera_corner_taken,camera_corner_when.meta_value as camera_corner_when,camera_corner_who.meta_value as camera_corner_who, posts.post_title, posts.post_name, posts.post_date, $termSelect $stateSelect posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url,users.user_nicename as user_nicename, users.display_name as author,users.`ID` as user_id, "$siteBrand" as brand,attachmentmeta.meta_value as attachment_meta,
(SELECT count(comment_ID) from wp_{$siteID}_comments as comments WHERE comment_post_id = posts.ID AND comments.comment_approved = 1) as comment_count, "$domain" as domain
FROM wp_{$siteID}_term_relationships as relationships
JOIN wp_{$siteID}_term_relationships as relationships2 ON (relationships.`object_id` = relationships2.`object_id`)
JOIN wp_{$siteID}_term_taxonomy as term_taxonomy2 ON (relationships2.term_taxonomy_id = term_taxonomy2.term_taxonomy_id)
JOIN wp_{$siteID}_terms as terms2 ON (term_taxonomy2.term_id = terms2.term_id)
JOIN wp_{$siteID}_posts as posts ON (posts.ID = relationships.object_id)
JOIN wp_{$siteID}_term_taxonomy as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.term_taxonomy_id)
JOIN wp_{$siteID}_terms as terms ON (term_taxonomy.term_id = terms.term_id)
JOIN wp_{$siteID}_posts as attachments ON (attachments.post_parent = posts.ID)
JOIN wp_{$siteID}_postmeta as meta ON (meta.meta_value = attachments.ID)
JOIN wp_users as users ON (users.`ID` = posts.post_author)
JOIN wp_{$siteID}_postmeta as postmeta ON (posts.ID = postmeta.post_id)

JOIN wp_{$siteID}_postmeta as camera_corner_taken ON (posts.ID = camera_corner_taken.post_id)
JOIN wp_{$siteID}_postmeta as camera_corner_when ON (posts.ID = camera_corner_when.post_id)
JOIN wp_{$siteID}_postmeta as camera_corner_who ON (posts.ID = camera_corner_who.post_id)

JOIN wp_{$siteID}_postmeta as attachmentmeta ON (attachments.ID = attachmentmeta.post_id)
AND posts.post_status = "publish"
AND postmeta.meta_key = '_thumbnail_id'
AND attachmentmeta.meta_key = '_wp_attachment_metadata'

AND camera_corner_taken.meta_key = 'camera_corner_taken'
AND camera_corner_when.meta_key = 'camera_corner_when'
AND camera_corner_who.meta_key = 'camera_corner_who'

AND posts.post_type = '$post_type'
$termQuery
$stateQuery
AND term_taxonomy.taxonomy = "$taxonomy"
AND meta.meta_key = "_thumbnail_id")
EOT;

            if ($siteCount < count($siteIDs)) {
                $sql .= " UNION ";
            } else {

                if (!$get_count) {
                    $sql .= " ORDER BY $sort DESC LIMIT $skip,$count";
                }

            }

            $executeArray = array_merge($executeArray,$termList);

        }//End foreach()


        if ($get_count) {
            $sql = "select count(*) as count from (" . $sql . " ) x";
        }

        $stmt = $db->prepare($sql);


         // print_r($termList);
         // echo $sql;

        // $siteCount = 5;





        foreach ($termList as $key => $term) {
            //$stmt->bindParam(":term" . $key, $term, PDO::PARAM_STR);
            // echo ":term" . $key . "--" . $term;
        }

        //print_r($stmt);
        $stmt->execute($executeArray);

        //print_r($executeArray);

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
            $postContent = preg_replace ("/^\[.+]/", "", $postContent);
            $postContent = delete_all_between("[","]",$postContent);

            $postContent = substr($postContent,0,120) . "...";


            if (!$get_count) {

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


                if ($thumbnail_size) {
                    $thumbnail = "http://" . $post->domain . getPostThumbnail2(unserialize($post->attachment_meta),$thumbnail_size);
                }

                $post->attachment_meta = "";


                $posts[$key]->img_url = $thumbnail;

                $posts[$key]->terms = getPostTerms($post->ID,$siteIDs[$post->domain]);

            }

			#fix to always get 150x150 thumb
			$thumb = str_replace("-640x640.jpg", "-150x150.jpg", $post->img_url);
			$posts[$key]->thumb = $thumb;

        }

        $db = "";

        if (!empty($posts)) {
            return $posts;
		} else {
        		return "FAILURE - NO POSTS FROM QUERY: $term WITH SORT: $sort \n";
        }

    } catch(PDOException $e) {
        echo $e->getMessage();
    }

}





function getPostThumbnail2($dataArray,$thumbnailSize) {

    $filepath = $dataArray['file'];

    $filepathParts = explode("/",$filepath);



    $filename = $dataArray['sizes'][$thumbnailSize]['file'];

    $fullPath = "/files/" . $filepathParts[0] . "/" . $filepathParts[1] . "/" . $filename;

    if (empty($filename)) {
        $fullPath = "/files/" . $filepath;
    }



    return $fullPath;
}

