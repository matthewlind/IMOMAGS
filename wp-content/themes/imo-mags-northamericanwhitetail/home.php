<?php

/**
 * Template Name: Home Page+
 * Description: Homepage for the new NAW+
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
?>
<div class="page-template-page-right-php">	

	<!-- Carrington Section w/ Sidebar Top -->	
	<div class="bonus-background">
		<div class="bonus">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-home-top')) : else : ?><?php endif; ?>
		</div>
	</div>
	<div class="col-abc">
				<?php the_content(__('Continued&hellip;', 'carrington-business')); ?>
	
	</div><!-- .col-abc -->		
		
	<!-- Super post section -->
<div class="col-abc super-post">
    <div <?php post_class('entry entry-full clearfix'); ?>>
        <div class="entry-content">
            <h1>Recon Network</h1>

            <span id="toggle-display-button">
                Toggle Display
            </span>
			<div class="plus"></div>
            <ul class="post-type-select">
                <li class='selected' title='all'><span></span>ALL</li>
                <li title='photo'>Photos</li>
                <li title='report'>Reports</li>
                <li title='tip'>Tips</li>
            </ul>
            <!-- This div id="recon-activity" is filled with posts by the displayRecon() function
                     inside plus.js -->    
            <div id="recon-activity">


            </div>
            <span id="more-superposts-button">
                More Recon
            </span>



        </div>
    </div><!-- .entry -->
</div><!-- .col-abc -->
	<div class="clear"></div>
	<!-- Editor's Picks w/ Sidebar Bottom -->		
	<div class="bonus-background">
		<div class="bonus">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-home-bottom')) : else : ?><?php endif; ?>
		</div>
	</div>
	
	<div class="col-abc">
		<div <?php post_class('entry entry-full clearfix'); ?>>
			<div class="entry-content">

				
				<div class="home-header-title">
					<h1>Editor's Picks</h1>
				</div>
				<?php
				$paged = get_query_var('paged') ? get_query_var('paged') : 1;
				$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'orderby' => 'date',
				'order' => 'DESC',
				'posts_per_page' => 5,
                'paged' => $paged,
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
				
			</div>
			<?php edit_post_link(__('Edit', 'carrington-business')); ?>
		</div><!-- .entry -->
	</div><!-- .col-abc -->
	<!-- Bottom Widget Area -->
	<div class="secondary">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('secondary-home')) : else : ?><?php endif; ?>
	</div>
</div>
<?php get_footer(); ?>