<div class="wrap4padding">
	<div class="schedule-area">
		<div class="schedule-area-left">
			<div class="w2w-box">
				<div class="w2w-schedule">
					<h1>WHEN TO WATCH</h1>
					<ul class="w2w-list">
						<?php 
							$idObj = get_category_by_slug('tv'); 
							$id = $idObj->term_id;
							$acfID = 'category_' . $id;
							$whenToWatch = get_field('when_to_watch',$acfID);
							echo do_shortcode("[tscschedule format='inline' postid='".$whenToWatch."']"); 
						?>
					</ul>
					<div class="show-btn">
						<a href="<?php echo get_field('remind_me',$acfID); ?>" target="_blank">remind me to watch</a>
					</div>
					<div class="grey-line"></div>
				</div><!-- end of .w2w-schedule -->
				<div class="w2w-get-sport">
					<img src="/wp-content/themes/imo-mags-parent/images/logos/sc-finder-logo.png">
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
		</div><!-- end of .schedule-area-left -->	
		
		
		<div class="w-sport">
			<?php the_widget( 'Schedule_Widget' ); ?>
		</div>
		</div><!-- end of .w-sport -->
	</div><!-- end of .schedule-area -->
</div><!-- end of .shows-player-area -->

