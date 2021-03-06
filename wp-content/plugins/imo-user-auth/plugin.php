<?php
/*  Copyright 2012 Aaron Baker*/
/*
Plugin Name: IMO User Auth
Plugin URI: http://imomags.com
Description: Adds authentication hashes that are used by Community API to authenticate. Also, creates an XMLRPC method that allows the Whitetail+ iphone app to authenticate.
Author: aaron
Author URI:
Version: 0.1
Stable tag: 0.1
License: IMO
*/


add_action("init","imo_user_display");


function imo_user_hash($id,$username){


}


function imo_user_display() {

	global $user_ID;

	$user = imo_get_user($user_ID);

	// send the user variables to the javascript
	wp_enqueue_script( 'imo-user-auth', plugin_dir_url( __FILE__ ) . 'imo-user-auth.js', array( 'jquery' ) );
	wp_localize_script( 'imo-user-auth', 'userIMO', $user);


}

function imo_get_user($userID = -1) {

	$salt = "jYSe38xE3:lfsbEV2u.nUB^?80AXr3<%_VA4!)cfX.z";
	$editorSalt = "AspenMichiganS252yysSl2*252sgcv222@#@!xx";

	$timecode = time();

	if ($userID < 1) {
		global $user_email;
		global $user_login;
		$WPuser = new stdClass();
	} else {
		$WPuser = get_user_by("id",$userID);
		$user_email = $WPuser->user_email;
		$user_login = $WPuser->user_login;
	}



	$facebookID = get_user_meta($userID,"facebook_ID",true);
	$state = get_user_meta($userID,"state",true);

	$userhash = md5($user_login . $salt);
	$timecode_hash = md5($timecode . $salt);
	$user_timecode_hash = md5($user_login .$timecode . $salt);


	$perms = "user";
	$editor_hash = "";
	$display_name = "";
	
	if(isset($WPuser->roles)) {
		if (in_array("administrator",$WPuser->roles) || in_array("editor",$WPuser->roles) || in_array("moderator",$WPuser->roles) || in_array("community_moderator",$WPuser->roles)) {
			$perms = "editor";
			$editor_hash = md5($user_login .$timecode . $editorSalt);
		}
	}
	if ($user_login == "admin") {
		$perms = "editor";
		$editor_hash = md5($user_login .$timecode . $editorSalt);
	}
	if(isset($WPuser->display_name)){
		$display_name = $WPuser->display_name;
	}

	$user = array(
		"username" => $user_login,
		"user_id" => $userID,
		"userhash" => $userhash,
		"gravatar_hash" => md5($user_email),
		"timecode" => $timecode,
		"timecode_hash" => $timecode_hash,
		"display_name" => $display_name,
		"facebook_id" => $facebookID,
		"default_state" => $state,
		"perms" => $perms,
		"editor_hash" => $editor_hash,
		"user_timecode_hash" => $user_timecode_hash,
	);

	return $user;
}


//ADD XML RPC FILTERS FOR SENDING USERS the AUTH HASH
add_filter('xmlrpc_methods', 'imo_xmlrpc_methods');
function imo_xmlrpc_methods($methods)
{
	$methods['imo.auth'] = 'imo_auth_user';
	return $methods;
}

function imo_auth_user($args){

// Parse the arguments, assuming they're in the correct order
	$username	= $args[0];
	$password	= $args[1];
	//$data = $args[2];


	global $wp_xmlrpc_server;

	// Let's run a check to see if credentials are okay
	if ( !$user = $wp_xmlrpc_server->login($username, $password) ) {
		return $wp_xmlrpc_server->error;
	} else {

		$userData = imo_get_user($user->ID);
		//print_r($user['data']['user_login']);
		//$userHashes = imo_get_user($user['data']['user_login'],$user['data']['ID'],$user['data']['user_email']);

		header ("Content-Type:text/xml");

		return $userData;
	}


}





