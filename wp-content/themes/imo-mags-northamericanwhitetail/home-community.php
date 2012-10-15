<?php

/**
 * Template Name: Home Page+ Community
 * Description: Homepage for the new NAW+ with community features
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
<div class="page-template-page-right-php">	

	<!-- Carrington Section w/ Sidebar Top -->	
	<div class="bonus-background">
		<div class="bonus">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-home-top')) : else : ?><?php endif; ?>
		</div>		
	</div>
	<div class="col-abc sticky-height">
		<?php the_content(__('Continued&hellip;', 'carrington-business')); ?>
		<div class="clearfix"></div>
		<div class="homepage-gear top">
		<div class="header-sort">
			<h1 class="more-header">Gear Reviews</h1>
		</div>
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('gear-home')) : else : ?><?php endif; ?>
		</div>
		
	</div><!-- .col-abc -->		

<!-- Super post section -->
<div class="col-abc super-post">
    <div <?php post_class('entry entry-full clearfix'); ?>>
    	<!-- This section is commented out until we add community features -->
        <div class="entry-content">
	        <!--<div class="super-header">
	            <hr class="comm-sep">
	            <h1 class="recon">Naw+ Community</h1>
	        </div>
       
			<ul id="user-bar" style="<?php echo $displayStyle; ?>">	          
				<li class="user-name">
					Hello, <a href="/profile/<?php echo $current_user->user_nicename; ?>"><span id="current-user-name"><?php echo $current_user->display_name; ?></span></a>
					<a class="start" href="/community-post">+ Start New Post</a>
				</li>
				<li><a href="/profile/<?php echo $current_user->user_nicename; ?>"><img src="/avatar?uid=<?php echo $current_user->ID; ?>" alt="User Avatar" class="recon-gravatar" /></a></li>                      
	       </ul> 
            <div class="imo-fb-login-button" style="<?php echo $loginStyle; ?>">
                LOGIN
            </div>           
            <div id="recon-activity" term="all" display="tile" widthMode="wide">


            </div>
            <span id="more-superposts-button">Load More<span></span></span>



            </div>
    </div><!-- .entry -->
</div><!-- .col-abc -->
	<div class="clear"></div>
	<!-- Editor's Picks w/ Sidebar Bottom -->		
	<div class="bonus-background">
		<div class="bonus">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-home-bottom')) : else : ?><?php endif; ?>
		</div>
		<div id="responderfollow"></div>
		<div class="sidebar advert">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : ?><?php endif; ?>
		</div>

	</div>
	
	<div class="col-abc">
		<div <?php post_class('entry entry-full clearfix'); ?>>
			<div class="entry-content">
				<div class="clear"></div>
					<div class="header-sort home-questions">
						<h1 class="more-header">Community Q&A</h1>
						<div class="qa-promo"></div>
					</div>
					<div class="questions-slider">
		                <div class="slides-container-f">
		                	<a href="/community/question" class="see-all home-see-all">See All Questions</a>
		                     	<ul id="slides-questions" class="jcarousel-skin-tango questions-feed">
		                        	<?php 
		                     		for ($i = 1; $i <= 4; $i++) {
			                     		echo '<li>';
											echo '<div class="top"></div>';
											echo '<div class="mdl">';
												echo '<a href="#"><img class="q-img" alt="" src="#"></a>';
												echo '<h4 class="quote"><a href="#"></a></h4>';
												echo '<div class="user-info">';
											echo '<a href="/profile/username"><img class="user" alt="Post Image" src="#"></a>';
											echo '<span>by </span><a class="username"></a>';
										echo '</div>';						
											echo '</div>';
											echo '<div class="btm"></div>';
										echo '</div>';
										echo '<div class="answers-area">';
											echo '<div class="answers-count">';
												echo 'Answers <a href="#"><span class="count">0</span></a>';
											echo '</div>';
											echo '<a href="#" class="answers-link">Answer This Question</a> '; 
											echo '<a href="/community/question" class="plus-button questions-right"><span class="plus">+</span><span>Ask Your Question</span></a>';             
										echo '</div>';
									echo '</li>';
									} ?>
		                        </ul>
		                    </div>    
		                </div>
		            <div class="clear"></div>
	<div style="height:30px;"></div>
				<div class="header-sort">
					<h1 class="more-header">The Latest</h1>
				</div>


				<div class="cross-site-feed" term=""></div><!-- This term= attribute is searched for by displayCrossSiteFeed() in cross-site-feed.js -->
				
				</div>
				<div class="cross-site-feed-more-button"> <div class="more-button"><span>LOAD MORE<span></span></span></div> </div>
				
			</div>
			<div class="clearfix"></div>
			<?php edit_post_link(__('Edit', 'carrington-business')); ?>
		</div><!-- .entry -->
	</div><!-- .col-abc -->
	<!-- Bottom Widget Area -->
	<div class="clear"></div>
	<!--<div class="homepage-gear bottom end-scroll">
		<div class="header-sort">
			<h1 class="more-header">New Gear</h1>
		</div>
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('gear-home')) : else : ?><?php endif; ?>
	</div>-->

	<div class="secondary">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('secondary-home')) : else : ?><?php endif; ?>
	</div>
	<div class="clearfix"></div>
</div>
<?php get_footer(); ?>