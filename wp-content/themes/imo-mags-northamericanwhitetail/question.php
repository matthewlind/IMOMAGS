<?php

/**
 * Template Name: Question
 * Description: The NAW+ Community - Question Category
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
<div class="col-abc super-post">
    <header class="header-title">
		<h1><a href="/community/">Community</a> <span>| Questions</span></h1>
	</header>
	<div class="col-abc super-post">
		<ul class="post-type-select">
			<li id="new-post-button" class="post"><span>+</span> Post</li>
		    <li title='all'>ALL</li>
		    <li title='report'>Reports</li>
		    <li title='tip'>Tips</li>
		    <li title='lifestyle'>Lifestyle</li>
		    <li title='trophy'>Trophy Bucks</li>
		    <!--<li class="dd-arrow"></li>-->
	    </ul>    
        <div id="recon-activity" term="question" display="list">


       </div>
       <span id="more-superposts-button">Load More<span></span></span>
   </div>
</div>
<?php get_footer(); ?>

