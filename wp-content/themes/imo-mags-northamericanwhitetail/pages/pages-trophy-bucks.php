<?php

/**
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
<div class="page-template-page-trophy-php page-template-page slider-height">
	<header class="header-title">
		<h1><?php the_title(); ?></h1>
		
		<div class="naw-ad"></div>
	</header>	
	<div class="bonus-background">
		<div class="sidebar">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-default')) : else : ?><?php endif; ?>
		</div>
	</div>
	<div class="col-abc">
		<?php the_content(__('Continued&hellip;', 'carrington-business')); ?>
		<div class="header-sort">
			<h1 class="more-header">More Trophy Bucks</h1>
			<div class='cssmenu'>
				<ul>
				   <li><a href='#' class="dd"><span>Sort</span><span class="dd-arrow"></span></a>
				      <ul>
				         <li><a href='#'><span>Category 1</span></a></li>
				         <li><a href='#'><span>Category 2</span></a></li>
				      </ul>
				   </li>
				</ul>
			</div>
		</div>
	<div class="cross-site-feed" term="trophy-bucks"><!-- This term= attribute is searched for by displayCrossSiteFeed() in cross-site-feed.js -->

				</div>


		<?php edit_post_link(__('Edit', 'carrington-business')); ?>

	</div><!-- .col-abc -->
</div>
<?php get_footer(); ?>