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



?>
<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?><?php if (!empty ($gallery)) : ?>

<?php 






$album = nggdb::find_album( get_query_var('album') );  ?>
<div class="ngg-galleryoverview" id="<?php echo $gallery->anchor ?>">
<h2><a href="<?php 

if (preg_match('~/album/[0-9]+/gallery/[0-9+]+/~i', $_SERVER['REQUEST_URI']))
	echo 'http://'.$_SERVER['HTTP_HOST'] . '/galleries/';
else
	the_permalink();

?>"><?php



 if ($album->name)
  	echo $album->name . '</a>: '. '<a href="/galleries/?album='. $album->id.'&gallery='.$gallery->ID.'">'.$gallery->title .'</a>';
 else
 	echo substr($GLOBALS['ngg_shortcode'], 3) . '</a>';
 
 
 // display breadcrumb titles if this a tag-driven subgallery 
 if (!empty($_POST['ngg_tag']))
 {
 	
 	$ngg_tag = $_POST["ngg_tag"];
 	$ngg_tag = str_replace(" ", "+", $ngg_tag);
 	$ngg_tag = str_replace("%20", "+", $ngg_tag);
 	echo ': '. show_tag_for_header($_POST['ngg_tag']);
 	echo '<script type="text/javascript">';
 	echo 'jQuery(document).ready(function() {
 	
 	txt = "tags/'.$ngg_tag.'/";
 	history.pushState({}, "html5", txt)
 	
 	} )';
	echo '</script>';
 
 }
 elseif (preg_match('~/album/[0-9]+/gallery/[0-9+]+/tags/[a-z-]+~i', $_SERVER['REQUEST_URI']))
 	echo ': '. show_tag_for_header(get_query_var('tags'));
 

 

 //if (preg_match('~/album/[0-9]+/gallery/[0-9+]+/tags/[a-z-]+~i', $_SERVER['REQUEST_URI']))
   // echo  substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], 'galleries/tag/')). '</a>';

 	 ?>

 	 </h2>

<?php

the_widget('Taxonomy_Drill_Down_Widget', array(
		'title' => '',
		'mode' => 'dropdowns',
		'taxonomies' => array( 'ngg_tag')
));


if ($gallery->show_slideshow) { ?>
	<!-- Slideshow link -->
	<div class="slideshowlink">
		<a class="slideshowlink" href="<?php echo $gallery->slideshow_link ?>">
			<?php echo $gallery->slideshow_link_text ?>
		</a>
	</div>
<?php } ?>

<?php if ($gallery->show_piclens) { ?>
	<!-- Piclense link -->
	<div class="piclenselink">
		<a class="piclenselink" href="<?php echo $gallery->piclens_link ?>">
			<?php _e('[View with PicLens]','nggallery'); ?>
		</a>
	</div>
<?php } ?>
	
	<!-- Thumbnails -->

	<?php foreach ( $images as $image ) :  ?>
	
	
	
	<div id="ngg-image-<?php echo $image->pid ?>" class="ngg-gallery-thumbnail-box" <?php echo $image->style ?> >
		<div class="ngg-gallery-thumbnail" >
			<a href="<?php echo $image->imageURL ?>" title="<?php echo $image->description ?>" <?php echo $image->thumbcode ?>>
				<?php if ( !$image->hidden ) { ?>
				<img title="<?php echo $image->alttext ?>" alt="<?php echo $image->alttext ?>" src="<?php echo $image->thumbnailURL ?>" <?php echo $image->size ?> />
				<?php } ?>
			</a>
		</div>
	</div>
	
	<?php if ( $image->hidden ) continue; ?>
	<?php if ( $gallery->columns > 0 && ++$i % $gallery->columns == 0 ) { ?>
		<br style="clear: both" />
	<?php } ?>

 	<?php endforeach; ?>
 	
	<!-- Pagination -->
 	<?php echo $pagination ?>
 	
</div>

<?php endif; ?>