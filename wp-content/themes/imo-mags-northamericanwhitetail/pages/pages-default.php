<?php

/**
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

the_post();

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
<div class="bonus-background">
	<div class="bonus">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('superpost-sidebar')) : else : ?><?php endif; ?>
	</div>
</div>
<div class="col-abc">
	<header class="header-title">
		<h1>Community Profile</h1>
		<div class="community-crumbs" style="<?php echo $displayStyle; ?>">
       		<a href="/community">Community Home</a> &raquo; Edit Profile
		</div>
			
		<div class="community-crumbs" style="<?php echo $loginStyle; ?>">
       		<a href="/community">Community Home</a> &raquo; Login
		</div>

	</header>

	<div class="col-abc">
		<?php the_content(__('Continued&hellip;', 'carrington-business')); ?>
	</div><!-- .col-abc -->		
		<?php edit_post_link(__('Edit', 'carrington-business')); ?>
		</div><!-- .entry -->
	</div><!-- .col-abc -->
</div>
<?php get_footer(); ?>