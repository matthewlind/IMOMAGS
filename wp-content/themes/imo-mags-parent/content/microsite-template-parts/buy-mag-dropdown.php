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
		<?php 
			if ($digital_edition_available == true && have_rows('digital_edition_urls', $term_cat_id)) { 
				while ( have_rows('digital_edition_urls', $term_cat_id) ) { the_row();
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