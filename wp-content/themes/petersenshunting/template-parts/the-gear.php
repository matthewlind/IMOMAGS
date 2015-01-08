<section class="about-show">
	<h1 class="a-text">The Gear</h1>
	<div class="a-text">
		<div class="gear-about">		
			<?php
			$content = get_the_content();
			echo $content;
			?>
		</div>		
		<?php if( get_field('gear_items') ): ?>
		<?php while( has_sub_field('gear_items')): 
			$gear_name = get_sub_field("gear_name");
			$gear_link = get_sub_field("gear_link");
			$gear_description = get_sub_field("gear_description");
			$gear_image = get_sub_field("gear_image");
			$gear_video = get_sub_field("gear_video");
		?>
		<div class="gear-item clearf">
			<h2><?php echo $gear_name; ?></h2>
			<p class="item-link"><a href="<?php echo $gear_link; ?>" target="_blank">Visit website</a><i class="fa fa-angle-double-right"></i></p>
			<p><?php echo $gear_description; ?> </p>
			<div class="img-video-container">
				<?php if ($gear_video) : ?>
				<div class="gear-video">
					
					<div id="#player"><!-- Start of Brightcove Player -->
					<div style="display:none"></div>
					<!--
					By use of this code snippet, I agree to the Brightcove Publisher T and C
					found at https://accounts.brightcove.com/en/terms-and-conditions/.
					-->
					<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>
					
					<object id="myExperience" class="BrightcoveExperience">
					  <param name="bgcolor" value="#FFFFFF" />
					  <param name="width" value="480" />
					  <param name="height" value="270" />
					  <param name="playerID" value="1445501637001" />
					  <param name="playerKey" value="AQ~~,AAAAALyrRUk~,m8Wuv4JIiTp4WJ_vxf089O1HdEWslAPu" />
					  <param name="isVid" value="true" />
					  <param name="isUI" value="true" />
					  <param name="dynamicStreaming" value="true" />
					  <param name="@videoPlayer" value="<?php echo $gear_video; ?> " /></object>
					</object>
					
					<!--
					This script tag will cause the Brightcove Players defined above it to be created as soon
					as the line is read by the browser. If you wish to have the player instantiated only after
					the rest of the HTML is processed and the page load is complete, remove the line.
					-->
					<script type="text/javascript">brightcove.createExperiences();</script>
					</div><!-- End of Brightcove Player -->
					
				</div><!-- .gear-video -->	
				<?php endif; ?>
				<?php if ($gear_image) : ?>
				<div class="gear-img"><img src="<?php echo $gear_image['url']; ?>" alt="<?php echo $gear_image['alt']; ?>" ></div>
				<?php endif; ?>
			</div>
		</div>
		<?php endwhile; ?>	
		<?php endif; ?><!-- End .gear-item -->
	</div><!-- .a-text -->	
</section><!-- .about-show -->	

