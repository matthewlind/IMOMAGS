<?php

/**
 * Template Name: Lifestyle
 * Description: The NAW+ Community - Lifestyle Category
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
		<h1><a href="/community/">Community</a> <span>| Lifestyle</span></h1>
	</header>
	<div class="col-abc super-post">
		<div id="user-login-button">
                LOGIN
        </div>   
	    <div id="recon-activity" term="lifestyle" display="tile">
		
		
		</div>
	<span id="more-superposts-button">Load More<span></span></span>
	</div>
</div>
<?php get_footer(); ?>

