<?php
	$microsite = true;
	get_header();
	
	
	$dartDomain = get_option("dart_domain", $default = false);
?>
<div class="content">
		<div class="posts-wrap">
			<div class="p-feat-container clearfix">
				<?php
				$post_counter = 0;	
					
				$args = array (
					'category_name'         	=> 'crossbow-revolution',			
					'posts_per_page'      		=> 3,
					'order'						=> 'DESC',
					'meta_query' => array(
					  array(
					    'key' => 'featured_post',
					    'value' => '1',
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
						$image = wp_get_attachment_image_src($image_id, "full");
						
						$wide_image_id = get_post_meta(get_the_ID(),"image_wide", true);
						$image_wide = wp_get_attachment_image_src($wide_image_id, "full");
				?>
				<a class="link-box" href="<?php the_permalink(); ?>">	
					<?php if ($post_counter == 2 && mobile() == false) { ?>
					<div class="post-box" style="background-image: url('<?php echo $image_wide[0]; ?>')"></div>	
					<?php } else { ?>
					<div class="post-box" style="background-image: url('<?php echo $image[0]; ?>')"></div>
					<?php } ?>
				</a>
				<?php
					$post_counter++;	
						}
					} else {
						echo "not found";
					}
					wp_reset_postdata();
				?>
			</div><!-- end .p-feat-container -->
						
			<div class="featured-message">
				<span>Love Guns, Gear, & Vehicles? Then Share it!<?php echo $dartDomain; ?></span>
				<div class="m-social-buttons">
					<ul>
						<li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo (urlencode(site_url())) . '/gear-accessories/gear-hunting/crossbows/'; ?>&title=Crossbow Revolution Magazine" class="icon-facebook" target="_blank"></a></li>
						<li><a href="http://twitter.com/intent/tweet?status=Crossbow Revolution Magazine+http://www.gameandfishmag.com/gear-accessories/gear-hunting/crossbows/" class="icon-twitter" target="_blank"></a></li>
						<li><a href="mailto:?subject=Website I came across&body=Check out this website! Crossbow Revolution Magazine. <?php echo (urlencode(site_url())) . '/gear-accessories/gear-hunting/crossbows/'; ?>" class="icon-mail" target="_blank"></a></li>
					</ul>				
				</div>
			</div><!-- end .featured-message -->
			<div class="p-container clearfix">
				<?php
				//$id_obj = get_category_by_slug('shoot101-featured'); 
				//$cat_id = $id_obj->term_id;
				// WP_Query arguments
				$args = array (
					'category_name'         	=> 'crossbow-revolution',			
					'posts_per_page'      		=> -1,
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
			<?php get_template_part( 'content/related', 'microsite' ); ?>
			
			<?php // echo get_template_part( 'content/relative', 'microsite' ); ?>
		</div><!-- end .posts-wrap -->
</div><!-- end .content -->


<?php get_footer(); ?>