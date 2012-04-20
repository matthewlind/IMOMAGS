<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();

the_post(); ?>

<div class="page-template-page-right-php right-sidebar-landing">
	<div id="sidebar">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('homepage-sidebar')) : else : ?><?php endif; ?>
	</div>
	<div id="content">
		<div <?php post_class('entry entry-full'); ?>>
			<div class="entry-content">
				<div class="cfct-module cfct-html section-title posts">
					<div class="cfct-mod-content">
						<h4>
 							<div class="icon"></div>
  								<span>Reviews</span>
						</h4>
					</div>
				</div>
				<?php				
				the_content(__('Continued&hellip;', 'carrington-business')); ?>
				<div class="cfct-module cfct-html section-title posts">
					<div class="cfct-mod-content">
						<h4>
 							<div class="icon"></div>
  								<span>Latest Reviews</span> 
						</h4> Filter: 
						<select>
							<option>Type</option> 
						
						</select>
						<select>
							<option>Manufacturer</option> 
						
						</select>
						<select>
							<option>Caliber</option>
						
						</select>
						<input type="submit" value="Submit" />
					</div>
				</div>

				<?php
				$args = array(
					'post_type' => 'reviews',
					'posts_per_page' => 9,
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
					<article class="post type-post status-publish format-standard hentry category-news-brief entry entry-excerpt has-img">
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
				wp_reset_postdata();

				wp_link_pages(); ?>
				
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>