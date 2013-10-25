<?php

/**
 * Template Name: Video
 * Description: Video page
 *
 * @package favebusiness
 *
 * This file is part of the FaveBusiness Theme for WordPress
 * http://crowdfavorite.com/wordpress/themes/favebusiness/
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
<header id="masthead">
	<h1><?php the_title(); ?></h1>
	<?php edit_post_link(__('Edit', 'carrington-business')); ?>
</header><!-- #masthead -->
<div class="entry-content">
	<?php the_content(__('Continued&hellip;', 'carrington-business')); ?>
</div>
	
<div class="bonus-background">
	<div class="bonus">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-landing')) : else : ?><?php endif; ?>
	</div>
	<div id="responderfollow"></div>
	<div class="sidebar advert">
		<?php imo_dart_tag("300x250",false,array("pos"=>"btf")); ?>
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : endif; ?>
	</div>
</div>

<div class="col-abc">
	<div <?php post_class('entry entry-full clearfix'); ?>>
		<div class="entry-content">			
			<h2>More Videos</h2>
			<?php $wp_query = new WP_Query();
			$wp_query->query('&category_name=video');
			while ($wp_query->have_posts()) : $wp_query->the_post();  ?>
				<div class="post type-post status-publish format-standard hentry category-breeds entry entry-excerpt clearfix has-img">
					<div class="entry-summary">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(190,120),array('class' => 'entry.has-img entry-summary entry-img'));?></a>		
						<div class="entry-info">
							<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<?php the_date(); ?>
							<a href="<?php the_permalink(); ?>/#comments" title="<?php the_title(); ?>"><?php comments_number(); ?></a>		
						</div>
						<?php the_excerpt(); ?>			
					</div>
				</div>
	
			<?php endwhile;
			wp_link_pages();
			?>
		</div>
	</div><!-- .entry -->
	<?php //comments_template(); ?>
</div><!-- .col-abc -->
<?php get_footer(); ?>