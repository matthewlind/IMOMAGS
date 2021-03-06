<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();

the_post(); 

?>

<div class="page-template-page-right-php right-sidebar-landing">
	<div id="sidebar">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('reviews-sidebar')) : else : ?><?php endif; ?>
		<div id="responderfollow"></div>
		<div class="sidebar advert">
			<?php imo_dart_tag("300x250",false,array("pos"=>"btf")); ?>
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : endif; ?>
		</div>
	</div>
	<div id="content">
		<h1 class="seo-h1">Shot Show</h1>
		<div <?php post_class('entry entry-full'); ?>>
			<div class="entry-content">
				<div class="cfct-module cfct-html section-title posts">
					<div class="cfct-mod-content">
						<h4>
 							<div class="icon"></div>
  								<span>Shot Show 2013</span>
						</h4>
					</div>
				</div>
				<?php				
				the_content(__('Continued&hellip;', 'carrington-business')); ?>
				<div style="clear:both;"></div>
				<div class="cfct-module cfct-html section-title posts">
								<div class="cfct-mod-content">
									<h4>
		 							<div class="icon"></div>
		  								<span>Most Recent</span>
		  							</h4>
								</div>
							</div>
				<div class="reviews-section">

					<div class="reviews-cover" style="display:none;"></div>
						<div class="reviews-container">
							
					<?php
						
					// Latest Reviews default
						$args = array(
							'category_name' => 'shot-show-2013',
		    				'posts_per_page' => 9999,
							'orderby' => 'date',
							'order' => 'DESC'
						);		

						
	    				$query = new WP_Query( $args );
						while ( $query->have_posts() ) : $query->the_post(); ?>
							<article class="post type-post status-publish format-standard hentry category-news-brief entry entry-excerpt has-img">
							<?php if(has_post_thumbnail()){ ?>
								<a<?php if( get_post_type() == 'imo_video' || in_category('video') ){echo ' class="video-excerpt"';} ?> class="thumbnail-link" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(190,120), array('class' => 'entry-img')); if( get_post_type() == 'imo_video' || in_category('video') ){echo '<span></span>';} ?></a>
							<?php } ?>
							<div class="entry-summary">
		  						<span class="entry-category">
		    						<span class="review-date" style="color:#CE181E;"><?php the_time('F jS, Y') ?></span>
		    					</span>
		    					<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<p class="review-excerpt"><?php the_excerpt(); ?></p>
							</div>
	  
	  						<a class="comment-count" href="<?php comments_link(); ?>"><?php echo get_comments_number(); ?></a>


							</article>		
								
						<?php endwhile;
						// Reset Post Data
						wp_reset_postdata();
				
					
					
					wp_link_pages(); ?>
					
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>