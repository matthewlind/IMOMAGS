<?php
// $dataPos = 0;


/*
$playerID = get_option('home_player_id', false);
$playerKey = get_option('home_player_Key', false);
$camp = get_option('home_player_camp', false);
$videoTitle = get_option('video_title', false);
*/


get_header('redesign'); 


$is_home_cat 	= true;
$dartdomain 	= get_option('dart_domain', false);
$magazine_img 	= get_option('magazine_cover_uri' );
$deal_copy 		= get_option('deal_copy' );
$features 		= get_field('homepage_featured_stories','options' );
$site_name		= trim(get_bloginfo('name'), "Magazine");

$this_cat 		= get_category( get_query_var( 'cat' ) );
$this_cat_id	= $this_cat->term_id;
$this_cat_name	= $this_cat->name;

?>


<div class="home-wrap">
	<section class="section-latest-posts">
		<div id="l_container" class="section-inner-wrap">
			<h1 class="main-h"><?php echo $this_cat_name;?></h1>
			<ul id="latest_list" class="c-list">
			<?php 	
				$p_counter = 0;		
				$args = array(
					'cat'	=> $this_cat_id,
					'posts_per_page' => 5,
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						$thumb 			= get_the_post_thumbnail($post->ID,"list-thumb");
						$author 		= get_the_author();
						$acf_byline 	= get_field("byline", $post->ID);
						?>
						<li class="c-item">
							<a href="<?php the_permalink(); ?>"><?php echo $thumb; ?></a>
							<div class="c-info">
								<div class="c-cats"><?php if (function_exists('primary_and_secondary_categories')){ echo primary_and_secondary_categories(null, ','); } ?></div>
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<span class="c-author"><?php if (!$acf_byline) { if ($author != 'admin') echo 'by '. $author;} else {echo $acf_byline;} ?></span>
							</div>
						</li>
			<?php		if ($p_counter == 1) {
							echo '<li class="c-ad ad-wrap"><span class="ad-span">Advertisement</span><div id="c_ad_inner" class="ad-inner"></div></li>';
						}
						$p_counter++;
					}
				} else {
					echo "no posts found";
				}
				wp_reset_postdata();
			?>
			</ul>
			<div id="btn_more_posts" class="btn-lg"  data-post-not="" data-cat="<?php echo $this_cat_id;?>">
				<span>Show More</span>
				<div class="loader-anim dnone">
					<div class="line-spin-fade-loader">
						<div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div>
					</div>
				</div>
			</div><!-- .btn-lg -->	
		</div>
	</section>
	<section class="home-subscribe clearfix">
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
				<a href="">More Breeds</a>
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
	
	if ($card_count == 4) {echo '<li id="ec_ad"><span>Advertisment</span><div class="ec-ad-inner"></div></li>';}
	
	$card_count++;
}
?>
			</ul>	
		</div>
	</section>
</div>





<?php get_footer('redesign'); ?>