<?php // Custom User Info area when user is logged in Widget
    
class User_Info_Widget extends WP_Widget {
	function User_Info_Widget() {
		$widget_ops = array('classname' => 'widget_user_info', 'description' => 'User Info area when user is logged in.' );
		$this->WP_Widget('user-info', 'User Admin Area', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
     
    $user = get_user_by("slug",$username);

//$avatar = get_avatar($user->ID,140);

if ($user)
	$userString = "username='$username'";


$avatar = "/avatar?uid=".$user->ID;
//$userPosts = 'http://www.northamericanwhitetail.fox/slim/api/superpost/user/posts/'.$user->ID;
		
$displayStyle = "display:none;";
$loginStyle = "";

if ( is_user_logged_in() ) {

	$displayStyle = "";
	$loginStyle = "display:none;";
	
	wp_get_current_user();
	
	$current_user = wp_get_current_user();
    if ( !($current_user instanceof WP_User) )
         return;
}
?>

    <aside id="user-info-widget" class="box widget_user-info" style="<?php echo $displayStyle; ?>">
	    <div class="sidebar-header">
		    <h2>You Are Logged In</h2>
		</div>
		
		<div class="center-content">
			<div class="user-info-area">
				<div class="user-avatar"><a href="/profile/<?php echo $current_user->user_nicename; ?>"><img src="/avatar?uid=<?php echo $current_user->ID; ?>" alt="User Avatar" class="recon-gravatar" /></a></div>  
				<a class="name" href="/profile/<?php echo $current_user->user_nicename; ?>"><span id="current-user-name"><?php echo $current_user->display_name; ?></span></a>
				
		    	<div class="score-box">
		    		<h2 class="user-points">0</h2> <span> Points</span>
		    	</div>
			</div>
		</div><!-- end wrapper -->
			
			<div class="post-btn">
				<a class="start" href="/community-post">+ Start New Post</a>
			</div>
			<div class="admin-area">
			<a href="/login/?action=profile">Edit Profile</a> <span> | </span> <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout">Logout</a>
		</div>

		
		
		    </aside>
    <div class="clear"></div>
    
    <script type="text/javascript">
	    // Auto Center user info and avatar based on width of the user name
	    jQuery(document).ready(function(){
		var	totalWidth = jQuery('#user-info-widget .user-info-area').outerWidth(),
			totalChildren = jQuery('#user-info-widget .center-content').size();
			containerWidth = totalWidth * totalChildren;
	
			jQuery('.wrapper').width(containerWidth);
		});
		// Run User Points script
		
	</script>
    
<?php	}
 
}
register_widget('User_Info_Widget');
