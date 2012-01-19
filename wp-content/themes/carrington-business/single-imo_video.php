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
?>


<div class="col-ab">
	<?php
	
if (have_posts()) :
   while (have_posts()) :
      the_post();
      ?>
      <?php
      
      $video_id = get_post_meta(get_the_ID(), '_video_id', TRUE);
      $player_id = get_option("bc_player_id", _BC_DEFAULT_PLAYER_ID );
      $player_key = get_option("bc_player_key", _BC_DEFAULT_PLAYER_KEY);
      $adServerURL = "http://ad.doubleclick.net/pfadx/" .  get_option("dart_domain", _imo_dart_guess_domain())  ."/video";
      $video_link = !empty($the_ID) ? get_permalink($the_ID) :  site_url() . $_SERVER['REQUEST_URI'];
      
      ?>
      <h1><?php the_title();?></h1>
      
            <!-- Start of Brightcove Player -->

	<p><script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script></p>
	<p><object id="myExperience" class="BrightcoveExperience">
		<param name="bgcolor" value="#FFFFFF" />
		<param name="width" value="620" />
		<param name="height" value="350" />
		<param name="playerID" value="<?php echo $player_id;?>" />
		<param name="playerKey" value="<?php echo $player_key; ?>" />
		<param name="isVid" value="true" /><param name="isUI" value="true" />
		<param name="dynamicStreaming" value="true" />
		<param name="linkBaseURL" value="<?php echo $video_link; ?>" />
		<param name="@videoPlayer" value="<?php echo $video_id; ?>" />
		<param name="adServerURL" value="<?php echo $adServerURL; ?>" />
		<param name="media_delivery" value="http" />
		</object></p>
	<p><!--<br />
	This script tag will cause the Brightcove Players defined above it to be created as soon<br />
	as the line is read by the browser. If you wish to have the player instantiated only after<br />
	the rest of the HTML is processed and the page load is complete, remove the line.<br />
	--><br />
	<script type="text/javascript">brightcove.createExperiences();</script></p>
      
      <p><?php the_content();?></p>
      
      

	
      
      
      
      <?php
      
      

      // do something for each post
   endwhile;
endif;
	?>
</div>

<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-video')) : else : ?><?php endif; ?>
<?php
get_footer();
?>
