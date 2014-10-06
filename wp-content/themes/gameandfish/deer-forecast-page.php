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
<div class="forecast-year">Choose forecast year:</div>
	<form>
	  <select id="target" class="target">
	    <option value="2014" selected="selected">2014</option>
	    <option value="2013">2013</option>
	  </select>
	</form>     
					        
<?php if(mobile() == true){ ?>
	
	
   
	<form name="menuform" class="forecast-menu previous-year" style="display:none;">
	<select name="menu4">
		<option value="">Select Your State</option>
		<option value="/deer-forecast/alabama-deer-forecast-2013">alabama</option>
		<option value="/deer-forecast/rocky-mountain-deer-forecast-2013">arizona</option>
		<option value="/deer-forecast/arkansas-deer-forecast-2013">arkansas</option>
		<option value="/deer-forecast/california-deer-forecast-2013">california</option>
		<option value="/deer-forecast/new-england-deer-forecast-2013">connecticut</option>
		<option value="/deer-forecast/florida-deer-forecast-2013">florida</option>
		<option value="/deer-forecast/georgia-deer-forecast-2013">georgia</option>
		<option value="/deer-forecast/idaho-deer-forecast-2013">idaho</option>
		<option value="/deer-forecast/illinois-deer-forecast-2013">illinois</option>
		<option value="/deer-forecast/indiana-deer-forecast-2013">indiana</option>
		<option value="/deer-forecast/iowa-deer-forecast-2013">iowa</option>
		<option value="/deer-forecast/great-plains-deer-forecast-2013">kansas</option>
		<option value="/deer-forecast/kentucky-deer-forecast-2013">kentucky</option>
		<option value="/deer-forecast/louisiana-deer-forecast-2013">louisiana</option>
		<option value="/deer-forecast/maine-deer-forecast-2013">maine</option>
		<option value="/deer-forecast/new-england-deer-forecast-2013">massachusetts</option>
		<option value="/deer-forecast/michigan-deer-forecast-2013">michigan</option>
		<option value="/deer-forecast/minnesota-deer-forecast-2013">minnesota</option>
		<option value="/deer-forecast/mississippi-deer-forecast-2013">mississippi</option>
		<option value="/deer-forecast/missouri-deer-forecast-2013">missouri</option>
		<option value="/deer-forecast/great-plains-deer-forecast-2013">nebraska</option>
		<option value="/deer-forecast/new-england-deer-forecast-2013">new hampshire</option>
		<option value="/deer-forecast/rocky-mountain-deer-forecast-2013">new mexico</option>
		<option value="/deer-forecast/new-york-deer-forecast-2013">new york</option>
		<option value="/deer-forecast/north-carolina-deer-forecast-2013">north carolina</option>
		<option value="/deer-forecast/great-plains-deer-forecast-2013">north dakota</option>
		<option value="/deer-forecast/ohio-deer-forecast-2013">ohio</option>
		<option value="/deer-forecast/oklahoma-deer-forecast-2013">oklahoma</option>
		<option value="/deer-forecast/washington-oregon-deer-forecast-2013">oregon</option>
		<option value="/deer-forecast/pennsylvania-deer-forecast-2013">pennsylvania</option>
		<option value="/deer-forecast/new-england-deer-forecast-2013">rhode island</option>
		<option value="/deer-forecast/south-carolina-deer-forecast-2013">south carolina</option>
		<option value="/deer-forecast/great-plains-deer-forecast-2013">south dakota</option>
		<option value="/deer-forecast/tennessee-deer-forecast-2013">tennessee</option>
		<option value="/deer-forecast/texas-deer-forecast-2013">texas</option>
		<option value="/deer-forecast/vermont-deer-forecast-2013">vermont</option>
		<option value="/deer-forecast/virginia-deer-forecast-2013">virginia</option>
		<option value="/deer-forecast/washington-oregon-deer-forecast-2013">washington</option>
		<option value="/deer-forecast/west-virginia-deer-forecast-2013">west virginia</option>
		<option value="/deer-forecast/wisconsin-deer-forecast-2013">wisconsin</option>
	</select>
	<input type="button" name="Submit" value="Go" class="forecast-submit" onClick="window.location = this.form.menu4.options[this.form.menu4.selectedIndex].value;">
	</form>
	
	<form name="menuform" class="forecast-menu current-year">
	<select name="menu4">
		<option value="">Select Your State</option>
		<option value="/deer-forecast/alabama-deer-hunting-forecast-2014">alabama</option>
		<option value="/deer-forecast/rocky-mountain-deer-hunting-forecast-2014">arizona</option>
		<option value="/deer-forecast/arkansas-deer-hunting-forecast-2014">arkansas</option>
		<option value="/deer-forecast/california-deer-hunting-forecast-2014">california</option>
		<option value="/deer-forecast/new-england-deer-hunting-forecast-2014">connecticut</option>
		<option value="/deer-forecast/rocky-mountain-deer-hunting-forecast-2014">colorado</option>
		<option value="/deer-forecast/florida-deer-hunting-forecast-2014">florida</option>
		<option value="/deer-forecast/georgia-deer-hunting-forecast-2014">georgia</option>
		<option value="/deer-forecast/idaho-deer-hunting-forecast-2014">idaho</option>
		<option value="/deer-forecast/illinois-deer-hunting-forecast-2014">illinois</option>
		<option value="/deer-forecast/indiana-deer-hunting-forecast-2014">indiana</option>
		<option value="/deer-forecast/iowa-deer-hunting-forecast-2014">iowa</option>
		<option value="/deer-forecast/great-plains-deer-hunting-forecast-2014">kansas</option>
		<option value="/deer-forecast/kentucky-deer-hunting-forecast-2014">kentucky</option>
		<option value="/deer-forecast/louisiana-deer-hunting-forecast-2014">louisiana</option>
		<option value="/deer-forecast/maine-deer-hunting-forecast-2014">maine</option>
		<option value="/deer-forecast/new-england-deer-hunting-forecast-2014">massachusetts</option>
		<option value="/deer-forecast/michigan-deer-hunting-forecast-2014">michigan</option>
		<option value="/deer-forecast/minnesota-deer-hunting-forecast-2014">minnesota</option>
		<option value="/deer-forecast/mississippi-deer-hunting-forecast-2014">mississippi</option>
		<option value="/deer-forecast/missouri-deer-hunting-forecast-2014">missouri</option>
		<option value="/deer-forecast/great-plains-deer-hunting-forecast-2014">nebraska</option>
		<option value="/deer-forecast/new-england-deer-hunting-forecast-2014">new hampshire</option>
		<option value="/deer-forecast/rocky-mountain-deer-hunting-forecast-2014">new mexico</option>
		<option value="/deer-forecast/new-york-deer-hunting-forecast-2014">new york</option>
		<option value="/deer-forecast/north-carolina-deer-hunting-forecast-2014">north carolina</option>
		<option value="/deer-forecast/great-plains-deer-hunting-forecast-2014">north dakota</option>
		<option value="/deer-forecast/ohio-deer-hunting-forecast-2014">ohio</option>
		<option value="/deer-forecast/oklahoma-deer-hunting-forecast-2014">oklahoma</option>
		<option value="/deer-forecast/washington-oregon-deer-hunting-forecast-2014">oregon</option>
		<option value="/deer-forecast/pennsylvania-deer-hunting-forecast-2014">pennsylvania</option>
		<option value="/deer-forecast/new-england-deer-hunting-forecast-2014">rhode island</option>
		<option value="/deer-forecast/south-carolina-deer-hunting-forecast-2014">south carolina</option>
		<option value="/deer-forecast/great-plains-deer-hunting-forecast-2014">south dakota</option>
		<option value="/deer-forecast/tennessee-deer-hunting-forecast-2014">tennessee</option>
		<option value="/deer-forecast/texas-deer-hunting-forecast-2014">texas</option>
		<option value="/deer-forecast/vermont-deer-hunting-forecast-2014">vermont</option>
		<option value="/deer-forecast/virginia-deer-hunting-forecast-2014">virginia</option>
		<option value="/deer-forecast/washington-oregon-deer-hunting-forecast-2014">washington</option>
		<option value="/deer-forecast/west-virginia-deer-hunting-forecast-2014">west virginia</option>
		<option value="/deer-forecast/wisconsin-deer-hunting-forecast-2014">wisconsin</option>		
		<option value="/deer-forecast/rocky-mountain-deer-hunting-forecast-2014">Wyoming</option>
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
