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
?>
<div class="category-page slider-thumbs slider-height">
	<header class="header-title">
		<h1><?php single_cat_title(''); ?></h1>
	</header>	
	<?php if (!is_category('video')){ ?>
	<div class="bonus-background">
		<div class="sidebar">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-default')) : else : ?><?php endif; ?>
		</div>
	</div>
	<?php } ?>
	<?php if (is_category('tactics')){ 
	//TACTICS PAGE
	?>
		<div class="cat-col-left">
				<?php
					$count = 0;
					$args = array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'category_name' => 'tactics',
					'orderby' => 'date',
					'order' => 'DESC',
					'posts_per_page' => 4,
					);
					// The Query
					$the_query = new WP_Query( $args ); ?>
			
			<div id="slideshow_mask">
				<div id="slideshow">
					
	
					<?php // The Loop
					while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					
					
						<div class='featured-item-pane cat-slide'>
							<div class='featured-item-image'>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large-featured-thumb-x'); ?></a>
							</div>
							<div class='featured-item-description'>
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							</div>
						</div>
						
						
						<?php endwhile;
						// Reset Post Data
						wp_reset_postdata(); ?>
				</div>
			</div>
				
				<div id="pager" class=""></div>
						<a id="prev"></a>
						<a id="next"></a>		
							
		</div><!-- end left -->	
 		
 		<div class="cat-col-right">
	 		<div class="cfct-module cfct-html mod-gallery">	
				<h2>Topics</h2>
 			</div>
	 			<ul class="land-topics">
					<?php $cat_id = get_query_var('cat');
						wp_list_categories('hide_empty=0&title_li=&child_of=' . $cat_id);		
						?>
	 			</ul>
 		</div>
 		
	<?php } else if (is_category('trophy-bucks')){ 
	//TROPHY BUCKS PAGE
	?>
		<div class="cat-col-left">
				<?php
					$count = 0;
					$args = array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'category_name' => 'trophy-bucks',
					'orderby' => 'date',
					'order' => 'DESC',
					'posts_per_page' => 4,
					);
					// The Query
					$the_query = new WP_Query( $args ); ?>
			
			<div id="slideshow_mask">
				<div id="slideshow">
					
	
					<?php // The Loop
					while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					
					
						<div class='featured-item-pane cat-slide'>
							<div class='featured-item-image'>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large-featured-thumb-x'); ?></a>
							</div>
							<div class='featured-item-description'>
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							</div>
						</div>
						
						
						<?php endwhile;
						// Reset Post Data
						wp_reset_postdata(); ?>
				</div>
			</div>
				
				<div id="pager" class=""></div>
						<a id="prev"></a>
						<a id="next"></a>		
							
		</div><!-- end left -->	
 		
 		<div class="cat-col-right">
	 		<div class="cfct-module cfct-html mod-gallery">	
				<h2>Topics</h2>
 			</div>
	 			<ul class="land-topics">
					<?php $cat_id = get_query_var('cat');
						wp_list_categories('hide_empty=0&title_li=&child_of=' . $cat_id);		
						?>
	 			</ul>
 		</div>
 		
	<?php } else if (is_category('land-management')){ 
	//LAND MANAGEMENT PAGE
	?>
		<div class="cat-col-left">
				<?php
					$count = 0;
					$args = array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'category_name' => 'land-management',
					'orderby' => 'date',
					'order' => 'DESC',
					'posts_per_page' => 4,
					);
					// The Query
					$the_query = new WP_Query( $args ); ?>
			
			<div id="slideshow_mask">
				<div id="slideshow">
					
	
					<?php // The Loop
					while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					
					
						<div class='featured-item-pane cat-slide'>
							<div class='featured-item-image'>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large-featured-thumb-x'); ?></a>
							</div>
							<div class='featured-item-description'>
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							</div>
						</div>
						
						
						<?php endwhile;
						// Reset Post Data
						wp_reset_postdata(); ?>
				</div>
			</div>
				
				<div id="pager" class=""></div>
						<a id="prev"></a>
						<a id="next"></a>		
							
		</div><!-- end left -->	
 		
 		<div class="cat-col-right">
	 		<div class="cfct-module cfct-html mod-gallery">	
				<h2>Topics</h2>
 			</div>
	 			<ul class="land-topics">
					<?php $cat_id = get_query_var('cat');
						wp_list_categories('hide_empty=0&title_li=&child_of=' . $cat_id);		
						?>
	 			</ul>
 		</div>
 		
	<?php } else if (is_category('deer-of-the-day')){ 
	//DOD PAGE
	?>
		<div class="cat-col-full">
				<?php
					$count = 0;
					$args = array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'category_name' => 'deer-of-the-day',
					'orderby' => 'date',
					'order' => 'DESC',
					'posts_per_page' => 4,
					);
					// The Query
					$the_query = new WP_Query( $args ); ?>
			
			<div id="slideshow_mask" class="featured-thumb-wide">
				<div id="slideshow">
					
	
					<?php // The Loop
					while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					
					
						<div class='featured-item-pane cat-slide'>
							<div class='featured-item-image'>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('huge-thumbs'); ?></a>
							</div>
							<div class='featured-item-description'>
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							</div>
						</div>
						
						
						<?php endwhile;
						// Reset Post Data
						wp_reset_postdata(); ?>
				</div>
			</div>
				
				<div id="pager" class=""></div>
						<a id="prev"></a>
						<a id="next"></a>		
							
		</div><!-- end left -->	
 		
	<?php } else if (is_category('gear')){ 
	//DOD PAGE
	?>
		<div class="cat-col-left">
				<?php
					$count = 0;
					$args = array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'category_name' => 'gear',
					'orderby' => 'date',
					'order' => 'DESC',
					'posts_per_page' => 4,
					);
					// The Query
					$the_query = new WP_Query( $args ); ?>
			
			<div id="slideshow_mask">
				<div id="slideshow">
					
	
					<?php // The Loop
					while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					
					
						<div class='featured-item-pane cat-slide'>
							<div class='featured-item-image'>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large-featured-thumb-x'); ?></a>
							</div>
							<div class='featured-item-description'>
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							</div>
						</div>
						
						
						<?php endwhile;
						// Reset Post Data
						wp_reset_postdata(); ?>
				</div>
			</div>
				
				<div id="pager" class=""></div>
						<a id="prev"></a>
						<a id="next"></a>		
							
		</div><!-- end left -->	
 		
 		<div class="cat-col-right">
	 		<div class="cfct-module cfct-html mod-gallery">	
				<h2>Topics</h2>
 			</div>
	 			<ul class="land-topics">
					<?php $cat_id = get_query_var('cat');
						wp_list_categories('hide_empty=0&title_li=&child_of=' . $cat_id);		
						?>
	 			</ul>
 		</div>
 		
 		 		
	<?php } else if (is_category('video')){ 
	//VIDEO PAGE
	?>
		<div class="cat-col-full">
			<!-- Start of Brightcove Player -->
			<div style="display:none">
			Stan Potts and Kandi Kisky muzzleload for trophy whitetails in Illinois and Iowa, and a huge Wisconsin buck is profiled.; The late season produces fast whitetail action as Don Kisky bowhunts Iowa and Gordon Whittington uses a muzzleloader to Ohio.; Stan Potts bowhunts the Illinois rut, and Kaleb Kisky gets a shock during Iowa?s late blackpowder season.; Kandi Kisky muzzleloads Iowa?s late season, while Dr. James Kroll hunts Kansas whitetails with both rifle and crossbow.; A small food plot in Kansas provides plenty of early-season action as Gordon Whittington and Brent Beimert decoy trophy bucks into bow range.; Stan Potts and friends head to Texas for a fun whitetail hunt during the rut. Dr. James Kroll shares tips on managing timber for deer.; A 218-year-old ranch is the legendary setting for Dr. James Kroll and Gordon Whittington?s pursuit of trophy bucks in South Texas.; Greg Miller decoys an early-season buck in South Dakota, while Kandi Kisky uses her muzzleloader in Iowa?s frigid late season.; Gordon Whittington rifle hunts the rainy rut in Missouri, and Stan Potts joins his friend Eddie Salter in trying to arrow a Kansas trophy.; Dr. James Kroll hunts the whitetail rut in North Texas, while Don Kisky bowhunts southern Iowa?s early season.; Stan Potts heads to southeastern Montana for a rifle hunt, and Gordon Whittington pursues Washington?s mountain whitetails in bow season.; Stan Potts finds himself covered up in Ohio bucks during bow season, while Dr. James Kroll travels to South Texas for a late-season gun hunt. A Tennessee whitetail is the focus of the ?Muzzy Moment? segment. Airs week of November 30 (Ep. 10).; Gordon Whittington stalks a post-rut Texas whitetail, and Kandi Kisky tries to smoke a trophy during Iowa?s late season. The ?Muzzy Moment? features several whitetails that definitely are having a ?bad hair? day. Airs week of December 7 (Ep. 11).; Stan Potts rifle hunts the Texas rut, and Gordon Whittington matches his bowhunting skills against bucks in Kansas. On the ?Dr. Deer? segment, Dr. James Kroll explains ways to minimize drought problems in plots. Airs week of December 14 (Ep. 12).; The King Ranch in Texas hosts Dr. James Kroll on a deer hunt. Meanwhile, Duncan Dobie sees his birthday wish come true in Iowa?s late season. The ?Big Buck Profile? features a world record buck that never was. Airs week of December 21 (Ep. 13).; Stan Potts bowhunts an early-season hotspot in Wyoming, while Gordon Whittington checks out a new piece of deer habitat during the Missouri rut. Also featured is a profile of Canada?s biggest whitetail of all time. (Ep. 1).; 2009; deer; Gordon Whittington; Naw; NAWT; North American Whitetail; promo; Stan Potts; whitetail; Dr. James Kroll discovers a new way to hunt Texas whitetails, and Stan Potts return to western Illinois for a rut bowhunt. Plus, the bowhunter who took the world?s top whitetail of 2008 tells how he did it. (Ep. 2); 2009; crossbow; deer; dr.; James Kroll; Naw; NAWT; North American Whitetail; promo; Stan Potts; whitetail; Duncan Dobie hunts Kansas during the early muzzleloader season. Then bowhunter Kandi Kisky matches wits with an Iowa giant. The ?Muzzy Moment? looks at a North Carolina boy?s amazing day in the deer woods. (Ep. 3); 2009; deer; Duncan Dobie; Kandi Kisky; Naw; NAWT; North American Whitetail; promo; whitetail; Gordon Whittington bowhunts big deer in Maryland waterfowl country, and Greg Miller checks out a new hotspot in Indiana. The ?Muzzy Moment? features stunning trail camera shots of a shockingly big Illinois buck. (Ep. 4).; 2009; deer; Gordon Whittington; Greg Miller; Indiana; Maryland; Naw; NAWT; North American Whitetail; promo; whitetail; Dr. James Kroll experiences an ?old school? deer hunt in northern Michigan, while Don Kisky bowhunts an Iowa monster in the snow. The ?Big Buck Profile? examines one of Ohio?s most impressive non-typicals of all time. Airs week of October 26 (Ep. 5).; 2009; deer; Don Kisky; dr.; iowa; James Kroll; michigan; Naw; NAWT; North American Whitetail; promo; whitetail; Stan Potts hunts the early-season feeding pattern in Kentucky. Then Kandi Kisky hits the ground to bowhunt the corn during Iowa?s late season. A big Ohio buck stuck in the muck is the star of the ?Muzzy Moment.? Airs week of November 2 (Ep. 6).; bow; Naw; north american; whitetail; Dr. James Kroll battles extreme wind as he challenges a late-rut buck in Kansas. Then Gordon Whittington hits the Wyoming rut for a great rifle hunt. Airs week of November 9 (Ep. 7).; Stan Potts uses a decoy to bowhunt the rut in Illinois, while Kaleb Kisky muzzleloads Iowa?s late season. The ?Muzzy Moment? shares video footage of a Pennsylvania whitetail that might be the ?dizziest? deer ever. Airs week of November 16 (Ep. 8).; Greg Miller fakes out a big Kentucky whitetail, and Gordon Whittington goes eye to eye with a brute in South Dakota. The ?Muzzy Moment? recounts an Iowa hunter?s shockingly close encounter with a belligerent buck. Airs week of November 23 (Ep. 9).; The View-All player for www.northamericanwhitetail.com 
			</div>
			<script src="http://admin.brightcove.com/js/experience_util.js" type="text/javascript"></script>
			<script type="text/javascript">
			 // By use of this code snippet, I agree to the Brightcove Publisher T and C 
			 // found at http://corp.brightcove.com/legal/terms_publisher.cfm. 
			
			 var config = new Array();
			
			 /* 
			 * feel free to edit these configurations
			 * to modify the player experience
			 */
			 config["videoId"] = null; //the default video loaded into the player
			 config["videoRef"] = null; //the default video loaded into the player by ref id specified in console
			 config["lineupId"] = null; //the default lineup loaded into the player
			 config["playerTag"] = null; //player tag used for identifying this page in brightcove reporting
			 config["autoStart"] = false; //tells the player to start playing video on load
			 config["preloadBackColor"] = "#dcc5ad"; //background color while loading the player
			
			
			 /* do not edit these config items */
			 config["playerId"] = 1388789768;
			 config["width"] = 988;
			 config["height"] = 550;
			
			 createExperience(config, 8);
			</script>
			<!-- End of Brightcove Player -->		
			
		</div>
 		<div class="divider"></div>
	<?php }	?>
	<?php if (is_category('video')){ ?>
	<div class="bonus-background video-padd">
		<div class="sidebar">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-default')) : else : ?><?php endif; ?>
		</div>
	</div>
	<?php } ?>
	<div class="col-abc">
	<div class="header-sort">
			<h1 class="more-header">More <?php single_cat_title(''); ?></h1>
			<div class='cssmenu'>
				<ul>
				   <li><a href='#' class="dd"><span>Sort</span><span class="dd-arrow"></span></a>
				      <ul>
				         <li><a href='#'><span>Recent</span></a></li>
				         <li><a href='#'><span>Commented</span></a></li>
				      </ul>
				   </li>
				</ul>
			</div>
		</div>

		<?php
		cfct_loop();
		cfct_misc('nav-posts'); ?>
	</div>

<?php
get_footer(); ?>
