<?php

$dataPos = 0;

get_header(); ?>
        <?php imo_sidebar(); ?>
        <div id="primary" class="general">
            <div id="content" role="main" class="general-frame">
                
                <?php if ( have_posts() ) : ?>
    
                    <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
                        <h1 class="page-title">
                        <div class="icon"></div>
                        <?php
                            printf('<span>' . single_cat_title( '', false ) . '</span>' );
                        ?>
                        </h1>
                        <div class="sponsor"><?php //imo_dart_tag("240x60"); ?></div>
					</div>
                                                
                    <?php 
                    if(function_exists('z_taxonomy_image_url')){
                    	if (z_taxonomy_image_url()) echo '<div class="category-img"><img src="'.z_taxonomy_image_url().'" alt="'.single_cat_title( '', false ).'" title="'.single_cat_title( '', false ).'" /></div>'; 
                    } 
                	$category_description = category_description();
                        if ( ! empty( $category_description ) )
                            echo apply_filters( 'category_archive_meta', '<div data-position="' . $dataPos = $dataPos + 1 . '" class="category-archive-meta taxdescription js-responsive-section">' . $category_description . '</div>' );
                    ?>
                        
                    <!--<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="filter-by jq-filter-by js-responsive-section">               
                        <strong>filter by:</strong>
                        <ul class="filter-links">
                            <li><a href="#">Latest</a></li>
                            <li><a href="#">Most Viewed</a></li>
                            <li><a href="#">Most Discussed</a></li>
                            <li><a href="#">Most Shared</a></li>
                        </ul>
                    </div>-->
                    
                    <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section main-content-preppend">
						<?php $i = 1; while ( have_posts() ) : the_post(); ?>
        
                            <?php
                                /* Include the Post-Format-specific template for the content.
                                 * If you want to overload this in a child theme then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                get_template_part( 'content/content', get_post_format() );
                                
                                $community_category = get_category( get_query_var( 'cat' ) );
								$community_cat = $community_category->slug;
                            ?>
						<?php if ( function_exists('imo_community_template') ){ 
							if ( $i == 4 && $paged == 0 && ($community_cat == "master-angler" || $community_cat == "bass" || $community_cat == "panfish" || $community_cat == "pike" || $community_cat == "muskie" || $community_cat == "trout" || $community_cat == "salmon" || $community_cat == "carp" || $community_cat == "crappie" || $community_cat == "catfish") ){ ?>
		                       <div class="post">
			                        <h2 style="margin-top:10px;">Explore Photos</h2>
			                        <?php echo do_shortcode('[imo-slideshow community=true gallery='. $community_cat .']'); ?>
				               </div>
			                <?php } } ?>
							
                       						
                        <?php $i++; endwhile; ?>
        
                    </div>
    
                    <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
                        <a href="#" class="btn-base">Load More</a>
                        <div class="next-link" style="display:none;"><?php next_posts_link(); ?></div>
                        <a href="#" class="go-top jq-go-top">go top</a>

                        <img src="/wp-content/themes/imo-mags-parent/images/ajax-loader.gif" id="ajax-loader" style="display:none;"/>
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
                <?php social_footer(); ?>
                <a href="#" class="back-top jq-go-top">back to top</a>
                
            </div><!-- #content -->
        </div><!-- #primary -->
<?php get_footer(); ?>