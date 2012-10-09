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
		<h1 class="more-header">Whitetail Gear</h1>
	</div>
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('gear-home')) : else : ?><?php endif; ?>
	</div>

	<!--<div style="height:30px;"></div>-->
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
<!-- 	<div class="homepage-gear">
		<h1 class="more-header">New Gear</h1>
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('gear-home')) : else : ?><?php endif; ?>
	</div> -->

		<!-- <div class="secondary">
		<?php //if (function_exists('dynamic_sidebar') && dynamic_sidebar('secondary-home')) : else : ?><?php //endif; ?>
	</div> -->
	<div class="clearfix"></div>
</div>
<?php get_footer(); ?>