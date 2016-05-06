<?php

// Add scripts only if $is_single_default = true. Scripts to be loaded only on single post pages
//--------------------------------------------//
add_action('init', 'register_home_script');
add_action('wp_footer', 'print_home_script');

function register_home_script() {
	wp_register_script( 'home-default-script', get_bloginfo( 'template_directory' ) . '/js/redesign/home-and-cat.js', array( 'jquery' ), '1.0', true );	
	wp_localize_script( 'home-default-script', 'ajax_object',
        array( 
        	'ajax_url' 	=> admin_url( 'admin-ajax.php' )
        ) 
	);
}

function print_home_script() {
	global $is_homy;

	if ( ! $is_homy )
		return;
	wp_print_scripts('home-default-script');
}



// Load More Posts
//--------------------------------------------//	
if ( is_admin()) {  
    add_action( 'wp_ajax_h_load_latest', 'h_load_latest' );
    add_action( 'wp_ajax_nopriv_h_load_latest', 'h_load_latest' );
} else {
    // Add non-Ajax front-end action hooks here
}

function h_load_latest() {
	global $wpdb;          
    ob_start();  
    
    $cat_id			= $_POST['cat_id'];
    $post_count		= $_POST['post_count'];
    $post_per_page	= $_POST['post_per_page'];
	$post_not		= $_POST['post_not'];
	$post_not_array = explode(',', $post_not);
	$p_counter		= 0;
		
	$args = array (
		'cat'         		=> $cat_id,
		'posts_per_page'	=> $post_per_page,
		'order'				=> 'DESC',
		'post_status'		=> 'publish',
		'post__not_in'		=> $post_not_array,
		'offset'			=> $post_count
	);
	// The Query
	$query = new WP_Query( $args );
	// The Loop
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();	
			$author 		= get_the_author();
			$acf_byline 	= get_field("byline", $post->ID);
			$thumb 			= get_the_post_thumbnail($post->ID,"list-thumb");
			?>
			
			<li class="l-item" featured_id="<?php echo $post->ID ?>">
				<div class="l-img"><a href="<?php the_permalink(); ?>" onclick="<?php echo $tracking; ?>"><?php echo $thumb; ?></a></div>
				<div class="l-info">
					<div class="l-cats"><?php if (function_exists('primary_and_secondary_categories')){ echo primary_and_secondary_categories(); } ?></div>
					<div class="l-title">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					</div>
					<div class="l-author"><?php if (!$acf_byline) { if ($author != 'admin') echo 'by '. $author;} else {echo $acf_byline;} ?></div>
				</div>
			</li>
						
		 
	<?php	}
	} else { ?>
		<script>
			jQuery('#btn_more_home > span').text('No more posts').css("color", "#eeeeee"); 
			jQuery('#btn_more_home').removeAttr("id");
		</script>
<?php }
	wp_reset_postdata();
	$response = ob_get_contents();
	ob_end_clean();
	
	echo $response;
	wp_die();
}

