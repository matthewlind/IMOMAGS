<?php
$dataPos = 0;
get_header();
?>
<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
	<h1 class="page-title">
		<span>Game & Fish 2013 Deer Forecast</span>
    </h1>
</div>
     					        
<?php if(mobile() == true){ ?>
	
	<!-- 240x60 Ad: -->
    <script type="text/javascript">
    document.write(unescape('%3Cscript src="http://ad.doubleclick.net/adj/<?php echo $dartDomain; ?>/;camp=deerforecast;sect=;manf=;pos=;page=;subs=;sz=240x60;dcopt=;tile=;ord='+dartadsgen_rand+'?"%3E%3C/script%3E'));
    </script>
    <noscript>
    <a href="http://ad.doubleclick.net/adj/<?php echo $dartDomain; ?>/;camp=deerforecast;sect=;manf=;pos=;page=;subs=;sz=240x60;dcopt=;tile=;ord=6545512368?">
    <img src="http://ad.doubleclick.net/ad/<?php echo $dartDomain; ?>/;camp=deerforecast;sect=;manf=;pos=;page=;subs=;sz=240x60;dcopt=;tile=;ord=6545512368?" border="0" />
    </a>
    </noscript>
    <!-- END 240x60 Ad: -->

	<form name="menuform" class="forecast-menu">
	<select name="menu4">
		<option value="">Select Your State</option>
		<option value="/alabama-deer-forecast-2013">alabama</option>
		<option value="/rocky-mountain-deer-forecast-2013">arizona</option>
		<option value="/arkansas-deer-forecast-2013">arkansas</option>
		<option value="/california-deer-forecast-2013">california</option>
		<option value="/new-england-deer-forecast-2013">connecticut</option>
		<option value="/florida-deer-forecast-2013">florida</option>
		<option value="/georgia-deer-forecast-2013">georgia</option>
		<option value="/idaho-deer-forecast-2013">idaho</option>
		<option value="/illinois-deer-forecast-2013">illinois</option>
		<option value="/indiana-deer-forecast-2013">indiana</option>
		<option value="/iowa-deer-forecast-2013">iowa</option>
		<option value="/great-plains-deer-forecast-2013">kansas</option>
		<option value="/kentucky-deer-forecast-2013">kentucky</option>
		<option value="/louisiana-deer-forecast-2013">louisiana</option>
		<option value="/maine-deer-forecast-2013">maine</option>
		<option value="/new-england-deer-forecast-2013">massachusetts</option>
		<option value="/michigan-deer-forecast-2013">michigan</option>
		<option value="/minnesota-deer-forecast-2013">minnesota</option>
		<option value="/mississippi-deer-forecast-2013">mississippi</option>
		<option value="/missouri-deer-forecast-2013">missouri</option>
		<option value="/great-plains-deer-forecast-2013">nebraska</option>
		<option value="/new-england-deer-forecast-2013">new hampshire</option>
		<option value="/rocky-mountain-deer-forecast-2013">new mexico</option>
		<option value="/new-york-deer-forecast-2013">new york</option>
		<option value="/north-carolina-deer-forecast-2013">north carolina</option>
		<option value="/great-plains-deer-forecast-2013">north dakota</option>
		<option value="/ohio-deer-forecast-2013">ohio</option>
		<option value="/oklahoma-deer-forecast-2013">oklahoma</option>
		<option value="/washington-oregon-deer-forecast-2013">oregon</option>
		<option value="/pennsylvania-deer-forecast-2013">pennsylvania</option>
		<option value="/new-england-deer-forecast-2013">rhode island</option>
		<option value="/south-carolina-deer-forecast-2013">south carolina</option>
		<option value="/great-plains-deer-forecast-2013">south dakota</option>
		<option value="/tennessee-deer-forecast-2013">tennessee</option>
		<option value="/texas-deer-forecast-2013">texas</option>
		<option value="/vermont-deer-forecast-2013">vermont</option>
		<option value="/virginia-deer-forecast-2013">virginia</option>
		<option value="/washington-oregon-deer-forecast-2013">washington</option>
		<option value="/west-virginia-deer-forecast-2013">west virginia</option>
		<option value="/wisconsin-deer-forecast-2013">wisconsin</option>
		
	</select>
	<input type="button" name="Submit" value="Go" class="forecast-submit" onClick="window.location = this.form.menu4.options[this.form.menu4.selectedIndex].value;">
	</form>
	<?php if(is_page("deer-forecast")){ ?>
		<img src="<?php bloginfo("stylesheet_directory"); ?>/images/pic/deer-forecast-logo-sm.png" alt="Deer Forecast" />
	<?php } ?>

<?php }else{ ?>

	<div class="forecast-map">	
		
			<div class="sponsor-logo">
				<div id="forecast"></div>
				<!-- 240x60 Ad: -->
                <script type="text/javascript">
                document.write(unescape('%3Cscript src="http://ad.doubleclick.net/adj/<?php echo $dartDomain; ?>/;camp=deerforecast;sect=;manf=;pos=;page=;subs=;sz=240x60;dcopt=;tile=;ord='+dartadsgen_rand+'?"%3E%3C/script%3E'));
                </script>
                <noscript>
                <a href="http://ad.doubleclick.net/adj/<?php echo $dartDomain; ?>/;camp=deerforecast;sect=;manf=;pos=;page=;subs=;sz=240x60;dcopt=;tile=;ord=6545512368?">
                <img src="http://ad.doubleclick.net/ad/<?php echo $dartDomain; ?>/;camp=deerforecast;sect=;manf=;pos=;page=;subs=;sz=240x60;dcopt=;tile=;ord=6545512368?" border="0" />
                </a>
                </noscript>
                <!-- END 240x60 Ad: -->
			</div>
			<p class="state-name">Select Your State</p>
			<div id="us-map-forecast" style="min-width:840px;height:600px;padding:20px;margin-left:60px;position:absolute;top:50px;"></div>
			<div class="modal">
				<p class="state-selection">Select Your Forecast</p>
				<a href="" class="deer-forecast">Places For Whitetail</a>
				<p class="delim">-- or --</p>
				<a class="trophy-buck">Trophy Bucks</a>
				<a class="close"></a>
			</div>

			<?php if(is_page("deer-forecast")){ ?>
				<img src="<?php bloginfo("stylesheet_directory"); ?>/images/pic/deer-forecast-logo-sm.png" alt="Deer Forecast" class="deer-logo" />
			<?php } ?>
		</div>

	
<?php } 
imo_sidebar(); ?>
	<div id="primary" class="general">
        <div class="general-frame">
            <div id="content" role="main" class="forecast-content">  
	            <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="clearfix js-responsive-section">
	            	<?php if(function_exists('wpsocialite_markup')){ wpsocialite_markup(); } ?>
				</div>
											
            	<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section">
	            	<div class="article-holder">
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content/content' ); ?>
						<?php endwhile; // end of the loop. ?>		
	            	</div>
            	</div>
				
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
					<a href="#" class="go-top jq-go-top">go top</a>
				</div>

		 	</div><!-- #content -->
        </div>
    </div><!-- #primary -->
<div class="overlay"></div>
<?php get_footer(); ?>
