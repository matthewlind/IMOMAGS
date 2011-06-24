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
get_header("");

the_post();
?>
<div class="col-abc">
	<div <?php post_class('entry entry-full clearfix'); ?>>
		<div class="entry-content">
<iframe src="http://imo.perfectprize.com/?m=<?php global $blog_id; print $blog_id; ?>" id="contest-frame" width="100%" height="570" frameBorder="0" scrolling="no" allowTransparency="true">
  <p>Your browser does not support iframes.</p>
</iframe>
			<?php
			the_content(__('Continued&hellip;', 'carrington-business'));
			wp_link_pages();
			
			?>
		</div>
		<?php edit_post_link(__('Edit', 'carrington-business')); ?>
	</div><!-- .entry -->
	<?php 
		# comments_template(); 
	?>
</div><!-- .col-abc -->
<?php
if (is_page_template("page-cabelas.php"))
{
	print "<!-- testplate-->";
} 
?>
<?php get_footer("contest"); ?>
