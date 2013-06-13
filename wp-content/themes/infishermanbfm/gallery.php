<?php global $galleryId; ?>
<?php global $gallery; ?>
<?php global $galleryImages; ?>
<div class="general-title clearfix">
    <h2><span><?php echo $gallery->name; ?></span></h2>
</div>
<div class="jq-gallery-slider gallery-slider" id="gallery-<?php echo $galleryId ?>">
    <span class="slide-count"><?php echo (count($galleryImages) == 1)? '1/1' : '' ; ?></span>
    <ul class="slides">
    <?php foreach ($galleryImages as $image):?>
        <li>
            <img src="<?php echo $image->image; ?>">
            <div class="feat-text">
                <h3><?php echo $image->title; ?></h3>
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
                <?php if (count($galleryImages) == 1): ?>updateSliderCounter(slider);<?php endif; ?>
            },
            after: function (slider) {
                updateSliderCounter(slider);        
            }
        });
    })
</script>