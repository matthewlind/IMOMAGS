<?php

/**
 * COPY THIS TEMPLATE TO THE THEME TO OVERRIDE!!!!!
 *  COPY THIS TEMPLATE TO THE THEME TO OVERRIDE!!!!!
 *   COPY THIS TEMPLATE TO THE THEME TO OVERRIDE!!!!!
 *    COPY THIS TEMPLATE TO THE THEME TO OVERRIDE!!!!!
 *     COPY THIS TEMPLATE TO THE THEME TO OVERRIDE!!!!!
 *      COPY THIS TEMPLATE TO THE THEME TO OVERRIDE!!!!!
 */

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }

// NOTE: this file is here for compatibility reasons - active templates are in the posts/ dir

$code = get_option("dart_domain", $default = false);
$h1Class = "";
$imageURL = false;

if (category_description()) {
	$h1Class = "has-category";
}

$categoryID = get_query_var('cat');

$this_category = get_category($cat);
$categorySlug =  $this_category->category_nicename;
$cat_name = $this_category->cat_name;

$queried_object = get_queried_object(); 
$taxonomy = $queried_object->taxonomy;
$term_id = $queried_object->term_id;  
$features = get_field('featured_category_posts', $taxonomy . '_' . $term_id);

$useNetworkFeed = get_option('use_network_feed_'.$categoryID, false);
$fullWidthImage = get_option('full_width_image_'.$categoryID, false);
$post_set_id = get_option('post_set_id_'.$categoryID, false);
$playerID = get_option('playerID_'.$categoryID, false);
$playerKey = get_option('playerKey_'.$categoryID, false);
$network_video_title = get_option('network_video_title_'.$categoryID, false);

if (function_exists('z_taxonomy_image_url'))
	$imageURL = z_taxonomy_image_url();

if ($imageURL)
	$h1Class .= " has-image";

get_header();
imo_sidebar(); ?>

<div id="primary" class="general category-page">
	<div id="content" role="main" class="<?php echo $h1Class; ?> general-frame">
		<?php if(function_exists('z_taxonomy_image_url')){ 
        	if ($imageURL) {
            	echo '<div class="sponsor">'.imo_ad_placement("sponsor").'</div>';
            	echo '<div class="category-img"><img src="'.$imageURL.'" alt="'.single_cat_title( '', false ).'" title="'.single_cat_title( '', false ).'" /></div>';
			}
        }
    	$category_description = category_description();
        if ( ! empty( $category_description ) )
            echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta taxdescription js-responsive-section">' . $category_description . '</div>' );
		?> 
		<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
			
			<?php if ($fullWidthImage != "") { ?>
				<h1><img alt="<?php single_cat_title(''); ?>" class="full-width-header" src="<?php echo $imageURL; ?>" title="<?php single_cat_title(''); ?>"><span style="display:none;"><?php single_cat_title(''); ?></span></h1>
			<?php } else { ?>
			    <h1 class="page-title <?php echo $h1Class; ?>" style="<?php if(function_exists('z_taxonomy_image_url')){ if ($imageURL){ echo 'text-indent:-9999px;height:0;background:none;'; } } ?>">
			    	<?php printf('<span>' . single_cat_title( '', false ) . '</span>' ); ?>
			    	<div class="icon" style="<?php if(function_exists('z_taxonomy_image_url')){ if ($imageURL){ echo 'text-indent:-9999px;height:0;'; } } ?>"></div>
			    </h1>
			    <?php if(function_exists('z_taxonomy_image_url')){ 
                	if ($imageURL == false){ ?>
						<div class="sponsor"><?php imo_ad_placement("sponsor"); ?></div>
                <?php } } ?>  
			<?php } ?>
            </div>

		</div><!-- .page-header -->
		
		<?php if( $features ){ ?>
		<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="featured-area clearfix js-responsive-section">
            <div class="clearfix">
                <ul>
					<?php foreach( $features as $feature ): 
						$title = $feature->post_title;
               	 		$url = $feature->guid;
						$thumb = get_the_post_thumbnail($feature->ID, "list-thumb");
						$tracking = "_gaq.push(['_trackEvent','Special Features '" . $this_category->name . "','$title','$url']);"; ?>
                   	 	<li class="home-featured" featured_id="<?php echo $feature->ID ?>">
                            <div class="feat-post">
                                <div class="feat-img"><a href="<?php echo $url; ?>" onclick="<?php echo $tracking; ?>"><?php echo $thumb; ?></a></div>
                                <div class="feat-text">
                                	<div class="clearfix">
                                    	<h3><a href="<?php echo $url; ?>" onclick="<?php echo $tracking; ?>"><?php echo $title; ?></a></h3>
                                	</div>
                                </div>
                                <div class="feat-sep"><div></div></div>
                            </div>
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
		
		<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section">
			<?php if (!$useNetworkFeed) {
				$i = 1; while ( have_posts() ) : the_post(); ?>
	        
		            <?php get_template_part( 'content/content', get_post_format() ); ?>
					<?php if ( function_exists('imo_community_template') ){ 
						if ( $i == 4 && $paged == 0 ){ ?>
			               <div class="post">
			                    <h2 style="margin-top:10px;">Explore Photos</h2>
			                    <?php $category = get_category( get_query_var( 'cat' ) );
								$category_slug = $cat->slug;
			                    echo do_shortcode('[imo-slideshow community=true gallery='. $category_slug .']'); ?>
			               </div>
			            <?php } } 						
			            $i++; endwhile;                  
			} else { ?>
      
				<div class="category-cross-site-feed" term="<?php echo $categorySlug; ?>" dart="<?php echo $code; ?>" thumb="list-thumb"><!-- This term= attribute is searched for --></div>
				<div id="category-excerpt-template" class="post type-post status-publish format-standard hentry category-gear-accessories category-hunting category-gear-hunting article-brief clearfix" style="display:none;">
					<div class="entry-summary entry-summary-dynamic">
						<div class="entry-info">
			    			<a href="http://www.shootingtimes.deva/2011/01/03/optics_optics_090706/"><img src="http://www.shootingtimes.deva/files/2010/09/stoptics_090706pl.jpg" class="attachment-list-thumb entry-img wp-post-image" alt="stoptics_090706pl" title="stoptics_090706pl" /></a>
						</div>
					</div>
			        <div class="article-holder">
					    <div class="clearfix">
			                <?php //if (function_exists('primary_and_secondary_categories')){ echo primary_and_secondary_categories(); } ?>
			            </div>

						<div class="entry-category">
							<a href="http://www.bowhuntingmag.com" rel="category tag" target="_blank">From Petersen's Bowhunting Magazine</a>
						</div>
						
						<h3 class="entry-title">
							<a rel="bookmark" href="http://www.shootingtimes.deva/2011/01/03/optics_optics_090706/">How To Cope With A Cross-Eyed Rifle</a>
						</h3>
						<!--<span>by <?php //the_author(); ?></span>
						 .entry-header -->
		    		
		    		    <div class="entry-content">
			    			<p class="entry-content">Hugh explains how to cope with a rifle that has misaligned scope-mount holes.</p>
			    		</div><!-- .entry-content -->
		      					            
					</div><!-- .article-holder -->
				</div><!-- #post -->
			<?php }	?>
		</div><!-- .posts-list -->
		
		<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
		    <a href="#" class="btn-base category-cross-site-feed-more-button">Load More</a>
		    <div class="next-link" style="display:none;"><?php next_posts_link(); ?></div>
		    <a href="#" class="go-top jq-go-top">go top</a>
		
		    <img src="/wp-content/themes/imo-mags-parent/images/ajax-loader.gif" id="ajax-loader" class="load-spinner" style="display:none;"/>
		</div>
	
		<?php social_footer(); ?>
		<a href="#" class="back-top jq-go-top">back to top</a>
                
    </div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>
