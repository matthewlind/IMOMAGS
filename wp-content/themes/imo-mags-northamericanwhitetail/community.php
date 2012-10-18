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

$hostname = $_SERVER['SERVER_NAME'];


//Get Post Count Data
$requestURL = "http://$hostname/slim/api/superpost/count/general";

$file = file_get_contents($requestURL);
$generalCount = json_decode($file);
$generalCount = $generalCount[0];

$requestURL2 = "http://$hostname/slim/api/superpost/count/report";

$file2 = file_get_contents($requestURL2);
$reportCount = json_decode($file2);
$reportCount = $reportCount[0];

$requestURL3 = "http://$hostname/slim/api/superpost/count/question";

$file3 = file_get_contents($requestURL3);
$questionCount = json_decode($file3);
$questionCount = $questionCount[0];

$requestURL4 = "http://$hostname/slim/api/superpost/count/trophy";

$file4 = file_get_contents($requestURL4);
$trophyCount = json_decode($file4);
$trophyCount = $trophyCount[0];

$requestURL5 = "http://$hostname/slim/api/superpost/count/tip";

$file5 = file_get_contents($requestURL5);
$tipCount = json_decode($file);
$$tipCount = $tipCount[0];

$requestURL6 = "http://$hostname/slim/api/superpost/count/lifestyle";

$file6 = file_get_contents($requestURL6);
$lifestyleCount = json_decode($file6);
$lifestyleCount = $lifestyleCount[0];

$requestURL7 = "http://$hostname/slim/api/superpost/count/gear";

$file7 = file_get_contents($requestURL7);
$gearCount = json_decode($file7);
$gearCount = $gearCount[0];

$requestURL8 = "http://$hostname/slim/api/superpost/count/tip";

$file8 = file_get_contents($requestURL8);
$tipCount = json_decode($file8);
$tipCount = $tipCount[0];

$requestURL9 = "http://$hostname/slim/api/superpost/count/gear";

$file9 = file_get_contents($requestURL9);
$gearCount = json_decode($file9);
$gearCount = $gearCount[0];


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
<div class="page-community page-community-home">
	<div class="bonus-background">
		<div class="bonus">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-community')) : else : ?><?php endif; ?>
		</div>		
	</div>
	<div class="col-abc community">
	<header class="header-title">
    	<h1>Community</h1>
	</header>
		<ul class="community-cats">
			<li id="rut" class="title"><div></div><h2><a href="/community/report/" term="report" display="list">State Rut Reports</a></h2></li>
			<li class="selected points"><a href="/community/report/"><?php echo $reportCount->post_count.' Posts'; ?></a></li>
		</ul>
		
		<ul class="community-cats">
			<li id="tbucks" class="title"><div></div><h2><a href="/community/trophy/">Trophy Bucks</a></h2></li>
			<li class="selected points"><a href="/community/trophy/"><?php echo $trophyCount->post_count.' Posts'; ?></a></li>
		</ul>
		
		<ul class="community-cats">
			<li id="experts" class="title"><div></div><h2><a href="/community/question/">Q&A</a></h2></li>
			<li class="selected points"><a href="/community/question/"><?php echo $questionCount->post_count.' Posts'; ?></a></li>
		</ul>
		
		<ul class="community-cats">
			<li id="gear" class="title"><div></div><h2><a href="/community/gear/">Gear</a></h2></li>
			<li class="selected points"><a href="/community/gear/"><?php echo $gearCount->post_count.' Posts'; ?></a></li>
		</ul>
		
		<ul class="community-cats">
			<li id="lifestyle" class="title"><div></div><h2><a href="/community/lifestyle/">Lifestyle</a></h2></li>
			<li class="selected points"><a href="/community/lifestyle/"><?php echo $lifestyleCount->post_count.' Posts'; ?></a></li>
		</ul>
		
		<ul class="community-cats">
			<li id="tips-tactics" class="title"><div></div><h2><a href="/community/tip/">Tips & Tactics</a></h2></li>
			<li class="selected points"><a href="/community/tip/"><?php echo $tipCount->post_count.' Posts'; ?></a></li>
		</ul>
		
		<ul class="community-cats">
			<li id="general" class="title"><div></div><h2><a href="/community/general/">General Discussion</a></h2></li>
			<li class="selected points"><a href="/community/general/"><?php echo $generalCount->post_count.' Posts'; ?></a></li>
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
            </div>
            <ul class="post-type-select">
            	
                <li class='change all-nav selected' title='all'>ALL</li>
                <li class='change report-nav' title='report'>Reports</li>
                 <li class='change trophy-nav' title='trophy'>Trophy Bucks</li>
                <li class='change lifestyle-nav' title='lifestyle'>Lifestyle</li>
                <li class='change tip-nav' title='tip'>Tips</li>
                <li class='change general-nav' title='general'>General</li>
                <li class="dd-arrow"></li>

            </ul>    
           <div class="imo-fb-login-button" style="<?php echo $loginStyle; ?>">
	    	LOGIN
	    </div>
    	<ul id="user-bar" style="<?php echo $displayStyle; ?>">	          
			<li class="user-name">Hello, <a href="/profile/<?php echo $current_user->user_nicename; ?>"><span id="current-user-name"><?php echo $current_user->display_name; ?></span></a></li>
			<li><a href="/profile/<?php echo $current_user->user_nicename; ?>"><img src="/avatar?uid=<?php echo $current_user->ID; ?>" alt="User Avatar" class="recon-gravatar" /></a></li>                      
       </ul>-->

            <div id="recon-activity" term="all" display="tile">


            </div>
            <span id="more-superposts-button">Load More<span></span></span>
        </div>
    </div>
</div>
<?php get_footer(); ?>

