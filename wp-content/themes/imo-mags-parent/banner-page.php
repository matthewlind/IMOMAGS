<?php
/**
 * Template Name: Banner Page
 * Description: A Page Template for Headers with Banners instead of titles.
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
imo_sidebar();?>
	<div id="primary" class="general">
        <div class="general-frame">
            <div id="content" role="main">
            	<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="article-brief clearfix js-responsive-section">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content/content', 'page' ); ?>
					<?php endwhile; // end of the loop. ?>				
            	</div>
				
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
					<a href="#" class="go-top jq-go-top">go top</a>
				</div>

				<div class="foot-social clearfix">
                    <strong class="social-title">Like us on Facebook to <span>stay updated !</span></strong>
                    <div class="fb-like" data-href="http://www.facebook.com/InFisherman" data-send="false" data-layout="button_count" data-width="100" data-show-faces="true"></div>
                     <?php social_networks(); ?>
                </div>
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
                
                <a href="#" class="subscribe-banner">
                    <img src="<?php bloginfo('template_directory'); ?>/images/pic/subscribe-banner.jpg" alt="" />
                </a>
                <a href="#" class="back-top jq-go-top">back to top</a>

		 	</div><!-- #content -->
        </div>
    </div><!-- #primary -->
<?php get_footer(); ?>
