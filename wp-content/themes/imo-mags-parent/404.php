<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage infisherman
 * @since infisherman 1.0
 */

//For some reason, 404 pages were set to not be cached be varnish. This should fix that issue.
header ("Cache-Control: max-age=20800"); // HTTP 1.1

$dataPos = 0;
get_header();
imo_sidebar();?>
	<div id="primary" class="general">
        <div class="general-frame">
            <div id="content" role="main">
            	 <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header article-brief clearfix js-responsive-section">
					 <strong class="message-not-found">Error: Page not found.</strong>
					 <p style="padding: 0 30px 30px;">Unfortunately, We can't find the page you are looking for. Here are the latest stories from In-Fisherman</p>
            	 </div>
				<div class="js-responsive-section main-content-preppend">
						<?php
							$custom_query = new WP_Query('order=DESC&limit=10');
							while ($custom_query->have_posts()) : $custom_query->the_post();
								get_template_part( 'content/content', get_post_format() );
							endwhile;
						?>
				</div>
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
                    <a href="#" class="btn-base">Load More</a>
                    <div class="next-link" style="display:none;"><?php next_posts_link(); ?></div>
                    <a href="#" class="go-top jq-go-top">go top</a>

                    <img src="/wp-content/themes/infisherman/images/ajax-loader.gif" id="ajax-loader" style="display:none;"/>
                </div>

		 	</div><!-- #content -->
        </div>
    </div><!-- #primary -->
<?php get_footer(); ?>
