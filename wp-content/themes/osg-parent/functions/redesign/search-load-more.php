<?php

// Add scripts only if $is_single_default = true. Scripts to be loaded only on single post pages
//--------------------------------------------//
add_action('init', 'register_search_script');
add_action('wp_footer', 'print_search_script');

function register_search_script() {
	wp_register_script( 'search-default-script', get_bloginfo( 'template_directory' ) . '/js/redesign/search.js', array( 'jquery' ), '1.0', true );
	wp_localize_script( 'search-default-script', 'ajax_object',
        array( 
        	'ajax_url' 	=> admin_url( 'admin-ajax.php' )
        ) 
	);
}

function print_search_script() {
	global $is_search;

	if ( ! $is_search )
		return;
	wp_print_scripts('search-default-script');
}



// Load More Posts
//--------------------------------------------//	
if ( is_admin()) {  
    add_action( 'wp_ajax_s_load_latest', 's_load_latest' );
    add_action( 'wp_ajax_nopriv_s_load_latest', 's_load_latest' );
} else {
    // Add non-Ajax front-end action hooks here
}

function s_load_latest() {
	global $wpdb;          
    ob_start();  
    
    $post_count		= $_POST['post_count'];
    $post_per_page	= $_POST['post_per_page'];
    $search_query	= strval($_POST['search_query']);
    $author			= strval($_POST['author']);

	$p_counter		= 0;
	$dartdomain 	= get_option('dart_domain', false);

	if ($page_type == 'post-type-archive-reader_photos') $post_type = 'reader_photos';
			
	$args = array (
		'post_type'			=> 'post',
		'posts_per_page'	=> $post_per_page,
		'post_status'		=> 'publish',
		'order'				=> 'DESC',
		'offset'			=> $post_count,
		's' 				=> $search_query,
		'author'			=> $author
	);
	
	// The Query
	$query = new WP_Query( $args );
	// The Loop
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();	
			$author 		= get_the_author();
			$acf_byline 	= get_field("byline", $post->ID);
			?>
			<li class="c-item">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('list-thumb'); ?></a>
				<div class="c-info">
					<div class="c-cats">
						<?php if (function_exists('primary_and_secondary_categories')){ echo primary_and_secondary_categories(null, ','); } ?>
					</div>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); echo get_search_query();?></a></h2>
					<!--<span class="c-author"><?php //if (!$acf_byline) { if ($author != 'admin') echo 'by '. $author;} else {echo $acf_byline;} ?></span>-->
				</div>
			</li>
	<?php
			if ($p_counter == 1 || $p_counter == 6) { echo '<li class="c-ad ad-wrap"><span class="ad-span">Advertisement</span><div class="ad-inner"><iframe class="new-iframe-ad" width="300" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad.php?term=home&ad_code='.$dartdomain.'&ad_unit=mediumRectangle&page=homepage"></iframe></div></li>'; }
			$p_counter++;
		}
	} else { ?>
		<script>
			jQuery('#btn_more_posts > span').text('No more results').css("color", "#888"); 
			jQuery('#btn_more_posts').removeAttr("id").css({"cursor" : "default", "background-color" : "#ececec"});
		</script>
<?php }
	wp_reset_postdata();
	$response = ob_get_contents();
	ob_end_clean();
	
	echo $response;
	wp_die();
}























