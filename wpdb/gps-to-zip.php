<?php 

//include mysql account info
include 'mysql.php';

//Set headers for json output
header('Access-Control-Allow-Origin: *');  
date_default_timezone_set('America/New_York'); 


$lat = 34.477757;
$lon = -83.773537;

//Grab the parameters
$params = $_GET;

//Overwrite the default settings with the new ones
extract($params,EXTR_OVERWRITE);


$query =  "SELECT zip,latitude,longitude,city,full_state as state FROM zip_codes WHERE ";
$query .= "latitude > ($lat - 0.4) AND ";
$query .= "latitude < ($lat + 0.4) AND ";
$query .= "longitude > ($lon - 0.4) AND ";
$query .= "longitude < ($lon + 0.4)";


$db = dbConnect();
$stmt = $db->prepare($query);
$stmt->execute(array());
$closestZipCodes= $stmt->fetchAll(PDO::FETCH_OBJ);

$db = "";

$bestMatch = $closestZipCodes[0];

$bestMatch->distance = calcDist($lat, $lon, $bestMatch->latitude, $bestMatch->longitude);

foreach ($closestZipCodes as $zip) {

	$zip->distance = calcDist($lat, $lon, $zip->latitude, $zip->longitude);
	
	if ($zip->distance < $bestMatch->distance) {

		$bestMatch = $zip;
	}
		
}


print_r(json_encode($bestMatch));

//Use trigonometry to calculate distance between 2 points on a curved surface
function calcDist($lat_A, $long_A, $lat_B, $long_B) {
  $distance = sin(deg2rad($lat_A))
                * sin(deg2rad($lat_B))
                + cos(deg2rad($lat_A))
                * cos(deg2rad($lat_B))
                * cos(deg2rad($long_A - $long_B));
  $distance = (rad2deg(acos($distance))) * 69.09;
  return $distance;
}