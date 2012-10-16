<?php // Custom Community Menu Widget

class Community_Menu_Widget extends WP_Widget {
	function Community_Menu_Widget() {
		$widget_ops = array('classname' => 'widget_community_menu', 'description' => 'community menu for ubermenu' );
		$this->WP_Widget('community_menu', 'Community Menu', $widget_ops);
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

    <aside id="community-menu-nav" class="community-menu-widget">
    	<div class="header">
    		<h2>The NAW Community</h2>
    		<h3>Bringing Whitetail Hunters Together</h3>
    	</div>
    	<div class="nav">
	     	<a href="/community/report">State Rut Reports</a>
	     	<a href="/community/trophy">Trophy Bucks</a>
	     	<a href="/community/question">Questions</a>
	     	<a href="/community/gear">Gear</a>
	     	<a href="/community/lifestyle">Lifestyle</a>
			<a href="/community/tip">Tips & Tactics</a>
			<a href="/community/general">General Discussion</a>
    	</div>
     	<div id="imo-fb-login-button" class="fb-login join-widget-fb-login" style="<?php echo $loginStyle; ?>">Fast Facebook Login</div>
		<small style="<?php echo $loginStyle; ?>">*we do not post anything to your wall unless you say so!</small>
    </aside>

<?php	}
 
}
register_widget('Community_Menu_Widget');