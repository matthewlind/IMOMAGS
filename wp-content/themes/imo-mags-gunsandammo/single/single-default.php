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

$current_category = single_cat_title("", false);

$soga_slug = "sons-of-guns-and-ammo";
$floc_slug = "for-the-love-of-competition";
$dt_slug = "defend-thyself";
$nb_slug = "news-brief";
$tfl_slug = "the-front-lines";
$tgg_slug = "the-gun-guys";
$tgr_slug = "the-gun-room";
$zn_slug = "zombie-nation";

get_header();
?>
<div id="sidebar"<?php if( in_category($soga_slug) || in_category($floc_slug) || in_category($dt_slug) || in_category($nb_slug) || in_category($zn_slug) || in_category($tgr_slug) ){echo ' class="blog-sidebar"';} ?>>
<?php 
	if(is_home()){
		if (function_exists('dynamic_sidebar') && dynamic_sidebar('homepage-sidebar')) : else :  endif; 
	} 
	else if('reviews' == get_post_type()){
		if (function_exists('dynamic_sidebar') && dynamic_sidebar('reviews-sidebar')) : else :  endif; 
	}
	else if('shooting' == get_post_type()){
		if (function_exists('dynamic_sidebar') && dynamic_sidebar('shooting-sidebar')) : else :  endif; 
	}
	else if('ga-lists' == get_post_type()){
		if (function_exists('dynamic_sidebar') && dynamic_sidebar('gallery-sidebar')) : else :  endif; 
	}
	else if('imo-video' == get_post_type()){
		if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-video')) : else :  endif; 
	}
	else if( in_category($soga_slug) || in_category($floc_slug) || in_category($dt_slug) || in_category($nb_slug) || in_category($zn_slug) || in_category($tgr_slug) ) {
		if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-default')) : else :  endif; 
	}else{
		if (function_exists('dynamic_sidebar') && dynamic_sidebar('homepage-sidebar')) : else :  endif; 
	}
	
	?>
	</div>
<!-- Set the blog header on single blog entry pages -->
<?php if (in_category($soga_slug)) { ?>
<h1 class="seo-h1">Sons of guns & Ammo</h1>
<a class="blog-header soga-header" href="/blogs/<?php echo "sons-of-gunsandammo"; ?>/" title="<?php echo $current_category; ?>"></a>

<?php } else if (in_category($floc_slug)) { ?>
<h1 class="seo-h1">For the Love of Competition</h1>
<a class="blog-header floc-header" href="/blogs/<?php echo $floc_slug; ?>/" title="<?php echo $current_category; ?>"></a>

<?php } else if (in_category($dt_slug)) { ?>
<h1 class="seo-h1">Defend Thyself</h1>
<a class="blog-header dt-header" href="/blogs/<?php echo $dt_slug; ?>/" title="<?php echo $current_category; ?>"></a>

<?php } else if (in_category($nb_slug)) { ?>
<h1 class="seo-h1">Guns & Ammo News Brief</h1>
<a class="blog-header nb-header" href="/blogs/<?php echo $nb_slug; ?>/" title="<?php echo $current_category; ?>"></a>

<?php } else if (in_category($tfl_slug)) { ?>
<h1 class="seo-h1">The Front Lines</h1>
<a class="blog-header tfl-header" href="/blogs/<?php echo $tfl_slug; ?>/" title="<?php echo $current_category; ?>"></a>

<?php } else if (in_category($tgg_slug)) { ?>
<h1 class="seo-h1">The Gun Guys</h1>
<a class="blog-header tgg-header" href="/blogs/<?php echo $tgg_slug; ?>/" title="<?php echo $current_category; ?>"></a>

<?php } else if (in_category($tgr_slug)) { ?>
<h1 class="seo-h1">From the History Books</h1>
<a class="blog-header tgr-header" href="/blogs/<?php echo $tgr_slug; ?>/" title="<?php echo $current_category; ?>"></a>

<?php } else if (in_category($zn_slug)) { ?>
<h1 class="seo-h1">Zombie Nation</h1>
<a class="blog-header zn-header" href="/blogs/<?php echo $zn_slug; ?>/" title="<?php echo $current_category; ?>"></a>

<?php } ?>

<div id="content" class="col-ab">
	<?php cfct_loop(); ?>
	<?php if (function_exists('imo_add_this')) {imo_add_this();} ?>
	<?php comments_template(); ?>
</div>
<?php get_footer();
?>
