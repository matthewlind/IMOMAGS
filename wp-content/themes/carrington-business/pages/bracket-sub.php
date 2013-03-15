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
<header>
	<ul id="ga-madness-nav">
		<li><a href="/ga-madness">Gun Bracket</a></li>
		<li><a href="/ga-madness/enter">Enter Now</a></li>
		<li style="width:270px;"></li>
		<li><a href="/ga-madness/prizes">Prizes</a></li>
		<li><a href="/ga-madness/rules">Rules</a></li>
	</ul>
	<div class="ga-madness-nav-logo"></div>
	<h1><?php the_title(); ?></h1>
	<?php edit_post_link(__('Edit', 'carrington-business')); ?>
</header>
<div class="col-abc">
	<div <?php post_class('entry entry-full clearfix'); ?>>
		<div class="entry-content">
			<?php
			the_content(__('Continued&hellip;', 'carrington-business'));
			wp_link_pages();
			?>
		</div>
	</div><!-- .entry -->
	<?php //comments_template(); ?>
</div><!-- .col-abc -->
<?php get_footer(); ?>