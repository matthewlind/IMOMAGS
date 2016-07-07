<?php	
	$image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	$image_large = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'lafge' );	
	$postID = get_the_ID();
	$byline = get_post_meta($postID, 'ecpt_byline', true);
	$acf_byline = get_field("byline",$postID); 
	$author = get_the_author();

	$idObj = get_category_by_slug($cat_slug); 
	$cat_id = $idObj->term_id;
	$term_cat_id = 'category_'.$cat_id;
	
	$hide_all_buy_mag_options = get_field('hide_all_buy_mag_options', $term_cat_id);
	$end_date_newsstand = get_field('end_date_newsstands', $term_cat_id);
	$mag_online_store = get_field('mag_online_store', $term_cat_id);
	$digital_edition_available = get_field('digital_edition_available', $term_cat_id);
	$online_store_url = get_field('online_store_url', $term_cat_id);
	$sponsors_disclaimer = get_field('sponsors_disclaimer', $term_cat_id);
	$social_share_message = get_field('social_share_message', $term_cat_id);
	
	$today = date("Ymd"); 
?>

<?php if( in_array( 'sponsors_disclaimer', get_field('additional_elements', $term_cat_id) ) ) { ?>
<div class="sponsors-disclaimer">
	<span><?php echo $sponsors_disclaimer; ?></span>
</div>
<?php } ?>

<div class="m-article-wrap clearfix">
	<?php if(mobile() == true) {
		if($image_large[0]) { ?>
			<div class="m-article-image" style="background-image: url('<?php echo $image_large[0]; ?>');"></div>
	<?php }
	} else {
		if($image_full[0]) { ?>
			<div class="m-article-image" style="background-image: url('<?php echo $image_full[0]; ?>');">
				<div class="m-top-ad">
					<p>ADVERTISMENT</p>
					<div><?php imo_ad_placement("microsite_BTF_300x250"); ?></div>	
				</div>
			</div>
	<?php } } ?>
	<article class="m-article clearfix">
		<div class="m-social-wrap">
			<p class="m-hlep-grow"><?php echo $social_share_message; ?></p>
			<ul class="share-count social-buttons">
				<li>
					<a href="http://www.facebook.com/sharer.php?u=<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>&t=<?php the_title(); ?>" class="socialite facebook-like reload-fb" data-href="<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>" data-send="false" data-layout="button_count" data-share="true" data-action="like" data-width="60" data-show-faces="false" rel="nofollow" target="_blank"><span class="vhidden"></span></a>
				</li>
			    <li>
			        <a href="http://twitter.com/share" class="socialite twitter-share reload-twitter" data-text="<?php the_title(); ?>" data-url="<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>" rel="nofollow" target="_blank"><span class="vhidden"></span></a>
			    </li>
			</ul>
<!-- 		</div> -->
		<h1><?php the_title();?></h1>
		<?php if(get_the_author() != "admin" && get_the_author() != "infisherman"){ ?><span class="m-post-byline">Words by <?php echo $author; ?></span><?php } ?><?php if ($acf_byline) { ?><span class="m-post-byline">&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $acf_byline;?></span><?php } ?>
		
		<?php if(mobile() == true) { 
			$content = apply_filters('the_content', $post->post_content);
			$mag_after_p = 0;
			//$ad1_after_p = 2;
			$contents = explode("</p>", $content);
			$p_counter = 0;
			foreach($contents as $content){
			    echo $content.'</p>';
			   
			    if($p_counter == $mag_after_p && $hide_all_buy_mag_options == false){ ?>
			   
				<div class="alignright-content m-buy-wrap"> 
		    		<div class="m-buy-mag" style="margin-top: 45px;"> 
			    		<?php if ($end_date_newsstand > $today  ) {	?>
							<h2>NOW AVAILABLE ON NEWSSTANDS!</h2>
							<?php echo do_shortcode('[osgimpubissue bipad="'.$zip_finder_bipad.'" alias="mid"]'); ?>
						<?php } else {  ?>
							<h2><?php echo $buy_mag_foot_message; ?> </h2>
						<?php } ?>
		    			<div class="m-buy-mag-bottom clearfix"> 				
		    				<div class="m-buy-mag-img"></div> 
		    				<div class="m-buy-dig">
		    					<a href="<?php echo $online_store_url; ?>" target="_blank">BUY PRINT MAGAZINE NOW!</a> 
		    					<?php if ($mag_online_store == false) : ?>
		    					<div class="unavailble-mag">
									<p>The print magazine is temporarily unavailable in the online store. Instead find it in your area using your zip code, or get the digital edition.</p>
								</div>
								<?php endif; ?>
		    				</div>
		    				<div class="m-buy-dig" href="#" target="_blank">
								<span>GET THE DIGITAL EDITION!</span>
								<?php
									if ($digital_edition_available == true && have_rows('digital_edition_urls', $term_cat_id)) { 
										while ( have_rows('digital_edition_urls', $term_cat_id) ) { the_row();
										$itunes_url = get_sub_field('itunes_url');
										$google_play_url = get_sub_field('google_play_url');
										$windows_store_url = get_sub_field('windows_store_url');
								?>
									<div class="m-dig-drop">
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
		    		</div>
		    	</div>
<!--
		    	<script>
			    	jQuery(document).ready(function($) {
				    	$(".m-buy-dig").click(function() {
					    	$(".m-dig-drop").addClass("m-dig-dropit")
				    	});
				    });
			    </script>
-->
				<?php }	
/*
			    if($p_counter == $ad1_after_p){
			    	//echo '<div class="alignright-content inline-ad">';
						//imo_ad_placement("atf_medium_rectangle_300x250"); 
					//echo '</div>';
				}
*/
			    $p_counter++;
			}
			
		} else { 
			if ($hide_all_buy_mag_options == false) { ?>
			<div class="alignright-content m-buy-wrap"> 
	    		<div class="m-buy-mag" style="margin-top: 45px;"> 
		    		<?php if ($end_date_newsstand > $today  ) {	?>
						<h2>NOW AVAILABLE ON NEWSSTANDS!</h2>
						<?php echo do_shortcode('[osgimpubissue bipad="'.$zip_finder_bipad.'" alias="mid"]'); ?>
					<?php } else {  ?>
						<h2><?php echo $buy_mag_foot_message; ?> </h2>
					<?php } ?>
	    			<div class="m-buy-mag-bottom clearfix"> 				
	    				<div class="m-buy-mag-img"></div> 
	    				<div class="m-buy-dig">
	    					<a href="<?php echo $online_store_url; ?>" target="_blank">BUY PRINT MAGAZINE NOW!</a> 
	    					<?php if ($mag_online_store == false) : ?>
	    					<div class="unavailble-mag">
								<p>The print magazine is temporarily unavailable in the online store. Instead find it in your area using your zip code, or get the digital edition.</p>
							</div>
							<?php endif; ?>
	    				</div>
	    				<div class="m-buy-dig" href="#" target="_blank">
							<span>GET THE DIGITAL EDITION!</span>
							<?php
								if ($digital_edition_available == true && have_rows('digital_edition_urls', $term_cat_id)) { 
									while ( have_rows('digital_edition_urls', $term_cat_id) ) { the_row();
									$itunes_url = get_sub_field('itunes_url');
									$google_play_url = get_sub_field('google_play_url');
									$windows_store_url = get_sub_field('windows_store_url');
							?>
								<div class="m-dig-drop">
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
	    		</div>
	    	</div>
		<?php
			}
			 the_content();
		}
		?>
		<!-- end of the_content(); -->
		
		<div class="m-article-bottom clearfix">
			<div class="m-social-wrap">
				<p class="m-hlep-grow"><?php echo $social_share_message; ?></p>
				<ul class="share-count social-buttons">
					<li>
				         <a href="http://www.facebook.com/sharer.php?u=<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>&t=<?php the_title(); ?>" class="socialite facebook-like reload-fb" data-href="<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>" data-send="false" data-layout="button_count" data-share="true" data-action="like" data-width="60" data-show-faces="false" rel="nofollow" target="_blank"><span class="vhidden"></span></a>
				    </li>
				    <li>
				        <a href="http://twitter.com/share" class="socialite twitter-share reload-twitter" data-text="<?php the_title(); ?>" data-url="<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>" rel="nofollow" target="_blank"><span class="vhidden"></span></a>
				    </li>
				</ul>
			</div><!-- end .m-social-wrap -->
			<div class="alignright-content inline-ad">
				<?php imo_ad_placement("microsite_BTF_300x250"); ?>
			</div>
		</div><!-- .m-article-bottom -->
	</article>
</div><!-- .m-article-wrap -->
<div class="m-more">
	<h2>More Stories</h2>
	<div class="m-more-wrap clearfix">
		<?php
		$args = array (
			'category_name'         	=> $cat_slug,			
			'posts_per_page'      		=> 6,
			'order'						=> 'DESC',
			'orderby'					=> 'rand',
			'post__not_in'				=> array($postID)
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();								
				$image_id = get_post_meta(get_the_ID(),"image", true);
				$image = wp_get_attachment_image_src($image_id, "large");
		?>
		<a class="link-box" href="<?php the_permalink(); ?>">	
			<div class="post-box" style="background-image: url('<?php echo $image[0]; ?>')"></div>
		</a>
		<?php
				}
			} else {
				echo "not found";
			}
			wp_reset_postdata();
		?>
	</div><!-- .m-more-wrap -->
</div><!-- .m-more -->