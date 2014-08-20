<?php
$dataPos = 0;
$features = get_field('homepage_featured_stories','options' );
get_header(); ?>
	<?php imo_sidebar(); ?>
	<div id="primary" class="general">
        <div class="general-frame">
            <div id="content" role="main">
            <?php if ( is_home() ) : ?>
               <?php if( $features ): ?>
	                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="featured-area clearfix js-responsive-section">
	                    <!--<div class="general-title clearfix">
	                        <h2>Featured</h2>
	                    </div>-->
	                    <div class="clearfix">
	                        <ul>
								<?php foreach( $features as $feature ):
	                       	 		$title = $feature->post_title;
	
	
	                       	 		if ($feature->promo_title) {
	
	                       	 			$title = $feature->promo_title;
	                       	 		}
	
	
	                       	 		$url = $feature->guid;
									$thumb = get_the_post_thumbnail($feature->ID,"list-thumb");
									$tracking = "_gaq.push(['_trackEvent','Special Features Homepage','$title','$url']);"; ?>
		                       	 	<li class="home-featured" featured_id="<?php echo $feature->ID ?>">
		                                <div class="feat-post">
		                                    <div class="feat-img"><a href="<?php echo $url; ?>" onclick="<?php echo $tracking; ?>"><?php echo $thumb; ?></a></div>
		                                    <div class="feat-text">
		                                    	<div class="clearfix">
			                                    	<h3><a href="<?php echo $url; ?>" onclick="<?php echo $tracking; ?>"><?php echo $title; ?></a></h3>
		                                    	</div>
			                                </div>
			                                <div class="feat-sep"><div></div></div>
			                            </div>
			                         </li>
								<?php endforeach; ?>
	                       	</ul>
	                    </div>
	                </div>
				<?php endif;                
                if(mobile()){ ?>
	                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="js-responsive-section">
						<?php the_widget( 'Community_Slider' ); ?>
					</div>
				<?php } ?>
                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="video-box js-responsive-section">
                    <div class="general-title clearfix">
                        <h2>In-Fisherman <span>TV</span></h2>
                        <div class="sponsor"><?php //imo_dart_tag("240x60"); ?></div>
                    </div>
                    <script type="text/javascript">
                      // resizing function - newWidth is percentage of content width as a decimal value
				      var BCL = {};
				      BCL.currentPlayerWidth = 1;
				      var $BCLbodyContent = jQuery('#BCLbodyContent');
				      var $BCLvideoWrapper = jQuery('.BCLvideoWrapper');
				      var $BCLcontainingBlock = jQuery('#BCLcontainingBlock');

				      // resizing function - newWidth is percentage of content width as a decimal value
					  BCL.resizePlayer = function(newWidth) {
					  var $BCLcontainingBlock = jQuery('#BCLcontainingBlock');
					  $BCLcontainingBlock.width(jQuery('#BCLbodyContent').width() * newWidth);
					  BCL.experienceModule.setSize($BCLcontainingBlock.width(),$BCLcontainingBlock.height());
					  BCL.currentPlayerWidth = newWidth;
					  }

					</script>
                    <div class="video-inner">
                        <div id="BCLcontainingBlock">
                             <div class="BCLvideoWrapper">
                               <!-- Start of Brightcove Player -->

								<div style="display:none">

								</div>

								<!--
								By use of this code snippet, I agree to the Brightcove Publisher T and C
								found at https://accounts.brightcove.com/en/terms-and-conditions/.
								-->

								<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>

								<object id="myExperience" class="BrightcoveExperience">
								  <param name="bgcolor" value="#FFFFFF" />
								  <param name="width" value="480" />
								  <param name="height" value="628" />
								  <param name="playerID" value="2568027916001" />
								  <param name="playerKey" value="AQ~~,AAAA-01d-uE~,FiwRPPEEyN6J4wQRpEDgtXFI2RXzS-Wu" />
								  <param name="isVid" value="true" />
								  <param name="isUI" value="true" />
								  <param name="dynamicStreaming" value="true" />

								</object>

								<!--
								This script tag will cause the Brightcove Players defined above it to be created as soon
								as the line is read by the browser. If you wish to have the player instantiated only after
								the rest of the HTML is processed and the page load is complete, remove the line.
								-->
								<script type="text/javascript" src="http://admin.brightcove.com/js/api/SmartPlayerAPI.js"></script>
								<script type="text/javascript">brightcove.createExperiences();</script>

								<!-- End of Brightcove Player -->
								</div>
                          </div>
                    </div>
                    <div class="video-panel clearfix">
                        <a href="/in-fisherman-tv/" class="see-all">See All Video </a>
                    </div>
                </div>

                <?php $fetured_slider_query = new WP_Query( 'category_name='.TIMELY_FEATURES.'&posts_per_page=8' ); ?>
                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="double-posts double-post-slider loading-block js-responsive-section">
                    <div class="general-title clearfix">
                        <h2>Timely <span>Features</span></h2>
                    </div>
	                    <div class="jq-slider onload-hidden clearfix">
	                        <ul class="slides-inner slides">
	                            <?php $i = 1;  ?>
	                            <?php while ($fetured_slider_query->have_posts()) : $fetured_slider_query->the_post(); ?>

	                            <?php if (!(($i+1)%2) ): ?>
	                            <li>
	                            <?php endif; ?>

	                            <div class="feat-post">
	                                <div class="feat-img"><a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('post-home-small-thumb');?></a></div>
	                                <div class="feat-text">
	                                    <div class="clearfix">
	                                    	<?php echo primary_and_secondary_categories(); ?>
	                                    </div>
	                                    <h3><a href="<?php the_permalink(); ?>" ><?php $title = the_title('','',FALSE); echo substr($title, 0, 54); if (strlen($title) > 54) echo "..."; ?></a></h3>
	                                    <!--<div class="shares-count">
	                                        <?php //render_shares_count(get_permalink(), $post->ID) ?> <span>Shares</span>
	                                    </div>
	                                    <a class="view-post" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">&nbsp;</a>-->
	                                </div>
	                            </div>

	                            <?php if (!($i%2)): ?>
	                            </li>
	                            <?php endif; ?>

	                            <?php $i++; ?>
	                            <?php endwhile; ?>
	                        </ul>
	                    </div>
                </div>

				<?php $fetured_slider_query = new WP_Query( 'category_name=online-exclusives&posts_per_page=8' ); ?>
                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="double-posts double-post-slider js-responsive-section">
                    <div class="general-title clearfix">
                        <h2>Online <span>Exclusives</span></h2>
                    </div>
                    <div class="jq-slider clearfix">
                        <ul class="slides-inner slides">
                            <?php $i = 1  ?>
                            <?php while ($fetured_slider_query->have_posts()) : $fetured_slider_query->the_post(); ?>

                            <?php if (!(($i+1)%2) ): ?>
                            <li>
                            <?php endif; ?>

                            <div class="feat-post">
                                <div class="feat-img"><a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('post-home-small-thumb');?></a></div>
                                <div class="feat-text">
                                    <div class="clearfix">
                                    	<?php echo primary_and_secondary_categories(); ?>
                                    </div>
                                    <h3><a href="<?php the_permalink(); ?>" ><?php $title = the_title('','',FALSE); echo substr($title, 0, 54); if (strlen($title) > 54) echo "..."; ?></a></h3>
                                    <!--<div class="shares-count">
                                        <?php //render_shares_count(get_permalink(), $post->ID) ?> <span>Shares</span>
                                    </div>
                                    <a class="view-post" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">&nbsp;</a>-->
                                </div>
                            </div>

                            <?php if (!($i%2)): ?>
                            </li>
                            <?php endif; ?>

                            <?php $i++; ?>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>

                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="ma-section clearfix js-responsive-section">
                    <div class="general-title clearfix">
                        <h2>Master <span>Anglers</span></h2>
                    </div>
                    <?php $hostname = $_SERVER['SERVER_NAME'];
					$jsonData = file_get_contents('http://'.$hostname.'/community-api/posts?master=1&per_page=10&sort=DESC');
					$pictures = json_decode($jsonData); ?>
                    <div class="clearfix">
                        <div class="master-angler-banner">	
                        	<div class="master-angler-copy">
	                            <p>Submit your trophy catch for a chance to win!</p>
	                            <a href="/photos/new#master" class="btn-base btn-base-middle">Enter Now!</a>
                        	</div>
                        </div>
                        <div class="single-post-slider loading-block">
							<div class="jq-slider onload-hidden">
                                <ul class="slides-inner slides">
                                   <?php foreach ($pictures as $picture) { ?>
								   <li>
                                        <div class="feat-post">
                                            <div class="feat-img"><a href="/photos/<?php echo $picture->id; ?>" ><img src="<?php echo $picture->img_url; ?>/convert?w=335&h=225&fit=crop&rotate=exif" alt="<?php echo $picture->title; ?>" /></a></div>
                                            <div class="feat-text">
                                                <h3><a href="/photos/<?php echo $picture->id; ?>" ><?php echo $picture->title; ?></a></h3>

                                               <!--<div class="shares-count">
                                                    <?php render_shares_count(get_permalink(), $picture->id) ?> <span>Shares</span>
                                                </div>
                                                <a class="view-post" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">&nbsp;</a>
                                            </div>-->
                                        </div>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="post-panel clearfix">
                                <a class="see-all" href="/master-angler/">See All </a>
                            </div>
                        </div>

                    </div>
                </div>


                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section">
                    <div class="general-title clearfix">
                        <h2><span>Popular</span></h2>
                    </div>
                    <?php $more_query = get_more_posts_query(); ?>
                    <?php while ($more_query->have_posts()) : $more_query->the_post(); ?>

                    <div class="article-brief clearfix">
                        <a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('index-thumb');?></a>
                        <div class="article-holder">
                            <div class="clearfix">
                                <?php echo primary_and_secondary_categories(); ?>
                            </div>
                            <h3 class="entry-title">
                                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                            </h3>
                            <!-- .entry-header -->
                            <a class="comment-count" href="<?php echo get_comments_link(); ?>"><?php echo get_comments_number(); ?></a>
                            <div class="entry-content">
                                <?php the_excerpt(); ?>
                                <?php //the_content( __( 'more <span class="meta-nav">&raquo;</span>', 'twentytwelve' ) ); ?>
                                <?php wp_link_pages( array( 'before' => '<div class="page-links">' . 'Pages:', 'after' => '</div>' ) ); ?>
                            </div><!-- .entry-content -->
                        </div>
                    </div><!-- #post -->
                    <?php endwhile; ?>
                </div>

                <!-- start footer posts -->
                <div class="links-holder">
                    <div class="image-banner">
                     <?php if (mobile()) {
	                 	imo_ad_placement("atf_medium_rectangle_300x250");
	                 } ?>
                    </div>
                    <div>
                        <div class="links-section">
                            <div class="links-column">
                               <?php $footer_query = new WP_Query( 'category_name='.CATFISH.'&posts_per_page=3' ); ?>
                               <h4><?php echo get_category_title_by_slug(CATFISH); ?></h4>
                               <ul class="links-list">
                                    <?php while ($footer_query->have_posts()) : $footer_query->the_post(); ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'infisherman' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                                    </li><!-- #post -->
                                    <?php endwhile; ?>
                               </ul>
                            </div>
                            <div class="links-column">
                                <?php $footer_query = new WP_Query( 'category_name='.ICE_FISHING.'&posts_per_page=3' ); ?>
                                <h4><?php echo get_category_title_by_slug(ICE_FISHING); ?></h4>
                                <ul class="links-list">
                                    <?php while ($footer_query->have_posts()) : $footer_query->the_post(); ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'infisherman' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                                    </li><!-- #post -->
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                            <div class="links-column">
                                <?php $footer_query = new WP_Query( 'category_name='.TRTUT_SALMON.'&posts_per_page=3' ); ?>
                                <h4><?php echo get_category_title_by_slug(TRTUT_SALMON); ?></h4>
                                <ul class="links-list">
                                    <?php while ($footer_query->have_posts()) : $footer_query->the_post(); ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'infisherman' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                                    </li><!-- #post -->
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="links-section">
                            <div class="links-column">
                                <?php $footer_query = new WP_Query( 'category_name='.PANFISH.'&posts_per_page=3' ); ?>
                                <h4><?php echo get_category_title_by_slug(PANFISH); ?></h4>
                                <ul class="links-list">
                                    <?php while ($footer_query->have_posts()) : $footer_query->the_post(); ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'infisherman' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                                    </li><!-- #post -->
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                            <div class="links-column">
                                <?php $footer_query = new WP_Query( 'category_name='.MASTER_ANGLERS.'&posts_per_page=3' ); ?>
                                <h4><?php echo get_category_title_by_slug(MASTER_ANGLERS); ?></h4>
                                <ul class="links-list">
                                    <?php while ($footer_query->have_posts()) : $footer_query->the_post(); ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'infisherman' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                                    </li><!-- #post -->
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                            <div class="links-column">
                                <?php $footer_query = new WP_Query( 'category_name='.WALLEYE.'&posts_per_page=3' ); ?>
                                <h4><?php echo get_category_title_by_slug(WALLEYE); ?></h4>
                                <ul class="links-list">
                                    <?php while ($footer_query->have_posts()) : $footer_query->the_post(); ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'infisherman' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                                    </li><!-- #post -->
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end footer posts -->
                <?php sub_footer(); ?>
                <!-- end home page content-->
            <?php endif; // end have_posts() check ?>

            </div><!-- #content -->
        </div>
    </div><!-- #primary -->


<?php get_footer(); ?>
