<?php
	$microsite = true;
	get_header(); 
?>
<div class="m-content-wrap">
	<div class="m-content-shadow"></div>
	<div class="m-content">
			<div class="m-direction">
				<div class="m-triangle"></div>
				<span>Northeast</span>
			</div>
			<div class="posts-wrap">
				<div class="p-container clearfix">
					<?php			
					// WP_Query arguments
					$args = array (
						'category_name'         	=> 'northeast',			
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
	</div><!-- end .m-content -->				
</div><!-- end .m-content-wrap -->					
<div class="m-truck-container m-truck-region">
	<div class="m-truck">
		<div class="m-truck-title clearfix">
			<h3>RIGGED & READY</h3>
			<div title="track tips"></div>
		</div>
		<p>Explore the all new 2015<br> RAM 1500</p>
		<a href="" class="blue-round-btn">
			<span class="m-text-under">READ NOW</span>
			<div class="m-btn-horizontal"></div>
			<div class="m-btn-vertical"></div>
			<span class="m-text-over">READ NOW</span>
		</a>
	</div>
</div><!-- .m-truck-container -->		
<div class="m-loc">
	<h2>Choose different location</h2>
	<div class="m-loc-wrap">
		<ul class="clearfix">
			<li>
				<a href="/rigged-ready/northeast/">
					<div class="m-loc-circle"></div>
					<span>NORTHEAST</span>
				</a>
			</li>
			<li>
				<a href="/rigged-ready/southeast/">
					<div class="m-loc-circle"></div>
					<span>SOUTHEAST</span>
				</a>
			</li>
			<li>
				<a href="/rigged-ready/midwest/">
					<div class="m-loc-circle"></div>
					<span>MIDWEST</span>
				</a>
			</li>
			<li>
				<a href="/rigged-ready/southwest/">
					<div class="m-loc-circle"></div>
					<span>SOUTHWEST</span>
				</a>
			</li>
			<li>
				<a href="/rigged-ready/northwest/">
					<div class="m-loc-circle"></div>
					<span>NORTHWEST</span>
				</a>
			</li>
		</ul>
	</div>
</div><!-- .m-loc -->			

				
	

<?php get_footer(); ?>