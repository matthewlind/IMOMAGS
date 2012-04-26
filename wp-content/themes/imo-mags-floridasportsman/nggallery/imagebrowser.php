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

<h2><a href="<?php 

if (strpos($_SERVER['REQUEST_URI'], '/tag/') || strpos($_SERVER['REQUEST_URI'], '/gallery/'))
	echo 'http://'.$_SERVER['HTTP_HOST'] . '/galleries/';
else
	the_permalink();


?>"><?php 



if ($album->name){

echo $album->name?></a>: <?php echo '<a href="/galleries/?album='. $album->id.'&gallery='.$gallery->gid.'">'.$gallery->title;?></a> 

<?php 

if (!empty($_GET['tags']))
	echo ': '.show_tag_for_header($_GET['tags']);




?>


<?php } else {
echo substr($GLOBALS['ngg_shortcode'], 3) . '</a>';
} ?> 

</h2>

<?php 
// if this is an AJAX callback then we already have the widget and don't need to generate another instance
if (empty($_GET['callback']))
the_widget('Taxonomy_Drill_Down_Widget', array(
		'title' => '',
		'mode' => 'dropdowns',
		'taxonomies' => array( 'ngg_tag')
));

?>
 
<div class="ngg-imagebrowser" id="<?php echo $image->anchor ?>">
<?php
$description = !empty($image->alttext)  ? trim( preg_replace( '/\s+/', ' ', $image->alttext ) ) : trim( preg_replace( '/\s+/', ' ', $image->description ) );
$description = show_tag_for_header($description);
echo '<script type="text/javascript">';
	echo 'jQuery(document).ready(function() {
	url = document.URL;
	title = document.title;
	document.title = title.replace( new RegExp("[^-]+ - "), "'.$description.' - ");
	txt = url.replace( new RegExp( "pid=[0-9]+" ), "pid='.$image->pid.'" ); 
	
	history.pushState({}, "html5", txt)
	
	} );';
	

	echo '</script>';
	
	?>
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

	<div class="pic">
	
	<?php echo $image->href_link; ?>
	
	
	</div>
    <p><?php echo $image->description ?></p>


</div>	

<?php endif; ?>