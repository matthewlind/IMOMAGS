<?php
/**
 * Template Name: Likes Leaderboard
 * Description: Displays the most liked photos
 *
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header();
get_template_part( 'nav', get_post_format() );
imo_sidebar(); ?>
	<div id="primary" class="general">
        <div class="general-frame">
            <div id="content" role="main">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content/content', 'leaderboard' ); ?>
				<?php endwhile; // end of the loop. ?>
            </div><!-- #content -->
        </div>
    </div><!-- #primary -->
<?php get_footer(); ?>