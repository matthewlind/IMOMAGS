<?php 
/**
Template Page for the gallery carousel

Follow variables are useable :

    $gallery     : Contain all about the gallery
    $images      : Contain all images, path, title
    $pagination  : Contain the pagination content
    $current     : Contain the selected image
    $prev/$next  : Contain link to the next/previous gallery page
    

 You can check the content when you insert the tag <?php var_dump($variable) ?>
 If you would like to show the timestamp of the image ,you can use <?php echo $exif['created_timestamp'] ?>
**/
?>

<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?><?php if (!empty ($gallery)) : ?>

<?php
$galleryId = $gallery->ID.rand(0, 9999);
?>

<div class="general-title clearfix">
    <h2><span><?php echo $gallery->title; ?></span></h2>
</div>
<div class="jq-gallery-slider gallery-slider" id="gallery-<?php echo $galleryId ?>">
    <span class="slide-count"><?php echo (count($images) == 1)? '1/1' : '' ; ?></span>
    <ul class="slides">
    <?php foreach ($images as $image):?>
        <li>
            <img src="<?php echo $image->imageURL; ?>" alt="<?php echo $image->alttext; ?>">
            <div class="feat-text">
                <h3><?php echo $image->alttext; ?></h3>
                <?php echo substr($image->description, 0, 290); ?><?php echo (strlen($image->description) > 290)? '...' : '' ; ?>
                
            </div>
        </li>
        
    <?php endforeach; ?>
    </ul>
</div>
<script type="text/javascript">
    jQuery(function(){
        var fslider = jQuery('#gallery-<?php echo $galleryId ?>').flexslider({
            animation: "slide",
            animationSpeed: 200,
            slideshow: false,
            start: function (slider) {
                <?php if (count($images) > 1): ?>updateSliderCounter(slider);<?php endif; ?>
            },
            after: function (slider) {
                updateSliderCounter(slider);        
            }
        });
    })
</script>

<?php endif; ?>