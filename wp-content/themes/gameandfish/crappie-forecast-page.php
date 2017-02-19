<?php
/**
 * Template Name: Crappie Forecast Template
 * Description: A Page Template for Fishing forecasts w/ map
 *
 * The showcase template in Twenty Eleven consists of a featured posts section using sticky posts,
 * another recent posts area (with the latest post shown in full and the rest as a list)
 * and a left sidebar holding aside posts.
 *
 * We are creating two queries to fetch the proper posts and a custom widget for the sidebar.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
 
$dataPos = 0;
$postID = get_the_ID();
get_header();
?>
<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section deer-forecast">
	<h1 class="page-title">
		<span><?php echo get_the_title($postID); ?></span>
    </h1>
</div>
<!-- 240x60 Ad: -->
<div class="sponsor"><?php imo_ad_placement("sponsor"); ?></div>
  
					        
<?php if(mobile() == true){ ?>
	
	<form name="menuform" class="forecast-menu current-year">
	<select name="menu4">
		<option value="">Select Your State</option>
		<option value="/fishing/alabama-crappie-fishing-forecast-spring-2017/">alabama</option>
		<option value="/fishing/2017-arkansas-crappie-fishing-forecast/">arkansas</option>
		<option value="/fishing/georgia-crappie-fishing-forecast-spring-2017/">georgia</option>
		<option value="/fishing/2017-illinois-crappie-fishing-forecast/">illinois</option>
		<option value="/fishing/2017-indiana-crappie-fishing-forecast/">indiana</option>
		<option value="/fishing/iowa-crappie-fishing-forecast-spring-2017/">iowa</option>
		<option value="/fishing/2017-great-plains-crappie-fishing-forecast/">kansas</option>
		<option value="/fishing/kentucky-crappie-fishing-forecast-spring-2017/">kentucky</option>
		<option value="/fishing/2017-mississippilouisiana-crappie-fishing-forecast/">louisiana</option>
		<option value="/fishing/2017-michigan-crappie-fishing-forecast/">michigan</option>
		<option value="/fishing/2017-minnesota-crappie-fishing-forecast/">minnesota</option>
		<option value="/fishing/2017-mississippilouisiana-crappie-fishing-forecast/">mississippi</option>
		<option value="/fishing/missouri-crappie-fishing-forecast-spring-2017/">missouri</option>
		<option value="/fishing/2017-great-plains-crappie-fishing-forecast/">nebraska</option>
		<option value="/fishing/2017-north-carolina-crappie-fishing-forecast/">north carolina</option>
		<option value="/fishing/2017-great-plains-crappie-fishing-forecast/">north dakota</option>
		<option value="/fishing/ohio-crappie-fishing-forecast-spring-2017/">ohio</option>
		<option value="/fishing/oklahoma-crappie-fishing-forecast-spring-2017/">oklahoma</option>
		<option value="/fishing/south-carolina-crappie-fishing-forecast-spring-2017/">south carolina</option>
		<option value="/fishing/2017-great-plains-crappie-fishing-forecast/">south dakota</option>
		<option value="/fishing/tennessee-crappie-fishing-forecast-spring-2017/">tennessee</option>
		<option value="/fishing/2017-texas-crappie-fishing-forecast/">texas</option>
		<option value="/forecasts/virginia-crappie-fishing-forecast-spring-2017/">virginia</option>
		<option value="/fishing/2017-west-virginia-crappie-fishing-forecast/">west virginia</option>
	</select>
	<input type="button" name="Submit" value="Go" class="forecast-submit" onClick="window.location = this.form.menu4.options[this.form.menu4.selectedIndex].value;">
	</form>
	<?php if(is_page("deer-forecast")){ ?>
		<img src="<?php bloginfo("stylesheet_directory"); ?>/images/pic/deer-forecast-logo-sm.png" alt="Deer Forecast" />
	<?php } ?>

<?php }else{ ?>
  
	<div class="forecast-map year-2014">	
		
			<p class="state-name">Select Your State</p>
			<div id="us-map-forecast-crappie"></div>
			<div class="modal">
				
			</div>
			<img style="display:none;" src="<?php bloginfo("stylesheet_directory"); ?>/images/pic/deer-forecast-logo-sm.png" alt="Deer Forecast" class="deer-logo" />
		</div>

	
<?php } ?>

<div>
<?php imo_sidebar(); ?>
	<div id="primary" class="general">
        <div class="general-frame">
            <div id="content" role="main" class="forecast-content">  
	            <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="clearfix js-responsive-section">
	            	<?php if(function_exists('wpsocialite_markup')){ wpsocialite_markup(); } ?>
				</div>
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
					<h1 class="page-title">
						<div class="icon"></div>
						<span><?php echo get_the_title($postID); ?></span>
				    </h1>
				</div>							
            	<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="article-brief clearfix js-responsive-section">
	            	<div class="article-holder">
	            		<?php if(!is_page("deer-forecast")){ ?>
							<a href="/deer-forecast/">G&F Crappie Forecast</a>
						<?php } ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<div id="post-<?php the_ID(); ?>" <?php post_class('article-brief clearfix js-responsive-section current-year'); ?>>
							<div class="article-holder">
								<?php $custom_fields = get_post_custom($post_id);
						        $checked = ( isset ($custom_fields['social_exclude'])   ) ? 'checked="checked"' : '' ;
						        if ($checked ==""){ ?>
									<?php if(function_exists('wpsocialite_markup')){ wpsocialite_markup(); } ?>
								<?php }
								the_content(); ?>
								<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
								<footer class="entry-meta">
									<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
								</footer><!-- .entry-meta -->
						    </div>
						</div><!-- #post-<?php the_ID(); ?> -->
						
						<div id="post-<?php the_ID(); ?>" <?php post_class('article-brief clearfix js-responsive-section previous-year'); ?> style="display:none;">
							<div class="article-holder">
								<?php $custom_fields = get_post_custom($post_id);
						        $checked = ( isset ($custom_fields['social_exclude'])   ) ? 'checked="checked"' : '' ;
						        if ($checked ==""){ ?>
									<?php if(function_exists('wpsocialite_markup')){ wpsocialite_markup(); } ?>
								<?php }
								the_field("previous_year",get_the_ID()); ?>
								<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
								<footer class="entry-meta">
									<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
								</footer><!-- .entry-meta -->
						    </div>
						</div><!-- #post-<?php the_ID(); ?> -->

						<?php endwhile; // end of the loop. ?>		
	            	</div>
            	</div>
				
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
					<a href="#" class="go-top jq-go-top">go top</a>
				</div>

		 	</div><!-- #content -->
        </div>
    </div><!-- #primary -->
</div>
<div class="overlay"></div>
<?php get_footer(); ?>
