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
	<header class="header-title">
		<h1>Community <span style="display:none;">| General Discussion</span></h1>
	</header>
	<div class="bonus-background">
		<div class="bonus">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-home-top')) : else : ?><?php endif; ?>
		</div>		
	</div>
	<div class="col-abc community">
			<ul class="community-cats">
				<li id="rut" class="title"><div></div><h2><a href="/report/" term="report" display="list">Rut Reports</a></h2></li>
				<li class="desc">Members report from the field</li>
				<li class="new-post post selected points report">+ POST</li>
			</ul>
			
			<ul class="community-cats">
				<li id="tips-tactics" class="title"><div></div><h2><a href="/tip/">Tips & Tactics</a></h2></li>
				<li class="desc">Members report from the field</li>
				<li class="new-post post selected points tip">+ POST</li>
			</ul>
			
			<ul class="community-cats">
				<li id="lifestyle" class="title"><div></div><h2><a href="/lifestyle/">Lifestyle</a></h2></li>
				<li class="desc">Members report from the field</li>
				<li class="new-post post selected points lifestyle">+ POST</li>
			</ul>
			
			<ul class="community-cats">
				<li id="tbucks" class="title"><div></div><h2><a href="/trophy/">Trophy Bucks</a></h2></li>
				<li class="desc">Members report from the field</li>
				<li class="new-post post selected points trophy">+ POST</li>
			</ul>
			
			<!-- <ul class="community-cats">
				<li id="gear" class="title"><div></div><h2><a href="/gear/">Gear</a></h2></li>
				<li class="desc">Members report from the field</li>
				<li class="new-post post selected points">+ POST</li>
			</ul> -->
			
			<ul class="community-cats">
				<li id="general" class="title"><div></div><h2><a href="/general/"">General Discussion</a></h2></li>
				<li class="desc">Members report from the field</li>
				<li class="new-post post selected points general">+ POST</li>
			</ul>
			
			<ul class="community-cats">
				<li id="experts" class="title"><div></div><h2><a href="/question/">Ask The Experts</a></h2></li>
				<li class="desc">Members report from the field</li>
				<li class="new-post post selected points question">+ POST</li>
			</ul>
		
	</div><!-- .col-abc -->	
<div class="clear"></div>
<div class="col-abc super-post">
        <div class="entry-content">
            <div class="super-header">
	            <hr class="comm-sep">
	            <h1 class="recon">Naw+ Community</h1>
	        </div>
	        <a class="back-to-community" href="#" term="all" display="tile" style="display:none;">Back to Community</a>
            <!--<div class='cssmenu'>
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
            </div>-->
            <ul class="post-type-select">
            	<li id="new-post-button" class="post"><span>+</span> Post</li>
                <li class='all-nav selected' title='all'>ALL</li>
                <li class='general-nav' title='general'>General</li>
                <li class='report-nav' title='report'>Reports</li>
                <li class='tip-nav' title='tip'>Tips</li>
                <li class='lifestyle-nav' title='lifestyle'>Lifestyle</li>
                <li class='trophy-nav' title='trophy'>Trophy Bucks</li>
                <!--<li class="dd-arrow"></li>-->
            </ul>    
            <div class="imo-fb-login-button">
                LOGIN
            </div>
            <div id="recon-activity" term="all" display="tile">


            </div>
            <span id="more-superposts-button">Load More<span></span></span>
        </div>
    </div>
</div>
<?php get_footer(); ?>

