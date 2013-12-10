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

get_header(); ?>
<div class="category-page">
	<header id="masthead">
		<h1>Summer Family and Fun</h1>
	</header>
	<div class="bonus-background">
		<div class="bonus">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-sweeps')) : else : ?><?php endif; ?>
		</div>
		<div id="responderfollow"></div>
		<div class="sidebar advert">
			<?php imo_dart_tag("300x250",false,array("pos"=>"btf")); ?>
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : endif; ?>
		</div>
	</div>


	<div class="col-ab">
		<!-- FOR WHEN THE GALLERY FOR SUMMER IS READY ---  <p>To celebrate our dads and all they've done for us, the editors of Intermedia Outdoors have joined forces to pay tribute to the men that made us sportsmen.</p>-->


		<?php




			//echo do_shortcode('[imo-slideshow gallery=92]');
		?>


	<h2>Recent Entries</h2>
	<?php

	$args = array(
	'post_type' => 'entries',
	'category_name' => 'summer-family-iiyn'
	);

	// The Query
	$the_query = new WP_Query( $args );

	// The Loop
	while ( $the_query->have_posts() ) :
		$the_query->the_post();
		$postID = get_the_ID();
		echo '<div class="iiyn">';
			if ( has_post_thumbnail() ) {
				echo '<div class="iiyn-thumb">' . get_the_post_thumbnail() . '</div>';
			}
			echo '<h4 class="iiyn-title">' . get_the_title() . '</h4>';
			echo '<h6 class="iiyn-name">' . get_post_meta($postID,"cabelas_entry_full_name",true) . ' &#8226; <span>' . get_post_meta($postID,"cabelas_entry_location",true) . '</span></h6>';
			echo '<p>' . the_content() . '</p>';
		echo '</div>';
	endwhile;

	/* Restore original Post Data
	 * NB: Because we are using new WP_Query we aren't stomping on the
	 * original $wp_query and it does not need to be reset.
	*/
	wp_reset_postdata();

	cfct_misc('nav-posts');
	?>


	</div>

<?php get_footer(); ?>
