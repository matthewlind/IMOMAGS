<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

$dataPos = 0;

get_header(); ?>
        <?php imo_sidebar();?>
        <div id="primary" class="general">
            <div id="content" role="main" class="general-frame">

			<?php if ( have_posts() ) : ?>

				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
                        <h1 class="page-title"><?php printf( __( 'Results for: %s', 'twentyeleven' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</div>

				<div class="js-responsive-section main-content-preppend">
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content/content', get_post_format() );
					?>
					
				<?php endwhile; ?>
				</div>
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
                    <a href="#" class="btn-base">Load More</a>
                    <div class="next-link" style="display:none;"><?php next_posts_link(); ?></div>
                    <a href="#" class="go-top jq-go-top">go top</a>

                    <img src="/wp-content/themes/infisherman/images/ajax-loader.gif" id="ajax-loader" style="display:none;"/>
                </div>
				

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentyeleven' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>
			
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
                
                <a href="#" class="get-newsletter">Get the In-Fisherman <br />Newsletter</a>
                <a href="#" class="subscribe-banner">
                    <img src="<?php bloginfo('template_directory'); ?>/images/pic/subscribe-banner.jpg" alt="" />
                </a>
                <a href="#" class="back-top jq-go-top">back to top</a>
                
            </div><!-- #content -->
        </div><!-- #primary -->
<?php get_footer(); ?>