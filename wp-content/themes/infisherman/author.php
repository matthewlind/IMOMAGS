<?php
/**
 * The template for displaying Author Archive pages.
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
	            <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">

				<?php if ( have_posts() ) : ?>
	
					<?php
						/* Queue the first post, that way we know
						 * what author we're dealing with (if that is the case).
						 *
						 * We reset this later so we can run the loop
						 * properly with a call to rewind_posts().
						 */
						the_post();
					?>
	

						<h1 class="page-title author"><?php printf( '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
					</div>
                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="sub-titile-banner js-responsive-section">
                    <a href="#">
                        <img src="<?php bloginfo('template_directory'); ?>/images/pic/revo-sx-family.jpg" alt="" />
                    </a>
                </div> 
	
					<?php
						/* Since we called the_post() above, we need to
						 * rewind the loop back to the beginning that way
						 * we can run the loop properly, in full.
						 */
						rewind_posts();
					?>
	
	
					<?php
					// If a user has filled out their description, show a bio on their entries.
					if ( get_the_author_meta( 'description' ) ) : ?>
					<div id="author-info" class="article-brief">
						<div id="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyeleven_author_bio_avatar_size', 60 ) ); ?>
						</div><!-- #author-avatar -->
						<div id="author-description">
							<?php the_author_meta( 'description' ); ?>
						</div><!-- #author-description	-->
					</div><!-- #entry-author-info -->
					<?php endif; ?>
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
							<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
						</div><!-- .entry-content -->
					</article><!-- #post-0 -->
	
				<?php endif; ?>
	
			<div class="foot-social clearfix">
                    <strong class="social-title">Like us on Facebook to <span>stay updated !</span></strong>
                    <div class="fb-like" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
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