<?php
$player_id = get_field('brightcove_player_id', 'options');
$account_num = get_field('brightcove_account_num', 'options');
if (have_rows('tv_section', $options)) {
	while (have_rows('tv_section', $options)) {
		the_row();
		$tv_title 		= get_sub_field('title');
		$tv_subtitle 	= get_sub_field('subtitle');
		$tv_logo		= get_sub_field('logo');
		$tv_link_text 	= get_sub_field('link_text');
		$tv_link_url	= get_sub_field('link_url');
		$tv_video_id	= get_sub_field('video_id');
	}
?>	
<section class="section-tv">
	<div class="section-inner-wrap clearfix">
		<div class="twins-title">
			<?php
			echo '<h1>'.$tv_title.'</h1>';
			if ($tv_subtitle) { echo '<span>'.$tv_subtitle.'</span><br>'; }
			if ($tv_logo) { echo '<img src="'.$tv_logo.'">';}
			if ($tv_link_url) { echo '<a class="link-to-all" href="'.$tv_link_url.'">'.$tv_link_text.'</a>';}
			?>
		</div>
		<div class="cat-player clearfix">
			<div class="player-wrap">
				<video 	
						data-video-id="<?php echo $tv_video_id; ?>"
						data-account="<?php echo $account_num; ?>" 
						data-player="<?php echo $player_id; ?>" 
						data-embed="default" 
						data-application-id 
						class="video-js" 
						controls 
						style="width: 100%; height: 100%; position: absolute; top: 0px; bottom: 0px; right: 0px; left: 0px;">
				</video>
				<script src="//players.brightcove.net/<?php echo $account_num; ?>/<?php echo $player_id; ?>_default/index.min.js"></script>
			</div> 
		</div>
	</div>
</section>		
<?php }	?>