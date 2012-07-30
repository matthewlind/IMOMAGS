<?php
/*  Copyright 2012 Aaron Baker*/
/*
Plugin Name: IMO User Auth
Plugin URI: http://imomags.com
Description: Adds network-wide authentication services to IMOMags.
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

	$user = imo_get_user();

	// send the user variables to the javascript
	wp_enqueue_script( 'imo-user-auth', plugin_dir_url( __FILE__ ) . 'imo-user-auth.js', array( 'jquery' ) );
	wp_localize_script( 'imo-user-auth', 'userIMO', $user);


}

function imo_get_user() {

	$salt = "jYSe38xE3:lfsbEV2u.nUB^?80AXr3<%_VA4!)cfX.z";
	
	$timecode = time();
	
	global $user_email;
	global $user_login;
	global $user_ID;

	$userhash = md5($user_login . $salt);
	$timecode_hash = md5($timecode . $salt);

	$user = array(
		"username" => $user_login,
		"user_id" => $user_ID,
		"userhash" => $userhash,
		"gravatar_hash" => md5($user_email),
		"timecode" => $timecode,
		"timecode_hash" => $timecode_hash
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
		$salt = "jYSe38xE3:lfsbEV2u.nUB^?80AXr3<%_VA4!)cfX.z";
		
		$timecode = time();
	
		$userhash = md5($user->data->user_login . $salt);
		$timecode_hash = md5($timecode . $salt);
		
		$user_email = $user->data->user_email;
	
		$userData = array(
			"userhash" => $userhash,
			"gravatar_hash" => md5($user_email),
			"timecode" => $timecode,
			"timecode_hash" => $timecode_hash,
			"user_nicename" => $user->data->user_nicename,
			"user_login" => $user->data->user_login,
			"user_ID" => $user->data->ID,
		);
	
		//print_r($user['data']['user_login']);
		//$userHashes = imo_get_user($user['data']['user_login'],$user['data']['ID'],$user['data']['user_email']);
	
		header ("Content-Type:text/xml");  
		
		return $userData;
	}
	
	
}





