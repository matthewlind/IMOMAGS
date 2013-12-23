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


$useNetworkFeed = get_option('use_network_feed_'.$categoryID, false);
$fullWidthImage = get_option('full_width_image_'.$categoryID, false);


if (function_exists('z_taxonomy_image_url'))
	$imageURL = z_taxonomy_image_url();

if ($imageURL)
	$h1Class .= " has-image";

get_header();
imo_sidebar(); ?>

<div id="primary" class="general category-page">
	<div id="content" role="main" class="<?php echo $h1Class; ?> general-frame">

		<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
		
			<?php if ($fullWidthImage != "") { ?>
				<h1><img alt="<?php single_cat_title(''); ?>" class="full-width-header" src="<?php echo $imageURL; ?>" title="<?php single_cat_title(''); ?>"><span style="display:none;"><?php single_cat_title(''); ?></span></h1>
			<?php } else { ?>
			
				<?php if ($imageURL): ?>
					<div class="header-bonus" style="background-image:url('<?php echo $imageURL; ?>');">
						<!-- <img src="<?php echo $imageURL; ?>"> -->
					</div>
				<?php endif; ?>
	
			    <h1 class="header-info page-title <?php echo $h1Class; ?>">
			    	<?php printf('<span>' . single_cat_title( '', false ) . '</span>' ); ?>
			    </h1>
			    <div class="sponsor"><?php //imo_dart_tag("240x60"); ?></div>
		
				<?php if (z_taxonomy_image_url()) echo '<div class="category-img"><img src="'.z_taxonomy_image_url().'" alt="'.single_cat_title( '', false ).'" title="'.single_cat_title( '', false ).'" /></div>'; ?>                    
	            <?php
	            	$category_description = category_description();
	                    if ( ! empty( $category_description ) )
	                        echo apply_filters( 'category_archive_meta', '<div data-position="' . $dataPos = $dataPos + 1 . '" class="category-archive-meta taxdescription js-responsive-section">' . $category_description . '</div>' );
	             ?>
	
			<?php } ?>
		</div><!-- .page-header -->

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
			            <?php } } ?>
						
			        <?php if ( (($i - (($paged -1) * 2 ))%6) == 0 ): ?>
			        	
			            <?php if ( mobile() ){ ?>
			            <div class="image-banner posts-image-banner">
			                <?php imo_dart_tag("300x250",array("pos"=>"mob")); ?> 
			            </div>
			            <?php } ?>
			        <?php endif;
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
						<!-- .entry-header -->
		    		
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
