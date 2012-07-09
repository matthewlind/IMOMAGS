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

$avatar = get_avatar($user->ID,140);

if ($user)
	$userString = "username='$username'";


?>
<header id="masthead">
	<h1><?php echo $username; ?> Community: Your Profile</h1>
	<?php edit_post_link(__('Edit', 'carrington-business')); ?>
    <?php //echo $requestURL; ?>
</header><!-- #masthead -->
<div class="col-abc">
	<div <?php post_class('entry entry-full clearfix'); ?>>
		<div class="entry-content">
			<div class="user-header">
	            <div class="user-info">
	            	<div class="user-thumbnail"><?php echo $avatar; ?></div>
	            	<div class="details">
	            		<h3 class="first-last-name"><?php echo $user->display_name; ?></h3>
	            		<div class="hometown"></div>
	            		<div class="twitter"></div>
	            		<div class="www"></div>
	            	</div>
	            	<div class="extras">
	            		<div class="score-box">
	            			<div class="user-points">
	            				0
	            			</div> Points
	            		</div>
	            	</div>
	            </div>
			</div>
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
			<div id="recon-activity" <?php echo $userString;?> >


            </div>
            <span id="more-superposts-button">Load More<span></span></span>
		</div>
	</div><!-- .entry -->
</div><!-- .col-abc -->
<?php get_footer(); ?>
