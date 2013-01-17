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
		<div class="desc">Your destination for the the latest guns and gear of 2013. See what's new, right now.</div>
		<div class="sponsor-logo"><a href="http://www.realtree.com/huntallseason/index.html" target="_blank"><img src="/wp-content/themes/imo-mags-petersenshunting/img/realtree-logo.png" align="Realtree Xtra" title="Realtree Xtra" /></a></div>	
	</div>

	<div class="bonus-background">
		<div class="bonus">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('shot-show-sidebar')) : else : ?><?php endif; ?>
		</div>
	</div>
	<div class="col-abc">
		<!-- Site - Hunting -->
		<script type="text/javascript">
		  var ord = window.ord || Math.floor(Math.random() * 1e16);
		  document.write('<a href="http://ad.doubleclick.net/N4930/jump/imo.hunting;sz=1x1;ord=' + ord + '?"><img src="http://ad.doubleclick.net/N4930/ad/imo.hunting;sz=1x1;ord=' + ord + '?" width="1" height="1" /></a>');
		</script>
		<noscript>
		<a href="http://ad.doubleclick.net/N4930/jump/imo.hunting;sz=1x1;ord=[timestamp]?">
		<img src="http://ad.doubleclick.net/N4930/ad/imo.hunting;sz=1x1;ord=[timestamp]?" width="1" height="1" />
		</a>
		</noscript>

		<div <?php post_class('entry entry-full clearfix'); ?>>
			<div class="entry-content">
					<div class="cat-col-full">
				<?php

					
		//Then get attachment data
		$requestURL = "http://www.petersenshunting.com/wpdb/shotshow-hunt-json.php";
		
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
				<?php wp_link_pages(); ?>
			</div>
			<?php edit_post_link(__('Edit', 'carrington-business')); ?>
		</div><!-- .entry -->
		<?php // comments_template(); ?>
	</div><!-- .col-abc -->
</div>
<?php get_footer(); ?>
			

			