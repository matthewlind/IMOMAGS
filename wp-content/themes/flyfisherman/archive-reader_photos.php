<?php

$dataPos = 0;

get_header();
get_template_part( 'nav', get_post_format() );
imo_community_sidebar();
?>



    <div id="primary" class="page-community">
        <div id="content" role="main" class="general">
			<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section main-content-preppend">

	             <?php while ( have_posts() ) : the_post(); ?>
	
	                <?php get_template_part( 'content/content-category-reader_photos', get_post_format() ); ?>
	
	            <?php endwhile; ?>
	            
	        </div>
            <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
			    <a href="#" class="btn-base">Load More</a>
			    <div class="next-link" style="display:none;"><?php next_posts_link(); ?></div>
			    <a href="#" class="go-top jq-go-top">go top</a>
			
			    <img src="/wp-content/themes/imo-mags-parent/images/ajax-loader.gif" id="ajax-loader" style="display:none;"/>
			</div>
        </div><!-- #content -->
    </div><!-- #primary -->
    

<?php get_footer(); ?>