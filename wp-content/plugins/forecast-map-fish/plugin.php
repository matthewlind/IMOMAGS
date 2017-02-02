<?php
/*  
Plugin Name: Forecast Map Fish
Plugin URI: https://imomags.com
Description: Helps setup an interactive map of US States
Author: IMOfox
Author URI:
Version: 0.1
Stable tag: 0.1
License: IMO
*/ 
add_action('wp_enqueue_scripts', 'imo_fish_forecast_map_init', 50);
function imo_fish_forecast_map_init() {
	//mobile map touch fix
	if(mobile() == true){ ?>
		<script type="text/javascript">
			var $mobile = true;
		</script>
	<?php }else{ ?>
		<script type="text/javascript">
			var $mobile = false;
		</script>
	<?php }
	wp_enqueue_style( 'fish-map-style', plugin_dir_url( __FILE__ ) . 'css/map-style.css' );
	wp_enqueue_script('imo-usa-map-forecast-fish-js',plugins_url('js/imo-usa-map-forecast.js', __FILE__)); ?>	
<?php } ?>