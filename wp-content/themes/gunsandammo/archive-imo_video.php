<?php
 
$dataPos = 0;

get_header();
imo_sidebar(); ?>
	<div id="primary" class="general">
        <div class="general-frame">
            <div id="content" role="main">
            	
	             <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="featured-area page-header clearfix js-responsive-section">
	                <div class="section-title videos">
					    <h2>
					        <div class="icon"></div>
					        <span>Videos</span> 
					    </h2>
					</div>
					<?php if(function_exists('wpsocialite_markup')){ wpsocialite_markup(); } ?>
					<div class="clearfix">
	                    <ul>
	                   	 	<?php if( function_exists('showFeaturedList') ){ echo showFeaturedPosts(array('set_id' => 15)); } ?>
	                   	</ul>
	                </div>
	            </div>

	            <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
	                <div class="section-title videos">
					    <h2>
					        <div class="icon"></div>
					        <span>Personal Defense</span> 
					    </h2>
					</div>
					
					<div class="clearfix">
	                    <ul>
	                   	 	<?php if( function_exists('showFeaturedList') ){ echo showFeaturedPosts(array('set_id' => 16)); } ?>
	                   	</ul>
                        <?php if ( mobile() ){ ?>
                        <div class="image-banner posts-image-banner">
                            <?php imo_ad_placement("atf_medium_rectangle_300x250"); ?>
                        </div>
                        <?php } ?>
			        </div>
			    </div>

				 <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
	                <div class="section-title videos">
					    <h2>
					        <div class="icon"></div>
					        <span>Tips & Tactics</span> 
					    </h2>
					</div>
					
					<div class="clearfix">
	                    <ul>
	                   	 	<?php if( function_exists('showFeaturedList') ){ echo showFeaturedPosts(array('set_id' => 17)); } ?>
	                   	</ul>
                        <?php if ( mobile() ){ ?>
                        <div class="image-banner posts-image-banner">
                            <?php imo_ad_placement("atf_medium_rectangle_300x250"); ?>
                        </div>
                        <?php } ?>
			        </div>
			    </div>				
				
				 <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
	                <div class="section-title videos">
					    <h2>
					        <div class="icon"></div>
					        <span>Video Reviews</span> 
					    </h2>
					</div>
					
					<div class="clearfix">
	                    <ul>
	                   	 	<?php if( function_exists('showFeaturedList') ){ echo showFeaturedPosts(array('set_id' => 18)); } ?>
	                   	</ul>
                        <?php if ( mobile() ){ ?>
                        <div class="image-banner posts-image-banner">
                           <?php imo_ad_placement("atf_medium_rectangle_300x250"); ?> 
                        </div>
                        <?php } ?>
			        </div>
			    </div>


				  
                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header posts-list js-responsive-section main-content-preppend">
                	 <div class="section-title videos">
				    <h2>
				        <div class="icon"></div>
				        <span>All Videos</span> 
				    </h2>
				</div>
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
            </div>  
        </div><!-- #content -->
    </div><!-- #primary -->
<?php get_footer(); ?>