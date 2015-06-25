<div class="rel-container clearfix">
	<header class="p-rel-header clearfix">
		<div class="rel-logo">
			<img src="/wp-content/themes/gunsandammo/images/logo-white.png">
		</div>
		<h5>RELATED ARTICLES FROM GUNS & AMMO</h5>
		<div class="rel-triangle"></div>
	</header>
	<div class="rel-wrap clearfix">					
		<?php
			$args = array (
				'category_name'         	=> 'crossbow-revolution',			
				'posts_per_page'      		=> 4,
				'order'						=> 'DESC',
				'meta_query' => array(
				  array(
				    'key' => 'featured_post',
				    'value' => '0',
				    'compare' => '=='
				  )
				)
			);
			// The Query
			$query = new WP_Query( $args );
			// The Loop
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();			
					$image_id = get_post_meta(get_the_ID(),"image", true);
					$image = wp_get_attachment_image_src($image_id, "large");
					//$image = wp_get_attachment_image_src($image_id, $image_size);
		?>
			<a class="rel-link" href="<?php the_permalink(); ?>">
				<div class="rel-box" style="background-image: url('<?php echo $image[0]; ?>')"></div>
				<h3><?php the_title();?></h3>
			</a>
		<?php
				}
			} else {
				echo "not found";
			}
			wp_reset_postdata();
		?>
	</div>
</div><!-- end .rel-container -->
