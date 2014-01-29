<?php // Custom Signup Form Widget powered by Gravity Forms

class iPadApp_Widget_reloaded extends WP_Widget {
  
	function iPadApp_Widget_reloaded () {
		$widget_ops = array('classname' => 'iPadApp_Widget_reloaded', 'description' => 'A link to the G&A Reloaded App in the iTunes App Store.' );
		$this->WP_Widget('ipad_app_reloaded', 'iPad Reloaded App', $widget_ops);
	}
 
	function widget($args) {
		extract($args); ?>
		<aside id="get_ipad_app" class="widget widget_ipad_app">
      <h3 class="title">Test your skills</h3>
      <a class="cta" href="/apps/point-of-impact-reloaded/">Get The App<div class="ipad-reloaded"></div></a>
      <a class="cta play" href="http://pointofimpact.upandatom.com/">Play Now</a>
    </aside>

<?php echo $after_widget;
	}

}
register_widget('iPadApp_Widget_reloaded');