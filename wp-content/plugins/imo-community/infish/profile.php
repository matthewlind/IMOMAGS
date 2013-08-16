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

$spid =  get_query_var("spid");

$apiURL = "http://$hostname/community-api/users/$spid?get_comments=1";

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



<div id="primary" class="general general-com" role="main">
        
            <div class="profile-title clearfix">
                <h1>COmmunity Profile</h1>
                <img src="<?php bloginfo( 'template_url' ); ?>/images/logos/fishhead.png" alt="" class="profile-logo" />
            </div>
            <div class="profile-data-box">
                <div class="thumb-col">
                    <img src="<?php bloginfo( 'template_url' ); ?>/images/logos/master-angler.png" alt="" />
                </div>
                <div class="user-col">
                    <h2>Rusty Bender</h2>
                    <div class="profile-panel clearfix">
                        <div class="profile-photo">
                            <a href="#"><img alt="" src="<?php bloginfo( 'template_url' ); ?>/images/pic/rud.jpg"></a>
                        </div>
                        <div class="profile-data">
                            <div class="user-from">
                                From: <br />
                                <span class="location">Martin, MI</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="points-col">
                    <strong class="points-nb">57</strong><br />points
                </div>
            </div>
            <div class="profile-btn-panel">
                <h3>Master Angler Achievements</h3>
                <ul class="profile-btns">
                    <li><a href="#"><span>Spotted bass</span></a></li>
                    <li><a href="#"><span>Wipper</span></a></li>
                    <li><a href="#"><span>Largemouth</span></a></li>
                    <li><a href="#"><span>Smallmouth</span></a></li>
                </ul>
            </div>
            <div class="general-title clearfix">
                <h2>Rusty Bender?s  <span>Activity</span></h2>
            </div>
            <div class="profile-tabs">
                <ul class="tabs">
                    <li><a href="#activity">Recent Activity</a></li>
                    <li><a href="#replies">Replies  (<span>11</span>)</a></li>
                </ul>
                <div id="activity" class="tab-content">
                    <div class="dif-posts">
                        <div class="dif-post">
                            <div class="feat-img">
                                <a href="#"><img class="feat-img" src="<?php bloginfo( 'template_url' ); ?>/images/pic/pic1.jpg" alt="" /></a>
                            </div>
                            <div class="dif-post-text">
                                <h3><a href="#">What should it score?</a></h3>
                                <div class="profile-panel">
                                    <div class="profile-photo">
                                        <a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/pic/rud.jpg" alt="" /></a>
                                    </div>
                                    <div class="profile-data">
                                        <h4><a href="#">Hunter Rud</a></h4>
                                        <ul class="prof-tags">
                                            <li><a href="#">North Carolina</a></li>
                                            <li><a href="#">Smallmout</a></li>
                                            <li><a href="#">Master Angler</a></li>
                                        </ul>
                                        <ul class="replies">
                                            <li><a href="#">9 Reply</a></li>
                                            <li>9 Point</li>
                                        </ul>
                                        <ul class="prof-like">
                                            <li><img src="<?php bloginfo( 'template_url' ); ?>/images/btn/fb-like.png" alt="" /></li>
                                        </ul>
                                    </div>
                                </div>
                                <span class="badge"><img src="<?php bloginfo( 'template_url' ); ?>/images/pic/badge-ma.png" alt="" /></span>
                            </div>
                        </div>
                        <div class="dif-post">
                            <div class="feat-img">
                                <a href="#"><img class="feat-img" src="<?php bloginfo( 'template_url' ); ?>/images/pic/pic2.jpg" alt="" /></a>
                            </div>
                            <div class="dif-post-text">
                                <h3><a href="#">Quest for Florida Giants</a></h3>
                                <div class="profile-panel">
                                    <div class="profile-photo">
                                        <a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/pic/rud.jpg" alt="" /></a>
                                    </div>
                                    <div class="profile-data">
                                        <h4><a href="#">Hunter Rud</a></h4>
                                        <ul class="prof-tags">
                                            <li><a href="#">North Carolina</a></li>
                                            <li><a href="#">Smallmout</a></li>
                                            <li><a href="#">Master Angler</a></li>
                                        </ul>
                                        <ul class="replies">
                                            <li><a href="#">9 Reply</a></li>
                                            <li>9 Point</li>
                                        </ul>
                                        <ul class="prof-like">
                                            <li><img src="<?php bloginfo( 'template_url' ); ?>/images/btn/fb-like.png" alt="" /></li>
                                        </ul>
                                    </div>
                                </div>
                                <span class="badge"><img src="<?php bloginfo( 'template_url' ); ?>/images/pic/badge-ma.png" alt="" /></span>
                            </div>
                        </div>
                        <div class="dif-post">
                            <div class="feat-img">
                                <a href="#"><img class="feat-img" src="<?php bloginfo( 'template_url' ); ?>/images/pic/pic3.jpg" alt="" /></a>
                            </div>
                            <div class="dif-post-text">
                                <h3><a href="#">What should it score?</a></h3>
                                <div class="profile-panel">
                                    <div class="profile-photo">
                                        <a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/pic/rud.jpg" alt="" /></a>
                                    </div>
                                    <div class="profile-data">
                                        <h4><a href="#">Hunter Rud</a></h4>
                                        <ul class="prof-tags">
                                            <li><a href="#">North Carolina</a></li>
                                            <li><a href="#">Smallmout</a></li>
                                            <li><a href="#">Master Angler</a></li>
                                        </ul>
                                        <ul class="replies">
                                            <li><a href="#">9 Reply</a></li>
                                            <li>9 Point</li>
                                        </ul>
                                        <ul class="prof-like">
                                            <li><img src="<?php bloginfo( 'template_url' ); ?>/images/btn/fb-like.png" alt="" /></li>
                                        </ul>
                                    </div>
                                </div>
                                <span class="badge"><img src="<?php bloginfo( 'template_url' ); ?>/images/pic/badge-ma.png" alt="" /></span>
                            </div>
                        </div>
                        <div class="dif-post">
                            <div class="feat-img">
                                <a href="#"><img class="feat-img" src="<?php bloginfo( 'template_url' ); ?>/images/pic/pic4.jpg" alt="" /></a>
                            </div>
                            <div class="dif-post-text">
                                <h3><a href="#">Quest for Florida Giants</a></h3>
                                <div class="profile-panel">
                                    <div class="profile-photo">
                                        <a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/pic/rud.jpg" alt="" /></a>
                                    </div>
                                    <div class="profile-data">
                                        <h4><a href="#">Hunter Rud</a></h4>
                                        <ul class="prof-tags">
                                            <li><a href="#">North Carolina</a></li>
                                            <li><a href="#">Smallmout</a></li>
                                            <li><a href="#">Master Angler</a></li>
                                        </ul>
                                        <ul class="replies">
                                            <li><a href="#">9 Reply</a></li>
                                            <li>9 Point</li>
                                        </ul>
                                        <ul class="prof-like">
                                            <li><img src="<?php bloginfo( 'template_url' ); ?>/images/btn/fb-like.png" alt="" /></li>
                                        </ul>
                                    </div>
                                </div>
                                <span class="badge"><img src="<?php bloginfo( 'template_url' ); ?>/images/pic/badge-ma.png" alt="" /></span>
                            </div>
                        </div>
                        <div class="content-banner-section">
                            <a href="#"><img alt="" src="<?php bloginfo( 'template_url' ); ?>/images/pic/imitates-injured.jpg"></a>
                        </div>
                        <div class="dif-post">
                            <div class="feat-img">
                                <a href="#"><img class="feat-img" src="<?php bloginfo( 'template_url' ); ?>/images/pic/pic1.jpg" alt="" /></a>
                            </div>
                            <div class="dif-post-text">
                                <h3><a href="#">What should it score?</a></h3>
                                <div class="profile-panel">
                                    <div class="profile-photo">
                                        <a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/pic/rud.jpg" alt="" /></a>
                                    </div>
                                    <div class="profile-data">
                                        <h4><a href="#">Hunter Rud</a></h4>
                                        <ul class="prof-tags">
                                            <li><a href="#">North Carolina</a></li>
                                            <li><a href="#">Smallmout</a></li>
                                            <li><a href="#">Master Angler</a></li>
                                        </ul>
                                        <ul class="replies">
                                            <li><a href="#">9 Reply</a></li>
                                            <li>9 Point</li>
                                        </ul>
                                        <ul class="prof-like">
                                            <li><img src="<?php bloginfo( 'template_url' ); ?>/images/btn/fb-like.png" alt="" /></li>
                                        </ul>
                                    </div>
                                </div>
                                <span class="badge"><img src="<?php bloginfo( 'template_url' ); ?>/images/pic/badge-ma.png" alt="" /></span>
                            </div>
                        </div>
                        <div class="dif-post">
                            <div class="feat-img">
                                <a href="#"><img class="feat-img" src="<?php bloginfo( 'template_url' ); ?>/images/pic/pic2.jpg" alt="" /></a>
                            </div>
                            <div class="dif-post-text">
                                <h3><a href="#">Quest for Florida Giants</a></h3>
                                <div class="profile-panel">
                                    <div class="profile-photo">
                                        <a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/pic/rud.jpg" alt="" /></a>
                                    </div>
                                    <div class="profile-data">
                                        <h4><a href="#">Hunter Rud</a></h4>
                                        <ul class="prof-tags">
                                            <li><a href="#">North Carolina</a></li>
                                            <li><a href="#">Smallmout</a></li>
                                            <li><a href="#">Master Angler</a></li>
                                        </ul>
                                        <ul class="replies">
                                            <li><a href="#">9 Reply</a></li>
                                            <li>9 Point</li>
                                        </ul>
                                        <ul class="prof-like">
                                            <li><img src="<?php bloginfo( 'template_url' ); ?>/images/btn/fb-like.png" alt="" /></li>
                                        </ul>
                                    </div>
                                </div>
                                <span class="badge"><img src="<?php bloginfo( 'template_url' ); ?>/images/pic/badge-ma.png" alt="" /></span>
                            </div>
                        </div>
                        <div class="content-banner-section">
                            <a href="#"><img alt="" src="<?php bloginfo( 'template_url' ); ?>/images/pic/banner-evinrude.jpg"></a>
                        </div>
                        <div class="dif-post">
                            <div class="feat-img">
                                <a href="#"><img class="feat-img" src="<?php bloginfo( 'template_url' ); ?>/images/pic/pic3.jpg" alt="" /></a>
                            </div>
                            <div class="dif-post-text">
                                <h3><a href="#">What should it score?</a></h3>
                                <div class="profile-panel">
                                    <div class="profile-photo">
                                        <a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/pic/rud.jpg" alt="" /></a>
                                    </div>
                                    <div class="profile-data">
                                        <h4><a href="#">Hunter Rud</a></h4>
                                        <ul class="prof-tags">
                                            <li><a href="#">North Carolina</a></li>
                                            <li><a href="#">Smallmout</a></li>
                                            <li><a href="#">Master Angler</a></li>
                                        </ul>
                                        <ul class="replies">
                                            <li><a href="#">9 Reply</a></li>
                                            <li>9 Point</li>
                                        </ul>
                                        <ul class="prof-like">
                                            <li><img src="<?php bloginfo( 'template_url' ); ?>/images/btn/fb-like.png" alt="" /></li>
                                        </ul>
                                    </div>
                                </div>
                                <span class="badge"><img src="<?php bloginfo( 'template_url' ); ?>/images/pic/badge-ma.png" alt="" /></span>
                            </div>
                        </div>
                        <div class="dif-post">
                            <div class="feat-img">
                                <a href="#"><img class="feat-img" src="<?php bloginfo( 'template_url' ); ?>/images/pic/pic4.jpg" alt="" /></a>
                            </div>
                            <div class="dif-post-text">
                                <h3><a href="#">Quest for Florida Giants</a></h3>
                                <div class="profile-panel">
                                    <div class="profile-photo">
                                        <a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/pic/rud.jpg" alt="" /></a>
                                    </div>
                                    <div class="profile-data">
                                        <h4><a href="#">Hunter Rud</a></h4>
                                        <ul class="prof-tags">
                                            <li><a href="#">North Carolina</a></li>
                                            <li><a href="#">Smallmout</a></li>
                                            <li><a href="#">Master Angler</a></li>
                                        </ul>
                                        <ul class="replies">
                                            <li><a href="#">9 Reply</a></li>
                                            <li>9 Point</li>
                                        </ul>
                                        <ul class="prof-like">
                                            <li><img src="<?php bloginfo( 'template_url' ); ?>/images/btn/fb-like.png" alt="" /></li>
                                        </ul>
                                    </div>
                                </div>
                                <span class="badge"><img src="<?php bloginfo( 'template_url' ); ?>/images/pic/badge-ma.png" alt="" /></span>
                            </div>
                        </div>
                    </div>
                    <div class="pager-holder js-responsive-section" data-position="5">
                        <a class="btn-base" href="#">Load More</a>
                        <a class="go-top jq-go-top" href="#">go top</a>
                    </div>
                </div>
                <div id="replies" class="tab-content">
                    <ul class="simple-replies">
                        <li class="reply-item">
                            <p>Yup. That's him. He's bulked up a bit since then. Don't think there's any question about it now.</p>
                            <div class="replies-data-line">
                                Replied To <a href="#">STUD</a>!! In <a href="#">Rut Reports</a>   |   3 Days Ago
                            </div>
                        </li>
                        <li class="reply-item even">
                            <p>Corn mixed with vita rack. Just on ground</p>
                            <div class="replies-data-line">
                                Replied To <a href="#">STUD</a>!! In <a href="#">Rut Reports</a>   |   3 Days Ago
                            </div>
                        </li>
                        <li class="reply-item">
                            <p>Good point Sean. The surrounding land owners do practice QDM, but my worries are the poachers that are shooting the bucks at night. Every year the DNR is out in...</p>
                            <div class="replies-data-line">
                                Replied To <a href="#">STUD</a>!! In <a href="#">Rut Reports</a>   |   3 Days Ago
                            </div>
                        </li>
                        <li class="reply-item even">
                            <p>Between ticks and bitting flies, you'll see this on a lot of deer this time of year.</p>
                            <div class="replies-data-line">
                                Replied To <a href="#">Is This A Disease Or Skin Abnormality?</a> In <a href="#">Q&A</a>    |   3 Days Ago
                            </div>
                        </li>
                        <li class="reply-item">
                            <p>Yup. That's him. He's bulked up a bit since then. Don't think there's any question about it now.</p>
                            <div class="replies-data-line">
                                Replied To <a href="#">STUD</a>!! In <a href="#">Rut Reports</a>   |   3 Days Ago
                            </div>
                        </li>
                        <li class="reply-item even">
                            <p>Corn mixed with vita rack. Just on ground</p>
                            <div class="replies-data-line">
                                Replied To <a href="#">STUD</a>!! In <a href="#">Rut Reports</a>   |   3 Days Ago
                            </div>
                        </li>
                        <li class="reply-item">
                            <p>Good point Sean. The surrounding land owners do practice QDM, but my worries are the poachers that are shooting the bucks at night. Every year the DNR is out in...</p>
                            <div class="replies-data-line">
                                Replied To <a href="#">STUD</a>!! In <a href="#">Rut Reports</a>   |   3 Days Ago
                            </div>
                        </li>
                        <li class="reply-item even">
                            <p>Between ticks and bitting flies, you'll see this on a lot of deer this time of year.</p>
                            <div class="replies-data-line">
                                 Replied To <a href="#">Is This A Disease Or Skin Abnormality?</a> In <a href="#">Q&A</a>   |   3 Days Ago
                            </div>
                        </li>
                        <li class="reply-item">
                            <p>Between ticks and bitting flies, you'll see this on a lot of deer this time of year.</p>
                            <div class="replies-data-line">
                                 Replied To <a href="#">Is This A Disease Or Skin Abnormality?</a> In <a href="#">Q&A</a>   |   3 Days Ago
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="foot-social clearfix">
                <strong class="social-title">Like us on Facebook to <span>stay updated !</span></strong>
                <div class="fb-like" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
                <div class="socials">
                    <a href="#" class="facebook">Facebook</a>
                    <a href="#" class="twitter">Twitter</a>
                    <a href="#" class="youtube">YouTube</a>
                    <a href="#" class="rss">RSS</a>
                </div>
            </div>
       
    </div><!-- #primary -->


<?php get_footer(); ?>
