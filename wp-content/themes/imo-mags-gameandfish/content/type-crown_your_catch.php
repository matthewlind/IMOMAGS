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

?>
<div <?php post_class('entry entry-full clearfix') ?>>
	<div class="entry-header">
		<?php
		// If we're not showing this particular single post page, link the title
		$this_post_is_not_single = (!is_single(get_the_ID()));
		if ($this_post_is_not_single) { ?>
			<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title() ?></a></h2>
		<?php
		} else {
		?>
			<h1 class="entry-title"><?php the_title() ?></h1>
		<?php
		}
		?>
		<div class="entry-info">
			<div class="meta-info">
          	<abbr class="published" title="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('F j, Y'); ?></abbr>
			
			<?php
				echo ' <span class="spacer">&bull;</span> ';
				comments_popup_link(__('No comments', 'carrington-business'), __('1 comment', 'carrington-business'), __('% comments', 'carrington-business')); ?>
			</div>
				<div class="navigation">
					<div class="alignleft">
						<?php previous_post('% ','&laquo; Previous Catch', 'no'); ?>
					</div>
					<div class="alignright">
						<?php next_post(' %','Next Catch &raquo;', 'no'); ?>
					</div>
				</div> <!-- end navigation -->
		</div>
	<div style="clear:both;"></div>
	<div class="entry-content">
		
	
		<?php
		// Un-comment this if you want featured images to automatically appear on full posts
		// the_post_thumbnail('thumbnail', array('class' => 'entry-img'));
		the_content(__('Continued&hellip;', 'carrington-business'));
		?>
	</div>
	<?php if (function_exists('imo_add_this')) {imo_add_this();} ?>
	<a href="<?php echo home_url('/'); ?>/crown-royal-2012/">&laquo; Back to the contest page</a>
	<div class="entry-footer">
		<?php _e('In', 'carrington-business'); ?>
		<?php
		the_category(', ');
		the_tags(__(' <span class="spacer">&bull;</span> Tagged ', 'carrington-business'), ', ', '');
		wp_link_pages();
		?>
	</div>
	<?php edit_post_link(__('Edit', 'carrington-business')); ?>
</div>
