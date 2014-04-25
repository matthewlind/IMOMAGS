<?php
/**
 * Template Name: Tournament Bass Fishing Page
 * Description: A Page Template for Tournament Bass Fishing
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
get_header();
get_template_part( 'nav', get_post_format() );

imo_sidebar(); ?>
    					        
<div id="primary" class="general">
    <div class="general-frame">
        <div id="content" role="main">  
            <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="clearfix js-responsive-section">
            	<?php if (function_exists('imo_add_this')) {imo_add_this();} ?>
			</div>
			<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="article-brief clearfix js-responsive-section">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content/content', 'page' ); ?>
				<?php endwhile; // end of the loop. ?>		
        	</div>
		
			<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
				<a href="#" class="go-top jq-go-top">go top</a>
			</div>

	 	</div><!-- #content -->
    </div>
</div><!-- #primary -->
<?php get_footer(); ?>
