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
$byline = get_post_meta($postID, 'ecpt_byline', true);
//set the primary category urls
$url="/category/".$categoryName->slug;

?>
<div <?php post_class('entry entry-full clearfix') ?>>
	<div class="entry-header">
		<?php
		if(in_category("shot-show-2013")){
			echo '<div class="primary-shot-show">';
				echo '<a class="primary-cat" href="/shot-show-2013">'.$categoryName->name.'</a>';
				echo '<div class="presented-by">Presented By</div>';
					echo '<div class="sponsor-logo">';
						if($_SERVER['SERVER_NAME'] == "www.petersenshunting.com" || $_SERVER['SERVER_NAME'] == "www.northamericanwhitetail.com" || $_SERVER['SERVER_NAME'] == "www.bowhuntingmag.com/" || $_SERVER['SERVER_NAME'] == "www.gundogmag.com/" || $_SERVER['SERVER_NAME'] == "www.wildfowlmag.com/" || $_SERVER['SERVER_NAME'] =="www.bowhunter.com/" || $_SERVER['SERVER_NAME'] == "www.gameandfishmag.com/" ){
							echo '<a href="http://www.realtree.com/huntallseason/index.html" target="_blank"><img src="/wp-content/themes/imo-mags-gunsandammo/img/realtree-logo.png" alt="Realtree Xtra" title="Realtree Xtra" /></a>';
							}else{
								echo '<a href="http://springfield-armory.com/" target="_blank"><img src="/wp-content/themes/imo-mags-gunsandammo/img/sausa.png" alt="Springfield Amory USA" title="Springfield Amory USA" /></a>';
							}
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
			<div class="post-byline"><?php echo $byline; ?></div>
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


	<?php imo_dart_tag("564x252"); ?>




		<!-- Site - Hunting -->
		<script type="text/javascript">
		  var ord = window.ord || Math.floor(Math.random() * 1e16);
		  document.write('<a href="http://ad.doubleclick.net/N4930/jump/imo.hunting;sz=1x1;ord=' + ord + '?"><img src="http://ad.doubleclick.net/N4930/ad/imo.hunting;sz=1x1;ord=' + ord + '?" width="1" height="1" /></a>');
		</script>
		<noscript>
		<a href="http://ad.doubleclick.net/N4930/jump/imo.hunting;sz=1x1;ord=[timestamp]?">
		<img src="http://ad.doubleclick.net/N4930/ad/imo.hunting;sz=1x1;ord=[timestamp]?" width="1" height="1" />
		</a>
		</noscript>
		<div class="post-content-area">
			<div style="float:left">
			   <?php imo_dart_tag("300x250",false,array("pos"=>"mid")); ?>
			</div>

			<div class="fb-recommendations recommendations" data-site="<?php echo $_SERVER['SERVER_NAME']; ?>" data-width="300" data-height="250" data-header="true"></div>
			<div class="divider"></div>

		</div>

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
