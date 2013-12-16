<?php
/**
 * Template Name: Video Page
 * Description: A Page Template for video Pages.
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

if($_SERVER["REQUEST_URI"] == "/personal-defense-video/"){
   $category = "category_name=video,personal-defense";
   $title = "Personal Defense Videos";
}else if($_SERVER["REQUEST_URI"] == "/tips-tactics/"){
   $category = ",category_name=videotips-tactics";
   $title = "Tips & Tactics Videos";
}else if($_SERVER["REQUEST_URI"] == "/video-reviews/"){
   $category = ",category_name=videovideo-reviews";
   $title = "Video Reviews";
}else{
   $category ="";
}

get_header();
imo_sidebar(); ?>
	<div id="primary" class="general">
        <div class="general-frame">
            <div id="content" role="main">
            	
	             <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="featured-area clearfix js-responsive-section">
	                <div class="section-title posts">
					    <h2 class="">
					        <div class="icon"></div>
					        <span><?php echo $title; ?></span> 
					    </h2>
					</div>

	            </div>
	           <?php 
			   $video_query = new WP_Query($category); ?>
	           <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section main-content-preppend">
						<?php $i = 1; while ( $video_query->have_posts() ) : $video_query->the_post(); ?>
        
                            <?php
                                /* Include the Post-Format-specific template for the content.
                                 * If you want to overload this in a child theme then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                get_template_part( 'content/content', get_post_format() );
								if ( (($i - (($paged -1) * 2 ))%6) == 0 ): ?>
                        	
	                        <?php if ( mobile() ){ ?>
	                        <div class="image-banner posts-image-banner">
	                            <?php imo_dart_tag("300x250",array("pos"=>"mob")); ?> 
	                        </div>
	                        <?php } ?>
                        <?php endif;?>
						
                        <?php $i++; endwhile; ?>
        
                    </div>
    
                    <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
                        <a href="#" class="btn-base">Load More</a>
                        <div class="next-link" style="display:none;"><?php next_posts_link(); ?></div>
                        <a href="#" class="go-top jq-go-top">go top</a>

                        <img src="/wp-content/themes/imo-mags-parent/images/ajax-loader.gif" id="ajax-loader" style="display:none;"/>
                    </div>
                    
         
                <?php social_footer(); ?>
                <a href="#" class="back-top jq-go-top">back to top</a>
                
            </div><!-- #content -->
        </div><!-- #primary -->
<?php get_footer(); ?>