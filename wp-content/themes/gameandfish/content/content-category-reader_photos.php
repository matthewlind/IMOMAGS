<?php
$cat = get_query_var('cat');
$category = get_category ($cat);
$catSlug = $category->slug;
?>
<div class='community-posts' style="background:#000;">
    <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section main-content-preppend" slug="<?php echo $catSlug; ?>">
    
    <?php if( mobile() ):?>
		<!-- <div id="state-menu-bar" class="btn-group btn-bar">
		    <button type="button" class="btn btn-default dropdown-toggle mobile" data-toggle="dropdown">
		    <span class="menu-title browse-community" style="text-transform:normal;">Browse by State</span> <span class="caret"></span>
		    </button>
		    <ul id="state-list-menu" class="dropdown-menu filter" role="menu"></ul>
		</div> -->
		
		<div id="state-menu-bar" class="btn-group btn-bar">
		    <button type="button" class="btn btn-default mobile">
		    <span class="menu-title browse-community" style="text-transform:normal;">Browse by State</span> <span class="caret"></span>
		    </button>
		    <ul id="state-list-menu" class="dropdown-menu filter"></ul>
		</div>
	<?php endif; ?>
	
	<div class="photos-title">
	    	<h2><?php echo ($category->name)? : 'All Photos'; ?></h2>
		<div class="state-header"></div>
    	</div>

    <div id="photoTopControls" class="desktop">
   		<div class="sliderPrev"></div>
		<div class="sliderNext"></div>
	</div>
	<div id="photoGalleryLike">
		<div class="photoGalleryLikeInner">
			<div class="photoGalleryLikeLeft">
				<?php if( get_field("cc_sweeps_viral_msg_3","options") ){ ?><h3><?php echo get_field("cc_sweeps_viral_msg_3","options"); ?></h3><?php } ?>
			</div>
			<div class="photoGalleryLikeRight"></div>
		</div>
	</div>
	<div id="photoGalleryBody">
		<div class="spinner">
			<img src="/wp-content/themes/gameandfish/images/spinner-black.gif" alt="" />
		</div>
		<!-- <div id="photoTopControls" class="mobile">
			<div class="sliderPrev"></div>
			<div class="sliderNext"></div>
		</div> -->
		<div id="photoSliderContainer">
			<!-- <div class="sliderPrev"></div> -->
			<div id="photoSlider" class="flexslider">
	    			<ul class="slides"></ul>
		    </div>
		    <!-- <div class="sliderNext"></div> -->
		</div>
		<div id="photoSliderThumbsContainer">
			<!-- <div class="sliderPrev"></div>
			<div id="photoSliderThumbs" class="flexslider">
		    		<ul class="slides"></ul>
		    </div>
		    <div class="sliderNext"></div> -->
		</div>
    </div>
    <div id="photoGalleryTitle">
    	<?php if( mobile() ) {
			$dartDomain = get_option("dart_domain", $default = false);
			echo '<iframe id="community-iframe-ad" class="mobile-gallery-ad" width="320" height="50" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad.php?size=320x50&ad_code='.$dartDomain.'"></iframe>'; 
		} ?>
		<h2><a href=""></a></h2>
		<span class="photoGalleryState"></span> <span class="photoGalleryCategory"></span> <span class="photoGalleryShare"><span class="fb-share-button" data-href="" data-title="" data-type="button_count"></span> <!--<span class="bookmark" value="">Copy share link</span>-->
	</div>
	<div id="photoGalleryBottomContent"></div>
	
    	<?php $i = 1; while ( have_posts() ) : the_post(); ?>

            <?php
                /* Include the Post-Format-specific template for the content.
                 * If you want to overload this in a child theme then include a file
                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                 */
               // get_template_part( 'content/content-reader_photos', get_post_format() );

                $community_category = get_category( get_query_var( 'cat' ) );
    			$community_cat = $community_category->slug;
            ?>

	<?php $i++; endwhile; ?>
        

    </div>
</div>

<div class="community-pager" style="display: none;">

    <a href="" class="more btn-red">Load More</a>

</div>
