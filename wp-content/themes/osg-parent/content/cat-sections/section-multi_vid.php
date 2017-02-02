<?php
$player_id = get_field('brightcove_player_id', 'options');
$account_num = get_field('brightcove_account_num', 'options');
if (have_rows('multi_video', $options)) {
	while (have_rows('multi_video', $options)) {
		the_row();
		$mv_section_title = get_sub_field('section_title');
		$y_feat_title = '';
		$feat_video_id = get_sub_field("feat_video_id");
		$v_source = get_sub_field("video_service");
		$feat_video_title = get_sub_field('feat_video_title');
		$feat_video_desc = get_sub_field('feat_video_desc');
		
		if ($v_source == 'youtube') {
			$feat_image = 'http://img.youtube.com/vi/'.$feat_video_id.'/0.jpg';
		} else {
			$feat_image = get_sub_field('feat_image_z');
		}
		
		$bv_row_count = 0;
		$video_list = '';
		$video_list .= '<li class="mv-active" data-vid="'.$feat_video_id.'">'.
					'<div class="mv-video-thumb" style="background-image: url('.$feat_image.');">'.
						'<i class="icon-play"></i>'.
					'</div>'.
					'<h5 class="mv-thumb-title">'.$feat_video_title.'</h5>'.
					'<p>'.$feat_video_desc.'</p>'.
					'<span>PLAYING NOW</span>'.
				'</li>';
		if( have_rows('video_list') ) {
		    while ( have_rows('video_list')  ) { 
			    the_row();
			    $mv_title 		= get_sub_field('znamez');
			    $mv_desc 		= get_sub_field('udesk');
			    $mv_video_id 	= get_sub_field('video_id');
				
				//echo $znamez . 'f-';
				if ($v_source == 'youtube') {
					$mv_image = 'http://img.youtube.com/vi/'.$mv_video_id.'/0.jpg';
				} else {
					$mv_image = get_sub_field('z_image_z');
				}
				
				if ($bv_row_count < 2) {
				$video_list .= '<li data-vid="'.$mv_video_id.'">'.
					'<div class="mv-video-thumb" style="background-image: url('.$mv_image.');">'.
						'<i class="icon-play"></i>'.
					'</div>'.
					'<h5 class="mv-thumb-title">'.$mv_title.'</h5>'.
					'<p>'.$mv_desc.'</p>'.
					'<span>PLAYING NOW</span>'.
				'</li>';
				}
				if ($bv_row_count >= 2) {
				$video_list .= '<li class="mv-hidden" data-vid="'.$mv_video_id.'">'.
					'<div class="mv-video-thumb" data-mv-img="'.$mv_image.'">'.
						'<i class="icon-play"></i>'.
					'</div>'.
					'<h5 class="mv-thumb-title">'.$mv_title.'</h5>'.
					'<p>'.$mv_desc.'</p>'.
					'<span>PLAYING NOW</span>'.
				'</li>';
				}
				
				$bv_row_count++;
		    }
		}
	}
?>	
<section class="section-video" id="section_video_<?php echo $feat_video_id; ?>">
	<div class="section-inner-wrap clearfix">
		<div class="mv-main clearfix">
			<div class="twins-title">
			<?php
				echo '<span>'.$mv_section_title.'</span>';
				if ($feat_video_title) { echo '<h1 id="video_title_'.$feat_video_id.'">'.$feat_video_title.'</h1>'; }
				if ($feat_video_desc) { echo '<p id="video_desc_'.$feat_video_id.'">'.$feat_video_desc.'</p>'; }
			?>
			</div>
			<div class="cat-player clearfix">
				
				<?php if ($v_source == 'youtube') { ?>
					<div class="player-wrap">
					<div id="<?php echo 'player_'.$feat_video_id; ?>"></div>
					<!-- YouTube Player -->
					<!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
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
							player = new YT.Player('<?php echo 'player_'.$feat_video_id; ?>', {
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
							$("#sections_wrap").on("click", "#mv_list_<?php echo $feat_video_id; ?> > li", function() {
								var d = $(this),
									vid = d.data('vid'),
									title = d.find("h5").text(),
									descr = d.find("p").text(),
									section_vid_scroll = $("#section_video_<?php echo $feat_video_id;?>").offset();
																		
								if(player) { player.loadVideoById(vid, 1, "large"); }
								$("#video_title_<?php echo $feat_video_id; ?>").text(title);
								$("#video_desc_<?php echo $feat_video_id; ?>").text(descr);
								$("html, body").animate({scrollTop: section_vid_scroll.top - 85}, 1000, "swing");
								
								setTimeout(function(){
									$("#mv_list_<?php echo $feat_video_id; ?> > li").removeClass("mv-active");
									d.addClass("mv-active");
								}, 400);
							});
						
						});
				    </script>
				    <!-- End of YouTube Player -->
					</div>
				    <?php } else { ?>
					<div class="player-wrap" id="placeHolder_<?php echo $feat_video_id; ?>"></div>
					<script type="text/JavaScript">
						var myPlayer,
							playerHTML,
							playerData = {
								'accountId': '<?php echo $account_num; ?>',
								'playerId': '<?php echo $player_id; ?>',
								'videoId': '<?php echo $feat_video_id; ?>'
							};
						
						// dynamically build the player video element
						playerHTML = '<video id=\"artem_player\" data-video-id=\"' + playerData.videoId + '\" data-account=\"' + playerData.accountId + '\" data-player=\"' + playerData.playerId + '\" data-embed=\"default\" class=\"video-js\" controls style=\"width: 100%; height: 100%; position: absolute; top: 0px; bottom: 0px; right: 0px; left: 0px;\"></video>';
						// inject the player code into the DOM
						document.getElementById('placeHolder_<?php echo $feat_video_id; ?>').innerHTML = playerHTML;
						// add and execute the player script tag
						var s = document.createElement('script');
						s.src = "//players.brightcove.net/" + playerData.accountId + "/" + playerData.playerId + "_default/index.min.js";
						document.body.appendChild(s);
						
						function changeVideo(video_id){
							myPlayer = videojs('artem_player');
							myPlayer.catalog.getVideo(video_id, function(error, video) { 
								myPlayer.catalog.load(video);
								myPlayer.play();
							})
						}
				        
				        jQuery(document).ready(function($) {
							$("#sections_wrap").on("click", "#mv_list_<?php echo $feat_video_id; ?> > li", function() {
								var d = $(this),
									vid = d.data('vid'),
									title = d.find("h5").text(),
									descr = d.find("p").text(),
									section_vid_scroll = $("#section_video_<?php echo $feat_video_id;?>").offset();
									
								changeVideo(vid);
								$("#video_title_<?php echo $feat_video_id; ?>").text(title);
								$("#video_desc_<?php echo $feat_video_id; ?>").text(descr);
								$("html, body").animate({scrollTop: section_vid_scroll.top - 85}, 1000, "swing");
								
								setTimeout(function(){
									$("#mv_list_<?php echo $feat_video_id; ?> > li").removeClass("mv-active");
									d.addClass("mv-active");
								}, 400);
							});
						});
					</script>
				    <?php } ?>
			</div>
		</div>	
		<div class="mv-list-wrap" id="video_wrap_<?php echo $feat_video_id; ?>">
			<ul id="mv_list_<?php echo $feat_video_id; ?>" class="mv-video-list clearfix">
				<?php echo $video_list; ?>
				<div class="mv-btn-wrap"><div class="btn-lg mv-load">LOAD MORE VIDEO</div></div>
			</ul>
		</div>		
	</div>
</section>		
<?php }	?>