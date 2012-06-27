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


//First get post data
$username =  get_query_var("user_id");
$requestURL = "http://www.northamericanwhitetail.deva/slim/api/superpost/user/posts/$spid";

$file = file_get_contents($requestURL);
$posts = json_decode($file);
$posts = $posts[0];


  

?>
<header id="masthead">
	<h1><?php echo $username; ?> HEY USERNAME</h1>
	<?php edit_post_link(__('Edit', 'carrington-business')); ?>
    <?php //echo $requestURL; ?>
</header><!-- #masthead -->
<div class="col-abc">
	<div <?php post_class('entry entry-full clearfix'); ?>>
		<div class="entry-content">
            <div class="user-info">
            </div>

		</div>
	</div><!-- .entry -->
</div><!-- .col-abc -->
<?php get_footer(); ?>
