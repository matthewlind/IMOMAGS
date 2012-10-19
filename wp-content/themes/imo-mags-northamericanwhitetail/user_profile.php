<?php

/**
 * Template Name: User Profile
 * Description: Displays a single user
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
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();

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
<div class="bonus-background">
	<div class="bonus">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('superpost-sidebar')) : else : ?><?php endif; ?>
	</div>
	<div id="responderfollow"></div>
	<div class="sidebar advert">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : ?><?php endif; ?>
	</div>
</div>
<div class="col-abc">
	<header class="header-title">
	<ul id="user-bar" style="<?php echo $displayStyle; ?>">	          
		<?php if($current_user->display_name == $user->display_name){ echo '<li><a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout">Logout</a></li>'; } ?>                    
	</ul>
		<h1>Community Profile</h1>
		 <div class="community-crumbs">
       		<a href="/community">Community Home</a> &raquo; <?php if($current_user->display_name == $user->display_name){ echo 'Your Profile'; }else{ echo $user->display_name;} ?>
		</div>
	</header>

	<div <?php post_class('entry entry-full clearfix'); ?>>
		<div class="entry-content">
			<div class="user-header">
	           
	            <div class="user-info">
	            	<h3><?php echo $user->display_name; ?></h3>
	            	<div class="user-thumbnail"><?php echo '<img src="'.$avatar.'" alt="User Avatar" class="recon-gravatar" />'; ?></div>
	            	<ul class="details">
	            	
	            	
	            	<?php
	            	//if logged in and no user meta
	            	if ($current_user->display_name == $user->display_name){
		            	//if ($twitter == ""){ 
		            		//echo '<li class="twitter"><a href="/login/?action=profile" class="update">Update Your Twitter</a></li>';
		            	//} 
		            	if ($city == "" && $state == ""){ 
		            		echo '<li class="hometown"><a href="/login/?action=profile" class="update">Update Your Hometown</a></li>';
		            	}
		            	
		            	 //if looking at your own profile and meta exists
	            		//if ($twitter != ""){
	            			//echo '<li class="twitter"><a href="http://twitter.com/'.$twitter.'" class="twitter">'.$twitter.'</a></li>';
	            		//}
	            		if ($city != "" || $state != ""){ 
	            			echo '<li class="hometown"><span>'.$city;
	            				if ($state != ""){ echo '<span>, '.$state.'</span></span></li>'; }
	            		} 

		            	
		            }else{ 
			            //if looking at another user and no meta
	            		//if ($twitter != ""){
	            			//echo '<li class="twitter"><a href="http://twitter.com/'.$twitter.'" class="twitter">'.$twitter.'</a></li>';
	            		//}
	            		if ($city != "" || $state != ""){ 
	            			echo '<li class="hometown"><span>'.$city.', '.$state.'</span></li>';
	            		} 
	            	} 
	            	?>
	            		
	            	</ul>
	            </div>
	            
	            <div class="extras">
		    		<div class="score-box">
		    			<h2 class="user-points-profile">0</h2> 
		    			<p>Points</p>		    		
		    		</div>
		    		<?php if($current_user->display_name == $user->display_name){ ?>
		    		<ul class="post-type-select">
	            		<li class="post new-post-button"><a href="/community-post"><span>+</span> Create New Post</a></li>
			    	</ul>
			    	<?php } ?>
		    	</div>
	    	</div>
	    </div>
	</div><!-- .entry -->
</div><!-- .col-abc -->
<div class="col-abc">
    <h3 class="first-last-name"><?php echo $user->display_name; ?>'s Activity</h3>
            
    <ul class="post-type-select">
        <li class="user-profile recent selected" display="recent" user="<?php echo $user->ID; ?>">Recent Activity</li>
        <li class="user-profile" display="comments" user="<?php echo $user->ID; ?>">Replies</li>
    </ul>    
    
    <div id="no-activity" style="display:none;">
    	<p>No Activity.</p>
    </div>
    
    <div id="user-activity" user="<?php echo $user->ID; ?>">


    </div>
    <!--<div class="cross-site-feed-more-button"> <div class="more-button"><span>LOAD MORE<span></span></span></div> </div>-->
</div><!-- .col-abc -->
<div class="clearfix"></div>
<?php get_footer(); ?>
<?php //print_r($user_meta); ?>)
