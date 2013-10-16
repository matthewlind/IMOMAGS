<?php

$app->get('/master_anglers', function () {

  $requestJSON = Slim\Slim::getInstance()->request()->getBody();
  $params = json_decode($requestJSON,true);



  if (!$params) {
    //Grab the parameters
    $params = \Slim\Slim::getInstance()->request()->post();
  }

    if (!$params) {
    //Grab the parameters
    $params = \Slim\Slim::getInstance()->request()->get();
  }

  $userIsGood = userIsGood($params['username'],$params['userhash']);
  $userIsEditor = userIsEditor($params['username'],$params['timecode'],$params['editor_hash']);




  if ($userIsEditor && $userIsGood) {
    try {

      $db = dbConnect();


      $sql = "SELECT master_angler.id,first_name,last_name,email,street_address_1,street_address_2,city,state_address,state,zip,phone,date,body_of_water,nearest_town,meta as species,length,weight,lure_used,kind_of_lure,lure_desc,kind_of_bait,kept,post_type,secondary_post_type,title,body,img_url,user_id,username,created as date_submitted FROM master_angler JOIN superposts ON superposts.id = post_id WHERE master = 1;";



      $stmt = $db->prepare($sql);
      $stmt->execute(array());

      $posts = $stmt->fetchAll(PDO::FETCH_OBJ);

      echo json_encode($posts,JSON_NUMERIC_CHECK);

      $db = "";

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
  } else {
    echo "error: link expired";
  }



});

$app->get('/master_anglers/csv', function () {
  $requestJSON = Slim\Slim::getInstance()->request()->getBody();
  $params = json_decode($requestJSON,true);



  if (!$params) {
    //Grab the parameters
    $params = \Slim\Slim::getInstance()->request()->post();
  }

    if (!$params) {
    //Grab the parameters
    $params = \Slim\Slim::getInstance()->request()->get();
  }

  $userIsGood = userIsGood($params['username'],$params['userhash']);
  $userIsEditor = userIsEditor($params['username'],$params['timecode'],$params['editor_hash']);




  if ($userIsEditor && $userIsGood) {
    try {

      $db = dbConnect();


      $sql = "SELECT master_angler.id,first_name,last_name,email,street_address_1,street_address_2,city,state_address,state,zip,phone,date,body_of_water,nearest_town,meta as species,length,weight,lure_used,kind_of_lure,lure_desc,kind_of_bait,kept,post_type,secondary_post_type,title,body,img_url,user_id,username,created as date_submitted FROM master_angler JOIN superposts ON superposts.id = post_id WHERE master = 1;";



      $stmt = $db->prepare($sql);
      $stmt->execute(array());

      $masterAnglers = $stmt->fetchAll(PDO::FETCH_ASSOC);

      download_send_headers("master_angler.csv");

      $arrayKeys = array_keys(reset($masterAnglers));



      $arrayKeysString = "";

      foreach ($arrayKeys as $key => $value) {
        $arrayKeysString .= "\"$value\",";
      }

      $arrayKeysString = rtrim($arrayKeysString,",");
      $arrayKeysString .= "\n";

      echo $arrayKeysString;

      $csv = new arrayToCsv();

      echo $csv->convert($masterAnglers);

      $db = "";



      //array2csv(array_keys(reset($masterAnglers)));

      //print_r(array_keys($masterAnglers));

      //array2csv($masterAnglers);

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
  } else {
    echo "ERROR: Expired Link. Please try reloading page";
  }


});

function array2csv(array &$array)
{
   if (count($array) == 0) {
     return null;
   }
   ob_start();
   $df = fopen("php://output", 'w');
   fputcsv($df, array_keys(reset($array)));
   foreach ($array as $row) {
      fputcsv($df, $row);
   }
   fclose($df);
   return ob_get_clean();
}


function download_send_headers($filename) {
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
}