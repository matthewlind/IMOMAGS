<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
$postID = get_the_ID();
$byline = get_post_meta($postID, 'ecpt_byline', true);
?>
<div class='community-posts' style="background:#000;">
    <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section main-content-preppend">

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
		<span class="photoGalleryState"></span> <span class="photoGalleryCategory"></span>
	</div>
	<div id="photoGalleryBottomContent"></div>


		<?php
		/*
			$the_query = new WP_Query(
				array(
					'post_type' => array('reader_photos'),
					'category__and' => $termArray
				)
			);

			// The Loop
			if ( $the_query->have_posts() ) {

				$i = 1;
				while ( $the_query->have_posts() ) {
					$the_query->the_post();

	                get_template_part( 'content/content-reader_photos', get_post_format() );

	                $community_category = get_category( get_query_var( 'cat' ) );
	    			$community_cat = $community_category->slug;

					$i++;
				}

			} else {
				// no posts found
			}
			// Restore original Post Data
			wp_reset_postdata();

		*/

		?>



    </div>
</div>

<div class="community-pager" style="display: none;">

    <a href="" class="more btn-red">Load More</a>

</div>
<div id="post-<?php the_ID(); ?>" <?php post_class('full-post reader_photo-post'); ?> style="display: none;">
    <?php if ( is_single() ) : ?>
    <?php if (function_exists('primary_and_secondary_categories')){ echo primary_and_secondary_categories(); } ?>
    <div class="sponsor"><?php imo_ad_placement("sponsor_logo_240x60"); ?></div>
    <div class="post-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php else : ?>
        <h1 class="entry-title">
            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
        </h1>
        <?php endif; // is_single() ?>
        <div class="post-date"><?php the_time('F jS, Y'); ?>&nbsp;&nbsp;|&nbsp;&nbsp;</div>

		<?php if ( mobile() ){ ?>
			<div class="image-banner posts-image-banner">
				<?php imo_ad_placement("atf_medium_rectangle_300x250"); ?>
				<small>ADVERTISEMENT</small>
			</div>
		<?php } ?>
    </div>
    <div class="share-photo-now clearfix">
    	<div class="share-container">
        	<?php if( get_field("cc_sweeps_viral_msg_3","options") ){ ?><h2><?php echo get_field("cc_sweeps_viral_msg_3","options"); ?></h2><?php } ?>
        	<?php if(function_exists('wpsocialite_markup')){ wpsocialite_markup('button_override=facebook'); } ?>

    <?php $checked = get_field("cc_sweeps_viral_msg","options");
	if ($_GET['message'] == "share") { ?>
	    <div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
	        	<?php if( get_field("cc_sweeps_viral_msg_1","options") ){ ?><h2><?php echo get_field("cc_sweeps_viral_msg_1","options"); ?></h2>
	        	<div class="fb-share-button" data-href="<?php the_permalink(); ?>" data-type="button_count"></div><?php }
	 }
	 if ($checked){
	        	if( get_field("cc_sweeps_viral_msg_2","options") ){ ?><p><?php echo get_field("cc_sweeps_viral_msg_2","options"); ?></p><?php } } ?>
    	</div>
    </div>
    <!-- .entry-header -->
    <div class="entry-content-holder">
        <?php if ( is_search() ) : // Only display Excerpts for Search ?>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div><!-- .entry-summary -->
        <?php else : ?>
        <div class="entry-content">
            <?php echo get_the_post_thumbnail( $postID, "community-square-retina"); ?>
            <?php echo get_the_post_thumbnail( $postID, "legacy-thumb"); ?>
            <?php the_content( __( 'more <span class="meta-nav">&raquo;</span>', 'twentytwelve' ) ); ?>
			<!-- <ul>
                <li><b>Species: </b><?php echo $species; ?></li>
                <li><b>Taken At: </b><?php echo get_post_meta($postID,"camera_corner_taken",true); ?></li>
                <li><b>Taken On: </b><?php echo get_post_meta($postID,"camera_corner_when",true); ?></li>
                <li><b>With: </b><?php echo get_post_meta($postID,"camera_corner_who",true); ?></li>
            </ul> -->

            <?php wp_link_pages( array( 'before' => '<div class="page-links">' . 'Pages:', 'after' => '</div>' ) ); ?>
        </div><!-- .entry-content -->
        <?php endif; ?>

        <div class="article-brief">
        	<?php if(function_exists('wpsocialite_markup')){ wpsocialite_markup('button_override=facebook'); } ?>
	    </div>

        <?php the_widget('imo_related_footer_widget'); ?>

	    <?php imo_ad_placement("e_commerce_widget"); ?>

	    <?php if ( function_exists('yarpp_plugin_activate') ): ?>
		    <?php if ( isset_related_posts() ): ?>
			    <?php if(mobile() || tablet()){ ?>
			    	<h2 class="related-stories">Related Stories</h2>
			    <?php } ?>
			    <div class="paging-posts paging-single-post">
			        <div class="jq-single-paging-slider">
			        <?php related_posts(); ?>
			        </div>
			    </div>
		    <?php endif; ?>
	    <?php endif; ?>
		    <?php //sub_footer(); ?>
			<div class="hr mobile-element"></div>
	    <div class="entry-meta">
	        <?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>

	               </div><!-- .entry-meta -->
	</div><!-- #post -->
