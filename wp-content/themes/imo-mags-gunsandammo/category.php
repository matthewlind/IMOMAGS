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
	<div id="sidebar"<?php if (in_category("shot-show-2013") ) { echo '<div id="sidebar" class="shot-show-sidebar">';
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('shot-show-sidebar')) : else : endif;
	}else{

		echo '<div id="sidebar">';
		if( in_category($soga_slug) || in_category($floc_slug) || in_category($dt_slug) || in_category($nb_slug) || in_category($zn_slug) || in_category($tgr_slug) ) {
			if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-default')) : else : endif;
		
		}else if( in_category("shot-show-2013") ){
					
		}else if( in_category("affiliates") ){
			if (function_exists('dynamic_sidebar') && dynamic_sidebar('affiliate-sidebar')) : else : endif;
		
		}else{
			if (function_exists('dynamic_sidebar') && dynamic_sidebar('homepage-sidebar')) : else : endif;
		}
	}
		 ?>
		<div id="responderfollow"></div>
		<div class="sidebar advert">
			<?php imo_dart_tag("300x250",false,array("pos"=>"btf")); ?>
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : endif; ?>
		</div>
	</div>
	<div id="content" class="col-abc category-col-abc">
	<?php if (is_category($soga_slug)) { ?>
	<div class="blog-headers soga">
		<div class="blog-border"></div>
		<h1>Sons of Guns & Ammo</h1>
		<div class="presented-by">Presented By</div>
		<p>Will Hayden and the Red Jacket Crew bring you everything you love about Sons of Guns in a blog with all the firepower and none of the drama.</p>
		<div class="sponsor-logo"><a href="http://www.armalite.com/Categories.aspx?Category=d4543129-c82e-4fc9-bb4d-213664c7b055" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/armalite.jpg" alt="Armalite Logo" title="Armalite Logo" /></a></div>
	</div>
	<?php } else if (is_category($floc_slug)) { ?>
	<div class="blog-headers ftloc">
		<div class="blog-border"></div>
		<h1>For the Love of Competition</h1>
		<!--<div class="presented-by">Presented By</div>-->
		<p>News, notes, jackassery and the occasional explosion from the world of competitive shooting with Top Shot champion and aspiring 3-gunner 
Iain Harrison.</p>
		<!--<div class="sponsor-logo"></div>-->
	</div>
	<?php } else if (is_category($dt_slug)) { ?>
	<div class="blog-headers dt">
		<div class="blog-border"></div>
		<h1>Defend Thyself</h1>
		<div class="presented-by">Presented By</div>
		<p>Tips and tactics for defending your home, your family and your life from Personal Defense expert James Tarr.</p>
		<!-- Site - Guns and Ammo/defend_thyself -->
		<div class="dt-sponsor">
			<script type="text/javascript">
			  var ord = window.ord || Math.floor(Math.random() * 1e16);
			  document.write('<a href="http://ad.doubleclick.net/N4930/jump/imo.gunsandammo/defend_thyself;sz=86x86;ord=' + ord + '?"><img src="http://ad.doubleclick.net/N4930/ad/imo.gunsandammo/defend_thyself;sz=86x86;ord=' + ord + '?" width="86" height="86" /></a>');
			</script>
			<noscript>
			<a href="http://ad.doubleclick.net/N4930/jump/imo.gunsandammo/defend_thyself;sz=86x86;ord=[timestamp]?">
			<img src="http://ad.doubleclick.net/N4930/ad/imo.gunsandammo/defend_thyself;sz=86x86;ord=[timestamp]?" width="86" height="86" />
			</a>
			</noscript>
		</div>
	</div>
	<?php } else if (is_category($nb_slug)) { ?>
	<div class="blog-headers ganb">
		<div class="blog-border"></div>
		<h1>Guns & Ammo News Brief</h1>
		<!--<div class="presented-by">Presented By</div>-->
		<p>All the news you'll ever need from the world of guns, shooting and weird web stuff. Brought to you by the scribes at GunsandAmmo.com.</p>
		<!--<div class="sponsor-logo"></div>-->
	</div>		
	<?php } else if (is_category($tgr_slug)) { ?>
	<div class="blog-headers fthb">
		<div class="blog-border"></div>
		<h1>From the History Books</h1>
		<!--<div class="presented-by">Presented By</div>-->
		<p>A look back in time at the history of the guns we love with Senior Editor Garry James and S.P. Fjestad, author and publisher of the Blue Book of Gun Values.</p>
		<!--<div class="sponsor-logo"></div>-->
	</div>
	<?php } else if (is_category($zn_slug)) { ?>
	<div class="blog-headers zn">
		<div class="blog-border"></div>
		<h1>Zombie Nation</h1>
		<!--<div class="presented-by">Presented By</div>-->
		<p>When you're helpless against the zombie horde and their blood lust, don't say we didn't warn you. Get your tips, tactics and gear for zombie defense here.</p>
		<!--<div class="sponsor-logo"></div>-->
	</div>	
	<?php } else if (is_category("affiliates") || is_category("military-arms") ) { ?>
	<div class="affiliate-header">
		<div class="bar"></div>
		<h1>G&A Affiliates</h1>
		<?php if( is_category("military-arms") ){ echo " <h4>Military Arms</h4>"; }?>
		<div class="desc">YouTube's underground is full of gun-loving videographers with cult-like followings. Guns & Ammo has joined forces with some of the top personalities to create a new community for the best of the best.</div>
	</div>
	<?php } else if (is_category("shot-show-2013") ) { ?>
		<div class="blog-headers shot-show">
		<div class="blog-border"></div>
		<h1>Daily SHOT SHOW 2013 Coverage</h1>
		<!--<div class="presented-by">Presented By</div>-->
		<div class="desc">Your destination for the the latest guns and gear of 2013. See what?s new, right now.</div>
		<!--<div class="sponsor-logo"><a href="http://resources.springfield-armory.com/" target="_blank"><img src="/wp-content/themes/imo-mags-gunsandammo/img/sausa.png" alt="Springfield Amory USA" title="Springfield Amory USA" /></a></div>-->
	</div>
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
	if( is_category("shot-show-2013") ){ ?>
		<div class="cat-col-full">
				<?php

					
		//Then get attachment data
		$requestURL = "http://gunsandammo.com/wpdb/shotshow-shoot-json.php";
		
		$file = file_get_contents($requestURL);
		$postData = json_decode($file);		
					
		?>
			
			<div id="slideshow_mask" class="featured-thumb-wide">
				<div id="slideshow">
					
					
	
					<?php // The Loop
					
					$itemCount = 0;
					foreach($postData as $post) {
					
						$isATAFeatured = FALSE;
						//Check for ata-featured term
						
						foreach ($post->terms as $term) {
							if ($term->slug == "shot-show-featured")
								$isATAFeatured = TRUE;
						}
						
						
						if ($isATAFeatured) {
						
							$imageURL = str_replace("-190x120", "", $post->img_url);
							

							?>

								<div class='featured-item-pane cat-slide'>
									<div class='featured-item-image'>
										<a href="<?php echo $post->post_url; ?>"><img src="<?php echo $imageURL; ?>"/></a>
									</div>
									<div class='featured-item-description'>
										<h2><a href="<?php echo $post->post_url; ?>"><?php echo $post->post_title; ?></a></h2>
									</div>
								</div>
							
							
							<?php 
							$itemCount++;
						
						}//end if $isATAFeatured
					
						if ($itemCount >= 4)
							break;
					
						}//End Foreach
						?>
				</div>
			</div>
				
				<div id="pager" class=""></div>
						<a id="prev"></a>
						<a id="next"></a>	
						
			<div style="clear:both;"></div>
		<div class="cross-site-feed" term=""></div><!-- This term= attribute is searched for by displayCrossSiteFeed() in cross-site-feed.js -->
				
		</div>
		<div class="cross-site-feed-more-button"> <div class="more-button"><span>LOAD MORE<span></span></span></div> </div>
	<?php }else{
		cfct_loop();
		cfct_misc('nav-posts');
	} ?>
</div>

<?php
get_footer(); ?>
