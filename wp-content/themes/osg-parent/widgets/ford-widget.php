<?php // Ford 300 x 602 Widget

class Ford_Widget extends WP_Widget {
	function Ford_Widget() {
		$widget_ops = array('classname' => 'widget_ford', 'description' => 'Ford 300 x 602 Widget' );
		$this->WP_Widget('ford_widget', 'Ford Widget', $widget_ops);
	}

	function widget() {

	$dartDomain = get_option("dart_domain", $default = false);
?>
<div class="widget ford-outfitters-widget">
	<?php imo_ad_placement("sweeps_widget_300x602"); ?>
</div>
<?php }
}
register_widget('Ford_Widget');