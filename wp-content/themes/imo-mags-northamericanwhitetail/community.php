<?php

/**
 * Template Name: Community
 * Description: The NAW+ Community Homepage
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
    <div>
        <div class="entry-content">
            <hr class="comm-sep">
            <h1 class="recon">Naw+ Community</h1>
            <div id="user-login-button">
                LOGIN
            </div>
            <div class='cssmenu'>
				<ul>
				   <li><a href='#' class="dd"><span>State Activity</span><span class="dd-arrow"></span></a>
				      <ul>
				         <li><a href='#'><span>Product 1</span></a></li>
				         <li><a href='#'><span>Product 2</span></a></li>
				      </ul>
				   </li>
				</ul>
			</div>
            <div class="toggle">
            	<a id="toggle-tile" class="tile-on"></a>
            	<span class="toggle-sep"></span>
            	<a id="toggle-list" class="list-off"></a>
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

            <div id="recon-activity">


            </div>
            <span id="more-superposts-button">Load More<span></span></span>
        </div>
    </div>
</div>
<?php get_footer(); ?>

