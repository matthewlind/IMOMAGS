<?php
$dataPos = 0;
$playerID = get_option('home_player_id', false);
$playerKey = get_option('home_player_Key', false);
$camp = get_option('home_player_camp', false);
$videoTitle = get_option('video_title', false);
get_header(); ?>
	<?php imo_sidebar(); ?>
	<div id="primary" class="general">
        <div class="general-frame">
            <div id="content" role="main">
            <?php if ( is_home() ) : ?>

            	<?php $featured_query = new WP_Query( 'category_name=featured&posts_per_page=2' ); ?>
                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="featured-area clearfix js-responsive-section">
                    <!--<div class="general-title clearfix">
                        <h2>Featured</h2>
                    </div>-->
                    <div class="clearfix">
                        <ul>
                       	 	<?php if( function_exists('showFeaturedList') ){ echo showFeaturedPosts('1'); } ?>
                       	</ul>
                    </div>
                </div>
				<?php 
				//Shotgun news ad units
				//if( mobile() && function_exists('split_120_ad') ){ ?>
				<!--<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="js-responsive-section">-->
					<?php //split_120_ad(); ?>			
				<!--</div>-->
				<?php //} ?>
				<?php if( $playerID && $playerKey ){ ?>
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section">
					<div class="general-title clearfix">
		                <h2><?php echo $videoTitle; ?></h2>
		                <div class="sponsor"><?php echo get_imo_dart_tag("240x60",1,false,array("camp"=>"$camp")); ?></div>
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
		
				<?php if ( mobile() ){ get_sidebar("mobile"); } ?>
                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section main-content-preppend">
					<div class="general-title clearfix">
                        <h2>Latest</h2>
                    </div>
                    <div class="cross-site-feed" term=""></div>
                        <?php if ( (($i - (($paged -1) * 2 ))%6) == 0 ): ?>
                        <?php if ( mobile() ){ ?>
                        <div class="image-banner posts-image-banner">
                            <?php imo_dart_tag("300x250",array("pos"=>"mob")); ?> 
                        </div>
                        <?php } ?>
                    <?php endif;?>

                </div>
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
                    <a href="#" class="btn-base cross-site-feed-more-button">Load More</a>
                    <div class="next-link" style="display:none;"><?php next_posts_link(); ?></div>
                    <a href="#" class="go-top jq-go-top">go top</a>

                    <img src="/wp-content/themes/imo-mags-parent/images/ajax-loader.gif" id="ajax-loader" style="display:none;"/>
                </div>

                <?php sub_footer(); ?>
                <!-- end home page content-->
            <?php endif; // end have_posts() check ?>

            </div><!-- #content -->
        </div>
    </div><!-- #primary -->
	 <div id="site-feed" class="post article-brief clearfix" style="display:none;">
        <a href=""><img src="" class="attachment-list-thumb wp-post-image" alt="" /></a>
        <div class="article-holder">
            <div class="clearfix">
                <?php 
                    //if(function_exists('primary_and_secondary_categories')){
                    	//echo primary_and_secondary_categories(); 
                   // }                                
                ?>
                <span class="cat-feat-label"></span>
            </div>
            <h3 class="entry-title">
                <a href="" title="" rel="bookmark"></a>
            </h3>
            <!-- .entry-header -->
            <!--<a class="comment-count" href="<?php echo get_comments_link(); ?>"><?php echo get_comments_number(); ?></a>-->
            <div class="entry-content"></div><!-- .entry-content -->
        </div>
    </div><!-- #post -->


<?php get_footer(); ?>
