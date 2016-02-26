<?php
	
/* Load Posts from children category
--------------------------------------------*/	
if ( is_admin()) {  
    add_action( 'wp_ajax_load_posts__action', 'load_microsite_posts' );
    add_action( 'wp_ajax_nopriv_load_posts__action', 'load_microsite_posts' );
} else {
    // Add non-Ajax front-end action hooks here
}

add_action( 'wp_enqueue_scripts', 'my_enqueue_microsite' );
function my_enqueue_microsite() {	
	global $cat, $microsite;
	if ( $microsite ) {
		$cat 			= get_query_var('cat');
		$this_cat 		= get_category($cat);
		$this_cat_slag 	= $this_cat->slug;
		$this_cat_id	= $this_cat->term_id;
		$term_cat_id 	= 'category_'.$this_cat_id;
		
		wp_enqueue_script( 'script-microsite-ajax', get_template_directory_uri() . '/js/microsite-js/ajax-load-posts.js', array( 'jquery' ), '1.0', true );
			
		wp_localize_script( 'script-microsite-ajax', 'ajax_object',
	        array( 
	        	'ajax_url' => admin_url( 'admin-ajax.php' ),
	        	'term_cat_id' => $term_cat_id,
	        	'parent_cat_slug' => $this_cat_slag
	        ) 
		);
	
	}
}
function load_microsite_posts() {
	global $wpdb;          
    ob_clean();  
    $children_cat_slug = $_POST[ 'cat_slug' ];
    $term_cat_id = $_POST[ 'term_cat_id' ];
    $parent_cat_slug = $_POST[ 'parent_cat_slug' ];
    $social_share_message 	= get_field('social_share_message', $term_cat_id);
?>
<div class="p-feat-container clearfix">
<?php	
	$post_counter = 0;
	
	$args = array (
		'category_name'         	=> "$children_cat_slug + $parent_cat_slug",
		'post_status'				=> 'publish',			
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
	<a class="link-box feat-post" href="<?php the_permalink(); ?>">	
		<?php if ($post_counter == 2 && mobile() == false && tablet() == false ) { ?>
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
	<?php
	$p_counter = 0;	
	$args = array (
		'category_name'         	=> "$children_cat_slug + $parent_cat_slug",
		'post_status'				=> 'publish',			
		'posts_per_page'      		=> 7,
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
	<a class="link-box reg-post" href="<?php the_permalink(); ?>">	
		<div class="post-box" style="background-image: url('<?php echo $image[0]; ?>')"></div>
	</a>
<?php
			$p_counter++;
			if ($p_counter == 7) {
?>
			<div class="load-more-reg" id="load_more_reg">
				<a href="#" id="load_reg_posts" class="btn-think-border load-btn" data-cat-load="<?php echo $children_cat_slug . "+" . $parent_cat_slug; ?>">
					Load More
					<i class="icon-arrow-left"></i>
					<div class="loader-anim display-none">
						<div class="loader-inner line-spin-fade-loader">
							<div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div>
						</div>
					</div>
				</a>
			</div><!-- .load-more-reg -->	
<?php		}
		}
	} else { 
		echo "something went wrong";
    }
	wp_reset_postdata();
?>
</div><!-- end .p-container -->				
<?php		
	wp_die();
}


/* Load More Posts
--------------------------------------------*/	
if ( is_admin()) {  
    add_action( 'wp_ajax_load_more_m_posts', 'load_more_m_posts' );
    add_action( 'wp_ajax_nopriv_load_more_m_posts', 'load_more_m_posts' );
} else {
    // Add non-Ajax front-end action hooks here
}

function load_more_m_posts() {
	global $wpdb;          
    ob_clean(); 
    
    $children_cat_slug 	= $_POST['data_child_cat_slug'];
    $parent_cat_slug	= $_POST['parent_cat__slug'];
    $reg_post_count		= $_POST['reg_post_count'];

	$p_counter = 0;	
	$args = array (
		'category_name'         	=> "$children_cat_slug + $parent_cat_slug",
		'post_status'				=> 'publish',			
		'posts_per_page'      		=> 7,
		'offset'					=> $reg_post_count,
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
	<a class="link-box reg-post" href="<?php the_permalink(); ?>">	
		<div class="post-box" style="background-image: url('<?php echo $image[0]; ?>')"></div>
	</a>
<?php		
		}
	} else { ?>
		<script>jQuery('#load_more_reg').text('No more posts.'); </script>
<?php	}
	wp_reset_postdata();
   
	wp_die();
}