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
$dartDomain = get_option("dart_domain", $default = false);
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('full-post'); ?>>
    <?php if ( is_single() ) : ?>
    
	<span class="cat-feat-label">
	    <?php
		$categories = get_the_category();
		$separator = ' ';
		$output = '';
		if($dartDomain == "imo.hunting"){
			$photosURL = "/rack-room?";
		}else{
			$photosURL = "/photos?";
		}
		
		
		if($categories){
			foreach($categories as $category) {
				$tracking = "_gaq.push(['_trackEvent','Category','".$category->cat_name."']);";
				$output .= '<a class="category-name-link" onclick="'.$tracking.'" href="'.$photosURL.$category->slug.'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
			}
		echo trim($output, $separator);
		}
		?>
	</span>
    <div class="sponsor"><?php imo_ad_placement("sponsor"); ?></div>
    <div class="post-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php else : ?>
        <h1 class="entry-title">
            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
        </h1>
        <?php endif; // is_single() ?>
        
        <div class="post-date"><?php the_time('F jS, Y'); ?></div>
        


		<?php if ( mobile() ){ ?>
			<div class="image-banner posts-image-banner">
				<?php imo_ad_placement("300_atf"); ?>
				<small>ADVERTISEMENT</small>
			</div>
		<?php } ?>
    </div>
    <?php if ($_GET['message'] == "share") { ?>
	    <div class="share-photo-now clearfix">
	    	<div class="share-container">
	        	<h2>Like this photo on Facebook!</h2>
	        	<?php if(function_exists('wpsocialite_markup')){ wpsocialite_markup('button_override=facebook'); } ?>
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
            <?php the_content( __( 'more <span class="meta-nav">&raquo;</span>', 'twentytwelve' ) );
            
            if(get_post_meta($postID,"camera_corner_taken",true)){ ?>
				<ul>
	                <li><b>Taken At: </b><?php echo get_post_meta($postID,"camera_corner_taken",true); ?></li>
	                <li><b>Taken On: </b><?php echo get_post_meta($postID,"camera_corner_when",true); ?></li>
	                <li><b>With: </b><?php echo get_post_meta($postID,"camera_corner_who",true); ?></li>
	            </ul> 
			<?php } ?>
			
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