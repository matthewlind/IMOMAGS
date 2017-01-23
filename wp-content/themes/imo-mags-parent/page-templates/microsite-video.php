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
$v_service = get_field("video_service");
$y_feat_title = "";

$page_in_cat = strtoupper(get_the_title());

?>
<div class="content" id="uppp">
	<div class="mv-video-atf">
		<h3 id="mv_heading"><?php echo $page_in_cat; ?></h3>
		<div class="mv-player-wrap">
			<div class="mv-player">
				<?php if ($v_service == 'youtube') { 
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
			    <div class="player-wrap">
				    <video id="bc_player"
					    data-account="3165341001" 
						data-player="Syj6BKtn"
						data-video-id="<?php echo $feat_video_id; ?>" 
						data-embed="default" 
						data-application-id 
						class="video-js" 
						controls 
						style="width: 100%; height: 100%; position: absolute; top: 0px; bottom: 0px; right: 0px; left: 0px;">
					</video>
					<script src="//players.brightcove.net/3165341001/Syj6BKtn_default/index.min.js"></script> 
			    </div>
				<script type="text/JavaScript">
					function changeVideo(video_id){
						myPlayer = videojs('bc_player');
						myPlayer.catalog.getVideo(video_id, function(error, video) { 
							myPlayer.catalog.load(video);
							myPlayer.play();
						});
					}
					jQuery(document).ready(function($) {
						videojs('bc_player').on('loadedmetadata',function(){
							var myPlayer = this,
								videDescription = myPlayer.mediainfo.description;
								if (videDescription == null) {videDescription = '';}
							$("#mv_title").text(myPlayer.mediainfo.name);
							$("#mv_description").text(videDescription);
						});
						
						$("#mv_list > li").click(function(){
							var d = $(this),
								vid = d.data('vid'),
								mv_heading = $("#mv_heading").offset();
							
							changeVideo(vid);
							$("html, body").animate({scrollTop: mv_heading.top - 65}, 1000, "swing");
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
					
					if ($v_service == 'youtube') {
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
						<h5 class="mv-thumb-title"><?php echo $title; ?></h5>
					</li>		
			<?php
			    }
			}
			?>
		</ul>
	</div>
</div>
<?php get_footer(); ?>