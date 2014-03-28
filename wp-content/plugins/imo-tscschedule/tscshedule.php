<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('America/New_York'); 
 	
function readCSV($csvFile){
	$file_handle = fopen($csvFile, 'r');
	while (!feof($file_handle) ) {
		$line_of_text[] = fgetcsv($file_handle, 1024);
	}
	fclose($file_handle);
	return $line_of_text;
}

function makeJSON() {
	// Set path to CSV file
	$csvFile = 'schedule_data.csv';
	
	$csv = readCSV($csvFile);
	
	$startstr = $csv[1][2];
	//print $startstr."<br>";
	//$nextTuesday = strtotime('next tue', strtotime($startstr));
	//print date('Y/m/d H:i:s	', strtotime('next tue 6:00PM', strtotime($startstr)))."<br>";
	//print date('m/d/Y', strtotime('next wed', strtotime($startstr)))."<br>";
	//print date('m/d/Y', strtotime('next thu', strtotime($startstr)))."<br>";
	//print date('m/d/Y', strtotime('next fri', strtotime($startstr)))."<br>";
	//$weekNo = date('W', strtotime($startstr));
	//print $weekNo."<br>";
	//$weekNoNextTuesday = date('W', $nextTuesday);

	$sdata = array();
	foreach ($csv as $key => $value) {
		if($key<4) continue;
		if(empty($value[0])) continue;

		$srow = array();
		$srow["SeriesTitle"] = $value[0];
		$srow["SeriesID"] = $value[1];
		$srow["EpisodeTitle"] = $value[2];
		$srow["EpisodeDescription"] = $value[3];
		$srow["NewEpisode"] = $value[4];
		$slots = array();
		
		for($i=5;$i<count($value);$i++) {
			if(!empty($value[$i])) {
				$slot = array();
				$slot["src"] = $value[$i];
				if(substr($value[$i],0,3)=="MON")
					$dstr = strtotime($startstr." ".$value[$i]);
				else 
					$dstr = strtotime('next '.$value[$i], strtotime($startstr));
				$slot["rdate"] = date('Y/m/d', $dstr);
				$slot["rtime"] = date('H:i:s', $dstr);
				$slots[] = $slot;
			}
		}
		$srow["Timeslots"] = $slots;
		
		$sdata[] = $srow;
	}
	
	print json_encode($sdata);
}

function readJSON() {
	
	print "OK";
	
}
readJSON();
	
?>