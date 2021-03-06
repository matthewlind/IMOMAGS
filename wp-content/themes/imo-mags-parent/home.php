<?php
$dataPos = 0;
$dartdomain = get_option('dart_domain', false);
$playerID = get_option('home_player_id', false);
$playerKey = get_option('home_player_Key', false);
$camp = get_option('home_player_camp', false);
$videoTitle = get_option('video_title', false);
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
	                                    	<?php if (in_category('sponsored', $feature->ID)) echo '<span class="is-sponsored">Sponsored</span>'; ?>
		                                </div>
		                                <div class="feat-sep"><div></div></div>
		                            </div>
		                         </li>
							<?php endforeach; ?>
                       	</ul>
                    </div>
                </div>
				<?php endif;
				if($dartdomain == "imo.in-fisherman"){ ?>
				<hr class="cfct-div-solid">
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header js-responsive-section fishhead-homepage">
					<div class="general-title clearfix">
						<h2 class="general-title">Fishhead Photos</h2>
		            </div>
		            <?php $lists_query = new WP_Query( 'post_type=fish_head_photos&posts_per_page=4' );
		            while ($lists_query->have_posts()) : $lists_query->the_post(); ?>
			        <div class="dif-post post">
						<div class="feat-img">
							<a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail("list-thumb"); ?></a>
		                     <?php if(in_category("master-angler")){ ?><span class="badge"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/pic/badge-ma.png" alt="Master Angler" /></span><?php } ?>
	                    </div>
					    <div class="dif-post-text">
					         <a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a>
					    </div>
					</div>

					<?php endwhile; ?>

					</div>
					<div class="fishhead-see-more">
						<a href="/photos/">See More Fishhead Photos<span></span></a>
					</div>
				
				
				<?php					
					$tvPost = new WP_Query(array( 
						'post_type' => 'post',
						'post_status' => 'publish',
					    'tax_query' => array(
						    array(
						      'taxonomy' => 'post_format',
						      'field' => 'slug',
						      'terms' => 'post-format-video'
						    )
						  ),
					    'showposts' => 1 
					)); 
					while ($tvPost->have_posts()) : $tvPost->the_post();
					$video_id = get_post_meta(get_the_ID(), '_video_id', TRUE);
					
					$idObj = get_category_by_slug('tv'); 
					$id = $idObj->term_id;
					$acfID = 'category_' . $id; 
				?>
				<div class="js-responsive-section">
					<div class="general-title clearfix">
		                <h2>In Fisherman TV</h2>
		            </div>
					<div id="when-to-watch">
						<div class="when-label">
							<h3>WHEN TO WATCH</h3>
							<a href="http://thesportsmanchannel.com" target="_blank"><img src="/wp-content/themes/imo-mags-parent/images/logos/sportsman-header-logo.jpg" alt="sc-logo" width="" height="" /></a>
						</div>
							<?php echo do_shortcode("[tscschedule format='singleshow' postid='1068']"); ?>	
						
						<a href="<?php echo get_field('remind_me',$acfID); ?>" class="remind-me show-btn" target="_blank">
							<span>REMIND ME TO WATCH</span>
						</a>
					</div><!-- end of #when-to-watch -->
					<!-- Start of Brightcove Player -->
					<div style="display:none"></div>

					<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>

					<object id="myExperience" class="BrightcoveExperience">
						<param name="bgcolor" value="#000000" />
						<param name="wmode" value="transparent">
						<param name="width" value="100%" />'
						<param name="height" value="350" />'
			    		<param name="quality" value="high">'
				  	    <param name="playerID" value="<?php echo get_field("tv_player_id","options"); ?>" />
				  	    <param name="isVid" value="true" />
					    <param name="isUI" value="true" />
					    <param name="dynamicStreaming" value="true" />
					    <param name="linkBaseURL" value="<?php echo get_the_permalink(); ?>" />
					    <param name="@videoPlayer" value="<?php echo $video_id; ?>" />
					</object>
					<script type="text/javascript">brightcove.createExperiences();</script>
					<!-- End of Brightcove Player -->
				</div>
				<div class="fishhead-see-more">
					<a href="/tv/">Watch More Videos<span></span></a>
				</div>
				<?php endwhile; ?> 
				
			
					<hr class="cfct-div-solid">
					<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
	                 	<div class="general-title clearfix">
						    <h2 class="general-title">Midwest Finesse</h2>
						</div>
						<div class="midwest-featured">
							<?php $lists_query = new WP_Query( 'category_name=midwest-finesse&posts_per_page=1' );
							while ($lists_query->have_posts()) : $lists_query->the_post(); ?>
						
							 	<li class="home-featured">
							        <div class="feat-post">
							            <div class="feat-img"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("list-thumb"); ?></a></div>
							            <div class="feat-text">
							            	<div class="clearfix">
							                	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							            	</div>
							            </div>
										<div class="feat-sep"><div></div></div>
								    </div>
							    </li>
							<?php endwhile; ?>
	                    </div>


	                    <div class="midwest-list">
		                    <div class="fancy">
								<ul>
									<?php $slug = 'featured';
									$category = get_category_by_slug($slug);
									$i = 0;
									$lists_query = new WP_Query( 'category_name=midwest-finesse&posts_per_page=8&offset=1' );
									
									while ($lists_query->have_posts()) : $lists_query->the_post(); ?>
										<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
									<?php $i++; endwhile; ?>
								</ul>
							</div>
							<hr class="cfct-div-solid">
							<a class="cta" href="/midwest-finesse/">See More Midwest Finesse<span></span></a>
	                    </div>
	                </div>
				<?php }else{ 
				
				
				if( $playerID && $playerKey ){ ?>
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section">
					<div class="general-title clearfix">
		                <h2><?php echo $videoTitle; ?></h2>
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
				<?php } 
					}
				?>
				
				<?php if ( mobile() ){ get_sidebar("mobile"); } ?>
                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section main-content-preppend">
					<!--<div class="general-title clearfix">
                        <h2>Popular</h2>
                    </div>-->
                    <?php
					$slug = 'featured';
					$category = get_category_by_slug($slug);
					
					$slug = 'bigger-bucks';
					$biggerBucks = get_category_by_slug($slug);
					
					$slug = 'deer-zone';
					$deerZone = get_category_by_slug($slug);
					
					$slug = 'rigged-ready';
					$riggedReady = get_category_by_slug($slug);
					
					$slug = 'wheels-afield';
					$wheelsAfield = get_category_by_slug($slug);
					
					$slug = 'gear-guide';
					$gearGuide = get_category_by_slug($slug);
					
					$slug = 'crossbow-revolution';
					$crossbowRev = get_category_by_slug($slug);

					$fslug = 'forecasts';
					$fcategory = get_category_by_slug($fslug);
					
					$deerForecasts = 'deer-forecast';
					$DFcategory = get_category_by_slug($deerForecasts);
					
					$tvslug = 'tv';
					$tvcategory = get_category_by_slug($tvslug);
					
					$Galleryslug = 'show-galleries';
					$Gallerycategory = get_category_by_slug($Galleryslug);		

					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $more_query = new WP_Query( 'post_type=post&posts_per_page=20&paged=' . $paged. '&cat=-' . $category->cat_ID.",-".$fcategory->cat_ID.",-".$DFcategory->cat_ID.",-".$Gallerycategory->cat_ID.",-".$tvcategory->cat_ID.",-".$riggedReady->cat_ID.",-".$gearGuide->cat_ID.",-".$wheelsAfield->cat_ID.",-".$crossbowRev->cat_ID.",-".$deerZone->cat_ID.",-".$biggerBucks->cat_ID );
                    //$i++;

                    while ($more_query->have_posts()) : $more_query->the_post(); ?>

                    <div class="<?php the_ID(); ?> post article-brief clearfix">
                        <!--<div class="posts-list-sep"><div class="bar"></div></div>-->
                        <a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('list-thumb');?></a>
                        <div class="article-holder">
                            <div class="clearfix">
                                <?php //if(function_exists('primary_and_secondary_categories')){echo primary_and_secondary_categories();} ?>
                            </div>
                            <h3 class="entry-title">
                                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
	                                 <?php 	
		                                $id = get_the_ID();
		                                $promo = get_field( "promo_title", $id );
		                       	 		if ($promo) {
	
		                       	 			$loopTitle = $promo;
		                       	 		}else{
			                       	 		$loopTitle = get_the_title();
		                       	 		}
	
		                               echo $loopTitle ?>                                
                                </a>
                            </h3>
                            <span>by <?php the_author(); ?></span><?php if (in_category("sponsored")) echo '<span class="sponsored-cat">&nbsp;&nbsp;|&nbsp;&nbsp;SPONSORED STORY</span>'; ?>
                            <!--<a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('list-thumb');?></a>-->
                            <!-- .entry-header -->
                            <!--<a class="comment-count" href="<?php echo get_comments_link(); ?>"><?php echo get_comments_number(); ?></a>-->
                            <div class="entry-content">
                                <?php the_excerpt(); ?>
                                <?php //the_content( __( 'more <span class="meta-nav">&raquo;</span>', 'twentytwelve' ) ); ?>
                                <?php wp_link_pages( array( 'before' => '<div class="page-links">' . 'Pages:', 'after' => '</div>' ) ); ?>
                            </div><!-- .entry-content -->
                        </div>
                    </div><!-- #post -->
                    <?php endwhile; ?>
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
        </div>
    </div><!-- #primary -->


<?php get_footer(); ?>