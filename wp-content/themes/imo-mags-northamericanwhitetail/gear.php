<?php

/**
 * Template Name: Gear
 * Description: The NAW+ Community - Gear Category
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
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();

the_post();
?>
<div class="page-community">
	<header class="header-title">
		<?php
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
		<ul id="user-bar" style="<?php echo $displayStyle; ?>">	          
			<li class="user-name">Hello, <a href="/profile/<?php echo $current_user->user_nicename; ?>"><span id="current-user-name"><?php echo $current_user->display_name; ?></span></a></li>
			<li><a href="/profile/<?php echo $current_user->user_nicename; ?>"><img src="/avatar?uid=<?php echo $current_user->ID; ?>" alt="User Avatar" class="recon-gravatar" /></a></li>                      
       </ul>
		<h1><a href="/community/">Community</a> <span>| Gear</span></h1>
	</header>
	<div class="col-abc super-post">
		<div class="imo-fb-login-button" style="<?php echo $loginStyle; ?>">
	    	LOGIN
	    </div>
	    <ul class="post-type-select add-post" style="<?php echo $displayStyle; ?>">
	    	<li id="new-post-button" class="post">+ POST IN GENERAL DISCUSSION</li>
		</ul>
	    <div id="recon-activity" term="gear" display="tile">
	
	
	    </div>
	    <span id="more-superposts-button">Load More<span></span></span>
	</div>
</div>
<?php get_footer(); ?>

