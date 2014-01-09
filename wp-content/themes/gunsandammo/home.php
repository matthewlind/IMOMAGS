<?php
$dataPos = 0;
get_header(); ?>
	<?php imo_sidebar(); ?>
	<div id="primary" class="general">
        <div class="general-frame">
            <div id="content" role="main">
            <?php if ( is_home() ) : ?>

                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="featured-area clearfix js-responsive-section">
                    <div class="clearfix">
                        <ul>
                       	 	<?php if( function_exists('showFeaturedList') ){ echo showFeaturedPosts(array('set_id' => 1)); } ?>
                       	</ul>
                    </div>
                </div>
                
                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
                 	<div class="section-title posts">
					    <h2>
					        <div class="icon"></div>
					        <span>The G&amp;A Lists</span> 
					    </h2>
					</div>
				
                    <div class="ga-lists-featured">
							<?php if( function_exists('showFeaturedList') ){ echo showFeaturedPosts(array('set_id' => 3)); } ?>                
					</div>
					
                    <div class="ga-lists-list">
	                    <div class="fancy">
							<ul>
								<?php $slug = 'featured';
								$category = get_category_by_slug($slug);
								
								$lists_query = new WP_Query( 'category_name=ga-lists&posts_per_page=8&cat=-' . $category->cat_ID );                     
								while ($lists_query->have_posts()) : $lists_query->the_post(); ?>			
									<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
								<?php $i++; endwhile; ?>
							</ul>
						</div>
						<hr class="cfct-div-solid">
						<a class="cta" href="/ga-lists/">See More Lists<span></span></a>
                    </div>
                </div>
				
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header loading-block js-responsive-section">
					<?php the_widget('imo\GAReviewWidget'); ?>			
				</div>
				<?php if ( mobile() ){ get_sidebar("mobile"); } ?>
                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list page-header js-responsive-section main-content-preppend">
					<div class="section-title posts">
					    <h2>
					        <div class="icon"></div>
					            <span>Latest</span> 
					    </h2>
					</div>
                    
                    <?php 
					$slug = 'featured';
					$category = get_category_by_slug($slug);
					
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $more_query = new WP_Query( 'post_type=post&posts_per_page=20&paged=' . $paged. '&cat=-' . $category->cat_ID );                     
                    
                    $i++;
                    
                    while ($more_query->have_posts()) : $more_query->the_post(); ?>
					
                    <div class="post article-brief clearfix">
                        <!--<div class="posts-list-sep"><div class="bar"></div></div>-->
                        <a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('list-thumb'); ?></a>
                        <div class="article-holder">
                            <div class="clearfix">
                                <?php //if(function_exists('primary_and_secondary_categories')){echo primary_and_secondary_categories();} ?>
                            </div>
                            <h3 class="entry-title">
                                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                            </h3>
                            <span>by <?php the_author(); ?></span>
                            <!--<a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('list-thumb');?></a>-->
                            <!-- .entry-header -->
                           <a class="comment-count" href="<?php echo get_comments_link(); ?>"><?php echo get_comments_number(); ?></a>
                            <div class="entry-content">
                                <?php the_excerpt(); ?>
                                <?php //the_content( __( 'more <span class="meta-nav">&raquo;</span>', 'twentytwelve' ) ); ?>
                                <?php wp_link_pages( array( 'before' => '<div class="page-links">' . 'Pages:', 'after' => '</div>' ) ); ?>
                            </div><!-- .entry-content -->
                        </div>
                    </div><!-- #post -->
                    <?php if ( (($i - (($paged -1) * 2 ))%6) == 0 ): ?>
                        <?php if ( mobile() ){ ?>
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

                    <img src="/wp-content/themes/imo-mags-parent/images/ajax-loader.gif" id="ajax-loader" style="display:none;"/>
                </div>

                <?php sub_footer(); ?>
                <!-- end home page content-->
            <?php endif; // end have_posts() check ?>

            </div><!-- #content -->
        </div><!-- .general -->
    </div><!-- #primary -->


<?php get_footer(); ?>
