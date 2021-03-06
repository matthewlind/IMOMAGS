<?php
header('Content-type: application/json');

include 'mysql.php';

$siteID["www.gunsandammo.com"] = 2;
$siteID["www.handgunsmag.com"] = 9;
$siteID["www.shootingtimes.com"] = 11;
$siteID["www.rifleshootermag.com"] = 10;
$siteID["www.shotgunnews.com"] = 12;
$siteID["www.bowhunter.com"] = 3;
$siteID["www.bowhuntingmag.com"] = 4;
$siteID["www.gundogmag.com"] = 5;
$siteID["www.northamericanwhitetail.com"] = 6;
$siteID["www.petersenshunting.com"] = 7;
$siteID["www.wildfowlmag.com"] = 8;
$siteID["www.gameandfishmag.com"] = 14;
$siteID["www.floridasportsman.com"] = 13;
$siteID["www.in-fisherman.com"] = 15;
$siteID["www.flyfisherman.com"] = 16;


$domain = $_SERVER['HTTP_HOST'];

$domain = str_replace(".deva", ".com", $domain);
$domain = str_replace(".fox", ".com", $domain);
$domain = str_replace(".salah", ".com", $domain);
$domain = str_replace(".devb", ".com", $domain);
$domain = str_replace(".devc", ".com", $domain);


$currentSiteID = $siteID[$domain];

$query = "";


$count = intval($_REQUEST['count']);
$skip = intval($_REQUEST['skip']);

$searchParameter = $_GET['setID'];

try {

    $db = dbConnect();

    $setResults = array();


    $query = "SELECT option_value,option_name FROM wp_{$currentSiteID}_options WHERE option_name LIKE ?";

    $stmt = $db->prepare($query);

    $stmt->execute(array("featured_set_%"));

    $sets = $stmt->fetchAll(PDO::FETCH_OBJ);



    foreach ($sets as $index => $set) {

        $setData = unserialize($set->option_value);


        $postIDs = $setData["post_id_string"];
        $setName = stripslashes($setData["name"]);



        $query = "SELECT
            posts.ID as id,
            posts.post_title as title,
            posts.post_title as label,
            posts.post_title as value,
            posts.post_type as type,
            attachmentmeta.meta_value as attachment_meta,
            posts.guid as url,
            postmeta2.meta_value as promo_title
            FROM wp_{$currentSiteID}_posts posts
            JOIN wp_{$currentSiteID}_postmeta as postmeta ON (posts.ID = postmeta.post_id)
            JOIN wp_{$currentSiteID}_posts as attachments ON (attachments.ID = postmeta.meta_value)
            JOIN wp_{$currentSiteID}_postmeta as attachmentmeta ON (attachments.ID = attachmentmeta.post_id)
            LEFT JOIN wp_{$currentSiteID}_postmeta as postmeta2 ON (posts.ID = postmeta2.post_id AND postmeta2.meta_key = 'promo_title')
            WHERE posts.ID IN ($postIDs)
            AND posts.post_status = 'publish'
            AND postmeta.meta_key = '_thumbnail_id'
            AND attachmentmeta.meta_key = '_wp_attachment_metadata'
            ORDER BY FIELD (posts.ID,$postIDs)";


        $stmt = $db->prepare($query);

        $stmt->execute();

        $posts = $stmt->fetchAll(PDO::FETCH_OBJ);



        foreach ($posts as $key => $post) {

            $thumb = getThumbnail(unserialize($post->attachment_meta));

            $posts[$key]->thumb = $thumb;
            $posts[$key]->attachment_meta = unserialize($posts[$key]->attachment_meta);

            if (!empty($post->promo_title)) {
                $posts[$key]->title = $post->promo_title;
                $posts[$key]->label = $post->promo_title;
            }
        }

        $postset['posts'] = $posts;
        $postset['name'] = $setName;

        $setResults[substr($set->option_name,13)] = $postset;

    }




    $db = "";

    echo json_encode($setResults);

} catch(PDOException $e) {
    echo $e->getMessage();
}


function getThumbnail($dataArray) {

    $filepath = $dataArray['file'];

    $filepathParts = explode("/",$filepath);



    $filename = $dataArray['sizes']['thumbnail']['file'];

    $fullPath = "/files/" . $filepathParts[0] . "/" . $filepathParts[1] . "/" . $filename;

    if (empty($filename)) {
        $fullPath = "/files/" . $filepath;
    }



    return $fullPath;
}


