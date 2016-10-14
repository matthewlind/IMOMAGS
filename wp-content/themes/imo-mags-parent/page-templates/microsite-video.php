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
			      //    the player should play for six seconds and then stop.
			      var done = false;
			      function onPlayerStateChange(event) {
			        if (event.data == YT.PlayerState.PLAYING && !done) {
			          setTimeout(stopVideo, 10000);
			          done = true;
			        }
			      }
			      function stopVideo() {
			        player.stopVideo();
			      }
				  	function loadVideo(videoID) {
						if(player) { player.loadVideoById(videoID, 1, "large"); }
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
					<li class="<?php echo $video_cats; ?>" onclick="loadVideo('<?php echo $video_id; ?>')">
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