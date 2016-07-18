<?php
/**
* The template for displaying Search Results pages.
*
* @package WordPress
* @subpackage Twenty_Eleven
* @since Twenty Eleven 1.0
*/
 	
	get_header('redesign'); 
	$dartdomain = get_option('dart_domain', false);
	$is_search = true;
	$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
?>


<div id="sections_wrap" class="sections-wrap">
	<section class="section-latest-posts">
		<div id="l_container" class="section-inner-wrap">
				<header class="main-h">
					<h1 style="text-transform: none;"><?php printf( __( 'Search Results For: %s', 'twentyeleven' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header>
				<?php 
					$args = array ('post_type' => 'post', 'posts_per_page'	=> 8, 's' => get_search_query(), 'order' => 'DESC', 'author' => $curauth->ID);
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
               	<div id="btn_more_posts" class="btn-lg" data-search="<?php echo get_search_query(); ?>" data-author="<?php echo $curauth->ID; ?>">
					<span>Show More</span>
					<div class="loader-anim dnone">
						<div class="line-spin-fade-loader">
							<div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div>
						</div>
					</div>
				</div><!-- .btn-lg -->
			<?php }  else { ?>
				<h3>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</h3>
				
				<h3>Sorry, this author haven't written a post yet. Check out other authors below</h3>
				<ul>
				<?php wp_list_authors(array('optioncount'   => true)); ?>
				</ul>
			<?php } ?>
			
		</div><!-- .l-container -->
	</section>
</div>





























<?php get_footer('redesign'); ?>