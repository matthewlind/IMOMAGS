<?php
	echo get_template_part( 'header', 'shoot101' );
	// The opening class in the header is .scroller-inner
/*
	$parrent_id = wp_get_post_parent_id( $post_ID ); 
	$post_slug = $post->post_name;
	
	$cat = get_category( get_query_var( 'cat' ) );
	$cat_slug = $cat->slug;
	$cat_name = $cat->cat_name;
*/
?>
<div class="sponsors-disclaimer">
	<span>BROGHT TO YOU BY VISTA OUTDOOR INC. AND ITS FAMILY OF <a href="#">BRANDS</a></span>
</div>
<div class="content">
		<div class="posts-wrap">
			<div class="p-feat-container clearfix">
				<?php
				$args = array (
					'category_name'         	=> 'shoot101',			
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
			</div><!-- end .p-feat-container -->
						
			<div class="featured-message">
				<span>Help grow shooting in America.  Share this with a new shooter!</span>
				<div class="m-social-buttons">
					<ul>
						<li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php print(urlencode(get_permalink())); ?>&title=<?php print(urlencode(the_title())); ?>" class="icon-facebook"></a></li>
						<li><a href="http://twitter.com/intent/tweet?status=<?php print(urlencode(the_title())); ?>+<?php print(urlencode(get_permalink())); ?>" class="icon-twitter"></a></li>
						<li><a class="icon-mail"></a></li>
					</ul>
				</div>
			</div><!-- end .featured-message -->
			<div class="p-container clearfix">
				<?php
				//$id_obj = get_category_by_slug('shoot101-featured'); 
				//$cat_id = $id_obj->term_id;
				// WP_Query arguments
				$args = array (
					'category_name'         	=> 'shoot101',			
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
							'category_name'         	=> 'shoot101',			
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
			</div><!-- end .p-ga-container -->
		</div><!-- end .posts-wrap -->
</div><!-- end .content -->


<?php echo get_template_part( 'footer', 'shoot101' ); ?>