<?php
	$microsite = true;
	get_header(); 
?>
<div class="m-content-wrap">
	<div class="m-content-shadow"></div>
	<div class="m-content">
			<div class="m-direction">
				<div class="m-triangle"></div>
				<span>Midwest</span>
			</div>
			<div class="posts-wrap">
				<div class="p-container clearfix">
					<?php			
					// WP_Query arguments
					$args = array (
						'category_name'         	=> 'mw',			
						'posts_per_page'      		=> -1,
						'order'						=> 'DESC',
					);
					// The Query
					$query = new WP_Query( $args );
					// The Loop
					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post();
							$image_id = get_post_meta(get_the_ID(),"image", true);
							$image = wp_get_attachment_image_src($image_id, "large");
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
			</div><!-- end .posts-wrap -->
	</div><!-- end .m-content -->				
</div><!-- end .m-content-wrap -->	

<?php get_template_part('content/rigged-ready/sweeps', 'banner'); ?>						
<?php get_template_part('content/rigged-ready/choose', 'location-bottom'); ?>			

<?php get_footer(); ?>