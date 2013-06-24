<?php 
/*
YARPP Template: Slider
Author: horechek
Description: A Slider YARPP template.
*/
?>


<?php if (have_posts()): ?>

    <ul class="slides">
        <?php while (have_posts()) : the_post(); ?>
        <li>
            <div class="paging-post">
                <div class="paging-post-inner">
                    <?php if(has_post_thumbnail()){ ?>
                    <div class="paging-image">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('index-thumb'); ?></a>
                    </div>
                    <?php } ?>
                    <div class="paging-post-holder">
                        
                        <h3 class="entry-title">
                            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
                            	<?php 
	                            	if(has_post_thumbnail()){ 
										$title = the_title('','',FALSE); echo substr($title, 0, 50); if (strlen($title) > 50) echo "..."; 
									}else{ 
										$title = the_title('','',FALSE); echo substr($title, 0, 100); if (strlen($title) > 100) echo "..."; 
									} 
								?>
							</a>
                        </h3>
                      
                    </div>
                </div>
            </div><!-- #post -->
        </li>
        <?php endwhile; ?>
        </ul>

<?php else: ?>
<!-- <p>No related photos.</p> -->
<?php endif; ?>

