<?php // Custom US Map Nav Widget

class us_map_Widget extends WP_Widget {
	function us_map_Widget() {
		$widget_ops = array('classname' => 'widget_us_map', 'description' => 'US Map Widget.' );
		$this->WP_Widget('us_map', 'US Map', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
?>

    <aside id="us-map-nav" class="us-map-widget">
     	
    </aside>

<?php	}
 
}
register_widget('us_map_Widget');