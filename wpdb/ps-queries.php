<?php


include_once 'mysql.php';

function get_set_data($siteID,$setID) {

    try {

        $db = dbConnect();


        $query = "SELECT option_value FROM wp_{$siteID}_options WHERE option_name = ?";

        $stmt = $db->prepare($query);

        $stmt->execute(array("featured_set_{$setID}"));

        $serializedData = $stmt->fetchColumn(0);



        $setData = unserialize($serializedData);


        $postIDs = $setData["post_id_string"];
        $setName = stripslashes($setData["name"]);

        $setData["name"] = stripslashes($setData["name"]);

        $query = "SELECT
            posts.ID as id,
            posts.post_title as title,
            posts.post_title as label,
            posts.post_title as value,
            posts.post_title as post_title,
            posts.post_type as type,
            posts.post_content as post_content,
            attachmentmeta.meta_value as attachment_meta,
            posts.guid as url,
            posts.guid as post_url,
            postmeta2.meta_value as promo_title
            FROM wp_{$siteID}_posts posts
            JOIN wp_{$siteID}_postmeta as postmeta ON (posts.ID = postmeta.post_id)
            JOIN wp_{$siteID}_posts as attachments ON (attachments.ID = postmeta.meta_value)
            JOIN wp_{$siteID}_postmeta as attachmentmeta ON (attachments.ID = attachmentmeta.post_id)
            LEFT JOIN wp_{$siteID}_postmeta as postmeta2 ON (posts.ID = postmeta2.post_id AND postmeta2.meta_key = 'promo_title')
            WHERE posts.ID IN ($postIDs)
            AND posts.post_status = 'publish'
            AND postmeta.meta_key = '_thumbnail_id'
            AND attachmentmeta.meta_key = '_wp_attachment_metadata'
            ORDER BY FIELD (posts.ID,$postIDs)";


        $stmt = $db->prepare($query);

        $stmt->execute();

        $posts = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = "";

        foreach ($posts as $key => $post) {

            $thumb = getPSThumbnail(unserialize($post->attachment_meta));

            $posts[$key]->thumb = $thumb;
            $posts[$key]->attachment_meta = unserialize($posts[$key]->attachment_meta);

            if (!empty($post->promo_title)) {
                $posts[$key]->orig_title = $post->title;
                $posts[$key]->title = $post->promo_title;
                $posts[$key]->label = $post->promo_title;

            }


            $timestamp =  strtotime($post->post_date);
            $niceDate = date("F j, Y",$timestamp);
            $posts[$key]->post_nicedate = $niceDate;



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
            //$postContent = delete_all_between("[","]",$postContent);

            $postContent = substr($postContent,0,120) . "...";
            $posts[$key]->post_content = $postContent;

            $posts[$key]->source = "post_set";
        }

        $setData['posts'] = $posts;
        //unset($setData["post_id_string"]);

        return $setData;

    } catch(PDOException $e) {
        echo $e->getMessage();
    }


}


function getPSThumbnail($dataArray) {

    $filepath = $dataArray['file'];

    $filepathParts = explode("/",$filepath);



    $filename = $dataArray['sizes']['thumbnail']['file'];

    $fullPath = "/files/" . $filepathParts[0] . "/" . $filepathParts[1] . "/" . $filename;

    if (empty($filename)) {
        $fullPath = "/files/" . $filepath;
    }



    return $fullPath;
}


