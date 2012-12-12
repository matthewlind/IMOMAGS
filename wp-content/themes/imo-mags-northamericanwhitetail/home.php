<?php

/**
 * Template Name: Home Page+
 * Description: Homepage for the new NAW+
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
?>
<div class="page-template-page-right-php">	

	<!-- Carrington Section w/ Sidebar Top -->	
	<div class="bonus-background">
		<div class="bonus">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-home-top')) : else : ?><?php endif; ?>
		</div>
		<div id="responderfollow"></div>
		<div class="sidebar advert">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : ?><?php endif; ?>
		</div>
		
	</div>
	<div class="col-abc sticky-height">
				<?php the_content(__('Continued&hellip;', 'carrington-business')); ?>
				<div class="clearfix"></div>
	<div class="homepage-gear top">
	<div class="header-sort">
		<h1 class="more-header">NAW Lists</h1>
	</div>
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('gear-home')) : else : ?><?php endif; ?>
	</div>
	<div class="col-abc">
		<div <?php post_class('entry entry-full clearfix'); ?>>
			<div class="entry-content">
			<div class="clear"></div>
				<div class="header-sort">
					<h1 class="more-header">The Latest</h1>
				</div>


				<div class="cross-site-feed" term=""></div><!-- This term= attribute is searched for by displayCrossSiteFeed() in cross-site-feed.js -->
				
				</div>
				<div class="cross-site-feed-more-button"> <div class="more-button"><span>LOAD MORE<span></span></span></div> </div>
				
			</div>
			<div class="clear"></div>
					<div class="col-abc single-question-area">
	<div class="question-module">
		<div class="questions-slider">
		    <div class="slides-container-f">
		    	<h2>Recent Questions</h2>
		         	<ul id="slides-questions" class="jcarousel-skin-tango questions-feed">
		            	<?php 
		                     		for ($i = 1; $i <= 4; $i++) {
			                     		echo '<li>';
											echo '<div class="quote-area">';
											echo '<div class="top"></div>';
											echo '<div class="mdl">';
												echo '<a href="#"><img class="q-img" alt="" src="#"></a>';
												echo '<h4 class="quote"><a href="#"></a></h4>';
												echo '<div class="user-info">';
											echo '<a href="/profile/username"><img class="user" alt="Post Image" src="#"></a>';
											echo '<span>by </span><a class="username"></a>';
											echo '<a href="#" class="count">0</a>';
										echo '</div>';						
											echo '</div>';
											echo '<div class="btm"></div>';
										echo '</div>';
										echo '<div class="answers-area">';
											echo '<a href="#" class="answers-link">Answer</a> '; 
											echo '<a href="/community/question" class="plus-button questions-right"><span class="plus">+</span><span>Ask Your Question</span></a>';             
										echo '</div>';
									echo '</li>';
									} ?>
		            </ul>
		        </div>    
		    </div>
	</div>
	<div id="superpost-thumbs-grid" class="superpost-thumbs-grid-widget homepage-thumbs-grid">
	     <h2>NAW+ Community</h2>
 		<ul id="homepage-grid" class="thumbs-grid" term="all">	
 			<?php 
            for ($i = 1; $i <= 12; $i++) {
                echo '<li><a href=""><span>Views</span><img src=""></a></li>';
			} ?>
        </ul>
        <div class="footer">
        	<a href="/community">Browse The Community</a>
        </div>
    </div>

	<!--<div class="top-users">
	<ul>
		<li class="rank-header">Rank</li>
		<li class="user-header">Username</li>
		<li class="score-header">Score</li>
	</ul>

		<?php for ($i = 1; $i <= 10; $i++) { 
		 	echo '<ul>';
		 		echo '<li class="rank">'.$i.'</li>';
			 	echo '<li class="avatar"><a href="#"><img src="#"></a></li>';
			 	echo '<li class="name"><a href="username">Display Name</a></li>';
			 	echo '<li class="score">0</li>';
		 	echo '</ul>';
		 } ?>
	</div>-->

			<div class="clearfix"></div>
			<?php edit_post_link(__('Edit', 'carrington-business')); ?>
		</div><!-- .entry -->
	</div><!-- .col-abc -->
	<!-- Bottom Widget Area -->
<!-- 	<div class="homepage-gear">
		<h1 class="more-header">New Gear</h1>
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('gear-home')) : else : ?><?php endif; ?>
	</div> -->

		<!-- <div class="secondary">
		<?php //if (function_exists('dynamic_sidebar') && dynamic_sidebar('secondary-home')) : else : ?><?php //endif; ?>
	</div> -->
	<div class="clearfix"></div>
</div>
<?php 
//true to show changing contest modals, false to revert to default modal.
$contest = true;
if($contest == true){ ?>
<div id="community-modal" class="new-superpost-modal-container new-superpost-box contest-modal" style="display:none;height:420px:width:600px;background-color:white;">
	<p class="top-text">Join the NAW Community and you could</p>
	<h1>Win this Crossbow!</h1>
	<p class="bottom-text">Post a photo and you're automatically entered!</p>
	<div class="modal-login-area">
		<small class="contest-model">*Model - Stealth XLT w/ ACUdraw 50</small>
		<small>*we do not post anything to your wall unless you say so!</small>
		<div id="imo-fb-login-button" class="fb-login join-widget-fb-login fb-login-community-modal">Join Now With Facebook</div>
		<a class="email-signup">or use your email address</a>	
	</div>
	<a class="hide-this" href="#">Don't show this again</a>
<?php }else{ ?>
<div id="community-modal" class="new-superpost-modal-container new-superpost-box" style="display:none;height:425px:width:600px;background-color:white;">
	<h1>Introducing the NAW Community and Whitetail+ App</h1>
	<div class="modal-login-area">
		<p>The all new whitetail resource for the hardcore hunter.</p>
		<div id="imo-fb-login-button" class="fb-login join-widget-fb-login fb-login-community-modal">Join Now With Facebook</div>
		<small>*we do not post anything to your wall unless you say so!</small>
		<a class="email-signup">or use your email address</a>
	</div>
	<div class="app-callout">
		<div class="left">
			<div class="iphone-screen">Whitetail+ App</div>
		</div>
		<div class="right">
			<div class="app-icon"><span>Whitetail+</span></div>
			<p class="copy">Stay connected on your hunt! Post photos and questions anytime!</p>
			<div class="app-store-icon">Available on the app store</div>
		</div>
	</div>
	<a class="hide-this" href="#">Don't show this again</a>
</div>
<?php } ?>
<?php get_footer(); ?>