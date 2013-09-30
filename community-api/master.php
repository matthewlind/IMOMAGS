<?php

$app->get('/master_anglers', function () {

	try {

		$db = dbConnect();


		$sql = "SELECT * FROM master_angler JOIN superposts ON superposts.id = post_id;";



		$stmt = $db->prepare($sql);
		$stmt->execute(array());

		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts,JSON_NUMERIC_CHECK);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});

$app->get('/master_anglers/csv', function () {
	try {

		$db = dbConnect();


		$sql = "SELECT * FROM master_angler JOIN superposts ON superposts.id = post_id;";



		$stmt = $db->prepare($sql);
		$stmt->execute(array());

		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		 date_default_timezone_set("America/New_York");

		download_send_headers("data_export_" . date("Y-m-d") . ".csv");
		echo array2csv($posts);


		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
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