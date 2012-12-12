<?php // Custom Join NAW+ Widget
    
class Join_Widget extends WP_Widget {
	function Join_Widget() {
		$widget_ops = array('classname' => 'widget_gravity_form', 'description' => 'Custom Join NAW+ Widget.' );
		$this->WP_Widget('join', 'Join NAW+', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
     
    //set to false to revert to default join widget
    $contest = true;
    
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
	    <div class="fb-join-widget-box" style="<?php echo $loginStyle; ?>">
		    <aside id="join" class="box widget_gravity_form " style="<?php echo $loginStyle; ?>">
		    	<div class="content_wrapper">
			    <h1>Join the NAW Community!</h1>
			    <div id="imo-fb-login-button" class="fb-login join-widget-fb-login">Fast Facebook Login</div>
			    <small>*we do not post anything to your wall unless you say so!</small>
			    <a class="email-signup">or use your email address</a>

		<?php if($contest == true){ ?>
		    <a class="prize-title">Post a photo and you're automatically entered to win this TenPoint Crossbow!</a>
		      <div class="prize"></div>
		      <small class="prize-desc">*Model Stealth XLT w/ ACUdraw 50</small>
		    <a href="/community/sweeps-rules/" class="about-link">Official Rules</a>
		    
	    <?php } ?>
    
   	    	<a href="/community/help/" class="about-link">What is North American Whitetail +?</a>
	       </div>
	    </aside>
    </div>
    <div class="clear"></div>
<?php	}
 
}
register_widget('Join_Widget');