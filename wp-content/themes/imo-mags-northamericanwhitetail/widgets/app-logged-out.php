<?php // Custom Get the App widget when user is logged out Widget
    
class App_Logged_Out_Widget extends WP_Widget {
	function App_Logged_Out_Widget() {
		$widget_ops = array('classname' => 'widget_app_logged_out', 'description' => 'Get the App widget when user is logged out.' );
		$this->WP_Widget('app-logged-out', 'Get the App (Logged Out)', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
 
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']); 
    
    $displayStyle = "display:none";
	$loginStyle = "";
	
	if ( is_user_logged_in() ) {
	
		$displayStyle = "";
		$loginStyle = "display:none";
		
		wp_get_current_user();
		
		$current_user = wp_get_current_user();
	    if ( !($current_user instanceof WP_User) )
	         return;
	    }
    ?>

    <aside id="get-app" class="box widget_get-app" style="<?php echo $loginStyle; ?>">
    	<p>This will display a callout to the app when a user is logged out.</p>
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
register_widget('App_Logged_Out_Widget');