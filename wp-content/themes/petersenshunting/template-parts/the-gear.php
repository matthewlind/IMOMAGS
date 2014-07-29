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
				<div class="gear-video"></div>
				<div class="gear-img"><img src="<?php echo $gear_image['url']; ?>" alt="<?php echo $gear_image['alt']; ?>" ></div>
			</div>
		</div>
		<?php endwhile; ?>	
		<?php endif; ?><!-- End .gear-item -->

	</div><!-- .a-text -->	
</section><!-- .about-show -->	


<!--  a test of brightcove player -->
<section>
<div class="a-text">
<script type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script> 
<div id="player"></div>
<div class="thumbs-full">
<ul id="video-thumbs">
<?php while (have_posts()) : the_post(); $i++; 
$post_id = get_the_id();
$post = get_post($post_id);
$slug = $post->post_name;
$thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
?>
<li id="thumb-<?php echo $i; ?>"><span class="play-btn"></span><a class="video-thumb" data-slug="<?php echo $slug; ?>" data-img_url="<?php echo $thumb_url; ?>" data-post_url="<?php echo get_permalink(); ?>" data-title="<?php echo get_the_title(); ?>" data-videoid="<?php echo get_field( "brightcove_id",get_the_ID() ); ?>"><?php the_post_thumbnail("show-thumb"); ?><h3><?php the_title(); ?></h3></a></li>
<?php endwhile;?>
</ul>
</div>
<script>
video_id = jQuery("#video-thumbs li:first-child").attr("data-videoid");
loadVideo(video_id);
jQuery("#video-thumbs li a").click(function(){
video_id = jQuery(this).attr("data-videoid");
jQuery(this).find("img").css("border-color","white");
title = jQuery(this).attr("data-title");
slug = jQuery(this).attr("data-slug");
img_url = jQuery(this).attr("data-img_url");
post_url = jQuery(this).attr("data-post_url");
jQuery(".sidebar h1").text(title);
loadVideo(video_id);

});
function loadVideo(id){
   
   var htm = '';
  
   htm = '<object id="myExperience" class="BrightcoveExperience">'
   +  '<param name="bgcolor" value="#000000" />'
   +  '<param name="wmode" value="transparent">'
   +  '<param name="width" value="100%" />'
   +  '<param name="height" value="350" />'
   +  '<param name="playerID" value="1445501637001" />'
   +  '<param name="isVid" value="true" />'
   +  '<param name="isUI" value="true" />'
   +  '<param name="quality" value="high">'
   +  '<param name="@videoPlayer" value="' + id + '" /></object>';
jQuery("#player").html(htm);
player = brightcove.createExperiences();
}

</script>
</div>
</section>