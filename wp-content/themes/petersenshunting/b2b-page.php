<?php
/**
 * Template Name: Border To Border Page
 * Description: A Page Template for Border To Border Show.
 *
 * The showcase template in Twenty Eleven consists of a featured posts section using sticky posts,
 * another recent posts area (with the latest post shown in full and the rest as a list)
 * and a left sidebar holding aside posts.
 *
 * We are creating two queries to fetch the proper posts and a custom widget for the sidebar.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>
	<div id="primary" class="general b2b">
        <div class="general-frame">
            <div id="content" role="main">
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header marquee-img clearfix js-responsive-section">
					<h1 class="page-title hidden-seo"><?php the_title(); ?></h1>
				</div>
				<div id="b2b-map">
					<div class="shadow-block"></div>
					<div id="map-wrap">
						<img id="b2b-map-img" src="/wp-content/themes/petersenshunting/images/b2b/b2b-map.jpg">
					</div>
				</div><!-- #b2b-map -->
				
				<div id="nav-wrap">
					<div id="shows-nav">
						<?php	wp_nav_menu( array( 'theme_location' => 'b2b', 'container' => '0' ) ); ?>
					</div>
				</div><!-- #b2b-nav-wrap -->
					
<!-- 					<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="show-video clearfix js-responsive-section"> -->
				<article id="article-wrap">
					<section class="about-show">
						<h1 class="a-text">The Overland Hunting Quest</h1>
						<div class="a-text">
							<div class="block-aside">
								<div class="ad-aside">
								<?php imo_dart_tag("300x250"); ?>
								</div>
							</div>
							<p>Border to Border was born by a desire to rekindle the adventure of hunting. Like the hunters of old who trekked through the West with only basic provisions, a map of the land and a desire to see new country, we intend to recapture that adventure and excitement in a modern world. The rules are simple and self imposed: travel overland from Mexico to Alaska hunting every state crossed. The only meat consumed is what is killed along the way. All hunts are on land open to the public. No fancy lodges or hotels—every one of the 45 nights will be spent camping out. No guides or outfitter, just friends and family.
							</p>
							<p>The goal of Border to Border is to not only entertain and rekindle the American love of adventure, but inspire, educate and motivate viewers for their own DIY hunting adventure.
							</p>
							<div class="overall-stats">
								<div class="stats-item">
									<span>6</span>
									<p>Number of States to Cross</p>
									<span>(And 1 Canadian Province)</span>
								</div>
								<div class="stats-item">
									<span>6000</span>
									<p>Number of Miles to Travel</p>
									<span>(Round Trip)</span>
								</div>
								<div class="stats-item">
									<span>2000</span>
									<p>Number of States to Cross</p>
									<span>(And 1 Canadian Province)</span>
								</div>
								<div class="stats-item">
									<span>8</span>
									<p>Number of States to Cross</p>
									<span>(And 1 Canadian Province)</span>
								</div>
								<div class="stats-item">
									<span>25</span>
									<p>Number of States to Cross</p>
									<span>(And 1 Canadian Province)</span>
								</div>
							</div>
						</div><!-- .a-text -->	
					</section><!-- .about-show -->	
					<section class="episode1">	
						<div class="episode-heading a-text">
							<div><span>#1</span></div>
							<h1>New Mexico Antelope</h1>
						</div>
						<div class="a-text">
							<div class="block-aside">
								<div class="ad-aside">
								<?php imo_dart_tag("300x250"); ?>
								</div>
							</div>
							<p>New Mexico is an amazing state for hunters who love diversity. Home to some of North American’s only free range, fair chase “exotics”, New Mexico boasts a healthy population of aoudad, oryx and ibex as well as native game such as elk, mule deer, couse whitetail, mountain lion, black bears, desert and Rock Mountain big horn sheep. 
							</p>
							<p>For this expedition to be a success I have to get to Alaska before the winter sets in and the seasons close, which means we have to start early. Luckily one of the earliest seasons in the country is in New Mexico for antelope. Considering New Mexico also is home to the largest antelope in the United States that makes for a perfect place to start our adventure.
							</p>
						</div>
					</section>				
				</article><!-- #article-wrap -->
						
						
					<!-- </div> .show-video -->
            </div><!-- #content -->
        </div>
    </div><!-- #primary -->
<?php get_footer(); ?>
