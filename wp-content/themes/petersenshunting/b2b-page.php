<?php
/**
 * Template Name: Border To Border Page
 * Description: A Page Template for Border To Border Show.
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
					<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header marquee-img clearfix js-responsive-section">
						<h1 class="page-title hidden-seo"><?php the_title(); ?></h1>
						<img src="/wp-content/themes/petersenshunting/images/b2b/b2b_marquee_placeholder.jpg" alt="b2b_marquee_placeholder" width="" height="" />
					</div>
					
			
					
					<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="show-video clearfix js-responsive-section">
						
						
						<div id="sidebar-area">
							<div class="sidebar">
								<?php imo_dart_tag("300x250"); ?>
							</div>
						</div>
						<div class="article-holder">
							<h2>Title</h2>
							<div>Content</div>
						</div>
						
						
					</div>
            </div><!-- #content -->
        </div>
    </div><!-- #primary -->
<?php get_footer(); ?>