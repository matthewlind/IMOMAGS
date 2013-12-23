<?php

function runBigAssQuery($network,$term,$taxonomy,$sort,$count,$skip,$thumbnail_size) {



    if ($network == "shooting") {
        $siteIDs["www.gunsandammo.com"] = 2;
        $siteIDs["www.handgunsmag.com"] = 9;
        $siteIDs["www.shootingtimes.com"] = 11;
        $siteIDs["www.rifleshootermag.com"] = 10;
        $siteIDs["www.shotgunnews.com"] = 12;

        $brand["www.gunsandammo.com"] = "Guns & Ammo";
        $brand["www.handgunsmag.com"] = "Handguns";
        $brand["www.shootingtimes.com"] = "Shooting Times";
        $brand["www.rifleshootermag.com"] = "RifleShooter";
        $brand["www.shotgunnews.com"] = "Shotgun News";
    }

    if ($network == "hunting") {

        $siteIDs["www.bowhunter.com"] = 3;
        $siteIDs["www.bowhuntingmag.com"] = 4;
        $siteIDs["www.gundogmag.com"] = 5;
        $siteIDs["www.northamericanwhitetail.com"] = 6;
        $siteIDs["www.petersenshunting.com"] = 7;
        $siteIDs["www.wildfowlmag.com"] = 8;
        $siteIDs["www.gameandfishmag.com"] = 14;

        $brand["www.bowhunter.com"] = "Bowhunter";
        $brand["www.bowhuntingmag.com"] = "Petersen's Bowhunting";
        $brand["www.gundogmag.com"] = "Gundog";
        $brand["www.northamericanwhitetail.com"] = "North American Whitetail";
        $brand["www.petersenshunting.com"] = "Petersens Hunting";
        $brand["www.wildfowlmag.com"] = "Wildfowl";
        $brand["www.gameandfishmag.com"] = "Game & Fish";
    }

    if ($network == "fishing") {

        $siteIDs["www.floridasportsman.com"] = 13;
        $siteIDs["www.gameandfishmag.com"] = 14;
        $siteIDs["www.in-fisherman.com"] = 15;
        $siteIDs["www.flyfisherman.com"] = 16;

        $brand["www.floridasportsman.com"] = "Florida Sportsman";
        $brand["www.gameandfishmag.com"] = "Game & Fish";
        $brand["www.in-fisherman.com"] = "In-Fisherman";
        $brand["www.flyfisherman.com"] = "Fly Fisherman";
    }

    if ($network == "everything") {
        $siteIDs["www.gunsandammo.com"] = 2;
        $siteIDs["www.handgunsmag.com"] = 9;
        $siteIDs["www.shootingtimes.com"] = 11;
        $siteIDs["www.rifleshootermag.com"] = 10;
        $siteIDs["www.shotgunnews.com"] = 12;

        $brand["www.gunsandammo.com"] = "Guns & Ammo";
        $brand["www.handgunsmag.com"] = "Handguns";
        $brand["www.shootingtimes.com"] = "Shooting Times";
        $brand["www.rifleshootermag.com"] = "RifleShooter";
        $brand["www.shotgunnews.com"] = "Shotgun News";

        $siteIDs["www.bowhunter.com"] = 3;
        $siteIDs["www.bowhuntingmag.com"] = 4;
        $siteIDs["www.gundogmag.com"] = 5;
        $siteIDs["www.northamericanwhitetail.com"] = 6;
        $siteIDs["www.petersenshunting.com"] = 7;
        $siteIDs["www.wildfowlmag.com"] = 8;
        $siteIDs["www.gameandfishmag.com"] = 14;

        $brand["www.bowhunter.com"] = "Bowhunter";
        $brand["www.bowhuntingmag.com"] = "Petersen's Bowhunting";
        $brand["www.gundogmag.com"] = "Gundog";
        $brand["www.northamericanwhitetail.com"] = "North American Whitetail";
        $brand["www.petersenshunting.com"] = "Petersens Hunting";
        $brand["www.wildfowlmag.com"] = "Wildfowl";
        $brand["www.gameandfishmag.com"] = "Game & Fish";

        $siteIDs["www.floridasportsman.com"] = 13;
        $siteIDs["www.in-fisherman.com"] = 15;
        $siteIDs["www.flyfisherman.com"] = 16;

        $brand["www.floridasportsman.com"] = "Florida Sportsman";
        $brand["www.in-fisherman.com"] = "In-Fisherman";
        $brand["www.flyfisherman.com"] = "Fly Fisherman";

    }




    $termList = getAllChildTerms($term);
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


    if (!empty($term))
        $termQuery = "AND terms.slug IN ($inQmarks)";
    else
        $termQuery = "";





    try {

        $db = dbConnect();

        $sql = "";
        $siteCount = 0;


        foreach ($siteIDs as $domain => $siteID) {


            $siteCount++;

            $siteBrand = $brand[$domain];

            $sql .= <<<EOT
(SELECT DISTINCT posts.ID, posts.post_title, posts.post_name, posts.post_date, terms.slug as slug, null as slug2, posts.post_content as post_content, posts.post_excerpt,attachments.guid as img_url, users.display_name as author, "$siteBrand" as brand,attachmentmeta.meta_value as attachment_meta,
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
JOIN wp_{$siteID}_postmeta as attachmentmeta ON (attachments.ID = attachmentmeta.post_id)
AND posts.post_status = "publish"
AND postmeta.meta_key = '_thumbnail_id'
AND attachmentmeta.meta_key = '_wp_attachment_metadata'
$termQuery
AND term_taxonomy.taxonomy = "$taxonomy"
AND meta.meta_key = "_thumbnail_id")
EOT;

            if ($siteCount < count($siteIDs)) {
                $sql .= " UNION ";
            } else {
                $sql .= " ORDER BY $sort DESC LIMIT $skip,$count";
            }

        }//End foreach()



        //echo $sql;

        $stmt = $db->prepare($sql);

        // print_r($termList);
        // echo $sql;

        // $siteCount = 5;

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

            $postContent = preg_replace ("/^\[.+]/", "", $postContent);

            $postContent = delete_all_between("[","]",$postContent);

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


            if ($thumbnail_size) {
                $thumbnail = "http://" . $post->domain . getThumbnail(unserialize($post->attachment_meta),$thumbnail_size);
            }

            $post->attachment_meta = "";


            $posts[$key]->img_url = $thumbnail;

            $posts[$key]->terms = getPostTerms($post->ID,$siteIDs[$post->domain]);

        }

        $json = json_encode($posts);
        //echo $json;

        $db = "";

        if (!empty($posts)) {




            if ($json) {


                return $json;

            } else {

            }

        } else {
            return "FAILURE - NO POSTS FROM QUERY: $term WITH SORT: $sort \n";
        }




    } catch(PDOException $e) {
        echo $e->getMessage();
    }



}


function getThumbnail($dataArray,$thumbnailSize) {

    $filepath = $dataArray['file'];

    $filepathParts = explode("/",$filepath);



    $filename = $dataArray['sizes'][$thumbnailSize]['file'];

    $fullPath = "/files/" . $filepathParts[0] . "/" . $filepathParts[1] . "/" . $filename;

    if (empty($filename)) {
        $fullPath = "/files/" . $filepath;
    }



    return $fullPath;
}

