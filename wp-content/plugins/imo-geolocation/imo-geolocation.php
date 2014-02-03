<?php
/*
 * Plugin Name: IMO Geolocation
 * Plugin URI: http://github.com/imoutdoors
 * Description: Detect which US State a user lives in and provides that information to other IMO Themes and Plugins
 * Version: 0.1
 * Author: aaron baker
 * Author URI: http://imomags.com
 */

include("sidebar-widget.php");
include("related-footer-widget.php");

$IMO_USER_STATE;
$IMO_USER_STATE_NICENAME;

add_action('template_redirect', 'checkForGeolocationCookie',-50);

function checkForGeolocationCookie() {

	//Read state cookie
	$stateAbbrev = $_COOKIE['userState'];

	//Use this list of states for validation
	$states = array('AL' => 'Alabama','AK' => 'Alaska','AZ' => 'Arizona','AR' => 'Arkansas','CA' => 'California','CO' => 'Colorado','CT' => 'Connecticut','DE' => 'Delaware','DC' => 'District of Columbia','FL' => 'Florida','GA' => 'Georgia', 'HI' => 'Hawaii','ID' => 'Idaho','IL' => 'Illinois','IN' => 'Indiana','IA' => 'Iowa','KS' => 'Kansas','KY' => 'Kentucky','LA' => 'Louisiana','ME' => 'Maine','MD' => 'Maryland','MA' => 'Massachusetts','MI' => 'Michigan','MN' => 'Minnesota','MS' => 'Mississippi','MO' => 'Missouri','MT' => 'Montana','NE' => 'Nebraska','NV' => 'Nevada','NH' => 'New Hampshire','NJ' => 'New Jersey','NM' => 'New Mexico','NY' => 'New York','NC' => 'North Carolina','ND' => 'North Dakota','OH' => 'Ohio','OK' => 'Oklahoma','OR' => 'Oregon','PA' => 'Pennsylvania','PR' => 'Puerto Rico','RI' => 'Rhode Island','SC' => 'South Carolina','SD' => 'South Dakota','TN' => 'Tennessee','TX' => 'Texas','UT' => 'Utah','VT' => 'Vermont', 'VA' => 'Virginia','WA' => 'Washington','WV' => 'West Virginia','WI' => 'Wisconsin','WY' => 'Wyoming ');

	//check if it's good
	if (!empty($states[$stateAbbrev])) {
		//If we have a state, set the variables to be used by themes and plugins
		setStateVariablesAndCookie($stateAbbrev);
	} else {
		//If not, detect using IP and then set the variables
		$stateAbbrev = detectLocationFromIP();
		setStateVariablesAndCookie($stateAbbrev);
	}

}




function detectLocationFromIP() {

	$ip = ip2long($_SERVER['REMOTE_ADDR']);

	global $wpdb;

	//Check to see if we have a location for the IP
	$sql = "SELECT region as state FROM geolitecity_blocks blocks LEFT JOIN geolitecity_location as location on blocks.location_id = location.location_id WHERE startipnum < $ip AND endipnum > $ip LIMIT 1;";
	$stateAbbrev = $wpdb->get_var($sql);


	$states = array('AL' => 'Alabama','AK' => 'Alaska','AZ' => 'Arizona','AR' => 'Arkansas','CA' => 'California','CO' => 'Colorado','CT' => 'Connecticut','DE' => 'Delaware','DC' => 'District of Columbia','FL' => 'Florida','GA' => 'Georgia', 'HI' => 'Hawaii','ID' => 'Idaho','IL' => 'Illinois','IN' => 'Indiana','IA' => 'Iowa','KS' => 'Kansas','KY' => 'Kentucky','LA' => 'Louisiana','ME' => 'Maine','MD' => 'Maryland','MA' => 'Massachusetts','MI' => 'Michigan','MN' => 'Minnesota','MS' => 'Mississippi','MO' => 'Missouri','MT' => 'Montana','NE' => 'Nebraska','NV' => 'Nevada','NH' => 'New Hampshire','NJ' => 'New Jersey','NM' => 'New Mexico','NY' => 'New York','NC' => 'North Carolina','ND' => 'North Dakota','OH' => 'Ohio','OK' => 'Oklahoma','OR' => 'Oregon','PA' => 'Pennsylvania','PR' => 'Puerto Rico','RI' => 'Rhode Island','SC' => 'South Carolina','SD' => 'South Dakota','TN' => 'Tennessee','TX' => 'Texas','UT' => 'Utah','VT' => 'Vermont', 'VA' => 'Virginia','WA' => 'Washington','WV' => 'West Virginia','WI' => 'Wisconsin','WY' => 'Wyoming ');

	//Check to see if the location is a valid state
	if (!empty($states[$stateAbbrev])) {
		//If we have a state, set the variables to be used by themes and plugins
		setStateVariablesAndCookie($stateAbbrev);
	} else {
		//If not, don't detect a state and hope we can use browser based geolocation
	}
}


function setStateVariablesAndCookie($state) {

	$states = array('AL' => 'Alabama','AK' => 'Alaska','AZ' => 'Arizona','AR' => 'Arkansas','CA' => 'California','CO' => 'Colorado','CT' => 'Connecticut','DE' => 'Delaware','DC' => 'District of Columbia','FL' => 'Florida','GA' => 'Georgia', 'HI' => 'Hawaii','ID' => 'Idaho','IL' => 'Illinois','IN' => 'Indiana','IA' => 'Iowa','KS' => 'Kansas','KY' => 'Kentucky','LA' => 'Louisiana','ME' => 'Maine','MD' => 'Maryland','MA' => 'Massachusetts','MI' => 'Michigan','MN' => 'Minnesota','MS' => 'Mississippi','MO' => 'Missouri','MT' => 'Montana','NE' => 'Nebraska','NV' => 'Nevada','NH' => 'New Hampshire','NJ' => 'New Jersey','NM' => 'New Mexico','NY' => 'New York','NC' => 'North Carolina','ND' => 'North Dakota','OH' => 'Ohio','OK' => 'Oklahoma','OR' => 'Oregon','PA' => 'Pennsylvania','PR' => 'Puerto Rico','RI' => 'Rhode Island','SC' => 'South Carolina','SD' => 'South Dakota','TN' => 'Tennessee','TX' => 'Texas','UT' => 'Utah','VT' => 'Vermont', 'VA' => 'Virginia','WA' => 'Washington','WV' => 'West Virginia','WI' => 'Wisconsin','WY' => 'Wyoming ');

	global $IMO_USER_STATE;
	$IMO_USER_STATE = $state;

	global $IMO_USER_STATE_NICENAME;
	$IMO_USER_STATE_NICENAME = $states[$state];

	wp_enqueue_script( 'imo-geolocation-js', plugin_dir_url( __FILE__ ) . 'imo-geolocation.js' ,array('jquery'));
	wp_localize_script( 'imo-geolocation-js', 'userState', $state);

	if (empty($_COOKIE['userState']))
		setcookie('userState',$state,time() + (86400 * 120));
}






