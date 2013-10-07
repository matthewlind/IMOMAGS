<?php // Custom Signup Form Widget powered by Gravity Forms

class Forecast_Widget extends WP_Widget {
	function Forecast_Widget() {
		$widget_ops = array('classname' => 'forecast-widget', 'description' => 'Forecast Widget.' );
		$this->WP_Widget('forecast_widget', 'Forecast Widget', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
 
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
    $dartDomain = get_option("dart_domain", $default = false); 
?>
	
	
<div class="widget forecast-widget">	
	<a href="/deer-forecast/" class="forecast-image"></a>
	<div class="forecast-copy">
		<?php if(!empty($title)) : ?>
			<h3><?php echo $title; ?></h3>
		<?php endif; ?>
		<p>Want to discover the best places to hunt deer in America? We've pinpointed the top counties, WMAs or zones in each state, along with deer harvest figures and other information that will help you fill your tag this season.</p>
	</div>
	<div class="state-filter">
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
	</div>
	<div class="forecast-sponor">
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
</div>
<?php	}
 
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
 
	function form($instance) {
		$instance = wp_parse_args((array) $instance, array('title' => ''));
		$title = strip_tags($instance['title']);
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
	}
}
register_widget('Forecast_Widget');