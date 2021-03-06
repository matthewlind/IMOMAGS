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


<div class="page-flow">
	<div id="content" class="col-ab">
		<header>
			<h1><?php _e('', 'carrington-business'); wp_title('&rsaquo;'); ?></h1>
		</header>
		<?php
		cfct_loop();
		cfct_misc('nav-posts'); ?>
	</div>
</div>
<?php
get_sidebar();
get_footer(); ?>