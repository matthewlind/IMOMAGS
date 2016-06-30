<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
    <h1 class="page-title">
	<div class="icon"></div>
    <?php
        printf('<span>' . single_cat_title( '', false ) . '</span>' );
        ?>
    </h1>
    <div class="sponsor"><?php imo_ad_placement("sponsor"); ?></div>
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
<?php if( $post_set_id ){ ?>
<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="featured-area clearfix js-responsive-section">
    <div class="clearfix">
        <ul>
       	 	<?php if( function_exists('showFeaturedList') ){  echo showFeaturedPosts(array('set_id' => $post_set_id)); } ?>
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
            get_template_part( 'content/content', get_post_format() );

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

        <?php $i++; endwhile; ?>

</div>

<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
    <a href="#" class="btn-base">Load More</a>
    <div class="next-link" style="display:none;"><?php next_posts_link(); ?></div>
    <a href="#" class="go-top jq-go-top">go top</a>

    <img src="/wp-content/themes/imo-mags-parent/images/ajax-loader.gif" id="ajax-loader" style="display:none;"/>
</div>