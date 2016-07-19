<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

<div id="post-<?php the_ID(); ?>">
	<?php if($dartDomain == "imo.hunting"){
			$photosURL = "/rack-room?";
		}else{
			$photosURL = "/photos?";
		}
		
	if ($_GET['message'] == "share") { ?>
	    <div class="share-photo-now clearfix">
	    	<div class="share-container">
	        	<h2>Like this photo on Facebook!</h2>
	        	<?php if(function_exists('wpsocialite_markup')){ wpsocialite_markup('button_override=facebook'); } ?>
			</div>
	    </div>
    <?php } ?>

            <?php the_content(); 
            
            if(get_post_meta($postID,"camera_corner_taken",true)){ ?>
				<ul>
	                <li><b>Taken At: </b><?php echo get_post_meta($postID,"camera_corner_taken",true); ?></li>
	                <li><b>Taken On: </b><?php echo get_post_meta($postID,"camera_corner_when",true); ?></li>
	                <li><b>With: </b><?php echo get_post_meta($postID,"camera_corner_who",true); ?></li>
	            </ul> 
			<?php } ?>
			
</div><!-- #post -->