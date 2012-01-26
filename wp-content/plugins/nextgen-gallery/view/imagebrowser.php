<?php 
/**
Template Page for the image browser

Follow variables are useable :

	$image : Contain all about the image 
	$meta  : Contain the raw Meta data from the image 
	$exif  : Contain the clean up Exif data 
	$iptc  : Contain the clean up IPTC data 
	$xmp   : Contain the clean up XMP data 

 You can check the content when you insert the tag <?php var_dump($variable) ?>
 If you would like to show the timestamp of the image ,you can use <?php echo $exif['created_timestamp'] ?>
**/
?>
<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?><?php if (!empty ($image)) : ?>
<?php $album = nggdb::find_album( get_query_var('album') ); ?>
<?php $gallery = nggdb::find_gallery( get_query_var('gallery') ); 

?>

<h2><a href="<?php the_permalink(); ?>"><?php 



if ($album->name){

echo $album->name?></a>: <?php echo '<a href="http://www.floridasportsman.devc/galleries/?album='. $album->id.'&gallery='.$gallery->gid.'">'.$gallery->title; ?></a> 

<?php } else {
echo substr($GLOBALS['ngg_shortcode'], 3) . '</a>';
} ?> 

</h2>
<a name="image"></a>
<div class="ngg-imagebrowser" id="<?php echo $image->anchor ?>">
	
	<div class="ngg-imagebrowser-nav"> 
		<div class="back">
			<a class="ngg-browser-prev" id="ngg-prev-<?php echo $image->previous_pid ?>" href="<?php echo $image->previous_image_link ?>#image">&#9668; <?php _e('Back', 'nggallery') ?></a>
		</div>
        		
		<div class="next">
			<a class="ngg-browser-next" id="ngg-next-<?php echo $image->next_pid ?>" href="<?php echo $image->next_image_link ?>#image"><?php _e('Next', 'nggallery') ?> &#9658;</a>
		</div>
        <div class="counter"><?php _e('Picture', 'nggallery') ?> <?php echo $image->number ?> <?php _e('of', 'nggallery')?> <?php echo $image->total ?></div>
                <div class="ngg-imagebrowser-desc"><h3><?php echo $image->alttext ?></h3></div>
	</div>	

	<div class="pic"><?php echo $image->href_link ?></div>
    <p><?php echo $image->description ?></p>


</div>	

<?php endif; ?>