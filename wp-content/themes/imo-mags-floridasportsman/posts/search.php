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

$s = esc_html(get_search_query());
?>
<header id="masthead">
	<h1 class="page-title-b"><?php printf(__('<i class="label">Results for:</i> %s', 'carrington-business'), $s); ?></h1>
</header><!-- #masthead -->
<div class="page-template-page-right-php bw-fullwidth">
	<div class="bonus-background">
		<div class="bonus">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-landing')) : else : ?><?php endif; ?>
		</div>
	</div>
	<div class="col-abc">
		<div <?php post_class('entry entry-full clearfix'); ?>>
			<div class="entry-content">
	<?php
	cfct_loop();
	cfct_misc('nav-posts');
	?>
			</div>
		</div><!-- .entry -->
	</div><!-- .col-abc -->
</div>
<?php get_footer(); ?>
