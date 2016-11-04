<?php
if (have_rows('sip_section', 'options')) {
	while (have_rows('sip_section', 'options')) {
		the_row();
		$title 			= get_sub_field('title');
		$subtitle 		= get_sub_field('subtitle');
		$sip_link_text 	= get_sub_field('sip_link_text');
		$sip_link_url 	= get_sub_field('sip_link_url');
		$mag_cover 		= get_sub_field('mag_cover');
		$online_str_url	= get_sub_field('online_store_url');
		$itunes_url 	= get_sub_field('itunes_url');
		$ggle_play_url 	= get_sub_field('google_play_url');
		$wind_str_url 	= get_sub_field('windows_store_url');
		$post_id_1 		= get_sub_field('post_id_1');
		$post_id_2 		= get_sub_field('post_id_2');
	}
}	
?>
<section class="section-twins">
	<div class="section-inner-wrap clearfix">
		<div class="twins-title">
			<h1><?php echo $title; ?></h1>
			<a class="link-to-all" href="<?php echo $sip_link_url; ?>"><?php echo $sip_link_text; ?></a>
			<?php if ($mag_cover) { ?>
				<div class="twins-buy-wrap">
					<img src="<?php echo $mag_cover; ?>">
					<div id="sip_buy_btn" class="twins-buy-btn">
						<span>Buy Now<i class="icon-caret-down"></i></span>
						<div id="sip_drop_down" class="tw-buy-drop-down">
							<?php if ($online_str_url) echo '<a href="'.$online_str_url.'" target="_blank">Order Print Magazine Online<i class="icon-arrow-right"></i></a>'; ?>
							<?php if ($itunes_url || $ggle_play_url || $wind_str_url) { ?>
							<hr>
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
				<?php	
					$args = array ('cat' => $cat_id,'posts_per_page' => 2,'order' => 'DESC');
					$query = new WP_Query( $args );
					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post();
							$thumb 	= get_the_post_thumbnail($query->post->ID,"list-thumb");	
					?>
					<li class="twins-item" featured_id="<?php echo $feature->ID ?>">
						<div class="twins-img"><a href="<?php the_permalink(); ?>"><?php echo $thumb; ?></a></div>
						<div class="twins-thumb-title">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						</div>
					</li>
					<?php
						}
					} else {
						echo "no posts found";
					}
					wp_reset_postdata(); 
				?>
			</ul>
		</div>
	</div>
</section>