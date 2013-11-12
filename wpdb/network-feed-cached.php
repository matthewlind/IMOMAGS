<?php

//All of these parameters can be overridden in the query string
$network = "shooting"; //e.g. "hunting","fishing","everything"
$taxonomy = 'category'; //Which taxonomy to select
$term = "ammo"; //e.g. "shotguns","poltics"
$count = 10; //Number of posts to return
$skip = 0; //Number of posts to skip (for paging)
$sort = "post_date"; //Sort posts by
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

if (preg_match("/^[0-9a-z-]{1,42}$/", $term)) {//Terms are allowed to have letters, numbers and dashes. Everything else is trash.
} else {
    echo "bad term";
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

$count = intval($count); //Make sure that the numbers are actually numbers.
$skip = intval($skip);


//*********************************************************************************
//****** CHECK TO SEE IF FILES SHOULD BE RETURNED OR GENERATED ********************
//*********************************************************************************
$fileIsStale = false;

$fileName = "/data/wordpress/imomags/wp-content/cache/network-feeds/$network-$term-$taxonomy-$sort-$count-$skip{$thumbnail_size}.json";
$tempFileName = "/data/wordpress/imomags/wp-content/cache/temp-feeds/$network-$term-$taxonomy-$sort-$count-$skip{$thumbnail_size}.json";


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
        writeFileAndReturnData($fileName,$tempFileName,$network,$term,$taxonomy,$sort,$count,$skip,$thumbnail_size);


    } else {
        //echo "FILE EXISTS: ";
        echo $fileData;
    }

    exit;



} else {//If there is no cache, we need to generate the feed

    //check for temp file
    if (!file_exists($tempFileName)) {

        //echo "NEW FILE: ";
        echo writeFileAndReturnData($fileName,$tempFileName,$network,$term,$taxonomy,$sort,$count,$skip,$thumbnail_size);

        exit;

    }


}


//*********************************************************************************
//*********************************************************************************
//*********************************************************************************

function writeFileAndReturnData($fileName,$tempFileName,$network,$term,$taxonomy,$sort,$count,$skip,$thumbnail_size) {

        $fileHandle = fopen($tempFileName,"w+");
        $data = runBigAssQuery($network,$term,$taxonomy,$sort,$count,$skip,$thumbnail_size);
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