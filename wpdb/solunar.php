<?php

//include mysql account info
include 'mysql.php';
include 'moon-phase.php';
include 'statelist.php';

//Set headers for json output
header('Access-Control-Allow-Origin: *');
date_default_timezone_set('America/New_York');

//Default Settings
$month = 1;
$year = date("Y");
//$location = 56425;

//Grab the parameters
$params = $_GET;



if (empty($location)) {

	$location = getLocationFromIP();

} else {
	$location = 56425;
}

//Overwrite the default settings with the new ones
extract($params,EXTR_OVERWRITE);



if (is_numeric($location)) { //if location is zip

	importSolunarData($month,$year,$location);
	querySolunarData($month,$year,$location);

} else {//if it's not a zip code, parse the location.

	$locationParts = explode(",",$location);

	$city = $locationParts[0];
	$state = strtolower(trim($locationParts[1]));

	if (!empty($statelist[$state])) {//convert state name to 2 character state
		$state = $statelist[$state];
	}

	$location = $city . $state;

	$location = urlencode($location);

	importSolunarData($month,$year,$location);
	querySolunarData($month,$year,$location);
}

//Overwrite the default settings with the new ones
extract($params,EXTR_OVERWRITE);

$hash = md5("h4m9az01" . $dateString);

function querySolunarData($month,$year,$zip) {


	$sql = "SELECT * FROM solunar WHERE postalcode = $zip AND month = $month and year = $year";

	//echo $sql;

	$db = dbConnect();
	$stmt = $db->prepare($sql);
	$stmt->execute(array());
	$solunarData = $stmt->fetchAll(PDO::FETCH_OBJ);

	$db = "";

	if (count($solunarData)>0)
		print_r(json_encode($solunarData));
	else
		header("HTTP/1.0 404 Not Found");

}

/////////////////////////////
function importSolunarData($month,$year,$location) {



	//Generate a secure hash for authentication with solunar.com
	$dateString = gmdate("Y-m-d");
	$hash = md5("h4m9az01" . $dateString);

	if (is_numeric($location))
		$url = "http://www.solunar.com/solunarwebservice.asmx/ComputeForPostalCode?_Token=$hash&_PostalCode=$location&_Month=$month&_Year=$year&_UseCache=false";
	else
		$url = "http://www.solunar.com/solunarwebservice.asmx/ComputeForCityState?_Token=$hash&_CityState=$location&_Month=$month&_Year=$year&_UseCache=false";


	//echo "<br>";
	//echo $url;

	//Grab the XML
	$xml = file_get_contents($url,FALSE);

	//echo $url;

	$parsedXML = new SimpleXMLElement($xml);
	$solunarData = $parsedXML->SolunarData;

	//print_r($xml);

	$solunarDataArray = array();

	foreach ($solunarData as $key => $dayData) {
		$solunarDataArray[] = json_decode(json_encode($dayData));
	}

	//print_r($solunarDataArray);

	//Set the location to the found zipcode so that we can query the db by zipcode
	global $location;
	$location = $solunarData->PostalCode;


	$daysToFix = array();

	$i = 0;

	//Parse and insert the XML feed results
	foreach ($solunarData as $key => $dayData) {

		//Existing values are replaced
		$sql = "REPLACE INTO solunar ";
		$sqlColumns = "(";
		$sqlValues = "(";

		//print_r($dayData);

		//Generate day of week
		$day = intval($dayData->Day);
		$timestamp = mktime(null,null,null,$month,$day,$year);
		$dayOfWeek = date("l",$timestamp);
		$dayOfWeekNumber = date("w",$timestamp);
		$dayData->weekday = $dayOfWeek;
		$dayData->weekdaycode = intval($dayOfWeekNumber);

		$dayData->mooncode = get_moon_code($timestamp);

		$dayInSeconds = 60*60*24;
		$TwoDaysInSeconds = $dayInSeconds * 2;
		$ThreeDaysInSeconds = $dayInSeconds * 3;
		$FourDaysInSeconds = $dayInSeconds * 4;

		//Generate color code and correct the moon codes
		$peakDayFlag = $dayData->PeakDayFlag;
		$dayData->peakcode = 0;

		$nextDayFlag = $solunarDataArray[$i+1]->PeakDayFlag;
		$prevDayFlag = $solunarDataArray[$i-1]->PeakDayFlag;

		if ($peakDayFlag == "Q") {
			$dayData->peakcode = 3;
		}
		if ($peakDayFlag == "N") {
			$dayData->peakcode = 4;
			$dayData->mooncode = 1;

			if ($nextDayFlag != "N") {
				$daysToFix[$timestamp + $dayInSeconds] = 3;
				$daysToFix[$timestamp + $TwoDaysInSeconds] = 2;
				$daysToFix[$timestamp + $ThreeDaysInSeconds] = 1;
			}

			if ($prevDayFlag != "N") {
				$daysToFix[$timestamp - $dayInSeconds] = 3;
				$daysToFix[$timestamp - $TwoDaysInSeconds] = 2;
				$daysToFix[$timestamp - $ThreeDaysInSeconds] = 1;
			}

		}
		if ($peakDayFlag == "F") {
			$dayData->peakcode = 4;
			$dayData->mooncode = 12;
			if ($nextDayFlag != "F") {
				$daysToFix[$timestamp + $dayInSeconds] = 3;
				$daysToFix[$timestamp + $TwoDaysInSeconds] = 2;
				$daysToFix[$timestamp + $ThreeDaysInSeconds] = 1;
			}

			if ($prevDayFlag != "F") {
				$daysToFix[$timestamp - $dayInSeconds] = 3;
				$daysToFix[$timestamp - $TwoDaysInSeconds] = 2;
				$daysToFix[$timestamp - $ThreeDaysInSeconds] = 1;
			}
		}
		if ($peakDayFlag == ">") {
			$dayData->peakcode = 1;
		}

		//print_r((int)$dayData->mooncode);echo"<br>";

		// if ($dayData->mooncode == 1 || $dayData->mooncode == 12)
		// 	$dayData->peakcode = 4;

		// if ($dayData->mooncode == 13 || $dayData->mooncode == 11)
		// 	$dayData->peakcode = 3;

		// if ($dayData->mooncode == 2 || $dayData->mooncode == 24)
		// 	$dayData->peakcode = 3;

		// if ($dayData->mooncode == 3 || $dayData->mooncode == 23)
		// 	$dayData->peakcode = 2;

		// if ($dayData->mooncode == 14 || $dayData->mooncode == 10)
		// 	$dayData->peakcode = 2;

		// if ($dayData->mooncode == 4 || $dayData->mooncode == 22)
		// 	$dayData->peakcode = 1;

		// if ($dayData->mooncode == 15 || $dayData->mooncode == 9)
		// 	$dayData->peakcode = 1;

		// if ($dayData->mooncode < 1)
		// 	$dayData->mooncode = 1;

		// if ($dayData->mooncode > 24)
		// 	$dayData->mooncode = 24;


		//print_r($dayData);

		//Generate the timestamps for the major and minor times
		$dayData->ammajortimestamp = get_timestamp($dayData->AMMajor,"AM",$month,$day,$year);
		$dayData->pmmajortimestamp = get_timestamp($dayData->PMMajor,"PM",$month,$day,$year);
		$dayData->amminortimestamp = get_timestamp($dayData->AMMinor,"AM",$month,$day,$year);
		$dayData->pmminortimestamp = get_timestamp($dayData->PMMinor,"PM",$month,$day,$year);

		//Generate the start times and end times by adding and subtracting an hour
		$dayData->ammajorstart = date("g:iA",$dayData->ammajortimestamp - 3600);
		$dayData->ammajorend =   date("g:iA",$dayData->ammajortimestamp + 3600);

		$dayData->pmmajorstart = date("g:iA",$dayData->pmmajortimestamp - 3600);
		$dayData->pmmajorend =   date("g:iA",$dayData->pmmajortimestamp + 3600);

		$dayData->amminorstart = date("g:iA",$dayData->amminortimestamp - 3600);
		$dayData->amminorend =   date("g:iA",$dayData->amminortimestamp + 3600);

		$dayData->pmminorstart = date("g:iA",$dayData->pmminortimestamp - 3600);
		$dayData->pmminorend =   date("g:iA",$dayData->pmminortimestamp + 3600);


		//set the ----- to null






		//Setup counters for calendar cell start day
		$total = count($dayData);
		$count = 0;


		foreach ($dayData as $colName => $value) {
			$count++;


			$lowercaseColName = strtolower($colName);

			$sqlColumns .= $lowercaseColName;
			$sqlValues .= "'" . $value ."'";

			if ($count != $total) {
				$sqlColumns .= ", ";
				$sqlValues .= ", ";
			}

		}
		$sqlColumns .= ")";
		$sqlValues .= ")";

		$sql .= $sqlColumns . " VALUES " . $sqlValues;

		//echo $sql;

		$db = dbConnect();
		$stmt = $db->prepare($sql);
		$stmt->execute(array());
		$db = "";

		$i++;

	}


	$db = dbConnect();


	foreach ($daysToFix as $timestamp => $peakcode) {

		$day = date("j",$timestamp);
		$month = date("n",$timestamp);
		$year = date("Y",$timestamp);

		$sql = "UPDATE solunar SET peakcode = $peakcode WHERE postalcode = $location AND month = $month AND day = $day AND year = $year;";

		$stmt = $db->prepare($sql);
		$stmt->execute(array());

	}

	$db = "";


}//End function download solunar data

/////////////////////////////
//calc moon phase
function get_moon_code($timestamp){
	$moon = new MoonPhase($timestamp);

	$illumination = $moon->illumination();
	$rIllumination = 1 - $illumination;//Reverse the number to better fit our moon filenames

	$phase = $moon->phase();


	return round(($moon->phase() * 24) + 0.9);

}

/////////////////////////////
//calc get timestamp
function get_timestamp($timestring,$period,$month,$day,$year) {

	//print_r($timestring);

	$timeparts = explode(":",$timestring);
	$hours = $timeparts[0];
	$minutes = $timeparts[1];

	//print_r($timeparts);

	if ($period == "PM")
		$hours = $hours + 12;

	$time = mktime($hours,$minutes,0,$month,$day,$year);

	return $time;




}

function getLocationFromIP() {

	$ip = ip2long($_SERVER['REMOTE_ADDR']);


	//echo $_SERVER['REMOTE_ADDR'];

	$ip = ip2long("75.150.12.113");


	$sql = "SELECT * FROM geolitecity_blocks blocks LEFT JOIN geolitecity_location as location on blocks.location_id = location.location_id WHERE startipnum < $ip AND endipnum > $ip LIMIT 1;";



	$db = dbConnect();

	$stmt = $db->prepare($sql);
	$stmt->execute();
	$locationData = $stmt->fetchAll(PDO::FETCH_OBJ);

	$db = "";


	$location = $locationData[0]->postalcode;


	if (!empty($location))
		return $location;
	else
		return false;

}


/////////////////////////////
/* Better Logging Function */
if(!function_exists('_log')){
  function _log( $message ) {
	  if( is_array( $message ) || is_object( $message ) ){

	  	$errorString = print_r( $message, true );

	    error_log( "$errorString",0);
	  } else {
	    error_log( $message );
	  }
  	}
}/////////////////////////////














