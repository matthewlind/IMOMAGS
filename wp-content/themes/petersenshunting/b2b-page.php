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
								<div class="links-aside">
									<img src="/wp-content/themes/petersenshunting/images/b2b/states/new-mexico.png">
									<ul class="list-links-aside">
										<li><a href="">Plan your DIY trip to New Mexico</a><i class="fa fa-angle-double-right"></i></li>
										<li><a href="">Places we hunted</a><i class="fa fa-angle-double-right"></i></li>
										<li><a href="">License Requirements and Fees</a><i class="fa fa-angle-double-right"></i></li>
										<li><a href="">Some useful link</a><i class="fa fa-angle-double-right"></i></li>
									</ul>
								</div>
							</div>
							<p>New Mexico is an amazing state for hunters who love diversity. Home to some of North American’s only free range, fair chase “exotics”, New Mexico boasts a healthy population of aoudad, oryx and ibex as well as native game such as elk, mule deer, couse whitetail, mountain lion, black bears, desert and Rock Mountain big horn sheep. 
							</p>
							<p>For this expedition to be a success I have to get to Alaska before the winter sets in and the seasons close, which means we have to start early. Luckily one of the earliest seasons in the country is in New Mexico for antelope. Considering New Mexico also is home to the largest antelope in the United States that makes for a perfect place to start our adventure.
							</p>
							<div class="a-slideshow">
								<div class="a-slideshow-container">
									<div class="a-slideshow-images">
										<img src="/wp-content/themes/petersenshunting/images/b2b/placeholder-slideshow.jpg">
									</div>
									<div class="a-slideshow-thumbs">
										<img class="a-slideshow-thumb" src="/wp-content/themes/petersenshunting/images/b2b/thumb.jpg">
										<img class="a-slideshow-thumb a-slideshow-thumb--active" src="/wp-content/themes/petersenshunting/images/b2b/thumb.jpg">
									</div>
									<div class="a-slideshow-captions">
										<div class="a-slideshow-caption">
										For this expedition to be a success I have to get to Alaska before the winter sets in and the seasons close, which means we have to start early.
										</div>
									</div>
								</div>
							</div><!-- .a-slideshow -->
							<p>The only hook is the New Mexico antelope season runs for only three days starting in late August. I will be hunting 150 miles southeast of Raton, NM on a piece or property I never seen before, but have looked at topo maps and talked to guys who have hunted the property in previous years. Even though I am doing research before hitting the ground, three days isn’t a lot of time to get to know an area, find a good antelope and get a shot.
							</p>
							<p>Tick tock, tick tock… hopefully our first episode doesn’t come down to us eating tag soup 
							</p>
							<p>I will be joined on this hunt by outdoor writer and long time friend Jeff Johnston who is spending his fall vagabond around the west on his own cross country trip. Meeting up and sharing some laughs around the fire will be a great way to kick off the Border to Border adventure. 
							</p>
							<div class="species-info">
								<div class="species-description">
									<img src="">
									<h2>New Mexico Antelope</h2>
									<p>The pronghorn, Antilocapra americana, is a species of artiodactyl mammal indigenous to interior western and central North America. Though not an antelope, it is often known colloquially in North America as the prong buck, pronghorn antelope, cabri (native American) or simply antelope[3] because it closely resembles the true antelopes of the Old World and fills a similar ecological niche due to convergent evolution										
									</p>
								</div>
								<div class="species-stats">
									<div class="stats-item">
										<span>2000</span>
										<p>Number of States to Cross</p>
										<span>(And 1 Canadian Province)</span>
									</div>
									<div class="stats-item">
										<span>2000</span>
										<p>Number of States to Cross</p>
										<span>(And 1 Canadian Province)</span>
									</div>
								</div>
							</div><!-- .species-info -->
						</div><!-- .a-text -->
						<div class="a-cell">
							<div class="a-inner-cell" style="background-image: url('/wp-content/themes/petersenshunting/images/b2b/tanzania-wildlife.jpg');"></div>
							<div class="a-cell-caption">
								<p>There are plenty of places to drop your kayak on the back side of the island. Bring a tow rope, a board for your jack, and a shovel to dig out with in case you get stuck.		
								</p>
							</div>
						</div>
					</section>		
					
					<?php $this_page_id=$wp_query->post->ID; ?>
					<?php
					$args = array(
						'posts_per_page' 	=> -1,
						'orderby'		 	=> 'date',
						'order'			 	=> 'ASC',
						'post_parent' 		=> $this_page_id,
						'post_type'      	=> 'page',
						'meta_key'			=> 'is_episode',
						'meta_value'  		=> '1',
						'meta_key'			=> 'is_episode',					
					);

					query_posts($args);
					
					if (have_posts())
					{
						while (have_posts())
						{
							the_post();
							
					$ep_num = get_field("episode_number");
					?>
					<section class="episode<?php echo $ep_num ?>">	
						<div class="episode-heading a-text">
							<div><span>#<?php echo $ep_num ?></span></div>
							<h1>New Mexico Antelope</h1>
						</div>
						<div class="a-text">
							<div class="block-aside">
								<div class="links-aside">
									<img src="/wp-content/themes/petersenshunting/images/b2b/states/new-mexico.png">
									<ul class="list-links-aside">
										<li><a href="">Plan your DIY trip to New Mexico</a><i class="fa fa-angle-double-right"></i></li>
										<li><a href="">Places we hunted</a><i class="fa fa-angle-double-right"></i></li>
										<li><a href="">License Requirements and Fees</a><i class="fa fa-angle-double-right"></i></li>
										<li><a href="">Some useful link</a><i class="fa fa-angle-double-right"></i></li>
									</ul>
								</div>
							</div>
							<p>New Mexico is an amazing state for hunters who love diversity. Home to some of North American’s only free range, fair chase “exotics”, New Mexico boasts a healthy population of aoudad, oryx and ibex as well as native game such as elk, mule deer, couse whitetail, mountain lion, black bears, desert and Rock Mountain big horn sheep. 
							</p>
							<p>For this expedition to be a success I have to get to Alaska before the winter sets in and the seasons close, which means we have to start early. Luckily one of the earliest seasons in the country is in New Mexico for antelope. Considering New Mexico also is home to the largest antelope in the United States that makes for a perfect place to start our adventure.
							</p>
							<div class="a-slideshow">
								<div class="a-slideshow-container">
									<div class="a-slideshow-images">
										<img src="/wp-content/themes/petersenshunting/images/b2b/placeholder-slideshow.jpg">
									</div>
									<div class="a-slideshow-thumbs">
										<img class="a-slideshow-thumb" src="/wp-content/themes/petersenshunting/images/b2b/thumb.jpg">
										<img class="a-slideshow-thumb a-slideshow-thumb--active" src="/wp-content/themes/petersenshunting/images/b2b/thumb.jpg">
									</div>
									<div class="a-slideshow-captions">
										<div class="a-slideshow-caption">
										For this expedition to be a success I have to get to Alaska before the winter sets in and the seasons close, which means we have to start early.
										</div>
									</div>
								</div>
							</div><!-- .a-slideshow -->
							<p>The only hook is the New Mexico antelope season runs for only three days starting in late August. I will be hunting 150 miles southeast of Raton, NM on a piece or property I never seen before, but have looked at topo maps and talked to guys who have hunted the property in previous years. Even though I am doing research before hitting the ground, three days isn’t a lot of time to get to know an area, find a good antelope and get a shot.
							</p>
							<p>Tick tock, tick tock… hopefully our first episode doesn’t come down to us eating tag soup 
							</p>
							<p>I will be joined on this hunt by outdoor writer and long time friend Jeff Johnston who is spending his fall vagabond around the west on his own cross country trip. Meeting up and sharing some laughs around the fire will be a great way to kick off the Border to Border adventure. 
							</p>
							<div class="species-info">
								<div class="species-description">
									<img src="">
									<h2>New Mexico Antelope</h2>
									<p>The pronghorn, Antilocapra americana, is a species of artiodactyl mammal indigenous to interior western and central North America. Though not an antelope, it is often known colloquially in North America as the prong buck, pronghorn antelope, cabri (native American) or simply antelope[3] because it closely resembles the true antelopes of the Old World and fills a similar ecological niche due to convergent evolution										
									</p>
								</div>
								<div class="species-stats">
									<div class="stats-item">
										<span>2000</span>
										<p>Number of States to Cross</p>
										<span>(And 1 Canadian Province)</span>
									</div>
									<div class="stats-item">
										<span>2000</span>
										<p>Number of States to Cross</p>
										<span>(And 1 Canadian Province)</span>
									</div>
								</div>
							</div><!-- .species-info -->
						</div><!-- .a-text -->
						<div class="a-cell">
							<div class="a-inner-cell" style="background-image: url('/wp-content/themes/petersenshunting/images/b2b/tanzania-wildlife.jpg');"></div>
							<div class="a-cell-caption">
								<p>There are plenty of places to drop your kayak on the back side of the island. Bring a tow rope, a board for your jack, and a shovel to dig out with in case you get stuck.		
								</p>
							</div>
						</div>
					</section>	
					
					<?php			
						}
					}
					else
					{
						echo '<h2>Not Found</h2>';
					}

					wp_reset_query();
				?>		
				</article><!-- #article-wrap -->
						
						
					<!-- </div> .show-video -->
            </div><!-- #content -->
        </div>
    </div><!-- #primary -->
<?php get_footer(); ?>
