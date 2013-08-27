<?php // Custom Join NAW+ Widget
    
class Join_Widget extends WP_Widget {
	function Join_Widget() {
		$widget_ops = array('classname' => 'widget_gravity_form', 'description' => 'Custom Join NAW+ Widget.' );
		$this->WP_Widget('join', 'Join NAW+', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
    
    $hostname = $_SERVER['SERVER_NAME'];
    
	$userInfo = wp_get_current_user();
	
	$username = $userInfo->user_nicename;

	$apiURL = "http://$hostname/community-api/users/$username?get_comments=1";
	
	$file = file_get_contents($apiURL);
	
	//SET TEMPLATE VARIABLES
	$data = json_decode($file);
	
	if($data->score == 1){
		$niceScore = '<b>'.$data->score.'</b> Point';
	}else{
		$niceScore = '<b>'.$data->score.'</b> Points';
	} 
	
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

	    <div id="join" class="join-box fb-join-widget-box" style="<?php echo $loginStyle; ?>">
	        <h3><span>Post</span> a Photo</h3>
	        <a href="#" id="imo-fb-login-button" class="fb-login join-widget-fb-login btn-fb-login">Fast Login with Facebook</a>
	        <div class="sub-photo-note">* we do not post anything to your wall unless you say so!</div>
	        <span class="or-delim">OR</span>
	        <a href="#" class="email-signup">Use Your Email Address</a>
	    </div>

		
		<div class="join-box" style="<?php echo $displayStyle; ?>">
	        <h3><span>YOU ARE</span> LOGGED IN</h3>
	        <div class="profile-panel">
	            <div class="profile-photo">
	                <a href="/profile/<?php echo $data->display_name; ?>"><img src="/avatar?uid=<?php echo $data->ID; ?>" alt="<?php echo $data->display_name; ?>" title="<?php echo $data->display_name; ?>"></a>
	            </div>
	            <div class="profile-data">
	                <h4><a href="/profile/<?php echo $data->username; ?>"><?php echo $data->display_name; ?></a></h4>
	                <strong class="user-points"><?php echo $niceScore; ?></strong>
	            </div>
	        </div>
			<a href="/photos/new/" class="btn-red btn-red2">Start New Post</a>
	        <div class="edit-section">
	            <a href="/edit-profile/?action=profile">edit profile</a>
	        </div>
	    </div>


<?php	}
 
}
register_widget('Join_Widget');