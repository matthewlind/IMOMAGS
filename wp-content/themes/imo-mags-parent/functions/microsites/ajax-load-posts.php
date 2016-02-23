<?php
	
if ( is_admin()) {  
    add_action( 'wp_ajax_load_posts__action', 'load_microsite_posts' );
    add_action( 'wp_ajax_nopriv_load_posts__action', 'load_microsite_posts' );
} else {
    // Add non-Ajax front-end action hooks here
}

add_action( 'wp_enqueue_scripts', 'my_enqueue_cross' );
function my_enqueue_cross() {	
	global $cat;
	if ( is_category('shoot101')) {
		// Get the mumber of posts in 'crossbows' category. Then us it in you js file			
		$postsInCat = get_term_by('slug','crossbows','category');
		$postsInCat = $postsInCat->count;
		
		wp_enqueue_script( 'script-microsite-ajax', get_template_directory_uri() . '/js/microsite-js/ajax-load-posts.js', array( 'jquery' ), '1.0', true );
			
		wp_localize_script( 'script-microsite-ajax', 'ajax_object',
	        array( 
	        	'ajax_url' => admin_url( 'admin-ajax.php' ),
	        	'crossbows_posts_cout' => $postsInCat
	        ) 
		);
	
	}
}
function load_microsite_posts() {
	global $wpdb;           
    ob_clean();  
	echo "start";
	
	$post_counter = 0;
	
	$args = array (
		'category_name'         	=> 'shoot101',
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
		if ($post_counter == 1) { ?>
						<div class="top-ad-home"> 
							<p>ADVERTISMENT</p>
							<?php imo_ad_placement("microsite_ATF_300x250"); ?>
				    	</div>
			<?php	}
		$post_counter++;	
			}
		} else {
			echo "not found";
		}
		wp_reset_postdata(); 	
   
	wp_die();
}