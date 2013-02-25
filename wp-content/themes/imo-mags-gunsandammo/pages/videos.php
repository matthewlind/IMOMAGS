<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();

the_post(); ?>

<div class="page-template-page-right-php right-sidebar-gallery">
	<div id="sidebar">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-gallery')) : else : ?><?php endif; ?>
		<div id="responderfollow"></div>
		<div class="sidebar advert">
			<?php if (function_exists("imo_dart_tag")) {
	            imo_dart_tag("300x250");
	          } else { ?>
	            <script type="text/javascript">
	              document.write(unescape('%3Cscript src="http://ad.doubleclick.net/adj/imo.'+dartadsgen_site+'/;sect=;page=index;subs=;sz=728x90;dcopt=;tile='+pr_tile+';ord='+dartadsgen_rand+'?"%3E%3C/script%3E'));
	            </script>
	            <script type="text/javascript">
	              ++pr_tile;
	            </script>
	            <noscript>
	              <a href="http://ad.doubleclick.net/adj/imo.outdoorsbest/;sect=;page=index;pos=btf;subs=;sz=300x250;dcopt=;tile=1;ord=7391727509?">
	                <img src="http://ad.doubleclick.net/ad/imo.outdoorsbest/home;sect=;page=index;pos=btf;subs=;sz=300x250;dcopt=;tile=1;ord=7391727509?" border="0" />
	              </a>
	            </noscript>
	          <?php } ?>

			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : endif; ?>
		</div>
	</div>
	<div id="content">
	<h1 class="seo-h1"><?php if(is_page('personal-defense')){
 								echo '<span>Personal Defense Videos</span>';
 							}
 							else if(is_page('video-reviews')){
 								echo '<span>Video Reviews</span>';
 							}
 							else if(is_page('tips-tactics')){
 								echo '<span>Tips & Tactics Videos</span>';
 							}
 							else{
  								echo '<span>Videos</span>';
  							} ?></h1>
		<div <?php post_class('entry entry-full'); ?>>
			<div class="entry-content">
				<div class="cfct-module cfct-html section-title posts">
					<div class="cfct-mod-content">
						<h4>
 							<div class="icon"></div>
 							<?php  
 							if(is_page('personal-defense')){
 								echo '<span>Personal Defense Videos</span>';
 							}
 							else if(is_page('video-reviews')){
 								echo '<span>Video Reviews</span>';
 							}
 							else if(is_page('tips-tactics')){
 								echo '<span>Tips & Tactics Videos</span>';
 							}
 							else{
  								echo '<span>Videos</span>';
  							}	
  								?>
						</h4>
					</div>
				</div>
			<?php
			 
 			if(is_page('personal-defense')){
 				$args = array(
					'post_type' => 'imo_video',
					'category_name' => 'personal-defense',
					'post_status'  => 'publish',
					'posts_per_page' => 99,
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
				<article class="post type-post status-publish format-standard hentry category-news-brief entry entry-excerpt has-img home-trending">
					<?php if(has_post_thumbnail()){ ?>
					<a class="video-excerpt" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(190,120), array('class' => 'entry-img')); ?><span></span></a>
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
				wp_reset_postdata();

			}
			else if(is_page('tips-tactics')){
 				$args = array(
					'post_type' => 'imo_video',
					'category_name' => 'tips-tactics',
					'post_status'  => 'publish',
					'posts_per_page' => 99,
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
				<article class="post type-post status-publish format-standard hentry category-news-brief entry entry-excerpt has-img home-trending">
					<?php if(has_post_thumbnail()){ ?>
					<a class="video-excerpt" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(190,120), array('class' => 'entry-img')); ?><span></span></a>
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
				wp_reset_postdata();

			}
			else if(is_page('video-reviews')){
 				$args = array(
					'post_type' => 'imo_video',
					'category_name' => 'video-reviews',
					'post_status'  => 'publish',
					'posts_per_page' => 99,
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
				<article class="post type-post status-publish format-standard hentry category-news-brief entry entry-excerpt has-img home-trending">
					<?php if(has_post_thumbnail()){ ?>
					<a class="video-excerpt" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(190,120), array('class' => 'entry-img')); ?><span></span></a>
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
				wp_reset_postdata();

			}else{
				the_content(__('Continued&hellip;', 'carrington-business'));
				wp_link_pages(); 
			} ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

</div>
</div>
</div>
</div>

<?php get_footer(); ?>