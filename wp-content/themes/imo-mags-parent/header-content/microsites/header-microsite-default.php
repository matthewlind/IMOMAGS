<?php		
	$idObj = get_category_by_slug($cat_slug); 
	$cat_id = $idObj->term_id;
	$term_cat_id = 'category_'.$cat_id;
	
	$cat_name = get_cat_name( $cat_id );
	$logo = get_field('logo', $term_cat_id);
	
	$hide_all_buy_mag_options = get_field('hide_all_buy_mag_options', $term_cat_id);	
	$message_unavailable = get_field('message_unavailable', $term_cat_id);	
	$end_date_newsstand = get_field('end_date_newsstands', $term_cat_id);
	$mag_online_store = get_field('mag_online_store', $term_cat_id);
	$digital_edition_available = get_field('digital_edition_available', $term_cat_id);
	$online_store_url = get_field('online_store_url', $term_cat_id);
	
/*
	$rows = get_field('mag_info', $term_cat_id ); // get all the rows
	$first_row = $rows[0]; // get the first row
	$first_row_image = $first_row['mag_cover_image' ]; // get the sub field value
	$mag_cover_image = wp_get_attachment_image_src( $first_row_image, 'full' );
*/
	
	$today = date("Ymd"); 			
?>
<div class="top-panel">
	<a href="<?php echo site_url(); ?>" class="icon-arrow-left">Back to <?php echo $blog_title; ?></a>
</div>
	
<header class="main-header">
	
	<div class="menu-area clearfix">
		<div class="microsite-logo">
			<a href="/<?php echo $cat_slug; ?>/" title="<?php echo $cat_name; ?>"><img  src="<?php echo $logo['url'];?>" alt="<?php echo $logo['alt']; ?>"></a>
		</div>
		<div class="nav-container clearfix">
			<nav id="site-navigation" class="main-nav" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => $theme_location, 'container' => '0' ) ); ?>
				
				<?php if ($hide_all_buy_mag_options == false) { ?>
				<div class="m-buymag-drop">
					<ul>
						<li class="clearfix">
							<i class="icon-cross"></i>
							<?php 
								if ($end_date_newsstand > $today  ) {
									echo do_shortcode('[osgimpubissue bipad="'.$zip_finder_bipad.'" alias="head" vertical="down"]'); 
								}
							?>
						</li>
						<li class="m-buy-online">
							<a href="<?php echo $online_store_url; ?>" target="_blank">Order Print Magazine Online</a>
							<?php if ($mag_online_store == false) : ?>
								<div class="unavailble-mag">
									<p>The print magazine is temporarily unavailable in the online store. Instead find it in your area using your zip code, or get the digital edition.</p>
								</div>
							<?php endif; ?>
						</li>
						
						<?php 
							if ($digital_edition_available == true && have_rows('digital_edition_urls', 'category'.'_'.$cat_id)) { 
								while ( have_rows('digital_edition_urls', 'category'.'_'.$cat_id) ) { the_row();
								$itunes_url = get_sub_field('itunes_url');
								$google_play_url = get_sub_field('google_play_url');
								$windows_store_url = get_sub_field('windows_store_url');
						?>
						<li> 
							<span>Get The Digital Edition:</span>
							<div class="m-list-dig">
								<ul>
									<li><a href="<?php echo $itunes_url; ?>" target="_blank"><img src="/wp-content/themes/imo-mags-parent/images/microsites/digit-store-icons/itunes-logo.png"><span>iTunes</span></a></li>
									<li><a href="<?php echo $google_play_url; ?>" target="_blank"><img src="/wp-content/themes/imo-mags-parent/images/microsites/digit-store-icons/google_play_icon.png"><span>Google Play</span></a></li>
									<li><a href="<?php echo $windows_store_url; ?>" target="_blank"><img src="/wp-content/themes/imo-mags-parent/images/microsites/digit-store-icons/windows-store-icon.png"><span>Windows Store</span></a></li>						
								</ul>
							</div><!-- .m-list-dig -->
						</li>
						<?php } } ?>
					</ul>						
				</div><!-- .m-buymag-drop -->	
				<?php } /* end if ($hide_all_buy_mag_options == false) */
					else { ?>
					<div class="m-buymag-drop">
						<ul>
							<li class="clearfix">
								<i class="icon-cross"></i>
								<?php echo $message_unavailable; ?>
							</li>
						</ul>						
					</div><!-- .m-buymag-drop -->
				<?php	}?>				
			</nav>				
			<div class="social-buttons">
				<?php 
				if( have_rows('site_share_buttons', $term_cat_id) ) : 						
					while ( have_rows('site_share_buttons', $term_cat_id) ) : the_row();
						$face_twit_title = get_sub_field('face_twit_title');
						$email_subject = get_sub_field('email_subject');
						$email_message = get_sub_field('email_message');
				?>
				<ul>
					<?php if (is_category('shoot101') || in_category('shoot101')){?><li><a href="https://www.youtube.com/channel/UCiUI8tBSAW88CEAr7oknkoA?utm_source=navbarlink&utm_medium=website&utm_campaign=shoot101&utm_content=youtubechannel" class="icon-youtube" target="_blank"></a></li><?php } ?>
					<li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo (urlencode(site_url())) . '/'. $cat_slug; ?>&title=<?php echo $face_twit_title; ?>" class="icon-facebook" target="_blank"></a></li>
					<li><a href="http://twitter.com/intent/tweet?status=<?php echo $face_twit_title; ?>+<?php echo (urlencode(site_url())) . '/'. $cat_slug; ?>" class="icon-twitter" target="_blank"></a></li>
					<li><a href="mailto:?subject=<?php echo $email_subject; ?>&body=<?php echo $email_message . ' ' . (urlencode(site_url())) . '/'. $cat_slug; ?>" class="icon-mail" target="_blank"></a></li>
				</ul>
				<?php endwhile; 
					endif;?>
			</div><!-- .m-social-buttons -->
			<?php if (have_rows('mag_info', $term_cat_id)) { 
					while ( have_rows('mag_info', $term_cat_id) ) { the_row();
						$mag_cover_image = get_sub_field('mag_cover_image');
			?>
			<img class="header-mag-cover" src="<?php echo $mag_cover_image['url']; ?>" alt="<?php echo $mag_cover_image['alt']; ?>">
			<?php } } ?>
		</div><!-- .nav-container -->
	</div><!-- .menu-area -->
</header>