<?php

/**
 * @package carrington-business
 *
 * This file is part of the Carrington Business Theme for WordPress
 * http://crowdfavorite.com/wordpress/themes/carrington-business/
 *
 * Copyright (c) 2008-2011 Crowd Favorite, Ltd. All rights reserved.
 * http://crowdfavorite.com
 *
 * **********************************************************************
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
 * **********************************************************************
 */

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();

the_post();
?>
<div class="page-template-page-trophy-php page-template-page slider-height">
	<header class="header-title">
		<h1><?php the_title(); ?></h1>
		
		<div class="naw-ad"></div>
	</header>	
	<div class="bonus-background">
		<div class="sidebar">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-default')) : else : ?><?php endif; ?>
		</div>
	</div>
	<div class="col-abc">
		<?php the_content(__('Continued&hellip;', 'carrington-business')); ?>
		<div class="header-sort">
			<h1 class="more-header">More Trophy Bucks</h1>
			<div class='cssmenu'>
				<ul>
				   <li><a href='#' class="dd"><span>Sort</span><span class="dd-arrow"></span></a>
				      <ul>
				         <li><a href='#'><span>Category 1</span></a></li>
				         <li><a href='#'><span>Category 2</span></a></li>
				      </ul>
				   </li>
				</ul>
			</div>
		</div>
			<?php
							$args = array(
							'post_type' => 'post',
							'post_status' => 'publish',
							'category_name' => 'trophy-bucks',
							'orderby' => 'date',
							'order' => 'DESC',
							'posts_per_page' => 10,
							);
							// The Query
							$the_query = new WP_Query( $args );
			
							// The Loop
							while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				
							<article id="post-excerpt-<?php the_ID(); ?>" <?php post_class('entry entry-excerpt') ?>>
								<?php if (has_post_thumbnail()) : ?>
								<a<?php if( get_post_type() == 'imo_video' || in_category('video') ){echo ' class="video-excerpt"';} ?> href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-thumbnail', array('class' => 'entry-img')); if( get_post_type() == 'imo_video' || in_category('video') ){echo '<span></span>';} ?></a>
			
								<?php endif; ?>
								<div class="entry-summary">
				  					<span class="entry-category"><?php the_category(' &middot; '); ?></span>
									<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
									<span class="author vcard"><?php the_time(get_option('date_format')); ?> <span class="fn">by <?php the_author(); ?></span></span>
									<?php the_excerpt(); ?>
								</div>
			 			 		<a class="comment-count" href="<?php comments_link(); ?>"><?php echo get_comments_number(); ?></a>
							</article>
							<?php endwhile;
							next_posts_link();
							previous_posts_link();
							// Reset Post Data
							wp_reset_postdata(); 
							
							?>

		<?php edit_post_link(__('Edit', 'carrington-business')); ?>

	</div><!-- .col-abc -->
</div>
<?php get_footer(); ?>