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

// Let's get the Primary Category (Hikari Plugin)
$postID = get_the_ID();
$categoryID = get_post_meta($postID);
$catID = $categoryID["_category_permalink"];
$categoryName = get_term_by('id', $catID[0], 'category'); 

//set the primary category urls
$url="/category/".$categoryName->slug;

?>
<div <?php post_class('entry entry-full clearfix') ?>>
	<div class="entry-header">
		<?php 
		if(in_category("shot-show-2013") && $_SERVER["SERVER_NAME"] == "www.petersenshunting.com"){
			echo '<div class="primary-shot-show">'; 
				echo '<a class="primary-cat" href="/shot-show-2013">'.$categoryName->name.'</a>'; 
				echo '<div class="presented-by">Presented By</div>'; 
					echo '<div class="sponsor-logo">'; 
						echo '<a href="http://www.realtree.com/huntallseason/index.html" target="_blank"><img src="/wp-content/themes/imo-mags-gunsandammo/img/realtree-logo.png" alt="Realtree Xtra" title="Realtree Xtra" /></a>'; 
					echo '</div>'; 
				echo '</div>'; 
		}
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
		</div><!-- entry info -->
	</div><!--entry header-->

	<?php if (function_exists('imo_add_this')) {imo_add_this();} ?>

	<div class="entry-content">
		<?php
		// Un-comment this if you want featured images to automatically appear on full posts
		// the_post_thumbnail('thumbnail', array('class' => 'entry-img'));
		the_content(__('Continued&hellip;', 'carrington-business'));
		?>
	</div><!-- entry content -->
	<?php if (function_exists('imo_add_this')) {imo_add_this();} ?>
	<div class="entry-footer">
		<?php _e('In', 'carrington-business'); ?>
		<?php
		the_category(', ');
		the_tags(__(' <span class="spacer">&bull;</span> Tagged ', 'carrington-business'), ', ', '');
		wp_link_pages();
		?>
	</div><!-- footer -->
	<?php edit_post_link(__('Edit', 'carrington-business')); ?>
</div><!-- post -->
