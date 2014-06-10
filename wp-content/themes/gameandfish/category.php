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

$dataPos = 0;

$categoryID = get_query_var('cat');

$post_type = get_query_var('post_type');

$fullWidthImage = get_option('full_width_image_'.$categoryID, false);
$post_set_id = get_option('post_set_id_'.$categoryID, false);
$playerID = get_option('playerID_'.$categoryID, false);
$playerKey = get_option('playerKey_'.$categoryID, false);
$network_video_title = get_option('network_video_title_'.$categoryID, false);

$queried_object = get_queried_object(); 
$taxonomy = $queried_object->taxonomy;
$term_id = $queried_object->term_id;  
$features = get_field('featured_category_posts', $taxonomy . '_' . $term_id);

get_header();
if ($post_type == reader_photos) {
    get_template_part( 'nav', get_post_format() );
    echo '<div id="community-wrap">';
}else{
	imo_sidebar();
}


?>
        <div id="primary" class="general">
            <div id="content" role="main" class="general-frame">

				<?php if( $features ){ ?>
					<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="featured-area clearfix js-responsive-section">
			            <div class="clearfix">
			                <ul>
								<?php foreach( $features as $feature ): 
							    	$title = $feature->post_title;
							    	$url = $feature->guid;
							    	$tracking = "_gaq.push(['_trackEvent','Special Features $cat_name','$title','$url']);";
									$thumb = get_the_post_thumbnail($feature->ID,"list-thumb"); ?>
							    	<li class='home-featured'>
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

                   if ( have_posts() ) : ?>

                    <?php if ($post_type == reader_photos) : ?>
                        <?php get_template_part( 'content/content-category-reader_photos', get_post_format() ); ?>

                    <?php else : ?>
                        <?php get_template_part( 'content/content-category', get_post_format() ); ?>

                    <?php endif; ?>

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

                <?php endif; 

                if ($post_type != reader_photos){	
	                social_footer(); 
	                echo '<a href="#" class="back-top jq-go-top">back to top</a>';
				} ?>
            </div><!-- #content -->
        </div><!-- #primary -->
    <?php if ($post_type == reader_photos){	
    	imo_community_sidebar(); 
    	echo '</div>';
    } ?>
<?php get_footer(); ?>