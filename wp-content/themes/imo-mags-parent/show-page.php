<?php
/**
 * Template Name: Show Page Child
 * Description: A Page Template for About pages and other child pages for shows.
 *
 * The showcase template in Twenty Eleven consists of a featured posts section using sticky posts,
 * another recent posts area (with the latest post shown in full and the rest as a list)
 * and a left sidebar holding aside posts.
 *
 * We are creating two queries to fetch the proper posts and a custom widget for the sidebar.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
get_header(); ?>
	<div id="primary" class="general">
        <div class="general-frame">
            <div id="content" role="main">
				<?php 
					while ( have_posts() ) : the_post(); 
						include("wp-content/themes/imo-mags-parent/content/content-show-child.php");
					endwhile; // end of the loop. 
				?>
            </div><!-- #content -->
        </div>
    </div><!-- #primary -->
<?php get_footer(); ?>