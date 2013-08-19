<?php

/**
 * Template Name: Profile
 * Description: Community Profile page
 *
 * @package carrington-business
 *
 * This file is part of the Carrington Business Theme for WordPress
 * http://crowdfavorite.com/wordpress/themes/carrington-business/
 *
 * Copyright (c) 2008-2011 Crowd Favorite, Ltd. All rights reserved.
 * http://crowdfavorite.com
 *
 * **********************************************************************
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * **********************************************************************
 */
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }


get_header();
imo_sidebar("community");

$hostname = $_SERVER['SERVER_NAME'];

$username = get_query_var("username");
var_dump($username);
$apiURL = "http://$hostname/community-api/users/$username?get_comments=1";

$file = file_get_contents($apiURL);

//SET TEMPLATE VARIABLES
$data = json_decode($file);
$attachmentData = $data->attachments;
$commentData = $data->comments;



if (empty($commentData)) {


    $visible = " style='display:none;'";
}



$grav_url = "http://www.gravatar.com/avatar/" . $data->gravatar_hash . ".jpg?s=50&d=identicon";

$headerTitle = $data->post_type . ": " . $data->title;

// get the score of the post's author
$requestURL4 = "http://$hostname/slim/api/superpost/user/score/".$data->user_id;
$file4 = file_get_contents($requestURL4);
$post_user_score = json_decode($file4);
$post_user_score = $post_user_score[0];


if (empty($data->display_name)) {
	$data->display_name = $data->username;
}

//get post user email

$postUserData = get_userdata( $data->user_id );
$postUserEmail = $postUserData->user_email;

// Topic nice names
if($data->post_type == "trophy"){
	$topicName = 'Trophy Bucks';
}else if($data->post_type == "general"){
	$topicName = 'General Discussion';
}else if($data->post_type == "report"){
	$topicName = 'Rut Reports';
}else{
	$topicName = $data->post_type;
}
$state_slug = $data->state;

// convert some slugs
$stateSlugToAbbv = array("AL"=>"Alabama",
"AK"=>"Alaska",
"AZ"=>"Arizona",
"AR"=>"Arkansas",
"CA"=>"California",
"CO"=>"Colorado",
"CT"=>"Connecticut",
"DE"=>"Delaware",
"DC"=>"District Of Columbia",
"FL"=>"Florida",
"GA"=>"Georgia",
"HI"=>"Hawaii",
"ID"=>"Idaho",
"IL"=>"Illinois",
"IN"=>"Indiana",
"IA"=>"Iowa",
"KS"=>"Kansas",
"KY"=>"Kentucky",
"LA"=>"Louisiana",
"ME"=>"Maine",
"MD"=>"Maryland",
"MA"=>"Massachusetts",
"MI"=>"Michigan",
"MN"=>"Minnesota",
"MS"=>"Mississippi",
"MO"=>"Missouri",
"MT"=>"Montana",
"NE"=>"Nebraska",
"NV"=>"Nevada",
"NH"=>"New Hampshire",
"NJ"=>"New Jersey",
"NM"=>"New Mexico",
"NY"=>"New York",
"NC"=>"North Carolina",
"ND"=>"North Dakota",
"OH"=>"Ohio",
"OK"=>"Oklahoma",
"OR"=>"Oregon",
"PA"=>"Pennsylvania",
"RI"=>"Rhode Island",
"SC"=>"South Carolina",
"SD"=>"South Dakota",
"TN"=>"Tennessee",
"TX"=>"Texas",
"UT"=>"Utah",
"VT"=>"Vermont",
"VA"=>"Virginia",
"WA"=>"Washington",
"WV"=>"West Virginia",
"WI"=>"Wisconsin",
"WY"=>"Wyoming",
"AB"=>"Alberta",
"BC"=>"British Columbia",
"MB"=>"Manitoba",
"NB"=>"New Brunswick",
"NL"=>"Newfoundland and Labrador",
"NT"=>"Northwest Territories",
"NS"=>"Nova Scotia",
"NU"=>"Nunavut",
"ON"=>"Ontario",
"PE"=>"Prince Edward Island",
"QC"=>"Quebec",
"SK"=>"Saskatchewan",
"YT"=>"Yukon");

$state = $stateSlugToAbbv[$state_slug];

if ($state == 'New York'){
	$state_slug = 'new-york';
}else if ($state == 'Rhode Island'){
	$state_slug = 'rhode-island';
}else if ($state == 'South Carolina'){
	$state_slug = 'south-carolina';
}else if ($state == 'South Dakota'){
	$state_slug = 'south-dakota';
}else if ($state == 'New Hampshire'){
	$state_slug = 'new-hampshire';
}else if ($state == 'New Jersey'){
	$state_slug = 'new-jersey';
}else if ($state == 'New Mexico'){
	$state_slug = 'new-mexico';
}else if ($state == 'North Carolina'){
	$state_slug = 'north-carolina';
}else if ($state == 'North Dakota'){
	$state_slug = 'north-dakota';
}else if ($state == 'New Brunswick'){
	$state_slug = 'new-brunswick';
}else if ($state == 'Newfoundland and Labrador'){
	$state_slug = 'newfoundland-and-labrador';
}else if ($state == 'Northwest Territories'){
	$state_slug = 'northwest-territories';
}else if ($state == 'Nova Scotia'){
	$state_slug = 'nova-scotia';
}else if ($state == 'Prince Edward Island'){
	$state_slug = 'prince-edward-island';
}else{
	$state_slug = $state;
}


if($post_user_score->score == 1){
	$nicePoint = $post_user_score->score.' Point';
}else{
	$nicePoint = $post_user_score->score.' Points';
}

if($data->view_count == 1){
	$niceView = $data->view_count.' View';
}else{
	$niceView = $data->view_count.' Views';
}

if($data->comment_count == 1){
	$niceComment = $data->comment_count.' Comment';
}else{
	$niceComment = $data->comment_count.' Comments';
}

// Get the timestamp
$timestamp = $data->created;

// Convert the timestamp
$date = date("F j, Y", strtotime($timestamp));
$time = date("g:i A", strtotime($timestamp));


$user = get_user_by("slug",$username);

if ($user)
	$userString = "username='$username'";


$avatar = "/avatar?uid=".$user->ID;
		
$displayStyle = "display:none;";
$loginStyle = "";

if ( is_user_logged_in() ) {

	$displayStyle = "";
	$loginStyle = "display:none;";
	
	wp_get_current_user();
	
	$current_user = wp_get_current_user();
    if ( !($current_user instanceof WP_User) )
         return;
}

// user meta
if( $user_meta = get_user_meta( $user->ID ) ) 
    array_map( function( $a ){ return $a[0]; }, get_user_meta( $user->ID ) );
    

$twitter = $user_meta['twitter'][0];
$city = $user_meta['city'][0];
$state = $user_meta['state'][0];

?>



  <div id="primary" class="general">
        <div id="content" class="general-frame" role="main">
            <div class="title-underline">
                <h1>COMMUNITY PROFILE</h1>
            </div>
            <div class="image-banner posts-image-banner">
                <a href="#" class="ui-link"><img alt="" src="<?php bloginfo( 'template_url' ); ?>/images/pic/imitates-injured.jpg"></a>
            </div>
            <div class="form">
                <form action="#">
                    <fieldset>
                        <div class="general-title clearfix">
                            <h2>Profile <span>Info</span></h2>
                        </div>
                        <div class="f-row">
                            <label for="namePublicly">Display name publicly as</label>
                            <div class="f-input">
                                <input id="namePublicly" type="text" />
                            </div>
                        </div>
                        <div class="f-row">
                            <label for="fName">First name</label>
                            <div class="f-input">
                                <input id="fName" type="text" />
                            </div>
                        </div>
                        <div class="f-row">
                            <label for="lName">Last name</label>
                            <div class="f-input">
                                <input id="lName" type="text" />
                            </div>
                        </div>
                        <div class="f-row">
                            <label for="age">Age</label>
                            <div class="f-input">
                                <input id="age" class="input-short" type="text" />
                            </div>
                        </div>
                        <div class="f-row">
                            <label for="address">Address 1</label>
                            <div class="f-input">
                                <input id="address" type="text" />
                            </div>
                        </div>
                        <div class="f-row">
                            <label for="address2">Address 2</label>
                            <div class="f-input">
                                <input id="address2" type="text" />
                            </div>
                        </div>
                        <div class="f-row">
                            <label for="city">City</label>
                            <div class="f-input">
                                <input id="city" type="text" />
                                <div class="form-note">Only your city and state will be shown as your hometown</div>
                            </div>
                        </div>
                        <div class="f-row">
                            <label for="state">State</label>
                            <div class="f-input">
                                <input id="state" class="input-short" type="text" />
                                <div class="row-item">
                                    <label for="zip">ZIP</label>
                                    <input id="zip" class="input-short" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="f-row">
                            <label for="mail">E-mail</label>
                            <div class="f-input">
                                <input id="mail" type="text" />
                                <span class="required">*</span>
                            </div>
                            
                        </div>
                        <div class="f-row">
                            <label for="twitter">Twitter</label>
                            <div class="f-input">
                                <input id="twitter" type="text" />
                            </div>
                        </div>
                        <div class="f-row">
                            <label for="psw">New Password</label>
                            <div class="f-input">
                                <input id="psw" type="password" />
                                <div class="form-note">If you would like to change the password type a new one. Otherwise leave this blank.</div>
                            </div>
                        </div>
                        <div class="f-row">
                            <label for="newPsw">Repeat New Password</label>
                            <div class="f-input">
                                <input id="newPsw" type="password" />
                            </div>
                        </div>
                        <div class="f-row single-row">
                            <div class="f-indicator">Strength indicator</div>
                            <div class="form-note">
                                Hint: The password should be at least seven characters long.
                                To make it stronger, use upper and lower case letters,
                                numbers and symbols like ! " ? $ % ^ & ).
                            </div>
                        </div>
                        <div class="f-row single-row">
                            <span class="btn-red"><input type="submit" value="Update Profile" /></span>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="image-banner posts-image-banner">
                <a href="#" class="ui-link"><img alt="" src="<?php bloginfo( 'template_url' ); ?>/images/pic/banner-evinrude.jpg"></a>
            </div>
        </div><!-- #content -->
    </div><!-- #primary -->


<?php get_footer(); ?>