<?php
get_header(); ?>
<div class="special-features">
	<ul>
		<li class="home-featured features">
			<div class="arrow-right"></div>
			<div class="feat-post">
	        	<div class="feat-text">
	        		<h3>Special Features</h3>
	            </div>
	        </div>
		</li>
		<?php if( function_exists('showFeaturedList')){ echo showFeaturedPosts('1'); } ?>
	</ul>
</div>
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