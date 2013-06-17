
<?php
get_header(); ?>

<?php if (isset_related_posts()): ?>
<div class="paging-posts paging-posts-top">
    <div class="jq-paging-slider">
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
                    
                    <div class="foot-social clearfix">
                        <strong class="social-title">Like us on Facebook to <span>stay updated !</span></strong>
                        <div class="fb-like" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
                        <?php social_networks(); ?>
                    </div>
                    
                    <a href="/newsletter-signup" class="get-newsletter">Get the In-Fisherman <br />Newsletter</a>
                    <a href="<?php print SUBS_LINK;?>" class="subscribe-banner">
                        <img src="<?php bloginfo('template_directory'); ?>/images/pic/subscribe-banner.jpg" alt="" />
                    </a>
                    <a href="#" class="back-top jq-go-top">back to top</a>
                    
                <?php endwhile; // end of the loop. ?>
    
            </div><!-- #content -->
        </div><!-- #primary -->
        
    </div>
<?php get_footer(); ?>