<?php
$dataPos = 0;

$videoTitle = get_option('video_title', false);
$playerID = get_option('home_player_id', false);
$playerKey = get_option('home_player_Key', false);
$camp = get_option('home_player_camp', false);
$features = get_field('homepage_featured_stories','options' );
$lists = get_field('lists_homepage_featured','options' );

get_header(); ?>
	<?php imo_sidebar(); ?>
	<div id="primary" class="general">
        <div class="general-frame">
            <div id="content" role="main">
            <?php if ( is_home() ) :
				if( $features ): ?>
	                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="featured-area clearfix js-responsive-section">
	                    <div class="clearfix">
	                        <ul>
	                       	 	<?php foreach( $features as $feature ):
	                       	 		$title = $feature->post_title;

	                       	 		if ($feature->promo_title) {

	                       	 			$title = $feature->promo_title;
	                       	 		}

	                       	 		$url = $feature->guid;
									$thumb = get_the_post_thumbnail($feature->ID, "list-thumb");
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
                if( $playerID && $playerKey ){ ?>
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header js-responsive-section">
					<div class="section-title videos">
					    <h2>
					        <div class="icon"></div>
					        <span><?php echo $videoTitle; ?></span>
					    </h2>
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

                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
                 	<div class="section-title posts">
					    <h2>
					        <div class="icon"></div>
					        <span>The G&amp;A Lists</span>
					    </h2>
					</div>
					<?php if( $lists ): ?>
						  <div class="ga-lists-featured">
							  <?php foreach( $lists as $list ):
	                       	 		$title = $list->post_title;
	                       	 		$url = $list->guid;
									$thumb = get_the_post_thumbnail($list->ID, "list-thumb");
									$tracking = "_gaq.push(['_trackEvent','Special Features Homepage','$title','$url']);"; ?>
		                       	 	<li class="home-featured">
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
	                    </div>

					<?php endif; ?>

                    <div class="ga-lists-list">
	                    <div class="fancy">
							<ul>
								<?php $slug = 'featured';
								$category = get_category_by_slug($slug);

								$lists_query = new WP_Query( 'category_name=ga-lists&posts_per_page=8&cat=-' . $category->cat_ID );
								while ($lists_query->have_posts()) : $lists_query->the_post(); ?>
									<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
								<?php $i++; endwhile; ?>
							</ul>
						</div>
						<hr class="cfct-div-solid">
						<a class="cta" href="/ga-lists/">See More Lists<span></span></a>
                    </div>
                </div>

				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header loading-block js-responsive-section">
					<?php the_widget('imo\GAReviewWidget'); ?>
				</div>
				<?php if ( mobile() ){ get_sidebar("mobile"); } ?>
                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list page-header js-responsive-section main-content-preppend">
					<div class="section-title posts">
					    <h2>
					        <div class="icon"></div>
					            <span>Latest</span>
					    </h2>
					</div>

                    <?php
					$slug = 'featured';
					$category = get_category_by_slug($slug);

					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $more_query = new WP_Query( 'post_type=post&posts_per_page=20&paged=' . $paged. '&cat=-' . $category->cat_ID );

                    $i++;

                    while ($more_query->have_posts()) : $more_query->the_post(); ?>

	                    <div class="<?php the_ID(); ?> post article-brief clearfix">
	                        <!--<div class="posts-list-sep"><div class="bar"></div></div>-->
	                        <a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('list-thumb'); ?></a>
	                        <div class="article-holder">
	                            <div class="clearfix">
	                                <?php //if(function_exists('primary_and_secondary_categories')){echo primary_and_secondary_categories();} ?>
	                            </div>
	                            <h3 class="entry-title">
	                                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
	                            </h3>
	                            <span>by <?php the_author(); ?></span>
	                            <!--<a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('list-thumb');?></a>-->
	                            <!-- .entry-header -->
	                           <a class="comment-count" href="<?php echo get_comments_link(); ?>"><?php echo get_comments_number(); ?></a>
	                            <div class="entry-content">
	                                <?php the_excerpt(); ?>
	                                <?php //the_content( __( 'more <span class="meta-nav">&raquo;</span>', 'twentytwelve' ) ); ?>
	                                <?php wp_link_pages( array( 'before' => '<div class="page-links">' . 'Pages:', 'after' => '</div>' ) ); ?>
	                            </div><!-- .entry-content -->
	                        </div>
	                    </div><!-- #post -->

                    <?php if ( (($i - (($paged -1) * 2 ))%6) == 0 ): ?>
                        <?php if ( mobile() ){ ?>
                        <div class="image-banner posts-image-banner">
                            <?php imo_dart_tag("300x250",array("pos"=>"mob")); ?>
                        </div>
                        <?php } ?>
                    <?php endif;?>

                <?php $i++; endwhile; ?>
                </div>
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
                    <a href="#" class="btn-base">Load More</a>
                    <div class="next-link" style="display:none;"><?php next_posts_link(); ?></div>
                    <a href="#" class="go-top jq-go-top">go top</a>

                    <img src="/wp-content/themes/imo-mags-parent/images/ajax-loader.gif" id="ajax-loader" style="display:none;"/>
                </div>

                <?php sub_footer(); ?>
                <!-- end home page content-->
            <?php endif; // end have_posts() check ?>

            </div><!-- #content -->
        </div><!-- .general -->
    </div><!-- #primary -->


<?php get_footer(); ?>
