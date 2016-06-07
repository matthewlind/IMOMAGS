<?php	
	$idObj = get_category_by_slug($cat_slug); 
	$cat_id = $idObj->term_id;
	$term_cat_id = 'category_'.$cat_id;
	
	$social_share_message = get_field('social_share_message', $term_cat_id);
	
	$hide_all_buy_mag_options = get_field('hide_all_buy_mag_options', $term_cat_id);	
	$end_date_newsstand = get_field('end_date_newsstands', $term_cat_id);
	$mag_online_store = get_field('mag_online_store', $term_cat_id);
	$digital_edition_available = get_field('digital_edition_available', $term_cat_id);
	$online_store_url = get_field('online_store_url', $term_cat_id);
	$buy_mag_foot_message = get_field('buy_mag_foot_message', $term_cat_id);
	$mag_descr_desktop 	= get_field('mag_descr_desktop', $term_cat_id);
	
	$today 	= date("Ymd"); 
?>
	<footer class="s-footer clearfix">
		<div class="s-mag clearfix">
			<?php
				if (have_rows('mag_info', $term_cat_id)) { 
					while ( have_rows('mag_info', $term_cat_id) ) { the_row();
						$mag_cover_image 	= get_sub_field('mag_cover_image');
						$mag_title 			= get_sub_field('mag_title');
						$mag_description 	= get_sub_field('mag_description');
						
					?>
					<div class="s-mag-cover">
						<img src="<?php echo $mag_cover_image['url']; ?>" alt="<?php echo $mag_cover_image['alt']; ?>">
					</div>
					<div class="s-mag-descr">
						<h1><?php echo $mag_title; ?></h1>
						<p>
						<?php
							if ($cat_slug == 'shoot101') {
								if ( mobile() || !$mag_descr_desktop) {
									echo $mag_description;
								} else {
									echo $mag_descr_desktop;
								}
							} else {
								echo $mag_description; 
							}
						?>
						</p>
					</div>
			<?php } } ?>
			
			<?php if ($hide_all_buy_mag_options == false) { ?>
			<div class="s-mag-buy <?php if ($end_date_newsstand <= $today  ) {?> no-newsstands<?php } ?>">
				
				<?php if ($end_date_newsstand > $today  ) {	?>
					<h2>NOW AVAILABLE ON NEWSSTANDS!</h2>
					<?php echo do_shortcode('[osgimpubissue bipad="'.$zip_finder_bipad.'" alias="foot" vertical="up" gotxt="GO!"]'); ?>
					<div class="s-or">
						<div>OR</div>			
					</div>
				<?php } else {  ?>
					<h2><?php echo $buy_mag_foot_message; ?> </h2>
				<?php } ?>
				<div class="s-mag-btns clearfix">
					<div class="s-buy-btn">
						<a href="<?php echo $online_store_url; ?>" target="_blank">BUY THE MAGAZINE NOW!</a>
						<?php if ($mag_online_store == false) : ?>
							<div class="unavailble-mag">
								<p>The print magazine is temporarily unavailable in the online store. Instead find it in your area using your zip code, or get the digital edition.</p>
							</div>
						<?php endif; ?>
					</div>
					<div class="s-buy-btn">
						<a class="disabled-link" href="">GET THE DIGITAL EDITION!</a>
						<?php
							if ($digital_edition_available == true && have_rows('digital_edition_urls', $term_cat_id)) { 
								while ( have_rows('digital_edition_urls', $term_cat_id) ) { the_row();
								$itunes_url = get_sub_field('itunes_url');
								$google_play_url = get_sub_field('google_play_url');
								$windows_store_url = get_sub_field('windows_store_url');
						?>
							<div class="buy-mag-drop">
								<ul>
									<li><a href="<?php echo $itunes_url; ?>" target="_blank"><img src="/wp-content/themes/imo-mags-parent/images/microsites/digit-store-icons/itunes-logo.png"><span>iTunes</span></a></li>
									<li><a href="<?php echo $google_play_url; ?>" target="_blank"><img src="/wp-content/themes/imo-mags-parent/images/microsites/digit-store-icons/google_play_icon.png"><span>Google Play</span></a></li>
									<li><a href="<?php echo $windows_store_url; ?>" target="_blank"><img src="/wp-content/themes/imo-mags-parent/images/microsites/digit-store-icons/windows-store-icon.png"><span>Windows Store</span></a></li>						
								</ul>
							</div>
						<?php }  // end while
							} else { ?>
							<div class="unavailble-mag">
								<p>Digital edition is temporarily unavailable. Instead find it in your area using your zip code, or get the the print magazine in the online store.</p>
							</div>
						<?php } ?>
					</div>
				</div>
			</div><!-- end .s-mag-buy -->
			<?php } /* end if ($hide_all_buy_mag_options == false) */?>
		</div><!-- end .s-mag -->
		<div class="footer-message clearfix">
			<h2><?php echo $social_share_message; ?></h2>
			<div class="f-social-buttons">
				<?php 
				if( have_rows('site_share_buttons', $term_cat_id) ) : 						
					while ( have_rows('site_share_buttons', $term_cat_id) ) : the_row();
						$face_twit_title = get_sub_field('face_twit_title');
						$email_subject = get_sub_field('email_subject');
						$email_message = get_sub_field('email_message');
				?>
				<ul>
					<li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo (urlencode(site_url())) . '/'. $cat_slug; ?>&title=<?php echo $face_twit_title; ?>" class="icon-facebook" target="_blank"></a></li>
					<li><a href="http://twitter.com/intent/tweet?status=<?php echo $face_twit_title; ?>+<?php echo (urlencode(site_url())) . '/'. $cat_slug; ?>" class="icon-twitter" target="_blank"></a></li>
					<li><a href="mailto:?subject=<?php echo $email_subject; ?>&body=<?php echo $email_message . ' ' . (urlencode(site_url())) . '/'. $cat_slug; ?>" class="icon-mail" target="_blank"></a></li>
				</ul>
				<?php endwhile; 
					endif;?>
			</div><!-- .m-social-buttons -->
		</div>
		<div class="m-footer-bottom">
			<div class="m-logo-nav">
	<!--
				<div class="m-imo-logo">
					<a href="http://www.imoutdoors.com/"><img src="/wp-content/themes/gunsandammo/images/shoot101/imo-logo.png"></a>
				</div>
	-->
				<div class="m-footer-nav">
					<ul>
						<li><a href="http://www.imoutdoors.com/about/what-we-do/" target="_blank">ABOUT</a></li>
						<li><a href="http://www.imoutdoors.com/advertise/" target="_blank">ADVERTISE</a></li>
						<li><a href="http://www.imoutdoors.com/about/contact/" target="_blank">CONTACT</a></li>
						<li><a href="http://www.imoutdoors.com/about/careers/" target="_blank">CAREERS</a></li>
						<li><a href="http://www.imoutdoors.com/about/privacy/" target="_blank">PRIVACY POLICY</a></li>
					</ul>
				</div>
			</div><!-- end .m-logo-nav -->
			<div class="m-copyright">
		        <p>© <?php echo date("Y"); ?> Outdoor Sportsman Group. All Rights Reserved</p>
		    </div>
		</div><!-- end .m-footer-bottom -->
	</footer>
	</div><!-- .microsite-container -->
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/microsite-js/microsite-default.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/microsite-js/<?php echo $script_folder_name; ?>/script-<?php echo $cat_slug; ?>.js"></script>
	<!--[if lt IE 9]><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->

	<?php wp_footer(); ?>
	<?php if(get_field("scroll_tracking","options")){ ?>
	<script src="<?php bloginfo('template_directory'); ?>/js/jquery.scrolldepth.js"></script>
	<script>
		jQuery.scrollDepth();
	</script>
	<?php } ?>
</body>
</html>