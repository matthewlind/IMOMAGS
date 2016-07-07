<?php
/**
 * Template Name: Full Width Page
 * Description: A full width page template without the sidebar.
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
 
$dataPos = 0;
get_header(); ?>
    <div id="content" role="main">
    	<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="article-brief clearfix js-responsive-section">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content/content', 'page' ); ?>
			<?php endwhile; // end of the loop. ?>				
    	</div>
 	</div><!-- #content -->
<?php get_footer(); ?>
