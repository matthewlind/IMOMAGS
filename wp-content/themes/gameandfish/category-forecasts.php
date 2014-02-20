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
                    <div class="sponsor"><?php imo_dart_tag("240x60"); ?></div>
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
							<option value="<?php echo get_cat_ID( "Alabama" ); ?>">Alabama</option>
							<option value="<?php echo get_cat_ID( "Alaska" ); ?>">Alaska</option>
							<option value="<?php echo get_cat_ID( "Arizona" ); ?>">Arizona</option>
							<option value="<?php echo get_cat_ID( "Arkansas" ); ?>">Arkansas</option>
							<option value="<?php echo get_cat_ID( "California" ); ?>">California</option>
							<option value="<?php echo get_cat_ID( "Colorado" ); ?>">Colorado</option>
							<option value="<?php echo get_cat_ID( "Connecticut" ); ?>">Connecticut</option>
							<option value="<?php echo get_cat_ID( "Delaware" ); ?>">Delaware</option>
							<option value="<?php echo get_cat_ID( "Florida" ); ?>">Florida</option>
							<option value="<?php echo get_cat_ID( "Georgia" ); ?>">Georgia</option>
							<option value="<?php echo get_cat_ID( "Hawaii" ); ?>">Hawaii</option>
							<option value="<?php echo get_cat_ID( "Idaho" ); ?>">Idaho</option>
							<option value="<?php echo get_cat_ID( "Illinois" ); ?>">Illinois</option>
							<option value="<?php echo get_cat_ID( "Indiana" ); ?>">Indiana</option>
							<option value="<?php echo get_cat_ID( "Iowa" ); ?>">Iowa</option>
							<option value="<?php echo get_cat_ID( "Kansas" ); ?>">Kansas</option>
							<option value="<?php echo get_cat_ID( "Kentucky" ); ?>">Kentucky</option>
							<option value="<?php echo get_cat_ID( "Louisiana" ); ?>">Louisiana</option>
							<option value="<?php echo get_cat_ID( "Maine" ); ?>">Maine</option>
							<option value="<?php echo get_cat_ID( "Maryland" ); ?>">Maryland</option>
							<option value="<?php echo get_cat_ID( "Massachusetts" ); ?>">Massachusetts</option>
							<option value="<?php echo get_cat_ID( "Michigan" ); ?>">Michigan</option>
							<option value="<?php echo get_cat_ID( "Minnesota" ); ?>">Minnesota</option>
							<option value="<?php echo get_cat_ID( "Mississippi" ); ?>">Mississippi</option>
							<option value="<?php echo get_cat_ID( "Missouri" ); ?>">Missouri</option>
							<option value="<?php echo get_cat_ID( "Montana" ); ?>">Montana</option>
							<option value="<?php echo get_cat_ID( "Nebraska" ); ?>">Nebraska</option>
							<option value="<?php echo get_cat_ID( "Nevada" ); ?>">Nevada</option>
							<option value="<?php echo get_cat_ID( "New Hampshire" ); ?>">New Hampshire</option>
							<option value="<?php echo get_cat_ID( "New Jersey" ); ?>">New Jersey</option>
							<option value="<?php echo get_cat_ID( "New Mexico" ); ?>">New Mexico</option>
							<option value="<?php echo get_cat_ID( "New York" ); ?>">New York</option>
							<option value="<?php echo get_cat_ID( "North Carolina" ); ?>">North Carolina</option>
							<option value="<?php echo get_cat_ID( "North Dakota" ); ?>">North Dakota</option>
							<option value="<?php echo get_cat_ID( "Ohio" ); ?>">Ohio</option>
							<option value="<?php echo get_cat_ID( "Oklahoma" ); ?>">Oklahoma</option>
							<option value="<?php echo get_cat_ID( "Oregon" ); ?>">Oregon</option>
							<option value="<?php echo get_cat_ID( "Pennsylvania" ); ?>">Pennsylvania</option>
							<option value="<?php echo get_cat_ID( "Rhode Island" ); ?>">Rhode Island</option>
							<option value="<?php echo get_cat_ID( "South Carolina" ); ?>">South Carolina</option>
							<option value="<?php echo get_cat_ID( "South Dakota" ); ?>">South Dakota</option>
							<option value="<?php echo get_cat_ID( "Tennessee" ); ?>">Tennessee</option>
							<option value="<?php echo get_cat_ID( "Texas" ); ?>">Texas</option>
							<option value="<?php echo get_cat_ID( "Utah" ); ?>">Utah</option>
							<option value="<?php echo get_cat_ID( "Vermont" ); ?>">Vermont</option>
							<option value="<?php echo get_cat_ID( "Virginia" ); ?>">Virginia</option>
							<option value="<?php echo get_cat_ID( "Washington" ); ?>">Washington</option>
							<option value="<?php echo get_cat_ID( "West Virginia" ); ?>">West Virginia</option>
							<option value="<?php echo get_cat_ID( "Wisconsin" ); ?>">Wisconsin</option>
							<option value="<?php echo get_cat_ID( "Wyoming" ); ?>">Wyoming</option>
						</select>
					</form>
				</div>
                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section main-content-preppend">
					<?php $i = 1; 					
					$query = new WP_Query(  array( "posts_per_page" => 999, "category__and" => array($forecasts,$states) )  );
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
                            <?php imo_dart_tag("300x250",array("pos"=>"mob")); ?> 
                        </div>
                        <?php } ?>
                    <?php endif;?>
					
                    <?php $i++; endwhile; ?>
    
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