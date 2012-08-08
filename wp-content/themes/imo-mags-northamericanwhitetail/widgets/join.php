<?php // Custom Join NAW+ Widget powered by Gravity Forms

class Join_Widget extends WP_Widget {
	function Join_Widget() {
		$widget_ops = array('classname' => 'widget_gravity_form', 'description' => 'Add a Gravity Form email signup form.' );
		$this->WP_Widget('join', 'Join NAW+', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
 
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']); ?>

    <aside id="join" class="box widget_gravity_form">
      <div class="content_wrapper">
      	  <div id="user-login-button" class="fb-login">Fast Facebook Login</div>
	      <small>*we do not post anything to your wall unless you say so!</small>
	      <div class="temp"></div>
	      <a class="email-signup">or use your email address</a>
	      <a class="prize-title">Sign Up Now & Win This Bolt Action Model 700!</a>
	      <div class="prize"></div>
	      <div class="prize-logo"></div>
	      <div class="clear"></div>
        <a href="#" class="about-link">What is North American Whitetail +?</a>
       </div>
    </aside>

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
register_widget('Join_Widget');