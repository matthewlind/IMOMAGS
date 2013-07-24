<?php
/*
 * Plugin Name: IMO Varnish Device Detection
 * Plugin URI: http://github.com/imoutdoors
 * Description: Detects devices in Varnish and sends the info to Wordpress
 * Version: 0.1
 * Author: aaron baker
 * Author URI: http://imomags.com
 */


add_action( 'init', 'check_and_add_http_headers' , -50); //Give function high priority so that it is called before anything else

//These variables are checked later in the functions below. If the page is mobile/tablet, these are set to true.
$deviceTypeIsTablet = FALSE;
$deviceTypeIsMobile = FALSE;
$varnishHeaderExists = FALSE;




function check_and_add_http_headers() {


	global $deviceTypeIsMobile;
	global $deviceTypeIsTablet;
	global $varnishHeaderExists;

	$headers = apache_request_headers();


	foreach ($headers as $header => $value) {//Search through headers for the Device Type header

		if ($header == "X-Device-Type") {//If Device Type header is found

			$varnishHeaderExists = TRUE;

			if ($value == "Mobile") {//If device is set to mobile

				$deviceTypeIsMobile = TRUE; //Set the device so that wordpress can use it later in the functions below

				header("Varys: Device-Type"); //Set Varys in the response header so that Varnish knows this page has multiple variations
				header("X-Device-Type: Mobile");//Set the device type in the response header so that varnish knows this is a mobile page

			} else if ($value == "Tablet") {

				$deviceTypeIsTablet = TRUE;

				header("Varys: Device-Type");
				header("X-Device-Type: Tablet");

			} else {

				header("Varys: Device-Type");
				header("X-Device-Type: Default");
			}


		}

	}

	if (!$varnishHeaderExists) { //If no device type header is found, we are probably on .deva or .fox

		include_once('Mobile_Detect.php');

		$detect = new Mobile_Detect();


		if ($detect->isMobile() && !$detect->isTablet()) {
			$deviceTypeIsMobile = TRUE;


		} //Make sure to only return true if tablet is false.


		if ($detect->isTablet()) {

			$deviceTypeIsTablet = TRUE;
		} //Make sure to only return true if tablet is false.



	}

}


function mobile() {

	global $deviceTypeIsMobile;
	return $deviceTypeIsMobile;
}

function tablet() {
	global $deviceTypeIsTablet;

	return $deviceTypeIsTablet;
}

