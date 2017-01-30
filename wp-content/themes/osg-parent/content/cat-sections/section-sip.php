<?php
if (have_rows('sip_section', $options)) {
	while (have_rows('sip_section', $options)) {
		the_row();
		$s_title 		= get_sub_field('title');
		$s_subtitle 	= get_sub_field('subtitle');
		$sip_link_text 	= get_sub_field('sip_link_text');
		$sip_link_url 	= get_sub_field('sip_link_url');
		$mag_cover 		= get_sub_field('mag_cover');
		//$online_str_url	= get_sub_field('online_store_url');
		$itunes_url 	= get_sub_field('itunes_url');
		$ggle_play_url 	= get_sub_field('google_play_url');
		$wind_str_url 	= get_sub_field('windows_store_url');
		$s_post_id_1 	= get_sub_field('post_id_1');
		$s_post_id_2 	= get_sub_field('post_id_2');
	}
	$title_1		= get_the_title($s_post_id_1);
	$permalink_1	= get_permalink($s_post_id_1);
	$thumb_1		= get_the_post_thumbnail($s_post_id_1, 'list-thumb');
	$title_2		= get_the_title($s_post_id_2);
	$permalink_2	= get_permalink($s_post_id_2);
	$thumb_2		= get_the_post_thumbnail($s_post_id_2, 'list-thumb');
?>	
<section class="section-twins">
	<div class="section-inner-wrap clearfix">
		<div class="twins-title">
			<?php
			echo '<h1>'.$s_title.'</h1>';
			if ($s_subtitle) { echo '<span>'.$s_subtitle.'</span><br>'; }
			if ($sip_link_url) { echo '<a class="link-to-all" href="'.$sip_link_url.'">'.$sip_link_text.'</a>';}
			if ($mag_cover) { ?>
				<div class="twins-buy-wrap">
					<img src="<?php echo $mag_cover; ?>">
					<div id="sip_buy_btn" class="twins-buy-btn">
						<span>Buy Now<i class="icon-caret-down"></i></span>
						<div id="sip_drop_down" class="tw-buy-drop-down">
							<?php //if ($online_str_url) echo '<a href="'.$online_str_url.'" target="_blank">Order Print Magazine Online<i class="icon-arrow-right"></i></a>'; ?>
							<?php if ($itunes_url || $ggle_play_url || $wind_str_url) { ?>
							<span>Get The Digital Edition</span>
							<ul>
							<?php 
								if ($itunes_url) echo '<li><a href="'.$itunes_url.'" target="_blank"><img src="/wp-content/themes/imo-mags-parent/images/microsites/digit-store-icons/itunes-logo.png"><span>iTunes</span></a></li>'; 
								if ($ggle_play_url) echo '<li><a href="'.$ggle_play_url.'" target="_blank"><img src="/wp-content/themes/imo-mags-parent/images/microsites/digit-store-icons/google_play_icon.png"><span>Google Play</span></a></li>'; 
								if ($itunes_url) echo '<li><a href="'.$itunes_url.'" target="_blank"><img src="/wp-content/themes/imo-mags-parent/images/microsites/digit-store-icons/windows-store-icon.png"><span>Windows Store</span></a></li>'; 
							?>
							</ul>
							<?php } ?>
						</div>
					</div>
				</div>	
			<?php } ?>
		</div>
		<div class="twins-thumbs clearfix">
			<ul>
				<li class="twins-item">
					<div class="twins-img"><a href="<?php echo $permalink_1; ?>"><?php echo $thumb_1; ?></a></div>
					<div class="twins-thumb-title">
						<h3><a href="<?php echo $permalink_1; ?>"><?php echo $title_1; ?></a></h3>
					</div>
				</li>
				<li class="twins-item">
					<div class="twins-img"><a href="<?php echo $permalink_2; ?>"><?php echo $thumb_2; ?></a></div>
					<div class="twins-thumb-title">
						<h3><a href="<?php echo $permalink_2; ?>"><?php echo $title_2; ?></a></h3>
					</div>
				</li>
			</ul>
		</div>
	</div>
</section>		
<?php }	?>
