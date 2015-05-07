<?php
	$microsite = true;
	get_header();
	
    $category_id = get_cat_ID( 'shoot101' );
    $category_link = get_category_link( $category_id );
?>
<div class="sponsors-disclaimer">
	<span>BROUGHT TO YOU BY VISTA OUTDOOR INC. AND ITS FAMILY OF <a href="http://www.vistaoutdoor.com/brands/" target="_blank">BRANDS</a></span>
</div>
<div class="content">
		<div class="posts-wrap">
			<div class="p-feat-container clearfix">
				<?php
				$post_counter = 0;	
					
				$args = array (
					'category_name'         	=> 'wheels-afield',			
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
				<span>Help grow shooting in America.  Share this with a new shooter!</span>
				<div class="m-social-buttons">
					<ul>
						<li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>&title=Shoot101: A starter's guide every new shooter should read." class="icon-facebook" target="_blank"></a></li>
						<li><a href="http://twitter.com/intent/tweet?status=Shoot101: A starter's guide every new shooter should read.+<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>" class="icon-twitter"  target="_blank"></a></li>
						<li><a href="mailto:?subject=Website I came across&body=Check out this website! A starter's guide every new shooter should read. <?php echo $category_link; ?>" class="icon-mail"  target="_blank"></a></li>
					</ul>
				</div>
			</div><!-- end .featured-message -->
			<div class="p-container clearfix">
				<?php
				//$id_obj = get_category_by_slug('shoot101-featured'); 
				//$cat_id = $id_obj->term_id;
				// WP_Query arguments
				$args = array (
					'category_name'         	=> 'wheels-afield',			
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
			
			<?php // echo get_template_part( 'content/relative', 'microsite' ); ?>
		</div><!-- end .posts-wrap -->
</div><!-- end .content -->


<?php echo get_template_part( 'footer', 'shoot101' ); ?>