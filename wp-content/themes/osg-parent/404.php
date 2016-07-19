<?php
/**
* The template for displaying 404 pages (Not Found).
*
* @package WordPress
* @subpackage Twenty_Eleven
* @since Twenty Eleven 1.0
*/

//For some reason, 404 pages were set to not be cached be varnish. This should fix that issue.
header ("Cache-Control: max-age=20800"); // HTTP 1.1
 	
get_header('redesign'); 
$is_search = true;
$dartdomain = get_option('dart_domain', false);

?>


<div id="sections_wrap" class="sections-wrap">
	<section class="section-latest-posts">
		<div id="l_container" class="section-inner-wrap">
				<header class="main-h">
					<h1 style="text-transform: none; color: #C6262D;">Error: Page not found.</h1>
					<p>Unfortunately, We can't find the page you are looking for. <br>Here are the latest stories.</p>
				</header>
				<?php 
					$args = array ('posts_per_page'	=> 8, 'order' => 'DESC');
					$query = new WP_Query( $args );
					$feat_counter = 0;

					if ( $query->have_posts() ) { 
				?>
				
                <ul id="latest_list" class="c-list">
	                <?php 
		                while ( $query->have_posts() ) { $query->the_post(); 
			                $author 		= get_the_author();
							$acf_byline 	= get_field("byline", $post->ID);
	                ?>
							<li class="c-item">
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('list-thumb'); ?></a>
								<div class="c-info">
									<div class="c-cats"><?php if (function_exists('primary_and_secondary_categories')){ echo primary_and_secondary_categories(null, ','); } ?></div>
									<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									<span class="c-author"><?php if (!$acf_byline) { if ($author != 'admin') echo 'by '. $author;} else {echo $acf_byline;} ?></span>
								</div>
							</li>
					<?php 
							if ($feat_counter == 1) { echo '<li class="c-ad ad-wrap"><span class="ad-span">Advertisement</span><div id="c_ad_inner" class="ad-inner"><iframe class="iframe-ad" width="300" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad.php?term='.$term.'&camp='.$camp.'&ad_code='.$dartdomain.'&ad_unit=mediumRectangle&page=homepage&pos=btf"></iframe></div></li>'; }
							$feat_counter++;
						} 
					?>
				</ul>
				<div id="btn_more_posts" class="btn-lg" data-search="" data-author="">
					<span>Show More</span>
					<div class="loader-anim dnone">
						<div class="line-spin-fade-loader">
							<div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div>
						</div>
					</div>
				</div><!-- .btn-lg -->
			<?php }  else { ?>
				<h3>No Post's Found</h3>
			<?php } ?>
			
		</div><!-- .l-container -->
	</section>
</div>



<?php get_footer('redesign'); ?>