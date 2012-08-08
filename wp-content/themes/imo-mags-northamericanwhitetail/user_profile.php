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

//$avatar = get_avatar($user->ID,140);

if ($user)
	$userString = "username='$username'";


$avatar = "http://www.northamericanwhitetail.fox/avatar?uid=".$user->ID;
//$userPosts = 'http://www.northamericanwhitetail.fox/slim/api/superpost/user/posts/'.$user->ID;

?>
<header class="header-title">
	<h1><a href="/community/">Community</a> / Your Profile</h1>
	<?php edit_post_link(__('Edit', 'carrington-business')); ?>
    <?php //echo $requestURL; ?>
</header>
<div class="col-abc super-post">
	<div <?php post_class('entry entry-full clearfix'); ?>>
		<div class="entry-content">
			<div class="user-header">
	           
	            <div class="user-info">
	            	<div class="user-thumbnail"><?php echo '<img src="'.$avatar.'" alt="User Avatar" />'; ?></div>
	            	
	            	<ul class="details">
	            		<li><h3><?php echo $user->display_name; ?></h3></li>
	            		<li class="hometown"><a href="#">Gotham City</a></li>
	            		<li class="twitter"><a href="#">@batman</a></li>
	            	</ul>
	            	<a class="edit" href="/login/?action=profile">edit profile</a>
	            </div>
	            
	            <div class="extras">
		    		<div class="score-box">
		    			<h2 class="user-points">0</h2> 
		    			<p>Points</p>
		    		</div>
		    		<ul class="post-type-select">
	            		<li id="new-post-button" class="post"><span>+</span> Create New Post</li>
			    	</ul>
		    	</div>
		    	
		    	<div class="profile-right">
		    	<?php if (function_exists("imo_dart_tag")) {
			            imo_dart_tag("300x250");
			          } else { ?>
			  	        <!-- 300x250 Ad: -->
			            <script type="text/javascript">
			              document.write(unescape('%3Cscript src="http://ad.doubleclick.net/adj/imo.'+dartadsgen_site+'/;sect=;page=index;subs=;sz=300x250;dcopt=;tile='+pr_tile+';ord='+dartadsgen_rand+'?"%3E%3C/script%3E'));
			            </script>
			            <script type="text/javascript">
			              ++pr_tile;
			            </script>
			            <noscript>
			              <a href="http://ad.doubleclick.net/adj/imo.outdoorsbest/;sect=;page=index;subs=;sz=300x250
			              ;dcopt=;tile=1;ord=7391727509?">
			                <img src="http://ad.doubleclick.net/ad/imo.outdoorsbest/home;sect=;page=index;subs=;sz=300x250;dcopt=;tile=1;ord=7391727509?" border="0" />
			              </a>
			            </noscript>
			            <!-- END 300x250 Ad: -->
			          <?php } ?>
			          </div>

	    	</div>
	        <h3 class="first-last-name"><?php echo $user->display_name; ?>'s Activity</h3>
	                
	        <ul class="post-type-select">
                <li class="user-profile recent selected" display="recent" user="<?php echo $user->ID;?>">Recent Activity</li>
                <li class="user-profile" display="comments" user="<?php echo $user->ID;?>">Comments</li>
            </ul>    
            
            <div id="no-activity" style="display:none;">
	        	<p>No Activity.</p>
	        </div>
	        
	        <div id="user-activity" user="<?php echo $user->ID;?>">


            </div>
            <!--<div class="cross-site-feed-more-button"> <div class="more-button"><span>LOAD MORE<span></span></span></div> </div>-->
		</div>
	</div><!-- .entry -->
</div><!-- .col-abc -->
<?php get_footer(); ?>
