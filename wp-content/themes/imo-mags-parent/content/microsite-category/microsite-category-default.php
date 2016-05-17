<?php	
	$cat 			= get_query_var('cat');
	$this_cat 		= get_category($cat);
	$this_cat_slag 	= $this_cat->slug;
	$this_cat_id	= $this_cat->term_id;
	$term_cat_id 	= 'category_'.$this_cat_id;
	
	$social_share_message 	= get_field('social_share_message', $term_cat_id);
	
	if ($this_cat_slag == 'crossbows') $this_cat_slag = 'crossbow-revolution';
?>

<div class="content">
	<div class="posts-wrap" id="posts_wrap">
<?php	
	$p_counter = 0;	
	$args = array (
		'category_name'         	=> $this_cat_slag,
		'posts_per_page'      		=> 12,
		'order'						=> 'DESC'
	);
	// The Query
	$query = new WP_Query( $args );
	// The Loop
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();	
						
			$image_id = get_post_meta(get_the_ID(),"image", true);
			$image = wp_get_attachment_image_src($image_id, "large");
			
			if ($p_counter == 0) { 
				echo '<div class="p-feat-container clearfix">';
			}
?>
			<a class="link-box reg-post" href="<?php the_permalink(); ?>">	
				<div class="post-box" style="background-image: url('<?php echo $image[0]; ?>')"></div>
			</a>
<?php
			if ($p_counter == 1) { 
				echo '<div class="top-ad-home"></div>';
			}
			if ($p_counter == 3) { ?>
			</div><!-- .p-feat-container -->
			<div class="featured-message">
				<span><?php echo $social_share_message; ?></span>
				<div class="m-social-buttons">
					<?php 
					if( have_rows('site_share_buttons', $term_cat_id) ) { 						
						while ( have_rows('site_share_buttons', $term_cat_id) ) { the_row();
							$face_twit_title = get_sub_field('face_twit_title');
							$email_subject = get_sub_field('email_subject');
							$email_message = get_sub_field('email_message');
					?>
					<ul>
						<li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo (urlencode(site_url())) . '/'. $cat_slug; ?>&title=<?php echo $face_twit_title; ?>" class="icon-facebook" target="_blank"></a></li>
						<li><a href="http://twitter.com/intent/tweet?status=<?php echo $face_twit_title; ?>+<?php echo (urlencode(site_url())) . '/'. $cat_slug; ?>" class="icon-twitter" target="_blank"></a></li>
						<li><a href="mailto:?subject=<?php echo $email_subject; ?>&body=<?php echo $email_message . ' ' . (urlencode(site_url())) . '/'. $cat_slug; ?>" class="icon-mail" target="_blank"></a></li>
					</ul>
					<?php } }?>
				</div><!-- .m-social-buttons -->
			</div><!-- end .featured-message -->
			<div id="reg_post_wrap" class="p-container clearfix">
				
<?php		}
			if ($p_counter == 11) {
?>
			<div class="load-more-reg" id="load_more_reg">
				<a href="#" id="load_reg_posts" class="load-btn" data-cat-load="<?php echo $this_cat_slag; ?>">
					Load More
					<i class="icon-arrow-left"></i>
					<div class="loader-anim display-none">
						<div class="loader-inner line-spin-fade-loader">
							<div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div>
						</div>
					</div>
				</a>
			</div><!-- .load-more-reg -->
		</div><!-- .p-container -->	
<?php		}
	
			$p_counter++;
		}
	} else { 
		echo "no posts found";
    }
	wp_reset_postdata();
?>
</div><!-- end .p-container -->				

		
		<?php if ($dartDomain == "imo.gameandfish") { include(get_template_directory() . '/content/microsite-category/related-microsite.php'); } else { }?>
	</div><!-- end .posts-wrap -->
</div><!-- end .content -->