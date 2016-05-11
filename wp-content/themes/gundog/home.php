<?php
// $dataPos = 0;


/*
$playerID = get_option('home_player_id', false);
$playerKey = get_option('home_player_Key', false);
$camp = get_option('home_player_camp', false);
$videoTitle = get_option('video_title', false);
*/


get_header('redesign'); 
$is_homy 		= true;
$dartdomain 	= get_option('dart_domain', false);
$magazine_img 	= get_option('magazine_cover_uri' );
$deal_copy 		= get_option('deal_copy' );
$features 		= get_field('homepage_featured_stories','options' );
$site_name		= trim(get_bloginfo('name'), "Magazine");
?>


<div class="home-wrap">
	<section class="latest-area">
		<h1>Latest News & Features</h1>
		<div id="l_container" class="l-container">
			<?php 
				if( $features ){ 
					$features_ids = array();
					$feat_counter = 0;
			?>
                <ul id="latest_list" class="l-list">
					<?php 
					foreach( $features as $feature ){
						$features_ids[] = $feature->ID;
						$title 			= $feature->post_title;  if ($feature->promo_title) { $title = $feature->promo_title;}
						$url 			= $feature->guid;
						$author 		= get_the_author();
						$acf_byline 	= get_field("byline", $feature->ID);
						$thumb 			= get_the_post_thumbnail($feature->ID,"list-thumb");
						$tracking 		= "_gaq.push(['_trackEvent','Special Features Homepage','$title','$url']);"; ?>
						
						<li class="featured-item" featured_id="<?php echo $feature->ID ?>">
							<div class="l-img"><a href="<?php echo $url; ?>" onclick="<?php echo $tracking; ?>"><?php echo $thumb; ?></a></div>
							<div class="l-info">
								<div class="l-cats"><?php if (function_exists('primary_and_secondary_categories')){ echo primary_and_secondary_categories(null, ','); } ?></div>
								<div class="l-title">
									<h3><a href="<?php echo $url; ?>" onclick="<?php echo $tracking; ?>"><?php echo $title; ?></a></h3>
								</div>
								<div class="l-author"><?php if (!$acf_byline) { if ($author != 'admin') echo 'by '. $author;} else {echo $acf_byline;} ?></div>
							</div>
						</li>
						
					<?php 
						if ($feat_counter == 1) { echo "<li id='l_ad_wrap' class='l-ad-wrap'><div class='l-ad'><span>Advertisment</span><div class='l-ad-inner'></div></div></li>"; }
						$feat_counter++;
					} 
						
						
					?>
               	</ul>
			<?php } ?>
			<div id="btn_more_home" class="btn-lg"  data-post-not="<?php echo implode(", ", $features_ids); ?>" data-cat="">
				<span>Show More</span>
				<div class="loader-anim dnone">
					<div class="line-spin-fade-loader">
						<div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div>
					</div>
				</div>
			</div><!-- .btn-lg -->
		</div><!-- .l-container -->
	</section>
	<section class="home-subscribe clearfix">
		<div class="home-subs-wrap">
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
	<section class="home-feat-cat clearfix">
		
		
	</section>
</div>





<div class="featured-area"></div>
<?php get_footer('redesign'); ?>