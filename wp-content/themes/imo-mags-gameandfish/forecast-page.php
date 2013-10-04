<?php

/**
 * Template Name: Forecast
 * Description: Forecast page
 *
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

get_header();

the_post();
?>
<div class="page-template-page-right-php">
	<header id="masthead">
		<h1>Game & Fish 2013 Deer Forecast</h1>
	</header>
	<div class="forecast-map">	
		<div class="col-abc">
			<p class="state-name"></p>
			<div id="us-map-forecast" style="min-width:840px;height:600px;padding:20px;margin-left:30px;position:absolute;top:20px;"></div>
		</div>
		<?php if(is_page("deer-forecast")){ ?>
			<img src="<?php bloginfo("stylesheet_directory"); ?>/img/deer-forecast-logo-sm.png" alt="Deer Forecast" />
		<?php } ?>
		
	</div>
	<div class="forecast-content">
		<div class="bonus-background">
			<div class="bonus">
				<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-default')) : else : ?><?php endif; ?>
			</div>
			<div id="responderfollow"></div>
			<div class="sidebar advert">
				<?php imo_dart_tag("300x250",false,array("pos"=>"btf")); ?>
				<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : endif; ?>
			</div>
		</div>
	
		<div id="forecast" class="col-abc">
		<?php if(!is_page("deer-forecast")){ ?>
			<a href="/deer-forecast/">G&F Deer Forecast</a>
		<?php } ?>
		<h1><?php the_title(); ?></h1>
			<div <?php post_class('entry entry-full clearfix'); ?>>
				<div class="entry-content">
					<?php
					the_content(__('Continued&hellip;', 'carrington-business'));				
					?>
				</div>
				<?php edit_post_link(__('Edit', 'carrington-business')); ?>
			</div><!-- .entry -->
			<?php comments_template(); ?>
		</div><!-- .col-abc -->
	</div>
</div>
<?php get_footer(); ?>

