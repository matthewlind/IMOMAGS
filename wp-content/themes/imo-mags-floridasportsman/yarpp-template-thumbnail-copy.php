<?php /*
Thumbnail template for Related Videos
Requires a theme which supports post thumbnails
Original Author: mitcho (Michael Yoshitaka Erlewine)
Modified by cbforrester
*/ ?>



<?php if (have_posts()):?>
<div id="related_videos">
  <h3 class="related_videos_header">Related</h3>
  <div class="related_videos_arrow" id="related_videos_goleft">
    <?php  echo '<img src="'.plugins_url() . '/test-plugin/images/arrowbar-prev.png">'; ?>
  </div>
  <div id="related_videos_video_wrapper">
<div id="related_videos_video_grid">
<?php while (have_posts()) : the_post(); ?>
		<?php if (has_post_thumbnail()):?>

	<div class="related_videos_post">
		<div class="postImage">
		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(array(128,96)); ?></a><br>
		<a href="<?php the_permalink() ?>"><?php the_title(); ?></a><br>
	</div>
	</div>
		<?php endif; ?>
<?php endwhile; ?>
</div>
</div>
<div class="related_videos_arrow" id="related_videos_goright">
  <?php  echo '<img src="'.plugins_url() . '/test-plugin/images/arrowbar-next.png">'; ?>
</div>
</div>
<?php else: ?>
<p>No related videos.</p>
<?php endif; ?>





<script type="text/javascript">
var position = 1;
jQuery('#related_videos_goright').click(function() {
	if (position < 5){
		position++;
  jQuery('#related_videos_video_grid').animate({
    marginLeft: '-=125px',
    marginRight: '+=125px'
  }, 500);
}
});

jQuery('#related_videos_goleft').click(function() {
		if (position > 1){
			position--;
  jQuery('#related_videos_video_grid').animate({
    marginRight: '-=125px',
    marginLeft: '+=125px'
  }, 500);
}
});
</script>