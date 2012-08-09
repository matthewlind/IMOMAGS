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
<div class="page-community">
	<header class="header-title">
		<ul id="user-bar" style="<?php echo $displayStyle; ?>">	          
			<li class="user-name">Hello, <a href="/profile/<?php echo $current_user->user_nicename; ?>"><span id="current-user-name"><?php echo $current_user->display_name; ?></span></a></li>
			<li><a href="/profile/<?php echo $current_user->user_nicename; ?>"><img src="/avatar?uid=<?php echo $current_user->ID; ?>" alt="User Avatar" class="recon-gravatar" /></a></li>                      
       </ul>
       <h1>Community <span style="display:none;">| General Discussion</span></h1>
		
	</header>
	<div class="bonus-background">
		<div class="bonus" style="<?php echo $loginStyle; ?>">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-home-top')) : else : ?><?php endif; ?>
		</div>		
		<div class="bonus" style="<?php echo $displayStyle; ?>">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-home-top-logged')) : else : ?><?php endif; ?>
		</div>		
	</div>
	<div class="col-abc community">
			<ul class="community-cats">
				<li id="rut" class="title"><div></div><h2><a href="/report/" term="report" display="list">Rut Reports</a></h2></li>
				<li class="new-post selected points report"><a href="#">Post in Rut Reports</a></li>
			</ul>
			
			<ul class="community-cats">
				<li id="tips-tactics" class="title"><div></div><h2><a href="/tip/">Tips & Tactics</a></h2></li>
				<li class="new-post selected points tip"><a href="#">Post in Tips & Tactics</a></li>
			</ul>
			
			<ul class="community-cats">
				<li id="lifestyle" class="title"><div></div><h2><a href="/lifestyle/">Lifestyle</a></h2></li>
				<li class="new-post selected points lifestyle"><a href="#">Post in Lifestyle</a></li>
			</ul>
			
			<ul class="community-cats">
				<li id="tbucks" class="title"><div></div><h2><a href="/trophy/">Trophy Bucks</a></h2></li>
				<li class="new-post selected points trophy"><a href="#">Post in Trophy Buck</a></li>
			</ul>
			
			<ul class="community-cats">
				<li id="general" class="title"><div></div><h2><a href="/general/"">General Discussion</a></h2></li>
				<li class="new-post selected points general"><a href="#">Post in Discussion</a></li>
			</ul>
			
			<ul class="community-cats">
				<li id="experts" class="title"><div></div><h2><a href="/question/">Q&A</a></h2></li>
				<li class="new-post selected points question"><a href="#">Post in Questions</a></li>
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
                <li class='change all-nav selected' title='all'>ALL</li>
                <li class='change general-nav' title='general'>General</li>
                <li class='change report-nav' title='report'>Reports</li>
                <li class='change tip-nav' title='tip'>Tips</li>
                <li class='change lifestyle-nav' title='lifestyle'>Lifestyle</li>
                <li class='change trophy-nav' title='trophy'>Trophy Bucks</li>
                <!--<li class="dd-arrow"></li>-->
            </ul>    
            <div class="imo-fb-login-button" style="<?php echo $loginStyle; ?>">
                LOGIN
            </div>  
            <div id="recon-activity" term="all" display="tile">


            </div>
            <span id="more-superposts-button">Load More<span></span></span>
        </div>
    </div>
</div>
<?php get_footer(); ?>

