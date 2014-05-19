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

<<<<<<< HEAD
<style type="text/css" media="screen">
	.flex-direction-nav{
		display:none;
	}
	
	#photoTopControls .sliderPrev{
		display: inline-block;
		width: 33px;
		height: 46px;
		border-radius:3px;
		border:1px solid #5A5A5A;
		cursor:pointer;
		background: #5A5A5A url('http://www.gameandfishmag.com/wp-content/plugins/imo-flex-gallery/img/imo-flex-next-prev.png') no-repeat -3px 9px !important;
	}
	
	#photoTopControls .sliderNext{
		display: inline-block;
		width: 33px;
		height: 46px;
		border-radius:3px;
		border:1px solid #5A5A5A;
		cursor:pointer;
		background: #5A5A5A url('http://www.gameandfishmag.com/wp-content/plugins/imo-flex-gallery/img/imo-flex-next-prev.png') no-repeat -43px 9px !important;
	}
	
	.flex-slide img {
		position: relative;
		display: inline !important;
		max-width: 99.5%;
		width: auto;
		height: auto !important;
		max-height: 435px;
		vertical-align: middle;
	}
	
	#photoAlbumGallery #carousel .slides img{
		width:75px !important;
	}
	
	#photoAlbumGallery .the_slide{
		text-align:center;
	}
	
	#photoAlbumGallery .flex-slide img{
		width:auto !important;
	}
</style>
=======
<div id="post-<?php the_ID(); ?>" <?php post_class('full-post'); ?>>
    <?php if ( is_single() ) : ?>
    <?php if (function_exists('primary_and_secondary_categories')){ echo primary_and_secondary_categories(); } ?>
    <div class="sponsor"><?php imo_dart_tag("240x60"); ?></div>
    <div class="post-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php else : ?>
        <h1 class="entry-title">
            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
        </h1>
        <?php endif; // is_single() ?>
        <div class="post-date"><?php the_time('F jS, Y'); ?>&nbsp;&nbsp;|&nbsp;&nbsp;</div>
        <?php if(function_exists('wpsocialite_markup')){ wpsocialite_markup('button_override=facebook'); } ?>
>>>>>>> 0891535794e2cfca5412b75e0961eb826971ed7e

<div class="spinner">
  <h2>Loading, Please Wait.</h2>
</div>
<div id="photoTopControls" style="text-align: right;">
	<div class="sliderPrev"></div>
	<div class="sliderNext"></div>
</div>
<div>
  Like Goes Here
</div><div id="photoAlbumGallery">
	<div id="slider" class="flexslider">
		<ul class="slides"></ul>
	</div>
<<<<<<< HEAD
	
	<div id="carousel" class="flexslider">
		<ul class="slides"></ul>
	</div>
</div>
=======

    <?php if ( mobile() ){ ?>
    <div class="image-banner posts-image-banner">
        <?php imo_dart_tag("300x250",array("pos"=>"mob")); ?>
        <small>ADVERTISEMENT</small>
    </div>
    <?php } ?>

    <?php $checked = get_field("cc_sweeps_viral_msg","options");
	if ($_GET['message'] == "share" && $checked) { ?>
	    <div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
	    <div class="share-photo-now clearfix">
	    	<div class="share-container">
	        	<?php if( get_field("cc_sweeps_viral_msg_1","options") ){ ?><h2><?php echo get_field("cc_sweeps_viral_msg_1","options"); ?></h2>
	        	<div class="fb-share-button" data-href="<?php the_permalink(); ?>" data-type="button_count"></div><?php } ?>
	        	<?php if( get_field("cc_sweeps_viral_msg_2","options") ){ ?><p><?php echo get_field("cc_sweeps_viral_msg_2","options"); ?></p><?php } ?>
	        	<?php if( get_field("cc_sweeps_viral_img","options") ){ ?><img src="<?php echo get_field("cc_sweeps_viral_img","options"); ?>" alt="Camera Corner Sweeps" title="Camera Corner Sweeps" /><?php } ?>
	    	</div>
	    </div>
    <?php } ?>
    <!-- .entry-header -->
    <div class="entry-content-holder">
        <?php if ( is_search() ) : // Only display Excerpts for Search ?>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div><!-- .entry-summary -->
        <?php else : ?>
        <div class="entry-content">
            <?php echo get_the_post_thumbnail( $postID, "large"); ?>
            <?php the_content( __( 'more <span class="meta-nav">&raquo;</span>', 'twentytwelve' ) ); ?>
			<ul>
                <!-- <li><b>Species: </b><?php echo $species; ?></li> -->
                <li><b>Taken At: </b><?php echo get_post_meta($postID,"camera_corner_taken",true); ?></li>
                <li><b>Taken On: </b><?php echo get_post_meta($postID,"camera_corner_when",true); ?></li>
                <li><b>With: </b><?php echo get_post_meta($postID,"camera_corner_who",true); ?></li>
            </ul>

            <?php wp_link_pages( array( 'before' => '<div class="page-links">' . 'Pages:', 'after' => '</div>' ) ); ?>
        </div><!-- .entry-content -->
        <?php endif; ?>

         <div class="article-brief">
         	<?php if(function_exists('wpsocialite_markup')){ wpsocialite_markup(); } ?>
	    </div>

        <?php the_widget('imo_related_footer_widget'); ?>

	    <?php imo_dart_tag("564x252"); ?>

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
>>>>>>> 0891535794e2cfca5412b75e0961eb826971ed7e
