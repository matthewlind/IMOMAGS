<?php
/**
 * The template used for displaying page content in show-page.php
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
$postID = get_the_ID();

$idObj = get_category_by_slug('tv'); 
$id = $idObj->term_id;
$acfID = 'category_' . $id;

$video_id = get_post_meta(get_the_ID(), '_video_id', TRUE);
$adServerURL = "http://ad.doubleclick.net/pfadx/" .  get_option("dart_domain", _imo_dart_guess_domain())  ."/tv";
$videoLink = !empty($postID) ? get_permalink($postID) :  site_url() . $_SERVER['REQUEST_URI']; 

// post slug
$slug_tv = get_post( $post )->post_name; 
?>
<style type="text/css">
	body {
		background: url(<?php echo get_field('background_skin',$acfID); ?>);
	    background-repeat: no-repeat;
		background-size: 100% auto;
		background-color: #2a2a2a;
	}
</style>
<div id="show-destination" playerID="<?php echo get_field("tv_player_id","options"); ?>" adServerURL="<?php echo $adServerURL; ?>" videoLink="<?php echo $videoLink; ?>">
	<?php get_template_part( 'content/show-header' ); ?>
		<div class="sidebar-area">
			<div class="sidebar">
				<div class="widget_advert-widget">
				<?php imo_dart_tag("300x250"); ?>
				</div>
			</div>
			<?php get_sidebar(); ?>
		</div><!-- end of .sidebar-area -->
		<div class="show-child-general">
			<div class="show-child-general-frame">
				<div class="page-header clearfix js-responsive-section">
					<h1 class="page-title">
						<span><?php the_title(); ?></span>
				    </h1>
				</div>
				
				<div id="post-<?php the_ID(); ?>" <?php post_class('article-brief clearfix js-responsive-section'); ?>>
					<div class="article-holder">
						<?php the_content(); ?>
					</div>
				</div>
				
				<?php get_template_part( "content/tv-show/{$slug_tv}" ); ?>
			</div><!-- end of .show-child-general-frame -->
		</div><!-- end of .show-child-general -->
	</div><!-- end of #shows_player_area :::: this div ends an open div in the show header template-->
	<div id="shows-player-area">
		<div class="schedule-area">
			<div class="w-on-sportsman">
				
			</div>
			<div class="show-child-general">
				<div class="w2w-box">
					<div class="w2w-schedule">
						<h1>WHEN TO WATCH</h1>
						<ul class="w2w-list">
							<li>
								<span class="episode-title">Episode 11: Bezoar Libex</span><br>
								<span class="episode-time"><span>Premiere Date: </span>Jun 02: SUN 9:00pm ET/PT</span>
							</li>
							<li>
								<span class="episode-title">Episode 11: Bezoar Libex</span><br>
								<span class="episode-time"><span>Premiere Date: </span>Jun 02: SUN 9:00pm ET/PT</span>
							</li>
							<li>
								<span class="episode-title">Episode 11: Bezoar Libex</span><br>
								<span class="episode-time"><span>Premiere Date: </span>Jun 02: SUN 9:00pm ET/PT</span>
							</li>
						</ul>
						<div class="btn-green">
							<a href="#">remind me to watch</a>
						</div>
						<div class="grey-line"></div>
					</div><!-- end of .w2w-schedule -->
					<div class="w2w-get-sport">
						<img src="/wp-content/themes/imo-mags-parent/images/logos/sportsman-channel.png">
						<h4>GET SPORTSMAN CHANEL</h4>
						<script>
						function popwin(loc,winname,w,h,scroll,resize) {
							var newwin = window.open( loc, winname, "width="+w+",height="+h+",top="+((screen.height - h) / 2)+",left="+((screen.width - w) / 2)+",location=no,scrollbars="+scroll+",menubar=no,toolbar=no,resizable="+resize);
						} // function..popwin
						</script>
						
						    <div class="channelControlsContainer">
								<div class="channelControls">
								    <input type="text" name="zip" id="zip" onfocus="if(this.value == this.defaultValue) this.value = '';" value="Enter Your ZIP" class="searchbox" />
								    <a href="#" onclick="javascript:popwin('http://thesportsmanchannel.viewerlink.tv/?zip='+document.getElementById('zip').value,'indicator',615,550,'yes','yes');"><input type="submit" value="GET SPORTSMAN!" class="button" /></a>
								</div>
						    </div>
					</div><!-- end of .w2w-get-sport -->
				</div><!-- end of .w2w-box -->
			</div><!-- end of .show-child-general -->	
				
		</div><!-- end of .schedule-area -->
	</div><!-- end of #shows-player-area -->
	<div id="imo-store">
			
	</div>
	
	<?php get_template_part( 'content/show-sponsors' ); ?>
	</div>
	
</div>


	
	
	
	
	
	
	
	
	
	
	
