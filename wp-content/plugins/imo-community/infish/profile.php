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

$apiURL = "http://$hostname/community-api/users/$username?get_comments=1";

$file = file_get_contents($apiURL);

//SET TEMPLATE VARIABLES
$data = json_decode($file);

//get post user email

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


?>

<div id="primary" class="general general-com" role="main">
            <div class="profile-title clearfix">
                <h1>Community Profile</h1>
                <img src="<?php echo plugins_url('images/fishhead.png' , __FILE__ ); ?>" alt="" class="profile-logo" />
            </div>
            <div class="profile-data-box">
                <div class="thumb-col">
                    <img src="<?php echo plugins_url('images/master-angler.png' , __FILE__ ); ?>" alt="" />
                </div>
                <div class="user-col">
                    <h2><?php echo $data->display_name; ?></h2>
                    <div class="profile-panel clearfix">
                        <div class="profile-photo">
                            <a><img alt="" src="/avatar?uid=<?php echo $data->ID; ?>"></a>
                        </div>
                        <?php if($data->city != null || $data->state != null ){ ?>
                        <div class="profile-data">
                            <div class="user-from">
                                From: <br />
                                <span class="location"><?php echo $data->city; ?>, <?php echo $data->state; ?></span>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="points-col">
                	<?php 
                	if($data->score == 1){
							$niceScore = '<strong class="points-nb">'.$data->score.'</strong><br />Point';
						}else{
							$niceScore = '<strong class="points-nb">'.$data->score.'</strong><br />Points';
						} 
					?>
                    <?php echo $niceScore; ?>
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
                <h2><?php echo $data->display_name; ?>'s  <span>Activity</span></h2>
            </div>
            <div class="profile-tabs">
                <ul class="tabs">
                    <li><a href="#activity">Recent Activity</a></li>
                    <li><a href="#replies">Replies  (<span><?php echo count($data->comments); ?></span>)</a></li>
                </ul>
                <div id="activity" class="tab-content">
                    <div class="dif-posts">
                        <?php 
                        $posts = $data->posts;
                        
                        foreach($posts as $post){ 
	                       	if($post->score == 1){
								$niceScore = $post->score.' Point';
							}else{
								$niceScore = $post->score.' Points';
							}
							
							if($post->comment_count == 1){
								$niceComment = $post->comment_count.' Comment';
							}else{
								$niceComment = $post->comment_count.' Comments';
							}
							
								if($post->img_url){ 
							?>
                        
		                        <div class="dif-post">
		                            <div class="feat-img">
		                                <a href="/photos/<?php echo $post->id; ?>"><img class="feat-img" src="<?php echo $post->img_url; ?>" alt="<?php echo $post->title; ?>" title="<?php echo $post->title; ?>" /></a>
		                            </div>
		                            <div class="dif-post-text">
		                                <h3><a href="/photos/<?php echo $post->id; ?>"><?php echo $post->title; ?></a></h3>
		                                <div class="profile-panel">
		                                    <div class="profile-photo">
		                                        <a href="/profile/<?php echo $post->username; ?>"><img src="/avatar?uid=<?php echo $data->ID; ?>" alt="<?php echo $post->display_name; ?>" title="<?php echo $post->display_name; ?>" /></a>
		                                    </div>
		                                    <div class="profile-data">
		                                        <h4><a href="/photos/<?php echo $post->id; ?>"></a></h4>
		                                        <ul class="prof-tags">
		                                            <li><a href="<?php echo $post->state; ?>"><?php echo $post->state; ?></a></li>
		                                            <li><a href="<?php echo $post->post_type; ?>"><?php echo $post->post_type; ?></a></li>
		                                            <li><a href="#">Master Angler</a></li>
		                                        </ul>
		                                        <ul class="replies">
		                                            <li><a href="/photos/<?php echo $post->id; ?>/#reply_field"><?php echo $niceComment; ?></a></li>
		                                            <li><?php echo $niceScore; ?></li>
		                                        </ul>
											</div>
		                                </div>
		                                <span class="badge"><img src="<?php echo plugins_url('images/badge-ma.png' , __FILE__ ); ?>" alt="" /></span>
		                            </div>
		                        </div>
                        <?php } } ?>
                    </div>
                    <div class="pager-holder js-responsive-section" data-position="5">
                        <a class="btn-base" href="#">Load More</a>
                        <a class="go-top jq-go-top" href="#">go top</a>
                    </div>
                </div>
                <div id="replies" class="tab-content">
                    <ul class="simple-replies">
                    	<?php 
                        $comments = $data->comments;
                        
                        foreach($comments as $comment){ $spid =  $comment->parent; }
                        
                        // Let's not run this a million times.
                        $replyURL = "http://$hostname/community-api/posts/$spid?get_comments=1";
						$replyFile = file_get_contents($replyURL);
						//SET TEMPLATE VARIABLES
						$replyData = json_decode($replyFile);

                        foreach($comments as $comment){  ?>
                        	<li class="reply-item">
	                            <p><?php echo $comment->body; ?></p>
	                            <div class="replies-data-line">
	                                Replied To <a href="<?php echo $replyData->url; ?>"><?php echo $replyData->title; ?></a> In <a href="<?php echo $replyData->url; ?>"><?php echo $replyData->post_type; ?></a>   |   <abbr class="recon-date timeago" title="<?php echo $comment->created; ?>"></abbr>
	                            </div>
	                        </li>
                        <?php } ?>
					</ul>
                </div>
            </div>
			<?php social_footer(); ?>
			<div class="hr mobile-hr"></div>
			<a href="#" class="back-top jq-go-top">back to top</a>       
    </div><!-- #primary -->


<?php get_footer(); ?>
