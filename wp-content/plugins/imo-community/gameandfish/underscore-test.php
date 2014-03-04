<?php

/**
 * Template Name: Gear
 * Description: The NAW+ Community - Gear Category
 *
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

get_header();

?>


	<!-- *********************************************************** -->
	<!-- ***************** UNDERSCORE TEMPLATE ********************* -->
	<!-- *********************************************************** -->
	<script type="text/template" id="post-template">

		<li>

			<img src="/avatar?uid=<%= post.user_id %>" class="recon-gravatar"><a href="<%= post.url %>"> <%= post.title %> </a>

		</li>

	</script>
	<!-- *********************************************************** -->
	<!-- *********************************************************** -->
	<!-- *********************************************************** -->



<div class="page-community">
	<h1>UNDERSCORE TEST</h1>


    <div id="posts-container">

    </div>


</div>









<?php get_footer(); ?>