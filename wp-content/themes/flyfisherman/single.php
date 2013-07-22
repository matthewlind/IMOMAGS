
<?php
get_header(); ?>

<?php if (isset_related_posts()): ?>
<div class="paging-posts paging-posts-top loading-block">
    <div class="jq-paging-slider onload-hidden">
    <?php related_posts(); ?>
    </div>
</div>
<?php endif; ?>
    <div class="inner-main">
    	<?php imo_sidebar();?>
		<div id="primary" class="general">
            <div id="content" class="general-frame" role="main">

                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'content/content-single', get_post_format() ); ?>

                    <div class="post-comments-area">
                        <?php comments_template( '', true ); ?>
                    </div>
                    
                    <div class="hr"></div>
                    
                    <?php social_footer(); ?> 
                    <a href="#" class="back-top jq-go-top">back to top</a>
                    
                <?php endwhile; // end of the loop. ?>
    
            </div><!-- #content -->
        </div><!-- #primary -->
        
    </div>
<?php get_footer(); ?>