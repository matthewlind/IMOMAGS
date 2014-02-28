<?php
/*  Copyright 2012 Aaron Baker*/
/*
Plugin Name: IMO Facebook Auth
Plugin URI: http://imomags.com
Description: Adds facebook PHP & Javascript SDKs and another tools for facebook authentication. Also includes services that allows users to Register & Login via ajax using their email address. <b>IMO User Auth</b> is required to use this plugin
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

        //Set Defaults for whitetail app
        $appID = '127971893974432';
        $secretID = '998a58347d730b52dd2bac877180bedd';

        //For for settings on new apps

        if (defined("FACEBOOK_APP_ID") && defined("FACEBOOK_APP_SECRET")) {
	        $appID = FACEBOOK_APP_ID;
	        $secretID = FACEBOOK_APP_SECRET;
        }

    require 'src/facebook.php';
    wp_enqueue_script('jquery-form-js',plugins_url('js/jquery.form.min.js', __FILE__));
    wp_enqueue_script('imo-facebook-auth',plugins_url('js/facebook-auth.js', __FILE__),array('jquery-form-js'));
    wp_localize_script("imo-facebook-auth","fb_auth", array("app_id" => $appID) );

}
/********************************
**** ADD TEMPLATE TO FOOTER *****
*********************************/
// add_action('wp_footer', 'imo_login_auth_footer', 100);
// function imo_login_auth_footer() {
// 	include 'footer-templates.php';
// }



/********************************
**********JSON RESPONSES*********
*********************************/


add_action("init", "imo_email_login");
function imo_email_login() {

    if (preg_match("/^\/imo-email-login\.json(\?(.+)?)?$/", $_SERVER['REQUEST_URI'])) {
        header('Content-type: application/json');

        $errorMessage = "";
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = get_user_by("email",$email);




        $username = $user->user_login;

        $user = wp_authenticate($username,$password);

        wp_set_auth_cookie($user->ID,true);


        $imouser = imo_get_user($user->ID);

        if ($imouser['username'] == "") {
	        $imouser['error'] = "Invalid Email or Password";
        }


        $json = json_encode($imouser);

	    print $json;
        //print_r($user_profile);
        die();
    }

}

add_action("init", "imo_email_register");
function imo_email_register() {

    if (preg_match("/^\/imo-email-register\.json(\?(.+)?)?$/", $_SERVER['REQUEST_URI'])) {
        header('Content-type: application/json');

        //echo "hey";

        $displayName = $_POST['displayname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        //$stateAbbrev = "GA";

        $user = get_user_by("email",$email);


        //check for ban hammer
        $banString = get_option("blacklist_keys");


        $role = "subscriber";
        if (strstr($_SERVER['HTTP_HOST'], "northamericanwhitetail")) {
        	$role = "naw_community";
        }



        if (strpos($banString, $email)) {
	        die();
        }


        if (empty($_POST['displayname']) || empty($_POST['email']) || empty($_POST['password'])) {
	        $json = json_encode(array("errorcode"=>"incomplete_form","error"=>"Please fill enter a Display Name, Email and Password."));
    	    print $json;
	        die();
        }

        if ($user) {
	        $json = json_encode(array("errorcode"=>"user_exists","error"=>"A user with this email address already has an account."));
    	    print $json;
	        //print_r($user_profile);
	        die();
        } else {
        	$userdata = array();
        	$userdata['user_email'] = $email;
        	$userdata['display_name'] = $displayName;
        	$userdata['user_login'] = strtolower($displayName) . rand(1000,9999);
        	$userdata['user_pass'] = $password;
        	$userdata['role'] = $role;

        	$userID = wp_insert_user($userdata);
       		wp_set_auth_cookie($userID,true);
       		//add_user_meta($userID,"state",$stateAbbrev);
       		add_user_meta($userID,"send_community_updates",1);

       		$user = imo_get_user($userID);
       		$json = json_encode($user);

       		print $json;
       		die();
       	}


    }

}



function imo_facebook_usercheck() {

    if (preg_match("/^\/facebook-usercheck\.json(\?(.+)?)?$/", $_SERVER['REQUEST_URI'])) {
        header('Content-type: application/json');

        $accessToken =  $_GET['accessToken'];



        //Set Defaults for whitetail app
        $appID = '127971893974432';
        $secretID = '998a58347d730b52dd2bac877180bedd';

        //For for settings on new apps

        if (defined("FACEBOOK_APP_ID") && defined("FACEBOOK_APP_SECRET")) {
	        $appID = FACEBOOK_APP_ID;
	        $secretID = FACEBOOK_APP_SECRET;
        }



        $facebook = new Facebook(array(
		  'appId'  => $appID,
		  'secret' => $secretID,
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

		// _log("*********************FB PROFILE********************");
		// _log($user_profile);


		$email = $user_profile['email'];



		//$json = json_encode("NO USER EXISTS");


		//Check if user already exists
        if ($user = get_user_by("email",$email)) {//if yes, log them in
        	//wp_authenticate("facebook","dgrsvgqt4523facebook");
        	wp_set_auth_cookie($user->ID,true);
        	$user = imo_get_user($user->ID);

        	$json = json_encode($user);
        } else { //if not, register the user

        	if (!empty($email)) {

        	    //check for ban hammer
		        $banString = get_option("blacklist_keys");

		        if (strpos($banString, $email)) {
			        die();
		        }

		        $role = "subscriber";
		        if (strstr($_SERVER['HTTP_HOST'], "northamericanwhitetail")) {
		        	$role = "naw_community";
		        }


		        $userdata = array();
	        	$userdata['user_email'] = $email;
	        	$userdata['first_name'] = $user_profile['first_name'];
	        	$userdata['last_name'] = $user_profile['last_name'];
	        	$userdata['display_name'] = $user_profile['first_name'] . " " . $user_profile['last_name'];
	        	$userdata['user_login'] = strtolower($user_profile['first_name']) . strtolower($user_profile['last_name']) . rand(100,999);
	        	$userdata['user_pass'] = imo_facebook_generate_password();
	        	$userdata['role'] = $role;

	        	_log("User Inserted?");

	        	$facebookUsername = $user_profile['username'];
	        	$facebookProfilePicURL = "http://graph.facebook.com/".$user_profile['id']."/picture";






	       		$userID = wp_insert_user($userdata);
	       		wp_set_auth_cookie($userID,true);

	       		add_user_meta($userID,"facebook_ID",$user_profile['id']);
	       		add_user_meta($userID,"facebook_profile_image_URL",$facebookProfilePicURL);
	       		add_user_meta($userID,"send_community_updates",1);

	       		$locations = explode(",", $user_profile['hometown']['name']);


	        	if ($stateAbbrev = locationIsState(ltrim($locations[1]))) {

	        		add_user_meta($userID,"city",ltrim($locations[0]));
	        		add_user_meta($userID,"state",$stateAbbrev);

	        	}

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
******ADMIN MENU SETTINGS******
*********************************/
/* add_settings_field callback */
function email_post_id_domain_settings_option() {
    echo "<input type='text' name='email_post_id' id='email_post_id' value='".get_option("email_post_id", "" )."' />";
}

function email_post_id_settings_section() {
    echo "";
}

/* admin_menu callback. */
function email_post_id_settings_init() {
    add_settings_section("email_post_id_settings", __("New User Email"), "email_post_id_settings_section", "general");
    add_settings_field("email_post_id_domain", __("Post ID for Welcome Email"), "email_post_id_domain_settings_option", "general", "email_post_id_settings");
    register_setting("general", "email_post_id");
}
add_action("admin_menu", "email_post_id_settings_init");



