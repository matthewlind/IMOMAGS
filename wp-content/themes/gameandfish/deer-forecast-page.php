<?php
/**
 * Template Name: Deer Forecast Template
 * Description: A Page Template for Deer forecasts w/ map
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
<div class="sponsor"><?php imo_ad_placement("sponsor_logo_240x60"); ?></div>
  
					        
<?php if(mobile() == true){ ?>
	
	<form name="menuform" class="forecast-menu current-year">
	<select name="menu4">
		<option value="">Select Your State</option>
		<option value="/forecasts/alabama-deer-hunting-forecast-2015">alabama</option>
		<option value="/forecasts/rocky-mountain-deer-hunting-forecast-2015">arizona</option>
		<option value="/forecasts/arkansas-deer-hunting-forecast-2015">arkansas</option>
		<option value="/forecasts/california-deer-hunting-forecast-2015">california</option>
		<option value="/forecasts/new-england-deer-hunting-forecast-2015">connecticut</option>
		<option value="/forecasts/rocky-mountain-deer-hunting-forecast-2015">colorado</option>
		<option value="/forecasts/florida-deer-hunting-forecast-2015">florida</option>
		<option value="/forecasts/georgia-deer-hunting-forecast-2015">georgia</option>
		<option value="/forecasts/idaho-deer-hunting-forecast-2015">idaho</option>
		<option value="/forecasts/illinois-deer-hunting-forecast-2015">illinois</option>
		<option value="/forecasts/indiana-deer-hunting-forecast-2015">indiana</option>
		<option value="/forecasts/iowa-deer-hunting-forecast-2015">iowa</option>
		<option value="/forecasts/great-plains-deer-hunting-forecast-2015">kansas</option>
		<option value="/forecasts/kentucky-deer-hunting-forecast-2015">kentucky</option>
		<option value="/forecasts/louisiana-deer-hunting-forecast-2015">louisiana</option>
		<option value="/forecasts/maine-deer-hunting-forecast-2015">maine</option>
		<option value="/forecasts/new-england-deer-hunting-forecast-2015">massachusetts</option>
		<option value="/forecasts/michigan-deer-hunting-forecast-2015">michigan</option>
		<option value="/forecasts/minnesota-deer-hunting-forecast-2015">minnesota</option>
		<option value="/forecasts/mississippi-deer-hunting-forecast-2015">mississippi</option>
		<option value="/forecasts/missouri-deer-hunting-forecast-2015">missouri</option>
		<option value="/forecasts/great-plains-deer-hunting-forecast-2015">nebraska</option>
		<option value="/forecasts/new-england-deer-hunting-forecast-2015">new hampshire</option>
		<option value="/forecasts/rocky-mountain-deer-hunting-forecast-2015">new mexico</option>
		<option value="/forecasts/new-york-deer-hunting-forecast-2015">new york</option>
		<option value="/forecasts/north-carolina-deer-hunting-forecast-2015">north carolina</option>
		<option value="/forecasts/great-plains-deer-hunting-forecast-2015">north dakota</option>
		<option value="/forecasts/ohio-deer-hunting-forecast-2015">ohio</option>
		<option value="/forecasts/oklahoma-deer-hunting-forecast-2015">oklahoma</option>
		<option value="/forecasts/washington-oregon-deer-hunting-forecast-2015">oregon</option>
		<option value="/forecasts/pennsylvania-deer-hunting-forecast-2015">pennsylvania</option>
		<option value="/forecasts/new-england-deer-hunting-forecast-2015">rhode island</option>
		<option value="/forecasts/south-carolina-deer-hunting-forecast-2015">south carolina</option>
		<option value="/forecasts/great-plains-deer-hunting-forecast-2015">south dakota</option>
		<option value="/forecasts/tennessee-deer-hunting-forecast-2015">tennessee</option>
		<option value="/forecasts/texas-deer-hunting-forecast-2015">texas</option>
		<option value="/forecasts/vermont-deer-hunting-forecast-2015">vermont</option>
		<option value="/forecasts/virginia-deer-hunting-forecast-2015">virginia</option>
		<option value="/forecasts/washington-oregon-deer-hunting-forecast-2015">washington</option>
		<option value="/forecasts/west-virginia-deer-hunting-forecast-2015">west virginia</option>
		<option value="/forecasts/wisconsin-deer-hunting-forecast-2015">wisconsin</option>		
		<option value="/forecasts/rocky-mountain-deer-hunting-forecast-2015">Wyoming</option>
	</select>
	<input type="button" name="Submit" value="Go" class="forecast-submit" onClick="window.location = this.form.menu4.options[this.form.menu4.selectedIndex].value;">
	</form>
	<?php if(is_page("deer-forecast")){ ?>
		<img src="<?php bloginfo("stylesheet_directory"); ?>/images/pic/deer-forecast-logo-sm.png" alt="Deer Forecast" />
	<?php } ?>

<?php }else{ ?>
  
	<div class="forecast-map year-2014">	
		
			<p class="state-name">Select Your State</p>
			<div id="us-map-forecast"></div>
			<div class="modal">
				<p class="state-selection">Select Your Forecast</p>
				<a href="" class="deer-forecast">Places For Whitetail</a>
				<p class="delim">-- or --</p>
				<a class="trophy-buck">Trophy Bucks</a>
				<a class="close"></a>
			</div>
			<img src="<?php bloginfo("stylesheet_directory"); ?>/images/pic/deer-forecast-logo-sm.png" alt="Deer Forecast" class="deer-logo" />
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
							<a href="/deer-forecast/">G&F Deer Forecast</a>
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
