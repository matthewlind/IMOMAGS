<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
/**
 * @package favebusiness
 *
 * This file is part of the FaveBusiness Theme for WordPress
 * http://crowdfavorite.com/wordpress/themes/favebusiness/
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
<div class="page-template-page-right-php">
	<div class="shot-show">
		<div class="blog-border"></div>
		<h1>Daily SHOT SHOW 2013 Coverage</h1>
		<div class="presented-by">Presented By</div>
		<?php //if( is_category("military-arms") ){ echo " <h4>Military Arms</h4>"; }?>
		<div class="desc">Your destination for the newest guns and gear coming out of the industry's biggest event of the year!</div>
		<div class="sponsor-logo"></div>
	</div>

	<div class="bonus-background">
		<div class="bonus">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('bonus_sidebar')) : else : ?><?php endif; ?>
		</div>
	</div>
	<div class="col-abc">
		
		<div <?php post_class('entry entry-full clearfix'); ?>>
			<div class="entry-content">
				<?php
				the_content(__('Continued&hellip;', 'carrington-business')); ?>
				<div class="cross-site-feed" term=""></div><!-- This term= attribute is searched for by displayCrossSiteFeed() in cross-site-feed.js -->
				
				</div>
				<div class="cross-site-feed-more-button"> <div class="more-button"><span>LOAD MORE<span></span></span></div> </div>
				<?php wp_link_pages(); ?>
			</div>
			<?php edit_post_link(__('Edit', 'carrington-business')); ?>
		</div><!-- .entry -->
		<?php // comments_template(); ?>
	</div><!-- .col-abc -->
</div>
<?php get_footer(); ?>
			

			