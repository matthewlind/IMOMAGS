<?php
/**
 * Template Name: Microsite Video
 * Description: When creating video page for a microsite the slug structure should be $cat_slug-video. Example bigger-bucks-video where bigger-bucks is category slug
 */
global $microsite, $microsite_default;
$microsite = true;
$microsite_default = true;
get_header();

$feat_video_id = get_field("feat_video_id");
$v_source = get_field("video_service");
$y_feat_title = "";

?>
<div class="content" id="uppp">
	<div class="mv-video-atf">
		<div class="mv-player-wrap">
			<div class="mv-player">
				<?php if ($v_source == 'youtube') { 
					$y_feat_title = get_field('youtube_video_title');
				?>
				<!-- YouTube Player -->
				<!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
			    <div id="player"></div>
			    <script>
					// 2. This code loads the IFrame Player API code asynchronously.
					var tag = document.createElement('script');
					tag.src = "https://www.youtube.com/iframe_api";
					var firstScriptTag = document.getElementsByTagName('script')[0];
					firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
					// 3. This function creates an <iframe> (and YouTube player)
					//    after the API code downloads.
					var player;
					function onYouTubeIframeAPIReady() {
						player = new YT.Player('player', {
							height: '390',
							width: '640',
							videoId: '<?php echo $feat_video_id; ?>',
							events: {
							'onReady': onPlayerReady,
							'onStateChange': onPlayerStateChange
							}
						});
					}
					// 4. The API will call this function when the video player is ready.
					function onPlayerReady(event) {
						event.target.playVideo();
					}
					// 5. The API calls this function when the player's state changes.
					//    The function indicates that when playing a video (state=1),
					//    the player should play for ten seconds and then stop.
					var done = false;
					function onPlayerStateChange(event) {
						if (event.data == YT.PlayerState.PLAYING && !done) {
							setTimeout(stopVideo, 10);
							done = true;
						}
					}
					function stopVideo() {
						player.stopVideo();
					}
	
					jQuery(document).ready(function($) {
						$("#mv_list > li").click(function(){
							var d = $(this),
								vid = d.data('vid'),
								title = d.find("h5").text();
								
							if(player) { player.loadVideoById(vid, 1, "large"); }
							$("html, body").animate({scrollTop: 70}, 1000, "swing");
							console.log("title: "+title);
							$("#mv_title").text(title);
						});
					
					});
			    </script>
			    <!-- End of YouTube Player -->
			    
			    <?php } else { ?>
			    
			    <!-- Brightcove Player -->
				<!--By use of this code snippet, I agree to the Brightcove Publisher T and C found at https://accounts.brightcove.com/en/terms-and-conditions/. -->
				<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>
				<div id="mv_player">
					<object id="myExperience" class="BrightcoveExperience">
						<param name="bgcolor" value="#FFFFFF" />
						<param name="playerID" value="5127750281001" />
						<param name="playerKey" value="AQ~~,AAAAALyrRUk~,m8Wuv4JIiTobaElEYjriRAAaiqhciIls" />
						<param name="isVid" value="true" />
						<param name="isUI" value="true" />
						<param name="dynamicStreaming" value="true" />
						<param name="@videoPlayer" value="<?php echo $feat_video_id; ?>" />
						<!-- smart player api params -->
						<param name="includeAPI" value="true" />
						<param name="templateLoadHandler" value="onTemplateLoaded" />
						<param name="templateReadyHandler" value="BCL.onTemplateReady" />
					</object>
					<!-- 
					This script tag will cause the Brightcove Players defined above it to be created as soon as the line is read by the browser. If you wish to have the player instantiated only after the rest of the HTML is processed and the page load is complete, remove the line.
					-->
					<script type="text/javascript">brightcove.createExperiences();</script>
				</div>
				<!-- End of Brightcove Player -->
				<script>
					var videoPlayer;
					
					// On page load, add title and description text
					function onTemplateLoaded(id) {
						var player = brightcove.api.getExperience(id);
						videoPlayer = player.getModule(brightcove.api.modules.APIModules.VIDEO_PLAYER);
						
						setTimeout(function(){
							videoPlayer.getCurrentVideo( function(video) {
								var display_name = video.displayName,
								long_desc = video.longDescription;
								jQuery("#mv_title").text(display_name);
								if (long_desc == null) { jQuery("#mv_description").text(""); } else { jQuery("#mv_description").text(long_desc);}
								
							});
						}, 400)
					}
					
					jQuery(document).ready(function($) {
						$("#mv_list > li").click(function(){
							var d = $(this),
								vid = d.data('vid'),
								title = d.find("h5").text();
								
							videoPlayer.loadVideoByID(vid);
							setTimeout(function(){
								videoPlayer.getCurrentVideo( function(video) {
									display_name = video.displayName,
									long_desc = video.longDescription;
									jQuery("#mv_title").text(display_name);
									if (long_desc == null) { jQuery("#mv_description").text("");} else {jQuery("#mv_description").text(long_desc);}
								});
							}, 400)
							$("html, body").animate({scrollTop: 70}, 1000, "swing");
						});
					
					});
				</script>			    
			    <?php } ?>
			</div>
			
			<div id="mv_info" class="mv-info clearfix">
				<h1 id="mv_title"><?php echo $y_feat_title; ?></h1>
				<p id="mv_description"></p>
				<div id="mv_ad" class="mv-ad">
					<script>
					googletag.cmd.push(function() { googletag.display('microsite_video_page'); });
					</script>
				</div>
			</div>
		</div>
	</div>
	<?php if( have_rows('video_menu') ) { ?>
	<div class="mv-menu-wrap">
		<ul id="mv_menu" class="mv-menu">
			<li class="active" data-vcat="all"><a href="#">all</a></li>
			<?php
			    while ( have_rows('video_menu') ) { the_row();
					$video_cat = get_sub_field('category_name');
					echo '<li data-vcat="'.$video_cat.'"><a href="#">'.$video_cat.'</a></li>';
			    }
			?>
		</ul>
	</div>
	<?php } ?>
	<div class="mv-video-wrap" id="video_wrap">
		<ul id="mv_list" class="mv-video-list clearfix">
			<?php
			if( have_rows('video') ) {
			    while ( have_rows('video') ) { the_row();
					$video_id = get_sub_field('video_id');
					$title = get_sub_field('title');
					
					if ($v_source == 'youtube') {
						$vm_image = 'http://img.youtube.com/vi/'.$video_id.'/0.jpg';
					} else {
						$vm_image = get_sub_field('image');
					}
					$video_cats = "";
					if( have_rows('video_category') ) {
						while ( have_rows('video_category') ) { the_row();
							$video_cats .= "target-" . get_sub_field("cat_name") . " ";
						}
					}
			?>
					<li class="<?php echo $video_cats; ?>" data-vid="<?php echo $video_id; ?>">
						<div class="mv-video-thumb" style="background-image: url(<?php echo $vm_image; ?>);">
							<i class="icon-play"></i>
						</div>
						<h5 class="mv-thumb-title"><?php echo $title; echo $video_source;?></h5>
					</li>		
			<?php
			    }
			}
			?>
		</ul>
	</div>
</div>
<?php get_footer(); ?>