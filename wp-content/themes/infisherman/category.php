<?php
$cat = get_category( get_query_var( 'cat' ) );
$cat_slug = $cat->slug;
if($cat_slug == "pike-muskie"){
	$cat_slug = "pike_amp_muskie";
}
if($cat_slug == "trout-salmon"){
	$cat_slug = "trout_amp_salmon";
}
$dataPos = 0;

get_header(); ?>
        <?php imo_sidebar();?>
        <div id="primary" class="general">
            <div id="content" role="main" class="general-frame">
                
                <?php if ( have_posts() ) : ?>
    
                    <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
                        <h1 class="page-title"><?php
                            printf('<span>' . single_cat_title( '', false ) . '</span>' );
                            ?>
                        </h1>
                        <!-- Site - In-Fisherman
						<script type="text/javascript">
						  var ord = window.ord || Math.floor(Math.random() * 1e16);
						  document.write('<a href="http://ad.doubleclick.net/N4930/jump/imo.in-fisherman;sz=260x35;camp=<?php echo $cat_slug; ?>;ord=' + ord + '?"><img src="http://ad.doubleclick.net/N4930/ad/imo.in-fisherman;sz=260x35;camp=<?php echo $cat_slug; ?>;ord=' + ord + '?" width="260" height="35" /></a>');
						</script>
						<noscript>
						<a href="http://ad.doubleclick.net/N4930/jump/imo.in-fisherman;sz=260x35;camp=<?php echo $cat_slug; ?>;ord=[timestamp]?">
						<img src="http://ad.doubleclick.net/N4930/ad/imo.in-fisherman;sz=260x35;camp=<?php echo $cat_slug; ?>;ord=[timestamp]?" width="260" height="35" />
						</a>
						</noscript> -->
					</div>
                                                
                    <?php if (z_taxonomy_image_url()) echo '<div class="category-img"><img src="'.z_taxonomy_image_url().'" alt="'.single_cat_title( '', false ).'" title="'.single_cat_title( '', false ).'" /></div>'; ?>                    
                    <?php
                    	$category_description = category_description();
                            if ( ! empty( $category_description ) )
                                echo apply_filters( 'category_archive_meta', '<div data-position="' . $dataPos = $dataPos + 1 . '" class="category-archive-meta taxdescription js-responsive-section">' . $category_description . '</div>' );
                        ?>
                     <?php $fetured_slider_query = new WP_Query( 'category_name='.$cat_slug.'&posts_per_page=8' ); ?>
                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="double-posts double-post-slider js-responsive-section">                    
                    <div class="jq-slider clearfix">
                        <ul class="slides-inner slides">
                            <?php $i = 1  ?>
                            <?php while ($fetured_slider_query->have_posts()) : $fetured_slider_query->the_post(); ?>
                            
                            <?php if (!(($i+1)%2) ): ?>
                            <li>
                            <?php endif; ?>
                            
                            <div class="feat-post">
                                <div class="feat-img"><a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('post-home-small-thumb');?></a></div>
                                <div class="feat-text">
                                    <div class="clearfix">
                                    	<?php echo primary_and_secondary_categories(); ?>
                                    </div>
                                    <h3><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h3>
                                    <!--<div class="shares-count">
                                        <?php //render_shares_count(get_permalink(), $post->ID) ?> <span>Shares</span>
                                    </div>
                                    <a class="view-post" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">&nbsp;</a>-->
                                </div>
                            </div>
                            
                            <?php if (!($i%2)): ?>
                            </li>
                            <?php endif; ?>
                            
                            <?php $i++; ?>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>
   
                    <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="filter-by jq-filter-by js-responsive-section">               
                        <strong>filter by:</strong>
                        <ul class="filter-links">
                            <li><a href="#">Latest</a></li>
                            <!--<li><a href="#">Most Viewed</a></li>-->
                            <li><a href="#">Most Discussed</a></li>
                            <!--<li><a href="#">Most Shared</a></li>-->
                        </ul>
                    </div>
                    
                    <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="js-responsive-section main-content-preppend">
                        <?php //twentyeleven_content_nav( 'nav-above' ); ?>
						
                        <?php /* Start the Loop */
                        query_posts('offset=6');
                        ?>
                        <?php $i = 1; while ( have_posts() ) : the_post(); ?>
        
                            <?php
                                /* Include the Post-Format-specific template for the content.
                                 * If you want to overload this in a child theme then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                get_template_part( 'content/content', get_post_format() );
                            ?>

                        <?php if ( (($i - (($paged -1) * 2 ))%6) == 0 ): ?>
	                        <?php if ( is_mobile() ){ ?>
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
                
               <a href="/newsletter-signup" class="get-newsletter">Get the In-Fisherman <br />Newsletter</a>
                <a href="<?php print SUBS_LINK;?>" class="subscribe-banner">                    
                    <img src="<?php bloginfo('template_directory'); ?>/images/pic/subscribe-banner.jpg" alt="" />
                </a>
                <a href="#" class="back-top jq-go-top">back to top</a>
                
            </div><!-- #content -->
        </div><!-- #primary -->
<?php get_footer(); ?>