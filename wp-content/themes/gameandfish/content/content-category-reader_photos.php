<?php
$cat = get_query_var('cat');
$category = get_category ($cat);
$catSlug = $category->slug;
?>
<div class='community-posts' style="background:#000;">
    <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section main-content-preppend" slug="<?php echo $catSlug; ?>">
    
    <style type="text/css" media="screen">
    		.flex-direction-nav .flex-next, .flex-direction-nav .flex-prev{
			display:none;
		}
    </style>
    
    <div id="photoTopControls">
		<div class="sliderPrev"></div>
		<div class="sliderNext"></div>
	</div>
	<div id="photoGalleryLike">
		<div class="photoGalleryLikeInner">
			<div class="photoGalleryLikeLeft">
				<h3>Think this photo deserves more views? Like it!</h3>
			</div>
			<div class="photoGalleryLikeRight"></div>
		</div>
	</div>
	<div id="photoGalleryBody">
		<div class="spinner">
			<img src="wp-content/themes/gameandfish/images/spinner-black.gif" alt="" />
		</div>
		<div id="photoSlider" class="flexslider">
    			<ul class="slides"></ul>
	    </div>
	    <div id="photoSliderThumbs" class="flexslider">
	    		<ul class="slides"></ul>
	    </div>
    </div>
    <div id="photoGalleryTitle">
		<h2></h2>
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


        <?php if ( (($i - (($paged -1) * 2 ))%6) == 0 ): ?>

            <?php if ( mobile() ){ ?>
            <div class="image-banner posts-image-banner">
                <?php imo_dart_tag("300x250",array("pos"=>"mob")); ?>
            </div>
            <?php } ?>
        <?php endif;?>

        <?php $i++; endwhile; ?>
        

    </div>
</div>

<div class="community-pager" style="display: none;">

    <a href="" class="more btn-red">Load More</a>

</div>
