<?php

/**
 * Template Name: User Profile Edit
 * Description: Displays the edit form for the user
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

//$avatar = get_avatar($user->ID,140);

if ($user)
	$userString = "username='$username'";


$avatar = "/avatar?uid=".$user->ID;
//$userPosts = 'http://www.northamericanwhitetail.fox/slim/api/superpost/user/posts/'.$user->ID;
		
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
</div>
<div class="col-abc">
	<header class="header-title">
	
	<div id="user-bar" class="edit">
		
	</div>
	<h1>Community Profile</h1>
	 <div class="community-crumbs">
       		<a href="/community">Community Home</a> &raquo; Edit Profile
		</div>

	</header>
	
	<?php the_content(__('Continued&hellip;', 'carrington-business')); ?>

</div><!-- .col-abc -->
<div class="clearfix"></div>
<?php get_footer(); ?>
<?php //print_r($user_meta); ?>)
