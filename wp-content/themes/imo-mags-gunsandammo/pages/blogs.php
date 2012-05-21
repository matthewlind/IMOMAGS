<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();
global $post;

// Test if this is a blog homepage (a child of Blogs landing page)
$blog = $post->post_parent == get_id_by_slug('blogs') ? "blog" : null;

the_post();
$current_category = single_cat_title("", false);

$soga_slug = "sons-of-guns-and-ammo";
$floc_slug = "for-the-love-of-competition";
$dt_slug = "defend-thyself";
$nb_slug = "news-brief";
$zn_slug = "zombie-nation";
$fthb_slug = "history-books";

$sg_img = get_option("sons_header_uri", get_stylesheet_directory_uri(). "/img/blogs/sonsofguns.png" );
if (empty($sg_img)) {
    $sg_img = get_stylesheet_directory_uri(). "/img/blogs/sonsofguns.png";
}
$dts_img = get_option("defend_header_uri", get_stylesheet_directory_uri(). "/img/blogs/defend-thyself.jpg" );
if (empty($dts_img)) {
    $dts_img = get_stylesheet_directory_uri(). "/img/blogs/defend-thyself.jpg";
}
$nb_img = get_option("news_header_uri", get_stylesheet_directory_uri(). "/img/blogs/news-brief.jpg" );
if (empty($nb_img)) {
    $nb_img = get_stylesheet_directory_uri(). "/img/blogs/news-brief.jpg";
}
$hb_img = get_option("history_header_uri", get_stylesheet_directory_uri(). "/img/blogs/history-books.jpg" );
if (empty($hb_img)) {
    $hb_img = get_stylesheet_directory_uri(). "/img/blogs/history-books.jpg";
}
$lc_img = get_option("competition_header_uri", get_stylesheet_directory_uri(). "/img/blogs/love-competition.jpg" );
if (empty($lc_img)) {
    $lc_img = get_stylesheet_directory_uri(). "/img/blogs/love-competition.jpg";
}
$zn_img = get_option("zombie_header_uri", get_stylesheet_directory_uri(). "/img/blogs/zombie-nation.jpg" );
if (empty($zn_img)) {
    $zn_img = get_stylesheet_directory_uri(). "/img/blogs/zombie-nation.jpg";
}


?>
<div id="carrington-modules" class="col-abc blogs">
	<div <?php post_class('entry entry-full'); ?>>
		<div class="entry-content">
			<h1 class="seo-h1"><?php single_cat_title('');?></h1>
	
			<div id="cfct-build-2114" class="cfct-build grid hideoverflow">
				<div class="row-c4-1234 row cfct-row-abc cfct-row cfct-inrow-callout">
					<div class="cfct-row-inner">
						<div class="c4-1234 cfct-block-abc cfct-block block-0">
						
							<!-- BLOG Sons -->
							<div class="cfct-module cfct-callout">
								<a class="blog-header" href="/blogs/sons-of-gunsandammo/"><img src="<?php print $sg_img; ?>"></a>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="row-c6-1234-56 row cfct-row-ab-c cfct-row cfct-inrow-loop">
				<div class="cfct-row-inner">
					<div class="c6-1234 cfct-block-ab cfct-block block-0">
						<div class="cfct-module cfct-module-loop">
							<div class="cfct-mod-content">
	
								<?php
								$args = array(
								'post_type' => 'post',
								'category_name' => $soga_slug,
								'post_status'  => 'publish',
								'posts_per_page' => 1,
								'orderby' => 'post_date',
								'order' => 'DESC'
								);
								$query = new WP_Query( $args );
				
								while ( $query->have_posts() ) : $query->the_post(); ?>
								<article class="post type-post status-publish format-standard hentryentry entry-excerpt has-img home-trending">
									<?php if(has_post_thumbnail()){ ?>
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(190,120), array('class' => 'entry-img')); ?></a>
									<?php } ?>
									<div class="entry-summary">
	  									<span class="entry-category">
	    									<span style="color:#CE181E;"><?php the_time('F jS, Y') ?></span>
	    								</span>
	    								<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
										<p><?php the_excerpt(); ?></p>
									</div>
  
  									<a class="comment-count" href="http://www.gunsandammo.fox/2012/04/12/introducing-the-smith-wesson-mp-shield/#comments"><?php echo get_comments_number(); ?></a>

								</article>

								<?php endwhile;
								// Reset Post Data
								wp_reset_postdata(); ?>
							</div>
						</div>
					</div>
					
					<div class="c6-56 cfct-block-c cfct-block block-1">
						<div class="cfct-module cfct-module-loop">
							<div class="cfct-mod-content">
	
								<ul class="cfct-module-loop">	
									<?php
									$args = array(
									'post_type' => 'post',
									'category_name' => $soga_slug,
									'post_status'  => 'publish',
									'posts_per_page' => 3,
									'offset' => 1,
									'orderby' => 'post_date',
									'order' => 'DESC'
									);
									$query = new WP_Query( $args );
								
									while ( $query->have_posts() ) : $query->the_post(); ?>		
										<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
									<?php endwhile;

									// Reset Post Data
									wp_reset_postdata(); ?>
								</ul><!-- /cfct-module-loop --></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-c4-1234 row cfct-row-abc cfct-row cfct-inrow-html cfct-inrow-callout">
				<div class="cfct-row-inner">
					<div class="c4-1234 cfct-block-abc cfct-block block-0">
						<div class="cfct-module cfct-html">
							<div class="cfct-mod-content"><a href="/blogs/sons-of-gunsandammo" class="cta">Visit the Sons of Guns & Ammo Blog<span></span></a>
							</div>
						</div>
			<div id="cfct-build-2114" class="cfct-build grid hideoverflow">
				<div class="row-c4-1234 row cfct-row-abc cfct-row cfct-inrow-callout">
					<div class="cfct-row-inner">
						<div class="c4-1234 cfct-block-abc cfct-block block-0">			
						<!-- BLOG Zombie -->
							<div class="cfct-module cfct-callout">
								<a class="blog-header" href="/blogs/<?php echo $zn_slug; ?>/"><img src="<?php print $zn_img; ?>"></a>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="row-c6-1234-56 row cfct-row-ab-c cfct-row cfct-inrow-loop">
				<div class="cfct-row-inner">
					<div class="c6-1234 cfct-block-ab cfct-block block-0">
						<div class="cfct-module cfct-module-loop">
							<div class="cfct-mod-content">
	
								<?php
								$args = array(
								'post_type' => 'post',
								'category_name' => $zn_slug,
								'post_status'  => 'publish',
								'posts_per_page' => 1,
								'orderby' => 'post_date',
								'order' => 'DESC'
								);
								$query = new WP_Query( $args );
				
								while ( $query->have_posts() ) : $query->the_post(); ?>
								<article class="post type-post status-publish format-standard hentryentry entry-excerpt has-img home-trending">
									<?php if(has_post_thumbnail()){ ?>
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(190,120), array('class' => 'entry-img')); ?></a>
									<?php } ?>
									<div class="entry-summary">
	  									<span class="entry-category">
	    									<span style="color:#CE181E;"><?php the_time('F jS, Y') ?></span>
	    								</span>
	    								<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
										<p><?php the_excerpt(); ?></p>
									</div>
  
  									<a class="comment-count" href="http://www.gunsandammo.fox/2012/04/12/introducing-the-smith-wesson-mp-shield/#comments"><?php echo get_comments_number(); ?></a>

								</article>

								<?php endwhile;
								// Reset Post Data
								wp_reset_postdata(); ?>
							</div>
						</div>
					</div>
					
					<div class="c6-56 cfct-block-c cfct-block block-1">
						<div class="cfct-module cfct-module-loop">
							<div class="cfct-mod-content">
	
								<ul class="cfct-module-loop">	
									<?php
									$args = array(
									'post_type' => 'post',
									'category_name' => $zn_slug,
									'post_status'  => 'publish',
									'posts_per_page' => 3,
									'offset' => 1,
									'orderby' => 'post_date',
									'order' => 'DESC'
									);
									$query = new WP_Query( $args );
								
									while ( $query->have_posts() ) : $query->the_post(); ?>		
										<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
									<?php endwhile;

									// Reset Post Data
									wp_reset_postdata(); ?>
								</ul><!-- /cfct-module-loop --></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-c4-1234 row cfct-row-abc cfct-row cfct-inrow-html cfct-inrow-callout">
				<div class="cfct-row-inner">
					<div class="c4-1234 cfct-block-abc cfct-block block-0">
						<div class="cfct-module cfct-html">
							<div class="cfct-mod-content"><a href="/blogs/<?php echo $zn_slug ?>" class="cta">Visit the Zombie Nation Blog<span></span></a>
							</div>
						</div>
			<div id="cfct-build-2114" class="cfct-build grid hideoverflow">
				<div class="row-c4-1234 row cfct-row-abc cfct-row cfct-inrow-callout">
					<div class="cfct-row-inner">
						<div class="c4-1234 cfct-block-abc cfct-block block-0">			
						<!-- BLOG Defend -->
							<div class="cfct-module cfct-callout">
								<a class="blog-header" href="/blogs/<?php echo $dt_slug; ?>/"><img src="<?php print $dts_img; ?>"></a>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="row-c6-1234-56 row cfct-row-ab-c cfct-row cfct-inrow-loop">
				<div class="cfct-row-inner">
					<div class="c6-1234 cfct-block-ab cfct-block block-0">
						<div class="cfct-module cfct-module-loop">
							<div class="cfct-mod-content">
	
								<?php
								$args = array(
								'post_type' => 'post',
								'category_name' => $dt_slug,
								'post_status'  => 'publish',
								'posts_per_page' => 1,
								'orderby' => 'post_date',
								'order' => 'DESC'
								);
								$query = new WP_Query( $args );
				
								while ( $query->have_posts() ) : $query->the_post(); ?>
								<article class="post type-post status-publish format-standard hentryentry entry-excerpt has-img home-trending">
									<?php if(has_post_thumbnail()){ ?>
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(190,120), array('class' => 'entry-img')); ?></a>
									<?php } ?>
									<div class="entry-summary">
	  									<span class="entry-category">
	    									<span style="color:#CE181E;"><?php the_time('F jS, Y') ?></span>
	    								</span>
	    								<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
										<p><?php the_excerpt(); ?></p>
									</div>
  
  									<a class="comment-count" href="http://www.gunsandammo.fox/2012/04/12/introducing-the-smith-wesson-mp-shield/#comments"><?php echo get_comments_number(); ?></a>

								</article>

								<?php endwhile;
								// Reset Post Data
								wp_reset_postdata(); ?>
							</div>
						</div>
					</div>
					
					<div class="c6-56 cfct-block-c cfct-block block-1">
						<div class="cfct-module cfct-module-loop">
							<div class="cfct-mod-content">
	
								<ul class="cfct-module-loop">	
									<?php
									$args = array(
									'post_type' => 'post',
									'category_name' => $dt_slug,
									'post_status'  => 'publish',
									'posts_per_page' => 3,
									'offset' => 1,
									'orderby' => 'post_date',
									'order' => 'DESC'
									);
									$query = new WP_Query( $args );
								
									while ( $query->have_posts() ) : $query->the_post(); ?>		
										<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
									<?php endwhile;

									// Reset Post Data
									wp_reset_postdata(); ?>
								</ul><!-- /cfct-module-loop --></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-c4-1234 row cfct-row-abc cfct-row cfct-inrow-html cfct-inrow-callout">
				<div class="cfct-row-inner">
					<div class="c4-1234 cfct-block-abc cfct-block block-0">
						<div class="cfct-module cfct-html">
							<div class="cfct-mod-content"><a href="/blogs/<?php echo $dt_slug ?>" class="cta">Visit the Defend Thyself Blog<span></span></a>
							</div>
						</div>
			<div id="cfct-build-2114" class="cfct-build grid hideoverflow">
				<div class="row-c4-1234 row cfct-row-abc cfct-row cfct-inrow-callout">
					<div class="cfct-row-inner">
						<div class="c4-1234 cfct-block-abc cfct-block block-0">
						<!-- BLOG History -->
							<div class="cfct-module cfct-callout">
								<a class="blog-header" href="/blogs/<?php echo $fthb_slug; ?>/"><img src="<?php print $hb_img; ?>"></a>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="row-c6-1234-56 row cfct-row-ab-c cfct-row cfct-inrow-loop">
				<div class="cfct-row-inner">
					<div class="c6-1234 cfct-block-ab cfct-block block-0">
						<div class="cfct-module cfct-module-loop">
							<div class="cfct-mod-content">
	
								<?php
								$args = array(
								'post_type' => 'post',
								'category_name' => $fthb_slug,
								'post_status'  => 'publish',
								'posts_per_page' => 1,
								'orderby' => 'post_date',
								'order' => 'DESC'
								);
								$query = new WP_Query( $args );
				
								while ( $query->have_posts() ) : $query->the_post(); ?>
								<article class="post type-post status-publish format-standard hentryentry entry-excerpt has-img home-trending">
									<?php if(has_post_thumbnail()){ ?>
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(190,120), array('class' => 'entry-img')); ?></a>
									<?php } ?>
									<div class="entry-summary">
	  									<span class="entry-category">
	    									<span style="color:#CE181E;"><?php the_time('F jS, Y') ?></span>
	    								</span>
	    								<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
										<p><?php the_excerpt(); ?></p>
									</div>
  
  									<a class="comment-count" href="http://www.gunsandammo.fox/2012/04/12/introducing-the-smith-wesson-mp-shield/#comments"><?php echo get_comments_number(); ?></a>

								</article>

								<?php endwhile;
								// Reset Post Data
								wp_reset_postdata(); ?>
							</div>
						</div>
					</div>
					
					<div class="c6-56 cfct-block-c cfct-block block-1">
						<div class="cfct-module cfct-module-loop">
							<div class="cfct-mod-content">
	
								<ul class="cfct-module-loop">	
									<?php
									$args = array(
									'post_type' => 'post',
									'category_name' => $fthb_slug,
									'post_status'  => 'publish',
									'posts_per_page' => 3,
									'offset' => 1,
									'orderby' => 'post_date',
									'order' => 'DESC'
									);
									$query = new WP_Query( $args );
								
									while ( $query->have_posts() ) : $query->the_post(); ?>		
										<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
									<?php endwhile;

									// Reset Post Data
									wp_reset_postdata(); ?>
								</ul><!-- /cfct-module-loop --></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-c4-1234 row cfct-row-abc cfct-row cfct-inrow-html cfct-inrow-callout">
				<div class="cfct-row-inner">
					<div class="c4-1234 cfct-block-abc cfct-block block-0">
						<div class="cfct-module cfct-html">
							<div class="cfct-mod-content"><a href="/blogs/<?php echo $fthb_slug ?>" class="cta">Visit the From History Blog<span></span></a>
							</div>
						</div>
			<div id="cfct-build-2114" class="cfct-build grid hideoverflow">
				<div class="row-c4-1234 row cfct-row-abc cfct-row cfct-inrow-callout">
					<div class="cfct-row-inner">
						<div class="c4-1234 cfct-block-abc cfct-block block-0">			
						<!-- BLOG Competition -->
							<div class="cfct-module cfct-callout">
								<a class="blog-header" href="/blogs/<?php echo $floc_slug; ?>/"><img src="<?php print $lc_img; ?>"></a>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="row-c6-1234-56 row cfct-row-ab-c cfct-row cfct-inrow-loop">
				<div class="cfct-row-inner">
					<div class="c6-1234 cfct-block-ab cfct-block block-0">
						<div class="cfct-module cfct-module-loop">
							<div class="cfct-mod-content">
	
								<?php
								$args = array(
								'post_type' => 'post',
								'category_name' => $floc_slug,
								'post_status'  => 'publish',
								'posts_per_page' => 1,
								'orderby' => 'post_date',
								'order' => 'DESC'
								);
								$query = new WP_Query( $args );
				
								while ( $query->have_posts() ) : $query->the_post(); ?>
								<article class="post type-post status-publish format-standard hentryentry entry-excerpt has-img home-trending">
									<?php if(has_post_thumbnail()){ ?>
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(190,120), array('class' => 'entry-img')); ?></a>
									<?php } ?>
									<div class="entry-summary">
	  									<span class="entry-category">
	    									<span style="color:#CE181E;"><?php the_time('F jS, Y') ?></span>
	    								</span>
	    								<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
										<p><?php the_excerpt(); ?></p>
									</div>
  
  									<a class="comment-count" href="http://www.gunsandammo.fox/2012/04/12/introducing-the-smith-wesson-mp-shield/#comments"><?php echo get_comments_number(); ?></a>

								</article>

								<?php endwhile;
								// Reset Post Data
								wp_reset_postdata(); ?>
							</div>
						</div>
					</div>
					
					<div class="c6-56 cfct-block-c cfct-block block-1">
						<div class="cfct-module cfct-module-loop">
							<div class="cfct-mod-content">
	
								<ul class="cfct-module-loop">	
									<?php
									$args = array(
									'post_type' => 'post',
									'category_name' => $floc_slug,
									'post_status'  => 'publish',
									'posts_per_page' => 3,
									'offset' => 1,
									'orderby' => 'post_date',
									'order' => 'DESC'
									);
									$query = new WP_Query( $args );
								
									while ( $query->have_posts() ) : $query->the_post(); ?>		
										<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
									<?php endwhile;

									// Reset Post Data
									wp_reset_postdata(); ?>
								</ul><!-- /cfct-module-loop --></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-c4-1234 row cfct-row-abc cfct-row cfct-inrow-html cfct-inrow-callout">
				<div class="cfct-row-inner">
					<div class="c4-1234 cfct-block-abc cfct-block block-0">
						<div class="cfct-module cfct-html">
							<div class="cfct-mod-content"><a href="/blogs/<?php echo $floc_slug ?>" class="cta">Visit the For the Love of Competition Blog<span></span></a>
							</div>
						</div>
						
						<!-- BLOG News -->
							<div class="cfct-module cfct-callout">
								<a class="blog-header" href="/blogs/<?php echo $nb_slug; ?>/"><img src="<?php print $nb_img; ?>"></a>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="row-c6-1234-56 row cfct-row-ab-c cfct-row cfct-inrow-loop">
				<div class="cfct-row-inner">
					<div class="c6-1234 cfct-block-ab cfct-block block-0">
						<div class="cfct-module cfct-module-loop">
							<div class="cfct-mod-content">
	
								<?php
								$args = array(
								'post_type' => 'post',
								'category_name' => $nb_slug,
								'post_status'  => 'publish',
								'posts_per_page' => 1,
								'orderby' => 'post_date',
								'order' => 'DESC'
								);
								$query = new WP_Query( $args );
				
								while ( $query->have_posts() ) : $query->the_post(); ?>
								<article class="post type-post status-publish format-standard hentryentry entry-excerpt has-img home-trending">
									<?php if(has_post_thumbnail()){ ?>
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(190,120), array('class' => 'entry-img')); ?></a>
									<?php } ?>
									<div class="entry-summary">
	  									<span class="entry-category">
	    									<span style="color:#CE181E;"><?php the_time('F jS, Y') ?></span>
	    								</span>
	    								<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
										<p><?php the_excerpt(); ?></p>
									</div>
  
  									<a class="comment-count" href="http://www.gunsandammo.fox/2012/04/12/introducing-the-smith-wesson-mp-shield/#comments"><?php echo get_comments_number(); ?></a>

								</article>

								<?php endwhile;
								// Reset Post Data
								wp_reset_postdata(); ?>
							</div>
						</div>
					</div>
					
					<div class="c6-56 cfct-block-c cfct-block block-1">
						<div class="cfct-module cfct-module-loop">
							<div class="cfct-mod-content">
	
								<ul class="cfct-module-loop">	
									<?php
									$args = array(
									'post_type' => 'post',
									'category_name' => $nb_slug,
									'post_status'  => 'publish',
									'posts_per_page' => 3,
									'offset' => 1,
									'orderby' => 'post_date',
									'order' => 'DESC'
									);
									$query = new WP_Query( $args );
								
									while ( $query->have_posts() ) : $query->the_post(); ?>		
										<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
									<?php endwhile;

									// Reset Post Data
									wp_reset_postdata(); ?>
								</ul><!-- /cfct-module-loop --></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-c4-1234 row cfct-row-abc cfct-row cfct-inrow-html cfct-inrow-callout">
				<div class="cfct-row-inner">
					<div class="c4-1234 cfct-block-abc cfct-block block-0">
						<div class="cfct-module cfct-html">
							<div class="cfct-mod-content"><a href="/blogs/<?php echo $nb_slug ?>" class="cta">Visit the News Brief Blog<span></span></a>
							</div>
						</div>
	

						<div style="height:20px;"></div>
					</div>
				</div>
			</div>
		</div>
	
		<?php edit_post_link(__('Edit', 'carrington-business')); ?>
	</div>
</div>


<?php get_footer(); ?>