<?php /*
Post Thumbnail Template
Author: Fox Bowden
*/
?>

<h4 class="meta">Related Posts</h4>

<?php if ($related_query->have_posts()):?>

<div class="questions-slider related-slider">
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
				<p><?php the_post_thumbnail(); ?></p>

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

	<p>No related posts found</p>

<?php endif; ?>