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

?>
<div class="page-template-page-right-php category-page">
	<h1 class="seo-h1"><?php single_cat_title('');?></h1>


	<div id="sidebar">
		<?php 
			if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-default')) : else : endif;
		?>
		<div id="responderfollow"></div>
		<div class="sidebar advert">
			<?php imo_dart_tag("300x250",false,array("pos"=>"btf")); ?>
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : endif; ?>
		</div>
	</div>
		<div id="content" class="col-abc category-col-abc">
		
		<div class="blog-headers shot-show nra-show">
			<div class="blog-border"></div>
			<h1>NRA SHOW 2013</h1>
			<div class="presented-by">Presented By</div>
			<div class="desc"><?php echo tag_description( get_terms('nra-show')->term_id ); ?></div>
			<div class="sponsor-logo">
				<!-- Site - Guns and Ammo -->
				<script type="text/javascript">
				  var ord = window.ord || Math.floor(Math.random() * 1e16);
				  document.write('<a href="http://ad.doubleclick.net/N4930/jump/imo.gunsandammo;sz=200x48;ord=' + ord + '?"><img src="http://ad.doubleclick.net/N4930/ad/imo.gunsandammo;sz=200x48;ord=' + ord + '?" width="200" height="48" /></a>');
				</script>
				<noscript>
				<a href="http://ad.doubleclick.net/N4930/jump/imo.gunsandammo;sz=200x48;ord=[timestamp]?">
				<img src="http://ad.doubleclick.net/N4930/ad/imo.gunsandammo;sz=200x48;ord=[timestamp]?" width="200" height="48" />
				</a>
				</noscript></div>
		</div>
		<div class="cat-col-full">
			<?php
			cfct_loop();
			cfct_misc('nav-posts');
			?>
		</div>
	</div>
</div>
<?php
get_footer(); ?>
