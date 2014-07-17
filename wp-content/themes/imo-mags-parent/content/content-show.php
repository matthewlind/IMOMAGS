<?php
/**
 * The template used for displaying page content in show-page.php
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
$dataPos = 0;
?>
<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
	<div id="header-top">
		<div class="shows-logo">
			<img src="<?php bloginfo('stylesheet_directory'); ?>/images/shows/petersenhuntlogo_color.png" alt="">
		</div>
		<div class="shows-title">
		<div>
			<h1 class="page-title<?php if(is_page("guns-ammo-tv-2")){ echo ' section-title videos'; } ?>">
				<div class="icon"></div>
				<span><?php 
				//leverage some of the advanced custom fields to add content here instead of the default WP title	
				the_title(); 				
				?></span>
		    </h1>
		</div>
		    <div class="fb-like" data-href="https://www.facebook.com/PetersensHuntingMag" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false">			    
		    </div>
		</div><!-- end of #shows-title -->
		<div class="shows-sponsor">
			<span>presented by</span>
			<img src="<?php bloginfo('stylesheet_directory'); ?>/images/shows/federal-logo.png" alt="">
		</div>
	</div><!-- end of #header-top -->
	<div id="shows-nav">
		<?php	wp_nav_menu( array( 'theme_location' => 'shows_menu', 'container' => '0' ) ); ?>
	</div>
</div><!-- end of .page-header -->


<div id="shows-player-area">
	<div id="when-to-watch">
		<div class="when-label">
			<h3>WHEN TO<br>WATCH</h3>
		</div>
		<div class="schedule-item">
			<span class="episode-title">Episode 11: Bezoar libex</span><br>
			<span class="episode-time">Jun 02: SUN 9:00pm ET/PT</span>
		</div>
		<div class="schedule-item">
			<span class="episode-title">Episode 11: Bezoar libex</span><br>
			<span class="episode-time">Jun 02: SUN 9:00pm ET/PT</span>
		</div>
		<div class="schedule-item">
			<span class="episode-title">Episode 11: Bezoar libex</span><br>
			<span class="episode-time">Jun 02: SUN 9:00pm ET/PT</span>
		</div>
		<div class="remind-me">
			<span>REMIND ME<br> TO WATCH</span>
		</div>
	</div><!-- end of #when-to-watch -->
	<div id="video-player-area">
		<div class="video-player-wrap">
			<div class="player">
			</div>
		</div>
		<div class="new-show"></div>
	</div><!-- end of #video-player-area -->
	<div id="description-area">
		<div class="unify">
			<span class="show-video-date">THURSDAY, JUNE 5, 2014</span>
			<h1>Thalay Sagar: Prayers in the Wind</h1>
			<p>Lorem ipsum dolor sit amet, Paul McSorley and Joshua, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.
			</p>
			<div class="social-share">
				<div class="share-results">
					<span>2K</span>				
					<div class="shares"><span>SHARES</span></div>		
				</div>
				<div class="social-share-btns">
					<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" title="Share on Facebook.">
						<div class="facebook-share">
							<i class="fa fa-facebook"></i>
						</div>
					</a>
					<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
						<div class="google-share">
							<i class="fa fa-google-plus"></i>
						</div>
					</a>
					<a href="http://twitter.com/home/?status=<?php the_title(); ?> - <?php the_permalink(); ?>" title="Tweet this!">
						<div class="twitter-share">
							<i class="fa fa-twitter"></i>
						</div>	
					</a>
				</div>
			
			</div><!-- end of .social-share -->
		</div><!-- end of .unify -->
		<div class="ad-block">

		</div>
		<!-- this widget is located in imo-mags-parent/widgets -->
		<?php get_template_part( 'widgets/sportsmanLocator' ); ?>		
		
	</div><!-- end of #description-area -->
</div><!-- end of #shows_player_area -->
<div id="sponsors-area">
	<div class=""
</div>
<div data-position="<?php echo $dataPos = $dataPos + 1; ?>"  id="post-<?php the_ID(); ?>" <?php post_class('clearfix js-responsive-section'); ?>>
	<?php 
	
	
	//leverage some of the advanced custom fields to add content here instead of the default WP content	
	//the_content(); 
	
	
	
	?>
</div><!-- #post-<?php the_ID(); ?> -->
               

