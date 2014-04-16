<?php
include 'mysql.php';

print_r(getLocationFromIP());

function getLocationFromIP() {

	$ip = ip2long($_SERVER['REMOTE_ADDR']);


	echo $_SERVER['REMOTE_ADDR'];
	echo "<br>";
	echo ip2long($_SERVER['REMOTE_ADDR']);
	echo "<br>";

	$ip = ip2long("24.240.222.0");


	$sql = "SELECT region as state FROM geolitecity_blocks blocks LEFT JOIN geolitecity_location as location on blocks.location_id = location.location_id WHERE startipnum < $ip AND endipnum > $ip LIMIT 1;";

	//$sql = "SELECT * FROM geolitecity_blocks blocks LEFT JOIN geolitecity_location as location on blocks.location_id = location.location_id  LEFT JOIN  zip_codes as zip_codes on zip_codes.zip = geolitecity_location.postalcode WHERE startipnum < $ip AND endipnum > $ip LIMIT 1;";


	$db = dbConnect();

	$stmt = $db->prepare($sql);
	$stmt->execute();
	$locationData = $stmt->fetchAll(PDO::FETCH_OBJ);

	$db = "";


	$location = $locationData[0];


	if (!empty($location))
		return $location;
	else
		return false;

}