<?php // Custom Signup Form Widget powered by Gravity Forms

class iPadApp_Widget extends WP_Widget {
  
	function iPadApp_Widget() {
		$widget_ops = array('classname' => 'widget_ipad_app', 'description' => 'A link to the G&A App in the iTunes App Store.' );
		$this->WP_Widget('ipad_app', 'iPad App', $widget_ops);
	}
 
	function widget($args) {
		extract($args); ?>
		<aside id="get_ipad_app" class="widget widget_ipad_app">
      <h3 class="title">G&amp;A Now on the iPad</h3>
      <a class="cta" href="http://itunes.apple.com/us/app/guns-ammo-magazine/id386234086?mt=8">Get The App</a>
      <div class="ipad"></div>
    </aside>

<?php echo $after_widget;
	}

}
register_widget('iPadApp_Widget');