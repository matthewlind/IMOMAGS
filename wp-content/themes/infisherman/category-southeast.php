<?php get_header(); ?>
<div class="content-wrap" style="background: url('/wp-content/themes/infisherman/images/rigged-and-ready/regions-fade-bottom/southeast.png') center top / 100% no-repeat;">
	<div class="content">
			<div class="m-direction">
				<div class="m-triangle"></div>
				<span>Southwest</span>
			</div>
			<div class="posts-wrap">
				<div class="p-container clearfix">
					<?php			
					// WP_Query arguments
					$args = array (
						'category_name'         	=> 'southeast',			
						'posts_per_page'      		=> -1,
						'order'						=> 'DESC',
					);
					// The Query
					$query = new WP_Query( $args );
					// The Loop
					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post();
						
						//$box_size = get_post_meta(get_the_ID(),"box_size", true);
						//later you can add cnditional if mobile $image_size = "medium"
		/*
						if ($box_size == "wide") {
							$image_size = "full";
						}  else {
							$image_size = "large";
						}
		*/					
						$image_id = get_post_meta(get_the_ID(),"image", true);
						$image = wp_get_attachment_image_src($image_id, "large");
						//$image = wp_get_attachment_image_src($image_id, $image_size);
					?>
					<a class="link-box" href="<?php the_permalink(); ?>">	
						<div class="post-box" style="background-image: url('<?php echo $image[0]; ?>')"></div>
					</a>
					<?php
							}
						} else {
							echo "not found";
						}
						wp_reset_postdata();
					?>
				</div><!-- end .p-container -->
				
				<?php // echo get_template_part( 'content/relative', 'microsite' ); ?>
			</div><!-- end .posts-wrap -->
	</div><!-- end .content -->				
</div><!-- end .content-wrap -->					
				
				
				
	

<?php get_footer(); ?>