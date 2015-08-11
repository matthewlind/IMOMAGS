<?php
	$id_rev = get_category_by_slug('crossbow-revolution'); 
	$exclude_id = $id_rev->term_id;
	
?>

<div class="rel-container clearfix">
	<header class="p-rel-header clearfix">
		<div class="rel-logo">
			<img src="<?php bloginfo('template_directory'); ?>/images/microsites/gameandfish/gameandfish-logo-white.png">
		</div>
		<h5>MORE CROSSBOW COVERAGE FROM GAME & FISH</h5>
		<div class="rel-triangle"></div>
	</header>
	<div class="rel-wrap clearfix">					
		<?php			
			$args = array (
				'category_name'         	=> 'crossbows',			
				'posts_per_page'      		=> 8,
				'order'						=> 'DESC',
				'category__not_in' 			=> array( $exclude_id )
			);
			// The Query
			$query = new WP_Query( $args );
			// The Loop
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();			
					$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		?>
			<a class="rel-link" href="<?php the_permalink(); ?>">
				<div class="rel-box" style="background-image: url('<?php echo $feat_image; ?>')"></div>
				<div class="rel-title">
					<h3><?php the_title();?></h3>
				</div>
			</a>
		<?php
				}
			} else {
				echo "not found";
			}
			wp_reset_postdata();
		?>
	</div>
	<div class="rel-load-more">
		
		<a class="load-btn" id="load-more-posts" href="#">
			LOAD MORE
			<i class="icon-arrow-left"></i>
			<div class="loader-anim display-none">
				<div class="loader-inner line-spin-fade-loader">
					<div></div>
					<div></div>
					<div></div>
					<div></div>
					<div></div>
					<div></div>
					<div></div>
					<div></div>
				</div>
			</div>
		</a>
	</div>
</div><!-- end .rel-container -->
