<?php // Custom Signup Form Widget powered by Gravity Forms

class Forecast_Widget extends WP_Widget {
	function Forecast_Widget() {
		$widget_ops = array('classname' => 'forecast-widget', 'description' => 'Forecast Widget.' );
		$this->WP_Widget('forecast_widget', 'Forecast Widget', $widget_ops);
	}
 
	function widget($args, $instance) {
	
	
		extract($args, EXTR_SKIP);
 
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
    $img = empty($instance['img']) ? '' : apply_filters('widget_img', $instance['img']);
    $body = empty($instance['body']) ? '' : apply_filters('widget_body', $instance['body']);
    $url = empty($instance['url']) ? '' : apply_filters('widget_url', $instance['url']);
    $campaign = empty($instance['campaign']) ? '' : apply_filters('widget_campaign', $instance['campaign']);
    $year = empty($instance['year']) ? '' : apply_filters('widget_year', $instance['year']);
    $species = empty($instance['species']) ? '' : apply_filters('widget_species', $instance['species']);
    $trophy = isset( $instance['trophy'] ) ? $instance['trophy'] : false;  
    
    $dartDomain = get_option("dart_domain", $default = false); 
?>
	
<style type="text/css">
.forecast-widget{
	margin-bottom: 30px;
	max-width: 300px;
	position: relative;
}
.forecast-widget h3{
	font-family: "open_sansbold", Helvetica, Arial, sans-serif;
	font-size: 20px;
	padding: 10px 10px 0;
	margin: 0;
}
.forecast-copy{
	border-left: 3px dashed #ccc;
	border-right: 3px dashed #ccc;
	border-bottom: 3px dashed #ccc;
}
.forecast-widget .forecast-image{
	background: url(img/Deer-Forecast-2013-300.jpg) no-repeat center top;	
	border-top: 3px solid #FF6600;
	width: 300px;
	height: auto;
	display: block;
}
.forecast-widget .forecast-widget-sponsor{
	top: 192px;
	position: absolute;
}
.forecast-widget p{
	padding: 0 10px 10px;
	color: #757575;
	margin: 0;
	font-size: 15px;
}
.forecast-widget .state-filter{
	margin: 0 auto;
	padding: 8px 0;
	background: #FF6600;
}
.forecast-widget .state-filter select{
	<?php if(tablet()){ echo "font-size: 14px;"; }else{ echo "font-size: 16px;"; } ?>
	width: 222px;
	margin-left: 10px;
	text-transform: capitalize;
}
.forecast-widget .state-filter input{
	font-size: 16px;
}
.forecast-sponor{
	background: black;
}
.forecast-sponor img{
	margin: 0 auto;
	display: block;
	padding: 10px 0;
}
</style>	
<div class="widget forecast-widget">	
	<div class="forecast-widget-sponsor">
		<?php imo_ad_placement("Deer_Forecast_Sponsor_Logo_240x60"); ?>
	</div>
	<a href="http://www.gameandfishmag.com/deer-forecast/" class="forecast-image" onclick="_gaq.push(['_trackEvent','Forecast Widget','<?php echo $campaign; ?>','<?php echo $url; ?>']);"><img src="<?php echo $img; ?>" alt="<?php echo $title; ?>" /></a>
	<div class="state-filter">
		<form name="menuform" class="forecast-menu">
			<select name="menu4">
				<option value="">Choose State: Deer Forecast</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/alabama-<?php echo $url; ?>-forecast-<?php echo $year; ?>">alabama</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/rocky-mountain-<?php echo $url; ?>-forecast-<?php echo $year; ?>">arizona</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/arkansas-<?php echo $url; ?>-forecast-<?php echo $year; ?>">arkansas</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/california-<?php echo $url; ?>-forecast-<?php echo $year; ?>">california</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/new-england-<?php echo $url; ?>-forecast-<?php echo $year; ?>">connecticut</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/florida-<?php echo $url; ?>-forecast-<?php echo $year; ?>">florida</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/georgia-<?php echo $url; ?>-forecast-<?php echo $year; ?>">georgia</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/idaho-<?php echo $url; ?>-forecast-<?php echo $year; ?>">idaho</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/illinois-<?php echo $url; ?>-forecast-<?php echo $year; ?>">illinois</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/indiana-<?php echo $url; ?>-forecast-<?php echo $year; ?>">indiana</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/iowa-<?php echo $url; ?>-forecast-<?php echo $year; ?>">iowa</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/great-plains-<?php echo $url; ?>-forecast-<?php echo $year; ?>">kansas</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/kentucky-<?php echo $url; ?>-forecast-<?php echo $year; ?>">kentucky</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/louisiana-<?php echo $url; ?>-forecast-<?php echo $year; ?>">louisiana</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/maine-<?php echo $url; ?>-forecast-<?php echo $year; ?>">maine</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/new-england-<?php echo $url; ?>-forecast-<?php echo $year; ?>">massachusetts</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/michigan-<?php echo $url; ?>-forecast-<?php echo $year; ?>">michigan</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/minnesota-<?php echo $url; ?>-forecast-<?php echo $year; ?>">minnesota</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/mississippi-<?php echo $url; ?>-forecast-<?php echo $year; ?>">mississippi</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/missouri-<?php echo $url; ?>-forecast-<?php echo $year; ?>">missouri</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/great-plains-<?php echo $url; ?>-forecast-<?php echo $year; ?>">nebraska</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/new-england-<?php echo $url; ?>-forecast-<?php echo $year; ?>">new hampshire</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/rocky-mountain-<?php echo $url; ?>-forecast-<?php echo $year; ?>">new mexico</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/new-york-<?php echo $url; ?>-forecast-<?php echo $year; ?>">new york</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/north-carolina-<?php echo $url; ?>-forecast-<?php echo $year; ?>">north carolina</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/great-plains-<?php echo $url; ?>-forecast-<?php echo $year; ?>">north dakota</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/ohio-<?php echo $url; ?>-forecast-<?php echo $year; ?>">ohio</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/oklahoma-<?php echo $url; ?>-forecast-<?php echo $year; ?>">oklahoma</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/washington-oregon-<?php echo $url; ?>-forecast-<?php echo $year; ?>">oregon</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/pennsylvania-<?php echo $url; ?>-forecast-<?php echo $year; ?>">pennsylvania</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/new-england-<?php echo $url; ?>-forecast-<?php echo $year; ?>">rhode island</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/south-carolina-<?php echo $url; ?>-forecast-<?php echo $year; ?>">south carolina</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/great-plains-<?php echo $url; ?>-forecast-<?php echo $year; ?>">south dakota</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/tennessee-<?php echo $url; ?>-forecast-<?php echo $year; ?>">tennessee</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/texas-<?php echo $url; ?>-forecast-<?php echo $year; ?>">texas</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/vermont-<?php echo $url; ?>-forecast-<?php echo $year; ?>">vermont</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/virginia-<?php echo $url; ?>-forecast-<?php echo $year; ?>">virginia</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/washington-oregon-<?php echo $url; ?>-forecast-<?php echo $year; ?>">washington</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/west-virginia-<?php echo $url; ?>-forecast-<?php echo $year; ?>">west virginia</option>
				<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/wisconsin-<?php echo $url; ?>-forecast-<?php echo $year; ?>">wisconsin</option>
				
			</select>
			<input type="button" name="Submit" value="Go" class="forecast-submit" 
			onClick="_gaq.push(['_trackEvent','Forecast Widget','<?php echo $campaign; ?>',this.form.menu4.options[this.form.menu4.selectedIndex].value]);window.location = this.form.menu4.options[this.form.menu4.selectedIndex].value;">
		</form>
		
		<?php
		
		 if($trophy == true){ ?>

				<form name="menuform" class="forecast-menu">
					<select name="menu4">
						<option value="">Choose State: Trophy Bucks</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/alabama-trophy-bucks-<?php echo $year; ?>">alabama</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/arkansas-trophy-bucks-<?php echo $year; ?>">arkansas</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/california-trophy-bucks-<?php echo $year; ?>">california</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/new-england-trophy-bucks-<?php echo $year; ?>">connecticut</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/florida-trophy-bucks-<?php echo $year; ?>">florida</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/georgia-trophy-bucks-<?php echo $year; ?>">georgia</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/idaho-trophy-bucks-<?php echo $year; ?>">idaho</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/illinois-trophy-bucks-<?php echo $year; ?>">illinois</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/indiana-trophy-bucks-<?php echo $year; ?>">indiana</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/iowa-trophy-bucks-<?php echo $year; ?>">iowa</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/great-plains-trophy-bucks-<?php echo $year; ?>">kansas</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/kentucky-trophy-bucks-<?php echo $year; ?>">kentucky</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/louisiana-trophy-bucks-<?php echo $year; ?>">louisiana</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/maine-trophy-bucks-<?php echo $year; ?>">maine</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/new-england-trophy-bucks-<?php echo $year; ?>">massachusetts</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/michigan-trophy-bucks-<?php echo $year; ?>">michigan</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/minnesota-trophy-bucks-<?php echo $year; ?>">minnesota</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/mississippi-trophy-bucks-<?php echo $year; ?>">mississippi</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/missouri-trophy-bucks-<?php echo $year; ?>">missouri</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/great-plains-trophy-bucks-<?php echo $year; ?>">nebraska</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/new-england-trophy-bucks-<?php echo $year; ?>">new hampshire</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/rocky-mountain-trophy-bucks-<?php echo $year; ?>">new mexico</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/new-york-trophy-bucks-<?php echo $year; ?>">new york</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/north-carolina-trophy-bucks-<?php echo $year; ?>">north carolina</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/great-plains-trophy-bucks-<?php echo $year; ?>">north dakota</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/ohio-trophy-bucks-<?php echo $year; ?>">ohio</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/oklahoma-trophy-bucks-<?php echo $year; ?>">oklahoma</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/washington-oregon-trophy-bucks-<?php echo $year; ?>">oregon</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/pennsylvania-trophy-bucks-<?php echo $year; ?>">pennsylvania</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/new-england-trophy-bucks-<?php echo $year; ?>">rhode island</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/south-carolina-trophy-bucks-<?php echo $year; ?>">south carolina</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/great-plains-trophy-bucks-<?php echo $year; ?>">south dakota</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/tennessee-trophy-bucks-<?php echo $year; ?>">tennessee</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/texas-trophy-bucks-<?php echo $year; ?>">texas</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/vermont-trophy-bucks-<?php echo $year; ?>">vermont</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/virginia-trophy-bucks-<?php echo $year; ?>">virginia</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/west-virginia-trophy-bucks-<?php echo $year; ?>">west virginia</option>
						<option value="http://www.gameandfishmag.com/<?php echo $species; ?>-forecast/wisconsin-trophy-bucks-<?php echo $year; ?>">wisconsin</option>
						
					</select>
					<input type="button" name="Submit" value="Go" class="forecast-submit" 
					onClick="_gaq.push(['_trackEvent','Forecast Widget','<?php echo $campaign; ?>',this.form.menu4.options[this.form.menu4.selectedIndex].value]);window.location = this.form.menu4.options[this.form.menu4.selectedIndex].value;">
				</form>
		<?php } ?>
	</div>
	
	<div class="forecast-copy">
		<?php if(!empty($title)) : ?>
			<h3><?php echo $title; ?></h3>
		<?php endif; ?>
		<p><?php echo $body; ?></p>
	</div>
	
	</div>
<?php	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['img'] = strip_tags($new_instance['img']);
		$instance['body'] = strip_tags($new_instance['body']);
		$instance['url'] = strip_tags($new_instance['url']);
		$instance['campaign'] = strip_tags($new_instance['campaign']);
		$instance['year'] = strip_tags($new_instance['year']);
		$instance['species'] = $new_instance['species'];
		$instance['trophy'] = $new_instance['trophy'];
		
		return $instance;
	}
 
	function form($instance) {
		
		$instance = wp_parse_args((array) $instance, array('title' => '','img' => '','body' => '','campaign' => '','year' => '','species' => '','url' => '','trophy' => true ));
		$title = strip_tags($instance['title']);
		$img = strip_tags($instance['img']);
		$body = strip_tags($instance['body']);
		$url = strip_tags($instance['url']);
		$campaign = strip_tags($instance['campaign']);
		$year = strip_tags($instance['year']);
		$species = strtolower($instance['species']);
		$trophy = $instance['trophy'];
		
?>			
			

			<p><label for="<?php echo $this->get_field_id('year'); ?>">Year: <input class="widefat" id="<?php echo $this->get_field_id('year'); ?>" name="<?php echo $this->get_field_name('year'); ?>" type="text" value="<?php echo attribute_escape($year); ?>" /></label></p>

			<p><label for="<?php echo $this->get_field_id('species'); ?>">Species: <input class="widefat" id="<?php echo $this->get_field_id('species'); ?>" name="<?php echo $this->get_field_name('species'); ?>" type="text" value="<?php echo attribute_escape($species); ?>" /></label></p>

			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('img'); ?>">Image (url of the widget image): <input class="widefat" id="<?php echo $this->get_field_id('img'); ?>" name="<?php echo $this->get_field_name('img'); ?>" type="text" value="<?php echo attribute_escape($img); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('url'); ?>">Page Slug (slug of the main forecast page - i.e deer-forecast): <input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo attribute_escape($url); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('body'); ?>">Body Text: <input class="widefat" id="<?php echo $this->get_field_id('body'); ?>" name="<?php echo $this->get_field_name('body'); ?>" type="text" value="<?php echo attribute_escape($body); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('campaign'); ?>">Campaign: (used for tracking and sponsors - i.e. deerforecastwidget): <input class="widefat" id="<?php echo $this->get_field_id('campaign'); ?>" name="<?php echo $this->get_field_name('campaign'); ?>" type="text" value="<?php echo attribute_escape($campaign); ?>" /></label></p>
			
			<input class="checkbox" type="checkbox" <?php checked( isset( $instance['trophy']), true ); ?> id="<?php echo $this->get_field_id( 'trophy' ); ?>" name="<?php echo $this->get_field_name( 'trophy' ); ?>" />   
			<label for="<?php echo $this->get_field_id( 'trophy' ); ?>"><?php _e('Display Trophy Bucks?', 'example'); ?></label>  
			<p></p>
			<?php
	}
}
register_widget('Forecast_Widget');

























