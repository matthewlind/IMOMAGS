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

get_header();

the_post();
?>
<div class="page-template-page-tactics-php page-template-page slider-height">
	<header class="header-title">
		<h1><?php the_title(); ?></h1>
		<div class='questions-page-nav'>
				<ul>
				   <li class="plus-button"><a href="#"><span class="plus">+</span><span>Ask A Question</span></a></li>
				   <li class="plus-button"><a href="#"><span>Sign In</span></a></li>
				   <li class="plus-button reg"><a href="#"><span>Register</span></a></li>
				</ul>
			</div>
		
		<div class="naw-ad"></div>
	</header>	
	<div class="bonus-background">
		<div class="sidebar">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-default')) : else : ?><?php endif; ?>
		</div>
	</div>
	<div class="col-abc">
		<!-- Questions -->
		<div class="questions-slider">
            <div class="otd-questions">
                <div class="slides-container-f">
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
			<div class="clear"></div>		
		
		<!-- Loop -->
		<div class="header-sort">
			<h1 class="more-header">More Questions</h1>
					</div>
					<div class="questions-slider q-loop">
			            <div class="otd-questions">
			                <div class="slides-container-f">
			                     <ul class="jcarousel-skin-tango">
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
			<div class="clear"></div>
								
											
		<?php edit_post_link(__('Edit', 'carrington-business')); ?>

	</div><!-- .col-abc -->
</div>
<?php get_footer(); ?>