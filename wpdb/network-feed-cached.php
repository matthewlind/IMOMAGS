<?php

//All of these parameters can be overridden in the query string
$network = "shooting"; //e.g. "hunting","fishing","everything"
$taxonomy = 'category'; //Which taxonomy to select
$post_type = 'post'; //Which taxonomy to select
$term = ""; //e.g. "shotguns","poltics"
$domain = ""; //***NEW FEATURE*** You can now just specify a domain to search a single site instead of an entire network. e.g. "www.gunsandammo.com"
$count = 10; //Number of posts to return
$skip = 0; //Number of posts to skip (for paging)
$sort = "post_date"; //Sort posts by
$state = "all"; //Slug for US state. Returned results will have both the State and the term
$post_set_merge = "0-0"; //Use this code to merge in results of a FPS with the query results. First Digit of the code is the site ID, the second digit is the FPS ID. e.g. "14-3"
$get_count;


$thumbnail_size = null; //Specify a Wordpress thumbnail size. e.g. "thumbnail". Leave blank for legacy behavior.

//This controls how long a file should be cached
//Set to -1 to force a refresh. (This could potentially be used to refresh the data after editors submit new posts.)
$fileExpirationTime = 1800; //in seconds (1800 = 30 minutes)





include 'mysql.php';
include 'cli-helper-functions.php';
include 'csf_queries.php';
header('Access-Control-Allow-Origin: *'); //Allow requests from different domains
date_default_timezone_set('America/New_York');

//*********************************************************************************
//******************************* SANITIZE INPUTS *********************************
//*********************************************************************************
extract($_REQUEST);

if (!empty($domain))
    $network = $domain;


if (strlen($state) == 2) {

    $states = array('al' => 'alabama','ak' => 'alaska','az' => 'arizona','ar' => 'arkansas','ca' => 'california','co' => 'colorado','ct' => 'connecticut','de' => 'delaware','dc' => 'district-of-columbia','fl' => 'florida','ga' => 'georgia', 'hi' => 'hawaii','id' => 'idaho','il' => 'illinois','in' => 'indiana','ia' => 'iowa','ks' => 'kansas','ky' => 'kentucky','la' => 'louisiana','me' => 'maine','md' => 'maryland','ma' => 'massachusetts','mi' => 'michigan','mn' => 'minnesota','ms' => 'mississippi','mo' => 'missouri','mt' => 'montana','ne' => 'nebraska','nv' => 'nevada','nh' => 'new-hampshire','nj' => 'new-jersey','nm' => 'new-mexico','ny' => 'new-york','nc' => 'north-carolina','nd' => 'north-dakota','oh' => 'ohio','ok' => 'oklahoma','or' => 'oregon','pa' => 'pennsylvania','pr' => 'puerto-rico','ri' => 'rhode-island','sc' => 'south-carolina','sd' => 'south-dakota','tn' => 'tennessee','tx' => 'texas','ut' => 'utah','vt' => 'vermont', 'va' => 'virginia','wa' => 'washington','wv' => 'west-virginia','wi' => 'wisconsin','wy' => 'wyoming ');

    $state = strtolower($state);

    $state = $states[$state];
}

//If there is no term, but there is a state, Make the state the search term.
if (empty($term) && !empty($state)) {
    $term = $state;
    $state = "all";
}


if (preg_match("/^[0-9a-z-]{1,42}$/", $term)) {//Terms are allowed to have letters, numbers and dashes. Everything else is trash.
    if ($term == "*") {
        unset($term);
    }
} else {
    echo "bad term";
    header('HTTP 1.1/400 Bad Request', true, 400);
    exit();
}


if (preg_match("/^[0-9a-z-_]{1,42}$/", $post_type)) {//Post types are allowed to have letters, numbers, underscores and dashes. Everything else is trash.

} else {
    echo "bad post type";
    header('HTTP 1.1/400 Bad Request', true, 400);
    exit();
}

if (preg_match("/^[0-9a-z-]{1,42}$/", $state)) {//Terms are allowed to have letters, numbers and dashes. Everything else is trash.
    if ($state == "all") {
        unset($state);
    }
} else {
    echo "bad state";
    header('HTTP 1.1/400 Bad Request', true, 400);
    exit();
}

if (preg_match("/^[a-z-]{1,42}$/", $taxonomy)) {//Taxonomies are allowed to have letters and dashes. Everything else is trash.
} else {
    echo "bad taxonomy";
    header('HTTP 1.1/400 Bad Request', true, 400);
    exit();
}

if (preg_match("/^[a-z-_]{1,42}$/", $sort)) {//Sorts can have letters, dashes, and underscores.
} else {
    echo "bad sort";
    header('HTTP 1.1/400 Bad Request', true, 400);
    exit();
}

if (preg_match("/^[0-9-]{1,7}$/", $post_set_merge)) {//Post sets should be specified with the format: 12-5 (SITEID-POSTSETID)
    if ($post_set_merge == "0-0") {
        unset($post_set_merge);
    }
} else {
    echo "bad post_set_merge";
    header('HTTP 1.1/400 Bad Request', true, 400);
    exit();
}


$count = intval($count); //Make sure that the numbers are actually numbers.
$skip = intval($skip);


//*********************************************************************************
//****** CHECK TO SEE IF FILES SHOULD BE RETURNED OR GENERATED ********************
//*********************************************************************************
$fileIsStale = false;

$fileName = "/data/wordpress/imomags/wp-content/cache/network-feeds/$network-$term-$taxonomy-$sort-$count-$skip{$thumbnail_size}{$get_count}$state{$post_set_merge}{$post_type}.json";
$tempFileName = "/data/wordpress/imomags/wp-content/cache/temp-feeds/$network-$term-$taxonomy-$sort-$count-$skip{$thumbnail_size}{$get_count}$state{$post_set_merge}{$post_type}.json";


$fileExists = file_exists($fileName);

if ($fileExists)
    $fileTimestamp = filemtime($fileName);
else
    $fileTimestamp = 1643473790; //Year 2022 (not expired.)

$fileAge = time() - $fileTimestamp;

if ($fileAge > $fileExpirationTime) {
    $fileIsStale = true;
}

//echo $fileName;

if ($fileExists) {
    //return file
    $fileData = file_get_contents($fileName);

    if ($fileIsStale && !file_exists($tempFileName)) {

        sendDataAndStartBackgroundProcess($fileData);

        //File is written, but nothing is done with returned data because we already sent a cached copy
        writeFileAndReturnData($fileName,$tempFileName,$network,$term,$taxonomy,$sort,$count,$skip,$thumbnail_size,$state,$post_set_merge,$get_count,$post_type);


    } else {
        //echo "FILE EXISTS: ";
        echo $fileData;
    }

    exit;



} else {//If there is no cache, we need to generate the feed

    //check for temp file
    if (!file_exists($tempFileName)) {

        //echo "NEW FILE: ";
        echo writeFileAndReturnData($fileName,$tempFileName,$network,$term,$taxonomy,$sort,$count,$skip,$thumbnail_size,$state,$post_set_merge,$get_count,$post_type);

        exit;

    }


}


//*********************************************************************************
//*********************************************************************************
//*********************************************************************************

function writeFileAndReturnData($fileName,$tempFileName,$network,$term,$taxonomy,$sort,$count,$skip,$thumbnail_size,$state,$post_set_merge,$get_count,$post_type) {


        $fileHandle = fopen($tempFileName,"w+");
        $data = getPosts($network,$term,$taxonomy,$sort,$count,$skip,$thumbnail_size,$state,$post_set_merge,$get_count,$post_type);
        fwrite($fileHandle,$data);
        fclose($fileHandle);
        rename($tempFileName,$fileName);

        return $data;
}




function sendDataAndStartBackgroundProcess($data) {

// buffer all upcoming output
ob_start();
echo $data;

// get the size of the output
$size = ob_get_length();

// send headers to tell the browser to close the connection
header("Content-Length: $size");
header('Connection: close');

// flush all output
ob_end_flush();
ob_flush();
flush();

}