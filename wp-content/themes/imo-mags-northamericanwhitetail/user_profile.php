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
 print_r($user);

//$avatar = get_avatar($user->ID,140);

if ($user)
	$userString = "username='$username'";

$avatar = "http://www.northamericanwhitetail.fox/avatar?uid=".$user->ID;
$userPosts = 'http://www.northamericanwhitetail.fox/api/superpost/user/posts/'.$user->ID;
var_dump($userPosts);
?>
<header class="header-title">
	<h1><a href="/community/">Community</a> / Your Profile</h1>
	<?php edit_post_link(__('Edit', 'carrington-business')); ?>
    <?php //echo $requestURL; ?>
</header>
<div class="col-abc">
	<div <?php post_class('entry entry-full clearfix'); ?>>
		<div class="entry-content">
			<div class="user-header">
	           
	            <div class="user-info">
	            	<div class="user-thumbnail"><?php echo '<img src="'.$avatar.'" alt="User Avatar" />'; ?></div>
	            	<ul class="details">
	            		<li><h3><?php echo $user->display_name; ?></h3></li>
	            		<li class="hometown"><a href="#">Gotham City</a></li>
	            		<li class="twitter"><a href="#">@batman</a></li>
	            		<!--<li class="www"><a href="#">dccomics.com/batman</a></li>-->
	            	</ul>
	            </div>
	            
	            <div class="extras">
		    		<div class="score-box">
		    			<h2 class="user-points">392</h2> 
		    			<p>Points</p>
		    		</div>
		    	</div>
		    	
	    	</div>
	        <h3 class="first-last-name"><?php echo $user->display_name; ?>'s Activity</h3>
	        
			<ul class="post-type-select">
            	<li id="new-post-button" class="post"><span>+</span> Post</li>
                <li class='selected' title='all'>ALL</li>
                <li title='report'>Reports</li>
                <li title='tip'>Tips</li>
                <li title='lifestyle'>LifeStyles</li>
                <li title='trophy'>Trophy Bucks</li>
                <li title='gear'>Gear</li>
                <li class="dd-arrow"></li>


            </ul>   
<!-- 			<div id="recon-activity" <?php echo $userString;?> >


            </div> -->
            <div class="cross-site-feed-more-button"> <div class="more-button"><span>LOAD MORE<span></span></span></div> </div>
		</div>
	</div><!-- .entry -->
</div><!-- .col-abc -->
<?php get_footer(); ?>
