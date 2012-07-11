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
$this_post_is_not_single = (!is_single(get_the_ID()));
?>
<div <?php post_class('entry entry-full clearfix') ?>>
	<?php
		// If we're not showing this particular single post page, link the title
		if ($this_post_is_not_single) { ?>
	<div class="entry-header">
		<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title() ?></a></h2>
		
		<div class="entry-info">
            <?php if (! in_category("What's Biting Now")): ?>
			<span class="author vcard"><span class="fn">by <?php the_author(); ?></span></span>
			<span class="spacer">&bull;</span>
            <?php endif; ?>
			<abbr class="published" title="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('F j, Y'); ?></abbr>
			
			
			<?php
			//if ($this_post_is_not_single) {
				echo ' <span class="spacer">&bull;</span> ';
				comments_popup_link(__('No comments', 'carrington-business'), __('1 comment', 'carrington-business'), __('% comments', 'carrington-business'));
			//}
			?>
		</div>
	</div>
<?php } ?>

	<div class="entry-content">
		<?php
		// Un-comment this if you want featured images to automatically appear on full posts
		// the_post_thumbnail('thumbnail', array('class' => 'entry-img'));
		the_content(__('Continued&hellip;', 'carrington-business')); ?>
	</div>
	<div class="entry-footer">
		<div class="tags">	
		<?php
		echo 'More in: ';
		_e('', 'carrington-business'); 
	
		the_category(', ');
		?>
		</div>
		<div class="addthis-below">
			<?php if (function_exists('imo_add_this')) {imo_add_this();} ?>
		</div>
		<div class="divider"></div>
		<?php
		if (function_exists('related_posts')){related_posts();} ?>
		<div class="divider"></div>
	</div>
	<?php edit_post_link(__('Edit', 'carrington-business')); ?>
</div>
