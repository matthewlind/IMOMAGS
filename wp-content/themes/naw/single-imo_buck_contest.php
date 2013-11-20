<?php

$productName = get_post_meta($post->ID,"product_name",true);
$productDescription = get_post_meta($post->ID,"product_description",true);
$thumbnailID = get_post_meta($post->ID,"product",true);

$thumbnailImage = wp_get_attachment_image($thumbnailID,"thumbnail");

get_header(); ?>
<div class="special-features">
	<ul>
		<li class="home-featured features">
			<div class="arrow-right"></div>
			<div class="feat-post">
	        	<div class="feat-text">
	        		<h3>Special Features</h3>
	            </div>
	        </div>
		</li>
		<?php if( function_exists('showFeaturedList')){ echo showFeaturedPosts('1'); } ?>
	</ul>
</div>
    <div class="inner-main">
    	<?php imo_sidebar();?>
		<div id="primary" class="general">
            <div id="content" class="general-frame" role="main">
				<?php echo $post->post_content; ?>
		
					<div class="caption-banner">
				  		<div class="caption-banner-text">This Week's Photo</div>
					</div>
				
				  	<div class="caption-contest">
				  	
				  	<?php $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "full"); ?>
				  	<img src="<?php echo $img_src[0]; ?>" class="wp-post-image" alt="<?php the_title(); ?>" />
				  
				  	<?php
					$commentID = get_post_meta($post->ID, '_buck_id', true);
					if ($commentID) : 
						$comment = get_comment($commentID); ?>
						<h2>The Winning Caption:</h2>
						<?php echo get_avatar($comment->comment_author_email, 60); ?>
						<div class="winning-caption">
							<div class="author"><?php echo $comment->comment_author; ?></div>
							<div class="caption"><?php echo $comment->comment_content; ?></div>
						</div>
					<?php endif; ?>
					
					</div>

					<div class="prize-box">
						<div class="prize-thumb">
							<?php echo $thumbnailImage; ?>
						</div>
						<h2>The Prize:</h2>
						<h4><?php echo $productName; ?></h4>
						<p><?php echo $productDescription; ?></p>
					</div>
					<?php comments_template(); ?>

                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'content/content-single', get_post_format() ); ?>

                    <div class="post-comments-area">
                        <?php comments_template( '', true ); ?>
                    </div>
                    
                    <div class="hr"></div>
                    <?php social_footer(); ?> 
					<a href="#" class="back-top jq-go-top">back to top</a>
                <?php endwhile; // end of the loop. ?>
				
            </div><!-- #content -->
        </div><!-- #primary -->
        
    </div>
<?php get_footer(); ?>