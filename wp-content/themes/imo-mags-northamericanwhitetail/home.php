<?php

/**
 * Template Name: Home Page+
 * Description: Homepage for the new NAW+
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
?>
<div class="page-template-page-right-php">	

	<!-- Carrington Section w/ Sidebar Top -->	
	<div class="bonus-background">
		<div class="bonus">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-home-top')) : else : ?><?php endif; ?>
		</div>
	</div>
	<div class="col-abc">
				<?php the_content(__('Continued&hellip;', 'carrington-business')); ?>
	
	<!--</div> .col-abc -->		

<!-- Super post section -->
<!--<div class="col-abc super-post">
    <div <?php //post_class('entry entry-full clearfix'); ?>>-->
    	<!-- This section is commented out until we add community features-->
<!--         <div class="entry-content">
            <hr class="comm-sep">
            <h1 class="recon">Naw+ Community</h1>
            <div id="user-login-button">
                LOGIN
            </div>
            <div class='cssmenu'>
				<ul>
				   <li><a href='#' class="dd"><span>State Activity</span><span class="dd-arrow"></span></a>
				      <ul>
				         <li><a href='#'><span>Product 1</span></a></li>
				         <li><a href='#'><span>Product 2</span></a></li>
				      </ul>
				   </li>
				</ul>
			</div>
            <div class="toggle">
            	<a id="toggle-tile" class="tile-on"></a>
            	<span class="toggle-sep"></span>
            	<a id="toggle-list" class="list-off"></a>
            </div>
            <ul class="post-type-select">
            	<li id="new-post-button" class="post"><span>+</span> Post</li>
                <li class='selected' title='all'>ALL</li>
                <li title='report'>Reports</li>
                <li title='tip'>Tips</li>
                <li title='lifestyle'>LifeStyles</li>
                <li title='trophy'>Trophy Bucks</li>
                <li title='gear'>Gear</li>
                <li class="dd-arrow"></li>


            </ul>    

            <div id="recon-activity">


            </div>
            <span id="more-superposts-button">Load More<span></span></span>



        </div> -->
    <!-- </div><!-- .entry -->
 <!-- </div><!-- .col-abc -->
	 <!-- <div class="clear"></div>
	<!-- Editor's Picks w/ Sidebar Bottom -->		
	<!-- <div class="bonus-background">
		<div class="bonus">
			<?php //if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-home-bottom')) : else : ?><?php //endif; ?>
		</div>
	</div>
	
	<div class="col-abc">
		<div <?php //post_class('entry entry-full clearfix'); ?>>
			<div class="entry-content">
				<div class="clear"></div>
					<div class="header-sort home-questions">
						<h1 class="more-header">Latest Questions</h1>
						<div class='questions-right'>
							<ul>
							   <li class="plus-button"><a href="#"><span class="plus">+</span><span>Ask A Question</span></a></li>
							   <li class="plus-button"><a href="#"><span>Sign In</span></a></li>
							   <li class="plus-button reg"><a href="#"><span>Register</span></a></li>
							</ul>
						</div>
					</div>
					<div class="questions-slider">
			            <div class="otd-questions">
			                <div class="slides-container-f">
			                	<div class="see-all home-see-all">See All Questions</div>
			                     <ul id="slides-questions" class="jcarousel-skin-tango">
			                        	<li>
			                        		<div class="user-info">
			                        			<img alt="user photo" src="http://www.northamericanwhitetail.fox/wp-content/themes/imo-mags-northamericanwhitetail/img/user-temp.jpg">
			                        			<span>Batman asks...</span>
			                        		</div>
			                        		<div class="quote-area">
			                        			<div class="top"></div>
			                        			<div class="mdl">
				                        			<h4 class="quote">&#8220;I am going on a late season muzzle-loader hunt for whitetails in western PA this weekend. Any idea on how I should go about hunting them?&#8221;</h3>
				                        		</div>
			                        			<div class="btm"></div>
			                        		</div>
			                        		<div class="answers-area">
			                        			<div class="answers-count">
			                        				Answers <span class="count">18</span>
			                        			</div>
			                        			<div class="answers-link">Answer This Question</div>                   
			                        		</div>
			                        	</li>

<li>
			                        		<div class="user-info">
			                        			<img alt="user photo" src="http://www.northamericanwhitetail.fox/wp-content/themes/imo-mags-northamericanwhitetail/img/user-temp.jpg">
			                        			<span>Batman asks...</span>
			                        		</div>
			                        		<div class="quote-area">
			                        			<div class="top"></div>
			                        			<div class="mdl">
				                        			<h4 class="quote">&#8220;Can anyone suggest a good camo bat-suit for hunting in the forest? I am having trouble hunting in the day time.&#8221;</h3>
				                        		</div>
			                        			<div class="btm"></div>
			                        		</div>
			                        		<div class="answers-area">
			                        			<div class="answers-count">
			                        				Answers <span class="count">18</span>
			                        			</div>
			                        			<div class="answers-link">Answer This Question</div>                   
			                        		</div>
			                        	</li>
			                        </ul>
				                 </div>    
				            </div>
				  </div>
			<div class="clear"></div> -->
	<div style="height:30px;"></div>
				<div class="header-sort">
					<h1 class="more-header">Editor's Picks</h1>
					<div class='cssmenu'>
						<ul>
						   <li><a href='#' class="dd"><span>Sort</span><span class="dd-arrow"></span></a>
						      <ul>
						         <li><a href='#'><span>Category 1</span></a></li>
						         <li><a href='#'><span>Category 2</span></a></li>
						      </ul>
						   </li>
						</ul>
					</div>
				</div>
				<div class="cross-site-feed" term=""><!-- This term= attribute is searched for by displayCrossSiteFeed() in cross-site-feed.js -->

				</div>

				
			</div>
			<?php edit_post_link(__('Edit', 'carrington-business')); ?>
		</div><!-- .entry -->
	</div><!-- .col-abc -->
	<!-- Bottom Widget Area -->
	<div class="gear-slider">
		<h1 class="more-header">Gear Reviews</h1>
		<aside class="widget widget_slider-widget">
			<div class="scroll_mask">				
				<ul id="slides-gear" class="scroll">
				<?php
				//Most Recent
				$the_query = new WP_Query( array( 'category_name' => 'gear','posts_per_page' =>-1, 'orderby' => 'date', 'order' => 'DESC' ) );
				while ( $the_query->have_posts() ) : $the_query->the_post(); 
					if(has_post_thumbnail()){  
						foreach($the_query as $query) ?>
						<li><a href="<?php echo $query->guid; ?>"><?php the_post_thumbnail('gear-thumb'); ?></a></li>
    					<?php
						}
				endwhile;	
				// Reset Post Data
				wp_reset_postdata();
				?>
	  			</ul>
			</div>
			<a class="prev">Previous</a>
			<a class="next">Next</a>
		</aside>
	</div>
	<!-- <div class="secondary">
		<?php //if (function_exists('dynamic_sidebar') && dynamic_sidebar('secondary-home')) : else : ?><?php //endif; ?>
	</div> -->
	<div class="clearfix"></div>
</div>
<?php get_footer(); ?>