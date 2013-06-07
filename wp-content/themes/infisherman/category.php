<?php
get_header(); ?>
        <?php imo_sidebar();?>
        <div id="primary" class="general">
            <div id="content" role="main" class="general-frame">
                
                <?php if ( have_posts() ) : ?>
    
                    <div data-position="1" class="page-header clearfix js-responsive-section">
                        <h1 class="page-title"><?php
                            printf('<span>' . single_cat_title( '', false ) . '</span>' );
                            ?>
                        </h1>
                        <img src="<?php bloginfo('template_directory'); ?>/images/logos/livingston.png" alt="" class="tite-logo" />
    
					</div>
                    <div data-position="2" class="sub-titile-banner js-responsive-section">
                        <a href="#">
                            <img src="<?php bloginfo('template_directory'); ?>/images/pic/revo-sx-family.jpg" alt="" />
                        </a>
                    </div> 
                             
                    <?php if (z_taxonomy_image_url()) echo '<div class="category-img"><img src="'.z_taxonomy_image_url().'" alt="'.single_cat_title( '', false ).'" title="'.single_cat_title( '', false ).'" /></div>'; ?>                    
                    <?php
                    	$category_description = category_description();
                            if ( ! empty( $category_description ) )
                                echo apply_filters( 'category_archive_meta', '<div data-position="3" class="category-archive-meta taxdescription js-responsive-section">' . $category_description . '</div>' );
                        ?>
                        
                    <div data-position="4" class="filter-by jq-filter-by js-responsive-section">               
                        <strong>filter by:</strong>
                        <ul class="filter-links">
                            <li><a href="#">Latest</a></li>
                            <!--<li><a href="#">Most Viewed</a></li>-->
                            <li><a href="#">Most Commented</a></li>
                            <!--<li><a href="#">Most Shared</a></li>-->
                        </ul>
                    </div>
                    
                    <div data-position="5" class="js-responsive-section main-content-preppend">
                        <?php //twentyeleven_content_nav( 'nav-above' ); ?>
    
                        <?php /* Start the Loop */ ?>
                        <?php $i = 1; while ( have_posts() ) : the_post(); ?>
        
                            <?php
                                /* Include the Post-Format-specific template for the content.
                                 * If you want to overload this in a child theme then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                get_template_part( 'content', get_post_format() );
                            ?>

                        <?php if ( ($i%6) == 0 ): ?>
                        <div class="image-banner posts-image-banner">
                            <?php imo_dart_tag("300x250",array("pos"=>"mob")); ?> 
                        </div>
                        <?php endif;?>
        
                        <?php $i++; endwhile; ?>
        
                        <?php //twentyeleven_content_nav( 'nav-below' ); ?>
                    </div>
    
                    <div data-position="7" class="pager-holder js-responsive-section">
                        <a href="#" class="btn-base">Load More</a>
                        <div class="next-link" style="display:none;"><?php next_posts_link(); ?></div>
                        <a href="#" class="go-top jq-go-top">go top</a>

                        <img src="/wp-content/themes/infisherman/images/ajax-loader.gif" id="ajax-loader" style="display:none;"/>
                    </div>
                <?php else : ?>
    
                    <div id="post-0" class="post no-results not-found">
                        <div class="entry-header">
                            <h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
                        </div><!-- .entry-header -->
    
                        <div class="entry-content">
                            <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
                            <?php get_search_form(); ?>
                        </div><!-- .entry-content -->
                    </div><!-- #post-0 -->
    
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