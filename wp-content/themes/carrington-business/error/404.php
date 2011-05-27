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
?>
<header id="masthead">
	<h1 class="page-title-b"><?php _e('<i class="label">Error 404:</i> Page Not Found', 'carrington-business'); ?></h1>
</header><!-- #masthead -->
<div class="col-full">
	<?php
	_e('<h2>Sorry, we couldn&rsquo;t find the page you&rsquo;re looking for.</h2> <p>We may have moved the page or perhaps you followed an outdated link.<br/> You could try a search, or visit the home page.</p>', 'carrington-business').'</p>'; 

	cfct_form('search');
	?>
</div>
<?php get_footer(); ?>