<?php
$cat = get_category( get_query_var( 'cat' ) );
$cat_slug = $cat->slug;
$cat_name = $cat->cat_name;
if($cat_slug == "pike-muskie"){
	$cat_slug = "pike_amp_muskie";
}
if($cat_slug == "trout-salmon"){
	$cat_slug = "trout_amp_salmon";
}
$featuredCatID = $cat->id;
$dataPos = 0;

$categoryID = get_query_var('cat');

$queried_object = get_queried_object(); 
$taxonomy = $queried_object->taxonomy;
$term_id = $queried_object->term_id;  
$features = get_field('featured_category_posts', $taxonomy . '_' . $term_id);
 
$fullWidthImage = get_option('full_width_image_'.$categoryID, false);
$post_set_id = get_option('post_set_id_'.$categoryID, false);
$playerID = get_option('playerID_'.$categoryID, false);
$playerKey = get_option('playerKey_'.$categoryID, false);
$network_video_title = get_option('network_video_title_'.$categoryID, false);

get_header(); ?>
        <?php imo_sidebar(); ?>
        <div id="primary" class="general">
            <div id="content" role="main" class="general-frame">
				
                <?php if ( have_posts() ) : ?>
					<?php
	                    if(function_exists('z_taxonomy_image_url')){ 
	                    	if (z_taxonomy_image_url()) {
		                    	echo '<div class="sponsor">'.imo_ad_placement("sponsor_logo_240x60").'</div>';
		                    	echo '<div class="category-img"><img src="'.z_taxonomy_image_url().'" alt="'.single_cat_title( '', false ).'" title="'.single_cat_title( '', false ).'" /></div>';
							}
	                    }
	                	$category_description = category_description();
                        if ( ! empty( $category_description ) )
                            echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta taxdescription js-responsive-section">' . $category_description . '</div>' );
                    ?>
                    <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
                        <h1 class="page-title" style="<?php if(function_exists('z_taxonomy_image_url')){ if (z_taxonomy_image_url()){ echo 'text-indent:-9999px;height:0;'; } } ?>">
						<div class="icon" style="<?php if(function_exists('z_taxonomy_image_url')){ if (z_taxonomy_image_url()){ echo 'text-indent:-9999px;height:0;'; } } ?>"></div>
                        <?php
                            printf('<span>' . single_cat_title( '', false ) . '</span>' );
                            ?>
                        </h1>
                        <?php if(function_exists('z_taxonomy_image_url')){ 
	                    	if (z_taxonomy_image_url() == false){ ?>
								<div class="sponsor"><?php imo_ad_placement("sponsor_logo_240x60"); ?></div>
                        <?php } } ?>
					</div>

                    <?php if( $features ){ ?>
                    <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="featured-area clearfix js-responsive-section">
			            <div class="clearfix">
			                <ul>
       		                    <?php foreach( $features as $feature ): 
       		                    	if(get_field("promo_title",$feature->ID)){
	       		                    	$title = get_field("promo_title",$feature->ID);
       		                    	}else{
	       		                    	$title = $feature->post_title;
       		                    	}
							    	
							    	$url = $feature->guid;
							    	$tracking = "_gaq.push(['_trackEvent','Special Features $cat_name','$title','$url']);";
									$thumb = get_the_post_thumbnail($feature->ID,"list-thumb"); ?>
							    	<li class='home-featured' featured_id="<?php echo $feature->ID ?>">
							            <div class='feat-post'>
							                <div class='feat-img'><a href='<?php echo $url; ?>' onclick='<?php echo $tracking ?>'><?php echo $thumb; ?></a></div>
							                <div class='feat-text'>
							                	<div class='clearfix'>
							                    	<h3><a href='<?php echo $url; ?>' onclick='<?php echo $tracking; ?>'><?php echo $title ?></a></h3>
							                	</div>
							            </div>
							            <div class='feat-sep'><div></div></div>
							        </li>
				                <?php endforeach; ?>
				           </ul>
				    </div>
				</div>
				<?php }

                if( $playerID && $playerKey ){ ?>
						<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section">
							<div class="general-title clearfix">
				                <h2><?php echo $network_video_title; ?></h2>
				            </div>

							<!-- Start of Brightcove Player -->
							<div style="display:none"></div>

							<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>

							<object id="myExperience" class="BrightcoveExperience">
							  <param name="bgcolor" value="#FFFFFF" />
							  <param name="width" value="480" />
							  <param name="height" value="628" />
							  <param name="playerID" value="<?php echo $playerID; ?>" />
							  <param name="playerKey" value="<?php echo $playerKey; ?>" />
							  <param name="isVid" value="true" />
							  <param name="isUI" value="true" />
							  <param name="dynamicStreaming" value="true" />
							</object>
							<script type="text/javascript">brightcove.createExperiences();</script>
							<!-- End of Brightcove Player -->
						</div>
						<?php } ?>

                    <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section main-content-preppend">
						<?php $i = 1; while ( have_posts() ) : the_post(); ?>

                            <?php
                                /* Include the Post-Format-specific template for the content.
                                 * If you want to overload this in a child theme then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                get_template_part( 'content/content', get_post_format("standard") );

                                $community_category = get_category( get_query_var( 'cat' ) );
								$community_cat = $community_category->slug;
                            ?>
						<?php if ( function_exists('imo_community_template') ){
							if ( $i == 4 && $paged == 0 && ($community_cat == "master-angler" || $community_cat == "panfish" || $community_cat == "pike" || $community_cat == "muskie" || $community_cat == "trout" || $community_cat == "salmon" || $community_cat == "carp" || $community_cat == "crappie" || $community_cat == "catfish") ){ ?>
		                       <div class="post">
			                        <h2 style="margin-top:10px;">Explore Photos</h2>
			                        <?php echo do_shortcode('[imo-slideshow community=true gallery='. $community_cat .']'); ?>
				               </div>
			                <?php } } ?>

                        <?php if ( (($i - (($paged -1) * 2 ))%6) == 0 ): ?>

	                        <?php if ( mobile() ){ ?>
	                        <div class="image-banner posts-image-banner">
	                           <?php imo_ad_placement("atf_medium_rectangle_300x250"); ?>
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