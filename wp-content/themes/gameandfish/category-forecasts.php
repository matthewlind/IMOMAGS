<?php
$dataPos = 0;
$categoryID = get_query_var('cat');
$fullWidthImage = get_option('full_width_image_'.$categoryID, false);
$post_set_id = get_option('post_set_id_'.$categoryID, false);
$playerID = get_option('playerID_'.$categoryID, false);
$playerKey = get_option('playerKey_'.$categoryID, false);
$network_video_title = get_option('network_video_title_'.$categoryID, false);
global $IMO_USER_STATE_NICENAME; 
if($_POST['state']){
	$state = get_the_category_by_ID($_POST['state']);
	$states = $_POST['state'];
}else{
	$state = $IMO_USER_STATE_NICENAME;
	$states = get_cat_ID( $state );
}
$forecasts = get_cat_ID('Forecasts');
get_header(); ?>
        <?php imo_sidebar(); ?>
        <div id="primary" class="general">
            <div id="content" role="main" class="general-frame">
                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
                    <h1 class="page-title">
					<div class="icon"></div>
                    <?php
                        printf('<span>' . $state . " " . single_cat_title( '', false ) . '</span>' );
                        ?>
                    </h1>
                    <div class="sponsor"><?php imo_ad_placement("sponsor_logo_240x60"); ?></div>
				</div>
                                            
                <?php 
                if(function_exists('z_taxonomy_image_url')){
                	if (z_taxonomy_image_url()) echo '<div class="category-img"><img src="'.z_taxonomy_image_url().'" alt="'.single_cat_title( '', false ).'" title="'.single_cat_title( '', false ).'" /></div>'; 
                } 
            	$category_description = category_description();
                    if ( ! empty( $category_description ) )
                        echo apply_filters( 'category_archive_meta', '<div data-position="' . $dataPos = $dataPos + 1 . '" class="category-archive-meta taxdescription js-responsive-section">' . $category_description . '</div>' );
                ?>

                <?php if( $post_set_id ){ ?>
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="featured-area clearfix js-responsive-section">
		            <div class="clearfix">
		                <ul>
		               	 	<?php if( function_exists('showFeaturedList') ){  echo showFeaturedPosts(array('set_id' => $post_set_id)); } ?>
		               	</ul>
		            </div>
		      
		        </div>
		
				<?php } 

                if( $playerID && $playerKey ){ ?>
					<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section">
						<div class="general-title clearfix">
			                <h2><?php echo $network_video_title; ?></h2>
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
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="forecast-filter clearfix js-responsive-section">
					<?php if($IMO_USER_STATE_NICENAME || $_POST['state']){ 
						echo '<h3>Filter Forecasts by State: </h3>'; 
					}else{ 
						echo '<h3 class="no-state-detection">CHOOSE A STATE TO VIEW FORECASTS: </h3>'; 
					} ?>
					<form action="" method="post">
						<select id="state" name="state" onchange="this.form.submit()">
							<option value=""><?php if($IMO_USER_STATE_NICENAME || $_POST['state']){ echo $state; }else{ echo 'SELECT STATE'; } ?></option>
							<option value="<?php $idObj = get_category_by_slug('alabama'); $id = $idObj->term_id; echo $id ?>">Alabama</option>
							<option value="<?php $idObj = get_category_by_slug('alaska'); $id = $idObj->term_id; echo $id ?>">Alaska</option>
							<option value="<?php $idObj = get_category_by_slug('arizona'); $id = $idObj->term_id; echo $id ?>">Arizona</option>
							<option value="<?php $idObj = get_category_by_slug('arkansas'); $id = $idObj->term_id; echo $id ?>">Arkansas</option>
							<option value="<?php $idObj = get_category_by_slug('california'); $id = $idObj->term_id; echo $id ?>">California</option>
							<option value="<?php $idObj = get_category_by_slug('colorado'); $id = $idObj->term_id; echo $id ?>">Colorado</option>
							<option value="<?php $idObj = get_category_by_slug('connecticut'); $id = $idObj->term_id; echo $id ?>">Connecticut</option>
							<option value="<?php $idObj = get_category_by_slug('delaware'); $id = $idObj->term_id; echo $id ?>">Delaware</option>
							<option value="<?php $idObj = get_category_by_slug('florida'); $id = $idObj->term_id; echo $id ?>">Florida</option>
							<option value="<?php $idObj = get_category_by_slug('georgia'); $id = $idObj->term_id; echo $id ?>">Georgia</option>
							<option value="<?php $idObj = get_category_by_slug('hawaii'); $id = $idObj->term_id; echo $id ?>">Hawaii</option>
							<option value="<?php $idObj = get_category_by_slug('idaho'); $id = $idObj->term_id; echo $id ?>">Idaho</option>
							<option value="<?php $idObj = get_category_by_slug('illinois'); $id = $idObj->term_id; echo $id ?>">Illinois</option>
							<option value="<?php $idObj = get_category_by_slug('indiana'); $id = $idObj->term_id; echo $id ?>">Indiana</option>
							<option value="<?php $idObj = get_category_by_slug('iowa'); $id = $idObj->term_id; echo $id ?>">Iowa</option>
							<option value="<?php $idObj = get_category_by_slug('kansas'); $id = $idObj->term_id; echo $id ?>">Kansas</option>
							<option value="<?php $idObj = get_category_by_slug('kentucky'); $id = $idObj->term_id; echo $id ?>">Kentucky</option>
							<option value="<?php $idObj = get_category_by_slug('louisiana'); $id = $idObj->term_id; echo $id ?>">Louisiana</option>
							<option value="<?php $idObj = get_category_by_slug('maine'); $id = $idObj->term_id; echo $id ?>">Maine</option>
							<option value="<?php $idObj = get_category_by_slug('maryland'); $id = $idObj->term_id; echo $id ?>">Maryland</option>
							<option value="<?php $idObj = get_category_by_slug('massachusetts'); $id = $idObj->term_id; echo $id ?>">Massachusetts</option>
							<option value="<?php $idObj = get_category_by_slug('michigan'); $id = $idObj->term_id; echo $id ?>">Michigan</option>
							<option value="<?php $idObj = get_category_by_slug('minnesota'); $id = $idObj->term_id; echo $id ?>">Minnesota</option>
							<option value="<?php $idObj = get_category_by_slug('mississippi'); $id = $idObj->term_id; echo $id ?>">Mississippi</option>
							<option value="<?php $idObj = get_category_by_slug('missouri'); $id = $idObj->term_id; echo $id ?>">Missouri</option>
							<option value="<?php $idObj = get_category_by_slug('montana'); $id = $idObj->term_id; echo $id ?>">Montana</option>
							<option value="<?php $idObj = get_category_by_slug('nebraska'); $id = $idObj->term_id; echo $id ?>">Nebraska</option>
							<option value="<?php $idObj = get_category_by_slug('nevada'); $id = $idObj->term_id; echo $id ?>">Nevada</option>
							<option value="<?php $idObj = get_category_by_slug('new-hampshire'); $id = $idObj->term_id; echo $id ?>">New Hampshire</option>
							<option value="<?php $idObj = get_category_by_slug('new-jersey'); $id = $idObj->term_id; echo $id ?>">New Jersey</option>
							<option value="<?php $idObj = get_category_by_slug('new-mexico'); $id = $idObj->term_id; echo $id ?>">New Mexico</option>
							<option value="<?php $idObj = get_category_by_slug('new-york'); $id = $idObj->term_id; echo $id ?>">New York</option>
							<option value="<?php $idObj = get_category_by_slug('north-carolina'); $id = $idObj->term_id; echo $id ?>">North Carolina</option>
							<option value="<?php $idObj = get_category_by_slug('north-dakota'); $id = $idObj->term_id; echo $id ?>">North Dakota</option>
							<option value="<?php $idObj = get_category_by_slug('ohio'); $id = $idObj->term_id; echo $id ?>">Ohio</option>
							<option value="<?php $idObj = get_category_by_slug('oklahoma'); $id = $idObj->term_id; echo $id ?>">Oklahoma</option>
							<option value="<?php $idObj = get_category_by_slug('oregon'); $id = $idObj->term_id; echo $id ?>">Oregon</option>
							<option value="<?php $idObj = get_category_by_slug('pennsylvania'); $id = $idObj->term_id; echo $id ?>">Pennsylvania</option>
							<option value="<?php $idObj = get_category_by_slug('rhode-island'); $id = $idObj->term_id; echo $id ?>">Rhode Island</option>
							<option value="<?php $idObj = get_category_by_slug('south-carolina'); $id = $idObj->term_id; echo $id ?>">South Carolina</option>
							<option value="<?php $idObj = get_category_by_slug('south-dakota'); $id = $idObj->term_id; echo $id ?>">South Dakota</option>
							<option value="<?php $idObj = get_category_by_slug('tennessee'); $id = $idObj->term_id; echo $id ?>">Tennessee</option>
							<option value="<?php $idObj = get_category_by_slug('texas'); $id = $idObj->term_id; echo $id ?>">Texas</option>
							<option value="<?php $idObj = get_category_by_slug('utah'); $id = $idObj->term_id; echo $id ?>">Utah</option>
							<option value="<?php $idObj = get_category_by_slug('vermont'); $id = $idObj->term_id; echo $id ?>">Vermont</option>
							<option value="<?php $idObj = get_category_by_slug('virginia'); $id = $idObj->term_id; echo $id ?>">Virginia</option>
							<option value="<?php $idObj = get_category_by_slug('washington'); $id = $idObj->term_id; echo $id ?>">Washington</option>
							<option value="<?php $idObj = get_category_by_slug('west-virginia'); $id = $idObj->term_id; echo $id ?>">West Virginia</option>
							<option value="<?php $idObj = get_category_by_slug('wisconsin'); $id = $idObj->term_id; echo $id ?>">Wisconsin</option>
							<option value="<?php $idObj = get_category_by_slug('wyoming'); $id = $idObj->term_id; echo $id ?>">Wyoming</option>
						</select>
					</form>
				</div>
                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section">
                	<?php $i = 1; 					
					$query = new WP_Query(  array( "posts_per_page" => 999, "category__and" => array($forecasts,$states) )  );
					if ( $query->have_posts() ) : 
						while ($query->have_posts()) : $query->the_post(); ?>	 	
						
							<div class="article-brief clearfix">				
					            <a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('list-thumb');?></a>
					            <div class="article-holder">
					                <h3 class="entry-title">
					                    <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
					                </h3>
					                <!-- .entry-header -->
					                <a class="comment-count" href="<?php echo get_comments_link(); ?>"><?php echo get_comments_number(); ?></a>
					                <div class="entry-content">
					                    <?php the_excerpt(); ?>
					                </div><!-- .entry-content -->
								</div>
							</div>
						    <?php if ( (($i - (($paged -1) * 2 ))%6) == 0 ): ?>
		                    	
		                        <?php if ( mobile() ){ ?>
		                        <div class="image-banner posts-image-banner">
		                            <?php imo_ad_placement("atf_medium_rectangle_300x250"); ?>	 
		                        </div>
		                        <?php } 
		                    endif; 
		                    $i++; 
		                endwhile;
					else : 
						if($IMO_USER_STATE_NICENAME || $_POST['state']){ ?>
							<h2>There are no current forecasts for <?php echo $state; ?>. Please choose another state.</h2>
						<?php }
					endif; ?>
		        </div>
                
				<?php if($IMO_USER_STATE_NICENAME || $_POST['state']){ ?>
                    <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
                        <a href="#" class="go-top jq-go-top">go top</a>
                    </div>
					<?php social_footer(); ?>
					<a href="#" class="back-top jq-go-top">back to top</a>
				<?php } ?>
            </div><!-- #content -->
        </div><!-- #primary -->
<?php get_footer(); ?>