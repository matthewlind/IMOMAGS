<?php
// $dataPos = 0;


/*
$playerID = get_option('home_player_id', false);
$playerKey = get_option('home_player_Key', false);
$camp = get_option('home_player_camp', false);
$videoTitle = get_option('video_title', false);
*/


get_header('redesign'); 
$is_homy 	= true;
$dartdomain = get_option('dart_domain', false);

$features 	= get_field('homepage_featured_stories','options' );
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
								<div class="l-cats"><?php if (function_exists('primary_and_secondary_categories')){ echo primary_and_secondary_categories(); } ?></div>
								<div class="l-title">
									<h3><a href="<?php echo $url; ?>" onclick="<?php echo $tracking; ?>"><?php echo $title; ?></a></h3>
								</div>
								<div class="l-author"><?php if (!$acf_byline) { if ($author != 'admin') echo 'by '. $author;} else {echo $acf_byline;} ?></div>
							</div>
						</li>
						
					<?php 
						if ($feat_counter == 1) { echo "<li class='l-ad-wrap'><div class='l-ad'><span>Advertisment</span><div class='l-ad-inner'></div></div></li>"; }
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
</div>





<div class="featured-area"></div>
<?php get_footer('redesign'); ?>