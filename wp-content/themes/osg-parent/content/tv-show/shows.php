<div class="tv-items-wrap">
<?php 
	$show_item = get_field("show_item");

if( !empty($show_item) ): ?> 
	<?php while(has_sub_field("show_item")): 
		$show_title = get_sub_field("show_title");
		$show_image = get_sub_field("show_image");
		$show_description = get_sub_field("show_description");
	?>
	<div class="m-shows-item">
		<h2><?php echo $show_title; ?></h2>
		<div class="m-shows-info clearf">
			<img src="<?php echo $show_image['url']; ?>" alt="<?php echo $show_image['alt']; ?>">
			<div class="m-shows-copy">
				<p><?php echo $show_description; ?><p>
			</div>
			<div class="m-shows-buttons">
		
				<div class="btn-green air-times-btn">
					<input type="submit" value="air times">
				</div>
				<div class="btn-green">
					<a href="">visit website</a>
				</div>
			</div>
		</div><!-- end of .m-show-info -->	
		<div class="m-shows-airtimes">
			<h3>AIR TIMES</h3>
			<ul class="m-shows-air-list">
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
				<a href="">remind me to watch</a>
			</div>
		</div><!-- end of .m-show-airtimes -->
	</div><!-- end of .m-show-item -->
<?php endwhile; ?>
<?php endif; ?>	<!-- end of .m-show-item -->
</div><!-- end of .tv-items-wrap -->