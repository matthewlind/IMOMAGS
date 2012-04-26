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

// NOTE: this file is here for compatibility reasons - active templates are in the posts/ dir 

if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header(); 
?>

<header id="masthead">
	<h1><?php single_cat_title('');?>hi</h1>
</header>

<div id="content" class="col-ab">
	<?php
	cfct_loop();
	cfct_misc('nav-posts'); ?>
</div>

<?php
get_sidebar();
get_footer(); ?>

?>