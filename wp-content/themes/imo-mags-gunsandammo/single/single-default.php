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
$tgr_slug = "history-books";
$zn_slug = "zombie-nation";
$aff_slug = "affiliates";

get_header();
?>
<div class="page-flow">
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
		}else if( in_category($aff_slug) ){
			if (function_exists('dynamic_sidebar') && dynamic_sidebar('affiliate-sidebar')) : else : endif;
		}else{
			if (function_exists('dynamic_sidebar') && dynamic_sidebar('homepage-sidebar')) : else :  endif; 
		}
		
		?>
	<div id="responderfollow"></div>
		<div class="sidebar advert">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : endif; ?>
		</div>
	</div>
	
	<div id="content" class="col-ab">
	<!-- Set the blog header on single blog entry pages -->
	<?php
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
	<?php if (in_category($soga_slug)) { ?>
	<div class="blog-headers soga">
		<div class="blog-border"></div>
		<h1>Sons of Guns & Ammo</h1>
		<div class="presented-by">Presented By</div>
		<p>Will Hayden and the Red Jacket Crew bring you everything you love about Sons of Guns in a blog with all the firepower and none of the drama.</p>
		<div class="sponsor-logo"><a href="http://www.armalite.com/Categories.aspx?Category=d4543129-c82e-4fc9-bb4d-213664c7b055"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/armalite.jpg" alt="Armalite Logo" title="Armalite Logo" /></a></div>
	</div>
	<?php } else if (in_category($floc_slug)) { ?>
	<div class="blog-headers ftloc">
		<div class="blog-border"></div>
		<h1>For the Love of Competition</h1>
		<!--<div class="presented-by">Presented By</div>-->
		<p>News, notes, jackassery and the occasional explosion from the world of competitive shooting with Top Shot champion and aspiring 3-gunner 
Iain Harrison.</p>
		<!--<div class="sponsor-logo"></div>-->
	</div>
	<?php } else if (in_category($dt_slug)) { ?>
	<div class="blog-headers dt">
		<div class="blog-border"></div>
		<h1>Defend Thyself</h1>
		<div class="presented-by">Presented By</div>
		<p>Tips and tactics for defending your home, your family and your life from Personal Defense expert Richard Nance.</p>
		<div class="sponsor-logo"></div>
	</div>
	<?php } else if (in_category($nb_slug)) { ?>
	<div class="blog-headers ganb">
		<div class="blog-border"></div>
		<h1>Guns & Ammo News Brief</h1>
		<!--<div class="presented-by">Presented By</div>-->
		<p>All the news you'll ever need from the world of guns, shooting and weird web stuff. Brought to you by the scribes at GunsandAmmo.com.</p>
		<!--<div class="sponsor-logo"></div>-->
	</div>		
	<?php } else if (in_category($tgr_slug)) { ?>
	<div class="blog-headers fthb">
		<div class="blog-border"></div>
		<h1>From the History Books</h1>
		<!--<div class="presented-by">Presented By</div>-->
		<p>A look back in time at the history of the guns we love with Senior Editor Garry James and S.P. Fjestad, author and publisher of the Blue Book of Gun Values.</p>
		<!--<div class="sponsor-logo"></div>-->
	</div>
	<?php } else if (in_category($zn_slug)) { ?>
	<div class="blog-headers zn">
		<div class="blog-border"></div>
		<h1>Zombie Nation</h1>
		<!--<div class="presented-by">Presented By</div>-->
		<p>When you're helpless against the zombie horde and their blood lust, don't say we didn't warn you. Get your tips, tactics and gear for zombie defense here.</p>
		<!--<div class="sponsor-logo"></div>-->
	</div>	
	<?php } else if ( in_category($aff_slug) || in_category("military-arms") ) { ?>
	<div class="affiliate-header">
	<div class="bar"></div>
	<h1>G&A Affiliates</h1>
	<?php if( in_category("military-arms") ){ echo " <h4>Military Arms Channel</h4>"; }?>
	<div class="desc"<?php if(in_category("military-arms")){ echo ' style="width:68%"'; } ?>>
	<?php 

		$aff_desc = get_option("affiliates_desc_uri", "YouTube's underground is full of gun-loving videographers with cult-like followings. Guns & Ammo has joined forces with some of the top personalities to create a new community for the best of the best." );
		if (empty($aff_desc)) {
		    $aff_desc = "YouTube's underground is full of gun-loving videographers with cult-like followings. Guns & Ammo has joined forces with some of the top personalities to create a new community for the best of the best.";
		    }
		$ma_desc = get_option("ma_desc_uri", "The Military Arms Channel is a YouTube channel dedicated to the shooting community and to bringing our viewers current information about firearms, self defense, gear, and more." );
			if (empty($ma_desc)) {
		    	$ma_desc = "The Military Arms Channel is a YouTube channel dedicated to the shooting community and to bringing our viewers current information about firearms, self defense, gear, and more.";
		    }

		if(in_category("affiliates") && !in_category("military-arms")){ echo $aff_desc; }
		else if(in_category("affiliates") || in_category("military-arms")){ echo $ma_desc; }

	?>
	</div>
	<?php if(in_category("military-arms")){ ?>
	<div class="avatar"><?php echo get_avatar("3342"); ?></div>
	<?php } ?>
	</div>
	<?php } ?>
	
	
		<?php cfct_loop(); ?>
		<?php if (function_exists('imo_add_this')) {imo_add_this();} ?>
		<div class="divider"></div>
		<div class="post-content-area">
		
					<div id="leiki1demo"></div>
						<script>
						(function() {
						//*** Note! If URL is not the ID of the page, uncomment
						//*** the line below and replace CONTENT_ID with the page ID.
						//var leiki_cid = 'CONTENT_ID';
						var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;
						s.src = 'http://kiwi12.leiki.com/focus/mwidget?wname=sb1' +((typeof leiki_cid !== 'undefined' && leiki_cid!='')? '&cid='+encodeURIComponent(leiki_cid) : '')+ '&first=' + top.leiki_first + '&ts='+new Date().getTime();
						var x = document.getElementsByTagName('script')[0];
						x.parentNode.insertBefore(s, x);
						top.leiki_first="no";
						})();
						</script>		
					
	
					<div class="fb-recommendations recommendations" data-site="www.gunsandammo.com" data-width="300" data-height="250" data-header="true"></div>
			<div class="divider"></div>
			<?php if (function_exists('related_posts')){related_posts();} ?>
		</div>
		<?php comments_template(); ?>
	</div>
</div>
<?php get_footer();
?>
