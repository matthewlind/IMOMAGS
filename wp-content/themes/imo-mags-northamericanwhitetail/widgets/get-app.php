<?php // Custom Get the App widget 
    
class App_Logged_Out_Widget extends WP_Widget {
	function App_Logged_Out_Widget() {
		$widget_ops = array('classname' => 'widget_app', 'description' => 'Get the App widget.' );
		$this->WP_Widget('app', 'Get the App', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
 
    
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

    <aside id="get-app" class="box widget_get-app">
	    <div class="sidebar-header">
		    <h2>Download The App</h2>
		</div>
		<div class="content">
			<div class="left">
				<div class="app-icon"><span>Whitetail+</span></div>
				<div class="copy">Share Photos of your Trophy Bucks!</div>
				<div class="app-store-icon">Available on the app store</div>
			</div>
			<div class="right">
				<div class="iphone-screen">Whitetail+ App</div>
			</div>
		</div>
		<div class="footer">
			<a href="https://itunes.apple.com/us/app/whitetail+/id568488512?mt=8" class="download" target="_blank">Download Whitetail+</a>

		</div>
    </aside>


<?php }
 
}
register_widget('App_Logged_Out_Widget');