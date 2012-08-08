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

// NOTE: this file is here for compatibility reasons - active templates are in the posts/ dir 

if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header(); 

$current_category = single_cat_title("", false);

$soga_slug = "sons-of-guns-and-ammo";
$floc_slug = "for-the-love-of-competition";
$dt_slug = "defend-thyself";
$nb_slug = "news-brief";
$tgr_slug = "history-books";
$zn_slug = "zombie-nation";

$sg_img = get_option("sons_header_uri", get_stylesheet_directory_uri(). "/img/blogs/sonsofguns.png" );
if (empty($sg_img)) {
    $sg_img = get_stylesheet_directory_uri(). "/img/blogs/sonsofguns.png";
}
$dts_img = get_option("defend_header_uri", get_stylesheet_directory_uri(). "/img/blogs/defend-thyself.jpg" );
if (empty($dts_img)) {
    $dts_img = get_stylesheet_directory_uri(). "/img/blogs/defend-thyself.jpg";
}
$nb_img = get_option("news_header_uri", get_stylesheet_directory_uri(). "/img/blogs/news-brief.jpg" );
if (empty($nb_img)) {
    $nb_img = get_stylesheet_directory_uri(). "/img/blogs/news-brief.jpg";
}
$hb_img = get_option("history_header_uri", get_stylesheet_directory_uri(). "/img/blogs/history-books.jpg" );
if (empty($hb_img)) {
    $hb_img = get_stylesheet_directory_uri(). "/img/blogs/history-books.jpg";
}
$lc_img = get_option("competition_header_uri", get_stylesheet_directory_uri(). "/img/blogs/love-competition.jpg" );
if (empty($lc_img)) {
    $lc_img = get_stylesheet_directory_uri(). "/img/blogs/love-competition.jpg";
}
$zn_img = get_option("zombie_header_uri", get_stylesheet_directory_uri(). "/img/blogs/zombie-nation.jpg" );
if (empty($zn_img)) {
    $zn_img = get_stylesheet_directory_uri(). "/img/blogs/zombie-nation.jpg";
}


?>
<div class="page-template-page-right-php category-page">
	<h1 class="seo-h1"><?php single_cat_title('');?></h1>
	<div id="sidebar">
		<?php 
		if( in_category($soga_slug) || in_category($floc_slug) || in_category($dt_slug) || in_category($nb_slug) || in_category($zn_slug) || in_category($tgr_slug) ) {
			if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-default')) : else : endif;
		}else{
			if (function_exists('dynamic_sidebar') && dynamic_sidebar('homepage-sidebar')) : else : endif;
		}
		
		 ?>
	</div>
	<div id="content" class="col-abc category-col-abc">
	<?php if (is_category($soga_slug)) { ?>
<a class="blog-header" href="/blogs/<?php echo "sons-of-gunsandammo"; ?>/" title="<?php echo $current_category; ?>"><img src="<?php print $sg_img; ?>"></a>
<div style="height:20px;"></div>
<?php } else if (is_category($floc_slug)) { ?>
<a class="blog-header" href="/blogs/<?php echo $floc_slug; ?>/" title="<?php echo $current_category; ?>"><img src="<?php print $lc_img; ?>"></a>
<div style="height:20px;"></div>

<?php } else if (is_category($dt_slug)) { ?>
<a class="blog-header" href="/blogs/<?php echo $dt_slug; ?>/" title="<?php echo $current_category; ?>"><img src="<?php print $dts_img; ?>"></a>
<div style="height:20px;"></div>

<?php } else if (is_category($nb_slug)) { ?>
<a class="blog-header" href="/blogs/<?php echo $nb_slug; ?>/" title="<?php echo $current_category; ?>"><img src="<?php print $nb_img; ?>"></a>
<div style="height:20px;"></div>

<?php } else if (is_category($tgr_slug)) { ?>
<a class="blog-header" href="/blogs/<?php echo $tgr_slug; ?>/" title="<?php echo $current_category; ?>"><img src="<?php print $hb_img; ?>"></a>
<div style="height:20px;"></div>

<?php } else if (is_category($zn_slug)) { ?>
<a class="blog-header" href="/blogs/<?php echo $zn_slug; ?>/" title="<?php echo $current_category; ?>"><img src="<?php print $zn_img; ?>"></a>
<div style="height:20px;"></div>
<?php } else { ?>

		<div class="section-title posts" style="width:648px;">
					<div class="cfct-mod-content">
						<h4>
 							<div class="icon"></div>
  								<span><?php single_cat_title('');?></span>
						</h4>
					</div>
				</div>

	<?php }
	cfct_loop();
	cfct_misc('nav-posts'); ?>
</div>

<?php
get_footer(); ?>
