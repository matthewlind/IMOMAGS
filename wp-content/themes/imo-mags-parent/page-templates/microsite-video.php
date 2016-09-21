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
?>
<div class="content" id="uppp">
	<div class="mv-video-atf">
		<div class="mv-player-wrap">
			<div class="mv-player">
				<!-- Start of Brightcove Player -->
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
					
					// Load chosen video, change title and description, scroll player into the view
					function loadVideo(event, videoId) {
						videoPlayer.loadVideoByID(videoId);
						
						setTimeout(function(){
							videoPlayer.getCurrentVideo( function(video) {
								display_name = video.displayName,
								long_desc = video.longDescription;
								jQuery("#mv_title").text(display_name);
								if (long_desc == null) { jQuery("#mv_description").text("");} else {jQuery("#mv_description").text(long_desc);}
							});
						}, 400)
						
						jQuery("html, body").animate({scrollTop: 0}, 1000, "swing");	
					}
				</script>
			</div>
			
			<div id="mv_info" class="mv-info clearfix">
				<h1 id="mv_title"></h1>
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
					$vm_image = get_sub_field('image');
					$video_cats = "";
					if( have_rows('video_category') ) {
						while ( have_rows('video_category') ) { the_row();
							$video_cats .= "target-" . get_sub_field("cat_name") . " ";
						}
					}
			?>
					<li class="<?php echo $video_cats; ?>" onclick="loadVideo(event, <?php echo $video_id; ?>)">
						<div class="mv-video-thumb" style="background-image: url(<?php echo $vm_image; ?>);">
							<i class="icon-play"></i>
						</div>
						<h5><?php echo $title; ?></h5>
					</li>		
			<?php
			    }
			}
			?>
		</ul>
	</div>
</div>
<?php get_footer(); ?>