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
<div class="page-template-page-default-php page-template-page slider-height">
	<header class="header-title">
		<h1><?php the_title(); ?></h1>
		<!-- <div class="naw-ad"></div> -->
	</header>	
	<div class="bonus-background">
		<div class="sidebar">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-default')) : else : ?><?php endif; ?>
		</div>
		<div id="responderfollow"></div>
		<div class="sidebar advert">
			<?php imo_ad_placement("btf_medium_rectangle_300x250"); ?>
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : ?><?php endif; ?>
		</div>

	</div>
	<div class="col-abc">
		<?php if(function_exists('wpsocialite_markup')){ wpsocialite_markup(); } ?>
		<div style="float:left;"><img class="wp-image-14234 alignnone" title="NAW Power Rankings 2013" src="http://www.northamericanwhitetail.com/files/2013/09/NAW-Power-Rankings-20131.jpg" alt="" width="325" height="184" />
			<div class="pr-rankings">
				<script type="text/javascript">document.write(unescape('%3Cscript src="http://ad.doubleclick.net/adj/imo.northamericanwhitetail/;sect=week1;manf=;pos=;page=naw_power_rankings_week_1;subs=;sz=240x60;dcopt=;tile=;ord='+dartadsgen_rand+'?"%3E%3C/script%3E'));</script><noscript><a href="http://ad.doubleclick.net/adj/imo.northamericanwhitetail/;sect=week1;manf=;pos=;page=naw_power_rankings_week_1;subs=;sz=240x60;dcopt=;tile=;ord=6545512368?"><img src="http://ad.doubleclick.net/ad/imo.northamericanwhitetail/;sect=week1;manf=;pos=;page=naw_power_rankings_week_1;subs=;sz=240x60;dcopt=;tile=;ord=6545512368?" border="0" /></a></noscript>
				</div>
		</div>
		<?php 
			the_content(__('Continued&hellip;', 'carrington-business')); 
			if (function_exists('imo_add_this')) {imo_add_this();} 
			comments_template(); 
		?>
	</div><!-- .col-abc -->		
		<?php edit_post_link(__('Edit', 'carrington-business')); ?>
		</div><!-- .entry -->
		
	</div><!-- .col-abc -->
</div>
<?php get_footer(); ?>