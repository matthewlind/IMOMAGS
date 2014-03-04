<?php
/*  Copyright 2012 Aaron Baker

*/

/*
Plugin Name: IMO USA MAP
Plugin URI: https://imomags.com
Description: Helps setup an interactive map of US States
Author: aaron
Author URI:
Version: 0.1
Stable tag: 0.1
License: IMO
*/



add_action('wp_enqueue_scripts', 'imo_usa_map_init');



function imo_usa_map_init() {
	
	//mobile map touch fix
	if(tablet() == true || mobile() == true){ ?>
		<script type="text/javascript">
			var $mobile = true;
		</script>
	<?php }else{ ?>
		<script type="text/javascript">
			var $mobile = false;
		</script>
	<?php }

	wp_enqueue_script('imo-usa-map-js',plugins_url('js/imo-usa-map.js', __FILE__));
	
	wp_enqueue_script('us-map-svg',plugins_url('js/us-map-svg.js', __FILE__));
	wp_enqueue_script('raphael-min',plugins_url('js/raphael-min.js', __FILE__));
	wp_enqueue_script('jquery-qtip',plugins_url('js/jquery.qtip.min.js', __FILE__));
	
}

