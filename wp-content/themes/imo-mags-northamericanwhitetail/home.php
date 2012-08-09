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
			<h1 class="more-header">Whitetail Gear</h1>
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('gear-home')) : else : ?><?php endif; ?>
		</div>

	</div><!-- .col-abc -->		

<!-- Super post section -->
<div class="col-abc super-post">
    <div <?php post_class('entry entry-full clearfix'); ?>>
    	<!-- This section is commented out until we add community features -->
        <div class="entry-content">
	        <div class="super-header">
	            <hr class="comm-sep">
	            <h1 class="recon">Naw+ Community</h1>
	            <div class="remington"></div>
	        </div>
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
                <li class='change selected' title='all'>ALL</li>
                <li class='change' title='general'>General</li>
                <li class='change' title='report'>Reports</li>
                <li class='change' title='tip'>Tips</li>
                <li class='change' title='lifestyle'>Lifestyle</li>
                <li class='change' title='trophy'>Trophy Bucks</li>
            </ul>   
       
			<ul id="user-bar" style="<?php echo $displayStyle; ?>">	          
				<li class="user-name">Hello, <a href="/profile/<?php echo $current_user->user_nicename; ?>"><span id="current-user-name"><?php echo $current_user->display_name; ?></span></a></li>
				<li><a href="/profile/<?php echo $current_user->user_nicename; ?>"><img src="/avatar?uid=<?php echo $current_user->ID; ?>" alt="User Avatar" class="recon-gravatar" /></a></li>                      
	       </ul> 
            <div class="imo-fb-login-button" style="<?php echo $loginStyle; ?>">
                LOGIN
            </div>           
            <div id="recon-activity" term="all" display="tile">


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
						<h1 class="more-header">Q&A</h1>
					</div>
					<div class="questions-slider">
		                <div class="slides-container-f">
		                	<a href="/question" class="see-all home-see-all">See All Questions</a>
		                     	<ul id="slides-questions" class="jcarousel-skin-tango questions-feed">
		                        	<?php 
		                     		for ($i = 1; $i <= 4; $i++) {
			                     		echo '<li>';
										echo '<div class="user-info">';
											echo '<a href="/profile/username"><img alt="user photo" src="http://www.northamericanwhitetail.fox/wp-content/themes/imo-mags-northamericanwhitetail/img/user-temp.jpg"></a>';
											echo '<a class="username">Batman</a><span> asks...</span>';
										echo '</div>';
										echo '<div class="quote-area">';
											echo '<div class="top"></div>';
											echo '<div class="mdl">';
												echo '<h4 class="quote">&#8220;Can anyone suggest a good camo bat-suit for hunting in the forest? I am having trouble hunting in the day time.&#8221;</h4>';
											echo '</div>';
											echo '<div class="btm"></div>';
										echo '</div>';
										echo '<div class="answers-area">';
											echo '<div class="answers-count">';
												echo 'Answers <a href="#"><span class="count">18</span></a>';
											echo '</div>';
											echo '<a href="#" class="answers-link">Answer This Question</a> '; 
											echo '<a class="plus-button new-post question questions-right"><span class="plus">+</span><span>Ask Your Question</span></a>';             
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
								<div class='cssmenu'>
									<ul>
									   <li><a href='#' class="dd ignore-click"><span>Sort</span><span class="dd-arrow"></span></a>
									      <ul>
									         <li><a href='#' class="sort-link" sort="post_date"><span>Recent</span></a></li>
									         <li><a href='#' class="sort-link" sort="comment_count"><span>Commented</span></a></li>
									      </ul>
									   </li>
									</ul>
								</div>
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
	<div class="homepage-gear end-scroll">
		<h1 class="more-header">New Gear</h1>
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('gear-home')) : else : ?><?php endif; ?>
	</div>

	<div class="secondary">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('secondary-home')) : else : ?><?php endif; ?>
	</div>
	<div class="clearfix"></div>
</div>
<?php get_footer(); ?>