<?php $images_slider = get_field("images_slider"); ?>
<section>
	<div class="truck-image">
		<img src="/wp-content/themes/petersenshunting/images/b2b/aev_brute_doublecab_studio_profile_side.jpg"
	</div>
	<h1 class="a-text">The Truck</h1>
	<div class="a-text">
		<div class="gear-about">		
			<?php
			$content = get_the_content();
			echo $content;
			?>
		</div>	
		
		<!-- Start .a-slideshow -->
		<?php if( !empty($images_slider) ): ?> 
		<div class="a-slideshow">
			<div id="slider-truck" class="flexslider slider-wrap">
			  <ul class="slides">
			  <?php while(has_sub_field("images_slider")): 
				  $image_slider = get_sub_field("image_slider");
				  $caption_slider = get_sub_field("caption_slider");
			  ?>
			    <li>
			      <img src="<?php echo $image_slider['url']; ?>" alt="<?php echo $image_slider['alt']; ?>" />
			       <p class="flex-caption"><?php echo $caption_slider; ?></p>
			    </li>
			  <?php endwhile; ?>  
			  </ul>
			</div>
			<div id="thumbs-truck" class="flexslider thumbs-wrap">
			  <ul class="slides">
			  <?php while(has_sub_field("images_slider")): 
				  $image_slider = get_sub_field("image_slider");
				  $caption_slider = get_sub_field("caption_slider");
			  ?>
			    <li style="background-image: url('<?php echo $image_slider['url']; ?>')">
			    </li>
			  <?php endwhile; ?>  
			  </ul>
			</div>
		</div>
		<?php endif; ?><!--END .a-slideshow -->	
		
		<?php if( get_field('gear_items') ): ?>
		<?php while( has_sub_field('gear_items')): 
			$gear_name = get_sub_field("gear_name");
			$gear_link = get_sub_field("gear_link");
			$gear_description = get_sub_field("gear_description");
			$gear_image = get_sub_field("gear_image");
			$gear_video = get_sub_field("gear_video");
		?>
		<div class="truck-item clearf">
			<h2><?php echo $gear_name; ?></h2>
			<p class="item-link"><a href="<?php echo $gear_link; ?>" target="_blank">Visit website</a><i class="fa fa-angle-double-right"></i></p>
			<div class="img-video-container">
				<img src="<?php echo $gear_image['url']; ?>" alt="<?php echo $gear_image['alt']; ?>" >
				<p><?php echo $gear_description; ?></p>
			</div>
		</div>
		<?php endwhile; ?>	
		<?php endif; ?><!-- End .gear-item -->
				
		
	</div><!-- End .a-text -->	
</section><!-- End .about-show -->	