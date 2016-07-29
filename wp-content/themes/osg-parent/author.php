<?php
/**
* The template for displaying Author pages.
*
* @package WordPress
* @subpackage Twenty_Eleven
* @since Twenty Eleven 1.0
*/
 	
	get_header('redesign'); 
	$is_search = true;
	$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
	$dartdomain = get_option("dart_domain", $default = false);
?>


<div id="sections_wrap" class="sections-wrap">
	<section class="section-latest-posts">
		<div id="l_container" class="section-inner-wrap">
				<header class="main-h">
					<h1 style="text-transform: none;">Articles by <?php echo "<span>".$curauth->display_name."</span>"; ?></h1>
				</header>
				<?php 
					$args = array ('posts_per_page'	=> 8, 'order' => 'DESC', 'author' => $curauth->ID);
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
								</div>
							</li>
					<?php 
							if ($feat_counter == 1) { echo '<li class="c-ad ad-wrap"><span class="ad-span">Advertisement</span><div id="c_ad_inner" class="ad-inner"><iframe class="iframe-ad" width="300" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad.php?term=author&ad_code='.$dartdomain.'&ad_unit=mediumRectangle&page=homepage"></iframe></div></li>'; }
							$feat_counter++;
						} 
					?>
               	</ul>
               	<div id="btn_more_posts" class="btn-lg" data-search="" data-author="<?php echo $curauth->ID; ?>">
					<span>Show More</span>
					<div class="loader-anim dnone">
						<div class="line-spin-fade-loader">
							<div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div>
						</div>
					</div>
				</div><!-- .btn-lg -->
			<?php }  else { ?>
				<h3>Sorry, this author hasn't written anything yet. Check out other authors below.</h3>
				<ul>
				<?php wp_list_authors(array('optioncount'   => true)); ?>
				</ul>
			<?php } ?>
			
		</div><!-- .l-container -->
	</section>
</div>



<?php get_footer('redesign'); ?>