<?php // Cross Site Feed Widget
    
class Cross_Site_Feed_Widget extends WP_Widget {
	function Cross_Site_Feed_Widget() {
		$widget_ops = array('classname' => 'widget_cross_site', 'description' => 'Cross Site Feed Widget.' );
		$this->WP_Widget('cross site feed', 'Cross Site Feed', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
   ?>

	    <aside id="cross-site-feed-widget" class="box">
	    	<div class="logo"></div>
		    <div class="cross-site-feed-widget" term=""></div><!-- This term= attribute is searched for by displayCrossSiteFeed() in cross-site-feed.js -->
	    </aside>

<?php	}
 
}
register_widget('Cross_Site_Feed_Widget');