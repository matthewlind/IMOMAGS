<?php /*
Post Thumbnail Template
Author: Fox Bowden
*/
?>


<?php if ($related_query->have_posts()):?>
<h4 class="meta">Related Stories</h4>
<div class="related-slider">
    <div class="otd-questions">
        <div class="slides-container-f">
             <ul id="slides-related" class="jcarousel-skin-tango">
             	<?php
				//Set Default Thumbnail Image URL's
				$related_thumbnail = get_post_meta($post->ID, "thumbnail_url", $single = true);
					$default_thumbnail = 'default-image.jpg';
				?>

                <?php while ($related_query->have_posts()) : $related_query->the_post(); 
	                if(has_post_thumbnail()){ ?>
                
				<li>
				<a href="<?php the_permalink(); ?>"<?php if( in_category('video') ){echo ' class="video-excerpt"';}else if( in_category('galleries') ){echo ' class="gallery-excerpt"';} ?>><?php the_post_thumbnail(); ?><?php if(  in_category(  array( 'video','galleries' )  )  ){echo '<span></span>';} ?></a>

				<a href="<?php the_permalink() ?>" rel="bookmark">
		
									
				<?php the_title(); ?></a>
				</li>
				<?php } ?>
				<?php endwhile; ?>
	
                </ul>
           </div>    
      </div>
</div>
<div class="clear"></div> 



<?php else: ?>

	<p style="text-align:center;">No related posts found</p>

<?php endif; ?>