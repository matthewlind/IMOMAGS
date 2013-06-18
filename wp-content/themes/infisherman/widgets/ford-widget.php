<?php // Ford 300 x 600 Widget

class Ford_Widget extends WP_Widget {
	function Ford_Widget() {
		$widget_ops = array('classname' => 'widget_ford', 'description' => 'Ford 300 x 600 Widget' );
		$this->WP_Widget('ford_widget', 'Ford Widget', $widget_ops);
	}
	
	function widget() {
	
	$dartDomain = get_option("dart_domain", $default = false);
?>
<div class="widget">	
	<script type="text/javascript">
	 var ord = window.ord || Math.floor(Math.random() * 1e16);
	 document.write('<iframe src="http://ad.doubleclick.net/N4930/adi/<?php echo $dartDomain; ?>;sz=300x645;ord=' + ord + '?" width="300" height="645" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no"></iframe>');
	</script>
	<noscript>
	<a href="http://ad.doubleclick.net/N4930/jump/<?php echo $dartDomain; ?>;sz=300x645;ord=[timestamp]?">
	<img src="http://ad.doubleclick.net/N4930/ad/<?php echo $dartDomain; ?>;sz=300x645;ord=[timestamp]?" width="300" height="645" />
	</a>
	</noscript>
</div>
<?php } 
}
register_widget('Ford_Widget');