<?php 
/**
Template Page for the gallery overview

Follow variables are useable :

	$gallery     : Contain all about the gallery
	$images      : Contain all images, path, title
	$pagination  : Contain the pagination content

 You can check the content when you insert the tag <?php var_dump($variable) ?>
 If you would like to show the timestamp of the image ,you can use <?php echo $exif['created_timestamp'] ?>
**/

wp_enqueue_script('jquery-ui-tabs');


?>

	<script>
	(function($){ $(function() {
		$( "#imo-gallery-tabs" ).tabs();
		

		$(".next-tab").click(function() {
			var selected = $("#imo-gallery-tabs").tabs("option", "selected");
			$("#imo-gallery-tabs").tabs("option", "selected", selected + 1);
			return false;
		});
		
		$(".prev-tab").click(function() {
			var selected = $("#imo-gallery-tabs").tabs("option", "selected");
			$("#imo-gallery-tabs").tabs("option", "selected", selected - 1);
			return false;
		});	

		
	}); })(jQuery);
	</script>

<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?><?php if (!empty ($gallery)) : ?>

<div class="ngg-galleryoverview" id="<?php echo $gallery->anchor ?>">
<h1>RIGHT ON</h1>
<a class="next-tab" href="#">Prev Tab</a><a class="next-tab" href="#">Next Tab</a>
	
	<div class="ngg-imagebrowser" id="imo-gallery-tabs">
		
		<ul>
		<?php $i=0; ?>
		<?php foreach ( $images as $image ) : ?>
		
			<?php $i++; ?>
			<li style="display:inline;"><a href="#gallery-tabs-<?php echo $i;?>">Tab <?php echo $i;?></a></li>
			
			
		
		
		<?php endforeach; ?>
		</ul>
		
		<!-- images -->
		<?php $i=0; ?>
		<?php foreach ( $images as $image ) : ?>
			<?php $i++; ?>
			<div id="gallery-tabs-<?php echo $i;?>" class="" <?php echo $image->style ?> >
				<div class="" >
					<a href="<?php echo $image->imageURL ?>" title="<?php echo $image->description ?>" <?php echo $image->thumbcode ?> >
						<?php if ( !$image->hidden ) { ?>
						<img title="<?php echo $image->alttext ?>" alt="<?php echo $image->alttext ?>" src="<?php echo $image->imageURL ?>"  />
						<?php } ?>
					</a>
				</div>
			</div>
		
	
	
		<?php endforeach; ?>
 	</div>

 	
</div>

<?php endif; ?>