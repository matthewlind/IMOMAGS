<?php
/*  Copyright 2012 Aaron Baker*/
/*
Plugin Name: IMO Facebook Auth
Plugin URI: http://imomags.com
Description: Adds facebook PHP & Javascript SDKs and another tools for facebook authentication
Author: aaron
Author URI:
Version: 0.1
Stable tag: 0.1
License: IMO
*/

/********************************
*******LOAD SCRIPTS & SDKs*******
*********************************/

add_action('init', 'imo_facebook_auth_setup');
function imo_facebook_auth_setup() {

    require 'src/facebook.php';
    wp_enqueue_script('imo-facebook-auth',plugins_url('js/facebook-auth.js', __FILE__));

}

/********************************
**********JSON RESPONSES*********
*********************************/

function imo_facebook_usercheck() {

    if (preg_match("/^\/facebook-usercheck\.json(\?(.+)?)?$/", $_SERVER['REQUEST_URI'])) {
        header('Content-type: application/json');
        
        $accessToken =  $_GET['accessToken'];
        

        

        $facebook = new Facebook(array(
		  'appId'  => '127971893974432',
		  'secret' => '998a58347d730b52dd2bac877180bedd',
		));
		
		if (!empty($accessToken)) {
	        $facebook->setAccessToken($accessToken);
        }

		// Get FB User ID
		$user = $facebook->getUser();
		
		
		

		if ($user) {
		  try {
		    // Proceed knowing you have a logged in user who's authenticated.
		    $user_profile = $facebook->api('/me');
		  } catch (FacebookApiException $e) {
		    error_log($e);
		    $user = null;
		  }
		}
		
		_log("*********************FB PROFILE********************");
		_log($user_profile);


		$email = $user_profile['email'];



		//$json = json_encode("NO USER EXISTS");


		//Check if user already exists
        if ($user = get_user_by("email",$email)) {//if yes, log them in
        	wp_authenticate("facebook","dgrsvgqt4523facebook");
        		
        	$user = imo_get_user($user->ID);
        	
        	$json = json_encode($user);
        } else { //if not, register the user
        
        	if (!empty($email)) {
		        $userdata = array();
	        	$userdata['user_email'] = $email;
	        	$userdata['first_name'] = $user_profile['first_name'];
	        	$userdata['last_name'] = $user_profile['last_name'];
	        	$userdata['display_name'] = $user_profile['first_name'] . " " . $user_profile['last_name'];
	        	$userdata['user_login'] = strtolower($user_profile['first_name']) . strtolower($user_profile['last_name']) . rand(100,999);
	        	$userdata['user_pass'] = imo_facebook_generate_password();
	
	        	_log("User Inserted?");
	        	
	        	$facebookUsername = $user_profile['username'];
	        	$facebookProfilePicURL = "http://graph.facebook.com/".$facebookUsername."/picture";
	        	
	         	

	        	
	
	        	
	       		$userID = wp_insert_user($userdata);
	       		wp_set_auth_cookie($userID,true);
	       		
	       		add_user_meta($userID,"facebook_ID",$user_profile['id']);
	       		add_user_meta($userID,"facebook_profile_image_URL",$facebookProfilePicURL);
	       		
	       		$locations = explode(",", $user_profile['hometown']['name']);
	        
	        	
	        	if ($stateAbbrev = locationIsState(ltrim($locations[1]))) {
	        	
	        		add_user_meta($userID,"city",ltrim($locations[0]));
	        		add_user_meta($userID,"state",$stateAbbrev);
		        	
	        	}
	       		
	       		
	       		
	
	       		//$userdata['user_pass'] = "";
	       		
	       		$user = imo_get_user($userID);
	
	       		$json = json_encode($user);

        	}


        }

        

        print $json;
        //print_r($user_profile);
        die();
    } 
    
    if (preg_match("/^\/logout\.json(\?(.+)?)?$/", $_SERVER['REQUEST_URI'])) {
        header('Content-type: application/json');
       $current_user = wp_get_current_user();        
        
        update_user_meta($current_user->ID,"imo_fb_login_status",false);
        
        wp_logout();
        die();
        
    }
    
   if (preg_match("/^\/usercheck\.json(\?(.+)?)?$/", $_SERVER['REQUEST_URI'])) {
        header('Content-type: application/json');
        $user = imo_get_user();
       	$json = json_encode($user);
       	print $json;
       	
        die();
        
    }


}

add_action("init", "imo_facebook_usercheck");


function imo_facebook_generate_password($length=9, $strength=0) {
	$vowels = 'aeuy23456789';
	$consonants = 'bdghjmnpqrstvz';
 
	$password = '';
	$alt = time() % 2;
	for ($i = 0; $i < $length; $i++) {
		if ($alt == 1) {
			$password .= $consonants[(rand() % strlen($consonants))];
			$alt = 0;
		} else {
			$password .= $vowels[(rand() % strlen($vowels))];
			$alt = 1;
		}
	}
	return $password;
}
 



function locationIsState($state) {
	
	$stateList = array(
	"alabama"=>"AL",
	"alaska"=>"AK",
	"arizona"=>"AZ",
	"arkansas"=>"AR",
	"california"=>"CA",
	"colorado"=>"CO",
	"connecticut"=>"CT",
	"delaware"=>"DE",
	"district of columbia"=>"DC",
	"florida"=>"FL",
	"georgia"=>"GA",
	"hawaii"=>"HI",
	"idaho"=>"ID",
	"illinois"=>"IL",
	"indiana"=>"IN",
	"iowa"=>"IA",
	"kansas"=>"KS",
	"kentucky"=>"KY",
	"louisiana"=>"LA",
	"maine"=>"ME",
	"maryland"=>"MD",
	"massachusetts"=>"MA",
	"michigan"=>"MI",
	"minnesota"=>"MN",
	"mississippi"=>"MS",
	"missouri"=>"MO",
	"montana"=>"MT",
	"nebraska"=>"NE",
	"nevada"=>"NV",
	"new hampshire"=>"NH",
	"new jersey"=>"NJ",
	"new mexico"=>"NM",
	"new york"=>"NY",
	"north carolina"=>"NC",
	"north dakota"=>"ND",
	"ohio"=>"OH",
	"oklahoma"=>"OK",
	"oregon"=>"OR",
	"pennsylvania"=>"PA",
	"rhode island"=>"RI",
	"south carolina"=>"SC",
	"south dakota"=>"SD",
	"tennessee"=>"TN",
	"texas"=>"TX",
	"utah"=>"UT",
	"vermont"=>"VT",
	"virginia"=>"VA",
	"washington"=>"WA",
	"west virginia"=>"WV",
	"wisconsin"=>"WI",
	"wyoming"=>"WY",
	"canada"=>"CN",
	"alberta"=>"AB",
	"british columbia"=>"BC",
	"manitoba"=>"MB",
	"new brunswick"=>"NB",
	"newfoundland and labrador"=>"NL",
	"northwest territories"=>"NT",
	"nova scotia"=>"NS",
	"nunavut"=>"NU",
	"ontario"=>"ON",
	"prince edward island"=>"PE",
	"quebec"=>"QC",
	"saskatchewan"=>"SK",
	"yukon"=>"YT",
	"aguascalientes"=>"AG",
	"baja california"=>"BJ",
	"baja california sur"=>"BS",
	"campeche"=>"CP",
	"chiapas"=>"CH",
	"chihuahua"=>"CI",
	"coahuila"=>"CU",
	"colima"=>"CL",
	"distrito federal"=>"DF",
	"durango"=>"DG",
	"guanajuato"=>"GJ",
	"guerrero"=>"GR",
	"hidalgo"=>"HG",
	"jalisco"=>"JA",
	"mexico"=>"EM",
	"michoacán"=>"MH",
	"morelos"=>"MR",
	"nayarit"=>"NA",
	"nuevo león"=>"NL",
	"oaxaca"=>"OA",
	"puebla"=>"PU",
	"querétaro"=>"QA",
	"queretaro"=>"QA",
	"quintana roo"=>"QR",
	"san luis potosi"=>"SL",
	"sinaloa"=>"SI",
	"sonora"=>"SO",
	"tabasco"=>"TA",
	"tamaulipas"=>"TM",
	"tlaxcala"=>"TL",
	"veracruz"=>"VZ",
	"yucatan"=>"YC",
	"zacatecas"=>"ZT");
	
	
	$state = strtolower($state);
	
	if (array_key_exists($state,$stateList)) {
		return $stateList[$state];
	} else {
		return false;
	}
	
	return array_key_exists($state,$stateList);
		
	
}



/********************************
******AUTHENTICATION PLUGGABLE******
*********************************/
if ( !function_exists('wp_authenticate') ) :
/**
 * Checks a user's login information and logs them in if it checks out.
 *
 * @since 2.5.0
 *
 * @param string $username User's username
 * @param string $password User's password
 * @return WP_Error|WP_User WP_User object if login successful, otherwise WP_Error object.
 */
function wp_authenticate($username, $password) {
	$username = sanitize_user($username);
	$password = trim($password);

	$user = apply_filters('authenticate', null, $username, $password);



	$ignore_codes = array('empty_username', 'empty_password');


	//Check if facebook!
	if ($username == "facebook" && $password == "dgrsvgqt4523facebook") {

		$facebook = new Facebook(array(
		  'appId'  => '127971893974432',
		  'secret' => '998a58347d730b52dd2bac877180bedd',
		));

		// Get FB User ID
		$user = $facebook->getUser();

		if ($user) {
		  try {
		    // Proceed knowing you have a logged in user who's authenticated.
		    $user_profile = $facebook->api('/me');
		  } catch (FacebookApiException $e) {
		    error_log($e);
		    $user = null;
		  }
		}

		$email = $user_profile['email'];	
		$user = get_user_by("email",$email);

		wp_set_auth_cookie($user->ID,true);


	}

	if ( $user == null ) {
		// TODO what should the error message be? (Or would these even happen?)
		// Only needed if all authentication handlers fail to return anything.
		$user = new WP_Error('authentication_failed', __('<strong>ERROR</strong>: Invalid username or incorrect password.'));
	}

	if (is_wp_error($user) && !in_array($user->get_error_code(), $ignore_codes) ) {
		do_action('wp_login_failed', $username);
	}


	return $user;
}
endif;
