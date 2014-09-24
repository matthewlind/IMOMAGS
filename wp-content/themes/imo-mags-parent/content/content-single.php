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
$acf_byline = get_field("byline",$postID); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class('full-post'); ?>>
    <?php if ( is_single() ) : ?>
    <?php if (function_exists('primary_and_secondary_categories')){ echo primary_and_secondary_categories(); } ?>
    <div class="post-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php else : ?>
        <h1 class="entry-title">
            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
        </h1>
        <?php endif; // is_single()
        if(get_the_author() != "admin" && get_the_author() != "infisherman"){ ?>
        <em class="meta-date-author">by <span class="author-item"><?php the_author_link(); ?></span>
        &nbsp;&nbsp;|&nbsp;&nbsp;<?php } the_time('F jS, Y'); ?>
        <?php if($byline){ ?>&nbsp;&nbsp;|&nbsp;&nbsp;<span class="post-byline author-item"><?php echo $byline; ?></span><?php } ?>
        <?php if($acf_byline){ ?>&nbsp;&nbsp;|&nbsp;&nbsp;<span class="post-byline author-item"><?php echo $acf_byline; ?></span><?php } ?>
        </em>
        <a class="comment-count" href="<?php echo get_comments_link(); ?>"><?php echo get_comments_number(); ?></a>

    </div>
                        	
    <?php if ( mobile() ){ ?>
    <div class="image-banner posts-image-banner">
        <?php imo_ad_placement("atf_medium_rectangle_300x250"); ?>
        <small>ADVERTISEMENT</small>
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
        	    <div class="sponsor"><?php imo_ad_placement("sponsor_logo_240x60"); ?></div>

		<?php
	
			$video_id = get_post_meta(get_the_ID(), '_video_id', TRUE);
			$player_id = get_option("bc_player_id" );
			$player_key = get_option("bc_player_key");
			$adServerURL = "http://ad.doubleclick.net/pfadx/" .  get_option("dart_domain", _imo_dart_guess_domain())  ."/video";
			$video_link = !empty($the_ID) ? get_permalink($the_ID) :  site_url() . $_SERVER['REQUEST_URI']; 
			if($video_id){ ?>
				
					<!-- Start of Brightcove Player -->
			    	<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>
			    	<div id="player">
			    		<object id="myExperience" class="BrightcoveExperience">
				    		<param name="bgcolor" value="#FFFFFF" />
				    		<param name="width" value="640" />
				    		<param name="height" value="360" />
				    		<param name="playerID" value="<?php echo $player_id;?>" />
				    		<param name="playerKey" value="<?php echo $player_key; ?>" />
				    		<param name="isVid" value="true" /><param name="isUI" value="true" />
				    		<param name="dynamicStreaming" value="true" />
				    		<param name="linkBaseURL" value="<?php echo $video_link; ?>" />
				    		<param name="@videoPlayer" value="<?php echo $video_id; ?>" />
				    		<param name="adServerURL" value="<?php echo $adServerURL; ?>" />
				    		<param name="media_delivery" value="http" />
				    		<param name="wmode" value="transparent" />
			    		</object>
			    	    <script type="text/javascript">brightcove.createExperiences();</script>
	    	    </div>
            <?php }
            the_content( __( 'more <span class="meta-nav">&raquo;</span>', 'twentytwelve' ) ); ?>
                       
            <?php wp_link_pages( array( 'before' => '<div class="page-links">' . 'Pages:', 'after' => '</div>' ) ); ?>
        </div><!-- .entry-content -->
        <?php endif; ?>
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
		    <?php sub_footer(); ?> 
			<div class="hr mobile-element"></div>
	    <div class="entry-meta">
	        <?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
	       
	               </div><!-- .entry-meta -->
	</div><!-- #post -->