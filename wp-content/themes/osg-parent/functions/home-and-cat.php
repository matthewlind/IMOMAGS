<?php
// Add scripts only if $is_single_default = true. Scripts to be loaded only on single post pages
//--------------------------------------------//
add_action('init', 'register_home_script');
add_action('wp_footer', 'print_home_script');

function register_home_script() {
	wp_register_script( 'home-default-script', get_bloginfo( 'template_directory' ) . '/js/home-and-cat.js', array( 'jquery' ), '1.0', true );
	//wp_register_script( 'home-flex-slider', get_bloginfo( 'template_directory' ) . '/js/plugins/flexslider/jquery.flexslider-min2.6.0.js', array( 'jquery' ), '1.0', true );
	wp_localize_script( 'home-default-script', 'ajax_object',
        array( 
        	'ajax_url' 	=> admin_url( 'admin-ajax.php' )
        ) 
	);
}

function print_home_script() {
	global $is_home_cat;

	if ( ! $is_home_cat )
		return;
	wp_print_scripts('home-default-script');
	//wp_print_scripts('home-flex-slider');
}



// Load More Posts, Home, Category
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
    
    $dartDomain     = get_option("dart_domain", $default = false);
    $cat_id			= (isset($_POST['cat_id']))? $_POST['cat_id']:"";
    $cat_slug		= (isset($_POST['cat_slug']))? $_POST['cat_slug']:"";
    $fb_like		= (isset($_POST['fb_like']))? intval($_POST['fb_like']): 0 ;
    $post_type		= (isset($_POST['post_type']))? $_POST['post_type'] : 'post' ;
    $post_count		= $_POST['post_count'];
    $post_per_page	= $_POST['post_per_page'];
	$post_not		= $_POST['post_not'];
	$page_type		= $_POST['page_type'];
	$post_not_array = explode(',', $post_not);
	$p_counter		= 0;
			
	$args = array (
		'post_type'			=> $post_type,
		'cat'         		=> $cat_id,
		'category_name'		=> $cat_slug,
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
			$acf_byline 	= get_field("byline", $query->post->ID);
			?>
			<li class="c-item">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('list-thumb'); ?></a>
				<div class="c-info">
					<?php if (in_category('sponsored', $query->post->ID)) echo '<span class="is-sponsored">Sponsored</span>'; ?>
					<div class="c-cats">
						<?php 
							if ($page_type == 'post-type-archive-reader_photos') { 
								$categories = get_the_category();
								$separator = ', ';
								$output = '';
								if($dartDomain == "imo.hunting"){ $photosURL = "/rack-room?"; }
								else{$photosURL = "/photos?";}
								
								if($categories){
									foreach($categories as $category) {
										$tracking = "_gaq.push(['_trackEvent','Category','".$category->cat_name."']);";
										$output .= '<a class="category-name-link" onclick="'.$tracking.'" href="'.$photosURL.$category->slug.'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
									}
									echo trim($output, $separator);
								}
							} else { 
								//if (function_exists('primary_and_secondary_categories')){ echo primary_and_secondary_categories(null, ','); }
							} 
						?>
					</div>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php if ($fb_like == 1) { ?>
						<div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
					<?php } ?>
					<?php if(in_category("master-angler")){ ?><img class="ma-badge" src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/pic/badge-ma.png" alt="Master Angler" /><?php } ?>
				</div>
			</li>
	<?php  $cat = get_the_category();
		if ($p_counter == 1 || $p_counter == 6) { 
			echo '<li class="c-ad ad-wrap"><span class="ad-span">Advertisement</span><div class="ad-inner"><iframe class="new-iframe-ad" width="300" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad.php?term='.$cat[0]->slug.'&ad_code='.$dartDomain.'&ad_unit=mediumRectangle&page=category"></iframe></div></li>'; }
			$p_counter++;
		}
	} else { ?>
		<script>
			jQuery('#btn_more_posts > span').text('No more posts').css("color", "#888"); 
			jQuery('#btn_more_posts').removeAttr("id").css({"cursor" : "default", "background-color" : "#ececec"});
		</script>
<?php }
	wp_reset_postdata();
	$response = ob_get_contents();
	ob_end_clean();
	
	echo $response;
	wp_die();
}


// Load Home BTF
//--------------------------------------------//	
if ( is_admin()) {  
    add_action( 'wp_ajax_load_cat_home_btf', 'load_cat_home_btf' );
    add_action( 'wp_ajax_nopriv_load_cat_home_btf', 'load_cat_home_btf' );
} else {
    // Add non-Ajax front-end action hooks here
}

function load_cat_home_btf() {
	global $wpdb;          
    ob_start(); 
    $curr_cat_id	= (isset($_POST['cat_id']))? $_POST['cat_id']:"";
    $dartDomain     = get_option("dart_domain", $default = false);
    $page_type		= $_POST['page_type'];
	$magazine_img 	= get_option('magazine_cover_uri' );
	$deal_copy 		= get_option('deal_copy' );
	$site_name		= trim(get_bloginfo('name'), "Magazine"); 
	$subs_link 		= get_option('subs_link') . "/?pkey=";
	$btf_sections	= 'cat_btf_sections';
	
	if ($page_type == 'home') {
		$btf_sections = 'home_btf_sections';
	}
	
	if( have_rows($btf_sections, 'options') ) {
		while ( have_rows($btf_sections, 'options') ) { 
			the_row(); 
			$section = get_sub_field('section');
			include(get_template_directory() . '/content/cat-sections/section-'.$section.'.php');		
		}
	}
		
	$response = ob_get_contents();
	ob_end_clean();
	
	echo $response;
	wp_die();
}


