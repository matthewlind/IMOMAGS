<?php // Custom Get the App widget when user is logged out Widget
    
class App_Logged_Out_Widget extends WP_Widget {
	function App_Logged_Out_Widget() {
		$widget_ops = array('classname' => 'widget_app_logged_out', 'description' => 'Get the App widget when user is logged out.' );
		$this->WP_Widget('app-logged-out', 'Get the App (Logged Out)', $widget_ops);
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

    <aside id="get-app" class="box widget_get-app logged-out" style="<?php echo $loginStyle; ?>">
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
			<div class="download">Download Whitetail+</div>
		</div>
    </aside>


<?php }
 
}
register_widget('App_Logged_Out_Widget');