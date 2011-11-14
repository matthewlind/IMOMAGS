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


the_post();
?>
<html>
	<head>
		<title><?php the_title(); ?></title>
		<link rel='stylesheet' id='mobile-css'  href='/wp-content/themes/carrington-business/css/mobile-page.css' type='text/css' media='all' />
		<meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
			
	</head>
	<body>
			
		<div id="container">
			
			<header id="masthead">
				<h1><?php the_title(); ?></h1>
			
			</header><!-- #masthead -->
			<div id="content_container">

				<div class="col-abc">
					<div <?php post_class('entry entry-full clearfix'); ?>>
						<div class="entry-content">
							<?php
							the_content(__('Continued&hellip;', 'carrington-business'));
							wp_link_pages();
							?>
						</div>
					</div><!-- .entry -->
				
				</div><!-- .col-abc -->
			</div>
		</div>
	</body>
</html>
