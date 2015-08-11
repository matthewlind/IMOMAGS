<?php	
    $idObj = get_category_by_slug($cat_slug); 
	$cat_id = $idObj->term_id;
	$term_cat_id = 'category_'.$cat_id;
	
	$social_share_message = get_field('social_share_message', $term_cat_id);
	$sponsors_disclaimer = get_field('sponsors_disclaimer', $term_cat_id);
?>

<?php if( in_array( 'sponsors_disclaimer', get_field('additional_elements', $term_cat_id) ) ) { ?>
<div class="sponsors-disclaimer">
	<span><?php echo $sponsors_disclaimer; ?></span>
</div>
<?php } ?>

<div class="content">
		<div class="posts-wrap">
			<div class="p-feat-container clearfix">
				<?php
				$post_counter = 0;	
					
				$args = array (
					'category_name'         	=> $cat_slug,			
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
				<span><?php echo $social_share_message; ?></span>
				<div class="m-social-buttons">
					<?php 
					if( have_rows('site_share_buttons', $term_cat_id) ) : 						
						while ( have_rows('site_share_buttons', $term_cat_id) ) : the_row();
							$face_twit_title = get_sub_field('face_twit_title');
							$email_subject = get_sub_field('email_subject');
							$email_message = get_sub_field('email_message');
					?>
					<ul>
						<li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo (urlencode(site_url())) . '/'. $cat_slug; ?>&title=<?php echo $face_twit_title; ?>" class="icon-facebook" target="_blank"></a></li>
						<li><a href="http://twitter.com/intent/tweet?status=<?php echo $face_twit_title; ?>+<?php echo (urlencode(site_url())) . '/'. $cat_slug; ?>" class="icon-twitter" target="_blank"></a></li>
						<li><a href="mailto:?subject=<?php echo $email_subject; ?>&body=<?php echo $email_message . ' ' . (urlencode(site_url())) . '/'. $cat_slug; ?>" class="icon-mail" target="_blank"></a></li>
					</ul>
					<?php endwhile; 
						endif;?>
				</div><!-- .m-social-buttons -->
			</div><!-- end .featured-message -->
			<div class="p-container clearfix">
				<?php
				//$id_obj = get_category_by_slug('shoot101-featured'); 
				//$cat_id = $id_obj->term_id;
				// WP_Query arguments
				$args = array (
					'category_name'         	=> $cat_slug,			
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
			<?php if ($dartDomain == "imo.gameandfish") { include(get_template_directory() . '/content/microsite-category/related-microsite.php'); } else { }?>
		</div><!-- end .posts-wrap -->
</div><!-- end .content -->