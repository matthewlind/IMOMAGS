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


add_action("init","imo_user_set");


function imo_user_hash($id,$username){


}


function imo_user_set() {

	$salt = "jYSe38xE3:lfsbEV2u.nUB^?80AXr3<%_VA4!)cfX.z";

	global $user_login;
	global $user_ID;
	global $user_email;

	$userhash = md5($user_login . $salt);

	$user = array(
		"username" => $user_login,
		"user_id" => $user_ID,
		"userhash" => $userhash,
		"gravatar_hash" => md5($user_email)
	);

	// send the user variables to the javascript
	wp_enqueue_script( 'imo-user-auth', plugin_dir_url( __FILE__ ) . 'imo-user-auth.js', array( 'jquery' ) );
	wp_localize_script( 'imo-user-auth', 'userIMO', $user);


}




