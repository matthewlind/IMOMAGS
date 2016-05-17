<?php

// Add scripts only if $is_single_default = true. Scripts to be loaded only on single post pages
//--------------------------------------------//
add_action('init', 'register_home_script');
add_action('wp_footer', 'print_home_script');

function register_home_script() {
	wp_register_script( 'home-default-script', get_bloginfo( 'template_directory' ) . '/js/redesign/home-and-cat.js', array( 'jquery' ), '1.0', true );
	wp_register_script( 'home-flex-slider', get_bloginfo( 'template_directory' ) . '/js/plugins/flexslider/jquery.flexslider-min2.6.0.js', array( 'jquery' ), '1.0', true );
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
	wp_print_scripts('home-flex-slider');
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
			<li class="c-item">
				<a href="<?php the_permalink(); ?>"><?php echo $thumb; ?></a>
				<div class="c-info">
					<div class="c-cats"><?php if (function_exists('primary_and_secondary_categories')){ echo primary_and_secondary_categories(null, ','); } ?></div>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<span class="c-author"><?php if (!$acf_byline) { if ($author != 'admin') echo 'by '. $author;} else {echo $acf_byline;} ?></span>
				</div>
			</li>
	<?php
			if ($p_counter == 7) { echo '<li class="c-ad ad-wrap"><span class="ad-span">Advertisement</span><div class="ad-inner"></div></li>'; }
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
    add_action( 'wp_ajax_load_home_btf', 'load_home_btf' );
    add_action( 'wp_ajax_nopriv_load_home_btf', 'load_home_btf' );
} else {
    // Add non-Ajax front-end action hooks here
}

function load_home_btf() {
	global $wpdb;          
    ob_start(); 
    
    $is_home_cat 	= true;
	$dartdomain 	= get_option('dart_domain', false);
	$magazine_img 	= get_option('magazine_cover_uri' );
	$deal_copy 		= get_option('deal_copy' );
	$features 		= get_field('homepage_featured_stories','options' );
	$site_name		= trim(get_bloginfo('name'), "Magazine"); 
    
?>    
    
    
<section id="section_subsicribe" class="home-subscribe clearfix">
		<div class="section-inner-wrap">
			<div class="subs-container clearfix">
				<h1>Subscribe & Save!</h1>
				<img src="<?php echo $magazine_img; ?>" alt="Gun Dog Magazine Cover">
				<div class="subs-info">
					<p><?php echo $deal_copy; ?></p>
					<a class="btn-lg" href="<?php echo $online_store_url; ?>">Subscribe Now!</a>
				</div>
			</div>
			<div class="store-container">
				<h1><?php echo $site_name; ?> Store</h1>
				<a class="store-link" href="">Visit Store</a>
				<div class="store-slider-wrap">
					<div id="store_slider" class="flexslider">
						<ul class="slides">
							<li>
								<div class="store-item-img">
									<a href=""><img src="/wp-content/themes/imo-mags-parent/images/temp/gun-dog.jpg" /></a>
								</div>
								<div class="store-item-title"><a href="">1 Lorem Ipsum Dolor Sit Amet</a></div>
								<a class="btn-sm" href="">Buy Now!</a>
							</li>
							<li>
								<div class="store-item-img">
									<img src="/wp-content/themes/imo-mags-parent/images/temp/gun-dog-dvd.jpg" />
								</div>
								<div class="store-item-title"><a href="">2 Lorem Ipsum Dolor Sit Amet Lorem Ipsum Dolor Sit Amet</a></div>
								<a class="btn-sm" href="">Buy Now!</a>
							</li>
							<li>
								<div class="store-item-img">
									<a href=""><img src="/wp-content/themes/imo-mags-parent/images/temp/gun-dog.jpg" /></a>
								</div>
								<div class="store-item-title"><a href="">3 Lorem Ipsum Dolor Sit Amet</a></div>
								<a class="btn-sm" href="">Buy Now!</a>
							</li>
							<li>
								<div class="store-item-img">
									<img src="/wp-content/themes/imo-mags-parent/images/temp/mike-bear1.jpg" />
								</div>
								<div class="store-item-title"><a href="">4 Lorem Ipsum Dolor Sit Amet Lorem Ipsum Dolor Sit Amet</a></div>
								<a class="btn-sm" href="">Buy Now!</a>
							</li>
							<li>
								<div class="store-item-img">
									<a href=""><img src="/wp-content/themes/imo-mags-parent/images/temp/gun-dog.jpg" /></a>
								</div>
								<div class="store-item-title"><a href="">5 Lorem Ipsum Dolor Sit Amet</a></div>
								<a class="btn-sm" href="">Buy Now!</a>
							</li>
							<li>
								<div class="store-item-img">
									<img src="/wp-content/themes/imo-mags-parent/images/temp/gun-dog-dvd.jpg" />
								</div>
								<div class="store-item-title"><a href="">6 Lorem Ipsum Dolor Sit Amet Lorem Ipsum Dolor Sit Amet</a></div>
								<a class="btn-sm" href="">Buy Now!</a>
							</li>
							<li>
								<div class="store-item-img">
									<a href=""><img src="/wp-content/themes/imo-mags-parent/images/temp/gun-dog.jpg" /></a>
								</div>
								<div class="store-item-title"><a href="">7 Lorem Ipsum Dolor Sit Amet</a></div>
								<a class="btn-sm" href="">Buy Now!</a>
							</li>
							<li>
								<div class="store-item-img">
									<img src="/wp-content/themes/imo-mags-parent/images/temp/gun-dog-dvd.jpg" />
								</div>
								<div class="store-item-title"><a href="">8 Lorem Ipsum Dolor Sit Amet Lorem Ipsum Dolor Sit Amet</a></div>
								<a class="btn-sm" href="">Buy Now!</a>
							</li>
							<li>
								<div class="store-item-img">
									<a href=""><img src="/wp-content/themes/imo-mags-parent/images/temp/gun-dog.jpg" /></a>
								</div>
								<div class="store-item-title"><a href="">9 Lorem Ipsum Dolor Sit Amet</a></div>
								<a class="btn-sm" href="">Buy Now!</a>
							</li>
							<li>
								<div class="store-item-img">
									<img src="/wp-content/themes/imo-mags-parent/images/temp/gun-dog-dvd.jpg" />
								</div>
								<div class="store-item-title"><a href="">10 Lorem Ipsum Dolor Sit Amet Lorem Ipsum Dolor Sit Amet</a></div>
								<a class="btn-sm" href="">Buy Now!</a>
							</li>
						</ul>
					</div>
				</div>	
			</div>
		</div>
	</section>
	<section class="section-twins">
		<div class="section-inner-wrap clearfix">
			<div class="twins-title">
				<h1>Breeds</h1>
				<a class="link-to-all" href="">More Breeds</a>
			</div>
			<div class="twins-thumbs clearfix">
				<ul>
					<?php	
						$args = array ('category_name' => 'breeds','posts_per_page' => 2,'order' => 'DESC');
						$query = new WP_Query( $args );
						if ( $query->have_posts() ) {
							while ( $query->have_posts() ) {
								$query->the_post();
								$thumb 	= get_the_post_thumbnail($post->ID,"list-thumb");	
						?>
						<li class="twins-item" featured_id="<?php echo $feature->ID ?>">
							<div class="twins-img"><a href="<?php the_permalink(); ?>" onclick="<?php echo $tracking; ?>"><?php echo $thumb; ?></a></div>
							<div class="twins-thumb-title">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							</div>
						</li>
						<?php
							}
						} else {
							echo "no posts found";
						}
						wp_reset_postdata(); 
					?>
				</ul>
			</div>
		</div>
	</section>
	<section class="section-twins">
		<div class="section-inner-wrap clearfix">
			<div class="twins-title">
				<h1>Reader Photos</h1>
				<a class="btn-lg" href="">Upload Your Photo!</a>
				<a class="link-to-all" href="">See All Reader Photos</a>
			</div>
			<div class="twins-thumbs clearfix">
				<ul>
					<?php	
						$string = parse_url($_SERVER[REQUEST_URI]);
						$term = $string["query"];
						$args = array(
						   'post_type' 		=> 'reader_photos',
						   'posts_per_page' => 2,
						   'order' 			=> 'DESC'
						);
						$query = new WP_Query( $args );
						if ( $query->have_posts() ) {
							while ( $query->have_posts() ) {
								$query->the_post();
								$thumb = get_the_post_thumbnail($post->ID,"list-thumb");	
						?>
						<li class="twins-item" featured_id="<?php echo $feature->ID ?>">
							<div class="twins-img"><a href="<?php the_permalink(); ?>" onclick="<?php echo $tracking; ?>"><?php echo $thumb; ?></a></div>
							<div class="twins-thumb-title">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							</div>
						</li>
						<?php
							}
						} else {
							echo "no posts found";
						}
						wp_reset_postdata(); 
					?>
				</ul>
			</div>
		</div>
	</section>
	<section class="section-exp-cats">
		<div class="section-inner-wrap">
			<h1>Explore <?php echo $site_name;?></h1>
			<ul class="ec-list">
			<?php 			
			$explore_cats 	= get_field('explore_cats','options' );
			$card_count		= 0;
			
			foreach ($explore_cats as $c) {
				$cat_name 	= get_cat_name($c);
				$cat_url	= get_category_link($c);
				$card_out 	= "<li><h2><a href='$cat_url'>$cat_name</a></h2>";
				$args = array(
					'cat'	=> $c,
					'posts_per_page' => 1,
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						$thumb 	= get_the_post_thumbnail($post->ID,"list-thumb");
						$permalink	= get_permalink();
						$get_title	= get_the_title();
						
						$card_out .= "<a href='$permalink'>$thumb</a>";
						$card_out .=	"<h3><a href='$permalink'>$get_title</a></h3>";	
					}
				} else {
					echo "no posts found";
				}
				wp_reset_postdata();
				$card_out .= "<a class='ec-link' href='$cat_url'>More $cat_name</a></li>";
				
				echo $card_out;
				
				if ($card_count == 4) {echo '<li class="ec-ad ad-wrap"><span class="ad-span">Advertisement</span><div id="ec_ad_inner" class="ad-inner"></div></li>';}
				
				$card_count++;
			}
			?>
			</ul>	
		</div>
	</section>

	
	
<?php	
	
	
	$response = ob_get_contents();
	ob_end_clean();
	
	echo $response;
	wp_die();
}

