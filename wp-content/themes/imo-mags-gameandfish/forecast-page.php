<?php

/**
 * Template Name: Forecast
 * Description: Forecast page
 *
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
$dartDomain = get_option("dart_domain", $default = false); 
get_header();

the_post();
?>
<div class="page-template-page-right-php">
	<header id="masthead">
		<h1>Game & Fish 2013 Deer Forecast</h1>
	</header>
		<?php if(mobile() == true){ ?>
					
			<div class="col-abc">
				<!-- 240x60 Ad: -->
                <script type="text/javascript">
                document.write(unescape('%3Cscript src="http://ad.doubleclick.net/adj/<?php echo $dartDomain; ?>/;camp=deerforecast;sect=;manf=;pos=;page=;subs=;sz=240x60;dcopt=;tile=;ord='+dartadsgen_rand+'?"%3E%3C/script%3E'));
                </script>
                <noscript>
                <a href="http://ad.doubleclick.net/adj/<?php echo $dartDomain; ?>/;camp=deerforecast;sect=;manf=;pos=;page=;subs=;sz=240x60;dcopt=;tile=;ord=6545512368?">
                <img src="http://ad.doubleclick.net/ad/<?php echo $dartDomain; ?>/;camp=deerforecast;sect=;manf=;pos=;page=;subs=;sz=240x60;dcopt=;tile=;ord=6545512368?" border="0" />
                </a>
                </noscript>
                <!-- END 240x60 Ad: -->

				<form name="menuform" class="forecast-menu">
				<select name="menu4">
					<option value="">Select Your State</option>
					<option value="/alabama-deer-forecast-2013">alabama</option>
					<option value="/rocky-mountain-deer-forecast-2013">arizona</option>
					<option value="/arkansas-deer-forecast-2013">arkansas</option>
					<option value="/california-deer-forecast-2013">california</option>
					<option value="/new-england-deer-forecast-2013">connecticut</option>
					<option value="/florida-deer-forecast-2013">florida</option>
					<option value="/georgia-deer-forecast-2013">georgia</option>
					<option value="/idaho-deer-forecast-2013">idaho</option>
					<option value="/illinois-deer-forecast-2013">illinois</option>
					<option value="/indiana-deer-forecast-2013">indiana</option>
					<option value="/iowa-deer-forecast-2013">iowa</option>
					<option value="/great-plains-deer-forecast-2013">kansas</option>
					<option value="/kentucky-deer-forecast-2013">kentucky</option>
					<option value="/louisiana-deer-forecast-2013">louisiana</option>
					<option value="/maine-deer-forecast-2013">maine</option>
					<option value="/new-england-deer-forecast-2013">massachusetts</option>
					<option value="/michigan-deer-forecast-2013">michigan</option>
					<option value="/minnesota-deer-forecast-2013">minnesota</option>
					<option value="/mississippi-deer-forecast-2013">mississippi</option>
					<option value="/missouri-deer-forecast-2013">missouri</option>
					<option value="/great-plains-deer-forecast-2013">nebraska</option>
					<option value="/new-england-deer-forecast-2013">new hampshire</option>
					<option value="/rocky-mountain-deer-forecast-2013">new mexico</option>
					<option value="/new-york-deer-forecast-2013">new york</option>
					<option value="/north-carolina-deer-forecast-2013">north carolina</option>
					<option value="/great-plains-deer-forecast-2013">north dakota</option>
					<option value="/ohio-deer-forecast-2013">ohio</option>
					<option value="/oklahoma-deer-forecast-2013">oklahoma</option>
					<option value="/washington-oregon-deer-forecast-2013">oregon</option>
					<option value="/pennsylvania-deer-forecast-2013">pennsylvania</option>
					<option value="/new-england-deer-forecast-2013">rhode island</option>
					<option value="/south-carolina-deer-forecast-2013">south carolina</option>
					<option value="/great-plains-deer-forecast-2013">south dakota</option>
					<option value="/tennessee-deer-forecast-2013">tennessee</option>
					<option value="/texas-deer-forecast-2013">texas</option>
					<option value="/vermont-deer-forecast-2013">vermont</option>
					<option value="/virginia-deer-forecast-2013">virginia</option>
					<option value="/washington-oregon-deer-forecast-2013">washington</option>
					<option value="/west-virginia-deer-forecast-2013">west virginia</option>
					<option value="/wisconsin-deer-forecast-2013">wisconsin</option>
					
				</select>
				<input type="button" name="Submit" value="Go" class="forecast-submit" onClick="window.location = this.form.menu4.options[this.form.menu4.selectedIndex].value;">
				</form>
				<?php if(is_page("deer-forecast")){ ?>
					<img src="<?php bloginfo("stylesheet_directory"); ?>/img/deer-forecast-logo-sm.png" alt="Deer Forecast" />
				<?php } ?>
			</div>
			<?php }else{ ?>
			
				<div class="forecast-map">	
					<div class="col-abc">
						<div class="<?php if(is_page("deer-forecast")){ echo 'sponsor-logo'; }else{ echo 'sponsor-logo-below'; } ?>">
							<div id="forecast"></div>
							<!-- 240x60 Ad: -->
			                <script type="text/javascript">
			                document.write(unescape('%3Cscript src="http://ad.doubleclick.net/adj/<?php echo $dartDomain; ?>/;camp=deerforecast;sect=;manf=;pos=;page=;subs=;sz=240x60;dcopt=;tile=;ord='+dartadsgen_rand+'?"%3E%3C/script%3E'));
			                </script>
			                <noscript>
			                <a href="http://ad.doubleclick.net/adj/<?php echo $dartDomain; ?>/;camp=deerforecast;sect=;manf=;pos=;page=;subs=;sz=240x60;dcopt=;tile=;ord=6545512368?">
			                <img src="http://ad.doubleclick.net/ad/<?php echo $dartDomain; ?>/;camp=deerforecast;sect=;manf=;pos=;page=;subs=;sz=240x60;dcopt=;tile=;ord=6545512368?" border="0" />
			                </a>
			                </noscript>
			                <!-- END 240x60 Ad: -->
						</div>
						<p class="state-name">Select Your State</p>
						<div id="us-map-forecast" style="min-width:840px;height:600px;padding:20px;margin-left:30px;position:absolute;top:50px;"></div>
					</div>
				</div>
				<?php if(is_page("deer-forecast")){ ?>
					<img src="<?php bloginfo("stylesheet_directory"); ?>/img/deer-forecast-logo-sm.png" alt="Deer Forecast" class="deer-logo" />
				<?php } ?>
			<?php } ?>
		
		
			 
	</div>
	<div class="forecast-content">
		<div class="bonus-background">
			<div class="bonus">
				<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-default')) : else : ?><?php endif; ?>
			</div>
			<div id="responderfollow"></div>
			<div class="sidebar advert">
				<?php imo_dart_tag("300x250",false,array("pos"=>"btf")); ?>
				<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : endif; ?>
			</div>
		</div>
	
		<div class="col-abc">
		<?php if(!is_page("deer-forecast")){ ?>
			<a href="/deer-forecast/">G&F Deer Forecast</a>
		<?php } ?>
		<h1><?php the_title(); ?></h1>
			<div <?php post_class('entry entry-full clearfix'); ?>>
				<div class="entry-content">
					<?php
					if (function_exists('imo_add_this')) {imo_add_this();}
					the_content(__('Continued&hellip;', 'carrington-business'));				
					?>
				</div>
				<?php edit_post_link(__('Edit', 'carrington-business')); ?>
			</div><!-- .entry -->
			<?php comments_template(); ?>
		</div><!-- .col-abc -->
	</div>
</div>
<?php get_footer(); ?>

