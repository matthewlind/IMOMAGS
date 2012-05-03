<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();

the_post(); ?>

<div class="page-template-page-right-php right-sidebar-homepage">
	<div id="sidebar">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('homepage-sidebar')) : else : ?><?php endif; ?>
	</div>
	<div id="content">
		<div <?php post_class('entry entry-full'); ?>>
			<div class="entry-content">
				<?php
				the_content(__('Continued&hellip;', 'carrington-business')); ?>
	
	
	<!-- advertisement (edit widget area: homepage trending ad) -->
	<div class="row-c6-12-3456 row cfct-row-a-bc cfct-row cfct-inrow-widget-advert-widget cfct-inrow-heading cfct-inrow-not-loop">
		<div class="c6-12 cfct-block-a cfct-block block-0">
			<div class="cfct-module cfct-widget-module-advert-widget">
				<div class="cfct-mod-content">
					<div class="widget widget_advert-widget">
						<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-ad')) : else : ?><?php endif; ?>
					</div>
				</div>
			</div>
		</div>
			
		<div class="c6-3456 cfct-block-bc cfct-block block-1">
			<div class="cfct-module cfct-heading">
				<h4 class="cfct-mod-title">Most Commented</h4>
			</div>
		<!-- trending articles -->
		<div class="cfct-module not-loop trending">
			<div class="cfct-mod-content">
				<?php
				//$week = date('W');
				//$year = date('Y');
		
				$args = array(
					'post_type' => 'post',
					'post_status'  => 'publish',
					'posts_per_page' => 4,
					'orderby' => 'comment_count',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
				<article class="post type-post status-publish format-standard hentry category-news-brief entry entry-excerpt has-img home-trending">
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

				?>
			
				</div>
			</div>
		</div>
	</div>
</div>
	<?php wp_link_pages(); ?>
			</div>
		</div>
	</div>
	<div id="secondary">
	 	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('homepage-secondary')) : else : ?><?php endif; ?>
	</div>
</div>
<?php get_footer(); ?>