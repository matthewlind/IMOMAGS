<?php // Custom Get the App widget when user is logged in Widget
    
class App_Logged_Widget extends WP_Widget {
	function App_Logged_Widget() {
		$widget_ops = array('classname' => 'widget_app_logged', 'description' => 'Get the App widget when user is logged in.' );
		$this->WP_Widget('app-logged', 'Get the App (Logged In)', $widget_ops);
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

    <aside id="get-app" class="box widget_get-app" style="<?php echo $displayStyle; ?>">
	    <div class="sidebar-header">
		    <h2>You Are Logged In</h2>
		</div>
		<div class="content">
			<p>Did you get the app?</p>
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
			<div class="download">Download Whitetail+</div>
		</div>
    </aside>

<?php	}
 
}
register_widget('App_Logged_Widget');